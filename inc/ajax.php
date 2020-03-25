<?php
function fun_save_set()
{
    global $theme_option;
    $theme_option['seo'] = $_POST['seo'];
    $theme_option['autoseo'] = $_POST['autoseo'];
    $theme_option['site_description'] = $_POST['site_description'];
    $theme_option['site_key'] = $_POST['site_key'];
    $theme_option['index_title'] = $_POST['index_title'];
    $theme_option['site_name'] = $_POST['site_name'];
    $theme_option['single_icon'] = $_POST['single_icon'];
    $theme_option['title_icon'] = $_POST['title_icon'];
    $theme_option['folder_3D_Objects'] = $_POST['folder_3D_Objects'];
    $theme_option['folder_Videos'] = $_POST['folder_Videos'];
    $theme_option['folder_Pictures'] = $_POST['folder_Pictures'];
    $theme_option['folder_Documents'] = $_POST['folder_Documents'];
    $theme_option['folder_Download'] = $_POST['folder_Download'];
    $theme_option['folder_Music'] = $_POST['folder_Music'];
    $theme_option['folder_Desktop'] = $_POST['folder_Desktop'];
    $theme_option['folder_Articals'] = $_POST['folder_Articals'];
    update_option(THEME_ID_SET, json_encode($theme_option));
    echo 1;
    wp_die();
}
function fun_check_version(){
    $http = new WP_Http;
    $result = $http->request( 'http://cdn.qwqdanchun.cn/win10_theme.json' );

    $result= json_decode($result['body'], true);
    if (is_array($result)){
        echo $result['version'];
    }else{
        echo '0';
    }
    wp_die();
}
add_action('wp_ajax_save_set', 'fun_save_set');
add_action('wp_ajax_check_version', 'fun_check_version');