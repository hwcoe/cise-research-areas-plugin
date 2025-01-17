<?php
/*
Plugin Name: CISE Faculty Listing and Research Areas
Description: Use this shortcode to display research areas under the "research-areas-pg" category<strong>[RESEARCH_AREAS type="post" posts_per_page="50" order="ASC" orderby="title" category_name="research-areas-pg"]</strong>
Version: 2.0
Author: Allison Logan
Author URI: http://allisoncandreva.com/
*/

// Add field groups for Research Areas and faculty information
add_filter('acf/settings/save_json', 'cise_faculty_acf_json_save_point');

if (!function_exists('cise_faculty_acf_json_save_point')) { 
	function cise_faculty_acf_json_save_point( $path ) {
		// update path
		$paths[] = plugin_dir_path(__FILE__) . 'inc/acf-json';
		return $path; 
	}
}

add_filter('acf/settings/load_json', 'cise_faculty_acf_json_load_point');
if (!function_exists('cise_faculty_acf_json_load_point')) {

	function cise_faculty_acf_json_load_point( $paths ) {
	    unset($paths[0]);
	    $paths[] = plugin_dir_path(__FILE__) . 'inc/acf-json';
	    return $paths;
	}
}

// Add Faculty page post template
function cise_faculty_add_page_template ($templates) {
    $templates[WP_PLUGIN_DIR . '/cise-research-areas-plugin/single-post-faculty.php'] = 'Faculty Single Entry';
    return $templates;
    }
add_filter( 'theme_post_templates', 'cise_faculty_add_page_template' );        // regular Posts

function cise_faculty_redirect_page_template ($template) {
    $post = get_post();
    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
    if ('single-post-faculty.php' == basename ($page_template))
        $template = WP_PLUGIN_DIR . '/cise-research-areas-plugin/single-post-faculty.php';
    return $template;
    }
add_filter ('single_template', 'cise_faculty_redirect_page_template');

// allow style tag in wp_kses_post
add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_html_tags', 10, 2 );
function acf_add_allowed_html_tags( $tags, $context ) {
    if ( $context === 'post' ) {
        $tags['style'] = array();
    }
    return $tags;
}

Class ResearchAreas {

	public $plugin_dir;
	public $plugin_url;

	function  __construct(){
		global $wpdb;
		$prefix = $wpdb->prefix;
		$this->plugin_dir = plugin_dir_path(__FILE__);
		$this->plugin_url = plugin_dir_url(__FILE__);
		add_shortcode( 'RESEARCH_AREAS', array($this, 'research_areas_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array($this,'researchareas_enqueue_scripts_styles' ));
	}
	
	function researchareas_enqueue_scripts_styles(){
		wp_enqueue_script('researchareas_fancybox_js', $this->plugin_url.'js/jquery.fancybox.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_style('researchareas_fancybox_css', $this->plugin_url.'css/jquery.fancybox.min.css');
		wp_enqueue_script('researchareas', $this->plugin_url.'js/researchareas.js', array('jquery'), '1.0.0', true);
		wp_enqueue_style('researchareas', $this->plugin_url.'css/researchareas.css');
	}
	
	public function research_areas_shortcode($atts) {

		extract( shortcode_atts( array(
			'posts_per_page' => '50',
			'order' => 'ASC',
			'orderby' => 'title',
			'type'=>'type',	
			'category_name' => 'research-areas-pg',
		), $atts ) );
		
		$args = array(
			'posts_per_page' => (int) $atts['posts_per_page'],
			'post_type' =>$atts['type'],
			'order' => $atts['order'],
			'orderby' => $atts['orderby'],
			'category_name' => $atts['category_name'],
			'no_found_rows' => true,
		);
		
		$dispCount  = (int) $posts_per_page;
		if($dispCount==50){
			$colmd = 'three';
		}else if($dispCount=="3"){
			$colmd = 'three'; 
		}else{
			$colmd = 'three';
		}
		$query = new WP_Query( $args  );

		$research_areas = '<div class="researchareas-tab">'; //col-md-12

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$post_id = get_the_ID();

				$featimageURL = wp_get_attachment_url( get_post_thumbnail_id($post_id) );

				$research_areas .= '<div class="researchbox" aria-label="' .get_the_title(). '">';
										
				$research_areas .= $this->wpse69204_excerpt(); 
				$research_areas .= 
					'<div class="fancyboxcont" id="post_'.$post_id.'">';
				$research_areas .= 
						'<div class="col-md-12 popupcont">';
				$research_areas .= 
							'<div class="popupcont-text"><h1>' .get_the_title(). '</h1>
								<hr class="header-line">
								<p>' . wp_kses_post( get_field('content_area') ) . '</p>' ;


				$research_areas .= '</div></div></div></div>';
			endwhile;
			wp_reset_postdata();
		} else { ?>
			<p style="text-align:center;">There are no research areas to show. Please come back.</p>
		<?php }
		$research_areas .= '</div>';
		return $research_areas;
	} //end research_areas_shortcode function
	
	public function wpse69204_excerpt( $post_id = null )
	{
		global $post;
		$research_post = $post_id ? get_post( $post_id ) : $post;
		$featimageURL = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		$featureimageALT = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
		
		$excerpt .= '<a class="various" data-fancybox="researchareas" href="#post_'.$post->ID.'" title="' .get_the_title(). '" aria-label="Click to see the ' .get_the_title(). ' research area associated faculty"><div class="researchthumbnail" style="background-image: url(' .$featimageURL. ');"><h2>' .get_the_title(). '</h2></div></a>';

		return $excerpt;
	}
}

$ResearchAreas = new ResearchAreas();

