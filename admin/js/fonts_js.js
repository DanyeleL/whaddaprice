/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
  'use strict';

  $(function () {

    var set_c = "";
    var set_o = "";
    var set_b = "";
    var varifont = '';
    if (whadda_fonts['option'] != null) //controllo presenza valori
      var ind = whadda_fonts['option'].length; // calcolo numero valori per cicli successivi
    //console.log(ind);
    var num_nomefont = '';
    var variants = '';
    var flag = 0;
    $('#whadda_font_vd').change(function () {

      for (var f in whadda_fonts['option']) {
        var nome = whadda_fonts['option'][f]['family'];
        if (nome == $('#whadda_font_nd').attr('data-id')) {
          var op = 'option[value="' + nome + '"]';
          var opd = 'option[value="Default"]';
          $(op).attr('selected', 'selected');
          $(opd).removeAttr('selected');
          flag = 1;
        } else {
          var op = 'option[value="' + nome + '"]';
          $(op).removeAttr('selected');
        }

      }
      if (flag == 0) {
        var opd = 'option[value="Default"]';
        $(opd).attr('selected', 'selected');
        nome = 'Default'
      }
      varifont = $('#whadda_font_vd').attr('data-id');
      if (nome != 'Default') {
        $('#whadda_fonts').val($('#whadda_font_fd').attr('data-id'));
      }
      $("#font").trigger('change');
    });


    //console.log($("#font option:selected").val());
    var sel = $("#font option:selected").val(); // leggo option selezionato
    //console.log(sel);
    if (whadda_fonts['varifont'] == undefined) { //leggo se presenti tipologie di font
      varifont = '';
    } else
      varifont = whadda_fonts['varifont'];
    genera(); // popolo tabella primo giro


    $("#font").change(function () {
      sel = $("#font option:selected").val();
      genera(); // cambio contenuto talella in base a elemento selezionato
    })


    $('#vario').change(function () { /*in base alle selezioni carico i valori negli input da salvare in db*/
      var vari = $("#vario option:selected").val();
      // console.log(wadda_fonts['option'][num_nomefont]['files'][vari]);
      if ($("#vario option:selected").val() == "Default") {
        $('#whadda_fonts').val("");
        $('#whadda_namefont').val("Default");
        $('#whadda_varifont').val("Default");
      } else {
        $('#whadda_fonts').val(whadda_fonts['option'][num_nomefont]['files'][vari]);
        $('#whadda_namefont').val(whadda_fonts['option'][num_nomefont]['family']);
        $('#whadda_varifont').val(vari);
      }
      $('#whadda_fonts').trigger('change');
    });

    function genera() { /*popolo le tabelle con i valori in base alle selezioni*/
      if (varifont == 'Default' || whadda_fonts['option'] == null) {
        $('#cat').children().remove();
        $("#cat").append('<option value="Default">Default</option>');
        $('#vario').children().remove();
        $("#vario").append('<option value="Default" selected>Default</option>');
      } else {
        $('#cat').children().remove();
        $("#cat").append('<option value="Default">Default</option>');
        $('#vario').children().remove();
        $("#vario").append('<option value="Default">Default</option>');

        for (var i = 0; i < ind; i++) {
          if (whadda_fonts['option'][i]['family'] == sel) {
            num_nomefont = i;
            $('#cat').children().remove();
            $("#cat").append('<option value="' + whadda_fonts['option'][i]['category'] + '">' + whadda_fonts['option'][i]['category'] + '</option>');
            //console.log(whadda_fonts['option'][i]['category']);
            $('#vario').children().remove();
            if (whadda_fonts['option'][i]['variants'].length > 1) {
              for (var indv = 0; indv < whadda_fonts['option'][i]['variants'].length; indv++) {
                //console.log(varifont);
                if (whadda_fonts['option'][i]['variants'][indv] == varifont)
                  $("#vario").append('<option value="' + whadda_fonts['option'][i]['variants'][indv] + '" selected>' + whadda_fonts['option'][i]['variants'][indv] + '</option>');
                else
                  $("#vario").append('<option value="' + whadda_fonts['option'][i]['variants'][indv] + '">' + whadda_fonts['option'][i]['variants'][indv] + '</option>');
              }
            } else {
              if (whadda_fonts['option'][i]['variants'] == varifont)
                $("#vario").append('<option value="' + whadda_fonts['option'][i]['variants'] + '" selected>' + whadda_fonts['option'][i]['variants'] + '</option>');
              else
                $("#vario").append('<option value="' + whadda_fonts['option'][i]['variants'] + '">' + whadda_fonts['option'][i]['variants'] + '</option>');
              //console.log();
            }
          }
        }
      }
    }


    /*--------------tabelle checkbox -------------------*/
    var prefix = 'whadda_';
    var numrow = '#' + prefix + 'nrows';
    var nrighe = $(numrow).val();
    var inizio = 0;
    var indice = 0;
    opz(); /*chiama funzione che crea tabelle con checkbox*/

    $('#rigapiu').click(function () {
      if (nrighe < 13) { //controllo numero righe
        nrighe++;
        inizio = nrighe;
        // set_c=$('#whadda_set_c').attr('data-id');
        set_o = $('#whadda_set_o').attr('data-id');
        set_b = $('#whadda_set_b').attr('data-id');
        opz(); //creo tabella checkbox con riga in più
      }
    });

    $('#tabella').on('click', '#rigameno', function () { //rimuovo riga
      var idrm = $(this).attr('data-id'); // acquisisco numero riga da rimuovere
      opz_r(idrm); //chiamo funzione rimozione riga e gli passo numero riga da rimuovere
      nrighe--; //aggiorno numro righe
      inizio = nrighe; // aggiorno valore iniziale
    });

    function opz_r(idrm) { // funzione che rimuove righe
      //console.log(nrighe);
      var id = '#' + prefix + 'bold_r' + idrm; //id per rimozione
      $(id).parent().parent().remove();// rimuovo tr associato a riga da rimuovere
      for (var num = (idrm * 1) + 1; num <= nrighe; num++) { // aggiorno contenuto righe
        var idvo = '#' + prefix + 'stile_o_r' + num;
        var idno = prefix + 'stile_o_r' + (num - 1);
        // var idvc = '#' + prefix + 'stile_c_r' + num;
        //var idnc = prefix + 'stile_c_r' + (num - 1);
        var idvb = '#' + prefix + 'bold_r' + num;
        var idnb = prefix + 'bold_r' + (num - 1);
        var nameon = prefix + 'stile_o_r' + (num - 1);
        //  var namecn = prefix + 'stile_c_r' + (num - 1);
        var namebn = prefix + 'bold_r' + (num - 1);
        $(idvo).attr('name', nameon);
        $(idvo).attr('id', idno);
        //$(idvc).attr('name', namecn);
        //$(idvc).attr('id', idnc);
        $(idvb).attr('name', namebn);
        $(idvb).attr('id', idnb);
        var tdv = '#nome_' + num;
        var tdn = 'nome_' + (num - 1);
        var nomeind = '#stile_o_num' + num;
        $(tdv).prepend('<span id="stile_o_num' + (num - 1) + '">'+whadda_fonts['testi'][2] + (num - 1) + '</span>');
        $(tdv).attr('id', tdn);
        $(nomeind).remove(); // rimuovo vecchio nome riga aggiornata
        //indice=num-1;
      }

    }

    function opz() { // creo tabella checkbox
      var rigao;
      var rigac;
      var boldchek;
      var stile_o = prefix + 'stile_o_r';
      // var stile_c = prefix + 'stile_c_r';
      var bold = prefix + 'bold_r';
      for (var indice = inizio; indice <= (nrighe) * 1; indice++) {
        // console.log(nrighe);
        if (indice == 0) { // primo giro creo titoli
          $('#whadda_tboby').append(
                  '<tr>' +
                  '<th></th>' +
                  '<th>'+whadda_fonts['testi'][0]+'</th>' +
                  // '<th>Corsivo</th>' +
                  '<th>'+whadda_fonts['testi'][1]+'</th></tr>'
                  );
        } else { // popolo tabella con checkbox salvati in db
          if (whadda_fonts['rigao'][indice] == undefined || whadda_fonts['rigao'][indice] == "") {
            rigao = set_o;
          } else
            rigao = "checked";
          /* if (whadda_fonts['rigac'][indice] == undefined || whadda_fonts['rigac'][indice] == "") {
           rigac = set_c;
           } else
           rigac = "checked";*/
          if (whadda_fonts['bold'][indice] == undefined || whadda_fonts['bold'][indice] == "") {
            boldchek = set_b;
          } else
            boldchek = "checked";

          //genero le checbok e popolo la tabella
          $('#whadda_tboby').append(
                  '<tr>' +
                  '<td id="nome_' + indice + '"><span id="stile_o_num' + indice + '">riga ' + indice + '</span></td> ' +
                  '<td><input type="checkbox" name="' + stile_o + indice + '" id="' + stile_o + indice + '" value="oblique" ' + rigao + '></td>' +
                  //'<td><input type="checkbox" name="' + stile_c + indice + '" id="' + stile_c + indice + '" value="' + 2 + '" ' + rigac + '></td>' +
                  '<td><input type="checkbox" name="' + bold + indice + '" id="' + bold + indice + '" value="bold" ' + boldchek + '></td>' +
                  '</tr>' +
                  '<div style="clear:both;"></div>'
                  );
        }
      }
    }
    /* $('#whadda_fonts').change(function(){
     $('style').remove('@font-face');
     $('style').remove('whadda_font');
     $('style').append('@font-face{ font-family:whadda_font;'+
     'src: url('+$('#whadda_fonts').val()+');'+
     '}',);
     $('style').append('.whadda_font{ font-family:whadda_font;}',);
     });*/
  });

})(jQuery);