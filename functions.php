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
        $theme_option = array('seo' => 0, 'single_icon' => '', 'index_title' => '', 'site_description' => '', 'site_key' => '', 'autoseo' => 0,'version'=>THEME_VERSION, 'autogray' => 0, );
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
//灵感
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

//集成wp-postviews
add_action( 'wp_head', 'process_postviews' );
function process_postviews() {
    global $user_ID, $post;
    if ( is_int( $post ) ) {
        $post = get_post( $post );
    }
    if ( ! wp_is_post_revision( $post ) && ! is_preview() ) {
        if ( is_single() || is_page() ) {
            $id = (int) $post->ID;
            if ( !$post_views = get_post_meta( $post->ID, 'views', true ) ) {
                $post_views = 0;
            }
            $should_count = false;
            if( empty( $_COOKIE[ USER_COOKIE ] ) && (int) $user_ID === 0 ) {
                $should_count = true;
            }
            $should_count = apply_filters( 'postviews_should_count', $should_count, $id );
            if( $should_count ) {
                update_post_meta( $id, 'views', $post_views + 1 );
                do_action( 'postviews_increment_views', $post_views + 1 );
            }
        }
    }
}
function the_views($display = true, $prefix = '', $postfix = '', $always = true) {
    $post_views = (int) get_post_meta( get_the_ID(), 'views', true );
    if ($always) {
        $output = $prefix.str_replace( array( '%VIEW_COUNT%', '%VIEW_COUNT_ROUNDED%' ), array( number_format_i18n( $post_views ), postviews_round_number( $post_views) ),  __( '%VIEW_COUNT% 次浏览', 'wp-postviews' ) ).$postfix;
        if($display) {
            echo apply_filters('the_views', $output);
        } else {
            return apply_filters('the_views', $output);
        }
    }
    elseif (!$display) {
        return '';
    }
}
if(!function_exists('get_totalviews')) {
    function get_totalviews($display = true) {
        global $wpdb;
        $total_views = (int) $wpdb->get_var("SELECT SUM(meta_value+0) FROM $wpdb->postmeta WHERE meta_key = 'views'" );
        if($display) {
            echo number_format_i18n($total_views);
        } else {
            return $total_views;
        }
    }
}
if(!function_exists('snippet_text')) {
    function snippet_text($text, $length = 0) {
        if (defined('MB_OVERLOAD_STRING')) {
          $text = @html_entity_decode($text, ENT_QUOTES, get_option('blog_charset'));
             if (mb_strlen($text) > $length) {
                return htmlentities(mb_substr($text,0,$length), ENT_COMPAT, get_option('blog_charset')).'...';
             } else {
                return htmlentities($text, ENT_COMPAT, get_option('blog_charset'));
             }
        } else {
            $text = @html_entity_decode($text, ENT_QUOTES, get_option('blog_charset'));
             if (strlen($text) > $length) {
                return htmlentities(substr($text,0,$length), ENT_COMPAT, get_option('blog_charset')).'...';
             } else {
                return htmlentities($text, ENT_COMPAT, get_option('blog_charset'));
             }
        }
    }
}
function views_fields($content) {
    global $wpdb;
    $content .= ", ($wpdb->postmeta.meta_value+0) AS views";
    return $content;
}
function views_join($content) {
    global $wpdb;
    $content .= " LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID";
    return $content;
}
function views_where($content) {
    global $wpdb;
    $content .= " AND $wpdb->postmeta.meta_key = 'views'";
    return $content;
}
function views_orderby($content) {
    $orderby = trim(addslashes(get_query_var('v_orderby')));
    if(empty($orderby) || ($orderby != 'asc' && $orderby != 'desc')) {
        $orderby = 'desc';
    }
    $content = " views $orderby";
    return $content;
}
add_action('publish_post', 'add_views_fields');
add_action('publish_page', 'add_views_fields');
function add_views_fields($post_ID) {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        add_post_meta($post_ID, 'views', 0, true);
    }
}
add_filter('query_vars', 'views_variables');
function views_variables($public_query_vars) {
    $public_query_vars[] = 'v_sortby';
    $public_query_vars[] = 'v_orderby';
    return $public_query_vars;
}
add_action('pre_get_posts', 'views_sorting');
function views_sorting($local_wp_query) {
    if($local_wp_query->get('v_sortby') == 'views') {
        add_filter('posts_fields', 'views_fields');
        add_filter('posts_join', 'views_join');
        add_filter('posts_where', 'views_where');
        add_filter('posts_orderby', 'views_orderby');
    } else {
        remove_filter('posts_fields', 'views_fields');
        remove_filter('posts_join', 'views_join');
        remove_filter('posts_where', 'views_where');
        remove_filter('posts_orderby', 'views_orderby');
    }
}
add_action('manage_posts_custom_column', 'add_postviews_column_content');
add_filter('manage_posts_columns', 'add_postviews_column');
add_action('manage_pages_custom_column', 'add_postviews_column_content');
add_filter('manage_pages_columns', 'add_postviews_column');
function add_postviews_column($defaults) {
    $defaults['views'] = __( 'Views', 'wp-postviews' );
    return $defaults;
}
function add_postviews_column_content($column_name) {
    if ($column_name === 'views' ) {
        if ( function_exists('the_views' ) ) {
            the_views( true, '', '', true );
        }
    }
}
add_filter( 'manage_edit-post_sortable_columns', 'sort_postviews_column');
add_filter( 'manage_edit-page_sortable_columns', 'sort_postviews_column' );
function sort_postviews_column( $defaults ) {
    $defaults['views'] = 'views';
    return $defaults;
}
add_action('pre_get_posts', 'sort_postviews');
function sort_postviews($query) {
    if ( ! is_admin() ) {
        return;
    }
    $orderby = $query->get('orderby');
    if ( 'views' === $orderby ) {
        $query->set( 'meta_key', 'views' );
        $query->set( 'orderby', 'meta_value_num' );
    }
}
function postviews_round_number( $number, $min_value = 1000, $decimal = 1 ) {
    if( $number < $min_value ) {
        return number_format_i18n( $number );
    }
    $alphabets = array( 1000000000 => 'B', 1000000 => 'M', 1000 => 'K' );
    foreach( $alphabets as $key => $value )
        if( $number >= $key ) {
            return round( $number / $key, $decimal ) . '' . $value;
        }
}

function Baidu_Submit($post_ID) {
    global $theme_option;
    $WEB_TOKEN = $theme_option['baidu_token'];
    $WEB_DOMAIN = get_option('home');
    if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
    $url = get_permalink($post_ID);
    $api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.$theme_option['baidu_token'];
    $request = new WP_Http;
    $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
    $result = json_decode($result['body'],true);
    if (array_key_exists('success',$result)) {
        add_post_meta($post_ID, 'Baidusubmit', 1, true);
    }else{add_post_meta($post_ID, 'Baidusubmit', $api, true);}
}
add_action('publish_post', 'Baidu_Submit', 0);

?>