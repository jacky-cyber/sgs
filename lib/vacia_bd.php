<?php


$Sql ="DROP TABLE `accion_acciones`, `accion_contenido`, `accion_etiqueta`, `accion_grupo`, `accion_opciones_menu`, `accion_perfil`, `accion_rollober`, `acciones`, `actividades`, `atencion`, `auto_admin`, `auto_admin_apps`, `auto_admin_apps_permisos`, `auto_admin_campo`, `auto_admin_combinacion`, `auto_admin_permisos`, `auto_admin_tipo_campo`, `cms_configuracion`, `comentarios`, `comunas`, `configuracion`, `contacto_mails`, `contactos`, `contenido_etiqueta`, `contenido_etiqueta_definicion`, `contenido_tipo`, `control_contenido_perfil`, `establecimientos`, `estadisticas_acciones`, `galerias`, `grupo_galeria`, `grupo_galeria_perfiles`, `ima_categorias`, `ima_secciones`, `imagenes`, `imagenes_comentarios`, `indices_economicos`, `modulos_bloqueo`, `no_habil`, `noticia_opina`, `noticia_plantilla`, `noticias`, `noticias_id_publicador`, `observaciones_persona`, `pais`, `personal`, `poll`, `poll_admin`, `poll_answers`, `poll_usuarios`, `regiones`, `sgs_departamentos`, `sgs_enrutamiento_estados`, `sgs_entidad_padre`, `sgs_entidades`, `sgs_entidades_oficinas`, `sgs_estadistica`, `sgs_estado_solicitudes`, `sgs_flujo_estados_solicitud`, `sgs_forma_recepcion`, `sgs_formato_entrega`, `sgs_llamadas_xml`, `sgs_log_error`, `sgs_responsable`, `sgs_solicitud_acceso`, `sgs_solicitud_acceso_temp`, `sgs_sub_estado_solicitudes`, `sgs_tramos`, `sgs_visitas_solicitudes`, `sgs_wizard`, `sitio`, `sitio_templates`, `soporte`, `sucursal`, `tab_busqueda`, `tab_camp`, `templates_acciones`, `templates_acciones_etiquetas`, `tipo_cont_cat_grupo_productos`, `tipo_persona`, `usuario`, `usuario_amigo`, `usuario_cambio_email`, `usuario_cambio_pass`, `usuario_establecimientos`, `usuario_frecuencia_organizacion`, `usuario_nacionalidad`, `usuario_nivel_educacional`, `usuario_ocupacion`, `usuario_organizacion`, `usuario_perfil`, `usuario_perfil_relacion`, `usuario_perfiles`, `usuario_rango_edad`, `usuario_sexo`, `usuarios_newsletter`";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));



$Sql ="truncate table sgs_solicitud_acceso";

 //cms_query($Sql)or die (error($Sql,mysql_error(),$php));



		 

?>