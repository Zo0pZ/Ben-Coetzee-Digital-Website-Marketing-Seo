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
		[
			'strategy'  => 'defer',
			'in_footer' => true,
		]
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
   Meta Description Output
   ---------------------------------------------------------- */
function bcd_meta_description() {
	$desc = '';

	if ( is_front_page() ) {
		$desc = 'Ben Coetzee Digital Consultancy – Enterprise-grade website design, digital marketing, and technical upgrades for businesses across Weston-super-Mare, Bristol, and Somerset.';
	} elseif ( is_page( 'about' ) ) {
		$desc = 'About Ben Coetzee – experienced Digital Website Manager with over 15 years in digital transformation, CMS platforms, SEO, and UX design across the UK.';
	} elseif ( is_page( 'contact' ) ) {
		$desc = 'Contact Ben Coetzee Digital Consultancy – based in the South West, available across Weston-super-Mare, Bristol, Somerset, and beyond for digital projects of any scale.';
	} elseif ( is_singular( 'service' ) ) {
		$desc = get_the_excerpt();
		if ( ! $desc ) {
			$desc = wp_trim_words( get_the_content(), 25, '...' );
		}
	} elseif ( is_singular() ) {
		$desc = get_the_excerpt();
	}

	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'bcd_meta_description', 1 );

/* ----------------------------------------------------------
   Security Headers (Best Practices: CSP, HSTS, COOP, XFO)
   ---------------------------------------------------------- */
function bcd_security_headers() {
	// Only on front-end, not admin
	if ( is_admin() ) {
		return;
	}

	// Content Security Policy
	header( "Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://fonts.gstatic.com https://www.googletagmanager.com https://www.google-analytics.com https://www.clarity.ms; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com https://www.clarity.ms; frame-ancestors 'self';" );

	// HTTP Strict Transport Security
	header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );

	// Cross-Origin Opener Policy
	header( 'Cross-Origin-Opener-Policy: same-origin' );

	// X-Frame-Options (clickjacking protection)
	header( 'X-Frame-Options: SAMEORIGIN' );

	// X-Content-Type-Options
	header( 'X-Content-Type-Options: nosniff' );

	// Referrer Policy
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );

	// Permissions Policy
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
}
add_action( 'send_headers', 'bcd_security_headers' );

/* ----------------------------------------------------------
   CookieAdmin – Self-Contained Consent Fallback
   The base consent.js intermittently returns 503, leaving all
   core functions undefined.  This script provides a complete
   fallback: it reads/writes the cookieadmin_consent cookie,
   wires up Accept / Reject / Save buttons, and hides the
   banner on return visits — entirely independent of the
   plugin's own JS.
   ---------------------------------------------------------- */
function bcd_patch_cookieadmin_consent() {
	if ( is_admin() ) {
		return;
	}
	?>
	<script>
	(function(){
		/* ── helpers ─────────────────────────────────────── */
		var COOKIE  = 'cookieadmin_consent';
		var PATH    = '/';
		var DAYS    = (window.cookieadmin_policy && window.cookieadmin_policy.cookieadmin_days) || 365;
		var IS_SSL  = location.protocol === 'https:';

		function setCookie(name, val, days){
			var d = new Date();
			d.setTime(d.getTime() + days*864e5);
			var s = encodeURIComponent(name) + '=' + JSON.stringify(val)
				  + '; expires=' + d.toUTCString()
				  + '; path=' + PATH
				  + '; SameSite=Lax';
			if(IS_SSL) s += '; Secure';
			document.cookie = s;
		}

		function getCookie(name){
			var m = document.cookie.match('(^|;)\\s*' + name + '=([^;]+)');
			if(!m) return null;
			try{ return JSON.parse(decodeURIComponent(m[2])); }catch(e){ return null; }
		}

		function hideUI(){
			var b = document.querySelector('.cookieadmin_law_container');
			var m = document.querySelector('.cookieadmin_cookie_modal');
			var o = document.querySelector('.cookieadmin_modal_overlay');
			if(b) b.style.display = 'none';
			if(m) m.style.display = 'none';
			if(o) o.style.display = 'none';
		}

		function showReconsent(){
			var rc = document.querySelector('.cookieadmin_re_consent');
			if(rc) rc.style.display = 'block';
		}

		function saveAndHide(pref){
			setCookie(COOKIE, pref, DAYS);
			hideUI();
			showReconsent();
			/* Still fire the pro AJAX logger if available */
			if(typeof cookieadmin_pro_set_consent === 'function'){
				try{ cookieadmin_pro_set_consent(pref, DAYS); }catch(e){}
			}
		}

		/* ── provide missing base functions as globals ──── */
		if(typeof window.cookieadmin_set_cookie !== 'function'){
			window.cookieadmin_set_cookie = setCookie;
		}
		if(typeof window.cookieadmin_is_consent === 'undefined'){
			window.cookieadmin_is_consent = {};
		}
		if(typeof window.cookieadmin_save_consent_cookie !== 'function'){
			window.cookieadmin_save_consent_cookie = function(pref, days){
				setCookie(COOKIE, pref, days || DAYS);
				window.cookieadmin_is_consent.action = pref;
			};
		}
		if(typeof window.cookieadmin_set_consent !== 'function'){
			window.cookieadmin_set_consent = function(pref, days){
				saveAndHide(pref);
			};
		}

		/* ── on page load: check cookie & wire buttons ──── */
		var existing = getCookie(COOKIE);
		if(existing){
			window.cookieadmin_is_consent.action = existing;
		}

		function showBanner(){
			var b = document.querySelector('.cookieadmin_law_container');
			if(b){
				b.style.display = 'block';
				b.style.position = 'fixed';
				b.style.bottom = '0';
				b.style.left = '0';
				b.style.right = '0';
				b.style.width = '100%';
				b.style.zIndex = '999999';
			}
		}

		document.addEventListener('DOMContentLoaded', function(){

			/* If consent already given, hide banner immediately */
			if(existing){
				hideUI();
				showReconsent();
				return;
			}

			/* No consent yet — show the banner */
			showBanner();

			/* Accept buttons */
			document.querySelectorAll('.cookieadmin_accept_btn').forEach(function(btn){
				btn.addEventListener('click', function(){
					saveAndHide({accept:'true'});
				});
			});

			/* Reject buttons */
			document.querySelectorAll('.cookieadmin_reject_btn').forEach(function(btn){
				btn.addEventListener('click', function(){
					saveAndHide({reject:'true'});
				});
			});

			/* Save preferences button */
			var saveBtn = document.querySelector('.cookieadmin_save_btn');
			if(saveBtn){
				saveBtn.addEventListener('click', function(){
					var pref = {};
					document.querySelectorAll('.cookieadmin_toggle').forEach(function(t){
						if(t.children[0] && t.children[0].checked){
							var key = t.children[0].id.replace('cookieadmin-','');
							pref[key] = 'true';
						}
					});
					if(Object.keys(pref).length === 0){
						pref = {reject:'true'};
					}
					saveAndHide(pref);
				});
			}
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'bcd_patch_cookieadmin_consent', 999 );

/* ----------------------------------------------------------
   Customizer: Logo Text Settings
---------------------------------------------------------- */
function bcd_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'bcd_logo_section', [
		'title'    => __( 'Logo Text', 'ben-coetzee-digital' ),
		'priority' => 20,
	] );

	// Logo Mark Image
	$wp_customize->add_setting( 'bcd_logo_mark_image', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bcd_logo_mark_image', [
		'label'   => __( 'Logo Mark Image', 'ben-coetzee-digital' ),
		'description' => __( 'Upload a logo image. If empty, the text fallback below is used.', 'ben-coetzee-digital' ),
		'section' => 'bcd_logo_section',
	] ) );

	// Logo Mark Text Fallback (e.g. "BC")
	$wp_customize->add_setting( 'bcd_logo_mark', [
		'default'           => 'BC',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	] );
	$wp_customize->add_control( 'bcd_logo_mark', [
		'label'   => __( 'Logo Mark Text (fallback)', 'ben-coetzee-digital' ),
		'description' => __( 'Shown when no image is uploaded.', 'ben-coetzee-digital' ),
		'section' => 'bcd_logo_section',
		'type'    => 'text',
	] );

	// Logo Text (e.g. "Ben Coetzee Digital")
	$wp_customize->add_setting( 'bcd_logo_text', [
		'default'           => 'Ben Coetzee Digital',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	] );
	$wp_customize->add_control( 'bcd_logo_text', [
		'label'   => __( 'Logo Text', 'ben-coetzee-digital' ),
		'section' => 'bcd_logo_section',
		'type'    => 'text',
	] );

	// Live preview JS
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'bcd_logo_mark_image', [
			'selector'            => '.logo-mark',
			'render_callback'     => 'bcd_render_logo_mark',
			'container_inclusive' => false,
		] );
		$wp_customize->selective_refresh->add_partial( 'bcd_logo_mark', [
			'selector'            => '.logo-mark',
			'render_callback'     => 'bcd_render_logo_mark',
			'container_inclusive' => false,
		] );
		$wp_customize->selective_refresh->add_partial( 'bcd_logo_text', [
			'selector'        => '.logo-text',
			'render_callback' => function() {
				echo esc_html( get_theme_mod( 'bcd_logo_text', 'Ben Coetzee Digital' ) );
			},
		] );
	}
}
add_action( 'customize_register', 'bcd_customize_register' );

function bcd_render_logo_mark() {
	$image = get_theme_mod( 'bcd_logo_mark_image', '' );
	$text  = get_theme_mod( 'bcd_logo_mark', 'BC' );
	if ( $image ) {
		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-mark__img">';
	} else {
		echo esc_html( $text );
	}
}

function bcd_customize_preview_js() {
	wp_enqueue_script(
		'bcd-customizer',
		BCD_URI . '/assets/js/customizer.js',
		[ 'customize-preview' ],
		BCD_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'bcd_customize_preview_js' );

/* ----------------------------------------------------------
   Flush Rewrite Rules on Theme Activation
---------------------------------------------------------- */
function bcd_flush_rewrite_rules() {
	bcd_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'bcd_flush_rewrite_rules' );
