<?php
require_once('ep-config.php');
function add_new_news($data){
require_once(SYSPATH.'ep-image-crop.class.php');
global $setting;
extract($setting);


$pID     	 	= strip_tags($data['pID']);
$nwidth 		= strip_tags($data['nwidth']);
$nheight        = strip_tags($data['nheight']);
$ntop           = intval(strip_tags($data['ntop']));
$nleft          = intval(strip_tags($data['nleft']));
$nwidth         =intval($nwidth+4);
$nheight         =intval($nheight+4);
global $epdb;
	$exists_page=$epdb->get_row("SELECT title,pdate,pnumber,ptype,img_full FROM e_page WHERE ID='".$pID."'");
	if(!empty($exists_page->ID)){
	  	return array('success'=>'0','msg'=>'Invalide Page :( ');
	 }
$ntitle        = $exists_page -> title;	 
$date_path     = str_replace('-','_',$exists_page->pdate);
$file_ext      = explode(".",$exists_page->img_full);
$file_path     = explode("/",$exists_page->img_full);
$get_ext       = end($file_ext);
$file_name     = end($file_path);
$extn          = strtolower($get_ext);	
 
$full_image_path = PAGE_UPLOAD.$date_path.'/'.$file_name;	
$root_news_path  = PAGE_UPLOAD.$date_path.'/';
$root_news_uri  = $site_url.'/images/'.$date_path.'/';
if(file_exists($full_image_path)){

	$news_image= $exists_page->ptype.'_'.$pID.'_news_'.time().'.'.$extn;
	$new_crop_image   = $root_news_path.$news_image;
	$newX=floatval($ntop*$crop_ratio + 0.5);
	$newY=floatval($nleft*$crop_ratio + 0.5);
	$newWidth=floatval($nwidth * $crop_ratio + 0.5);
	$newheight=floatval($nheight * $crop_ratio + 0.5);
	$img = new image();
	$img->source($full_image_path);
	$img->crop($newY,$newX,$newWidth,$newheight);
	$img->create($new_crop_image);
	$news_image_url=$root_news_uri.$news_image;
	$addnews=array('title'=>$ntitle,'pos_top'=>$ntop,'pos_left'=>$nleft,'width'=>$nwidth,'height'=>$nheight,'uri'=>$news_image_url,'page_id'=> $pID,'ref_link'=>'0');
	$epdb->insert('e_news',$addnews);
	if(!empty($epdb->insert_id)){
		return array('success'=>'1','msg'=>'Successfully news Publish','nid'=>$epdb->insert_id);
	}else{
		return array('success'=>'0','msg'=>'Sorry Connection Problem try again with valid informations');
	}
 }
 else{
	 return array('success'=>'0','msg'=>'Image Does not upload properly. try again.');
	 }
}
function ajax_load_page_news_links($data){
	$news = news_for_link($data['pid']);
	return array('success'=>'1','news'=>$news,'msg'=>'kljsdlkjaklsjd');
}
function ajax_load_page_news($data){
	$news = news_for_page($data['pid']);
	return array('success'=>'1','news'=>$news,'msg'=>'kljsdlkjaklsjd');
}
function set_ref_link($data){
	global $epdb;
	$nid=intval($data['lfor']);
	$rlink=intval($data['rlink']);
	$update = $epdb->update('e_news',array('ref_link'=>$rlink),array('ID'=>$nid));
	if(!empty($update)){
		return array('success'=>'1','msg'=>'Successfully added Link');
	}
	else{
		return array('success'=>'0','msg'=>'Seorry Connection Problem try again with valid informations');
	}
}
function get_pages_for_select($date){
	global $epdb;
	$pdate = '<option value="0">--Select--</option>';
	if(empty($date)){
		return array('success'=>0,'msg'=>'Please Select a date!!');
	}

	  $page = $epdb->get_results("SELECT  * FROM e_page WHERE pdate='".$date."' ORDER BY list_order ASC");	
	foreach($page as $row){

		  $val=$row->ID.":".$row->pdate.":".$row->ptype.":".$row->pnumber.':'.$row->img_medium;
		  $pdate .= '<option value="'.$val.'">'.$row->pnumber.'.'.$row->title.'('.$row->ptype.')'.'</option>';
	}
	return array('success'=>1,'option'=>$pdate );
}
?>