<?php

function suma_minutos ($hora,$minutos_suma){


$hora1=$minutos_suma;
$hora2=$hora;

$hora1=split(":",$hora1);
$hora2=split(":",$hora2);
$horas=(int)$hora1[0]+(int)$hora2[0];
$minutos=(int)$hora1[1]+(int)$hora2[1];
$horas+=(int)($minutos/60);
$minutos=$minutos%60;
if($minutos<10 and $minutos !=0)$minutos = "0".$minutos;
if($minutos==0)$minutos="00";
return $horas.":".$minutos;

}


if($folio!=""){




$fecha = date(Y)."-".date(m)."-".date(d);
$hora = date(G).":".date(i);




$id_usuario     = id_usuario($id_sesion);






  $query= "SELECT hora   
           FROM  sgs_visitas_solicitudes
           WHERE folio='$folio' and id_usuario=$id_usuario
		   order by fecha, hora desc";
    
	 $result= cms_query($query)or die (error($query,mysql_error(),$php));
   
   if(list($hora_ultima_visita) = mysql_fetch_row($result)){
	
	 $ultima_hora_mas_10 = suma_minutos ($hora_ultima_visita,'00:01');
	
	
	if($hora > $ultima_hora_mas_10){
	$qry_insert="INSERT INTO sgs_visitas_solicitudes (id_visitas_solicitudes,id_usuario,fecha,hora,folio) 
					 values (null,'$id_usuario','$fecha','$hora','$folio')";
              
		$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");	   
	   
	  
	}else{
	//echo "esto no es mayor $hora > $ultima_hora_mas_10    --- $hora_ultima_visita"  ;
	}
	
	
  }else{
  
  $qry_insert="INSERT INTO sgs_visitas_solicitudes (id_visitas_solicitudes,id_usuario,fecha,hora,folio) 
					 values (null,'$id_usuario','$fecha','$hora','$folio')";
              
		$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");	   
	   
  }

	



}





?>