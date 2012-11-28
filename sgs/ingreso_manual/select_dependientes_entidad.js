
// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelectsEntidad=new Array();
listadoSelectsEntidad[0]="id_entidad_padre_origen";
listadoSelectsEntidad[1]="id_entidad_hija_origen";


function cargaContenidoEntidad(idSelectOrigen)
{
	
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelectsEntidad, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
	if(opcionSeleccionada==0)
	{
		var x=posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelectsEntidad[x])
		{
			selectActual=document.getElementById(listadoSelectsEntidad[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelectsEntidad[listadoSelectsEntidad.length-1])
	{
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelectsEntidad[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		
		ajax.open("GET", "sgs/ingreso_manual/select_dependientes_proceso_entidad.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);     
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}