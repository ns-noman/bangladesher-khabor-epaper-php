<?php
if (!isset($_SESSION)) {session_start();}
if (!empty($_GET['action']) && $_GET['action'] == 'logout') {session_destroy();}
if (!empty($_SESSION['USERNAME']) && !empty($_SESSION['USERID'])) {header('Location:index.php');}
//if(isset($_SESSION['USERNAME'])){ header('Location:index.php');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require_once 'global.php';
global $setting;
extract($setting);
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Epaper | Newage</title>
<style type="text/css">
@font-face
{
  font-family: "Siyam Rupali";
  src: url('../assets/font/Siyamrupali.ttf');
}
</style>
<link href="css/login.css" rel="stylesheet" media="screen" />
<!--[if IE]>
<link href="css/ie.css" rel="stylesheet" media="screen" />
<![endif]-->
<script id="jquery-1.9.1" type="application/javascript" src="../assets/js/jquery.js"></script>
<script type="application/javascript" src="../assets/js/jquery-ui/js/jquery-ui-1.10.2.custom.js"></script>
<script id="eaper-libs" type="application/javascript" src="../assets/js/lib.js"></script>
<title><?php echo $site_title; ?></title>
</head>
<body class="login">
<div id="epage">
 <div id="wrapper" class="ewidth">
   <div id="branding" class="ewidth">
    <ul class="block-row">
      <li class="bcenter logo"><a href="<?php echo $site_url; ?>" title="<?php echo $site_title; ?>"><img src="<?php echo $site_url; ?>/assets/images/temp-logo.png" /></a></li>
    </ul>

   </div><!--#branding-->
   <div class="clearfixd"></div>
   <div id="main-content" class="efull">
    <fieldset class="user-form" id="loginform-content">
     <legend>Login</legend>
     <form action="" method="get" enctype="multipart/form-data" id="form-login">
     <input type="hidden" value="userlogin" name="action" />
         <div class="form-element">
            <label for="user_id">User id:</label><input type="text" class="required" value="" id="user_id" name="user[id]">
         </div>
         <div class="form-element">
            <label for="user_pass">Password:</label><input type="password" class="required" value="" id="user_id" name="user[pass]">
         </div>
        <div class="form-element form-element-submit"><input type="submit" class="submit_button" value="Login" id="form-login-submit"></div>
     </form>
    </fieldset>
   </div><!--#main-content-->
  <div id="footer-container">
  <div id="footer" class="ewidth">
     <p class="copyright">&copy;Copyright <?php echo date("Y"); ?> Newage</p>
  </div><!--#footer-->
   <div class="clearfixd"></div>
  </div><!--#footer-container-->
  </div>
 </div><!--#epage-->
 <script type="text/javascript">
   $(document).ready(function(){
	   $('#form-login').on('submit',function(){
         var loder=$(this).parent();
		 loder.addClass('lodding');
		 var post_data=$(this).serialize();
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',
			 success: function(responce){
                             alert(responce);
				if(responce.success == '1'){
                                          console.log(responce.msg);
                                          $('#reguler-epage').html(responce.news);
					  location.href='login.php?action='+encodeURIComponent('login');
					  loder.removeClass('lodding');
				}else{
					loder.removeClass('lodding');
				  show_massage(responce.msg,'error');

			    }
			 }
			 });
			 return false;
	   });
   });
 </script>
 <div id="status" class=""></div>
</body>
</html>
