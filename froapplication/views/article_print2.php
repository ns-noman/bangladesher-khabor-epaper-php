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




 <style>
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50120474-2', 'auto');
  ga('send', 'pageview');

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
    

    
    <p align="center">
       <img src="<?php echo base_url();?>assets/contents/images/logo2.png" width="150"/>
    </p>
    <p align="center" class="border">
		<?php      
		  list($first, $second) =  explode('images/',$news['uri']);
		  list($first, $second) =  explode('/',$second);
		  $dates =explode('_',$first);	  
		  $page_date = $dates[2]."-".$dates[1]."-".$dates[0];
		  echo date("l, F d, Y",strtotime($page_date));
		?>
    </p>
  

	<?php if(!empty($news['ref_link'])) {?>
			 <img src="<?php echo $news['uri'];?>">
			 <br>
			 <img src="<?php echo $news_second['uri'];?>">
	<?php } else {?>
	
	<img src="<?php echo $news['uri'];?>">
	<?php }?>
	
	<?php if($parentnews > 0):?>
	        <?php  ?>
			<img src="<?php echo $news_first['uri'];?>">
			<br>
			<img src="<?php echo $news['uri'];?>">
	<?php else : ?>
          
	<?php endif; ?>	  

    <div style="clear:both; float:left; width:<?php echo $width;?>px"></div>

</div>    



    <div class="footerText">
		<div class="footerTextIn">
		  <div class="footerTextInner">
			<div class="container2">
			  <div class="row site_url" data-url="<?php echo site_url(); ?>">
				<div class="col-md-12 col-sm-12 col-xs-12">
				  <div class="footerMid">
					<p> © <?php echo date("Y"); ?> Bangladesher Khabar. All rights reserved.</p>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
 
  

 




   
     


      
     <script>
			window.print();
	</script>
    
                
</body>
</html>