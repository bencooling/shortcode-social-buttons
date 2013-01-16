<?php

class sso_Public {
  
  protected $_btns = array('pinit', 'fblike');

  public function __construct(){
    add_action('wp_head', array($this, 'wp_head'));
    add_action('open_body', array($this, 'open_body'));

    foreach($this->_btns as $btn){
      $this->add_shortcode($btn);
    }
  }

  public function wp_head(){
    foreach($this->_btns as $btn){
      $classname = 'sso_' . ucwords($btn);
      $socialmedia = new $classname;
      if (method_exists($socialmedia, 'wp_head')) echo $socialmedia->wp_head();
    }
  }

  public function open_body(){
    foreach($this->_btns as $btn){
      $classname = 'sso_' . ucwords($btn);
      $socialmedia = new $classname;
      if (method_exists($socialmedia, 'open_body')) echo $socialmedia->open_body();
    }
  }

  public function add_shortcode($btn){
    $classname = 'sso_' . ucwords($btn);
    add_shortcode( $btn, array($classname, 'add_shortcode') );
  }

}