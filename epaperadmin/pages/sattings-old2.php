<?php require_once('global.php');
      global $setting;
      extract($setting);
	$active_date=get_options('active_date');
	$active_date= empty($active_date)? date('d-m-Y'):$active_date;
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Settings</h1><div class="clearfix"></div></div>
<div class="page-enty">
    <div id="accordion-settings">
        <h3>Main Page</h3>
        <div class="accordion-content">
           <form action="" method="post" enctype="multipart/form-data" id="form-setting-site" class="setting-form">
            <input type="hidden" name="action" value="settings" />
            <div class="form-element"><label for="active_date">Active Date: </label><input type="text" name="setting[active_date]" id="active_date"  value="<?php echo $active_date;?>" class="wsmall required"/></div>
            <div class="form-element" style="display:none;"><label for="active_page">Active Page: </label><select id="active_page" name="setting[active_page]"><?php echo get_spage_option($active_date);?></select></div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
        </div>
        <h3>First Feature Box</h3>
        <div class="accordion-content">
        <?php 
		$first_feature_box_title=get_options('first_feature_box_title');
		$first_feature_box=get_options('first_feature_box');
		$first_feature_box_date=get_options('first_feature_box_date');
		?>
           <form action="" method="post" enctype="multipart/form-data" id="form-setting-site" class="setting-form">
            <input type="hidden" name="action" value="settings" />
             <div class="form-element"><label for="active_page">Magazine Title(Bangla)</label>
            <input type="text" class="wlarg" name="setting[first_feature_box_title]" value="<?php echo $first_feature_box_title;?>"/></div>
             <div class="form-element"><label for="active_page">Select Magazine</label>
             <select id="first_feature_box" name="setting[first_feature_box]">
             <?php foreach($feature_page as $feature=>$text):?>
                     <option value="<?php echo $feature;?>" <?php if($first_feature_box == $feature) echo 'selected'?>><?php echo $text;?></option>
              <?php endforeach;?>
             </select></div>
             <div class="form-element"><label for="active_page">Select Date</label>
            <input type="text" class="wsmall ui_date" name="setting[first_feature_box_date]" value="<?php echo $first_feature_box_date;?>"/></div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
        </div>
        <h3>Second Feature Box</h3>
        <div class="accordion-content">
        <?php 
		$second_feature_box_title=get_options('second_feature_box_title');
		$second_feature_box=get_options('second_feature_box');
		$second_feature_box_date=get_options('second_feature_box_date');
		?>
           <form action="" method="post" enctype="multipart/form-data" id="form-setting-site" class="setting-form">
            <input type="hidden" name="action" value="settings" />
             <div class="form-element"><label for="active_page">Magazine Title(Bangla)</label>
            <input type="text" class="wlarg" name="setting[second_feature_box_title]" value="<?php echo $second_feature_box_title;?>"/></div>
             <div class="form-element"><label for="active_page">Select Magazine</label>
             <select id="second_feature_box" name="setting[second_feature_box]">
             <?php foreach($feature_page as $feature=>$text):?>
                     <option value="<?php echo $feature;?>" <?php if($second_feature_box == $feature) echo 'selected'?>><?php echo $text;?></option>
              <?php endforeach;?>
             </select></div>
              <div class="form-element"><label for="active_page">Select Date</label>
            <input type="text" class="wsmall ui_date" name="setting[second_feature_box_date]" value="<?php echo $second_feature_box_date;?>"/></div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
        </div> 
        <h3>Third Feature Box</h3>
        <div class="accordion-content">
        <?php 
		$third_feature_box_title=get_options('third_feature_box_title');
		$third_feature_box=get_options('third_feature_box');
		$third_feature_box_date=get_options('third_feature_box_date');
		?>
           <form action="" method="post" enctype="multipart/form-data" id="form-setting-site" class="setting-form">
            <input type="hidden" name="action" value="settings" />
            <div class="form-element"><label for="active_page">Magazine Title(Bangla)</label>
            <input type="text" class="wlarg" name="setting[third_feature_box_title]" value="<?php echo $second_feature_box_title;?>"/></div>
             <div class="form-element"><label for="active_page">Select Magazine</label>
             <select id="first_feature_box" name="setting[third_feature_box]">
             <?php foreach($feature_page as $feature=>$text):?>
                     <option value="<?php echo $feature;?>" <?php if($third_feature_box == $feature) echo 'selected'?>><?php echo $text;?></option>
              <?php endforeach;?>
             </select></div>
              <div class="form-element"><label for="active_page">Select Date</label>
            <input type="text" class="wsmall ui_date" name="setting[third_feature_box_date]" value="<?php echo $third_feature_box_date;?>"/></div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
        </div>  
 </div>
</div>
<script type="application/javascript">
 $(function() {
	 $( "#accordion-settings" ).accordion({heightStyle: "content"});
	 $( "#active_date,input.ui_date" ).datepicker({dateFormat:'dd-mm-yy'});
/*	 $( "#active_date").on('change',function(){		    
		    var post_date=$(this).val();
             $.ajax({
			 url: 'adminAjax.php',
			 data:{'function':'get_spage_option','val':post_date},
			 type:'POST',			 			 
			 success: function(responce){
				$('#active_page').html(responce);
			 }
			 });
	 });*/
	 $('form.setting-form').on('submit',function(){
		  var form_loder=$(this).find('.form-element-submit');
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
			return false;
	 });
  });
 </script>