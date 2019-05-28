<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* funzione per scelta colori */

class Whadda_color {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;
    $this->colori();
  }

  public function colori() {
    $prefix = $this->metakeypre;
    $colsf = $prefix . 'colsf';
    $colts = $prefix . 'colts';
    $colbr = $prefix . 'colbr';

    if (get_the_ID() !== null) {

      if (!isset(get_post_meta(get_the_ID(), $colsf)[0]) || get_post_meta(get_the_ID(), $colsf)[0] == "")
        $coloresf = '#000000';
      else
        $coloresf = get_post_meta(get_the_ID(), $colsf)[0];

      if (!isset(get_post_meta(get_the_ID(), $colbr)[0]) || get_post_meta(get_the_ID(), $colbr)[0] == "")
        $colorebr = '#000000';
      else
        $colorebr = get_post_meta(get_the_ID(), $colbr)[0];

      if (!isset(get_post_meta(get_the_ID(), $colts)[0]) || get_post_meta(get_the_ID(), $colts)[0] == "")
        $colorets = '#000000';
      else
        $colorets = get_post_meta(get_the_ID(), $colts)[0];
    } else {
      $coloresf = '#000000';
      $colorebr = '#000000';
      $colorets = '#000000';
    }

    echo '<hr>';
    echo '<h3>'.esc_html__('Colori','whaddaprice').'</h3>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore sfondo','whaddaprice').'<input type="color"  name="' . $colsf . '" id="' . $colsf . '" value="' . $coloresf . '"/></label>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore testo','whaddaprice').'<input type="color"  name="' . $colts . '" id="' . $colts . '" value="' . $colorets . '"/></label>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore bordo','whaddaprice').'<input type="color"  name="' . $colbr . '" id="' . $colbr . '" value="' . $colorebr . '"/></label>';
  }

}
