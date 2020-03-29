<?php 

/**
 Template Name: links
 */

get_header();
?>
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