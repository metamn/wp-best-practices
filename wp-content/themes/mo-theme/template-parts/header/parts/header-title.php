<?php
/**
 * Template part for displaying the header title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoTheme
 * @since 1.0.0
 */

$component  = new MoThemeHTMLComponent();
$attributes = apply_filters(
	'mo_theme_header_title',
	array(
		'block'   => 'header',
		'element' => 'title',
	)
);

if ( display_header_text() ) {
	?>
	<h1 <?php $component->attributes->display( $attributes ); ?>>
		<a class="link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>">
			<span class="text">
				<?php bloginfo( 'name' ); ?>
			</span>
		</a>
	</h1>
	<?php
}
