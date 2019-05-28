<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Whaddaprice_panel{
  
  private $metakeypre;
  private $metakeycol;
  private $metakeyrow;
          
  function __construct() {

  add_action('add_meta_boxes', array($this,'metabox'));

  add_action('add_meta_boxes', array($this,'shortbox'));

  add_filter('manage_whaddaprice_posts_columns', array($this,'set_custom_edit_whaddaprice_columns'));

  add_action('manage_whaddaprice_posts_custom_column', array($this,'custom_whaddaprice_column'));
  
  add_action('init', array($this, 'whaddaprice_custom_post_type'));
  
  $this->metakeypre=WhaddaMetaKeys::PREFIX; 
  $this->metakeycol=WhaddaMetaKeys::NUMBER_OF_COLUMNS;
  $this->metakeyrow=WhaddaMetaKeys::NUMBER_OF_ROWS;
  }
  
   /* -----------Inizio custom-------------------- */
  
  /*------custom_post_type whaddaprice---------------*/
  /* aggiungo voce in barra laterale admin, creo parte di info post presenti e aggiungi post */

  public function whaddaprice_custom_post_type() {
    register_post_type('whaddaprice',
            array(
                'labels' => array(
                    'name' => __('whaddaprices'),
                    'singular_name' => __('whaddaprice'),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'whaddaprices'),
            )
    );
  }
/*---------- creo sezione tabella in cpt whaddaprice-----------*/
  public function metabox() {
    $id = $this->metakeypre. 'boxid';
    $title = 'Tabella';
    $callback = array($this,'callback_whaddaprice');
    $page = 'whaddaprice';
    add_meta_box($id, $title, $callback, $page);
  }
/*-------creo contenuto sezione tabella (metabox)----------*/
  public function callback_whaddaprice() {
    
    $prefix = $this->metakeypre;  //carico il prefisso generale
    $numcol = $this->metakeycol;  //carico  prefisso colonna
    $numrow = $this->metakeyrow;  //carico prefisso riga
    $reg = $prefix . 'tab_js';
    
    /*controllo se il dato è presente nel database ed è settato, altrimenti valori default*/
    if(get_the_ID()!==null){
      
    if (!isset(get_post_meta(get_the_ID(), $numcol)[0]) || get_post_meta(get_the_ID(), $numcol)[0] == "" || get_post_meta(get_the_ID(), $numcol)[0] < 1 )
    $col = 1;
    else
      $col = get_post_meta(get_the_ID(), $numcol)[0];

    if (!isset(get_post_meta(get_the_ID(), $numrow)[0]) || get_post_meta(get_the_ID(), $numrow)[0] == "" || get_post_meta(get_the_ID(), $numrow)[0] < 3)
    $row = 3;
    else
    $row = get_post_meta(get_the_ID(), $numrow)[0];
      
    }else {
      $col=1;
      $row=3;
    }
/* acquisisco i dati dal database e li carico in variabili da passare a tab_js */
    $cont = 1;
    $i = 0;
    while ($cont <= $col) {
      $i++;
      if ($i <= $row) {
        $val = $prefix . 'c' . $cont . '_r' . $i;
        $url = $prefix . 'c' .$cont;
        if(isset(get_post_meta(get_the_ID(), $url)[0]))
                            $metaurl[$cont]= get_post_meta(get_the_ID(), $url)[0];
        else $metaurl[$cont]='';
        if(isset(get_post_meta(get_the_ID(), $val)[0]))
                            $meta[$cont][$i]= get_post_meta(get_the_ID(), $val)[0];
        else $meta[$cont][$i]='';
        //$meta[$cont][$i] = get_post_meta(get_the_ID(), $val)[0];
      } else {
        $meta[$cont][$i] = "";
        $metaurl[$cont]=  "";
        $cont++;
        $i = 0;
      }
    }
/* registro il tab_js e dichiaro la variabile che passerò oltre al nome che usero per richiamarla in tab_js */
    wp_register_script($reg, plugin_dir_url(__FILE__) . 'js/tab_js.js');
    $wadda_var = array(
        'colonne' => $col,
        'righe' => $row,
        'value' => $meta,
        'url' => $metaurl,
    );
   wp_localize_script($reg, 'wadda_var', $wadda_var);
       wp_enqueue_script($reg);
    /* preparo la parte di html non dinamica */ 
    echo '<div>';
    echo '<input type="button" value="aggiungi riga" name="rigapiu" id="rigapiu"/>';
    echo '<input type="button" value="aggiungi colonna" name="colpiu" id="colpiu"/>';
    echo '<input type="text" name="' . $numrow . '" id="' . $numrow . '" value="' . $row . '" hidden>';
    echo '<input type="text" name="' . $numcol . '" id="' . $numcol . '" value="' . $col . '" hidden>';
    echo '</div>';
    echo '<div id="tabella" class="divtabella"></div>';
  }
/* creo il box laterale dove visualizzare lo shortcode e richiamo la funzione shortbox_metabox_callback() nella
    classe Shortcode presente in WhaddaMetaKeys.php */
  public function shortbox() {
    $sh=new WhaddaShortcode();
    add_meta_box(
            "shortbox",
            "shortcode",
             array($sh,'shortbox_metabox_callback'),
            'whaddaprice',
            'side'
    );
  }
  /* Aggiungo colonna in cpt per visualizzare lo shortcode */
  function set_custom_edit_whaddaprice_columns($columns) {
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
/* carico il valore dello shortcode presente in database nella colonna che ho aggiunto */
  function custom_whaddaprice_column() {
    $prefix = $this->metakeypre;
    $short = $prefix . 'short';
    $post_id = get_post()->ID;
    echo get_post_meta($post_id, $short, true);
  }
  
}



