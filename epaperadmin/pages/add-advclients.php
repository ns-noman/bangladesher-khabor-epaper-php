<?php require_once('global.php');
      global $setting,$epdb;
      extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Clients</h1><div class="clearfix"></div></div>
<div class="page-enty">
<div id="accordion-clients">
        <h3>All Clients</h3>
        <div class="accordion-content">
         <form action="" method="post" enctype="multipart/form-data" id="form-update-advclients" class="clients-form">
         <input type="hidden" name="action" value="update_client" />
          <table class="datalist" width="100%">
           <thead>
            <tr>
              <th align="left">#</th>
              <th align="left">Name</th>
              <th align="left">Link</th>
              <th align="left">Remove</th>
            </tr>
           </thead>
           <tbody>
            <?php $clients=$epdb->get_results("SELECT * FROM e_advclient WHERE status='1' ORDER BY ID DESC");
			 foreach($clients as $n=>$cl):
			?>
             <tr>
              <td><?php echo $n+1;?><input type="hidden" name="clients[cln][<?php echo $cl->ID;?>]" value="1" /></td>
              <td><?php echo $cl->name;?></td>
              <td><input type="text"  name="clients[links][<?php echo $cl->ID;?>]" value="<?php echo $cl->link;?>"/></td>
              <td><input type="checkbox"  value="1" name="clients[status][<?php echo $cl->ID;?>]"/></td>
             </tr>
             <?php endforeach;?>
           </tbody>
          </table>
          <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Update" class="submit_button"/></div>
         </form>
        </div>
        <h3>Add Clients</h3>
        <div class="accordion-content">
           <form action="" method="post" enctype="multipart/form-data" id="form-add-advclients" class="clients-form">
            <input type="hidden" name="action" value="addClients" />
             <div class="form-element"><label for="client[name]">Name : </label>
             <input type="text" class="wlarg" name="client[name]" value="" placeholder="XYZ LTD."/></div>
             <div class="form-element"><label for="client[url]">Url/Link :</label>
             <input type="text" class="wlarg" name="client[url]" value="" placeholder="http://example.com"/></div>
             <div class="form-element form-element-submit"><input type="submit" id="form-setting-site-submit"  value="Save" class="submit_button"/></div>
           </form>
        </div>


 </div>
</div>
<script type="application/javascript">
 $(function() {
	 $( "#accordion-clients" ).accordion({heightStyle: "content"});
 });
 $(document).ready(function(){
	$('form.clients-form').on('submit',function(){
		 $('#page_title').addClass('lodding');
		if($('#client_name').val()=='0'){show_massage('Enter Client Name.','error'); $('#page_title').removeClass('lodding');return false;}		
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
					 load_ajax_page('pages/add-advclients.php'); 
				}else{
					 $('#page_title').removeClass('lodding');
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });
		return false;
	});
});
</script>