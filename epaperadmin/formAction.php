<?php
require_once 'global.php';
session_save_path(SESSION_PATH);

ini_set('session.gc_probability', 1);
//$_POST = $_GET ;
if (empty($_POST)) {
    $output = array('success' => '0', 'msg' => 'Invalid Request.');
    echo json_encode($output);
} else {
    switch ($_POST['action']) {
        case 'add_new_page':
            require_once 'inc/process-page.php';
            $output = add_new_page($_POST);
            break;
        case 'load_all_page':
            require_once 'inc/process-page.php';
            $output = load_all_page($_POST);
            break;
        case 'update_pages':
            require_once 'inc/process-page.php';
            $output = update_all_pages($_POST);
            break;
        case 'addnews':
            require_once 'inc/process-news.php';
            $output = add_new_news($_POST);
            break;
        case 'loadnewslinks':
            require_once 'inc/process-news.php';
            $output = ajax_load_page_news_links($_POST);
            break;
        case 'loadnews':
            require_once 'inc/process-news.php';
            $output = ajax_load_page_news($_POST);
            break;
        case 'setreflink':
            require_once 'inc/process-news.php';
            $output = set_ref_link($_POST);
            break;
        case 'get_page_options':
            require_once 'inc/process-news.php';
            $output = get_pages_for_select($_POST['date']);
            break;
        case 'userlogin':
            require_once 'inc/process-settings.php';
            $output = login_user($_POST['user']);
            break;
        case 'adduser':
            require_once 'inc/process-settings.php';
            $output = add_users($_POST['user']);
            break;
        case 'change_password':
            require_once 'inc/process-settings.php';
            $output = user_change_password($_POST['user']);
            break;
        case 'settings':
            require_once 'inc/process-settings.php';
            $output = update_page_settings($_POST);
            break;
        case 'addadv':
            require_once 'inc/process-adv.php';
            $output = add_advertise($_POST['adv']);
            break;
        case 'update_adv':
            require_once 'inc/process-adv.php';
            $output = update_advertise($_POST);
            break;
        case 'addClients':
            require_once 'inc/process-adv.php';
            $output = add_advclients($_POST['client']);
            break;
        case 'update_client':
            require_once 'inc/process-adv.php';
            $output = update_advclients($_POST);
            break;
        default:
            $output = array('success' => '0', 'msg' => 'Invalid Request.');
            break;
    }
    echo json_encode($output);
}
