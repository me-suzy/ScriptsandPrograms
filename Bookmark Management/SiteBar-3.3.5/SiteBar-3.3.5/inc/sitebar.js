/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software; you can redistribute it and/or modify      *
 *  it under the terms of the GNU General Public License as published by      *
 *  the Free Software Foundation; either version 2 of the License, or         *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU General Public License for more details.                              *
 *                                                                            *
 *  You should have received a copy of the GNU General Public License         *
 *  along with this program; if not, write to the Free Software               *
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA *
 ******************************************************************************/

/*** Global variables *********************************************************/

// Skin directory
var SB_gSkinDir = null;

// Image holder to fix problems with cache
var SB_gImageHolder = new Array();

// Currently selected context menu
var SB_gCtxMenu = null;

// Semaphore for ignoring bubbling of eventsusing timers
var SB_gIgnore = 0;

// Timer for hiding context menu
var SB_gHideTimer = null;

// Object reference of the right clicked object
var SB_gTargetID = null;

// ID to be copied or moved
var SB_gSourceID = null;

// ID of the dragged object
var SB_gDraggedID = null;

// Object to show tool tip
var SB_gToolTipObj = null;
var SB_gToolTipTop = null;
var SB_gToolTipLeft = null;

// Saved color
var SB_gDraggingStyleBG = null;
var SB_gDraggingStyleFG = null;

// Is source node? If not it is link.
var SB_gSourceTypeIsNode = null;

// Global variable to focus already opened window
var SB_gCmdWin = null;

// Should external window be used?
var SB_gAutoReload = true;

// In place commands
var SB_gInPlaceCommands = new Array();

// Default search prefix
var SB_gDefaultSearch = null;

// Previous opened parent - optimization
var SB_gPrevParent = null;

// Saved state of nodes
var SB_gState = null;

// Filter state
var SB_gFilterActive = false;

var SB_gHighlighted = new Array();
var SB_gHidden = Array();

/*** Autoload *****************************************************************/

function SB_getCookie(name, defaultValue)
{
    var index = document.cookie.indexOf(name + "=");
    if (index == -1)
    {
        return defaultValue;
    }
    index = document.cookie.indexOf("=", index) + 1; // first character
    var endstr = document.cookie.indexOf(";", index);

    if (endstr == -1)
    {
        endstr = document.cookie.length; // last character
    }
    return unescape(document.cookie.substr(index, endstr));
}

SB_gState = SB_getCookie('SB3NODES','!');

/*** Toolbar functions ********************************************************/

function SB_buttonDown(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'pressed';
}

function SB_buttonUp(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'raised';
}

function SB_buttonOver(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'raised';
}

function SB_buttonOut(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = '';
}

function SB_storeSearch()
{
    searchText = document.getElementById('fldSearch').value;
    document.cookie = 'SB3SEARCH='+encodeURIComponent(searchText);
}

function SB_storePosition()
{
    document.cookie = 'SB3TOP='+SB_getTop();
    document.cookie = 'SB3LEFT='+SB_getLeft();
}

/**
 * Add remove class name to the link
 */
function SB_classLink(linkObj, highlight)
{
    var className = 'highlight';

    // We are highlighted
    if (linkObj.className.indexOf(className)==0)
    {
        // And still should be
        if (highlight)
        {
            return;
        }
        else // Remove the style
        {
            linkObj.className = linkObj.className.substr(className.length);
        }
    }
    else // We are not
    {
        // And do not want be
        if (!highlight)
        {
            return;
        }
        else // Add the style
        {
            linkObj.className = className + ' ' + linkObj.className;
            SB_gHighlighted[SB_gHighlighted.length] = linkObj;
        }
    }
}

/**
 * Filter links with matching name or URL
 */
function SB_filter(icon)
{
    var btnFilter = document.getElementById('btnFilter');

    if (SB_gFilterActive)
    {
        SB_unfilter();
        if (icon) return;
    }

    for (i=0; i<SB_gHighlighted.length; i++)
    {
        SB_classLink(SB_gHighlighted[i], false);
    }

    SB_gHighlighted = new Array();

    var fld  = document.getElementById('fldSearch');
    var text = fld.value;
    if (text.length==0) return;

    SB_gFilterActive = true;
    SB_buttonDown(btnFilter, true);

    var type = SB_gDefaultSearch;
    SB_gPrevParent = null;

    // Check search pattern
    var reST = new RegExp("^(url|desc|name|all):(.*)$");
    if (text.match(reST))
    {
        type = RegExp.$1;

        // If we have pattern then use it
        if (type == 'url'
        ||  type == 'desc'
        ||  type == 'name'
        ||  type == 'all')
        {
            text = RegExp.$2;
        }
    }

    var re = new RegExp(text,"i")

    var divs = document.getElementsByTagName('div');
    for (i = 0; i<divs.length; i++)
    {
        if (divs[i].className == 'node')
        {
            nodeAnchor = document.getElementById('a'+divs[i].id);
            if (SB_getLinkName(nodeAnchor).search(re)!=-1)
            {
                SB_classLink(nodeAnchor, true);
                divs[i].style.display = 'block';
                SB_openParents(divs[i].parentNode.parentNode);
            }
            else
            {
                divs[i].style.display = 'none';
                SB_gHidden[SB_gHidden.length] = divs[i];
            }
        }
    }

    var links = document.getElementsByTagName('a');
    for (i = 0; i<links.length; i++)
    {
        var name = SB_getLinkName(links[i]);
        var url = links[i].getAttribute('href');
        var desc = links[i].getAttribute('x_title');
        if (!desc)
        {
            links[i].getAttribute('title');
        }

        var parentDIV = links[i].parentNode;

        // Ignore everything but links in tree
        if (parentDIV.className.indexOf('link')==-1) continue;

        var subject = '';

        if (type=='url'  || type=='all') subject += url;
        if (type=='name' || type=='all') subject += name;
        if (type=='desc' || type=='all') subject += desc;

        if (subject.search(re)!=-1)
        {
            SB_openParents(parentDIV.parentNode.parentNode);
            SB_classLink(links[i], true);
        }
    }

    for (i = 0; i<divs.length; i++)
    {
        if (divs[i].className == 'node')
        {
            nodeAnchor = document.getElementById('a'+divs[i].id);
            // Folder is not matching
            if (SB_getLinkName(nodeAnchor).search(re)==-1)
            {
                var children = document.getElementById('c'+divs[i].id).childNodes;

                for (var j = 0; j < children.length; j++)
                {
                    if (children[j].className == 'link')
                    {
                        if (document.getElementById('a'+children[j].id).className.indexOf('highlight')>-1)
                        {
                            continue;
                        }
                        children[j].style.display = 'none';
                        SB_gHidden[SB_gHidden.length] = children[j];
                    }
                }
            }
        }
    }

    fld.select();
    fld.focus();
}

function SB_unfilter()
{
    if (!SB_gFilterActive) return;
    SB_gFilterActive = false;

    for (var i=0; i<SB_gHidden.length; i++)
    {
        SB_gHidden[i].style.display = 'block';
    }

    SB_gHidden = new Array();

    SB_buttonOut(document.getElementById('btnFilter'));
    document.getElementById('fldSearch').focus();
}

/**
 * For search functions: opens all parent folders
 */
function SB_openParents(parentNode)
{
    if (SB_gPrevParent == parentNode)
    {
        return;
    }

    SB_gPrevParent = parentNode;

    var obj = parentNode;
    while (obj && obj.getAttribute('x_level')!=null
        && obj.getAttribute('x_level')!='') // For Opera
    {
        obj.style.display = 'block';
        SB_node(false, obj, true);
        obj = obj.parentNode.parentNode;
    }
}

/**
 * For search functions: returns name of the link (ignores leading tags)
 */
function SB_getLinkName(linkTag)
{
    if (linkTag.innerHTML.match(/.*>(.*)/))
    {
        return RegExp.$1;
    }
    else
    {
        return linkTag.innerHTML;
    }
}

/**
 * Reload sitebar keeping images in cache
 */
function SB_reloadPageWorker(cancelled, all)
{
    var url = 'index.php?';
    var sParam = location.search;

    if (sParam && sParam.length && sParam.split)
    {
        var aParam = sParam.substr(1).split('&');

        for (var i=0; i<aParam.length; i++)
        {
            var aPair = aParam[i].split('=');
            if (aPair[0] == 'reload') continue;
            if (aPair[0] == 'uniq') continue;

            url += aParam[i] + '&';
        }
    }

    location.href = url + 'reload=' + (all?'all':'yes') +
              (!cancelled?'&uniq=' + (new Date()).valueOf():'');
}

function SB_reloadPage()
{
    SB_storePosition();
    SB_reloadPageWorker();
}

/**
 * Reload with hidden folders and all roots
 */
function SB_reloadAll()
{
    SB_storePosition();
    SB_reloadPageWorker(false, true);
}

/**
 * Collapse all nodes
 */
function SB_collapseAll()
{
    if (SB_gState.length==0 || SB_gState=='!')
    {
        SB_expandAll();
        return;
    }

    divs = document.getElementsByTagName('div');
    for (var i=0; i<divs.length; i++)
    {
        div = divs[i];
        level = div.getAttribute('x_level');
        if (level!=null && level!='') // '' for Opera
        {
            SB_node(null, div, false, true);
        }
    }

    SB_gState = '!';
    SB_saveCookie(SB_gState);
}


/**
 * Collapse all nodes
 */
function SB_expandAll()
{
    divs = document.getElementsByTagName('div');
    for (var i=0; i<divs.length; i++)
    {
        div = divs[i];
        level = div.getAttribute('x_level');
        if (level!=null && level!='') // '' for Opera
        {
            SB_node(null, div, true);
        }
    }
}

/**
 * Change CSS style
 */
function SB_changeCSS(myclass,element,value)
{
    var CSSRules;

    if (document.all)
    {
        CSSRules = 'rules'
    }
    else if (document.getElementById)
    {
        CSSRules = 'cssRules'
    }

    for (var i = 0; i < document.styleSheets[0][CSSRules].length; i++)
    {
        var rule = document.styleSheets[0][CSSRules][i];

        if (rule.selectorText && rule.selectorText.toUpperCase() == myclass.toUpperCase())
        {
            var oldValue = rule.style[element];
            if (value)
            {
                rule.style[element] = value;
            }
            return oldValue;
        }
    }

    // Class not found
    return '';
}

/*** Drag & Drop **************************************************************/

function SB_changeStyleForDragging(dragging)
{
    var style = 'div.tree a:hover';

    if (dragging)
    {
        // Get colors only
        bg = SB_changeCSS(style + ' .selected', 'background');
        fg = SB_changeCSS(style + ' .selected', 'color');

        // Change color attributes
        SB_gDraggingStyleBG = SB_changeCSS(style, 'background', bg);
        SB_gDraggingStyleFG = SB_changeCSS(style, 'color', fg);
    }
    else
    {
        SB_changeCSS(style, 'background', SB_gDraggingStyleBG);
        SB_changeCSS(style, 'color', SB_gDraggingStyleFG);
    }
}

function SB_nodeDrag(event, id)
{
    if (event.button == 2 || SB_gDraggedID != null)
    {
        return false;
    }

    SB_changeStyleForDragging(true);
    SB_gDraggedID = id;
    SB_gSourceTypeIsNode = true;
    return false;
}

function SB_linkDrag(event, id)
{
    if (event.button == 2 || SB_gDraggedID != null)
    {
        return false;
    }

    SB_changeStyleForDragging(true);
    SB_gDraggedID = id;
    SB_gSourceTypeIsNode = false;
    return false;
}

function SB_cancelDragging()
{
    if (SB_gDraggedID!=null)
    {
        SB_changeStyleForDragging(false);
        SB_gDraggedID = null;
    }
}

function SB_nodeDrop(event, id, linkID)
{
    if (id == SB_gDraggedID || (!SB_gSourceTypeIsNode && linkID && linkID == SB_gDraggedID))
    {
        return true;
    }

    if (event.button == 2 || SB_gDraggedID == null)
    {
        return false;
    }

    SB_stopIt(event);
    SB_gSourceID = SB_gDraggedID;
    SB_cancelDragging();
    SB_commandWindow("Paste", id);
    return false;
}

/*** Image preloading *********************************************************/

/**
 * Preload images - necessary for Internet Explorer otherwise
 * some image is always somehow missing.
 * Does not harm any other browser. Function setImgDir is called
 * just after this script is included on the page.
 */

function SB_setSkinDir(skindir)
{
    SB_gSkinDir = skindir;

    var images = Array
    (
        'collapse',
        'connect',
        'empty',
        'filter',
        'join',
        'join_last',
        'link',
        'link_private',
        'menu',
        'minus',
        'minus_last',
        'node',
        'node_open',
        'plus',
        'plus_last',
        'reload',
        'reload_all',
        'root',
        'root_deleted',
        'root_plus'
    );

    /**
     * This is called when the script is loaded automatically.
     */
    for (var i=0; i<images.length; i++)
    {
        var img = new Image();
        img.src = SB_imgPath(images[i]);
        SB_gImageHolder[SB_gImageHolder.length] = img;
    }
}

function SB_imgPath(basename)
{
    return SB_gSkinDir + '/' + basename + '.png';
}

/*** Commander functions ******************************************************/

function SB_initCommander()
{
    document.cookie = 'SB3COOKIE=1';

    var field = document.getElementById('focused');
    if (field)
    {
        field.focus();
    }
    if (window && window.focus)
    {
        window.focus();
    }
}

function SB_initPage(autoReload, defaultSearch, inPlaceCommands)
{
    SB_gAutoReload = autoReload;
    SB_gInPlaceCommands = inPlaceCommands;
    SB_gDefaultSearch = defaultSearch;
    if (!SB_isOpera())
    {
        setTimeout("SB_restorePosition()",10);
    }
}

function SB_onLoad()
{
    if (SB_isOpera())
    {
        SB_restorePosition();
    }
}

function SB_restorePosition()
{
    var iTop = parseInt(SB_getCookie("SB3TOP",-1),10);
    var iLeft = parseInt(SB_getCookie("SB3LEFT",-1),10);

    if (iTop!=-1)
    {
        window.scroll(iLeft,iTop);
    }
}

/*** Tree collapsing/expanding ************************************************/

/**
 * When a div is clicked this event becomes all its parent, however, the
 * the innermost is the first. We increader ignore semaphore and schedule
 * its zeroing after 10 milliseconds. Any subsequent call of stopIt will
 * return false before it is zeroied.
 */
function SB_stopIt(event)
{
    // If event not filled then user initiated action which should
    // not be stopped.
    if (!event) return false;

    SB_gIgnore++;
    if (SB_gIgnore>1) return true;

    setTimeout("SB_gIgnore=0;",10);
    return false;
}

/**
 * Renew the event - for Opera Ctrl+click.
 */
function SB_renewIt(event)
{
    SB_gIgnore=0;
}

/**
 * If the base is not content is must be changed to main, what is most likely
 * Internet Explorer and works in Opera.
 */
function SB_hasTargetWindow( name)
{
    return name=="_content" && window.sidebar && window.sidebar.addPanel;
}

/**
 * When a menu should be shown on link when using Ctrl click
 */
function SB_isOpera()
{
    return window.opera && window.print;
}

/**
 * Save state of certain node
 */
function SB_saveState(id, state)
{
    SB_gState = (state?'Y':'N')+id.substr(1)+':'+SB_gState;
    SB_saveCookie(SB_gState);
}

/**
 * Save global state cookie
 */
function SB_saveCookie(value)
{
    expires = new Date(new Date().getTime()+1000*60*60*24*7).toGMTString();
    document.cookie = 'SB3NODES='+value+'; expires=' + expires;
}

/**
 * Toggle display of any div referenced as object
 */
function SB_toggleDiv( div, show )
{
    if (show!=null)
    {
        div.style.display = (show?'block':'none');
        return show;
    }

    if (div.style.display=='')
    {
        if (div.className.indexOf('Expanded')>-1)
        {
            div.style.display = 'block';
        }
        if (div.className.indexOf('Collapsed')>-1)
        {
            div.style.display = 'none';
        }
    }

    div.style.display = (div.style.display=='block'?'none':'block');
    return (div.style.display=='block');
}

/**
 * Activated on click on node (folder). Changes + and - sign according to
 * current state.
 */
function SB_node(event, obj, show, noSaveState)
{
    if (SB_stopIt(event)) return false;

    SB_menuOff();
    SB_cancelDragging();

    if (event)
    {
        if (event.ctrlKey)
        {
            SB_renewIt(event);
            SB_menuOn(event, obj);
            return false;
        }
    }

    var simg = document.getElementById('is' + obj.id);
    var nimg = document.getElementById('in' + obj.id);
    var children = document.getElementById('c' + obj.id);

    var root = obj.getAttribute('x_level')=='1';
    var opened = SB_toggleDiv(children, show);

    if (!noSaveState)
    {
        SB_saveState(obj.id, opened);
    }

    if (root)
    {
        var deleted = obj.getAttribute('x_acl').indexOf('*')==-1;
        var links = children.getElementsByTagName('a');
        nimg.src = SB_imgPath( (opened||!links.length
            ?'root'+(deleted?'_deleted':''):'root_plus'));
    }
    else if (simg)
    {
        var last = (simg.src.indexOf("_last.png")>-1);
        simg.src = SB_imgPath( (opened?'minus':'plus') + (last?'_last':""));
        nimg.src = SB_imgPath( 'node' + (opened?'_open':""));
    }

    return true;
}

function SB_nodeReload(event, obj)
{
    if (SB_node(event, obj))
    {
        var children = document.getElementById('c' + obj.id);

        // If we have opened it now, but there are no children
        if (children.style.display == 'block'
        &&  children.className == 'childrenCollapsed')
        {
            SB_storePosition();
            setTimeout('SB_reloadPageWorker()',10);
        }
    }
}

/**
 * Ctrl link in Opera substitutes right click.
 */
function SB_lnk(event,obj)
{
    SB_cancelDragging();

    if (event.ctrlKey && SB_isOpera())
    {
        SB_menuOn(event, obj);
        return false;
    }
    else
    {
        SB_stopIt(event);
        return true;
    }
}

/*** Context menu functionality ***********************************************/

function SB_getCoordTop(event)
{
    var topOffset = document.documentElement.scrollTop;
    if (!topOffset)
    {
        topOffset = document.body.scrollTop;
    }
    return event.clientY - 0 + topOffset;
}

function SB_getCoordLeft(event)
{
    return event.clientX - 0;
}

function SB_getTop()
{
    var topOffset = document.documentElement.scrollTop;
    if (!topOffset)
    {
        topOffset = document.body.scrollTop;
    }
    return topOffset;
}

function SB_getLeft()
{
    var leftOffset = document.documentElement.scrollLeft;
    if (!leftOffset)
    {
        leftOffset = document.body.scrollLeft;
    }
    return leftOffset;
}

/**
 * Called on right click on nodes or items
 */
function SB_menuOn(event, obj)
{
    if (SB_stopIt(event)) return false;
    SB_cancelDragging();

    // Store reference in the global variable
    SB_gTargetID = obj;

    var menuDIV = (obj.id.charAt(0)=='n'?'node':'link');
    SB_gCtxMenu = document.getElementById(menuDIV+'CtxMenu');

    if (menuDIV=='node')
    {
        document.cookie = 'SB3CTXROOT='+obj.id.substr(1);
    }

    // Hide the other contex menu
    SB_hideMenus(SB_gCtxMenu);
    SB_toolTip(); // Hides tooltip

    SB_gCtxMenu.style.top = SB_getCoordTop(event);
    SB_gCtxMenu.style.left = SB_getCoordLeft(event);

    SB_gCtxMenu.style.display = 'block';

    // Get ACL for node
    var nodeACL = obj.getAttribute("x_acl");

    // Set initial state of all items in the context menu
    for (var i=0;;i++)
    {
        menuItem = document.getElementById(menuDIV+'Item'+i);
        if (!menuItem) break;

        // If not separator then set off or disable
        if (menuItem.className!='separator')
        {
            var commandACL = menuItem.getAttribute("x_acl");

            if (!commandACL)
            {
                continue;
            }

            var commandSPEC = null;

            var arr = commandACL.split('_');
            var disabled = false;

            if (arr.length>1)
            {
                commandACL = arr[0];
                commandSPEC = arr[1];
            }

            // Each command might require some rights, for each letter
            // in the command ACL there must be a letter in the node
            // otherwise the command is disabled
            for (j=0; j<commandACL.length; j++)
            {
                if (nodeACL.indexOf(commandACL.charAt(j))==-1)
                {
                    disabled = true;
                    break;
                }
            }

            if (!disabled && commandSPEC)
            {
                switch (commandSPEC)
                {
                    case 'c':
                        disabled = !(SB_gSourceID);
                        break;
                }
            }

            menuItem.className = 'off';
            if (disabled)
            {
                menuItem.className = 'disabled';
            }
        }
    }

    return false;
}

/**
 * When the item is left this is called to show parent menu.
 */
function SB_menuOff()
{
    SB_gHideTimer = null;
    SB_hideMenus(null);
    SB_gCtxMenu = null;
}

/**
 * Hide all context menus, ignore the one passed as object reference
 */
function SB_hideMenus(ignore)
{
    menus = Array('node','link');
    for (var i=0; i<menus.length; i++)
    {
        menu = document.getElementById(menus[i]+'CtxMenu');
        if (menu != ignore)
        {
            menu.style.display = 'none';
        }
    }
}

/**
 * Activated on mouseover on the item in context menu
 */
function SB_itemOn(item)
{
    // If we have popup menu
    if (SB_gCtxMenu)
    {
        // And its hiding was scheduled
        if (SB_gHideTimer)
        {
            // Stop it
            clearTimeout(SB_gHideTimer);
            SB_gHideTimer = null;
        }
        else
        {
            // Display menu
            SB_gCtxMenu.style.display = 'block';
        }
    }

    SB_toggleItem(item, true);
}

/**
 * Activated on mouse off
 */
function SB_itemOff(item)
{
    SB_gHideTimer = setTimeout('SB_menuOff()', 1000);
    SB_toggleItem(item, false);
}

/**
 * Toggles state of the context menu item
 */
function SB_toggleItem(item, show)
{
    if (item.className.charAt(0) == 'o')
    {
        item.className = show?'on':'off';
        return true;
    }
    return false;
}

/**
 * Activated on click on the context menu item
 */
function SB_itemDo(item, func)
{
    if (item.className!='on')
    {
        return;
    }

    SB_menuOff();
    var nid = null;
    var lid = null;
    var id  = null;

    if (SB_gTargetID)
    {
        id = SB_gTargetID.id.substr(1);
        if (SB_gTargetID.id.charAt(0)=='n')
        {
            nid = id;
        }
        else
        {
            lid = id;
        }
        SB_gTargetID = null;
    }

    if (func)
    {
        eval(func+'(id)');
    }
    else
    {
        SB_commandWindow(item.getAttribute('x_cmd'), nid, lid);
    }
}

function SB_itemDoAlt(id, func)
{
    item = document.getElementById(id);

    SB_menuOff();
    var nid = null;
    var lid = null;
    var id  = null;

    if (SB_gTargetID)
    {
        id = SB_gTargetID.id.substr(1);
        if (SB_gTargetID.id.charAt(0)=='n')
        {
            nid = id;
        }
        else
        {
            lid = id;
        }
        SB_gTargetID = null;
    }

    if (func)
    {
        eval(func+'(id)');
    }
    else
    {
        SB_commandWindow(item.getAttribute('x_cmd'), nid, lid);
    }
}

function SB_toolTip(source, event)
{
    if (event)
    {
        SB_gToolTipObj = source;
        SB_gToolTipTop = SB_getCoordTop(event);
        SB_gToolTipLeft = SB_getCoordLeft(event);
        setTimeout('SB_toolTipShow()',500)
    }
    else
    {
        SB_gToolTipObj = null;
        var toolTipObj = document.getElementById('toolTip');
        if (toolTipObj)
        {
            toolTipObj.style.display = 'none';
        }
    }
}

function SB_toolTipShow()
{
    if (SB_gToolTipObj)
    {
        var toolTipObj = document.getElementById('toolTip');

        if (!toolTipObj || toolTipObj.style.display == 'block')
        {
            return;
        }
        var text = SB_gToolTipObj.getAttribute('x_title');

        if (!text || !text.length)
        {
            return;
        }

        var maxLen = 20;
        var curLen = 0;

        if (text.indexOf(' ')==-1)
        {
            maxLen = text.length;
        }
        else
        {
            for (var i=0; i<text.length; i++)
            {
                curLen = text.indexOf(' ',i);
                if ((curLen-i)>maxLen)
                {
                    maxLen = (curLen-i);
                }
            }
        }

        var width = maxLen*7; // Magic number

        toolTipObj.style.display = 'block';
        toolTipObj.style.width = width;
        if (SB_gToolTipObj.className=='raised')
        {
            toolTipObj.style.top = SB_gToolTipTop+15;

            left = SB_gToolTipLeft-width;

            if (left<0)
            {
              left = 0;
            }

            toolTipObj.style.left = left;
        }
        else
        {
            toolTipObj.style.top = SB_gToolTipTop+22;
            toolTipObj.style.left = SB_gToolTipLeft/10;
        }
        toolTipObj.innerHTML = text;
    }
}

/**
 * Called on node Copy command
 */
function SB_nodeCopy(nid)
{
    SB_gSourceID = nid;
    SB_gSourceTypeIsNode = true;
}

/**
 * Called on node Hide command
 */
function SB_nodeHide(nid)
{
    nodeObj = document.getElementById('n'+nid);
    nodeObj.style.display = 'none';
    SB_commandWindow("Hide Folder", nid, null);
}

/**
 * Called on node Copy command
 */
function SB_linkCopy(lid)
{
    SB_gSourceID = lid;
    SB_gSourceTypeIsNode = false;
}

/**
 * Open control window
 */
function SB_commandWindow(command, nid, lid)
{
    uri = "command.php?command=" + command +
        (nid?"&nid_acl="+nid:"") +
        (lid?"&lid_acl="+lid:"") +
        (SB_gSourceID?"&sid="+SB_gSourceID+"&stype="+(SB_gSourceTypeIsNode?"1":"0"):"");

    var sParam = location.search;
    var aPersistentParams = new Array( 'target', 'w', 'mode' );

    if (sParam && sParam.length && sParam.split)
    {
        var aParam = sParam.substr(1).split('&');

        for (var i=0; i<aParam.length; i++)
        {
            var aPair = aParam[i].split('=');

            for (var j=0; j<aPersistentParams.length; j++)
            {
                if (aPersistentParams[j] == aPair[0])
                {
                    uri += '&' + aParam[i];
                }
            }
        }
    }

    inPlaceCommand = false;
    for (var i=0; i<SB_gInPlaceCommands.length; i++)
    {
        if (command == SB_gInPlaceCommands[i])
        {
            inPlaceCommand = true;
            break;
        }
    }

    if (!SB_gAutoReload && !inPlaceCommand)
    {
        winPrefs = "resizable=yes,dependent=no,"+
            "width=240,height=480,top=200,left=300,titlebar=yes,scrollbars=yes";
        if (SB_gCmdWin && !SB_gCmdWin.closed) SB_gCmdWin.focus();
        SB_gCmdWin = window.open(uri, 'sitebar_gCmdWin', winPrefs);
        SB_gCmdWin.focus();
        SB_gSourceID = null;
    }
    else
    {
        location.href=uri;
    }
}
