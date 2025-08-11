<?php

$para = array();

$para['command::contact'] = <<<_P
메시지:

%s

--
%s에 설치된 SiteBar로부터 전달된 것입니다.
_P;

$para['command::contact_group'] = <<<_P
그룹: %s
메시지:

%s

--
%s에 설치된 SiteBar로부터 전달된 것입니다.
_P;

$para['command::delete_account'] = <<<_P
<h3>정말로 당신의 계정을 삭제하시겠습니까?</h3>
나중에 다시 복구할 방법이 없습니다!<p>
당신이 아직 가지고 있는 모든 트리는 시스템 관리자에게 주어질 것입니다.

_P;

$para['command::email_link_href'] = <<<_P
<p>기본 <a href="mailto:?subject=웹사이트 안내: %s&body=당신이 관심있을만한 웹사이트를 찾았습니다.
 한번 들어가보세요 : %s
 --
 %s에 설치된 SiteBar에서 보내진 것입니다.
 Open Source Bookmark Server http://sitebar.org
">메일 클라이언트</a>를 사용해서 메일을 보냅니다.
_P;

$para['command::email_link'] = <<<_P
당신이 관심있을만한 웹사이트를 찾았습니다.
 한번 들어가보세요 :

   "%s" %s

%s

--
 %s에 설치된 SiteBar에서 보내진 것입니다.
 Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
자동 가입 정규식을 사용한 그룹 가입과 SiteBar의 메일 관련 기능을 사용하기 위해 메일 주소 확인을 요청했습니다.

메일 주소를 확인하기 위해서는 다음 링크를 클릭해 주세요.
   %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer는 Netscape 북마크 파일 형식에서 북마크를 가져오거나 내보낼 수 있습니다. 그렇지만 그 파일은 반드시 윈도우 인코딩을 사용해야 하며, 기본 설정인 UTF-8은 동작하지 않을 것입니다.
_P;

$para['command::noiconv'] = <<<_P
<br>현재 SiteBar 서버에는 코드페이지 변환이 설치되어있지 않습니다.<br>
_P;

$para['command::security_legend'] = <<<_P
권한: 읽기(<strong>R</strong>), 추가(<strong>A</strong>), 편집(<strong>M</strong>), 삭제(<strong>D</strong>), 비우기(<strong>P</strong>), 권한승인(<strong>G</strong>)
_P;

$para['command::purge_cache'] = <<<_P
<h3>정말로 캐시에서 모든 아이콘을 지우시겠습니까?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
당신의 메일 주소는 다음의 제한 그룹에서 사용하는 자동 가입을 위한 규칙에 맞는 주소입니다.
   %s

회원가입을 승인하기 위해서는 메일 주소를 확인해야 합니다. 메일 주소 확인을 위해서 다음 링크를 클릭해주세요.
   %s
_P;

$para['usermanager::signup_info'] = <<<_P
사용자 "%s" <%s>는 %s에 설치된 SiteBar에 가입하였습니다.
_P;

$para['hook::statistics'] = <<<_P
최상위 {roots_total}.
폴더 {nodes_shown}/{nodes_total}.
링크 {links_shown}/{links_total}.
사용자 {users}.
그룹 {groups}.
SQL 질의 {queries}.
DB/총 시간 {time_db}/{time_total} 초 ({time_pct}%).
_P;

?>
