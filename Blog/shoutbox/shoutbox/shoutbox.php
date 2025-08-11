<script type="text/javascript">
<!--
  function addsmiley(code)  {
    var pretext = document.forms['shoutbox_form'].shoutbox_message.value;
      this.code = code;
      document.forms['shoutbox_form'].shoutbox_message.value = pretext + code;
  }
//-->
</script>

<style type="text/css">
  /* Belows is the CSS file with some comments, edit it to your likings. */

  /* This is to "trap" all shoutbox message into one content box */
  div.shoutbox {
    background: #E5E5E5;
    padding: 5px;
    width: 190px;
    height: 200px;
    border: 1px solid #000000;
    overflow: auto;
    color: #000000;
    font: normal 10px verdana,tahoma,arial }

  /* Smiley with no border and a cursor pointer */
  img.smileys { 
    border: 0;
    cursor: pointer; }

  /* Just some styling... */
  #shoutbox-message { width: 200px }
  strong {
    color: #000000;
    font: bold 10px verdana,tahoma,arial }

  /* Dont remove this style property or the messages wont display properly! */
  ul { 
    margin: 0;
    padding: 0;
    list-style-type: none;
    color: #000000;
    font: normal 10px verdana,tahoma,arial; }

  /* This is just to make the form looks nice */
  input {
    padding: 0px;
    border: 1px solid #000000;
    background-color: #E5E5E5;
    color: #000000;
    font: normal 10px verdana,tahoma,arial; }
  textarea {
    width: 195px;
    padding: 0px;
    border: 1px solid #000000;
    background-color: #E5E5E5;
    color: #000000;
    font: normal 10px verdana,tahoma,arial; }
</style>

<?php
  include("config.php");
    if ($_POST['shoutbox_submit'])  {
      $name = $_POST['shoutbox_name'];
      $ip = $_POST['shoutbox_ip'];
      $message = $_POST['shoutbox_message'];
      $mlen = strlen($message);
      $date = date("F jS Y");
      if ($name == "") { 
        echo "<strong>Error: Please enter your nickname.</strong>"; 
      }
      else if ($message == "") { 
        echo "<strong>Error: No message to be sent.</strong>"; 
      }
      else if ($mlen > $max_length) { 
        echo "<strong>Error: Message too long.</strong>"; 
      }
     else {
      $db = mysql_connect($db_host,$db_user,$db_pass); 
      mysql_select_db($db_name) or die("Cannot connect to database");
      mysql_query("INSERT INTO shoutbox(name,ip,message,date) VALUES('$name','$ip','$message','$date')"); 
      mysql_close($db);
      }
    }
  $db = mysql_connect($db_host,$db_user,$db_pass); 
  mysql_select_db($db_name) or die("Cannot connect to database");
  $query = "SELECT * FROM shoutbox ORDER BY id DESC LIMIT $dmessage"; 
  $result = mysql_query($query);
    echo "<div class=\"shoutbox\">\n";
    echo "<ul>\n";
    while($r=mysql_fetch_array($result)) {
      //Strips unwanted HTML from nickname
      $name = $r['name'];
      $name = strip_tags($name);
      //Strips unwanted HTML from message
      $message = $r['message'];
      $message = strip_tags($message);
      // Transform text to smileys =) 
      $message = str_replace("=(","<img src=\"/shoutbox/smileys/sad.gif\" alt=\"=(\"/>", $message);
      $message = str_replace(":(","<img src=\"/shoutbox/smileys/sad.gif\" alt=\":(\"/>", $message);
      $message = str_replace(";(","<img src=\"/shoutbox/smileys/cry.gif\" alt=\";(\"/>", $message);
      $message = str_replace(":@","<img src=\"/shoutbox/smileys/mad.gif\" alt=\":@\"/>", $message);
      $message = ereg_replace(":)","<img src=\"/shoutbox/smileys/smile.gif\" alt=\":)\"/>", $message);
      $message = ereg_replace("=)","<img src=\"/shoutbox/smileys/smile.gif\" alt=\"=)\"/>", $message);
      $message = ereg_replace(":D","<img src=\"/shoutbox/smileys/laugh.gif\" alt=\":D\"/>", $message);
      $message = ereg_replace(":d","<img src=\"/shoutbox/smileys/laugh.gif\" alt=\":d\"/>", $message);
      $message = ereg_replace(":p","<img src=\"/shoutbox/smileys/tongue.gif\" alt=\":p\"/>", $message);
      $message = ereg_replace(":P","<img src=\"/shoutbox/smileys/tongue.gif\" alt=\":P\"/>", $message);
      $message = ereg_replace(":O","<img src=\"/shoutbox/smileys/shocked.gif\" alt=\":O\"/>", $message);
      $message = ereg_replace(":o","<img src=\"/shoutbox/smileys/shocked.gif\" alt=\":o\"/>", $message);
      $message = ereg_replace(";)","<img src=\"/shoutbox/smileys/wink.gif\" alt=\";)\"/>", $message);
      $message = ereg_replace(":S","<img src=\"/shoutbox/smileys/sick.gif\" alt=\":S\"/>", $message);
      $message = ereg_replace(":s","<img src=\"/shoutbox/smileys/sick.gif\" alt=\":s\"/>", $message);
      $message = ereg_replace(":roll:","<img src=\"/shoutbox/smileys/roll.gif\" alt=\":roll:\"/>", $message);
      echo "<li title=\"Shouted on $r[date]\" style=\"cursor: pointer\"><strong>$name</strong>: $message</li>\n";
    }
      echo "</ul>\n";
      echo "</div>\n";
      mysql_close($db);
?>

<div>
  <form id="shoutbox_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <strong>Nickname:</strong><br/>
    <input type="text" name="shoutbox_name" size="37" maxlength="20"><br/>
    <strong>Message:</strong><br/>
    <img class="smileys" src="./shoutbox/smileys/smile.gif" alt=":)" onclick="addsmiley(':)')"/>
    <img class="smileys" src="./shoutbox/smileys/laugh.gif" alt=":D" onclick="addsmiley(':D')"/>
    <img class="smileys" src="./shoutbox/smileys/wink.gif" alt=";)" onclick="addsmiley(';)')"/>
    <img class="smileys" src="./shoutbox/smileys/sad.gif" alt=":(" onclick="addsmiley(':(')"/>
    <img class="smileys" src="./shoutbox/smileys/shocked.gif" alt=":O" onclick="addsmiley(':O')"/>
    <img class="smileys" src="./shoutbox/smileys/tongue.gif" alt=":P" onclick="addsmiley(':P')"/>
    <img class="smileys" src="./shoutbox/smileys/sick.gif" alt=":S" onclick="addsmiley(':S')"/>
    <img class="smileys" src="./shoutbox/smileys/roll.gif" alt=":roll:" onclick="addsmiley(':roll:')"/>
    <img class="smileys" src="./shoutbox/smileys/cry.gif" alt=";(" onclick="addsmiley(';(')"/>
    <img class="smileys" src="./shoutbox/smileys/mad.gif" alt=":@" onclick="addsmiley(':@')"/><br/>
    <textarea id="shoutbox-message" cols="20" rows="3" name="shoutbox_message"></textarea><br/>
    <input type="submit" name="shoutbox_submit" value="Shout It!">&nbsp;<a href="http://www.r2xDesign.net" title="Web Scripting Resources - PHP Scripts, PHP Snippets, PHP Tutorials and Free Templates">www.r2xDesign.net</a>
    <input type="hidden" name="shoutbox_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
  </form>
</div>