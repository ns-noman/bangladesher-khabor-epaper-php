<?php 
require_once('global.php');
session_save_path(SESSION_PATH);   

ini_set('session.gc_probability', 1);
if(!isset($_SESSION)) {session_start();}
// if(empty($_SESSION['USERNAME']) || empty($_SESSION['USERID'])){ header('Location:login.php');}

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Epaper | bangladesher Khabor</title>
    <link rel="shortcut icon" href="http://epaper.bangladesherkhabor.net/assets/images/1_3.png" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" href="css/layout.css" media="all"  rel="stylesheet"/>
<link type="text/css" href="assets/js/jquery-ui/css/ep/jquery-ui-1.10.2.custom.css" media="all" rel="stylesheet"/>
<!-- <link type="text/css" href="assets/plugins/uploadify/uploadify.css" media="all" rel="stylesheet"/> -->


<link type="text/css" href="assets/plugins/uploadifive/uploadifive.css" media="all" rel="stylesheet"/>


<link type="text/css" href="assets/plugins/colorbox/theme2/colorbox.css" media="all" rel="stylesheet"/>
<script id="jquery-1.9.1" type="application/javascript" src="assets/js/jquery.js"></script>

<script type="application/javascript">
$.ajaxSetup ({
    // Disable caching of AJAX responses
    cache: false
});
</script>

<script type="application/javascript" src="assets/js/jquery-ui/js/jquery-ui-1.10.2.custom.js"></script>
<!--<script type="application/javascript" src="assets/plugins/uploadify/jquery.uploadify.min.js"></script>-->
<script type="application/javascript" src="assets/plugins/uploadifive/jquery.uploadifive.min.js"></script>
<script type="application/javascript" src="assets/plugins/colorbox/jquery.colorbox.js"></script>
<script type="application/javascript" src="assets/js/lib.js"></script>
<script type="application/javascript" src="assets/js/jquery.form.js"></script>
<script type="application/javascript" src="js/admin.js"></script>

</head>
<body class="ep">
<div id="container">
 <div class="clearfix row" id="content-wrapper">
 <div class="content-right twelve columns">
  <div id="content">