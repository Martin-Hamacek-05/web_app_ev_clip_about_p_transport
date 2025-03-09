<?php


class Personalization {
  // Properties
  public $name;
  public $owner;
  public $banner;

  
  function set_name($name) {
    $this->name = $name;
  }
  
  function get_name() {
    return $this->name;
  }
  
  function set_owner($owner) {
    $this->owner = $owner;
  }
  
  function get_owner() {
    return $this->owner;
  }
  
  function set_banner($banner) {
    $this->banner = $banner;
  }
  
  function get_banner() {
    return $this->banner;
  }
  
  
}
?>