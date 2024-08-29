<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="canonical" href="https://epaper.bangladesherkhabor.net/?v=<?php echo strtotime(date('Y-m-d')); ?>">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($title) ? $title : $siteinfo['HomePageTitle']; ?></title>
    <meta name="Description" content="<?php echo isset($description) ? $description : $siteinfo['MetaDescription']; ?>">
    <link rel="shortcut icon" href="<?php echo $this->config->item('assets_url') . $siteinfo['FavIcon']; ?>" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/contents/css/colorbox.css" />
    <!--<link href="<?php echo base_url(); ?>assets/contents/css/style.css?v=1" rel="stylesheet">-->
    <link href="<?php echo base_url(); ?>assets/contents/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo current_url(); ?>" />
    <meta property="og:site_name" content="<?php echo $siteinfo['HomePageTitle']; ?>" />
    <meta property="og:image" content="<?php echo isset($page_image) ? $page_image : $this->config->item('assets_url') . $siteinfo['Logo']; ?>" />
    <meta property="og:title" content="<?php echo isset($title) ? $title : $siteinfo['SiteName']; ?>" />
    <meta property="og:description" content="<?php echo isset($description) ? $description : $siteinfo['MetaDescription']; ?>" />




    <style>
        #cboxOverlay {
            background: #000
        }

        .logoTop .img-responsive {
            margin: 0 auto;
        }

        .example3 .navbar {
            margin-bottom: 10px;
        }

        .container-fluid2 .navbar-brand {
            padding: 5px 5px;
        }

        .navbar-brand-centered p {
            font-size: 12px;
            text-align: right;
        }

        .container {
            padding-right: 0;
            padding-left: 0;
        }

        .datepicker {
            width: 260px;
            margin: 0 auto;
            border-radius: 0px;
        }


        h2.archive {
            background: #4CAF50;
            color: #fff;
            margin: 0;
            padding: 5px 10px;
            font-size: 18px;
        }
    </style>
    <style>
        @font-face {
            font-family: SolaimanLipi;
            src: local('SolaimanLipi'),
                url('../fonts/solaimanlipi.woff') format('woff'),
                url('../fonts/solaimanlipi.woff2') format('woff2');
        }

        body {
            margin: 0;
            padding: 0;
            font-family: SolaimanLipi;
        }

        img {
            border: 0;
            max-width: 100%;
        }

        ul li {
            list-style: none;
        }

        .wrapper {
            width: 1265px;
            margin: 0 auto;
            overflow: hidden;
        }

        /*  Header */
        .header {
            width: 100%;
            text-align: center;
            overflow: hidden;
        }

        .headerTopNav {
            background: #017AC3;
            text-align: right;
            padding: 0;
            height: 32px;
        }

        .headerTopNav .online-vershion {
            float: left;
            text-align: left;
            width: 15%;
        }

        .headerTopNav .online-date {
            float: left;
            line-height: 30px;
            color: #ffffff;
            width: 40%;
            text-align: center;
        }

        .headerTopNav .online-weather img {
            vertical-align: middle;
        }

        .headerTopNav .online-weather {
            float: left;
            line-height: 24px;
            color: #ffffff;
            width: 20%;
            text-align: center;
        }

        .headerTopNav .online-vershion a {
            padding-left: 10px;
            font-size: 16px;
        }

        .social-icons {
            float: right;
            height: 32px;
            overflow-x: hidden;
            overflow-y: hidden;
            padding-left: 10px
        }

        .social-icons a:hover {
            color: #ffffff;
        }

        .social-icons .facebook:hover {
            /* background: #3b5998;*/
            color: #3b5998;
            ;
        }

        .social-icons .twitter:hover {
            /*  background: #1ebef0;*/
            color: #1ebef0;

        }

        .social-icons .google-plus:hover {
            /* background: #dc4a38;*/
            color: #dc4a38;
        }

        .social-icons .youtube:hover {
            /*  background:#C52F30;*/
            color: #C52F30;
        }

        .social-icons .linkedin:hover {
            /* background:#025DAC;*/
            color: #025DAC;
        }

        ul.social {
            margin-top: 2px;
        }

        ul.social li {
            padding-right: 10px;
        }

        ul.social li:last-child {
            padding-right: 0px;
        }

        ul.social li a {
            border-radius: 20px;
            background: #ffffff;
            height: 28px;
            width: 28px;
            display: inline-block;
            color: #939393;
            text-align: center;
        }


        .headerTopNav ul {
            display: inline-flex
        }

        .headerTopNav li {
            display: inline;
            margin-right: 5px
        }

        .headerTopNav a {
            font-size: 80%;
            color: #fff;
            text-decoration: none;
            line-height: 30px
        }

        .headerTopNav a:hover {
            text-decoration: none
        }

        .mi_32x32 {
            background-attachment: scroll;
            background-clip: border-box;
            background-color: rgba(0, 0, 0, 0);
            background-image: url(../images/social.png);
            background-origin: padding-box;
            background-repeat: no-repeat;
            background-size: auto auto;
            color: transparent;
            cursor: pointer;
            display: inline-block;
            height: 32px;
            text-indent: -999px;
            width: 32px;
        }

        .mi_32x32_tw {
            background-position: 0 -64px;
        }

        .mi_32x32_gp {
            background-position: 0 -128px;
        }



        .archive {
            margin-top: 10px;
            border: 1px solid #337ab7;
            text-align: left
        }

        .archive_field {
            padding-right: 1px
        }

        .archive_select {
            width: 95px;
            font-size: 8.5pt;
            color: #333;
            font-family: Arial;
            text-decoration: none;
            line-height: 14pt;
            height: 22px;
            border: 1px solid #337ab7;
        }

        .archive_select.date {
            width: 45px
        }

        .archive_select.year {
            width: 55px
        }

        .archive_go {
            font-size: 9.5pt;
            color: #fff;
            font-family: Arial;
            text-decoration: none;
            line-height: 14pt;
            width: 34px;
            background: #337ab7;
            border: 1px solid #a4a4a4
        }

        select#armonth {
            width: 85px
        }

        select#aryear {
            width: 55px
        }

        .purono-sonkha-img {
            float: left;
            margin-right: 7px
        }

        .bottomBanner {
            padding: 5px 0;
            margin: 0 10px 20px;
            background: #f1f1f1;
            text-align: center
        }

        .headerTopAdd {
            text-align: center;
            border: 1px solid #ccc;
            padding: 10px 0
        }

        .headerTopAdd .logo {
            float: left;
            padding-left: 10px;
            padding-top: 20px;
        }

        .headerTopAdd .ad {
            float: right
        }

        .headerMain {
            background: #f2f4f7;
            border-bottom: 1px solid #ccc;
            border-top: 1px solid #ccc
        }




        /* main content */


        .left_side {
            width: 899px;
            float: left;
            margin: 25px 30px 25px 0;
        }

        .indivisual-page {
            overflow: hidden;
        }

        .indivisual-page .pagination {
            float: left;
            margin-right: 20px
        }

        .pagination ul {
            display: inline-block;
            padding: 0;
            margin: 8px 0;

        }

        .pagination ul li {
            display: inline-block;
        }

        .pagination ul li a,
        .pagination ul li span {
            color: black;
            float: left;
            padding: 5px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .pagination ul li a:hover {
            background-color: #ddd;
        }

        .pagination ul li.active {
            background-color: #4CAF50;
        }

        .pagination ul li.active span {
            color: #ffffff;
        }

        .indivisual-page .select-page {
            float: left;
            margin-top: 8px;
        }

        .indivisual-page .select-page select {
            padding: 5px 8px 5px 8px;
            font-size: 16px;
            width: 200px;
            font-family: SolaimanLipi;
        }

        .main_content {
            text-align: justify;
        }

        #page-content {
            position: relative;
            text-align: center;
            margin: 0 auto;
            border: 1px solid #ccc;
        }

        #page-content a.news-box {
            position: absolute;
            display: block;
        }

        #page-content a.news-box:hover {
            background-color: rgba(0, 0, 0, .3);
        }

        .navigation ul {
            width: 100%;
        }

        .navigation .last {
            float: right;
        }

        .right_side {
            float: right;
            width: 336px;
            margin-top: 25px;
        }

        .all_pages h2 {
            background: #4CAF50;
            color: #fff;
            margin-top: 23px;
            padding: 5px 10px;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .all_pages ul {
            padding-left: 0;
            padding-right: 10px;
            height: 400px;
            overflow-y: scroll;
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 0px;

        }

        .all_pages ul li {
            height: 200px;
            overflow-y: hidden;
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
            position: relative
        }


        .all_pages ul li span {
            position: absolute;
            bottom: 2px;
            right: 2px;
            background: red;
            width: 30px;
            height: 25px;
            text-align: center;
            padding-top: 5px;
            color: #fff;
        }

        .right_side .advertise {
            margin: 0 auto;
        }

        /* Footer  */
        .footerText {
            width: 100%;
            overflow: hidden;
            border-top: 1px solid #bbbcbd;
            background: #e7e7e7;
            text-align: center;
        }
    </style>
    <style>
        #colorbox,
        #cboxOverlay,
        #cboxWrapper {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9999;
            overflow: hidden;
            -webkit-transform: translate3d(0, 0, 0);
        }

        #cboxWrapper {
            max-width: none;
        }

        #cboxOverlay {
            position: fixed;
            width: 100%;
            height: 100%;
        }

        #cboxMiddleLeft,
        #cboxBottomLeft {
            clear: left;
        }

        #cboxContent {
            position: relative;
        }

        #cboxLoadedContent {
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }

        #cboxTitle {
            margin: 0;
        }

        #cboxLoadingOverlay,
        #cboxLoadingGraphic {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #cboxPrevious,
        #cboxNext,
        #cboxClose,
        #cboxSlideshow {
            cursor: pointer;
        }

        .cboxPhoto {
            float: left;
            margin: auto;
            border: 0;
            display: block;
            max-width: none;
            -ms-interpolation-mode: bicubic;
        }

        .cboxIframe {
            width: 100%;
            height: 100%;
            display: block;
            border: 0;
            padding: 0;
            margin: 0;
        }

        #colorbox,
        #cboxContent,
        #cboxLoadedContent {
            box-sizing: content-box;
            -moz-box-sizing: content-box;
            -webkit-box-sizing: content-box;
        }

        /*

        #cboxOverlay {
            background: #fff;
            opacity: 0.9;
            filter: alpha(opacity=90);
        }

        #colorbox {
            outline: 0;
        }

        #cboxContent {
            margin-top: 32px;
            overflow: visible;
            background: #000;
        }

        .cboxIframe {
            background: #fff;
        }

        #cboxError {
            padding: 50px;
            border: 1px solid #ccc;
        }

        #cboxLoadedContent {
            background: #fff;
            padding: 1px;
        }

        #cboxLoadingGraphic {
            background: url(../images/loading.gif) no-repeat center center;
        }

        #cboxLoadingOverlay {
            background: #000;
        }

        #cboxTitle {
            position: absolute;
            top: -22px;
            left: 0;
            color: #000;
        }

        #cboxCurrent {
            position: absolute;
            top: -22px;
            right: 205px;
            text-indent: -9999px;
        }

        /* these elements are buttons, and may need to have additional styles reset to avoid unwanted base styles */
        #cboxPrevious,
        #cboxNext,
        #cboxSlideshow,
        #cboxClose {
            border: 0;
            padding: 0;
            margin: 0;
            overflow: visible;
            text-indent: -9999px;
            width: 24px;
            height: 24px;
            position: absolute;
            top: 10px;
            background: url(../images/controls.png) no-repeat 0 0;
        }

        /* avoid outlines on :active (mouseclick), but preserve outlines on :focus (tabbed navigating) */
        #cboxPrevious:active,
        #cboxNext:active,
        #cboxSlideshow:active,
        #cboxClose:active {
            outline: 0;
        }

        #cboxPrevious {
            background-position: 0px 0px;
            right: 44px;
        }

        #cboxPrevious:hover {
            background-position: 0px -25px;
        }

        #cboxNext {
            background-position: -25px 0px;
            right: 22px;
        }

        #cboxNext:hover {
            background-position: -25px -25px;
        }

        #cboxClose {
            background-position: -25px 0px;
            right: 30px;
        }

        #cboxClose:hover {
            background-position: -25px -25px;
        }

        .cboxSlideshow_on #cboxPrevious,
        .cboxSlideshow_off #cboxPrevious {
            right: 66px;
        }

        .cboxSlideshow_on #cboxSlideshow {
            background-position: -75px -25px;
            right: 44px;
        }

        .cboxSlideshow_on #cboxSlideshow:hover {
            background-position: -100px -25px;
        }

        .cboxSlideshow_off #cboxSlideshow {
            background-position: -100px 0px;
            right: 44px;
        }

        .cboxSlideshow_off #cboxSlideshow:hover {
            background-position: -75px -25px;
        }
    </style>
</head>

<h1 style="position:absolute;top:-15389px">Playing online casino Malaysia through Alibaba33 online casino Malaysia can
    be a fun and rewarding experience for those who enjoy playing games for fun. <a
        href="https://www.judipoker365.com/">judipoker365.com</a>Bet on your favourite slots, live, sporting events and
    win big! If you enjoy sports, duitnow 918kiss slots like Mega888 ewallet Alibaba33 online casino Malaysia has
    something for you.</h1>

<body>
    <?php $pnumber = $this->uri->segment(2, 1); ?>
    <div class="wrapper">
        <div class="header">
            <div class="headerTopNav">
                <div class="online-vershion">
                    <a target='_blank' href="http://www.bangladesherkhabor.net/">অনলাইন ভার্সন</a>
                </div>
                <div class="online-date">
                    <?php echo getBanglaDate(date('D, j F ')) . getBanglaDate(date('Y')) . ', ' . $dateinfo['BanglaDate'] . ', ' . $dateinfo['ArabicDate']; ?>
                </div>
                <div class="online-weather">
                    <?php if(isset($weather->main->temp)) {?>
                    <img alt="weather" height="23" src="http://openweathermap.org/img/w/<?php echo $weather->weather[0]->icon; ?>.png">
                    <?php echo getBanglaDate($weather->main->temp); ?><sup>o</sup> সে. আদ্রতা <?php echo getBanglaDate($weather->main->humidity); ?>%
                    <?php } ?>

                </div>
                <div class="social-icons">
                    <ul class="social">
                        <li><a class="facebook text-center" target="_blank" href="https://www.facebook.com/bk.bnel/"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a class="twitter text-center" target="_blank" href="https://twitter.com/bk_bnel"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a class="google-plus text-center" target="_blank"
                                href="https://plus.google.com/u/1/103750288693046619035"><i class="fa fa-google-plus"
                                    aria-hidden="true"></i></a></li>
                        <li><a class="youtube text-center" target="_blank"
                                href="https://www.youtube.com/channel/UCafcud5S_jK-kLf5Lja4ErQ"><i class="fa fa-youtube"
                                    aria-hidden="true"></i></a></li>
                        <li><a class="linkedin text-center" target="_blank"
                                href="https://www.linkedin.com/company/13603152/admin/updates/"><i
                                    class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="headerTopAdd">
                <div class="logo">
                    <a href="<?php echo site_url(); ?>"> <img height="30"
                            src="<?php echo base_url(); ?>/assets/images/Logo.png" alt=""> </a>
                </div>
                <div id="ad" style="height:90px;">
                    <a href="http://www.maguragroup.com.bd/" target="_blank"> <img style="border: solid 1px #ccc;"
                            src="http://epaper.bangladesherkhabor.net/assets/ads/728X90.jpg" alt=""></a>
                </div>
            </div>
            <div class="headerMain" style="display:none;">
                <div style="padding-top:10px;padding-bottom:10px;">
                    <div class="Current_date" style="">
                        <?php echo banglaformat(date_format(date_create($active_date), 'l, j F Y')); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php //echo $_SERVER['DOCUMENT_ROOT']
        ?>
        <div class="main_content_section">
            <?php if($all_pages){ ?>
            <div class="left_side">
                <div class="indivisual-page">
                    <div class="pagination">
                        <?php echo $pagination; ?>
                    </div>
                    <div class="select-page">
                        <select onchange="location = this.value;">
                            <?php foreach($all_pages as $all_page){ ?>
                            <option <?php echo $pnumber == $all_page['pnumber'] ? 'selected' : ''; ?> value="<?php echo site_url() . $all_page['pdate'] . '/' . $all_page['pnumber']; ?>"><?php echo $all_page['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="page-content" class="main_content">
                    <?php echo $page_content; ?>
                </div>

                <div class="pagination navigation">
                    <ul>
                        <?php if($pnumber>1){?>
                        <li>
                            <a date="<?php echo $p['pdate']; ?>" data="<?php echo $pnumber - 1; ?>" href="<?php echo site_url() . $p['pdate'] . '/' . ($pnumber - 1); ?>"
                                title="<?php echo $p['title'] . ':' . $pnumber - 1; ?>"><i class="fa fa-angle-double-left fa-3"
                                    aria-hidden="true"></i>
                                << আগের পাতা</a>
                        </li>
                        <?php }?>
                        <?php if($pnumber < count($pages_list)){?>
                        <li class="last">
                            <a date="<?php echo $p['pdate']; ?>" data="<?php echo $pnumber + 1; ?>" href="<?php echo site_url() . $p['pdate'] . '/' . ($pnumber + 1); ?>"
                                title="<?php echo $p['title'] . ':' . $pnumber + 1; ?>">পরের পাতা >> </a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <?php } else{ ?>
            <div class="left_side">
                <h2>কোন পাতা পাওয়া যায় নি</h2>
            </div>
            <?php } ?>


            <!-- start: right sidebar -->
            <div class="right_side">
                <div class="headerSearch" style="width:336px;">
                    <div class="serach-portion" style="text-align:center; margin-bottom:20px;">


                        <h2 class="archive">আর্কাইভ</h2>

                        <input style="width: 250px; padding: 5px; margin:5px 0 2px 0;" value="<?php echo $this->uri->segment(1, date('d-m-y')); ?>" />

                        <div class="datepicker-here" data-language='en' data-date-format="dd-mm-yyyy"></div>

                        <div class="archive" style="margin:10px 0; display:none">
                            <div style="padding:8px;background-color: #f2f4f7;">
                                <p style="float:left;margin-top:1px;padding-right:10px;color:#337ab7">আর্কাইভ </p>
                                <form class="form-inline choose-date" role="form" method="post"
                                    accept-charset="UTF-8" style="display:hidden">
                                    <input value="<?php echo site_url(); ?>" id="url" type="hidden" />
                                    <span class="archive_field">
                                        <select class="archive_select date" id="Day" required>
                                            <option>Day</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                if ($i == $current_day) {
                                                    echo "<option selected value='" . $i . "'>" . sprintf('%02d', $i) . '</option>';
                                                } else {
                                                    echo "<option value='" . $i . "'>" . sprintf('%02d', $i) . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </span>

                                    <span class="archive_field">
                                        <select class="archive_select" id="Month" required>
                                            <option value="0">Month</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                if ($i == $current_month) {
                                                    echo "<option selected value='" . $i . "'>" . sprintf('%02d', $i) . '</option>';
                                                } else {
                                                    echo "<option value='" . $i . "'>" . sprintf('%02d', $i) . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </span>
                                    <span class="archive_field">
                                        <select class="archive_select year" id="Year" required>
                                            <option>Year</option>
                                            <?php
                                            for ($i = date('Y'); $i >= 2017; $i--) {
                                                if ($i == $current_year) {
                                                    echo "<option selected value='" . $i . "'>" . $i . '</option>';
                                                } else {
                                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </span>
                                    <input class="archive_go" type="submit" id="go" value="go">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($all_pages){ ?>
                <div class="all_pages">
                    <h2>সকল পাতা</h2>
                    <ul>
                        <?php foreach($all_pages as $all_page){ ?>
                        <li><a href="<?php echo site_url() . $all_page['pdate'] . '/' . $all_page['pnumber']; ?>"><img width="100%" src="<?php echo $all_page['img_small']; ?>"
                                    alt=""><span><?php echo $all_page['pnumber']; ?></span></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="advertise">
                    <a href="http://www.maguragroup.com.bd/" target="_blank"> <img style="border: solid 1px #ccc;"
                            src="http://epaper.bangladesherkhabor.net/assets/ads/300X600.jpg" alt=""></a>
                </div>
            </div>
        </div>

    </div>
    <div class="footerText">
        <div class="footerTextIn">
            <div class="footerTextInner">
                <div class="container2">
                    <div class="row site_url" data-url="<?php echo current_url(); ?>">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="footerMid">
                                <p> © <?php echo date('Y'); ?> Bangladesher Khabor. All rights reserved.</p>
                                <p>
                                    ভারপ্রাপ্ত সম্পাদক: সৈয়দ মেজবাহ উদ্দিন।
                                </p>
                                <p>বার্তা ও বাণিজ্যিক কার্যালয়: প্লট নং-৩১৪/এ, রোড-১৮, বøক-ই, বসুন্ধরা আ/এ, ঢাকা-১২২৯।
                                </p>
                                <p>
                                    পিএবিএক্স : ৫৫০৩৬৪৫৬-৭, ৫৫০৩৬৪৫৮ ফ্যাক্স : ৮৪৩১০৯৩ সার্কুলেশন: ০১৮৪৭-৪২১১৫২ বিজ্ঞাপন
                                    : ০১৮৪৭-০৯১১৩১, ০১৭৩০-৭৯৩৪৭৮, ০১৮৪৭-৪২১১৫৩, Email: newsbnel@gmail.com, বিজ্ঞাপন:
                                    bkhaboradvt2021@gmail.com, www.bangladesherkhabor.net, www.bangladesherkhabor.org
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/contents/js/jquery.colorbox.js"></script>

    <script src="<?php echo base_url(); ?>assets/contents/jPaginate/jquery.paginate.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>


    <!--<script src="<?php echo base_url(); ?>assets/contents/js/responsive-paginate.js"></script>-->
    <script>
        $(document).ready(function() {

            var site_url = $(".site_url").attr("data-url");

            $('button[data-toggle=popover]').popover({
                html: true,
                //trigger: "click", // ???? ?? ??? ??????
                content: function() {
                    return $('#popover_content_wrapper').html();
                }
            });

            // $(".pagination").rPage();




            $("#demo2").paginate({
                count: <?php echo count($pages_list); ?>,
                start: <?php echo $pnumber; ?>,
                display: <?php echo count($pages_list) < 16 ? count($pages_list) : 16; ?>,
                border: false,
                text_color: '#888',
                background_color: '#EEE',
                text_hover_color: 'black',
                background_hover_color: '#CFCFCF',
                onChange: function(page) {
                    //$('._current','#paginationdemo').removeClass('_current').hide();
                    //$('#p'+page).addClass('_current').show();


                    window.location = site_url + page;
                    // alert(page);
                }
            });

            $("#demo23").paginate({
                count: <?php echo 100; ?>,
                start: 1,
                display: <?php echo 16; ?>,
                border: false,
                text_color: '#888',
                background_color: '#EEE',
                text_hover_color: 'black',
                background_hover_color: '#CFCFCF',
                onChange: function(page) {
                    //$('._current','#paginationdemo').removeClass('_current').hide();
                    //$('#p'+page).addClass('_current').show();
                    // var site_url =  $('.site_url').data("url");
                    //  var site_url =  $(this).attr('data-url');



                    window.location = site_url + page;
                    // alert(page);
                }
            });

        });

        $(function() {
            // bind change event to select
            $('.news-page-select').on('change', function() {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });

        $(document).ready(function() {
            $('.choose-date').on('submit', function(e) {

                var url = $('#url').val(); // get selected value

                var Day = $('#Day').val();
                var Month = $('#Month').val();
                var Year = $('#Year').val();


                FullDate = ('0' + Day).slice(-2) + '-' +
                    ('0' + Month).slice(-2) + '-' +
                    Year + '/1';

                window.location = url + FullDate;

                e.preventDefault();
            });
        });

        //choose-date
    </script>


    <script>
        $(document).ready(function() {
            //Examples of how to assign the Colorbox event to elements

            // $(".iframe").colorbox();
            $(".iframe").colorbox({
                iframe: true,
                width: "80%",
                height: "100%"
            });
            // $(".inline").colorbox();

            var base_url = '<?php echo site_url(); ?>';

            $picker = $('.datepicker-here');

            var dp = $picker.datepicker({
                //language: 'en',
                // maxDate: new Date(),

            }).on('changeDate', function(e) {
                // console.log(e.format());
                window.location.href = base_url + e.format();
            });
        });
    </script>













</body>

</html>
