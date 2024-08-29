<?php 
if(!empty($_GET['pID'])){
require_once ('../../ep-config.php');
global $setting;
extract($setting);
 ?> 
<div class="page-enty" style="width:400px; padding:20px; height:450px">
<h2> Add News Image</h2>
<?php //print_r($_GET);?>
 <form action="" method="post" enctype="multipart/form-data" name="set_page_news" id="set_page_news">
   <input type="hidden" name="action" value="addnews" />
   <input type="hidden" name="pID" value="<?php echo $_GET['pID'];?>" />
   <input type="hidden" name="nwidth" value="<?php echo $_GET['nwidth'];?>" />
   <input type="hidden" name="nheight" value="<?php echo $_GET['nheight'];?>" />
   <input type="hidden" name="ntop" value="<?php echo $_GET['ntop'];?>" /> 
   <input type="hidden" name="nleft" value="<?php echo $_GET['nleft'];?>" />
   <input type="hidden" placeholder="News Title"  name="ntitle" value="news"/>
   <input type="hidden" id="image_name"  name="image_name"  value=""/>
   <div class="form-element"><input type="file" name="nfile" id="nfile" /></div>
   <div class="clearfix"></div>
    <div class="form-element form-element-submit"><input type="submit" id="add_new_news_submit"  value="Publish" class="submit_button"/></div>
 </form>
</div>
<script type="application/javascript">
 $(function() {
	 $('#set_page_news').on('submit',function(){
         var form_loder=$('#add_new_news_submit').parent();
		 eploding( form_loder);
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
				}else{
				  show_massage(responce.msg,'error');
				  remove_eploding(form_loder);        
			    }
			 }
			 });
	 return false;});
 });
 $(function() {
	var tempimage='<?php echo $site_url.'/tempupload/';?>';
	//$('#button-upload-image').on('click',function(){$("#enfile_upload").uploadify('upload');})
	$("#nfile").uploadify({
		'auto'     : true,
		'removeCompleted' : false,
		height        : 25,
		swf           : 'assets/plugins/uploadify/uploadify.swf',
		uploader      : 'uploadify.php',
		width         : 100,
		'onSelect' : function(file) {},
		'onUploadStart' : function(file) {},
		'onCancel' : function(file) {},
		'onUploadComplete':function(file){},
        'onUploadSuccess' : function(file, data, response) {
			 $('#image_name').val(file.name);		 		
             $('#nfile-queue').append('<img src="'+tempimage+file.name+'" style="max-width:120px;max-height:120px" class="tempimg"/>');
		  
        }
	});
});
</script>
<?php }?>