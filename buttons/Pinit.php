<?php

class sso_Pinit extends Button {
  
  /* @see https://pinterest.com/about/goodies/ for required code */
  public function add_shortcode(){
    global $post;

$tpl = <<<TPL
<a href="http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s" class="pin-it-button" count-layout="horizontal">
  <img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
</a>
TPL;
    $full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    return sprintf($tpl, get_permalink($post->ID), $full[0], $post->post_excerpt);
  }

  public function wp_head(){
    return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
  }

}