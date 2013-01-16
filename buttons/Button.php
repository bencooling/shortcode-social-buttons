<?php

class Button {

   // getters and setters for public properies
   public function __get($prop) {
    if( array_key_exists($prop, get_object_vars($this)) ) return $this->$prop;
   }    
   public function __set($prop, $val) {
    if( array_key_exists($prop, get_object_vars($this)) ) $this->$prop = $val;
   }

}