<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('basecontroller.php');
class Welcome extends basecontroller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $date = $this->uri->segment(1,0);
            $pnumber = $this->uri->segment(2,1);
			if($date=='0'){
				$date=$this->get_options('active_date');
				redirect(base_url().$date);
			}
			$this->data['active_date'] =  $date;//$this->get_options('active_date');         

            $page =  $this->SiteModel->getfirstrow('e_page', '*', array('pdate'=>$date,'pnumber'=>$pnumber,'ptype'=>'regular'), 'ID DESC', 1, 0);
            
            if(count($page)==0)
    		{
    		    $page =  $this->SiteModel->getfirstrow('e_page', '*', array('pdate'=>$date,'ptype'=>'regular'), 'pnumber ASC', 1, $pnumber-1);   //$pnumber => 12
    		}
            
            $output = '';	
	 
			if(!empty($page['ID'])){
				$output .= '<img src="'.$page['img_medium'].'" id="page-'.$page['ID'] .'" class="main-page-image" />';
				$output .=$this->add_page_news($page['ID']);
				$output .=$this->add_page_arg($page['pdate'],$page['ptype'],$page['pnumber']);
			}
            
            $this->data['page_content'] = $output;
               $this->data['page_image'] = isset($page['img_medium']) ? $page['img_medium'] : '';       
                     
            $this->data['pages'] =  $this->SiteModel->getlist('e_page', '*', array('pdate'=>$date, 'is_list'=>'1', 'ptype'=>'regular'), 'list_order ASC', 100, 0);
			
			$this->data['all_pages'] =  $this->SiteModel->getlist('e_page', '*', array('pdate'=>$date, 'ptype'=>'regular'), 'list_order ASC', 100, 0);
			 			
			$this->data['pages_list'] =  $this->SiteModel->getlist('e_page', '*', array('pdate'=>$date,   'ptype'=>'regular'), 'list_order ASC', 100, 0);
			
			$weather = @file_get_contents('http://api.openweathermap.org/data/2.5/weather?id=1185241&lang=en&units=metric&APPID=8f5de18abbc963cb66b7b05f85fa06b7');

    	if($weather !== FALSE)
	{   $weather = json_decode($weather);
		$this->data['weather'] =  $weather;
	}
			    
                 
			$this->load->library('pagination');

			$config['first_url'] = '1';
			$config['use_page_numbers'] = TRUE;
			$config['base_url'] = site_url($date);
			$config['total_rows'] = count($this->data['pages_list']);
			$config['per_page'] = 1;
			$config["uri_segment"] = 2;
			//$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = ( $pnumber > 4) ? ( $pnumber > 9 ? 3 : 4) : 6;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'শুরু';
			$config['last_link'] = 'শেষ';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'আগের';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'পরের';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><span>';
			$config['cur_tag_close'] = '</span></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';        
			$this->pagination->initialize($config);        
			$this->data['pagination'] = $this->pagination->create_links();
 
			 
	           $this->data['pnumber'] = $pnumber;
			 
			  $this->data['p'] = $page;
		   $this->load->view('index.php',$this->data);                     
		 
		
		 
	
	}
        
        
        
        
        
      function add_page_news($pid){
	 
            $news =  $this->SiteModel->getlist('e_news', '*', array('page_id'=>$pid), 'ID ASC');
	
          
	 
	$news_output='';
	 
        
      
	$news_style='';
	foreach($news as $n){
		$news_style = 'style="width:'.$n['width'].'px; height:'.$n['height'].'px; top:'.$n['pos_top'].'px;left:'.$n['pos_left'].'px"';
		//$news_output .='<a data-toggle="modal"  data-target="#myModal" id="news-'.$n['ID'].'" href="'.site_url('detail/'.$n['ID']).'" class="news-box eplightbox" '.$news_style.' data="'.$n['ID'].'"></a>';
	$news_output .='<a  href="'.site_url('article/'.$n['ID'].'/'.rand(0,9999)).'" class="news-box iframe" '.$news_style.' data-newsid="'.$n['ID'].'"></a>';
                
                
        }
	return $news_output;
}
function get_options($name){
    
	 $options =  $this->SiteModel->getcolumn('e_options', 'option_value', array('option_name'=>$name)); 
         
         
	  
	return !empty($options)? $options :'';
}

function add_page_arg($date,$page_type,$current_page){
	 
	$sql_page= "SELECT COUNT(ID) as ptotal FROM e_page WHERE pdate ='".$date."' AND ptype='".$page_type."';";	
	
        $page_count = $this->SiteModel->query($sql_page); //$epdb->get_row();
        
	$page_max = isset($page_count[0]['ptotal'])? $page_count[0]['ptotal']:0;
	$arg  ='';
	$arg .= '<input type="hidden" id="page_date" value="'.$date.'" />';
	$arg .= '<input type="hidden" id="page_type" value="'.$page_type.'" />';
	$arg .= '<input type="hidden" id="page_max" value="'.$page_max.'" />';
	$arg .= '<input type="hidden" id="page_current" value="'.$current_page.'" />';
	return $arg;
}  
        
     
     
     
     
     


function detail_org($nid,$rand = ''){         
             $news =  $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$nid), 'ID DESC', 1, 0);
             $parent_news  = $this->SiteModel->getfirstrow('e_news', '*', array('ref_link'=>$nid), 'ID DESC', 1, 0);
			 
			 
             
             if(count($parent_news)>0) {
                  $this->data['parentnews'] =   $parent_news["ID"];
                 
               	        if(!empty($parent_news['uri'])){
			                 $parentphoto = $parent_news['uri']; 
			            }
                 
                 
                  
			   } else{ 
                $this->data['parentnews']  = 0;
				$this->data['id']  = $news['ID'];
               }				
            
			$this->data['news'] = '';	 	 
			if(!empty($news['uri'])){
			    $this->data['news'] =   $news;
			   
			}


 
$child_news  = $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$news['ref_link']), 'ID DESC', 1, 0);

if(count($child_news)>0) {
                  $this->data['child_news'] =   $child_news["ID"];
                
               	        if(!empty($child_news['uri'])){
               	            
			                 $childphoto = $child_news['uri']; 
			            }
                 
                 
                  
			   }






 




            $this->load->view('detail.php',$this->data);                     
    }
    
    
    
    
    
    

function detail($nid,$rand = ''){         
             $news =  $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$nid), 'ID DESC', 1, 0);
             $parent_news  = $this->SiteModel->getfirstrow('e_news', '*', array('ref_link'=>$nid), 'ID DESC', 1, 0);
			 
			 
             
             if(count($parent_news)>0) {
                  $this->data['parentnews'] =   $parent_news["ID"];
                 
               	        if(!empty($parent_news['uri'])){
			                 $parentphoto = $parent_news['uri']; 
			            }
                 
                 
                  
			   } else{ 
                $this->data['parentnews']  = 0;
				$this->data['id']  = $news['ID'];
               }				
            
			$this->data['news'] = '';	 	 
			if(!empty($news['uri'])){
			    $this->data['news'] =   $news;
			   
			}


 
$child_news  = $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$news['ref_link']), 'ID DESC', 1, 0);

if(count($child_news)>0) {
                  $this->data['child_news'] =   $child_news["ID"];
                
               	        if(!empty($child_news['uri'])){
               	            
			                 $childphoto = $child_news['uri']; 
			            }
                 
                 
                  
			   }










if(!isset($parentphoto) && !isset($childphoto) )
{
    
     $this->data['image'] =   $news['uri'];
     $this->data['showimage1'] =   $news['uri'];
     
    
}

elseif(!isset($parentphoto) && isset($childphoto) ) {
   
    $this->data['image'] = $this->createimage($news['uri'],$childphoto,$nid.'merged.jpg'); 
    
     $this->data['showimage1'] =   $news['uri'];
     $this->data['showimage2'] =   $childphoto;
}

elseif(isset($parentphoto) && !isset($childphoto) ) {
    
    $this->data['image'] = $this->createimage($parentphoto,$news['uri'],$nid.'merged.jpg'); 
    
    $this->data['showimage1'] =   $parentphoto;
    $this->data['showimage2'] =   $news['uri']; 
    
}

 





            $this->load->view('detail.php',$this->data);                     
    }
    
    
    
    
    
    
    
    
    
    
    function createimage($filename_x,$filename_y, $filename_result,$type='vertical'){
        
        
        
        
 $filename_x = '/home/bkhabor/epaper/'.str_replace('http://epaper.bangladesherkhabor.net/','',$filename_x) ;
 
 $filename_y = '/home/bkhabor/epaper/'.str_replace('http://epaper.bangladesherkhabor.net/','',$filename_y) ;
  
 

 // Get dimensions for specified images

 list($width_x, $height_x) = getimagesize($filename_x);
 list($width_y, $height_y) = getimagesize($filename_y);

 // Create new image with desired dimensions
 
 
 
 if($type=='vertical'){
 ////////////////////////////////////
 ///for vertical////////////////////
 ///////////////////////////////////
$merged_width = $width_x > $width_y ? $width_x : $width_y;  
$merged_height = $height_x + $height_y;

 }
 
 
 
 else{
 ////////////////////////////////////
 ///for horizontal////////////////////
 ///////////////////////////////////
 
 $merged_height = $height_x > $height_y ? $height_x : $height_y;  
 $merged_width = $width_x + $width_y; //get highest width as result image width
 }
 
 
 
 
 if(0) {

if($merged_width >= $merged_height) {
    $ratio = $merged_width/$merged_height;
    if($ratio >= 1.9)
       $merged_height = floor($merged_width / 1.9);
       
     else {
     $merged_width = floor( $merged_height * 1.9);    
         
     }   
    
}

else {
    //$ratio = $merged_width/$merged_height;
    $merged_width = floor( $merged_height * 1.9);    
      
    
}
 }



 
$image = imagecreatetruecolor($merged_width, $merged_height);


$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);


 // Load images and then copy to destination image

 $image_x = imagecreatefromjpeg($filename_x);
 $image_y = imagecreatefromjpeg($filename_y);
 
 
if($type=='vertical'){
 ////////////////////////////////////
 ///for vertical////////////////////
 ///////////////////////////////////
imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
//place at right side of $img1
imagecopy($image, $image_y, 0,$height_x , 0, 0, $width_y, $height_y);
}



else{
 ////////////////////////////////////
 ///for horizontal////////////////////
 ///////////////////////////////////
 
 imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
 imagecopy($image, $image_y, $width_x, 0, 0, 0, $width_y, $height_y);
 
}

 // Save the resulting image to disk (as JPEG)

 imagejpeg($image, '/home/bkhabor/epaper/assets/files/'.$filename_result);

  // echo $merged_width.' >>>'. $merged_height;
return 'http://epaper.bangladesherkhabor.net/assets/files/'.$filename_result;
 // Clean up

 imagedestroy($image);
 imagedestroy($image_x);
 imagedestroy($image_y);

    
      
      
    }
    
    

	function article_print($nid,$rand = ''){         
             $news =  $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$nid), 'ID DESC', 1, 0);
             $parent_news  = $this->SiteModel->getfirstrow('e_news', 'ID', array('ref_link'=>$nid), 'ID DESC', 1, 0);
			 
			 
             
             if(count($parent_news)>0) {
                  $this->data['parentnews'] =   $parent_news["ID"];
				  $news_first =  $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$parent_news["ID"]), 'ID DESC', 1, 0);
                  $this->data['news_first'] =   $news_first;
			   } else{ 
                $this->data['parentnews']  = 0;
               }				
            
			$this->data['news'] = '';	 	 
			if(!empty($news['uri'])){
			    $this->data['news'] =   $news;
			}
			
			$this->data['news_second'] = '';
			if($news['ref_link']){
				$news_second =  $this->SiteModel->getfirstrow('e_news', '*', array('ID'=>$news['ref_link']), 'ID DESC', 1, 0);
			    $this->data['news_second'] =   $news_second;
			}
		
            $this->load->view('article_print.php',$this->data);                     
    }
    
    public function weather()
	{  exit;
		$weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?id=1185241&lang=en&units=metric&APPID=8f5de18abbc963cb66b7b05f85fa06b7');

		$weather = json_decode($weather);
		 
		$this->data['weather'] =  $weather;	

        echo   $this->load->view('weather',$this->data,true);		
	}
        
   
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */