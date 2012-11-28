<?php
$id_ac_crea;
$accionAnterior=$_GET["accion"]; 
//barra de herramientas (tool.php)
$id_perfil = perfil($id_sesion);
$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

   		$result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);


if(verfica_permiso($id_auto_admin,$id_perfil,'configurar') ){
	$configurar_perfiles = "
 <div class=\"span-icono\">
                            <a class=\"quick-action\" id=\"configura-popover\" data-content=\"Configurar Accesos a Aplicaciones de este modulo.\" rel=\"popover\" data-original-title=\"Configurar\"  href=\"?accion=$accion&act=8&id_auto_admin=$id_auto_admin\">
                                <span class=\"icon cogwheel\"></span>
                                Configurar
                            </a>
                        </div>

";
	
}elseif($id_perfil==999){

$configurar_perfiles = "
 <div class=\"span-icono\">
                            <a class=\"quick-action\" id=\"configura-popover\" data-content=\"Configurar Accesos a Aplicaciones de este modulo.\" rel=\"popover\" data-original-title=\"Configurar\"  href=\"?accion=$accion&act=8&id_auto_admin=$id_auto_admin\">
                               <span class=\"icon cogwheel\"></span>
                                Configurar
                            </a>
                        </div>";

}

	if(verfica_permiso($id_auto_admin,$id_perfil,'ordenar')){
		
			//icon-tasks
	$configurar_ordenar = "
	<div class=\"span-icono\">
                            <a class=\"quick-action\" href=\"?accion=$accion&act=5&id_auto_admin=$id_auto_admin\">
                                <span class=\"icon order\"></span>
                                Ordenar
                            </a>
                        </div>
	";
		
	}
	
	if(verfica_permiso($id_auto_admin,$id_perfil,'crear')){
		//href=\"?accion=$accion&act=1&id_a=$id_auto_admin\"
		$id_ac_crea=$id_auto_admin;
		$configurar_crear = "
		<div class=\"span-icono\">
                            <a class=\"quick-action\" id=\"crea_form_admin\" href=\"?accion=$accion&act=1&id_a=$id_auto_admin\" style=\"cursor:pointer;\"  role=\"button\" data-toggle=\"modal\">
                                <span class=\"icon plus\"></span>
                                Crear
                            </a>
                        </div>";
		
	}

	//if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
	if($id_perfil==999){	
		$busqueda = "
		<div class=\"span-icono\">
                            <a class=\"quick-action\" href=\"?accion=$accion&act=14&id_auto_admin=$id_auto_admin\">
                                <span class=\"icon search\"></span>
                               	Busqueda
                            </a>
                        </div>
		";
		
	}
	
	if(verfica_permiso($id_auto_admin,$id_perfil,'xls')){
		
		$xls = "<div class=\"span-icono\">
                            <a class=\"quick-action\" href=\"?accion=$accion&act=16&id_auto_admin=$id_auto_admin\">
                                <span class=\"icon export\"></span>
                               	Exportar
                            </a>
                        </div>
			
			";
		
	}
	
	
	  $query= "SELECT help,control_version
               FROM  auto_admin 
               WHERE id_auto_admin='$id_auto_admin'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$control_version) = mysql_fetch_row($result3);
          if ($help_txt!=""){
    			$help="
			<div class=\"span-icono\">
                            <a class=\"quick-action tooltipss\" href=\"#\" rel=\"tooltip\" title=\"$help_txt\" >
                                <span class=\"icon help\"></span>
                               	Ayuda
                            </a>
                        </div>";
				
    		 }else{
			 	$help="";
			 }
	
	
	
	
	
	

	
	
	
	  $query= "SELECT ass.id_apps,ass.apps,ass.nom_apps, ass.id_auto_admin, ass.ico_apps
	   FROM auto_admin_apps ass, auto_admin_apps_permisos aps 
	   WHERE aps.id_perfil= $id_perfil and ass.id_apps=aps.id_apps and accion =$accion and id_auto_admin =$id_auto_admin ";
	  //echo $query;
         $result_8= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_apps,$apps,$nom_apps, $id_auto_admin,$icono_apps) = mysql_fetch_row($result_8)){
		  $cont_apps++;
		  
		
				
	
    			$lista_barra_custom .="<li><a href=\"index.php?accion=$accion&act=17&id_apps=$id_apps\">$nom_apps</a></li>\n";				
						   
    		
    		 
			 if($cont_apps>0){
			$barra_custom  ="<ul id=\"nav\"><li>&nbsp;</li>
			<li>$cont_apps Aplicaciones <img src=\"images/down_over.gif\" alt=\"\" border=\"0\"></li>
			
			     <ul> $lista_barra_custom </ul>
      				</ul>"; 
 
			 }
			 
			 $tabla = tabla($id_auto_admin);
			 //style=\"background-image: url(\"images/sitio/sistema/$tabla/auto_admin_apps/ico_apps/$icono_apps\");\"
			 $barra_cust = "
			 <div class=\"span-icono\">
                            <a class=\"quick-action tooltipss\" data-content=\"Tooltip on top\" rel=\"popover\" data-original-title=\"A Title\"  href=\"index.php?accion=$accion&act=17&id_apps=$id_apps\">
                               <br>
                               <strong>$nom_apps</strong>
				
                            </a>
                        </div>"
                           ;
			 
			
	
	 }
	
	
	
	if($tabla!=""){
	  $query= "SELECT  count(*) 
	               FROM  $tabla";
	        // echo "$query";   

	     $result33= cms_query($query)or die (error($query,mysql_error(),$php)); 
	     list($tot_res) = mysql_fetch_row($result33);

	}
		
	
$tool="
<div class=\"row well-fondo-icono\">

	
  <div class=\"izqierda\" >
                          <div class=\"span-icono\">
                            <div class=\"news-item-registros\">
					<span class=\"news-item-reg_num\">$tot_res</span>
					<span class=\"news-item-reg_text\">Registros</span>
				</div>
                        </div>
                       
		       
			
		
    </div>
  

				<div class=\"derecha\">
			  			  $barra_cust
						  $configurar_perfiles
						  $configurar_ordenar
			   			  $busqueda
						  $xls
						  $configurar_crear
						  $help
		       
				</div> 
  
  
  

  
  

</div>
<div class=\"modal\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style=\"display:none;\" >
  <div class=\"modal-header\">
    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">x</button>
    <h3 id=\"myModalLabel\">{TITULO_MODAL}</h3>
  </div>
  <div class=\"modal-body\">
    {CONTENIDO_MODAL} 
  </div>
  <div class=\"modal-footer\">
    {BOTONERA_MODAL}
  </div>
</div>
			
			";
			/*
			 
			 
			 <div class=\"alert fade in\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
          </div>
<div style=\"padding-bottom: 24px;\" class=\"bs-docs-example\">
              <button class=\"btn btn-primary\" data-loading-text=\"loading...\" id=\"fat-btn\" type=\"button\">
                Loading state
              </button>
            </div>
            
            
			<a href=\"#myModal\" role=\"button\" class=\"btn\" data-toggle=\"modal\">Launch demo modal</a>
 
<!-- Modal -->
<div class=\"modal\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style=\"display: none;\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">?</button>
<h3 id=\"myModalLabel\">Modal header</h3>
</div>
<div class=\"modal-body\">
<p>One fine body…</p>
</div>
<div class=\"modal-footer\">
<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</button>
<button class=\"btn btn-primary\">Save changes</button>
</div>
</div>
			*/
			
		//?accion=$accion&act=1&id_a=$id_auto_admin&axj=1;
		$titulo_modal="TEST";
		$contenido_modal="";
		$botonera_modal="&nbsp;";
/*		
  $js .="   
  	<script src=\"js/bootstrap/admin-js/modal.js\"></script>
  <script type=\"text/javascript\"> 
				$(function(){
					
					$.post('index.php?accion=$accion&act=1&id_a=$id_auto_admin&axj=1',{
									id_entidad_padre:$(this).val()
								}, function(resp){
									$('.modal-body').html(resp);
									
								
					});
					var alto;
					$(\"#configura-popover\").popover();
							$(\"#crea_form_admin\").live(\"click\", function(){
								$('#myModal').modal('show');
								$('#myModal').modal({resizable:'true'});	
							});
					});
				
				// $('#test').tooltip('hover');
				 $('.tooltipss').tooltip({
					 selector: \"a[rel=tooltip]\"
				})
				 //$('#test').popover();
				 
				 $('#fat-btn')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      }) 
	</script>";
	
*/


$js .="   
  	
  <script type=\"text/javascript\"> 
				$(function(){
					$(\"#configura-popover\").popover();
				
					$('.tooltipss').tooltip({
						selector: \"a[rel=tooltip]\"
					});
				});
			
				 
				 
	</script>";
?>