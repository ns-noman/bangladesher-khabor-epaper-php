<?php
require_once('ep-config.php');
function add_advertise($data){
    global $setting,$epdb;
	$location = trim($data['location']);
	$order = empty($data['order'])? 0: intval($data['order']);
	$status = empty($data['activate'])? 0: intval($data['activate']);
	$client = empty($data['client'])? 0: intval($data['client']);
	$slideshow = empty($data['slide'])? 0: intval($data['slide']);
	$image = $data['image'];
	$image_uri=SITEURL.'/advertise/'.$image;
	$insert_adv=array('uri'=>$image_uri,'client_id'=>$client,'locations'=>$location,'order'=>$order,'status'=>$status,'is_slide'=>$slideshow);
	$epdb->insert('e_advertise',$insert_adv,array('%s','%d','%s','%d','%s','%d'));
	if(!empty($epdb->insert_id)){
		 return array('success'=>'1','msg'=>'Advertise Successfully Inserted.');
	}
	 return array('success'=>'0','msg'=>'Sorry Invalide Information. try again!!');
}
function update_advertise($data){
	global $setting,$epdb;
	$advertise=$data['adv'];
	$update_msg=0;
	foreach($advertise as $adv=>$val){
		$location = $data['adv_location'][$adv];
		$order    = $data['adv_order'][$adv];
		$slide    =!empty($data['adv_slide'][$adv]) ? '1':'0';
		$status   =!empty($data['adv_status'][$adv]) ? '0':'1';
		if(!empty($data['adv_remove'][$adv]))
		{
			$epdb->query('DELETE FROM e_advertise WHERE ID ='.intval($adv).';');
			$update_msg=1;
		}
		else{
		 $update=$epdb->update('e_advertise',array('locations'=>$location,'order'=>$order,'is_slide'=>$slide,'status'=>$status),array('ID'=>$adv));
		}
		if($update){$update_msg=1;}
	}
	if(!empty($update_msg)){
		 return array('success'=>'1','msg'=>'Advertise Update Successfully Done');
	}else
	 return array('success'=>'0','msg'=>'Sorry no change found');
}
function add_advclients($data){
    global $setting,$epdb;
	$name = trim($data['name']);
	$url=trim($data['url']);
	$insert_clint=array('name'=>$name,'link'=>$url,'status'=>'1');
	$epdb->insert('e_advclient',$insert_clint,array('%s','%s','%s'));
	if(!empty($epdb->insert_id)){
		 return array('success'=>'1','msg'=>'Client Successfully Inserted.');
	}
	 return array('success'=>'0','msg'=>'Sorry Invalide Information. try again!!');
}
function update_advclients($data){
    global $setting,$epdb;
	$update_msg=0;
	//print_r($data); die();
	if(!empty($data['clients'])){
		foreach($data['clients']['cln'] as $cl=>$val){
			$status = !empty($data['clients']['status'][$cl])? '0':'1';
			$link   = !empty($data['clients']['links'][$cl]) ? trim($data['clients']['links'][$cl]):'javascript:void(0)';
			$update=$epdb->update('e_advclient',array('link'=>$link,'status'=>$status),array('ID'=>$cl));
			if($update){$update_msg=1;}
		}
	}
	if(!empty($update_msg)){
		 return array('success'=>'1','msg'=>'Advertise Update Successfully Done');
	}else
	 return array('success'=>'0','msg'=>'Sorry no change found');
}
?>