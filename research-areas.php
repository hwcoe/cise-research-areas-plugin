<?php
/*
Plugin Name: CISE Research Areas
Description: Use this shortcode to display research areas under the "research-areas-pg" category<strong>[RESEARCH_AREAS type="post" posts_per_page="50" order="ASC" orderby="title" category_name="research-areas-pg"]</strong>
Version: 1.1
Author: Allison Logan
Author URI: http://allisoncandreva.com/
*/


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
			$colmd = three;
		}else if($dispCount=="3"){
			$colmd = three; 
		}else{
			$colmd = three;
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
								<p>' .get_field('content_area'). '</p>' ;

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