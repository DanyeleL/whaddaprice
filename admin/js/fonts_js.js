/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
  'use strict';

  $(function () {
    if (whadda_fonts['option'] != null)
      var ind = whadda_fonts['option'].length;
    //console.log(test);
    var num_nomefont = '';
    var variants = '';
    var sel = $("#font option:selected").val();
    //console.log(sel);
    if (whadda_fonts['varifont'] == undefined) {
      var varifont = '';
    } else
      varifont = whadda_fonts['varifont'];
    genera();

    $("#font").change(function () {
      sel = $("#font option:selected").val();
      genera();
    })

    $('#vari').change(function () {
      var vari = $("#vari option:selected").val();
      // console.log(wadda_fonts['option'][num_nomefont]['files'][vari]);
      if ($("#vari option:selected").val() == "Default") {
        $('#whadda_fonts').val("");
        $('#whadda_namefont').val("Default");
        $('#whadda_varifont').val("Default");
      } else {
        $('#whadda_fonts').val(whadda_fonts['option'][num_nomefont]['files'][vari]);
        $('#whadda_namefont').val(whadda_fonts['option'][num_nomefont]['family']);
        $('#whadda_varifont').val(vari);
      }
    });

    function genera() {
      if (varifont == 'Default') {
        $('#cat').children().remove();
        $("#cat").append('<option>Default</option>');
        $('#vari').children().remove();
        $("#vari").append('<option selected>Default</option>');
      } else {
        $('#cat').children().remove();
        $("#cat").append('<option>Default</option>');
        $('#vari').children().remove();
        $("#vari").append('<option>Default</option>');

        for (var i = 0; i < ind; i++) {
          if (whadda_fonts['option'][i]['family'] == sel) {
            num_nomefont = i;
            $('#cat').children().remove();
            $("#cat").append('<option>' + whadda_fonts['option'][i]['category'] + '</option>');
            // console.log(wadda_fonts['option'][i]['category']);
            $('#vari').children().remove();
            if (whadda_fonts['option'][i]['variants'].length > 1) {
              for (var indv = 0; indv < whadda_fonts['option'][i]['variants'].length; indv++) {
                //console.log(varifont);
                if (whadda_fonts['option'][i]['variants'][indv] == varifont)
                  $("#vari").append('<option selected>' + whadda_fonts['option'][i]['variants'][indv] + '</option>');
                else
                  $("#vari").append('<option>' + whadda_fonts['option'][i]['variants'][indv] + '</option>');
              }
            } else {
              if (whadda_fonts['option'][i]['variants'] == varifont)
                $("#vari").append('<option selected>' + whadda_fonts['option'][i]['variants'] + '</option>');
              else
                $("#vari").append('<option>' + whadda_fonts['option'][i]['variants'] + '</option>');
              //console.log();
            }
          }
        }
      }
    }
    /*---------da finire ---------------*/

    var prefix = 'whadda_';
    var numrow = '#' + prefix + 'nrows';
    var nrighe = $(numrow).val();
    var inizio = 0;
    var indice = 0;
    opz();
    $('#rigapiu').click(function () {
      if (nrighe < 13) {
        nrighe++;
        inizio = nrighe;
        opz();
      }
    });

    $('#tabella').on('click', '#rigameno', function () {
      var idrm = $(this).attr('data-id');
      opz_r(idrm);
      nrighe--;
      inizio = nrighe;
    });

    function opz_r(idrm) {
      console.log(nrighe);
      var id = '#' + prefix + 'bold_r' + idrm;
      $(id).parent().parent().remove();
      for (var num = (idrm * 1) + 1; num <= nrighe; num++) {
        var idvo = '#' + prefix + 'stile_o_r' + num;
        var idno = prefix + 'stile_o_r' + (num - 1);
        var idvc = '#' + prefix + 'stile_c_r' + num;
        var idnc = prefix + 'stile_c_r' + (num - 1);
        var idvb = '#' + prefix + 'bold_r' + num;
        var idnb = prefix + 'bold_r' + (num - 1);
        var nameon = prefix + 'stile_o_r' + (num - 1);
        var namecn = prefix + 'stile_c_r' + (num - 1);
        var namebn = prefix + 'bold_r' + (num - 1);
        $(idvo).attr('name', nameon);
        $(idvo).attr('id', idno);
        $(idvc).attr('name', namecn);
        $(idvc).attr('id', idnc);
        $(idvb).attr('name', namebn);
        $(idvb).attr('id', idnb);
        var tdv = '#nome_' + num;
        var tdn = 'nome_' + (num - 1);
        var nomeind = '#stile_o_num' + num;
        $(tdv).prepend('<span id="stile_o_num' + (num - 1) + '">riga ' + (num - 1) + '</span>');
        $(tdv).attr('id', tdn);
        $(nomeind).remove();
        //indice=num-1;
      }

    }

    function opz() {
      var rigao;
      var rigac;
      var boldchek;
      var stile_o = prefix + 'stile_o_r';
      var stile_c = prefix + 'stile_c_r';
      var bold = prefix + 'bold_r';
      for (var indice = inizio; indice <= (nrighe) * 1; indice++) {
        // console.log(nrighe);
        if (indice == 0) {
          $('#testare').append(
                  '<tr>' +
                  '<th></th>'+
                  '<th>Obliquo</th>' +
                  '<th>Corsivo</th>' +
                  '<th>Bold</th></tr>'
                  );
        } else {
          //console.log("indice= " + indice + " rigao= " + whadda_fonts['rigao'][indice]);
          // console.log("indice= " + indice + " rigac= " + whadda_fonts['rigac'][indice]);
          //console.log("indice= " + indice + " bold= " + whadda_fonts['bold'][indice]);
          if (whadda_fonts['rigao'][indice] == undefined || whadda_fonts['rigao'][indice] == "") {
            rigao = "";
          } else
            rigao = "checked";
          if (whadda_fonts['rigac'][indice] == undefined || whadda_fonts['rigac'][indice] == "") {
            rigac = "";
          } else
            rigac = "checked";
          if (whadda_fonts['bold'][indice] == undefined || whadda_fonts['bold'][indice] == "") {
            boldchek = "";
          } else
            boldchek = "checked";


          $('#testare').append(
                  '<tr>' +
                  '<td id="nome_' + indice + '"><span id="stile_o_num' + indice + '">riga '+indice + '</span></td> ' + 
                  '<td><input type="checkbox" name="' + stile_o + indice + '" id="' + stile_o + indice + '" value="' + 1 + '" ' + rigao + '></td>' +
                  '<td><input type="checkbox" name="' + stile_c + indice + '" id="' + stile_c + indice + '" value="' + 2 + '" ' + rigac + '></td>' +
                  '<td><input type="checkbox" name="' + bold + indice + '" id="' + bold + indice + '" value="' + 3 + '" ' + boldchek + '></td>' +
                  '</tr>' +
                  '<div style="clear:both;"></div>'
                  );
        }
      }
    }
  });

})(jQuery);