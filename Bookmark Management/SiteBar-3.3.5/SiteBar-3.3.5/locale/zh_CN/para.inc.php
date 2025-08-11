<?php

$para = array();

$para['index::tip'] = <<<_P
使用此页去启动或安装 SiteBar 到您的浏览器中。我们建议您将有标记「*」号的连结加到我的最爱中，方便您更快使用 SiteBar。这一页是可以从 SiteBar 最顶部的 Logo 中连结得到的。
_P;

$para['index::any_browser'] = <<<_P
在本页开启 <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>*，或以 Pop-Up 的形式启动 <a title="SiteBar" href="%s">SiteBar</a>*。
_P;

$para['index::ie_install'] = <<<_P
从「浏览器列」和「Context Menu」中 <a href="?install=1">安装</a> / <a href="?install=0">移除</a> - 要令所有功能生效，您
需要更改窗口的登录文件和重新启动系统。视乎您的权限，有些功能可能未能安装。
<p class='comment'>成功安装后，您可以到「检视 / 浏览器列」开启您的 SiteBar，或用<b>自订...</b>工具列功能去显示「SiteBar Panel toggle button」。您更可以在任何一个网页页面或连结上按鼠标右键，并将之加到 SiteBar 之中。</p>
_P;

$para['index::ie_search'] = <<<_P
暂时性地加 <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))">
SiteBar</a>* 到搜寻列之中。
<p class='comment'>如果您没有足够的权限完成以上安装的话，您可以这样做。</p>

_P;

$para['index::mozilla'] = <<<_P
增加兼容Mozilla/Netscape的
<a title="SiteBar"
href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
sidebar</a> - 显示使用F9.
<p class='comment'>Mozilla Firefox 使用以上联结. Mozillazine
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">topic</a> 描述如何使用 <a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> sidebar
extension 和 <a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">WebLinks</a> 菜单扩展.
</p>
_P;

$para['index::opera'] = <<<_P
以 sidebar 的形式加 Opera's <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a>。
<p class='comment'>用 Ctrl+click 而不是 Right+click 去显示数据夹或连结的选项。</p>
_P;

$para['index::myie2_install'] = <<<_P
下载已自订的 <a href="http://sitebar.org/plugin/myie2/?sidebar=%s">sidebar</a> 和 / 或 <a href="http://sitebar.org/plugin/myie2/?toolbar=%s">加入目前的标签到 SiteBar</a> 工具列外挂中。
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">加入目前页面到 SiteBar</a>* - 在这连结上按下鼠标右键，这样可以让您新增正在浏览的页面到 SiteBar 中。MS IE 用户可选用上面介绍的安装程序和 context menu。
_P;

$para['index::copyright2'] = <<<_P
Copyright &copy; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
和 <a href='http://sitebar.org/team.php'>SiteBar 团队</a>.
支持 <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>论坛</a>.
_P;

$para['command::contact'] = <<<_P
Message:

%s


--
SiteBar 安装至 %s.
_P;

$para['command::contact_group'] = <<<_P
群组: %s
消息:

%s


--
SiteBar 安装至 %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>确认要删除帐号么?</h3>
无法恢复这个操作!<p>
所有您遗留的目录树将留给管理员.
_P;

$para['command::email_link_href'] = <<<_P
<p>寄一封电子邮件到预设
<a href='mailto:?subject=Web site: %s&body=我找到一个您可能有兴趣的网站。
 到这儿看看： %s
 --
 由 SiteBar at %s 寄出
 开源码 Bookmark Server http://sitebar.org
'>电子邮件客户端</a>

_P;

$para['command::email_link'] = <<<_P
我找到一个您可能有兴趣的网站。
到这儿看看：

    "%s" %s

%s

--
由 SiteBar at %s 寄出
开源码 Bookmark Server http://sitebar.org

_P;

$para['command::verify_email'] = <<<_P
您发送了e-mail验证，允许使用自动合并规则合并群组，允许使用Sitebar的e-mail特性。

请点一下联结来验证您的email:
   %s
_P;

$para['command::import_bk'] = <<<_P
<br>
您可以用 javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>function</a> 汇出本机的书签成为一个书签档案。
_P;

$para['command::export_bk'] = <<<_P
<br>
经汇出的书签可以用 javascript
<a href='javascript:window.external.ImportExportFavorites(true,"")'>function</a> 汇入本机书签之中。

_P;

$para['command::noiconv'] = <<<_P
<br>
这 SiteBar server 并未安装编码转换功能。
<br>

_P;

$para['command::security_legend'] = <<<_P
权限:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete,
<strong>P</strong>urge,
<strong>G</strong>rant
_P;

$para['command::purge_cache'] = <<<_P
<h3>您真的要从缓存里清空所有图标么？</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
您的电邮地址符合以下已关闭的群组的 auto join 规则：
    %s。

您的电邮地址必须先被查证，系统才会认可您的会员资格。请按以下连结查证：%s
_P;

$para['usermanager::signup_info'] = <<<_P
用户「%s」已登记
到您的 SiteBar 系统安装 at %s。

_P;

$para['hook::statistics'] = <<<_P
Roots {roots_total}.
Folders {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Users {users}.
Groups {groups}.
SQL queries {queries}.
DB/Total time {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
