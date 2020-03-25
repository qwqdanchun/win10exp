<?php
/**
 Template Name: home
 */
get_header();
the_post();
?>
<div class="layui-container" id="main">
    <div class="blog-title"><img class="toobar-icon" src="<?php echo getImgDir('folder.ico') ?>"
                                 alt=""><?php /*bloginfo('name');*/
        echo bloginfo('name') ?>
        <div class="post-title"> - <?php the_title(); ?></div>
        <div class="close"><i class="layui-icon layui-icon-close"></i>
        </div>
    </div>
    <div class="toolbar">
        <div class="layui-row">
            <div class="obj_menu_header">
                <?php get_nav_menu_obj(); ?>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-md1  <?php get_self_adaption_css()?>">
                <div class="toobar-col"><i class="fa fa-arrow-left" aria-hidden="true"
                                           onclick="javascript :history.back(-1)"></i>
                    <i class="fa fa-arrow-right" aria-hidden="true" onclick="javascript :history.forward()"></i>
                    <i class="fa fa-arrow-up" aria-hidden="true"></i></div>
            </div>
            <div class="layui-col-md9  layui-col-xs-12 layui-col-sm-12">
                <div class="toolbar-url"><img class="toobar-icon" src="<?php echo getImgDir('folder.ico') ?>"
                                              alt=""><span>
                        <a href="//<?php echo $_SERVER['SERVER_NAME']; ?>">本网站</a></span>
                    ><span><?php the_title() ?></span>
                </div>
            </div>
            <div class="layui-col-md2 <?php get_self_adaption_css()?>">
                <?php get_search_obj(); ?>
            </div>
        </div>
    </div>
    <div class="layui-row content">
        <div class="layui-col-md2 sidebar <?php get_self_adaption_css() ?>">
            <?php get_sidebar(); ?>
        </div>
        <div class="layui-col-md10 post-content">
            <div class="post-content-content">
               
   <div class="homes"> 
    <h3 class="home-title"><span class="home-fix">常用文件夹(7)</span></h3> 
    <ul class="home-items fontSmooth"> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_3D_Objects'] ?>" title="3D 对象" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_3D_Objects.png" /><span class="sitename">3D 对象</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Videos'] ?>" title="视频" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Videos.png" /><span class="sitename">视频</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Pictures'] ?>" title="图片" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Pictures.png" /><span class="sitename">图片</span></a></li>

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Documents'] ?>" title="文档" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Documents.png" /><span class="sitename">文档</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Download'] ?>" title="下载" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Download.png" /><span class="sitename">下载</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Music'] ?>" title="音乐" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Music.png" /><span class="sitename">音乐</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Desktop'] ?>" title="桌面" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_Desktop.png" /><span class="sitename">桌面</span></a></li> 


    </ul> 
    <h3 class="home-title"><span class="home-fix">设备和驱动器(1)</span></h3> 
    <ul class="home-items fontSmooth"> 

    <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Articals'] ?>" title="最近文章" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="http://cdn.qwqdanchun.cn/image/blog/folder_OS.png" /><span class="sitename">系统(C:)</span></a><div class="progress-bar"><div class="progress"></div></div><a class="disk_size">66.6 GB 可用, 共 118 GB</a></li> 

    </ul> 



    
   </div> 
            </div>

        </div>

    </div>
</div>

</body>
<?php get_footer() ?>
<?php wp_footer(); ?>
</html>