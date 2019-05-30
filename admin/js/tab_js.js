/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
  'use strict';

  $(function () {
    //inizializzo le variabili comuni alle funzioni successive
    var prefix = 'whadda_';
    var numcol = '#' + prefix + 'ncols';
    var numrow = '#' + prefix + 'nrows';
    var colonne = wadda_var['colonne']; //num colonne passate da php
    var righe = wadda_var['righe']; //num righe passate da php
    var url = wadda_var['url']; // url passato da php
    var num = 1; // inizializzo prima colonna
    var value = "";
    $(numrow).val(righe); //carico input numrow con il numero di righe passate da php
    $(numcol).val(colonne); //carico input numcol con il numero di colonne passate da php
    num = tab(num); // creo la prima tabella
    
    var meno = '#colmeno';
    var cont = ($(numrow).val()) * 1; //trasformo il valore aquisito da input in numero

    if (val == undefined) {
      var val = cont; 
    }
 // funzione che crea le colonne
    function colon(num) {
      if (num == 1) {
        var disabled = 'disabled'; // disabilito il pulsante rimuovi alla prima colonna
        var testo = 'non-rimovibile';
      } else {
        disabled = '';
        testo = 'rimuovi';
      }
      if (url[num] === undefined) {
        url[num] = '';  //inizializzo url se non ancora inizializzato
      }
      //creo tabella, id colmeno uguale per tutti i bottoni rimuovi colonna
      $('#tabella').append(
              '<div class="divtab">' +
              '<input type="button" value=' + testo + ' name="colmeno_' + num + '" id="colmeno" class="rimuovi" data-id="' + num + '"' + disabled + '/>' +
              '<table id="col_' + num + '">' +
              '<tbody id="tb_' + num + '">' +
              '<th id="tab_' + num + '">Tabella ' + num + '</th>' +
              '</tbody>' +
              '</table>' + '<span class="span_tab_url"><button type="button" disabled>-</button></span>' +
              '<input class="clear" type="text" id="' + prefix + 'c' + num + '" name="' + prefix + 'c' + num + '" value="' + url[num] + '" placeholder="https://" >' +
              '</div>'
              )
    }
    // creo righe
    function riga(num, i) {
      var idt = '#tb_' + num;
      if (wadda_var['value'][num][i] === undefined) // verifico presenza valori iniziali
        value = '';
      else
        value = wadda_var['value'][num][i];
      // faccio le prime 3 righe non rimovibli-> l'id rigameno ugulae per tutti i bottoni di rigameno
      if (i < 4) {
        $(idt).append(
                '<tr>' +
                '<td>' + '<span><button type="button" disabled>-</button></span>' +
                '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '" value="' + value + '">' +
                '</td>' +
                '</tr>'
                );
      } else
        $(idt).append(
                '<tr>' +
                '<td>' + '<span><button type="button" name="rigameno" id="rigameno" data-id="' + i + '">-</button></span>' +
                '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '" value="' + value + '">' +
                '</td>' +
                '</tr>'
                );

    }
    // funzione che aggiunge righe
    function rigapiu(num, i) {
      var idtab = '#tb_' + num;
      if (i > 3) {  // verifico se aggiungo alle prime 3 o creo le prime 3
        // faccio le prime 3 righe non rimovibli-> l'id rigameno ugulae per tutti i bottoni di rigameno
        $(idtab).append(
                '<tr>' +
                '<td>' + '<span><button type="button" name="rigameno" id="rigameno" data-id="' + i + '">-</button></span>' +
                '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '">' +
                '</td>' +
                '</tr>'
                );
      } else {
        $(idtab).append(
                '<tr>' +
                '<td>' + '<span><button type="button" disabled>-</button></span>' +
                '<input type="text" id="' + prefix + 'c' + num + '_r' + i + '" name="' + prefix + 'c' + num + '_r' + i + '">' +
                '</td>' +
                '</tr>'
                );

      }
    }
    //funzione che crea la tabella
    function tab(num) {
      while (num <= colonne) {
        colon(num);
        for (var i = 1; i <= righe; i++) {
          riga(num, i);
        }
        num++;
      }
      num = colonne;
      return num;
    }
    // funzione per aggiunge riga a pressione bottone
    $('#rigapiu').click(function () {
      if (cont < 13) {
        cont = cont + 1;
        val = cont;
        $(numrow).val(val);
        for (var newnum = 1; newnum <= num; newnum++) { // ciclo l'aggiunta per ogni colonna
          rigapiu(newnum, val);
        }
      }
      righe = val; //aggiorno valore numero riga 
    });
    // acquisisco il click sul bottone rigameno per rimouvere riga selezionata, cerca #rigameno in #tabella
    $('#tabella').on('click', '#rigameno', function () {
      var rig = $(this).attr('data-id') * 1;  // leggo data-id che contiene nun riga selezionata
      //console.log(rig);
      for (var newnum = 1; newnum <= num; newnum++) { //preparo ciclo per ogni colonna
        var id = '#' + prefix + 'c' + newnum + '_r' + rig;
        $(id).parent().parent().remove(); // rimuovo riga
        var ind = 0;
        for (ind = rig; ind <= val; ind++) {  //preparo ciclo per spostare righe successive
          var button='button[data-id="'+(ind+1)+'"]'; // preparo valore che identifica bottone successivo
          $(button).attr('data-id',ind); //cambio il suo valore data-id con quello nuovo
          var idp = '#' + prefix + 'c' + newnum + '_r' + (ind + 1); //identifico riga successiva (per id)
          var idn = prefix + 'c' + newnum + '_r' + (ind); // preparo nuovo valore id riga
          $(idp).attr('data-id', (idn)); //carico nuovo data-id
          $(idp).attr('name', idn); // carico nuovo name
          $(idp).attr('id', idn); //carico nuovo id 
        }
      }
      cont--;
      val = cont;
      righe = val;
      $(numrow).val(val); //aggiorno valore campo input per nuovo numero righe

    });
    // acquisisco il click sul bottone colmeno per rimouvere colonna selezionata, cerca #colmeno in #tabella
    $('#tabella').on('click', meno, function () {
      if (num > 1) { //verifico che vi sia più di una tabella
        var numid = $(this).attr('data-id'); // acquisisco data-id con numero colonna selezionata
        var id = '#' + 'col_' + numid;
        $(id).parent().remove(); // rimuovo colonna
        colonne++;
        num--;
        var i = 1;
        var riga = $(numrow).val(); //controllo numero righe
        for (var ind = numid; ind <= num; ind++) { //preparo ciclo per tutte le colonne
          if (i <= riga) { // ciclo per tutte le righe della colonna
            var idp = '#' + prefix + 'c' + (ind * 1 + 1) + '_r' + i; //identifico riga successiva
            var idnew = prefix + 'c' + ind + '_r' + i;
            var namenew = prefix + 'c' + ind + '_r' + i;
            $(idp).attr('name', namenew); //aggiorno name
            $(idp).attr('id', idnew); //aggiorno id
            i++;
            ind--;
          } else {
            var tabnew = 'tab_' + ind;
            var tabp = '#tab_' + (ind * 1 + 1); // num tabella
            var idtp = '#col_' + (ind * 1 + 1); // num colonna
            var idtnew = 'col_' + ind;
            $(idtp).prepend(
                    '<th id="' + tabnew + '">Tabella ' + ind + '</th>' // appendo nuovo th con nuovo testo
                    );
            $(tabp).remove(); //rimuovo vecchio th 
            $(idtp).attr('id', idtnew); // aggiorno id colonna
            var colmp = 'input' + '[name="colmeno_' + (ind * 1 + 1) + '"]'; //preparo identificativo input colmeno
            var colmnew = 'colmeno_' + ind;
            var tbp = '#tb_' + (ind * 1 + 1);
            var tbpnew = 'tb_' + ind;
            $(tbp).attr('id', tbpnew); //nuovo id tablella
            $(colmp).attr('data-id', ind); // nuovo data-id colmeno
            $(colmp).attr('name', colmnew); // nuovo nome colmeno
            i = 1;
          }
        }
        colonne = num;
      }

      $(numcol).val(colonne);// aggiorno numero colonne
    });
    // aggiungo collonna al click su bottone colpiu
    $('#colpiu').click(function () {
      if (num < 10) { // verifico numero max colonne
        num = (colonne * 1) + 1;
        colonne = num;
        colon(num); // richiamo la funzione colon()
        for (var i = 1; i <= righe; i++) { //preparo ciclio per num righe
          rigapiu(num, i); //richiamo rigapiu per in numero giche necessario
        }
        $(numcol).val(colonne); //aggiorno numero colonne
      }
    });
  //bordi select_bordi
  $('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
    $('#select_bordi').change(function () {
      //if ($('#select_bordi option:selected').val() !== 'manuale')
      var tipobordo = $('#select_bordi option:selected').val();
      
      switch (tipobordo) {
        case 'poco' :
          {
            $('#whadda_border_radius').val('0.25 em');
            $('#whadda_border_radius').attr('readonly','readonly');
            //$('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
          }
          break;
        case 'medio' :
          {
            $('#whadda_border_radius').val('0.5 em');
            $('#whadda_border_radius').attr('readonly','readonly');
           // $('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
          }
          break;
        case 'tanto':
          {
            $('#whadda_border_radius').val('1 em');
            $('#whadda_border_radius').attr('readonly','readonly');
           // $('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
          }
          break;
        case 'manuale':
          {
            $('#whadda_border_radius').removeAttr('readonly');
          }
          break;
        default :
          {
            $('#whadda_border_radius').val('0');
            $('#whadda_border_radius').attr('readonly','readonly');
           // $('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
          }
          break;
      }
      });
      
     /* $('#whadda_border_radius').change(function(){
        / $('.divangoli').css('border-radius',$('#whadda_border_radius').val()+'em');
     
    });*/
 
  });
})(jQuery);

