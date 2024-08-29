<?php
require_once('ep-config.php');
function update_page_settings($data){
 $data_setting=$data['setting'];
 $update=$insert=0;
 global $epdb;
 foreach($data_setting as $name=>$val){
	 $is_option=is_avilabe_options($name);
	 if(!empty($is_option)){
		$update = update_options(array('option_value'=>$val),array('option_name'=>$name));
	 }
	 else{
		$insert =add_options(array('option_name'=>$name,'option_value'=>$val));
	 }
 } 

	 return array('success'=>'1','msg'=>'Setting Successfully Updated');
}
function add_options($data_array){
	global $epdb;
	$epdb->insert('e_options',$data_array,array('%s','%s'));
	$inserted=$epdb->insert_id;
	return $inserted;
	
}
function update_options($data_array,$where){
	global $epdb;
	$update=$epdb->update('e_options',$data_array,$where);
	return $update;
}
function is_avilabe_options($name){
	global $epdb;
    $sql_options= "SELECT option_id FROM e_options WHERE option_name='".$name."'";
	$options = $epdb->get_row($sql_options);
	return !empty($options->option_id)? $options->option_id:'0';
}
function login_user($data){
	global $epdb;
	$uid   = trim($data['id']);
	$upass = trim($data['pass']);
	$sql = "SELECT * FROM e_users WHERE user_name='".$uid."' AND user_pass='".md5($upass)."'";
	$user = $epdb->get_row($sql);
      
       
	if(!empty($user->ID)){
		@session_start();
                 session_set_cookie_params(600);
		$_SESSION['USERID']=$user->ID;
		$_SESSION['USERNAME']=$user->user_name;
		$_SESSION['USERTYPE']=$user->user_type;
		//$datetime=date("Y-m-d H:i:s");
		//$epdb->update('e_usere',array('last_login'=>$datetime),array('ID'=>$user->ID));
		 return array('success'=>'1','msg'=>'Setting Successfully Login');//
	}
	else{
		return array('success'=>'0','msg'=>'Wrong User/Pass !!');//
	}
	 
}
function add_users($data){
	global $epdb;
	$uid   = trim($data['user_id']);
	$upass = trim($data['password']);
	$utype = trim($data['type']);
	$sql = "SELECT * FROM e_users WHERE user_name='".$uid."'";
	$user = $epdb->get_row($sql);
	if(!empty($user->ID)){
		return array('success'=>'0','msg'=>'This user id already exists.');//
	}
	else{
		$epdb->insert('e_users',array('user_name'=>$uid ,'user_pass'=>md5($upass),'user_type'=>$utype),array('%s','%s','%s'));
		if($epdb->insert_id){
		 return array('success'=>'1','msg'=>'Successfully user added');
		}
		else{
			return array('success'=>'0','msg'=>'Connection problem try letter !!');
		}
	}
return array('success'=>'0','msg'=>'Something wrong contact with admin!!');	 
}
function user_change_password($data){
	global $epdb;
	$uid   = trim($data['user_id']);
	$upass = trim($data['newpass']);
	$sql = "SELECT * FROM e_users WHERE ID='".$uid."'";
	$user = $epdb->get_row($sql);
	if(empty($user->ID)){
		return array('success'=>'0','msg'=>'This user not exists');//
	}
	else{
		$update=$epdb->update('e_users',array('user_pass'=>md5($upass)),array('ID'=>$uid));
		if($update){
		 return array('success'=>'1','msg'=>'Successfully password change');
		}
		else{
			return array('success'=>'0','msg'=>'Password have no change');
		}
	}
return array('success'=>'0','msg'=>'Something wrong contact with admin!!');	 
}
?>