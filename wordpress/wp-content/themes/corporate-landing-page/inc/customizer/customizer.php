<?php
Corporate_Landing_Page_Kirki::add_config( 'corporate_landing_page', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
        'disable_output'=> true,
    ) );
/* Option list of all posts */	
	$corporate_landing_page_options_posts = array();
	$corporate_landing_page_options_posts_obj = get_posts();
	$corporate_landing_page_options_posts[''] = __( 'Choose Post', 'corporate-landing-page' );
	foreach ( $corporate_landing_page_options_posts_obj as $corporate_landing_page_posts ) {
		$corporate_landing_page_options_posts[$corporate_landing_page_posts->ID] = $corporate_landing_page_posts->post_title;
	}

/* Option list of all categories */
	$args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
	); 
	$corporate_landing_page_option_categories = array();
	$corporate_landing_page_category_lists = get_categories( $args );
	$corporate_landing_page_option_categories[''] = __( 'Choose Category', 'corporate-landing-page' );
	foreach( $corporate_landing_page_category_lists as $corporate_landing_page_category ){
		$corporate_landing_page_option_categories[$corporate_landing_page_category->term_id] = $corporate_landing_page_category->name;
	}

/**
 * Basic customizations
 */
function corporate_landing_page_homepage_customize($wp_customize) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-branding .site-title a',
			'render_callback' => 'corporate_landing_page_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'corporate_landing_page_customize_partial_blogdescription',
		) );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	function corporate_landing_page_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */

	function corporate_landing_page_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}
add_action( 'customize_register', 'corporate_landing_page_homepage_customize', 10 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function corporate_landing_page_customize_preview_js() {
	wp_enqueue_script( 'corporate_landing_page-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'corporate_landing_page_customize_preview_js' );

/**
 * Information links section
 */
function corporate_landing_page_customizer_theme_info( $wp_customize ) {

	$wp_customize->add_section( 'corporate_landing_page_theme_info' , array(
		'title'       => __( 'Information Links' , 'corporate-landing-page' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('corporate_landing_page_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
    $theme_info .= '<span class="sticky_info_row"><a href="' . esc_url( 'http://demo.themethread.com/corporatelandingpage/' ) . '" target="_blank">' . esc_html__( 'View demo', 'corporate-landing-page' ) . '</a></span>';
	$theme_info .= '<span class="sticky_info_row"><a href="' . esc_url( 'http://themethread.com/article/corporate-landing-page-documentation/' ) . '" target="_blank">' . esc_html__( 'View documentation', 'corporate-landing-page' ) . '</a></span>';
    $theme_info .= '<span class="sticky_info_row"><a href="' . esc_url( 'http://themethread.com/support/' ) . '" target="_blank">' . esc_html__( 'Support Ticket', 'corporate-landing-page' ) . '</a></span>';
	$theme_info .= '<span class="sticky_info_row"><a href="' . esc_url( 'http://themethread.com/theme/corporate-landing-page/' ) . '" target="_blank">' . esc_html__( 'More Details', 'corporate-landing-page' ) . '</a></span>';
	

	$wp_customize->add_control( new Corporate_Landing_Page_Theme_Info( $wp_customize ,'corporate_landing_page_info_theme',array(
		'label' => esc_html__( 'About Corporate Landing Page' , 'corporate-landing-page' ),
		'section' => 'corporate_landing_page_theme_info',
		'description' => $theme_info
		)));

	$wp_customize->add_setting('corporate_landing_page_info_more_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
}
add_action( 'customize_register', 'corporate_landing_page_customizer_theme_info' );

if( class_exists( 'WP_Customize_control' ) ){

	class Corporate_Landing_Page_Theme_Info extends WP_Customize_Control
	{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }//editor close
    
} //class close

/**
 * Add the go to pro section
 */
if( class_exists( 'WP_Customize_Section' ) ) :
	/**
	 * Adding Go to Pro Section in Customizer
	 * https://github.com/justintadlock/trt-customizer-pro
	 */
	class Corporate_Landing_Page_Customize_Section_Pro extends WP_Customize_Section {
	
		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'pro-section';
	
		/**
		 * Custom button text to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_text = '';
	
		/**
		 * Custom pro button URL.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_url = '';
	
		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function json() {
			$json = parent::json();
	
			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );
	
			return $json;
		}
	
		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		protected function render_template() { ?>
	
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
	
				<h3 class="accordion-section-title">
					{{ data.title }}
	
					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
	endif;

add_action( 'customize_register', 'corporate_landing_page_sections_pro' );

function corporate_landing_page_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Corporate_Landing_Page_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Corporate_Landing_Page_Customize_Section_Pro(
			$manager,
			'corporate_landing_page_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'corporate-landing-page' ),
                'priority' => 5,
				'pro_text' => esc_html__( 'Buy Pro Version', 'corporate-landing-page' ),
				'pro_url'  => 'https://themethread.com/theme/corporate-landing-page-pro/'
			)
		)
	);
}

function corporate_landing_page_customizer_info_links_css() {
    wp_enqueue_style( 'corporate-landing-page-admin', get_template_directory_uri().'/css/admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'corporate_landing_page_customizer_info_links_css' );

/**
 * Customizer List
 */
get_template_part( 'inc/customizer/customize-homepage' );
get_template_part( 'inc/customizer/general' );
get_template_part( 'inc/customizer/header' );
get_template_part( 'inc/customizer/typography' );
get_template_part( 'inc/customizer/layouts' );
get_template_part( 'inc/customizer/breadcrumb' );
get_template_part( 'inc/fontawesome/fontawesome-readable-file' );
get_template_part( 'inc/animate/animate-options-file' );