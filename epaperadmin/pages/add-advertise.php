<?php require_once('global.php');
      global $setting,$epdb;
      extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Add Advertise</h1><div class="clearfix"></div></div>
<div class="page-enty">
           <form action="" method="post" enctype="multipart/form-data" id="form-add-advertise" class="setting-form">
            <input type="hidden" name="action" value="addadv" />
            <div class="form-element"><label for="adv_location">Select Location: </label>
            <select id="adv_location" name="adv[location]">
			<option value="0">--Select--</option>
            <?php foreach($adv_locations as $loc => $val){
				echo '<option value="'.$loc.'">'.$val.'</option>';
			}?>
            </select></div>
            <div class="form-element"><label for="adv_client">Select Client: </label>
            <?php $advclient=$epdb->get_results("SELECT ID,name FROM e_advclient WHERE status=1 ORDER BY name;");?>
            <select id="adv_location" name="adv[client]">
			<option value="0">--Select--</option>
            <?php foreach($advclient as $client){
				echo '<option value="'.$client->ID.'">'.$client->name.'</option>';
			}?>
            </select></div>
             <div class="form-element"><label for="adv_order">Order :</label><input type="text" id="adv_order" name="adv[order]" class="wsmall" placeholder="1-30"/></div>
              <div class="form-element"><label for="adv_activate">&nbsp;</label><input type="checkbox" id="adv_activate" name="adv[slide]"  value="1"/><span>Slideshow</span></div>
             <div class="form-element"><label for="adv_activate">&nbsp;</label><input type="checkbox" id="adv_activate" name="adv[activate]"  value="1"/>Enable</div>
             <div class="form-element">
                 <input type="hidden" id="image_name"  name="adv[image]"  value=""/>
                 <input id="enfile_upload" name="enfile_upload" type="file" multiple="false">
                 <input type="button" value="Upload Image" id="button-upload-image" />
                 <div class="clearfix"></div>
             </div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th colspan="2"  align="left">Advertise Location and Size</td>
  </tr>
  <tr>
    <th  align="left">Location</td>
    <th  align="left">Width*Height(px)</td>
  </tr>
  <tr>
    <td>Left of Logo</td>
    <td>160*60</td>
  </tr>
  <tr>
    <td>Right of Logo</td>
    <td>160*60</td>
  </tr>
  <tr>
    <td>Below Date - Top of Paper</td>
    <td>750*N</td>
  </tr>
  <tr>
    <td>Below 1st Magazine(Satrong)</td>
    <td>160*N</td>
  </tr>
  <tr>
    <td>Below 2nd Magazine(Abokash)</td>
    <td>160*N</td>
  </tr>
  <tr>
    <td>Below 3rd Magazine(Satrong)</td>
    <td>160*N</td>
  </tr>
  <tr>
    <td>Rest Left Bottom</td>
    <td>160*N</td>
  </tr>
  <tr>
    <td>Right Side</td>
    <td>180*N</td>
  </tr>
  <tr>
    <td>Top Footer</td>
    <td>940*N</td>
  </tr>
  <tr>
    <td>News Lightbox</td>
    <td>N*50;</td>
  </tr>
  <tr>
    <td colspan="2"><font color="#660000">N=>Any comfortable width/height</font></td>
  </tr>
</table>
         
</div>
<script type="application/javascript">
$(document).ready(function(){
	$('#form-add-advertise').on('submit',function(){
		if($('#adv_location').val()=='0'){show_massage('Select a Location.','error'); return false;}
		if($('#image_name').val()==''){show_massage('Select a Image.','error'); return false;}
		 var post_data=$(this).serialize();             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
                    show_massage(responce.msg,'success');
					 load_ajax_page('pages/add-advertise.php'); 
				}else{
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });
		return false;
	});
});
$(function() {
	var advertise_file='<?php echo $site_url.'/advertise/';?>';
	$('#button-upload-image').on('click',function(){$("#enfile_upload").uploadify('upload');})
	$("#enfile_upload").uploadify({
		'auto'     : false,
		'removeCompleted' : false,
		height        : 25,
		swf           : 'assets/plugins/uploadify/uploadify.swf',
		uploader      : 'uploadadv.php',
		width         : 100,
		'onSelect' : function(file) {},
		'onUploadStart' : function(file) {},
		'onCancel' : function(file) {},
		'onUploadComplete':function(file){},
        'onUploadSuccess' : function(file, data, response) {
		   $('#image_name').val(file.name);		 		
           $('#enfile_upload-queue').append('<img src="'+advertise_file+file.name+'" width="160" class="tempimg"/>');
		  
        }
	});
});
</script>