<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


<meta name="Description" content="<?php echo isset($description) ? $description : $siteinfo["MetaDescription"];?>">




<title><?php echo isset($title) ? $title : $siteinfo["HomePageTitle"]; ?></title>

	 <meta property="og:type"                 content="website"/> 
     <meta property="og:url"                  content="<?php echo current_url(); ?>"/>
     <meta property="og:site_name"            content="<?php echo $siteinfo["HomePageTitle"]; ?>"/>
     <meta property="og:image"                content="<?php echo isset($image) ? $image : $this->config->item('assets_url').$siteinfo["Logo"]; ?>"/>
     <meta property="og:title"                content="<?php echo isset($title) ? $title : $siteinfo["SiteName"]; ?>"/>
	 <meta property="og:description"          content="<?php echo isset($description) ? $description : $siteinfo["MetaDescription"];?>"/> 
	   
      
<link rel="shortcut icon" href="<?php echo $this->config->item('assets_url').$siteinfo["FavIcon"];?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>



 <style>
          .inline { font-size: 20px; text-decoration: none; color: #030303}   
           
             
         </style>

         <style media="print">
           
          
           
          @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
          
         </style>

         
         
          <style>
            .no-print a
    {
        padding: 5px;
    }
           
    .print{
   display : none;
}

@media print {
    .print {
       display : block;
    }
}
.border{
    padding: 5px 0;
    border:none;
    border-top: solid 1px #ccc;
     border-bottom: solid 1px #ccc;
    
}   


@page { size: auto;  margin: 0mm; }


   
         </style>

<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/contents/css/colorbox.css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "fc3b7463-f15d-4d7e-bc93-5ad428477cde", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script language="javascript" type="text/javascript"> 
function windowClose() { 
window.open('','_parent',''); 
window.close();
 
} 
</script>
	<!-- Google adsense -->
<script data-ad-client="ca-pub-2872207974896528" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115325801-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115325801-2');
</script>

</head>
<body>
  
  
   
                     
                <?php

              $crop_ratio = 1.27;
            //  echo floatval($news['width'])*floatval($crop_ratio);
if(empty($news)){ echo '<h1>Sorry news not found!!!</h1>'; exit();}	
$exheight=44;
if(intval(intval($news['width'])*floatval($crop_ratio)) <400){$exheight=88;}

$width  = ($exheight+4)+floatval($news['width'])*floatval($crop_ratio);
$height = ($exheight+4)+floatval($news['height'])*floatval($crop_ratio);
?>

    
<div style=" text-align: center;  clear:both;">
    
    <p align="center " class="no-print">
       <a href="http://www.maguragroup.com.bd/" target="_blank">  <img style="border: solid 1px #ccc;" src="http://epaper.bangladesherkhabor.net/assets/ads/728X90.jpg" alt=""></a>
    </p>
    
    <p align="center" class="print">
       <img src="<?php echo base_url();?>assets/contents/images/logo2.png" width="150"/>
    </p>
    <p align="center" class="print border">
		<?php      
		  list($first, $second) =  explode('images/',$news['uri']);
		  list($first, $second) =  explode('/',$second);
		  $dates =explode('_',$first);	  
		  $page_date = $dates[2]."-".$dates[1]."-".$dates[0];
		  echo date("l, F d, Y",strtotime($page_date));
		?>
    </p>
  
	<img src="<?php echo $news['uri'];?>">

  

			


    <div style="clear:both; float:left; width:<?php echo $width;?>px"></div>
	<div style="height:30px; text-align: center" class="no-print">
		<div style=" margin-top: 6px; ">        
			<?php if(!empty($news['ref_link'])):?>
			<?php  $id = $news['ID'] ?>
			 <a href="<?php echo site_url("article/".$news['ref_link']);?>" class="inline" >পরের পাতা >></a>
			<?php endif;?>
			
			 <?php if($parentnews > 0):?>
			 <?php  $id = $parentnews ?>
			 <a href="<?php echo site_url("article/".$parentnews);?>" class="inline" ><< আগের পাতা</a>
			<?php endif;?>                
		</div> 
	</div>
</div>    




<div class="no-print" style="padding:10px;   height:30px; border:0px solid #333; text-align:center;  overflow:hidden;">
    <a  href="<?php echo site_url();?>"  ><i class="fa fa-home fa-2x"></i></a>

    
	<a  target="_blank" href="<?php echo site_url("print/article/".$id);?>">
	    
	    <i class="fa fa-print fa-2x"></i>
	</a>


<a target="_blank" href="" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo current_url().'?ref=f';?>')+'&picture='+encodeURIComponent('<?php echo $image;?>'),'facebook-share-dialog','width=626,height=436'); return false;" ><i class="fa fa-facebook-square fa-2x"></i></a>

<!--<a target="_blank" href="" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo $image;?>'),'facebook-share-dialog','width=626,height=436'); return false;" ><i class="fa fa-facebook-square fa-2x"></i></a> -->
							<a target="_blank" href="" onclick="javascript:window.open('https://twitter.com/share?text=<?php echo 'bangladesher khabor epaper';?>&url=<?php echo current_url();?>','Twitter-dialog','width=626,height=436'); return false;"><i class="fa fa-twitter-square fa-2x"></i></a>
							<a target="_blank" href="" onclick="window.open('https://plus.google.com/share?url=<?php echo current_url();?>','Google-dialog','width=626,height=436'); return false;"><i class="fa fa-google-plus-square fa-2x"></i></a>


</div>
    
  

<?php

 if(isset($_SERVER['HTTP_REFERER'])){ 
  if (strpos($_SERVER['HTTP_REFERER'], base_url() ) === 0){  //http://epaper.newagebd.net
   ?>  <p align="center" class="no-print">
       <span onclick="javascript:parent.$.colorbox.close()" style="text-decoration: none;color: #030303; font-weight: bold; cursor:pointer">Close this page</span>
<!--        parent.jQuery.colorbox.close()-->

    </p>
    
    <?php
  }
 
 else  {
      
     ?>  
<p align="center" class="no-print">
       <span onclick="javascript:parent.$.colorbox.close()" style="text-decoration: none;color: #030303; font-weight: bold; cursor:pointer">Close this page</span> 
        
    </p>

<?php } }?>




   
      <p align="center" class="no-print">
        <a href="http://www.maguragroup.com.bd/" target="_blank"> <img style="border: solid 1px #ccc;" src="http://epaper.bangladesherkhabor.net/assets/ads/728X90_2.jpg" alt=""> </a>
        
    </p>


      
     <script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
			 
				
				 
				 
			 
			});
		</script>
    
                
</body>
</html>