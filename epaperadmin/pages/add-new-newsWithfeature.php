<?php
if(!file_exists('global.php')) die(); 
require_once('global.php');
global $setting;
extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Add News</h1><div class="clearfix"></div></div>
<div class="page-enty">
 <div id="get_page_form">
 <form action="" name="get_page_form" id="get_page_form" method="post" enctype="multipart/form-data">
  <ul class="form-el-container">
  <li><div class="form-element"><label for="">Select date:</label><input type="text" class="wsmall required" id="page_for_date" name="page_for_date" value="" placeholder="dd-mm-yy" onchange="get_pages_from_date(this)"></div></li>
   <li><div class="form-element"><label for="">Select Page:</label><select id="page_for_news" name="page_for_news"><option value="0">--Select --</option></select></div></li>
   </ul>
 </form>
 </div><!--#get_page_form-->
 <div class="clearfix"></div>
 <div id="reguler-epage">
 </div>
 <div class="clearfix"></div>
 <div id="news-addbutton">
   <a href="javascript:void(0)" id="create_news_block" title="Create News Block"></a>
 </div>
 
</div>
<script type="text/javascript">	
$(document).ready(function(){
	 $("#page_for_date").datepicker({dateFormat:'dd-mm-yy'});
});
 $(function() {	 
  var customNewsblock = '<div class="cnewsblock ui_enable">';
	customNewsblock +='<ul class="ui-helper-reset">';
	customNewsblock +='<li><a href="javascript:void(0)" onClick="setNews(this)" class="nsave">Publish</a></li>';
	customNewsblock +='<a href="javascript:void(0)" onClick="cancelNews(this)" title="Remove" class="nremove">Remove</a>';	
	customNewsblock +='</ul>';
	customNewsblock +='</div>';
	 $('#page_for_news').on('change',function(e){
		 $('#news-addbutton a').css('display','none');
		 $('#news-addbutton').show().addClass('lodding');
		 var page_request=$(this).val();
		 if(page_request=='0'){ show_massage('Please select a news page.','error'); e.preventDefault(); return;}
		 else{
			 var req_var = page_request.split(":");
			 var pID = req_var[0];
			 var pdate = req_var[1];
			 var ptype = req_var[2];
			 var pnumber = req_var[3];
			 var pimage = req_var[4]+':'+req_var[5];			 
			 $('#reguler-epage').css('background-image', 'url(' + pimage + ')').attr('data',pID );
			  load_news_page(pID);			
			  $('#news-addbutton').removeClass('lodding');
			 $('#news-addbutton a').css('display','block');
		 }
	 });
	 $('#create_news_block').on('click',function(){
		  var page_request=$('#page_for_news').val();
		if(page_request=='0'){ show_massage('Please select a news page.','error'); e.preventDefault(); return;}
		else{
			$('#reguler-epage').append(customNewsblock);
			$( ".cnewsblock.ui_enable" ).draggable();
			$( ".cnewsblock.ui_enable" ).resizable();
		}
	 });
  
 })
 function setNews(this_){
	  $('#page_title').addClass('lodding');
	 var nwidth_=$(this_).parents('.cnewsblock').css('width');
	 var nheight_=$(this_).parents('.cnewsblock').css('height');
	 var ntop_=$(this_).parents('.cnewsblock').css('top');
	 var nleft_=$(this_).parents('.cnewsblock').css('left');
	 var pID_ =$('#reguler-epage').attr('data');
	
         var form_loder=$(this_).parents('.cnewsblock');
		 eploding( form_loder);
		 var post_data={nwidth:nwidth_,nheight:nheight_,ntop:ntop_,nleft:nleft_,pID:pID_,action:'addnews'};             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
                             
				if(responce.success == '1'){
				  show_massage(responce.msg,'success');
				  remove_eploding(form_loder);
				  $(this_).parents('.cnewsblock.ui_enable').draggable('disable').resizable('disable'); 
				  $(this_).removeAttr('onclick'); 
				 //  $('#page_title').addClass('lodding');
				}else{
				  show_massage(responce.msg,'error');
				  remove_eploding(form_loder);
				  // $('#page_title').addClass('lodding');        
			    }
			 }
			 });
 }
 function cancelNews(this_){
	// $(this_).parents('.cnewsblock').draggable( "destroy" );
	// $(this_).parents('.cnewsblock').resizable( "destroy" );
        
        
        //ajax call
	 $(this_).parents('.cnewsblock').remove();
}
function addParentNews(nlink){
	var nId= $(nlink).parent().attr('data');
	var ajaxpage='pages/set-link.php?nID='+nId;
   var add_news= $.colorbox({'open':true,href:ajaxpage});
}
function ajax_get_page_news(npage){
	var pId=$(npage).val();
	if(pId == 0){ return;}
	else{
		load_news_for_link(pId);
	}
}
function load_news_for_link(pID){
	   $('#page_title').addClass('lodding');
		 var post_data={'action':'loadnewslinks','pid':pID};             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
                     $('#reguler-epage-news').html(responce.news);
					 $('#page_title').removeClass('lodding');
				}else{
				  show_massage(responce.msg,'error');
				  $('#page_title').removeClass('lodding');				    
			    }
			 }
			 });
}
function load_news_page(pID){
	    $('#page_title').addClass('lodding');
		 var post_data={'action':'loadnews','pid':pID};             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
                     $('#reguler-epage').html(responce.news);
					 $('#page_title').removeClass('lodding');
				}else{
				  show_massage(responce.msg,'error');
				  $('#page_title').removeClass('lodding');				    
			    }
			 }
			 });
}
function addNewsLink(links){
	var link_for = $('#news-link-for').val();
	var ref_link = $(links).attr('data');
	var post_data={'action':'setreflink','lfor':link_for,'rlink':ref_link};             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
                    show_massage(responce.msg,'success');
					$('div[data="'+link_for+'"]').find('a.nlink').addClass('activated');
					$.colorbox.close();
				}else{
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });
}
function get_pages_from_date(objDate){
	 $('#page_title').addClass('lodding');
	var sdate = $(objDate).val();
	var post_data={'action':'get_page_options','date':sdate};             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
					 
                   $('#page_for_news').html(responce.option);					
				
				}else{
				  show_massage(responce.msg,'error');				    
			    }
				$('#page_title').removeClass('lodding');
			 }
			 });
}
 </script>
 <style type="text/css">
 .cnewsblock.ui-state-disabled a.nlink{display:none!important;

 </style>
