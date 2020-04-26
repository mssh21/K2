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
        <div class="section">
			<h1>店舗から探す<span>SHOP</span></h1>
			<div class="container">
				<div id="shopList" class="flex-col sp-col-2 pc-col-4">
					<?php while ( have_posts() ) : the_post(); ?>
					<?php
						$shop_image = get_field('shop_image');
						$size = 'middle-feature';
						$shop_imageSrc = wp_get_attachment_image_src( $shop_image, $size );
						$shop_address = get_field('shop_address');
					?>
					<a href="<?php the_permalink(); ?>" class="genreThum"><img class="imgHover"  src="<?php echo $shop_imageSrc[0]; ?>" loading="lazy" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
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
