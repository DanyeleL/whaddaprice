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
    $numcol = $this->metakeycol;  //carico  prefisso colonna
    $numrow = $this->metakeyrow;
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
  

//////////////////////* IN TEST */////////////////////////////////
    
    $sfondo = $prefix . 'sfondo';
    $char = $prefix . 'char';
    $reg_fo = $prefix . 'color_js';
    
    if(get_the_ID()!==null){
      
    if (!isset(get_post_meta(get_the_ID(), $numcol)[0]) || get_post_meta(get_the_ID(), $numcol)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 )
    $col = 1;
    else
    $col = get_post_meta(get_the_ID(), $numcol)[0];
     if (!isset(get_post_meta(get_the_ID(), $numrow)[0]) || get_post_meta(get_the_ID(), $numrow)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 )
    $row = 3;
    else
    $row = get_post_meta(get_the_ID(), $numrow)[0];
    for($i=0;$i<=$col;$i++){
              for($r=0;$r<=$row;$r++){
      if (!isset(get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0]) || get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0] == "")
    $colore_s[$i][$r] = '#ffffff';
    else
    $colore_s[$i][$r] = get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0];
                                      }
                           }
    
    for($i=0;$i<=$col;$i++){
              for($r=0;$r<=$row;$r++){
      if (!isset(get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0]) || get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0] == "")
    $colore_c[$i][$r] = '#000000';
    else
    $colore_c[$i][$r] = get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0];
                                      }
                           }
    }
    
    echo '<h3>'.esc_html__('Colori vari','whaddaprice').'</h3>';
   /* echo __('Colonna','whaddaprice').'<select name="test" id="test">';
    for($i=0;$i<1;$i++){ // ciclo per numero colonne in section
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
    echo '</select>';*/
    
     wp_register_script($reg_fo, plugin_dir_url(__FILE__) . 'js/color.js');
    $whadda_color = array(
        'color_s'=>$colore_s,
        'color_c'=>$colore_c,
    );
    wp_localize_script($reg_fo, 'whadda_color', $whadda_color);
    wp_enqueue_script($reg_fo);
   
   echo '<div id="coloritab"></div>';
   echo '<div class="clear"></div>';
   //echo '<table ><tbody id="testare2" class="whaddacenter"></tbody></table>';
   //echo '<div id="tab_but"></div>';

    }

}
