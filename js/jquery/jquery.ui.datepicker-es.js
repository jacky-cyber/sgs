/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester [en] gmail [punto] com). */
jQuery(function($){
   $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: 'Ant',
      nextText: 'Sig',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi\u00e9rcoles', 'Jueves', 'Viernes', 'S\u00e1bado'],
      dayNamesShort: ['Dom','Lun','Mar','Mi\u00e9','Juv','Vie','S\u00e1b'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S\u00e1'],
      weekHeader: 'Sm',
      dateFormat: 'dd-mm-yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
	  changeMonth: false,
	  changeYear: true,
      yearSuffix: ''};
   $.datepicker.setDefaults($.datepicker.regional['es']);
});