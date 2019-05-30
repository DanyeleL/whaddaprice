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
/* Salvo i dati presenti negli input del cpt */

class Whadda_save {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {
    add_action("save_post", array($this, 'save_whaddaprice_meta_box'));

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;
  }

  function save_whaddaprice_meta_box($font) {

    if (!current_user_can("edit_post", get_the_ID()))
      return get_the_ID();

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
      return get_the_ID();
    $slug = "whaddaprice";

    if ($slug != 'whaddaprice')
      return get_the_ID();

    $post_id = get_the_ID();
    $prefix = $this->metakeypre;
    $numcol = $this->metakeycol;
    $numrow = $this->metakeyrow;
    $short = $prefix . 'short';
    $colsf = $prefix . 'colsf';
    $colts = $prefix . 'colts';
    $colbr = $prefix . 'colbr';
    $fonts = $prefix . 'fonts';
    $evidenza = $prefix . 'colev';
    $nome_font = $prefix . 'namefont';
    $vari_font = $prefix . 'varifont';
    $borer_radius = $prefix . 'border_radius';
    $border_on = $prefix . 'border_on';
    $margin_top_c = $prefix . 'margin_top_c';
    $margin_right_c = $prefix . 'margin_right_c';
    $margin_bottom_c = $prefix . 'margin_bottom_c';
    $margin_left_c = $prefix . 'margin_left_c';
    $padding_top_c = $prefix . 'padding_top_c';
    $padding_right_c = $prefix . 'padding_right_c';
    $padding_bottom_c = $prefix . 'padding_bottom_c';
    $padding_left_c = $prefix . 'padding_left_c';
    $margin_top_r = $prefix . 'margin_top_r';
    $margin_right_r = $prefix . 'margin_right_r';
    $margin_bottom_r = $prefix . 'margin_bottom_r';
    $margin_left_r = $prefix . 'margin_left_r';
    $padding_top_r = $prefix . 'padding_top_r';
    $padding_right_r = $prefix . 'padding_right_r';
    $padding_bottom_r = $prefix . 'padding_bottom_r';
    $padding_left_r = $prefix . 'padding_left_r';
    $whadda_layout = $prefix . 'layout';
    $stile_o_b = $prefix . 'stile_o_b';
    $stile_c_b = $prefix . 'stile_c_b';
    $bold_b = $prefix . 'bold_b';
    $sfondo = $prefix . 'sfondo';
    $char = $prefix . 'char';
    $meta_box_text_value = "";
    $meta_box_select_value = "";
    $meta_box_checkbox_value = "";
    $meta_box_numrow_value = "";
    $meta_box_numcol_value = "";
    $meta_box_url_value = "";
    $meta_box_short_value = "";
    $meta_box_colsf_value = "";
    $meta_box_colts_value = "";
    $meta_box_colbr_value = "";
    $meta_box_fonts_value = "";
    $meta_box_nome_fonts_value = "";
    $meta_box_vari_fonts_value = "";
    $meta_box_border_radius_value = "";
    $meta_box_border_on_value = 0;
    $meta_box_margin_top_c_value = 0;
    $meta_box_margin_right_c_value = 0;
    $meta_box_margin_bottom_c_value = 0;
    $meta_box_margin_left_c_value = 0;
    $meta_box_padding_top_c_value = 0;
    $meta_box_padding_right_c_value = 0;
    $meta_box_padding_bottom_c_value = 0;
    $meta_box_padding_left_c_value = 0;
    $meta_box_margin_top_r_value = 0;
    $meta_box_margin_right_r_value = 0;
    $meta_box_margin_bottom_r_value = 0;
    $meta_box_margin_left_r_value = 0;
    $meta_box_padding_top_r_value = 0;
    $meta_box_padding_right_r_value = 0;
    $meta_box_padding_bottom_r_value = 0;
    $meta_box_padding_left_r_value = 0;
    $meta_box_layout_value = "";
    $meta_box_stile_o_r_value = "";
    $meta_box_stile_c_r_value = "";
    $meta_box_bold_r_value = "";
    $meta_box_colev_value = "";
    $meta_box_stile_o_b_value = "";
    $meta_box_stile_c_b_value = "";
    $meta_box_bold_b_value = "";
    $meta_box_sfondo_value = "";
    $meta_box_char_value = "";
    
    
    if (isset($_POST[$stile_o_b])) {
          $meta_box_stile_o_b_value = $_POST[$stile_o_b];
        } else
          $meta_box_stile_o_b_value = "";
        update_post_meta($post_id, $stile_o_b, $meta_box_stile_o_b_value);
        
    if (isset($_POST[$stile_c_b])) {
          $meta_box_stile_c_b_value = $_POST[$stile_c_b];
        } else
          $meta_box_stile_c_b_value = "";
        update_post_meta($post_id, $stile_c_b, $meta_box_stile_c_b_value);
        
    if (isset($_POST[$bold_b])) {
          $meta_box_bold_b_value = $_POST[$bold_b];
        } else
          $meta_box_bold_b_value = "";
        update_post_meta($post_id, $bold_b, $meta_box_bold_b_value);

    if (isset($_POST[$evidenza])) {
      if ($_POST[$evidenza] == "")
        $meta_box_colev_value = 0;
      else
        $meta_box_colev_value = $_POST[$evidenza];
    }
    update_post_meta($post_id, $evidenza, $meta_box_colev_value);

    if (isset($_POST[$numrow])) {
      $meta_box_numrow_value = $_POST[$numrow];
    }
    update_post_meta($post_id, $numrow, $meta_box_numrow_value);

    if (isset($_POST[$numcol])) {
      $meta_box_numcol_value = $_POST[$numcol];
    }
    update_post_meta($post_id, $numcol, $meta_box_numcol_value);

    if (isset($_POST[$short])) {
      $meta_box_short_value = $_POST[$short];
    }
    update_post_meta($post_id, $short, $meta_box_short_value);

    for ($colonna = 1; $colonna <= $meta_box_numcol_value; $colonna++) {
      $riga = 1;
      $url = $prefix . 'c' . $colonna;
      if (isset($_POST[$url])) {
        $meta_box_url_value = $_POST[$url];
      }
      update_post_meta($post_id, $url, $meta_box_url_value);

      while ($riga <= $meta_box_numrow_value && $meta_box_numrow_value != "") {
        $val = $prefix . 'c' . $colonna . '_r' . ($riga++);
        if (isset($_POST[$val])) {
          $meta_box_text_value = $_POST[$val];
        }
        update_post_meta($post_id, $val, $meta_box_text_value);
      }
    }

    if (isset($_POST[$colsf])) {
      $meta_box_colsf_value = $_POST[$colsf];
    }
    update_post_meta($post_id, $colsf, $meta_box_colsf_value);

    if (isset($_POST[$colts])) {
      $meta_box_colts_value = $_POST[$colts];
    }
    update_post_meta($post_id, $colts, $meta_box_colts_value);

    if (isset($_POST[$colbr])) {
      $meta_box_colbr_value = $_POST[$colbr];
    }
    update_post_meta($post_id, $colbr, $meta_box_colbr_value);

    if (isset($_POST[$fonts])) {
      $meta_box_fonts_value = $_POST[$fonts];
    }
    update_post_meta($post_id, $fonts, $meta_box_fonts_value);

    if (isset($_POST[$nome_font])) {
      $meta_box_nome_fonts_value = $_POST[$nome_font];
    }
    update_post_meta($post_id, $nome_font, $meta_box_nome_fonts_value);

    if (isset($_POST[$vari_font])) {
      $meta_box_vari_fonts_value = $_POST[$vari_font];
    }
    update_post_meta($post_id, $vari_font, $meta_box_vari_fonts_value);

    if (isset($_POST[$borer_radius])) {
      $meta_box_border_radius_value = $_POST[$borer_radius];
    }
    update_post_meta($post_id, $borer_radius, $meta_box_border_radius_value);

    if (isset($_POST[$border_on])) {
      $meta_box_border_on_value = $_POST[$border_on] + 1;
    }
    update_post_meta($post_id, $border_on, $meta_box_border_on_value);

    if (isset($_POST[$margin_top_c])) {
      $meta_box_margin_top_c_value = $_POST[$margin_top_c];
    }
    update_post_meta($post_id, $margin_top_c, $meta_box_margin_top_c_value);

    if (isset($_POST[$margin_right_c])) {
      $meta_box_margin_right_c_value = $_POST[$margin_right_c];
    }
    update_post_meta($post_id, $margin_right_c, $meta_box_margin_right_c_value);

    if (isset($_POST[$margin_bottom_c])) {
      $meta_box_margin_bottom_c_value = $_POST[$margin_bottom_c];
    }
    update_post_meta($post_id, $margin_bottom_c, $meta_box_margin_bottom_c_value);

    if (isset($_POST[$margin_left_c])) {
      $meta_box_margin_left_c_value = $_POST[$margin_left_c];
    }
    update_post_meta($post_id, $margin_left_c, $meta_box_margin_left_c_value);

    if (isset($_POST[$padding_top_c])) {
      $meta_box_padding_top_c_value = $_POST[$padding_top_c];
    }
    update_post_meta($post_id, $padding_top_c, $meta_box_padding_top_c_value);

    if (isset($_POST[$padding_right_c])) {
      $meta_box_padding_right_c_value = $_POST[$padding_right_c];
    }
    update_post_meta($post_id, $padding_right_c, $meta_box_padding_right_c_value);

    if (isset($_POST[$padding_bottom_c])) {
      $meta_box_padding_bottom_c_value = $_POST[$padding_bottom_c];
    }
    update_post_meta($post_id, $padding_bottom_c, $meta_box_padding_bottom_c_value);

    if (isset($_POST[$padding_left_c])) {
      $meta_box_padding_left_c_value = $_POST[$padding_left_c];
    }
    update_post_meta($post_id, $padding_left_c, $meta_box_padding_left_c_value);

    if (isset($_POST[$margin_top_r])) {
      $meta_box_margin_top_r_value = $_POST[$margin_top_r];
    }
    update_post_meta($post_id, $margin_top_r, $meta_box_margin_top_r_value);

    if (isset($_POST[$margin_right_r])) {
      $meta_box_margin_right_r_value = $_POST[$margin_right_r];
    }
    update_post_meta($post_id, $margin_right_r, $meta_box_margin_right_r_value);

    if (isset($_POST[$margin_bottom_r])) {
      $meta_box_margin_bottom_r_value = $_POST[$margin_bottom_r];
    }
    update_post_meta($post_id, $margin_bottom_r, $meta_box_margin_bottom_r_value);

    if (isset($_POST[$margin_left_r])) {
      $meta_box_margin_left_r_value = $_POST[$margin_left_r];
    }
    update_post_meta($post_id, $margin_left_r, $meta_box_margin_left_r_value);

    if (isset($_POST[$padding_top_r])) {
      $meta_box_padding_top_r_value = $_POST[$padding_top_r];
    }
    update_post_meta($post_id, $padding_top_r, $meta_box_padding_top_r_value);

    if (isset($_POST[$padding_right_r])) {
      $meta_box_padding_right_r_value = $_POST[$padding_right_r];
    }
    update_post_meta($post_id, $padding_right_r, $meta_box_padding_right_r_value);

    if (isset($_POST[$padding_bottom_r])) {
      $meta_box_padding_bottom_r_value = $_POST[$padding_bottom_r];
    }
    update_post_meta($post_id, $padding_bottom_r, $meta_box_padding_bottom_r_value);

    if (isset($_POST[$padding_left_r])) {
      $meta_box_padding_left_r_value = $_POST[$padding_left_r];
    }
    update_post_meta($post_id, $padding_left_r, $meta_box_padding_left_r_value);

    if (isset($_POST[$whadda_layout])) {
      $meta_box_layout_value = $_POST[$whadda_layout];
    }
    update_post_meta($post_id, $whadda_layout, $meta_box_layout_value);

    if ($meta_box_numrow_value != "") {

      for ($riga_stile = 1; $riga_stile <= $meta_box_numrow_value; $riga_stile++) {
        $val = $prefix . 'stile_o_r' . ($riga_stile);
        if (isset($_POST[$val])) {
          $meta_box_stile_o_r_value = $_POST[$val];
        } else
          $meta_box_stile_o_r_value = "";
        update_post_meta($post_id, $val, $meta_box_stile_o_r_value);
      }

      for ($riga_stile = 1; $riga_stile <= $meta_box_numrow_value; $riga_stile++) {
        $val = $prefix . 'stile_c_r' . ($riga_stile);
        if (isset($_POST[$val])) {
          $meta_box_stile_c_r_value = $_POST[$val];
        } else
          $meta_box_stile_c_r_value = "";
        update_post_meta($post_id, $val, $meta_box_stile_c_r_value);
      }

      for ($riga_stile = 1; $riga_stile <= $meta_box_numrow_value; $riga_stile++) {
        $val = $prefix . 'bold_r' . ($riga_stile);
        if (isset($_POST[$val])) {
          $meta_box_bold_r_value = $_POST[$val];
        } else
          $meta_box_bold_r_value = "";
        update_post_meta($post_id, $val, $meta_box_bold_r_value);
      }
    }
    
    
    if ($meta_box_numrow_value != "" && $meta_box_numcol_value != "") {

      for ($colsf = 0; $colsf <= $meta_box_numcol_value; $colsf++) {
        for ($rigsf = 0; $rigsf <= $meta_box_numrow_value; $rigsf++){
          $val = $sfondo.'_c'.$colsf.'_r'.$rigsf;
          if (isset($_POST[$val])) {
          $meta_box_sfondo_value = $_POST[$val];
        } else
          $meta_box_sfondo_value = "#ffffff";
        update_post_meta($post_id, $val, $meta_box_sfondo_value);
          } 
      }

      for ($colsf = 0; $colsf <= $meta_box_numcol_value; $colsf++) {
        for ($rigsf = 0; $rigsf <= $meta_box_numrow_value; $rigsf++){
          $val = $char.'_c'.$colsf.'_r'.$rigsf;
          if (isset($_POST[$val])) {
          $meta_box_char_value = $_POST[$val];
        } else
          $meta_box_char_value = "#000000";
        update_post_meta($post_id, $val, $meta_box_char_value);
          } 
      }

    }
    
  }

}
