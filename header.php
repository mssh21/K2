<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package K2
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/image/apple-touch-icon.png" sizes="180x180">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/theme.css">
</head>

<body <?php body_class(); ?>>
	<div id="siteBody">
	<?php if(is_home()): ?>
	<?php
		$args = array(
			'post_type' => 'home',
			'posts_per_page' => 1
		);
		$home_query = new WP_Query($args);
	?>
	<?php if ( $home_query->have_posts() ) : ?>
	<?php while ( $home_query->have_posts() ) : $home_query->the_post(); ?>
	<?php
		$mv_background = get_field('mv_background');
		$mv_logo = get_field('mv_logo');
		$mv_description = get_field('mv_description');
	?>
	<div id="mainVisual" class="top-mainVisual" <?php if($mv_background): ?>style="background-image:url(<?php echo $mv_background; ?>)"<?php endif; ?>>
		<div class="innner">
			<h1><?php if($mv_logo): ?><img src="<?php echo $mv_logo; ?>" alt="<?php bloginfo( 'name' ); ?>"><?php else: ?><<?php bloginfo( 'name' ); ?><?php endif; ?></h1>
			<div class="mv_description"><?php if($mv_description): ?><?php echo $mv_description; ?><?php else: ?><?php bloginfo( 'description' ); ?><?php endif; ?></div>
		</div>
	</div>
	<?php endwhile; ?>
			<?php else: ?>
	<div id="mainVisual" class="top-mainVisual">
		<div class="innner">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<div class="mv_description"><?php bloginfo( 'description' ); ?></div>
		</div>
	</div>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	<?php else: ?>
	<header id="masthead" class="site-header">
		<div class="pc">
			<?php if(has_custom_logo()): ?>
			<<?php if(is_home()): ?>h1<?php else: ?>div<?php endif; ?> class="site-title"><?php the_custom_logo(); ?></<?php if(is_home()): ?>h1<?php else: ?>div<?php endif; ?>>
			<?php else: ?>
			<<?php if(is_home()): ?>h1<?php else: ?>div<?php endif; ?> class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></<?php if(is_home()): ?>h1<?php else: ?>div<?php endif; ?>>
			<?php endif; ?>
		</div>
		<div id="spHead" class="sp">
			<a href="#" class="back" onclick="javascript:window.history.back(-1);return false;">前のページへ</a>
			<?php
				$args = array(
					'post_type' => 'menu',
					'posts_per_page' => -1,
					'date_query' => array(
						array(
							'inclusive' => true,
							'after' => date( 'Y-m-d', strtotime( '-7 day' ) ),
						),
					),
				);
				$menu_limit_post = new WP_Query($args);
			?>
			<?php if ( $menu_limit_post->have_posts() ) : ?>
			<div class="notify hasnotify">
				<label for="disp-btn">更新情報を表示</label>
				<input type="checkbox" id="disp-btn">
				<div class="notifyList">
					<ul>
						<?php while ( $menu_limit_post->have_posts() ) : $menu_limit_post->the_post(); ?>
						<?php
							$shopID = get_field('menu_shop');
							$menu_image = get_field('menu_image');
							$size = 'thumbnail';
							$menu_imageSrc = wp_get_attachment_image_src( $menu_image, $size );
						?>
						<li><a class="notify-link" href="<?php the_permalink(); ?>">
							<div class="notify-image"><img src="<?php echo $menu_imageSrc[0]; ?>" alt="<?php the_title(); ?>"></div>
							<div class="notify-detail">
								<span class="shopName"><b><?php echo get_post($shopID)->post_title; ?></b></span>-メニュー【<b class="menuTitle"><?php the_title(); ?></b>】が更新されました。
							</div>
						</a></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
			<?php else: ?>
			<div class="notify">
				<label for="disp-btn">更新情報を表示</label>
				<input type="checkbox" id="disp-btn">
				<div class="notifyList">
					<div class="nopost">更新情報はありません。</div>
				</div>
			</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home">HOME</a>
		</div>
	</header><!-- #masthead -->
	<?php endif; ?>
