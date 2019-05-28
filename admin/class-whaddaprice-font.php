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

/* funzione per scelta font con key google */

class Whadda_font {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;

    $this->fonts();
  }

  public function fonts() {

    $prefix = $this->metakeypre;
    $key = $prefix . 'key';
    $fonts = $prefix . 'fonts';
    $reg_font = $prefix . 'fonts_js';
    $name_font = $prefix . 'namefont';
    $vari_font = $prefix . 'varifont';
    $stile_o = $prefix . 'stile_o_r';
    $stile_c = $prefix . 'stile_c_r';
    $bold = $prefix . 'boled_r';
    $stile_o_b = $prefix . 'stile_o_b';
    $stile_c_b = $prefix . 'stile_c_b';
    $bold_b = $prefix . 'bold_b';
    $riga_stili = 1;
    $numrow = $this->metakeyrow;


    if (get_the_ID() !== null) {
      if (!isset(get_post_meta(get_the_ID(), $numrow)[0]) || get_post_meta(get_the_ID(), $numrow)[0] == "" || get_post_meta(get_the_ID(), $numrow)[0] < 3)
        $row = 3;
      else
        $row = get_post_meta(get_the_ID(), $numrow)[0];

      if (!isset(get_post_meta(get_the_ID(), $fonts)[0]) || get_post_meta(get_the_ID(), $fonts)[0] == "")
        $nome_ttf = '';
      else
        $nome_ttf = get_post_meta(get_the_ID(), $fonts)[0];

      if (!isset(get_post_meta(get_the_ID(), $name_font)[0]) || get_post_meta(get_the_ID(), $name_font)[0] == "")
        $nome_font = 'Default';
      else
        $nome_font = get_post_meta(get_the_ID(), $name_font)[0];

      if (!isset(get_post_meta(get_the_ID(), $vari_font)[0]) || get_post_meta(get_the_ID(), $vari_font)[0] == "")
        $var_font = '';
      else
        $var_font = get_post_meta(get_the_ID(), $vari_font)[0];

      for ($riga_stili = 1; $riga_stili <= $row; $riga_stili++) { // ciclo su chekbox obloquo per tutte le righe
        $val = $prefix . 'stile_o_r' . ($riga_stili);
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $rigao[$riga_stili] = "";
        } else {
          $rigao[$riga_stili] = "checked";
        }
      }

      for ($riga_stili = 1; $riga_stili <= $row; $riga_stili++) { // ciclo su chekbox corsivo per tutte le righe
        $val = $prefix . 'stile_c_r' . ($riga_stili);
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $rigac[$riga_stili] = "";
        } else {
          $rigac[$riga_stili] = "checked";
        }
      }

      for ($riga_stili = 1; $riga_stili <= $row; $riga_stili++) {// ciclo su chekbox bold  per tutte le righe
        $val = $prefix . 'bold_r' . ($riga_stili);
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $bolder[$riga_stili] = "";
        } else {
          $bolder[$riga_stili] = "checked";
        }
      }
      
       $val = $prefix . 'bold_b';
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $bold_b_ck = "";
        } else {
          $bold_b_ck = "checked";
        }
        
        $val = $prefix . 'stile_o_b';
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $stile_o_b_ck = "";
        } else {
          $stile_o_b_ck = "checked";
        }
        
        $val = $prefix . 'stile_c_b';
        if (!isset(get_post_meta(get_the_ID(), $val)[0]) || get_post_meta(get_the_ID(), $val)[0] == "") {
          $stile_c_b_ck = "";
        } else {
          $stile_c_b_ck = "checked";
        }
    }

    echo '<hr>';
    echo '<div class="divcontfont">';
    echo '<h3>'.esc_html__('Font','whaddaprice').'</h3>';

    /* chiamata a google con credenziali google font key per elenco font disponibili */
    $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . get_option($key);
    $lettura = wp_remote_get('http://www.googleapis.com/webfonts/v1/webfonts?key=' . get_option($key), array('sslverify' => true));
    $lettura = wp_remote_retrieve_body(wp_remote_get($url, array('sslverify' => false)));
    $json_google = json_decode($lettura, true); // creo un json della risposta di google
    // verifico la risposta e genero uno stato di allerta in caso si risposta negativa
    if (isset($json_google['error']) || !isset($json_google)) {
      if (get_option($key) == "") {
        echo __('inserire una key di google fonts in Impostazioni->Whaddaprice','whaddaprice');
      } else
        echo __('Errore di lettura! key non valida o rete non accessibile -','whaddaprice') . $json_google['error']['errors'][0]['reason'] . '-';
    }
    if (!isset($json_google['items'])) {
      $font_google[] = '';
      $option[] = '';
    } else {
      $font_google = $json_google['items'];
      $option = $json_google['items'];
    }
    //genero le select con quanto ricevuto da google
    $scelta = array();
    echo '<div id="tabfont" ><div class="divfont"><p>'.esc_html__('Family','whaddaprice').'</p>';
    echo '<select name="font" id="font" size="5" class="select_vari">';
    if ($font == "")
      echo '<option value="Default" selected >'.esc_html__('Default','whaddaprice').'</option>';
    else
      echo '<option value="Default">'.esc_html__('Default','whaddaprice').'</option>';
    foreach ($font_google as $value => $item) {
      $font = $scelta[$item['family']] = $item['family'];
      if ($font == $nome_font)
        echo '<option value="' . $font . '" selected>' . $font . '</option>'; // al primo avvio l'opzione che sto usando
      else
        echo '<option value="' . $font . '">' . $font . '</option>';
    }
    echo '</select>';
    echo '<p>'.esc_html__('Category','whaddaprice').'</p>';
    echo '<select name="cat" id="cat" class="select_cat"></select></div>';
    echo '<div class="divfont"><p>'.esc_html__('Variants','whaddaprice').'</p>';
    echo '<select name="vari" id="vari" size="5" class="select_vari"></select></div>';
    echo '</div></div>';

    /* carico il font_js per elaborare i dati di google e riempire dinamicamente la select */
    wp_register_script($reg_font, plugin_dir_url(__FILE__) . 'js/fonts_js.js');
    $whadda_fonts = array(
        'rigao' => $rigao, //riga obliqua
        'rigac' => $rigac, //riga corsivo
        'bold' => $bolder, //riga con bold
        'option' => $option, // tutto il contenuto del json
        'varifont' => $var_font, //il variants del font che stiamo usando 
    );
    wp_localize_script($reg_font, 'whadda_fonts', $whadda_fonts);
    wp_enqueue_script($reg_font);

    /* tabella scelte stili*/    
    
    echo '<div class="tabfont">';
    echo '<h3 class="whaddacenter">'.esc_html__('Stili','whaddaprice').'</h3>';
    echo '<table ><tbody id="testare" class="whaddacenter"></tbody></table>';
    echo '<table ><tbody id="testare1" class="whaddacenter">'
    . '<tr>' 
    .'<th></th> '
    .'<th>'.esc_html__('Obliquo','whaddaprice').'</th>' 
    .'<th>'.esc_html__('Corsivo','whaddaprice').'</th>' 
    .'<th>'.esc_html__('Bold','whaddaprice').'</th>' 
    .'</tr>' 
    . '<tr>' 
    .'<td id="nome_"><span id="stile_o_num">'.esc_html__('button','whaddaprice').'</span></td> ' // da terminare -> nomi e salvataggio
    .'<td><input type="checkbox" name="'.$stile_o_b.'" id="'.$stile_o_b.'" value="1" '.$stile_o_b_ck.'></td>' // da terminare -> nomi e salvataggio
    .'<td><input type="checkbox" name="'.$stile_c_b.'" id="'.$stile_c_b.'" value="2" '.$stile_c_b_ck.'></td>' // da terminare -> nomi e salvataggio
    .'<td><input type="checkbox" name="'.$bold_b.'" id="'.$bold_b.'" value="3" '.$bold_b_ck.'></td>' // da terminare -> nomi e salvataggio
    .'</tr>' 
    .'<div class="clear"></div>'
    . '</tbody></table>';
    /* campi nascosti per memorizzare i valori da salvare nel database */
    echo '<input type=text name="' . $fonts . '" id="' . $fonts . '" value="' . $nome_ttf . '" hidden>';
    echo '<input type=text name="' . $name_font . '" id="' . $name_font . '" value="' . $nome_font . '" hidden>';
    echo '<input type=text name="' . $vari_font . '" id="' . $vari_font . '" value="' . $var_font . '" hidden>';
    echo '</div>';
  }

}
