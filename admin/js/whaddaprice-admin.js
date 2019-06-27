(function( $ ) {
	'use strict';
  
  $(function(){
    var layout="";
    var id="";
    var conf='annulla';
    var lv='';
    var ver=0;
    $(document).ready(function(){
      $('.labelbordi').on('mouseover',function(){
        if(ver==0){
         lv=$('.inputbordi[checked]').val()*1; 
         ver=1;
        }
      });
     $('.labelbordi').on('mouseup',function(){
       ver=0;
       layout=$(this).attr('data-id')*1; 
       $('#whadda_allert').removeAttr('hidden');
      
    var data="";
    
    $('#whadda_confirm').click(function(){
     $('#whadda_allert').attr('hidden','hidden');
     for(var i=1;i<=4;i++){
            id='#whadda_layout_'+i;
           if(i!=layout){
             $(id).removeAttr('checked');
           }else $(id).attr('checked','checked');
         }
    $.ajax({
    dataType: "json",
    url: '/',
    data: data,
    //success: success
    });
     
    $.getJSON( "../wp-content/plugins/whaddaprice/admin/js/layout"+layout+".json", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
    for(var x in val){
      id='#'+x;
     // console.log($('#whadda_nrows').val());

      if(x=='whadda_nrows' && val[x]> $('#whadda_nrows').val()){
                var nrows=$('#whadda_nrows').val()*1;
               for(var ir=nrows;ir<val[x];ir++){
                                          $('#rigapiu').trigger('click');
                                        }
      }else if(x=='whadda_nrows' && val[x]<= $('#whadda_nrows').val()){
      } else $(id).val(val[x]);
      
      if(val[x]=='checked'){
        $(id).attr(val[x],val[x]);
      }else $(id).removeAttr("checked");
      
      if(x=='whadda_sfondo_c_r'){
                $('#whadda_sets').val(val[x]);
      }
      if(x=='whadda_char_c_r'){
                $('#whadda_setc').val(val[x]);
      }
      if(x=='whadda_set_o'){
                $('#whadda_set_o').attr('data-id',val[x]);
      }
      if(x=='whadda_set_c'){
                $('#whadda_set_c').attr('data-id',val[x]);
      }
      if(x=='whadda_set_b'){
                $('#whadda_set_b').attr('data-id',val[x]);
      }
       if(x=="whadda_fonts"){
           $('#whadda_font_fd').attr('data-id',val[x]);
      }
      if(x=="whadda_namefont"){
           $('#whadda_font_nd').attr('data-id',val[x]);
      }
      if(x=="whadda_varifont"){
           $('#whadda_font_vd').attr('data-id',val[x]);
           $('#whadda_font_vd').trigger('change');
      }
    }  
    });
  });
  });
     $('#whadda_dinieg').click(function(){
         for(var i=1;i<=4;i++){
            id='#whadda_layout_'+i;
           if(i!=lv){
             $(id).removeAttr('checked');
           } else $(id).attr('checked','checked');
         }
         $('#whadda_allert').attr('hidden','hidden');
     
    });
   
     });
      
      
    });
   

});
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


})( jQuery );
