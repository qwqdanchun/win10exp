<?php
//获取设置
define('THEME_ID', 'win10exp'); // 主题ID，请勿修改,否则可能导致配置错误
define('THEME_VERSION', '1.0.0'); // 主题内部版本号，请勿修改，否则可能导致配置错误
define('THEME_ID_SET', 'win10exp_set');

include ("wp-postviews/wp-postviews.php"); // wp-postviews

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
                <em>看法等待审核...</em><br/>
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
//nmsl评论抽象话
function nmsl_conents_replace($incoming_comment) {
    $pattern = '[nmsl]';
    $words = '笑->😁||笑哭->😂||色->😍||亲->💋||哭->😭||晕->😵||愤怒->👿||生气->👿||怒->👿||死->💀||鬼->👻||外星人->👽||屎->💩||男孩->👦||男生->👦||男人->👨||男->👨||女孩->👧||女生->👧||女人->👩||女->👩||老人->👴||老子->👴||老->👴||警察->👮||工人->👷||农民工->👷||秃子->👨‍||秃子->👨‍||圣诞->🎅||圣诞老人->🎅||走->🚶||跑->🏃||跳舞->💃||舞->💃||家人->👪||强壮->💪||强->💪||壮->💪||肌肉->💪||腿->🦵||脚->🦶||足->🦶||指->👈||左->👈||右->👉||上->☝️||下->👇||耶->✌️||剪刀手->✌️||比心->🤞||笔芯->🤞||手掌->🖐️||手->🖐️||ok->👌||好的->👌||好->👌||点赞->👍||赞->👍||棒->👍||差->👎||坏->👎||拳->👊||不->👋||挥手->👋||鼓掌->👏||啪->👏||举手->🙌||合十->🙏||祈祷->🙏||握手->🤝||耳朵->👂||耳->👂||鼻->👃||鼻子->👃||眼睛->👀||脚印->👣||足迹->👣||大脑->🧠||智->🧠||骨头->🦴||骨->🦴||牙齿->🦷||齿->🦷||舔->👅||嘴->👄||眼镜->👓||太阳镜->🕶️||T恤->👕||袜子->🧦||袜->🧦||裙子->👗||裙->👗||比基尼->👙||女装->👚||钱包->👛||手提袋->👜||包->👜||鞋->👞||鞋子->👞||高跟鞋->👠||帽子->🎩||口红->💄||行李->🧳||雨伞->☂️||伞->☂️||蒙眼->🙈||没眼看->🙈||不听->🙉||不说话->🙊||禁言->🙊||爆炸->💥||炸->💥||滴->💦||奔->💨||奔跑->🏃💨||猴->🐵||猴子->🐵||狗->🐶||猫->🐱||浣熊->🦝||狮子->🦁||狮->🦁||马->🐴||妈->🐴||老虎->🐯||虎->🐯||斑马->🦓||牛->🐮||猪->🐷||猪鼻->🐽||骆驼->🐫||驼->🐫||长颈鹿->🦒||大象->🐘||象->🐘||老鼠->🐭||鼠->🐭||兔子->🐰||兔->🐰||熊->🐻||考拉->🐨||熊猫->🐼||袋鼠->🦘||鸡->🐔||公鸡->🐓||鸟->🐦||鸽子->🕊️||鸽->🕊️||企鹅->🐧||腾讯->🐧||老鹰->🦅||鹰->🦅||鸭子->🦆||鸭->🦆||天鹅->🦢||鹦鹉->🦜||蛤蟆->🐸||蛤->🐸||龟->🐢||乖->🐢||蛇->🐍||射->🐍||农民->🐲鸣||龙->🐲||鲸鱼->🐋||鲸->🐋||海豚->🐬||豚->🐬||带鱼->🐠||鲨鱼->🦈||鲨->🦈||章鱼->🐙||章->🐙||螃蟹->🦀||蟹->🦀||龙虾->🦞||虾->🦐||乌贼->🦑||蜗牛->🐌||蝴蝶->🦋||蝶->🦋||虫->🐛||虫子->🐛||蚂蚁->🐜||蚁->🐜||蜜蜂->🐝||蜂->🐝||瓢虫->🐞||嫖->🐞||瓢->🐞||蜘蛛->🕷️||蛛->🕷️||蛛网->🕸️||花朵->🌸||鲜花->🌸||花->🌸||玫瑰->🌹||向日葵->🌻||树->🌲||仙人掌->🌵||四叶草->🍀||枫叶->🍁||落叶->🍂||地球->🌏||世界->🌏||月亮->🌙||日->☀️||太阳->☀️||星->⭐||明星->🌟||云->☁️||多云->⛅||下雨->🌧️||雨->🌧️||下雪->🌨️||龙卷风->🌪️||雾->🌫️||彩虹->🌈||闪电->⚡||高压电->⚡||电->⚡||雪花->❄️||雪->❄️||雪人->☃️||水->💧||火->🔥||波浪->🌊||波->🌊||圣诞树->🎄||闪->✨||葡萄->🍇||西瓜->🍉||瓜->🍉||柠檬->🍋||酸->🍋||香蕉->🍌||蕉->🍌||菠萝->🍍||凤梨->🍍||苹果->🍎||梨->🍐||梨子->🍐||桃子->🍑||桃->🍑||樱桃->🍒||草莓->🍓||猕猴桃->🥝||西红柿->🍅||茄子->🍆||茄->🍆||土豆->🥔||番薯->🥔||胡萝卜->🥕||萝卜->🥕||辣椒->🌶️||那->🌶️||辣->🌶️||黄瓜->🥒||蘑菇->🍄||花生->🥜||面包->🍞||煎饼->🥞||烙饼->🥞||奶酪->🧀||肉->🍖||鸡腿->🍗||培根->🥓||盐->🧂||爆米花->🍿||汤->🥣||煎->🍳||三明治->🥪||热狗->🌭||火腿->🌭||披萨->🍕||薯条->🍟||汉堡->🍔||汉堡包->🍔||牛奶->🥛||奶瓶->🍼||甜甜圈->🍭||糖->🍬||巧克力棒->🍫||巧克力->🍫||生日蛋糕->🎂||蛋糕->🎂||曲奇->🍪||冰淇淋->🍦||饺子->🥟||月饼->🥮||寿司->🍣||面条->🍜||面->🍜||饭->🍚||米饭->🍚||饭团->🍙||餐具->🍴||惨剧->🍴||勺子->🥄||筷子->🥢||筷->🥢||干杯->🍻||啤酒->🍺||啤->🍺||酒->🍺||批->🍺||逼->🍺||酒杯->🍷||飞机->✈️||船->🚢||红绿灯->🚦||加油->⛽||单车->🚲||自行车->🚲||拖拉机->🚜||车->🚗||汽车->🚗||出租车->🚕||警车->🚓||消防车->🚒||急救车->🚑||公交车->🚌||公共汽车->🚌||地铁->🚇||火车->🚆||高铁->🚄||学校->🏫||旅馆->🏨||宾馆->🏨||银行->🏦||医院->🏥||房子->🏠||家庭->🏠||好死->🏠||不得好死->不得🏠||火山->🌋||山->⛰️||摩托->🏍️||摩托车->🏍️||赛车->🏎️||石像->🗿||烟花->🎆||流星->🌠||飞碟->🛸||火箭->🚀||人造卫星->🛰️||卫星->🛰️||座位->💺||爬->🧗||骑马->🏇||滑雪->⛷️||游泳->🏊||游->🏊||打球->⛹️||举重->🏋️||骑车->🚴||票->🎫||勋章->🎖️||奖杯->🏆||奖牌->🏅||足球->⚽||棒球->⚾||篮球->🏀||排球->🏐||橄榄球->🏈||网球->🎾||保龄球->🎳||乒乓球->🏓||羽毛球->🏸||拳击->🥊||鱼竿->🎣||钓鱼->🎣||游戏->🎮||打游戏->🎮||骰子->🎲||色子->🎲||画板->🎨||画->🎨||艺术->🎨||毛线->🧶||话筒->🎤||耳机->🎧||萨克斯->🎷||吉他->🎸||钢琴->🎹||喇叭->🎺||小提琴->🎻||剪辑->🎬||电影->🎬||射箭->🏹||情书->💌||洞->🕳️||炸弹->💣||洗澡->🛀||睡觉->🛌||睡->🛌||刀->🔪||世界地图->🗺||指南针->🧭||砖->🧱||油->🛢||铃->🛎||响铃->🛎||沙漏->⌛||沙->⌛||表->⌚||闹钟->⏰||钟->⏰||温度计->🌡||灭火器->🧨||气球->🎈||恭喜->🎉||祝贺->🎉||日本人->🎎||鲤鱼旗->🎏||红包->🧧||蝴蝶结->🎀||礼物->🎁||礼->🎁||水晶球->🔮||泰迪熊->🧸||线->🧵||购物袋->🛍||钻石->💎||钻->💎||收音机->📻||收听->📻||手机->📱||电话->☎||电池->🔋||插头->🔌||电脑->💻||键盘->⌨||打印机->🖨||打印->🖨||鼠标->🖱||硬盘->💽||光盘->💿||DVD->📀||算盘->🧮||摄影机->🎥||放映->📽||上映->📽||电视->📺||相机->📷||照相机->📷||录像机->📹||放大镜->🔍||放大->🔍||蜡烛->🕯||灯->💡||亮->💡||手电筒->🔦||笔记本->📔||本->📕||书->📕||纸->📄||报纸->📰||书签->📑||标签->🏷||钱袋->💰||日元->💴||美元->💵||欧元->💶||信用卡->💳||收据->🧾||信封->✉||信->✉||邮件->📧||发送->📤||接收->📥||收到->📥||包->📦||邮箱->📮||铅笔->✏||钢笔->🖊||笔->🖊||画笔->🖌||蜡笔->🖍||备忘录->📝||便签->📝||记->📝||文件夹->📁||日历->📅||增长->📈||增加->📈||增大->📈||增->📈||下降->📉||降低->📉||减少->📉||降->📉||图钉->📌||回形针->📎||尺子->📏||尺->📏||剪刀->✂||剪->✂||垃圾桶->🗑||锁->🔒||钥匙->🔑||锤子->🔨||匕首->🗡||手枪->🔫||盾牌->🛡||修理->🔧||修->🔧||扳手->🔧||齿轮->⚙||天平->⚖||连接->🔗||锁链->⛓||工具箱->🧰||磁力->🧲||磁->🧲||磁铁->🧲||试管->🧪||DNA->🧬||基因->🧬||显微镜->🔬||望远镜->🔭||雷达->📡||针->💉||药->💊||要->💊||门->🚪||们->🚪||床->🛏||厕所->🚽||马桶->🚽||淋浴->🚿||浴缸->🛁||洗洁精->🧴||扫->🧹||扫帚->🧹||扫把->🧹||篮子->🧺||卷纸->🧻||卫生纸->🧻||肥皂->🧼||皂->🧼||海绵->🧽||烟->🚬||香烟->🚬||扎心->💘||心动->💓||心跳->💓||心心相印->💕||心相印->💕||心碎->💔||黑心->🖤||满分->💯||100分->💯||怒->💢||信息->💬||想法->💭||昏睡->💤||困->💤||蒸->♨||停->🛑||旋风->🌀||飓风->🌀||黑桃->♠||红桃->♥||方块->♦||梅花->♣||牌->🃏||扑克->🃏||中->🀄||红中->🀄||静音->🔇||音量->🔈||喇叭->📢||铃铛->🔔||音乐->🎵||音->🎵||ATM->🏧||轮椅->♿||残疾人->♿||男厕->🚹||女厕->🚺||婴儿->🚼||厕所->🚾||警告->⚠||禁止进入->⛔||禁止->🚫||成人->🔞||色情->🔞||辐射->☢||上->⬆||右->➡||下->⬇||左->⬅||上下->↕||左右->↔||循环->🔄||绕圈->🔄||绕->🔄||返回->🔙||原子->⚛||阴阳->☯||清真->☪||伊斯兰->☪||穆斯林->☪||白羊座->♈||金牛座->♉||双子座->♊||巨蟹座->♋||狮子座->♌||处女座->♍||天秤座->♎||天蝎座->♏||射手座->♐||摩羯座->♑||水瓶座->♒||双鱼座->♓||蛇夫座->⛎||重放->🔁||单曲循环->🔂||播放->▶||快进->⏩||返回键->◀||快退->⏪||暂停->⏹||退出->⏏||电影院->🎦||信号->📶||无穷->♾||无限->♾||回收->♻||三叉戟->🔱||圈->⭕||圆->⭕||对->✅||错->❌||加->➕||减->➖||除->➗||?->¿||!->❗||井->️⃣||0->0️⃣||1->1️⃣||2->2️⃣||3->3️⃣||4->4️⃣||5->5️⃣||6->6️⃣||7->7️⃣||8->8️⃣||9->9️⃣||10->🔟||酷->🆒||免费->🆓||新->🆕||月->🈷||有->🈶||得->🉐||割->🈹||无->🈚||禁->🈲||可->🉑||申->🈸||合十->🈴||空->🈳||祝->㊗||秘->㊙||满->🈵||零->0️⃣||一->1️⃣||二->2️⃣||三->3️⃣||四->4️⃣||五->5️⃣||六->6️⃣||七->7️⃣||八->8️⃣||九->9️⃣||十->🔟||我->👴||爷->👴';
    $rules = explode('||', $words);
    if(preg_match($pattern, $incoming_comment)) {
        foreach($rules as $rule) {
            $word = explode('->', trim($rule));
            if(isset($word[1]))
                $incoming_comment = str_replace(trim($word[0]), trim($word[1]), $incoming_comment);
        }
    }
    return $incoming_comment;
}
add_filter( 'comment_text', 'nmsl_conents_replace' );
add_filter( 'comment_text_rss', 'nmsl_conents_replace' );

//公祭日变灰
//date_default_timezone_set( 'Asia/Shanghai' );
add_action( 'wp_head', 'btmd_memorial_day' );
function btmd_memorial_day() {
    $options     = get_option( 'plugin_options' );
    $theme_color = $options['text_string'];
    $custom_date = $options['text_date'];
    if ( strstr( $custom_date, date( 'm-d', time() ) ) ):?>
        <meta name="theme-color" content="757575">
        <style type="text/css">
            <!--
            html {
                filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
                -webkit-filter: grayscale(100%);
            }
            -->
        </style>
        <?php btmd_change_meta() ?>
    <?php elseif ( ! empty( $theme_color ) ): ?>
        <meta name="theme-color" content="<?= $theme_color; ?>">
        <?php btmd_change_meta($theme_color) ?>
    <?php endif; ?>
<?php }
function btmd_change_meta($hex_color='757575') {
    ?>
    <script>
        var meta = document.getElementsByTagName('meta');
        meta["theme-color"].setAttribute('content', '<?="#".$hex_color?>');
    </script>
    <?
}
add_action( 'admin_menu', 'btmd_admin_add_page' );
function btmd_admin_add_page() {
    add_options_page(
        'MemorialDay 设置页面',
        'MemorialDay 设置',
        'manage_options',
        'MemorialDay',
        'btmd_options_page' );
}
function btmd_options_page() {
    ?>
    <div>
         <h2>以此来缅怀那些逝去的生命</h2>  
        请设置你需要的日期（形如04-04）与主题颜色（theme-color）  
        <form action="options.php" method="post">
            <?php settings_fields( 'plugin_options' ); ?>
            <?php do_settings_sections( 'plugin' ); ?>

            <input name="Submit" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>"/>
        </form>
    </div>
    <?php
}
add_action( 'admin_init', 'btmd_admin_init' );
function btmd_admin_init() {
    register_setting(
        'plugin_options',
        'plugin_options',
        'plugin_options_validate' );
    add_settings_section(
        'plugin_main',
        '日期设置，一行一个',
        'btmd_date_text',
        'plugin'
    );
    add_settings_section(
        'plugin_main2',
        'theme-color，十六进制不需要带#',
        'btmd_color_text',
        'plugin'
    );
}
function btmd_date_text() {
    $options = get_option( 'plugin_options' );
    if(empty($options['text_date']))
        $options['text_date']=$options['text_date'].
        '04-04
12-13';
    echo "<textarea name='plugin_options[text_date]'>" . $options['text_date'] . "</textarea>";
}
function btmd_color_text() {
    $options = get_option( 'plugin_options' );
    echo "<input id='color_string' name='plugin_options[text_string]' size='40' 
type='text' value='{$options['text_string']}' />" . "<br>" . "<br>";
}

?>