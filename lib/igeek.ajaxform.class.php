<?php
/**
 * Arcffhivo de definicion de la clase iGeekAjaxForm.
 *
 * @author Homer0
 * @copyright iGeek.com.ar 2008
 * @package iGeek Lib
 * @subpackage classes
 */

/**
 * iGeekAjaxForm
 *
 * @package iGeek Lib
 * @subpackage classes
 * @author Homer0
 * @access public
 */
class AjaxForm
{
    /**
     * El archivo de respuesta
     *
     * @access public
     * @var string
     */
    var $file;
    /**
     * El id del formulario
     * 
     * @access public
     * @var string
     */
    var $formId;
    /**
     * El id del div que contiene SOLAMENTE al formulario
     * 
     * @access public
     * @var string
     */
    var $formDivId;
    /**
     * El div que responde a la respuesta
     * 
     * @access public
     * @var string
     */
    var $answerDivId;
    /**
     * El id del div que se muestra mientras carga
     * 
     * @access public
     * @var string
     */
    var $loadDivId;
    /**
     * El nombre de la funcion javascript para el ajax
     * 
     * @access private
     * @var string
     */
    var $funcName;
    /**
     * Configura las variables.
     * 
     * En vez de hacerlo de forma manual, se puede
     * utilizar este metodo 
     * 
	 * @access public
     * @return true    
     */
    function settings($file, $formId, $formDivId, $answerDivId, $loadDivId = "")
    {
        $this->file = $file;
        $this->formId = $formId;
        $this->formDivId = $formDivId;
        $this->answerDivId = $answerDivId;
        if ($loadDivId != "") {
            $this->loadDivId = $loadDivId;
        }
        return true;
    }
/**
     * Incluye prototype.js
     * 
     * En el caso de que no lo hayas
	 * llamado desde html, puedes hacerlo
	 * con este metodo   
     * 
	 * @access public
     * @return true    
     */
    function includePrototype($src, $return=false)
    { 
	
	$code= '<script type="text/javascript" language="javascript" src="' . $src .
            '"></script>' . "\n";
	 if ($return == false) {
            echo $code;
           // return true;
        } else {
            return $code;
        }
	
       
           
    }
/**
     * Genera el script
     * 
	 * @access public
     * @return string    
     */
    function generateScript($name, $return = true, $scriptTags = true)
    {
        $this->funcName = $name;

        if ($scriptTags == true) {
            $code = "<script type=\"text/javascript\" language=\"javascript\">\n";
        }
      
		$code .= "function {$name}(){";
        $code .= "
		var url=\"{$this->file}\";
		var form=\"{$this->formId}\";
		var form_div=\"{$this->formDivId}\";
		var resp_div=\"{$this->answerDivId}\";
		";
        if ($this->loadDivId != "") {
            $code .= "var loading_div=\"{$this->loadDivId}\";\n";
        }
        $code .= "\n
          //$(form_div).hide();\n
		 	$(resp_div).hide();\n";
        if ($this->loadDivId != "") {
            $code .= "$(loading_div).show();\n
			
    				$(\"button\").disabled = true;\n
					";
					
        }

        
        $code .= "var okFunc = function(t){
		if (t.responseText.match('<!--AJAXFORM OK-->')){
			$(form_div).hide();
			
		}else{
			$(form_div).show();
			
		}\n";
        if ($this->loadDivId != "") {
            $code .= "$(loading_div).hide();\n
					
    	$(\"button\").disabled = false;\n
					";
        }
        $code .= "$(resp_div).innerHTML = t.responseText;
		$(resp_div).show();
		t.responseText.evalScripts();\n
		
						
		}\n\n";
        $code .= "var errFunc = function(t) {
    	alert('Error: ' + t.status + ' -- ' + t.statusText);
		}\n\n";
        $code .= "
		var params =$(form).serialize();\n\n
		new Ajax.Request(url, {
		method: 'post',
		parameters:params,
		onSuccess:okFunc,
		onFailure:errFunc
		});\n\n
		
		}\n";
		
	
        if ($scriptTags == true) {
            $code .= "</script>";
        }
        if ($return == false) {
            echo $code;
		   
        } else {
            return $code;
        }

    }
/**
     * Hace que el formulario llame al ajax
     * 
     * 
	 * @access public
     * @return true    
     */
    function getCall($return = false)
    {
        $code = $this->funcName . '();return false';
        if ($return == false) {
            echo $code;
           // return true;
        } else {
            return $code;
        }
    }


}
?>