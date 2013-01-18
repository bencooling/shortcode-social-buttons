<?php

class sso_Fbfollow extends Button {
  // @see http://developers.facebook.com/docs/reference/plugins/like/ for required code
  public function add_shortcode($attr){
    if (!isset($attr['url'])) return false;
    return sprintf( '<div class="fb-follow" data-href="%s" data-show-faces="true" data-width="450"></div>', $attr['url'] );
  }

  /* ideally right after the opening <body> tag. */
  public function open_body(){
return <<<TPL
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
TPL;
  }

}