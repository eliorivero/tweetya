<?php
/**
* Plugin Name: TweetYa
* Plugin URI: http://queryloop.com
* Description: Tweetea el título del post y la URL.
* Version: 0.0.7
* Author: Elio Rivero
* Author URI: http://twitter.com/eliorivero
* Text Domain: queryloop
*/

/**
* Muestra link para tweetear
*
* @since 1.0.0
*
* @param string $content El contenido del post.
*
* @return string El contenido del post con el link para tweetear al final.
*/
function tweetya_mostrar_link( $contenido ) {
	wp_enqueue_style( 'ql-tweetya' );
	wp_enqueue_script( 'ql-tweetya' );
	$title = the_title_attribute('echo=0');
	$intent = 'http://twitter.com/intent/tweet?text=' . urlencode( $title . ' ' . get_permalink() );
	$link = '<a href="' . esc_url( $intent ) . '"
		  title="' . esc_attr( sprintf( __( 'Compartir %s', 'queryloop' ), $title ) ) . '"
		  target="_blank" class="tweetya-btn">' . __( 'Comparte!', 'queryloop' ) . '</a>';
	return $contenido . $link;
}
add_filter( 'the_content', 'tweetya_mostrar_link' );

/**
 * Initialize localization routines. If you're already doing it in your plugin or theme dismiss this.
 *
 * @since 1.0.0
 */
function tweetya_localizacion() {
	load_plugin_textdomain( 'queryloop', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'tweetya_localizacion' );

/**
 * Registra un estilo para ser encolado luego.
 * @since 1.0.0
 */
function tweetya_css_js() {
	wp_register_style( 'ql-tweetya', plugins_url( 'ql-tweetya/css/ql-style.css' ) );
	wp_register_script( 'ql-tweetya', plugins_url( 'ql-tweetya/js/ql-style.js' ), array( 'jquery' ) );
	wp_localize_script( 'ql-tweetya', 'qlTweetYaVars', array(
		'toolTip' => __( 'Compartir artículo', 'queryloop' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'tweetya_css_js' );