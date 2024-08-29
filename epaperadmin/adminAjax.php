<?php

require_once('global.php');
session_save_path(SESSION_PATH);    

ini_set('session.gc_probability', 1);
if(isset($_POST['page'])){
    $page=$_POST['page'];
	if(file_exists($page)){
		require_once($page);	  
	}else{
	  echo '404';
	}
}
elseif(isset($_POST['function'])){
 require_once('global.php');
 $html='';
 switch($_POST['function']){
	  case 'get_spage_option':
		  $arg=$_POST['val'];
		  $html=get_spage_option($arg);
		  break;
	default:
	$html='';
	break;	  
 }
  echo $html;
} else{
	 echo '404 Page not found';
}
?>