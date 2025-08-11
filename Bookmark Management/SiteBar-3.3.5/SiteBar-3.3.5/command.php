<?php
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

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/usermanager.inc.php');
require_once('./inc/tree.inc.php');

/**
* Change the line below to command.cgi, if you have backend problems with
* importing bookmarks or other security related problems or your server
* runs PHP in a 'safe mode' :
*/
define( 'FORM_ACTION_EXECUTOR', 'command.php');
/*
* Example of command.cgi (create manually, save as "command.cgi" and
* upload to the same directory as this file is :
* --- BEGIN ---
* #!/usr/bin/php
* <?php include("command.php"); ?>
* --- END ---
*/

/******************************************************************************/

class CommandWindow extends SB_ErrorHandler
{
    var $command;
    var $um;
    var $tree;

    var $reload = false;
    var $close = false;

    var $fields = array();
    var $message = '';
    var $nobuttons = false;
    var $bookmarklet = false;
    var $onLoad = 'SB_initCommander()';
    var $showWithErrors = false;
    var $skipBuild = false;
    var $forward = false;
    var $getInfo = false;
    var $useToolTips = null;

    var $persistentParams = array('target','mode','w');

    function CommandWindow()
    {
        $this->command = SB_reqVal('command');

        if (!$this->command)
        {
            $this->error('Missing command!');
        }

        if (is_array($this->command))
        {
            $this->command=key($this->command);
        }

        if (SB_reqChk('weblinks'))
        {
            $this->bookmarklet = true;
        }

        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();

        $this->useToolTips = $this->um->getParam('user','use_tooltips');
        $this->handleCommand();
    }

    function handleCommand()
    {
        if (!$this->um->isAuthorized($this->command,
            in_array($this->command, array('Log In', 'Log Out', 'Sign Up')),
            SB_reqVal('command_gid'), SB_reqVal('nid_acl'), SB_reqVal('lid_acl')))
        {
            $this->um->accessDenied();
            return;
        }

        // For logout we do not build the form and just execute
        // Do is set on build forms (if not set another form is opened)
        if (!$this->forward && (SB_reqVal('do') ||
           in_array($this->command,array('Log Out'))))
        {
            $this->reload = !$this->um->getParam('user','extern_commander');
            $this->close = $this->um->getParam('user','auto_close');

            $execute = 'command' . $this->shortName();
            $this->forward = false;

            if (method_exists($this, $execute))
            {
                $this->$execute();
            }

            foreach ($this->um->plugins as $plugin)
            {
                if (in_array($this->command, $plugin['command']))
                {
                    $execute = $plugin['prefix'].'Command'.$this->shortName();
                    $execute($this);
                }
            }

            if ($this->forward)
            {
                $this->handleCommand();
            }
        }
        else
        {
            $this->handleCommandBuild();
        }
    }

    function handleCommandBuild()
    {
        $built = false;

        $execute = 'build' . $this->shortName();

        if (method_exists($this, $execute))
        {
            $fields = $this->$execute();
            $built = true;
        }

        foreach ($this->um->plugins as $plugin)
        {
            if (in_array($this->command, $plugin['build']))
            {
                $execute = $plugin['prefix'].'Build'.$this->shortName();
                $execute($this, $fields);
                $built = true;
            }
        }

        if (!$this->skipBuild)
        {
            if (!$built || !count($fields))
            {
                if (!$this->hasErrors())
                {
                    $this->error('Unknown command.');
                }
            }
            else
            {
                $this->fields = $fields;
            }
        }
    }

    function shortName()
    {
        return str_replace(' ','',$this->command);
    }

    function forwardCommand($command)
    {
        if (!$this->hasErrors() && !$this->message)
        {
            $this->fields  = array();
            $this->command = $command;
            $this->forward = true;
        }
    }

    function goBack()
    {
        // We cannot repair error in this case because we would
        // lost additional infomation.
        if (SB_reqChk('bookmarklet') && $this->command='Log In')
        {
            $this->bookmarklet = true;
            return;
        }

        $this->showWithErrors = true;
        $execute = 'build' . $this->shortName();

        if (method_exists($this, $execute))
        {
            $fields = $this->$execute();
        }

        foreach ($this->um->plugins as $plugin)
        {
            if (in_array($this->command, $plugin['build']))
            {
                $execute = $plugin['prefix'].'Build'.$this->shortName();
                $execute($this, $fields);
            }
        }

        foreach ($fields as $name => $params)
        {
            if (isset($fields[$name]['name']) && !strstr($name,'-raw') )
            {
                $fields[$name]['value'] = SB_reqVal($fields[$name]['name']);
            }
        }

        $this->fields = $fields;
    }

    function inPlace()
    {
        return !$this->bookmarklet &&
            (in_array($this->command, $this->um->inPlaceCommands()) ||
             !$this->um->getParam('user','extern_commander'));
    }

    function getParams($html=true)
    {
        $params = array();
        $params[] = 'uniq=' . time();

        foreach ( $this->persistentParams as $param)
        {
            if (isset($_REQUEST[$param]))
            {
                $params[] = $param.'='.$_REQUEST[$param];
            }
        }

        return '?' . implode($html?'&amp;':'&',$params);;
    }

    function getFieldParams($params)
    {
        static $tabindex = 1;

        if (!isset($params['maxlength']) && isset($params['name']))
        {
            if ($params['name'] == 'name' || $params['name'] == 'email')
            {
                $params['maxlength'] = 50;
            }
        }

        $txt = '';

        if (!array_key_exists('disabled', $params)
        &&  !array_key_exists('hidden', $params)
        &&   isset($params['type'])
        &&   $params['type']=='text')
        {
            if ($tabindex==1)
            {
                $txt .= 'id="focused" ';
            }
            $tabindex++;
        }

        foreach ($params as $param => $value)
        {
            if ($value!=='' && $param{0}!='_')
            {
                if ($param=='type' && $value=='textarea')
                {
                    continue;
                }

                if ($param=='title' && $this->useToolTips)
                {
                    $param='x_title';
                    $txt .= SB_Page::toolTip();
                }

                if ($param=='value')
                {
                    $value = SB_Page::quoteValue($value);
                }
                $txt .= $param . ($value?'="' . $value . '" ':' ');
            }
        }
        return $txt;
    }

    function getToolTip($params)
    {
        if (!isset($params['title']))
        {
            return '';
        }

        $txt = '';

        $param = 'title';
        if ($this->useToolTips)
        {
            $param='x_title';
            $txt .= SB_Page::toolTip();
        }

        $txt .= $param.'="'. $params['title'] . '" ';
        return $txt;
    }

    function checkFile($name)
    {
        if (isset($_FILES[$name]['name']) && !$_FILES[$name]['name'])
        {
            // We cannot do this directly because it would be always missing
            $this->checkMandatoryFields(array($name));
            $this->goBack();
            return false;
        }

        if (!is_uploaded_file($_FILES[$name]['tmp_name']) || !$_FILES[$name]['size'])
        {
            $this->error('Invalid filename or other upload related problem: %s!',
                array( SB_safeVal($_FILES[$name],'error')));
            $this->goBack();
            return false;
        }

        return true;
    }

    function _getAuthMethod()
    {
        $auths = array('');
        $dirname = "./plugins";

        if (is_dir($dirname) && ($dir = opendir($dirname)))
        {
            while (($plugin = readdir($dir)) !== false)
            {
                $plugdir = $dirname.'/'.$plugin;

                if (!is_dir($plugdir))
                {
                    continue;
                }

                $plugfile = $plugdir.'/auth.inc.php';

                if (is_file($plugfile))
                {
                    $auths[] = $plugin;
                }
            }
            closedir($dir);
        }

        return count($auths) > 1 ? $auths : array();
    }

    function _buildAuthList($select=null)
    {
        foreach ($this->_getAuthMethod() as $auth)
        {
            echo '<option '. ($select==$auth?'selected':'') .
                 ' value="' . $auth . '">' . (strlen($auth)?$auth:'SiteBar') . "</option>\n";
        }
    }

    function _buildSkinList($select=null)
    {
        if ($select == null || $select == '')
        {
            $select = SB_Skin::get();
        }

        if ($dir = opendir("./skins"))
        {
            $skins = array();
            while (($dirname = readdir($dir)) !== false)
            {
                if (!file_exists('./skins/'.$dirname.'/hook.inc.php')) continue;
                $skins[] = $dirname;
            }
            closedir($dir);

            sort($skins);
            foreach ($skins as $skin)
            {
                echo '<option '. ($select==$skin?'selected':'') .
                     ' value="' . $skin . '">' . $skin . "</option>\n";
            }
        }
    }

    function _buildLangList($select=null)
    {
        $l =& SB_Localizer::staticInstance();

        foreach ($l->getLanguages() as $lang)
        {
            $dir = $lang['dir'] . str_repeat("&nbsp;", 5-strlen($lang['dir']));

            echo '<option class="fixed" '. ($select==$lang['dir']?'selected':'') .
                 ' value="' . $lang['dir'] . '">' . $dir .  " " . $lang['language'] . "</option>\n";
        }
    }

    function _buildAutoLangList($select=null)
    {
        echo '<option class="fixed" '. ($select==null?'selected':'') .
             ' value="">' . SB_T('Auto detection') . "</option>\n";

        $this->_buildLangList($select);
    }

    function _buildUserList($select=null, $exclude=null)
    {
        foreach ($this->um->getUsers() as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            if ($uid == $exclude) continue;
            echo '<option '. ($select==$uid?'selected':'') .
                ' value="' . $uid . '">' . $rec['cryptmail'] .' - '. $rec['name']. "</option>\n";
        }
    }

    function _buildUserCheck($params)
    {
        $id = 'l_'.$params['name'];
        $attr = ' name="' .$params['name'].'" '.
            (isset($params['checked'])?' checked':'').
            (isset($params['disabled'])?' disabled':'');
?>
        <tr>
            <td class='check'>
                <input id="<?php echo $id?>" type='checkbox' value='1' <?php echo $attr?>>
            </td>
            <td colspan="2">
                <label for="<?php echo $id?>"><?php echo $params['email']?></label>
            </td>
        </tr>
        <tr>
            <td colspan="3"><label for="<?php echo $id?>">"<?php echo $params['realname']?>"</label></td>
        </tr>
<?php
        if (isset($params['signup']))
        {
?>
        <tr>
            <th colspan="2"><?php echo SB_T('First Visit') ?>:</th>
            <td> <?php echo $params['signup']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Last Visit') ?>:</th>
            <td> <?php echo $params['visited']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Visit Count') ?>:</th>
            <td> <?php echo $params['visits']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Link Count') ?>:</th>
            <td> <?php echo $params['links']?></td>
        </tr>
<?php
        }
    }

    function _buildGroupList($select=null)
    {
        $gregexp = null;

        if (SB_reqChk('gregexp'))
        {
            $gregexp = SB_reqVal('gregexp');
            if ($gregexp{0} != '/')
            {
                $gregexp = '/'.$gregexp.'/i';
            }
        }

        $groups = $this->um->getModeratedGroups($this->um->uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            if ($gregexp)
            {
                if (!preg_match($gregexp, $rec['long_name']))
                {
                    continue;
                }
            }

            if (!$this->um->isAdmin() && !in_array($gid, array_keys($groups))) continue;

            echo '<option '. ($select==$gid?'selected':'') .' value="' . $gid . '">' .
                $rec['long_name'] . "</option>\n";
        }
    }

    function _buildFolderOrder($params)
    {
?>
        <tr>
            <td>
                <input class="order" value="<?php echo $params['order']?>"
                    name="id<?php echo $params['id']?>" maxlength="5">
            </td>
            <td>
                <?php echo $params['name']?>
            </td>
        </tr>
<?php
    }

    function _buildFavicon($lid, $favicon)
    {
        $wrong = SB_Skin::imgsrc('link_wrong_favicon');
        $txt = '';

        $binary = (substr($favicon,0,7) == 'binary:');

        if ($this->um->getParam('config', 'use_favicon_cache'))
        {
            $link = $this->tree->getLink($lid);
            if ($link->favicon)
            {
                $cached = 'favicon.php?';

                if ($binary)
                {
                    $cached .= $favicon;
                }
                else
                {
                    $cached .= md5($favicon) . '=' . $lid . "&refresh=" . SB_StopWatch::getMicroTime();
                }

                $txt .= SB_T('Cached: ') . '<img alt="" class="favicon" src="'.$cached.'" onerror="this.src=\''.$wrong.'\'">';
                $txt .= '&nbsp;';
            }
        }

        if (!$binary)
        {
            $txt .= SB_T("Original: ") . '<img alt="" src="'.$favicon.'" onerror="this.src=\''.$wrong.'\'">';
        }

        return "<div>$txt</div>\n";
    }

    function _buildSendEmail($label=null, $checkRCPT=false)
    {
        $fields = array();
        $fields[$label?$label:'Message'] = array('name'=>'message', 'type'=>'textarea', 'rows'=>5);

        if ($checkRCPT)
        {
            $fields['-hidden000-'] = array('name'=>'checkrcpt', 'value'=>1);
            $fields['Respect Allow Info Mail'] =
                array('name'=>'respect', 'type'=>'checkbox', 'checked'=>1,
                'title'=>SB_P('command::tooltip_respect'));
            $fields['Only to Verified Emails'] =
                array('name'=>'verified', 'type'=>'checkbox', 'checked'=>1,
                'title'=>SB_P('command::tooltip_to_verified'));
        }

        return $fields;
    }

    function _commandSendEmail($to, $subject, $group=null)
    {
        // Prefetch to have it in our language
        $okStr    = SB_T('%s - ok.');
        $errorStr = SB_T('%s - error!');

        $message  = stripslashes(SB_reqVal('message'));

        foreach ($to as $uid => $user)
        {
            $userparams = $user['params'];
            $this->um->explodeParams($userparams, 'tmp');

            if (SB_reqVal('checkrcpt'))
            {
                if (SB_reqChk('respect') && !$this->um->getParam('tmp','allow_info_mails'))
                {
                    continue;
                }

                if (SB_reqChk('verified') && !$user['verified'])
                {
                    continue;
                }
            }

            SB_SetLanguage($this->um->getParam('tmp','lang'));

            $body = '';
            if ($group)
            {
                $body = SB_P('command::contact_group',array($group, $message, SB_Page::baseurl()));
            }
            else
            {
                $body = SB_P('command::contact',array($message, SB_Page::baseurl()));
            }

            if (!$this->checkEmailCorrectness($this->um->email))
            {
                continue;
            }

            $ret = $this->um->sendMail($user, SB_T($subject), $body, $this->um->name, $this->um->email);

            // No translation here
            if ($ret)
            {
                $this->warn('%s', sprintf($okStr, $user['cryptmail']));
            }
            else
            {
                $this->error('%s', sprintf($errorStr, $user['cryptmail']));
            }
        }

        SB_SetLanguage($this->um->getParam('user','lang'));
    }

    function checkCookie()
    {
        if (!isset($_COOKIE['SB3COOKIE']))
        {
            $this->error('You have to enable cookies in order to log-in or sign-up!');
            return false;
        }
        return true;
    }

    function checkEmailCorrectness($email)
    {
        if (!strstr($email,'@'))
        {
            $this->error('The e-mail %s does not look correctly!', $email);
            return false;
        }
        return true;
    }

    function writeForm()
    {
        $customButton = false;
        if ($this->useToolTips)
        {
?>
<div id='toolTip'></div>
<?php
        }
?>
<form method="post" enctype="multipart/form-data" action="<?php echo FORM_ACTION_EXECUTOR ?>">
    <input type="hidden" name="command" value="<?php echo $this->command?>">
<?php

        foreach ( $this->persistentParams as $param)
        {
            $value = SB_safeVal($_REQUEST, $param);
            if ($value)
            {
?>
        <input type="hidden" name="<?php echo $param?>" value="<?php echo $value?>">
<?php
            }
        }

        $enabled = false;
        foreach ($this->fields as $name => $params)
        {
            if (!is_array($params))
            {
                if (strpos($name,'-raw')===0)
                {
                    echo $params;
                }
                else
                {
?>
    <div class="label"><?php echo $params?></div>
<?php
                }
                continue;
            }

            if (!isset($params['type']))
            {
                $params['type'] = 'text';
            }

            $disabled = !$params || array_key_exists('disabled', $params);

            // Is at least one field enabled
            $enabled = ($name{0} != '-' && !$disabled) || $enabled;

            // If we have disabled field then keep the value that would
            // be otherwise lost. Needed to go back.
            if ($disabled && $params['type'] == 'text')
            {
?>
    <input type="hidden" name="<?php echo SB_safeVal($params,'name') ?>" value="<?php echo $params['value']?>">
<?php
                $params['name'] = ''; // Don't use name with disabled fields.
            }

            if ($name{0} == '-')
            {
?>
    <input type="hidden" name="<?php echo $params['name']?>" value="<?php echo $params['value']?>">
<?php
            }
            elseif (isset($params['type']) &&  ($params['type'] == 'checkbox' || $params['type'] == 'radio'))
            {
                $id = 'l_'.(isset($params['name'])?$params['name']:'_noname');
                $params['id'] = $id;
                if (!isset($params['value']))
                {
                    $params['value'] = 1;
                }
?>
    <div class="check" <?php echo $this->getToolTip($params)?>>
        <input <?php echo $this->getFieldParams($params)?>>
        <label for="<?php echo $id?>"><?php echo isset($params['_raw'])?$name:SB_T($name)?></label>
    </div>
<?php
            }
            elseif (isset($params['type']) && $params['type'] == 'select')
            {
                unset($params['type']);
?>
    <div class="label"><?php echo SB_T($name)?></div>
    <div class="data">
        <select <?php echo $this->getFieldParams($params)?>>
<?php
            $this->$params['_options'](
                isset($params['_select'])?$params['_select']:null,
                isset($params['_exclude'])?$params['_exclude']:null
                );
?>
        </select>
    </div>
<?php
            }
            elseif (isset($params['type']) &&  $params['type'] == 'callback')
            {
?>
                <div class="label"><?php echo SB_T($name)?></div>
<?php
                $this->$params['function'](isset($params['params'])?$params['params']:null);
            }
            elseif (isset($params['type']) &&  $params['type'] == 'callbackextern')
            {
                $params['function'](isset($params['params'])?$params['params']:null);
            }
            elseif (isset($params['type']) &&  ($params['type'] == 'button') || ($params['type'] == 'addbutton'))
            {
                if (!$this->um->isAuthorized($name,false,null,SB_reqVal('nid_acl'),SB_reqVal('lid_acl'))) continue;

                if ($params['type'] == 'button')
                {
                    $customButton = true;
                }

                $params['name'] = 'command['.$name.']';
?>
    <div>
        <input class="button customButton" type="submit" name="<?php echo $params['name']?>" value="<?php echo SB_T($name)?>">
    </div>
<?php
            }
            elseif (isset($params['type']) &&  $params['type'] == 'textarea')
            {
                unset($params['type']);
?>
    <div class="label"><?php echo SB_T($name)?></div>
    <div class="data">
        <textarea <?php echo $this->getFieldParams($params)?>><?php echo isset($params['value'])?$params['value']:''?></textarea>
    </div>
<?php
            }
            else
            {
?>
    <div class="label"><?php echo SB_T($name)?></div>
    <div class="data">
        <input <?php echo $this->getFieldParams($params)?>>
        <input type="hidden" name="label_<?php echo $params['name']?>" value="<?php echo $name?>">
    </div>
<?php
            }
        }

        if (!$customButton)
        {
?>
    <div class="buttons">
        <input class="button" type="submit" name="do" value="<?php echo SB_T('Submit')?>">
<?php
            if ($enabled) :
?>
        <input class="button" type="reset" value="<?php echo SB_T('Reset')?>">
<?php
            endif;
?>
    </div>
<?php
        }
?>
</form>
<?php
    }

    function checkMandatoryFields($fields)
    {
        $ok = true;

        foreach ($fields as $field)
        {
            if (!SB_reqVal($field))
            {
                $this->error('Field %s must be filled!', array(SB_T(SB_reqVal('label_'.$field))));
                $ok = false;
            }
        }

        return $ok;
    }

/******************************************************************************/

    function _buildIntegSelector($select=null)
    {
        $integs = array
        (
            'Keep Current URL' => '',
            'Local Installation' => 'integrator.php',
            'my.sitebar.org [Stable]' => 'http://my.sitebar.org/integrator.php',
            'beta.sitebar.org [CVS]' => 'http://beta.sitebar.org/integrator.php',
        );

        foreach ($integs as $label => $url)
        {
            echo '<option value="' . $url . '">' . SB_T($label) . "</option>\n";
        }
    }

    function buildSiteBarSettings()
    {
        $fields = array();

        if (count($this->_getAuthMethod()))
        {
            $fields['Authentication Method'] = array('name'=>'auth','type'=>'select',
                '_options'=>'_buildAuthList', '_select'=>$this->um->getParam('config','auth'));
        }

        $fields['Base URL'] = array('name'=>'baseurl',
            'value'=>$this->um->getParamB64('config','baseurl'),
            'title'=>SB_P('command::tooltip_baseurl'));
        $fields['Default Domain'] = array('name'=>'default_domain',
            'value'=>$this->um->getParam('config','default_domain'),
            'title'=>SB_P('command::tooltip_default_domain'));
        $fields['Filter Users When More Than'] = array('name'=>'filter_users_limit',
            'value'=>$this->um->getParam('config','filter_users_limit'));
        $fields['Filter Groups When More Than'] = array('name'=>'filter_groups_limit',
            'value'=>$this->um->getParam('config','filter_groups_limit'));
        $fields['Integrator URL Selector'] = array('type'=>'select',
                'onchange'=>'if (this.value.length) this.form.integrator_url.value = this.value',
                '_options'=>'_buildIntegSelector', '_select'=>0);
        $fields['Integrator URL'] = array('name'=>'integrator_url',
            'value'=>$this->um->getParamB64('config','integrator_url'));
        $fields['Link Description Length'] = array('name'=>'comment_limit',
            'value'=>$this->um->getParam('config','comment_limit'));
        $fields['Maximum Session Time (sec)'] = array('name'=>'max_session_time',
            'value'=>$this->um->getParam('config','max_session_time'));
        $fields['Sender E-mail'] = array('name'=>'sender_email',
            'value'=>$this->um->getParam('config','sender_email'));
        $fields['Web Search Engine URL'] = array('name'=>'search_engine_url',
            'value'=>$this->um->getParamB64('config','search_engine_url'));
        $fields['Web Search Engine Icon'] = array('name'=>'search_engine_ico',
            'value'=>$this->um->getParamB64('config','search_engine_ico'));

        $fields['Allow Anonymous Contact'] = array('name'=>'allow_contact', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_contact'),
            'title'=>SB_P('command::tooltip_allow_contact'));
        $fields['Allow Custom Web Search Engine'] = array('name'=>'allow_custom_search_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_custom_search_engine'),
            'title'=>SB_P('command::tooltip_allow_custom_search_engine'));
        $fields['Allow Sign Up'] = array('name'=>'allow_sign_up', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_sign_up'),
            'title'=>SB_P('command::tooltip_allow_sign_up'));

        $fields['Description Import/Export'] = array('name'=>'comment_impex', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','comment_impex'),
            'title'=>SB_P('command::tooltip_comment_impex'));

        $fields['Personal Mode'] = array('name'=>'personal_mode', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','personal_mode'),
            'title'=>SB_P('command::tooltip_personal_mode'));
        $fields['Users Can Create Trees'] = array('name'=>'allow_user_trees', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_trees'),
            'title'=>SB_P('command::tooltip_allow_user_trees'));
        $fields['Users Can Delete Trees'] = array('name'=>'allow_user_tree_deletion', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_tree_deletion'),
            'title'=>SB_P('command::tooltip_allow_user_tree_deletion'));
        $fields['Users Can Create Groups'] = array('name'=>'allow_user_groups', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_groups'),
            'title'=>SB_P('command::tooltip_allow_user_groups'));
        $fields['Use Conversion Engine'] = array('name'=>'use_conv_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_conv_engine'),
            'title'=>SB_P('command::tooltip_use_conv_engine'));
        $fields['Use Compression'] = array('name'=>'use_compression', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_compression'),
            'title'=>SB_P('command::tooltip_use_compression'));
        $fields['Use E-mail Features'] = array('name'=>'use_mail_features', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_mail_features'),
            'title'=>SB_P('command::tooltip_use_mail_features'));
        $fields['Use Outbound Connection'] = array('name'=>'use_outbound_connection', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_outbound_connection'),
            'title'=>SB_P('command::tooltip_use_outbound_connection'));
        $fields['Use Hit Counter'] = array('name'=>'use_hit_counter', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_hit_counter'),
            'title'=>SB_P('command::tooltip_hits'));
        $fields['Users Must Be Approved'] = array('name'=>'users_must_be_approved', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','users_must_be_approved'),
            'title'=>SB_P('command::tooltip_users_must_be_approved'));
        $fields['Users Must Verify E-mail'] = array('name'=>'users_must_verify_email', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','users_must_verify_email'),
            'title'=>SB_P('command::tooltip_users_must_verify_email'));
        $fields['Show Logo'] = array('name'=>'show_logo', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','show_logo'),
            'title'=>SB_P('command::tooltip_show_logo'));
        $fields['Show Statistics'] = array('name'=>'show_statistics', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','show_statistics'),
            'title'=>SB_P('command::tooltip_show_statistics'));

        $fields['Default User Settings'] = array('type'=>'addbutton');
        $fields['Favicon Management'] = array('type'=>'addbutton');
        $fields['Export Bookmarks Settings'] = array('type'=>'addbutton');

        return $fields;
    }

    function checkSiteBarSettings()
    {
        if (strstr(SB_reqVal('default_domain'),'@'))
        {
            $this->error('Default domain should not contain @ sign!');
        }
    }

    function commandSiteBarSettings()
    {
        $checks = array
        (
            'allow_contact',
            'allow_sign_up',
            'allow_custom_search_engine',
            'allow_user_trees',
            'allow_user_tree_deletion',
            'allow_user_groups',
            'comment_impex',
            'personal_mode',
            'show_logo',
            'show_statistics',
            'use_compression',
            'use_conv_engine',
            'use_hit_counter',
            'use_mail_features',
            'use_outbound_connection',
            'users_must_be_approved',
            'users_must_verify_email',
        );

        $values = array
        (
            'auth',
            'comment_limit',
            'default_domain',
            'filter_users_limit',
            'filter_groups_limit',
            'max_session_time',
            'sender_email',
        );

        $this->checkSiteBarSettings();

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $valuesB64 = array
        (
            'baseurl',
            'integrator_url',
            'search_engine_url',
            'search_engine_ico',
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('config', $check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $value)
        {
            $this->um->setParam('config', $value, SB_reqVal($value));
        }
        foreach ($valuesB64 as $check)
        {
            $this->um->setParamB64('config', $check, SB_reqVal($check));
        }

        $this->um->saveConfiguration();
    }

/******************************************************************************/

    function buildExportBookmarksSettings()
    {
        $fields = array();

        $values = array();

        require_once('./inc/writer.inc.php');

        foreach (SB_WriterInterface::settingItems() as $name)
        {
            $values[$name] = SB_WriterInterface::settingsValue($name);
        }

        $fields['Title for Root'] = array('name'=>'feed_root_name', 'value'=>$values['feed_root_name'],);
        $fields['Title Format for Selected Folder'] = array('name'=>'feed_folder_title', 'value'=>$values['feed_folder_title'],);
        $fields['Link'] = array('name'=>'feed_link', 'value'=>$values['feed_link'],);
        $fields['Description'] = array('name'=>'feed_desc', 'value'=>$values['feed_desc'],);
        $fields['Copyright'] = array('name'=>'feed_copyright', 'value'=>$values['feed_copyright'],);
        $fields['Webmaster Email'] = array('name'=>'feed_webmaster', 'value'=>$values['feed_webmaster'],);
        $fields['Managing Editor'] = array('name'=>'feed_managing_editor', 'value'=>$values['feed_managing_editor'],);

        $fields['Allow Anonymous Exports'] = array('name'=>'allow_anonymous_export', 'type'=>'checkbox',
            'value'=>1,
            'checked'=>$this->um->getParamCheck('config','allow_anonymous_export'),
            'title'=>SB_P('command::tooltip_allow_anonymous_export'));

        // Never external
        $this->um->setParam('user','extern_commander',0);

        return $fields;
    }

    function commandExportBookmarksSettings()
    {
        $checks = array
        (
            'allow_anonymous_export',
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('config',$check, SB_reqVal($check));
        }

        require_once('./inc/writer.inc.php');

        foreach (SB_WriterInterface::settingItems() as $name)
        {
            $this->um->setParamB64('config',$name, SB_reqVal($name));
        }

        $this->um->saveConfiguration();
        $this->forwardCommand('SiteBar Settings');
    }

/******************************************************************************/

    function buildFaviconManagement()
    {
        $fields = array();

        $fields['Use the Favicon Cache'] = array('name'=>'use_favicon_cache', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_favicon_cache'),
            'title'=>SB_P('command::tooltip_use_favicon_cache'));
        $fields['Maximal Icons Total'] = array('name'=>'max_icon_cache',
            'value'=>$this->um->getParam('config','max_icon_cache'),
            'title'=>SB_P('command::tooltip_max_icon_cache'));
        $fields['Maximal Icon Size'] = array('name'=>'max_icon_size',
            'value'=>$this->um->getParam('config','max_icon_size'),
            'title'=>SB_P('command::tooltip_max_icon_size'));
        $fields['Maximal Icon Age'] = array('name'=>'max_icon_age',
            'value'=>$this->um->getParam('config','max_icon_age'),
            'title'=>SB_P('command::tooltip_max_icon_age'));

        $fields['Purge Cache'] = array('type'=>'addbutton');
        $fields['Show All Icons'] = array('type'=>'addbutton');

        return $fields;
    }

    function commandFaviconManagement()
    {
        $values = array
        (
            'max_icon_cache',
            'max_icon_size',
            'max_icon_age',
        );

        foreach ($values as $value)
        {
            $this->um->setParam('config',$value, SB_reqVal($value));
        }

        $this->um->setParam('config','use_favicon_cache', SB_reqVal('use_favicon_cache'));

        $this->um->saveConfiguration();

    }

    function buildPurgeCache()
    {
        $fields = array();

        $fields['-raw1-'] = SB_P('command::purge_cache');

        return $fields;
    }

    function commandPurgeCache()
    {
        require_once('./inc/faviconcache.inc.php');
        $fc = & SB_FaviconCache::staticInstance();
        $fc->purge();
    }

    function buildShowAllIcons()
    {
        $fields = array();

        $carpet = '';

        require_once('./inc/faviconcache.inc.php');

        $fc = & SB_FaviconCache::staticInstance();

        $cacheItems = $fc->faviconGetAll();

        foreach ($cacheItems as $item)
        {
            $favicon = 'favicon.php?' . $item['ckey'];

            $carpet .= '<img class="favicon" alt="" src="'.$favicon.'">'."\n";
        }

        $fields['-raw1-'] = $carpet;

        return $fields;
    }

/******************************************************************************/

    function _buildTreeList()
    {
        foreach ($this->tree->loadRoots(true, true) as $root)
        {
            $own = ($root->myTree == SB_TREE_OWN? "+ " : "- ");
            echo '<option value="' . $root->id . '">'. $own . $root->name . "</option>\n";
        }
    }

    function buildMaintainTrees()
    {
        $fields = array();
        $fields['Create Tree'] = array('type'=>'button');
        $fields['Unhide Trees'] = array('type'=>'button');
        $fields['Order of Trees'] = array('type'=>'button');
        $fields['Export Bookmarks'] = array('type'=>'button');

        $fields['-hidden1-'] = array('name'=>'doall', 'value'=>1);

        if ($this->um->getParam('config','allow_user_tree_deletion') || $this->um->isAdmin())
        {
            $fields['Select Tree'] = array('name'=>'nid_acl','type'=>'select', '_options'=>'_buildTreeList');
            $fields['Delete Tree'] = array('type'=>'button');
        }

        // Dirty, to allow forward back
        $_REQUEST['nid_acl'] = null;

        return $fields;
    }

    function buildCreateTree()
    {
        $fields = array();
        if ($this->um->isAdmin())
        {
            $fields['Owner'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList','_select'=>$this->um->uid);
        }
        $fields['Tree Name'] = array('name'=>'treename');
        $fields['Description'] = array('name'=>'comment');
        return $fields;
    }

    function commandCreateTree()
    {
        $this->checkMandatoryFields(array('treename'));
        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $uid = SB_reqVal('uid');

        if (!$this->um->isAdmin())
        {
            $uid = $this->um->uid;
        }

        $this->tree->addRoot($uid, SB_reqVal('treename'), SB_reqVal('comment'));

        $this->forwardCommand('Maintain Trees');
    }

    function buildUnhideTrees()
    {
        $fields['-raw1-'] = "<table cellpadding='0'>";
        $count = 0;

        foreach ($this->tree->loadRoots(true) as $root)
        {
            if ($root->hidden)
            {
                $fields[$root->name] = array('name'=>'nid_'.$root->id,'type'=>'checkbox');
                $count++;
            }
        }

        if (!$count)
        {
            $this->warn('There are no hidden trees!');
        }

        $fields['-raw2-'] = "</table>";

        return $fields;
    }

    function commandUnhideTrees()
    {
        foreach ($this->tree->loadRoots(true) as $root)
        {
            if ($root->hidden && SB_reqVal('nid_'.$root->id))
            {
                unset($this->um->hiddenFolders[$root->id]);
            }
        }

        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();

        $this->forwardCommand('Maintain Trees');
    }

    function buildOrderOfTrees()
    {
        $fields['-raw1-'] = "<table cellpadding='0'>";

        foreach ($this->tree->loadRoots() as $root)
        {
            $label = $root->name;
            $fields[$label] = array
            (
                'type'=>'callback',
                'function'=>'_buildFolderOrder',
                'params'=>array('name'=>$root->name,'id'=>$root->id,'order'=>$root->order),
            );
        }

        $fields['-raw2-'] = "</table>";

        return $fields;
    }

    function commandOrderOfTrees()
    {
        $order = array();

        foreach ($this->tree->loadRoots() as $root)
        {
            $order[] = $root->id.'~'.intval(SB_reqVal('id'.$root->id));
        }

        $this->um->setParam('user', 'root_order', implode(':',$order));
        $this->um->saveUserParams();
        $this->forwardCommand('Maintain Trees');
    }

    function buildDeleteTree()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));
        if (!$node) return null;

        $fields['Folder Name'] = array('name'=>'name','value'=>$node->name, 'disabled'=>null);
        $fields['Description'] = array('name'=>'comment', 'type'=>'textarea',
            'value'=>$node->comment, 'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        return $fields;
    }

    function commandDeleteTree()
    {
        $this->tree->removeNode(SB_reqVal('nid_acl'), false);
        if ($this->um->getParam('user','use_trash'))
        {
            $this->tree->purgeNode(SB_reqVal('nid_acl'));
        }
        SB_unsetVal('nid_acl');
        $this->forwardCommand('Maintain Trees');
    }

/******************************************************************************/

    function buildSetUp()
    {
        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');
        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildAutoLangList', '_select'=>$lang);

        $fields['E-mail'] = array('name'=>'email');
        $fields['Admin Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Admin Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['Real Name'] = array('name'=>'realname');

        return array_merge($fields, $this->buildSiteBarSettings());
    }

    function commandSetUp()
    {
        SB_SetLanguage(SB_reqVal('lang'));

        if (SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        $this->checkMandatoryFields(array('pass','realname','email'));
        $this->checkSiteBarSettings();

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        if ($this->um->setUp(SB_reqVal('email'),SB_reqVal('pass'),SB_reqVal('realname')))
        {
            $this->um->setParam('user','lang', SB_reqVal('lang'));
            $this->um->saveUserParams();
            $this->commandSiteBarSettings();

            $this->reload = true;
            $this->close = false;
            $this->message = SB_P('command::welcome',array(SB_reqVal('realname'),''));
        }
    }

/******************************************************************************/

    function buildLogIn()
    {
        $fields = array();
        $fields['E-mail'] = array('name'=>'email');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Remember Me'] = array('name'=>'expires','type'=>'select',
            '_options'=>'_buildExpirationList');

        if (SB_reqChk('forward'))
        {
            $fields['--hidden1--'] = array('name'=>'forward','value'=>SB_reqVal('forward'));
        }

        if ($this->showWithErrors)
        {
            $fields['Reset Password'] = array('type'=>'addbutton');
        }

        return $fields;
    }

    function _buildExpirationList()
    {
        $expiration = array
        (
            'Until I close browser' =>0,
            '12 hours' =>60*60*12,
            '6 days'   =>60*60*24*6,
            '1 month'  =>60*60*24*30,
            'Maximum session time' => $this->um->getParam('config','max_session_time'),
        );

        foreach ($expiration as $label => $value)
        {
            if ($value > $this->um->getParam('config','max_session_time'))
            {
                break;
            }

            echo '<option value="' . $value. '">' . SB_T($label). "</option>\n";
        }
    }

    function commandLogIn()
    {
        if (!$this->checkCookie())
        {
            $this->goBack();
            return;
        }

        $this->checkMandatoryFields(array('email','pass'));
        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $expires = min(SB_reqVal('expires'),$this->um->getParam('config','max_session_time'));

        if (!$this->um->login(SB_reqVal('email'), SB_reqVal('pass'), $expires))
        {
            $this->goBack();
            return;
        }

        if (SB_reqChk('forward'))
        {
            header('Location: '.SB_reqVal('forward'));
            exit;
        }

        if (SB_reqChk('bookmarklet'))
        {
            $this->command = 'Add Link';
            $this->fields = $this->buildAddLink();
        }
        else
        {
            $this->reload = true;
            $this->close = true;
        }
    }

    function commandLogOut()
    {
        $this->um->logout();
        $this->reload = true;
        $this->close = true;
    }

/******************************************************************************/

    function buildHelp()
    {
        $fields = array();
        $topics = SB_GetHelpTopics();

        $fields['Help Topic'] = array('class'=>'help', 'name'=>'topic','type'=>'select',
            'size'=> (SB_reqChk('topic')?1:count($topics)),
            '_options'=>'_buildHelpTopicList', '_select'=>SB_reqVal('topic'));
        $fields['Display Topic'] = array('type'=>'button','value'=>'Help');

        if (SB_reqChk('topic'))
        {
            $fields['-raw1-'] = '<h3>' . $topics[SB_reqVal('topic')] . '</h3>';
            $fields['Topic'] = array('type'=>'callbackextern',
                'function'=>'SB_GetHelp', 'params'=>array('topic'=>SB_reqVal('topic')));
        }
        return $fields;
    }

    function buildDisplayTopic()
    {
        $this->command = 'Help';
        return $this->buildHelp();
    }

    function _buildHelpTopicList($select=null)
    {
        foreach (SB_GetHelpTopics() as $value => $label)
        {
            if (intval($value) % 100)
            {
                $label = '&nbsp;-&nbsp;' . $label;
            }

            echo '<option '.($select==$value?'selected':'').
                 ' value="' . $value. '">' . $label. "</option>\n";
        }
    }

/******************************************************************************/

    function buildContactAdmin()
    {
        $fields = array();
        if ($this->um->isAnonymous())
        {
            $fields['Your E-mail'] = array('name'=>'email');
        }
        return array_merge($fields,$this->_buildSendEmail('Feedback or Other Comment'));
    }

    function commandContactAdmin()
    {
        $name = $this->um->name;
        $email = $this->um->email;

        if (SB_reqChk('email'))
        {
            if (SB_reqVal('email'))
            {
                $email = SB_reqVal('email');
                $name  = SB_T('Guest') . ' ['.$email.']';
            }
            else
            {
                $name  = SB_T('Anonymous Guest');
                $email = 'noname@no.where';
            }
        }

        $comment = SB_reqVal('message');

        if (!$comment)
        {
            return;
        }

        $this->um->mailToAdmins(
            'SiteBar: Contact Admin',
            'command::contact',
            array($comment,SB_Page::baseurl()),
            $name, $email);
    }

/******************************************************************************/

    function buildSignUp()
    {
        $fields = array();

        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$lang);

        $defDom = $this->um->getParam('config', 'default_domain');
        if ($defDom)
        {
            $defDom = '@' . $defDom;
        }

        $fields['E-mail'] = array('name'=>'email', 'value'=>$defDom);

        if ($this->command == 'Sign Up' && $this->um->getParam('config','use_mail_features'))
        {
            $fields['Verify E-mail'] = array
            (
                'name'=>'verify_email',
                'type'=>'checkbox',
                'checked'=>1,
            );

            if ($this->um->getParam('config','users_must_verify_email'))
            {
                $fields['Verify E-mail']['disabled'] = null;
            }
        }

        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['Real Name'] = array('name'=>'realname');
        $fields['Comment'] = array('name'=>'comment');
        return $fields;
    }

    function commandSignUp($autoLogin = true)
    {
        SB_SetLanguage(SB_reqVal('lang'));

        if (!$this->checkCookie())
        {
            $this->goBack();
            return;
        }

        if (SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if (!$this->checkMandatoryFields(array('email','pass','realname')))
        {
            $this->goBack();
        }

        $mustVerify = $this->um->getParam('config','users_must_verify_email');

        if ($this->um->getParam('config','use_mail_features') && ( SB_reqChk('verify_email') || $mustVerify))
        {
            $this->checkEmailCorrectness(SB_reqVal('email'));
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $uid = $this->um->signUp(
            SB_reqVal('email'),
            SB_reqVal('pass'),
            SB_reqVal('realname'),
            SB_reqVal('comment'),
            !$autoLogin,
            SB_reqVal('verified'),
            SB_reqVal('demo'),
            SB_reqVal('lang'));

        if ($uid)
        {
            $this->tree->addRoot($uid, SB_T('%s&#39;s Bookmarks', SB_reqVal('realname')));

            if ($this->um->getParam('config','use_mail_features') && ( SB_reqChk('verify_email') || $mustVerify))
            {
                if (!$this->_sendVerificationEmail($uid, array('email'=>SB_reqVal('email')), $mustVerify))
                {
                    $this->error('Cannot send verification email!');
                }
            }

            if ($autoLogin)
            {
                $mustApprove = $this->um->getParam('config','users_must_be_approved');

                $this->um->login(SB_reqVal('email'), SB_reqVal('pass'));
                $this->reload = true;
                $this->close = false;

                $params = array(SB_reqVal('realname'));

                if ($mustVerify || $mustApprove)
                {
                    $params[] = SB_P('command::signup' . ($mustVerify?'_verify':'') . ($mustApprove?'_approve':''));
                }
                else
                {
                    $params[] = '';
                }

                $this->message = SB_P('command::welcome',$params);
            }
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }
    }

/******************************************************************************/

    function _sendVerificationEmail($uid, $user, $mustVerify=false)
    {
        $subject = SB_T('SiteBar: Email Verification');
        $msg = SB_P(($mustVerify? 'command::verify_email_must':'command::verify_email'),
            array($this->um->getVerificationUrl($uid)));
        // Verify email
        return $this->um->sendMail($user, $subject, $msg);
    }

    function buildVerifyEmail()
    {
        $this->_sendVerificationEmail($this->um->uid, $this->um->user);
        $this->warn('Verification e-mail has been sent to your e-mail address!');
        return array();
    }

    function commandEmailVerified()
    {
        $this->nobuttons = true;
        $this->reload = false;
        $this->close = false;

        $this->message =
            SB_T('E-mail %s verified! Any pending memberships were approved.',
            array(SB_reqVal('email')));

        $user = $this->um->getUserByEmail('email');

        if ($this->um->getParam('config', 'users_must_be_approved') && !$user['approved'])
        {
            $this->message .= '<p>' . SB_T('Your account will be activated as soon as one of the administrators approves it.');
        }
    }

    function commandInvalidToken()
    {
        $this->nobuttons = true;
        $this->reload = false;
        $this->close = false;
        $this->message = SB_T('Invalid or expired token received! All pending tokens were deleted.');
    }

    function buildResetPassword()
    {
        $email = SB_reqVal('email');
        $fields = array();
        $fields['E-mail'] = array('name'=>'email', 'value'=>$email);
        $fields['-raw1-'] = SB_T('A token will be sent to this email address.');
        return $fields;
    }

    function commandResetPassword()
    {
        $email = SB_reqVal('email');
        $user = $this->um->getUserByEmail($email);
        if ($user==null)
        {
            $this->error('User with email "%s" does not exist!', $email);
            return;
        }

        if ($user->demo)
        {
            $this->um->accessDenied();
            return;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();

        $subject = SB_T('SiteBar: Reset Password');
        $msg = SB_P('command::reset_password', array
        (
            $email,
            $token->createResetToken($user['uid']),
            SB_Page::baseurl(),
        ));
        $this->um->sendMail($user, $subject, $msg);

        $this->reload = false;
        $this->close = false;
    }

    function buildNewPassword()
    {
        $user = $this->um->getUser(SB_reqVal('uid', true));

        $fields = array();

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>$user['uid']);
        $fields['-hidden2-'] = array('name'=>'token', 'value'=>SB_reqVal('token', true),'disabled'=>null);

        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'],'disabled'=>null);
        $fields['Real Name'] = array('name'=>'realname','value'=>$user['name'],'disabled'=>null);
        $fields['Password'] = array('name'=>'pass1','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass2','type'=>'password');

        return $fields;
    }

    function commandNewPassword()
    {
        $this->checkMandatoryFields(array('pass1', 'pass2'));

        if (SB_reqVal('pass1') != SB_reqVal('pass2'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();

        $uid = SB_reqVal('uid', true);

        if ($token->validate($uid, SB_reqVal('token', true)))
        {
            $token->invalidateTokens($uid);
            $this->um->changePassword($uid, SB_reqVal('pass1'));
            $this->reload = false;
            $this->close = false;
            $this->message = SB_T('Password has been changed!');
        }
        else
        {
            $this->commandInvalidToken();
        }
    }

/******************************************************************************/

    function matchesUserFilter(&$userRec)
    {
        static $uregexp = null;

        if ($uregexp === null)
        {
            if (strlen(SB_reqVal('uregexp')))
            {
                $uregexp = SB_reqVal('uregexp');
                if ($uregexp{0} != '/')
                {
                    $uregexp = '/'.$uregexp.'/i';
                }
            }
            else
            {
                $uregexp = '';
            }
        }

        if (strlen($uregexp))
        {
            $fullname = $userRec['name'] . ' <' . $userRec['email'] . '>';
            if (!preg_match($uregexp, $fullname))
            {
                return false;
            }
        }

        return true;
    }

    function buildFilterUsers()
    {
        $command = SB_reqVal('forward', true);
        if (!$this->um->isAuthorized($command))
        {
            $this->um->accessDenied();
        }

        $this->command = $command;
        $this->skipBuild = false;
        $this->handleCommandBuild();
        $this->skipBuild = true;
    }

    function buildMaintainUsers()
    {
        $fields = array();

        if ($this->um->useUserFilter() && !SB_reqChk('uregexp'))
        {
            $fields['Filter User RegExp'] = array('name'=>'uregexp');
            $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Maintain Users');
            $fields['Filter Users'] = array('type'=>'button');
        }

        $fields['Pending Users'] = array('type'=>'button');
        $fields['Pending Verified Users'] = array('type'=>'button');
        $fields['Pending Unverified Users'] = array('type'=>'button');
        $fields['Activity Period'] = array('name'=>'aperiod','value'=>30);
        $fields['Active Users'] = array('type'=>'button');
        $fields['Most Active Users'] = array('type'=>'button');
        $fields['Inactive Users'] = array('type'=>'button');
        $fields['Create User'] = array('type'=>'button');
        $fields['Send Email to All'] = array('type'=>'button');

        if (!$this->um->useUserFilter() || SB_reqChk('uregexp'))
        {
            $fields['Select User'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList');
            $fields['Modify User'] = array('type'=>'button');
            $fields['Delete User'] = array('type'=>'button');
            $fields['Send Email to User'] = array('type'=>'button');
        }
        return $fields;
    }

    function buildPendingUsers($verified = -1)
    {
        $fields = array();
        $members = $this->um->getPending($verified);

        if (!count($members))
        {
            $this->warn("No users are pending!");
            return;
        }

        $fields['-hidden1-'] = array('name'=>'verified', 'value'=> $verified);
        $fields['Approve All Users'] = array('type'=>'button');
        $fields['Reject All Users'] = array('type'=>'button');

        $fields['-raw1-'] = "<table class='users'>";

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $label = $rec['email'];
            $fields[$label] = array
            (
                'name'=>$uid,
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array('name'=>$uid,'email'=>$rec['cryptmail'],'realname'=>$rec['name']),
            );
        }

        $fields['-raw2-'] = "</table>";

        $fields['Approve Users'] = array('type'=>'button');
        $fields['Reject Users'] = array('type'=>'button');

        return $fields;
    }

    function buildPendingVerifiedUsers()
    {
        return $this->buildPendingUsers(1);
    }

    function buildPendingUnverifiedUsers()
    {
        return $this->buildPendingUsers(0);
    }

    function _buildPendingUsers($approve, $all, $email=null)
    {
        $members = array();

        if ($email!=null)
        {
            $user = $this->um->getUserByEmail($email);

            if ($user==null)
            {
                $this->warn('User with email "%s" has already been rejected!', $email);
                return;
            }

            $members = array($user['uid']=>$user);
        }
        else
        {
            $members = $this->um->getPending(SB_reqVal('verified'));
        }

        foreach ($members as $uid => $rec)
        {
            if (!$all && !SB_reqChk($uid))
            {
                continue;
            }

            $subject = '';
            $body = '';

            $user = $this->um->getUser($uid);

            if ($user==null)
            {
                $this->warn('User with uid %d has already been rejected!', $uid);
                continue;
            }

            $this->um->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->um->getParam('tmp','lang'));

            if (isset($user['approved']) && $user['approved'])
            {
                $this->warn('User "%s" <%s> has already been approved!',
                    array($user['name'], $user['email']));
                continue;
            }

            if ($approve)
            {
                if ($this->um->getParam('config','users_must_verify_email')
                &&  (!isset($user['verified']) || !$user['verified']))
                {
                    $this->warn('User "%s" did not verify own email "%s" yet, he cannot be approved!',
                        array($user['name'], $user['email']));
                    continue;
                }

                $subject = 'SiteBar: Account Request Approved';
                $body = 'command::account_approved';
                $this->um->modifyUser($uid, null, array( 'approved'=>1 ));

                $this->warn('User "%s" <%s> approved.',
                    array($user['name'], $user['email']));
            }
            else
            {
                $subject = 'SiteBar: Account Request Rejected';
                $body = 'command::account_rejected';
                $this->um->removeUser($uid);
                $this->tree->deleteUsersTrees($uid);
            }

            if ($this->um->getParam('config', 'use_mail_features'))
            {
                // No email on unverified users
                if ($approve || (isset($user['verified']) && $user['verified']))
                {
                    $this->um->sendMail($user, SB_T($subject),
                        SB_P($body, array($user['email'], SB_Page::baseurl())));
                }
            }
        }

        SB_SetLanguage($this->um->getParam('user','lang'));

        if (!$this->hasErrors())
        {
            $this->error('No action taken!');
        }

        $this->skipBuild = true;
        return array();
    }

    function buildApproveAllUsers()
    {
        return $this->_buildPendingUsers(true,true);
    }
    function buildApproveUser()
    {
        return $this->_buildPendingUsers(true,true,SB_reqVal('email',true));
    }
    function buildApproveUsers()
    {
        return $this->_buildPendingUsers(true,false);
    }
    function buildRejectAllUsers()
    {
        return $this->_buildPendingUsers(false,true);
    }
    function buildRejectUser()
    {
        return $this->_buildPendingUsers(true,true,SB_reqVal('email',true));
    }
    function buildRejectUsers()
    {
        return $this->_buildPendingUsers(false,false);
    }

    function _buildUserActivity(&$fields, &$members)
    {
        $fields['User Count'] = array('name'=>'usercount', 'disabled'=>null, 'value'=>0);
        $fields['-hidden1-'] = array('name'=>'aperiod', 'value'=>SB_reqVal('aperiod'));
        $fields['-raw1-'] = "<table class='users'>";

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $fields['User Count']['value']++;
            $label = $rec['email'];
            $fields[$label] = array
            (
                'name'=>$uid,
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array
                (
                    'name'=>$uid,
                    'email'=>$rec['cryptmail'],
                    'realname'=>$rec['name'],
                    'signup'=>$this->um->firstSession($uid),
                    'visited'=>$rec['visited'],
                    'visits'=>$rec['visits'],
                    'links' =>$this->tree->getLinkCount($uid),
                ),
            );
        }

        $fields['-raw2-'] = "</table>";
    }

    function buildInactiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'<','visited ASC');

        if (!count($members))
        {
            $this->warn("No users are inactive!");
            return;
        }

        $fields['Delete All Inactive Users'] = array('type'=>'button');
        $this->_buildUserActivity($fields, $members);
        $fields['Delete Inactive Users'] = array('type'=>'button');

        return $fields;
    }

    function buildMostActiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'>','visits DESC');
        $this->_buildUserActivity($fields, $members);
        return $fields;
        return $this->buildActiveUsers();
    }

    function buildActiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'>','visited DESC');
        $this->_buildUserActivity($fields, $members);
        return $fields;
    }

    function _buildDeleteInactiveUsers($all)
    {
        $members = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'<=','visits DESC');

        foreach ($members as $uid => $rec)
        {
            if (!$all && !SB_reqChk($uid))
            {
                continue;
            }

            $subject = '';
            $body = '';

            $user = $this->um->getUser($uid);
            $this->um->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->um->getParam('tmp','lang'));

            $subject = 'SiteBar: Inactive Account Deleted';
            $body = 'command::account_deleted';
            $this->um->removeUser($uid);
            $this->tree->deleteUsersTrees($uid);

            if ($this->um->getParam('config', 'use_mail_features'))
            {
                // No email on unverified users
                if (isset($user['verified']) && $user['verified'])
                {
                    $this->um->sendMail($user, SB_T($subject),
                        SB_P($body, array($user['email'], SB_Page::baseurl())));
                }
            }

            $this->warn('Account "%s" <%s> deleted.',
                array($user['name'], $user['email']));
        }

        SB_SetLanguage($this->um->getParam('user','lang'));

        if (!$this->hasErrors())
        {
            $this->error('No action taken!');
        }

        $this->skipBuild = true;
        return array();
    }

    function buildDeleteInactiveUsers()
    {
        return $this->_buildDeleteInactiveUsers(false);
    }

    function buildDeleteAllInactiveUsers()
    {
        return $this->_buildDeleteInactiveUsers(true);
    }

    function buildCreateUser()
    {
        $fields = $this->buildSignUp();
        $fields['E-mail Verified'] = array('name'=>'verified', 'type'=>'checkbox',
            'checked'=>null,
            'title'=>SB_P('command::tooltip_verified'));
        $fields['Demo Account'] = array('name'=>'demo', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_demo'));
        return $fields;
    }

    function commandCreateUser()
    {
        $this->commandSignUp(false);

        $this->forwardCommand('Maintain Users');
    }

    function buildModifyUser()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        if (SB_reqVal('uid') == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return null;
        }

        $uid = SB_reqVal('uid');

        $fields = array();
        $user = $this->um->getUser($uid);
        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'], 'disabled' => null);
        $fields['Real Name'] = array('name'=>'realname', 'value'=>$user['name']);
        $fields['Comment'] = array('name'=>'comment', 'value'=>$user['comment']);
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['E-mail Verified'] = array('name'=>'verified', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_verified'));
        $fields['Account Approved'] = array('name'=>'approved', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_approved'));
        $fields['Demo Account'] = array('name'=>'demo', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_demo'));
        $fields['Last Visit'] = array('name'=>'visited', 'value'=>$user['visited'], 'disabled'=>null);
        $fields['Visit Count'] = array('name'=>'visits', 'value'=>$user['visits'], 'disabled'=>null);
        $fields['Link Count'] = array('name'=>'visits', 'value'=>$this->tree->getLinkCount($uid), 'disabled'=>null);

        if ($user['verified'])
        {
            $fields['E-mail Verified']['checked'] = null;
        }

        if ($user['approved'])
        {
            $fields['Account Approved']['checked'] = null;
        }

        if ($user['demo'])
        {
            $fields['Demo Account']['checked'] = null;
        }

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>$uid);
        return $fields;
    }

    function commandModifyUser()
    {
        if (SB_reqChk('pass') && SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $this->um->modifyUser(SB_reqVal('uid',true), SB_reqVal('pass'),
            array
            (
                'name' =>     SB_reqVal('realname'),
                'comment' =>  SB_reqVal('comment'),
                'verified' => (SB_reqVal('verified')?1:0),
                'approved' => (SB_reqVal('approved')?1:0),
                'demo' =>     (SB_reqVal('demo')?1:0)
            ));

        $this->forwardCommand('Maintain Users');
    }

    function buildDeleteUser()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        if ($this->um->uid == SB_reqVal('uid',true))
        {
            $this->error('Use "%s" command to delete own account!', SB_T('Delete Account'));
            return null;
        }

        $fields = array();
        $user = $this->um->getUser(SB_reqVal('uid'));
        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'], 'disabled' => null);
        $fields['Real Name'] = array('name'=>'realname', 'value'=>$user['name'], 'disabled' => null);
        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>SB_reqVal('uid'));

        if (count($this->tree->getUserRoots(SB_reqVal('uid'))))
        {
            $fields['New Tree Owner'] = array('name'=>'owner','type'=>'select',
                '_options'=>'_buildUserList', '_exclude'=>SB_reqVal('uid'));
        }
        return $fields;
    }

    function commandDeleteUser()
    {
        if (!$this->um->removeUser(SB_reqVal('uid',true)))
        {
            return;
        }
        if (SB_reqChk('owner'))
        {
            $this->tree->changeOwner(SB_reqVal('uid'), SB_reqVal('owner'));
        }

        $this->forwardCommand('Maintain Users');
    }

    function buildDeleteAccount()
    {
        $fields = array();
        $fields['-raw1-'] = SB_P('command::delete_account');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        return $fields;
    }

    function commandDeleteAccount()
    {
        $this->checkMandatoryFields(array('pass'));

        if (SB_reqChk('pass') && SB_reqVal('pass') && !$this->um->checkPassword($this->um->uid,SB_reqVal('pass')))
        {
            $this->error('Invalid password!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        if ($this->um->deleteAccount())
        {
            $this->commandLogOut();
        }
    }

    function _buildCommonUserSettings($prefix, &$fields)
    {
        $fields['Default Search In'] = array('name'=>'default_search','type'=>'select',
            '_options'=>'_buildSearchPrefix', '_select'=>$this->um->getParam($prefix,'default_search'));
        $fields['Default Link Sort Mode'] = array('name'=>'link_sort_mode','type'=>'select',
            '_options'=>'_buildLinkSortMode', '_select'=>$this->um->getParam($prefix,'link_sort_mode'));
        $fields['Default URL'] = array('name'=>'default_url',
            'value'=>$this->um->getParam($prefix,'default_url'));
        $fields['Order of Folders v. Links'] = array('name'=>'mix_mode','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam($prefix,'mix_mode'),
            'title'=>SB_P('command::tooltip_mix_mode'));
        $fields['Paste Mode'] = array('name'=>'paste_mode','type'=>'select',
            '_options'=>'_buildPasteModeSetting', '_select'=>$this->um->getParam($prefix,'paste_mode'));
        $fields['Skin'] = array('name'=>'skin','type'=>'select',
            '_options'=>'_buildSkinList', '_select'=>$this->um->getParam($prefix,'skin'));

        if ($this->um->getParam('config', 'allow_custom_search_engine'))
        {
            $fields['Web Search Engine URL'] = array('name'=>'search_engine_url',
                'value'=>$this->um->getParamB64($prefix,'search_engine_url'));
            $fields['Web Search Engine Icon'] = array('name'=>'search_engine_ico',
                'value'=>$this->um->getParamB64($prefix,'search_engine_ico'));
        }

        if (!$this->um->pmode)
        {
            $fields['Allow Given Membership'] = array('name'=>'allow_given_membership',
                'type'=>'checkbox',
                'checked'=>$this->um->getParamCheck($prefix,'allow_given_membership'),
                'title'=>SB_P('command::tooltip_allow_given_membership'));
            $fields['Allow Info Mail'] = array('name'=>'allow_info_mails',
                'type'=>'checkbox',
                'checked'=>$this->um->getParamCheck($prefix,'allow_info_mails'),
                'title'=>SB_P('command::tooltip_allow_info_mails'));
        }

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $fields['Auto Retrieve Favicon'] = array('name'=>'auto_retrieve_favicon', 'type'=>'checkbox',
                'checked'=>$this->um->getParamCheck($prefix,'auto_retrieve_favicon'),
                'title'=>SB_P('command::tooltip_auto_retrieve_favicon'));
        }

        $name = ($this->um->pmode?'Decorate Published Folders':'Decorate ACL Folders');

        $fields[$name] = array('name'=>'show_acl', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'show_acl'),
            'title'=>SB_P('command::tooltip_show_acl'));

        $fields['Extern Commander'] = array('name'=>'extern_commander', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'extern_commander'),
            'title'=>SB_P('command::tooltip_extern_commander'));

        $fields['Hide XSLT Features'] = array('name'=>'hide_xslt', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'hide_xslt'),
            'title'=>SB_P('command::tooltip_hide_xslt'));

        $fields['Load Open Folders Only'] = array('name'=>'load_open_nodes_only', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'load_open_nodes_only'),
            'title'=>SB_P('command::tooltip_load_open_nodes_only'));

        $fields['Load Private Links Over SSL Only'] = array('name'=>'private_over_ssl_only', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'private_over_ssl_only'),
            'title'=>SB_P('command::tooltip_private_over_ssl_only'));

        $fields['Show Menu Icon'] = array('name'=>'menu_icon', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'menu_icon'),
            'title'=>SB_P('command::tooltip_menu_icon'));

        $fields['Skip Execution Messages'] = array('name'=>'auto_close', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'auto_close'),
            'title'=>SB_P('command::tooltip_auto_close'));

        if ($this->um->pmode)
        {
            $fields['Show Public Bookmarks'] = array('name'=>'show_public', 'type'=>'checkbox',
                'checked'=>($this->um->showPublic()?null:''),
                'title'=>SB_P('command::tooltip_show_public'));
        }

        $fields['Use Favicons'] = array('name'=>'use_favicons', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_favicons'),
            'title'=>SB_P('command::tooltip_use_favicons'));

        $fields['Use Folder Hiding'] = array('name'=>'use_hiding', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_hiding'),
            'title'=>SB_P('command::tooltip_use_hiding'));

        $fields['Use SiteBar Tooltips'] = array('name'=>'use_tooltips', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_tooltips'),
            'title'=>SB_P('command::tooltip_use_tooltips'));

        $fields['Use Trash'] = array('name'=>'use_trash', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_trash'),
            'title'=>SB_P('command::tooltip_use_trash'));

        $fields['Use Web Search Engine'] = array('name'=>'use_search_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_search_engine'),
            'title'=>SB_P('command::tooltip_use_search_engine'));

        $fields['Show Web Search Engine Results Inline'] = array('name'=>'use_search_engine_iframe', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_search_engine_iframe'),
            'title'=>SB_P('command::tooltip_use_search_engine_iframe'));
    }

    function buildUserSettings()
    {
        $prefix = 'user';
        $fields = array();

        $fields['Personal Data'] = array('type'=>'addbutton');
        $fields['Delete Account'] = array('type'=>'addbutton');

        if ($this->um->demo)
        {
            foreach ($fields as $name => $field)
            {
                $fields[$name]['disabled'] = null;
            }
        }

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$this->um->getParam($prefix,'lang'));

        $this->_buildCommonUserSettings($prefix, $fields);
        return $fields;
    }

    function buildDefaultUserSettings()
    {
        $prefix = 'default';
        $fields = array();

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildAutoLangList', '_select'=>$this->um->getParam($prefix,'lang'));

        $this->_buildCommonUserSettings($prefix, $fields);
        return $fields;
    }

    function buildSessionSettings()
    {
        $prefix = 'user';

        $fields = array();

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$this->um->getParam($prefix,'lang'));
        $fields['Default Search In'] = array('name'=>'default_search','type'=>'select',
            '_options'=>'_buildSearchPrefix', '_select'=>$this->um->getParam($prefix,'default_search'));
        $fields['Default Link Sort Mode'] = array('name'=>'link_sort_mode','type'=>'select',
            '_options'=>'_buildLinkSortMode', '_select'=>$this->um->getParam($prefix,'link_sort_mode'));
        $fields['Order of Folders v. Links'] = array('name'=>'mix_mode','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam($prefix,'mix_mode'),
            'title'=>SB_P('command::tooltip_mix_mode'));
        $fields['Skin'] = array('name'=>'skin','type'=>'select',
            '_options'=>'_buildSkinList', '_select'=>$this->um->getParam($prefix,'skin'));

        $fields['Load Open Folders Only'] = array('name'=>'load_open_nodes_only', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'load_open_nodes_only'),
            'title'=>SB_P('command::tooltip_load_open_nodes_only'));

        $fields['Use Favicons'] = array('name'=>'use_favicons', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_favicons'),
            'title'=>SB_P('command::tooltip_use_favicons'));

        $fields['Use SiteBar Tooltips'] = array('name'=>'use_tooltips', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_tooltips'),
            'title'=>SB_P('command::tooltip_use_tooltips'));

        $fields['Show Menu Icon'] = array('name'=>'menu_icon', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'menu_icon'),
            'title'=>SB_P('command::tooltip_menu_icon'));

        return $fields;
    }

    function _buildPasteModeSetting($select=null)
    {
        $modes = array
        (
            'ask'  => SB_T('Ask'),
            'copy' => SB_T('Copy'),
            'move' => SB_T('Move or Copy'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildSearchPrefix($select=null)
    {
        $modes = array
        (
            'name' => SB_T('Name'),
            'url'  => SB_T('URL'),
            'desc' => SB_T('Description'),
            'all'  => SB_T('All'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildMixMode($select=null)
    {
        $modes = array
        (
            'nodes' => SB_T('Folders First'),
            'links' => SB_T('Links First'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildLinkSortMode($select=null)
    {
        $modes = array
        (
            'abc',
            'added',
            'changed',
        );

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $modes[] = 'visited';
            $modes[] = 'hits';
            $modes[] = 'waiting';
        }

        foreach ($modes as $mode)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . SB_T($this->tree->sortModeLabel[$mode]) . "</option>\n";
        }
    }

    function _commandGatherUserSettings($prefix)
    {
        $checks = array
        (
            'auto_close',
            'load_open_nodes_only',
            'private_over_ssl_only',
            'extern_commander',
            'menu_icon',
            'hide_xslt',
            'show_acl',
            'use_tooltips',
            'use_favicons',
            'use_hiding',
            'use_trash',
            'use_search_engine',
            'use_search_engine_iframe',
        );

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $checks[] = 'auto_retrieve_favicon';
        }

        $values = array
        (
            'default_search',
            'link_sort_mode',
            'mix_mode',
            'lang',
            'paste_mode',
            'skin',
            'default_url',
        );

        $valuesB64 = array();

        if ($this->um->getParam('config', 'allow_custom_search_engine'))
        {
            $valuesB64[] = 'search_engine_url';
            $valuesB64[] = 'search_engine_ico';
        }

        foreach ($checks as $check)
        {
            $this->um->setParam($prefix, $check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $check)
        {
            $this->um->setParam($prefix, $check, SB_reqVal($check));
        }
        foreach ($valuesB64 as $check)
        {
            $this->um->setParamB64($prefix, $check, SB_reqVal($check));
        }

        if (!$this->um->pmode)
        {
            $this->um->setParam($prefix,'allow_given_membership', SB_reqVal('allow_given_membership'));
            $this->um->setParam($prefix,'allow_info_mails', SB_reqVal('allow_info_mails'));
        }
        else
        {
            $gid = $this->um->config['gid_everyone'];

            if (SB_reqVal('show_public') && !$this->um->showPublic())
            {
                // Add to Everyone group
                $this->um->addMember($gid,$this->um->uid);
            }
            else if (!SB_reqVal('show_public') && $this->um->showPublic())
            {
                // Remove from Everyone group
                $this->um->removeMember($gid,$this->um->uid);
            }
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        // Have the behaviour immediately
        $this->reload = !$this->um->getParam($prefix,'extern_commander');
        $this->close = $this->um->getParam($prefix,'auto_close');
    }

    function commandUserSettings()
    {
        $prefix = 'user';
        $this->_commandGatherUserSettings($prefix);
        $this->um->saveUserParams();
    }

    function commandDefaultUserSettings()
    {
        $prefix = 'default';
        $this->_commandGatherUserSettings($prefix);
        $this->um->saveUserParams(SB_ANONYM, $prefix);
    }

    function commandSessionSettings()
    {
        $checks = array
        (
            'load_open_nodes_only',
            'use_favicons',
            'use_tooltips',
            'menu_icon',
        );

        $values = array
        (
            'lang',
            'default_search',
            'link_sort_mode',
            'mix_mode',
            'skin',
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('user',$check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $check)
        {
            $this->um->setParam('user',$check, SB_reqVal($check));
        }

        // Have the behaviour immediately
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');

        $this->um->setCookie('SB3SETTINGS', $this->um->implodeParams('user'), 0);
    }

    function buildPersonalData()
    {
        $fields = array();

        $fields['E-mail'] = array('name'=>'email', 'value'=>$this->um->email);
        $fields['Old Password'] = array('name'=>'pass','type'=>'password');
        $fields['Password'] = array('name'=>'pass1','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass2','type'=>'password');
        $fields['Real Name'] = array('name'=>'realname','value'=>$this->um->name);
        $fields['Comment'] = array('name'=>'comment','value'=>$this->um->comment);

        if ($this->um->demo)
        {
            foreach ($fields as $name => $field)
            {
                $fields[$name]['disabled'] = null;
            }
        }

        return $fields;
    }

    function commandPersonalData()
    {
        if (SB_reqVal('pass1') != SB_reqVal('pass2'))
        {
            $this->error('The password was not repeated correctly!');
        }

        $mfields = array('email','realname');

        // When changing password or email, old password must be specified
        if (SB_reqVal('pass1') || (SB_reqVal('email') != $this->um->email))
        {
            $mfields[] = 'pass';

            if (strlen(SB_reqVal('pass')) && !$this->um->checkPassword($this->um->uid,SB_reqVal('pass')))
            {
                $this->error('Old password is invalid!');
            }
        }

        $this->checkMandatoryFields($mfields);

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $this->um->personalData(
            SB_reqVal('email'),
            ($this->um->demo?null:SB_reqVal('pass1')),
            SB_reqVal('realname'),
            SB_reqVal('comment'));

        $this->forwardCommand('User Settings');
    }

/******************************************************************************/

    function buildFilterGroups()
    {
        return $this->buildFilterUsers();
    }

    function buildMaintainGroups()
    {
        $fields = array();

        $fields['Create Group'] = array('type'=>'button');

        $groups = $this->um->getModeratedGroups($this->um->uid);
        if (count($groups))
        {
            if ($this->um->useGroupFilter() && !SB_reqChk('gregexp'))
            {
                $fields['Filter Group RegExp'] = array('name'=>'gregexp');
                $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Maintain Groups');
                $fields['Filter Groups'] = array('type'=>'button');
            }
            else
            {
                $fields['Select Group'] = array('name'=>'command_gid','type'=>'select','_options'=>'_buildGroupList','_select'=>SB_reqVal('command_gid'));
                $fields['Group Properties'] = array('type'=>'button');

                if ($this->um->useUserFilter())
                {
                    $fields['Filter User RegExp'] = array('name'=>'uregexp', 'value'=>SB_reqVal('uregexp'));
                }

                $fields['Group Members'] = array('type'=>'button');
                $fields['Group Moderators'] = array('type'=>'button');
                $fields['Delete Group'] = array('type'=>'button');
                $fields['Send Email to Members'] = array('type'=>'button');
                $fields['Send Email to Moderators'] = array('type'=>'button');
            }
        }
        return $fields;
    }

    function buildGroupProperties()
    {
        $fields = $this->buildCreateGroup();

        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        foreach ($fields as $name => $params)
        {
            if ($params['name']
            &&  $params['name']!='allow_addself'
            &&  $params['name']!='allow_contact'
            &&  isset($group[$params['name']]))
            {
                $fields[$name]['value'] = $group[$params['name']];
            }
        }
        if ($group['allow_addself'])
        {
            $fields['Allow Self Add']['checked'] = null;
        }
        if ($group['allow_contact'])
        {
            $fields['Allow Contact']['checked'] = null;
        }
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);

        return $fields;
    }

    function commandGroupProperties()
    {
        // Regexp check
        if (SB_reqChk('auto_join') && strlen(SB_reqVal('auto_join')))
        {
            $autoJoin = SB_reqVal('auto_join');
            if ($autoJoin{0} != '/')
            {
                $autoJoin = '/'.$autoJoin.'/i';
            }

            // Would be caugth by error handler
            preg_match($autoJoin, '');

            if ($this->hasErrors())
            {
                $this->error('Invalid regular expresssion!');
                $this->goBack();
                return;
            }
        }

        $this->um->updateGroup(SB_reqVal('command_gid'), SB_reqVal('name'), SB_reqVal('comment'),
            SB_reqVal('allow_addself')?1:0, SB_reqVal('allow_contact')?1:0, SB_reqVal('auto_join'));

        $this->forwardCommand('Maintain Groups');
    }

    function buildGroupMembers()
    {
        $fields = array();
        $group = $this->um->getGroup(SB_reqVal('command_gid'));

        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        $fields['-hidden2-'] = array('name'=>'uregexp','value'=>SB_reqVal('uregexp'));

        $fields['Add Member with E-mail'] = array('name'=>'email');

        $hideNonMembers = $group['is_usergroup'] && !$this->um->isAdmin();

        $members    = $this->um->getMembers(SB_reqVal('command_gid'));
        $moderators = $this->um->getMembers(SB_reqVal('command_gid'), true);

        $fields['-raw1-'] = "<table class='users'>";

        foreach ($this->um->getUsers() as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $isMember = in_array($uid, array_keys($members));

            if ($hideNonMembers && !$isMember)
            {
                continue;
            }

            $label = $rec['email'];
            $fields[$label] = array
            (
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array('name'=>$uid,'email'=>$rec['cryptmail'],'realname'=>$rec['name']),
            );

            if ($isMember)
            {
                $fields[$label]['params']['checked'] = true;

                if (in_array($uid, array_keys($moderators)))
                {
                    $fields[$label]['params']['disabled'] = true;
                }
            }
            else
            {
                // Member is not in the group and does not want to be added
                if (strstr($rec['params'],'allow_given_membership=;'))
                {
                    array_pop($fields); // Hidden value
                }
            }
        }

        $fields['-raw2-'] = "</table>";
        return $fields;
    }

    function commandGroupMembers()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $members    = $this->um->getMembers(SB_reqVal('command_gid'));
        $moderators = $this->um->getMembers(SB_reqVal('command_gid'), true);
        $newuser = SB_reqVal('email');

        foreach ($this->um->getUsers() as $uid => $rec)
        {
            if ($rec['email'] == $newuser)
            {
                if (strstr($rec['params'],'allow_given_membership=;'))
                {
                    $this->um->accessDenied();
                    return;
                }

                $this->um->addMember(SB_reqVal('command_gid'),$uid);
                continue;
            }

            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            if (!SB_reqChk($uid))
            {
                // Skip moderators - they cannot be unchecked
                if (in_array($uid, array_keys($moderators)))
                {
                    continue;
                }

                if (in_array($uid, array_keys($members)))
                {
                    $this->um->removeMember(SB_reqVal('command_gid'),$uid);
                }
            }
            else
            {
                // Member already in
                if (in_array($uid, array_keys($members)))
                {
                    continue;
                }
                // Member is not in the group and does not want to be added
                if (strstr($rec['params'],'allow_given_membership=;'))
                {
                    $this->um->accessDenied();
                    return;
                }

                $this->um->addMember(SB_reqVal('command_gid'),$uid);
            }
        }

        $this->forwardCommand('Maintain Groups');
    }

    function buildGroupModerators()
    {
        $fields = array();
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $members    = $this->um->getMembers(SB_reqVal('command_gid'));
        $moderators = $this->um->getMembers(SB_reqVal('command_gid'),true);

        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        $fields['-hidden2-'] = array('name'=>'uregexp','value'=>SB_reqVal('uregexp'));
        $fields['-raw1-'] = "<table cellpadding='0'>";

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $label = $rec['email'];
            $fields[$label] = array
            (
                'name'=>$uid,
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array('name'=>$uid,'email'=>$rec['cryptmail'],'realname'=>$rec['name']),
            );

            if (in_array($uid, array_keys($moderators)))
            {
                $fields[$label]['params']['checked'] = true;
            }
        }

        $fields['-raw2-'] = "</table>";
        return $fields;
    }

    function commandGroupModerators()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $members    = $this->um->getMembers(SB_reqVal('command_gid'));
        $moderators = $this->um->getMembers(SB_reqVal('command_gid'), true);

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            if (!SB_reqChk($uid) && in_array($uid, array_keys($moderators)))
            {
                $this->um->updateMember(SB_reqVal('command_gid'),$uid,false);
            }
            else if (SB_reqChk($uid))
            {
                $this->um->updateMember(SB_reqVal('command_gid'),$uid,true);
            }
        }

        // We might have deleted all moderators what would be fatal and
        // require manual change in database, therefore we make this one
        // as the only moderator.
        $moderators = $this->um->getMembers(SB_reqVal('command_gid'),true);
        if (!count($moderators))
        {
            $this->um->updateMember(SB_reqVal('command_gid'),$this->um->uid,true);
            $this->error('Cannot remove all moderators from a group!');
            $this->error('You have been left as group moderator.');
        }

        $this->forwardCommand('Maintain Groups');
    }

    function buildDeleteGroup()
    {
        $fields = array();
        if (SB_reqVal('command_gid') == $this->um->config['gid_admins'])
        {
            $this->error('Cannot delete built in group!');
            return $fields;
        }

        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['Comment'] = array('name'=>'comment','value'=>$group['comment'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        return $fields;
    }

    function commandDeleteGroup()
    {
        $this->um->removeGroup(SB_reqVal('command_gid'));

        $this->forwardCommand('Maintain Groups');
    }

    function buildCreateGroup()
    {
        $fields = array();
        $fields['Group Name'] = array('name'=>'name');
        $fields['Comment'] = array('name'=>'comment');

        if ($this->um->isAdmin())
        {
            $fields['Auto Join E-Mail RegExp'] = array('name'=>'auto_join');
            if ($this->command == 'Create Group')
            {
                $fields['Moderator'] = array('name'=>'uid','type'=>'select',
                    '_options'=>'_buildUserList');
            }
        }

        $fields['Allow Self Add'] = array('name'=>'allow_addself','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_allow_addself'));
        $fields['Allow Contact'] = array('name'=>'allow_contact','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_allow_contact_moderator'));
        return $fields;
    }

    function commandCreateGroup()
    {
        $moderator = $this->um->uid;
        $autoJoin = '';

        if ($this->um->isAdmin())
        {
            $moderator = SB_reqVal('uid');
            $autoJoin = SB_reqVal('auto_join');
        }

        $this->um->addGroup(
            SB_reqVal('name'),
            SB_reqVal('comment'),
            $moderator ,
            SB_reqVal('allow_addself')?1:0,
            SB_reqVal('allow_contact')?1:0,
            $autoJoin);

        $this->forwardCommand('Maintain Groups');
    }

/******************************************************************************/

    function buildMembership()
    {
        $fields = array();
        $mygroups = $this->um->getUserGroups($this->um->uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            if ($this->um->isHiddenGroup($rec, $this->command))
            {
                continue;
            }

            $isMyGroup = in_array($gid, array_keys($mygroups));
            $canJoin = $this->um->canJoinGroup($rec);

            if ($isMyGroup || $canJoin || $rec['allow_contact'])
            {
                $name = $rec['name'];

                if (!$isMyGroup && $rec['allow_contact'])
                {
                    $name .= ' [<a href="?command=Contact%20Moderator&amp;gid=' . $gid . '">Contact</a>]';
                }

                $fields[$name] =  array('name'=>'gid_'.$gid,'type'=>'checkbox','_raw'=>1);

                if ($isMyGroup)
                {
                    $fields[$name]['checked'] = null;
                }

                $isModerator = isset($mygroups[$gid]) && $mygroups[$gid]['moderator'];
                if ((!$canJoin && !$isMyGroup) || $isModerator)
                {
                    $fields[$name]['disabled'] = null;
                }
            }
        }
        return $fields;
    }

    function commandMembership()
    {
        $mygroups = $this->um->getUserGroups($this->um->uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            $isMyGroup = in_array($gid, array_keys($mygroups));
            $canJoin = $this->um->canJoinGroup($rec);
            $checked = SB_reqVal('gid_'.$gid)==1;
            $isModerator = isset($mygroups[$gid]) && $mygroups[$gid]['moderator'];

            if ($isMyGroup && !$checked && !$isModerator)
            {
                $this->um->removeMember($gid,$this->um->uid);
            }
            else if (!$isMyGroup && $checked)
            {
                if ($canJoin)
                {
                    $this->um->addMember($gid,$this->um->uid);
                }
                else
                {
                    $this->um->accessDenied();
                }
            }
        }
    }

    function buildContactModerator()
    {
        $fields = $this->_buildSendEmail();
        $fields['-hidden1-'] = array('name'=>'gid','value'=>SB_reqVal('gid'));
        return $fields;
    }

    function commandContactModerator()
    {
        $group = $this->um->getGroup(SB_reqVal('gid'));
        $comment = SB_reqVal('message');

        if (!$comment || !$group)
        {
            return;
        }

        if (!$group['allow_contact'])
        {
            $this->um->accessDenied();
            return;
        }

        $moderators = $this->um->getMembers(SB_reqVal('gid'), true);
        foreach ($moderators as $uid => $user)
        {
            $this->um->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->um->getParam('tmp','lang'));
            $msg = SB_P('command::contact_group',array($group['name'],$comment,SB_Page::baseurl()));
            $this->um->sendMail($user, SB_T("SiteBar: Contact Group Moderator"), $msg,
                $this->um->name, $this->um->email);
        }
        SB_SetLanguage($this->um->getParam('user','lang'));
    }

    function buildSendEmailtoMembers()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        return array_merge($fields,$this->_buildSendEmail(null, true));
    }

    function buildSendEmailtoModerators()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        return array_merge($fields,$this->_buildSendEmail(null, true));
    }

    function buildSendEmailtoUser()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        $fields = array();
        $user = $this->um->getUser(SB_reqVal('uid'));

        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'], 'disabled' => null);
        $fields['Real Name'] = array('name'=>'realname', 'value'=>$user['name'], 'disabled' => null);

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>SB_reqVal('uid'));
        $fields = array_merge($fields,$this->_buildSendEmail());

        return $fields;
    }

    function buildSendEmailtoAll()
    {
        return $this->_buildSendEmail(null, true);
    }

    function commandSendEmailtoMembers()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $to = $this->um->getMembers($group['gid']);
        $this->_commandSendEmail($to, 'SiteBar: Email to Group Members', $group['name']);
    }

    function commandSendEmailtoModerators()
    {
        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $to = $this->um->getMembers($group['gid'], true);
        $this->_commandSendEmail($to, 'SiteBar: Email to Group Moderators', $group['name']);
    }

    function commandSendEmailtoUser()
    {
        $uid = SB_reqVal('uid', true);
        $to = array($uid => $this->um->getUser($uid));
        $this->_commandSendEmail($to, 'SiteBar: Email to SiteBar User');
    }

    function commandSendEmailtoAll()
    {
        $to = $this->um->getUsers();
        $this->_commandSendEmail($to, 'SiteBar: Email to all SiteBar Users');
    }

/******************************************************************************/

    function _buildFolderSortMode($select=null)
    {
        $modes = array
        (
            'user',
            'custom',
            'abc',
            'added',
            'changed',
        );

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $modes[] = 'visited';
            $modes[] = 'hits';
            $modes[] = 'waiting';
        }

        foreach ($modes as $mode)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . SB_T($this->tree->sortModeLabel[$mode]) . "</option>\n";
        }
    }

    function buildAddFolder()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));
        if (!$node) return null;

        if ($this->command == 'Add Folder')
        {
            $fields['Parent Folder'] = array('name'=>'parent','value'=>$node->name, 'disabled'=>null);
        }

        $fields['Folder Name'] = array('name'=>'name','maxlength'=>255);
        $fields['Sort Mode'] = array('name'=>'sort_mode','type'=>'select',
                '_options'=>'_buildFolderSortMode', '_select'=>$node->sort_mode);

        $fields['Description'] = array('name'=>'comment', 'type'=>'textarea');
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        if ($this->command == 'Folder Properties'
        && $node->id_parent==0
        && $this->um->isAdmin()
        && !$this->um->pmode)
        {
            $uid = $this->tree->getRootOwner($node->id);
            $fields['Tree Owner'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList', '_select'=> $uid);
        }

        if ($this->command != 'Add Folder')
        {
            $fields['Folder Name']['value'] = $node->name;
            $fields['Description']['value'] = $node->comment;
        }

        if ($this->um->pmode)
        {
            $inherited = false;
            $acl = false;

            if ($this->command == 'Folder Properties')
            {
                $inherited = $node->isPublishedByParent();
                $acl = $node->getGroupACL($this->um->config['gid_everyone']);
            }

            $fields['Publish Folder'] = array
            (
                'name'=>'publish', 'type'=>'checkbox',
                'checked'=>((($acl&&$acl['allow_select'])||(!$acl&&$inherited))?null:''),
                'title'=>SB_P('command::tooltip_publish'),
            );

            if ($inherited)
            {
                $fields['Publish Folder']['disabled'] = null;
            }
        }

        return $fields;
    }

    function commandAddFolder()
    {
        $nid = $this->tree->addNode(SB_reqVal('nid_acl'),SB_reqVal('name'),
            SB_reqVal('comment'), SB_reqVal('sort_mode'));

        if ($this->um->pmode && !$this->hasErrors())
        {
            $node = $this->tree->getNode($nid);
            $node->publishFolder(SB_reqVal('publish'));
        }
    }

/******************************************************************************/

    function buildHideFolder()
    {
        $this->skipBuild = true;
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');
        $this->um->hiddenFolders[SB_reqVal('nid_acl')] = 1;
        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();
    }

    function buildUnhideSubfolders()
    {
        $this->skipBuild = true;
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');

        $parent = $this->tree->getNode(SB_reqVal('nid_acl'));

        $this->tree->loadNodes($parent, false, 'select', true);

        foreach ($parent->getNodes() as $node)
        {
            if (isset($this->um->hiddenFolders[$node->id]))
            {
                unset($this->um->hiddenFolders[$node->id]);
            }
        }

        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();
    }

/******************************************************************************/

    function buildFolderProperties()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));

        $fields = $this->buildAddFolder();

        if ( $node->id_parent && !$node->parentHasRight('update') )
        {
            foreach ($fields as $name => $param)
            {
                if ($name{0} != '-')
                {
                    $fields[$name]['disabled'] = null;
                }
            }
        }

        $fields['Custom Order'] = array('type'=>'addbutton');
        $fields['Import Bookmarks'] = array('type'=>'addbutton');
        $fields['Export Bookmarks'] = array('type'=>'addbutton');
        $fields['Validate Links'] = array('type'=>'addbutton');
        $fields['Security'] = array('type'=>'addbutton');

        return $fields;
    }

    function commandFolderProperties()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));
        if ($node->id_parent && !$node->parentHasRight('update'))
        {
            return;
        }

        $nid = SB_reqVal('nid_acl');

        $columns = array
        (
            'name' => SB_reqVal('name'),
            'sort_mode' => SB_reqVal('sort_mode'),
            'comment'=> SB_reqVal('comment'),
        );

        $this->tree->updateNode( $nid, $columns);

        if (SB_reqVal('uid'))
        {
            $this->tree->updateNodeOwner( $nid, SB_reqVal('uid'));
        }

        if ($this->um->pmode && !$this->hasErrors())
        {
            $node = $this->tree->getNode($nid);
            $node->publishFolder(SB_reqVal('publish'));
        }
    }

    function buildCustomOrder()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));
        $this->tree->loadNodes($node);

        $fields['-raw1-'] = "<table cellpadding='0'>";

        foreach ($node->getChildren() as $child)
        {
            $label = $child->name;
            $fields[$label] = array
            (
                'type'=>'callback',
                'function'=>'_buildFolderOrder',
                'params'=>array('name'=>$child->name,'id'=>$child->type_flag.$child->id,'order'=>$child->order),
            );
        }

        $fields['-raw2-'] = "</table>";
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        return $fields;
    }

    function commandCustomOrder()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));
        $this->tree->loadNodes($node);

        $order = array();

        foreach ($node->getChildren() as $child)
        {
            $id = $child->type_flag.$child->id;
            $order[] = $id.'~'.intval(SB_reqVal('id'.$id));
        }

        $columns = array
        (
            'custom_order' => implode(':',$order),
            'sort_mode' => 'custom',
        );

        $this->tree->updateNode($node->id, $columns);
        $this->forwardCommand('Folder Properties');
    }

/******************************************************************************/

    function _deleteContentOnly(&$node)
    {
        if ($node->id_parent)
        {
            return !$node->parentHasRight('delete');
        }
        else
        {
            return !$this->um->getParam('config','allow_user_tree_deletion');
        }
    }

    function buildDeleteFolder()
    {
        $fields = $this->buildDeleteTree();
        $fields['Delete Content Only'] = array('name'=>'content','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_delete_content'));

        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));

        if ($this->_deleteContentOnly($node))
        {
            $fields['Delete Content Only']['checked'] = null;
            $fields['Delete Content Only']['disabled'] = null;
        }

        return $fields;
    }

    function commandDeleteFolder()
    {
        $node = $this->tree->getNode(SB_reqVal('nid_acl', true));
        $deleteContentOnly = SB_reqVal('content') || $this->_deleteContentOnly($node);

        $this->tree->removeNode(SB_reqVal('nid_acl'), $deleteContentOnly);

        if (!$this->um->getParam('user','use_trash') && $node->hasRight('purge'))
        {
            $this->tree->purgeNode(SB_reqVal('nid_acl'));
        }
    }

/******************************************************************************/

    function buildPurgeFolder()
    {
        return $this->buildDeleteTree();
    }

    function commandPurgeFolder()
    {
        $this->tree->purgeNode(SB_reqVal('nid_acl'));
    }

/******************************************************************************/

    function buildUndelete()
    {
        return $this->buildDeleteTree();
    }

    function commandUndelete()
    {
        $this->tree->undeleteNode(SB_reqVal('nid_acl'));
    }

/******************************************************************************/

    function _buildPasteMode($params)
    {
?>
    <div class='label'><?php echo SB_T('Paste Mode')?></div>
    <input value='Copy' type='radio' name='mode' <?php echo $params['canMove']?'':'checked'?>><?php echo SB_T('Copy (Keep Source)')?><br>
    <input value='Move' type='radio' name='mode' <?php echo $params['canMove']?'checked':'disabled'?>><?php echo SB_T('Move (Delete Source)')?><br>
<?php
    }

    function buildPaste()
    {
        $fields = array();
        $sourceId   = SB_reqVal('sid',true);
        $sourceIsNode = SB_reqVal('stype',true);
        $sourceObj  = null;
        $targetID = SB_reqVal('nid_acl',true);
        $targetNode = $this->tree->getNode($targetID);
        $sourceNodeId = $sourceId;

        if ($sourceIsNode)
        {
            $sourceObj = $this->tree->getNode($sourceId);
            if (!$this->um->isAuthorized('Copy', false, null, $sourceId))
            {
                $this->um->accessDenied();
                return;
            }

            $parents = $this->tree->getParentNodes($targetID);

            if (in_array($sourceId, $parents))
            {
                $this->warn('Cannot move folder to its subfolder!');
                return;
            }
        }
        else
        {
            $sourceObj = $this->tree->getLink($sourceId);
            $sourceNodeId = $sourceObj->id_parent;

            if (!$this->um->isAuthorized('Copy Link', false, null, null, $sourceId))
            {
                $this->um->accessDenied();
                return;
            }

            if ($sourceObj->id_parent == $targetNode->id)
            {
                $this->warn('Link already is in the target folder!');
                return;
            }
        }

        $canMove = $this->um->canMove($sourceNodeId,$targetNode->id,$sourceIsNode);

        if ($this->um->getParam('user','paste_mode')!='ask')
        {
            $this->skipBuild = true;
            $this->reload = !$this->um->getParam('user','extern_commander');
            $this->close = $this->um->getParam('user','auto_close');

            $move = $canMove && $this->um->getParam('user','paste_mode')=='move';
            $this->executePaste($targetNode->id, $sourceId, $sourceIsNode, $move);
            return;
        }

        $fields[$sourceIsNode?SB_T('Source Folder Name'):SB_T('Source Link Name')] =
            array('name'=>'sidname', 'value'=>$sourceObj->name, 'disabled' => null);
        $fields['Target Folder Name'] =
            array('name'=>'tidname', 'value'=>$targetNode->name, 'disabled' => null);

        if ($sourceIsNode)
        {
            $fields['Content Only'] = array('name'=>'content','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_paste_content'));
        }


        $fields['Mode'] = array('type'=>'callback', 'function'=>'_buildPasteMode',
            'params'=>array('canMove'=>$canMove));

        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$targetNode->id);
        $fields['-hidden2-'] = array('name'=>'sid','value'=>$sourceId);
        $fields['-hidden3-'] = array('name'=>'stype','value'=>$sourceIsNode);

        return $fields;
    }

    function commandPaste()
    {
        $targetID = SB_reqVal('nid_acl');
        $sourceId   = SB_reqVal('sid',true);
        $sourceIsNode = SB_reqVal('stype',true);
        $move = SB_reqVal('mode',true)=='Move';

        $this->executePaste($targetID, $sourceId, $sourceIsNode, $move, SB_reqVal('content'));
    }

    function executePaste($targetID, $sourceId, $sourceIsNode, $move, $contentOnly=false)
    {
        $targetNode = $this->tree->getNode($targetID);
        $sourceObj  = null;

        if ($sourceIsNode)
        {
            $sourceObj = $this->tree->getNode($sourceId);
            if (!$this->um->isAuthorized('Copy', false, null, $sourceId) ||
                ($move && !$this->um->canMove($sourceId, $targetNode->id, true)))
            {
                $this->um->accessDenied();
                return;
            }

            if ($move)
            {
                $this->tree->moveNode( $sourceId, $targetNode->id, $contentOnly);
            }
            else
            {
                $this->tree->copyNode( $sourceId, $targetNode->id, $contentOnly);
            }
        }
        else
        {
            $sourceObj = $this->tree->getLink($sourceId);
            if (!$this->um->isAuthorized('Copy Link', false, null, null, $sourceId) ||
                ($move && !$this->um->canMove($sourceObj->id_parent, $targetNode->id, false)))
            {
                $this->um->accessDenied();
                return;
            }

            if ($move)
            {
                $this->tree->moveLink( $sourceId, $targetNode->id);
            }
            else
            {
                $this->tree->copyLink( $sourceId, $targetNode->id);
            }
        }
    }


/******************************************************************************/

    function buildEmailLink()
    {
        $fields = array();
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));
        if (!$link) return null;

        if ($this->um->canUseMail())
        {
            $fields['From'] = array('name'=>'from',
                'value'=> $this->um->email, 'disabled' => null);
            $fields['To'] =
                array('name'=>'to');

            $fields['Link Name'] = array('name'=>'name','value'=>$link->name,'disabled'=>null);
            $fields['URL']       = array('name'=>'url','value'=>$link->url,'disabled'=>null);
            $fields['Description'] = array('name'=>'comment','type'=>'textarea','value'=>$link->comment);
            $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>$link->id);
        }

        $fields['-raw1-'] = SB_P('command::email_link_href',
            array(htmlspecialchars($link->name),htmlspecialchars($link->url),SB_Page::baseurl()));
        return $fields;
    }

    function commandEmailLink()
    {
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));
        if (!$link) return null;

        $this->checkMandatoryFields(array('to'));

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $subject = SB_T('SiteBar: Web site') . ' ' . $link->name;

        $msg = SB_P('command::email_link',array($link->name, $link->url, SB_reqChk('comment'), SB_Page::baseurl()));
        $this->um->sendMail(array('email'=>SB_reqVal('to')), $subject, $msg, $this->um->name, $this->um->email);
    }

/******************************************************************************/

    function _buildAddLinkNode($node, $level)
    {
        foreach ($node->getChildren() as $childNode)
        {
            if ($childNode->type_flag!='n')
            {
                continue;
            }
            echo '<option class="fldList'.$level.'" '.(!$childNode->hasRight('insert')?'class="noinsert"':'').
                 ($childNode->id==$this->um->getParam('user','default_folder')?' selected ':'').
                 ' value='.$childNode->id.'>'.
                 str_repeat('&nbsp;&nbsp;&nbsp;',$level) . $childNode->name,
                 '</option>';
            $this->_buildAddLinkNode($childNode, $level+1);
        }
    }

    function _buildAddLink($params)
    {
?>
        <select class="fldList" name='nid_acl'>
<?php
        foreach ($this->tree->loadRoots($this->um->uid) as $root)
        {
            echo '<option class="'. ($root->hasRight('insert')?'fldList':'noinsert') .'" '.
                 ($root->id==$this->um->getParam('user','default_folder')?' selected ':'').
                 ' value='.$root->id.'>['.$root->name.']</option>';

            // Load just folders
            $this->tree->loadNodes($root, false, 'insert', true);
            $this->_buildAddLinkNode($root, 1);
        }
?>
        </select>
<?php
    }

    /* Retrieve available link information.
     * Currently this only retrieves the
     * favicon.
     */
    function buildRetrieveLinkInformation()
    {
        $this->command = SB_reqVal('origin');
        $execute = 'build'.str_replace(' ','',$this->command);
        $this->getInfo = true;
        $fields = $this->$execute();

        if ($this->hasErrors(E_WARNING) && !$this->hasErrors(E_ERROR))
        {
            $this->showWithErrors = true;
        }

        return $fields;
    }

    function buildAddLink()
    {
        $fields = array();
        $node = null;
        $favicon = '';
        $name = SB_reqVal('name');

        if (SB_reqChk('nid_acl') && SB_reqVal('bookmarklet')!=1)
        {
            $node = $this->tree->getNode(SB_reqVal('nid_acl'));
            $fields['-hidden0-'] = array('name'=>'nid_acl','value'=>$node->id);
            $fields['Parent Folder'] = array('name'=>'parent',
                'value'=>$node->name,'disabled'=>null);
            if (!$node) return null;
        }
        else
        {
            $this->bookmarklet = true;

            if (SB_reqVal('bookmarklet')!=1)
            {
                $cp = SB_reqVal('cp');

                // If we have empty cp or undefined use iso
                if (!strlen($cp) || $cp=='undefined')
                {
                    $cp = "iso-8859-1";
                }

                require_once('./inc/converter.inc.php');
                $c = new SB_Converter($this->um->getParam('config','use_conv_engine'),$cp);
                $name = $c->utf8RawUrlDecode($name);
            }

            if ($this->um->isAnonymous())
            {
                $this->command = 'Log In';
                $fields = $this->buildLogIn();
                $fields['-hidden0-'] = array('name'=>'bookmarklet','value'=>1);
                $fields['-hidden1-'] = array('name'=>'name','value'=>$name);
                $fields['-hidden2-'] = array('name'=>'url','value'=>SB_reqVal('url'));
                $fields['-hidden3-'] = array('name'=>'cp','value'=>SB_reqVal('cp'));
                return $fields;
            }

            $fields['Parent Folder'] = array('type'=>'callback','function'=>'_buildAddLink');
            $fields['Create New Sub Folder'] = array('name'=>'newfolder');
            $fields['Remember as Default'] = array('name'=>'default_folder','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_default_folder'));

            if (strlen($this->um->getParam('user','default_folder')))
            {
                $fields['Remember as Default']['checked'] = null;
            }

            $fields['-hidden0-'] = array('name'=>'bookmarklet','value'=>1);
            $this->nobuttons = true;

            // If we want to get favicon on submit, then do it better now
            // we will get more information.
            if ($this->um->getParam('user','auto_retrieve_favicon'))
            {
                $this->getInfo = true;
            }
        }

        $fields['URL'] =
            array('name'=>'url','value'=>(SB_reqChk('url')?SB_reqVal('url'):$this->um->getParam('user','default_url')));

        if (!$this->getInfo)
        {
            if ($this->um->getParam('config','use_outbound_connection'))
            {
                /* Show the 'Retrieve Info' button only in case it has not been yet
                 * performed
                 */
                $fields['Retrieve Link Information'] = array('type'=>'addbutton');
            }

            $fields['-hidden4-'] = array('name'=>'origin','value'=>$this->command);

            $fields['Link Name'] = array('name'=>'name','value'=>$name,'maxlength'=>255);

            if ($this->um->getParam('user','use_favicons'))
            {
                $fields['Favicon'] = array('name'=>'favicon', 'value'=>$favicon);
            }
        }
        else
        {
            /* Try to get the title and favicon */
            require_once('./inc/pageparser.inc.php');
            $page = new SB_PageParser( SB_reqVal('url', true));
            $page->getInformation(array('CHARSET', 'TITLE', 'FAVURL'));

            $cp = 'iso-8859-1';

            if (isset($page->info['CHARSET']))
            {
                $cp = $page->info['CHARSET'];
            }

            $fields['Link Name'] = array('name'=>'name','maxlength'=>255);

            if (!$name && isset($page->info['TITLE']))
            {
                require_once('./inc/converter.inc.php');
                $c = new SB_Converter($this->um->getParam('config','use_conv_engine'),$cp);
                $name = $c->utf8RawUrlDecode($page->info['TITLE']);
            }

            $fields['Link Name']['value'] = $name;

            if ($this->um->getParam('user','use_favicons'))
            {
                $fields['Favicon'] = array('name'=>'favicon');

                if (isset($page->info['FAVURL']))
                {
                    $favicon = $page->info['FAVURL'];

                    /* Show the retrieved favicon. */
                    $wrong = SB_Skin::imgsrc('link_wrong_favicon');
                    $fields['-raw2-'] = "<div><img class='favicon' alt='' src='$favicon' onerror='this.src=\"$wrong\"'></div>";
                }

                $fields['Favicon']['value'] = $favicon;
            }
        }

        $fields['Description'] = array('name'=>'comment', 'type'=>'textarea');
        $fields['Target'] = array('name'=>'link_target');

        // It is allowed to create private item in others tree
        $fields['Private'] = array('name'=>'private','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_private'));

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $fields['Exclude From Validation'] = array('name'=>'novalidate','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_novalidate'));
        }

        if ($this->hasErrors(E_WARNING) && !$this->hasErrors(E_ERROR))
        {
            $this->showWithErrors = true;
        }

        return $fields;
    }

    function commandAddLink()
    {
        $nid = SB_reqVal('nid_acl',true);
        $node = $this->tree->getNode($nid);
        if (!$node) return;

        if (SB_reqChk('bookmarklet'))
        {
            if (strlen(SB_reqVal('newfolder'))>0)
            {
                $newnode = $this->tree->addNode($nid, SB_reqVal('newfolder'));
                if ($this->hasErrors())
                {
                    return;
                }
                $nid = $newnode;
            }
        }

        // Get values entered by the user
        $url = SB_reqVal('url');
        $favicon = SB_reqVal('favicon');
        $name = SB_reqVal('name');

        // If we have bookmarklet we have already received the icon
        if (!SB_reqChk('bookmarklet') && !$favicon && $this->um->getParam('user','auto_retrieve_favicon'))
        {
            $this->ignoreWarnings();
            require_once('./inc/pageparser.inc.php');
            $page = new SB_PageParser( $url, array('FAVURL'));
            $page->getInformation(array('FAVURL'));
            $this->ignoreWarnings(false);

            if (!$page->isDead && $page->errorCode['FAVURL']<PP_ERR)
            {
                $favicon = $page->info['FAVURL'];
                $fiurl   = './favicon.php?' . md5($favicon) . '=' . SB_reqVal('lid_acl');
                $this->message = SB_T('Favicon <img src="%s"> found at url %s.', array($fiurl, $url));
            }
            else
            {
                $this->message = SB_T('Favicon not found!');
            }
        }

        $insert = array
        (
            'name'=>$name,
            'url'=>$url,
            'favicon'=>$favicon,
            'target'=>SB_reqVal('link_target'),
            'private'=>SB_reqVal('private'),
            'comment'=>SB_reqVal('comment'),
            'validate'=>SB_reqVal('novalidate')?0:1,
        );

        $this->tree->addLink($nid, $insert);

        if (SB_reqChk('bookmarklet'))
        {
            $this->um->setParam('user','default_folder', SB_reqChk('default_folder')?$nid:'');
            $this->um->saveUserParams();
            $this->bookmarklet = true;
            $this->nobuttons = true;
            $this->message =
                SB_T("Link has been added.<p>You must reload your SiteBar in order to see added link!");
        }
    }

/******************************************************************************/

    function buildProperties()
    {
        $fields = array();
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));
        if (!$link) return null;

        $fields['URL'] = array('name'=>'url', 'value'=>$link->url);

        if (!$this->getInfo)
        {
            /* Show the 'Retrieve Info' button only in case it has not been yet
             * performed
             */
            if ($this->command!='Delete Link')
            {
                $fields['Retrieve Link Information'] = array('type'=>'addbutton');
                $fields['-hidden4-'] = array('name'=>'origin','value'=>$this->command);
            }

            $fields['Link Name'] = array('name'=>'name','value'=>$link->name,'maxlength'=>255);

            if ($this->um->getParam('user','use_favicons'))
            {
                $favicon = $link->favicon;

                if (substr($link->favicon,0,7) == 'binary:')
                {
                    require_once('./inc/faviconcache.inc.php');
                    $fc = & SB_FaviconCache::staticInstance();
                    $favicon = 'data:image/x-icon;base64,'.base64_encode($fc->faviconGet($link->favicon, null));
                }

                $fields['Favicon'] = array('name'=>'favicon', 'maxsize'=>32000, 'value'=>$favicon);

                if ($link->favicon)
                {
                    $fields['-raw2-'] = $this->_buildFavicon($link->id, $link->favicon);
                }

            }
        }
        else
        {
            $name = SB_reqVal('name');
            $url = SB_reqVal('url');
            $favicon = SB_reqVal('favicon');

            /* Try to get the title and favicon */
            require_once('./inc/pageparser.inc.php');
            $page = new SB_PageParser( $url );
            $page->getInformation(array('CHARSET', 'TITLE', 'FAVURL'));

            $cp = 'iso-8859-1';

            if ($page->errorCode['CHARSET']<PP_ERR)
            {
                $cp = $page->info['CHARSET'];
            }

            $fields['Link Name'] = array('name'=>'name', 'maxlength'=>255);

            if (!$name && isset($page->info['TITLE']))
            {
                require_once('./inc/converter.inc.php');
                $c = new SB_Converter($this->um->getParam('config','use_conv_engine'),$cp);
                $name = $c->utf8RawUrlDecode($page->info['TITLE']);
            }

            if ($this->um->getParam('user','use_favicons'))
            {
                $fields['Favicon'] = array('name'=>'favicon');

                if (!$favicon && isset($page->info['FAVURL']))
                {
                    $favicon = $page->info['FAVURL'];
                    /* Show the retrieved favicon. */
                    $fields['-raw2-'] = $this->_buildFavicon(SB_reqVal('lid_acl'), $favicon);
                }
            }

            $fields['URL']['value'] = $url;
            $fields['Link Name']['value'] = $name;
            $fields['Favicon']['value'] = $favicon;
        }

        $size = strlen($link->comment);
        $MAXSIZETOEDIT = 4096;

        if ($size<=$MAXSIZETOEDIT)
        {
            $fields['Description'] = array('name'=>'comment',
                'type'=>'textarea','value'=>$link->comment);
        }
        else
        {
            $fields['-raw1-'] = SB_T("Description too long for inplace editing, please use export feature!");
        }
        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>$link->id);

        $fields['Target'] = array('name'=>'link_target', 'value'=>'');

        if ($this->tree->inMyTree($link->id_parent))
        {
            $fields['Private'] = array('name'=>'private','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_private'));
            if ($link->private)
            {
                $fields['Private']['checked'] = null;
            }
        }

        if ($link->is_dead)
        {
            $fields['Dead Link'] = array('name'=>'is_dead_check','type'=>'checkbox','checked'=>null,
                'title'=>SB_P('command::tooltip_is_dead_check'));
            $fields['-hidden2-'] = array('name'=>'is_dead','type'=>'hidden','value'=>1);
        }

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $fields['Exclude From Validation'] = array('name'=>'novalidate','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_novalidate'));
            if (!$link->validate)
            {
                $fields['Exclude From Validation']['checked'] = null;
            }
        }

        if ($this->command!='Delete Link')
        {
            if (($this->um->getParam('config','comment_impex') && strlen($link->comment)>0)
            ||  strlen($link->comment)>=$MAXSIZETOEDIT)
            {
                $fields['Export Description'] = array('name'=>'command','type'=>'addbutton');
            }

            if ($this->um->getParam('config','comment_impex'))
            {
                $fields['Import Description'] = array('name'=>'command','type'=>'addbutton');
            }
        }

        return $fields;
    }

    function commandProperties()
    {
        if (SB_reqVal('private'))
        {
            $link = $this->tree->getLink(SB_reqVal('lid_acl'));
            if (!$link) return;
            if (!$this->tree->inMyTree($link->id_parent))
            {
                $this->um->accessDenied();
                return;
            }
        }

        $limit = $this->um->getParam('config','comment_limit');

        if ($limit && $limit<strlen(SB_reqVal('comment')))
        {
            $this->error('The description length exceeds maximum length of %s bytes!', array($limit));
            return;
        }

        $favicon = SB_reqVal('favicon');

        if ($this->um->getParam('config','use_favicon_cache'))
        {
            require_once('./inc/faviconcache.inc.php');
            $fc = & SB_FaviconCache::staticInstance();

            if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $favicon, $reg))
            {
                $favicon = $fc->saveFaviconBase64($reg[2]);
            }
            else
            {
                // Delete old URL favicon from cache on update to allow new version
                $fc->purge(SB_reqVal('lid_acl'));
            }
        }

        $update = array
        (
            'name'=>SB_reqVal('name'),
            'url'=>SB_reqVal('url'),
            'favicon'=>$favicon,
            'target'=>SB_reqVal('link_target'),
            'private'=>SB_reqVal('private')?1:0,
            'comment'=>SB_reqVal('comment'),
            'validate'=>SB_reqVal('novalidate')?0:1,
        );

        if (SB_reqVal('is_dead') && !SB_reqVal('is_dead_check'))
        {
            $update['is_dead'] = 0;
        }

        $this->tree->updateLink(SB_reqVal('lid_acl', true), $update);
    }

    function buildExportDescription()
    {
        $fields['Decode Using'] = array('type'=>'callback', 'function'=>'_buildDecodeUsing');
        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>SB_reqVal('lid_acl'));

        return $fields;
    }

    function _buildDecodeUsing($params)
    {
?>
        <div class='label'>Decode Using</div>
        <input value='base64' type='radio' name='type' checked>MIME Base64<br>
        <input value='text' type='radio' name='type'>No decoding<br>
<?php
    }

    function commandExportDescription()
    {
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));
        if (!strlen($link->comment))
        {
            $this->error('Cannot export empty description!');
        }

        if ($this->hasErrors())
        {
            return;
        }

        switch (SB_reqVal('type'))
        {
            case 'base64':
                header('Content-type: application/octet-stream');
                header('Content-disposition: attachment; filename="' . $link->name . '"');
                header('Content-transfer-encoding: binary');
                echo base64_decode($link->comment);
                break;

            case 'text':
                header('Content-type: text/plain');
                header('Content-disposition: attachment; filename="' . $link->name . '"');
                header('Content-transfer-encoding: binary');
                echo $link->comment;
                break;
        }

        exit; // Really break program here
    }

    function buildImportDescription()
    {
        $fields['Description File'] = array('type'=>'file','name'=>'file');
        $fields['Encode Using'] = array('type'=>'callback', 'function'=>'_buildEncodeUsing');
        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>SB_reqVal('lid_acl'));
        return $fields;
    }

    function _buildEncodeUsing($params)
    {
?>
        <div class='label'>Encode Using</div>
        <input value='base64' type='radio' name='type' checked>MIME Base64<br>
        <input value='text' type='radio' name='type'>No encoding<br>
<?php
    }

    function commandImportDescription()
    {
        if (!$this->checkFile('file'))
        {
            return;
        }
        $filename = $_FILES['file']['tmp_name'];
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));

        if ($this->hasErrors())
        {
            return;
        }

        $limit = $this->um->getParam('config','comment_limit');

        if ($limit && $limit<filesize($filename))
        {
            $this->error('The description length exceeds maximum length of %s bytes!', array($limit));
            return;
        }

        $size = filesize($filename);
        $handle = fopen($filename, 'rb');
        $file_content = fread($handle,$size);
        fclose($handle);

        // File might not exist when closed
        $this->useHandler(false);
        @unlink($filename);
        $this->useHandler(true);

        $comment = '';

        switch (SB_reqVal('type'))
        {
            case 'base64':
                $comment = base64_encode($file_content);
                break;

            case 'text':
                $comment = $file_content;
                break;
        }

        $this->tree->updateLink($link->id, array( 'comment'=>$comment ));
    }

/******************************************************************************/

    function buildDeleteLink()
    {
        $fields = $this->buildProperties();

        foreach ($fields as $name => $value)
        {
            if (isset($fields[$name]['type']) && $fields[$name]['type']=='hidden')
            {
                continue;
            }

            if (isset($fields[$name]['name']) && !strstr($name,'-raw'))
            {
                $fields[$name]['disabled'] = null;
            }
        }

        return $fields;
    }

    function commandDeleteLink()
    {
        $link = $this->tree->getLink(SB_reqVal('lid_acl'));

        if (!$link)
        {
            return;
        }

        $this->tree->removeLink($link->id);
        $node = $this->tree->getNode($link->id_parent);

        if (!$node)
        {
            return;
        }

        if (!$this->um->getParam('user','use_trash') && $node->hasRight('purge'))
        {
            $this->tree->purgeNode($link->id_parent);
        }
    }

/******************************************************************************/

    function buildSecurity()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));

        $fields['Folder Name'] = array('name'=>'name','value'=>$node->name,'disabled'=>null);
        $fields['Security'] = array('type'=>'callback',
            'function'=>'_buildSecurityList', 'params'=>array('node'=>$node));
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);
        return $fields;
    }

    function _buildSecurityList($params)
    {
        $groups = $this->um->getGroups();
        // We may display a subset here
        $myGroups = $this->um->getUserGroups();
        $node = $params['node'];
?>
    <table cellpadding='0'>
        <tr>
            <th class='group'><?php echo SB_T('Group')?></th>
            <th class='right'><?php echo SB_T('R')?></th>
            <th class='right'><?php echo SB_T('A')?></th>
            <th class='right'><?php echo SB_T('M')?></th>
            <th class='right'><?php echo SB_T('D')?></th>
            <th class='right'><?php echo SB_T('P')?></th>
            <th class='right'><?php echo SB_T('G')?></th>
        </tr>
<?php
        foreach ($groups as $gid => $rec)
        {
            if ($this->um->isHiddenGroup($rec, $this->command))
            {
                continue;
            }

            $acl = $node->getGroupACL($gid);
            $parentACL = $node->getParentACL($gid);
            $isMyGroup = isset($myGroups[$gid]) || $this->um->canJoinGroup($rec);
            $isModerator = isset($myGroups[$gid]) && isset($myGroups[$gid]) && $myGroups[$gid]['moderator'];

            if (!$acl)
            {
                $acl = $parentACL;
            }

            $aclSum = 0;
            foreach ($this->tree->rights as $right)
            {
                $aclSum += $acl['allow_'.$right];
            }

            if (!$isMyGroup // It is not my group and I cannot join it freely
            &&  !($node->hasRight('grant') && $aclSum)) // I cannot modify it
            {
                continue;
            }

            $sumChange = 0;
            $sumDiff = 0;

            // Check whether we have direct right or right thanks to the
            // fact that some right is enabled and we are moderator of
            // the group.
            foreach ($this->tree->rights as $right)
            {
                $value = $acl && $acl['allow_'.$right];
                $canChange = $node->hasRight('grant') || ($value && $isModerator);

                if ($canChange)
                {
                    $sumChange++;
                }

                // Count differences between parent and this ACL.
                if (($parentACL && $parentACL['allow_'.$right] != $value)
                ||  ($acl && !$parentACL)
                ||  (!$acl && $parentACL))
                {
                    $sumDiff++;
                }
            }

            // We cannot change and there is no right set on this node for this group.
            // Therefore we do not show it.
            if (!$sumChange && !$sumDiff)
            {
                continue;
            }
?>
        <tr class='group'>
            <td rowspan='2' class='group'><?php echo $rec['name']?></td>
<?php
            foreach ($this->tree->rights as $right)
            {
?>
            <td class='right'>
                <input type='checkbox' disabled <?php echo $parentACL && $parentACL['allow_'.$right]?'checked':''?>>
            </td>
<?php
            }
?>
        </tr><tr>
<?php
            foreach ($this->tree->rights as $right)
            {
                $value = $acl && $acl['allow_'.$right];
                $canChange = ($node->hasRight('grant') && ($isMyGroup||$value))
                    || ($value && $isModerator);
?>
            <td class='right'>
                <input type='checkbox' value='1' <?php echo $canChange?'':'disabled'?>
                    name='<?php echo $right.'_'.$gid?>' <?php echo $value?'checked':''?>>
            </td>
<?php
            }
?>
        </tr>
<?php
        }
?>
    </table>
    <div class='legend'><?php echo SB_P('command::security_legend')?></div>
<?php
    }

    function commandSecurity()
    {
        $groups = $this->um->getGroups();
        $myGroups = $this->um->getUserGroups();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));
        $sameACL = true;
        $updated = 0;

        foreach ($groups as $gid => $rec)
        {
            $isMyGroup = isset($myGroups[$gid]) || $this->um->canJoinGroup($rec);
            $isModerator = isset($myGroups[$gid]) && $myGroups[$gid]['moderator'];

            if (!$node->hasRight('grant')  // We have no grant right to node
            &&  !$isModerator)             // And we are not moderator
            {
                continue;
            }

            $parentACL = $node->getParentACL($gid);
            $oldacl = $node->getGroupACL($gid);
            $newacl = array();
            $newsum = 0;
            $same = true;

            foreach ($this->tree->rights as $right)
            {
                $name = $right.'_'.$gid;
                $value = SB_reqVal($name)?1:0;
                $parentValue = $parentACL?$parentACL['allow_'.$right]:0;
                $same = $same && $value==$parentValue;
                $newacl['allow_'.$right] = $value?1:0;
                $newsum += $value;
            }

            // We had right on the node before and we do not have right
            // to grant right but have right to remove it then check
            // that we are not cheating.
            if ($oldacl && (!$node->hasRight('grant') || !$isMyGroup))
            {
                foreach ($this->tree->rights as $right)
                {
                    if ($newacl['allow_'.$right]>$oldacl['allow_'.$right])
                    {
                        $this->um->accessDenied();
                        return;
                    }
                }
            }

            // Remove empty acl
            if (!$newsum && $same)
            {
                $node->removeACL($gid);
            }
            else
            {
                $node->updateACL($gid, $newacl);
            }

            $updated++;
            $sameACL = $sameACL && $same;
        }

        // If complete group ACL is the same as parent then we can remove it
        if ($updated && $sameACL)
        {
            $node->removeACL();
        }
    }

/******************************************************************************/

    function buildValidateLinks()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));
        if (!$node) return null;

        $fields['Folder Name'] = array('name'=>'name','maxlength'=>255,
            'disabled'=>null, 'value'=>$node->name);
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);
        $fields['Include Subfolders'] = array('name'=>'subfolders', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_subfolders'));
        $fields['Ignore Recently Tested'] = array('name'=>'ignore_recently', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_ignore_recently'));
        $fields['Recent Time Expressed in Seconds'] = array('name'=>'recent_time', 'value'=>60*60);

        if ($this->um->getParam('user', 'use_favicons'))
        {
            $fields['Discover Missing Favicons'] = array('name'=>'discover_favicons', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_discover_favicons'));

            if ($this->um->getParam('config', 'use_favicon_cache'))
            {
                $fields['Delete Invalid Favicons'] = array('name'=>'delete_favicons', 'type'=>'checkbox', 'checked'=>null,
                    'title'=>SB_P('command::tooltip_delete_favicons'));
            }
        }

        return $fields;
    }

    function commandValidateLinks()
    {
        $this->forwardCommand('Validation');
    }

    function buildValidation()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));
        if (!$node) return null;

        require_once('./inc/validator.inc.php');
        $validator = new SB_Validator();

        if (SB_reqVal('ignore_recently'))
        {
            $this->tree->loadLinkFilter =
                'UNIX_TIMESTAMP(tested) < ' . (mktime() - SB_reqVal('recent_time'));
        }

        if (SB_reqVal('subfolders'))
        {
            $this->tree->loadNodes($node);
        }
        else
        {
            $this->tree->loadLinks($node);
        }

        $validator->buildValidate($node, $fields,
            SB_reqVal('discover_favicons'),
            SB_reqVal('delete_favicons'));

        if (!$validator->linkCount)
        {
            if (SB_reqVal('ignore_recently'))
            {
                $this->warn('All links recently validated!');
            }
            else
            {
                $this->warn('No links in the folder!');
            }
        }

        return $fields;
    }

/******************************************************************************/

    function buildImportBookmarks()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqVal('nid_acl',true));

        $loaders['auto'] = array('', true);
        $dirName = './inc/loaders';
        $dir = opendir($dirName);

        require_once('./inc/loader.inc.php');

        while (($fileName = readdir($dir)) !== false)
        {
            if (preg_match('/(\w+)\.inc\.php/i', $fileName, $reg))
            {
                $name = $reg[1];

                require_once($dirName.'/'.$fileName);

                $loaders[$name] = array(SB_safeVal($SB_loader_title,$name),false);
            }
        }
        closedir($dir);
        asort($loaders);
        $loaders['auto'][0] = 'Auto detection';

        $fields['Target Folder Name'] = array('value'=>$node->name,'disabled'=>null);
        $fields['Bookmark File'] = array('type'=>'file','name'=>'file');
        $fields['Select Input Format'] = array('name'=>'loader','type'=>'callback',
            'function'=>'_buildFeedBuildList',
            'params'=>array('name'=>'loader', 'title'=>'Select Input Format','values'=>$loaders));

        if (SB_Page::isMSIE())
        {
            $fields['-raw1-'] = SB_P('command::import_bk_ie_hint') . '<br>';
        }

        $fields['Rename Duplicate Links'] = array('name'=>'rename', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_rename'));
        $fields['Codepage'] = array('type'=>'callback', 'function'=>'_buildCodepage');
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);


/* Does not work in Windows XP SP2 anymore
        if (SB_Page::isMSIE())
        {
            $fields['-raw2-'] = SB_P('command::import_bk');
        }
*/
        return $fields;
    }

    function _buildCodepage()
    {
        if (!$this->um->getParam('config','use_conv_engine'))
        {
            return;
        }

        require_once('./inc/converter.inc.php');

        $cnv = new SB_Converter();

        function _cmdlangCmp(&$a, $b)
        {
            return (strcmp($a[1], $b[1]));
        }

        uasort($cnv->languages, '_cmdlangCmp');
        reset($cnv->languages);
?>
    <div class='label'><?php echo SB_T('Codepage')?></div>
    <select class="language" name="cp">
<?php
        echo "\t\t" . '<option value="utf-8">'. SB_T('Default (%s)', 'utf-8') . '</option>' . "\n";


        foreach ($cnv->languages as $key => $value)
        {
            if ($cnv->getEngine()==SB_CHARSET_IGNORE && !($value[2] == 'iso-8859-1'))
            {
                continue;
            }

            $lang_name = ucfirst(substr(strstr($value[0], '|'), 1));
            echo "\t\t" . '<option value="' . $value[2] . '">' .
                $lang_name .' (' . $key . ')</option>' . "\n";
        }
?>
    </select>
<?php

        if ($cnv->getEngine()==SB_CHARSET_IGNORE)
        {
            echo SB_P('command::noiconv');
        }
    }

    function commandImportBookmarks()
    {
        require_once('./inc/loader.inc.php');

        if (!$this->checkFile('file'))
        {
            return;
        }

        $filename = $_FILES['file']['tmp_name'];

        $bm = new SB_Loader($this->um->getParam('config','use_conv_engine'),SB_reqVal('cp'));
        $type = SB_reqVal('loader');
        $bm->loadFile($filename, ($type=='auto'?null:$type));

        // If not loaded message will be recorded and we go out
        if (!$bm->success)
        {
            return;
        }

        $this->message = SB_T(
            'Imported %s link(s) into %s folder(s) from the bookmark file.',
            array($bm->importedLinks, $bm->importedFolders));

        $this->tree->importTree(SB_reqVal('nid_acl'), $bm->root, SB_reqChk('rename'));
    }

    function buildExportBookmarks()
    {
        $fields = array();

        $writers = array();
        $dirName = './inc/writers';
        $dir = opendir($dirName);

        require_once('./inc/writer.inc.php');

        while (($fileName = readdir($dir)) !== false)
        {
            if (preg_match('/(\w+)\.inc\.php/i', $fileName, $reg))
            {
                $name = $reg[1];

                require_once($dirName.'/'.$fileName);

                if (!SB_safeVal($SB_writer_hidden,$name))
                {
                    $writers[$name] = array(SB_safeVal($SB_writer_title,$name),SB_safeVal($SB_writer_default,$name));
                }
            }
        }
        closedir($dir);

        asort($writers);

        $fields['Select Output Format'] = array('name'=>'writer','type'=>'callback',
            'function'=>'_buildFeedBuildList',
            'params'=>array('name'=>'w', 'title'=>SB_T('Select Output Format'),'values'=>$writers));

        if (SB_Page::isMSIE())
        {
            $fields['-raw1-'] = SB_P('command::export_bk_ie_hint') . '<br>';
        }

        $fields['Codepage'] = array('type'=>'callback', 'function'=>'_buildCodepage');

        $fields['Sort Mode'] = array('name'=>'sort','type'=>'select',
                '_options'=>'_buildFolderSortMode', '_select'=>'custom');

        $fields['Order of Folders v. Links'] = array('name'=>'mix','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam('user','mix_mode'));

        $fields['Limit Number of Links'] = array('name'=>'max');
        $fields['Limit Description Length'] = array('name'=>'len');

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $fields['Use Hit Counter'] = array('name'=>'hits', 'type'=>'checkbox',
                'title'=>SB_P('command::tooltip_hits'));
        }

        $fields['Exclude Root Folder'] = array('name'=>'exr', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_exclude_root'));
        $fields['Ignore Private Links'] = array('name'=>'igp', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_private'));
        $fields['Include Subfolders'] = array('name'=>'sd', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_subdir'));
        $fields['Flatten the Hierarchy'] = array('name'=>'flat', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_flat'));

        if (!SB_reqChk('doall'))
        {
            $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>SB_reqVal('nid_acl'));
        }
        else
        {
            $fields['-hidden1-'] = array('name'=>'doall','value'=>1);
        }

        $fields['Add SiteBar Commands'] = array('name'=>'cmd', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_cmd'));

/* Does not work in Windows XP SP2 anymore
        if (SB_Page::isMSIE())
        {
            $fields['-raw2-'] = SB_P('command::export_bk') . '<br>';
        }
*/

        $fields['Download Bookmarks'] = array('type'=>'button');

        $fields['E-Mail'] = array('name'=>'email');
        $fields['Password (visible to others)'] = array('name'=>'pass');
        $fields['Show Feed URL'] = array('type'=>'button');

        if (!count($writers))
        {
            $this->error("No feed available!");
        }

        return $fields;
    }

    function _buildExportUrl()
    {
        $url = SB_Page::baseurl() . '/index.php';
        $params = array();

        if (!SB_reqChk('sd'))
        {
            $params[] = 'sd=0';
        }

        if (!SB_reqChk('hits') && $this->um->getParam('config','use_hit_counter'))
        {
            $params[] = 'hits=0';
        }

        // Add value
        foreach (array('w', 'sort', 'email', 'pass', 'max', 'len', 'cmd', 'exr', 'igp', 'flat', 'cp', 'mix') as $check)
        {
            if (SB_reqChk($check) && strlen(SB_reqVal($check)))
            {
                if ($check == 'w' && SB_reqVal($check) == 'sitebar') continue;
                if ($check == 'sort' && SB_reqVal($check) == 'custom') continue;
                if ($check == 'cp' && SB_reqVal($check) == 'utf-8') continue;
                $params[] = $check.'='.SB_reqVal($check);
            }
        }

        if (SB_reqChk('nid_acl') && SB_reqVal('nid_acl')>0)
        {
            $params[] = 'root=' . SB_reqVal('nid_acl');
        }

        if (count($params))
        {
            $url .= '?' . implode('&amp;', $params);
        }

        return $url;
    }

    function buildDownloadBookmarks()
    {
        $url = str_replace('&amp;', '&', $this->_buildExportUrl()) . '&mode=download';
        header('Location: ' .  $url);
        exit; // Really break program here
    }

    function buildShowFeedURL()
    {
        $fields = array();

        $url = $this->_buildExportUrl();

        $fields['Copy'] = array('name'=>'copy', 'value'=>$url);
        $fields['-label1-'] = SB_T('Open in New Window');
        $fields['-raw1-'] = "<a href='$url' target='_blank'>$url</a>";

        $url .= '&amp;mode=plain';

        $fields['-label2-'] = SB_T('Open as Plain Text');
        $fields['-raw2-'] = "<a href='$url' target='_blank'>$url</a>";

        if (!SB_reqChk('doall'))
        {
            $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>SB_reqVal('nid_acl'));
        }
        else
        {
            $fields['-hidden1-'] = array('name'=>'doall','value'=>1);
        }

        $fields['Export Bookmarks'] = array('type'=>'button');

        return $fields;
    }

    function _buildFeedBuildList($params)
    {
    ?>
        <div class="label"><?php echo SB_T($params['title'])?></div>
        <div class="data">
            <select name='<?php echo SB_T($params['name'])?>'>
    <?php
            foreach ($params['values'] as $name => $label)
            {
                echo '<option value="' . $name . '" '. ($label[1]?'selected':'').'>' . SB_T($label[0]) . "</option>\n";
            }
    ?>
            </select>
        </div>
    <?php
    }

}

/******************************************************************************/
/******************************************************************************/
/******************************************************************************/

$cw = new CommandWindow();
SB_Skin::set($cw->um->getParam('user','skin'));

// On error no reloading and no closing
if ($cw->hasErrors())
{
    $cw->reload = false;
    $cw->close = false;
}

$isIIS = strstr($_SERVER['SERVER_SOFTWARE'],'IIS');
$metaClose = false;
$metaTag = null;

if ($cw->close && $isIIS && in_array($cw->command, $cw->um->inPlaceCommands()))
{
    $metaClose = true;
    $metaTag =
        '<meta http-equiv="refresh" content="0;url=index.php'.
        $cw->getParams()."\">\n";
}

// On command success when auto close is required and we do not use IIS with
// in place commands.
if ($cw->close && !$cw->fields && !$metaClose)
{
    // When in place just reload
    if ($cw->inPlace())
    {
        header('Location: index.php'.$cw->getParams(false));
        exit;
    }
    // When not in place then close
    else
    {
        $cw->onLoad = 'window.close()';
    }
}

/**
 * I do not need instance, I just need to call static functions.
 * As of PHP 4.3.1 it will generate strange warning in case
 * bookmarkmanager issued an error() on import(). I cannot see
 * any relevance because SB_Page does not inherit from SB_ErrorHandler.
 * But it is indeed related to SB_ErrorHandler (when removing & from
 * declaration of getErrors() it works, but errors cannot be
 * reported then. Too curious for reporting and PHP 5 adds
 * static members what should solve the problem in future.
 */
$page = new SB_Page();
$page->head('Commander', 'cmdWin', null, $cw->onLoad, $metaTag);

$errId = ($cw->hasErrors() && $cw->hasErrors(E_ERROR))?'error':'warn';

?>

<div id="<?php echo ($cw->hasErrors()?$errId:'command').'Head'?>" class='cmnTitle'><?php echo SB_T($cw->command)?></div>
<div id="<?php echo ($cw->hasErrors()?$errId:'command').'Body'?>">
<?php
    if ($cw->hasErrors())
    {
        $cw->writeErrors(false);
        echo "<p>";
    }

    // If we have no errors or ignore them
    if (!$cw->hasErrors() || $cw->showWithErrors || $cw->hasHandledErrors()==$cw->hasErrors())
    {
        if ($cw->fields)
        {
            $noerrors = !$cw->hasErrors();

            $cw->writeForm();

            // Some late errors?
            if ($noerrors && $cw->hasErrors())
            {
                $cw->writeErrors(false);
            }
        }
        else
        {
            echo (strlen($cw->message)?$cw->message:SB_T('Successful execution!'));
        }
    }

    if ($cw->inPlace()) : ?>
    <div class='buttons'>
        <input class='button' type='button' onclick="SB_reloadPage(true)" value='<?php echo SB_T('Return')?>'>
    </div>
<?php
    endif;
?>
</div>
<?php
    if (!$cw->nobuttons) : ?>
<div id='foot'>
<?php   if (!$cw->inPlace()) : ?>
<?php       if (!$cw->bookmarklet) : ?>
    [<a href="javascript:window.opener.location.reload();window.close()"><?php echo SB_T('Reload SiteBar')?></a>]
<?php       endif; ?>
    [<a href="javascript:window.close()"><?php echo SB_T('Close')?></a>]
<?php   endif; ?>
</div>
<?php
    endif;
$page->foot();
?>
