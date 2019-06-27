<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.virtualbit.it
 * @since      1.0.0
 *
 * @package    Whaddaprice
 * @subpackage Whaddaprice/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Whaddaprice
 * @subpackage Whaddaprice/public
 * @author     Lucio Crusca <lucio@sulweb.org>
 */
class Whaddaprice_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whaddaprice-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		 * The Whaddaprice_Loader willx then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whaddaprice-public.js', array( 'jquery' ), $this->version, false );

	}

}

/* ------------------------------------------------------------------------- *
*   SHORTCODE FALON
/* ------------------------------------------------------------------------- */
function jb_shortcode_de_contenido($idp) {
	
	$test = new Whadda_css();
	$test->whadda_styles_method($idp['id']);

    $numColumnas=get_post_meta($idp["id"], WhaddaMetaKeys::NUMBER_OF_COLUMNS);
    $numRows=get_post_meta($idp["id"], WhaddaMetaKeys::NUMBER_OF_ROWS);
	$prefix=WhaddaMetaKeys::PREFIX;



/* ------------------------------------------------------------------------- *
*   LAYOUT
/* ------------------------------------------------------------------------- */


/**Leggo layout */
$prefixLayout= $prefix.'layout';
$layout= get_post_meta($idp["id"], $prefixLayout)[0];


$prefixBorder= $prefix.'border_radius';
$prefixOn=$prefix .'border_on';
if($layout==1){
  ob_start();
  
	echo 
	'<div class="wrap">' ;
/*
    '<div class="miswitch">'.
	 '<div class="swicht-btn" id="swicht-btn">'.'</div>'.
     '<a>Mensile</a>'.
	 '<a>Anual</a>'.
	 '</div>'. 
*/
    echo
	 '<div class="pricing-wrap" >';
	


    for($i=1; $i<=$numColumnas[0]; $i++){
     
	 echo 
	  
	  '<div class="pricing-table f'. $idp['id'].'" style="margin-right:'.get_post_meta($idp["id"], $prefix.'margin_right_c')[0].';ù
		margin-left:'.get_post_meta($idp["id"], $prefix.'margin_left_c')[0].';
		margin-top:'.get_post_meta($idp["id"], $prefix.'margin_top_c')[0].';
		margin-bottom:'.get_post_meta($idp["id"], $prefix.'margin_bottom_c')[0].';
		padding-right:'.get_post_meta($idp["id"], $prefix.'padding_right_c')[0].';
		padding-left:'.get_post_meta($idp["id"], $prefix.'padding_left_c')[0].';
		padding-top:'.get_post_meta($idp["id"], $prefix.'padding_top_c')[0].';
		padding-bottom:'.get_post_meta($idp["id"], $prefix.'padding_bottom_c')[0].'";>'.
		
	  '<div class="pricing-table-cont" style="border:'.get_post_meta($idp["id"], $prefix.'border_on')[0].';
	  border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
	  border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
	  background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].';
	  border-color:'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.
	  
	  '<div class="pricing-table-month" >'.
      '<div class="pricing-table-head">';
	 
	  echo
	  '<h2  style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r1')[0].';">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r1')[0]. '</h2>'.
	  '<h3  style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r2')[0].'">'.'<sup></sup>'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'<sub>/MES</sub>'.'</h3>' .
	  '<ul class="pricing-table-list riga_1" >';

	
      for($w=4; $w<=$numRows[0]; $w++){

	   echo '<li class="riga_'.$w.'" style="margin-right:'.get_post_meta($idp["id"], $prefix.'margin_right_r')[0].';
	   margin-left:'.get_post_meta($idp["id"], $prefix.'margin_left_r')[0].';
	   margin-top:'.get_post_meta($idp["id"], $prefix.'margin_top_r')[0].';
	   margin-bottom:'.get_post_meta($idp["id"], $prefix.'margin_bottom_r')[0].';
	   padding-right:'.get_post_meta($idp["id"], $prefix.'padding_right_r')[0].';
	   padding-left:'.get_post_meta($idp["id"], $prefix.'padding_left_r')[0].';
	   padding-top:'.get_post_meta($idp["id"], $prefix.'padding_top_r')[0].';
	   background:'.get_post_meta($idp["id"], $prefix.'sfondo_c1_r'.$w)[0].'; 
	   border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].';
	   padding-bottom:'.get_post_meta($idp["id"], $prefix.'padding_bottom_r')[0].';
	   font-style:'.get_post_meta($idp["id"], $prefix.'stile_o_r'.$w)[0].';
	   font-weight:'.get_post_meta($idp["id"], $prefix.'bold_r'.$w)[0].'">
	   <span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r'.$w)[0].'"> 
	   '.get_post_meta($idp["id"], $prefix.'c'.$i.'_r'.$w)[0].'</span></li>';
       
	  }echo
	   '</ul>'.
	   '<a href="#" class="pricing-table-button" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'; background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r0')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i)[0].'</a>'.
	   '</div>'.	
       '</div>'.
       '</div>'.
	   '</div>';
    
		}
		echo 

		'</div>'.
		'</div>';

    return ob_get_clean();
  }

if($layout==2){
	ob_start();
  
	
	echo 
	'<div class="wrap2">'.
	'<div class="pricing-wrap2">';

	 for($i=1; $i<=$numColumnas[0]; $i++){
     
		echo 

		'<div class="pricing-table2">'.
		'<div class="pricing-table-cont2 f'. $idp['id'].'">'.
		'<div class="col">'. 
		'<ul class="price-box" style="border:'.get_post_meta($idp["id"], $prefix.'border_on')[0].';
		 border-color:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].'">'.
		'<li class="header" style="border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r1')[0].'">'.'<h2 style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r1')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r1')[0]. '</h2>'.'</li>'.
		'<li class="emph" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r1')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r2')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'</li>';
	   
		 for($w=4; $w<=$numRows[0]; $w++){
		  if($w==$numRows[0]){

		echo

	   '<li class="riga_'.$w.'" style="margin-right:'.get_post_meta($idp["id"], $prefix.'margin_right_r')[0].';
		margin-left:'.get_post_meta($idp["id"], $prefix.'margin_left_r')[0].';
		color:'.get_post_meta($idp["id"], $prefix.'colts')[0].';
		margin-top:'.get_post_meta($idp["id"], $prefix.'margin_top_r')[0].';
		margin-bottom:'.get_post_meta($idp["id"], $prefix.'margin_bottom_r')[0].';
		padding-right:'.get_post_meta($idp["id"], $prefix.'padding_right_r')[0].';
		padding-left:'.get_post_meta($idp["id"], $prefix.'padding_left_r')[0].';
		padding-top:'.get_post_meta($idp["id"], $prefix.'padding_top_r')[0].';
		padding-bottom:'.get_post_meta($idp["id"], $prefix.'padding_bottom_r')[0].'; 
		border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
		border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
		color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r'.$w)[0].';
		background:'.get_post_meta($idp["id"], $prefix.'sfondo_c1_r'.$w)[0].'; 
		border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].';
		font-style:'.get_post_meta($idp["id"], $prefix.'stile_o_r'.$w)[0].';
	    font-weight:'.get_post_meta($idp["id"], $prefix.'bold_r'.$w)[0].'">
		<strong > '.get_post_meta($idp["id"], $prefix.'c'.$i.'_r'.$w)[0]. '</strong></li>';

			   
		   }
		else{
			echo 
			
			'<li class="riga_'.$w.'" style="margin-right:'.get_post_meta($idp["id"], $prefix.'margin_right_r')[0].';
			color:'.get_post_meta($idp["id"], $prefix.'colts')[0].';
			margin-left:'.get_post_meta($idp["id"], $prefix.'margin_left_r')[0].';
			margin-top:'.get_post_meta($idp["id"], $prefix.'margin_top_r')[0].';
			margin-bottom:'.get_post_meta($idp["id"], $prefix.'margin_bottom_r')[0].';
			padding-right:'.get_post_meta($idp["id"], $prefix.'padding_right_r')[0].';
			padding-left:'.get_post_meta($idp["id"], $prefix.'padding_left_r')[0].';
			padding-top:'.get_post_meta($idp["id"], $prefix.'padding_top_r')[0].';
			padding-bottom:'.get_post_meta($idp["id"], $prefix.'padding_bottom_r')[0].';	 
			background:'.get_post_meta($idp["id"], $prefix.'sfondo_c1_r'.$w)[0].'; 
			border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">
			<strong style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r'.$w)[0].';
			font-style:'.get_post_meta($idp["id"], $prefix.'stile_o_r'.$w)[0].';
	        font-weight:'.get_post_meta($idp["id"], $prefix.'bold_r'.$w)[0].'">
			'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r'.$w)[0].'</strong></li>';
		}

		 }echo
		  '</ul>'.
		 '<a href="#" class="button" style="color: '.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].';
		  background:'.get_post_meta($idp["id"], $prefix.'sfondo_c1_r0')[0].'; 
	      border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i)[0].'</a>'.
		  '</div>'. 
		  '</div>'. 
		  '</div>';
	   
		   }
		   echo '</div>'. '</div>';
	   return ob_get_clean();
	
}
if($layout==3){
	ob_start();
	
	  echo 
	  '<div id="pricing-table" class="clear f'. $idp['id'].'">' ;
  
	  for($i=1; $i<=$numColumnas[0]; $i++){
	  
	   if($i==2){ 
		echo 
		'<div class="plan" id="most-popular" style="border:'.get_post_meta($idp["id"], $prefix.'border_on')[0].';
		 border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].';
		 border-color:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.
		'<div class="tape">'.
		'<span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r3')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r3')[0].'</span></div>'.
		'<h3 style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r1')[0].';
		 border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r1')[0].'">'
		 .get_post_meta($idp["id"], $prefix.'c2_r1')[0].
		'<span style="color: '.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r2')[0].';">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'</span></h3>'.
		'<a class="signup" href="" style="color: '.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i)[0].'</a>'.
		'<ul class="riga_1">';   
	   
	   }else
	   echo
	    '<div class="plan" style="border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
		border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
		border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].';
	    border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.
		'<h3 style="
		color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r1')[0].';
		border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
		 background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r1')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r1')[0].
		'<span style="color: '.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r2')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'</span></h3>'.
		'<a class="signup f'. $idp['id'].'" href=""  style="color: '.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i)[0].'</a>'.
		'<ul class="riga_1" >';
  
	  
		for($w=4; $w<=$numRows[0]; $w++){
		 echo '<li class="riga_'.$w.'"><b style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r'.$w)[0].';
		 font-style:'.get_post_meta($idp["id"], $prefix.'stile_o_r'.$w)[0].';
         font-weight:'.get_post_meta($idp["id"], $prefix.'bold_r'.$w)[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r'.$w)[0]. '</b></li>';
		  
		}echo
		 '</ul>'.
		 '</div>';
		 
	  
		  }
		  echo '</div>';
	  return ob_get_clean();
	}

else{
	ob_start();
  
	echo 
	'<div class="prom f'. $idp['id'].'">' ;
    
    for($i=1; $i<=$numColumnas[0]; $i++){
	  
	 if($i==2){ 
	  echo '<div class="tabla grande" style="border:'.get_post_meta($idp["id"], $prefix.'border_on')[0].'; 	
	  border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
	  border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].';
	  border-color:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.
	  '<div class="deal">'.
      '<span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r1')[0].'</span>'.
	  '<span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r3')[0].'</span>'. 
	  '</div>'. 
	  '<span class="price" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r2')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'</span>'. 
	  '<ul class="features">';
	 }else

	 echo
	 '<div class="tabla" style="border-top-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-top-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  border-bottom-right-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].'; 
	  border-bottom-left-radius:'.get_post_meta($idp["id"], $prefix.'border_radius')[0].';
	  background:'.get_post_meta($idp["id"], $prefix.'colsf')[0].';
	  border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.
      '<div class="deal">'.
      '<span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r1')[0].'</span>'.
	  '<span style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r3')[0].'</span>'. 
	  '</div>'. 
	  '<span class="price" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r2')[0].'">'. get_post_meta($idp["id"], $prefix.'c'.$i.'_r2')[0].'</span>'. 
	  '<ul class="features">';
	
      for($w=4; $w<=$numRows[0]; $w++){

	   echo '<li class="riga_'.$w.'" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r'.$w)[0].';
	   background:'.get_post_meta($idp["id"], $prefix.'sfondo_c1_r'.$w)[0].';
	   font-style:'.get_post_meta($idp["id"], $prefix.'stile_o_r'.$w)[0].';
	   font-weight:'.get_post_meta($idp["id"], $prefix.'bold_r'.$w)[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i.'_r'.$w)[0]. '</li>';
	  
	  } echo
	   '</ul>'.  
	   '<button class="buy" style="color:'.get_post_meta($idp["id"], $prefix.'char_c'.$i.'_r0')[0].';
	   background:'.get_post_meta($idp["id"], $prefix.'sfondo_c'.$i.'_r0')[0].'; 
	   border:1px solid'.get_post_meta($idp["id"], $prefix.'colbr')[0].'">'.get_post_meta($idp["id"], $prefix.'c'.$i)[0].'</button>'.
       '</div>';
        
    
		}
		echo '</div>' ;
    return ob_get_clean();
  }
}


class Whadda_css{

	function __construct()
		{
         add_action('wp_enqueue_scripts', array($this, 'whadda_styles_method'));
		}

		function whadda_styles_method($id)
		{
			wp_register_style('whadda-custom-css', false);
			wp_enqueue_style('whadda-custom-css',
			plugin_dir_url(__FILE__). 'css/whaddaprice-public.css');
		$font =get_post_meta($id, 'whadda_fonts', true);
		$custom_css ="@font-face{
			font-family: f{$id};
			src:url({$font});
		}".	
		".f{$id}{font-family:f{$id};}";

		wp_add_inline_style('whadda-custom-css', $custom_css);
		}
}

	/*ob_start();
	
	<label for="NUMBER_OF_COLUMNS">Columnas</label>
    <input name="NUMBER_OF_COLUMNS" type="number" value="<?php echo get_post_meta($idp["id"], WhaddaMetaKeys::NUMBER_OF_COLUMNS, true); ?>">
	<label for="NUMBER_OF_COLUMNS">Rows</label>
	<input name="NUMBER_OF_ROWS"type="number" value="<?php echo get_post_meta($idp["id"], WhaddaMetaKeys::NUMBER_OF_ROWS, true); ?>">
			
    <?php  	return ob_get_clean();
	}
	add_shortcode('whaddaprice', 'jb_shortcode_de_contenido'); 

function whaddaprice_shortcode(){
  ob_start();
  ?>
  <p>ciao</p>
   <?php  	return ob_get_clean();
}
/* ------------------------------------------------------------------------- *
*   CUSTOM POST TYPE Portfolio
/* ------------------------------------------------------------------------- */
/*add_action('init', 'create_habitacion');
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
  s
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
/*
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
/*
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
/*function add_custom_meta_box()
{
    add_meta_box("custom-meta-box", "Tabla Precios", "custom_meta_box_markup", "Habitacion", "normal");
}

add_action("add_meta_boxes", "add_custom_meta_box");

/*Guardar los datos del metabox*/


/* ------------------------------------------------------------------------- *
*   GUARDAR DATOS EN EL POST META
/* ------------------------------------------------------------------------- */
/*function save_custom_meta_box($Habitacion_id, $post)
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
/*
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
 
add_action("save_post", "save_custom_meta_box", 10, 2);*/



