<?php

$logon = $_GET['logon'];
$version_os= $_SERVER[HTTP_USER_AGENT];


	
$a=1;

if($a){
   
	//el cliente no tiene win xp y explorer 6  


}



$js ="<script language=\"JavaScript\">
		function validaforma(theForm){
		
			
				if (theForm.celuar.value == \"\"){
					alert(\"Por favor ingrese usuario.\");
					theForm.celular.focus();
					return false;
			}
				
			
		
		
		}
		</script>
		<script type=\"text/javascript\">


function clearText(thefield){
	if (thefield.defaultValue==thefield.value)
		thefield.value = \"\"
}


</script>";
		
		
	
		$login_html ="
		<form name=\"form_login\" method=\"post\" action=\"index.php?log=ok\" {ONSUBMIT} enctype=\"multipart/form-data\">
                            
		

 <tr>
                <td align=\"center\"><img src=\"images/title01.gif\" width=\"183\" height=\"35\" alt=\"\" border=\"0\"></td>
              </tr>
              <tr> 
                <td> 
                  <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr> 
                      <td> 
                        <!--COMIENZO FORM2 -->
						
						
						
                 <form action=\"\" method=\"post\" enctype=\"multipart/form-data\" name=\"form2\" accept-charset=\"UTF-8\">
                  
                        
<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
                          <tr><td align=\"center\" class=\"textos1\">
			  &nbsp;
			  </td></tr>
						  <tr> 
                            <td align=\"left\" class=\"textos1\">
                              Celular
                            </td>
                          </tr>
                         <tr> 
                            <td>
                              <input type=\"Text\" name=\"celular\" value=\"\" size=\"15\" >
                            </td>
                          </tr>
                          <tr> 
                            <td> 
                              <input type=\"submit\" name=\"login_bot\" value=\">>\" >
                            </td>
                          </tr>
                        </table>
						</form>  
						
						
						   
                        <!--FIN FORM2 -->
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
			
			  <tr><td align=\"center\" class=\"textos1\">
			  
			  </td></tr> <tr><td align=\"center\" class=\"textos1\">
			  &nbsp;
			  </td></tr>
			  <tr><td align=\"center\" class=\"textos1\">
	
	 </td></tr> 
	 <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  </form>
";

?>