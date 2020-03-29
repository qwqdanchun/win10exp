<?php
/**
 Template Name: home
 */
get_header();
the_post();
?>
    <div class="layui-row content">
        <div class="layui-col-md2 sidebar <?php get_self_adaption_css() ?>">
            <?php get_sidebar(); ?>
        </div>
        <div class="layui-col-md10 post-content">
            <div class="post-content-content">
               
   <div class="homes"> 
    <h3 class="home-title"><span class="home-fix">常用文件夹(7)</span></h3> 
    <ul class="home-items fontSmooth"> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_3D_Objects'] ?>" title="3D 对象" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_3D_Objects.png') ?>" /><span class="sitename">3D 对象</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Videos'] ?>" title="视频" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Videos.png') ?>" /><span class="sitename">视频</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Pictures'] ?>" title="图片" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Pictures.png') ?>" /><span class="sitename">图片</span></a></li>

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Documents'] ?>" title="文档" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Documents.png') ?>" /><span class="sitename">文档</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Download'] ?>" title="下载" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Download.png') ?>" /><span class="sitename">下载</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Music'] ?>" title="音乐" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Music.png') ?>" /><span class="sitename">音乐</span></a></li> 

     <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Desktop'] ?>" title="桌面" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_Desktop.png') ?>" /><span class="sitename">桌面</span></a></li> 


    </ul> 
    <h3 class="home-title"><span class="home-fix">设备和驱动器(1)</span></h3> 
    <ul class="home-items fontSmooth"> 

    <li class="home-item"><a class="home-item-inner effect-apollo" href="<?php echo $theme_option['folder_Articals'] ?>" title="最近文章" target="_blank" rel="friend"><img class="lazyload" onerror="imgError(this,1)" src="<?php echo getImgDir('folder_OS.png') ?>" /><span class="sitename">系统(C:)</span></a><div class="progress-bar"><div class="progress"></div></div><a class="disk_size">66.6 GB 可用, 共 118 GB</a></li> 

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