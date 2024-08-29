<div id="accordion-nav">
     <aside class="widget" style="border-bottom:solid 3px #eee">
          <ul>
               <li><a id="settings" href="pages/settings.php" data="dashbord">Settings</a></li>
          </ul>
     </aside>
     <aside class="widget" style="border-bottom:solid 3px #eee">
          <ul>
               <li><a id="all_pages" href="pages/pages.php">All Pages</a></li>
               <li><a id="add_news_page" href="pages/add-new-page.php">Add Page</a></li>
          </ul>
     </aside>
     <aside class="widget" style="border-bottom:solid 3px #eee">
          <ul>
               <li><a id="add_new_news" href="pages/add-new-news.php">Add News</a></li>
               <li><a id="add_new_news" href="pages/set-news-link.php">Set Link</a></li>
          </ul>
     </aside>
               <aside class="widget " style="display:none;">
                    <h3 class="widget-title active">Advertise Manager</h3>
          <ul>
               <li><a id="all_advertise" href="pages/advertise.php">All Advertise</a></li>
               <li><a id="addnewadvertise" href="pages/add-advertise.php">Add Advertise</a></li>
               <li><a id="addnewadvertise" href="pages/add-advclients.php">Clients</a></li>
          </ul>
     </aside>
     <?php if (!empty($_SESSION['USERTYPE']) && $_SESSION['USERTYPE'] == "admin"): ?>
     <aside class="widget " style="border-bottom:solid 1px #eee">
          <ul>
               <li><a id="addnewadvertise" href="pages/add-user.php">Add User</a></li>
               <li><a id="addnewadvertise" href="pages/change-password.php">Change Password</a></li>
          </ul>
     </aside>
     <?php endif;?>
</div>