<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package K2
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 1
			);
			$post_query = new WP_Query($args);
		?>
		<?php if ( $post_query->have_posts() ) : ?>
		<div id="top-update">
			<div class="container">
				<dl>
				<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
				<?php
					$cat = get_the_category();
					$cat_name = $cat[0]->cat_name;
				?>
				<dt><?php the_time('Y.m.d'); ?></dt>
				<dd>
					<span class="category_name"><?php echo $cat_name; ?></php></span>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</dd>
				<?php endwhile; ?>
				</dl>
			</div>
		</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		<div id="genre" class="section">
			<div class="container">
				<h2>料理のジャンルから選ぶ<span>GENRE</span></spa></h2>
				<div class="flex-col sp-col-2 pc-col-4">
					<?php
						$menu_genre = get_terms('menu_genre');
						foreach ( $menu_genre as $term ):
					?>
					<?php
						$term_name = $term->name;
						$term_slug = $term->slug;

						$term_id = esc_html($term->term_id);
						$term_idsp = "menu_genre_".$term_id;
						$tax_thumbnail = get_field('tax_thumbnail',$term_idsp);
						$tax_thumbnailUrl = wp_get_attachment_image_src($tax_thumbnail, 'thumbnail');
					?>
					<a href="<?php echo get_term_link($term); ?>" class="genreThum"><img class="imgHover" loading="lazy" src="<?php if($tax_thumbnail): ?><?php echo $tax_thumbnailUrl[0]; ?><?php else: ?><?php echo get_template_directory_uri(); ?>/image/default/noimage.jpg<?php endif; ?>" alt="<?php echo $term_name; ?>"><?php echo $term_name; ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
			$args = array(
				'post_type' => 'menu',
				'posts_per_page' => 12,
				'order' => 'RAND'
			);
			$menu_query = new WP_Query($args);
		?>
		<?php if ( $menu_query->have_posts() ) : ?>
		<div id="menu" class="section">
			<h2>自宅で食べる<br class="sp">美味しいメニュー<span>MENU</span></h2>
			<div class="container">
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
						<div class="menuThum"><img class="imgHover" loading="lazy" src="<?php echo $menu_imageSrc[0]; ?>" alt="<?php the_title(); ?>"></div>
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
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>menu" class="btn orange">メニュー一覧へ</a>
			<p class="pc"><a href="<?php echo esc_url( home_url( '/' ) ); ?>shops" class="btn outline-orange">店舗から選ぶ</a></p>
		</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</main><!-- #main -->

<?php
get_footer();
