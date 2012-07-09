<?php 
/**
 * Plugin Name: itemprop WP
 * Plugin URI: http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-1-0-itempropWP_load_widgets
 * Description: Add human invisible schema.org itemprop code to images
 * Version: 1.0
 * Requires at least: 3.3
 * Tested up to: 3.4.1
 * Author: Rolands Umbrovskis
 * Author URI: http://umbrovskis.com
 * License: simplemediacode
 * License URI: http://simplemediacode.com/license/gpl/
 */



define('SMCIPWPV','1.0'); // location general @since 1.0
define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
define('SMCIPWPF','itempropwp'); // location folder @since 1.0
define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Image location @since 1.0
define('SMCIPWPI',WPDRAUGIEMURL.'/img'); // Image location @since 1.0
define('SMCIPWPORG','http://wordpress.org/extend/plugins/'.SMCIPWPF); // Image location @since 1.0

add_filter('post_thumbnail_html','smc_ipwp_image_itemprop',10,3 );
function smc_ipwp_image_itemprop($html, $post_id, $post_image_id){
 $html = str_replace('src',' itemprop="image" src',$html);
 return $html;
}

function smc_ipwp_get_first_image($postid) {
  global $post;
  if(!$postid||empty($postid)) $postid = $post->ID;
  /* Get all images*/
  $allposimages = get_children(array('post_parent' => $postid,'post_type'=>'attachment', 'post_mime_type'=>'image','numberposts' => 1,'order'=> 'ASC',));
  
  $smc_ipwpfi = '';
  $new_img_tag = "";

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $smc_ipwpfi = $matches[1][0];

  if(empty($smc_ipwpfi)){ //Defines a default image with 0 width
  $new_img_tag = "<img src='./images/bargainsfrenzy.com.gif' class='alignleft' />";
  }

  else{
    echo $new_img_tag = "<img src='./thumb.php?gd=2&src=".$smc_ipwpfi."&maxw=120' class='alignleft' />";
  }

  return $new_img_tag;
}