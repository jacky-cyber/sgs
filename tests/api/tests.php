<?php
include("lib/connect_db.inc.test.php");
class StackTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {

        
    }
    public function tearDown(){
        $query= "TRUNCATE sgs_solicitud_acceso";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));

    }
}
?>