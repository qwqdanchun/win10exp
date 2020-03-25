<?php 

/**
 Template Name: links
 */

get_header();
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
                <?php while(have_posts()) : the_post(); ?>
	<?php if(win10_option('patternimg') || !get_post_thumbnail_id(get_the_ID())) { ?>
	<?php } ?>
		<article <?php post_class("post-item"); ?>>
			<?php the_content(); ?>
			<div class="links">
				<?php echo get_link_items(); ?>
			</div>
		</article>
        <div class="have-toc"></div><div class="toc-container"><div class="toc"></div></div>
	<?php endwhile; ?>
            </div>
                        <div class="post-content-comments">
                <?php
                comments_template();
                ?>
            </div>

        </div>

    </div>
</div>

</body>
<?php get_footer() ?>
<?php wp_footer(); ?>
</html>