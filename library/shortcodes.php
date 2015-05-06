<?php
// shortcodes

/*
 * Allow shortcodes in widgets
 * @since v0.1
 */
add_filter('widget_text', 'do_shortcode');


/*
 * Grid Box
 * @since v1.0
 */
if( !function_exists('btsc_gridbox_shortcode') ) {
	function btsc_gridbox_shortcode($atts, $content = null) {
        
        $att = shortcode_atts( array(
            'post_type' => 'page',
            'posts_per_page' => -1,
            'col' => 3,
            'date' => false,
            'tax' => ''
        ), $atts );
        
        $html = '<div id="gridbox" class="row">';
        $args = array(
                'post_type' => esc_attr($att['post_type']),
                'post_parent' => 0,
                'posts_per_page' => esc_attr($att['posts_per_page']),
                'orderby' => 'date'
        );
        
        $postsgrid = get_posts( $args );
        $colw = 12/ esc_attr($att['col']);
        //print_r($postsgrid);
    
        
        foreach ( $postsgrid as $postg ) :
            $html .= '<div class="gridbox-container col-sm-'.$colw;
            if(!wp_is_mobile() ) $html.=' animated fadeInRight delay0 duration3 eds-on-scroll';
            $html .= '">';
            $html .= '<div class="gridbox-thumbnail">';
            $html .= '<a href="'.get_the_permalink($postg->ID).'">';
            $html .= get_the_post_thumbnail($postg->ID, 'thumb-col-'.$col);
            $html .= '</a>';
            $html .= '<div class="captiongrid">';
            if(esc_attr($att['tax'])) { 
                $terms = get_the_terms( $postg->ID, esc_attr($att['tax']) );
                if ( $terms && ! is_wp_error( $terms ) ) : 
                $tax_links = array();
                    foreach ( $terms as $term ) {
                        $tax_links[] = $term->name;
                    }
                $tax_text = join( ", ", $tax_links );
                endif;

                $html .= '<span class="taxonomy">';
                $html .= $tax_text;
                $html .= '</span>  ';
            }
            $html .= '<h2 class="titlegrid">';
            if(esc_attr($att['date'])) { 
                $html .= '<span class="postdate">';
                $html .= get_the_date('d/m', $postg->ID);
                $html .= '</span>  ';
            }
            $html .= '<a href="'.get_the_permalink($postg->ID).'">'.get_the_title($postg->ID).'</a></h2>';
            $html .= '</div> </div> </div>';
        endforeach; 
        $html .= '</div>';

        return $html;
	}
	add_shortcode( 'gridbox', 'btsc_gridbox_shortcode' );
}

/*
 * Image Post Slider
 * @since v0.2
 */
if( !function_exists('btsc_imagepostslider_shortcode') ) {
	function btsc_imagepostslider_shortcode($atts, $content = null) {
        
        global $post;
        $args = array(
            'post_mime_type' => 'image',
            'post_parent' => $post->ID,
            'post_type' => 'attachment',
            'suppress_filters' => 0
        );

        $attachments = get_children( $args );
        $numattach = count($attachments);

        if ( $attachments && $numattach == 1 ) {
            $html = get_the_post_thumbnail('page-thumb', array('class' => 'page-thumb img-rounded'));
        } elseif ($attachments) {
            
        $html = '<div class="carousel slide" id="myCarousel">';
        $html .= '<div class="carousel-inner">';

        $i = 0;
        foreach ( $attachments as $attachment ) {

            $html .= '<div class="item ';
            if($i==0) $html .= ' active';
            $html .= '">';
            $html .= '<div class="bannerImage">';
            $html .= get_the_post_thumbnail( $post->ID, 'page-thumb' );
            $html .= '</div>';
            $html .= '</div><!-- /Slide -->' ;
            $i++;
        }
        $html .= '</div>';
        $html .= '<div class="control-box">';
        $html .= '<a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>';
        $html .= '<a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>';
        $html .= '</div><!-- /.control-box -->';
        $html .= '</div>';
            
        return $html;
        }
    }
	add_shortcode( 'imagepostslider', 'btsc_imagepostslider_shortcode' );
}

/*
 * Grid Taxonomy Box
 * @since v1.1
 */
if( !function_exists('btsc_gridtaxbox_shortcode') ) {
	function btsc_gridtaxbox_shortcode($atts, $content = null) {
        
        $att = shortcode_atts( array(
            'col' => 3,
            'tax' => '',
            'title' => false,
        ), $atts );
        
        $html = '<div id="gridbox" class="row">';
        
        $taxgrid = get_terms( array(esc_attr($att['tax']) ), 
                              array('orderby' => 'name', 
                                    'order'   => 'ASC',
                                    'hide_empty' =>true
                                   ) );
        $colw = 12/ esc_attr($att['col']);
        
        foreach ( $taxgrid as $taxg ) :
            $html .= '<div class="gridtaxbox-container col-sm-'.$colw;
            if(!wp_is_mobile() ) $html.= ' animated fadeInRight delay1 duration3 eds-on-scroll';
            $html.='">';
            $html .= '<div class="gridtaxbox-thumbnail text-center">';
            $html .= '<a href="'.get_term_link($taxg).'">';
        
            $tax_term_id = $taxg->term_id;
            $images = get_option('taxonomy_image_plugin');
            $html.= wp_get_attachment_image( $images[$tax_term_id], 'medium' );

            $html .= '</a>';
            if(esc_attr($att['title'])==true){
                $html .= '<div class="captiongrid">';
                $html .= '<h2 class="titlegrid">';
                $html .= '<a href="'.get_term_link($taxg).'">'.$taxg->name.'</a></h2>';
                $html .= '</div>';
            }
            $html .= '</div> </div>';
        endforeach; 
        $html .= '</div>';

        return $html;
	}
	add_shortcode( 'gridtaxbox', 'btsc_gridtaxbox_shortcode' );
}

/*
 * Carousel for Posts Types
 * @since v1.0
 **/

if ( !function_exists('btsc_carouselcpt_shortcode') ) {
	function btsc_carouselcpt_shortcode($atts, $content = null) {
        
        $att = shortcode_atts( array(
            'post_type' => 'page',
            'tax' => '',
            'title' => '',
            'type' => 'post',
            'col' => 3,
            'titlep' => false
        ), $atts );
        
        $html = '<div id="gridcarbox" class="row">';
        $type = esc_attr($att['type']);
        $idcarousel = rand(1,99);
        $col = esc_attr($att['col']);
        $colw = 12/ esc_attr($att['col']);

        if($type =='post') {
            $args = array(
                'post_type' => esc_attr($att['post_type']),
                'post_parent' => 0,
                'posts_per_page' => 6,
                'orderby' => 'date'
            );
            $grid = get_posts( $args );
            
        } elseif($type =='tax') { 
            $grid = get_terms( array(esc_attr($att['tax']) ), 'orderby=count&hide_empty=0' );
        }
                
        $i = 1;
        $idcarousel = rand(1,99);
        $titlep = esc_attr($att['titlep']);
        $html .='
        <div class="container">
            <div class="col-sm-12">';
            if(esc_attr($att['title']) ) { $html.= '<h2>'.esc_attr($att['title']).'</h2>'; }
        $html.='
                <div class="carousel carousel'.$idcarousel.' slide" id="myCarousel'.$idcarousel.'" data-ride="carousel">
                  <div class="carousel-inner">';

        
            foreach ( $grid as $gridg ) : 
                    $html.='
                    <div class="item';
                    if($i == 1) $html.=' active';
                    $html.='">';
        
                    if($type =='post') { 
                        $html.='<div class="col-xs-12 col-sm-'.$colw.'">';
                        $html .= '<a href="'.get_permalink($gridg).'">';
                        $html.= get_the_post_thumbnail( $gridg->ID, 'thumb-col-'.$colw );
                        $html.= '</a>';
                        if($titlep) {
                            $html .= '<div class="captiongrid">';
                            $html .= '<h2 class="titlegrid"><a href="'.get_permalink($gridg).'">';
                            $html .= get_the_title($gridg->ID);
                            $html.= '</a></h2></div>';
                            }
                        $html.='</div>';
                    } elseif($type =='tax') { 
                        $html.='<div class="col-xs-12 col-sm-'.$colw.'">';
                        $html .= '<a href="'.get_term_link($gridg).'">';

                        $tax_term_id = $gridg->term_id;
                        $images = get_option('taxonomy_image_plugin');
                        $html.= wp_get_attachment_image( $images[$tax_term_id], 'medium' );
                        $html.= '</a></div>';
                    }
        
                    $html.='</div>';
                    $i++;
                endforeach;         
        
        
                  $html.='</div>
                  <a class="left carousel-control" href="#myCarousel'.$idcarousel.'" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                  <a class="right carousel-control" href="#myCarousel'.$idcarousel.'" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
        </div>';
        

        $html .="
        <script type='text/javascript'>
        jQuery('#myCarousel".$idcarousel."').carousel({
          interval: 2000
        });
        
        jQuery('.carousel".$idcarousel." .item').each(function(){
          var next = jQuery(this).next();
          if (!next.length) {
            next = jQuery(this).siblings(':first');
          }
          next.children(':first-child').clone().appendTo(jQuery(this));
          if (next.next().length>0) {
              next.next().children(':first-child').clone().appendTo(jQuery(this)).addClass('rightest');
          }
          else {
              jQuery(this).siblings(':first').children(':first-child').clone().appendTo(jQuery(this));
          }
        });
        </script>";
        $html .='
        <style>
        .carousel-inner .active.left { left: -33%; }
        .carousel-inner .next        { left:  33%; }
        .carousel-inner .prev        { left: -33%; }
        .carousel-control.left,.carousel-control.right {background-image:none;}
        .item:not(.prev) {visibility: visible;}
        .item.right:not(.prev) {visibility: hidden;}
        .rightest{ visibility: visible;}
        #myCarousel'.$idcarousel.' a.left.carousel-control {left: -75px;}
        #myCarousel'.$idcarousel.' a.right.carousel-control {right: -75px;}
        </style>
        ';
        return $html;
	}
add_shortcode( 'carouselcpt', 'btsc_carouselcpt_shortcode' );
}





// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<div class="row-fluid"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="col-sm-2">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';
	}

	return $output;
}



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 


