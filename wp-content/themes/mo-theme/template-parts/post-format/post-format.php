<?php
/**
 * Displays a Standard post
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package MoTheme
 * @since 1.0.0
 */

$mopost    = new Mo_Theme_TemplateTags_Post();
$component = new Mo_Theme_Components();

$post_klass_array = apply_filters(
	'mo_theme_post_klass_attributes',
	array(
		'post-format-standard',
		$mopost->get_class(),
	)
);

$attributes = apply_filters(
	'mo_theme_post_format_attributes',
	array(
		'block'        => 'post',
		'custom_class' => $mopost->implode( ' ', $post_klass_array ),
		'custom_id'    => 'post-' . get_the_ID(),
	)
);
?>

<article <?php $component->attributes->display( $attributes ); ?>>
	<?php do_action( 'mo_theme_before_post_format' ); ?>

	<?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>

	<?php
		if ( is_single() ) {
			get_template_part( 'template-parts/post/parts/post', 'title-without-link' );
		} else {
			get_template_part( 'template-parts/post/parts/post', 'title' );
		}
	?>

	<?php get_template_part( 'template-parts/post/parts/post', 'featured-image' ); ?>

	<?php
		if ( ! is_single() && has_excerpt() ) {
			get_template_part( 'template-parts/post/parts/post', 'excerpt' );
		} else {
			get_template_part( 'template-parts/post/parts/post-content', 'standard' );
			get_template_part( 'template-parts/post/parts/post', 'paginated-content' );
		}
	?>
	<?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-no-title' ); ?>

	<?php do_action( 'mo_theme_after_post_format' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
