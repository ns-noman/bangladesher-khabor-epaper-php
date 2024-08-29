<?php 
 require_once('global.php');
      global $setting;
      extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>All Advertise</h1><div class="clearfix"></div></div>
<div class="page-enty">
<div id="accordion-advertise">
 <?php 
 global $epdb ;
 $clients=$epdb->get_results("SELECT * FROM e_advclient WHERE status='1' ORDER BY name ASC");
 foreach($clients as $cl):
 ?>
  <h3><?php echo $cl->name;?><span class="link"><?php echo $cl->link;?></span></h3>
        <div class="accordion-content">
         <form action="" method="post" enctype="multipart/form-data" id="form-update-adv" class="clients-form">
         <input type="hidden" name="action" value="update_adv" />
          <?php $advertise=$epdb->get_results("SELECT * FROM e_advertise WHERE client_id=".$cl->ID." ORDER BY ID DESC");?>
          <table class="datalist" width="100%">
           <thead>
            <tr>
              <th align="left">#</th>
              <th align="left">Image</th>
              <th align="left">locations</th>
              <th align="left">Order</th>
              <th align="left">Slide Show</th>
              <th align="left">Deactive</th>
              <th align="left">Remove</th>
            </tr>
           </thead>
           <tbody>
            <?php //$clients=$epdb->get_results("SELECT * FROM e_advertise WHERE client_id= status='1' ORDER BY ID DESC");
			 foreach($advertise as $a=>$adv):
			?>
             <tr>
              <td><?php echo $a+1;?><input type="hidden" name="adv[<?php echo $adv->ID;?>]" value="1" /></td>
              <td><a href="<?php echo $adv->uri;?>" rel="light-box" title="<?php echo $cl->name;?>"><img src="<?php echo $adv->uri;?>" width="120" /></a> </td>
              <td>
			       <select name="adv_location[<?php echo $adv->ID;?>]"> 
                     <?php 
					   foreach($adv_locations as $loc=>$pos){ 
					   $select=($loc==$adv->locations)? "selected=\"selected\"":""; 
					   echo '<option value="'.$loc.'" '.$select.'>'.$pos.'</option>';
					  } ?>
                   </select>
			  </td>
              <td><select name="adv_order[<?php echo $adv->ID;?>]"> 
                     <?php 
					   for($i=0;$i<30;$i++){ 
					   $select=($i==$adv->order)? "selected=\"selected\"":""; 
					   echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
					  } ?>
                   </select>
              </td>
              <td><input type="checkbox"  value="1" name="adv_slide[<?php echo $adv->ID;?>]" <?php if($adv->is_slide==1):?>checked="checked"<?php endif;?>/></td>
              <td><input type="checkbox"  value="1" name="adv_status[<?php echo $adv->ID;?>]" <?php if($adv->status !=1):?>checked="checked"<?php endif;?>/></td>
              <td><input type="checkbox"  value="1" name="adv_remove[<?php echo $adv->ID;?>]"/></td>
             </tr>
             <?php endforeach;?>
           </tbody>
          </table>
           <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Update" class="submit_button"/></div>
          </form>
        </div>
 <?php endforeach;?>
 </div>
</div>
<script type="text/javascript">
 $(function() {
	 $( "#accordion-advertise" ).accordion({heightStyle: "content",active: 'none'});
 });
  $(document).ready(function(){
	$('form.clients-form').on('submit',function(){
		 $('#page_title').addClass('lodding');	
		 var post_data=$(this).serialize();             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				if(responce.success == '1'){
					 $('#page_title').removeClass('lodding');
                     show_massage(responce.msg,'success');
					 load_ajax_page('pages/advertise.php'); 
				}else{
					 $('#page_title').removeClass('lodding');
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });
		return false;
	});
	$('a[rel="light-box"]').colorbox({slideshowAuto:false,loop:false,current: "{current}|{total}",rel:false});
});
</script>