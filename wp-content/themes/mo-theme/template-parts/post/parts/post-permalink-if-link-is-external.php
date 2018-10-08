<?php
/**
 * Displays post permalink if the link points to an external link
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoTheme
 * @since 1.0.0
 */

$mopost = new MoThemePost();

if ( ! $mopost->link_is_external( $mopost->get_link_from_content() ) ) {
	get_template_part( 'template-parts/post/parts/post', 'permalink' );
}
