<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Id-K2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <h1 class="entry-title">404 NOT FOUND</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p>お探しのページは見つかりませんでした。</p>
		<p>あなたがアクセスしようとしたページは削除されたかURLが変更されているため、見つけることができません。</p>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページへ戻る</a></p>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
