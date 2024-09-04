<?php
/**
 * tenaadam functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tenaadam
 */

add_filter( 'comments_open', '__return_false');//コメントを停止

//曜日返す。
function getWeek($dateObj){
    $week = array("日", "月", "火", "水", "木", "金", "土");
    if($dateObj) {
        $windex = (int) $dateObj->format('w');
        $nweek = "（".$week[$windex]."）";
    }
    return $nweek;
}

//アイキャッチ出力
function mytheme_setup() {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(300, 225, true);
}
add_action('after_setup_theme', 'mytheme_setup');

//子ページか親ページか判断
function is_parent_slug() {
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}

//タイトルタグ
function nendebcom_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'nendebcom_theme_slug_setup' );

//hentryクラスの出力をしないようにする
function remove_hentry( $classes ) {
    $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'remove_hentry');

//WPでjquery使用する
function load_script(){
    wp_enqueue_script('jquery');
}
add_action('init', 'load_script');

//権限レベルに対して、表示させるか非表示か
// function example_remove_dashboard_widgets() {
//     global $current_user;
//     wp_get_currentuserinfo();
//     // 管理者（level_10）以外のユーザーの場合
//     if (!current_user_can('level_10')) {
//         global $wp_meta_boxes;
//         unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);//最近のコメント
//         unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);//被リンク
//         unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);//プラグイン
//         unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);//WordPressブログ
//         unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);//WordPressフォーラム
//         unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);//アクティビティ
//         unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);//WordPressフォーラム
//         unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);//クイックドラフト
//     }
// }
// add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

//管理者権限のみバージョン更新案内を表示する
function update_nag_admin_only() {
    if ( ! current_user_can( 'administrator' ) ) {
            remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_init', 'update_nag_admin_only' );

//使用しないメニューを非表示にする(管理者以外)
function remove_admin_menus() {
    //購読者、投稿者、寄稿者ユーザーの場合
    if (current_user_can('subscriber') || current_user_can('contributor') || current_user_can('author')) {
            global $menu;
            unset($menu[2]);//ダッシュボード
            unset($menu[20]);//固定ページ
            unset($menu[60]);//外観
            unset($menu[65]);//プラグイン
            unset($menu[70]);//ユーザー
            unset($menu[75]);//ツール
            unset($menu[80]);//設定
            unset($menu[25]);//コメント
    //編集者ユーザーの場合
    }elseif (current_user_can('editor')) {
            global $menu;
            unset($menu[2]);//ダッシュボード
            unset($menu[20]);//固定ページ
            unset($menu[60]);//外観
            unset($menu[65]);//プラグイン
            unset($menu[70]);//ユーザー
            unset($menu[75]);//ツール
            unset($menu[80]);//設定
            unset($menu[25]);//コメント
     }
    //管理者ユーザーの場合　何もしない
}
add_action('admin_menu', 'remove_admin_menus');

//mwを管理者以外表示させない
function remove_menus() {
    if (!current_user_can('level_10')) {
        remove_menu_page('edit.php?post_type=mw-wp-form');
    }
}
add_action('admin_menu', 'remove_menus');

//WP-PageNavieが読み込むCSSを削除
function my_delete_plugin_styles() {
    wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_enqueue_scripts', 'my_delete_plugin_styles' );

//抜粋
function twpp_change_excerpt_length( $length ) {
  return 50;
}
add_filter( 'excerpt_length', 'twpp_change_excerpt_length', 999 );

function new_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//自動整形無効（ページのみ）
function wpautop_filter($content) {
    global $post;
    $remove_filter = false;

    $arr_types = array('page');//自動整形を無効にする投稿タイプを記述
    $post_type = get_post_type( $post->ID );
    if (in_array($post_type, $arr_types)) $remove_filter = true;

    if ( $remove_filter ) {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
    }
    return $content;
}
add_filter('the_content', 'wpautop_filter', 9);

//ショートコード home
add_shortcode('home', 'shortcode_hurl');
function shortcode_hurl() {
    return home_url( );
}

//ショートコード templateurl
add_shortcode('dir', 'shortcode_dir');
function shortcode_dir() {
    return get_bloginfo('template_url');
}

//ショートコードを使ったphpファイルの呼び出し方法
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');

//WordPressの不要なタグを消す
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

//親ページ判別
function is_child( $slug = "" ) {
  if(is_singular())://投稿ページのとき（固定ページ含）
    global $post;
    if ( $post->post_parent ) {//現在のページに親がいる場合
      $post_data = get_post($post->post_parent);//親ページの取得
      if($slug != "") {//$slugが空じゃないとき
        if(is_array($slug)) {//$slugが配列のとき
          for($i = 0 ; $i <= count($slug); $i++) {
            if($slug[$i] == $post_data->post_name || $slug[$i] == $post_data->ID || $slug[$i] == $post_data->post_title) {//$slugの中のどれかが親ページのスラッグ、ID、投稿タイトルと同じのとき
              return true;
            }
          }
        } elseif($slug == $post_data->post_name || $slug == $post_data->ID || $slug == $post_data->post_title) {//$slugが配列ではなく、$slugが親ページのスラッグ、ID、投稿タイトルと同じのとき
          return true;
        } else {
          return false;
        }
      } else {//親ページは存在するけど$slugが空のとき
        return true;
      }
    }else {//親ページがいない
      return false;
    }
  endif;
}
//post ⇒　ニュースに変更
function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'ニュース';
    $submenu['edit.php'][5][0] = 'ニュース一覧';
    $submenu['edit.php'][10][0] = '新しいニュース';
    $submenu['edit.php'][16][0] = 'タグ';
    //echo ";
}
function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'ニュース';
    $labels->singular_name = 'ニュース';
    $labels->add_new = _x('新規追加', 'ニュース');
    $labels->add_new_item = 'ニュースの新規追加';
    $labels->edit_item = 'ニュースの編集';
    $labels->new_item = '新規ニュース';
    $labels->view_item = 'ニュースを表示';
    $labels->search_items = 'ニュースを検索';
    $labels->not_found = '記事が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');

//カスタム投稿
function new_post_type(){
    //実績
    register_post_type(
        'portfolio',
        array(
            'label' => '非公開実績',
            'public' => true,
            'hierarchical' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'custom-fields'
            ),
        'menu_position' => 5,
        'show_in_rest' => true
        )
    );
    //タクソノミーを作成
    register_taxonomy(
        'portfolio_cat',
        'portfolio',
        array(
            'label' => 'カテゴリー',
                'labels' => array(
                'edit_item' => 'カテゴリーを編集',
                'add_new_item' => 'カテゴリーを追加',
                'search_items' => 'カテゴリーを検索',
                ),
            'public' => true,
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'portfolio_cat')
        )
    );
}
add_action('init', 'new_post_type');

//パスワードページ
function my_password_form() {
  return
    '<div class="password-wrapper">
      <div class="password-wrapper-box">
        <p class="post_password_txt">このコンテンツはパスワードで保護されています。<br>閲覧するには以下にパスワードを入力してください。<p>
        <form class="post_password" action="http://portfolio.local/wp-login.php?action=postpass" method="post">
        <p class="input_password"><label>パスワード：<input name="post_password" type="password" size="" /></label></p>
        <p class="submit_password"><input type="submit" name="Submit" value="' . esc_attr__("パスワード送信") . '" /></p>
        <p class="password-caption">パスワードは<a href="/#contact">こちら</a>からからお問い合わせください。</p>
        </form>
      </div>
    </div>
    ';
}
add_filter('the_password_form', 'my_password_form');

//ベーシック認証
function basic_auth($auth_list,$realm="Restricted Area",$failed_text="認証に失敗しました。ブラウザバックでもう一度入力してください。"){
    if (isset($_SERVER['PHP_AUTH_USER']) and isset($auth_list[$_SERVER['PHP_AUTH_USER']])){
        if ($auth_list[$_SERVER['PHP_AUTH_USER']] == $_SERVER['PHP_AUTH_PW']){
            return $_SERVER['PHP_AUTH_USER'];
        }
    }
    header('WWW-Authenticate: Basic realm="'.$realm.'"');
    header('HTTP/1.0 401 Unauthorized');
    header('Content-type: text/html; charset='.mb_internal_encoding());
    die($failed_text);
}
