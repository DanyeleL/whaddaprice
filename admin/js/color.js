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
      crea_hide_show();



    $('#rigapiu').click(function () {
      if (nrighe < 13) {
        nrighe++;
        inizio = nrighe;
        for (var ini = 1; ini < ncol; ini++) {
          colsel = ini;
          opz1();
        }
      }
    });

    $('#tabella').on('click', '#rigameno', function () {
      var idrm = $(this).attr('data-id');
      for (var ini = 1; ini < ncol; ini++) {
        opz_r1(idrm, ini);
      }
      inizio = nrighe;
      nrighe--;

    });

    function opz_r1(idrm, col) {
      var id = '#' + prefix + 'sfondo_c' + col + '_r' + idrm;
      $(id).parent().parent().remove();
      for (var num = (idrm * 1); num <= nrighe; num++) {
        var idvo = '#' + prefix + 'sfondo_c' + col + '_r' + (num);
        var idno = prefix + 'sfondo_c' + col + '_r' + (num - 1);
        var idvc = '#' + prefix + 'char_c' + col + '_r' + num;
        var idnc = prefix + 'char_c' + col + '_r' + (num - 1);
        var nameon = prefix + 'sfondo_c' + col + '_r' + (num - 1);
        var namecn = prefix + 'char_c' + col + '_r' + (num - 1);
        $(idvo).attr('name', nameon);
        $(idvo).attr('id', idno);
        $(idvc).attr('name', namecn);
        $(idvc).attr('id', idnc);
        var tdv = '#nome2_c' + col + '_r' + num;
        var tdn = 'nome2_c' + col + '_r' + (num - 1);
        var nomeind = '#prova_o_num_c' + col + '_r' + num;
        $(tdv).prepend('<span id="prova_o_num_c' + col + '_r' + (num - 1) + '">riga ' + (num - 1) + '</span>');
        $(tdv).attr('id', tdn);
        $(nomeind).remove();
      }
    }

    function crea_hide_show() {
      colsel = ncol;
      inizio = 0;
      opz1();
      var tabcol = '#' + prefix + 'col_' + colsel;
      var tabbut = '#' + prefix + 'but_' + colsel;
      ncol++;
    }

    $("#colpiu").click(function () {
      crea_hide_show();
    });

    $('#tabella').on('click', '#colmeno', function () {
      var colrem = $(this).attr('data-id');
      var tabcol = '#' + prefix + 'col_' + ncol;
      var tabbut = '#' + prefix + 'but_' + ncol;
      for (var indcol = colrem; indcol < ncol; indcol++) {
        renamecol(indcol);
      }
      ncol--;
      var tab_num = '#tab_num_' + ncol;
      $(tab_num).remove();

    });

    function renamecol(numcol) {
      numcol *= 1;
      for (var num = 0; num <= nrighe; num++) {
        var idvo = '#' + prefix + 'sfondo_c' + (numcol + 1) + '_r' + num;
        var idno = '#' + prefix + 'sfondo_c' + numcol + '_r' + num;
        var idvc = '#' + prefix + 'char_c' + (numcol + 1) + '_r' + num;
        var idnc = '#' + prefix + 'char_c' + numcol + '_r' + num;
        $(idno).val($(idvo).val());
        $(idnc).val($(idvc).val());
      }

    }

    function opz1() {
      console.log(colsel);
      var rigao;
      var rigac;
      var boldchek;
      var sfondo = prefix + 'sfondo';
      var char = prefix + 'char';
      var tabcol = prefix + 'col_';
      var tabcolcanc = '#' + tabcol + colsel;
      var tabbut = prefix + 'but_';
      if (colsel == ncol) {
        $('#coloritab').append(
                '<div id="tab_num_' + colsel + '"style="float:left; text-align:center;">Tabella' + colsel +
                '<div id="tab_col_' + colsel + '" ><div id="tab_but_' + colsel + '"></div></div></div>'
                );
      }
      var tab_col = '#tab_col_' + colsel;
      var tab_but = '#tab_but_' + colsel;
      console.log('ini= ', inizio, ' nrig= ', nrighe);
      for (var indice = inizio; indice <= (nrighe) * 1; indice++) {
        //console.log(indice);
        if (whadda_color['color_s'][colsel] == undefined)
          var whadda_col_s = '#ffffff';
        else if (whadda_color['color_s'][colsel][indice] == undefined)
          whadda_col_s = '#ffffff';
        else
          whadda_col_s = whadda_color['color_s'][colsel][indice];

        if (whadda_color['color_c'][colsel] == undefined)
          var whadda_col_c = '#000000';
        else if (whadda_color['color_c'][colsel][indice] == undefined)
          var whadda_col_c = '#000000';
        else
          whadda_col_c = whadda_color['color_c'][colsel][indice];

        if (indice == 0) {
          $(tab_col).prepend(
                  '<table ><tbody id="' + tabcol + colsel + '" class="whaddacenter">' +
                  '<tr>' +
                  '<th></th>' +
                  '<th>Sfondo</th>' +
                  '<th>Testo</th></tr>' +
                  '</tbody></table>'
                  );
          $(tab_but).prepend(
                  '<table ><tbody id="' + tabbut + colsel + '" class="whaddacenter">' +
                  '<tr>' +
                  '<th></th>' +
                  '<th>Sfondo</th>' +
                  '<th>Testo</th>' +
                  '</tr>' +
                  '<tr>' +
                  '<td id="nome2_c' + colsel + '_r' + indice + '"><span id="prova_o_num_c' + colsel + '_r' + indice + '">button</span></td>' + // da terminare -> nomi e salvataggio
                  '<td><input type="color" name="' + sfondo + '_c' + colsel + '_r' + indice + '" id="' + sfondo + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_s + '"></td>' + // da terminare -> nomi e salvataggio
                  '<td><input type="color" name="' + char + '_c' + colsel + '_r' + indice + '" id="' + char + '_c' + colsel + '_r' + indice + '" value="' + whadda_col_c + '"></td>' + // da terminare -> nomi e salvataggio
                  '</tr>' +
                  '<div class="clear"></div>' +
                  '</tbody></table>'
                  );
        } else {
          $(tabcolcanc).append(
                  '<tr>' +
                  '<td id="nome2_c' + colsel + '_r' + indice + '"><span id="prova_o_num_c' + colsel + '_r' + indice + '">riga ' + indice + '</span></td> ' +
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