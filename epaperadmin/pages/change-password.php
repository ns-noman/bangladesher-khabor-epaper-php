<?php require_once('global.php');
      global $setting,$epdb;
      extract($setting);
	  $users=$epdb->get_results("SELECT ID, user_name,user_type FROM e_users ORDER BY user_name");
?>
<div id="page_title" class="icon-32"><span class=""></span><h1>Change Password</h1><div class="clearfix"></div></div>
<div class="page-enty">
  <form action="" method="post" enctype="multipart/form-data" id="form-add-user" class="setting-form">
   <input type="hidden" name="action" value="change_password" />
   <div class="form-element"><label for="user_id">User: </label>
   <select name="user[user_id]" id="user_id"  class="wsmall">
    <option value="0">--Select--</option>
    <?php foreach($users as $u){ echo ' <option value="'.$u->ID.'">'.$u->user_name.'('.$u->user_type.')'.'</option>';}?>
   </select>
   </div>
    <div class="form-element"><label for="user_pass">New Password: </label><input id="user_pass" name="user[newpass]"  class="wsmall" type="text"/></div>
   <div class="form-element form-element-submit"><input type="submit" id=""  value="Save" class="submit_button"/></div>
  </form>
 </div>

<script type="application/javascript">
 $(document).ready(function(){
	$('#form-add-user').on('submit',function(){
		var lodder=$('#page_title');
		lodder.addClass('lodding');
		if($('#user_id').val()=='0' ){
			 show_massage('Please select user!!','error');
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