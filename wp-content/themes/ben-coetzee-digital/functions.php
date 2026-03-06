<?php
/**
 * Ben Coetzee Digital — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BCD_VERSION', '1.0.0' );
define( 'BCD_DIR', get_template_directory() );
define( 'BCD_URI', get_template_directory_uri() );

/* ----------------------------------------------------------
   Theme Setup
---------------------------------------------------------- */
function bcd_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( [
		'primary' => __( 'Primary Navigation', 'ben-coetzee-digital' ),
		'footer'  => __( 'Footer Navigation', 'ben-coetzee-digital' ),
	] );
}
add_action( 'after_setup_theme', 'bcd_setup' );

/* ----------------------------------------------------------
   Enqueue Styles & Scripts
---------------------------------------------------------- */
function bcd_enqueue() {
	wp_enqueue_style(
		'bcd-style',
		BCD_URI . '/assets/css/style.css',
		[],
		BCD_VERSION
	);

	wp_enqueue_script(
		'bcd-main',
		BCD_URI . '/assets/js/main.js',
		[],
		BCD_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bcd_enqueue' );

/* ----------------------------------------------------------
   Services Custom Post Type
---------------------------------------------------------- */
function bcd_register_post_types() {
	register_post_type( 'service', [
		'labels' => [
			'name'               => __( 'Services', 'ben-coetzee-digital' ),
			'singular_name'      => __( 'Service', 'ben-coetzee-digital' ),
			'add_new_item'       => __( 'Add New Service', 'ben-coetzee-digital' ),
			'edit_item'          => __( 'Edit Service', 'ben-coetzee-digital' ),
			'view_item'          => __( 'View Service', 'ben-coetzee-digital' ),
			'all_items'          => __( 'All Services', 'ben-coetzee-digital' ),
			'menu_name'          => __( 'Services', 'ben-coetzee-digital' ),
		],
		'public'             => true,
		'show_in_rest'       => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-hammer',
		'menu_position'      => 5,
		'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields' ],
		'rewrite'            => [ 'slug' => 'services', 'with_front' => false ],
	] );
}
add_action( 'init', 'bcd_register_post_types' );

/* ----------------------------------------------------------
   Service Meta Boxes
   Fields: _service_number, _service_badge, _service_hero_subtitle,
           _service_icon_svg, _service_stat_{1|2|3}_{num|label},
           _service_cta_heading, _service_cta_sub
---------------------------------------------------------- */
function bcd_register_meta_boxes() {
	add_meta_box(
		'bcd_service_meta',
		__( 'Service Details', 'ben-coetzee-digital' ),
		'bcd_service_meta_cb',
		'service',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'bcd_register_meta_boxes' );

function bcd_service_meta_cb( $post ) {
	wp_nonce_field( 'bcd_service_meta', 'bcd_service_meta_nonce' );
	$fields = [
		'_service_number'       => 'Service Number (e.g. 01)',
		'_service_badge'        => 'Hero Badge (e.g. Service 01)',
		'_service_hero_subtitle'=> 'Hero Subtitle',
		'_service_icon_svg'     => 'Card Icon SVG (paste full <svg> tag)',
		'_service_stat_1_num'   => 'Stat 1 — Number',
		'_service_stat_1_label' => 'Stat 1 — Label',
		'_service_stat_2_num'   => 'Stat 2 — Number',
		'_service_stat_2_label' => 'Stat 2 — Label',
		'_service_stat_3_num'   => 'Stat 3 — Number',
		'_service_stat_3_label' => 'Stat 3 — Label',
		'_service_cta_heading'  => 'CTA Banner Heading',
		'_service_cta_sub'      => 'CTA Banner Subtext',
	];
	foreach ( $fields as $key => $label ) :
		$val = get_post_meta( $post->ID, $key, true );
		$multiline = in_array( $key, [ '_service_icon_svg', '_service_hero_subtitle' ] );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label><br>
			<?php if ( $multiline ) : ?>
				<textarea id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" style="width:100%;height:80px;"><?php echo esc_textarea( $val ); ?></textarea>
			<?php else : ?>
				<input type="text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $val ); ?>" style="width:100%;">
			<?php endif; ?>
		</p>
	<?php endforeach;
}

function bcd_save_service_meta( $post_id ) {
	if ( ! isset( $_POST['bcd_service_meta_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['bcd_service_meta_nonce'], 'bcd_service_meta' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$fields = [
		'_service_number', '_service_badge', '_service_hero_subtitle',
		'_service_icon_svg',
		'_service_stat_1_num', '_service_stat_1_label',
		'_service_stat_2_num', '_service_stat_2_label',
		'_service_stat_3_num', '_service_stat_3_label',
		'_service_cta_heading', '_service_cta_sub',
	];

	foreach ( $fields as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$val = $key === '_service_icon_svg'
				? wp_kses( $_POST[ $key ], [ 'svg' => [ 'width' => [], 'height' => [], 'viewBox' => [], 'fill' => [], 'stroke' => [], 'stroke-width' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'aria-hidden' => [], 'xmlns' => [] ], 'rect' => [ 'x' => [], 'y' => [], 'width' => [], 'height' => [], 'rx' => [] ], 'path' => [ 'd' => [] ], 'line' => [ 'x1' => [], 'y1' => [], 'x2' => [], 'y2' => [] ], 'circle' => [ 'cx' => [], 'cy' => [], 'r' => [] ], 'polyline' => [ 'points' => [] ], 'polygon' => [ 'points' => [] ] ] )
				: sanitize_text_field( $_POST[ $key ] );
			update_post_meta( $post_id, $key, $val );
		}
	}
}
add_action( 'save_post_service', 'bcd_save_service_meta' );

/* ----------------------------------------------------------
   Helper: Get Service Meta
---------------------------------------------------------- */
function bcd_get_service_meta( $key, $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	return get_post_meta( $post_id, $key, true );
}

/* ----------------------------------------------------------
   Contact Form Handler
---------------------------------------------------------- */
function bcd_handle_contact_form() {
	if ( ! isset( $_POST['bcd_contact_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['bcd_contact_nonce'], 'bcd_contact_form' ) ) {
		wp_die( 'Security check failed.' );
	}

	$name    = sanitize_text_field( $_POST['name'] ?? '' );
	$email   = sanitize_email( $_POST['email'] ?? '' );
	$size    = sanitize_text_field( $_POST['company_size'] ?? '' );
	$phone   = sanitize_text_field( $_POST['phone'] ?? '' );
	$project = sanitize_textarea_field( $_POST['project_overview'] ?? '' );

	if ( ! $name || ! is_email( $email ) || strlen( $project ) < 20 ) {
		wp_safe_redirect( add_query_arg( 'contact', 'error', get_permalink() ) );
		exit;
	}

	$to      = get_option( 'admin_email' );
	$subject = "New Enquiry from {$name} — Ben Coetzee Digital";
	$body    = "Name: {$name}\nEmail: {$email}\nOrganisation Type: {$size}\nPhone: {$phone}\n\nProject Overview:\n{$project}";
	$headers = [ "Reply-To: {$name} <{$email}>", 'Content-Type: text/plain; charset=UTF-8' ];

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'contact', 'success', get_permalink() ) );
	exit;
}
add_action( 'admin_post_nopriv_bcd_contact', 'bcd_handle_contact_form' );
add_action( 'admin_post_bcd_contact', 'bcd_handle_contact_form' );

/* ----------------------------------------------------------
   Flush Rewrite Rules on Theme Activation
---------------------------------------------------------- */
function bcd_flush_rewrite_rules() {
	bcd_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'bcd_flush_rewrite_rules' );
