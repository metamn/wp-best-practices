<?php
/**
 * Displays the site header
 *
 * It contains:
 * * A Header image template part.
 * * A Header logo template part.
 * * A Header title template part.
 * * A Header subtitle template part.
 * * A Header hamburger menu template part.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoTheme
 * @since 1.0.0
 */

$component = new MoThemeHTMLComponent();
$header    = new MoThemeHeader();
$klass     = apply_filters(
	'mo_theme_header_attributes',
	array(
		'block'        => 'header',
		'custom_class' => $header->get_class(),
	)
);
?>

<header <?php $component->attributes->display( $klass ); ?>>
	<?php get_template_part( 'template-parts/header/parts/header', 'image' ); ?>
	<?php get_template_part( 'template-parts/header/parts/header', 'logo' ); ?>
	<?php get_template_part( 'template-parts/header/parts/header', 'title' ); ?>
	<?php get_template_part( 'template-parts/header/parts/header', 'subtitle' ); ?>
	<?php get_template_part( 'template-parts/header/parts/header', 'menu-hamburger' ); ?>
</header>

<?php get_template_part( 'template-parts/header/parts/header', 'menu' ); ?>
