<?php

include("lib/connect_db.inc.php");
include("lib/lib.inc.php");
include("lib/lib.inc2.php");

$query_opciones="SELECT id_institucion
						 FROM chileatiende_escalamiento_instituciones
						 WHERE materia=1
						 AND id_entidad <> 128";
		$result_opciones= mysql_query($query_opciones)or die (error($query_opciones,mysql_error(),$php));	
		while(list($id_institucion) = mysql_fetch_row($result_opciones)){
		
			$array_materias = array('Reclamo','Felicitación','Sugerencia');
			for($x=0;$x<count($array_materias);$x++){
				$_POST['materia'] = $array_materias[$x];
				$_POST['id_usuario'] = 0;
				$_POST['id_institucion'] = $id_institucion;
				$_POST['en_convenio'] = 1;
				//inserta('chileatiende_materias');
				
				$id_materia_nueva = mysql_insert_id();
				$array_submaterias = array('Calidad Atención CAP','Calidad Atención Call Center','Calidad Atención Web','Demora en Trámites Solicitados','Infraestructura CAP','Hechos irregulares');
				for($j=0;$j<count($array_submaterias);$j++){
					$_POST['id_materia'] = $id_materia_nueva;
					$_POST['nombre_submateria'] = $array_submaterias[$j];
					$_POST['id_usuario'] = 1;
					$_POST['escalar_segpres'] = 0;
					//inserta('chileatiende_submaterias');
				}
			}
		}
		
		echo "ok";

?>