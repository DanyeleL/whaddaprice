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

/* classe gestione angoli bordi */

class Whadda_angle {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;

    $this->whadda_angoli();
  }
//funzione per la gestione del raggio angoli
  public function whadda_angoli() {
    $prefix = $this->metakeypre;
    $borer_radius = $prefix . 'border_radius';
    $border_on = $prefix . 'border_on';
    
    if (get_post_meta(get_the_ID(), 'whadda_layout',true)==null || get_post_meta(get_the_ID(), 'whadda_layout')[0] == "")
    $layout = 4;
    else
    $layout = get_post_meta(get_the_ID(), 'whadda_layout')[0];
    $request= file_get_contents( dirname( __FILE__ ) .'/js/layout'.$layout.'.json');
    $dec= json_decode($request);
    
    if (get_the_ID() !== null) {

      if (!isset(get_post_meta(get_the_ID(), $borer_radius)[0]) || get_post_meta(get_the_ID(), $borer_radius)[0] == "")
        $radius = $dec[0]->whadda_border_radius;
      else
        $radius = get_post_meta(get_the_ID(), $borer_radius)[0];

      if (!isset(get_post_meta(get_the_ID(), $border_on)[0]) || get_post_meta(get_the_ID(), $border_on)[0] == 0)
        $border_val = $dec[0]->whadda_border_on;
      else
        $border_val = "checked";
    }
    
    echo '<div class="clear" >';
    echo '<hr>';
    echo '<h3>'.esc_html__('Angoli e Bordi','whaddaprice').'</h3>';
    echo '<div class="div_cont_angoli">';
    echo '<label>'.esc_html__('Raggio','whaddaprice').'<select nome="angoli" id="select_bordi" class="angoli"></label>';
    echo '<option value="manuale">'.__('manuale','whaddaprice').'</option>';
    echo '<option value="nessuno">'.__('nessuno','whaddaprice').'</option>';
    echo '<option value="poco">'.__('poco','whaddaprice').'</option>';
    echo '<option value="medio">'.__('medio','whaddaprice').'</option>';
    echo '<option value="tanto">'.__('tanto','whaddaprice').'</option>';
    echo '</select>';
    echo '</div>';
    echo '<div class="div_cont_angoli">';
    echo '<label>'.esc_html__('Misura','whaddaprice').'</label><input class="angoli" type="text" name="' . $borer_radius . '" id="' . $borer_radius . '" value="' . $radius . '" >';
    echo '</div>';
   // echo '<div class="divangoli"></div>';
    echo '<div class="clear"></div>';
    echo '<div>';
    echo '<label class="labelbordi">'.esc_html__('Bordi','whaddaprice').'<br/>'.esc_html__('(checked sì/ vuoto no)','whaddaprice').'<input class="inputbordi" type="checkbox" name="' . $border_on . '" id="' . $border_on . '"' . $border_val . '></label>';
    echo '</div></div>';
  }

}
