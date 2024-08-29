<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


<meta name="Description" content="<?php echo isset($description) ? $description : $siteinfo["MetaDescription"];?>">




<title><?php echo isset($title) ? $title : $siteinfo["HomePageTitle"]; ?></title>

	 <meta property="og:type"                 content="website"/> 
     <meta property="og:url"                  content="<?php echo current_url(); ?>"/>
     <meta property="og:site_name"            content="<?php echo $siteinfo["HomePageTitle"]; ?>"/>
     <meta property="og:image"                content="<?php echo isset($image) ? $this->config->item('assets_url').$image : $this->config->item('assets_url').$siteinfo["Logo"]; ?>"/>
     <meta property="og:title"                content="<?php echo isset($title) ? $title : $siteinfo["SiteName"]; ?>"/>
	 <meta property="og:description"          content="<?php echo isset($description) ? $description : $siteinfo["MetaDescription"];?>"/> 
	   
      
<link rel="shortcut icon" href="<?php echo $this->config->item('assets_url').$siteinfo["FavIcon"];?>" />



<link rel="stylesheet" href="<?php echo base_url();?>assets/contents/css/colorbox.css" />
	<link href="<?php echo base_url();?>assets/contents/css/style.css?v=1" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





 <style>
 
 
 
 @media print and (color) {
   * {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
   }
}

   .wrapper{    max-width:1000px; margin:0 1cm;}
    
     img {  
  max-width: 100%;
  height: auto;  
}

.logo img{ width:270px; height: auto;}

 .left_side{ width:100% !important; margin: 20px 0 20px 0px;}
          .inline { font-size: 20px; text-decoration: none; color: #030303}

.footerText {
    width: 100%;
    overflow: hidden;
    border-top: 1px solid #bbbcbd;
    background: #e7e7e7;
	text-align:center;
}		  
           
             
  </style>

         <style media="print">
           
        
           
           
          @media print
{    
    
     
    
    .no-print, .no-print *
    {
        display: none !important;
    }
    
 
           .wrapper{ margin:0 auto;  max-width:1000px;  }
    .main_content {padding:20px;}
     img { display: block;
  max-width: 98%;
  height: auto; margin:0 auto;}
  
  
  
}
          
         </style>

         
         
          <style>
           
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


 
   
         </style>
 
 

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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50120474-2', 'auto');
  ga('send', 'pageview');

</script>
</head>




<body class="A4">
  <?php $pnumber = $this->uri->segment(2,1); ?>  
<div class="wrapper">
	<div class="header">
		<div class="headerTopNav">
			 
			<div class="online-date">
		     	<?php  echo getBanglaDate(date("D, j F ")).getBanglaDate(date("Y")).', '.$dateinfo['BanglaDate'].', '.$dateinfo['ArabicDate'];?>    
			</div>
			<div class="online-weather">
		    <?php if(isset($weather->main->temp)) {?>
		    	 <img  alt="weather" height="23" src="http://openweathermap.org/img/w/<?php echo $weather->weather[0]->icon ?>.png"> <?php echo getBanglaDate($weather->main->temp) ?><sup>o</sup> সে. আদ্রতা <?php echo getBanglaDate($weather->main->humidity) ?>%   
		    	  <?php } ?>
		    	 
			</div>
			 
        </div>
		<div class="headerTopAdd">
		    <div class="logo">
			   <a  href="<?php echo site_url();?>"> <img height="30" src="<?php echo base_url() ?>/assets/images/Logo.png" alt=""> </a>
			</div>
			<div id="ad" style="height:90px;">
            </div>
		</div>
		<div class="headerMain" style="display:none;">
			<div style="padding-top:10px;padding-bottom:10px;">		
				<div class="Current_date" style="">
					<?php echo banglaformat(date_format(date_create($active_date),'l, j F Y')) ?>		
				</div>
			</div>
		</div>		
    </div>
		
		<?php //echo $_SERVER['DOCUMENT_ROOT'] ?>
		<div class="main_content_section">
		 
			<div class="left_side">               			
				 	
				<div id="page-content" class="main_content">				     
				
				        
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
    

    
  

	<?php if(!empty($news['ref_link'])) {?>
			 <img src="<?php echo str_replace("/epaperadmin","",$news['uri']);?>">
			 <br>
			 <img src="<?php echo str_replace("/epaperadmin","",$news_second['uri']);?>">
	<?php } else {?>
	
	<img src="<?php echo str_replace("/epaperadmin","",$news['uri']);?>">
	<?php }?>
	
	<?php if($parentnews > 0):?>
	        <?php  ?>
			<img src="<?php echo str_replace("/epaperadmin","",$news_first['uri']);?>">
			<br>
			<img src="<?php echo str_replace("/epaperadmin","",$news['uri']);?>">
	<?php else : ?>
          
	<?php endif; ?>	  

    <div style="clear:both; float:left; width:<?php echo $width;?>px"></div>

</div>    
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
				</div>
		
				 					
			</div>
		 
	

			 
			 
		</div>
		
	</div>
    <div class="footerText">
		<div class="footerTextIn">
		  <div class="footerTextInner">
			<div class="container2">
			  <div class="row site_url" data-url="<?php echo current_url(); ?>">
				<div class="col-md-12 col-sm-12 col-xs-12">
				  <div class="footerMid">
					<p> © <?php echo date('Y'); ?> Bangladesher Khabor. All rights reserved.</p>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
 


 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url();?>assets/contents/js/jquery-1.12.4.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url();?>assets/contents/js/bootstrap.min.js"></script>
 
   
     <script>
			window.print();
	</script>
    

    
    
    
    
    
    
    
    
 
    
    
</body>
</html>