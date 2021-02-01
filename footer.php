<?php global $theme_option; ?>
<footer>
    <?php obj_tongji_set(); ?>
    <p>Copyright © <?php echo $theme_option['copyright_year']; ?> <a href="//<?php echo $_SERVER['SERVER_NAME']; ?>"><?php echo bloginfo('name')?> </a>.<?php echo $theme_option['footer']; ?></p>
    <p><a href="http://beian.miit.gov.cn/" class="links" target="_blank"><?php echo $theme_option['beian']; ?></a></p>
    <p>页面加载<?php echo get_num_queries(); ?>次查询，加载时间<?php timer_stop(1); ?>秒</p>
    <p><a class="egg" style="color: white!important" href="javascript:var%20s%20=%20document.createElement('script');s.type='text/javascript';document.body.appendChild(s);s.src='<?php echo get_stylesheet_directory_uri() . '/extend/asteroids.min.js' ?>';void(0);" title="小飞机">小飞机</a>
    <a class="egg" style="color: white!important" href="javascript:var%20s%20=%20document.createElement('script');s.type='text/javascript';document.body.appendChild(s);s.src='<?php echo get_stylesheet_directory_uri() . '/extend/bug.js' ?>';void(0);" title="bug">bug</a>
    <a class="egg" style="color: white!important" href="javascript:var%20s%20=%20document.createElement('script');s.type='text/javascript';document.body.appendChild(s);s.src='<?php echo get_stylesheet_directory_uri() . '/extend/nyancat.js' ?>';void(0);" title="nyancat">nyancat</a> </p>
</footer>
