<?php
get_header();
the_post();
?>
    <div class="layui-row content">
        <div class="layui-col-md2 sidebar <?php get_self_adaption_css() ?>">
            <?php get_sidebar(); ?>
        </div>
        <div class="layui-col-md10 post-content">
            <div class="post-content-content">
                <?php the_content(); ?>
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