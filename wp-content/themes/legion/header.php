<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' :';
        } ?><?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <link rel="stylesheet"
          href="<?php echo get_template_directory_uri(); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="<?php echo get_template_directory_uri(); ?>/fonts/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="<?php echo get_template_directory_uri(); ?>/fonts/jquery-3.2.1/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/fonts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <?php wp_head(); ?>
    <script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
    </script>
</head>
<body <?php body_class(); ?>>
<i id="showHideSideBar" onclick="hideShowSideBar(false)"
   class="fa fa-arrow-circle-left fa-2x buttonSideBar hidden-lg hidden-md" aria-hidden="true"></i>
<!-- wrapper -->
<div class="wrapper">

    <!-- header -->
    <header class="header clear" role="banner">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?= get_home_url(); ?>">
                        <?php
                        $homePageId = get_option('page_on_front');
                        $image = get_field("logo", $homePageId);
                        echo wp_get_attachment_image($image["id"], 'medium', "", ["class" => "mainLogoHomePage hidden-xs"]);
                        ?>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php header_left_nav(); ?>
                    <?php header_right_nav(); ?>
                </div>
            </div>
        </nav>
        <!-- /nav -->
        <?php
        $homePageId = get_option('page_on_front');
        $image = get_field("parallax", $homePageId);
        $video = get_field("video_parallax", $homePageId);
        ?>
        <?php if ($video AND !wp_is_mobile()) {
            echo '
            <div class="parallax">
            <video class="videoMainParallax" autoplay loop="loop" src="' . $video["url"] . ' "></video>
            </div>';
        } else { ?>
            <div class="parallax" style="background-image: url('<?= $image["url"] ?>');"></div>
        <?php } ?>
    </header>
    <!-- /header -->
    <div class="hrMain">
        <hr class="hrMain dividerHeader"/>
    </div>
    <?php
    $homePageId = get_option('page_on_front');
    $image = get_field("main_paralaxx", $homePageId);
    ?>
    <div class="mainContent row mainParallax" style="background-image: url('<?= $image["url"] ?>');">
