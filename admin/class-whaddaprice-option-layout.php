<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* creo metabox opzioni */

class Whadda_option {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  function __construct() {
    add_action('add_meta_boxes', array($this, 'metabox_opz'));

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;
  }

  public function metabox_opz() {
    $id = $this->metakeypre . 'boxidopz';
    $title = __('opzioni', 'whaddaprice');
    $callback = array($this, 'callback_whaddaprice_opz'); //chiamo funzione per contenuto 
    $page = 'whaddaprice';
    add_meta_box($id, $title, $callback, $page);
  }

  /* funzione che gesticsce richiamo funzioni e classi per campo opzioni */

  public function callback_whaddaprice_opz() {

   // $this->layout(); // chiama la funzione per la scelta layout
    if(get_post_meta(get_the_ID(), 'whadda_on',true)=='ok'){
    $whadda_color = new Whadda_color(); // chiama la classe per scelta colori
    $font = new Whadda_font(); // chiama classe per scelta font
    $angoli = new whadda_angle(); // chiama la classe scelta angoli
    $mar_pad = new whadda_marg_pad(); //chiama la classe scelta margin e padding
    }
  }

  /* funzione per la scelta del layuot */

  public function layout() {

    $prefix = $this->metakeypre;
    $whadda_layout = $prefix . 'layout';
    $numlayout = 4;
    for ($i = 1; $i <= $numlayout; $i++) {
      $layout[$i] = plugin_dir_url(__FILE__) . 'img/layout' . $i . '.jpg';
      ${"whadda_layout_$i"} = $prefix . 'layout_' . $i;
      if ($i == 4)
        ${"whadda_layout_val_$i"} = "checked";
      else
        ${"whadda_layout_val_$i"} = "";
    }

    if (get_the_ID() !== null) {

      if (get_post_meta(get_the_ID(), 'whadda_layout',true)==null || get_post_meta(get_the_ID(), $whadda_layout)[0] == "") {
        for ($i = 1; $i <= $numlayout; $i++) {
          if ($i != 4) { // layout di default -> se non selezionato altro seleziono il 3
            ${"whadda_layout_val_$i"} = "";
          } else {
            ${"whadda_layout_val_$i"} = "checked";
          }
        }
      } else {
        for ($i = 1; $i <= $numlayout; $i++) {
          if ($i != get_post_meta(get_the_ID(), $whadda_layout)[0] * 1) {
            ${"whadda_layout_val_$i"} = "";
          } else {
            $prov = get_post_meta(get_the_ID(), $whadda_layout)[0];
            ${"whadda_layout_val_$prov"} = "checked";
          }
        }
      }
    }
    
    echo '<h3>' . esc_html__('Layout', 'whaddaprice') .'</h3>';
    if(!isset(get_post_meta(get_the_ID(), 'whadda_on')[0]) || get_post_meta(get_the_ID(), 'whadda_on')[0]==""){
    echo '<label style="color:red;">'.esc_html__('Seleziona un layout prima di iniziare e premi su ok','whaddaprice');
    echo '<input type="submit" name="whadda_on" id="whadda_on" value="ok"></label><br/>';
   }
    for ($i = 1; $i <= $numlayout; $i++)
       /*echo '<span class="labelbordi" style="float:left;" id="whadda_sel_radio"><label ><img src="' . $layout[$i] . '"></label><input class="inputbordi" type="radio" name="' . $whadda_layout . '" id="' . ${"whadda_layout_$i"} . '" value="' . $i . '" ' . ${"whadda_layout_val_$i"} . '></span>';*/
       echo '<label class="labelbordi" style="float:left;" data-id="'.$i.'"><img src="' . $layout[$i] .'"><input class="inputbordi" type="radio" name="' . $whadda_layout . '" id="' . ${"whadda_layout_$i"} . '" value="' . $i . '" ' . ${"whadda_layout_val_$i"} . '></label>';

    if(get_post_meta(get_the_ID(), 'whadda_on',true)!=null  && get_post_meta(get_the_ID(), 'whadda_on')[0]=="ok"){
    echo '<div id="whadda_allert" style="float:left; text-align:justify; border:1px solid gray; width:40%;" hidden>'; 
    echo '<p style="color:red;">'.__('ATTENZIONE !! CAMBIARE LAYOUT PUÒ COMPORTARE LA PERDITA DI DATI E/O IMPOSTAZIONI','whaddaprice').'</p>';
    echo '<div style="width:100%; height:auto; display: grid;">';
    echo '<button type="button" id="whadda_dinieg" value="Annulla" autofocus>Annulla (Azione Consigliata)</button>'; 
    echo '<button type="button" id="whadda_confirm" value="Conferma">Conferma</button>'; 
    echo '</div></div>'; 
    }
    echo '<div class="clear"></div>';
      }
    
}
