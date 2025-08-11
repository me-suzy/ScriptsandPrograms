<?php
  require("showlister_methods.inc.php");
?>
<html>
<head>
    <title>showlister :: add artist [1]</title>
    <link rel="stylesheet" type="text/css" href="showlister.css">
</head>
<body>

<div class="box">
<h3>showlister :: add artists</h3>
</div>

<div class="box">
  <form method="post" action="add_artists_02.php">
    <table>
      <tr>
        <td>
          <b>Name</b><br />
          <input type="text" name="artist_name">
        </td>
        <td>
          <b>Contact email</b><br />
          <input type="text" name="artist_email">
        </td>
        <td>
          <b>Website</b><br />
          <input type="text" name="artist_url">
        </td>
        <td>
          <b>Phone</b><br />
          <input type="text" name="artist_phone">
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center">
          <input type="submit" value="add artist">
        </td>
      </tr>
    </table>
  </form>
</div>

<?php
  footer();
?>