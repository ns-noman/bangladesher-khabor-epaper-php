<?php
if(!file_exists('global.php')) die(); 
require_once('global.php');
	global $setting;
	extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>All Pages</h1><div class="clearfix"></div></div>
 <div id="get_page_form">
 <form action="" name="get_page_form" id="get_page_form" method="post" enctype="multipart/form-data">
  <ul class="form-el-container">
  <li><div class="form-element"><label for="">Select date:</label><input type="text" class="wsmall required" id="page_for_date" name="page_for_date" value="" placeholder="dd-mm-yy"  onchange="load_page_with_arg()"></div></li>
   <li><div class="form-element"><label for="">Page Type:</label>
   <select id="page_type" name="page_type" onchange="load_page_with_arg()">
    <option value="0">--Select --</option>
    <option value="regular">Today's Paper</option>
    <optgroup label="Feature magazine">
    <?php foreach($feature_page as $fpage=>$title){ echo '<option value="'.$fpage.'">'.$title.'</option>';}?>
    </optgroup>
   </select></div></li>
   </ul>
 </form>
 </div><!--#get_page_form-->
 <div class="clearfix"></div>
 <div id="all_page_list" class="page-enty">
 </div>
 <div class="clearfix"></div>
</div>
<script type="text/javascript">	
$(document).ready(function(){
	 $("#page_for_date").datepicker({dateFormat:'dd-mm-yy'});
});
function load_page_with_arg(){
	$('#page_title').addClass('lodding');
	var page_date=$('#page_for_date').val();
	var page_type=$('#page_type').val();
	if(page_date ==''){
		show_massage('Please select a Date.','error');
		$('#page_title').removeClass('lodding');
	}
	else if(page_type =='0'){
		show_massage('Please select page Type.','error');
		$('#page_title').removeClass('lodding');
	}
	else{
             $.ajax({
			 url: 'formAction.php',
			 data:{'action':'load_all_page','pdate':page_date,'ptype':page_type},
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
					 $('#page_title').removeClass('lodding');
                     $('#all_page_list').html(responce.page_list);	
					 $('#page_title').removeClass('lodding');				
				}else{
				  $('#page_title').removeClass('lodding');
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });

	}
}
function update_epage(page_form){
   $('#page_title').addClass('lodding');
	var pForm=$(page_form);
	 var post_data=pForm.serialize();   
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
					 $('#page_title').removeClass('lodding');
                     show_massage(responce.msg,'success');
					 load_ajax_page('pages/pages.php');	
					 			
				}else{
				  $('#page_title').removeClass('lodding');
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });  
	return false;
}
</script>