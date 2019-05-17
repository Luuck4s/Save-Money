(function ($) {
  $(function () {

    $('.sidenav').sidenav();
    $('.parallax').parallax();

    $(document).ready(function(){
      $('.modal').modal();
    });

    $(".dropdown-trigger").dropdown();

    $(document).ready(function () {
      $('.sidenav').sidenav();
    });

    $(document).ready(function () {
      $('.slider').slider({
        full_width: true
      });
    });

    $(document).ready(function () {
      $('input#input_text, textarea#descricaoArea').characterCounter();
    });

    $(document).ready(function() {
      $('input#input_text, textarea#respostaSegu').characterCounter();
    });

    $(document).ready(function(){
      $('select').formSelect();
    });

    $(document).ready(function () {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        i18n: {
          months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
            'Setembro', 'Outubro', 'Novembro', 'Dezembro'
          ],
          monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out',
            'Nov', 'Dez'
          ],
          weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
          weekdaysAbbrev: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
          today: 'Hoje',
          clear: 'Limpar',
          close: 'Pronto',
          labelMonthNext: 'Próximo mês',
          labelMonthPrev: 'Mês anterior',
          labelMonthSelect: 'Selecione um mês',
          labelYearSelect: 'Selecione um ano',
          selectMonths: true,
          selectYears: 15,
          cancel: 'Cancelar',
          clear: 'Limpar'
        }
      });
    });
  }); // end of document ready

})(jQuery); // end of jQuery name space


