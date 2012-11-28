<?php

$id_servicio = configuracion_cms('id_servicio');


$entidad_padre = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre');

$id_entidad = configuracion_cms('id_entidad');


$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad');



$nombre_servicio= $entidad.", $entidad_padre";


?>