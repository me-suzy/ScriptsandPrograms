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

require_once('./inc/database.inc.php');
require_once('./inc/errorhandler.inc.php');

define ('SB_ADMIN',  1);
define ('SB_ANONYM', 2);

class SB_UserManager extends SB_ErrorHandler
{
    var $user = null;

    var $config;
    var $useCookies = true;
    var $setupDone;
    var $db;
    var $pmode; // personal mode
    var $plugins = array(); // plugin cache
    var $pluginPaths = array();

    var $uid;
    var $name;
    var $email;
    var $comment;
    var $verified;
    var $approved;
    var $demo;
    var $params = array('config'=>array(),'user'=>array());
    var $hiddenFolders = array();

    function SB_UserManager()
    {
        $this->db =& SB_Database::staticInstance();

        /* Read SiteBar configuration - must be the first step ! */
        if ($this->db->hasTable('sitebar_config'))
        {
            $rset = $this->db->select(null, 'sitebar_config');
            $this->config = $this->db->fetchRecord($rset);
        }
        else
        {
            $this->config['release'] = '';
        }

        if ($this->db->currentRelease() != $this->config['release'])
        {
            header('Location: config.php');
            exit;
        }

        $this->explodeParams($this->config['params'],'config');

        if (strlen($this->getParamB64('config','baseurl')))
        {
            require_once('./inc/page.inc.php');
            SB_Page::baseurl($this->getParamB64('config','baseurl'));
        }

        $this->pmode = $this->getParam('config','personal_mode');

        $this->loadPlugins();

        /* Check whether Admin has password if not we will run setup */
        $rset = $this->db->select(null, 'sitebar_user',
            array( 'uid'=> SB_ADMIN, '^1'=> 'AND', 'pass'=>null));

        $this->setupDone = ($this->db->fetchRecord($rset)===false);

        $anonym = $this->getUser(SB_ANONYM);
        $this->explodeParams($anonym['params'],'default');

        if (!$this->isLogged())
        {
            if (!$anonym)
            {
                $this->error('Database corrupted - missing anonymous account!');
            }
            else
            {
                $this->initUser($anonym);
                unset($this->user['pass']); // Security
            }
        }

        $lang = $this->getParam('user','lang');

        if (!$lang)
        {
            $l =& SB_Localizer::staticInstance();
            $browserLang = $l->getBrowserLang();
            if (!$this->getParam('config','lang'))
            {
                $this->setParam('config','lang',$l->langDefault);
            }
            $lang = $browserLang?$browserLang:$this->getParam('config','lang');
            $this->setParam('user','lang',$lang);
        }

        // Set our language
        SB_SetLanguage($lang);

        // Check if we have plugin that changes rights
        foreach ($this->plugins as $plugin)
        {
            $execute = $plugin['prefix'].'Init';
            if (function_exists($execute))
            {
                $execute($this);
            }
        }
    }

    function statistics(&$data)
    {
        $rset = $this->db->select('count(*) count', 'sitebar_user');
        $rec = $this->db->fetchRecord($rset);
        $data['users'] = $rec['count'];
        $rset = $this->db->select('count(*) count', 'sitebar_group');
        $rec = $this->db->fetchRecord($rset);
        $data['groups'] = $rec['count'];
    }

    function & staticInstance()
    {
        static $um;

        if (!$um)
        {
            // Here we give chance to the plugins to change any aspect of this
            // class, be creating an ascendant class.

            $count = 0;
            $dirname = "./plugins";
            $classes = '';

            if (is_dir($dirname) && ($dir = opendir($dirname)))
            {
                while (($plugin = readdir($dir)) !== false)
                {
                    $plugdir = $dirname.'/'.$plugin;
                    $umclass = $plugdir.'/usermanager.inc.php';

                    if (!is_dir($plugdir) || !is_file($umclass))
                    {
                        continue;
                    }

                    $fp = fopen($umclass, "r");

                    if (!$fp)
                    {
                        die("Cannot open existing file $umclass!");
                    }

                    $count++;

                    $skip = 1;
                    while ( !feof($fp) )
                    {
                        $buffer = fgets($fp, 4096);
                        if (strpos($buffer, 'class')===0)
                        {
                            # Eat {
                            fgets($fp, 4096);
                            $skip = 0;
                            $sub = "SB_UserManager$count";
                            $sup = ($count>1?'SB_UserManager'.($count-1):'SB_UserManager');
                            $classes .= "class $sub extends $sup\n{\n";
                            $classes .= "    function $sub() { \$this->$sup(); }\n";
                            continue;
                        }

                        if ($skip)
                        {
                            continue;
                        }

                        $classes .= $buffer;

                    }
                    fclose($fp);
                }
                closedir($dir);
            }

            if ($count)
            {
                // echo("<pre>$classes</pre>");
                eval($classes);
                eval("\$um = new SB_UserManager$count();");
            }
            else
            {
                $um = new SB_UserManager();
            }
        }

        return $um;
    }

    function initUser(&$rec)
    {
        $this->user = $rec;
        $this->uid = $rec['uid'];
        $this->email = $rec['email'];
        $this->name = SB_safeVal($rec,'name');
        $this->comment = SB_safeVal($rec,'comment');
        $this->verified = $rec['verified'];
        $this->approved = $rec['approved'];
        $this->demo = $rec['demo'];
        $this->explodeParams($rec['params'],'user');

        if ($this->getParam('user','use_hiding') && $this->getParam('user','hidden_folders'))
        {
            $ids = explode(':',$this->getParam('user','hidden_folders'));
            $this->hiddenFolders = array();
            foreach ($ids as $id)
            {
                $this->hiddenFolders[$id] = 1;
            }
        }
    }

    function setCookie($name, $value='', $expires=null)
    {
        if (!$this->useCookies)
        {
            return;
        }

        if ($expires===null)
        {
            // Default expiration 7 days
            $expires = time()+60*60*24*7;
        }

        if (!$value)
        {
            // Remove now
            $expires = time()-60*60;
        }

        setcookie($name, $value, $expires);
        $_COOKIE[$name] = $value;
    }

    function explodeParams(&$params, $prefix)
    {
        $default = array();

        switch ($prefix)
        {
            case 'config':
                $default['auth']='';
                $default['allow_contact']=1;
                $default['allow_sign_up']=1;
                $default['allow_user_groups']=0;
                $default['allow_user_trees']=1;
                $default['allow_user_tree_deletion']=1;
                $default['allow_anonymous_export']=1;
                $default['max_session_time']=60*60*24*365; // 1 year
                $default['default_domain']='';
                $default['comment_impex']=0;
                $default['comment_limit']=1024;
                $default['integrator_url']=base64_encode('http://my.sitebar.org/integrator.php');
                $default['max_icon_age']=30;
                $default['max_icon_cache']=1000;
                $default['max_icon_size']=20000;
                $default['max_icon_user']=100;
                $default['filter_users_limit']=30;
                $default['filter_groups_limit']=10;
                $default['personal_mode']=0;
                $default['search_engine_url']= base64_encode('http://www.google.com/search'.
                        '?q=%SEARCH%'.
                        '&sourceid=sitebar-search'.
                        '&start=0'.
                        '&ie=utf-8'.
                        '&oe=utf-8');
                $default['search_engine_ico']= base64_encode('http://www.google.com/favicon.ico');
                $default['allow_custom_search_engine']=1;
                $default['sender_email']='';
                $default['show_logo']=1;
                $default['show_statistics']=1;
                $default['skin']='Modern';
                $default['use_compression']=1;
                $default['use_conv_engine']=1;
                $default['use_favicon_cache']=1;
                $default['use_hit_counter']=1;
                $default['use_mail_features']=1;
                $default['use_outbound_connection']=1;
                $default['users_must_verify_email']=0;
                $default['users_must_be_approved']=0;
                break;

            case 'user':
                $default = $this->params['default'];
                break;

            case 'default':
            case 'tmp':
            default:
                $default['allow_given_membership']=1;
                $default['allow_info_mails']=1;
                $default['auto_close']=1;
                $default['auto_retrieve_favicon']=1;
                $default['default_folder']='';
                $default['default_search']='name';
                $default['default_url']='http://';
                $default['extern_commander']=0;
                $default['hidden_folders']='';
                $default['hide_xslt']=0;
                $default['private_over_ssl_only']=0;
                $default['link_sort_mode']='abc';
                $default['load_open_nodes_only']=1;
                $default['menu_icon']=0;
                $default['mix_mode']='nodes';
                $default['paste_mode']='ask';
                $default['show_acl']=1;
                $default['use_search_engine']=1;
                $default['use_search_engine_iframe']=1;
                $default['use_favicons']=1;
                $default['use_hiding']=1;
                $default['use_tooltips']=1;
                $default['use_trash']=1;
                break;
        }

        // Clear old values
        $this->params[$prefix] = $default;

        // If we have some params then explode them
        if ($params)
        {
            foreach (explode(';',$params) as $param)
            {
                $pair = explode('=',$param);
                $key = array_shift($pair);
                $value = array_shift($pair);
                $this->setParam($prefix,$key,$value);
            }
        }

        switch ($prefix)
        {
            case 'config':
                if (!strlen($this->getParam('config','sender_email')))
                {
                    $admin = $this->getUser(SB_ADMIN);
                    if ($admin['email']!='Admin')
                    {
                        $this->setParam('config', 'sender_email', $admin['email']);
                    }
                }

                if (!$this->getParam('config', 'use_outbound_connection'))
                {
                    $this->setParam('config', 'use_favicon_cache', 0);
                }
                if ($this->getParam('config', 'auth'))
                {
                    $this->setParam('config', 'allow_sign_up', 0);
                }
                if (!$this->getParam('config', 'use_mail_features'))
                {
                    $this->setParam('config', 'users_must_verify_email', 0);
                }
                break;

            case 'user':
                if (!$this->getParam('config','use_hit_counter'))
                {
                    if (!in_array($this->getParam('user','link_sort_mode'),array('abc','added')))
                    {
                        $this->setParam('user', 'link_sort_mode', 'abc');
                    }
                }

                if ($this->getParam('user', 'link_sort_mode')=='visit')
                {
                    $this->setParam('user', 'link_sort_mode', 'waiting');
                }

                if (!$this->getParam('config', 'use_outbound_connection') ||
                    !$this->getParam('user', 'use_favicons'))
                {
                    $this->setParam('user', 'auto_retrieve_favicon', 0);
                }

                if (!$this->getParam('config', 'allow_custom_search_engine'))
                {
                    $this->setParam('user', 'search_engine_url', $this->getParam('config','search_engine_url'));
                    $this->setParam('user', 'search_engine_ico', $this->getParam('config','search_engine_ico'));
                }

                if ($this->getParam('user', 'search_engine_url')=='')
                {
                    $this->setParam('user', 'search_engine_url', $this->getParam('config','search_engine_url'));
                    $this->setParam('user', 'search_engine_ico', $this->getParam('config','search_engine_ico'));
                }

                if ($this->isAnonymous() && isset($_COOKIE['SB3SETTINGS']))
                {
                    foreach (explode(';', $_COOKIE['SB3SETTINGS']) as $param)
                    {
                        list($key,$value) = explode('=',$param);
                        $this->setParam('user', $key, $value);
                    }
                }
                break;
        }
    }

    function implodeParams($prefix)
    {
        $params = array();
        foreach ($this->params[$prefix] as $name => $value)
        {
            $params[] = $name.'='.$value;
        }
        return implode(';',$params);
    }

    function getParam($prefix, $name, $default=null)
    {
        return isset($this->params[$prefix][$name])
            ?$this->params[$prefix][$name]:$default;
    }

    function getParamB64($prefix, $name, $default=null)
    {
        return isset($this->params[$prefix][$name])
            ?base64_decode($this->params[$prefix][$name]):$default;
    }

    function getParamCheck($prefix, $name)
    {
        return $this->getParam($prefix,$name)?null:'';
    }

    function setParam($prefix, $name, $value)
    {
        $this->params[$prefix][$name] = $value;
    }

    function setParamB64($prefix, $name, $value)
    {
        $this->params[$prefix][$name] = base64_encode($value);
    }

    function isAnonymous()
    {
        return $this->uid == SB_ANONYM;
    }

    function isAdmin()
    {
        if (!$this->user)        return false;
        if ($this->uid == SB_ADMIN) return true;

        static $isAdmin = null;

        if ($isAdmin === null)
        {
            $rset = $this->db->select('g.gid',
                'sitebar_group g natural join sitebar_member m',
                array('uid'=>$this->uid, '^1'=> 'AND',
                    'g.gid'=> $this->config['gid_admins']));

            $rec = $this->db->fetchRecord($rset);
            $isAdmin = is_array($rec);
        }

        return $isAdmin;
    }

    function isModerator($gid = null)
    {
        $groups = $this->getModeratedGroups($this->uid);

        if (!count($groups))
        {
            return false;
        }

        return $gid?in_array($gid, array_keys($groups)):true;
    }

    function canUseMail()
    {
        return $this->verified && $this->getParam('config','use_mail_features');
    }

    function accessDenied()
    {
        $this->error('Access denied!');

        if (!$this->verified && $this->getParam('config','users_must_verify_email'))
        {
            $this->warn('This SiteBar server requires your email address to be verified in order to use some functions.');
            $this->warn('Please click on the "%s" command and finish the verification procedure.', 'Verify Email');
        }
    }

    function isAuthorized($command, $ignoreAnonymous=false, $gid=null, $nid=null, $lid=null)
    {
        $acl = null;
        $node = null;
        $link = null;
        $readOnly = false;

        if ($lid)
        {
            $tree =& SB_Tree::staticInstance();
            $link = $tree->getLink($lid);
            $nid = $link->id_parent;

            if ($link->private && !$tree->inMyTree($nid))
            {
                return false;
            }
        }

        if ($nid)
        {
            $tree =& SB_Tree::staticInstance();
            $node = $tree->getNode($nid);
            $readOnly = $node->id_parent && !$node->parentHasRight('update');

            if (!$node)
            {
                return false;
            }

            $acl =& $node->getACL();

            if (!$acl)
            {
                return false;
            }

            if ($node && $node->deleted_by != null)
            {
                if ($command != 'Purge Folder' && $command != 'Undelete')
                {
                    return false;
                }
            }
        }

        if (!$this->isAnonymous())
        {
            $mustApprove = $this->getParam('config','users_must_be_approved');
            $mustVerify = $this->getParam('config','users_must_verify_email');

            // Hide commands if we are not setup completely
            if ($mustVerify && !$this->verified || $mustApprove && !$this->approved)
            {
                //
                switch ($command)
                {
                    case 'Browse Folder':
                    case 'Show Link News':
                    case 'Show All Links':
                    case 'Open Integrator':
                    case 'Add Page Bookmarklet':

                    case 'Contact Admin':
                    case 'Display Topic':
                    case 'Download Bookmarks':
                    case 'Email Link':
                    case 'Help':
                    case 'Log Out':
                    case 'Verify Email':
                    case 'Email Verified':
                    case 'Invalid Token':
                        break;

                    default:
                        $command = 'N/A';
                }
            }
        }

        // Check if we have plugin that changes rights
        foreach ($this->plugins as $plugin)
        {
            if (in_array($command, $plugin['authorization']))
            {
                $execute = $plugin['prefix'] . 'IsAuthorized';
                $result = $execute($this, $command, $ignoreAnonymous, $gid, $node, $acl, $link);

                if ($result !== null)
                {
                    return $result;
                }
            }
        }

        // If !$acl then we just ask for command list.
        switch ($command)
        {
            case 'Add Page Bookmarklet':
            case 'Display Topic':
            case 'Email Link':
            case 'Email Verified':
            case 'Help':
            case 'Invalid Token':
            case 'New Password':
            case 'Open Integrator':
                return true;

            case 'Set Up':
                return !$this->setupDone;

            case 'Sign Up':
                return ($this->isAnonymous() || $ignoreAnonymous)
                    && $this->getParam('config','allow_sign_up');

            case 'Log In':
                return $this->isAnonymous() || $ignoreAnonymous;

            case 'Log Out':
                return !$this->isAnonymous() || $ignoreAnonymous;
            case 'Reset Password':
                return $this->isAnonymous() &&
                       $this->getParam('config','use_mail_features');

            case 'Verify Email':
                return !$this->pmode &&
                       !$this->isAnonymous() &&
                       !$this->verified &&
                       !$this->demo &&
                       $this->getParam('config','use_mail_features');

            case 'Browse Folder':
            case 'Show Link News':
            case 'Show All Links':
                return !$this->getParam('user','hide_xslt') && (!$acl || $acl['allow_select']);

            case 'Contact Admin':
                return $this->getParam('config','use_mail_features') &&
                       ($this->getParam('config','allow_contact') || !$this->isAnonymous());

            case 'Contact Moderator':
                return !$this->pmode && !$this->isAnonymous();

            case 'Add Link':
            case 'Retrieve Link Information':
            case 'Add Folder':
                return !$acl || $acl['allow_insert'];

            case 'Paste': // Paste does its own checking later
            case 'Import Bookmarks':
                return !$acl || $acl['allow_insert'];

            case 'Hide Folder':
            case 'Unhide Subfolders':
            case 'Unhide Trees':
                return !$this->isAnonymous() &&
                    $this->getParam('user','use_hiding');

            case 'Copy':
            case 'Copy Link':
                return !$this->isAnonymous() && (!$acl || $acl['allow_select']);

            case 'Export Bookmarks':
            case 'Download Bookmarks':
            case 'Show Feed URL':
                return (!$this->isAnonymous() || $this->getParam('config','allow_anonymous_export'))
                    && (!$acl || $acl['allow_select']);

            case 'Custom Order':
                return !$acl || ($acl['allow_update'] && !$readOnly);

            case 'Folder Properties':
            case 'Properties':
                return !$acl || ($acl['allow_update']);

            case 'Validate Links':
            case 'Validation':
                return !$acl || ($acl['allow_update'] && $this->getParam('config','use_outbound_connection'));

            case 'Export Description':
                // Select is enough but, currently update is necessary
                return !$acl || ($acl['allow_select']);

            case 'Import Description':
                return !$acl || ($acl['allow_update'] && $this->getParam('config','comment_impex'));

            case 'Delete Link':
                return !$acl || ($acl['allow_delete']);

            case 'Delete Folder':
                return !$acl || ($acl['allow_delete']);

            case 'Delete Tree':
                return !$acl || $this->isAdmin() ||
                       (  $acl['allow_delete'] && $acl['allow_purge'] && $this->getParam('config','allow_user_tree_deletion'));

            case 'Purge Folder':
                return $this->getParam('user','use_trash') && (!$acl || $acl['allow_purge']);

            case 'Undelete':
                return $this->getParam('user','use_trash') && (!$acl || ($acl['allow_delete'] && $acl['allow_insert']));

            case 'Maintain Trees':
            case 'Order of Trees':
            case 'User Settings':
                return !$this->isAnonymous();

            case 'Session Settings':
                return $this->isAnonymous();

            case 'Personal Data':
                // Either we are number 1 user, or we have SiteBar authorization
                return !$this->isAnonymous() && ($this->uid==SB_ADMIN || !strlen($this->getParam('config', 'auth')));

            case 'Unhide Folders':
                return !$this->pmode && !$this->isAnonymous();

            case 'Delete Account':
                return !$this->isAnonymous() && !$this->demo && $this->uid != SB_ADMIN;

            case 'Membership':
            case 'Security':
                return !$this->isAnonymous() && !$this->pmode;

            case 'Create Tree':
                return !$this->isAnonymous() &&
                       $this->getParam('config','allow_user_trees');

            case 'Active Users':
            case 'Approve All Users':
            case 'Approve User':
            case 'Approve Users':
            case 'Create User':
            case 'Default User Settings':
            case 'Delete All Inactive Users':
            case 'Delete Inactive Users':
            case 'Delete User':
            case 'Export Bookmarks Settings':
            case 'Favicon Management':
            case 'Filter Users':
            case 'Inactive Users':
            case 'Maintain Users':
            case 'Modify User':
            case 'Most Active Users':
            case 'Pending Unverified Users':
            case 'Pending User':
            case 'Pending Users':
            case 'Pending Users':
            case 'Pending Verified Users':
            case 'Purge Cache':
            case 'Reject All Users':
            case 'Reject Users':
            case 'Show All Icons':
            case 'SiteBar Settings':
                return $this->isAdmin();

            case 'Send Email to User':
            case 'Send Email to All':
                return $this->isAdmin() && $this->verified
                       && $this->getParam('config','use_mail_features');

            case 'Create Group':
            case 'Delete Group':
            case 'Filter Groups':
                return !$this->pmode && ($this->isAdmin() || $this->getParam('config','allow_user_groups'));

            case 'Maintain Groups':
                return !$this->pmode && ($this->isAdmin() || $this->isModerator() || $this->getParam('config','allow_user_groups'));

            case 'Group Properties':
            case 'Group Members':
            case 'Group Moderators':
                return !$this->pmode && $this->isModerator($gid);

            case 'Send Email to Members':
            case 'Send Email to Moderators':
                return !$this->pmode && ($this->isAdmin() || $this->isModerator($gid))
                       && $this->verified
                       && $this->getParam('config','use_mail_features');
        }

        return false;
    }

    function canMove($sid,$tid,$isnode=true)
    {
        if ($this->isAuthorized(($isnode?'Delete Folder':'Delete Link'), false, null, $sid))
        {
            $tree = SB_Tree::staticInstance();
            $sroot = $tree->getRootNode($sid);
            $troot = $tree->getRootNode($tid);

            if ($sroot->id == $troot->id)
            {
                return true;
            }
            else // Another tree and the source tree does not have purge right
            {
                return $this->isAuthorized('Purge Folder', false, null, $sid);
            }
        }

        return false;
    }

    function & inPlaceCommands()
    {
        static $commands = array
        (
            'Log In',
            'Log Out',
            'Sign Up',
            'Set Up',
            'SiteBar Settings',
                'Default User Settings',
                'Favicon Management',
                    'Purge Cache',
                    'Show All Icons',
                'Export Bookmarks Settings',
            'User Settings',
                'Personal Data',
                'Delete Account',
        );
        return $commands;
    }

    // expires as delta time in seconds
    function login($email, $pass, $expires=0)
    {
        $auth = $this->getParam('config', 'auth');
        $addedRealName = '';
        $addedComment = '';
        $where = array('ucase(email)' => '');
        $rec = null;

        for ($i = 0; $rec==null && $i<2; $i++)
        {
            $where['ucase(email)'] = array('ucase'=>$email);

            // Get UID
            $rset = $this->db->select('uid', 'sitebar_user', $where);
            $rec = $this->db->fetchRecord($rset);

            if (!is_array($rec))
            {
                $defaultDomain = $this->getParam('config', 'default_domain');

                if ($defaultDomain && strpos($email,'@')===false)
                {
                    $email = $email . '@' . $defaultDomain;
                }
            }
        }

        // We have another setting and do not know the user or we know him and he is not admin
        $useAltAuth = strlen($auth) && (!is_array($rec) || $rec['uid'] != SB_ADMIN);

        // Plugin based authorization
        if ($useAltAuth)
        {
            $file = './plugins/' . $auth . '/auth.inc.php';
            if (!is_file($file))
            {
                $this->error('Authentication plugin %s missing!', $auth);
                return false;
            }

            include_once($file);
            if (!authenticate($this, $email, $pass, $addedRealName, $addedComment))
            {
                $this->error('Unknown username or wrong password!');
                return false;
            }
        }
        else
        {
            $where['^1'] = 'AND';
            $where['pass'] = array('md5' => $pass);
        }

        $rset = $this->db->select(null, 'sitebar_user', $where);
        $rec = $this->db->fetchRecord($rset);

        if (!is_array($rec))
        {
            if ($useAltAuth)
            {
                if (!strlen($addedRealName))
                {
                    $addedRealName = $email;
                }

                // Auto add user to database
                $uid = $this->signUp(
                    $email, 'NOPASSWORD',
                    $addedRealName,
                    $addedComment,
                    $createdByAdmin=true,
                    $verified=true,
                    $demoAccount=false,
                    $lang=null);

                if (!$uid)
                {
                    return false;
                }

                $tree =& SB_Tree::staticInstance();
                $tree->addRoot($uid, SB_T('%s&#39;s Bookmarks', array($addedRealName)) );

                return $this->login($email, $pass, $expires);
            }
            else
            {
                $this->error('Unknown username or wrong password!');
            }

            return false;
        }

        $this->initUser($rec);
        unset($this->user['pass']); // Security

        // Noone from outside can reconstruct the password, because
        // only half of its md5 is used to generate another md5 and
        // hence we use password noone from outside can guess the code.
        // Is it obscure or slow? Please tell me.
        $code = md5(substr(md5($pass),6,18).date('r').$email);

        $expires = ($expires?$expires+time():0);

        $this->db->insert('sitebar_session', array(
            'uid' => $this->uid,
            'code' => $code,
            'created' => array('now' => null),
            'expires' => $expires,
            'ip' => $_SERVER['REMOTE_ADDR']
        ));

        $this->setCookie('SB3AUTH', $code, $expires);
        $this->remote = false;
        return true;
    }

    function logout()
    {
        $this->user = null;
        $this->setCookie('SB3AUTH');
    }

    function isLogged()
    {
        if (!isset($_COOKIE['SB3AUTH']))
        {
            return false;
        }

        // Check if we have valid session
        $rset = $this->db->select('uid', 'sitebar_session',
            array('code' => $_COOKIE['SB3AUTH'],
                '^1' => 'AND (expires <= 0 OR expires>=unix_timestamp())'));

        $rec = $this->db->fetchRecord($rset);

        // Delete invalid cookie
        if (!is_array($rec))
        {
            $this->setCookie('SB3AUTH');
            return false;
        }

        // If yes then let us go in.

        // - first update some statistics
        $this->db->update('sitebar_user', array
        (
            'visits' => array('visits+'=>'1'),
            'visited'=>array('now'=>null)
        )
        ,array
        (
            'uid' => $rec['uid']
        ));

        $rset = $this->db->select(null, 'sitebar_user', array('uid' => $rec['uid']));

        $rec = $this->db->fetchRecord($rset);

        // User deleted?
        if (!is_array($rec))
        {
            $this->setCookie('SB3AUTH');
            return false;
        }

        $this->initUser($rec);
        unset($this->user['pass']); // Security

        return true;
    }

    function setUp($email, $pass,$name)
    {
        $rset = $this->db->update('sitebar_user',
            array(
                'email' => $email,
                'pass' => array('md5' => $pass),
                'name' => $name,
                'verified' => 1,
            ),
            array('uid'=>SB_ADMIN));

        return $this->login($email, $pass);
    }

    function saveConfiguration()
    {
        $rset = $this->db->update('sitebar_config',
            array('params' => $this->implodeParams('config')));

        return true;
    }

/*** User functions ***/

    function signUp($email, $pass, $name, $comment,
        $createdByAdmin=false, $verified=false, $demoAccount=false, $lang=null)
    {
        $rset = $this->db->select(null, 'sitebar_user', array(
            'ucase(email)' => array('ucase' => $email)));

        $user = $this->db->fetchRecord($rset);

        if (is_array($user))
        {
            $this->error('This email is already used. Try to login using your email address!');
            return false;
        }

        $params = '';

        if ($lang)
        {
            $params = 'lang='.$lang;
        }

        $this->db->insert('sitebar_user', array(
            'email' => $email,
            'pass' => array('md5' => $pass),
            'name' => $name,
            'comment' => $comment,
            'verified' => ($verified?1:0),
            'approved' => ($this->getParam('config', 'users_must_be_approved')?0:1),
            'demo' => ($demoAccount?1:0),
            'params' => $params
        ));

        $newUID = $this->db->getLastId();

        // Join groups where verification is not neccessary and
        // return list of groups when it is.
        $closedMatchingGroups = $this->autoJoinGroups($newUID, $email, $createdByAdmin);

        if ($this->getParam('config','use_mail_features') && !$createdByAdmin)
        {
            // If verification is not required, we must check whether the user should
            // verify because of pending membership. However not when he must verify anyway.
            if (!$this->getParam('config','users_must_verify_email'))
            {
                if (count($closedMatchingGroups))
                {
                    $groups = implode(', ', $closedMatchingGroups);
                    $url = $this->getVerificationUrl($newUID);
                    $subject = SB_T('SiteBar: Email Verification');
                    $msg = SB_P('usermanager::auto_verify_email', array($groups,$url));
                    // Verify email
                    $this->sendMail(array('name'=>$name, 'email'=>$email), $subject, $msg);
                }


                $paraName = 'usermanager::signup_info';
                $paraAtt = array($name,$email,SB_Page::baseurl());

                if ($this->getParam('config', 'users_must_be_approved'))
                {
                    $paraName = 'usermanager::signup_approval';
                    $paraAtt[] = $this->getApproveUserUrl($email);
                    $paraAtt[] = $this->getRejectUserUrl($email);
                    $paraAtt[] = $this->getPendingUsersUrl();
                }

                $this->mailToAdmins('SiteBar: New SiteBar User', $paraName, $paraAtt, '', '', $lang);
            }
        }

        // Always greater then zero
        return $newUID;
    }

    function mailToAdmins($subject, $bodyid, $bodyparams, $from_name='', $from_email='', $lang=null)
    {
        $admins = $this->getMembers($this->config['gid_admins']);
        foreach ($admins as $uid => $user)
        {
            $this->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->getParam('tmp', 'lang'));
            $this->sendMail($user, SB_T($subject), SB_P($bodyid, $bodyparams), $from_name, $from_email);
        }
        SB_SetLanguage($lang?$lang:$this->getParam('user','lang'));
    }

    function getVerificationUrl($uid='')
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();
        return $token->createVerifyToken($uid);
    }

    function getPendingUsersUrl()
    {
        return SB_Page::baseurl().
            '/command.php'.
            '?command=Pending%20Users';
    }

    function getApproveUserUrl($email)
    {
        return SB_Page::baseurl().
            '/command.php'.
            '?command=Approve%20User'.
            '&email='.$email;
    }

    function getRejectUserUrl($email)
    {
        return SB_Page::baseurl().
            '/command.php'.
            '?command=Reject%20User'.
            '&email='.$email;
    }

    function decodeValue($value, $header=false)
    {
        // translator.php needs &#39; instead of apostrope, there
        // are places when we do not like it -> in the mail.
        $tmp = str_replace("&#39;", "'", $value);

        if ($header)
        {
            return '=?UTF-8?B?'.base64_encode($tmp).'?=';
        }
        else
        {
            $tmp = str_replace("\n", "\x0D\x0A", $tmp);
            return stripslashes($tmp);
        }
    }

    function sendMail($user, $subject, $msg, $from_name='', $from_email='', $cc=false)
    {
        require_once("./inc/page.inc.php");

        $headers  = "Content-Type: text/plain; ".CHARSET."\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        $sender   = $this->getParam('config','sender_email');
        $email    = $user['email'];

        if (!($from_name && $from_email))
        {
            $from_name = SB_T('SiteBar Server');
            $from_email = $sender;
        }

        $headers .= sprintf("From: \"%s\" <%s>\n",
                $this->decodeValue($from_name, true), $from_email);

        if ($cc)
        {
            $headers .= sprintf("cc: %s\n", $from_email);
        }

        $headers .= sprintf("Reply-to: \"%s\" <%s>\n",
                $this->decodeValue($from_name, true), $from_email);
        $headers .= sprintf("Sender: \"%s\" <%s>\n",
                $this->decodeValue(SB_T('SiteBar Server'), true), $sender);
        $headers .= sprintf("Return-path: <%s>\n", $sender);

        // Do not set "To:" - it would duplicate mails.
        if (!mail($email,
            $this->decodeValue($subject, true),
            $this->decodeValue($msg), $headers))
        {
            return false;
        }

        return true;
    }

    function getLastModeratorGroups($uid)
    {
        $groups = $this->getModeratedGroups($uid);
        $names = array();

        foreach ($groups as $gid => $rec)
        {
            $members = $this->getMembers($gid);
            $moderators = $this->getMembers($gid, true);
            if (count($moderators)==1 && count($members)>1)
            {
                $names[] = $rec['name'];
            }
        }

        return $names;
    }

    function removeUser($uid)
    {
        $names = $this->getLastModeratorGroups($uid);

        if (count($names))
        {
            $this->error('Cannot delete user because he is the only moderator of the following group(s): %s!',
                array(implode(', ',$names)));

            return false;
        }

        $rset = $this->db->delete('sitebar_member', array('uid' => $uid));
        $rset = $this->db->delete('sitebar_user', array('uid' => $uid));

        return true;
    }

    function deleteAccount()
    {
        $names = $this->getLastModeratorGroups($this->uid);

        if (count($names))
        {
            $this->error('You are the last moderator of used group(s): %s. Account cannot be deleted!',
                array(implode(', ',$names)));

            return false;
        }

        $tree =& SB_Tree::staticInstance();

        if (!$this->removeUser($this->uid))
        {
            return false;
        }

        if (!$tree->changeOwner($this->uid, SB_ADMIN, $this->email))
        {
            return false;
        }

        return true;
    }

    function personalData($email,$pass,$name,$comment)
    {
        if ($email!=$this->email)
        {
            if ($this->verified)
            {
                $this->verified = 0;
            }

            $rset = $this->db->select(null, 'sitebar_user', array(
                'ucase(email)' => array('ucase' => $email)));

            $user = $this->db->fetchRecord($rset);

            if (is_array($user))
            {
                $this->error('This email is already used. Did you forget your password?');
                return false;
            }
        }

        $this->db->update('sitebar_user',
            array
            (
                'email' => $email,
                'name' => $name,
                'comment' => $comment,
                'verified' => $this->verified,
            ),
            array('uid'=>$this->uid));

        $this->email = $email;

        if ($pass)
        {
            $this->changePassword($this->uid, $pass);
            $this->login($email, $pass);
        }

        return true;
    }

    function saveUserParams($uid=null, $prefix='user')
    {
        if ($uid===null)
        {
            $uid = $this->uid;
        }

        $this->db->update('sitebar_user',
            array('params' => $this->implodeParams($prefix)),
            array('uid'=>$uid));
    }

    function modifyUser($uid, $pass, $columns)
    {
        if ($pass)
        {
            $this->changePassword($uid, $pass);
        }

        $this->db->update('sitebar_user', $columns, array('uid'=>$uid));
    }

    function checkPassword($uid, $pass)
    {
        $auth = $this->getParam('config', 'auth');
        $useAltAuth = strlen($auth) && ($uid != SB_ADMIN);

        // Plugin based authorization
        if ($useAltAuth)
        {
            $addedRealName = '';
            $addedComment = '';

            $user = $this->getUser($uid);

            include_once('./plugins/' . $auth . '/auth.inc.php');
            return authenticate($this, $user['email'], $pass, $addedRealName, $addedComment);
        }
        else
        {
            $rset = $this->db->select(null,'sitebar_user', array(
                'pass' => array('md5' => $pass),
                '^1' => 'AND',
                'uid'=>$uid));

            return is_array($this->db->fetchRecord($rset));
        }
    }

    function changePassword($uid, $pass)
    {
        $this->db->update('sitebar_user',
            array('pass' => array('md5' => $pass)),
            array('uid'=>$uid));
    }

/*** Group functions ***/

    function addGroup($name, $comment, $uid, $allow_addself, $allow_contact, $auto_join)
    {
        $rset = $this->db->select(null, 'sitebar_group', array(
            'name' => $name));

        $group = $this->db->fetchRecord($rset);

        if (is_array($group))
        {
            $this->error('Group name "%s" is already used!', array($group['name']));
            return false;
        }

        $this->db->insert('sitebar_group', array(
            'name' => $name,
            'comment' => $comment,
            'allow_addself' => $allow_addself,
            'allow_contact' => $allow_contact,
            'is_usergroup' => $this->isAdmin()?0:1,
            'auto_join' => $auto_join,
        ));

        $gid = $this->db->getLastId();
        $this->addMember($gid, $uid, true);

        // Always greater then zero
        return $gid;
    }

    function removeGroup($gid)
    {
        $this->db->delete('sitebar_acl', array('gid'=>$gid));
        $this->db->delete('sitebar_member', array('gid'=>$gid));
        $this->db->delete('sitebar_group', array('gid'=>$gid));
    }

    function updateGroup($gid, $name, $comment, $allow_addself, $allow_contact, $auto_join)
    {
        $this->db->update('sitebar_group',
            array('name' => $name,
                'comment' => $comment,
                'allow_addself' => $allow_addself,
                'allow_contact' => $allow_contact,
                'auto_join' => $auto_join),
            array('gid'=>$gid));
    }

    function addMember($gid, $uid, $moderator=false)
    {
        $this->db->purgeCache('acl_nodes', $uid);
        $this->db->purgeCache('vis_nodes', $uid);

        $this->db->insert('sitebar_member', array(
            'gid' => $gid,
            'uid' => $uid,
            'moderator' => $moderator?1:0),
            array(1062)); // Ignore duplicate membership
    }

    function removeMember($gid, $uid)
    {
        $this->db->purgeCache('acl_nodes', $uid);
        $this->db->purgeCache('vis_nodes', $uid);

        $this->db->delete('sitebar_member',
            array('gid'=>$gid, '^1'=>'AND', 'uid'=>$uid));
    }

    function updateMember($gid, $uid, $moderator)
    {
        $this->db->update('sitebar_member',
            array('moderator' => ($moderator?1:0)),
            array('gid'=>$gid, '^1'=>'AND', 'uid'=>$uid));
    }

    function showPublic()
    {
        return in_array($this->config['gid_everyone'],
            array_keys($this->getUserGroups()));
    }

    function useUserFilter()
    {
        $res = $this->db->select('count(*) count', 'sitebar_user');
        $rec = $this->db->fetchRecord($res);
        return $rec['count']>=$this->getParam('config','filter_users_limit');
    }

    function useGroupFilter()
    {
        $res = $this->db->select('count(*) count', 'sitebar_group');
        $rec = $this->db->fetchRecord($res);
        return $rec['count']>=$this->getParam('config','filter_groups_limit');
    }

/*** Search functions ***/

    function getUser($uid)
    {
        $rset = $this->db->select(null, 'sitebar_user',
            array('uid' => $uid));
        $users = array( $this->db->fetchRecord($rset));

        $this->cryptMail($users);
        return $users[0];
    }

    function firstSession($uid)
    {
        $rset = $this->db->select('min(created) signup', 'sitebar_session', array('uid' => $uid));
        $rec = $this->db->fetchRecord($rset);
        return $rec['signup'];
    }

    function getUserByEmail($email)
    {
        for ($i=0; $i<2; $i++)
        {
            $rset = $this->db->select(null, 'sitebar_user',
                array( 'email'=> $email));
            $rec = $this->db->fetchRecord($rset);

            if (is_array($rec))
            {
                return $rec;
            }

            $defaultDomain = $this->getParam('config', 'default_domain');

            if ($defaultDomain && strpos($email,'@')===false)
            {
                $email = $email . '@' . $defaultDomain;
            }
        }

        return null;
    }

    function cryptMail(&$users)
    {
        $unique = array();
        foreach ($users as $uid => $rec)
        {
            $crypt = $rec['email'];
            if (!$this->isAdmin())
            {
                // Create unique short email
                for ($i=2;;$i++)
                {
                    $crypt = preg_replace("/^([^@]+@.{1,".$i."}).*$/","$1...",$rec['email']);
                    if (!isset($unique[$crypt]))
                    {
                        break;
                    }
                }
                $unique[$crypt] = 1;
            }
            $users[$uid]['cryptmail'] = $crypt;
        }
    }

    function getUsers()
    {
        $rset = $this->db->select('uid, email, verified, approved, name, params',
            'sitebar_user', null, 'ucase(email)');
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->cryptMail($users);
        return $users;
    }

    function getPending($verified=-1)
    {
        $where = array('approved'=>0);

        if ($verified!=-1)
        {
            $where['^1'] = 'AND';
            $where['verified'] = $verified;
        }

        $rset = $this->db->select('uid, email, verified, name, params', 'sitebar_user', $where, 'ucase(email)');
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->cryptMail($users);
        return $users;
    }

    function getUsersUsingVisited($days, $cmp, $order)
    {
        $rset = $this->db->select
        (
            'uid, email, name, visited, visits',
            'sitebar_user',
            'visited '.$cmp.' DATE_ADD( now() , INTERVAL -'.intval($days).' DAY)',
            $order
        );
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->cryptMail($users);
        return $users;
    }

    function getMembers($gid, $moderators=false)
    {
        $where = array('gid'=>$gid);
        if ($moderators)
        {
            $where['^1'] = 'AND';
            $where['moderator'] = 1;
        }
        $rset = $this->db->select('u.uid, email, verified, approved, name, params, moderator',
            'sitebar_user u natural join sitebar_member m', $where, 'ucase(email)');
        $members = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $members[$rec['uid']] = $rec;
        }

        $this->cryptMail($members);
        return $members;
    }

    function getModeratedGroups($uid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $rset = $this->db->select('g.gid, g.name',
            'sitebar_group g natural join sitebar_member m',
            array('uid'=>$uid, '^1'=> 'AND', 'moderator'=>1 ), 'name');

        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        return $groups;
    }

    function getUserGroups($uid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $rset = $this->db->select('g.gid, g.name, moderator',
            'sitebar_group g natural join sitebar_member m',
            array('uid'=>$uid), 'name');

        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        return $groups;
    }

    function getUserGroupsForSecurity($uid=null)
    {
        return $this->getUserGroups();
    }

    function getGroup($gid)
    {
        $rset = $this->db->select(null, 'sitebar_group',
            array( 'gid'=> $gid), 'is_usergroup, name');
        $group = $this->db->fetchRecord($rset);

        if (!$group)
        {
            $this->error('Group has already been deleted.');
            return null;
        }

        return $group;
    }

    function getGroupByName($name)
    {
        $rset = $this->db->select(null, 'sitebar_group',
            array( 'name'=> $name), 'is_usergroup, name');
        $group = $this->db->fetchRecord($rset);

        if (!$group)
        {
            $this->error('Group has already been deleted.');
            return null;
        }

        return $group;
    }

    function getGroups()
    {
        $rset = $this->db->select(null, 'sitebar_group', null, 'name');
        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $this->renameGroup($rec);
            $groups[$rec['gid']] = $rec;
        }

        return $groups;
    }

    function isHiddenGroup(&$rec, $command)
    {
        return false;
    }

    function renameGroup(&$rec)
    {
        if ($rec['gid']<=2)
        {
            $rec['name'] = SB_T($rec['name']);
        }

        if ($rec['is_usergroup'])
        {
            $rec['long_name'] = SB_T('UsrGrp: %s', $rec['name']);
        }
        else
        {
            $rec['long_name'] = $rec['name'];
        }
    }

    function autoJoinGroups($uid, $email, $verified=false)
    {
        $groups = array();

        // Add member to all groups that have auto_join filled and matching
        foreach ($this->getGroups() as $gid => $rec)
        {
            $res = $this->canJoinGroup($rec, $uid, $email, $verified);

            if ($res === true)
            {
                // Only add based on auto join - do not add when
                // he just can join the group
                if (strlen($rec['auto_join']))
                {
                    $this->addMember($gid, $uid);
                }
            }
            elseif ($res === null) // Verification missing, note group name
            {
                // Otherwise return
                $groups[] = $rec['name'];
            }
        }

        return $groups;
    }

    function canJoinGroup(&$groupRec, $uid=null, $email=null, $verified=null)
    {
        if ($uid===null) $uid = $this->uid;
        if ($email===null) $email = $this->email;
        if ($verified===null) $verified= $this->verified;

        // If he can add himself then just let himself
        if ($groupRec['allow_addself'])
        {
            return true;
        }

        // If he cannot add himself directly then try auto join pattern
        if (strlen($groupRec['auto_join']))
        {
            if ($groupRec['auto_join']{0} != '/')
            {
                $groupRec['auto_join'] = '/'.$groupRec['auto_join'].'/i';
            }

            if (preg_match($groupRec['auto_join'], $email))
            {
                // If open group or mail already verified or demo account
                // then allow direct add self
                if ($verified || $this->demo)
                {
                    return true;
                }
                else
                {
                    // Otherwise signal that verification required
                    return null;
                }
            }
        }

        return false;
    }

    function loadPlugins()
    {
        $this->plugins = array();
        $this->pluginPaths = array();

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

                $authfile = $plugdir.'/auth.inc.php';

                if (is_file($authfile) && $this->getParam('config', 'auth') != $plugin)
                {
                    continue;
                }

                $plugfile = $plugdir.'/command.inc.php';

                if (is_file($plugfile))
                {
                    include($plugfile);
                    $this->pluginPaths[] = $plugdir;

                    // $plugin gets injected
                    $this->plugins[] = $plugin;
                }
            }
            closedir($dir);
        }

        if (count($this->plugins))
        {
            $l =& SB_Localizer::staticInstance();
            $l->setPlugins($this->pluginPaths);
        }
    }
}
?>
