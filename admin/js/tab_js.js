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
    var url = wadda_var['url'];
    var num = 1;
    var value = "";
    $(numrow).val(righe);
    $(numcol).val(colonne);
    num = tab(num);
    
    var meno = '#colmeno';
    var cont = ($(numrow).val()) * 1;

    if (val == undefined) {
      var val = cont;
    }

    function colon(num) {
      if (num == 1) {
        var disabled = 'disabled';
        var testo = 'non-rimovibile';
      } else {
        disabled = '';
        testo = 'rimuovi';
      }
      if(url[num]== undefined){
       url[num]='';
       }
      $('#tabella').append(
              '<div class="divtab">' +
              '<input type="button" value=' + testo + ' name="colmeno_' + num + '" id="colmeno" class="rimuovi" data-id="' + num + '"' + disabled + '/>' +
              '<table id="col_' + num + '">' +
              '<tbody id="tb_' + num + '">' +
              '<th id="tab_' + num + '">Tabella ' + num + '</th>' +
              '</tbody>' +
              '</table>' +
              '<input type="text" id="' + prefix + 'c' + num +'" name="' + prefix + 'c' + num + '" value="' + url[num] + '" placeholder="https://" class="input_tab_url">' +
              '</div>'
              )
    }

    function riga(num, i) {
      var idt = '#tb_' + num;
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
      var idtab = '#tb_' + num;
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
      num=colonne;
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

    $('#tabella').on('click', meno, function () {
      //console.log($(this).attr('data-id'));
      // console.log("num= ",num);
     // console.log('nump=',num,' colonnep= ',colonne);
      if (num > 1) {
        var numid = $(this).attr('data-id');
        var id = '#' + 'col_' + numid;
        $(id).parent().remove();
        colonne++;
        num--;
        var i = 1;
        var riga = $(numrow).val();
        for (var ind = numid; ind <= num; ind++) {
          if (i <= riga) {
            var idp = '#' + prefix + 'c' + (ind * 1 + 1) + '_r' + i;
            var idnew = prefix + 'c' + ind + '_r' + i;
            //var namep= prefix + 'c' + (ind*1+1) + '_r' + i; 
            var namenew = prefix + 'c' + ind + '_r' + i;
            //console.log('idp= ',idp,' idnew= ',idnew);
            $(idp).attr('name', namenew);
            $(idp).attr('id', idnew);
            i++;
            ind--;
          } else {
            var tabnew = 'tab_' + ind;
            var tabp = '#tab_' + (ind * 1 + 1);
            var idtp = '#col_' + (ind * 1 + 1);
            var idtnew = 'col_' + ind;
            $(idtp).prepend(
                    '<th id="' + tabnew + '">Tabella ' + ind + '</th>'
                    );
            $(tabp).remove();
            $(idtp).attr('id', idtnew);
            var colmp = 'input' + '[name="colmeno_' + (ind * 1 + 1) + '"]';
            var colmnew = 'colmeno_' + ind;
            var tbp = '#tb_' + (ind * 1 + 1);
            var tbpnew = 'tb_' + ind;
            $(tbp).attr('id',tbpnew);
            $(colmp).attr('data-id', ind);
            $(colmp).attr('name', colmnew);
            //console.log('tabp= ',tabp,' tabnew= ',tabnew);
            i = 1;
         }   
        }
        colonne = num;
      }
      
      $(numcol).val(colonne);
      //console.log('numd=',num,' colonned= ',colonne);
    });

    $('#colpiu').click(function () {
      if (num < 10) {
        num = (colonne * 1) + 1;
        colonne = num;
        colon(num);
        for (var i = 1; i <= righe; i++) {
          rigapiu(num, i);
        }
        $(numcol).val(colonne);
      }
    });


  });
})(jQuery);

