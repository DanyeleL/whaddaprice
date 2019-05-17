/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
  'use strict';

  $(function () {
    var prefix = 'whadda_';
    var numcol = '#' + prefix + 'ncols';
    var numrow = '#' + prefix + 'nrows';
    var colonne = wadda_var['colonne'];
    var righe = wadda_var['righe'];
    var num = 1;
    var value = "";
    $(numrow).val(righe);
    $(numcol).val(colonne);
    num = tab(num);
    var cont = ($(numrow).val()) * 1;

    if (val == undefined) {
      var val = cont;
    }

    function colon(num) {
      $('#tabella').append(
              '<div style="float:left;">' +
              '<input type="button" value="rimuovi colonna" name="colmeno" id="colmeno_' + num + '" class="rimuovi" data-id="' + num + '"/>' +
              '<table style="border: 1px solid #ddd; border-radius: 5px;" id="col_' + num + '">' +
              '<tbody>' +
              '<th id="tab_' + num + '">Tabella ' + num + '</th>' +
              '</tbody>' +
              '</table>' +
              '</div>'
              )
    }

    function riga(num, i) {
      var idt = '#tab_' + num;
      if (wadda_var['value'][num][i] == undefined)
        value = "";
      else
        value = wadda_var['value'][num][i];
      $(idt).append(
              '<tr>' +
              '<td>' +
              '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '" value="' + value + '">' +
              '</td>' +
              '</tr>'
              );
    }

    function rigapiu(num, i) {
      var idtab = '#tab_' + num;
      $(idtab).append(
              '<tr>' +
              '<td>' +
              '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '">' +
              '</td>' +
              '</tr>'
              );

    }

    function tab(num) {
      while (num <= colonne) {
        colon(num);
        for (var i = 1; i <= righe; i++) {
          riga(num, i);
        }
        num++;
      }
      return num;
    }

    $('#rigapiu').click(function () {
      if (cont < 10) {
        cont = cont + 1;
        val = cont;
        $(numrow).val(val);
        for (var newnum = 1; newnum <= num; newnum++) {
          rigapiu(newnum, val);
        }
      }
      righe = val;
    });

    $('#rigameno').click(function () {
      if (val > 3) {
        for (var newnum = 1; newnum <= num; newnum++) {
          var id = '#' + prefix + 'c' + newnum + '_r' + val;
          $(id).parent().parent().remove();
        }
        cont--;
        val = cont;
        righe = val;
        $(numrow).val(val);
      }

    });

    $('#colpiu').click(function () {
      num = (colonne * 1) + 1;
      colonne = num;
      colon(num);
      for (var i = 1; i <= righe; i++) {
        rigapiu(num, i);
      }
      $(numcol).val(colonne);
    });


  });
})(jQuery);

