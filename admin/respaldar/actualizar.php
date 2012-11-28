<? 

$sql = implode('', file('dump.txt')); 
$sql_sentencias=explode(';',$sql); 

// conectas a tu BD .. selecionas tu BD ... 
foreach ($sql_sentencias as $sentencia_sql){ cms_query($sentencia_sql) or die ('Error ejecutando:'.$sentencia_sql.'<br>Mysql dice: '.mysql_error()); 
} 
?>