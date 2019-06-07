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

/* gestione margini e padding delle colonne */

class Whadda_marg_pad {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;

    $this->whadda_marg_pad();
  }

  public function whadda_marg_pad() {

    $prefix = $this->metakeypre;
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

    if (get_the_ID() !== null) {

      if (!isset(get_post_meta(get_the_ID(), $margin_top_c)[0]) || get_post_meta(get_the_ID(), $margin_top_c)[0] == "")
        $mtop_c = 0;
      else
        $mtop_c = get_post_meta(get_the_ID(), $margin_top_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_right_c)[0]) || get_post_meta(get_the_ID(), $margin_right_c)[0] == 0)
        $mright_c = 0;
      else
        $mright_c = get_post_meta(get_the_ID(), $margin_right_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_bottom_c)[0]) || get_post_meta(get_the_ID(), $margin_bottom_c)[0] == "")
        $mbottom_c = 0;
      else
        $mbottom_c = get_post_meta(get_the_ID(), $margin_bottom_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_left_c)[0]) || get_post_meta(get_the_ID(), $margin_left_c)[0] == 0)
        $mleft_c = 0;
      else
        $mleft_c = get_post_meta(get_the_ID(), $margin_left_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_top_c)[0]) || get_post_meta(get_the_ID(), $padding_top_c)[0] == "")
        $ptop_c = 0;
      else
        $ptop_c = get_post_meta(get_the_ID(), $padding_top_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_right_c)[0]) || get_post_meta(get_the_ID(), $padding_right_c)[0] == 0)
        $pright_c = 0;
      else
        $pright_c = get_post_meta(get_the_ID(), $padding_right_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_bottom_c)[0]) || get_post_meta(get_the_ID(), $padding_bottom_c)[0] == "")
        $pbottom_c = 0;
      else
        $pbottom_c = get_post_meta(get_the_ID(), $padding_bottom_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_left_c)[0]) || get_post_meta(get_the_ID(), $padding_left_c)[0] == 0)
        $pleft_c = 0;
      else
        $pleft_c = get_post_meta(get_the_ID(), $padding_left_c)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_top_r)[0]) || get_post_meta(get_the_ID(), $margin_top_r)[0] == "")
        $mtop_r = 0;
      else
        $mtop_r = get_post_meta(get_the_ID(), $margin_top_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_right_r)[0]) || get_post_meta(get_the_ID(), $margin_right_r)[0] == 0)
        $mright_r = 0;
      else
        $mright_r = get_post_meta(get_the_ID(), $margin_right_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_bottom_r)[0]) || get_post_meta(get_the_ID(), $margin_bottom_r)[0] == "")
        $mbottom_r = 0;
      else
        $mbottom_r = get_post_meta(get_the_ID(), $margin_bottom_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $margin_left_r)[0]) || get_post_meta(get_the_ID(), $margin_left_r)[0] == 0)
        $mleft_r = 0;
      else
        $mleft_r = get_post_meta(get_the_ID(), $margin_left_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_top_r)[0]) || get_post_meta(get_the_ID(), $padding_top_r)[0] == "")
        $ptop_r = 0;
      else
        $ptop_r = get_post_meta(get_the_ID(), $padding_top_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_right_r)[0]) || get_post_meta(get_the_ID(), $padding_right_r)[0] == 0)
        $pright_r = 0;
      else
        $pright_r = get_post_meta(get_the_ID(), $padding_right_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_bottom_r)[0]) || get_post_meta(get_the_ID(), $padding_bottom_r)[0] == "")
        $pbottom_r = 0;
      else
        $pbottom_r = get_post_meta(get_the_ID(), $padding_bottom_r)[0];

      if (!isset(get_post_meta(get_the_ID(), $padding_left_r)[0]) || get_post_meta(get_the_ID(), $padding_left_r)[0] == 0)
        $pleft_r = 0;
      else
        $pleft_r = get_post_meta(get_the_ID(), $padding_left_r)[0];
    }

    echo '<div>';
    echo '<hr>';
    echo '<h3>'.esc_html__('Margin e Padding -RIGHE-','whaddaprice').'</h3>';
    echo '<div class="mprighempcol">';
    echo '<p>'.esc_html__('margin-top','whaddaprice').'</p><input type="text" name="' . $margin_top_r . '" id="' . $margin_top_r . '" value="' . $mtop_r . '">';
    echo '<p>'.esc_html__('margin-right','whaddaprice').'</p><input type="text" name="' . $margin_right_r . '" id="' . $margin_right_r . '" value="' . $mright_r . '">';
    echo '<p>'.esc_html__('margin-bottom','whaddaprice').'</p><input type="text" name="' . $margin_bottom_r . '" id="' . $margin_bottom_r . '" value="' . $mbottom_r . '">';
    echo '<p>'.esc_html__('margin-left','whaddaprice').'</p><input type="text" name="' . $margin_left_r . '" id="' . $margin_left_r . '" value="' . $mleft_r . '">';
    echo '</div>';
    echo '<div class="mprighempcol">';
    echo '<p>'.esc_html__('padding-top','whaddaprice').'</p><input type="text" name="' . $padding_top_r . '" id="' . $padding_top_r . '" value="' . $ptop_r . '">';
    echo '<p>'.esc_html__('padding-right','whaddaprice').'</p><input type="text" name="' . $padding_right_r . '" id="' . $padding_right_r . '" value="' . $pright_r . '">';
    echo '<p>'.esc_html__('padding-bottom','whaddaprice').'</p><input type="text" name="' . $padding_bottom_r . '" id="' . $padding_bottom_r . '" value="' . $pbottom_r . '">';
    echo '<p>'.esc_html__('padding-left','whaddaprice').'</p><input type="text" name="' . $padding_left_r . '" id="' . $padding_left_r . '" value="' . $pleft_r . '">';
    echo '</div></div>';
    echo '<div class="clear"></div>';
    echo '<div>';
    echo '<h3>'.esc_html__('Margin e Padding -COLONNE-','whaddaprice').'</h3>';
    echo '<div class="mprighempcol">';
    echo '<p>'.esc_html__('margin-top','whaddaprice').'</p><input type="text" name="' . $margin_top_c . '" id="' . $margin_top_c . '" value="' . $mtop_c . '">';
    echo '<p>'.esc_html__('margin-right','whaddaprice').'</p><input type="text" name="' . $margin_right_c . '" id="' . $margin_right_c . '" value="' . $mright_c . '">';
    echo '<p>'.esc_html__('margin-bottom','whaddaprice').'</p><input type="text" name="' . $margin_bottom_c . '" id="' . $margin_bottom_c . '" value="' . $mbottom_c . '">';
    echo '<p>'.esc_html__('padding-left','whaddaprice').'</p><input type="text" name="' . $margin_left_c . '" id="' . $margin_left_c . '" value="' . $mleft_c . '">';
    echo '</div>';
    echo '<div class="mprighempcol">';
    echo '<p>'.esc_html__('padding-top','whaddaprice').'</p><input type="text" name="' . $padding_top_c . '" id="' . $padding_top_c . '" value="' . $ptop_c . '">';
    echo '<p>'.esc_html__('margin-right','whaddaprice').'</p><input type="text" name="' . $padding_right_c . '" id="' . $padding_right_c . '" value="' . $pright_c . '">';
    echo '<p>'.esc_html__('margin-bottom','whaddaprice').'</p><input type="text" name="' . $padding_bottom_c . '" id="' . $padding_bottom_c . '" value="' . $pbottom_c . '">';
    echo '<p>'.esc_html__('padding-left','whaddaprice').'</p><input type="text" name="' . $padding_left_c . '" id="' . $padding_left_c . '" value="' . $pleft_c . '">';
    echo '</div></div>';
    echo '<div class="clear"></div>';
  }

}
