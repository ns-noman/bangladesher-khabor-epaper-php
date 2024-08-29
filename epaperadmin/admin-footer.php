  </div>
  <div role="complementary" class="widget-area" id="sidebar">
   <aside class="widget">
       <img src="assets/images/logo.png" alt="Logo" width="80"  class="align-center" style="margin: 20px; "/>
   </aside>
    <?php require_once('admin-menu.php');?> 
   <aside class="widget user">
     <p>Welcome: <?php echo $_SESSION['USERNAME'];?></p>
     <p><a href="login.php?action=logout" tuitle="Log Out">Logout</a></p>
   </aside>
  </div>
  </div>
 </div>
</div>
<div id="status" class=""></div>
</body>
</html>
