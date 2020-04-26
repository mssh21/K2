<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package K2
 */

get_header();
$shop_image = get_field('shop_image');
$size = 'large';
$shop_imageSrc = wp_get_attachment_image_src( $shop_image, $size );
$shop_description = get_field('shop_description');
$shop_address = get_field('shop_address');
$shop_tel = get_field('shop_tel');
$shop_email = get_field('shop_email');
$shop_url = get_field('shop_url');

$postID = get_the_ID();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<h1><span>店舗名</span><?php the_title(); ?></h1>
		</div>
		<?php if($shop_image): ?><div class="shop-image"><img src="<?php echo $shop_imageSrc[0]; ?>" loading="lazy" alt="<?php the_title(); ?>"></div><?php endif; ?>
		<?php if($shop_description): ?>
		<div class="container middle">
			<p><?php echo $shop_description; ?></p>
		</div>
		<?php endif; ?>
		<div id="pageDetail" class="container sp-wide middle">
			<table class="data">
				<?php if($shop_address): ?>
				<tr>
					<th>住所</th>
					<td><?php echo $shop_address; ?><br><a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $shop_address; ?>">地図で見る</a></td>
				</tr>
				<?php endif; ?>
				<?php if($shop_tel): ?>
				<tr>
					<th>電話番号</th>
					<td><span class="tel-link"><?php echo $shop_tel; ?></span><br><small class="sp box">タップで電話をかけることができます。</small></td>
				</tr>
				<?php endif; ?>
				<?php if($shop_url): ?>
				<tr>
					<th>URL</th>
					<td><a href="<?php echo $shop_url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $shop_url; ?></a></td>
				</tr>
				<?php endif; ?>
			</table>

			<?php
				function my_posts_where( $where ) {
					$where = str_replace("meta_key = 'menu_shop_$", "meta_key LIKE 'menu_shop_%", $where);
					return $where;
				}
				add_filter('posts_where', 'my_posts_where');

				$args = array(
					'post_type' => 'menu',
					'posts_per_page' => -1,
					'meta_key' => 'menu_shop',
					'meta_value' => $postID
				);
				$menu_query = new WP_Query($args);
			?>
			<?php if ( $menu_query->have_posts() ) : ?>
			<div id="menu">
				<h2>メニュー</h2>
				<div class="flex-col sp-col-1 pc-col-3">
					<?php while ( $menu_query->have_posts() ) : $menu_query->the_post(); ?>
					<?php
						$menu_image = get_field('menu_image');
						$size = 'middle-feature';
						$menu_imageSrc = wp_get_attachment_image_src( $menu_image, $size );
						$menu_charge = get_field('menu_charge');

						$menu_genre = get_the_terms($post->ID,'menu_genre',true);
						foreach($menu_genre as $genre){
							$genre_name = $genre->name;
						}

						$menu_delivery = get_the_terms($post->ID,'menu_delivery',true);
						$menu_tag = get_the_terms($post->ID,'menu_tag',true);
					?>
					<a href="<?php the_permalink(); ?>" class="menuBox">
						<div class="menuThum"><img class="imgHover" src="<?php echo $menu_imageSrc[0]; ?>" loading="lazy" alt="<?php the_title(); ?>"></div>
						<div class="menuDetail">
							<div class="tag">
								<?php
									if ( !empty( $menu_delivery ) ){
										foreach ( $menu_delivery as $delivery ) {
											echo '<span class="menu_delivery">' .$delivery->name.'</span>';
										}
									}
								?>
								<span><?php echo $genre_name; ?></span>
								<?php
									if ( !empty( $menu_tag ) ){
										foreach ( $menu_tag as $tag ) {
											echo '<span>' .$tag->name.'</span>';
										}
									}
								?>
							</div>
							<h3><?php the_title(); ?></h3>
							<div class="charge">￥<?php echo number_format($menu_charge); ?></div>
						</div>
					</a>
					<?php endwhile; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
