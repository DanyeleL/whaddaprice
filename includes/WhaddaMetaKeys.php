<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WhaddaVars
 *
 * @author lucio
 */
class WhaddaMetaKeys {

  const PREFIX = "whadda_";
  const NUMBER_OF_COLUMNS = self::PREFIX . "ncols";
  const NUMBER_OF_ROWS = self::PREFIX . "nrows";
 
}

class WhaddaShortcode {
 
  function __construct() {
  add_shortcode("whaddaprice", 'jb_shortcode_de_contenido');
 
  }
  /*creo lo shortcode ma solo nella sua struttura da pallicare a pagine o post => [whaddaprice id=numid] */
  public function shortbox_metabox_callback() {
    $prefix = WhaddaMetaKeys::PREFIX;
    $test = '[whaddaprice id=&quot;' . get_post()->ID . '&quot;]';
    echo '<input type="text" id="' . $prefix . 'short" name="' . $prefix . 'short" value="' . $test . '" readonly/>';
  }

}
  
 
  