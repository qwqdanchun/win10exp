<?php
//获取设置
define('THEME_ID', 'win10exp'); // 主题ID，请勿修改,否则可能导致配置错误
define('THEME_VERSION', '1.0.0'); // 主题内部版本号，请勿修改，否则可能导致配置错误
define('THEME_ID_SET', 'win10exp_set');

global $theme_option;

theme_int_set();
include_once 'inc/obj.php';
include_once 'inc/ajax.php';
//add_filter('get_avatar', 'my_custom_avatar', 1, 5);
function my_custom_avatar($avatar, $id_or_email, $size, $default, $alt)
{
    //屏蔽自带头像
    if (!empty($id_or_email->user_id)) {
        $avatar = getImgDir('avatar.png');
    } else {
        $avatar = getImgDir('avatar.png');
    }
    $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

    return $avatar;
}

function getImgDir($name)
{
    //获取图片路径
    return get_stylesheet_directory_uri() . '/static/img/' . $name;
}

$foldercat = getImgDir('foldercat.png');
register_sidebar(array(
    'name' => '首页侧边栏',
    'id' => 'exsidebar_index',
    'description' => '首页侧边栏',
    'class' => 'sidebar_A',
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<div class="sidebar-cat-title"><img width="19" src="' . $foldercat . '">',
    'after_title' => '</div>'));

if (function_exists('add_theme_support')) {
//开启导航菜单主题支持
    add_theme_support('top-nav-menus');
//注册一个导航菜单
    register_nav_menus(array(
        'header_menu' => '顶部导航菜单'
    ));
}
//自定义评论
function my_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    $reply = '';
    if ($depth > 0 && $comment->comment_parent) {
        $reply = get_comment_author($comment->comment_parent);

        if ($reply) {
            $reply = '<span class="comment-from">@<a href="#comment-' . $comment->comment_parent . '">' . $reply . '</a></span>';
        } else {
            $reply = '';
        }

    }
    ?>
<li class="comment" id="li-comment-<?php comment_ID(); ?>">
    <div class="media">
        <div class="media-left">
            <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
                echo get_avatar($comment, 48);
            } ?>
        </div>
        <div class="media-body">
            <?php echo __('<p class="author_name">') . get_comment_author_link() . $reply . '</p>'; ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <em>评论等待审核...</em><br/>
            <?php endif; ?>
            <?php echo comment_text(); ?>
        </div>
    </div>
    <div class="comment-metadata">
        <span class="comment-pub-time">
          <?php echo get_comment_time('Y-m-d H:i'); ?>
        </span>
        <span class="comment-btn-reply">
        <i class="fa fa-reply"></i> <?php comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </span>
    </div>

    <?php
}

add_action('admin_menu', 'theme_options_menu');
function theme_options_menu()
{
    add_menu_page('主题设置', '主题设置', 'administrator', 'theme_options_menu', 'theme_settings_admin', 'dashicons-admin-appearance');
}

function theme_settings_admin()
{
    include_once get_template_directory() . "/inc/page-options.php";
}


function theme_int_set()
{
    global $theme_option;
    $theme_option = get_option(THEME_ID_SET);
    if ($theme_option == false || $theme_option == '{}') {
        $theme_option = array('seo' => 0, 'single_icon' => '', 'index_title' => '', 'site_description' => '', 'site_key' => '', 'autoseo' => 0,'version'=>THEME_VERSION);

        update_option(THEME_ID_SET, json_encode($theme_option));
        $theme_option = json_decode(json_encode($theme_option), true);
    } else {
        $theme_option = json_decode($theme_option, true);
    }

}
// 解决php https签名错误（用于国内服务器使用wordpress反代更新主题及插件）
add_action('http_request_args', 'jkudish_http_request_args', 10, 2);
function jkudish_http_request_args($args, $url) {
$args['sslverify'] = false;
return $args;
}

//开启链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// 优化代码
//去除头部冗余代码
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_generator'); //隐藏wordpress版本
remove_filter('the_content', 'wptexturize'); //取消标点符号转义

function inspiration_init()
{
  $labels = [
    'name' => __('灵感', 'win10exp'),
    'singular_name' => __('灵感', 'win10exp'),
    'add_new' => __('发表灵感', 'win10exp'),
    'add_new_item' => __('发表灵感', 'win10exp'),
    'edit_item' => __('编辑灵感', 'win10exp'),
    'new_item' => __('新灵感', 'win10exp'),
    'view_item' => __('查看灵感', 'win10exp'),
    'search_items' => __('搜索灵感', 'win10exp'),
    'not_found' => __('暂无灵感', 'win10exp'),
    'not_found_in_trash' => __('没有已遗弃的灵感', 'win10exp'),
    'parent_item_colon' => '',
    'menu_name' => __('灵感', 'win10exp')
  ];
  $args = [
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'exclude_from_search' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'show_in_rest' => true,
    'supports' => ['editor', 'author', 'title', 'custom-fields']
  ];
  register_post_type('inspiration', $args);
};

add_action('init', 'inspiration_init');

// 设置文章缩略图
function theme_get_other_thumbnail($post)
{
  // <img.+src=[\'"]([^\'"]+)[\'"].+is-thum=[\'"]([^\'"]+)[\'"].*>
  $image_url = false;
  if (
    preg_match(
      '/\[image.+is-thum="true".+\]([^\'"]+)\[\/image]/i',
      $post->post_content
    ) != 0
  ) {
    preg_match_all(
      '/\[image.+is-thum="true".+\]([^\'"]+)\[\/image]/i',
      $post->post_content,
      $matches
    );
    if (isset($matches[1][0])) {
      $image_url = $matches[1][0];
    }
  }
  if (
    preg_match(
      '/<img.+src=[\'"]([^\'"]+)[\'"].+(data-|)is-thum=[\'"]true[\'"].*>/i',
      $post->post_content
    ) != 0
  ) {
    preg_match_all(
      '/<img.+src=[\'"]([^\'"]+)[\'"].+(data-|)is-thum=[\'"]true[\'"].*>/i',
      $post->post_content,
      $matches
    );
    if (isset($matches[1][0])) {
      $image_url = $matches[1][0];
    }
  }
  return $image_url;
}

//自动生成站点地图
if ( !defined('WIN_SITEMAP_PATH') )
  define('WIN_SITEMAP_PATH', dirname(__FILE__) . '/');
function win_sitemap_refresh() {
    require_once(WIN_SITEMAP_PATH.'extend/xml.php');
    $sitemap_xml = win_get_xml_sitemap();
    file_put_contents(ABSPATH.'sitemap.xml', $sitemap_xml);
    require_once(WIN_SITEMAP_PATH.'extend/html.php');
    $sitemap_html = win_get_html_sitemap();
    file_put_contents(ABSPATH.'sitemap.html', $sitemap_html);
}
if ( defined('ABSPATH') ) {
    add_action('publish_post', 'win_sitemap_refresh');
    add_action('save_post', 'win_sitemap_refresh');
    add_action('edit_post', 'win_sitemap_refresh');
    add_action('delete_post', 'win_sitemap_refresh');
}
?>