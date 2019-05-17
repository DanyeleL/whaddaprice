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
    $callback = ['Whaddaprice_Admin', 'callback_waddaprice'];
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

add_action('init', array('Whaddaprice_Admin', 'waddaprice_custom_post_type'));

add_action('add_meta_boxes', array('Whaddaprice_Admin', 'metabox'));

add_action('add_meta_boxes', array('Whaddaprice_Admin', 'shortbox'));

add_action("save_post", array('Whaddaprice_Admin', 'save_waddaprice_meta_box'));

add_filter('manage_waddaprice_posts_columns', array('Whaddaprice_Admin', 'set_custom_edit_waddaprice_columns'));

add_action('manage_waddaprice_posts_custom_column', array('Whaddaprice_Admin', 'custom_waddaprice_column'));

/* ------------------------------------------------------------------------- *
*   SHORTCODE FALON
/* ------------------------------------------------------------------------- */

function jb_shortcode_de_contenido($idp ) {
  
	ob_start();
	?>
	<label for="NUMBER_OF_COLUMNS">Columnas</label>
    <input name="NUMBER_OF_COLUMNS" type="number" value="<?php echo get_post_meta($idp["id"], "NUMBER_OF_COLUMNS", true); ?>">
	<label for="NUMBER_OF_COLUMNS">Rows</label>
	<input name="NUMBER_OF_ROWS"type="number" value="<?php echo get_post_meta($idp["id"], "NUMBER_OF_ROWS", true); ?>">
			
    <?php  	return ob_get_clean();
	}
	add_shortcode('stage-2019', 'jb_shortcode_de_contenido'); 


/* ------------------------------------------------------------------------- *
*   CUSTOM POST TYPE Portfolio
/* ------------------------------------------------------------------------- */
add_action('init', 'create_habitacion');
function create_habitacion() {
$labels = array(
'name'               => __('Habitacion' , 'proyecto-plugin'),
'singular_name'      => __('Habitacion' , 'proyecto-plugin'),
'add_new'            => __('Agregar habitacion', 'proyecto-plugin'),
'add_new_item'       => __('Agregar Nueva habitacion' , 'proyecto-plugin'),
'edit_item'          => __('Edit Habitacion', 'proyecto-plugin'),
'new_item'           => __('Nuevo Habitacion', 'proyecto-plugin'),
'all_items'          => __('Todas las Habitaciones', 'proyecto-plugin'),
'view_item'          => __('Ver Habitaciones' , 'proyecto-plugin'),
'search_items'       => __('Search Habitacion' , 'proyecto-plugin'),
'not_found'          => __('Habitacion Not found', 'proyecto-plugin'),
'not_found_in_trash' => __('Habitacion Not found in the trash', 'proyecto-plugin'),
);
$args = array(
'labels'             => $labels,
'public'             => true,
'rewrite'            => array('slug' => 'Habitacion'),
'has_archive'        => true,
'hierarchical'       => true,
'menu_position'      => 22,
'menu_icon'          => 'dashicons-welcome-write-blog',
'supports'           => array(
'title',
'editor',
'thumbnail',
//'excerpt',
'page-attributes'
),
);
register_post_type('habitacion', $args);
}


add_filter( 'manage_edit-habitacion_columns', 'columnas_post_type_habitacion' ) ;
// Funcion para la definicion del metabox
// e indicaciones de la funcion de instaciar

function add_metabox_shortcode() {
	add_meta_box('metabox_shortcode','ShortCode',
	  'add_metabox_shortcode_form','habitacion','side','default');
  }
  
  // Funcion que disena la form del metabox
  // ingresando los campos personalizados que necesita
  
  function add_metabox_shortcode_form() 
  {
	$idp=get_post()->ID;
	echo '[stage-2019 id='. get_post()->ID.']';

  }
  

  
  // Funcion generak para la guardar los datos del metabox en un post seleccionado 
  // con los valores que corresponden a los custom field
  
  
  function check_metabox_shortcode($id,$fields) 
  {
	// Si son en fase de guadar automaticamente  no salvan la informacion ligada al custom field.
	// Las informaciones son guardadas solo en confirma directa
	
  
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	  return false;
	}
  
	// Controla si los nombres del campo son dentro del array  
	// Controla si el usuario corriente puede modificar el post
  
	if (!is_array($fields)) return false;
	if (!current_user_can('edit_post',$id)) return false;
  
	// Controla si todos los nombres de los campos especificos dentro 
	// de un array existen como nombre de los campos especificos en la variable $POST
  
	$custom = array();
  
	foreach ($fields as $key=>$value) {
	  if (!isset($_POST[$value])) return false;
	  $custom[$value] = trim($_POST[$value]);
	}
  
	// Lectura del nuevo arreglo con los nuevos valores y modificas
	// de los custom field ligados al post objeto ($ID)
  
	foreach ($custom as $key=>$value) { 
	  $value = implode(',',(array)$value); 
	  if($value) update_post_meta($id,$key,$value);
		else delete_post_meta($id, $key);
	}
  
	return $custom;
  }
  
  // Asociacion de las funciones a las acciones 
  // di wordpress para la gestion del matabox
 
  
  add_action('add_meta_boxes','add_metabox_shortcode');
  add_action('save_post','save_metabox_shortcode');


/* ------------------------------------------------------------------------- *
*   COLUMNAS PERSONALIZADAS DEL POST TYPE
/* ------------------------------------------------------------------------- */

function columnas_post_type_habitacion( $columnas ) {

    $columnas = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Nombre',
        'shortcode' => 'Shortcode',
        'precio' => 'Precio',
        'direccion' => 'Lugar',
        'date' => 'Fecha'
    );

    return $columnas;
}





/* ------------------------------------------------------------------------- *
*  MARCADORES DEL CUSTUM METABOX 
/* ------------------------------------------------------------------------- */

function custom_meta_box_markup($post)
{
    ?>
    <div>
        <label for="NUMBER_OF_COLUMNS">Columns</label>
        <input name="NUMBER_OF_COLUMNS" type="number" value="<?php echo get_post_meta($post->ID, "NUMBER_OF_COLUMNS", true); ?>">

		<label for="NUMBER_OF_ROWS">Rows</label>
        <input name="NUMBER_OF_ROWS" type="number" value="<?php echo get_post_meta($post->ID, "NUMBER_OF_ROWS", true); ?>">
 
        <br>
 
        <label for="meta-box-select">Numero de Habitaciones</label>
        <select name="meta-box-select">
            <?php
            $option_values = array(0, 1, 2, 3);
 
            foreach($option_values as $key => $value) {
                if($value == get_post_meta($post->ID, "meta-box-select", true)) {
                    ?>
                    <option selected><?php echo $value; ?></option>
                <?php
                } else {
                    ?>
                    <option><?php echo $value; ?></option>
                    <?php
                }
            }
            ?>
        </select>
 
        <br>
 
        <label for="meta-box-checkbox">Desayuno</label>
        <?php
        $checkbox_value = get_post_meta($post->ID, "meta-box-checkbox", true);
 
        if($checkbox_value == "")
        {
            ?>
            <input name="meta-box-checkbox" type="checkbox" value="true">
            <?php
        }
        else if($checkbox_value == "true")
        {
            ?>
            <input name="meta-box-checkbox" type="checkbox" value="true" checked>
            <?php
        }
        ?>
    </div>
    <?php
}


/* ------------------------------------------------------------------------- *
*   METABOX PERSONALIZADO
/* ------------------------------------------------------------------------- */
function add_custom_meta_box()
{
    add_meta_box("custom-meta-box", "Tabla Precios", "custom_meta_box_markup", "Habitacion", "normal");
}

add_action("add_meta_boxes", "add_custom_meta_box");

/*Guardar los datos del metabox*/


/* ------------------------------------------------------------------------- *
*   GUARDAR DATOS EN EL POST META
/* ------------------------------------------------------------------------- */
function save_custom_meta_box($Habitacion_id, $post)
{
/*	
	if(!current_user_can("edit_post", $idP))
        return $idP;
 
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $idP;
 
    $slug = "post";
    if($slug != $Habitacion->habitacion_type)
        return $idP;
 */

$idP= get_post()->ID;
    $meta_box_text_value = "";
    $meta_box_select_value = "";
    $meta_box_checkbox_value = "";
 
    if(isset($_POST["NUMBER_OF_COLUMNS"])) {
        $meta_box_text_value = $_POST["NUMBER_OF_COLUMNS"];
    }
    update_post_meta($idP, "NUMBER_OF_COLUMNS", $meta_box_text_value);
 
	if(isset($_POST["NUMBER_OF_ROWS"])) {
        $meta_box_text_value = $_POST["NUMBER_OF_ROWS"];
    }
	update_post_meta($idP, "NUMBER_OF_ROWS", $meta_box_text_value);
	
    if(isset($_POST["NUMBER_OF_COLUMNS"])) {
        $meta_box_select_value = $_POST["NUMBER_OF_COLUMNS"];
    }
    update_post_meta($idP, "meta-box-dropdown", $meta_box_select_value);
 
    if(isset($_POST["meta-box-checkbox"])) {
        $meta_box_checkbox_value = $_POST["meta-box-checkbox"];
    }
    update_post_meta($idP, "meta-box-checkbox", $meta_box_checkbox_value);
}
 
add_action("save_post", "save_custom_meta_box", 10, 2);
