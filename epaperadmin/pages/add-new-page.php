<?php require_once('global.php');
global $setting;
extract($setting);
?>
<div id="page_title" class="icon-32"><span class="page"></span><h1>Add New Page</h1><div class="clearfix"></div></div>
<div class="page-enty">
    <form id="addpage-form" enctype="multipart/form-data" name="addpage-form">
      <input type="hidden" name="action" value="add_new_page" />
      <div class="form-element"><label for="news_date">Date: </label><input type="text" name="news_date" id="news_date"  value="<?php echo date('d-m-Y');?>" class="wsmall required"/></div>
      <div class="form-element"><label for="page_type">Page Type: </label>
       <select id="page_type" name="page_type" class="wsmall required">
        <option value="regular">Today's Paper</option>
        
        
       </select></div>
      <div class="form-element"><label for="page_heading">Page Title : </label><input type="text" name="page_heading" id="page_heading"  value="" class="wlarg required bangla"/></div>
      <div class="form-element"><label for="page_no">Page Number : </label>
      <select id="page_no" name="page_no" class="wsmall required">
      <option value="0">-Select-</option>
       <?php for($i=1; $i<=TOTALPAGE; $i++){ echo ' <option value="'.$i.'">'.$i.'</option>';} ?>
      </select> </div>
       <div class="form-element"><label>&nbsp;</label><input type="checkbox" value="1" name="is_list_page" /><span>Show today's page list</span></div>
       <div class="form-element"><label>Order in today's page list:</label>
       <select id="page_list_order" name="page_list_order" class="wsmall required">
      <option value="0">0</option>
       <?php for($i=1; $i<=100; $i++){ echo ' <option value="'.$i.'">'.$i.'</option>';} ?>
      </select>
       </div>
       <div class="form-element"><input type="hidden" id="image_name"  name="image_name"  value=""/><input id="enfile_upload" name="enfile_upload" type="file" multiple="false"><input type="button" value="Upload Image" id="button-upload-image" /><div class="clearfix"></div></div>
       <div class="form-element form-element-submit"><i style="float:left">Image Size 2000*3010</i><input type="submit" id="add_new_page_submit"  value="Publish" class="submit_button"/></div>
    </form>
    <div class="clearfix"></div>
	 <div class="img_preview"></div>
	
	
</div>
<script type="application/javascript">
 $(function() {
	  var availableTags = [
							"প্রথম পাতা",
							"শেষের পাতা",
						 	"আজকের কম্পিউটার",
							"নিত্যদিন",
							"বিনোদন সারাদিন",
							"বিভাগ পরিক্রমা",
							"সিলেবাস",							
							];
	 $( "#news_date" ).datepicker({dateFormat:'dd-mm-yy'});
	 $( "#page_heading" ).autocomplete({source: availableTags,appendTo: "#someElem",autoFocus: true});
	 
	 $('#addpage-form').on('submit',function(){
		 var form_loder=$('#add_new_page_submit').parent();
		 eploding( form_loder);
		 
		 if( $('#news_date').val()=='' ){
			  show_massage('Please select news date.','error');
			  remove_eploding(form_loder);
			  return false;
		 }
		 if( $('#page_type').val()=='' ){
			  show_massage('Please select page type.','error');
			  remove_eploding(form_loder);
			  return false;
		 }
		 if( $('#page_heading').val()=='' ){
			  show_massage('Please enter page title.','error');
			  remove_eploding(form_loder);
			  return false;
		 }
		 if( $('#page_no').val()=='' || $('#page_no').val()=='0'){
			  show_massage('Please select page number.','error');
			  remove_eploding(form_loder);
			  return false;
		 }
		 if( $('#image_name').val()=='' ){
			  show_massage('Please upload image.','error');
			  remove_eploding(form_loder);
			  return false;
		 }
		 var post_data=$(this).serialize();             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
				  show_massage(responce.msg,'success');
				  remove_eploding(form_loder);
				  load_ajax_page('pages/add-new-page.php');   
				}else{
				  show_massage(responce.msg,'error');
				  remove_eploding(form_loder);        
			    }
			 }
			 });
			 
		 return false;
	})

	 
 })


$(function() {
	var tempimage='<?php echo $site_url.'/tempupload/';?>';
	$('#button-upload-image').on('click',function(){$("#enfile_upload").uploadifive('upload');})
	$("#enfile_upload").uploadifive({
		'auto'     : false,
		'removeCompleted' : false,
		height        : 25,
		//swf           : 'assets/plugins/uploadify/uploadify.swf',
		uploader      : 'uploadify.php',
		width         : 100,
		//'onSelect' : function(file) {},
		//'onUploadStart' : function(file) {},
		//'onCancel' : function(file) {},
		//'onUploadComplete':function(file){},
        'onUploadComplete' : function(file, data, response) {  //onUploadSuccess
			console.log(file, data);
			
			 $('#image_name').val(file.name);		 		
           $('.img_preview').append('<img src="'+tempimage+file.name+'" width="280" class="tempimg"/>');
		  
        }
	});
});
</script>