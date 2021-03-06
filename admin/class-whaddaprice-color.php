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
    $prefix = $this->metakeypre; //carico  prefisso 
    $numcol = $this->metakeycol;  //carico  prefisso colonna
    $numrow = $this->metakeyrow; //carico  prefisso riga
    $colsf = $prefix . 'colsf';
    $colts = $prefix . 'colts';
    $colbr = $prefix . 'colbr';

    if (get_post_meta(get_the_ID(), 'whadda_layout',true)==null || get_post_meta(get_the_ID(), 'whadda_layout')[0] == "")
    $layout = 4;
    else
    $layout = get_post_meta(get_the_ID(), 'whadda_layout')[0];
    $request= file_get_contents( dirname( __FILE__ ) .'/js/layout'.$layout.'.json');
    $dec= json_decode($request);
    ////////////// colori generali di default ////////////////////////
    if (get_the_ID() !== null) {

      if (!isset(get_post_meta(get_the_ID(), $colsf)[0]) || get_post_meta(get_the_ID(), $colsf)[0] == "")
        $coloresf =$dec[0]->$colsf;
      else
        $coloresf = get_post_meta(get_the_ID(), $colsf)[0];

      if (!isset(get_post_meta(get_the_ID(), $colbr)[0]) || get_post_meta(get_the_ID(), $colbr)[0] == "")
        $colorebr = $dec[0]->$colbr;
      else
        $colorebr = get_post_meta(get_the_ID(), $colbr)[0];

      if (!isset(get_post_meta(get_the_ID(), $colts)[0]) || get_post_meta(get_the_ID(), $colts)[0] == "")
        $colorets =$dec[0]->$colts;
      else
        $colorets = get_post_meta(get_the_ID(), $colts)[0];
    } else {
      $coloresf =$dec[0]->$colsf;
      $colorebr =$dec[0]->$colbr;
      $colorets =$dec[0]->$colts;
    }

    //echo '<hr>';
    echo '<h3>'.esc_html__('Colori','whaddaprice').'</h3>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore sfondo','whaddaprice').'<input type="color"  name="' . $colsf . '" id="' . $colsf . '" value="' . $coloresf . '"/></label>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore testo','whaddaprice').'<input type="color"  name="' . $colts . '" id="' . $colts . '" value="' . $colorets . '"/></label>';
    echo '<label for="colsf" class="inpcol">'.esc_html__('colore bordo','whaddaprice').'<input type="color"  name="' . $colbr . '" id="' . $colbr . '" value="' . $colorebr . '"/></label>';

    /////////////////// colori per ogni riga e ogni colonna ///////////////////////
    
    $sfondo = $prefix . 'sfondo';
    $char = $prefix . 'char';
    $reg_fo = $prefix . 'color_js';
    
    if(get_the_ID()!==null){
      
    if (!isset(get_post_meta(get_the_ID(), $numcol)[0]) || get_post_meta(get_the_ID(), $numcol)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 )
    $col = 1;
    else
    $col = get_post_meta(get_the_ID(), $numcol)[0];
     if (!isset(get_post_meta(get_the_ID(), $numrow)[0]) || get_post_meta(get_the_ID(), $numrow)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 )
    $row = $dec[0]->whadda_nrows;
    else
    $row = get_post_meta(get_the_ID(), $numrow)[0];
    for($i=1;$i<=$col;$i++){
              for($r=0;$r<=$row;$r++){
      if (!isset(get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0]) || get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0] == ""){
      $colo=$sfondo.'_c'.$i.'_r'.$r;
      $colore_s[$i][$r] = $dec[0]->$colo;
      }else      
        $colore_s[$i][$r] = get_post_meta(get_the_ID(), $sfondo.'_c'.$i.'_r'.$r)[0];
                                      }
                           }
    
    for($i=1;$i<=$col;$i++){
              for($r=0;$r<=$row;$r++){
      if (!isset(get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0]) || get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0] == ""){
       $colo=$char.'_c'.$i.'_r'.$r;
       $colore_c[$i][$r] = $dec[0]->$colo;
      }else
    $colore_c[$i][$r] = get_post_meta(get_the_ID(), $char.'_c'.$i.'_r'.$r)[0];
                                      }
                           }
    }
    
    echo '<h3>'.esc_html__('Colori vari','whaddaprice').'</h3>';
    $testi=[__('Tabella','whaddaprice'),__('Sfondo','whaddaprice'),__('Testo','whaddaprice'),__('button','whaddaprice'),__('riga','whaddaprice')];
     wp_register_script($reg_fo, plugin_dir_url(__FILE__) . 'js/color.js');
    $whadda_color = array(
        'color_s'=>$colore_s,
        'color_c'=>$colore_c,
        'testi'=>$testi
    );
    wp_localize_script($reg_fo, 'whadda_color', $whadda_color);
    wp_enqueue_script($reg_fo);
   
   echo '<div id="coloritab"></div>';
   echo '<div class="clear"></div>';
   echo '<span id="whadda_sets" data-id="'.$dec[0]->whadda_sfondo_c_r.'" hidden></span>';
   echo '<span id="whadda_setc" data-id="'.$dec[0]->whadda_char_c_r.'" hidden></span>';

}
}
