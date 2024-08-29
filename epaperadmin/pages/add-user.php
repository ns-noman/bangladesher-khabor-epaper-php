<?php require_once('global.php');
      global $setting;
      extract($setting);
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Add new User</h1><div class="clearfix"></div></div>
<div class="page-enty">
  <form action="" method="post" enctype="multipart/form-data" id="form-add-user" class="setting-form">
   <input type="hidden" name="action" value="adduser" />
   <div class="form-element"><label for="user_id">User name: </label><input id="user_id" name="user[user_id]"  class="wsmall" type="text"/></div>
    <div class="form-element"><label for="user_pass">User Password: </label><input id="user_pass" name="user[password]"  class="wsmall" type="text"/></div>
    <div class="form-element"><label for="user[type]">User Role: </label><select class="wsmall" name="user[type]"><option value="editor">Editor</option><option value="admin">Adminstrator</option></select></div>
   <div class="form-element form-element-submit"><input type="submit" id=""  value="Save" class="submit_button"/></div>
  </form>
 </div>

<script type="application/javascript">
 $(document).ready(function(){
	$('#form-add-user').on('submit',function(){
		var lodder=$('#page_title');
		lodder.addClass('lodding');
		if($('#user_id').val()=='' || $('#user_id').val().length < 6 ){
			 show_massage('Please inter a strong userid without space, minimum 6 charcter!!','error');
			  lodder.removeClass('lodding');
			  return false;
			}
		if($('#user_pass').val()=='' || $('#user_pass').val().length < 6){
			show_massage('Please inter a strong pasword, minimum 6 charcter!!','error'); 
			 lodder.removeClass('lodding');
			return false;
		}
		 var post_data=$(this).serialize();             
             $.ajax({
			 url: 'formAction.php',
			 data:post_data,
			 type:'POST',
			 dataType:'json',			 
			 success: function(responce){
				 lodder.removeClass('lodding');
				if(responce.success == '1'){					
                    show_massage(responce.msg,'success');					
				}else{				  
				  show_massage(responce.msg,'error');				    
			    }
			 }
			 });
		return false;
	});
});
 </script>