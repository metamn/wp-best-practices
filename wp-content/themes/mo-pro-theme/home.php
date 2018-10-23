<?php
/**
 * Displays the home page with a sidebar
 *
 * The home page is a list of posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ Wordpress documentation
 *
 * @package Mo\Pro|Theme
 * @since 1.0.0
 */

get_header();

$component = new Mo_Theme_Components();

$attributes = apply_filters(
	'mo_theme_home_attributes',
	array(
		'block' => 'home',
	)
);

$title = apply_filters(
	'mo_theme_home_title',
	array(
		'title' => 'Home',
	)
);
?>

<section <?php $component->attributes->display( $attributes ); ?>>
	<?php
		$component->title->display( $title );
		get_template_part( 'template-parts/post-list/post-list', '' );
	?>
</section>

<?php
get_sidebar( 'sidebar-1' );
get_footer();
