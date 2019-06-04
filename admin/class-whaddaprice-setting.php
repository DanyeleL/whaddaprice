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

/* genero sottomenu campo impostazioni per salvare key di google */

class Whadda_setting {

  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;

  public function __construct() {

    add_action('admin_menu', array($this, 'mykey'));

    add_action('admin_init', array($this, 'register_mykey'));

    $this->metakeypre = WhaddaMetaKeys::PREFIX;
    $this->metakeycol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $this->metakeyrow = WhaddaMetaKeys::NUMBER_OF_ROWS;
  }

  public function mykey() {
    //creo nuovo menù
    add_submenu_page(
            'options-general.php',
            'Whaddaprice_option',
            'Whaddaprice',
            'administrator',
            'mysettings',
            array(
                $this, 'mykey_settings_page'
            )
    );
  }

  public function register_mykey() {
    $prefix = $this->metakeypre;
    $key = $prefix . 'key';
    register_setting('Key_Fonts', $key);
  }

  /* genero contenuto con campi per scrivere e salvare il key di google font */

  public function mykey_settings_page() {
    $prefix = $this->metakeypre;
    $key = $prefix . 'key';
    echo '<h2>Google fonts Key</h2>';
    echo '<form method="post" action="options.php">';
    settings_fields('Key_Fonts');
    do_settings_sections('Key_Fonts');
    echo '<input type="text" name="' . $key . '" value="' . get_option($key) . '" />';
    submit_button();
    echo '</form>';
  }

}
