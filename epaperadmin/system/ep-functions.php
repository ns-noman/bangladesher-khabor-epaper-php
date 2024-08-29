<?php
function __( $text, $domain = 'default' ) {
	return $text;
	//return translate( $text, $domain );
}
function get_npage_option($nid=''){
	global $epdb;
	$pdate = '<option value="0">--Select--</option>';
	if(empty($nid)){
		$rows  = $epdb->get_results('SELECT * FROM e_page  ORDER BY pnumber ASC, pdate DESC');
	}
	else{
	  $page = $epdb->get_row("SELECT  p.pdate, p.ptype FROM e_page p, e_news n WHERE n.page_id=p.ID AND n.ID=".$nid." ORDER BY p.pnumber ASC");
	  $pDate = $page->pdate;
	  $ptype = $page->ptype;
	  $rows  = $epdb->get_results("SELECT * FROM e_page WHERE  pdate='".$pDate."' AND ptype='".$ptype."' ORDER BY pnumber ASC");
	}
	foreach($rows as $row){
		if(empty($nid)){
		  $val=$row->ID.":".$row->pdate.":".$row->ptype.":".$row->pnumber.':'.$row->img_medium;
		  $pdate .= '<option value="'.$val.'">'.$row->pnumber.'.'.$row->title.'('.$row->ptype.':'.$row->pdate.')'.'</option>';
		}
		else{
		  $val=$row->ID;
		  $pdate .= '<option value="'.$val.'">'.$row->pnumber.'.'.$row->title.'</option>';	
		}
	}
	return $pdate;
}
function get_spage_option($date=''){
	global $epdb;
	$active_page=get_options('active_page');
	$date = empty($date)? date('d-m-Y'):$date;
	$pdate = '<option value="0">--Select--</option>';
	$rows  = $epdb->get_results("SELECT * FROM e_page  WHERE pdate='".$date."' ORDER BY ID ASC");
	if(!empty($rows)){
	foreach($rows as $row){	
	    $selected=empty($active_page) ?'':'selected="selected"';
		$pdate .= '<option value="'.$row->ID.'" '.$selected.' >'.$row->title.'-'.$row->pnumber.'</option>';
	}
	}
	return $pdate;
}
function load_epage($date='',$page_type='regular',$page_number=1){
	global $epdb;
	$output = $where= '';
	//$active_page=get_options('active_page');
	$active_date=get_options('active_date');
	if(!empty($date)){
		$where =" pdate='".trim($date)."' AND ptype='".$page_type."' AND pnumber='".$page_number."' ";
	}else if(!empty($active_page) && !empty($active_date)){
		$where =" pdate='".$active_date."' AND pnumber='1' ";
	 }
	if(!empty($where)){
		$sql_page= "SELECT * FROM e_page WHERE ".$where.";";		
		$page  = $epdb->get_row($sql_page);
		
		if(!empty($page->ID)){
			$output .= '<img src="'.$page->img_medium.'" id="page-'.$page->ID .'" class="main-page-image" />';
			$output .=add_page_news($page->ID);
			$output .=add_page_arg($page->pdate,$page->ptype,$page->pnumber);
		}
		else{
			$output .='<h3>Sorry Page not found</h3>';
		}
	}
	else{
		$output .='<h3>Sorry No News Activated.</h3>';
	}
	return $output;
}
function add_page_news($pid){
	global $epdb;
	$sql_news= "SELECT * FROM e_news WHERE page_id ='".$pid."' ORDER BY ID ASC";
	$news_output='';
	$news  = $epdb->get_results($sql_news);
        
                
	$news_style='';
	foreach($news as $n){
		$news_style = 'style="width:'.$n->width.'px; height:'.$n->height.'px; top:'.$n->pos_top.'px;left:'.$n->pos_left.'px"';
		$news_output .='<a id="news-'.$n->ID.'" href="news.php?nid='.$n->ID.'" class="news-box eplightbox" '.$news_style.' data="'.$n->ID.'"></a>';
	}
	return $news_output;
}
function get_options($name){
	global $epdb;
	$sql_options= "SELECT option_value as val FROM e_options WHERE option_name ='".$name."';";
	$options = $epdb->get_row($sql_options);
	return !empty($options->val)? $options->val:'';
}

function add_page_arg($date,$page_type,$current_page){
	global $epdb;
	$sql_page= "SELECT COUNT(ID) as ptotal FROM e_page WHERE pdate ='".$date."' AND ptype='".$page_type."';";	
	$page_count = $epdb->get_row($sql_page);
	$page_max =!empty($page_count->ptotal)? $page_count->ptotal:0;
	$arg  ='';
	$arg .= '<input type="hidden" id="page_date" value="'.$date.'" />';
	$arg .= '<input type="hidden" id="page_type" value="'.$page_type.'" />';
	$arg .= '<input type="hidden" id="page_max" value="'.$page_max.'" />';
	$arg .= '<input type="hidden" id="page_current" value="'.$current_page.'" />';
	return $arg;
}
function get_all_page_list($date){
	global $epdb;
	$sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='regular' ORDER BY pnumber ASC;";
	$pages  		= $epdb->get_results($sql_pages);
	return $pages;
		
}
function get_all_page_list_odb_title($date){
	global $epdb;
	$sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='regular' AND is_list='1' GROUP BY title ORDER BY list_order ASC;";
	$pages  		= $epdb->get_results($sql_pages);
	return $pages;
}
function get_all_magazine($mag,$date=''){
	global $epdb;

	if(!empty($date)){	  
	  $sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='".$mag."' ORDER BY pnumber ASC;";
	  $pages  		= $epdb->get_results($sql_pages);
	}else{
	 $last_date  = "SELECT pdate FROM  e_page WHERE ptype='".$mag."'  GROUP BY  pdate ORDER BY pdate DESC";
	  $last_mag  		= $epdb->get_row($last_date);
	  $date=$last_mag->pdate;
	  $sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='".$mag."' ORDER BY pnumber ASC;";
	  $pages  		= $epdb->get_results($sql_pages);
	}
	return $pages;
}
function get_all_magazine_archive($mag,$date){
	global $epdb;
        	  
	  $sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='".$mag."' ORDER BY pnumber ASC;";
	  $pages  		= $epdb->get_results($sql_pages);
	  if(empty($pages)){
          $date_to_int = strtotime($date);   
	  $last_date  = "SELECT pdate FROM  e_page WHERE ptype='".$mag."' AND datetime < ".$date_to_int ." GROUP BY  pdate ORDER BY datetime DESC LIMIT 1";
	  $last_mag  		= $epdb->get_row($last_date);
	  $date=$last_mag->pdate;
	  $sql_pages  = "SELECT * FROM e_page WHERE pdate ='".$date."' AND ptype='".$mag."' ORDER BY pnumber ASC;";
	  $pages  		= $epdb->get_results($sql_pages);
          }
	return $pages;
}
function uni_bang($date){
	$date_array= explode(' ',$date);
	if(empty($date_array)) { return $date;}
	$eng_month=strtolower($date_array[1]);
    $lang =array();
	
		$lang['jan']         = "জানুয়ারী";
		$lang['feb']         = "ফেব্রুয়ারী";
		$lang['mar']         = "মার্চ";
		$lang['apr']         = "এপ্রিল";
		$lang['may']         = "মে";
		$lang['jun']         = "জুন";
		$lang['jul']         = "জুলাই";
		$lang['aug']         = "অগাস্ট";
		$lang['sep']         = "সেপ্টেম্বর";
		$lang['oct']         = "অক্টোবর";
		$lang['nov']         = "নভেম্বর";
		$lang['dec']         = "ডিসেম্বর";
		$lang['january']     = "জানুয়ারী";
		$lang['february']    = "ফেব্রুয়ারী";
		$lang['march']       = "মার্চ";
		$lang['april']       = "এপ্রিল";
		$lang['june']        = "জুন";
		$lang['july']        = "জুলাই";
		$lang['august']      = "অগাস্ট";
		$lang['september']   = "সেপ্টেম্বর";
		$lang['october']     = "অক্টোবর";
		$lang['november']    = "নভেম্বর";
		$lang['december']    = "ডিসেম্বর";
    $engNumber = array(1,2,3,4,5,6,7,8,9,0);
    $bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
    
	$date = 	$date_array[0].' '.$lang[$eng_month].' '.$date_array[2];
	$converted = str_replace($engNumber, $bangNumber, $date );
   return $converted ;
}
function load_archives_epage($date,$page_type='regular',$page_number=1){
	global $epdb;
	$output = $where= '';
	$active_page=$page_number;
	$active_date=trim($date);
    if(!empty($active_page) && !empty($active_date)){
		$where =" pdate='".$active_date."' AND pnumber='".$active_page."' ";
		
	 }
	if(!empty($where)){
		$sql_page= "SELECT * FROM e_page WHERE ".$where.";";		
		$page  = $epdb->get_row($sql_page);
		
		if(!empty($page->ID)){
			$output .= '<img src="'.$page->img_medium.'" id="page-'.$page->ID .'" class="main-page-image" />';
			$output .=add_page_news($page->ID);
			$output .=add_page_arg($page->pdate,$page->ptype,$page->pnumber);
		}
		else{
			$output .='<h3>Sorry Page not found</h3>';
		}
	}
	else{
		$output .='<h3>Sorry No News Activated.</h3>';
	}
	return $output;
}
function popup_get_news($nid){
	global $epdb;
	$sql_news= "SELECT * FROM e_news WHERE ID='".$nid."'";
	$news_output='';
	$news  = $epdb->get_row($sql_news);
	if(!empty($news->uri)){
	 return $news;
	}
	else return 0;
}
function news_for_link($pid){
	global $epdb;
	$sql_news= "SELECT * FROM e_news WHERE page_id ='".$pid."' ORDER BY ID ASC";
	$news_output='';
	$news  = $epdb->get_results($sql_news);
	$news_style='';
	foreach($news as $n){
		$news_style = 'style="width:'.$n->width.'px; height:'.$n->height.'px; top:'.$n->pos_top.'px;left:'.$n->pos_left.'px"';
		$news_output .='<a id="news-'.$n->ID.'" href="javascript:void(0)" class="news-box eplightbox" '.$news_style.' data="'.$n->ID.'" onClick="addNewsLink(this)">';
		$news_output .= '<img width="'.$n->width.'" height="'.$n->height.'" src="'.str_replace("/epaperadmin","",$n->uri).'"/>';
		$news_output .= '</a>';
	}
	return $news_output;
}
function news_for_page($pid){
	global $epdb;
	$sql_news= "SELECT * FROM e_news WHERE page_id ='".$pid."' ORDER BY ID ASC";
	$news_output='';
	$news  = $epdb->get_results($sql_news);
	$news_style='';
	foreach($news as $n){		
		$news_output .='<div class="cnewsblock  ui-state-disabled" style="position: absolute; width:'.$n->width.'px; height:'.$n->height.'px; top:'.$n->pos_top.'px;left:'.$n->pos_left.'px" data="'.$n->ID.'" aria-disabled="true">';
		$news_output .= '<a class="nsave" title="Save News" href="javascript:void(0)">Save</a>';
                $news_output .= '<ul class="ui-helper-reset"><a href="javascript:void(0)" onclick="cancelNews(this)" title="Remove" data="'.$n->ID.'" class="nremove">Remove</a></ul>';
                
		if(empty($n->ref_link)){
		  $news_output .= '<a class="nlink" title="Add Readmore News Link" onclick="addParentNews(this)" href="javascript:void(0)">Link</a>';
		}else{
			 $news_output .= '<a class="nlink activated" title="Add Readmore News Link" onclick="addParentNews(this)" href="javascript:void(0)">Link</a>';
		}
		$news_output .='<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>';
	}
	return $news_output;
}
function get_advertise($locations,$rows="single"){
	global $epdb;
	$sql_adv= "SELECT adv.* FROM e_advertise adv WHERE adv.locations ='".$locations."' AND adv.status=1 ORDER BY adv.order ASC, ID DESC";
	if($rows == 'array'){
	 $results = $epdb->get_results($sql_adv);	
	}
	else{
		$results = $epdb->get_row($sql_adv);	
	}
	return $results;
}
function load_advertise($locations,$rows="single"){
	global $epdb;
	$width  = 'auto';
	$height = 'auto';
	switch($locations){
		case 'left_of_logo':
		case 'right_of_logo':
		  $width  = '160px';
		  $height = '60px';
		break;
		case 'top_of_paper':
		  $width  = '750px';
		break;
		case 'below_1st_feature':
		case 'below_2nd_feature':
		case 'below_3rd_feature':
		case 'left_side':
		  $width  = '160px';
		break;
		case 'right_side':
		  $width  = '180px';
		break;
		case 'top_footer':
		  $width  = '940px';
		break;
		case 'popup':
		  $height  = '50px';
		break;
		default:
	     $width  = 'auto';
	     $height = 'auto';
		 break;
	}
	$style='width:'.$width.'; height:'.$height;
	
	$count_sql = "SELECT COUNT(adv.ID) as total_row FROM
			  e_advertise adv  
			  WHERE 
			  adv.locations='".$locations."' 
			  AND adv.status='1'			  
			  AND adv.is_slide=1";
			  
	$slide_count = $epdb->get_row($count_sql);
    if($slide_count->total_row >1){		
		if($locations == 'left_side' || $locations == 'right_side'){
			$client_group = "SELECT adv.client_id FROM e_advertise adv WHERE adv.locations='".$locations."' AND adv.status='1' GROUP BY adv.client_id ORDER BY adv.order ASC";
			$adv_client = $epdb->get_results($client_group);
			foreach($adv_client as $client){
				$chiled_count="SELECT COUNT(adv.ID) as total_row FROM e_advertise adv  WHERE adv.locations='".$locations."' AND adv.status='1' AND adv.is_slide=1 AND adv.client_id=".$client->client_id.";";
				$cldcount= $epdb->get_row($chiled_count);
				 if($cldcount->total_row >1){
					 echo '<li>';
					 get_sliding_adv($locations,$style,$client->client_id);
					 echo '</li>';
				 }else{
						$adv_query ="SELECT adv.*,client.name,client.link FROM
							  e_advertise adv,e_advclient client 
							  WHERE 
							  adv.locations='".$locations."' 
							  AND adv.status='1'
							  AND adv.client_id=".$client->client_id."
							  AND adv.client_id =client.ID 
							  ORDER BY adv.order ASC";
						$adv = $epdb->get_row($adv_query);
						 if(empty($adv)){return;}
						 $box ='<li>'; 
						 $box .='<a href="'.$adv->link.'" target="_blank" title="'.$adv->name.'">';
						 $box .='<img class="site-advertise" style="'.$style.'" alt="'.$adv->name.'" src="'.$adv->uri.'">';
						 $box .='</a>';
						 $box .='</li>'; 
						 echo  $box;
				 }
			}
		}else{
			//echo $slide_count->total_row;
			get_sliding_adv($locations,$style);
		}
	}else{
	    $adv_query ="SELECT adv.*,client.name,client.link FROM
			  e_advertise adv,e_advclient client 
			  WHERE 
			  adv.locations='".$locations."' 
			  AND adv.status='1'
			  AND adv.client_id =client.ID 
			  ORDER BY adv.order ASC";
		$adv = $epdb->get_row($adv_query);
		 if(empty($adv)){return;}
		 $box  ='<a href="'.$adv->link.'" target="_blank" title="'.$adv->name.'">';
		 $box .='<img class="site-advertise" style="'.$style.'" alt="'.$adv->name.'" src="'.$adv->uri.'">';
		 $box .='</a>';
		 echo  $box;
	}
  
}
function is_arcive($date){
	$orgtime=date('d-m-Y',strtotime($date));
	global $epdb;
	$count= "SELECT COUNT(pnumber) as ptotal FROM e_page WHERE pdate='".$orgtime."' AND ptype='regular'";
	$results = $epdb->get_row($count);
	if(!empty($results->ptotal))
	   return $results->ptotal;
	else return ;
}
function get_multi_blok_adv(){
}
function get_sliding_adv($location,$style,$client=''){
	global $epdb;
	$where='';
	if(!empty($client)){
	$where = " AND adv.client_id=".$client;
	}
	
	$gallery_query ="SELECT adv.*,client.name,client.link FROM
			  e_advertise adv,e_advclient client 
			  WHERE 
			  adv.locations='".$location."' 
			  AND adv.is_slide='1' 
			  AND adv.status='1'
			  ".$where."
			  AND adv.client_id =client.ID 
			  ORDER BY adv.order ASC";
	$gallery = $epdb->get_results($gallery_query);
 
	$slide  = '<div class="epaper-adv-slidebox" style="'.$style.'">';
	 foreach($gallery as $gl){
		 $slide .='<a href="'.$gl->link.'" target="_blank" title="'.$gl->name.'">';
		 $slide .='<img class="site-advertise" style="'.$style.'" alt="'.$gl->name.'" src="'.$gl->uri.'">';
		  $slide .='</a>';
	 }
	$slide .= '</div>';
	
	echo $slide;
}