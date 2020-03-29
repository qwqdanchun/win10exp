<?php
$cat = get_the_category();
$catid = $cat[0]->cat_ID;
?>
<!doctype html>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php get_blog_title_obj() ?></title>
    <?php obj_seo_set(); ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/static/layui/css/layui.css' ?>"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/static/font-awesome/css/font-awesome.css' ?>"
          type="text/css"/>
    <script type="text/javascript">function kaishi(){var docElm=document.documentElement;if(docElm.requestFullscreen){docElm.requestFullscreen()}else if(docElm.mozRequestFullScreen){docElm.mozRequestFullScreen()}else if(docElm.webkitRequestFullScreen){docElm.webkitRequestFullScreen()}else if(elem.msRequestFullscreen){elem.msRequestFullscreen()}}function guanbi(){if(document.exitFullscreen){document.exitFullscreen()}else if(document.mozCancelFullScreen){document.mozCancelFullScreen()}else if(document.webkitCancelFullScreen){document.webkitCancelFullScreen()}else if(document.msExitFullscreen){document.msExitFullscreen()}}document.addEventListener("fullscreenchange",function(){fullscreenState.innerHTML=(document.fullscreen)?"":"not "},false);document.addEventListener("mozfullscreenchange",function(){fullscreenState.innerHTML=(document.mozFullScreen)?"":"not "},false);document.addEventListener("webkitfullscreenchange",function(){fullscreenState.innerHTML=(document.webkitIsFullScreen)?"":"not "},false);document.addEventListener("msfullscreenchange",function(){fullscreenState.innerHTML=(document.msFullscreenElement)?"":"not "},false);</script>
    <?php wp_head(); ?>
</head>
<body>
    <div class="layui-container" id="main">
    <div class="blog-title"><?php obj_title_icon();
        bloginfo('name'); ?>
        <div class="close"><a href="javascript:window.opener=null;window.open('','_self');window.close();"><i
                        class="layui-icon layui-icon-close"></i></a>
        </div>
        <div class="maximize" onclick="kaishi()"><a><i class="fa fa-window-maximize"></i></a>
        </div>
        <div class="minimize" onclick="guanbi()"><a><i class="fa fa-window-minimize"></i></a>
        </div>
    </div>
    <div class="toolbar">
        <div class="layui-row">
            <div class="obj_menu_header">
                <?php get_nav_menu_obj(); ?>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-md1 <?php get_self_adaption_css()?>">
                <div class="toobar-col"><i class="fa fa-arrow-left" aria-hidden="true"
                                           onclick="javascript :history.back(-1)"></i>
                    <i class="fa fa-arrow-right" aria-hidden="true" onclick="javascript :history.forward()"></i><i
                            class="fa fa-arrow-up" aria-hidden="true"></i></div>
            </div>
            <div class="layui-col-md9 layui-col-xs-12 layui-col-sm-12">
                <div class="toolbar-url"><img class="toobar-icon" src="<?php echo getImgDir('folder.ico') ?>"alt=""><span><a href="//<?php echo $_SERVER['SERVER_NAME']; ?>">本网站</a></span>>
                                                <?php if (is_front_page()) {?>
                                                <span>首页</span>
                                                <?php }elseif(is_category()){?>
                                                <span><a href="<?php echo get_category_link($catid)?>"><?php echo get_cat_name($catid)?></a></span>
                                                <?php }elseif(is_page()){?>
                                                <span><?php the_title() ?></span>
                                                <?php }elseif(is_single()){?>
                                                <span><a href="<?php echo get_category_link($catid) ?>"><?php echo get_cat_name($catid) ?></a></span>><span><?php the_title(); ?></span>
                                                <?php }?>
                </div>
            </div>
            <div class="layui-col-md2 <?php get_self_adaption_css()?>">
                <?php get_search_obj(); ?>
            </div>
        </div>
    </div>
