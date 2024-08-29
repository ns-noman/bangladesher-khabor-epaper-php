<?php 
if(empty($_GET['nID'])){ echo 'Sorry Wrong request!'; die();}
require_once ('../ep-config.php');
//global $setting;
//extract($setting);
$nID=intval($_GET['nID']);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Select Link News</h1><div class="clearfix"></div></div>
<div class="page-enty">
 <div id="get_page_form">
 <form action="" name="get_page_form" id="get_page_form" method="post" enctype="multipart/form-data">
  <ul class="form-el-container">
   <li><div class="form-element"><label for="">Select Page:</label>
   <select id="page_for_news" name="page_for_news" onchange="ajax_get_page_news(this)"><?php echo get_npage_option($nID);?></select></div></li>
   <input type="hidden" id="news-link-for"  value="<?php echo $nID;?>"/>
 </form>
 </div><!--#get_page_form-->
 <div class="clearfix"></div>
 <div id="reguler-epage-news">
 </div>
 <div class="clearfix"></div>
 <div id="news-addbutton">
   <a href="javascript:void(0)" id="create_news_block" title="Create News Block"></a>
 </div>
 
</div>