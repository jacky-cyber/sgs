$(document).ready(function(){
   $("#muestra").click(function(evento){
      if ($("#muestra").attr("checked")){
        
	 // $("#oculta_datos").css("display", "block");
	   $("#oculta_datos").show(100);
	
      }else{
           $("#oculta_datos").hide("fast");
	  //$("#oculta_datos").css("display", "none");
	   
	
      }
   });
});