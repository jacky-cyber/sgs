<?php

while($a<10){
$a++;

$var = rand(1,50);

$nombre= "nombre$a";

$xml .= " <set label='$nombre' value='$var'  />";


}


echo "<chart palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           $xml
</chart>";

/*


*/

?>