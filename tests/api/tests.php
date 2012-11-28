<?php
include("lib/connect_db.inc.test.php");
include("deuman/api/crea_solicitud.php");

class StackTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {

        
    }
    public function tearDown(){
        $query= "TRUNCATE sgs_solicitud_acceso";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));

    }

    public function testCreaSolicitudAPartirDeArregloAsociativo(){
        #Estos son aproximadamente los valores que aparecen en el formulario 
        #
        $data = Array(
            'nombre' => "El desarrollador",
            'paterno' =>"Fantasma",
            'materno' =>"De la opera",
            'fono' =>"2135",
            'email' =>"fierita@ciudadanointeligente.org",
            'direccion' => "holanda",
            'numero' => "895",
            'departamento' => "",
            'telefono' => "1111111",
            'pais' => 51,#de donde podemos sacar la lista de estos cargos??
            'region' => 14,#de donde puedo sacar la lista de regiones??
            'comuna' => 333,#de donde puedo sacar la lista de las comunas??
            'identificacion_documentos' => "¿Quiero saber cuanto gastan en comida para la fiera?", //Señale la materia, fecha de emisión o período de vigencia del documento, origen o destino, soporte, etc.*
            'observacion_adicional' => "Incluyendo las galletas que le llevan en la mañana",
            'entidad' => '128',#debemos averiguar esto con antelación
            #formato de entrega no va por lo que siempre debe ser  2
            #forma de recepción no va y siempre debe ser 1
            );


        creaSolicitud($data);

        #me aseguro que existe uno creado
        $query= "SELECT count(*)   
                       FROM  sgs_solicitud_acceso";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
        list($cuenta_solicitudes) = mysql_fetch_row($result);

        $query= "SELECT * 
                       FROM  sgs_solicitud_acceso";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
        list($solicitud) = mysql_fetch_row($result);
        print_r($solicitud);

        #Debo asegurar que existe una solicitud
        $this->assertEquals($cuenta_solicitudes, 1);
        
        #Debo asegurar que la solicitud guardada es la misma que yo inserté







    }
}
?>