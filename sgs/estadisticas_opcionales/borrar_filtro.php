<?php
$id = $_POST['id'];



$criterios = explode(",", $_SESSION['criterios_sess']);


 while(list($valor) = each($criterios)) {
  $contt++;
  $criterios2 = explode("#", $criterios[$valor]);   
    $campo_tabla = $criterios2[0];
    $valor_campo = $criterios2[1];
    $id = str_replace("id_","",$id);
    if($contt!=$id){
        $cadena.="$campo_tabla#$valor_campo,";
       
      }
    
    
}

echo json_encode(array("returnValue"=>1)); 

//$cadena = elimina_ultimo_caracter($cadena);
$_SESSION['criterios_sess']=$cadena;
?>