<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.virtualbit.it
 * @since      1.0.0
 *
 * @package    Whaddaprice
 * @subpackage Whaddaprice/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whaddaprice
 * @subpackage Whaddaprice/admin
 * @author     Lucio Crusca <lucio@sulweb.org>
 */
class Whaddaprice_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Whaddaprice_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Whaddaprice_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */
    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/whaddaprice-admin.css', array(), $this->version, 'all');
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Whaddaprice_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Whaddaprice_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */
    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/whaddaprice-admin.js', array('jquery'), $this->version, false);
  }
  
}

class Waddaprice_panel{
  
   /* -----------Inizio custom-------------------- */

  public function waddaprice_custom_post_type() {
    register_post_type('waddaprice',
            array(
                'labels' => array(
                    'name' => __('waddaprices'),
                    'singular_name' => __('waddaprice'),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'waddaprices'),
            )
    );
  }

  public function metabox() {
    $id = WhaddaMetaKeys::PREFIX . 'boxid';
    $title = 'Tabella';
    $callback = ['Waddaprice_panel', 'callback_waddaprice'];
    $page = 'waddaprice';
    add_meta_box($id, $title, $callback, $page);
  }

  public function callback_waddaprice() {
    $numcol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $numrow = WhaddaMetaKeys::NUMBER_OF_ROWS;

    if (get_post_meta(get_the_ID(), $numcol)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 || !isset(get_post_meta(get_the_ID(), $numcol)[0]))
      $col = 1;
    else
      $col = get_post_meta(get_the_ID(), $numcol)[0];

    if (get_post_meta(get_the_ID(), $numrow)[0] == "" || get_post_meta(get_the_ID(), $numrow)[0] < 3 || !isset(get_post_meta(get_the_ID(), $numrow)[0]))
      $row = 3;
    else
      $row = get_post_meta(get_the_ID(), $numrow)[0];

    $prefix = WhaddaMetaKeys::PREFIX;
    $reg = $prefix . 'tab_js';
    $cont = 1;
    $i = 0;
    while ($cont <= $col) {
      $i++;
      if ($i <= $row) {
        $val = $prefix . 'c' . $cont . '_r' . $i;
        $url = $prefix . 'c' .$cont;
        $metaurl[$cont]= get_post_meta(get_the_ID(), $url)[0];
        $meta[$cont][$i] = get_post_meta(get_the_ID(), $val)[0];
      } else {
        $meta[$cont][$i] = "";
        $cont++;
        $i = 0;
      }
    }
    wp_register_script($reg, plugin_dir_url(__FILE__) . 'js/tab_js.js');
    $wadda_var = array(
        'colonne' => $col,
        'righe' => $row,
        'value' => $meta,
        'url'=> $metaurl,
    );

    wp_localize_script($reg, 'wadda_var', $wadda_var);
    wp_enqueue_script($reg);

    echo '<input type="button" value="aggiungi riga" name="rigapiu" id="rigapiu"/>';
    echo '<input type="button" value="rimuovi riga" name="rigameno" id="rigameno"/>';
    echo '<input type="button" value="aggiungi colonna" name="colpiu" id="colpiu"/>';
    echo '<input type="text" name="' . $numrow . '" id="' . $numrow . '" value="' . $row . '" hidden>';
    echo '<input type="text" name="' . $numcol . '" id="' . $numcol . '" value="' . $col . '" hidden>';
    echo '<div id="tabella" style="display:table;"></div>';
  }

  public function shortbox() {
    add_meta_box(
            "shortbox",
            "shortcode",
            ['Shortcode', 'shortbox_metabox_callback'],
            'waddaprice',
            'side'
    );
  }

  function save_waddaprice_meta_box() {
    /*
      if(!current_user_can("edit_post", $post_id))
      return $post_id;

      if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
      return $post_id;
      $slug = "wporg_product";
      if($slug != 'wporg_product')
      return $post_id; */
    $prefix = WhaddaMetaKeys::PREFIX;
    $numcol = WhaddaMetaKeys::NUMBER_OF_COLUMNS;
    $numrow = WhaddaMetaKeys::NUMBER_OF_ROWS;
    $short = $prefix . 'short';
    $post_id = get_post()->ID;
    $meta_box_text_value = "";
    $meta_box_select_value = "";
    $meta_box_checkbox_value = "";
    $meta_box_numrow_value = "";
    $meta_box_numcol_value = "";
    $meta_box_url_value = "";
    $meta_box_short = "";

    if (isset($_POST[$numrow])) {
      $meta_box_numrow_value = $_POST[$numrow];
    }
    update_post_meta($post_id, $numrow, $meta_box_numrow_value);

    if (isset($_POST[$numcol])) {
      $meta_box_numcol_value = $_POST[$numcol];
    }
    update_post_meta($post_id, $numcol, $meta_box_numcol_value);

    if (isset($_POST[$short])) {
      $meta_box_short = $_POST[$short];
    }
    update_post_meta($post_id, $short, $meta_box_short);

    for ($colonna = 1; $colonna <= $meta_box_numcol_value; $colonna++) {
      $riga = 1;
      $url = $prefix.'c'.$colonna;
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
    
    
  }

  function set_custom_edit_waddaprice_columns($columns) {
    //unset( $columns['date'] );
    $columns['Shortcode'] = __('Shortcode', 'your_text_domain');
    foreach ($columns as $type => $val) {
      if ($type == 'date') {
        $col['Shortcode'] = $temp;
      }
      $col[$type] = $val;
    }

    return $col;
  }

  function custom_waddaprice_column() {
    $prefix = WhaddaMetaKeys::PREFIX;
    $short = $prefix . 'short';
    $post_id = get_post()->ID;
    echo get_post_meta($post_id, $short, true);
  }
  
}

add_action('init', array('Waddaprice_panel', 'waddaprice_custom_post_type'));

add_action('add_meta_boxes', array('Waddaprice_panel', 'metabox'));

add_action('add_meta_boxes', array('Waddaprice_panel', 'shortbox'));

add_action("save_post", array('Waddaprice_panel', 'save_waddaprice_meta_box'));

add_filter('manage_waddaprice_posts_columns', array('Waddaprice_panel', 'set_custom_edit_waddaprice_columns'));

add_action('manage_waddaprice_posts_custom_column', array('Waddaprice_panel', 'custom_waddaprice_column'));

