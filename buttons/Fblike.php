<?php

class sso_Fblike extends Button {
  // css fix for fb .fb-like span{overflow:visible !important; width:450px !important; margin-right:-375px;}
  // @see http://developers.facebook.com/docs/reference/plugins/like/ for required code
  public function add_shortcode(){
    global $post;
    return sprintf('<div class="fb-like" data-href="http://bcooling.com.au" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>', get_permalink($post->ID));
  }

  /* ideally right after the opening <body> tag. */
  public function open_body(){
return <<<SCRIPT
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
SCRIPT;
  }

  public function wp_head(){
    global $post;
$tpl = <<<TPL
<meta property="og:title" content="%s" />
<meta property="og:site_name" content="%s" />
<meta property="og:image" content="%s" />
TPL;
    $full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    return sprintf("\n" . $tpl . "\n", $post->post_title, get_bloginfo('name'), $full[0]);
  }

}