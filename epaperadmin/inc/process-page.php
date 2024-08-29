<?php
require_once('ep-config.php');
require_once(SYSPATH.'ep-image.class.php');
function add_new_page($data){
global $setting;
extract($setting);
$date     	 	= strip_tags($data['news_date']);
$page_type 		= strip_tags($data['page_type']);
$page_heading   = strip_tags($data['page_heading']);
$page_no        = strip_tags($data['page_no']);
$image_name     = strip_tags($data['image_name']);
$todays_list     = !empty($data['is_list_page'])? '1':'0';
$list_order     = strip_tags($data['page_list_order']);
global $epdb;

	$exists_page=$epdb->get_row("SELECT ID FROM e_page WHERE pdate='".$date."' AND pnumber='".$page_no."' AND ptype='".$page_type."'");
	if(!empty($exists_page->ID)){
	  	return array('success'=>'0','msg'=>'This Page Exists !! You need to remove first.');
	 }
	 
if(file_exists(UPLOAD_TEMPPATH.$image_name)){
	$tempimage   = UPLOAD_TEMPPATH.$image_name;
	$path_parts  = pathinfo($tempimage);
	$extn        = $path_parts['extension'];
	$date_path   = str_replace('-','_',$date);
	$root_page_path = PAGE_UPLOAD.'/'.$date_path;
	$site_url = str_replace("/epaperadmin","",$site_url);
	$root_img_uri   =$site_url.'/images/'.$date_path;
	$file_full   = $root_page_path.'/'.$page_type.'_'.$page_no.'_full.'.$extn;
	$file_larg   = $root_page_path.'/'.$page_type.'_'.$page_no.'_larg.'.$extn;
	$file_medium = $root_page_path.'/'.$page_type.'_'.$page_no.'_medium.'.$extn;
	$file_small  = $root_page_path.'/'.$page_type.'_'.$page_no.'_small.'.$extn;
	$img_full_uri=$img_medium_uri=$img_small_uri='';
	
	//	return array('success'=>'0','msg'=>$site_url);
    if(!is_dir($root_page_path)){mkdir($root_page_path,0777);}
	$resizeObj = new resize($tempimage);
	if($page_type == 'regular'){	
		$resizeObj -> resizeImage($max_img_with,$max_img_height, 'exact');
		$resizeObj -> saveImage($file_full, 100);
		if(file_exists($file_full)){$img_full_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_full.'.$extn;}
		
		$resizeObj -> resizeImage($medium_width,$medium_height, 'exact');
		$resizeObj -> saveImage($file_medium , 100);
		if(file_exists($file_medium)){$img_medium_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_medium.'.$extn;}
		
		$resizeObj -> resizeImage($small_width,$small_height, 'exact');
		$resizeObj -> saveImage($file_small, 100);
		if(file_exists($file_small)){$img_small_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_small.'.$extn;}
	}else{
		$resizeObj -> resizeImage($magazine_max_width,$magazine_max_height,'exact');
		$resizeObj -> saveImage($file_full, 100);
		if(file_exists($file_full)){$img_full_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_full.'.$extn;}
		
		$resizeObj -> resizeImage($magazine_mid_width,$magazine_mid_height, 'exact');
		$resizeObj -> saveImage($file_medium , 100);
		if(file_exists($file_medium)){$img_medium_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_medium.'.$extn;}
		
		$resizeObj -> resizeImage($magazine_small_width,$magazine_small_height, 'exact');
		$resizeObj -> saveImage($file_small, 100);
		if(file_exists($file_small)){$img_small_uri=$root_img_uri.'/'.$page_type.'_'.$page_no.'_small.'.$extn;}
	}
        
	$addpage=array(
            'title'=>$page_heading,
            'pdate'=>$date,
            'ptype'=>$page_type,
            'pnumber'=>$page_no,
            'img_small'=>$img_small_uri,
            'img_medium'=>$img_medium_uri,
            'img_full'=> $img_full_uri,
            'is_list'=>$todays_list,
            'list_order'=>$list_order,
            'status'=>1,
            'datetime'=>strtotime($date)
            );
	  
//	print_r($addpage);

	$epdb->insert('e_page',$addpage,array('%s','%s','%s','%d','%s','%s','%s','%s','%d','%d'));
	if(!empty($epdb->insert_id)){
		return array('success'=>'1','msg'=>'Successfully Page Publish');
	}else{
		return array('success'=>'0','msg'=>$epdb->db_version());
	}
 }
 else{
	 return array('success'=>'0','msg'=>'Image Does not upload properly. try again.');
	 }
}
function load_all_page($data){
	global $epdb;
    global $setting;
    extract($setting);
	$pdate=trim($data['pdate']);
	$ptype=trim($data['ptype']);
	$page_query="SELECT * FROM e_page WHERE  pdate='".$pdate."' AND ptype='".$ptype."' ORDER BY pnumber ASC";
	$page_result=$epdb->get_results($page_query);
	if(!empty($page_result)){
		$html='<form onsubmit="return update_epage(this)" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="update_pages" /><table width="100%" class="datalist">
				 <thead>
				  <tr>
				   <th>Page Number</th>
				   <th>Image</th>
				   <th>Title</th>
				   <th>Date</th>
				   <th>Type</th>
				   <th>In page list</th>
				   <th>Page list order</th>
				   <th>Remove</th>
				  </tr>
				 </thead> <tbody>';
		foreach($page_result as $page){
			$html .='<tr>';
			$html .='<td><input type="text" size="2" name="page_number['.$page->ID.']" value="'.$page->pnumber.'"/></td>';
			$html .='<td><img src="'.$page->img_small.'" /><input type="hidden" name="page_ids['.$page->ID.']" value="'.$page->ID.'" /></td>';
			$html .='<td><input type="text"  name="page_title['.$page->ID.']" value="'.$page->title.'"/></td>';
			$html .='<td><input type="text" size="10" name="page_date['.$page->ID.']" value="'.$page->pdate.'"/></td>';
			$html .='<td>';
			$html .='<select name="page_type['.$page->ID.']">';
			if($page->ptype ==="regular"){
				$html .='<option value="regular" selected="selected">আজকের পত্রিকা</option>';
			}else{
				$html .='<option value="regular">আজকের পত্রিকা</option>';
			}
			foreach($feature_page as $fpage=>$title){
				$selected=($page->ptype === $fpage) ?'selected="selected"':''; 
			   $html .='<option value="'.$fpage.'" '.$selected.'>'.$title.'</option>';
			}
			$is_in_page_list=!empty($page->is_list)? 'checked="checked"':'';
			$html .='<td><input type="checkbox"  '.$is_in_page_list.' name="in_page_list['.$page->ID.']" value="1"></td>'; 
			$html .='<td><input type="text" size="2" name="in_page_list_order['.$page->ID.']" value="'.$page->list_order.'"/></td>';
			$html .='<td><input type="checkbox" name="remove_page['.$page->ID.']" value="1"></td>'; 
			$html .='</tr>';	
			
		}
		$html .='</tbody></table>';
		$html .='<div class="form-element form-element-submit"><input type="submit" class="submit_button" value="Update" id="form-setting-site-submit"></div>';
		$html .='</form>';	 
		 return array('success'=>'1','page_list'=>$html);
	}
	else{
		 return array('success'=>'0','msg'=>'No page found.');
	}
}
function update_all_pages($data){
	
	$all_page=$data['page_ids'];
	$count=':';
	global $epdb;
	foreach($all_page as $page_id){
	  $count=   $page_id.':';
	  if(!empty($data['remove_page'][$page_id])){
		  $epdb->query('DELETE FROM e_page WHERE ID ='.intval($page_id).';');
		  $update_msg=1;
		  //$count .=   'Remove:';
	  }
	  else{
		
		 $pnumber = intval($data['page_number'][$page_id]); 
		 $ptitle  = trim($data['page_title'][$page_id]);
		 $pdate   = trim($data['page_date'][$page_id]);
		 $ptype   = trim($data['page_type'][$page_id]);
		 $page_list = empty($data['in_page_list'][$page_id])? '0':'1';
		 $page_list_order = intval($data['in_page_list_order'][$page_id]);
		// $up=array('title'=>$ptitle,'pdate'=>$pdate,'ptype'=>$ptype,'pnumber'=>$pnumber,'is_list'=>$page_list,'list_order'=>$page_list_order);
		 //$count .=   'update:';
         $update=$epdb->update('e_page',array('title'=>$ptitle,'pdate'=>$pdate,'ptype'=>$ptype,'pnumber'=>$pnumber,'is_list'=>$page_list,'list_order'=>$page_list_order),array('ID'=>$page_id));
			if($update){$update_msg=1;}
	  }
	  
	}
	if(!empty($update_msg)){
		 return array('success'=>'1','msg'=>'Page Update Successfully');
	}else
	 return array('success'=>'0','msg'=>'There is no changed');
}
?>