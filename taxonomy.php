<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package K2
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div id="menu" class="section">
            <h1><?php single_term_title(); ?><span><?php if(is_tax('menu_genre')): ?>GENRN<?php else: ?>TAG<?php endif; ?></span></h1>
			<div class="container">
				<div class="flex-col sp-col-1 pc-col-3">
					<?php while ( have_posts() ) : the_post(); ?>
					<?php
						$menu_image = get_field('menu_image');
						$size = 'medium';
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
						<div class="menuThum"><img class="imgHover" src="<?php echo $menu_imageSrc[0]; ?>" alt="<?php the_title(); ?>"></div>
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
				<?php
                    global $wp_query;
                    $maxpages = $wp_query->max_num_pages;
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    select_pagination( $maxpages, $paged );
                ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
