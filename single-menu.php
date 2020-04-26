<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package K2
 */

get_header();
$menu_shop = get_field('menu_shop');
$menu_image = get_field('menu_image');
$size = 'large';
$menu_imageSrc = wp_get_attachment_image_src( $menu_image, $size );
$menu_genre = get_field('menu_genre');
$menu_tag = get_field('menu_tag');
$menu_description = get_field('menu_description');
$menu_charge = get_field('menu_charge');
$menu_genre = get_the_terms($post->ID,'menu_genre',true);
	foreach($menu_genre as $genre){
	$genre_name = $genre->name;
}
$menu_delivery = get_the_terms($post->ID,'menu_delivery',true);
$menu_tag = get_the_terms($post->ID,'menu_tag',true);

$shopID = get_field('menu_shop');
?>

	<main id="primary" class="site-main">
		<div class="container">
            <h1 class=""><span>メニュー</span><?php the_title(); ?></h1>
            <div class="tag menuPage">
                <?php
					if ( !empty( $menu_delivery ) ){
						foreach ( $menu_delivery as $delivery ) {
							echo '<a href="' .get_term_link($delivery->slug, 'menu_delivery'). '" class="menu_delivery">' .$delivery->name.'</a>';
						}
					}
				?>
				<a href="<?php echo get_term_link($genre->slug, 'menu_genre'); ?>"><?php echo $genre_name; ?></a>
				<?php
					if ( !empty( $menu_tag ) ){
						foreach ( $menu_tag as $tag ) {
							echo '<a href="' .get_term_link($tag->slug, 'menu_tag'). '">' .$tag->name.'</a>';
						}
					}
				?>
			</div>
        </div>
        <?php if($menu_image): ?><div class="shop-image"><img src="<?php echo $menu_imageSrc[0]; ?>" loading="lazy" alt="<?php the_title(); ?>"></div><?php endif; ?>
        <div class="container middle">
            <div class="clearfix">
                <div class="col-left">
                    <p><?php echo $menu_description; ?></p>
                    <div class="chage">￥<?php echo number_format($menu_charge); ?></div>
                </div>
                <div class="col-right">
                    <?php
                        $args = array(
                            'post_type' => 'shops',
                            'post__in' => array($shopID),
                        );
                        $shops_query = new WP_Query($args);
                    ?>
                    <?php if ( $shops_query->have_posts() ) : ?>
                    <?php while ( $shops_query->have_posts() ) : $shops_query->the_post(); ?>
                    <?php
                        $shop_tel = get_field('shop_tel');
                    ?>
                    <div class="request sp">
                        <a href="tel:<?php echo $shop_tel; ?>" class="btn orange">
                            <b>商品を注文する</b><br>
                            <small>タップで電話をかけることができます。</small>
                        </a>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                    <div class="pc qr">
                        <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php the_permalink(); ?>" alt="QRコード"><br>
                        <small>スマートフォンで見る</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="pageDetail" class="container sp-wide middle">
            <?php
                $args = array(
                    'post_type' => 'shops',
                    'post__in' => array($shopID),
                );
                $shops_query = new WP_Query($args);
            ?>
            <?php if ( $shops_query->have_posts() ) : ?>
            <div id="shop">
                <h2>店舗情報</h2>
				<div class="flex-col sp-col-1 pc-col-1">
					<?php while ( $shops_query->have_posts() ) : $shops_query->the_post(); ?>
					<?php
                        $shop_image = get_field('shop_image');
                        $size = 'middle-feature';
                        $shop_imageSrc = wp_get_attachment_image_src( $shop_image, $size );
                        $shop_address = get_field('shop_address');
					?>
					<a href="<?php the_permalink(); ?>" class="shopBox">
						<div class="shopThum"><img class="imgHover" src="<?php echo $shop_imageSrc[0]; ?>" loading="lazy" alt="<?php the_title(); ?>"></div>
						<div class="shopDetail">
							<h3><?php the_title(); ?></h3>
							<div class="address"><?php echo $shop_address; ?></div>
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
