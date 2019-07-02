/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
  'use strict';
  $(function () {

    var prefix = 'whadda_';
    var numrow = '#' + prefix + 'nrows';
    var numcol = '#' + prefix + 'ncols';
    var colsel = 1;
    var nrighe = $(numrow).val();
    var ncol = $(numcol).val();
    var inizio = 0;
    var indice = 0;
    var colin = ncol;
    ncol = 1;
    for (var i = 1; i <= colin; i++)
      crea_col();


      /*creao nuova riga fino a max 10 oltre le tre obbligatorie*/
    $('#rigapiu').click(function () {
      if (nrighe < 13) {
        nrighe++;
        inizio = nrighe;
        for (var ini = 1; ini < ncol; ini++) {
          colsel = ini;
          opz1(); /*funzione che genera le righe*/
        }
      }
    });
    /*rimuovo la riga colori quando riga dati rimossa*/
    $('#tabella').on('click', '#rigameno', function () {
      var idrm = $(this).attr('data-id');
      for (var ini = 1; ini < ncol; ini++) {
        opz_r1(idrm, ini);/* funzione di rimozione, passo numero riga da rimuovere e ciclo per num colonne*/
      }
      inizio = nrighe;
      nrighe--; /*aggiorno numero righe*/

    });
    /*funzione rimozione righe colori*/
    function opz_r1(idrm, col) {
      var id = '#' + prefix + 'sfondo_c' + col + '_r' + idrm; /*riga da rimuovere*/
      $(id).parent().parent().remove();/*rimozione tr corrispondente a riga*/
      for (var num = (idrm * 1); num <= nrighe; num++) {
        var idvo = '#' + prefix + 'sfondo_c' + col + '_r' + (num); /*vecchio id colore sfondo*/
        var idno = prefix + 'sfondo_c' + col + '_r' + (num - 1);/*nuovo id colore sfondo*/
        var idvc = '#' + prefix + 'char_c' + col + '_r' + num;/*vecchio id colore carattere*/
        var idnc = prefix + 'char_c' + col + '_r' + (num - 1);/*nuovo id colore carattere*/
        var nameon = prefix + 'sfondo_c' + col + '_r' + (num - 1);/*nuovo nome sfondo*/
        var namecn = prefix + 'char_c' + col + '_r' + (num - 1);/*nuovo nome carattere*/
        $(idvo).attr('name', nameon);/* carico    */
        $(idvo).attr('id', idno);    /*  nuovi    */
        $(idvc).attr('name', namecn);/*  dati     */
        $(idvc).attr('id', idnc);    /*  riga     */
        var tdv = '#nome2_c' + col + '_r' + num; /*vecchio id span numero riga*/
        var tdn = 'nome2_c' + col + '_r' + (num - 1);/*nuovo id span numero riga*/
        var nomeind = '#name_o_num_c' + col + '_r' + num;/*id span da rimuovere*/
        $(tdv).prepend('<span id="name_o_num_c' + col + '_r' + (num - 1) + '">riga ' + (num - 1) + '</span>');
        $(tdv).attr('id', tdn);
        $(nomeind).remove();/*rimozione span con nome riga vecchio*/
      }
    }

    function crea_col() { /*funzione per preparare creazione colonne*/
      colsel = ncol;
      inizio = 0; /*azzero conteggio colonne*/
      opz1();/*creo colonne*/
      ncol++; /*aggiorno numero colonne*/
    }

    $("#colpiu").click(function () {
      crea_col(); /*chiamo il prepara crea colonne quando premo per aggiungere colonna*/
    });

    $('#tabella').on('click', '#colmeno', function () {/*rimozione colonna*/
      var colrem = $(this).attr('data-id');/*numero colonna da rimuovere*/
      for (var indcol = colrem; indcol < ncol; indcol++) {
        renamecol(indcol); /*chiamo funzione che rinomina contenuto colonne*/
      }
      ncol--;
      var tab_num = '#tab_num_' + ncol; /*id colonna da rimuovere*/
      $(tab_num).remove(); /*rimuovo colonna*/
    });

    function renamecol(numcol) {
      numcol *= 1; /* traformo numcol in numero */
      for (var num = 0; num <= nrighe; num++) { /*ciclo per ogni riga*/
        var idvo = '#' + prefix + 'sfondo_c' + (numcol + 1) + '_r' + num; /*vecchio id riga sfondo*/
        var idno = '#' + prefix + 'sfondo_c' + numcol + '_r' + num; /*nuovo id riga sfondo*/
        var idvc = '#' + prefix + 'char_c' + (numcol + 1) + '_r' + num;/*vecchio id riga carattere*/
        var idnc = '#' + prefix + 'char_c' + numcol + '_r' + num;/*nuovo id riga carattere*/
        $(idno).val($(idvo).val()); /*carico su nuovo id valore di vecchio id sfondo*/
        $(idnc).val($(idvc).val()); /*carico su nuovo id valore di vecchio id carattere*/
      }

    }

    function opz1() { /*funzione che crea colonne*/
      //console.log(colsel);
      var rigao;
      var rigac;
      var boldchek;
      var coldefs=$('#whadda_sets').attr('data-id'); 
      var coldeft=$('#whadda_setc').attr('data-id');
      var sfondo = prefix + 'sfondo';
      var char = prefix + 'char';
      var tabcol = prefix + 'col_';
      var tabcolcanc = '#' + tabcol + colsel;
      var tabbut = prefix + 'but_';
      if (colsel == ncol) { /*distinguo se creo colonna nuova o rigenero*/
        $('#coloritab').append( /*creo div che contengono tabelle (colonne)*/
                '<div id="tab_num_' + colsel + '" class="whaddacenterfloat">'+whadda_color['testi'][0] + colsel +
                '<div id="tab_col_' + colsel + '" ><div id="tab_but_' + colsel + '"></div></div></div>'
                );
      }
      var tab_col = '#tab_col_' + colsel;
      var tab_but = '#tab_but_' + colsel;
      //console.log('ini= ', inizio, ' nrig= ', nrighe);
      /*carico valori presenti nel database o imposto default*/
      for (var indice = inizio; indice <= (nrighe) * 1; indice++) {
        var id='#whadda_sfondo_c1_r'+indice;
        //console.log($(id).val(),' ',indice);/////////////// VERIFICARE ERRORE ///////////////
        if (whadda_color['color_s'][colsel]==undefined){
                    if ($('#whadda_sfondo_c1_r'+indice).val() == undefined){
                    var whadda_col_s = coldefs;
                  }else whadda_col_s = $('#whadda_sfondo_c1_r'+indice).val();
        }else if (whadda_color['color_s'][colsel][indice] == undefined){
                                        whadda_col_s = coldefs;
                                      }
        else whadda_col_s=whadda_color['color_s'][colsel][indice];
      
       if (whadda_color['color_c'][colsel]==undefined){
                    if ($('#whadda_sfondo_c1_r'+indice).val() == undefined){
                    var whadda_col_c = coldeft;
                  }else whadda_col_c = $('#whadda_char_c1_r'+indice).val();
        }else if (whadda_color['color_c'][colsel][indice] == undefined){
                                        whadda_col_c = coldeft;
                                      }
        else whadda_col_c=whadda_color['color_c'][colsel][indice];
        /*primo giro di ogni colonna creo intestazione tabella e bottone*/
       // console.log(whadda_col_c,' ',coldeft)
        if (indice == 0) {
          $(tab_col).prepend(
                  '<table ><tbody id="' + tabcol + colsel + '" class="whaddacenter">' +
                  '<tr>' +
                  '<th></th>' +
                  '<th>'+whadda_color['testi'][1]+'</th>' +
                  '<th>'+whadda_color['testi'][2]+'</th></tr>' +
                  '</tbody></table>'
                  );
          $(tab_but).prepend(
                  '<table ><tbody id="' + tabbut + colsel + '" class="whaddacenter">' +
                  '<tr>' +
                  '<th></th>' +
                  '<th>'+whadda_color['testi'][1]+'</th>' +
                  '<th>'+whadda_color['testi'][2]+'</th>' +
                  '</tr>' +
                  '<tr>' +
                  '<td id="nome2_c' + colsel + '_r' + indice + '"><span id="name_o_num_c' + colsel + '_r' + indice + '">'+whadda_color['testi'][3]+'</span></td>' + // da terminare -> nomi e salvataggio
                  '<td><input type="color" name="' + sfondo + '_c' + colsel + '_r' + indice + '" id="' + sfondo + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_s + '"></td>' + // da terminare -> nomi e salvataggio
                  '<td><input type="color" name="' + char + '_c' + colsel + '_r' + indice + '" id="' + char + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_c + '"></td>' + // da terminare -> nomi e salvataggio
                  '</tr>' +
                  '<div class="clear"></div>' +
                  '</tbody></table>'
                  );
        } else {/*giri dopo il primo creo righe*/
          $(tabcolcanc).append(
                  '<tr>' +
                  '<td id="nome2_c' + colsel + '_r' + indice + '"><span id="name_o_num_c' + colsel + '_r' + indice + '">'+whadda_color['testi'][4] + indice + '</span></td> ' +
                  '<td><input type="color" name="' + sfondo + '_c' + colsel + '_r' + indice + '" id="' + sfondo + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_s + '"></td>' +
                  '<td><input type="color" name="' + char + '_c' + colsel + '_r' + indice + '" id="' + char + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_c + '"></td>' +
                  '</tr>' +
                  '<div style="clear:both;"></div>'
                  );
        }
      }
    }


  });
})(jQuery);