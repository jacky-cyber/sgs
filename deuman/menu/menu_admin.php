<?php

	
	$query= "SELECT id_grupo,grupo,home   
             FROM  accion_grupo
             ORDER BY orden asc";
    $result= cms_query($query)or die (error($query,mysql_error(),$php));
	
    while (list($id_grupo,$grupo,$home) = mysql_fetch_row($result)){
		$cont_sub=0;				   
		$tabla_menu="";
		
		
		  $query_per= "SELECT ac.accion, ac.descrip_php_$idm, ac.icono , ac.descrip_url 
					   FROM  acciones ac
					   WHERE  ac.home='si' 
					   and ac.id_grupo='$id_grupo'
					   $condicion_buscar_menu
					   ORDER BY ac.id_acc";
	  
	  
	  
		 $result_per= cms_query($query_per)or die (error($query_per,mysql_error(),$php));
		  while (list($accion_id, $descrip_php, $icono,$descrip_url) = mysql_fetch_row($result_per)){
			$si=false;
				
				
				 $si= menu_perfil($id_perfil,$accion_id);	
				
				if($si==false){
				$query= "SELECT id_perfil   
						   FROM  usuario_perfiles 
						   WHERE id_usuario='$id_usuario'";
				  $result2= cms_query($query)or die (error($query,mysql_error(),$php));
					  while (list($id_sub_perfil) = mysql_fetch_row($result2)){
								$si= menu_perfil($id_sub_perfil,$accion_id);		   
						
						 }
				}
						 
					if($si){  
					 $cont_sub++;
						if($accion==$accion_id){
								$bg="bgcolor=\"#0099CC\"";
						 }             
				 
						if($_GET['accion']==$descrip_url){
							$tabla_menu .=" <li class=\"active\"><a href=\"index.php?accion=$descrip_url\"><span class=\"ico\"><i class=\"icon-edit\"></i></span>$descrip_php</a></li>";
						}else{
							$tabla_menu .= "<li><a href=\"index.php?accion=$descrip_url\"><span class=\"ico\"><i class=\"icon-edit\"></i></span>$descrip_php</a></li>";
						}
					}
				
				
				  
					  
		  }
		if($cont_sub>0){
			if($home==1){
			
			
			$menu_user .="<ul class=\"nav leftmenu\">
					<li class=\"nav-header nav\">$grupo </li>
						$tabla_menu
						</ul>
						<hr />";
			}else{
			$menu_top .="<li class=\"dropdown\">
			<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">$grupo <b class=\"caret\"></b></a>
			  <ul class=\"dropdown-menu\">
						$tabla_menu 
						</ul></li>
						";
			}
		
			
			   
					
		}
  
	}

	$menu_usuario = $menu_user;
	$buscador = "<input type=\"text\" class=\"input-medium\" id=\"buscador\" name=\"buscador\" size=\"10\" />";
	$menu_user = $buscador."<h1 id=\"header\"></h1>".$menu_usuario;
	
	
	$js .= "
			
			<script type=\"text/javascript\">
					
			(function ($) {
				  // custom css expression for a case-insensitive contains()
				  jQuery.expr[':'].Contains = function(a,i,m){
					  return (a.textContent || a.innerText || \"\").toUpperCase().indexOf(m[3].toUpperCase())>=0;
				  };


				  function listFilter(header, list) { // header is any element, list is an unordered list

					$('#buscador')
					  .change( function () {
						var filter = $(this).val();
						if(filter) {
						  // this finds all links in a list that contain the input,
						  // and hide the ones not containing the input while showing the ones that do
						  $(list).find(\"a:not(:Contains(\" + filter + \"))\").parent().slideUp();
						  $(list).find(\"a:Contains(\" + filter + \")\").parent().slideDown();
						} else {
						  $(list).find(\"li\").slideDown();
						}
						return false;
					  })
					.keyup( function () {
						// fire the above change event after every letter
						$(this).change();
					});
				  }


				  //ondomready
				  $(function () {
					//listFilter($(\"#header\"), $(\"#list\"));
					listFilter($(\"#header\"), $(\".leftmenu\"));
				  });
			}(jQuery));
				
			
			</script>
			
	";

/*

<ul class="nav">

                        <li class="active"><a href="index.html"><span class="ico"><i class="icon-home"></i></span><span class="text">Dashboard</span></a></li>

                        <li><a href="forms.html"><span class="ico"><i class="icon-edit"></i></span><span class="text">Forms</span></a></li>

                        <li><a href="typography.html"><span class="ico"><i class="icon-bold"></i></span><span class="text">Typography</span></a></li>

                        <li><a href="tables.html"><span class="ico"><i class="icon-th-list"></i></span><span class="text">Tables</span></a></li>

                        <li><a href="charts.html"><span class="ico"><i class="icon-signal"></i></span><span class="text">Charts</span></a></li>

                        <li><a href="components.html"><span class="ico"><i class="icon-inbox"></i></span><span class="text">Components</span></a></li>

                        <li><a href="interface-elements.html"><span class="ico"><i class="icon-tasks"></i></span><span class="text">Interface elements</span></a></li>                        

                        <li><a href="grid.html"><span class="ico"><i class="icon-th"></i></span><span class="text">Grid</span></a></li>

                        <li><a href="calendar.html"><span class="ico"><i class="icon-calendar"></i></span><span class="text">Calendar</span></a></li>


                    </ul>
		   
		    
		    
		<hr />

	
	 <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Dropdown <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                      <li><a href=\"#\">Action</a></li>
                      <li><a href=\"#\">Another action</a></li>
                      <li><a href=\"#\">Something else here</a></li>
                      <li class=\"divider\"></li>
                      <li><a href=\"#\">Separated link</a></li>
                    </ul>*/
?>