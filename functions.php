<?php
/**
 * K2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package K2
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'K2_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function K2_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on K2, use a find and replace
		 * to change 'K2' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'K2', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'K2' ),
			)
		);


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'K2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function K2_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'K2_content_width', 640 );
}
add_action( 'after_setup_theme', 'K2_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function K2_scripts() {
	wp_enqueue_style( 'K2-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'K2-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'K2_scripts' );


add_filter( 'big_image_size_threshold', '__return_false' );

function change_post_menu_label() {
  global $menu;
  global $submenu;
  $menu[5][0] = 'お知らせ';
  $submenu['edit.php'][5][0] = 'お知らせ一覧';
  $submenu['edit.php'][10][0] = '新しいお知らせ';
  $submenu['edit.php'][16][0] = 'タグ';
}

function change_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'お知らせ';
  $labels->singular_name = 'お知らせ';
  $labels->add_new = _x('追加', 'お知らせ');
  $labels->add_new_item = '新規追加';
  $labels->edit_item = '編集';
  $labels->new_item = '新規お知らせ';
  $labels->view_item = 'お知らせを表示';
  $labels->search_items = 'お知らせを検索';
  $labels->not_found = '記事が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

// create custom post type
function my_custom_post_type(){

	$labels = array(
        'name' => '共通設定',
        'singular_name' => '共通設定',
		'all_items' => '共通設定',
        'add_new' => '登録',
        'add_new_item' => '登録',
        'edit_item' => '編集',
        'new_item' => '新規項目',
        'view_item' => '項目を表示',
        'search_items' => '項目検索',
        'not_found' => '記事が見つかりません',
        'not_found_in_trash' => 'ゴミ箱に記事はありません',
        'parent_item_colon' => ''
    );
    $args = array(
         'labels' => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui' => true,
         'has_archive' => true,
         'query_var' => true,
         'rewrite' => true,
         'capability_type' => 'post',
         'hierarchical' => false,
         'menu_position' => 2,
         'supports' => array('title')
    );
	register_post_type('home',$args);

    $labels = array(
        'name' => '店舗情報',
        'singular_name' => '店舗情報',
		'all_items' => '店舗を確認',
        'add_new' => '店舗を登録',
        'add_new_item' => '店舗を登録',
        'edit_item' => '店舗を編集',
        'new_item' => '新規項目',
        'view_item' => '項目を表示',
        'search_items' => '項目検索',
        'not_found' => '記事が見つかりません',
        'not_found_in_trash' => 'ゴミ箱に記事はありません',
        'parent_item_colon' => ''
    );
    $args = array(
         'labels' => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui' => true,
         'has_archive' => true,
         'query_var' => true,
         'rewrite' => true,
         'capability_type' => 'post',
         'hierarchical' => false,
         'menu_position' => 5,
         'supports' => array('title')
    );
	register_post_type('shops',$args);

	$labels = array(
        'name' => 'メニュー',
        'singular_name' => 'メニュー',
		'all_items' => 'メニューを確認',
        'add_new' => 'メニューを登録',
        'add_new_item' => 'メニューを登録',
        'edit_item' => 'メニューを編集',
        'new_item' => '新規項目',
        'view_item' => '項目を表示',
        'search_items' => '項目検索',
        'not_found' => '記事が見つかりません',
        'not_found_in_trash' => 'ゴミ箱に記事はありません',
        'parent_item_colon' => ''
    );
    $args = array(
         'labels' => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui' => true,
         'has_archive' => true,
         'query_var' => true,
         'rewrite' => true,
         'capability_type' => 'post',
         'hierarchical' => false,
         'menu_position' => 5,
         'supports' => array('title')
    );
    register_post_type('menu',$args);
}
add_action('init', 'my_custom_post_type');
// create custom taxonomy
$args = array(
'label' => 'ジャンル',
'public' => true,
'show_ui' => true,
'hierarchical' => true
);
register_taxonomy('menu_genre','menu',$args);
$args = array(
'label' => 'タグ',
'public' => true,
'show_ui' => true,
'hierarchical' => true
);
register_taxonomy('menu_tag','menu',$args);
$args = array(
'label' => 'デリバリー設定',
'public' => true,
'show_ui' => true,
'hierarchical' => true
);
register_taxonomy('menu_delivery','menu',$args);

function change_posts_per_page($query) {
	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}
	if ( $query->is_post_type_archive('menu') ) {
		$query->set( 'posts_per_page', '15' );
		return;
	}
	if ( $query->is_post_type_archive('shops') ) {
		$query->set( 'posts_per_page', '15' );
		return;
	}
}
add_action( 'pre_get_posts', 'change_posts_per_page' );

//ページネーションのドロップダウンメニュー
function select_pagination( $maxpages, $paged ) {
    if( $maxpages == 1 ) return;
    echo '<div class="pagination">';
    if( $paged != 1 ) {
        echo '<div class="pagination_prev"><a href="'.esc_url( get_pagenum_link( $paged - 1 ) ).'">前のページへ</a></div>';
    }
    echo '<div class="pagination_select">';
    echo '<label class="pagination_label" for="PaginationSelect"><span id="Pagination_current">'.$paged.'</span><span>&nbsp;/&nbsp;'.$maxpages.'</span></label>';
    echo '<select name="paginationselect" id="PaginationSelect" onChange="document.location.href=this.options[this.selectedIndex].value;">';
    for( $i = 1; $i <= $maxpages; ++$i ) {
        $selected = ( $i == $paged ) ? ' selected' : null;
        echo '<option value="'.esc_url( get_pagenum_link( $i ) ).'"'.$selected.'>'.$i.'</option>';
    }
    echo '</select></div>';
    if( $paged != $maxpages ) {
        echo '<div class="pagination_next"><a href="'.esc_url( get_pagenum_link( $paged + 1 ) ).'">次のページへ</a></div>';
    }
    echo '</div>';
}

//'middle-feature'という名前で幅600px、高さ440pxのサムネイルを作成
add_image_size( 'middle-feature', 600, 440, true );


//ACF Generate
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5ea2b69131381',
	'title' => 'サムネイル画像',
	'fields' => array(
		array(
			'key' => 'field_5ea2b6cc381d3',
			'label' => 'サムネイル',
			'name' => 'tax_thumbnail',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'menu_genre',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e9e8706c5bba',
	'title' => 'メニュー登録',
	'fields' => array(
		array(
			'key' => 'field_5ea067f6d11ef',
			'label' => '店舗',
			'name' => 'menu_shop',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'shops',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		),
		array(
			'key' => 'field_5ea15e8de6858',
			'label' => '写真',
			'name' => 'menu_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'large',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5ea28be5e8fc9',
			'label' => '価格',
			'name' => 'menu_charge',
			'type' => 'number',
			'instructions' => '円や￥は不要です。
数字のみを入力してください。',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 1000,
			'prepend' => '￥',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5ea27c01dfdf9',
			'label' => 'ジャンル',
			'name' => 'menu_genre',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'menu_genre',
			'field_type' => 'multi_select',
			'allow_null' => 0,
			'add_term' => 1,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
		),
		array(
			'key' => 'field_5ea38218ee2d5',
			'label' => 'デリバリー設定',
			'name' => 'menu_delivery',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'menu_delivery',
			'field_type' => 'checkbox',
			'add_term' => 0,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
		),
		array(
			'key' => 'field_5ea15f00399d1',
			'label' => 'タグ',
			'name' => 'menu_tag',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'menu_tag',
			'field_type' => 'multi_select',
			'allow_null' => 0,
			'add_term' => 1,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
		),
		array(
			'key' => 'field_5e9e870f3a598',
			'label' => '説明文',
			'name' => 'menu_description',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'menu',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
		4 => 'revisions',
		5 => 'slug',
		6 => 'author',
		7 => 'format',
		8 => 'page_attributes',
		9 => 'featured_image',
		10 => 'categories',
		11 => 'tags',
		12 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e9fd813a3d13',
	'title' => '共通設定',
	'fields' => array(
		array(
			'key' => 'field_5e9fd81a9689e',
			'label' => 'メインビジュアル背景画像',
			'name' => 'mv_background',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'large',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5e9fd82a9689f',
			'label' => 'ロゴ',
			'name' => 'mv_logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5e9fd84f968a0',
			'label' => '表示テキスト',
			'name' => 'mv_description',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'home',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'discussion',
		4 => 'comments',
		5 => 'revisions',
		6 => 'slug',
		7 => 'author',
		8 => 'format',
		9 => 'page_attributes',
		10 => 'featured_image',
		11 => 'categories',
		12 => 'tags',
		13 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e9e85bd031a4',
	'title' => '店舗登録',
	'fields' => array(
		array(
			'key' => 'field_5e9e867f1f9b2',
			'label' => 'イメージ画像',
			'name' => 'shop_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'large',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5ea3752f677ae',
			'label' => '店舗紹介文',
			'name' => 'shop_description',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'br',
		),
		array(
			'key' => 'field_5e9e85cc1f9ae',
			'label' => '住所',
			'name' => 'shop_address',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ea3e2ae33eb6',
			'label' => '営業時間',
			'name' => 'shop_time',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5ea3e5fda1ccc',
					'label' => '開始時間',
					'name' => 'start_time',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '11:00',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5ea3e61ea1ccd',
					'label' => '閉店時間',
					'name' => 'closed_time',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '18:00',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
		array(
			'key' => 'field_5ea3e2d133eb7',
			'label' => '定休日',
			'name' => 'shop_holiday',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5ea555351dc2d',
					'label' => '曜日選択',
					'name' => 'holiday_week',
					'type' => 'checkbox',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'sun' => '日',
						'mon' => '月',
						'tue' => '火',
						'wed' => '水',
						'thu' => '木',
						'fri' => '金',
						'sat' => '土',
					),
					'allow_custom' => 0,
					'default_value' => array(
					),
					'layout' => 'horizontal',
					'toggle' => 0,
					'return_format' => 'value',
					'save_custom' => 0,
				),
				array(
					'key' => 'field_5ea555711dc2e',
					'label' => 'その他',
					'name' => 'holiday_any',
					'type' => 'text',
					'instructions' => '不定休の場合はこちらにご記入ください。',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
		array(
			'key' => 'field_5e9e85df1f9af',
			'label' => '電話番号',
			'name' => 'shop_tel',
			'type' => 'text',
			'instructions' => '電話でのご注文に対応する場合は受付電話番号ご入力ください。',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5e9e85f61f9b0',
			'label' => 'メールアドレス',
			'name' => 'shop_email',
			'type' => 'email',
			'instructions' => 'メールアドレスご入力いただくとWEBからのご注文が可能です。',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_5e9e865b1f9b1',
			'label' => 'URL',
			'name' => 'shop_url',
			'type' => 'url',
			'instructions' => 'ホームページをお持ちの方はURLを掲載できます。',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'shops',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
		4 => 'revisions',
		5 => 'slug',
		6 => 'author',
		7 => 'format',
		8 => 'page_attributes',
		9 => 'featured_image',
		10 => 'categories',
		11 => 'tags',
		12 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

endif;
