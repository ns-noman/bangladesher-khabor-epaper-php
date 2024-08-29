   <div id="accordion-nav">
       <aside class="widget">
            <h3 class="widget-title">Epaper</h3>
            <ul>
                <!--<li><a id="dashbord" href="pages/dashboard.php" data="dashbord">Dashbord</a></li> --> 
                <li><a id="settings" href="pages/settings.php" data="dashbord">Settings</a></li>             
           </ul>
        </aside>
         <aside class="widget">
            <h3 class="widget-title">Page</h3>
            <ul>
                <li><a id="all_pages" href="pages/pages.php">All Page</a></li>
                <li><a id="add_news_page" href="pages/add-new-page.php">Add New Page</a></li>
               <!-- <li><a id="page_archives" href="pages/page-archives.php">Page Archives</a></li>-->                            
           </ul>
        </aside>
         <aside class="widget">
            <h3 class="widget-title">News</h3>
            <ul>
               <!-- <li><a id="all_nesw" href="pages/news.php">All News</a></li>   -->
                <li><a id="add_new_news" href="pages/add-new-news.php">Add New News</a></li>
                <li><a id="add_new_news" href="pages/set-news-link.php">Set News Link</a></li>                        
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
        <?php if(!empty($_SESSION['USERTYPE']) && $_SESSION['USERTYPE'] == "admin"):?>
       <aside class="widget ">
            <h3 class="widget-title active">User</h3>
            <ul>
               <!-- <li><a id="all_advertise" href="pages/advertise.php">All Advertise</a></li> -->
                <li><a id="addnewadvertise" href="pages/add-user.php">Add User</a></li>                
                <li><a id="addnewadvertise" href="pages/change-password.php">Change Password</a></li> 
                   	
           </ul>
        </aside>
         <?php endif;?>          
    </div>