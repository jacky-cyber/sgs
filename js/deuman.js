function confirmar( mensaje, destino){  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}





function ObtenerDatos(datos,div_destino) { 
		var div_destino;
		var datos;
		//var url_consulta=datos;
		//var div2 = div_destino;
		
		if(div_destino==''){
			div_destino='div_respuesta';
		}
		
		
		/**/
		$.ajax ({
				url:  datos,								
				type: 'get',										
				async:true,
       			beforeSend: function(objeto){ 
          		     $('#'+div_destino).html("<img src=images/ajax-loader.gif  border=0>");
       			 },
				success: function(request, settings)
				{	
					$('#'+div_destino).html(request); 
					
				}			
			});




}

	function lookup(inputString,campo_input,tabla_input) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("deuman/autocompleta.php", {queryString: ""+inputString+"",campo: ""+campo_input+"",tabla: ""+tabla_input+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,campo) {
		$("#"+campo).val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	

	
	
	
if ( document.getElementById('mensaje_tool') ){

startList = function() {
if (document.all&&document.getElementById) {
  navRoot = document.getElementById("nav");
  for (i=0; i<navRoot.childNodes.length; i++) {
	node = navRoot.childNodes[i];
	if (node.nodeName=="LI") {
	  node.onmouseover=function() {
		this.className+=" over";
	  }
	  node.onmouseout=function() {
		this.className=this.className.replace(" over", "");
	  }
	}
  }
}
}
window.onload=startList;
        		
				
$(document).ready( function() { 
		
$(window).load(function () {

$('#mensaje_tool').fadeIn('slow');
$('#mensaje_tool').animate({opacity: 1.0}, 1700)

$('#mensaje_tool').fadeOut('0');




});

 } ); 		

}	
			


		//$(document).ready(function () 
	//	{
		//	$('#boton').click(function() 
			//{ procesar('index.php');
			//});
		//});
		
		
			
		function procesar(url,div)
		{
		var url_consulta=url;
		//var formulario="form1";
		//var form_div="contenido";
		//var resp_div="div_respuesta";
		//var loading_div="div_cargando";

		if(div==''){
		div='div_respuesta';
		}
			$.ajax ({
				url:  url_consulta,								/* URL a invocar asíncronamente */
				type: 'post',										/* Método utilizado para el requerimiento */
				data: $('#form1').serialize(),		/* Información local a enviarse con el requerimiento */
				async:true,
       			beforeSend: function(objeto){ /*mostramos un mensaje de espera*/
          		   $('#div_cargando').show(); 
				   $('#div_respuesta').hide();
			   $('#boton').attr('disabled',true);
				    
				   
       			 },
				success: function(request, settings)/* Que hacer en caso de ser exitoso el requerimiento */
				{	
					 $('#div_cargando').hide();
					 $('#div_respuesta').show(); 
					 $('#'+div).html(request); 
					$('#boton').attr('disabled',false);
					
					 //  resetForm('form1');
				},
				error: function(request, settings)/*Upsss... algun problema*/
				{
					$('#div_respuesta').html('Error');
					$('#div_respuesta').addClass('alert alert-error');
					
				}				
			});
		}
		
		function resetForm(id) {
				$('#'+id).each(function(){
	       			 this.reset();
				});
			}
		
   		
		
function agregar_fila_tabla(url,id_tabla)
		{
		var url_consulta=url;
		
		
			$.ajax ({
				url:  url_consulta,								/* URL a invocar asíncronamente */
				type: 'post',										/* Método utilizado para el requerimiento */
				data: $('#form1').serialize(),		/* Información local a enviarse con el requerimiento */
				async:true,
       			beforeSend: function(objeto){ /*mostramos un mensaje de espera*/
          		$('#div_cargando').show(); 
				$('#boton').attr('disabled',true);
				   
       			 },
				success: function(request, settings)/* Que hacer en caso de ser exitoso el requerimiento */
				{	
					 $('#div_cargando').hide();
					 $('#'+id_tabla+' > tbody > tr:nth-child(2)').attr('class','');
					 $('#'+id_tabla+' > tbody > tr:first').after(request);
					 $('#'+id_tabla+' > tbody > tr:nth-child(2)').fadeOut(0);
					 $('#'+id_tabla+' > tbody > tr:nth-child(2)').fadeIn(800,function(){
					 	$(this).attr('class','nuevo');
					 });
					 $('#boton').attr('disabled',false);
					
					
				},
				error: function(request, settings)/*Upsss... algun problema*/
				{
					$('#div_respuesta').html('Error');
				}				
			});
		} 

$(document).ready(function(){
  // Reset Font Size
  var originalFontSize = $('#contenido').css('font-size');
  $("#reset").click(function(){
  $('#contenido').css('font-size', originalFontSize);
  });
  // Increase Font Size
  $("#mas").click(function(){
  	var currentFontSize = $('#contenido').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*1.2;
	$('#contenido').css('font-size', newFontSize);
	return false;
  });
  // Decrease Font Size
  $("#menos").click(function(){
  	var currentFontSize = $('#contenido').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*0.8;
	$('#contenido').css('font-size', newFontSize);
	return false;
  });
});
		
<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$("#root ul").each(function() {$(this).css("display", "none");});
		$("#root .category").click(function() {
			var childid = "#" + $(this).attr("childid");
			if ($(childid).css("display") == "none") {$(childid).css("display", "block");}
			else {$(childid).css("display", "none");}
			if ($(this).hasClass("cat_close")) {$(this).removeClass("cat_close").addClass("cat_open");}
			else{$(this).removeClass("cat_open").addClass("cat_close");}
		});
	});
//--><!]]>


/*********************************************************************
* Author: Iván Guardado Castro
* Reference: http://web.ontuts.com | http://twitter.com/ivanguardado
**********************************************************************/
(function(a){
a.fn.extend({
	fijarTexto: function(texto,activeColor,disabledColor){
	
		/*Recorre todos los elementos encapsulados*/
		this.each(function(){
		
		    /*Aquí se cambia el contexto, por lo que 'this' se refiere al elemento DOM por el que se está pasando*/
		    var $this = a(this); //Convertimos a jQuery
			
		    
		    $this.css("color",disabledColor).val(texto);/*Esto es para la primera vez*/
		    /*Cuando recibe el foco, si está el texto por defecto, lo borra y cambia el color*/
		  	
		    $this.focus(function(){
		    	if($this.val() == texto){
		    		$this.val("").css("color",activeColor);
		    	}
		    });
		    /*Cuando pierde el foco, si está vacío, pone el texto por defecto y cambia el color*/
		    $this.blur(function(){
		    	if(a.trim($this.val()).length==0){
		    		$this.css("color",disabledColor).val(texto);
		    	}
		    });
		});
	}
});
})(jQuery);

