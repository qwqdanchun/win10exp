<?php
/**
 * Template Name: Inspiration
 */
$post_list_class =
  $sidebar_pos == 'none' ? 'col-10 col-md-12' : 'col-8 col-md-12';
$sidebar_class = $sidebar_pos == 'none' ? 'd-none' : 'col-4 col-md-12';
$main_class = $sidebar_pos == 'left' ? 'flex-rev' : '';

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
query_posts([
  "post_type" => "inspiration",
  "post_status" => "publish",
  "posts_per_page" => 30,
  "paged" => $paged
]);
if (have_posts()) {
  $post_list = [];
  while (have_posts()) {
    the_post();
    $post_author_id = get_post_field('post_author', $post->ID);
    global $post_list;
    $post_item = [
      'post_id' => $post->ID,
      'post_title' => get_the_title($post->ID),
      'post_date' => get_the_date(get_option('date_format'), $post->ID),
      'post_year' => get_the_date('Y', $post->ID),
      'post_month' => get_the_date('m', $post->ID),
      'post_comments' => get_comments_number($post->ID),
      'post_link' => get_the_permalink($post->ID),
      'post_image' => wp_get_attachment_url(get_post_thumbnail_id($post->ID)),
      'post_image_alt' => get_post_meta(
        get_post_thumbnail_id($post->ID),
        '_wp_attachment_image_alt',
        true
      ),
      'post_author' => get_the_author_meta('display_name', $post_author_id),
      'post_author_avatar' => get_avatar(
        get_the_author_email(),
        64,
        get_option("avatar_default"),
        "",
        [
          "class" => "inspiration-avatar"
        ]
      ),
      'post_category' => wp_get_post_categories($post->ID),
      'post_tag' => wp_get_post_tags($post->ID),
      'post_excerpt' => get_the_excerpt($post->ID),
      'post_content' => get_the_content()
    ];
    if (
      $post_item['post_image'] == false &&
      theme_get_other_thumbnail($post)
    ) {
      $post_item['post_image'] = theme_get_other_thumbnail($post);
    }
    $post_list[] = $post_item;
  }
}
$count = wp_count_posts("inspiration")->publish;

wp_reset_query();
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
        	
        <div id="main-content">

    <main class="ori-container columns <?php echo $main_class; ?> grid-md">
        <section class="inspiration-list column <?php echo $post_list_class; ?>">
          <article <?php post_class("p-post-content"); ?> id="post-<?php the_ID(); ?>">
              <?php the_content(); ?>
          </article>
          <ul class="inspiration">
            <?php foreach ((array)$post_list as $item): ?>
              <li class="inspiration-card">
                <?php echo $item['post_author_avatar']; ?>
                <div class="inspiration-right">
                  <div class="inspiration-title"><?php echo $item[
                    'post_title'
                  ]; ?></div>
                  <div class="inspiration-content">
                    <?php echo $item['post_content']; ?>
                  </div>
                  <div class="inspiration-footer">
                    <span class="inspiration-footer-left">
                      <i class="fa fa-paper-plane-o"></i>
                      <span><?php echo $item['post_author']; ?></span>
                    </span>
                    <span class="inspiration-footer-right">
                      <i class="fa fa-calendar"></i>
                      <time><?php echo $item['post_date']; ?></time>
                    </span>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>

      </section>
      <aside class="column ori-sidebar <?php echo $sidebar_class; ?>">
          <?php get_sidebar(); ?>
      </aside>
    </main>
</div>
</div>
    </div>
</div>

</body>
<?php get_footer() ?>
<?php wp_footer(); ?>
</html>