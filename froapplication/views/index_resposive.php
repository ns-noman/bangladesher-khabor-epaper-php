<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>NEW AGE</title>

<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/contents/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/contents/css/colorbox.css" />
<link href="<?php echo base_url();?>assets/contents/css/customize.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
    
    #cboxOverlay { background: #000}
    .logoTop .img-responsive {
    margin: 0 auto;
}
.example3 .navbar { margin-bottom: 10px;}
.container-fluid2 .navbar-brand {padding: 5px 5px;}
.navbar-brand-centered p{ font-size: 12px;}
.container{ padding-right: 0; padding-left: 0;}
</style>
 <!-- Google adsense -->
<script data-ad-client="ca-pub-2872207974896528" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
    
    
    <div class="container" style="border:solid 1px #5d5a5a; margin-bottom:20px;">
<header><!-- Begin Header Section -->
  <div class="header">
      
      
      
  <div class="example3">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container2">
       
       
      <div id="navbar3" class="navbar-collapse collapse">
          
          
        
          <ul class="nav navbar-nav navbar-left">
          <li>
          
            <div class="text-center center-block">
            
                <a href="http://www.newagebd.net" target="_blank" class="online-edition">Online Edition</a> |
	             
</div>
          </li>
          
          <li class="news-scroll">
          <?php
          
          $xml = new SimpleXMLElement(file_get_contents('http://newagebd.net/feed'));

 
          ?>
          <marquee onmouseover="this.stop();" onmouseout="this.start();">
          <?php foreach($xml->channel[0] as $row) if(isset($row->title)){ ?>
              <a href="<?php echo $row->link; ?>" target="_blank"><?php echo $row->title; ?></a> 
          <?php } ?>
          </marquee>
          
          
          </li>
          
       
        </ul>
          
        <ul class="nav navbar-nav navbar-right">
          <li>
          
            <div class="text-center center-block">
            
                <a target="_blank" href="https://www.facebook.com/newageonline"><i class="fa fa-facebook-square fa-2x social"></i></a>
	            <a target="_blank" href="https://twitter.com/NewAgeBDcom"><i class="fa fa-twitter-square fa-2x social"></i></a>
	            <a target="_blank" href="https://plus.google.com/u/0/communities/113426908857218378909"><i class="fa fa-google-plus-square fa-2x social"></i></a>
<!--	            <a href="##"><i class="fa fa-envelope-square fa-2x social"></i></a>-->
</div>
          </li>
          
       
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>

      
      
      
      
      
      
      
   
      
    <div class="headerIn">
      <div class="headerInner">
        <div class="container2">
            
            
       
            
          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 logoTop">
               <img   class="img-responsive" src="http://www.sflworldwide.com/images/---google-ad-970-90.jpg" alt="Header Right" title="Header Right">
              </div>
          </div>
          
        </div>
      </div>
    </div>
  
  
  
<div class="container2 menu-main">
    
    
          <nav class="navbar navbar-default" role="navigation">
    	  <div class="container-fluid2">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="navbar-brand navbar-brand-centered">
                          
                          <a href="<?php echo site_url();?>"><img style="margin-right: 10px; padding: 0; height: 40px;" align="left" src="<?php echo base_url();?>assets/contents/images/elogo.png" alt="e-New Age"></a>  <a href="<?php echo site_url();?>">e-New Age</a>
                      
                          <p><?php $date =  $this->uri->segment(1,0); echo date("F d, Y", ($date==0) ? time(): strtotime($date ));?></p>
                      </div>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="navbar-brand-centered">
		      
                        
                     <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
   
      <select class="form-control news-page-select" placeholder="Today's Paper">
          
       
          
          
                       <?php
					   $pnumber = $this->uri->segment(2,1);
					   
					    foreach($pages as $p):?>
          <option <?php echo ($p['pnumber']==$pnumber) ? "selected": "";?> value="<?php echo site_url().$p['pdate'].'/'.$p['pnumber'];?>"><?php echo $p['title'];?></option>
               
                 <?php endforeach;?>
                     
          
          
          
      </select>
      
  </div>
  <button type="submit" class="btn btn-default hidden">Go</button>
</form>   
                        
                        
                        
                        
                           
    <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archive <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 
								 <form class="form-inline choose-date"  role="form" method="post"  accept-charset="UTF-8">
                                 <input value="<?php echo site_url();?>" id="url" type="hidden"/>
										<div class="form-group">
											 <label class="sr-only" for="Day">Day</label>
											 
                                                                                         
                                                                                         
                                                                                         <select class="form-control" id="Day" required>
                                                                                             <option>Day</option>    
                                                                                              <?php 
                                                                                              for($i=1; $i<=31; $i++)
                                                                                              echo "<option value='".$i."'>".$i."</option>";
                                                                                              
                                                                                              
                                                                                              ?> 
                                                                                               
                                                                                         </select>
                                                                                         
                                                                                         
                                                                                         
										</div>
										<div class="form-group">
											 <label class="sr-only" for="Month">Month</label>
											 <select class="form-control" id="Month" required>
                                                                                             <option>Month</option>    
                                                                                              <?php 
                                                                                              for($i=1; $i<=12; $i++)
                                                                                              echo "<option value='".$i."'>".$i."</option>";
                                                                                              
                                                                                              
                                                                                              ?> 
                                                                                               
                                                                                         </select>
                                              
										</div>
                                                                     
                                                                                <div class="form-group">
											 <label class="sr-only" for="Year">Year</label>
											 <select class="form-control" id="Year" required>
                                                                                             <option>Year</option>    
                                                                                              <?php 
                                                                                              for($i=date("Y"); $i>=2016; $i--)
                                                                                              echo "<option value='".$i."'>".$i."</option>";
                                                                                              
                                                                                              
                                                                                              ?> 
                                                                                               
                                                                                         </select>
                                              
										</div>
										<div class="form-group pull-right">
											 <button type="submit" class="btn btn-primary btn-block">Go</button>
										</div>
										 
								 </form>
							</div>
							 
					 </div>
				</li>
			</ul>
        </li>
      </ul>
    
    
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
		      <ul class="nav navbar-nav navbar-right hidden">
		       
                          
                          
                          
                          <li> <button type="button" class="btn btn-default navbar-btn" data-container="body" data-toggle="popover" data-placement="bottom">Login</button>
</li>
		         <div id="popover_content_wrapper" style="display: none">
  <form action="" role="form">
    <div class="form-group">
      <label for="user">User</label>
      <input type="text" class="form-control" id="user" placeholder="User" />
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password" />
    </div>
      <button type="submit" class="btn btn-default">Sign in</button>
 
  </form>
</div>	        
		      </ul>
                        
           
                        
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
    
    
    
    
    <nav class="navbar navbar-default" style="display: none;">
    <div class="container-fluid2">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar9">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      
      <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
      
      
        <div class="brand-centered">
      <a class="navbar-brand" href="##"><img style="margin-right: 10px; padding: 0;" src="<?php echo base_url();?>assets/images/logo.png" alt="New Age">New Age
      </a>
      </div>
        
        
       
      
      <div id="navbar9" class="navbar-collapse collapse">
         
        
          
          
          
          
          
          
          
          <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Choose Date</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 
                                
								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Year</label>
											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Go</button>
										</div>
										 
								 </form>
							</div>
							 
					 </div>
				</li>
			</ul>
        </li>
      </ul>
          
          
          
          
          
          
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>

  
  </div>
</header>
<!-- End Header Section -->
            







<section><!-- Begin Content Part One -->
  <div class="contentPartOne">
    <div class="contentPartOneIn">
      <div class="contentPartOneInner">
        <div class="container2">
           
           
           <?php if(!empty($page_content)) {?>
           
            <div class="row">
                <div class="col-md-12">
                    
                    
                    
                  <div style="position: relative;  margin: 0 auto; text-align: center; margin-bottom: 5px;">
        <ul class="pagination">
<!--            <li class="left-etc"><a href="#">&laquo;</a></li>-->
            
           
          
              <?php
			           
        
			   foreach($pages as $p) if($pnumber!=$p['pnumber']){?>
                <li><a  date="<?php echo $p['pdate'];?>" data="<?php echo $p['pnumber'];?>" href="<?php echo site_url().$p['pdate'].'/'.$p['pnumber'];?>" title="<?php echo $p['title'].':'.$p['pnumber'];?>"><?php echo $p['pnumber'];?></a></li>
                 <?php }
				 else {
					 ?>
                      <li class="active">
                <span>
                  <?php echo $p['pnumber'];?>
                </span>
            </li>
                     <?php 
					 }
				 ?>
            
<!--            <li><a href="#">&raquo;</a></li>-->
        </ul>
    </div>
                    
                    
                    
                    
                    
                </div></div>
            
            <div class="row">
                 <div class="col-md-12">
                     
                     <div  id="page-content"> 
                     
                     <?php 
                     echo $page_content;
                     ?>
                   
                 
                 
                   </div>
                 
                 
                 
                 </div>
            
            
            
            </div>
            
            
              <div class="row">
                 <div class="col-md-12">
                     
                     <ul class="pager">
                     <?php if($pnumber>1){?>
                     
  <li class="previous">
    <a  date="<?php echo $p['pdate'];?>" data="<?php echo $pnumber-1;?>" href="<?php echo site_url().$p['pdate'].'/'.($pnumber-1);?>" title="<?php echo $p['title'].':'.$pnumber-1;?>">Prev</a>
  </li>
  <?php }?>
   
  
        <?php if($pnumber < $p['pnumber']){?>
               
  <li class="next">
    <a  date="<?php echo $p['pdate'];?>" data="<?php echo $pnumber+1;?>" href="<?php echo site_url().$p['pdate'].'/'.($pnumber+1);?>" title="<?php echo $p['title'].':'.$pnumber+1;?>">Next</a>
  </li>
  
  <?php }?>
</ul>
                     
                 </div></div>
            <?php }
			
			else {?>
            
            <h3>No Record Found</h3>
            
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
 

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 logoTop">
               <img   class="img-responsive" src="http://www.sflworldwide.com/images/---google-ad-970-90.jpg" alt="Header Right" title="Header Right">
              </div>
          </div>





<footer><!-- Begin Footer Section-->
 
   
  <div class="footerText">
    <div class="footerTextIn">
      <div class="footerTextInner">
        <div class="container2">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="footerMid">
                <p> &COPY; <?php echo date("Y"); ?> Media New Age Limited or its affiliated companies. All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer Section--> 






 






<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url();?>assets/contents/js/jquery-1.12.4.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url();?>assets/contents/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/contents/js/jquery.colorbox.js"></script>



<script src="<?php echo base_url();?>assets/contents/js/responsive-paginate.js"></script>
    <script>
        $(document).ready(function () {
           
               $('button[data-toggle=popover]').popover({ 
    html : true,
    //trigger: "click", // може да се смени
    content: function() {
      return $('#popover_content_wrapper').html();
    }
});

        $(".pagination").rPage();
            
     
        });
		
		
		
		
		
		
		 
    $(function(){
      // bind change event to select
      $('.news-page-select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    }); 
	
	$(document).ready(function() {
  $('.choose-date').on('submit', function(e){
      
	  var url = $('#url').val(); // get selected value
	  
	  var Day = $('#Day').val();
	  var Month = $('#Month').val();
	  var Year = $('#Year').val();
	  
	  
	  FullDate = ('0' + Day).slice(-2) + '-'
             + ('0' + Month).slice(-2) + '-'
             + Year+'/1';
			 
	  window.location = url+FullDate;
	  
    e.preventDefault();
  });
});

 


 









	//choose-date
    </script>

    
    <script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
			 
				// $(".iframe").colorbox();
				 $(".iframe").colorbox({iframe:true, width:"80%", height:"100%"}); 
				// $(".inline").colorbox();
			 
			});
		</script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 </div>   
    
    
</body>
</html>