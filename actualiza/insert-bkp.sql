# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# servidor: 192.168.29.2
# Tiempo de generación: 22-04-2009 a las 12:12:25
# Versión del servidor: 4.00.00
# Versión de PHP: 5.2.8
# Base de datos : `sgs`

#
# Volcar la base de datos para la tabla `accion_acciones`
#
truncate table accion_acciones;

INSERT INTO accion_acciones VALUES (10, 1148, 54699, 0);
INSERT INTO accion_acciones VALUES (12, 992, 54699, 0);

#
# Volcar la base de datos para la tabla `accion_contenido`
#
truncate table accion_contenido;
INSERT INTO accion_contenido VALUES (1, 48, '2008072817483738', 1, 0);
INSERT INTO accion_contenido VALUES (2, 36, '2008072907085455', 1, 0);
INSERT INTO accion_contenido VALUES (3, 963, '2008072907174040', 1, 0);
INSERT INTO accion_contenido VALUES (4, 700, '2008073110461339', 1, 0);
INSERT INTO accion_contenido VALUES (7, 33, '2008090415022783', 1, 0);
INSERT INTO accion_contenido VALUES (12, 0, '2008100709093141', 0, 0);

#
# Volcar la base de datos para la tabla `accion_etiqueta`
#
truncate table accion_etiqueta;
INSERT INTO accion_etiqueta VALUES (1, '1078', 'CONTENEDOR_MENU', '2008121819081292', 1);
INSERT INTO accion_etiqueta VALUES (2, '1078', 'CONTENEDOR_LATERAL', '2008121819050396', 2);
INSERT INTO accion_etiqueta VALUES (3, '1001', 'FOOTER', '2008121819384436', 3);
INSERT INTO accion_etiqueta VALUES (15, '1079', 'HEADER', '2008121819525087', 11);
INSERT INTO accion_etiqueta VALUES (8, '1082', 'RR', '2008121817213824', 5);
INSERT INTO accion_etiqueta VALUES (9, '1135', 'CONTENIDO', '2008121812050561', 6);
INSERT INTO accion_etiqueta VALUES (11, '1120', 'CONTENIDO', '2008121812050561', 7);
INSERT INTO accion_etiqueta VALUES (12, '1118', 'CONTENIDO', '2008121718424896', 8);
INSERT INTO accion_etiqueta VALUES (13, '1146', 'CONTENIDO', '2009021715335463', 9);
INSERT INTO accion_etiqueta VALUES (14, '1148', 'CONTENIDO', '2009021715335463', 10);
INSERT INTO accion_etiqueta VALUES (16, '1150', 'CONTENIDO', '2009012010144481', 12);
INSERT INTO accion_etiqueta VALUES (17, '1152', 'CONTENIDO', '2009021911060251', 13);
INSERT INTO accion_etiqueta VALUES (18, '1154', 'CONTENIDO', '2009021911314646', 14);
INSERT INTO accion_etiqueta VALUES (19, '1155', 'CONTENIDO', '2009021911405795', 15);
INSERT INTO accion_etiqueta VALUES (20, '1227', 'CONTENIDO', '2009021911405795', 16);
INSERT INTO accion_etiqueta VALUES (21, '1225', 'CONTENIDO', '2009021911060251', 17);
INSERT INTO accion_etiqueta VALUES (22, '1224', 'CONTENIDO', '2009012010144481', 18);
INSERT INTO accion_etiqueta VALUES (23, '1226', 'CONTENIDO', '2009021911314646', 19);
INSERT INTO accion_etiqueta VALUES (24, '1299', 'CONTENIDO', '2009012010144481', 20);
INSERT INTO accion_etiqueta VALUES (25, '1300', 'CONTENIDO', '2009021911060251', 21);
INSERT INTO accion_etiqueta VALUES (26, '1301', 'CONTENIDO', '2009021911314646', 22);
INSERT INTO accion_etiqueta VALUES (27, '1302', 'CONTENIDO', '2009021911405795', 23);
INSERT INTO accion_etiqueta VALUES (28, '1319', 'CONTENIDO', '2009021911060251', 24);
INSERT INTO accion_etiqueta VALUES (29, '1320', 'CONTENIDO', '2009021911314646', 25);
INSERT INTO accion_etiqueta VALUES (30, '1330', 'CONTENIDO', '2009012010144481', 26);
INSERT INTO accion_etiqueta VALUES (31, '1329', 'CONTENIDO', '2009021911314646', 27);
INSERT INTO accion_etiqueta VALUES (32, '1511', 'CONTENIDO', '2009021911060251', 28);
INSERT INTO accion_etiqueta VALUES (33, '1523', 'CONTENIDO', '2009012010144481', 29);
INSERT INTO accion_etiqueta VALUES (34, '1518', 'CONTENIDO', '2009021911314646', 30);
INSERT INTO accion_etiqueta VALUES (35, '992', 'CONTENIDO', '2009021715335463', 31);
INSERT INTO accion_etiqueta VALUES (36, '1530', 'CONTENIDO', '2009052210500446', 32);


#
# Volcar la base de datos para la tabla `accion_grupo`
#

truncate table accion_grupo;
INSERT INTO accion_grupo VALUES (999, 'WM', 8, 1, 0);
INSERT INTO accion_grupo VALUES (0, 'Sitio', 1, 0, 0);
INSERT INTO accion_grupo VALUES (1011, 'Administraci&oacute;n', 7, 1, 0);
INSERT INTO accion_grupo VALUES (1016, 'Admin Contenido', 5, 1, 0);
INSERT INTO accion_grupo VALUES (1017, 'Banner', 9, 0, 0);
INSERT INTO accion_grupo VALUES (1019, 'Admin. Galerias', 6, 1, 0);
INSERT INTO accion_grupo VALUES (1020, 'Admin Form Registro', 2, 1, 0);
INSERT INTO accion_grupo VALUES (1021, 'Admin SGS', 3, 1, 1);
UPDATE accion_grupo SET id_grupo ='0' WHERE grupo ='Sitio';


#
# Volcar la base de datos para la tabla `accion_opciones_menu`
#
truncate table accion_opciones_menu;
INSERT INTO accion_opciones_menu VALUES ('1', 'Contenido Est&aacute;tico', 'contenido/contenido_estatico.php', 1);
INSERT INTO accion_opciones_menu VALUES ('2', 'Auto Administrables', 'admin/administracion_sistema/administracion_sistema.php', 2);
INSERT INTO accion_opciones_menu VALUES ('3', 'Cl&aacute;sico', '', 3);
INSERT INTO accion_opciones_menu VALUES ('4', 'Grupo de Noticias', 'contenido/ver_grupo_noticias.php', 4);

#
# Volcar la base de datos para la tabla `accion_perfil`
#
truncate table accion_perfil;
INSERT INTO accion_perfil VALUES (999, 906, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54724, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54704, 0, 0);
INSERT INTO accion_perfil VALUES (999, 88, 0, 0);
INSERT INTO accion_perfil VALUES (999, 30, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 179, 0, 0);
INSERT INTO accion_perfil VALUES (1, 5001, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 34, 0, 0);
INSERT INTO accion_perfil VALUES (999, 5001, 0, 0);
INSERT INTO accion_perfil VALUES (0, 700, 0, 0);
INSERT INTO accion_perfil VALUES (999, 891, 0, 0);
INSERT INTO accion_perfil VALUES (999, 46, 0, 0);
INSERT INTO accion_perfil VALUES (999, 906, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (999, 901, 0, 0);
INSERT INTO accion_perfil VALUES (999, 8, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 53, 0, 0);
INSERT INTO accion_perfil VALUES (999, 946, 0, 0);
INSERT INTO accion_perfil VALUES (999, 9, 0, 0);
INSERT INTO accion_perfil VALUES (4, 5001, 0, 0);
INSERT INTO accion_perfil VALUES (999, 912, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 25, 0, 0);
INSERT INTO accion_perfil VALUES (999, 911, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54708, 0, 0);
INSERT INTO accion_perfil VALUES (999, 988, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (999, 31, 0, 0);
INSERT INTO accion_perfil VALUES (999, 3, 0, 0);
INSERT INTO accion_perfil VALUES (999, 900, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54717, 0, 0);
INSERT INTO accion_perfil VALUES (999, 931, 0, 0);
INSERT INTO accion_perfil VALUES (999, 930, 0, 0);
INSERT INTO accion_perfil VALUES (999, 929, 0, 0);
INSERT INTO accion_perfil VALUES (999, 903, 0, 0);
INSERT INTO accion_perfil VALUES (4, 179, 0, 0);
INSERT INTO accion_perfil VALUES (999, 904, 0, 0);
INSERT INTO accion_perfil VALUES (1, 320, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 38, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54704, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54684, 0, 0);
INSERT INTO accion_perfil VALUES (999, 200, 0, 0);
INSERT INTO accion_perfil VALUES (4, 320, 0, 0);
INSERT INTO accion_perfil VALUES (999, 987, 0, 0);
INSERT INTO accion_perfil VALUES (999, 966, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54710, 0, 0);
INSERT INTO accion_perfil VALUES (999, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54703, 0, 0);
INSERT INTO accion_perfil VALUES (4, 112, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 32, 0, 0);
INSERT INTO accion_perfil VALUES (999, 932, 0, 0);
INSERT INTO accion_perfil VALUES (999, 40, 0, 0);
INSERT INTO accion_perfil VALUES (4, 3436, 0, 0);
INSERT INTO accion_perfil VALUES (999, 45, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54705, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54705, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54704, 0, 0);
INSERT INTO accion_perfil VALUES (999, 320, 0, 0);
INSERT INTO accion_perfil VALUES (0, 40, 0, 0);
INSERT INTO accion_perfil VALUES (1, 51, 0, 0);
INSERT INTO accion_perfil VALUES (4, 51, 0, 0);
INSERT INTO accion_perfil VALUES (999, 51, 0, 0);
INSERT INTO accion_perfil VALUES (1, 3436, 0, 0);
INSERT INTO accion_perfil VALUES (999, 41, 0, 0);
INSERT INTO accion_perfil VALUES (999, 43, 0, 0);
INSERT INTO accion_perfil VALUES (0, 904, 0, 0);
INSERT INTO accion_perfil VALUES (999, 42, 0, 0);
INSERT INTO accion_perfil VALUES (0, 3436, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (999, 3436, 0, 0);
INSERT INTO accion_perfil VALUES (4, 5, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54742, 0, 0);
INSERT INTO accion_perfil VALUES (999, 44, 0, 0);
INSERT INTO accion_perfil VALUES (0, 912, 0, 0);
INSERT INTO accion_perfil VALUES (0, 932, 0, 0);
INSERT INTO accion_perfil VALUES (0, 41, 0, 0);
INSERT INTO accion_perfil VALUES (0, 43, 0, 0);
INSERT INTO accion_perfil VALUES (0, 44, 0, 0);
INSERT INTO accion_perfil VALUES (0, 42, 0, 0);
INSERT INTO accion_perfil VALUES (0, 46, 0, 0);
INSERT INTO accion_perfil VALUES (0, 947, 0, 0);
INSERT INTO accion_perfil VALUES (4, 111, 0, 0);
INSERT INTO accion_perfil VALUES (0, 45, 0, 0);
INSERT INTO accion_perfil VALUES (999, 34, 0, 0);
INSERT INTO accion_perfil VALUES (4, 32, 0, 0);
INSERT INTO accion_perfil VALUES (999, 958, 0, 0);
INSERT INTO accion_perfil VALUES (1, 53, 0, 0);
INSERT INTO accion_perfil VALUES (999, 53, 0, 0);
INSERT INTO accion_perfil VALUES (4, 53, 0, 0);
INSERT INTO accion_perfil VALUES (999, 179, 0, 0);
INSERT INTO accion_perfil VALUES (0, 53, 0, 0);
INSERT INTO accion_perfil VALUES (4, 52, 0, 0);
INSERT INTO accion_perfil VALUES (0, 901, 0, 0);
INSERT INTO accion_perfil VALUES (0, 30, 0, 0);
INSERT INTO accion_perfil VALUES (0, 911, 0, 0);
INSERT INTO accion_perfil VALUES (1, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (1, 34, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54716, 0, 0);
INSERT INTO accion_perfil VALUES (0, 960, 0, 0);
INSERT INTO accion_perfil VALUES (1, 179, 0, 0);
INSERT INTO accion_perfil VALUES (999, 920, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54671, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (999, 965, 0, 0);
INSERT INTO accion_perfil VALUES (0, 48, 0, 0);
INSERT INTO accion_perfil VALUES (999, 48, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54729, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54728, 0, 0);
INSERT INTO accion_perfil VALUES (999, 963, 0, 0);
INSERT INTO accion_perfil VALUES (0, 963, 0, 0);
INSERT INTO accion_perfil VALUES (999, 700, 0, 0);
INSERT INTO accion_perfil VALUES (1, 5, 0, 0);
INSERT INTO accion_perfil VALUES (1, 77, 0, 0);
INSERT INTO accion_perfil VALUES (999, 49, 0, 0);
INSERT INTO accion_perfil VALUES (4, 38, 0, 0);
INSERT INTO accion_perfil VALUES (1, 38, 0, 0);
INSERT INTO accion_perfil VALUES (999, 0, 0, 0);
INSERT INTO accion_perfil VALUES (999, 945, 0, 0);
INSERT INTO accion_perfil VALUES (4, 25, 0, 0);
INSERT INTO accion_perfil VALUES (1, 25, 0, 0);
INSERT INTO accion_perfil VALUES (1, 52, 0, 0);
INSERT INTO accion_perfil VALUES (999, 967, 0, 0);
INSERT INTO accion_perfil VALUES (4, 77, 0, 0);
INSERT INTO accion_perfil VALUES (999, 0, 0, 0);
INSERT INTO accion_perfil VALUES (999, 0, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54660, 0, 0);
INSERT INTO accion_perfil VALUES (999, 997, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54662, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54684, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54684, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54671, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54671, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54697, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54713, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54709, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54676, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54678, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54716, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54716, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54680, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54712, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54711, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54689, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54689, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54688, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54687, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54691, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54714, 0, 0);
INSERT INTO accion_perfil VALUES (1002, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54699, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54699, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 34, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54722, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54775, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54720, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54727, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54726, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54725, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54723, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54733, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54730, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54732, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54734, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54735, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54743, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54737, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54738, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54747, 0, 0);
INSERT INTO accion_perfil VALUES (5, 34, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54718, 0, 0);
INSERT INTO accion_perfil VALUES (5, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (5, 32, 0, 0);
INSERT INTO accion_perfil VALUES (5, 179, 0, 0);
INSERT INTO accion_perfil VALUES (5, 53, 0, 0);
INSERT INTO accion_perfil VALUES (5, 25, 0, 0);
INSERT INTO accion_perfil VALUES (5, 77, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 34, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54741, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54742, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 179, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 53, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 25, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 77, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54751, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54746, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54772, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54742, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54744, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54750, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54745, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54745, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54757, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54716, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54747, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54684, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (1002, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 77, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54750, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54752, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54753, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54754, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54758, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 34, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 32, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 179, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 53, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 25, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 77, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54685, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54748, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54744, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54757, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54766, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54763, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54760, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54747, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54749, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54767, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 53, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 179, 0, 0);
INSERT INTO accion_perfil VALUES (999, 910, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54761, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54761, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54762, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54762, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54764, 0, 0);
INSERT INTO accion_perfil VALUES (2, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 1000, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1002, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54769, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54746, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54750, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54771, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54771, 0, 0);
INSERT INTO accion_perfil VALUES (1002, 54771, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54771, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54772, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (2, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54773, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54774, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54776, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54776, 0, 0);
INSERT INTO accion_perfil VALUES (1, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (2, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (4, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (5, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (1001, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (1003, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (1005, 54777, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54779, 0, 0);
INSERT INTO accion_perfil VALUES (999, 54780, 0, 0);
INSERT INTO accion_perfil VALUES (1004, 54780, 0, 0);

#
# Volcar la base de datos para la tabla `accion_rollober`
#
truncate table accion_rollober;
INSERT INTO accion_rollober VALUES (3, 42, 'btn_registro.jpg', 'btn_registro_roll.jpg', 3);
INSERT INTO accion_rollober VALUES (2, 888, 'btn_contacto.jpg', 'btn_contacto_roll.jpg', 2);

#
# Volcar la base de datos para la tabla `acciones`
#

truncate table acciones;
INSERT INTO acciones VALUES (1, 9, 0, 'poll/pastpoll.php', 'Otras Encuestas', 'Otras Encuestas', 'Otras-Encuestas', 'no', '', 0, 0, 0, 0, '0', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (2, 3, 0, 'buscador/buscador.php', 'Search', 'Search', 'Search', 'no', '', 0, 0, 0, 0, '0', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (3, 901, 0, 'admin/acciones/accion.php', 'Acciones', 'Acciones', 'Acciones', 'si', '', 999, 0, 0, 0, '0', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (4, 30, 0, 'admin/usuarios/usuarios.php', 'Admin Usuarios', 'Admin Usuarios', 'Admin-Usuarios', 'si', '', 999, 0, 0, 0, '0', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (6, 900, 0, 'admin/respaldar/respaldar.php', 'Backup BD', 'Backup BD', 'Backup-BD', 'si', '', 999, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (920, 946, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Grupo Menu', 'Grupo Menu', 'Grupo-Menu', 'si', '', 999, 0, 0, 0, '', 144, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (8, 910, 0, 'admin/perfiles/perfiles.php', 'Navegación', 'Navegación', 'Navegacion', 'si', '', 999, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (9, 903, 0, 'poll/admin/admin.php', 'Admin Poll', 'Admin Poll', 'Admin-Poll', 'si', '', 999, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1376, 904, 0, 'admin/GNews/index.php', 'Admin Noticias', 'Admin Noticias', 'Admin-Noticias', 'si', '', 1016, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (11, 920, 0, 'admin/buscador/buscador.php', 'Admin. Buscador', 'Admin. Buscador', 'Admin.-Buscador', 'si', '', 999, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (12, 912, 0, 'admin/estadisticas/admin_estadisticas.php', 'Admin Estadisticas', 'Admin Estadisticas', 'Admin-Estadisticas', 'si', '', 999, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (889, 8, 0, 'poll/poll.php', 'Encuestas', 'Encuestas', 'Encuestas', 'no', '', 0, 0, 0, 0, '0', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1508, 54718, 0, 'sgs/solicitudes/solicitudes.php', 'Solicitud de Informaci&oacute;n', 'Solicitud de Informaci&oacute;n', 'Solicitud-de-Informacion', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1106, 5, 0, 'contenido/index.php', 'Noticias', 'Noticias', 'Noticias', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (43, 112, 0, 'usuario/olvido_pass.php', 'Olvido', 'Olvido', 'Olvido', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1505, 34, 0, 'personal/personal.php', 'Mis Datos', 'Mis Datos', 'Mis-Datos', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1509, 111, 0, 'usuario/registro/registro.php', 'Registro', 'Registro', 'Registro', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (44, 31, 0, 'admin/admin_auto/admin_auto.php', 'Auto Admin', 'Auto Admin', 'Auto-Admin', 'si', '', 999, 0, 0, 0, '2007111520543524', 47, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (56, 6565, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin perfiles', 'Admin perfiles', 'Admin-perfiles', 'si', '', 1001, 0, 0, 0, '', 18, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (57, 54654, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Actividades', 'Admin Actividades', 'Admin-Actividades', 'si', '', 1001, 0, 0, 0, '', 19, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (66, 995, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Pa&iacute;s', 'Pa&iacute;s', 'Pais', 'si', '', 1001, 0, 0, 1, '2007111520543524', 27, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (67, 996, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Ciudad', 'Ciudad', 'Ciudad', 'si', '', 1001, 0, 0, 1, '2007111520543524', 28, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1266, 997, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Regi&oacute;n', 'Regi&oacute;n', 'Region', 'si', '', 1020, 0, 0, 0, '', 96, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (69, 998, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Nacionalidad', 'Nacionalidad', 'Nacionalidad', 'si', '', 1001, 0, 0, 1, '2007111520543524', 30, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (71, 893, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Actividad', 'Actividad', 'Actividad', 'si', '', 1001, 0, 0, 1, '2007111520543524', 19, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (77, 233, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Tipo Persona', 'Tipo Persona', 'Tipo-Persona', 'si', '', 1001, 0, 0, 1, '2007111520543524', 44, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (79, 928, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Campos autm', 'Admin Campos autm', 'Admin-Campos-autm', 'si', '', 999, 0, 0, 0, '2007111520543524', 49, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (91, 500, 0, 'contenido/index.php', 'Noticias', 'Noticias', 'Noticias', 'si', '', 1000, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1512, 54715, 0, 'contacto/contacto.php', 'Contacto', 'Contacto', 'Contacto', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1506, 1000, 0, 'exit.php', 'Salir', 'Salir', 'Salir', 'si', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1276, 54717, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Wizard', 'Admin Wizard', 'Admin-Wizard', 'si', '', 1021, 0, 0, 0, '', 185, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (100, 506, 0, 'exit.php', 'Salir', 'Salir', 'Salir', 'si', '', 1000, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (101, 507, 0, 'poll/poll.php', 'Encuestas', 'Encuestas', 'Encuestas', 'si', '', 1000, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (102, 508, 0, 'poll/pastpoll.php', 'Otras Encuestas', 'Otras Encuestas', 'Otras-Encuestas', 'si', '', 1000, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (103, 509, 0, 'buscador/buscador.php', 'Buscador', 'Buscador', 'Buscador', 'si', '', 1000, 0, 0, 0, '2007111520543524', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (104, 929, 0, 'admin/galeria/galeria.php', 'Admin. Galer&iacute;as', 'Admin. Galer&iacute;as', 'Admin.-Galerias', 'no', '', 1019, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (836, 987, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Tipo Campo', 'Admin Tipo Campo', 'Admin-Tipo-Campo', 'si', '', 999, 0, 0, 0, '2007121017485632', 40, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1377, 932, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Tipo Noticias', 'Tipo Noticias', 'Tipo-Noticias', 'si', '', 1016, 0, 0, 0, '', 77, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1382, 54703, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Tipo Persona', 'Admin Tipo Persona', 'Admin-Tipo-Persona', 'si', '', 1016, 0, 0, 0, '', 177, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (959, 32, 0, 'usuario/login.php', 'login', 'login', 'login', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (960, 958, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Comunas', 'Admin. Comunas', 'Admin.-Comunas', 'si', '', 999, 0, 0, 0, '', 100, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (998, 179, 0, 'tienda/buscar/buscar.php', 'Buscar', 'Buscar', 'Buscar', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1000, 53, 0, 'contenido/contenido_estatico.php', 'Gracias Registro', 'Gracias Registro', 'Gracias-Registro', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1010, 960, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Mails Contactos', 'Admin Mails Contactos', 'Admin-Mails-Contactos', 'no', '', 1009, 0, 0, 0, '', 152, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1528, 54775, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Entidades Hijas', 'Admin. Entidades Hijas', 'Admin.-Entidades-Hijas', 'si', '', 1021, 0, 0, 0, '', 186, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1378, 963, 0, 'contenido/contenido_estatico.php', 'Help Admin Noticias', 'Help Admin Noticias', 'Help-Admin-Noticias', 'si', '', 1016, 0, 0, 0, '', 0, 1, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (975, 700, 0, 'contenido/contenido_estatico.php', 'Help Admin Usuarios', 'Help Admin Usuarios', 'Help-Admin-Usuarios', 'si', '', 999, 0, 0, 0, '', 0, 1, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1001, 25, 0, 'contenido/contenido_estatico.php', 'Footer', 'Footer', 'Footer', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 1, '', 0, 1, 0);
INSERT INTO acciones VALUES (982, 38, 0, 'contenido/contenido_estatico.php', 'Banner menu', 'Banner menu', 'Banner-menu', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 1, '', 0, 1, 0);
INSERT INTO acciones VALUES (1379, 967, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Templates', 'Admin. Templates', 'Admin.-Templates', 'si', '', 1016, 0, 0, 0, '', 157, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (992, 77, 0, 'contenido/contenido_estatico.php', 'Home', 'Home', 'Home', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1012, 47, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Grupos Contenido', 'Grupos Contenido', 'Grupos-Contenido', 'no', '', 1009, 0, 0, 0, '', 161, 1, '<p>Con este modulo se podra asignar los contenidos a las papeletas u opciones en cada seccion de contenido de los catalogos de productos</p>', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1013, 410, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Tipo de Contenido Grupo', 'Tipo de Contenido Grupo', 'Tipo-de-Contenido-Grupo', 'no', '', 1009, 0, 0, 0, '', 160, 1, '<p>Lista de contenidos posibles para asignar como tipo de contenido</p>', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1381, 966, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Def Etiqueta', 'Admin Def Etiqueta', 'Admin-Def-Etiqueta', 'si', '', 1016, 0, 0, 0, '', 162, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1003, 945, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Conte. Etiquetas', 'Conte. Etiquetas', 'Conte.-Etiquetas', 'si', '', 999, 0, 0, 0, '', 163, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1138, 54691, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Grupo Galer&iacute;a', 'Grupo Galer&iacute;a', 'Grupo-Galeria', 'si', '', 999, 0, 0, 0, '', 168, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1078, 54684, 0, 'contenido/contenido_estatico.php', 'Banner home', 'Banner home', 'Banner-home', 'no', '', 1017, 0, 0, 0, '', 0, 1, '', 1, '', 0, 1, 0);
INSERT INTO acciones VALUES (1406, 54766, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Deptos', 'Admin Deptos', 'Admin-Deptos', 'si', '', 1020, 0, 0, 0, '', 211, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1145, 54697, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin Contactos', 'Admin Contactos', 'Admin-Contactos', 'si', '', 999, 0, 0, 0, '', 175, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1117, 54671, 0, 'contenido/ver_grupo_noticias.php', 'Opini&oacute;n', 'Opini&oacute;n', 'Opinion', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 4, 13);
INSERT INTO acciones VALUES (1079, 54685, 0, 'contenido/contenido_estatico.php', 'HEADER', 'HEADER', 'HEADER', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 1, '', 0, 1, 0);
INSERT INTO acciones VALUES (1069, 54678, 0, 'suscribete/suscribete.php', 'suscribete', 'suscribete', 'suscribete', 'no', '', 0, 0, 0, 0, '', 0, 0, '<p>Este php debe ingresar el mail que se entrega por el formulario de inscripci&oacute;n al newsletter</p>', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1230, 54716, 0, 'usuario/actualiza_email.php', 'Actualiza email', 'Actualiza email', 'Actualiza-email', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1071, 54680, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Templates Sitio', 'Templates Sitio', 'Templates-Sitio', 'si', '', 999, 0, 0, 0, '', 166, 0, '<p>Administraci&oacute;n de Templates del Sitio</p>', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1137, 54690, 0, 'gal/galeria.php', 'Galer&iacute;a de im&aacute;genes', 'Galer&iacute;a de im&aacute;genes', 'Galeria-de-imagenes', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1357, 54748, 0, 'inicio.php', 'Inicio', 'Inicio', 'Inicio', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1147, 54699, 0, 'usuario/usuario.php', 'login usuario', 'login usuario', 'login-usuario', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1511, 54704, 0, 'contenido/contenido_estatico.php', 'Ayuda', 'Ayuda', 'Ayuda', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1331, 54746, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. no habiles', 'Admin. no habiles', 'Admin.-no-habiles', 'si', '', 1021, 0, 0, 0, '', 203, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1267, 54708, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Ocupaci&oacute;n', 'Admin. Ocupaci&oacute;n', 'Admin.-Ocupacion', 'si', '', 1020, 0, 0, 0, '', 178, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1268, 54709, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Rango de Edad', 'Rango de Edad', 'Rango-de-Edad', 'si', '', 1020, 0, 0, 0, '', 179, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1269, 54710, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Sexo', 'Sexo', 'Sexo', 'si', '', 1020, 0, 0, 0, '', 180, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1270, 54711, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Nacionaliddad', 'Nacionaliddad', 'Nacionaliddad', 'si', '', 1020, 0, 0, 0, '', 181, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1271, 54712, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Nivel Educacional', 'Nivel Educacional', 'Nivel-Educacional', 'si', '', 1020, 0, 0, 0, '', 182, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1272, 54713, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Organizaci&oacute;n', 'Organizaci&oacute;n', 'Organizacion', 'si', '', 1020, 0, 0, 0, '', 183, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1273, 54714, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Frecuencia', 'Frecuencia', 'Frecuencia', 'si', '', 1020, 0, 0, 0, '', 184, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1277, 54720, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Formas de Recepci&oacute;n', 'Formas de Recepci&oacute;n', 'Formas-de-Recepcion', 'si', '', 1021, 0, 0, 0, '', 187, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1245, 54722, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Adm. Forma Recepci&oacute;n', 'Adm. Forma Recepci&oacute;n', 'Adm.-Forma-Recepcion', 'no', '', 0, 0, 0, 0, '', 187, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1279, 54723, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Adm. Formato Entrega', 'Adm. Formato Entrega', 'Adm.-Formato-Entrega', 'si', '', 1021, 0, 0, 0, '', 189, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1280, 54725, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Adm. Estado de solicitudes', 'Adm. Estado de solicitudes', 'Adm.-Estado-de-solicitudes', 'si', '', 1021, 0, 0, 0, '', 191, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1513, 54726, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Adm. sub estados de solicitudes', 'Adm. sub estados de solicitudes', 'Adm.-sub-estados-de-solicitudes', 'si', '', 0, 0, 0, 0, '', 192, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1281, 54727, 0, '', 'Adm. sub estados de solicitudes', 'Adm. sub estados de solicitudes', 'Adm.-sub-estados-de-solicitudes', 'si', '', 1021, 0, 0, 0, '', 192, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1291, 54733, 0, 'admin/administracion_sistema/administracion_sistema.php', 'URL XML', 'URL XML', 'URL-XML', 'si', '', 1021, 0, 0, 0, '', 197, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1292, 54734, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Actividades', 'Actividades', 'Actividades', 'si', '', 999, 0, 0, 0, '', 198, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1287, 54732, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Log Error XML', 'Log Error XML', 'Log-Error-XML', 'si', '', 1021, 0, 0, 0, '', 195, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1507, 54735, 0, 'sgs/mis_solicitudes/mis_solicitudes.php', 'Mis Solicitudes', 'Mis Solicitudes', 'Mis-Solicitudes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1514, 54736, 0, 'sgs/admin_solicitudes/admin_solicitudes.php', 'Solicitudes Ingresadas', 'Solicitudes Ingresadas', 'Solicitudes-Ingresadas', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1515, 54737, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Responsables', 'Admin. Responsables', 'Admin.-Responsables', 'si', '', 0, 0, 0, 0, '', 199, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1308, 54738, 0, '', 'Admin. Responsables', 'Admin. Responsables', 'Admin.-Responsables', 'si', '', 1021, 0, 0, 0, '', 199, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1516, 54739, 0, 'sgs/solicitudes_asignadas/solicitudes_asignadas.php', 'Solicitudes Asignadas', 'Solicitudes Asignadas', 'Solicitudes-Asignadas', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1311, 54741, 0, 'sgs/enrrutamiento/enrrutamiento.php', 'Enrrutamiento', 'Enrrutamiento', 'Enrrutamiento', 'si', '', 1021, 0, 0, 0, '', 0, 1, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1517, 54742, 0, 'sgs/mis_solicitudes_asignadas/mis_solicitudes_asignadas.php', 'Panel de Gesti&oacute;n de Solicitudes', 'Panel de Gesti&oacute;n de Solicitudes', 'gestion-de-solicitudes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1328, 54743, 0, 'admin/administracion_sistema/administracion_sistema.php', 'admin. Pais', 'admin. Pais', 'admin.-Pais', 'si', '', 999, 0, 0, 0, '', 202, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1518, 54744, 0, '', 'Preguntas Frecuentes', 'Preguntas Frecuentes', 'Preguntas-Frecuentes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1523, 54745, 0, '', 'Pol&iacute;tica de Privacidad', 'Pol&iacute;tica de Privacidad', 'Politica-de-Privacidad', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1519, 54747, 0, 'sgs/ingreso_manual/ingreso_manual.php', 'Ingreso de solicitudes', 'Ingreso de solicitudes', 'Ingreso-de-solicitudes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1373, 54749, 0, '', 'Home', 'Home', 'Home', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1520, 54750, 0, 'sgs/admin_solicitudes/admin_solicitudes.php', 'Asignar solicitudes', 'Asignar solicitudes', 'Asignar-solicitudes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1380, 54751, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin etiquetas tmplt', 'Admin etiquetas tmplt', 'Admin-etiquetas-tmplt', 'si', '', 1016, 0, 0, 0, '', 204, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1504, 54772, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Oficinas Retiro Informacion', 'Oficinas Retiro Informacion', 'Oficinas-Retiro-Informacion', 'si', '', 1021, 0, 0, 0, '', 215, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1449, 54760, 0, 'personal/cambio_contrasenia/cambio_contrasenia.php', 'Cambio Contraseña', 'Cambio Contraseña', 'Cambio-Contrasena', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1390, 54757, 0, 'sgs/instalacion/instalacion.php', 'Configuración', 'Configuración', 'Configuracion', 'si', '', 1021, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1510, 54761, 0, 'sgs/consulta_solicitud/consulta_solicitud.php', 'Consulta de solicitudes', 'Consulta de solicitudes', 'Consulta-de-solicitudes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1525, 54762, 0, 'sgs/reportes/reportes.php', 'Reportes', 'Reportes', 'Reportes', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1522, 54763, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Grupo User', 'Grupo User', 'Grupo-User', 'si', '', 0, 0, 0, 0, '', 210, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1401, 54764, 0, '', 'Grupo User', 'Grupo User', 'Grupo-User', 'si', '', 999, 0, 0, 0, '', 210, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1407, 54767, 0, 'admin/administracion_sistema/administracion_sistema.php', 'configuración Sistema', 'configuración Sistema', 'configuracion-Sistema', 'si', '', 999, 0, 0, 0, '', 213, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1455, 54769, 0, 'lib/version.php', 'ver', 'ver', 'ver', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1526, 54773, 0, 'lib/gpl.php', 'licencia', 'licencia', 'licencia', 'no', '', 0, 0, 0, 0, '', 0, 1, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1524, 54771, 0, 'sgs/solicitudes_finalizadas/solicitudes_finalizadas.php', 'Solicitudes Finalizadas', 'Solicitudes Finalizadas', 'Solicitudes-Finalizadas', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1521, 54754, 0, 'sgs/admin_usuarios/usuarios.php', 'Gestión de Usuarios', 'Gestión de Usuarios', 'Gestion-de-Usuarios', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);
INSERT INTO acciones VALUES (1527, 54774, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Admin. Entidades Padres', 'Admin. Entidades Padres', 'Admin.-Entidades-Padres', 'si', '', 1021, 0, 0, 0, '', 190, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1529, 54776, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Unidades Departamentos', 'Unidades Departamentos', 'Unidades-Departamentos', 'si', '', 1021, 0, 0, 0, '', 211, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1530, 54777, 0, 'contenido/contenido_estatico.php', 'error', 'error', 'error', 'no', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 1, 0);
INSERT INTO acciones VALUES (1532, 54779, 0, 'admin/administracion_sistema/administracion_sistema.php', 'Log de Errores', 'Log de Errores', 'Log-de-Errores', 'si', '', 999, 0, 0, 0, '', 216, 1, '', 0, '', 0, 2, 0);
INSERT INTO acciones VALUES (1533, 54780, 0, 'admin/respaldar/respaldar.php', 'Respaldo de BD', 'Respaldo de BD', 'Respaldo-de-BD', 'si', '', 0, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0);

#
# Volcar la base de datos para la tabla `actividades`
#
truncate table actividades;
INSERT INTO actividades VALUES (1, 'Introducci&oacute;n al proyecto', '2009-03-02', 253, 1);
INSERT INTO actividades VALUES (2, 'Lectura XML', '2009-03-03', 253, 2);
INSERT INTO actividades VALUES (3, 'Desarrollo de reglas de lectura de XML (Insert autom&aacute;ticos)', '2004-03-04', 253, 3);
INSERT INTO actividades VALUES (4, 'Optimizaci&oacute;n de estructura de Base de datos', '2009-03-05', 253, 4);
INSERT INTO actividades VALUES (5, 'Implementaci&oacute;n de UPDATE autom&aacute;tico en tablas con XML', '0000-00-00', 253, 0);
INSERT INTO actividades VALUES (6, 'Correcciones funcionales de SGS', '2009-03-20', 253, 5);

#
# Volcar la base de datos para la tabla `atencion`
#
truncate table atencion;
INSERT INTO atencion VALUES (12, '6', 6);
INSERT INTO atencion VALUES (11, '5', 5);
INSERT INTO atencion VALUES (10, '4', 4);
INSERT INTO atencion VALUES (9, '3', 3);
INSERT INTO atencion VALUES (8, '2', 2);
INSERT INTO atencion VALUES (7, '1', 1);
INSERT INTO atencion VALUES (13, '7', 7);

#
# Volcar la base de datos para la tabla `auto_admin`
#
truncate table auto_admin;
INSERT INTO auto_admin VALUES (40, 'auto_admin_tipo_campo', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (41, 'poll', '', 0, 0, '', 0, '<p>fgsdfgsdg sdfg</p>');
INSERT INTO auto_admin VALUES (17, 'accion_perfil', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (96, 'regiones', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (144, 'accion_grupo', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (47, 'auto_admin', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (48, 'auto_admin_campo', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (76, 'personal', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (77, 'contenido_tipo', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (100, 'comunas', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (212, 'usuario', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (104, 'soporte', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (95, 'atencion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (135, 'accion_etiqueta', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (210, 'usuario_perfil', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (152, 'contacto_mails', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (214, 'sgs_solicitud_acceso_temp', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (215, 'sgs_entidades_oficinas', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (154, 'establecimientos', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (155, 'accion_rollober', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (156, 'acciones', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (157, 'templates_acciones', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (211, 'sgs_departamentos', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (159, 'noticias', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (160, 'tipo_cont_cat_grupo_productos', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (162, 'contenido_etiqueta_definicion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (163, 'contenido_etiqueta', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (164, 'accion_opciones_menu', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (165, 'usuarios_newsletter', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (166, 'sitio_templates', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (168, 'grupo_galeria', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (169, 'grupo_galeria_perfiles', 'grupo_galeria', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (172, 'sucursal', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (175, 'contactos', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (177, 'tipo_persona', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (178, 'usuario_ocupacion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (179, 'usuario_rango_edad', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (180, 'usuario_sexo', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (181, 'usuario_nacionalidad', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (182, 'usuario_nivel_educacional', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (183, 'usuario_organizacion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (184, 'usuario_frecuencia_organizacion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (185, 'sgs_wizard', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (186, 'sgs_entidades', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (187, 'sgs_forma_recepcion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (208, 'sgs_solicitud_acceso', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (189, 'sgs_formato_entrega', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (190, 'sgs_entidad_padre', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (191, 'sgs_estado_solicitudes', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (192, 'sgs_sub_estado_solicitudes', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (197, 'sgs_llamadas_xml', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (198, 'actividades', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (195, 'sgs_log_error', '', 0, 0, '', 0, '<p>almacena los XML que no se ingresaron en el sistema</p>');
INSERT INTO auto_admin VALUES (199, 'sgs_responsable', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (213, 'cms_configuracion', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (201, 'sgs_flujo_estados_solicitud', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (202, 'pais', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (203, 'no_habil', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (204, 'templates_acciones_etiquetas', '', 0, 0, '', 0, '');
INSERT INTO auto_admin VALUES (216, 'error', '', 0, 0, '', 0, '');


#
# Volcar la base de datos para la tabla `auto_admin_apps`
#


#
# Volcar la base de datos para la tabla `auto_admin_apps_permisos`
#


#
# Volcar la base de datos para la tabla `auto_admin_campo`
#
truncate table auto_admin_campo;
INSERT INTO auto_admin_campo VALUES (3628, 'orden', 7, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3627, 'visto', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2465, 'act', 2, '', 17, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2464, 'accion', 2, '', 17, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4671, 'id_nacionalidad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4670, 'id_sexo', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3625, 'asigjefatura', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3624, 'detalleg', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3623, 'hrsextension', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3622, 'hrsjornada', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3621, 'hrsvalor', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3620, 'tipocontrato', 6, 'tipos_contratos', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3619, 'fechavence', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3618, 'fechaingreso', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3617, 'ccosto', 7, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3616, 'establecimiento', 6, 'establecimientos', 76, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3615, 'cargo', 6, 'tipos_cargos', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3614, 'celparentesco', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2629, 'html', 3, '', 40, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2628, 'tipo_campo', 2, '', 40, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2385, 'publico', 4, '', 41, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2384, 'active', 4, '', 41, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2383, 'lastip', 2, '', 41, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2382, 'question', 2, '#', 41, '', 0, '', 1, 0, 1, 0, '<p>dsfg sdfg sdfg sdf</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (2381, 'pollid', 1, '#', 41, '', 0, '', 0, 1, 0, 0, '<p>ooooooo</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (3613, 'telparentesco', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3612, 'parentesco', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2630, 'js', 3, '', 40, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2627, 'id_tipo_campo', 1, '', 40, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3611, 'contacto', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3610, 'ahorrocotizacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4107, 'orden', 7, '', 144, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4106, 'grupo', 2, '', 144, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2463, 'id_perfil', 1, '', 17, '', 0, '', 1, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3722, 'orden', 7, '', 96, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3609, 'ahorro', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3607, 'apv', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3608, 'apvcotizacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4669, 'id_rango_edad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3606, 'isaprecotizacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3605, 'isapre', 6, 'isapre', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3604, 'afpcotizacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3603, 'afpafiliacion', 5, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4668, 'id_ocupacion', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3721, 'region', 2, '', 96, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3602, 'afp', 6, 'afp', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3601, 'beneficio', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4667, 'telefono', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4666, 'codigo', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2623, 'id_auto_admin', 1, '', 47, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2624, 'tabla', 3, '', 47, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2625, 'accion', 2, '', 47, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2626, 'orden', 7, '', 47, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2631, 'orden', 7, '', 40, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2632, 'visible', 4, '', 40, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2709, 'orden', 7, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2708, 'txt', 4, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2707, 'pk', 4, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2706, 'existe_listado', 2, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2705, 'carpeta', 2, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2704, 'js', 3, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2703, 'id_auto_admin', 6, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2701, 'id_tipo_campo', 6, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2702, 'relacion', 2, '', 48, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2700, 'campo', 2, '', 48, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (2699, 'id_campo', 1, '', 48, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3600, 'desempeno', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3720, 'id_region', 1, '', 96, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3599, 'ley', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4105, 'id_grupo', 1, '', 144, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4665, 'comuna_empresa', 3, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3598, 'movilizacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3597, 'colacion', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3596, 'ump', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3595, 'bono', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3594, 'jefatura', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3593, 'ctacte', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3592, 'banco', 6, 'bancos', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3591, 'especialidad', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3590, 'universidad', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3589, 'titulo', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3587, 'id_comuna', 6, 'comunas', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3588, 'escolaridad', 6, 'personal_escolaridad', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3586, 'domicilio', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3585, 'email', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3584, 'celular', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3583, 'telefono', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3582, 'nacionalidad', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3580, 'fechanac', 9, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3579, 'nombres', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3014, 'foto', 5, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3013, 'bajada', 5, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3012, 'titulo', 5, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3011, 'cant_noticias', 11, '', 77, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3010, 'portada', 4, '', 77, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3009, 'orden', 7, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3008, 'descripcion', 2, '', 77, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3007, 'id_tipo', 1, '', 77, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3015, 'titulo_css', 3, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3016, 'bajada_css', 3, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3017, 'imagen_css', 3, '', 77, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3578, 'materno', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3577, 'paterno', 2, '', 76, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3576, 'dig', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3575, 'rut', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3574, 'id', 1, '', 76, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4664, 'direccion_empresa', 3, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3626, 'estado', 2, '', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3581, 'estcivil', 6, 'estado_civil', 76, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4663, 'empresa', 3, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3795, 'minuto', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3794, 'hora', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3735, 'orden', 7, '', 100, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3732, 'id_comuna', 1, '', 100, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3733, 'id_region', 6, '', 100, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3734, 'comuna', 2, '', 100, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4662, 'comuna', 3, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4661, 'id_comuna', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4660, 'ciudad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3793, 'orden', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3792, 'observaciones', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3791, 'soporte', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3790, 'tiempo', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3789, 'ejecutivo', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3788, 'fecha_fin', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3787, 'fecha_ini', 2, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3786, 'id_solucion', 6, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3785, 'id_lugar', 6, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3784, 'id_atencion', 6, '', 104, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3783, 'id_usuario', 6, '', 104, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3782, 'id_soporte', 1, '', 104, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3717, 'id_atencion', 1, '', 95, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3718, 'atencion', 2, '', 95, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3719, 'orden', 7, '', 95, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3993, 'id_accion_etiqueta', 1, '', 135, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3994, 'accion', 2, '', 135, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3995, 'etiqueta', 2, '', 135, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3996, 'id_contenido', 7, '', 135, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (3997, 'orden', 7, '', 135, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4625, 'administracion', 4, '', 210, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4624, 'orden', 7, '', 210, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4623, 'activo', 4, '', 210, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4622, 'url_defecto', 2, '', 210, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4108, 'home', 4, '', 144, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4147, 'orden', 2, '', 41, '', 0, '', 0, 0, 0, 0, '<p>sdfsdfsdfs</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4659, 'id_region', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4658, 'equipo', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4189, 'id_contacto', 1, '', 152, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4190, 'descripcion', 2, '', 152, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4191, 'mail_contacto', 2, '', 152, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4192, 'defecto', 4, '', 152, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4193, 'orden', 7, '', 152, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4201, 'id', 1, '', 154, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4202, 'establecimiento', 2, '', 154, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4203, 'ctro_costo', 7, '', 154, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4204, 'dificil', 7, '', 154, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4205, 'orden', 7, '', 154, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4209, 'id_accion_rollober', 1, '', 155, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4210, 'id_acc', 6, '', 155, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4211, 'boton_up', 8, '', 155, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4212, 'boton_down', 8, '', 155, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4213, 'orden', 7, '', 155, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4214, 'id_acc', 1, '', 156, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4215, 'accion', 11, '', 156, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4216, 'act', 11, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4217, 'php', 2, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4218, 'descrip_php_esp', 2, '', 156, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4219, 'descrip_php_eng', 2, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4220, 'home', 4, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4221, 'icono', 4, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4222, 'id_grupo', 6, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4223, 'defecto', 4, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4224, 'orden', 7, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4225, 'id_tipo', 6, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4226, 'id_contenido', 6, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4227, 'id_auto_admin', 6, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4228, 'publica_noticia', 4, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4229, 'help', 3, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4230, 'presente', 4, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4231, 'etiqueta', 2, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4232, 'id_templates', 6, '', 156, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4233, 'id_templates', 1, '', 157, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4234, 'templates', 2, '', 157, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4235, 'html', 3, '', 157, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4236, 'orden', 7, '', 157, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4243, 'id_noticia', 1, '', 159, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4244, 'idioma', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4245, 'titulo', 2, '', 159, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4246, 'titulo_corto', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4247, 'contenido_corto', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4248, 'contenido', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4249, 'id_imagen', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4250, 'id_tipo', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4251, 'visible', 4, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4252, 'imprimir', 4, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4253, 'amigo', 4, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4254, 'fecha', 9, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4255, 'fuente', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4256, 'id_sector', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4257, 'id_cliente', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4258, 'id_galeria', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4259, 'id_autor', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4260, 'id_user', 6, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4261, 'estado', 4, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4262, 'click', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4263, 'link', 3, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4264, 'ptos', 2, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4265, 'orden', 7, '', 159, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4270, 'id_tipo_cont_cat_grupo_productos', 1, '', 160, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4271, 'tipo_contenido', 2, '', 160, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4272, 'orden', 7, '', 160, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4657, 'orden', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4656, 'celular', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4655, 'estado', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4290, 'id_definicion', 1, '', 162, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4291, 'descripcion_definicion', 2, '', 162, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4292, 'orden', 7, '', 162, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4293, 'id_etiqueta', 1, '', 163, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4294, 'etiqueta', 3, '', 163, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4295, 'id_tipo', 6, '', 163, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4296, 'id_definicion', 6, '', 163, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4297, 'orden', 7, '', 163, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4298, 'id_opcion_menu', 1, '', 164, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4299, 'opcion', 2, '', 164, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4300, 'orden', 7, '', 164, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4301, 'id_usuario_newsletter', 1, '', 165, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4302, 'email_news', 3, '', 165, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4303, 'fecha_ingreso', 9, '', 165, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4304, 'orden', 7, '', 165, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4305, 'id_template', 1, '', 166, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4306, 'template', 2, '', 166, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4307, 'html_template', 3, '', 166, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4308, 'defecto', 4, '', 166, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4309, 'orden', 7, '', 166, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4310, 'php', 2, '', 164, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4317, 'id_grupo_galeria', 1, '', 168, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4318, 'grupo_galeria', 2, '', 168, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4319, 'imagen', 8, '', 168, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4320, 'descripcion', 3, '', 168, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4321, 'orden', 7, '', 168, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4322, 'id_grupo_galeria_perfiles', 1, '', 169, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4323, 'id_perfil', 6, 'usuario_perfil', 169, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4324, 'id_grupo_galeria', 7, '', 169, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4325, 'orden', 7, '', 169, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4346, 'id_sucursal', 1, '', 172, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4347, 'sucursal', 2, '', 172, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4348, 'orden', 7, '', 172, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4365, 'fecha', 9, '', 175, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4364, 'comentario', 3, '', 175, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4363, 'mail', 2, '', 175, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4362, 'nombre', 2, '', 175, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4361, 'id_contacto', 1, '', 175, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4366, 'mail_contacto', 2, '', 175, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4367, 'orden', 7, '', 175, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4372, 'tipo_persona', 2, '', 177, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4371, 'id_tipo_persona', 1, '', 177, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4373, 'orden', 7, '', 177, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4374, 'id_usuario_ocupacion', 1, '', 178, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4375, 'ocupacion', 2, '', 178, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4376, 'orden', 7, '', 178, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4377, 'id_rango_edad', 1, '', 179, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4378, 'rango_edad', 2, '', 179, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4379, 'orden', 7, '', 179, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4380, 'id_sexo', 1, '', 180, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4381, 'sexo', 2, '', 180, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4382, 'orden', 7, '', 180, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4383, 'id_nacionalidad', 1, '', 181, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4384, 'nacionalidad', 2, '', 181, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4385, 'orden', 7, '', 181, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4386, 'id_nivel_educacional', 1, '', 182, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4387, 'nivel_educacional', 2, '', 182, '', 0, '', 1, 0, 1, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4388, 'orden', 7, '', 182, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4389, 'id_organizacion', 1, '', 183, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4390, 'organizacion', 2, '', 183, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4391, 'orden', 7, '', 183, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4392, 'id_frecuencia_organizacion', 1, '', 184, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4393, 'frecuencia_organizacion', 2, '', 184, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4394, 'orden', 7, '', 184, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4654, 'escolaridad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4653, 'ocupacion', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4652, 'hijos', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4651, 'fono', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4650, 'depto', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4649, 'numero', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4648, 'direccion', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4647, 'estado_civil', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4646, 'edad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4645, 'fecha_nac', 9, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4644, 'rut', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4643, 'session', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4642, 'email', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4641, 'apoderado', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4640, 'razon_social', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4414, 'id_wizard', 1, '', 185, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4415, 'nombre_pregunta', 2, '', 185, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4416, 'pregunta', 16, '', 185, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4417, 'respuesta_positiva', 17, '', 185, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4418, 'orden', 7, '', 185, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4419, 'id_entidad', 1, '', 186, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4420, 'entidad', 2, '', 186, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4421, 'orden', 7, '', 186, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4422, 'id_forma_recepcion', 1, '', 187, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4423, 'forma_recepcion', 2, '', 187, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4424, 'orden', 7, '', 187, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4567, 'id_digitador', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4566, 'id_responsable', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4565, 'id_sub_estado_solicitud', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4564, 'id_estado_solicitud', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4563, 'orden', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4562, 'id_formato_entrega', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4561, 'oficina', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4560, 'id_forma_recepcion', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4559, 'notificacion', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4558, 'identificacion_documentos', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4557, 'id_usuario', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4556, 'id_entidad', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4438, 'id_formato_entrega', 1, '', 189, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4439, 'formato_entrega', 2, '', 189, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4440, 'orden', 7, '', 189, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4441, 'id_entidad_padre', 1, '', 190, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4442, 'entidad_padre', 2, '', 190, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4443, 'sigla', 2, '', 190, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4444, 'orden', 7, '', 190, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4445, 'sigla', 2, '', 186, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4446, 'id_entidad_padre', 6, '', 186, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4447, 'id_estado_solicitud', 1, '', 191, '', 0, '', 0, 1, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4448, 'estado_solicitud', 2, '#', 191, '', 0, '', 1, 0, 0, 0, '<p>Estado que vera los asignadores, responsables o funcionarios del servicio o entidad</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4449, 'orden', 7, '', 191, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4450, 'id_sub_estado_solicitud', 1, '', 192, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4451, 'id_estado_solicitud', 6, '', 192, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4452, 'sub_estado_solicitud', 2, '', 192, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4453, 'orden', 7, '', 192, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4555, 'id_entidad_padre', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4554, 'fecha_termino', 9, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4466, 'id_log_error', 1, '', 195, '', 0, '', 0, 1, 0, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4482, 'orden', 7, '', 197, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4481, 'url', 2, '', 197, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4480, 'id_entidad_padre', 6, '', 197, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4479, 'id_llamada_xml', 1, '', 197, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4553, 'fecha_inicio', 9, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4488, 'id_usuario', 6, '', 198, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4487, 'fecha', 9, '', 198, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4486, 'actividad', 2, '', 198, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4467, 'id_entidad_padre', 6, '', 195, '', 0, '', 1, 0, 0, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4468, 'query', 16, '', 195, '', 0, '', 0, 0, 0, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4469, 'fecha_hora', 2, '', 195, '', 0, '', 1, 0, 1, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4470, 'orden', 7, '', 195, '', 0, '', 0, 0, 0, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4471, 'error', 3, '', 195, '', 0, '', 0, 0, 0, 0, '<p>almacena los XML que no se ingresaron en el sistema</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4484, 'id', 2, '', 197, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4485, 'id_actividad', 1, '', 198, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4489, 'orden', 7, '', 198, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4490, 'id_responsable', 1, '', 199, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4491, 'id_entidad_padre', 6, '', 199, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4492, 'id_entidad', 6, '', 199, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4493, 'id_usuario', 6, '', 199, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4494, 'orden', 2, '', 199, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4684, 'descripcion', 16, '', 213, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4683, 'valor', 3, '', 213, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4500, 'id_estado_padre', 11, '#', 191, '', 0, '', 0, 0, 0, 0, '<p>Este debe ser el id del estado que contendra a este estado por ejejmplo el estado finalizado que tiene id 13 en este minuto contendra a todos los demas estados finalizados del sistema, el id 13 es el id padre de todos estos estados</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4501, 'id_perfil', 6, '', 191, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4502, 'pregunta', 7, '', 191, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4503, 'si_descripcion', 7, '', 191, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4504, 'no_descripcion', 7, '', 191, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4505, 'folio', 1, '', 201, '', 0, '', 1, 1, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4506, 'id_estado_solicitud', 2, '', 201, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4507, 'id_estado_respuestas', 2, '', 201, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4508, 'fecha', 2, '', 201, '', 0, '', 1, 0, 1, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4509, 'id_usuario', 2, '', 201, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4510, 'observacion', 2, '', 201, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4511, 'orden', 7, '', 201, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4512, 'id_pais', 1, '', 202, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4513, 'pais', 2, '', 202, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4514, 'orden', 7, '', 202, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4515, 'id_no_habil', 1, '', 203, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4516, 'no_habil', 9, '', 203, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4517, 'orden', 7, '', 203, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4518, 'id_templates_acciones_etiquetas', 1, '', 204, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4519, 'etiqueta', 2, '', 204, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4520, 'variable', 2, '', 204, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4521, 'id_templates', 6, '', 204, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4522, 'orden', 7, '', 204, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4552, 'fecha_digitacion', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4551, 'fecha_formulacion', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4550, 'folio', 2, '', 208, '', 0, '', 1, 0, 1, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4549, 'id_solicitud_acceso', 1, '', 208, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4528, 'estado_para_usuario', 2, '#', 191, '', 0, '', 0, 0, 0, 0, '<p>Es el estado o nombre del estado que vera el usuario en su listado</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4529, 'comentario_para_usuario', 16, '#', 191, '', 0, '', 0, 0, 0, 0, '<p>Descripci&oacute;n extensa que se le mostrara al usuario&nbsp; final en pantalla</p>', 0, '');
INSERT INTO auto_admin_campo VALUES (4682, 'configuracion', 2, '', 213, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4681, 'id_configuracion', 1, '', 213, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4621, 'perfil', 2, '', 210, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4620, 'id_perfil', 1, '', 210, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4568, 'prorroga', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4569, 'finalizada', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4570, 'hash', 7, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4639, 'materno', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4638, 'paterno', 2, '', 212, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4637, 'apellido', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4636, 'nombre', 2, '', 212, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4635, 'establecimiento', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4634, 'id_perfil', 6, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4633, 'password', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4632, 'login', 2, '', 212, '', 1, '', 0, 0, 1, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4631, 'id_usuario', 1, '', 212, '', 0, '', 0, 1, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4626, 'funcionario', 4, '', 210, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4627, 'maneja_solicitudes', 4, '', 210, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4628, 'id_departamento', 1, '', 211, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4629, 'departamento', 2, '', 211, '', 1, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4630, 'orden', 7, '', 211, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4672, 'id_nivel_educacional', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4673, 'id_organizacion', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4674, 'id_frecuencia_organizacion', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4675, 'fecha_crea', 9, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4676, 'fecha_ingreso', 9, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4677, 'id_tipo_persona', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4678, 'id_entidad_padre', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4679, 'id_entidad', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4680, 'id_departamento', 2, '', 212, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4685, 'publico', 4, '', 213, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4686, 'orden', 7, '', 213, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4687, 'txt', 4, '', 213, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4688, 'obligatorio', 4, '', 213, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4689, 'id_solicitud_acceso', 1, '', 214, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4690, 'folio', 2, '', 214, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4691, 'fecha_formulacion', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4692, 'fecha_digitacion', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4693, 'fecha_inicio', 9, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4694, 'fecha_termino', 9, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4695, 'id_entidad_padre', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4696, 'id_entidad', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4697, 'id_usuario', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4698, 'identificacion_documentos', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4699, 'notificacion', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4700, 'id_forma_recepcion', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4701, 'oficina', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4702, 'id_formato_entrega', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4703, 'orden', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4704, 'id_estado_solicitud', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4705, 'id_sub_estado_solicitud', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4706, 'id_responsable', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4707, 'id_digitador', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4708, 'prorroga', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4709, 'finalizada', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4710, 'hash', 2, '', 214, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4711, 'id_entidad_oficina', 1, '', 215, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4712, 'oficina', 2, '', 215, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4713, 'id_entidad', 6, '', 215, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4714, 'orden', 7, '', 215, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4715, 'id_entidad_padre', 6, 'sgs_entidades', 215, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4716, 'obliga', 4, '', 187, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4717, 'firmada', 2, '', 208, '', 0, '', 0, 0, 0, 0, '', 1, '');
INSERT INTO auto_admin_campo VALUES (4718, 'id_entidad_padre', 6, 'sgs_entidades', 211, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4719, 'id_entidad', 6, '', 211, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4720, 'id_error', 1, '', 216, '', 0, '', 0, 1, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4721, 'query', 3, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4722, 'mysql_error', 3, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4723, 'php', 2, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4724, 'id_usuario', 6, '', 216, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4725, 'fecha', 9, '', 216, '', 0, '', 1, 0, 1, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4726, 'hora', 2, '', 216, '', 0, '', 1, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4727, 'solucionado', 4, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4728, 'descripcion_solucion', 17, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4729, 'id_user_solucion', 2, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4730, 'url', 2, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4731, 'orden', 7, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4732, 'query_error', 3, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4733, 'servidor', 2, '', 216, '', 0, '', 0, 0, 0, 0, '', 0, '');
INSERT INTO auto_admin_campo VALUES (4734, 'id_flujo_estados_solicitud', 2, '', 201, '', 0, '', 0, 0, 0, 0, '', 1, '');

#
# Volcar la base de datos para la tabla `auto_admin_combinacion`
#
truncate table auto_admin_combinacion;
INSERT INTO auto_admin_combinacion VALUES ('not_null primary_key auto_increment', 11, 'int', 1, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null', 10, 'string', 2, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null', 255, 'string', 3, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null', 11, 'int', 2, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null', 10, 'date', 9, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null', 1, 'int', 3, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null primary_key auto_increment', 20, 'int', 1, 0);
INSERT INTO auto_admin_combinacion VALUES ('not_null blob', 65535, 'blob', 2, 0);

#
# Volcar la base de datos para la tabla `auto_admin_permisos`
#
truncate table auto_admin_permisos;
INSERT INTO auto_admin_permisos VALUES (37, 144, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (110, 135, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (147, 100, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (171, 152, 0, 1, 1, 0, 1, 1, 1, 1, 0, '', 0);
INSERT INTO auto_admin_permisos VALUES (172, 152, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (186, 154, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (198, 77, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (199, 77, 0, 1, 1, 1, 1, 1, 1, 1, 0, '', 0);
INSERT INTO auto_admin_permisos VALUES (208, 77, 0, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (209, 77, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (214, 152, 0, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (215, 152, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (243, 155, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (255, 157, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (275, 160, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (301, 162, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (302, 163, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (303, 163, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (317, 164, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (318, 165, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (319, 166, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (321, 168, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (329, 175, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (331, 177, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (332, 178, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (333, 178, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (334, 179, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (335, 179, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (336, 180, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (337, 181, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (338, 182, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (339, 183, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (340, 184, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (341, 96, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (342, 185, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (343, 186, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (344, 187, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (345, 186, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (346, 187, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (347, 187, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (348, 189, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (349, 190, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (350, 191, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (351, 192, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (352, 192, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (355, 186, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (360, 192, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (362, 195, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (366, 197, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (367, 198, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (369, 48, 1, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (370, 199, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (371, 199, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (372, 199, 5, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (376, 202, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (377, 203, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (378, 201, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (379, 40, 5, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (380, 40, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (381, 96, 1, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (382, 96, 2, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (383, 96, 4, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (384, 96, 5, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (385, 96, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (386, 96, 1001, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (387, 96, 1002, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (388, 96, 1003, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (389, 96, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (390, 96, 1003, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (391, 204, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (392, 178, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (393, 190, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (394, 135, 5, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (395, 135, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (416, 210, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (417, 210, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (418, 210, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (419, 210, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (425, 211, 999, 1, 1, 1, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (426, 213, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (445, 190, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (439, 215, 1004, 1, 1, 0, 0, 1, 1, 1, 0, '', 0);
INSERT INTO auto_admin_permisos VALUES (448, 203, 1004, 1, 1, 0, 1, 1, 1, 1, 0, '', 0);
INSERT INTO auto_admin_permisos VALUES (447, 186, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (446, 186, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (443, 215, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);
INSERT INTO auto_admin_permisos VALUES (450, 211, 1004, 1, 1, 0, 0, 1, 1, 1, 0, '', 0);
INSERT INTO auto_admin_permisos VALUES (451, 216, 999, 1, 1, 0, 1, 1, 1, 1, 1, '', 0);

#
# Volcar la base de datos para la tabla `auto_admin_tipo_campo`
#
truncate table auto_admin_tipo_campo;
INSERT INTO auto_admin_tipo_campo VALUES (2, 'text', '<input type="text" name="#nombre_campo#" value="#valor_campo#" id="#nombre_campo#" #js_unico#>', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (3, 'text area', '<textarea name="#nombre_campo#" cols="70" rows="10" class="textos" id="#nombre_campo#">#valor_campo#</textarea>', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (4, 'si no', '<input type="radio" name="#nombre_campo#" value="1"  id="#nombre_campo#" #checked1#>si\r\n<input type="radio" name="#nombre_campo#" value="0"  id="#nombre_campo#" #checked0#>no\r\n', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (5, 'checkbox', '<input type="checkbox" name="#nombre_campo#" value="1"  id="#nombre_campo#" #checked1#>\r\n', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (6, 'combo list', '', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (7, 'hidden', '<input type="hidden" name="#nombre_campo#" value="#valor_campo#"  id="#nombre_campo#">\r\n', '', 0, 1);
INSERT INTO auto_admin_tipo_campo VALUES (8, 'file', '<input type="file" name="#nombre_campo#"><div id="file_#nombre_campo#">#valor_campo#</div>', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (9, 'date', '<input name="#nombre_campo#" type="text" size="10" value= "#valor_campo#" maxlength="10"  id="#nombre_campo#">&nbsp;\r\n<img src="images/calendario.gif" alt="" border="0" onclick="displayCalendar(document.form1.#nombre_campo#,\'dd-mm-yyyy\',this)">\r\n\r\n', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (10, 'sexo', '<input type="radio" name="#nombre_campo#" value="0" id="#nombre_campo#">hombre\r\n<input type="radio" name="#nombre_campo#" value="1" id="#nombre_campo#">mujer\r\n', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (1, 'PK', '', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (11, 'solo numeros', '<input type="text" name="#nombre_campo#" value="#valor_campo#"  id="#nombre_campo#">', ' var #nombre_campo# = new LiveValidation(\'#nombre_campo#\');\r\n#nombre_campo#.add( Validate.Numericality );', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (12, 'solo letras', '<input type="text" name="#nombre_campo#" value="#valor_campo#" id="#nombre_campo#" >', '', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (13, 'email', '<input type="text" name="#nombre_campo#" value="#valor_campo#"  id="#nombre_campo#">', ' var #nombre_campo# = new LiveValidation(\'#nombre_campo#\');\r\n#nombre_campo#.add( Validate.Email );', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (14, 'rango', ' <input type="text" name="#nombre_campo#" value="#valor_campo#"  id="#nombre_campo#">', ' var #nom_campo# = new LiveValidation(\'#nom_campo#\');\r\n#nom_campo#.add( Validate.Numericality, { minimum: #nom_campo#, maximum: #nom_campo# } );', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (15, 'sino letras', '<input type="radio" name="#nombre_campo#" value="si"  id="#nombre_campo#">si\r\n<input type="radio" name="#nombre_campo#" value="no"  id="#nombre_campo#">no', '<script type="text/javascript" src="js/livevalidation_standalone.js"></script>\r\n	<SCRIPT type="text/javascript" src="js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>', 0, 1);
INSERT INTO auto_admin_tipo_campo VALUES (16, 'fckeditor_b', ' <textarea id="#nombre_campo#" name="#nombre_campo#"  rows="2">#valor_campo#</textarea>', '      window.onload = function()\r\n      {\r\n        var oFCKeditor1 = new FCKeditor(\'#nombre_campo#\') ;\r\n        oFCKeditor1.BasePath ="fckeditor/";\r\n		oFCKeditor1.ToolbarSet ="Basic";\r\n		oFCKeditor1.Height =70;\r\n        oFCKeditor1.ReplaceTextarea() ;\r\n     \r\n      }\r\n    ', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (17, 'fckeditor_pro', ' <textarea id="#nombre_campo#" name="#nombre_campo#"  rows="2">#valor_campo#</textarea>', '      window.onload = function()\r\n      {\r\n        \r\n     \r\n        var oFCKeditor3 = new FCKeditor(\'#nombre_campo#\' ) ;\r\n        oFCKeditor3.BasePath ="fckeditor/" ;\r\n		oFCKeditor3.Height = 400 ;\r\n		oFCKeditor3.ReplaceTextarea() ;\r\n      }\r\n    ', 0, 0);
INSERT INTO auto_admin_tipo_campo VALUES (18, 'Password', '<input type="password" name="#nombre_campo#" id="#nombre_campo#">', '', 0, 1);

#
# Volcar la base de datos para la tabla `comentarios`
#


INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (null, 'Aviso de errores via email', '1', '<p>Si esta variable esta en 1, cualquier consulta que registre un error y cuente con la funcion error sera supervizada y dara aviso via email a todos los mail que se encuentren en la variable mail de soporte</strong></p>', 1, 26, 0, 0);
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (null, 'mail de soporte', 'rrosende@minsegpres.gob.cl', '<p>se pueden agregar todos los mail necesarios separados por coma, a estos email se le enviaran avisos de errores en el sistema.</p>', 1, 27, 0, 0);



#
# Volcar la base de datos para la tabla `comunas`
#
truncate table comunas;
INSERT INTO comunas VALUES (1, 1, 'Alto Hospicio', 0);
INSERT INTO comunas VALUES (2, 1, 'Camina', 0);
INSERT INTO comunas VALUES (3, 1, 'Colchane', 0);
INSERT INTO comunas VALUES (4, 1, 'Huara', 0);
INSERT INTO comunas VALUES (5, 1, 'Iquique', 0);
INSERT INTO comunas VALUES (6, 1, 'Pica', 0);
INSERT INTO comunas VALUES (7, 1, 'Pozo Almonte', 0);
INSERT INTO comunas VALUES (8, 2, 'Antofagasta', 0);
INSERT INTO comunas VALUES (9, 2, 'Calama', 0);
INSERT INTO comunas VALUES (10, 2, 'Mar&iacute;a Elena', 0);
INSERT INTO comunas VALUES (11, 2, 'Mejillones', 0);
INSERT INTO comunas VALUES (12, 2, 'Ollague', 0);
INSERT INTO comunas VALUES (13, 2, 'San Pedro Atacama', 0);
INSERT INTO comunas VALUES (14, 2, 'Sierra Gorda', 0);
INSERT INTO comunas VALUES (15, 2, 'Taltal', 0);
INSERT INTO comunas VALUES (16, 2, 'Tocopilla', 0);
INSERT INTO comunas VALUES (17, 3, 'Alto del Carmen', 0);
INSERT INTO comunas VALUES (18, 3, 'Caldera', 0);
INSERT INTO comunas VALUES (19, 3, 'Cha&ntilde;aral', 0);
INSERT INTO comunas VALUES (20, 3, 'Copiap&oacute;', 0);
INSERT INTO comunas VALUES (21, 3, 'Diego de Almagro', 0);
INSERT INTO comunas VALUES (22, 3, 'Freirina', 0);
INSERT INTO comunas VALUES (23, 3, 'Huasco', 0);
INSERT INTO comunas VALUES (24, 3, 'Tierra Amarilla', 0);
INSERT INTO comunas VALUES (25, 3, 'Vallenar', 0);
INSERT INTO comunas VALUES (26, 4, 'Andacollo', 0);
INSERT INTO comunas VALUES (27, 4, 'Canela', 0);
INSERT INTO comunas VALUES (28, 4, 'Combarbal&aacute;', 0);
INSERT INTO comunas VALUES (29, 4, 'Coquimbo', 0);
INSERT INTO comunas VALUES (30, 4, 'Illapel', 0);
INSERT INTO comunas VALUES (31, 4, 'La Higuera', 0);
INSERT INTO comunas VALUES (32, 4, 'La Serena', 0);
INSERT INTO comunas VALUES (33, 4, 'Los Vilos', 0);
INSERT INTO comunas VALUES (34, 4, 'Monte Patria', 0);
INSERT INTO comunas VALUES (35, 4, 'Ovalle', 0);
INSERT INTO comunas VALUES (36, 4, 'Paihuano', 0);
INSERT INTO comunas VALUES (37, 4, 'Punitaqui', 0);
INSERT INTO comunas VALUES (38, 4, 'R&iacute;o Hurtado', 0);
INSERT INTO comunas VALUES (39, 4, 'Salamanca', 0);
INSERT INTO comunas VALUES (40, 4, 'Vicu&ntilde;a', 0);
INSERT INTO comunas VALUES (41, 5, 'Algarrobo', 0);
INSERT INTO comunas VALUES (42, 5, 'Cabildo', 0);
INSERT INTO comunas VALUES (43, 5, 'Calle Larga', 0);
INSERT INTO comunas VALUES (44, 5, 'Cartagena', 0);
INSERT INTO comunas VALUES (45, 5, 'Casablanca', 0);
INSERT INTO comunas VALUES (46, 5, 'Catemu', 0);
INSERT INTO comunas VALUES (47, 5, 'Con - Con', 0);
INSERT INTO comunas VALUES (48, 5, 'El Quisco', 0);
INSERT INTO comunas VALUES (49, 5, 'El Tabo', 0);
INSERT INTO comunas VALUES (50, 5, 'Hijuelas', 0);
INSERT INTO comunas VALUES (51, 5, 'Isla de Pascua', 0);
INSERT INTO comunas VALUES (52, 5, 'Juan Fern&aacute;ndez', 0);
INSERT INTO comunas VALUES (53, 5, 'La Calera', 0);
INSERT INTO comunas VALUES (54, 5, 'La Cruz', 0);
INSERT INTO comunas VALUES (55, 5, 'La Ligua', 0);
INSERT INTO comunas VALUES (56, 5, 'Limache', 0);
INSERT INTO comunas VALUES (57, 5, 'Llay llay', 0);
INSERT INTO comunas VALUES (58, 5, 'Los Andes', 0);
INSERT INTO comunas VALUES (59, 5, 'Nogales', 0);
INSERT INTO comunas VALUES (60, 5, 'Olmu&eacute;', 0);
INSERT INTO comunas VALUES (61, 5, 'Panquehue', 0);
INSERT INTO comunas VALUES (62, 5, 'Papudo', 0);
INSERT INTO comunas VALUES (63, 5, 'Petorca', 0);
INSERT INTO comunas VALUES (64, 5, 'Puchuncavi', 0);
INSERT INTO comunas VALUES (65, 5, 'Putaendo', 0);
INSERT INTO comunas VALUES (66, 5, 'Quillota', 0);
INSERT INTO comunas VALUES (67, 5, 'Quilpue', 0);
INSERT INTO comunas VALUES (68, 5, 'Quintero', 0);
INSERT INTO comunas VALUES (69, 5, 'Rinconada', 0);
INSERT INTO comunas VALUES (70, 5, 'San Antonio', 0);
INSERT INTO comunas VALUES (71, 5, 'San Esteban', 0);
INSERT INTO comunas VALUES (72, 5, 'San Felipe', 0);
INSERT INTO comunas VALUES (73, 5, 'Santa Mar&iacute;a', 0);
INSERT INTO comunas VALUES (74, 5, 'Santo Domingo', 0);
INSERT INTO comunas VALUES (75, 5, 'Valpara&iacute;so', 0);
INSERT INTO comunas VALUES (76, 5, 'Villa Alemana', 0);
INSERT INTO comunas VALUES (77, 5, 'Vi&ntilde;a del Mar', 0);
INSERT INTO comunas VALUES (78, 5, 'Zapallar', 0);
INSERT INTO comunas VALUES (79, 6, 'Chepica', 0);
INSERT INTO comunas VALUES (80, 6, 'Chimbarongo', 0);
INSERT INTO comunas VALUES (81, 6, 'Codegua', 0);
INSERT INTO comunas VALUES (82, 6, 'Coinco', 0);
INSERT INTO comunas VALUES (83, 6, 'Coltauco', 0);
INSERT INTO comunas VALUES (84, 6, 'Donihue', 0);
INSERT INTO comunas VALUES (85, 6, 'Graneros', 0);
INSERT INTO comunas VALUES (86, 6, 'La Estrella', 0);
INSERT INTO comunas VALUES (87, 6, 'Las Cabras', 0);
INSERT INTO comunas VALUES (88, 6, 'Litueche', 0);
INSERT INTO comunas VALUES (89, 6, 'Lolol', 0);
INSERT INTO comunas VALUES (90, 6, 'Machali', 0);
INSERT INTO comunas VALUES (91, 6, 'Malloa', 0);
INSERT INTO comunas VALUES (92, 6, 'Marchigue', 0);
INSERT INTO comunas VALUES (93, 6, 'Nancagua', 0);
INSERT INTO comunas VALUES (94, 6, 'Navidad', 0);
INSERT INTO comunas VALUES (95, 6, 'Olivar', 0);
INSERT INTO comunas VALUES (96, 6, 'Palmilla', 0);
INSERT INTO comunas VALUES (97, 6, 'Paredones', 0);
INSERT INTO comunas VALUES (98, 6, 'Peralillo', 0);
INSERT INTO comunas VALUES (99, 6, 'Peumo', 0);
INSERT INTO comunas VALUES (100, 6, 'Pichidegua', 0);
INSERT INTO comunas VALUES (101, 6, 'Pichilemu', 0);
INSERT INTO comunas VALUES (102, 6, 'Placilla', 0);
INSERT INTO comunas VALUES (103, 6, 'Pumanque', 0);
INSERT INTO comunas VALUES (104, 6, 'Quinta de Tilcoco', 0);
INSERT INTO comunas VALUES (105, 6, 'Rancagua', 0);
INSERT INTO comunas VALUES (106, 6, 'Rengo', 0);
INSERT INTO comunas VALUES (107, 6, 'Requinoa', 0);
INSERT INTO comunas VALUES (108, 6, 'San Fernando', 0);
INSERT INTO comunas VALUES (109, 6, 'San Vicente', 0);
INSERT INTO comunas VALUES (110, 6, 'Santa Cruz', 0);
INSERT INTO comunas VALUES (111, 6, 'Sn. Fco. de Mostazal', 0);
INSERT INTO comunas VALUES (112, 7, 'Cauquenes', 0);
INSERT INTO comunas VALUES (113, 7, 'Chanco', 0);
INSERT INTO comunas VALUES (114, 7, 'Colb&uacute;n', 0);
INSERT INTO comunas VALUES (115, 7, 'Constituci&oacute;n', 0);
INSERT INTO comunas VALUES (116, 7, 'Curepto', 0);
INSERT INTO comunas VALUES (117, 7, 'Curico', 0);
INSERT INTO comunas VALUES (118, 7, 'Empedrado', 0);
INSERT INTO comunas VALUES (119, 7, 'Hualane', 0);
INSERT INTO comunas VALUES (120, 7, 'Licanten', 0);
INSERT INTO comunas VALUES (121, 7, 'Linares', 0);
INSERT INTO comunas VALUES (122, 7, 'Longavi', 0);
INSERT INTO comunas VALUES (123, 7, 'Maule', 0);
INSERT INTO comunas VALUES (124, 7, 'Molina', 0);
INSERT INTO comunas VALUES (125, 7, 'Parral', 0);
INSERT INTO comunas VALUES (126, 7, 'Pelarco', 0);
INSERT INTO comunas VALUES (127, 7, 'Pelluhue', 0);
INSERT INTO comunas VALUES (128, 7, 'Pencahue', 0);
INSERT INTO comunas VALUES (129, 7, 'Rauco', 0);
INSERT INTO comunas VALUES (130, 7, 'Retiro', 0);
INSERT INTO comunas VALUES (131, 7, 'Rio Claro', 0);
INSERT INTO comunas VALUES (132, 7, 'Romeral', 0);
INSERT INTO comunas VALUES (133, 7, 'Sagrada Familia', 0);
INSERT INTO comunas VALUES (134, 7, 'San Clemente', 0);
INSERT INTO comunas VALUES (135, 7, 'San Javier', 0);
INSERT INTO comunas VALUES (136, 7, 'San Rafael', 0);
INSERT INTO comunas VALUES (137, 7, 'Talca', 0);
INSERT INTO comunas VALUES (138, 7, 'Teno', 0);
INSERT INTO comunas VALUES (139, 7, 'Vichuqu&eacute;n', 0);
INSERT INTO comunas VALUES (140, 7, 'Villa Alegre', 0);
INSERT INTO comunas VALUES (141, 7, 'Yerbas Buenas', 0);
INSERT INTO comunas VALUES (142, 8, 'Alto Biobio', 0);
INSERT INTO comunas VALUES (143, 8, 'Antuco', 0);
INSERT INTO comunas VALUES (144, 8, 'Arauco', 0);
INSERT INTO comunas VALUES (145, 8, 'Bulnes', 0);
INSERT INTO comunas VALUES (146, 8, 'Cabrero', 0);
INSERT INTO comunas VALUES (147, 8, 'Canete', 0);
INSERT INTO comunas VALUES (148, 8, 'Chiguayante', 0);
INSERT INTO comunas VALUES (149, 8, 'Chillan', 0);
INSERT INTO comunas VALUES (150, 8, 'Chillan Viejo', 0);
INSERT INTO comunas VALUES (151, 8, 'Cobquecura', 0);
INSERT INTO comunas VALUES (152, 8, 'Coelemu', 0);
INSERT INTO comunas VALUES (153, 8, 'Coihueco', 0);
INSERT INTO comunas VALUES (154, 8, 'Concepci&oacute;n', 0);
INSERT INTO comunas VALUES (155, 8, 'Contulmo', 0);
INSERT INTO comunas VALUES (156, 8, 'Coronel', 0);
INSERT INTO comunas VALUES (157, 8, 'Curanilahue', 0);
INSERT INTO comunas VALUES (158, 8, 'El Carmen', 0);
INSERT INTO comunas VALUES (159, 8, 'Florida', 0);
INSERT INTO comunas VALUES (160, 8, 'Hualpen', 0);
INSERT INTO comunas VALUES (161, 8, 'Hualqui', 0);
INSERT INTO comunas VALUES (162, 8, 'Laja', 0);
INSERT INTO comunas VALUES (163, 8, 'Lebu', 0);
INSERT INTO comunas VALUES (164, 8, 'Los Alamos', 0);
INSERT INTO comunas VALUES (165, 8, 'Los Angeles', 0);
INSERT INTO comunas VALUES (166, 8, 'Lota', 0);
INSERT INTO comunas VALUES (167, 8, 'Mulchen', 0);
INSERT INTO comunas VALUES (168, 8, 'Nacimiento', 0);
INSERT INTO comunas VALUES (169, 8, 'Negrete', 0);
INSERT INTO comunas VALUES (170, 8, 'Ninhue', 0);
INSERT INTO comunas VALUES (171, 8, 'Niquen', 0);
INSERT INTO comunas VALUES (172, 8, 'Pemuco', 0);
INSERT INTO comunas VALUES (173, 8, 'Penco', 0);
INSERT INTO comunas VALUES (174, 8, 'Pinto', 0);
INSERT INTO comunas VALUES (175, 8, 'Portezuelo', 0);
INSERT INTO comunas VALUES (176, 8, 'Quilaco', 0);
INSERT INTO comunas VALUES (177, 8, 'Quilleco', 0);
INSERT INTO comunas VALUES (178, 8, 'Quillon', 0);
INSERT INTO comunas VALUES (179, 8, 'Quirihue', 0);
INSERT INTO comunas VALUES (180, 8, 'Ranquil', 0);
INSERT INTO comunas VALUES (181, 8, 'San Carlos', 0);
INSERT INTO comunas VALUES (182, 8, 'San Fabian', 0);
INSERT INTO comunas VALUES (183, 8, 'San Ignacio', 0);
INSERT INTO comunas VALUES (184, 8, 'San Nicol&aacute;s', 0);
INSERT INTO comunas VALUES (185, 8, 'San Pedro de la Paz', 0);
INSERT INTO comunas VALUES (186, 8, 'San Rosendo', 0);
INSERT INTO comunas VALUES (187, 8, 'Santa Barbara', 0);
INSERT INTO comunas VALUES (188, 8, 'Santa Juana', 0);
INSERT INTO comunas VALUES (189, 8, 'Talcahuano', 0);
INSERT INTO comunas VALUES (190, 8, 'Tirua', 0);
INSERT INTO comunas VALUES (191, 8, 'Tome', 0);
INSERT INTO comunas VALUES (192, 8, 'Trehuaco', 0);
INSERT INTO comunas VALUES (193, 8, 'Tucapel', 0);
INSERT INTO comunas VALUES (194, 8, 'Yumbel', 0);
INSERT INTO comunas VALUES (195, 8, 'Yungay', 0);
INSERT INTO comunas VALUES (196, 9, 'Angol', 0);
INSERT INTO comunas VALUES (197, 9, 'Carahue', 0);
INSERT INTO comunas VALUES (198, 9, 'Cholchol', 0);
INSERT INTO comunas VALUES (199, 9, 'Collipulli', 0);
INSERT INTO comunas VALUES (200, 9, 'Cunco', 0);
INSERT INTO comunas VALUES (201, 9, 'Curacautin', 0);
INSERT INTO comunas VALUES (202, 9, 'Curarrehue', 0);
INSERT INTO comunas VALUES (203, 9, 'Ercilla', 0);
INSERT INTO comunas VALUES (204, 9, 'Freire', 0);
INSERT INTO comunas VALUES (205, 9, 'Galvarino', 0);
INSERT INTO comunas VALUES (206, 9, 'Gorbea', 0);
INSERT INTO comunas VALUES (207, 9, 'Lautaro', 0);
INSERT INTO comunas VALUES (208, 9, 'Loncoche', 0);
INSERT INTO comunas VALUES (209, 9, 'Lonquimay', 0);
INSERT INTO comunas VALUES (210, 9, 'Los Sauces', 0);
INSERT INTO comunas VALUES (211, 9, 'Lumaco', 0);
INSERT INTO comunas VALUES (212, 9, 'Melipeuco', 0);
INSERT INTO comunas VALUES (213, 9, 'Nueva Imperial', 0);
INSERT INTO comunas VALUES (214, 9, 'Padre las Casas', 0);
INSERT INTO comunas VALUES (215, 9, 'Perquenco', 0);
INSERT INTO comunas VALUES (216, 9, 'Pitrufquen', 0);
INSERT INTO comunas VALUES (217, 9, 'Puc&oacute;n', 0);
INSERT INTO comunas VALUES (218, 9, 'Puren', 0);
INSERT INTO comunas VALUES (219, 9, 'Renaico', 0);
INSERT INTO comunas VALUES (220, 9, 'Saavedra', 0);
INSERT INTO comunas VALUES (221, 9, 'Temuco', 0);
INSERT INTO comunas VALUES (222, 9, 'Teodoro Schmidt', 0);
INSERT INTO comunas VALUES (223, 9, 'Tolt&eacute;n', 0);
INSERT INTO comunas VALUES (224, 9, 'Traiguen', 0);
INSERT INTO comunas VALUES (225, 9, 'Victoria', 0);
INSERT INTO comunas VALUES (226, 9, 'Vilcun', 0);
INSERT INTO comunas VALUES (227, 9, 'Villarrica', 0);
INSERT INTO comunas VALUES (228, 10, 'Ancud', 0);
INSERT INTO comunas VALUES (229, 10, 'Calbuco', 0);
INSERT INTO comunas VALUES (230, 10, 'Castro', 0);
INSERT INTO comunas VALUES (231, 10, 'Chaiten', 0);
INSERT INTO comunas VALUES (232, 10, 'Chonchi', 0);
INSERT INTO comunas VALUES (233, 10, 'Cochamo', 0);
INSERT INTO comunas VALUES (234, 10, 'Curaco de Velez', 0);
INSERT INTO comunas VALUES (235, 10, 'Dalcahue', 0);
INSERT INTO comunas VALUES (236, 10, 'Fresia', 0);
INSERT INTO comunas VALUES (237, 10, 'Frutillar', 0);
INSERT INTO comunas VALUES (238, 10, 'Futaleufu', 0);
INSERT INTO comunas VALUES (239, 10, 'Hualaihue', 0);
INSERT INTO comunas VALUES (240, 10, 'Llanquihue', 0);
INSERT INTO comunas VALUES (241, 10, 'Los muermos', 0);
INSERT INTO comunas VALUES (242, 10, 'Maullin', 0);
INSERT INTO comunas VALUES (243, 10, 'Osorno', 0);
INSERT INTO comunas VALUES (244, 10, 'Palena', 0);
INSERT INTO comunas VALUES (245, 10, 'Puerto Montt', 0);
INSERT INTO comunas VALUES (246, 10, 'Puerto Octay', 0);
INSERT INTO comunas VALUES (247, 10, 'Puerto Varas', 0);
INSERT INTO comunas VALUES (248, 10, 'Puqueldon', 0);
INSERT INTO comunas VALUES (249, 10, 'Purranque', 0);
INSERT INTO comunas VALUES (250, 10, 'Puyehue', 0);
INSERT INTO comunas VALUES (251, 10, 'Queilen', 0);
INSERT INTO comunas VALUES (252, 10, 'Quellon', 0);
INSERT INTO comunas VALUES (253, 10, 'Quemchi', 0);
INSERT INTO comunas VALUES (254, 10, 'Quinchao', 0);
INSERT INTO comunas VALUES (255, 10, 'Rio Negro', 0);
INSERT INTO comunas VALUES (256, 10, 'San Juan de la Costa', 0);
INSERT INTO comunas VALUES (257, 10, 'San Pablo', 0);
INSERT INTO comunas VALUES (258, 11, 'Ays&eacute;n', 0);
INSERT INTO comunas VALUES (259, 11, 'Chile Chico', 0);
INSERT INTO comunas VALUES (260, 11, 'Cisnes', 0);
INSERT INTO comunas VALUES (261, 11, 'Cochrane', 0);
INSERT INTO comunas VALUES (262, 11, 'Coyhaique', 0);
INSERT INTO comunas VALUES (263, 11, 'Guaitecas', 0);
INSERT INTO comunas VALUES (264, 11, 'Lago verde', 0);
INSERT INTO comunas VALUES (265, 11, 'O`higgins', 0);
INSERT INTO comunas VALUES (266, 11, 'R&iacute;o Iba&ntilde;ez', 0);
INSERT INTO comunas VALUES (267, 11, 'Tortel', 0);
INSERT INTO comunas VALUES (268, 12, 'Cabo de Hornos', 0);
INSERT INTO comunas VALUES (269, 12, 'Laguna Blanca', 0);
INSERT INTO comunas VALUES (270, 12, 'Natales', 0);
INSERT INTO comunas VALUES (271, 12, 'Porvenir', 0);
INSERT INTO comunas VALUES (272, 12, 'Primavera', 0);
INSERT INTO comunas VALUES (273, 12, 'Punta Arenas', 0);
INSERT INTO comunas VALUES (274, 12, 'Rio Verde', 0);
INSERT INTO comunas VALUES (275, 12, 'San Gregorio', 0);
INSERT INTO comunas VALUES (276, 12, 'Timaukel', 0);
INSERT INTO comunas VALUES (277, 12, 'Torres del Paine', 0);
INSERT INTO comunas VALUES (278, 13, 'Alhue', 0);
INSERT INTO comunas VALUES (279, 13, 'Buin', 0);
INSERT INTO comunas VALUES (280, 13, 'Calera de Tango', 0);
INSERT INTO comunas VALUES (281, 13, 'Cerrillos', 0);
INSERT INTO comunas VALUES (282, 13, 'Cerro Navia', 0);
INSERT INTO comunas VALUES (283, 13, 'Colina', 0);
INSERT INTO comunas VALUES (284, 13, 'Conchali', 0);
INSERT INTO comunas VALUES (285, 13, 'Curacavi', 0);
INSERT INTO comunas VALUES (286, 13, 'El Bosque', 0);
INSERT INTO comunas VALUES (287, 13, 'El Monte', 0);
INSERT INTO comunas VALUES (288, 13, 'Estacion Central', 0);
INSERT INTO comunas VALUES (289, 13, 'Huechuraba', 0);
INSERT INTO comunas VALUES (290, 13, 'Independencia', 0);
INSERT INTO comunas VALUES (291, 13, 'Isla de Maipo', 0);
INSERT INTO comunas VALUES (292, 13, 'La Cisterna', 0);
INSERT INTO comunas VALUES (293, 13, 'La Florida', 0);
INSERT INTO comunas VALUES (294, 13, 'La Granja', 0);
INSERT INTO comunas VALUES (295, 13, 'La Pintana', 0);
INSERT INTO comunas VALUES (296, 13, 'La Reina', 0);
INSERT INTO comunas VALUES (297, 13, 'Lampa', 0);
INSERT INTO comunas VALUES (298, 13, 'Las Condes', 0);
INSERT INTO comunas VALUES (299, 13, 'Lo Barnechea', 0);
INSERT INTO comunas VALUES (300, 13, 'Lo Espejo', 0);
INSERT INTO comunas VALUES (301, 13, 'Lo Prado', 0);
INSERT INTO comunas VALUES (302, 13, 'Macul', 0);
INSERT INTO comunas VALUES (303, 13, 'Maip&uacute;', 0);
INSERT INTO comunas VALUES (304, 13, 'Mar&iacute;a Pinto', 0);
INSERT INTO comunas VALUES (305, 13, 'Melipilla', 0);
INSERT INTO comunas VALUES (306, 13, '&Ntilde;u&ntilde;oa', 0);
INSERT INTO comunas VALUES (307, 13, 'Padre Hurtado', 0);
INSERT INTO comunas VALUES (308, 13, 'Paine', 0);
INSERT INTO comunas VALUES (309, 13, 'Pedro Aguirre Cerda', 0);
INSERT INTO comunas VALUES (310, 13, 'Penaflor', 0);
INSERT INTO comunas VALUES (311, 13, 'Pe&ntilde;alol&eacute;n', 0);
INSERT INTO comunas VALUES (312, 13, 'Pirque', 0);
INSERT INTO comunas VALUES (313, 13, 'Providencia', 0);
INSERT INTO comunas VALUES (314, 13, 'Pudahuel', 0);
INSERT INTO comunas VALUES (315, 13, 'Puente Alto', 0);
INSERT INTO comunas VALUES (316, 13, 'Quilicura', 0);
INSERT INTO comunas VALUES (317, 13, 'Quinta Normal', 0);
INSERT INTO comunas VALUES (318, 13, 'Recoleta', 0);
INSERT INTO comunas VALUES (319, 13, 'Renca', 0);
INSERT INTO comunas VALUES (320, 13, 'San Bernardo', 0);
INSERT INTO comunas VALUES (321, 13, 'San Joaqu&iacute;n', 0);
INSERT INTO comunas VALUES (322, 13, 'San Jos&eacute; de Maipo', 0);
INSERT INTO comunas VALUES (323, 13, 'San Miguel', 0);
INSERT INTO comunas VALUES (324, 13, 'San Pedro', 0);
INSERT INTO comunas VALUES (325, 13, 'San Ram&oacute;n', 0);
INSERT INTO comunas VALUES (326, 13, 'Santiago', 0);
INSERT INTO comunas VALUES (329, 13, 'Talagante', 0);
INSERT INTO comunas VALUES (330, 13, 'Til Til', 0);
INSERT INTO comunas VALUES (331, 13, 'Vitacura', 0);
INSERT INTO comunas VALUES (332, 14, 'Corral', 0);
INSERT INTO comunas VALUES (333, 14, 'Futrono', 0);
INSERT INTO comunas VALUES (334, 14, 'La Uni&oacute;n', 0);
INSERT INTO comunas VALUES (335, 14, 'Lago Ranco', 0);
INSERT INTO comunas VALUES (336, 14, 'Lanco', 0);
INSERT INTO comunas VALUES (337, 14, 'Los Lagos', 0);
INSERT INTO comunas VALUES (338, 14, 'Mafil', 0);
INSERT INTO comunas VALUES (339, 14, 'Mariquina', 0);
INSERT INTO comunas VALUES (340, 14, 'Paillaco', 0);
INSERT INTO comunas VALUES (341, 14, 'Panguipulli', 0);
INSERT INTO comunas VALUES (342, 14, 'Rio Bueno', 0);
INSERT INTO comunas VALUES (343, 14, 'Valdivia', 0);
INSERT INTO comunas VALUES (344, 15, 'Arica', 0);
INSERT INTO comunas VALUES (345, 15, 'Camarones', 0);
INSERT INTO comunas VALUES (346, 15, 'General Lagos', 0);
INSERT INTO comunas VALUES (347, 15, 'Putre', 0);

#
# Volcar la base de datos para la tabla `contacto_mails`
#
truncate table contacto_mails;
INSERT INTO contacto_mails VALUES (1, 'Consultas Generales', 'servicio@servicio.gov.cl', 1, 0);

#
# Volcar la base de datos para la tabla `contactos`
#
truncate table contactos;
INSERT INTO contactos VALUES (1, 'claudia', 'servicio@servicio.gov.cl', 'ddd', '2009-02-13', 'ingenieria@2r.cl', 0);
INSERT INTO contactos VALUES (2, 'ccc', 'servicio@servicio.gov.cl', 'jjj', '2009-02-13', 'ingenieria@2r.cl', 0);

#
# Volcar la base de datos para la tabla `contenido_etiqueta`
#
truncate table contenido_etiqueta;
INSERT INTO contenido_etiqueta VALUES (1, 'titulo', 1, 1, 0);
INSERT INTO contenido_etiqueta VALUES (2, 'bajada', 1, 2, 0);
INSERT INTO contenido_etiqueta VALUES (3, 'contenido', 1, 3, 0);
INSERT INTO contenido_etiqueta VALUES (4, 'imagen', 1, 4, 0);
INSERT INTO contenido_etiqueta VALUES (5, 'titulo', 2, 1, 0);
INSERT INTO contenido_etiqueta VALUES (6, 'bajada', 2, 2, 0);
INSERT INTO contenido_etiqueta VALUES (7, 'contenido', 2, 3, 0);
INSERT INTO contenido_etiqueta VALUES (8, 'imagen', 2, 4, 0);

#
# Volcar la base de datos para la tabla `contenido_etiqueta_definicion`
#
truncate table contenido_etiqueta_definicion;
INSERT INTO contenido_etiqueta_definicion VALUES (1, 'Titulo noticia', 0);
INSERT INTO contenido_etiqueta_definicion VALUES (2, 'Bajada noticia', 0);
INSERT INTO contenido_etiqueta_definicion VALUES (3, 'Contenido noticia', 0);
INSERT INTO contenido_etiqueta_definicion VALUES (4, 'Imagen noticia', 0);

#
# Volcar la base de datos para la tabla `contenido_tipo`
#
truncate table contenido_tipo;
INSERT INTO contenido_tipo VALUES (1, 'Principal', 0, 1, 1, 1, 1, 0, '<style type="text/css">\r\n.Principal_titulo{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 15px;\r\n	font-weight: bold;\r\n	color: #003366;\r\n		}\r\n</style >', '', '<style type="text/css">\r\n.Principal_imagen {\r\n			float: left;\r\n			clear: left;\r\n			border: 2px solid #ccc;\r\n			background: #eee;\r\n			color: #000;\r\n	padding: 5px;\r\n	\r\n}\r\n</style>', 0, 0, '');
INSERT INTO contenido_tipo VALUES (2, 'Destacados', 0, 1, 4, 1, 1, 0, '<style type="text/css">\r\n.Destacados_titulo{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 12px;\r\n	font-weight: bold;\r\n	color: #252525;\r\n		}\r\n</style >', '<style type="text/css">\r\n.Destacados_bajada{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 10px;\r\n	color: #252525;\r\n		}\r\n</style >', '', 0, 0, '');
INSERT INTO contenido_tipo VALUES (3, 'Est&aacute;tico', 0, 0, 1, 0, 0, 0, '', '', '', 0, 0, '');
INSERT INTO contenido_tipo VALUES (4, 'Enunciado', 0, 1, 8, 1, 0, 0, '<style type="text/css">\r\n.Enunciado_titulo{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 10px;\r\n	\r\n	color: #333333;\r\n                      padding-left: 5px;\r\n	padding-right: 5px;\r\n		}\r\n</style >', '', '', 0, 0, '');
INSERT INTO contenido_tipo VALUES (11, 'Entrevista', 7, 1, 5, 1, 1, 0, '', '', '', 0, 0, '');
INSERT INTO contenido_tipo VALUES (13, 'Opini&oacute;n', 9, 1, 5, 1, 1, 0, '', '', '', 0, 0, '');

#
# Volcar la base de datos para la tabla `control_contenido_perfil`
#
truncate table control_contenido_perfil;
INSERT INTO control_contenido_perfil VALUES ('7', 7);
INSERT INTO control_contenido_perfil VALUES ('2007030722064641', 0);
INSERT INTO control_contenido_perfil VALUES ('7', 8);
INSERT INTO control_contenido_perfil VALUES ('2007031410095085', 0);
INSERT INTO control_contenido_perfil VALUES ('4', 999);
INSERT INTO control_contenido_perfil VALUES ('3', 999);
INSERT INTO control_contenido_perfil VALUES ('4', 8);
INSERT INTO control_contenido_perfil VALUES ('2007031801173782', 0);
INSERT INTO control_contenido_perfil VALUES ('4', 7);
INSERT INTO control_contenido_perfil VALUES ('4', 6);
INSERT INTO control_contenido_perfil VALUES ('8', 8);
INSERT INTO control_contenido_perfil VALUES ('4', 24);
INSERT INTO control_contenido_perfil VALUES ('4', 17);
INSERT INTO control_contenido_perfil VALUES ('4', 18);
INSERT INTO control_contenido_perfil VALUES ('7', 999);
INSERT INTO control_contenido_perfil VALUES ('7', 6);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('2007031410133254', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('2007020117142189', 6);
INSERT INTO control_contenido_perfil VALUES ('2007020117142189', 8);
INSERT INTO control_contenido_perfil VALUES ('2007020117142189', 7);
INSERT INTO control_contenido_perfil VALUES ('2007020117142189', 3);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('1', 7);
INSERT INTO control_contenido_perfil VALUES ('1', 6);
INSERT INTO control_contenido_perfil VALUES ('1', 999);
INSERT INTO control_contenido_perfil VALUES ('3', 8);
INSERT INTO control_contenido_perfil VALUES ('3', 7);
INSERT INTO control_contenido_perfil VALUES ('3', 6);
INSERT INTO control_contenido_perfil VALUES ('1', 8);
INSERT INTO control_contenido_perfil VALUES ('8', 7);
INSERT INTO control_contenido_perfil VALUES ('8', 6);
INSERT INTO control_contenido_perfil VALUES ('8', 999);
INSERT INTO control_contenido_perfil VALUES ('2007030718155159', 0);
INSERT INTO control_contenido_perfil VALUES ('2007022702331081', 0);
INSERT INTO control_contenido_perfil VALUES ('2007022702110435', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('2007030512291912', 0);
INSERT INTO control_contenido_perfil VALUES ('2007030301213573', 0);
INSERT INTO control_contenido_perfil VALUES ('2007030301203496', 0);
INSERT INTO control_contenido_perfil VALUES ('2007020117142189', 999);
INSERT INTO control_contenido_perfil VALUES ('4', 1);
INSERT INTO control_contenido_perfil VALUES ('4', 3);
INSERT INTO control_contenido_perfil VALUES ('4', 4);
INSERT INTO control_contenido_perfil VALUES ('2007020118064576', 0);
INSERT INTO control_contenido_perfil VALUES ('4', 22);
INSERT INTO control_contenido_perfil VALUES ('4', 23);
INSERT INTO control_contenido_perfil VALUES ('4', 13);
INSERT INTO control_contenido_perfil VALUES ('4', 14);
INSERT INTO control_contenido_perfil VALUES ('4', 15);
INSERT INTO control_contenido_perfil VALUES ('4', 16);
INSERT INTO control_contenido_perfil VALUES ('4', 10);
INSERT INTO control_contenido_perfil VALUES ('4', 19);
INSERT INTO control_contenido_perfil VALUES ('4', 20);
INSERT INTO control_contenido_perfil VALUES ('4', 11);
INSERT INTO control_contenido_perfil VALUES ('4', 9);
INSERT INTO control_contenido_perfil VALUES ('2007020118181055', 0);
INSERT INTO control_contenido_perfil VALUES ('2007020119101561', 0);
INSERT INTO control_contenido_perfil VALUES ('2007022710551176', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032710542224', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032714354641', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032714363699', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032714380047', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032714383819', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032714384971', 0);
INSERT INTO control_contenido_perfil VALUES ('2007032718005297', 0);
INSERT INTO control_contenido_perfil VALUES ('2007040300021758', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('2007101118281520', 0);
INSERT INTO control_contenido_perfil VALUES ('2007102315490344', 0);
INSERT INTO control_contenido_perfil VALUES ('2007102316034138', 0);
INSERT INTO control_contenido_perfil VALUES ('2007103008343084', 0);
INSERT INTO control_contenido_perfil VALUES ('2007111520543524', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121420071925', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121019583274', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121019583274', 999);
INSERT INTO control_contenido_perfil VALUES ('2008012915332766', 0);
INSERT INTO control_contenido_perfil VALUES ('2008013007543977', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121010010487', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121114563185', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121017485632', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121018475278', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121012021593', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121117501838', 0);
INSERT INTO control_contenido_perfil VALUES ('', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022513083745', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022609513657', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022608130439', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022510445035', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022614471331', 0);
INSERT INTO control_contenido_perfil VALUES ('2008022608105618', 0);
INSERT INTO control_contenido_perfil VALUES ('2007121013040285', 0);
INSERT INTO control_contenido_perfil VALUES ('2008030607585793', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042314181156', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042315281691', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042315290240', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042315293174', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042315311182', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042418200726', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042420381697', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042420415571', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042509502041', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042510131172', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042511184073', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042511290648', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042511463983', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042512132044', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042512571624', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042513004729', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042516233864', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042517264443', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042814221679', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042814383559', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042814534637', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042818022290', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042818091296', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042818115929', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042916145884', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042916242429', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042916273690', 0);
INSERT INTO control_contenido_perfil VALUES ('2008042923203423', 0);
INSERT INTO control_contenido_perfil VALUES ('2008043001451138', 0);
INSERT INTO control_contenido_perfil VALUES ('2008043001485496', 0);
INSERT INTO control_contenido_perfil VALUES ('2008043006252272', 0);
INSERT INTO control_contenido_perfil VALUES ('2008051317565120', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052010485468', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052011054644', 0);
INSERT INTO control_contenido_perfil VALUES ('2008061616100490', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052016295568', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052016313491', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052018110534', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052612455569', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052613234855', 4);
INSERT INTO control_contenido_perfil VALUES ('2008052613234855', 1);
INSERT INTO control_contenido_perfil VALUES ('2008052613523031', 1);
INSERT INTO control_contenido_perfil VALUES ('2008052613234855', 999);
INSERT INTO control_contenido_perfil VALUES ('2008052614023515', 0);
INSERT INTO control_contenido_perfil VALUES ('2008072817483738', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052613332991', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052613523031', 4);
INSERT INTO control_contenido_perfil VALUES ('2008052613523031', 999);
INSERT INTO control_contenido_perfil VALUES ('2008052615295446', 999);
INSERT INTO control_contenido_perfil VALUES ('2008052614064615', 1);
INSERT INTO control_contenido_perfil VALUES ('2008052614064615', 4);
INSERT INTO control_contenido_perfil VALUES ('2008052614064615', 999);
INSERT INTO control_contenido_perfil VALUES ('2008052615295446', 4);
INSERT INTO control_contenido_perfil VALUES ('2008062720013766', 0);
INSERT INTO control_contenido_perfil VALUES ('2008061616093183', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052615380073', 1);
INSERT INTO control_contenido_perfil VALUES ('2008052615380073', 4);
INSERT INTO control_contenido_perfil VALUES ('2008052615380073', 999);
INSERT INTO control_contenido_perfil VALUES ('2008052613430264', 0);
INSERT INTO control_contenido_perfil VALUES ('2008061318013519', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052016120989', 0);
INSERT INTO control_contenido_perfil VALUES ('2008061616544654', 0);
INSERT INTO control_contenido_perfil VALUES ('2008061702534668', 0);
INSERT INTO control_contenido_perfil VALUES ('2008062720042091', 0);
INSERT INTO control_contenido_perfil VALUES ('2008072907085455', 0);
INSERT INTO control_contenido_perfil VALUES ('2008072907174040', 0);
INSERT INTO control_contenido_perfil VALUES ('2008073110461339', 0);
INSERT INTO control_contenido_perfil VALUES ('2008052018473340', 0);
INSERT INTO control_contenido_perfil VALUES ('2008090415022783', 0);
INSERT INTO control_contenido_perfil VALUES ('2008091514085940', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100618385267', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100212285128', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100618432323', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709084717', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709093141', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709102654', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709110246', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709113883', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100709120464', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100717001873', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100717021363', 0);
INSERT INTO control_contenido_perfil VALUES ('2008100816483566', 0);
INSERT INTO control_contenido_perfil VALUES ('2008111015222232', 0);
INSERT INTO control_contenido_perfil VALUES ('2008112409504267', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121113073755', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121113381137', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121113433442', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121210233937', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708511291', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708391758', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708411856', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708422787', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708430990', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708441887', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121708451766', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121709050744', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121709161268', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121709191237', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121709273319', 0);
INSERT INTO control_contenido_perfil VALUES ('2009012014045469', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121709552999', 0);
INSERT INTO control_contenido_perfil VALUES ('2009012108564353', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121710032935', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121718424896', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121719482242', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121813082455', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121812050561', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121812060821', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121210222710', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816204662', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816261614', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816270131', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816281617', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816390994', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816402119', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816582196', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816461194', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816470710', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816524567', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816534713', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816544390', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816570551', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121819081292', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121819050396', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121819384436', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121819492710', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121819525087', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121817213824', 0);
INSERT INTO control_contenido_perfil VALUES ('2009021911314646', 0);
INSERT INTO control_contenido_perfil VALUES ('2009012010151161', 0);
INSERT INTO control_contenido_perfil VALUES ('2008121816450473', 0);
INSERT INTO control_contenido_perfil VALUES ('2009021911405795', 0);
INSERT INTO control_contenido_perfil VALUES ('2009021717595171', 0);
INSERT INTO control_contenido_perfil VALUES ('2009021718252366', 0);
INSERT INTO control_contenido_perfil VALUES ('2009012010144481', 0);
INSERT INTO control_contenido_perfil VALUES ('2009030216503074', 0);
INSERT INTO control_contenido_perfil VALUES ('2009021715335463', 999);
INSERT INTO control_contenido_perfil VALUES ('2009052210500446', 0);

#
# Volcar la base de datos para la tabla `establecimientos`
#

truncate table establecimientos;
INSERT INTO establecimientos VALUES (11, 'Sgs', '-01', 'no', 13);

#
# Volcar la base de datos para la tabla `galerias`
#
truncate table galerias;
INSERT INTO galerias VALUES ('1', '2008013007543977', '08-01-30', 'prueba de Galeria', 'descrip prueba', 'DSCF6181.JPG', 0, 0);

#
# Volcar la base de datos para la tabla `grupo_galeria`
#
truncate table grupo_galeria;
INSERT INTO grupo_galeria VALUES (1, 'prueba', 'ddd.jpg', '', 1);
INSERT INTO grupo_galeria VALUES (2, 'General', 'PEREZA_.jpg', '', 2);

#
# Volcar la base de datos para la tabla `grupo_galeria_perfiles`
#
truncate table grupo_galeria_perfiles;
INSERT INTO grupo_galeria_perfiles VALUES (1, 4, 2, 1);
INSERT INTO grupo_galeria_perfiles VALUES (2, 999, 2, 2);



#
# Volcar la base de datos para la tabla `indices_economicos`
#
truncate table indices_economicos;
INSERT INTO indices_economicos VALUES (1, '21.176,83', '2.635,30', '12.528,53', '605,70', '780,64', '11-02-2009');
INSERT INTO indices_economicos VALUES (2, '21.170,75', '2.624,31', '12.482,42', '602,12', '773,73', '12-02-2009');
INSERT INTO indices_economicos VALUES (3, '21.164,68', '2.606,72', '12.413,52', '593,02', '760,38', '13-02-2009');

#
# Volcar la base de datos para la tabla `modulos_bloqueo`
#
truncate table modulos_bloqueo;
INSERT INTO modulos_bloqueo VALUES (1, 'Contratos', 12, 1, '');
INSERT INTO modulos_bloqueo VALUES (2, 'Egreso', 22, 0, '');
INSERT INTO modulos_bloqueo VALUES (3, 'Suplencias', 24, 0, '');
INSERT INTO modulos_bloqueo VALUES (4, 'Ausencias', 23, 0, '');
INSERT INTO modulos_bloqueo VALUES (5, 'Consumo de Luz', 25, 0, '');

#
# Volcar la base de datos para la tabla `no_habil`
#
truncate table  no_habil;
INSERT INTO no_habil VALUES (1, '2009-01-03', 0);
INSERT INTO no_habil VALUES (2, '2009-01-04', 0);
INSERT INTO no_habil VALUES (3, '2009-01-10', 0);
INSERT INTO no_habil VALUES (4, '2009-01-11', 0);
INSERT INTO no_habil VALUES (5, '2009-01-17', 0);
INSERT INTO no_habil VALUES (6, '2009-01-18', 0);
INSERT INTO no_habil VALUES (7, '2009-01-24', 0);
INSERT INTO no_habil VALUES (8, '2009-01-25', 0);
INSERT INTO no_habil VALUES (9, '2009-01-31', 0);
INSERT INTO no_habil VALUES (10, '2009-02-01', 0);
INSERT INTO no_habil VALUES (11, '2009-02-07', 0);
INSERT INTO no_habil VALUES (12, '2009-02-08', 0);
INSERT INTO no_habil VALUES (13, '2009-02-14', 0);
INSERT INTO no_habil VALUES (14, '2009-02-15', 0);
INSERT INTO no_habil VALUES (15, '2009-02-21', 0);
INSERT INTO no_habil VALUES (16, '2009-02-22', 0);
INSERT INTO no_habil VALUES (17, '2009-02-28', 0);
INSERT INTO no_habil VALUES (18, '2009-03-01', 0);
INSERT INTO no_habil VALUES (19, '2009-03-07', 0);
INSERT INTO no_habil VALUES (20, '2009-03-08', 0);
INSERT INTO no_habil VALUES (21, '2009-03-14', 0);
INSERT INTO no_habil VALUES (22, '2009-03-15', 0);
INSERT INTO no_habil VALUES (23, '2009-03-21', 0);
INSERT INTO no_habil VALUES (24, '2009-03-22', 0);
INSERT INTO no_habil VALUES (25, '2009-03-28', 0);
INSERT INTO no_habil VALUES (26, '2009-03-29', 0);
INSERT INTO no_habil VALUES (27, '2009-04-04', 0);
INSERT INTO no_habil VALUES (28, '2009-04-05', 0);
INSERT INTO no_habil VALUES (29, '2009-04-11', 0);
INSERT INTO no_habil VALUES (30, '2009-04-12', 0);
INSERT INTO no_habil VALUES (31, '2009-04-18', 0);
INSERT INTO no_habil VALUES (32, '2009-04-19', 0);
INSERT INTO no_habil VALUES (33, '2009-04-25', 0);
INSERT INTO no_habil VALUES (34, '2009-04-26', 0);
INSERT INTO no_habil VALUES (35, '2009-05-02', 0);
INSERT INTO no_habil VALUES (36, '2009-05-03', 0);
INSERT INTO no_habil VALUES (37, '2009-05-09', 0);
INSERT INTO no_habil VALUES (38, '2009-05-10', 0);
INSERT INTO no_habil VALUES (39, '2009-05-16', 0);
INSERT INTO no_habil VALUES (40, '2009-05-17', 0);
INSERT INTO no_habil VALUES (41, '2009-05-23', 0);
INSERT INTO no_habil VALUES (42, '2009-05-24', 0);
INSERT INTO no_habil VALUES (43, '2009-05-30', 0);
INSERT INTO no_habil VALUES (44, '2009-05-31', 0);
INSERT INTO no_habil VALUES (45, '2009-06-06', 0);
INSERT INTO no_habil VALUES (46, '2009-06-07', 0);
INSERT INTO no_habil VALUES (47, '2009-06-13', 0);
INSERT INTO no_habil VALUES (48, '2009-06-14', 0);
INSERT INTO no_habil VALUES (49, '2009-06-20', 0);
INSERT INTO no_habil VALUES (50, '2009-06-21', 0);
INSERT INTO no_habil VALUES (51, '2009-06-27', 0);
INSERT INTO no_habil VALUES (52, '2009-06-28', 0);
INSERT INTO no_habil VALUES (53, '2009-07-04', 0);
INSERT INTO no_habil VALUES (54, '2009-07-05', 0);
INSERT INTO no_habil VALUES (55, '2009-07-11', 0);
INSERT INTO no_habil VALUES (56, '2009-07-12', 0);
INSERT INTO no_habil VALUES (57, '2009-07-18', 0);
INSERT INTO no_habil VALUES (58, '2009-07-19', 0);
INSERT INTO no_habil VALUES (59, '2009-07-25', 0);
INSERT INTO no_habil VALUES (60, '2009-07-26', 0);
INSERT INTO no_habil VALUES (61, '2009-08-01', 0);
INSERT INTO no_habil VALUES (62, '2009-08-02', 0);
INSERT INTO no_habil VALUES (63, '2009-08-08', 0);
INSERT INTO no_habil VALUES (64, '2009-08-09', 0);
INSERT INTO no_habil VALUES (65, '2009-08-15', 0);
INSERT INTO no_habil VALUES (66, '2009-08-16', 0);
INSERT INTO no_habil VALUES (67, '2009-08-22', 0);
INSERT INTO no_habil VALUES (68, '2009-08-23', 0);
INSERT INTO no_habil VALUES (69, '2009-08-29', 0);
INSERT INTO no_habil VALUES (70, '2009-08-30', 0);
INSERT INTO no_habil VALUES (71, '2009-09-05', 0);
INSERT INTO no_habil VALUES (72, '2009-09-06', 0);
INSERT INTO no_habil VALUES (73, '2009-09-12', 0);
INSERT INTO no_habil VALUES (74, '2009-09-13', 0);
INSERT INTO no_habil VALUES (75, '2009-09-19', 0);
INSERT INTO no_habil VALUES (76, '2009-09-20', 0);
INSERT INTO no_habil VALUES (77, '2009-09-26', 0);
INSERT INTO no_habil VALUES (78, '2009-09-27', 0);
INSERT INTO no_habil VALUES (79, '2009-10-03', 0);
INSERT INTO no_habil VALUES (80, '2009-10-04', 0);
INSERT INTO no_habil VALUES (81, '2009-10-10', 0);
INSERT INTO no_habil VALUES (82, '2009-10-11', 0);
INSERT INTO no_habil VALUES (83, '2009-10-17', 0);
INSERT INTO no_habil VALUES (84, '2009-10-18', 0);
INSERT INTO no_habil VALUES (85, '2009-10-24', 0);
INSERT INTO no_habil VALUES (86, '2009-10-25', 0);
INSERT INTO no_habil VALUES (87, '2009-10-31', 0);
INSERT INTO no_habil VALUES (88, '2009-11-01', 0);
INSERT INTO no_habil VALUES (89, '2009-11-07', 0);
INSERT INTO no_habil VALUES (90, '2009-11-08', 0);
INSERT INTO no_habil VALUES (91, '2009-11-14', 0);
INSERT INTO no_habil VALUES (92, '2009-11-15', 0);
INSERT INTO no_habil VALUES (93, '2009-11-21', 0);
INSERT INTO no_habil VALUES (94, '2009-11-22', 0);
INSERT INTO no_habil VALUES (95, '2009-11-28', 0);
INSERT INTO no_habil VALUES (96, '2009-11-29', 0);
INSERT INTO no_habil VALUES (97, '2009-12-05', 0);
INSERT INTO no_habil VALUES (98, '2009-12-06', 0);
INSERT INTO no_habil VALUES (99, '2009-12-12', 0);
INSERT INTO no_habil VALUES (100, '2009-12-13', 0);
INSERT INTO no_habil VALUES (101, '2009-12-19', 0);
INSERT INTO no_habil VALUES (102, '2009-12-20', 0);
INSERT INTO no_habil VALUES (103, '2009-12-26', 0);
INSERT INTO no_habil VALUES (104, '2009-12-27', 0);
INSERT INTO no_habil VALUES (115, '2009-04-10', 0);
INSERT INTO no_habil VALUES (106, '2009-05-01', 2);
INSERT INTO no_habil VALUES (107, '2009-05-21', 3);
INSERT INTO no_habil VALUES (108, '2009-06-29', 4);
INSERT INTO no_habil VALUES (109, '2009-07-16', 5);
INSERT INTO no_habil VALUES (110, '2009-09-18', 6);
INSERT INTO no_habil VALUES (111, '2009-10-12', 7);
INSERT INTO no_habil VALUES (112, '2009-12-08', 8);
INSERT INTO no_habil VALUES (113, '2009-12-25', 9);
INSERT INTO no_habil VALUES (114, '2009-01-01', 10);

#
# Volcar la base de datos para la tabla `noticia_opina`
#
truncate table  noticia_opina;
INSERT INTO noticia_opina VALUES ('2007020200475592', '2007020118181055', '27', 'fsdfsd sdf sdf sdf sdf sdf sdf sdf sdf sdf sdfsdf sdf sdf sdf sdf', 0);


#
# Volcar la base de datos para la tabla `noticia_plantilla`
#
truncate table  noticia_plantilla;
INSERT INTO noticia_plantilla VALUES (3, 150, 'prueba1', '<p><style type="text/css">\r\n\r\n\r\n\r\n\r\n\r\n.titulo_portada {\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 15px;\r\n	color: #ccccc;\r\n	padding:  5px ;\r\n        font-weight: bold;\r\n\r\n}\r\n.bajada_portada {\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 9px;\r\n	color: #000;\r\n        padding:  5px ;\r\n	\r\n\r\n}\r\n.right_articles {\r\n		border: 1px solid #ccc;\r\n		\r\n		\r\n		background: #eee;\r\n		color: #454545;\r\n	}\r\n.titulo_portada a{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 15px;\r\n	color: #ccccc;\r\n	padding:  5px ;\r\n        font-weight: bold;\r\n\r\n}\r\n.bajada_portada a{\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 9px;\r\n	color: #000;\r\n        padding:  5px ;\r\n	\r\n\r\n}\r\n.right_articles a{\r\n		border: 1px solid #ccc;\r\n		\r\n		\r\n		background: #eee;\r\n		color: #454545;\r\n	}\r\n#right_articles titulo_portada {\r\n\r\nfont-size: 9px;\r\n\r\n}</style></p>\r\n<table width="95%" cellspacing="2" cellpadding="2" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="top">#Principal#</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <table width="100%" cellspacing="2" cellpadding="2" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign="top">#Destacados#</td>\r\n                        <td valign="top">\r\n                        <div class="right_articles">#Enunciado#</div>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '2008-12-19', 1);
INSERT INTO noticia_plantilla VALUES (4, 116, 'trtwr', '', '0000-00-00', 0);
INSERT INTO noticia_plantilla VALUES (5, 150, 'nuevo', '<table width="100%" border="1">\r\n    <tbody>\r\n        <tr>\r\n            <td height="30%" valign="top">#Salud_y_prevencion#</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <table width="100%" border="1">\r\n                <tbody>\r\n                    <tr>\r\n                        <td width="60%" valign="top" rowspan="2">#Belleza#</td>\r\n                        <td height="60%" valign="top">#Entrevistas#</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td height="40%" valign="top">#Opinion#</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '2008-12-19', 0);
INSERT INTO noticia_plantilla VALUES (6, 116, 'plantilla_grupo_noticias', '<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td>#PRINCIPAL#</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>#NOTICIA_1#</td>\r\n                        <td>#NOTICIA_2#</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>#NOTICIA_3#</td>\r\n                        <td>#NOTICIA_4#</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td align="right">#VER_MAS#</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '2009-01-20', 0);
INSERT INTO noticia_plantilla VALUES (7, 116, 'plantilla_noticia', '<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n  <tr>\r\n    <td class="titulo"><h3>#TITULO#</h3></td>\r\n  </tr>\r\n  <tr>\r\n    <td class="bajada">#BAJADA#</td>\r\n  </tr>\r\n  <tr>\r\n    <td align="right" class="bajada">#VER_MAS#</td>\r\n  </tr>\r\n  <tr>\r\n    <td align="right" class="bajada">&nbsp;</td>\r\n  </tr>\r\n</table>', '2009-01-20', 0);
INSERT INTO noticia_plantilla VALUES (8, 116, 'plantilla_noticia_principal', '<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <h2>#TITULO_PRINCIPAL#</h2>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>#BAJADA_PRINCIPAL#</td>\r\n        </tr>\r\n        <tr>\r\n            <td align="right">#VER_MAS#</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '2009-01-20', 0);

#
# Volcar la base de datos para la tabla `noticias`
#
truncate table  noticias;
INSERT INTO noticias VALUES ('2008121819384436', 'esp', 'Footer', 'Footer', 'Bajada', '', '', '0', 3, 'si', 'si', 'si', '18/12/2008', '', 0, '', '', '150', '', 0, 0, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2008121819525087', 'esp', 'Header2', 'Header2', 'Bajada', '', '<a href="index.php"><img height="119" width="902" border="0" src="images/sitio/sgs/images/top.jpg" alt="Sistema de Gesti&oacute;n de Solicitudes" /></a>', '0', 3, 'si', 'si', 'si', '18/12/2008', '', 0, '', '', '150', '', 0, 0, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009012010144481', 'esp', 'Pol&iacute;ca de Privacidad', 'Politica-de-Privacidad', 'bajada de noticia', '', '<h3 align="justify">Pol&iacute;tica de Privacidad</h3>\r\n<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; De conformidad a lo dispuesto en&nbsp;la Constituci&oacute;n Pol&iacute;tica de la Rep&uacute;blica, art&iacute;culo 19 N&ordm; 4 y la Ley N&ordm; 19.628 sobre Protecci&oacute;n de la Vida Privada se se&ntilde;ala lo siguiente: <br />\r\nEste organismo, pone en conocimiento de todos quienes acceden a este Sistema de Gesti&oacute;n de Solicitudes la siguiente Pol&iacute;tica de Privacidad, a fin de resguardar la seguridad, confidencialidad y privacidad del usuario y/o visitante de este sitio, as&iacute; como de establecer los t&eacute;rminos de uso del Sistema de Gesti&oacute;n de Solicitudes de Informaci&oacute;n P&uacute;blica Ley N&deg;20.285. <br />\r\nEstas pol&iacute;ticas tienen por finalidad asegurar la correcta utilizaci&oacute;n de la informaci&oacute;n recopilada a trav&eacute;s de las visitas de este sitio y de sus contenidos.</p>\r\n<p align="justify"><strong>I. EN CUANTO A LA RECOPILACION DE DATOS</strong></p>\r\n<p align="justify">Este organismo&nbsp;recopila datos de los suscriptores, usuarios y/o visitantes que hagan uso de este portal, a trav&eacute;s de dos mecanismos: <br />\r\na)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mecanismos Autom&aacute;ticos: Son aquellos procesos inform&aacute;ticos realizados para generar registros de las actividades de los visitantes de sitios Web y cuyo objeto es establecer patrones de actividad, navegaci&oacute;n y audiencia, que no implican la identificaci&oacute;n personal de aquellos suscriptores, usuarios y/o visitantes que accedan a los servicios del sistema de gesti&oacute;n de solicitudes. <br />\r\nA este organismo, s&oacute;lo en lo que le concierne administrar, se reserva el derecho de usar dicha informaci&oacute;n general, a fin de establecer criterios que mejoren los contenidos de este sistema, en todo caso siempre disociados de la persona que dej&oacute; los datos en su navegaci&oacute;n. <br />\r\nb)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mecanismos Manuales: Son requerimientos formales y expresos de informaci&oacute;n a los suscriptores, usuarios y/o visitantes del portal que implican la recolecci&oacute;n de datos como nombre, apellidos, domicilio, correo electr&oacute;nico, ocupaci&oacute;n, etc.</p>\r\n<p align="justify"><strong>II. EN CUANTO A LA ENTREGA DE INFORMACI&Oacute;N A TERCEROS</strong></p>\r\n<p align="justify">Respecto de la entrega de informaci&oacute;n recopilada por medio de los mecanismos autom&aacute;ticos antes se&ntilde;alados, y que no contengan identificaci&oacute;n personal de los suscriptores, usuarios y/o visitantes de la p&aacute;gina, esta podr&aacute; ser utilizada para informar a entidades p&uacute;blicas, gubernamentales o a terceros sobre patrones de actividad, navegaci&oacute;n, audiencia y caracterizaci&oacute;n general de este sistema. Cuando se trate de datos recopilados que contengan informaci&oacute;n personal de los usuarios y/o visitantes de la p&aacute;gina, s&oacute;lo podr&aacute; entregarse en raz&oacute;n de un mandato legal o una orden emanada de los Tribunales de Justicia que as&iacute; lo establezca.</p>\r\n<p align="justify">Al acceder al portal, el visitante tendr&aacute; derecho a revisar toda la informaci&oacute;n que est&eacute; disponible en el, solo pudiendo utilizarla para fines particulares y no comerciales. Sin perjuicio de lo anterior, esta repartici&oacute;n, no se hace responsable por la veracidad o exactitud de la informaci&oacute;n contenida en los enlaces a otros sitios Web o que haya sido entregada por terceros.</p>\r\n<p align="justify"><strong>III. RECOLECCI&Oacute;N DE DATOS PERSONALES EN CUANTO A LAS SOLICITUDES DE INFORMACI&Oacute;N P&Uacute;BLICA DESTINADAS A ESTE ORGANISMO</strong></p>\r\n<p align="justify">E&nbsp;asegura la confidencialidad de los datos personales de los solicitantes que se registren como tales en el sitio del sistema y dirigidas exclusivamente el entidad_padre mediante el(los) formulario(s) establecido(s) para esos efectos. Sin perjuicio de sus facultades legales, s&oacute;lo se efectuar&aacute; tratamiento de datos personales respecto de aquellos que han sido entregados voluntariamente por los Usuarios en el referido formulario.<br />\r\nLos datos personales de los solicitantes ser&aacute;n utilizados &uacute;nicamente para el cumplimiento de los fines indicados en el(los) formulario(s) correspondiente(s) y siempre dentro de la competencia y atribuciones del organismo.<br />\r\nRespecto de los datos personales, si en raz&oacute;n de las consultas o peticiones efectuadas por los solicitantes, &eacute;stos entregan datos personales al Sistema, &eacute;ste se entender&aacute; autorizado para su tratamiento en el marco de lo establecido en la ley 19.628 sobre &quot;Protecci&oacute;n de Datos de Car&aacute;cter Personal&quot;. Tales datos ser&aacute;n protegidos de acuerdo a la ley, y podr&aacute;n ser utilizados y transmitidos &uacute;nica y exclusivamente a otros organismos o dependencias p&uacute;blicas por&nbsp;este servicio p&uacute;blico&nbsp;en su calidad de administrador del sitio, no pudiendo acceder al contenido de los mismos.</p>\r\n<p align="justify"><strong>IV. LIBERACI&Oacute;N DE RESPONSABILIDAD POR PARTE DE LOS ORGANISMOS DEL ESTADO </strong></p>\r\n<p align="justify">El Sistema de Gesti&oacute;n de Solicitudes para la Ley N&deg;20.285 es un medio que facilita la realizaci&oacute;n de las solicitudes de acceso a la informaci&oacute;n p&uacute;blica, sin intervenir en la ejecuci&oacute;n de dichos actos ni intervenir ni formal ni sustantivamente en ninguna de sus fases. Tampoco el Sistema ser&aacute; responsable de la seriedad e idoneidad de las solicitudes recibidas, las que deber&aacute;n ser evaluadas por cada organismo adscrito al Sistema.</p>\r\n<p align="justify"><strong>V. DECLARACI&Oacute;N </strong></p>\r\n<p align="justify">Los usuarios del Sistema declaran conocer y aceptar la circunstancia relativa a que&nbsp;este servicio p&uacute;blico&nbsp;podr&aacute; en cualquier momento modificar el todo o parte de las presentes condiciones de uso, conforme la legislaci&oacute;n vigente o pol&iacute;ticas del organismo.</p>', '0', 3, 'si', 'si', 'si', '20/01/2009', '', 0, '', '', '150', '', 1, 28, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009021911314646', 'esp', 'Preguntas Frecuentes', 'Preguntas-Frecuentes', 'Bajada', '', '<h3 align="justify">Preguntas Frecuentes sobre acceso a la informaci&oacute;n p&uacute;blica</h3>\r\n<ul type="disc">\r\n    <li>\r\n    <div align="justify"><a href="#0"><strong>&iquest;A qu&eacute; organismos y servicios puedo solicitar informaci&oacute;n de acuerdo con la Ley N&deg; 20.285? </strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#1"><strong>&iquest;Qu&eacute; documentos y en qu&eacute; formatos puedo solicitar por esta Ley sobre Acceso a la Informaci&oacute;n P&uacute;blica? </strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#2"><strong>&iquest;Qu&eacute; plazo tiene el organismo para responder mi solicitud?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#3"><strong>&iquest;Por qu&eacute; v&iacute;a me notificar&aacute;n los hechos relevantes del proceso?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#4"><strong>&iquest;Qu&eacute; sucede si el organismo al que estoy solicitando la informaci&oacute;n no es competente para darme respuesta?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#5"><strong>&iquest;Puedo por esta Ley conocer el estado de un tr&aacute;mite?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#6"><strong>&iquest;Me pueden cobrar por la informaci&oacute;n solicitada?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#7"><strong>&iquest;Puedo pedir que un &oacute;rgano elabore, produzca, procese o consolide informaci&oacute;n para dar respuesta a mi solicitud?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#8"><strong>&iquest;Qu&eacute; se entiende por un &ldquo;requerimiento gen&eacute;rico&rdquo;?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#9"><strong>&iquest;Por qu&eacute; raz&oacute;n me pueden negar acceso a informaci&oacute;n?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#10"><strong>&iquest;Qu&eacute; pasa si la informaci&oacute;n que se solicita afecta los derechos de otra persona?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#11"><strong>Si se cumple el plazo y no me han dado una respuesta, &iquest;Qu&eacute; puedo hacer?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#12"><strong>Si una autoridad niega el acceso a la informaci&oacute;n fundado en alguna de las causales, &iquest;Qu&eacute; puede hacer?</strong></a></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><a href="#13"><strong>&iquest;Es el Consejo para la Transparencia la &uacute;ltima instancia de reclamaci&oacute;n? </strong></a></div>\r\n    </li>\r\n</ul>\r\n<p align="justify"><strong><a name="0" id="0"></a>&iquest;A qu&eacute; organismos y servicios puedo solicitar informaci&oacute;n de acuerdo con la Ley N&deg; 20.285? </strong>\r\n<p align="justify">A ministerios,  intendencias, gobernaciones, gobiernos regionales, municipios, Fuerzas Armadas, Carabineros, Investigaciones, &oacute;rganos y servicios p&uacute;blicos.<br />\r\nLa Contralor&iacute;a General de la Rep&uacute;blica y el Banco Central se ajustar&aacute;n a las disposiciones que expresamente les se&ntilde;ale la Ley N&deg;20.285.<br />\r\nEn cuanto al Congreso Nacional, los Tribunales de Justicia, Tribunales Especiales, Servicios P&uacute;blico, Tribunal Constitucional y a la Justicia Electoral, se ajustar&aacute;n a las disposiciones que se&ntilde;alen sus respectivas leyes org&aacute;nicas.<br />\r\n<strong><br />\r\n<a name="1" id="1"></a>&iquest;Qu&eacute; documentos y en qu&eacute; formatos puedo solicitar por esta Ley sobre Acceso a la Informaci&oacute;n P&uacute;blica? </strong>\r\n<p align="justify">Todos los actos y resoluciones de los &oacute;rganos de la administraci&oacute;n del Estado, sus fundamentos, los documentos que les sirvan de sustento directo o esencial y los procedimientos que se utilizaron para su dictaci&oacute;n, cualquiera sea su formato, soporte, fecha de creaci&oacute;n, origen, clasificaci&oacute;n o procesamiento.<br />\r\nEsto, salvo las excepciones que establece la Ley.<br />\r\n<strong><br />\r\n<a name="2" id="2"></a>&iquest;Qu&eacute; plazo tiene el organismo para responder mi solicitud?</strong>\r\n<p align="justify">El organismo dispone de 20 d&iacute;as h&aacute;biles desde la recepci&oacute;n de la solicitud. En ese plazo la autoridad debe resolver entregar la informaci&oacute;n solicitada o negarse a ello, mediante comunicaci&oacute;n fundada al requirente.<br />\r\nEste plazo puede prorrogarse por 10 d&iacute;as h&aacute;biles m&aacute;s en el caso que sea dif&iacute;cil reunir la informaci&oacute;n solicitada, debiendo comunicar dicha circunstancia al solicitante.<br />\r\n<strong><br />\r\n<a name="3" id="3"></a>&iquest;Por qu&eacute; v&iacute;a me notificar&aacute;n los hechos relevantes del proceso?</strong>\r\n<p align="justify">Si en la solicitud de informaci&oacute;n usted expresa claramente un medio de notificaci&oacute;n, se har&aacute; por esa v&iacute;a. En el caso que desee ser notificado de manera electr&oacute;nica, debe se&ntilde;alar una direcci&oacute;n de correo electr&oacute;nico habilitado.<br />\r\nEn los dem&aacute;s casos las notificaciones se har&aacute;n de acuerdo a lo dispuesto en los art&iacute;culos 46 y 47 de la Ley N&deg; 19.880 sobre Bases de los Procedimientos Administrativos, de aplicaci&oacute;n supletoria. Esta se&ntilde;ala que las notificaciones pueden efectuarse ya sea por carta certificada; personalmente en el domicilio del solicitante; o, en la oficina o servicio si el requirente se apersonare a recibirla. Asimismo, se entender&aacute; practicada la notificaci&oacute;n en forma t&aacute;cita si el solicitante realiza alguna gesti&oacute;n en el procedimiento que suponga necesariamente su conocimiento.<br />\r\n<strong><br />\r\n<a name="4" id="4"></a>&iquest;Qu&eacute; sucede si el organismo al que estoy solicitando la informaci&oacute;n no es competente para darme respuesta?</strong>\r\n<p align="justify">En la solicitud debe identificar lo m&aacute;s claramente posible el &oacute;rgano que tiene en su poder la informaci&oacute;n. Si pese a ello el organismo receptor define que otro &oacute;rgano es competente, &eacute;ste derivar&aacute; su solicitud, notific&aacute;ndolo de ello. Si no es posible identificar al &oacute;rgano competente o si la informaci&oacute;n solicitada pertenece a m&uacute;ltiples organismos, se le comunicar&aacute; oportunamente.<br />\r\n<strong><br />\r\n<a name="5" id="5"></a>&iquest;Puedo por esta Ley conocer el estado de un tr&aacute;mite? </strong>\r\n<p align="justify">No. El conocimiento del estado de un tr&aacute;mite est&aacute; regulado por el art&iacute;culo 17 de&nbsp; la Ley N&deg;19.880 sobre &nbsp;Bases de los Procedimientos Administrativos, no constituyendo una solicitud de acceso a informaci&oacute;n p&uacute;blica regida por la Ley N&deg;20.285.<br />\r\n<strong><br />\r\n<a name="6" id="6"></a>&iquest;Me pueden cobrar por la informaci&oacute;n solicitada? </strong>\r\n<p align="justify">La Ley N&deg;20.285 establece que se pueden cobrar los costos directos de reproducci&oacute;n y los dem&aacute;s valores que una ley expresamente autorice. En caso que usted no cancele los costos y valores,&nbsp; se suspende la obligaci&oacute;n de entrega.<br />\r\n<strong><br />\r\n<a name="7" id="7"></a>&iquest;Puedo pedir que un &oacute;rgano elabore, produzca, procese o consolide informaci&oacute;n para dar respuesta a mi solicitud?</strong>\r\n<p align="justify">No, s&oacute;lo puede solicitar aquella informaci&oacute;n que est&eacute; contenida en actos, resoluciones, actas, expedientes, contratos y acuerdos, lo que no incluye ni el procesamiento ni la generaci&oacute;n de informaci&oacute;n.<br />\r\n<strong><br />\r\n<a name="8" id="8"></a>&iquest;Qu&eacute; se entiende por un &ldquo;requerimiento gen&eacute;rico&rdquo;?</strong>\r\n<p align="justify">Aquellos que carecen de especificidad respecto de las caracter&iacute;sticas esenciales de la informaci&oacute;n solicitada, tales como materia, fecha de emisi&oacute;n o periodo de vigencia, autor, origen o destino, soporte, entre otros.<br />\r\n<strong><br />\r\n<a name="9" id="9"></a>&iquest;Por qu&eacute; raz&oacute;n me pueden negar acceso a informaci&oacute;n? </strong>\r\n<p align="justify">No obstante el principio general es la m&aacute;xima publicidad, la Ley establece excepciones ligadas a causales de secreto y reserva. Estas est&aacute;n relacionadas en general con temas de defensa nacional, relaciones exteriores, seguridad p&uacute;blica, derechos de las personas, el debido cumplimiento de las funciones del &oacute;rgano requerido, entre otras. Adem&aacute;s, una ley de qu&oacute;rum calificado puede declarar ciertos documentos, actos o informaci&oacute;n como secretos o reservados.<br />\r\n<strong><br />\r\n<a name="10" id="10"></a>&iquest;Qu&eacute; pasa si la informaci&oacute;n que se solicita afecta los derechos de otra persona? </strong>\r\n<p align="justify">La autoridad tiene un plazo de dos d&iacute;as h&aacute;biles, contados desde la recepci&oacute;n de la solicitud, para notificar por carta certificada a la o las personas a que se refiere o afecta la informaci&oacute;n, la cual puede oponerse a la entrega de documentos solicitados en un plazo de tres d&iacute;as desde la fecha de notificaci&oacute;n.<br />\r\nSi la persona se opone, la autoridad notificar&aacute; al solicitante de&nbsp; la oposici&oacute;n y negar&aacute; el acceso a dicha informaci&oacute;n, salvo resoluci&oacute;n en contrario del Consejo para la Transparencia. <br />\r\nSi la tercera persona no se opusiese o no responde, se entender&aacute; que accede a la entrega de la informaci&oacute;n.&nbsp;\r\n<p align="justify"><strong><a name="11" id="11"></a>Si se cumple el plazo y no me han dado una respuesta, &iquest;Qu&eacute; puedo hacer? </strong>\r\n<p align="justify">El solicitante o requirente puede recurrir de amparo ante el Consejo para la Transparencia. Para ello tiene un plazo de quince d&iacute;as desde que se cumpli&oacute; el plazo legal para que el organismo o servicio entregara la informaci&oacute;n.<br />\r\n<strong><br />\r\n<a name="12" id="12"></a>Si una autoridad niega el acceso a la informaci&oacute;n fundado en alguna de las causales, &iquest;qu&eacute; puede hacer? </strong>\r\n<p align="justify">Negada la informaci&oacute;n puede recurrir de reclamaci&oacute;n ante el Consejo para la Transparencia, el que podr&aacute; ratificar lo decidido por la autoridad u ordenar que se le entregue la informaci&oacute;n al solicitante. El requirente tiene plazo de quince d&iacute;as para presentar su reclamaci&oacute;n, contados desde la notificaci&oacute;n de la denegaci&oacute;n.<br />\r\n<strong><br />\r\n<a name="13" id="13"></a>&iquest;Es el Consejo para la Transparencia la &uacute;ltima instancia de reclamaci&oacute;n? </strong>\r\n<p align="justify">No, en caso de que el Consejo falle adversamente al solicitante, &eacute;ste puede acudir a la Corte de Apelaciones de su domicilio, interponiendo un reclamo de ilegalidad, en el plazo de 15 d&iacute;as corridos contados desde la notificaci&oacute;n de la resoluci&oacute;n reclamada.', '0', 3, 'no', 'si', 'si', '19/02/2009', '', 0, '', '', '235', '', 1, 28, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009021715335463', 'esp', 'Ayuda al Ciudadano - Portada', 'Ayuda-al-Ciudadano--Portada', 'Bajada', '', '<p align="justify">A trav&eacute;s de este sistema podr&aacute; solicitar informaci&oacute;n p&uacute;blica de acuerdo a lo establecido en la <a target="_blank" href="http://www.bcn.cl/ley-transparencia">Ley N&ordm; 20.285</a>.', '0', 3, 'si', 'si', 'si', '17/02/2009', '', 0, '', '', '150', '', 1, 127, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009021911405795', 'esp', 'Condiciones de Uso', 'Condiciones-de-Uso', 'Bajada', '', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.', '0', 3, 'no', 'si', 'si', '19/02/2009', '', 0, '', '', '235', '', 0, 10, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009021911060251', 'esp', 'Ayuda', 'Ayuda', 'Bajada', '', '<h3 align="justify">Ayuda Sobre Solicitudes Electr&oacute;nicas</h3>\r\n<ul>\r\n    <li>\r\n    <div align="justify"><strong><a href="#solicitud">&iquest;C&oacute;mo puedo realizar una solicitud?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#registro">&iquest;C&oacute;mo registrarme?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#usuario">&iquest;Qu&eacute; es mi nombre de usuario?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#clave">&iquest;Qu&eacute; es? y &iquest;C&oacute;mo obtengo mi clave?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#recuperar">&iquest;C&oacute;mo puedo recuperar mi clave?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#modificar">&iquest;C&oacute;mo modifico mi clave?</a></strong></div>\r\n    </li>\r\n    <li>\r\n    <div align="justify"><strong><a href="#estado">&iquest;C&oacute;mo puedo ver el estado en que se encuentran mis solicitudes?</a></strong></div>\r\n    </li>\r\n</ul>\r\n<p align="justify">&nbsp;<strong><a id="solicitud" name="solicitud"></a>&iquest;C&oacute;mo puedo realizar una solicitud?</strong>\r\n<p align="justify">Para realizar una solicitud debe estar registrado. Ingrese sus datos (usuario y contrase&ntilde;a) en el formulario de acceso y a continuaci&oacute;n haga clic en &ldquo;Realizar Solicitud&rdquo; ubicada en el men&uacute; del costado izquierdo de la pantalla. Se presentar&aacute;n a usted algunas preguntas que lo orientar&aacute;n en su solicitud.&nbsp; A continuaci&oacute;n complete el formulario indicando su consulta, el servicio al que desea consultar, la forma en que desea ser notificado/a, y la forma y el formato en que desea recibir la informaci&oacute;n solicitada.<br />\r\n<strong><br />\r\n<a id="registro" name="registro"></a>&iquest;C&oacute;mo registrarme?</strong>\r\n<p align="justify">Dir&iacute;jase a la p&aacute;gina de inicio y haga clic en el enlace "Deseo registrarme ahora" ubicado bajo el formulario de acceso. En la p&aacute;gina que se presenta a continuaci&oacute;n se le solicitar&aacute; que complete sus datos personales (nombres, apellidos y su domicilio), que ingrese una direcci&oacute;n de correo electr&oacute;nico, que defina una contrase&ntilde;a para identificarse en el sistema y que indique su aceptaci&oacute;n de la pol&iacute;tica de privacidad del sitio. Adicionalmente usted podr&aacute; proporcionar algunos datos estad&iacute;sticos opcionales. Finalmente deber&aacute; ingresar un c&oacute;digo de letras y&nbsp; n&uacute;meros que se muestra al final formulario y presionar el bot&oacute;n &ldquo;Registrarse&rdquo;.<br />\r\nSe le enviar&aacute; un correo electr&oacute;nico con indicaciones para verificar la validez de los datos proporcionados&nbsp; y activar su cuenta.<br />\r\n<strong><br />\r\n<a id="usuario" name="usuario"></a>&iquest;Qu&eacute; es mi nombre de usuario?</strong>\r\n<p align="justify">Corresponde a la identificaci&oacute;n del usuario en el Sistema de Gesti&oacute;n de Solicitudes, en particular en esta plataforma el nombre de usuario corresponde al correo electr&oacute;nico proporcionado en el formulario de registro. (Ej. <a href="mailto:jperez@misitio.com">jperez@misitio.com</a>)<br />\r\n<strong><br />\r\n<a id="clave" name="clave"></a>&iquest;Qu&eacute; es? y &iquest;C&oacute;mo obtengo mi clave?</strong>\r\n<p align="justify">La clave es un c&oacute;digo o palabra secreta que permite ingresar a su cuenta privada y por tanto debe ser personal e intransferible. Esta clave de usuario es definida por usted al momento de registrarse.<br />\r\n<strong><br />\r\n<a id="recuperar" name="recuperar"></a>&iquest;C&oacute;mo puedo recuperar mi clave?</strong>\r\n<p align="justify">Para recuperar su clave dir&iacute;jase a la p&aacute;gina de inicio y haga clic en el enlace "&iquest;Olvid&oacute; su contrase&ntilde;a?" ubicado bajo el formulario de acceso. En la p&aacute;gina que se presenta a continuaci&oacute;n se le solicitar&aacute; que digite la direcci&oacute;n de correo electr&oacute;nico que tiene registrada en el Portal. Su clave ser&aacute; enviada en forma autom&aacute;tica desde el servidor al correo registrado.<br />\r\n<strong><br />\r\n<a id="modificar" name="modificar"></a>&iquest;C&oacute;mo modifico mi clave?</strong>\r\n<p align="justify">Para modificar su clave dir&iacute;jase a la secci&oacute;n Mis Datos ubicada en el men&uacute; del costado izquierdo de la pantalla.<br />\r\nSeleccione la opci&oacute;n Modificar clave. A continuaci&oacute;n se le solicitar&aacute; digitar su clave actual, ingresar una nueva clave y reingresar su nueva clave para confirmar. Finalmente presione aceptar y su clave ser&aacute; actualizada.<br />\r\n<strong><br />\r\n<a id="estado" name="estado"></a></strong><strong>&iquest;C&oacute;mo puedo ver el estado en que se encuentran mis solicitudes?</strong>\r\n<p align="justify">Para ver el estado de sus solicitudes, dir&iacute;jase a la secci&oacute;n &ldquo;Mis Solicitudes&rdquo; ubicada en el men&uacute; del costado izquierdo de la pantalla. Aparecer&aacute; un listado de cada una de sus solicitudes con su respectivo estado. Si desea ver m&aacute;s informaci&oacute;n de una solicitud en particular, seleccione el enlace &ldquo;VER&rdquo; ubicado al costado derecho de cada solicitud.', '0', 3, 'no', 'si', 'si', '19/02/2009', '', 0, '', '', '235', '', 1, 118, '', 1, 0, 0);
INSERT INTO noticias VALUES ('2009052210500446', 'esp', 'Error no borrar esto', 'Error-no-borrar-esto', 'Bajada', '', '<p align="center"><img alt="upss" src="images/atencion.gif" />&nbsp;<br />\r\nDisc&uacute;lpenos estamos experimentando alg&uacute;n tipo de dificultad, intente <br />\r\nmas tarde.<br />\r\n<br />\r\n<br />\r\n', '0', 3, 'si', 'si', 'si', '22/05/2009', '', 0, '', '', '150', '150', 1, 20, '', 1, 0, 0);

#
# Volcar la base de datos para la tabla `noticias_id_publicador`
#
truncate table  noticias_id_publicador;
INSERT INTO noticias_id_publicador VALUES (116);
INSERT INTO noticias_id_publicador VALUES (150);
INSERT INTO noticias_id_publicador VALUES (235);

#
# Volcar la base de datos para la tabla `observaciones_persona`
#


#
# Volcar la base de datos para la tabla `pais`
#
truncate table  pais;
INSERT INTO pais VALUES (1, 'afganistan', 2);
INSERT INTO pais VALUES (2, 'africa del sur', 3);
INSERT INTO pais VALUES (3, 'albania', 4);
INSERT INTO pais VALUES (4, 'alemania', 5);
INSERT INTO pais VALUES (5, 'andorra', 6);
INSERT INTO pais VALUES (6, 'angola', 7);
INSERT INTO pais VALUES (7, 'antigua y barbuda', 8);
INSERT INTO pais VALUES (8, 'antillas holandesas', 9);
INSERT INTO pais VALUES (9, 'arabia saudita', 10);
INSERT INTO pais VALUES (10, 'argelia', 11);
INSERT INTO pais VALUES (11, 'argentina', 12);
INSERT INTO pais VALUES (12, 'armenia', 13);
INSERT INTO pais VALUES (13, 'aruba', 14);
INSERT INTO pais VALUES (14, 'australia', 15);
INSERT INTO pais VALUES (15, 'austria', 16);
INSERT INTO pais VALUES (16, 'azerbaijan', 17);
INSERT INTO pais VALUES (17, 'bahamas', 18);
INSERT INTO pais VALUES (18, 'bahrain', 19);
INSERT INTO pais VALUES (19, 'bangladesh', 20);
INSERT INTO pais VALUES (20, 'barbados', 21);
INSERT INTO pais VALUES (21, 'belarusia', 22);
INSERT INTO pais VALUES (22, 'belgica', 23);
INSERT INTO pais VALUES (23, 'belice', 24);
INSERT INTO pais VALUES (24, 'benin', 25);
INSERT INTO pais VALUES (25, 'bermudas', 26);
INSERT INTO pais VALUES (26, 'bolivia', 27);
INSERT INTO pais VALUES (27, 'bosnia', 28);
INSERT INTO pais VALUES (28, 'botswana', 29);
INSERT INTO pais VALUES (29, 'brasil', 30);
INSERT INTO pais VALUES (30, 'brunei darussulam', 31);
INSERT INTO pais VALUES (31, 'bulgaria', 32);
INSERT INTO pais VALUES (32, 'burkina faso', 33);
INSERT INTO pais VALUES (33, 'burundi', 34);
INSERT INTO pais VALUES (34, 'butan', 35);
INSERT INTO pais VALUES (35, 'camboya', 36);
INSERT INTO pais VALUES (36, 'camerun', 37);
INSERT INTO pais VALUES (37, 'canada', 38);
INSERT INTO pais VALUES (38, 'cape verde', 39);
INSERT INTO pais VALUES (39, 'chad', 40);
INSERT INTO pais VALUES (40, 'chile', 1);
INSERT INTO pais VALUES (41, 'china', 41);
INSERT INTO pais VALUES (42, 'chipre', 42);
INSERT INTO pais VALUES (43, 'colombia', 43);
INSERT INTO pais VALUES (44, 'comoros', 44);
INSERT INTO pais VALUES (45, 'congo', 45);
INSERT INTO pais VALUES (46, 'corea del norte', 46);
INSERT INTO pais VALUES (47, 'corea del sur', 47);
INSERT INTO pais VALUES (48, 'costa de marf&iacute;l', 48);
INSERT INTO pais VALUES (49, 'costa rica', 49);
INSERT INTO pais VALUES (50, 'croasia', 50);
INSERT INTO pais VALUES (51, 'cuba', 51);
INSERT INTO pais VALUES (52, 'dinamarca', 52);
INSERT INTO pais VALUES (53, 'djibouti', 53);
INSERT INTO pais VALUES (54, 'dominica', 54);
INSERT INTO pais VALUES (55, 'ecuador', 55);
INSERT INTO pais VALUES (56, 'egipto', 56);
INSERT INTO pais VALUES (57, 'el salvador', 57);
INSERT INTO pais VALUES (58, 'emiratos arabes unidos', 58);
INSERT INTO pais VALUES (59, 'eritrea', 59);
INSERT INTO pais VALUES (60, 'eslovenia', 60);
INSERT INTO pais VALUES (61, 'españa', 61);
INSERT INTO pais VALUES (62, 'estados unidos', 0);
INSERT INTO pais VALUES (63, 'estonia', 0);
INSERT INTO pais VALUES (64, 'etiopia', 0);
INSERT INTO pais VALUES (65, 'fiji', 0);
INSERT INTO pais VALUES (66, 'filipinas', 0);
INSERT INTO pais VALUES (67, 'finlandia', 0);
INSERT INTO pais VALUES (68, 'francia', 0);
INSERT INTO pais VALUES (69, 'gabon', 0);
INSERT INTO pais VALUES (70, 'gambia', 0);
INSERT INTO pais VALUES (71, 'georgia', 0);
INSERT INTO pais VALUES (72, 'ghana', 0);
INSERT INTO pais VALUES (73, 'granada', 0);
INSERT INTO pais VALUES (74, 'grecia', 0);
INSERT INTO pais VALUES (75, 'groenlandia', 0);
INSERT INTO pais VALUES (76, 'guadalupe', 0);
INSERT INTO pais VALUES (77, 'guam', 0);
INSERT INTO pais VALUES (78, 'guatemala', 0);
INSERT INTO pais VALUES (79, 'guayana francesa', 0);
INSERT INTO pais VALUES (80, 'guerney', 0);
INSERT INTO pais VALUES (81, 'guinea', 0);
INSERT INTO pais VALUES (82, 'guinea-bissau', 0);
INSERT INTO pais VALUES (83, 'guinea equatorial', 0);
INSERT INTO pais VALUES (84, 'guyana', 0);
INSERT INTO pais VALUES (85, '', 0);
INSERT INTO pais VALUES (86, '', 0);
INSERT INTO pais VALUES (87, ':', 0);
INSERT INTO pais VALUES (88, 'haiti', 0);
INSERT INTO pais VALUES (89, 'holanda', 0);
INSERT INTO pais VALUES (90, 'honduras', 0);
INSERT INTO pais VALUES (91, 'hong kong', 0);
INSERT INTO pais VALUES (92, 'hungria', 0);
INSERT INTO pais VALUES (93, 'india', 0);
INSERT INTO pais VALUES (94, 'indonesia', 0);
INSERT INTO pais VALUES (95, 'irak', 0);
INSERT INTO pais VALUES (96, 'iran', 0);
INSERT INTO pais VALUES (97, 'irlanda', 0);
INSERT INTO pais VALUES (98, 'islandia', 0);
INSERT INTO pais VALUES (99, 'islas caiman', 0);
INSERT INTO pais VALUES (100, 'islas faroe', 0);
INSERT INTO pais VALUES (101, 'islas malvinas', 0);
INSERT INTO pais VALUES (102, 'islas marshall', 0);
INSERT INTO pais VALUES (103, 'islas solomon', 0);
INSERT INTO pais VALUES (104, 'islas virgenes britanicas', 0);
INSERT INTO pais VALUES (105, 'islas virgenes (u.s.)', 0);
INSERT INTO pais VALUES (106, 'israel', 0);
INSERT INTO pais VALUES (107, 'italia', 0);
INSERT INTO pais VALUES (108, 'jamaica', 0);
INSERT INTO pais VALUES (109, 'japon', 0);
INSERT INTO pais VALUES (110, 'jersey', 0);
INSERT INTO pais VALUES (111, 'jjordania', 0);
INSERT INTO pais VALUES (112, 'kazakhstan', 0);
INSERT INTO pais VALUES (113, 'kenia', 0);
INSERT INTO pais VALUES (114, 'kiribati', 0);
INSERT INTO pais VALUES (115, 'kuwait', 0);
INSERT INTO pais VALUES (116, 'kyrgyzstan', 0);
INSERT INTO pais VALUES (117, 'laos', 0);
INSERT INTO pais VALUES (118, 'latvia', 0);
INSERT INTO pais VALUES (119, 'lesotho', 0);
INSERT INTO pais VALUES (120, 'libano', 0);
INSERT INTO pais VALUES (121, 'liberia', 0);
INSERT INTO pais VALUES (122, 'libia', 0);
INSERT INTO pais VALUES (123, 'liechtenstein', 0);
INSERT INTO pais VALUES (124, 'lituania', 0);
INSERT INTO pais VALUES (125, 'luxemburgo', 0);
INSERT INTO pais VALUES (126, 'macao', 0);
INSERT INTO pais VALUES (127, 'macedonia', 0);
INSERT INTO pais VALUES (128, 'madagascar', 0);
INSERT INTO pais VALUES (129, 'malasia', 0);
INSERT INTO pais VALUES (130, 'malawi', 0);
INSERT INTO pais VALUES (131, 'maldivas', 0);
INSERT INTO pais VALUES (132, 'mali', 0);
INSERT INTO pais VALUES (133, 'malta', 0);
INSERT INTO pais VALUES (134, 'marruecos', 0);
INSERT INTO pais VALUES (135, 'martinica', 0);
INSERT INTO pais VALUES (136, 'mauricio', 0);
INSERT INTO pais VALUES (137, 'mauritania', 0);
INSERT INTO pais VALUES (138, 'mexico', 0);
INSERT INTO pais VALUES (139, 'micronesia', 0);
INSERT INTO pais VALUES (140, 'moldova', 0);
INSERT INTO pais VALUES (141, 'monaco', 0);
INSERT INTO pais VALUES (142, 'mongolia', 0);
INSERT INTO pais VALUES (143, 'mozambique', 0);
INSERT INTO pais VALUES (144, 'myanmar (burma)', 0);
INSERT INTO pais VALUES (145, 'namibia', 0);
INSERT INTO pais VALUES (146, 'nepal', 0);
INSERT INTO pais VALUES (147, 'nicaragua', 0);
INSERT INTO pais VALUES (148, 'niger', 0);
INSERT INTO pais VALUES (149, 'nigeria', 0);
INSERT INTO pais VALUES (150, 'noruega', 0);
INSERT INTO pais VALUES (151, 'nueva caledonia', 0);
INSERT INTO pais VALUES (152, 'nueva zealandia', 0);
INSERT INTO pais VALUES (153, 'oman', 0);
INSERT INTO pais VALUES (154, 'pakistan', 0);
INSERT INTO pais VALUES (155, 'palestina', 0);
INSERT INTO pais VALUES (156, 'panama', 0);
INSERT INTO pais VALUES (157, 'papua nueva guinea', 0);
INSERT INTO pais VALUES (158, 'paraguay', 0);
INSERT INTO pais VALUES (159, 'peru', 0);
INSERT INTO pais VALUES (160, 'polinesia francesa', 0);
INSERT INTO pais VALUES (161, 'polonia', 0);
INSERT INTO pais VALUES (162, 'portugal', 0);
INSERT INTO pais VALUES (163, 'puerto rico', 0);
INSERT INTO pais VALUES (164, 'qatar', 0);
INSERT INTO pais VALUES (165, 'reino unido', 0);
INSERT INTO pais VALUES (166, 'republica centroafricana', 0);
INSERT INTO pais VALUES (167, 'republica checa', 0);
INSERT INTO pais VALUES (168, 'republica democratica del congo', 0);
INSERT INTO pais VALUES (169, 'republica dominicana', 0);
INSERT INTO pais VALUES (170, 'republica eslovaca', 0);
INSERT INTO pais VALUES (171, 'reunion', 0);
INSERT INTO pais VALUES (172, 'ruanda', 0);
INSERT INTO pais VALUES (173, 'rumania', 0);
INSERT INTO pais VALUES (174, 'rusia', 0);
INSERT INTO pais VALUES (175, 'sahara', 0);
INSERT INTO pais VALUES (176, 'samoa', 0);
INSERT INTO pais VALUES (177, 'san cristobal-nevis (st. kitts)', 0);
INSERT INTO pais VALUES (178, 'san marino', 0);
INSERT INTO pais VALUES (179, 'san vincente y las granadinas', 0);
INSERT INTO pais VALUES (180, 'santa helena', 0);
INSERT INTO pais VALUES (181, 'santa lucia', 0);
INSERT INTO pais VALUES (182, 'santa sede (vaticano)', 0);
INSERT INTO pais VALUES (183, 'sao tome & principe', 0);
INSERT INTO pais VALUES (184, 'senegal', 0);
INSERT INTO pais VALUES (185, 'seychelles', 0);
INSERT INTO pais VALUES (186, 'sierra leona', 0);
INSERT INTO pais VALUES (187, 'singapur', 0);
INSERT INTO pais VALUES (188, 'siria', 0);
INSERT INTO pais VALUES (189, 'somalia', 0);
INSERT INTO pais VALUES (190, 'sri lanka (ceilan)', 0);
INSERT INTO pais VALUES (191, 'sudan', 0);
INSERT INTO pais VALUES (192, 'suecia', 0);
INSERT INTO pais VALUES (193, 'suiza', 0);
INSERT INTO pais VALUES (194, 'sur africa', 0);
INSERT INTO pais VALUES (195, 'surinam', 0);
INSERT INTO pais VALUES (196, 'swaziland', 0);
INSERT INTO pais VALUES (197, 'tailandia', 0);
INSERT INTO pais VALUES (198, 'taiwan', 0);
INSERT INTO pais VALUES (199, 'tajikistan', 0);
INSERT INTO pais VALUES (200, 'tanzania', 0);
INSERT INTO pais VALUES (201, 'timor oriental', 0);
INSERT INTO pais VALUES (202, 'togo', 0);
INSERT INTO pais VALUES (203, 'tokelau', 0);
INSERT INTO pais VALUES (204, 'tonga', 0);
INSERT INTO pais VALUES (205, 'trinidad & tobago', 0);
INSERT INTO pais VALUES (206, 'tunisia', 0);
INSERT INTO pais VALUES (207, 'turkmenistan', 0);
INSERT INTO pais VALUES (208, 'turquia', 0);
INSERT INTO pais VALUES (209, 'ucrania', 0);
INSERT INTO pais VALUES (210, 'uganda', 0);
INSERT INTO pais VALUES (211, 'union europea', 0);
INSERT INTO pais VALUES (212, 'uruguay', 0);
INSERT INTO pais VALUES (213, 'uzbekistan', 0);
INSERT INTO pais VALUES (214, 'vanuatu', 0);
INSERT INTO pais VALUES (215, 'venezuela', 0);
INSERT INTO pais VALUES (216, 'vietnam', 0);
INSERT INTO pais VALUES (217, 'yemen', 0);
INSERT INTO pais VALUES (218, 'yugoslavia', 0);
INSERT INTO pais VALUES (219, 'zambia', 0);
INSERT INTO pais VALUES (220, 'zimbabwe', 0);

#
# Volcar la base de datos para la tabla `personal`
#


#
# Volcar la base de datos para la tabla `poll`
#
truncate table  poll;
INSERT INTO poll VALUES ('1', '¿Que opinas sobre esta encuesta?', '200.2.213.102', 'no', 0, 0);
INSERT INTO poll VALUES ('4', '¿Tienes tag?', '', 'yes', 0, 0);

#
# Volcar la base de datos para la tabla `poll_admin`
#
truncate table  poll_admin;
INSERT INTO poll_admin VALUES ('ricardor', '8764695');

#
# Volcar la base de datos para la tabla `poll_answers`
#
truncate table  poll_answers;
INSERT INTO poll_answers VALUES (1, '1', 'Esta cool!!', 3, 13);
INSERT INTO poll_answers VALUES (36, '4', 'No', 0, 0);
INSERT INTO poll_answers VALUES (34, '4', 'Si', 0, 0);
INSERT INTO poll_answers VALUES (37, '1', 'Esta muy buena', 0, 0);
INSERT INTO poll_answers VALUES (38, '1', 'No me gusta', 0, 0);

#
# Volcar la base de datos para la tabla `poll_usuarios`
#
truncate table  poll_usuarios;
INSERT INTO poll_usuarios VALUES ('7', '1', 1);


#
# Volcar la base de datos para la tabla `regiones`
#
truncate table  regiones;
INSERT INTO regiones VALUES (1, 'Regi&oacute;n de Tarapac&aacute;', 0);
INSERT INTO regiones VALUES (2, 'Regi&oacute;n de Antofagasta', 0);
INSERT INTO regiones VALUES (3, 'Regi&oacute;n de Atacama', 0);
INSERT INTO regiones VALUES (4, 'Regi&oacute;n de Coquimbo', 0);
INSERT INTO regiones VALUES (5, 'Regi&oacute;n de Valpara&iacute;so', 0);
INSERT INTO regiones VALUES (6, 'Regi&oacute;n de Ohiggins', 0);
INSERT INTO regiones VALUES (7, 'Regi&oacute;n del Maule', 0);
INSERT INTO regiones VALUES (8, 'Regi&oacute;n del B&iacute;o  B&iacute;o', 0);
INSERT INTO regiones VALUES (9, 'Regi&oacute;n de La Araucan&iacute;a', 0);
INSERT INTO regiones VALUES (10, 'Regi&oacute;n de Los Lagos', 0);
INSERT INTO regiones VALUES (11, 'Regi&oacute;n de Ays&eacute;n', 0);
INSERT INTO regiones VALUES (12, 'Regi&oacute;n de Magallanes y La Ant&aacute;rtica Chilena', 0);
INSERT INTO regiones VALUES (13, 'Regi&oacute;n Metropolitana', 0);
INSERT INTO regiones VALUES (14, 'Regi&oacute;n de Los R&iacute;os', 0);
INSERT INTO regiones VALUES (15, 'Regi&oacute;n de Arica y Parinacota', 0);

#
# Volcar la base de datos para la tabla `sgs_enrutamiento_estados`
#


#
# Volcar la base de datos para la tabla `sgs_entidad_padre`
#
truncate table  sgs_entidad_padre;
INSERT INTO sgs_entidad_padre VALUES (1, 'Presidencia de la Rep&uacute;blica', 'AA', 0);
INSERT INTO sgs_entidad_padre VALUES (2, 'Ministerio del Interior', 'AB', 0);
INSERT INTO sgs_entidad_padre VALUES (3, 'Ministerio de Relaciones Exteriores', 'AC', 0);
INSERT INTO sgs_entidad_padre VALUES (4, 'Ministerio de Defensa Nacional', 'AD', 0);
INSERT INTO sgs_entidad_padre VALUES (5, 'Ministerio de Hacienda', 'AE', 0);
INSERT INTO sgs_entidad_padre VALUES (6, 'Ministerio Secretar&iacute;a General de la Presidencia', 'AF', 0);
INSERT INTO sgs_entidad_padre VALUES (7, 'Ministerio Secretar&iacute;a General de Gobierno', 'AG', 0);
INSERT INTO sgs_entidad_padre VALUES (8, 'Ministerio de Econom&iacute;a, Fomento y Reconstrucci&oacute;n', 'AH', 0);
INSERT INTO sgs_entidad_padre VALUES (9, 'Ministerio de Planificaci&oacute;n', 'AI', 0);
INSERT INTO sgs_entidad_padre VALUES (10, 'Ministerio de Educaci&oacute;n', 'AJ', 0);
INSERT INTO sgs_entidad_padre VALUES (11, 'Ministerio de Justicia', 'AK', 0);
INSERT INTO sgs_entidad_padre VALUES (12, 'Ministerio de Trabajo y Previsi&oacute;n Social', 'AL', 0);
INSERT INTO sgs_entidad_padre VALUES (13, 'Ministerio de Obras P&uacute;blicas', 'AM', 0);
INSERT INTO sgs_entidad_padre VALUES (14, 'Ministerio de Transportes y Telecomunicaciones', 'AN', 0);
INSERT INTO sgs_entidad_padre VALUES (16, 'Ministerio de Salud', 'AO', 0);
INSERT INTO sgs_entidad_padre VALUES (17, 'Ministerio de Vivienda y Urbanismo', 'AP', 0);
INSERT INTO sgs_entidad_padre VALUES (18, 'Ministerio de Bienes Nacionales', 'AQ', 0);
INSERT INTO sgs_entidad_padre VALUES (19, 'Ministerio de Agricultura', 'AR', 0);
INSERT INTO sgs_entidad_padre VALUES (20, 'Ministerio de Miner&iacute;a', 'AS', 0);
INSERT INTO sgs_entidad_padre VALUES (21, 'Servicio Nacional de la Mujer', 'AT', 0);
INSERT INTO sgs_entidad_padre VALUES (22, 'Comisi&oacute;n Nacional de Energ&iacute;a', 'AU', 0);
INSERT INTO sgs_entidad_padre VALUES (23, 'Consejo Nacional de la Cultura y las Artes', 'AV', 0);
INSERT INTO sgs_entidad_padre VALUES (24, 'Comisi&oacute;n Nacional del Medio Ambiente', 'AW', 0);
INSERT INTO sgs_entidad_padre VALUES (25, 'Consejo de Defensa del Estado', 'AX', 0);
INSERT INTO sgs_entidad_padre VALUES (26, 'Instituto Nacional de Propiedad Intelectual (INAPI)', 'AY', 1);
INSERT INTO sgs_entidad_padre VALUES (27, 'Comisi&oacute;n Nacional de Acreditaci&oacute;n', 'AZ', 2);

#
# Volcar la base de datos para la tabla `sgs_entidades`
#
truncate table  sgs_entidades;
INSERT INTO sgs_entidades VALUES (1, 1, 'Presidencia de la Rep&uacute;blica', '001', 0);
INSERT INTO sgs_entidades VALUES (2, 2, 'Subsecretar&iacute;a del Interior', '001', 0);
INSERT INTO sgs_entidades VALUES (3, 2, 'Subsecretar&iacute;a de Desarrollo Regional', '002', 0);
INSERT INTO sgs_entidades VALUES (4, 2, 'Agencia Nacional de Inteligencia', '003', 0);
INSERT INTO sgs_entidades VALUES (5, 2, 'Oficina Nacional de Emergencia', '004', 0);
INSERT INTO sgs_entidades VALUES (6, 2, 'Servicio de Gobierno Interior', '005', 0);
INSERT INTO sgs_entidades VALUES (7, 2, 'Servicio Electoral', '006', 0);
INSERT INTO sgs_entidades VALUES (8, 2, 'Intendencia Arica y Parinacota', '007', 0);
INSERT INTO sgs_entidades VALUES (9, 2, 'Intendencia de Antofagasta', '008', 0);
INSERT INTO sgs_entidades VALUES (10, 2, 'Intendencia de Atacama', '009', 0);
INSERT INTO sgs_entidades VALUES (11, 2, 'Intendencia de Ays&eacute;n', '010', 0);
INSERT INTO sgs_entidades VALUES (12, 2, 'Intendencia de Coquimbo', '011', 0);
INSERT INTO sgs_entidades VALUES (13, 2, 'Intendencia de La Araucan&iacute;a', '012', 0);
INSERT INTO sgs_entidades VALUES (14, 2, 'Intendencia de Los Lagos', '013', 0);
INSERT INTO sgs_entidades VALUES (15, 2, 'Intendencia de Los R&iacute;os', '014', 0);
INSERT INTO sgs_entidades VALUES (16, 2, 'Intendencia de Magallanes', '015', 0);
INSERT INTO sgs_entidades VALUES (17, 2, 'Intendencia de O’Higgins', '016', 0);
INSERT INTO sgs_entidades VALUES (18, 2, 'Intendencia de Tarapac&aacute;', '017', 0);
INSERT INTO sgs_entidades VALUES (19, 2, 'Intendencia de Valpara&iacute;so', '018', 0);
INSERT INTO sgs_entidades VALUES (20, 2, 'Intendencia del B&iacute;o-b&iacute;o', '019', 0);
INSERT INTO sgs_entidades VALUES (21, 2, 'Intendencia del Maule', '020', 0);
INSERT INTO sgs_entidades VALUES (22, 2, 'Intendencia Metropolitana', '021', 0);
INSERT INTO sgs_entidades VALUES (23, 2, 'Gobernaci&oacute;n de Arica', '022', 0);
INSERT INTO sgs_entidades VALUES (24, 2, 'Gobernaci&oacute;n de Parinacota', '023', 0);
INSERT INTO sgs_entidades VALUES (25, 2, 'Gobernaci&oacute;n de Iquique', '024', 0);
INSERT INTO sgs_entidades VALUES (26, 2, 'Gobernaci&oacute;n de Tamarugal', '025', 0);
INSERT INTO sgs_entidades VALUES (27, 2, 'Gobernaci&oacute;n de Antofagasta', '026', 0);
INSERT INTO sgs_entidades VALUES (28, 2, 'Gobernaci&oacute;n de El Loa', '027', 0);
INSERT INTO sgs_entidades VALUES (29, 2, 'Gobernaci&oacute;n de Tocopilla', '028', 0);
INSERT INTO sgs_entidades VALUES (30, 2, 'Gobernaci&oacute;n de Chañaral', '029', 0);
INSERT INTO sgs_entidades VALUES (31, 2, 'Gobernaci&oacute;n de Copiap&oacute;', '030', 0);
INSERT INTO sgs_entidades VALUES (32, 2, 'Gobernaci&oacute;n de Huasco', '031', 0);
INSERT INTO sgs_entidades VALUES (33, 2, 'Gobernaci&oacute;n de Elqui', '032', 0);
INSERT INTO sgs_entidades VALUES (34, 2, 'Gobernaci&oacute;n de Limar&iacute;', '033', 0);
INSERT INTO sgs_entidades VALUES (35, 2, 'Gobernaci&oacute;n de Choapa', '034', 0);
INSERT INTO sgs_entidades VALUES (36, 2, 'Gobernaci&oacute;n de Petorca', '035', 0);
INSERT INTO sgs_entidades VALUES (37, 2, 'Gobernaci&oacute;n de Valpara&iacute;so', '036', 0);
INSERT INTO sgs_entidades VALUES (38, 2, 'Gobernaci&oacute;n de San Felipe', '037', 0);
INSERT INTO sgs_entidades VALUES (39, 2, 'Gobernaci&oacute;n de Los Andes', '038', 0);
INSERT INTO sgs_entidades VALUES (40, 2, 'Gobernaci&oacute;n de Quillota', '039', 0);
INSERT INTO sgs_entidades VALUES (41, 2, 'Gobernaci&oacute;n de San Antonio', '040', 0);
INSERT INTO sgs_entidades VALUES (42, 2, 'Gobernaci&oacute;n de Isla de Pascua', '041', 0);
INSERT INTO sgs_entidades VALUES (43, 2, 'Gobernaci&oacute;n de Cachapoal', '042', 0);
INSERT INTO sgs_entidades VALUES (44, 2, 'Gobernaci&oacute;n de Colchagua', '043', 0);
INSERT INTO sgs_entidades VALUES (45, 2, 'Gobernaci&oacute;n de Cardenal Caro', '044', 0);
INSERT INTO sgs_entidades VALUES (46, 2, 'Gobernaci&oacute;n de Curic&oacute;', '045', 0);
INSERT INTO sgs_entidades VALUES (47, 2, 'Gobernaci&oacute;n de Talca', '046', 0);
INSERT INTO sgs_entidades VALUES (48, 2, 'Gobernaci&oacute;n de Linares', '047', 0);
INSERT INTO sgs_entidades VALUES (49, 2, 'Gobernaci&oacute;n de Cauquenes', '048', 0);
INSERT INTO sgs_entidades VALUES (50, 2, 'Gobernaci&oacute;n de Ñuble', '049', 0);
INSERT INTO sgs_entidades VALUES (51, 2, 'Gobernaci&oacute;n de B&iacute;o-b&iacute;o', '050', 0);
INSERT INTO sgs_entidades VALUES (52, 2, 'Gobernaci&oacute;n de Concepci&oacute;n', '051', 0);
INSERT INTO sgs_entidades VALUES (53, 2, 'Gobernaci&oacute;n de Arauco', '052', 0);
INSERT INTO sgs_entidades VALUES (54, 2, 'Gobernaci&oacute;n de Malleco', '053', 0);
INSERT INTO sgs_entidades VALUES (55, 2, 'Gobernaci&oacute;n de Caut&iacute;n', '054', 0);
INSERT INTO sgs_entidades VALUES (56, 2, 'Gobernaci&oacute;n de Valdivia', '055', 0);
INSERT INTO sgs_entidades VALUES (57, 2, 'Gobernaci&oacute;n de Ranco', '056', 0);
INSERT INTO sgs_entidades VALUES (58, 2, 'Gobernaci&oacute;n de Osorno', '057', 0);
INSERT INTO sgs_entidades VALUES (59, 2, 'Gobernaci&oacute;n de Llanquihue', '058', 0);
INSERT INTO sgs_entidades VALUES (60, 2, 'Gobernaci&oacute;n de Chilo&eacute;', '059', 0);
INSERT INTO sgs_entidades VALUES (61, 2, 'Gobernaci&oacute;n de Palena', '060', 0);
INSERT INTO sgs_entidades VALUES (62, 2, 'Gobernaci&oacute;n de Coyhaique', '061', 0);
INSERT INTO sgs_entidades VALUES (63, 2, 'Gobernaci&oacute;n de Puerto Ays&eacute;n', '062', 0);
INSERT INTO sgs_entidades VALUES (64, 2, 'Gobernaci&oacute;n de General Carrera', '063', 0);
INSERT INTO sgs_entidades VALUES (65, 2, 'Gobernaci&oacute;n de Capit&aacute;n Prat', '064', 0);
INSERT INTO sgs_entidades VALUES (66, 2, 'Gobernaci&oacute;n de &uacute;ltima Esperanza', '065', 0);
INSERT INTO sgs_entidades VALUES (67, 2, 'Gobernaci&oacute;n de Magallanes', '066', 0);
INSERT INTO sgs_entidades VALUES (68, 2, 'Gobernaci&oacute;n de Tierra del Fuego', '067', 0);
INSERT INTO sgs_entidades VALUES (69, 2, 'Gobernaci&oacute;n de La Ant&aacute;rtica Chilena', '068', 0);
INSERT INTO sgs_entidades VALUES (70, 2, 'Gobernaci&oacute;n de Chacabuco', '069', 0);
INSERT INTO sgs_entidades VALUES (71, 2, 'Gobernaci&oacute;n de Cordillera', '070', 0);
INSERT INTO sgs_entidades VALUES (72, 2, 'Gobernaci&oacute;n de Maipo', '071', 0);
INSERT INTO sgs_entidades VALUES (73, 2, 'Gobernaci&oacute;n de Talagante', '072', 0);
INSERT INTO sgs_entidades VALUES (74, 2, 'Gobernaci&oacute;n de Melipilla', '073', 0);
INSERT INTO sgs_entidades VALUES (75, 2, 'Gobernaci&oacute;n de Santiago', '074', 0);
INSERT INTO sgs_entidades VALUES (76, 2, 'Gobierno Regional de Arica y Parinacota', '075', 0);
INSERT INTO sgs_entidades VALUES (77, 2, 'Gobierno Regional de Tarapac&aacute;', '076', 0);
INSERT INTO sgs_entidades VALUES (78, 2, 'Gobierno Regional de Antofagasta', '077', 0);
INSERT INTO sgs_entidades VALUES (79, 2, 'Gobierno Regional de Atacama', '078', 0);
INSERT INTO sgs_entidades VALUES (80, 2, 'Gobierno Regional de Coquimbo', '079', 0);
INSERT INTO sgs_entidades VALUES (81, 2, 'Gobierno Regional de Valpara&iacute;so', '080', 0);
INSERT INTO sgs_entidades VALUES (82, 2, 'Gobierno Regional Metropolitano de Santiago', '081', 0);
INSERT INTO sgs_entidades VALUES (83, 2, 'Gobierno Regional de O´Higgins', '082', 0);
INSERT INTO sgs_entidades VALUES (84, 2, 'Gobierno Regional del Maule', '083', 0);
INSERT INTO sgs_entidades VALUES (85, 2, 'Gobierno Regional del B&iacute;o-b&iacute;o', '084', 0);
INSERT INTO sgs_entidades VALUES (86, 2, 'Gobierno Regional de La Araucan&iacute;a', '085', 0);
INSERT INTO sgs_entidades VALUES (87, 2, 'Gobierno Regional de Los R&iacute;os', '086', 0);
INSERT INTO sgs_entidades VALUES (88, 2, 'Gobierno Regional de Los Lagos', '087', 0);
INSERT INTO sgs_entidades VALUES (89, 2, 'Gobierno Regional de Ays&eacute;n', '088', 0);
INSERT INTO sgs_entidades VALUES (90, 2, 'Gobierno Regional de Magallanes y Ant&aacute;rtica Chilena', '089', 0);
INSERT INTO sgs_entidades VALUES (91, 3, 'Subsecretar&iacute;a de Relaciones Exteriores', '001', 0);
INSERT INTO sgs_entidades VALUES (92, 3, 'Direcci&oacute;n General de Relaciones Econ&oacute;micas Internacionales', '002', 0);
INSERT INTO sgs_entidades VALUES (93, 3, 'Direcci&oacute;n Nacional de Fronteras y L&iacute;mites del Estado', '003', 0);
INSERT INTO sgs_entidades VALUES (94, 3, 'Agencia de Cooperaci&oacute;n Internacional', '004', 0);
INSERT INTO sgs_entidades VALUES (95, 3, 'Instituto Ant&aacute;rtico Chileno', '005', 0);
INSERT INTO sgs_entidades VALUES (96, 4, 'Subsecretar&iacute;a de Guerra', '001', 0);
INSERT INTO sgs_entidades VALUES (97, 4, 'Subsecretar&iacute;a de Marina', '002', 0);
INSERT INTO sgs_entidades VALUES (98, 4, 'Subsecretar&iacute;a de Aviaci&oacute;n', '003', 0);
INSERT INTO sgs_entidades VALUES (99, 4, 'Subsecretar&iacute;a de Carabineros', '004', 0);
INSERT INTO sgs_entidades VALUES (100, 4, 'Subsecretar&iacute;a de Investigaciones', '005', 0);
INSERT INTO sgs_entidades VALUES (101, 4, 'Ej&eacute;rcito de Chile', '006', 0);
INSERT INTO sgs_entidades VALUES (102, 4, 'Armada de Chile', '007', 0);
INSERT INTO sgs_entidades VALUES (103, 4, 'Fuerza A&eacute;rea de Chile', '008', 0);
INSERT INTO sgs_entidades VALUES (104, 4, 'Carabineros de Chile', '009', 0);
INSERT INTO sgs_entidades VALUES (105, 4, 'Polic&iacute;a de Investigaciones', '010', 0);
INSERT INTO sgs_entidades VALUES (106, 4, 'Direcci&oacute;n Administrativa', '011', 0);
INSERT INTO sgs_entidades VALUES (107, 4, 'Defensa Civil de Chile', '012', 0);
INSERT INTO sgs_entidades VALUES (108, 4, 'Direcci&oacute;n General de Movilizaci&oacute;n Nacional', '013', 0);
INSERT INTO sgs_entidades VALUES (109, 4, 'Direcci&oacute;n General del Territorio Mar&iacute;timo y Marina Mercante', '014', 0);
INSERT INTO sgs_entidades VALUES (110, 4, 'Caja de Previsi&oacute;n de la Defensa Nacional', '015', 0);
INSERT INTO sgs_entidades VALUES (111, 4, 'Direcci&oacute;n de Previsi&oacute;n de Carabineros de Chile', '016', 0);
INSERT INTO sgs_entidades VALUES (112, 4, 'Instituto Geogr&aacute;fico Militar', '017', 0);
INSERT INTO sgs_entidades VALUES (113, 4, 'Servicio Aerofotogram&eacute;trico Fach', '018', 0);
INSERT INTO sgs_entidades VALUES (114, 4, 'Servicio Hidrogr&aacute;fico y Oceanogr&aacute;fico de La Armada', '019', 0);
INSERT INTO sgs_entidades VALUES (115, 4, 'Direcci&oacute;n General de Aeron&aacute;utica Civil (dgac)', '020', 0);
INSERT INTO sgs_entidades VALUES (116, 5, 'Subsecretar&iacute;a de Hacienda', '001', 0);
INSERT INTO sgs_entidades VALUES (117, 5, 'Direcci&oacute;n de Presupuestos', '002', 0);
INSERT INTO sgs_entidades VALUES (118, 5, 'Tesorer&iacute;a General de La Rep&uacute;blica', '003', 0);
INSERT INTO sgs_entidades VALUES (119, 5, 'Direcci&oacute;n Nacional del Servicio Civil', '004', 0);
INSERT INTO sgs_entidades VALUES (120, 5, 'Unidad de An&aacute;lisis Financiero', '005', 0);
INSERT INTO sgs_entidades VALUES (121, 5, 'Servicio de Impuestos Internos', '006', 0);
INSERT INTO sgs_entidades VALUES (122, 5, 'Servicio Nacional de Aduanas', '007', 0);
INSERT INTO sgs_entidades VALUES (123, 5, 'Superintendencia de Bancos e Instituciones Financieras', '008', 0);
INSERT INTO sgs_entidades VALUES (124, 5, 'Superintendencia de Valores y Seguros', '009', 0);
INSERT INTO sgs_entidades VALUES (125, 5, 'Casa de Moneda de Chile', '010', 0);
INSERT INTO sgs_entidades VALUES (126, 5, 'Direcci&oacute;n de Compras y Contrataci&oacute;n P&uacute;blica (chilecompra)', '011', 0);
INSERT INTO sgs_entidades VALUES (127, 5, 'Superintendencia de Casinos de Juego', '012', 0);
INSERT INTO sgs_entidades VALUES (128, 6, 'Subsecretar&iacute;a General de La Presidencia', '001', 0);
INSERT INTO sgs_entidades VALUES (129, 6, 'Servicio Nacional del Adulto Mayor (senama)', '002', 0);
INSERT INTO sgs_entidades VALUES (130, 7, 'Subsecretar&iacute;a General de Gobierno', '001', 0);
INSERT INTO sgs_entidades VALUES (131, 7, 'Instituto Nacional del Deporte', '002', 0);
INSERT INTO sgs_entidades VALUES (132, 7, 'Consejo Nacional de Televisi&oacute;n', '003', 0);
INSERT INTO sgs_entidades VALUES (133, 8, 'Subsecretar&iacute;a de Econom&iacute;a', '001', 0);
INSERT INTO sgs_entidades VALUES (134, 8, 'Subsecretar&iacute;a de Pesca', '002', 0);
INSERT INTO sgs_entidades VALUES (135, 8, 'Comit&eacute; de Inversiones Extranjeras', '003', 0);
INSERT INTO sgs_entidades VALUES (136, 8, 'Corporaci&oacute;n de Fomento Para La Producci&oacute;n', '004', 0);
INSERT INTO sgs_entidades VALUES (137, 8, 'Fiscal&iacute;a Nacional Econ&oacute;mica', '005', 0);
INSERT INTO sgs_entidades VALUES (138, 8, 'Superintendencia de Electricidad y Combustibles', '006', 0);
INSERT INTO sgs_entidades VALUES (139, 8, 'Instituto Nacional de Estad&iacute;sticas (ine)', '007', 0);
INSERT INTO sgs_entidades VALUES (140, 8, 'Servicio Nacional de Turismo (sernatur)', '008', 0);
INSERT INTO sgs_entidades VALUES (141, 8, 'Servicio Nacional del Consumidor (sernac)', '009', 0);
INSERT INTO sgs_entidades VALUES (142, 8, 'Servicio Nacional de Pesca', '010', 0);
INSERT INTO sgs_entidades VALUES (143, 9, 'Subsecretar&iacute;a de Planificaci&oacute;n y Cooperaci&oacute;n', '001', 0);
INSERT INTO sgs_entidades VALUES (144, 9, 'Corporaci&oacute;n Nacional de Desarrollo Ind&iacute;gena (conadi)', '002', 0);
INSERT INTO sgs_entidades VALUES (145, 9, 'Fondo Nacional de la Discapacidad (fonadis)', '003', 0);
INSERT INTO sgs_entidades VALUES (146, 9, 'Fondo de Solidaridad e Inversi&oacute;n Social (fosis)', '004', 0);
INSERT INTO sgs_entidades VALUES (147, 9, 'Instituto Nacional de la Juventud', '005', 0);
INSERT INTO sgs_entidades VALUES (148, 10, 'Subsecretar&iacute;a de Educaci&oacute;n', '001', 0);
INSERT INTO sgs_entidades VALUES (149, 10, 'Consejo de Rectores de las Universidades Chilenas', '002', 0);
INSERT INTO sgs_entidades VALUES (150, 10, 'Consejo Superior de Educaci&oacute;n', '003', 0);
INSERT INTO sgs_entidades VALUES (151, 10, 'Comisi&oacute;n Administradora del Sistema de Cr&eacute;ditos para Estudios Superiores', '004', 0);
INSERT INTO sgs_entidades VALUES (152, 10, 'Direcci&oacute;n de Bibliotecas, Archivos y Museos', '005', 0);
INSERT INTO sgs_entidades VALUES (154, 10, 'Consejo de Calificaci&oacute;n Cinematogr&aacute;fica', '007', 0);
INSERT INTO sgs_entidades VALUES (155, 10, 'Comisi&oacute;n Nacional de Investigaci&oacute;n En Ciencia y Tecnolog&iacute;a (conicyt)', '008', 0);
INSERT INTO sgs_entidades VALUES (156, 10, 'Junta Nacional de Auxilio Escolar y Becas (junaeb)', '009', 0);
INSERT INTO sgs_entidades VALUES (157, 10, 'Junta Nacional de Jardines Infantiles (junji)', '010', 0);
INSERT INTO sgs_entidades VALUES (158, 11, 'Subsecretar&iacute;a de Justicia', '001', 0);
INSERT INTO sgs_entidades VALUES (159, 11, 'Servicio de Registro Civil e Identificaci&oacute;n', '002', 0);
INSERT INTO sgs_entidades VALUES (160, 11, 'Servicio M&eacute;dico Legal', '003', 0);
INSERT INTO sgs_entidades VALUES (161, 11, 'Servicio Nacional de Menores', '004', 0);
INSERT INTO sgs_entidades VALUES (162, 11, 'Defensor&iacute;a Penal P&uacute;blica', '005', 0);
INSERT INTO sgs_entidades VALUES (163, 11, 'Gendarmer&iacute;a de Chile', '006', 0);
INSERT INTO sgs_entidades VALUES (164, 11, 'Superintendencia de Quiebras', '007', 0);
INSERT INTO sgs_entidades VALUES (165, 11, 'Corporaci&oacute;n de Asistencia Judicial Regi&oacute;n Metropolitana', '008', 0);
INSERT INTO sgs_entidades VALUES (166, 11, 'Corporaci&oacute;n de Asistencia Judicial Regi&oacute;n Valpara&iacute;so', '009', 0);
INSERT INTO sgs_entidades VALUES (167, 11, 'Corporaci&oacute;n de Asistencia Judicial Regiones Tarapac&aacute; y Antofagasta', '010', 0);
INSERT INTO sgs_entidades VALUES (168, 11, 'Corporaci&oacute;n de Asistencia Judicial Regi&oacute;n B&iacute;o-b&iacute;o', '011', 0);
INSERT INTO sgs_entidades VALUES (169, 12, 'Subsecretar&iacute;a del Trabajo', '001', 0);
INSERT INTO sgs_entidades VALUES (170, 12, 'Subsecretar&iacute;a de Previsi&oacute;n Social', '002', 0);
INSERT INTO sgs_entidades VALUES (171, 12, 'Direcci&oacute;n del Trabajo', '003', 0);
INSERT INTO sgs_entidades VALUES (172, 12, 'Direcci&oacute;n General de Cr&eacute;dito Prendario', '004', 0);
INSERT INTO sgs_entidades VALUES (173, 12, 'Instituto de Previsi&oacute;n Social', '005', 0);
INSERT INTO sgs_entidades VALUES (174, 12, 'Instituto de Seguridad Laboral', '006', 0);
INSERT INTO sgs_entidades VALUES (175, 12, 'Servicio Nacional de Capacitaci&oacute;n y Empleo', '007', 0);
INSERT INTO sgs_entidades VALUES (176, 12, 'Superintendencia de Pensiones', '008', 0);
INSERT INTO sgs_entidades VALUES (177, 12, 'Superintendencia de Seguridad Social', '009', 0);
INSERT INTO sgs_entidades VALUES (178, 13, 'Subsecretar&iacute;a de Obras P&uacute;blicas', '001', 0);
INSERT INTO sgs_entidades VALUES (179, 13, 'Direcci&oacute;n General de Obras P&uacute;blicas', '002', 0);
INSERT INTO sgs_entidades VALUES (180, 13, 'Direcci&oacute;n de Contabilidad y Finanzas', '003', 0);
INSERT INTO sgs_entidades VALUES (181, 13, 'Direcci&oacute;n de Aeropuertos', '004', 0);
INSERT INTO sgs_entidades VALUES (182, 13, 'Direcci&oacute;n de Arquitectura', '005', 0);
INSERT INTO sgs_entidades VALUES (183, 13, 'Direcci&oacute;n General de Aguas', '006', 0);
INSERT INTO sgs_entidades VALUES (184, 13, 'Direcci&oacute;n de Obras Hidr&aacute;ulicas', '007', 0);
INSERT INTO sgs_entidades VALUES (185, 13, 'Direcci&oacute;n de Obras Portuarias', '008', 0);
INSERT INTO sgs_entidades VALUES (186, 13, 'Direcci&oacute;n de Planeamiento', '009', 0);
INSERT INTO sgs_entidades VALUES (187, 13, 'Direcci&oacute;n de Vialidad', '010', 0);
INSERT INTO sgs_entidades VALUES (188, 13, 'Superintendencia de Servicios Sanitarios', '011', 0);
INSERT INTO sgs_entidades VALUES (189, 13, 'Instituto Nacional de Hidr&aacute;ulica', '012', 0);
INSERT INTO sgs_entidades VALUES (190, 14, 'Subsecretar&iacute;a de Transporte', '001', 0);
INSERT INTO sgs_entidades VALUES (191, 14, 'Subsecretar&iacute;a de Telecomunicaciones', '002', 0);
INSERT INTO sgs_entidades VALUES (192, 14, 'Junta de Aeron&aacute;utica Civil', '003', 0);
INSERT INTO sgs_entidades VALUES (193, 16, 'Subsecretar&iacute;a de Salud P&uacute;blica', '001', 0);
INSERT INTO sgs_entidades VALUES (194, 16, 'Subsecretar&iacute;a de Redes Asistenciales', '002', 0);
INSERT INTO sgs_entidades VALUES (195, 16, 'Central de Abastecimiento del Sistema Nacional de Servicios de Salud', '003', 0);
INSERT INTO sgs_entidades VALUES (196, 16, 'Fondo Nacional de Salud (fonasa)', '004', 0);
INSERT INTO sgs_entidades VALUES (197, 16, 'Instituto de Salud P&uacute;blica', '005', 0);
INSERT INTO sgs_entidades VALUES (198, 16, 'Superintendencia de Salud', '006', 0);
INSERT INTO sgs_entidades VALUES (199, 16, 'Servicio de Salud Metropolitano Central', '007', 0);
INSERT INTO sgs_entidades VALUES (200, 16, 'Servicio de Salud Metropolitano Norte', '008', 0);
INSERT INTO sgs_entidades VALUES (201, 16, 'Servicio de Salud Metropolitano Occidente', '009', 0);
INSERT INTO sgs_entidades VALUES (202, 16, 'Servicio de Salud Metropolitano Oriente', '010', 0);
INSERT INTO sgs_entidades VALUES (203, 16, 'Servicio de Salud Metropolitano Sur', '011', 0);
INSERT INTO sgs_entidades VALUES (204, 16, 'Servicio de Salud Metropolitano Sur Oriente', '012', 0);
INSERT INTO sgs_entidades VALUES (205, 16, 'Hospital Padre Hurtado', '013', 0);
INSERT INTO sgs_entidades VALUES (206, 16, 'Centro de Referencia de Salud de Peñalol&eacute;n Cordillera Oriente', '014', 0);
INSERT INTO sgs_entidades VALUES (207, 16, 'Centro de Referencia de Salud de Maip&uacute;', '015', 0);
INSERT INTO sgs_entidades VALUES (208, 16, 'Servicio de Salud Arica', '016', 0);
INSERT INTO sgs_entidades VALUES (209, 16, 'Servicio de Salud Iquique', '017', 0);
INSERT INTO sgs_entidades VALUES (210, 16, 'Servicio de Salud Antofagasta', '018', 0);
INSERT INTO sgs_entidades VALUES (211, 16, 'Servicio de Salud Atacama', '019', 0);
INSERT INTO sgs_entidades VALUES (212, 16, 'Servicio de Salud Coquimbo', '020', 0);
INSERT INTO sgs_entidades VALUES (213, 16, 'Servicio de Salud Aconcagua', '021', 0);
INSERT INTO sgs_entidades VALUES (214, 16, 'Servicio de Salud Valpara&iacute;so - San Antonio', '022', 0);
INSERT INTO sgs_entidades VALUES (215, 16, 'Servicio de Salud Viña del Mar - Quillota', '023', 0);
INSERT INTO sgs_entidades VALUES (216, 16, 'Servicio de Salud O´Higgins', '024', 0);
INSERT INTO sgs_entidades VALUES (217, 16, 'Servicio de Salud Maule', '025', 0);
INSERT INTO sgs_entidades VALUES (218, 16, 'Servicio de Salud Ñuble', '026', 0);
INSERT INTO sgs_entidades VALUES (219, 16, 'Servicio de Salud Concepci&oacute;n', '027', 0);
INSERT INTO sgs_entidades VALUES (220, 16, 'Servicio de Salud Talcahuano', '028', 0);
INSERT INTO sgs_entidades VALUES (221, 16, 'Servicio de Salud B&iacute;o-b&iacute;o', '029', 0);
INSERT INTO sgs_entidades VALUES (222, 16, 'Servicio de Salud Arauco', '030', 0);
INSERT INTO sgs_entidades VALUES (223, 16, 'Servicio de Salud Araucan&iacute;a Norte', '031', 0);
INSERT INTO sgs_entidades VALUES (224, 16, 'Servicio de Salud Araucan&iacute;a Sur', '032', 0);
INSERT INTO sgs_entidades VALUES (225, 16, 'Servicio de Salud Valdivia', '033', 0);
INSERT INTO sgs_entidades VALUES (226, 16, 'Servicio de Salud Osorno', '034', 0);
INSERT INTO sgs_entidades VALUES (227, 16, 'Servicio de Salud de Chilo&eacute;', '035', 0);
INSERT INTO sgs_entidades VALUES (228, 16, 'Servicio de Salud Ays&eacute;n', '036', 0);
INSERT INTO sgs_entidades VALUES (229, 16, 'Servicio de Salud del Reloncav&iacute;', '037', 0);
INSERT INTO sgs_entidades VALUES (230, 16, 'Servicio de Salud Magallanes', '038', 0);
INSERT INTO sgs_entidades VALUES (231, 17, 'Subsecretar&iacute;a de Vivienda y Urbanismo', '001', 0);
INSERT INTO sgs_entidades VALUES (232, 17, 'Serviu I Regi&oacute;n', '002', 0);
INSERT INTO sgs_entidades VALUES (233, 17, 'Serviu II Regi&oacute;n', '003', 0);
INSERT INTO sgs_entidades VALUES (234, 17, 'Serviu III Regi&oacute;n', '004', 0);
INSERT INTO sgs_entidades VALUES (235, 17, 'Serviu IV Regi&oacute;n', '005', 0);
INSERT INTO sgs_entidades VALUES (236, 17, 'Serviu V Regi&oacute;n', '006', 0);
INSERT INTO sgs_entidades VALUES (237, 17, 'Serviu Rm', '007', 0);
INSERT INTO sgs_entidades VALUES (238, 17, 'Serviu VI Regi&oacute;n', '008', 0);
INSERT INTO sgs_entidades VALUES (239, 17, 'Serviu VII Regi&oacute;n', '009', 0);
INSERT INTO sgs_entidades VALUES (240, 17, 'Serviu VIII Regi&oacute;n', '010', 0);
INSERT INTO sgs_entidades VALUES (241, 17, 'Serviu IX Regi&oacute;n', '011', 0);
INSERT INTO sgs_entidades VALUES (242, 17, 'Serviu X Regi&oacute;n', '012', 0);
INSERT INTO sgs_entidades VALUES (243, 17, 'Serviu XI Regi&oacute;n', '013', 0);
INSERT INTO sgs_entidades VALUES (244, 17, 'Serviu XII Regi&oacute;n', '014', 0);
INSERT INTO sgs_entidades VALUES (245, 17, 'Serviu Regi&oacute;n de Los R&iacute;os', '015', 0);
INSERT INTO sgs_entidades VALUES (246, 17, 'Serviu Arica y Parinacota', '016', 0);
INSERT INTO sgs_entidades VALUES (247, 17, 'Parque Metropolitano de Santiago', '017', 0);
INSERT INTO sgs_entidades VALUES (248, 18, 'Subsecretar&iacute;a de Bienes Nacionales', '001', 0);
INSERT INTO sgs_entidades VALUES (249, 19, 'Subsecretar&iacute;a de Agricultura', '001', 0);
INSERT INTO sgs_entidades VALUES (250, 19, 'Comisi&oacute;n Nacional de Riego (cnr)', '002', 0);
INSERT INTO sgs_entidades VALUES (251, 19, 'Corporaci&oacute;n Nacional Forestal (conaf)', '003', 0);
INSERT INTO sgs_entidades VALUES (252, 19, 'Instituto de Desarrollo Agropecuario(indap)', '004', 0);
INSERT INTO sgs_entidades VALUES (253, 19, 'Oficinas de Estudios y Pol&iacute;ticas Agrarias (odepa)', '005', 0);
INSERT INTO sgs_entidades VALUES (254, 19, 'Servicio Agr&iacute;cola y Ganadero (sag)', '006', 0);
INSERT INTO sgs_entidades VALUES (255, 20, 'Subsecretar&iacute;a de Miner&iacute;a', '001', 0);
INSERT INTO sgs_entidades VALUES (256, 20, 'Comisi&oacute;n Chilena del Cobre', '002', 0);
INSERT INTO sgs_entidades VALUES (257, 20, 'Comisi&oacute;n Chilena de Energ&iacute;a Nuclear', '003', 0);
INSERT INTO sgs_entidades VALUES (258, 20, 'Servicio Nacional de Geolog&iacute;a y Miner&iacute;a', '004', 0);
INSERT INTO sgs_entidades VALUES (259, 21, 'Servicio Nacional de la Mujer', '001', 0);
INSERT INTO sgs_entidades VALUES (260, 22, 'Comisi&oacute;n Nacional de Energ&iacute;a', '001', 0);
INSERT INTO sgs_entidades VALUES (261, 23, 'Consejo Nacional de la Cultura y las Artes', '001', 0);
INSERT INTO sgs_entidades VALUES (262, 24, 'Comisi&oacute;n Nacional del Medio Ambiente', '001', 0);
INSERT INTO sgs_entidades VALUES (263, 25, 'Consejo de Defensa del Estado', '001', 0);
INSERT INTO sgs_entidades VALUES (264, 8, 'CORFO - Sistemas de Empresas P&uacute;blicas (SEP)', '011', 1);
INSERT INTO sgs_entidades VALUES (265, 16, 'Secretar&iacute;a Regional Ministerial de Arica y Parinacota', '039', 2);
INSERT INTO sgs_entidades VALUES (266, 16, 'Secretar&iacute;a Regional Ministerial de Tarapac&aacute;', '040', 3);
INSERT INTO sgs_entidades VALUES (267, 16, 'Secretar&iacute;a Regional Ministerial de Antofagasta', '041', 4);
INSERT INTO sgs_entidades VALUES (268, 16, 'Secretar&iacute;a Regional Ministerial de Atacama', '042', 5);
INSERT INTO sgs_entidades VALUES (269, 16, 'Secretar&iacute;a Regional Ministerial de Coquimbo', '043', 6);
INSERT INTO sgs_entidades VALUES (270, 16, 'Secretar&iacute;a Regional Ministerial de Valpara&iacute;so', '044', 7);
INSERT INTO sgs_entidades VALUES (271, 16, 'Secretar&iacute;a Regional Ministerial Metropolitano de Santiago', '045', 8);
INSERT INTO sgs_entidades VALUES (272, 16, 'Secretar&iacute;a Regional Ministerial de O´Higgins', '046', 9);
INSERT INTO sgs_entidades VALUES (273, 10, 'Secretar&iacute;a Regional Ministerial del Maule', '047', 10);
INSERT INTO sgs_entidades VALUES (274, 16, 'Secretar&iacute;a Regional Ministerial del B&iacute;o-B&iacute;o', '048', 11);
INSERT INTO sgs_entidades VALUES (275, 16, 'Secretar&iacute;a Regional Ministerial de La Araucan&iacute;a', '049', 12);
INSERT INTO sgs_entidades VALUES (276, 16, 'Secretar&iacute;a Regional Ministerial de Los R&iacute;os', '050', 13);
INSERT INTO sgs_entidades VALUES (277, 16, 'Secretar&iacute;a Regional Ministerial de Los Lagos', '051', 14);
INSERT INTO sgs_entidades VALUES (278, 16, 'Secretar&iacute;a Regional Ministerial de Ays&eacute;n', '052', 15);
INSERT INTO sgs_entidades VALUES (279, 16, 'Secretar&iacute;a Regional Ministerial de Magallanes y Ant&aacute;rtica Chilena', '053', 16);
INSERT INTO sgs_entidades VALUES (280, 26, 'Instituto Nacional de Propiedad Intelectual (INAPI)', '001', 17);
INSERT INTO sgs_entidades VALUES (281, 27, 'Consejo Nacional de Acreditaci&oacute;n', '001', 18);

#
# Volcar la base de datos para la tabla `sgs_estado_solicitudes`
#
truncate table  sgs_estado_solicitudes;
INSERT INTO sgs_estado_solicitudes VALUES (1, 'Ingresada', 1, 1003, '', '', '', 2, 'En Proceso', '');
INSERT INTO sgs_estado_solicitudes VALUES (2, 'Ingresada', 1, 1003, '', '', '', 3, 'En Proceso', '');
INSERT INTO sgs_estado_solicitudes VALUES (3, 'En Proceso', 3, 1003, '', '', '', 4, 'En Proceso', '');
INSERT INTO sgs_estado_solicitudes VALUES (4, 'Asignada', 3, 1003, '', '', '', 5, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (5, 'Pendiente de rectificaci&oacute;n', 3, 1003, '', '', '', 6, 'En proceso', '');
INSERT INTO sgs_estado_solicitudes VALUES (6, 'An&aacute;lisis de competencia', 3, 5, '', '', '', 7, 'En proceso', '');
INSERT INTO sgs_estado_solicitudes VALUES (7, 'Verificaci&oacute;n de disponibilidad', 3, 5, '', '', '', 8, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (8, 'An&aacute;lisis de reserva/secreto', 3, 5, '', '', '', 9, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (9, 'Consulta a terceros', 3, 5, '', '', '', 10, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (10, 'Verificaci&oacute;n de medios de reproducci&oacute;n', 3, 5, '', '', '', 11, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (11, 'Verificaci&oacute;n de costos', 3, 5, '', '', '', 12, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (12, 'Respuesta requiere pr&oacute;rroga', 3, 5, '', '', '', 13, 'En proceso', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (13, 'Finalizada', 13, 5, '', '', '', 14, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (14, 'Respondida: Pago pendiente', 13, 5, '', '', '', 15, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (15, 'Respondida: Retiro pendiente', 13, 5, '', '', '', 16, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (16, 'Finalizada: Entregada', 13, 5, '', '', '', 17, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (17, 'Finalizada: Acceso parcial', 13, 5, '', '', '', 18, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (18, 'Finalizada: Informaci&oacute;n permanentemente disponible', 13, 5, '', '', '', 19, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (19, 'Finalizada: No corresponde a solicitud transparencia', 13, 5, '', '', '', 20, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (20, 'Finalizada: No identifica &oacute;rgano competente', 13, 5, '', '', '', 21, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (21, 'Finalizada: Denegaci&oacute;n por no disponibilidad', 13, 5, '', '', '', 22, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (22, 'Finalizada: Denegaci&oacute;n por reserva/secreto', 13, 5, '', '', '', 24, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (23, 'Finalizada: Desistida por no rectificaci&oacute;n', 13, 5, '', '', '', 1, 'Respondida', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (24, 'Finalizada: Derivada', 13, 5, '', '', '', 25, 'Derivada', NULL);
INSERT INTO sgs_estado_solicitudes VALUES (25, 'Pr&oacute;rroga', 0, 0, '', '', '', 26, NULL, NULL);


#
# Volcar la base de datos para la tabla `sgs_forma_recepcion`
#


#
# Volcar la base de datos para la tabla `sgs_formato_entrega`
#
truncate table  sgs_formato_entrega;
INSERT INTO sgs_formato_entrega VALUES (1, 'Copia en papel', 2);
INSERT INTO sgs_formato_entrega VALUES (2, 'Formato electr&oacute;nico o digital', 1);

#
# Volcar la base de datos para la tabla `sgs_responsable`
#


#
# Volcar la base de datos para la tabla `sgs_sub_estado_solicitudes`
#
truncate table  sgs_sub_estado_solicitudes;
INSERT INTO sgs_sub_estado_solicitudes VALUES (1, 1, 'Asignada', 1);
INSERT INTO sgs_sub_estado_solicitudes VALUES (2, 1, 'No asignada', 2);
INSERT INTO sgs_sub_estado_solicitudes VALUES (3, 2, 'An&aacute;lisis de admisibilidad', 3);
INSERT INTO sgs_sub_estado_solicitudes VALUES (4, 2, 'An&aacute;lisis de competencia', 4);
INSERT INTO sgs_sub_estado_solicitudes VALUES (5, 2, 'Verificaci&oacute;n de disponibilidad', 5);
INSERT INTO sgs_sub_estado_solicitudes VALUES (6, 2, 'An&aacute;lisis de reserva o secreto', 6);
INSERT INTO sgs_sub_estado_solicitudes VALUES (7, 2, 'Consulta a terceros', 7);
INSERT INTO sgs_sub_estado_solicitudes VALUES (8, 2, 'Verificaci&oacute;n de medios de reproducci&oacute;n', 8);
INSERT INTO sgs_sub_estado_solicitudes VALUES (9, 4, 'Solicita rectificaci&oacute;n', 9);
INSERT INTO sgs_sub_estado_solicitudes VALUES (10, 4, 'Denegaci&oacute;n por forma', 10);
INSERT INTO sgs_sub_estado_solicitudes VALUES (11, 4, 'Derivaci&oacute;n a SSPP', 11);
INSERT INTO sgs_sub_estado_solicitudes VALUES (12, 4, 'Denegaci&oacute;n por competencia', 12);
INSERT INTO sgs_sub_estado_solicitudes VALUES (13, 4, 'Denegaci&oacute;n por disponibilidad', 13);
INSERT INTO sgs_sub_estado_solicitudes VALUES (14, 4, 'Denegacion por reserva o secreto', 14);
INSERT INTO sgs_sub_estado_solicitudes VALUES (15, 4, 'Denegaci&oacute;n por oposici&oacute;n de terceros', 15);
INSERT INTO sgs_sub_estado_solicitudes VALUES (16, 4, 'Respuesta tiene costos', 16);
INSERT INTO sgs_sub_estado_solicitudes VALUES (17, 4, 'Respuesta requiere pr&oacute;rroga', 17);
INSERT INTO sgs_sub_estado_solicitudes VALUES (18, 3, 'Conforme - Gratuito', 18);
INSERT INTO sgs_sub_estado_solicitudes VALUES (19, 3, 'Conforme - pagado', 19);
INSERT INTO sgs_sub_estado_solicitudes VALUES (20, 3, 'Cobro pendiente', 20);
INSERT INTO sgs_sub_estado_solicitudes VALUES (21, 3, 'Costo rechazado por usuario', 21);
INSERT INTO sgs_sub_estado_solicitudes VALUES (22, 7, 'Con reserva / secreto', 22);
INSERT INTO sgs_sub_estado_solicitudes VALUES (23, 7, 'Sin reserva / secreto (Normal)', 23);

#
# Volcar la base de datos para la tabla `sgs_tramos`
#
truncate table  sgs_tramos;
INSERT INTO sgs_tramos VALUES (1, 'Más de 10', '11,mayor', 'Tienen más de 10 días de plazo');
INSERT INTO sgs_tramos VALUES (2, '6-10', '6,10', 'Tienen entre 6 y 10 días');
INSERT INTO sgs_tramos VALUES (3, '1-5', '1,5', 'Tienen entre 1 y 5 días');
INSERT INTO sgs_tramos VALUES (4, '0-(-4)', '-4,0', 'Han vencido hace menos de cinco días.');
INSERT INTO sgs_tramos VALUES (5, 'Más de (-5)', '-6,menor', 'Han vencido hace más de 5 días.');



#
# Volcar la base de datos para la tabla `soporte`
#
truncate table  soporte;
INSERT INTO soporte VALUES (1, 7, 7, 2, 3, '2008-03-18', '2008-03-18', 'ewrwqe', 'rweqrwqe', 'rweqrweq', 'rweqr', 0, '4', '2', '3', '2');
INSERT INTO soporte VALUES (2, 7, 7, 4, 3, '2008-03-25', '2008-03-26', '', '', '', '', 0, '', '', '', '');

#
# Volcar la base de datos para la tabla `sucursal`
#


#
# Volcar la base de datos para la tabla `tab_busqueda`
#
truncate table  tab_busqueda;

INSERT INTO tab_busqueda VALUES ('acciones', '901');

#
# Volcar la base de datos para la tabla `tab_camp`
#
truncate table  tab_camp;
INSERT INTO tab_camp VALUES ('acciones', 'descrip_php_esp');

#
# Volcar la base de datos para la tabla `templates_acciones`
#
truncate table  templates_acciones;
INSERT INTO templates_acciones VALUES (48, 'texto_de_fin_activacion_nuevo_email', '<p>Gracias hemos cambiado su cuenta</p>', 43);
INSERT INTO templates_acciones VALUES (43, 'texto_de_cambio_email1', '<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">\r\n    <tbody>\r\n        <tr>\r\n            <td align="center">\r\n            <p><strong>Estimado(a): #USUARIO#</strong><br />\r\n            <br />\r\n            <br />\r\n            El Sistema de Gesti&oacute;n de Solicitudes de:</p>\r\n            #SERVICIO#\r\n            <p>&nbsp;</p>\r\n            <p>ha enviado un mensaje a la cuenta <strong>#EMAIL_ACTUAL#</strong>, <br />\r\n            pidiendo autorizaci&oacute;n para modificar su direcci&oacute;n de correo electr&oacute;nico por:  <strong>#NUEVO_EMAIL#</strong>.</p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 38);
INSERT INTO templates_acciones VALUES (2, 'formulario_olvido', '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cuadro_light">\r\n<tr><td class="textos" align="center">&nbsp; </td></tr> \r\n				<tr><td class="textos" align="center">&nbsp; </td></tr> \r\n				<tr><td class="textos" align="center">\r\n				  <span class="categoria_p">Ingrese su email por favor:</span></td></tr> \r\n				<tr>\r\n                  \r\n    <td class="textos_bold" align="center"> #MAIL# #BOTON#</td>\r\n                </tr>\r\n\r\n				<tr><td class="textos" align="center">&nbsp; </td></tr> \r\n</table>', 2);
INSERT INTO templates_acciones VALUES (3, 'formulario_registro', '<h4>Registro</h4>\r\n<p align="justify">Para registrarse en este sistema complete el siguiente formulario y presione el bot&oacute;n &quot;Registrarse&quot;. A continuaci&oacute;n recibir&aacute; un correo electr&oacute;nico con indicaciones para verificar la validez de los datos proporcionados y activar su cuenta.</p>\r\n<div class="mensaje" id="mensaje">Los campos indicados con (*) son obligatorios</div>\r\n<fieldset>\r\n<legend>Datos personales</legend>\r\n<br />\r\n<label>Tipo de persona</label> <br />\r\n&nbsp; #TIPO_PERSONA# <br />\r\n<div class="showhide" id="cdiv0"><label>Nombres</label> *<br />\r\n#NOMBRES# (Ej. Francisco)<br />\r\n<label>Apellido paterno</label>\r\n *<br />\r\n#PATERNO# (Ej. Maldonado)<br />\r\n<label>Apellido materno</label>\r\n *<br />\r\n#MATERNO# (Ej. Soto)<br />\r\n<label>Apoderado</label>\r\n<br />\r\n#APODERADO_NATURAL#</div>\r\n<div class="showhide" id="cdiv1">\r\n  <label>Raz&oacute;n social</label>\r\n   *<br />\r\n#RAZON_SOCIAL# <br />\r\n<label>Apoderado</label> *<br />\r\n#APODERADO#</div>\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset><legend>Domicilio</legend>\r\n<table class="tabla_nb" cellspacing="0" cellpadding="0" width="99%" align="left" border="0">\r\n  <tbody>\r\n    <tr>\r\n      <td align="left"><label>Direcci&oacute;n *</label>\r\n      </td>\r\n      <td colspan="3" align="left">#DIRECCION# \r\n        &nbsp;\r\n                    <label>N&uacute;mero* </label>\r\n        #NUMERO#\r\n        <label> &nbsp;&nbsp;&nbsp;Departamento </label>\r\n        #DEPTO# </td>\r\n    </tr>\r\n    <tr>\r\n      <td align="left"><label>Ciudad *</label>\r\n      </td>\r\n      <td align="left">#CIUDAD#</td>\r\n      <td align="left">&nbsp;</td>\r\n      <td align="left">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td width="17%" align="left"><label>Regi&oacute;n  *</label>\r\n      </td>\r\n      <td width="34%" align="left">#REGION#</td>\r\n      <td width="17%" align="left"><label> Comuna *</label></td>\r\n      <td width="32%" align="left">#COMUNA#</td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n<label></label>\r\n\r\n</label>\r\n</label>\r\n</fieldset>\r\n<p><br />\r\n</p>\r\n<fieldset>\r\n<legend>Datos de ingreso al sistema</legend>\r\n<br />\r\n<label>Direcci&oacute;n de correo electr&oacute;nico</label> *<br />\r\n#MAIL# (fmerino@economia.gov.cl)<br />\r\n<label>Contrase&ntilde;a *</label> <br />\r\n#CONTRASENIA# M&iacute;nimo 6 caracteres.<br />\r\n<label>Confirme contrase&ntilde;a *</label> <br />\r\n#CONTRASENIA2# <br />\r\n<label /></fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset><legend>Datos estad&iacute;sticos (opcionales)</legend><br />\r\n\r\n<label>RUT / RUN</label> \r\n#RUT# (Ej. 12.345.678-9) <br>\r\n<label>Nacionalidad </label>\r\n#NACIONALIDAD# <br><br>\r\n<label>\r\nTel&eacute;fono de contacto</label>\r\n<br>\r\n#CODIGO# -#TELEFONO#\r\n<label>\r\n(Ej. 562-456 78 90)\r\n\r\n<br>\r\n<br>\r\n<label>Sexo </label>\r\n#SEXO# <br />\r\n\r\n<label>Edad</label> #RANGO_EDAD#<br /><br />\r\n<label>Ocupaci&oacute;n </label>\r\n#OCUPACION# <br />\r\n\r\n<label>Nivel educacional </label>\r\n#NIVEL_EDUCACIONAL#<br />\r\n\r\n<br>\r\n<label>Tipo de organizaci&oacute;n en la que participa</label>\r\n #ORGANIZACION_SINDICAL# <br />\r\n<label>Frecuencia</label> #FRECUENCIA# \r\n<br>\r\n<br>\r\n</fieldset>\r\n<div align="center">#CAPTCHA#</div>\r\n<div align="center"><input class="botones" id="Registrarse" type="submit" name="Registrarse" value="Registrarse" /></div>\r\n<div>&nbsp;</div>', 3);
INSERT INTO templates_acciones VALUES (55, 'contenedor_listado_admin_solicitudes', '<table cellspacing="0" cellpadding="0" width="98%" border="0">\r\n    <tbody>\r\n        <tr>\r\n          <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">\r\n                      \r\n            <table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n              <tr>\r\n                <td><div align="center"><strong>Panel de Gesti&oacute;n de Solicitudes</strong></div></td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td><div align="center">#MENSAJE_SIN_ASIGNAR#</div></td>\r\n              </tr>\r\n              <tr>\r\n                <td><div align="center"><strong>#LINK_SOLICITUDES_SIN_ASIGNAR#</strong></div></td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td><div align="center">Buscar por N&ordm; de solicitud:\r\n                    <input id="buscar" name="buscar" type="text" />\r\n                  <input id="buscar2" type="submit" name="buscar2" value="Buscar..." />\r\n                </div></td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td><strong>Bandeja de Solicitudes</strong></td>\r\n              </tr>\r\n              <tr>\r\n                <td><strong>Estado:</strong> #FILTROS#&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tipo</strong>:#TIPO#&nbsp;&nbsp;&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td align="left"><strong>Responsable:</strong>#RESPONSABLE#&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.form1.ms.value=1;document.form1.submit();">Mis Solicitudes (#TOT_MIS_SOLICITUDES#)\r\n                  <input name="ms" type="hidden" id="ms" value="0" />\r\n                </a></td>\r\n              </tr>\r\n              <tr>\r\n                <td align="left">&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td  valign="top">  <div class="wide" id="table-block">\r\n              <table cellspacing="0" cellpadding="0">\r\n                <tbody>\r\n                    <tr class="header2">\r\n                        <td width="15%">N&ordm; de Solicitud</td>\r\n                        <td width="20%">Fecha  Solicitud</td>\r\n                      <td width="20%">Fecha T&eacute;rmino  Solicitud</td>\r\n                        <td width="20%">Plazo</td>\r\n                        <td width="23%">Etapa</td>\r\n                        <td width="23%">Estado</td>\r\n                        <td width="14%">Ver</td>\r\n                    </tr>\r\n                    #LISTA_ADMINISTRACION_SOLICITUDES#\r\n                </tbody>\r\n            </table>\r\n            </div></td>\r\n              </tr>\r\n            </table>\r\n            <br />\r\n            <div align="center"><br />\r\n            <br />\r\n            #PAGINACION#</div>            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n', 50);
INSERT INTO templates_acciones VALUES (90, 'estado_glosa_responsable', 'Procesar', 84);
INSERT INTO templates_acciones VALUES (57, 'registros_por_pagina', '2', 52);
INSERT INTO templates_acciones VALUES (21, 'olvido_pass', '<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td width="10">\r\n            \r\n            </td>\r\n        </tr>\r\n        <tr>\r\n          <td valign="top"><h3>¿Olvid&oacute; su contrase&ntilde;a?</h3></td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td class="registro" valign="top">Ingrese su correo electr&oacute;nico para recuperar&nbsp;contrase&ntilde;a.</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">\r\n            <table cellspacing="0" cellpadding="5" width="400" align="center" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td class="registro"><input class="campos2" id="mail" size="40" name="mail" type="text" /></td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                          <div align="center"><img id="boton" style="cursor: hand" height="30" alt="" width="86" name="boton" onClick="document.form1.submit();" src="images/btn_enviar.jpg" /></div></td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 16);
INSERT INTO templates_acciones VALUES (22, 'mensaje_contacto', '<h3>Contacto:</h3>\r\n<p>&nbsp;</p>', 17);
INSERT INTO templates_acciones VALUES (26, 'mensaje_error_pass', '<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n        <tbody>\r\n            <tr>\r\n                <td >\r\n                <table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n                    <tbody>\r\n                        <tr>\r\n                            <td><h3>¿Olvid&oacute; su contrase&ntilde;a?</h3></td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n                </td>\r\n            </tr>\r\n            <tr>\r\n                <td valign="top"><img height="10" width="10" alt="" src="images/espacio.gif" /></td>\r\n            </tr>\r\n            <tr>\r\n                <td class="registro" valign="top">\r\n                </td>\r\n            </tr>\r\n            <tr>\r\n                <td valign="top"><img height="10" width="10" alt="" src="images/espacio.gif" /></td>\r\n            </tr>\r\n            <tr>\r\n                <td valign="top">\r\n                <table cellspacing="0" cellpadding="5" width="400" align="center" border="0">\r\n                    <tbody>\r\n                        <tr>\r\n                            <td class="registro">Este correo eletr&oacute;nico no existe en nuestros registros</td>\r\n                          \r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan="2">\r\n                            <div align="right">\r\n                            <img style="cursor: hand" src="images/btn_enviar.jpg" alt="" name="boton" width="86" height="30" id="boton" onclick="document.form1.submit();" /></div>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>', 21);
INSERT INTO templates_acciones VALUES (29, 'contenido_vacio', '#CONTENIDO#', 24);
INSERT INTO templates_acciones VALUES (39, 'login', '<table width="270" cellspacing="0" cellpadding="0" border="0" background="images/sitio/sgs/images/login_top.gif">\r\n    <tbody>\r\n        <tr>\r\n            <td width="10">&nbsp;</td>\r\n            <td width="250" class="top_caja">Acceso Usuarios Registrados</td>\r\n            <td width="10"><img height="32" width="10" alt="" src="images/sitio/sgs/images/login_top.gif" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" class="top_caja_texto" colspan="3">Si ya est&aacute; registrado ingrese su nombre de usuario y contrase&ntilde;a.</td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" colspan="3">\r\n            <form id="form_login" action="?accion=login" method="post" name="form_login">\r\n                <table width="90%" cellspacing="0" cellpadding="0" border="0">\r\n                    <tbody>\r\n                        <tr>\r\n                            <td class="top_caja_texto">Usuario</td>\r\n                            <td><input type="text" id="login" size="15" name="login" /></td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class="top_caja_texto">Contrase&ntilde;a</td>\r\n                            <td><input type="password" id="password" size="15" name="password" /></td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class="top_caja_texto" colspan="2"><label>                             </label>\r\n                            <div align="center"><input type="submit" id="Ingresar" name="Ingresar" value="Ingresar" /></div>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n            </form>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" colspan="3">\r\n            <div align="center" class="top_caja_texto"><a href="?accion=olvido">&iquest;Olvid&oacute; su contrase&ntilde;a?</a></div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" colspan="3">&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n<table width="270" cellspacing="0" cellpadding="0" border="0" background="images/sitio/sgs/images/login_top.gif">\r\n    <tbody>\r\n        <tr>\r\n            <td width="10">&nbsp;</td>\r\n            <td width="250" class="top_caja">Registro de Usuarios</td>\r\n            <td width="10"><img height="32" width="10" alt="" src="images/sitio/sgs/images/login_top.gif" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" class="top_caja_texto" colspan="3">\r\n            <p>Para realizar una solicitud de acceso a la informaci&oacute;n p&uacute;blica debe registrarse.</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" colspan="3">\r\n            <div align="center" class="top_caja_texto"><a href="?accion=Registro">Deseo registrarme ahora</a></div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor="#edf1f5" colspan="3">\r\n            <p>&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</p>', 34);
INSERT INTO templates_acciones VALUES (40, 'ficha_usuario2', '<table class="cuadro" height="132" cellspacing="0" cellpadding="0" width="196" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td class="textos_blanco" align="left">\r\n            <table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td class="textos_blanco" align="left"><strong>Bienvenido Don(a)</strong></td>\r\n                        <td class="textos_blanco" align="right"><img style="cursor: pointer" alt="Mi Carro" border="0" onclick="ObtenerDatos(\'?accion=tienda&amp;apos;amp;apos;act=&amp;apos;amp;apos;id_productos=$id_productos&amp;apos;amp;apos;axj=1\',\'contenido\');" src="images/shopcart.gif" /></td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td class="textos_blanco" align="left"><strong>#USUARIO# </strong></td>\r\n        </tr>\r\n        <tr>\r\n            <td class="textos_blanco" align="left">#INDICADORES#</td>\r\n        </tr>\r\n        <tr>\r\n            <td class="textos_blanco" align="left">Fecha: #DATE#</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td class="textos_blanco" style="background-color: #ebebeb" align="center" onmouseout="this.style.backgroundColor=\'#EBEBEB\'" onmouseover="this.style.backgroundColor=\'#F8F8F8\'"><a href="index.php?accion=mis_datos"><strong>Mis Datos</strong></a></td>\r\n                        <td class="textos_blanco" style="background-color: #ebebeb" align="center" onmouseout="this.style.backgroundColor=\'#EBEBEB\'" onmouseover="this.style.backgroundColor=\'#F8F8F8\'"><a href="index.php?accion=salir"><strong>Salir</strong></a></td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 35);
INSERT INTO templates_acciones VALUES (41, 'formulario_registro_edicion', '<h3>Mis Datos</h3>\r\n<p align="justify">Para actualizar sus datos en el sistema utilice el siguiente formulario, y presione el bot&oacute;n &quot;Actualizar Datos&quot;. A continuaci&oacute;n recibir&aacute; un correo electr&oacute;nico con indicaciones para verificar la validez de los datos proporcionados y modificar su cuenta.</p>\r\n<div class="mensaje" id="mensaje">Los campos indicados con (*) son obligatorios</div>\r\n<fieldset>               <legend>Datos Personales</legend>                              \r\n<br />\r\n<label>Nombres</label> *<br />\r\n#NOMBRES# <br />\r\n<label>Apellido paterno</label>  *<br />\r\n#PATERNO# <br />\r\n<label>Apellido materno</label>  *<br />\r\n#MATERNO#  \r\n<br />  \r\n<label>Apoderado</label>\r\n<br />\r\n#APODERADO# <br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>              <legend> Domicilio</legend>                           \r\n<table class="tabla_nb" cellspacing="0" cellpadding="0" width="99%" align="left" border="0">\r\n<tbody>\r\n        \r\n        <tr>\r\n          <td align="left"><label>Direcci&oacute;n *</label>\r\n</td>\r\n          <td colspan="3" align="left">#DIRECCION# \r\n            &nbsp;\r\n            <label>N&uacute;mero*  </label>#NUMERO#\r\n            <label>  &nbsp;&nbsp;&nbsp;Departamento </label>\r\n#DEPTO# </td>\r\n        </tr>\r\n        <tr>\r\n          <td align="left"><label>Ciudad *</label>\r\n</td>\r\n          <td align="left">#CIUDAD#</td>\r\n          <td align="left">&nbsp;</td>\r\n          <td align="left">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td width="17%" align="left"><label>Regi&oacute;n  *</label>      </td>\r\n            <td width="34%" align="left">#REGION#</td>\r\n          <td width="17%" align="left"><label> Comuna *</label></td>\r\n          <td width="32%" align="left">#COMUNA#</td>\r\n    </tr>\r\n    </tbody>\r\n</table>\r\n<br />\r\n<br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Datos de ingreso al sistema</legend>               <br />\r\n<label>               Direcci&oacute;n de correo electr&oacute;nico</label>  <strong>#MAIL#</strong> <a href="index.php?accion=Actualiza-email">Actualizar correo electr&oacute;nico</a>               <br />\r\n<br />\r\n<label><strong>Solo si desea cambiar su contrase&ntilde;a</strong></label> <br />\r\n<label>Contrase&ntilde;a actual</label>               <br />\r\n#CONTRASENIA_ACTUAL#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Confirme nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA2#               <br />\r\n<br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Datos  estad&iacute;sticos (opcionales)</legend>               <br />\r\n<label>               RUT / RUN</label>               <br />\r\n#RUT#               (Ej. 12.233.456-8)               <br />\r\n<label>               Tel&eacute;fono de contacto</label>               <br />\r\n#CODIGO# -#TELEFONO#(Ej. 562-456 78 90)                 <label><br />\r\n</label>               <hr />\r\n<label>Sexo </label>#SEXO# <label>Edad</label>#RANGO_EDAD# <label><br />\r\nNacionalidad </label>#NACIONALIDAD#                            <hr />\r\n<label>Nivel educacional </label> #NIVEL_EDUCACIONAL# <br />\r\n<label>Ocupaci&oacute;n </label>#OCUPACION#               <hr />\r\n<label>Tipo de organizaci&oacute;n en la que participa</label>                              #ORGANIZACION_SINDICAL#          <br />\r\n<label>               Frecuencia</label> #FRECUENCIA# <br />\r\n</fieldset>\r\n<div align="center">#CAPTCHA#</div>\r\n<div align="center"><input type="submit" value="Actualizar Datos" id="Registrarse" class="botones" name="Registrarse" /></div>', 36);
INSERT INTO templates_acciones VALUES (42, 'formulario_registro_edicion_juridica', '<h3>Mis Datos</h3>\r\n              <p>\r\n  Para actualizar sus datos en el sistema utilice el siguiente formulario, y presione el bot&oacute;n "Actualizar Datos". A continuaci&oacute;n recibir&aacute; un correo electr&oacute;nico con indicaciones para verificar la validez de los datos proporcionados y modificar su cuenta. </p>\r\n              \r\n              <div id="mensaje" class="mensaje"> Los campos indicados con (*) son obligatorios</div>\r\n            \r\n              <fieldset>\r\n              <legend>Identificaci&oacute;n</legend>\r\n              \r\n             \r\n              \r\n<br />\r\n\r\n<label>Raz&oacute;n Social</label> *<br />\r\n#RAZON_SOCIAL# <br />\r\n<label>Apoderado</label> *<br />\r\n#APODERADO#  <br />  \r\n             \r\n               \r\n             \r\n              </fieldset>\r\n             <br />\r\n             <fieldset>\r\n             <legend> Domicilio</legend>\r\n             <label></label>\r\n             <table class="tabla_nb" cellspacing="0" cellpadding="0" width="99%" align="left" border="0">\r\n               <tbody>\r\n                 <tr>\r\n                   <td align="left"><label>Direcci&oacute;n *</label>\r\n                   </td>\r\n                   <td colspan="3" align="left">#DIRECCION# \r\n                     &nbsp;\r\n                <label>N&uacute;mero* </label>\r\n                     #NUMERO#\r\n                     <label> &nbsp;&nbsp;&nbsp;Departamento </label>\r\n                     #DEPTO# </td>\r\n                 </tr>\r\n                 <tr>\r\n                   <td align="left"><label>Ciudad *</label>\r\n                   </td>\r\n                   <td align="left">#CIUDAD#</td>\r\n                   <td align="left">&nbsp;</td>\r\n                   <td align="left">&nbsp;</td>\r\n                 </tr>\r\n                 <tr>\r\n                   <td width="17%" align="left"><label>Regi&oacute;n  *</label>\r\n                   </td>\r\n                   <td width="34%" align="left">#REGION#</td>\r\n                   <td width="17%" align="left"><label> Comuna *</label></td>\r\n                   <td width="32%" align="left">#COMUNA#</td>\r\n                 </tr>\r\n               </tbody>\r\n             </table>\r\n             <br />\r\n<br />\r\n             </fieldset>\r\n             <br />\r\n <br />\r\n              <br />\r\n\r\n\r\n               <fieldset>\r\n              <legend>Datos de Ingreso al sistema</legend>\r\n              <br /><label>\r\n              Direcci&oacute;n de Correo electr&oacute;nico</label> <strong>#MAIL#</strong> <a href="index.php?accion=Actualiza-email">Actualizar E-Mail</a>\r\n              <br /><br />\r\n			  <label><strong>Solo si Desea Cambiar la su Contrase&ntilde;a</strong></label></br>\r\n              <label>Contrase&ntilde;a Actual</label>\r\n              <br />\r\n              #CONTRASENIA_ACTUAL#\r\n              M&iacute;nimo  6 caracteres.<br />\r\n              <label>Nueva Contrase&ntilde;a </label>\r\n              <br />\r\n              #CONTRASENIA#\r\n              M&iacute;nimo  6 caracteres.<br />\r\n              <label>Confirme Nueva Contrase&ntilde;a </label>\r\n              <br />\r\n              #CONTRASENIA2#\r\n              <br />         \r\n              <label></label>\r\n              <br />\r\n              </fieldset>\r\n               <br />\r\n               <br />\r\n\r\n              <fieldset>\r\n              <legend>Datos  estad&iacute;sticos (opcionales)</legend>\r\n              <br /><label>\r\n              RUT / RUN</label>\r\n              <br />\r\n             #RUT#\r\n              (ej: 12.233.456-8)\r\n              <br /><label>\r\n              Tel&eacute;fono de Contacto</label>\r\n              <br />\r\n              #CODIGO# -#TELEFONO#<label></label>(ej: 562-456 78 90) \r\n              <label><br />\r\n              </label>\r\n              <hr />\r\n              <label>Sexo </label>#SEXO# <label>Edad</label>#RANGO_EDAD# <br><label>Nacionalidad </label>#NACIONALIDAD#\r\n            \r\n              <hr />\r\n              \r\n              <label>Nivel Educacional </label>#NIVEL_EDUCACIONAL# <label><br />Ocupaci&oacute;n </label>#OCUPACION#\r\n              <hr />\r\n               <label>Tipo de Organizaci&oacute;n en la que participa</label>\r\n             \r\n              #ORGANIZACION_SINDICAL#\r\n         <br />\r\n              <label>\r\n              Frecuencia</label> #FRECUENCIA#\r\n<br />\r\n              </fieldset>\r\n              \r\n              \r\n              <div align="center">\r\n                <input name="Registrarse" type="submit" class="botones" id="Registrarse" value="Actualizar Datos" />\r\n              </div>\r\n \r\n     \r\n              </div>', 37);
INSERT INTO templates_acciones VALUES (47, 'texto_de_activacion_nuevo_email', '<p><strong>Estimado(a): #USUARIO#</strong><br />\r\n<br />\r\n<br />\r\nMuchas Gracias, ahora debe activar su nueva cuenta de correo y asi finalizar el proceso.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 42);
INSERT INTO templates_acciones VALUES (44, 'texto_mail_envio_solicitud1', '<p><strong>Estimado(a): #USUARIO#</strong><br />\r\n<br />\r\n<br />\r\nSe ha solicitado el cambio de correo de esta cuenta #EMAIL# a la nueva cuenta #NUEVO_EMAIL#, clickee <a href="#URL#">aqu&iacute;</a> para aceptar el cambio.<br />\r\n<br />\r\n<br />\r\nSi no funciona el link copie y pege la siguiente direcci&oacute;n en la url de su navegador<br />\r\n#URL#</p>', 39);
INSERT INTO templates_acciones VALUES (45, 'gracias_registro', '<h3>Registro</h3>\r\n<p>Gracias por registrarse. Para completar el registro se le enviar&aacute; un correo electr&oacute;nico a <strong>#EMAIL#</strong> con indicaciones para activar su cuenta.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n', 40);
INSERT INTO templates_acciones VALUES (66, 'texto_correo_activa_cuenta', '<p><br />\r\nMuchas Gracias por registrarse en el Sistema de Gesti&oacute;n de Solicitudes </p>\r\n<p><br />\r\nSus datos de ingreso son:<br />\r\n<br />\r\nUsuario : <strong>#LOGIN#</strong><br />\r\n<br />\r\nContrase&ntilde;a : <strong>#PASS1#</strong><br />\r\n<br />\r\nPara activar su cuenta haga click <a href="http://#URL#/index.php?sess=xx#SESSION#">Aqu&iacute;</a><br />\r\nO pegue la siguiente url en su navegador http://#URL#/index.php?sess=xx#SESSION#\r\n<br />\r\n</p>', 61);
INSERT INTO templates_acciones VALUES (46, 'gracias_registro_finalizado', '<h3>Registro</h3>\r\n<p>Gracias por registrarse. Su cuenta ha sido activada.</p>\r\n<p>Para ingresar al sistema, utilice su nombre de usuario &nbsp;<strong>#EMAIL#</strong>&nbsp;y su contrase&ntilde;a en el formulario de acceso ubicado en la p&aacute;gina de inicio.</p>', 41);
INSERT INTO templates_acciones VALUES (49, 'texto_mail_envio_fin_actualizacion', '<p>Gracias ha completado el proceso de cambio de mail, su nuevo usuario y email es:<br />\r\n<br />\r\nUsuario : #EMAIL#<br />\r\nEmail: #EMAIL#</p>', 44);
INSERT INTO templates_acciones VALUES (50, 'pantalla_asistencia_solicitud', '<p>Desea que lo asistamos en la <strong>Solicitud de Informaci&oacute;n</strong></p>\r\n<p><br />\r\n<a href="#LINK_SI_GRACIAS#">Si gracias, deseo Asistencia para el formulario</a></p>\r\n<p>&nbsp;</p>\r\n<p><a href="#LINK_NO_GRACIAS#">No gracias, quiero llenar directamente la solicitud</a></p>\r\n<br>\r\n<br>', 45);
INSERT INTO templates_acciones VALUES (51, 'contenedor_preguntas_asistencia_solicitud', '<h3>Solicitud de Acceso</h3>\r\n<p>Para ayudarlo hemos dise&ntilde;ado este asistente que le permitir&aacute; encontrar la informaci&oacute;n que usted busca.</p>\r\n<div id="form-block"><label for="field_1">Pregunta #ACTUAL_PREGUNTAS# de #TOT_PREGUNTAS#</label>\r\n<h3>#PREGUNTAS#</h3>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;<a href="#LINK_FORMULARIO#">Ir al formulario</a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 46);
INSERT INTO templates_acciones VALUES (52, 'formulario_solicitud_informacion', '<h3>Solicitud de Acceso a Informaci&oacute;n P&uacute;blica </h3>\r\n<p><br />\r\n<strong>#SERVICIO#</strong></p>\r\n<p>Los campos indicados con (*) son obligatorios</p>\r\n<fieldset>               <legend>Identificaci&oacute;n del solicitante</legend>                <br />\r\n<label> Nombre completo: \r\n  <strong>#RAZON_SOCIAL#</strong></label> <br />\r\n#APODERADO#               <br />\r\n</fieldset>\r\n<p><br />\r\n</p>\r\n<fieldset>              <legend> Domicilio</legend>                            <br />\r\n<label>Direcci&oacute;n:\r\n  <strong>#DIRECCION#</strong> </label><br />\r\n<label>N&uacute;mero: <strong>#NUMERO#</strong> </label> <label>Departamento:  \r\n <strong>#DEPTO#</strong>  </label>\r\n<br>\r\n<br>\r\n<label>\r\nRegi&oacute;n: \r\n<strong>#REGION#</strong></label><br>\r\n<label>Ciudad\r\n:\r\n <strong>#CIUDAD#</strong></label><br>\r\n<label>Comuna\r\n:\r\n<strong>#COMUNA#</strong></label><br />\r\n<br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Informaci&oacute;n de la solicitud</legend> <br />\r\n<label>Fecha de ingreso:\r\n <strong>#FECHA#</strong> </label><br />\r\n<br />\r\n<label>Nombre de la entidad a la que dirige la solicitud</label>\r\n: #LISTA_ENTIDADES#<br />\r\n<br />\r\n<label>Informaci&oacute;n solicitada. Se&ntilde;ale la materia, fecha de  			  emisi&oacute;n o per&iacute;odo de vigencia del documento, origen o destino, soporte, etc.*:</label>\r\n<p>#IDENTIFICACION_DOCUMENTOS# </p>\r\n<br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Notificaci&oacute;n</legend>               <br />\r\n<label>Deseo ser notificado por correo electr&oacute;nico: </label>#SI#\r\n<label><br />\r\n</label> <br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Forma de recepci&oacute;n de la informaci&oacute;n solicitada</legend>               <br />\r\n<label>Seleccione forma *:</label> #FORMA_RECEPCION#\r\n<br />\r\n<div class="showhide" id="cdiv0"><label>Especificar oficina:</label> #OFICINA#</div>\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n<fieldset>               <legend>Formato de entrega</legend>               <br />\r\n<label>Seleccione formato de entrega: </label> <br />\r\n#FORMATO_ENTREGA#<br />\r\n<br />\r\n              <br />\r\n</fieldset>\r\n<div align="center"><input type="submit" name="Registrarse" class="botones" id="Registrarse" value="Continuar" /></div>', 47);
INSERT INTO templates_acciones VALUES (67, 'asunto_mail_activa_cuenta', 'Activacion de cuenta - Transparencia', 62);
INSERT INTO templates_acciones VALUES (53, 'linea_lista_mis_solicitudes', '<tr>\r\n\r\n<td>#FOLIO#</td>\r\n\r\n<td>#FECHA_CREACION#</td>\r\n<td>#FECHA_TERMINO#</td>\r\n\r\n<td>#DIAS# d&iacute;as</td>\r\n\r\n<td>#ESTADO#</td>\r\n\r\n<td class="actions"><a class="edit" href="#LINK_EDITAR#">VER DETALLE</a></td>\r\n\r\n</tr>', 48);
INSERT INTO templates_acciones VALUES (74, 'formulario_solicitud_papel', '<h3>Solicitud de Acceso a Informaci&oacute;n P&uacute;blica</h3>\r\n<br> <strong>#SERVICIO#</strong>\r\n              <p>Los campos indicados con (*) son obligatorios \r\n  <fieldset><legend>Informaci&oacute;n del formulario</legend>\r\n  <table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n    <tr>\r\n      <td><label>Medio de ingreso</label></td>\r\n      <td>\r\n	  #RADIOS#</td>\r\n    </tr>\r\n    <tr>\r\n      <td width="24%"><label>Folio de formulario</label>\r\n        *     </td>\r\n      <td  align="left">#FOLIO#&nbsp;&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>Ejemplo: AF001P-0000007</td>\r\n    </tr>\r\n    <tr>\r\n      <td><label>Fecha del formulario </label>\r\n* </td>\r\n      <td>#FECHA_INGRESO#</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>(Ingrese la fecha que figura en el formulario DD-MM-AAAA)</td>\r\n    </tr>\r\n  </table>\r\n  <br />\r\n  </fieldset>\r\n<fieldset><legend>Datos Personales</legend><br />\r\n<label>Tipo de Persona</label> <br />\r\n&nbsp; #TIPO_PERSONA# <br />\r\n<div class="showhide" id="cdiv0"><label>Nombres</label> *<br />\r\n \r\n  <input type="text" name="nombre" id="nombre" />\r\n \r\n  (Francisco)<br />\r\n<label>Apellido Paterno</label> *<br />\r\n<input type="text" name="paterno" id="paterno" /> \r\n(Merino)<br />\r\n<label>Apellido Materno</label> *<br />\r\n<input type="text" name="materno" id="materno" /> \r\n(Echeverria)<br /><label>Apoderado</label></div>\r\n<div class="showhide" id="cdiv1"><label>Raz&oacute;n Social</label> *<br />\r\n  <input type="text" name="razon_social" id="razon_social" />\r\n  <br />\r\n<label>Apoderado</label> *<br />\r\n</div>\r\n\r\n<input type="text" name="apoderado" id="apoderado" /><br />\r\n<label>Email</label> <br />\r\n<input type="text" name="email" id="email" />\r\n</fieldset>\r\n             <br /><br />\r\n              <br />\r\n             <fieldset>\r\n             <legend> Domicilio</legend>\r\n             \r\n\r\n             <table class="tabla_nb" cellspacing="0" cellpadding="0" width="99%" align="left" border="0">\r\n  <tbody>\r\n    <tr>\r\n      <td align="left"><label>Direcci&oacute;n *</label>      </td>\r\n      <td colspan="3" align="left"><input type="text" name="direccion" id="direccion"  size="30" />\r\n        &nbsp;\r\n                <label>N&uacute;mero* </label>\r\n        <label>\r\n        <input type="text" name="numero" id="numero" size="3" />\r\n        &nbsp;&nbsp;&nbsp;Departamento \r\n        <input type="text" name="depto" id="depto" size="3" />\r\n        </label></td>\r\n    </tr>\r\n    <tr>\r\n      <td align="left"><label>Ciudad *</label>      </td>\r\n      <td align="left"><input type="text" name="ciudad" id="ciudad" /></td>\r\n      <td align="left">&nbsp;</td>\r\n      <td align="left">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td width="17%" align="left"><label>Regi&oacute;n  *</label>      </td>\r\n      <td width="34%" align="left">#REGION#</td>\r\n      <td width="17%" align="left"><label> Comuna *</label></td>\r\n      <td width="32%" align="left">#COMUNA#</td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n<p><br />\r\n</p>\r\n             </fieldset>\r\n             <br />\r\n <br />\r\n     \r\n\r\n\r\n               <fieldset>\r\n              <legend>Informaci&oacute;n de la Solicitud</legend>\r\n              <label></label>\r\n              <label></label>\r\n               <br/>\r\n			  <label>Nombre de la entidad a la que dirige la solicitud *&nbsp; </label>\r\n			   #LISTA_ENTIDADES#<br/>\r\n			   <br/>\r\n              <label>Identificaci&oacute;n de la informaci&oacute;n solicitada. Se&ntilde;ale la materia, fecha de \r\n			  emisi&oacute;n o per&iacute;odo de vigencia del documento, origen o destino, soporte, etc. *:</label>\r\n              <p>\r\n               <textarea name="identificacion_documentos" id="identificacion_documentos" cols="80" rows="8" class="textos"></textarea>\r\n                <br />\r\n              </p>\r\n              <label></label>\r\n              <br />         \r\n            \r\n              </fieldset>\r\n               <br />\r\n               <br />\r\n\r\n<fieldset>\r\n              <legend>Notificaci&oacute;n</legend>\r\n              <br />\r\n<label>Deseo ser notificado por correo electr&oacute;nico </label>#SI#<label><br />\r\n              </label>\r\n<br />\r\n</fieldset>\r\n              \r\n              <br/>\r\n              <br/>\r\n<fieldset>\r\n              <legend>Documento Firmado</legend>\r\n              <br />\r\n<label>Este documento esta firmado </label>#SI_FIRMADO#<label><br />\r\n              </label>\r\n<br />\r\n</fieldset>\r\n              \r\n              <br/>\r\n              <br/>\r\n               <fieldset>\r\n              <legend>Forma de recepci&oacute;n de la informaci&oacute;n solicitada</legend>\r\n              <br />\r\n              <label>Seleccione forma * #FORMA_RECEPCION#</label>\r\n              <br />\r\n              <div class="showhide" id="cdiv0">\r\n              <label>Especificar oficina: #OFICINA#</label><br /><br />\r\n              </div>\r\n             \r\n</fieldset> <br /><br />\r\n              \r\n<fieldset>\r\n              <legend>Formato de entrega</legend>\r\n              <br />\r\n              <label>Seleccione formato de entrega</label> <br/> #FORMATO_ENTREGA#<br />\r\n              <br />\r\n              \r\n              <br />\r\n</fieldset>\r\n              \r\n                            <fieldset>\r\n              <legend>Datos  estad&iacute;sticos (opcionales)</legend>\r\n              <br /><label>\r\n              RUT / RUN</label>\r\n              <br />\r\n             #RUT#\r\n              (ej: 12.233.456-8)\r\n              <br /><label>\r\n              Tel&eacute;fono de Contacto</label>\r\n              <br />\r\n              #CODIGO# -#TELEFONO#<label></label>(ej: 562-456 78 90) \r\n              <label><br />\r\n              </label>\r\n              <hr />\r\n              <label>Sexo </label>#SEXO# <label>Edad</label>#RANGO_EDAD# <br/>\r\n			  <label>Nacionalidad </label>#NACIONALIDAD#\r\n            \r\n              <hr />\r\n              \r\n              <label>Nivel Educacional </label>#NIVEL_EDUCACIONAL#  \r\n			  <br /><label>Ocupaci&oacute;n </label>#OCUPACION#\r\n              <hr />\r\n               <label>Tipo de Organizaci&oacute;n en la que participa</label>\r\n             \r\n              #ORGANIZACION_SINDICAL#\r\n         <br />\r\n              <label>\r\n              Frecuencia</label> #FRECUENCIA#\r\n<br />\r\n              </fieldset>\r\n              \r\n              <div align="center"></div>\r\n              <div align="center"></div>\r\n \r\n     \r\n              </div>\r\n\r\n              \r\n              <div align="center">\r\n                <input name="Registrarse" type="submit" class="botones" id="Registrarse" value="Enviar Solicitud" />\r\n              </div>\r\n \r\n     \r\n              </div>\r\n', 69);
INSERT INTO templates_acciones VALUES (103, 'formulario_cambio_contrasenia', '<h3>Mis Datos</h3>\r\n\r\n<fieldset>               <legend>Datos Personales</legend>                              \r\n<br />\r\n<label>Nombres</label> <strong>\r\n#NOMBRES# #PATERNO# #MATERNO# </strong><br />\r\n<label> </label>#ENTIDAD_PADRE#<BR />\r\n<label> </label>#ENTIDAD_HIJA#<BR />\r\n<label>Tel&eacute;fono </label> #FONO#<br />\r\n\r\n<br />  \r\n<label></label>\r\n<br />\r\n</fieldset>\r\n<p>CAMBIO DE CONTRASEÑA</p>\r\n\r\n<fieldset>               <legend>Datos de ingreso al sistema</legend>               <br />\r\n<label>               Direcci&oacute;n de correo electr&oacute;nico</label>  <strong>#MAIL#</strong><br />\r\n<br />\r\n<label><strong>Solo si desea cambiar su contrase&ntilde;a</strong></label> <br />\r\n<label>Contrase&ntilde;a actual</label>               <br />\r\n#CONTRASENIA_ACTUAL#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Confirme nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA2#               <br />\r\n<br />\r\n</fieldset>\r\n<p>&nbsp;</p>\r\n\r\n<div align="center"><input type="submit" value="Cambiar Contrase&ntilde;a" id="Registrarse" class="botones" name="Registrarse" />\r\n</div>', 97);
INSERT INTO templates_acciones VALUES (54, 'contenedor_lista_mis_solicitudes', '\r\n<h3>Mis Solicitudes</h3>\r\n<p>Aqu&iacute; podr&aacute; revisar el estado de sus solicitudes.</p>\r\n<p>Si necesita asistencia ingrese a la <a href="?accion=ayuda">secci&oacute;n de ayuda</a>.</p>\r\n\r\n<div class="wide" id="table-block">\r\n<table cellspacing="0" cellpadding="0">\r\n    <tbody>\r\n        <tr class="header">\r\n            <td width="18%">N&ordm; de Solicitud</td>\r\n            <td width="18%">Fecha Solicitud</td>\r\n            <td width="23%">Fecha T&eacute;rmino Solicitud</td>\r\n            <td width="11%">Plazo*</td>\r\n            <td width="15%">Estado</td>\r\n            <td width="15%">&nbsp;</td>\r\n      </tr>\r\n        #LINEAS_MIS_SOLICITUDES#\r\n    </tbody>\r\n</table>\r\n</div>\r\n<p>&nbsp;</p>\r\n<table cellspacing="2" cellpadding="2" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td align="center"><strong>#CANT_PAGINAS#</strong></td>\r\n        </tr>\r\n        <tr>\r\n            <td align="center">#PAGINACION#</td>\r\n        </tr>\r\n    <tr>\r\n            <td align="left">*Los plazos se cuentan en d&iacute;as h&aacute;biles y desde el siguiente d&iacute;a de formulada la solicitud.</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 49);
INSERT INTO templates_acciones VALUES (56, 'linea_lista_administracion_solicitudes', '<tr>\r\n\r\n<td>#FOLIO#</td>\r\n\r\n<td>#FECHA_INGRESO# </td>\r\n<td>#FECHA_TERMINO# </td>\r\n<td>#DIAS# d&iacute;as</td>\r\n<td width="100">#ESTADO_PADRE#</td>\r\n<td>#ESTADO#</td>\r\n<td class="actions"><a class="edit" href="#LINK#">Editar</a></td>\r\n\r\n</tr>', 51);
INSERT INTO templates_acciones VALUES (58, 'contenedor_detalle_solicitud', '<h3>Detalle de la solicitud - N&ordm; #FOLIO#</h3>\r\n<div class="mensaje" ><a #LINK_PRINT# class="comprobante">Ver comprobante</a></div>\r\n<p>Dirigida a: <strong>#SERVICIO#</strong><br />\r\n#ENTIDAD_HIJA#</p>\r\n<div class="wide" id="table-block">\r\n<table cellspacing="0" cellpadding="0">\r\n    <tbody>\r\n        <tr class="header">\r\n            <td width="23%">Entidad</td>\r\n            <td colspan="3">#ENTIDAD#</td>\r\n        </tr>\r\n        <tr>\r\n            <td><strong>Fecha de la solicitud</strong></td>\r\n            <td width="30%">#FECHA_INGRESO#</td>\r\n            <td width="11%"><strong>Estado </strong></td>\r\n            <td width="36%">#ESTADO#</td>\r\n        </tr>\r\n        <tr>\r\n            <td><strong>Plazo para responder</strong></td>\r\n            <td>#DIAS# d&iacute;as</td>\r\n          <td>&nbsp;  </td>\r\n            <td>&nbsp;  </td>\r\n        </tr>\r\n          <tr>\r\n            <td><strong>Desea notificaci&oacute;n por correo electr&oacute;nico</strong></td>\r\n            <td colspan="3">#MEDIO_NOTIFICACION#  &nbsp;  </td>\r\n        </tr>\r\n       <tr>\r\n            <td><strong>Forma de recepci&oacute;n</strong></td>\r\n            <td colspan="3">#FORMA_RECEPCION# &nbsp;   </td>\r\n        </tr>\r\n      #RETIRO_OFICINA# \r\n       <tr>\r\n            <td><strong>Formato de entrega</strong></td>\r\n            <td colspan="3">#FORMA_ENTREGA# &nbsp;   </td>\r\n        </tr>\r\n      \r\n        <tr>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n        </tr>\r\n        <tr class="header">\r\n          <td colspan="4">Informaci&oacute;n solicitada</td>\r\n        </tr>\r\n        <tr>\r\n          <td colspan="4">#OBS#</td>\r\n        </tr>\r\n        <tr>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n        </tr>\r\n        <tr class="header">\r\n          <td colspan="2">Observaciones</td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n        </tr>\r\n        <tr>\r\n          <td colspan="4">#SUBESTADO#</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>  </p>\r\n</div>\r\n<p align="center"><a href="?accion=#ACCION#"><img height="20" alt="" width="71" border="0" src="images/sitio/sgs/img/boton_volver.gif" /></a></p>\r\n', 53);
INSERT INTO templates_acciones VALUES (59, 'contenedor_admin_solicitudes_ver', '<table width="100%" border="0" cellspacing="2" cellpadding="2">\r\n  <tr>\r\n    <td><strong>Editar Solicitud</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo para entregar respuesta: <strong>#PLAZO#</strong><br />\r\n    </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br />\r\n    Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span> </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n      <table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">\r\n        <tr>\r\n          <td width="17%">Solicitante:</td>\r\n          <td colspan="5"><span class="style1"><strong>#SOLICITANTE#</strong></span></td>\r\n        </tr>\r\n        #APODERADO#\r\n        <tr>\r\n          <td>Direcci&oacute;n:</td>\r\n          <td width="29%"><strong>#DIRECCION#</strong></td>\r\n          <td width="14%">Número:</td>\r\n          <td width="19%"><strong>#NUMERO#</strong></td>\r\n          <td width="12%">Departamento:</td>\r\n          <td width="9%"><strong>#DEPARTAMENTO#</strong></td>\r\n        </tr>\r\n        <tr>\r\n          <td>Regi&oacute;n:</td>\r\n          <td><strong>#REGION#</strong></td>\r\n          <td>Comuna:</td>\r\n          <td><strong>#COMUNA#</strong></td>\r\n          <td>Ciudad:</td>\r\n          <td><strong>#CIUDAD#</strong></td>\r\n        </tr>\r\n        <tr>\r\n          <td>Correo electr&oacute;nico:</td>\r\n          <td colspan="5"><strong>#CORREO_ELECTRONICO#</strong></td>\r\n        </tr>\r\n        <tr>\r\n          <td>Dirigida a:</td>\r\n          <td colspan="5"><span class="style1"><strong>#SERVICIO#</strong></span></td>\r\n        </tr>\r\n        <tr>\r\n          <td>Entidad :</td>\r\n          <td colspan="5"><span class="style1"><strong>#ENTIDAD#</strong></span></td>\r\n        </tr>\r\n        <tr>\r\n          <td colspan="6">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>Etapa actual:</td>\r\n          <td colspan="3"><span class="style1"><strong>#ESTADO_PADRE#</strong></span></td>\r\n          <td>&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>Estado actual:</td>\r\n          <td colspan="3"><span class="style1"><strong>#ESTADO#</strong></span></td>\r\n          <td>&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>&nbsp;</td>\r\n          <td colspan="3">&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>Asignada a:</td>\r\n          <td colspan="3"><strong>#RESPONSABLE#</strong></td>\r\n          <td>&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>&nbsp;</td>\r\n          <td colspan="3">&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n          <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n          <td>&nbsp;</td>\r\n          <td colspan="3"><input type="button" name="Aceptar" id="Aceptar" value="Asignar responsable" #ONCLICK# /></td>\r\n          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>\r\n          </tr>\r\n        <tr>\r\n          <td colspan="6"><div align="center">#MENSAJE#</div></td>\r\n          </tr>\r\n        <tr>\r\n          <td>&nbsp;</td>\r\n          <td colspan="3">&nbsp;</td>\r\n          <td colspan="2">&nbsp;</td>\r\n        </tr>\r\n      </table>\r\n    \r\n</div></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><strong>Notificar por correo eletr&oacute;nico</strong></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#MEDIO_NOTIFICACION#</strong> &nbsp;</div></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><strong>Forma de recepci&oacute;n de la información solicitada</strong></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_RECEPCION#</strong> &nbsp; </div></td>\r\n  </tr>\r\n  \r\n  <tr >\r\n    <td align="left" ><strong>Formato de entrega</strong></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_ENTREGA#</strong></div></td>\r\n  </tr>\r\n  #RETIRO_OFICINA#\r\n  <tr >\r\n    <td align="left" ><strong>Informaci&oacute;n Solicitada </strong></td>\r\n  </tr>\r\n  <tr >\r\n    <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#IDENTIFICACION_DOCUMENTOS#</strong></div></td>\r\n  </tr>\r\n  #FIRMADA#\r\n</table>\r\n', 54);
INSERT INTO templates_acciones VALUES (60, 'linea_estado_solicitud_user_registrado', '<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td><strong>Fecha Asignaci&oacute;n:</strong> #FECHA#</td>\r\n        </tr>\r\n        <tr>\r\n          <td><strong>Estado :</strong> #ESTADO#</td>\r\n        </tr>\r\n        <tr>\r\n            <td><strong>Modificado por: </strong>#NOMBRE_USUARIO#</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td><strong>Observaci&oacute;n</strong></td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>#OBSERVACION#</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 55);
INSERT INTO templates_acciones VALUES (62, 'detalle_solicitud_mis_solcitudes_asignadas', '<table width="100%"  border="0" align="left" cellpadding="2" cellspacing="2">\r\n    	 <tr >\r\n    	   <td width="769" align="left" ><h4>Editar solicitud</h4></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo para entregar respuesta: <strong>#PLAZO#</strong><br>\r\n    	   </div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br>\r\n   	       Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span> </div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n    	     <table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">\r\n               <tr>\r\n                 <td width="17%">Solicitante:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SOLICITANTE#</strong></span></td>\r\n               </tr>\r\n              #APODERADO#\r\n               <tr>\r\n                 <td>Direcci&oacute;n:</td>\r\n                 <td width="29%"><strong>#DIRECCION#</strong></td>\r\n                 <td width="14%">Número:</td>\r\n                 <td width="19%"><strong>#NUMERO#</strong></td>\r\n                 <td width="12%">Departamento:</td>\r\n                 <td width="9%"><strong>#DEPARTAMENTO#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Regi&oacute;n:</td>\r\n                 <td><strong>#REGION#</strong></td>\r\n                 <td>Comuna:</td>\r\n                 <td><strong>#COMUNA#</strong></td>\r\n                 <td>Ciudad:</td>\r\n                 <td><strong>#CIUDAD#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Correo electr&oacute;nico:</td>\r\n                 <td colspan="5"><strong>#CORREO_ELECTRONICO#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Dirigida a:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SERVICIO#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Entidad:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#ENTIDAD#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td colspan="6">&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Etapa actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO_PADRE#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Estado actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n             </table>\r\n    	     \r\n    	    \r\n    	 \r\n    	   </div></td>\r\n  	   </tr>\r\n         <tr >\r\n           <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n             <table width="95%" border="0" cellspacing="0" cellpadding="2">\r\n               <tr>\r\n                 <td width="22%">Url documento 1</td>\r\n                 <td width="78%">#URL_1#</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Url documento 2</td>\r\n                 <td>#URL_2#</td>\r\n               </tr>\r\n             </table>\r\n           </div></td>\r\n         </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n         <table width="95%" border="0" cellpadding="0" cellspacing="0">\r\n           <tr>\r\n             <td>Seleccione etapa&nbsp;</td>\r\n           </tr>\r\n           <tr>\r\n             <td>#COMBO_ESTADOS#</td>\r\n           </tr>\r\n           <tr>\r\n             <td>Seleccione el estado</td>\r\n           </tr>\r\n           <tr>\r\n             <td>#COMBO_ETAPAS#</td>\r\n           </tr>\r\n           <tr>\r\n             <td>Observaciones</td>\r\n           </tr>\r\n           <tr>\r\n             <td><textarea name="observacion" cols="50" rows="7" id="observacion"></textarea></td>\r\n           </tr>\r\n           <tr>\r\n             <td>&nbsp;</td>\r\n           </tr>\r\n           <tr>\r\n             <td><table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n               <tr>\r\n                 <td><input type="submit" name="Submit" value="Enviar" /></td>\r\n                 <td>#PRORROGA#</td>\r\n               </tr>\r\n             </table></td>\r\n           </tr>\r\n           <tr>\r\n             <td>&nbsp;</td>\r\n           </tr>\r\n           <tr>\r\n             <td><div align="center">#MENSAJE# </div></td>\r\n           </tr>\r\n         </table>\r\n       </div></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Notificar por correo eletr&oacute;nico</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#MEDIO_NOTIFICACION#</strong> &nbsp;</div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Forma de recepci&oacute;n de la información solicitada</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_RECEPCION#</strong> &nbsp; </div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Formato de entrega</strong></td>\r\n  </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_ENTREGA#</strong></div></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Informaci&oacute;n Solicitada </strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#IDENTIFICACION_DOCUMENTOS#</strong></div></td>\r\n     </tr>\r\n     #FIRMADA#\r\n     \r\n     <tr >\r\n       <td align="left" >&nbsp;</td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" >#VER_HISTORIAL# </td>\r\n     </tr>\r\n  </table>', 57);
INSERT INTO templates_acciones VALUES (61, 'lo_sentimos_no_existe_info', '<p>Los sentimos, no encontramos informaci&oacute;n sobre este item</p>', 56);
INSERT INTO templates_acciones VALUES (63, 'gracias_solicitud_completa', '<p>Gracias, la solicitud ha sido ingresada en el sistema<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n</p>', 58);
INSERT INTO templates_acciones VALUES (64, 'lista_vacia_mis_solicitudes', '  <tr>\r\n    <td colspan="#COLSPAN#">En este momento usted no tiene solicitudes</td>\r\n  </tr>\r\n', 59);
INSERT INTO templates_acciones VALUES (65, 'comprobante_electronico_de_ingreso', '<style type="text/css">\r\n<!--\r\n.style1 {font-weight: bold}\r\n-->\r\n</style>\r\n<img src="images/sitio/sgs/images/logo_gobierno_horizontal.jpg" alt="Gobierno de chile" border="0">\r\n\r\n #SOLICITUD_ENVIADA#\r\n\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px">\r\n<div class="mensaje" id="mensaje"><a  #LINK#><img height="28" alt="" width="27" align="right" border="0" src="images/sitio/sgs/img/imprimir.gif" />Imprimir</a></div>\r\n\r\n  <p><br />\r\n<strong>#USUARIO#</strong> <br />\r\n<br />\r\nUsted ha ingresado una consulta dirigida a:<br />\r\n<br />\r\n<strong>#SERVICIO#</strong> <br />\r\n\r\n<strong>#ENTIDAD#</strong> <br />\r\n<br />\r\nSu consulta ha sido ingresada con el n&uacute;mero <br />\r\n<br />\r\n<strong>#FOLIO# </strong><br />\r\n<br />\r\nSu solicitud ha sido recibida con fecha: <strong>#FECHA# </strong><table width="600" cellpadding="0" cellspacing="0">\r\n    <tbody>\r\n          <tr>\r\n            <td width="285"><strong>Desea notificaci&oacute;n por correo electr&oacute;nico</strong></td>\r\n            <td colspan="3">#MEDIO_NOTIFICACION#     </td>\r\n        </tr>\r\n       <tr>\r\n            <td><strong>Forma de recepci&oacute;n</strong></td>\r\n            <td colspan="3">#FORMA_RECEPCION#     </td>\r\n      </tr>\r\n      #RETIRO_OFICINA# \r\n       <tr>\r\n            <td><strong>Formato de entrega</strong></td>\r\n            <td colspan="3">#FORMA_ENTREGA#     </td>\r\n    </tr>\r\n      \r\n        <tr>\r\n          <td>  </td>\r\n          <td width="32">  </td>\r\n          <td width="64">  </td>\r\n          <td width="217">  </td>\r\n        </tr>\r\n       \r\n        <tr>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<br />\r\n<DIV align="center">#IMG#</DIV><BR />\r\n</div>\r\n <br/>\r\n Informaci&oacute;n   relevante<br />\r\n\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px">\r\n  <p><strong>1. La   respuesta a su solicitud tiene un plazo m&aacute;ximo de 20 d&iacute;as h&aacute;biles. Sin embargo,   &eacute;ste podr&iacute;a ser prorrogado por otros 10 d&iacute;as h&aacute;biles en casos   justificados.</strong></p>\r\n  <p class="style1"><strong>2. La   informaci&oacute;n solicitada se entregar&aacute; en la forma y por el medio que usted se&ntilde;ale, siempre que no signifique un costo excesivo.</strong></p>\r\n  <p class="style1"><strong>3. La   reproducci&oacute;n de la informaci&oacute;n puede tener costo. El no pago de &eacute;ste impide la   entrega de la informaci&oacute;n.</strong></p>\r\n</div>\r\n\r\n<br />\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px">\r\n  <table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">\r\n    <tr class="header">\r\n      <td ><strong>Informaci&oacute;n solicitada</strong></td>\r\n    </tr>\r\n    <tr>\r\n      <td >#OBS#</td>\r\n    </tr>\r\n  </table>\r\n  \r\n</div>\r\n#BOTON_TERMINAR#', 60);
INSERT INTO templates_acciones VALUES (72, 'upss', '<p>Existe alg&uacute;n problema con nuestro servicio, int&eacute;ntelo mas tarde</p>', 67);
INSERT INTO templates_acciones VALUES (73, 'html_vacio', '<head>\r\n<title>Sistema de Gesti&oacute;n de Solicitudes</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">\r\n\r\n<link href="css/sitio.css" rel="stylesheet" type="text/css" />\r\n\r\n\r\n\r\n<style type="text/css">\r\n<!--\r\nbody {\r\n	background-color: #3D587A;\r\n	\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 1em;\r\n	\r\n	text-align:left; \r\n\r\n}\r\n-->\r\n</style>\r\n\r\n\r\n</head>\r\n\r\n\r\n<body>\r\n\r\n\r\n			\r\n<div id="maincol2" > \r\n<table width="600" border="0" cellspacing="3" cellpadding="3">\r\n  <tr>\r\n    <td>#CONTENIDO#</td>\r\n  </tr>\r\n</table>\r\n\r\n\r\n\r\n</div>\r\n\r\n</body>\r\n</html>', 68);
INSERT INTO templates_acciones VALUES (71, 'mensaje_actualizar_datos', '<h3>Mis Datos</h3>\r\n<p>Muchas gracias, sus datos han sido actualizados exitosamente.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 66);
INSERT INTO templates_acciones VALUES (102, 'formulario_olvido1', '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">\r\n                <tr>\r\n                  <td align="center" >Ind&iacute;quenos su nueva direcci&oacute;n de correo \r\n				  </td>\r\n				  <td align="left" width="300" ><input type="text" name="nuevo_email"></td> \r\n                </tr>\r\n				<tr><td align="center"  colspan="2">\r\n				<input type="submit" name="Submit" value="Enviar solicitud de cambio"> </td></tr> \r\n              </table>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 96);
INSERT INTO templates_acciones VALUES (68, 'gracias_envio_pass', '<p>Gracias hemos enviado una nueva contrase&ntilde;a a su cuenta de correo.<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n</p>', 63);
INSERT INTO templates_acciones VALUES (69, 'recuperacion_contrasenia_1_texto_correo', '<p>Se ha solicitado una nueva contrase&ntilde;a para esta cuenta de correos #LOGIN#:</p>\r\n<p><br />\r\nPara activar el cambio haga click <a href="http://#URL#">Aqu&iacute;</a></p>', 64);
INSERT INTO templates_acciones VALUES (81, 'recuperacion_contrasenia_2_subjet_correo', 'Nueva contraseña Sgs', 75);
INSERT INTO templates_acciones VALUES (79, 'contenedor_listado_solicitudes_sin_asignar', '<table cellspacing="0" cellpadding="0" width="98%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">\r\n            <table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center"><strong>Asignar solicitudes</strong></div>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center">#MENSAJE_SIN_ASIGNAR#</div>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center"></div>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center">Buscar por N&ordm; de solicitud: \r\n                          <input id="buscar" name="buscar" type="text" /> <input id="buscar2" type="submit" name="buscar2" value="Buscar..." /></div>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td><strong>Bandeja de Solicitudes</strong></td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td valign="top">\r\n                        <div class="wide" id="table-block">\r\n                        <table cellspacing="0" cellpadding="0">\r\n                            <tbody>\r\n                                <tr class="header2">\r\n                                    <td width="15%">N&ordm; de Solicitud</td>\r\n                                    <td width="20%">Fecha  Solicitud</td>\r\n                                    <td width="20%">Fecha T&eacute;rmino  Solicitud</td>\r\n                                  <td width="20%">Plazo</td>\r\n                                    <td width="23%">Etapa</td>\r\n                                    <td width="23%">Estado</td>\r\n                                    <td width="14%">Editar</td>\r\n                                </tr>\r\n                                #LISTA_ADMINISTRACION_SOLICITUDES#\r\n                            </tbody>\r\n                        </table>\r\n                        </div>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            <br />\r\n            <div align="center"><br />\r\n            <br />\r\n            #PAGINACION#</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 73);
INSERT INTO templates_acciones VALUES (91, 'estado_glosa_asignador', 'Asignar', 85);
INSERT INTO templates_acciones VALUES (92, 'mensaje_vacio_solicitudes_asignador', 'No existen solicitudes sin Asignar', 86);
INSERT INTO templates_acciones VALUES (70, 'recuperacion_contrasenia_1_subjet_correo', 'Recuperaci&oacute;n de clave', 65);
INSERT INTO templates_acciones VALUES (75, 'subjet_mail_envio_solicitud1', 'Verificaci&oacute;n de cambio de cuenta', 70);
INSERT INTO templates_acciones VALUES (76, 'texto_de_activacion_nuevo_email2', '<p>Gracias, ahora solo falta activar la cuenta defenitiva, haciendo click <a href="#URL#">aqu&iacute;</a></p>', 71);
INSERT INTO templates_acciones VALUES (77, 'subjet_mail_envio_solicitud2', 'Activaci&oacute;n de cambio de cuenta', 72);
INSERT INTO templates_acciones VALUES (80, 'observacion_asignacion_responsable', 'Asignaci&oacute;n de responsable', 74);
INSERT INTO templates_acciones VALUES (82, 'recuperacion_contrasenia_2_texto_correo', '<p>Hemos asignado una nueva contrase&ntilde;a a su cuenta, los datos son:</p>\r\n<p>Ususario: #LOGIN#<br />\r\nContrase&ntilde;a : #CAD#<br />\r\n<br />\r\n<br />\r\n#SGS#</p>', 76);
INSERT INTO templates_acciones VALUES (83, 'Mensaje_solicitud_cambio_contrasena', '<p>Hemos enviado una solicitud de cambio de contrase&ntilde;a a su cuenta de correo\r\n\r\n</p>\r\n</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br></br></br></br></br>\r\n<p></p><p>&nbsp;</p><p></p>', 77);
INSERT INTO templates_acciones VALUES (84, 'gracias_envio_clave_olvidada', '<p>Gracias, hemos enviado una nueva calve a su cuenta de correo.</p>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>&nbsp;</br>', 78);
INSERT INTO templates_acciones VALUES (85, 'solicitud_caducada', '<p>Esta solicitud ya caduco<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n</p>', 79);
INSERT INTO templates_acciones VALUES (86, 'gracias_ingreso_manual', '<h4>Gracias hemos ingresado la solicitud </h4>\r\n<br><br><br>\r\n\r\n<a href="?accion=Ingreso-de-solicitudes">Ingresar una nueva Solicitud</a>\r\n\r\n<br>&nbsp;<br>&nbsp;<br><br>&nbsp;<br>&nbsp;<br>', 80);
INSERT INTO templates_acciones VALUES (87, 'mensaje_cantidad_solicitudes_responsable', 'Existen #TOTAL_SOLICITUDES_SIN_ASIGNAR# solicitudes sin #ESTADO_GLOSA#. La m&aacute;s antigua fue ingresada el #FECHA_MAS_ANTIGUA#', 81);
INSERT INTO templates_acciones VALUES (88, 'link_cantidad_solicitudes_responsable', '<a href="#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#">Haga click aqu&iacute; para Procesar Solicitudes Pendientes (<span class="style1">#TOTAL_SOLICITUDES_SIN_ASIGNAR#</span>)</a>', 82);
INSERT INTO templates_acciones VALUES (89, 'mensaje_vacio_solicitudes_responsable', 'No existen solicitudes sin Procesar', 83);
INSERT INTO templates_acciones VALUES (93, 'linea_listado_usuarios', '<tr #CLASE#>\r\n                                <td title="#LOGIN#" align="left" >#NOMBRE# #PATERNO#</td>\r\n                                <td align="left">&nbsp;#PERFIL#</td>\r\n                                <td align="left">&nbsp;#ENTIDAD#</td>\r\n                                <td align="left">&nbsp;#EMAIL#</td>\r\n                                <td>&nbsp;#IMG_ESTADO#</td>\r\n                                <td class="actions">#LINK_EDIT#</td>\r\n                              <td class="actions">#LINK_DEL#</td>\r\n                        </tr>', 87);
INSERT INTO templates_acciones VALUES (106, 'formulario_registro_funcionario', '<h4>Registro Funcionario</h4>\r\n<p align="justify"> </p>\r\n<div class="mensaje" id="mensaje">Los campos indicados con (*) son obligatorios</div>\r\n<fieldset>\r\n<legend>Datos personales</legend>\r\n\r\n<label></label>\r\n<br />\r\n<div class="showhide" id="cdiv0"><label>Nombres</label> *<br />\r\n#NOMBRES# (Ej. Francisco)<br />\r\n<label>Apellido paterno</label>\r\n *<br />\r\n#PATERNO# (Ej. Maldonado)<br />\r\n<label>Apellido materno</label>\r\n *<br />\r\n#MATERNO# (Ej. Soto)<br />\r\n<label>Tel&eacute;fono</label><br />\r\n#TELEFONO# <br />\r\n<label></label>\r\n</div>\r\n\r\n</fieldset>\r\n\r\n<br /> \r\n<fieldset>\r\n<legend>Datos Institucionales</legend>\r\n\r\n<label></label>\r\n<br />\r\n<div class="showhide" id="cdiv0">\r\n  \r\n<label>Entidad</label>\r\n<br />\r\n<label>#ENTIDAD_PADRE# <br /></label>\r\n<label>Servicio</label>\r\n *<br />\r\n<label>#ENTIDAD_HIJA# <br /></label><br/>\r\n<label>Departamento u Oficina</label>\r\n   *<br />\r\n#OFICINA#  <br />\r\n<label></label>\r\n</div>\r\n\r\n</fieldset>\r\n\r\n\r\n<br /> \r\n<fieldset>\r\n<legend>Datos de ingreso al sistema</legend>\r\n<br />\r\n<label>Direcci&oacute;n de correo electr&oacute;nico</label> *<br />\r\n#MAIL# (fmerino@economia.gov.cl)<br />\r\n<label>Contrase&ntilde;a  M&iacute;nimo 6 caracteres. </label><br />\r\n#CONTRASENIA# \r\n<label>(solo si desea cambiar la contrase&ntilde;a)</label>\r\n<br />\r\n<label>Confirme contrase&ntilde;a </label> <br />\r\n#CONTRASENIA2# <br />\r\n<label /></fieldset><br />\r\n\r\n<fieldset>\r\n<legend>Perfil</legend>\r\n\r\n<label></label>\r\n<br />\r\n<div class="showhide" id="cdiv0">\r\n  <label>Perfil</label>\r\n   *<br />\r\n<label>#PERFIL#</label> <br />\r\n\r\n<br />\r\n<label></label>\r\n</div>\r\n\r\n</fieldset>\r\n\r\n<p> </p>\r\n<div align="center"><input class="botones" id="Registrarse" type="submit" name="Registrarse" value="Aceptar" />\r\n</div>\r\n<div> </div>\r\n', 100);
INSERT INTO templates_acciones VALUES (94, 'contenedor_lista_usuarios', '<table width="98%" border="0" cellpadding="0" cellspacing="0">                 				 <tr>                  <td valign="top"><strong>Administraci&oacute;n de Usuarios</strong><br />                  <br />                    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="left">#CUADRO_BUSQUEDA#</td><td align="right" > <table   border="0" align="right" cellpadding="0" cellspacing="0">                                                                     <tr >                                                                       <td align="center" class="textos">																	   <a href="index.php?accion=#ACCION#&act=4">																	    <img src="images/new.gif" alt="Nuevo Usuario" border="0"></a></td>              </tr>                                                                 	<tr >                                                                       <td align="center" class="textos"> <a href="index.php?accion=#ACCION#&act=4">																	   Crear Usuario</a></td>              </tr>                                                                 	</table> </td></tr><tr>  <td align="right" colspan="2" class="textos"><a href="index.php?accion=#ACCION#&act=11&axj=1" target="_blank">Exportar a hoja de c&aacute;lculo los usuarios ciudadanos solicitantes registrados &nbsp;</a></td></tr></table>                                        <div align="center">listado de usuarios<br />                          <br />                                       <br />                                             <div id="table-block" class="wide">                          <table cellspacing="0" cellpadding="0">                            <tbody>                              <tr class="header">                                <td width="16%">Usuario</td>                                <td width="16%">Tipo</td>                                <td width="14%">Departamento / Unidad</td>                                <td width="36%">correo electr&oacute;nico</td>                                <td width="10%">Estado</td>                                <td width="8%">Editar</td>                             <td width="8%">Borrar</td>                              </tr>                                                                              #LINEA_REGISTROS#                            </tbody>                          </table>                      </div>                      <br />                  <br />                    #PAGINACION#					 <br />                    </div></td>                </tr>                <tr><td>                	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">            			<tr>        			 <td align="left" >         				<img src="images/ciculo_ok.gif" border="0" >&nbsp;&nbsp;Usuario Activo</td> 	  			</tr> 				<tr>	    			<td align="left" >	    				<img src="images/ciculo_warring.gif" border="0" >&nbsp;&nbsp;Usuario Inactivo</td> 				</tr> 				<tr>	    			<td align="left" >	    				<img src="images/minus_circle.gif" border="0" >&nbsp;&nbsp;Usuario Bloqueado</td> 				</tr> 			</table>                </td></tr>              </table>', 88);
INSERT INTO templates_acciones VALUES (95, 'contenedor_instalador', '<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n    <tr>\r\n      <td width="28">&nbsp;</td>\r\n      <td width="637">&nbsp;</td>\r\n      <td width="22">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center"><h3>Configuraci&oacute;n e instalaci&oacute;n de sistema de gesti&oacute;n de solicitudes.</h3></div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center">Versi&oacute;n 0.1 Beta</div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center">#MENSAJE#</div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><table width="100%" border="1" cellspacing="0" cellpadding="3">\r\n          <tr>\r\n            <td><div align="center">Identificador</div></td>\r\n            <td><div align="center">Valor</div></td>\r\n          </tr>\r\n          \r\n         #REGISTROS_INSTALADOR#\r\n\r\n      </table></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>Pol&iacute;ticas de Privacidad </td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><textarea name="politicas" cols="30" rows="30">#POLITICAS#</textarea></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><input type="hidden" name="cantidad" value="#SUMA#" />\r\n        <input type="hidden" name="opcion" id="opcion" />\r\n        <input type="hidden" name="entidad_padre" id="entidad_padre" /></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><input name="Grabar" type="button" id="Grabar" value="Grabar" onClick="if (valida()==true){ document.form1.opcion.value=3;document.form1.submit();}"></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n  </table>\r\n  <script language="javascript">\r\n#SELECCIONA_COMBO#\r\n</script>\r\n\r\n\r\n\r\n\r\n', 89);
INSERT INTO templates_acciones VALUES (96, 'registro_valor_instalador', '<tr>\r\n            <td>#DESCRIPCION# <input type="hidden" name="id_#I#" value="#ID_CONFIGURACION#">   </td>\r\n            <td>#CAMPO#</td>\r\n          </tr>', 90);
INSERT INTO templates_acciones VALUES (97, 'lista_vacia_mis_solicitudes_asignador', '\r\n<tr>\r\n    <td colspan="#COLSPAN#">Actualmente no existen solicitudes sin asignar </td>\r\n  </tr>', 91);
INSERT INTO templates_acciones VALUES (98, 'lista_vacia_mis_solicidudes_responsable', '<tr>\r\n    <td colspan="#COLSPAN#">Actualmente no existen solicitudes sin Procesar</td>\r\n  </tr>', 92);
INSERT INTO templates_acciones VALUES (99, 'lista_vacia_mis_solicitudes_asignador_folio', '<tr>\r\n    <td colspan="#COLSPAN#">No se encontró la solicitud  #BUSCAR#</td>\r\n  </tr>', 93);
INSERT INTO templates_acciones VALUES (100, 'lista_vacia_mis_solicitudes_responsable_folio', '<tr>\r\n    <td colspan="#COLSPAN#">No se encontró la solicitud #BUSCAR#</td>\r\n  </tr>', 94);
INSERT INTO templates_acciones VALUES (101, 'contenedor_mensaje_configuracion', '<table width="101%" border="0" cellspacing="0" cellpadding="0">\r\n    <tr>\r\n      <td width="33">&nbsp;</td>\r\n      <td width="768">&nbsp;</td>\r\n      <td width="38">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center"><h3>Configuraci&oacute;n e instalaci&oacute;n de sistema de gesti&oacute;n de solicitudes.</h3></div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center">Versi&oacute;n 0.1 Beta</div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td><div align="center">La actualizaci&oacute;n de los datos de configuraci&oacute;n se realiz&oacute; correctamente </div></td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n      <td>&nbsp;</td>\r\n    </tr>\r\n  </table>', 95);
INSERT INTO templates_acciones VALUES (104, 'gracias_cambios_realizados', 'Gracias hemos realisado su cambio.', 98);
INSERT INTO templates_acciones VALUES (105, 'password_error', '<div align="center">\r\nLa contrase&ntilde;a ingresada no es la correcta, int&eacute;ntelo nuevamente.\r\n</br></br>\r\n\r\n<a href="index.php?accion=#ACCION#">Volver</a>\r\n</div>', 99);
INSERT INTO templates_acciones VALUES (107, 'contenedor_buscador_solicitudes', '<h3>Consulta de solicitudes</h3>\r\n<table cellspacing="0" cellpadding="0" width="98%" border="0">\r\n    <tbody>\r\n        <tr> \r\n            <td valign="top">\r\n                      \r\n            <table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n              <tr>\r\n                <td><div align="center">#INFORMACION_PARA_EL _USUARIO#</div></td>\r\n              </tr>\r\n              <tr>\r\n                <td><div align="center"></div></td>\r\n              </tr>\r\n              <tr>\r\n                <td><div align="center">\r\n                  <table width="90%" border="0" cellspacing="0" cellpadding="2">\r\n                    <tr>\r\n                      <td width="39%"><div align="right">Buscar por N&ordm; de solicitud:</div></td>\r\n                      <td width="61%"><input id="buscar" name="buscar" type="text" /> \r\n                        &nbsp;&nbsp;(Ejemplo: AA001-00000000)</td>\r\n                    </tr>\r\n                    <tr>\r\n                      <td colspan="2" valign="top">#CAPTCHA#</td>\r\n                    </tr>\r\n                    <tr>\r\n                      <td>&nbsp;</td>\r\n                      <td><input id="buscar2" type="submit" name="buscar2" value="Buscar..." /></td>\r\n                    </tr>\r\n                  </table>\r\n                </div></td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td>&nbsp;</td>\r\n              </tr>\r\n              <tr>\r\n                <td  valign="top">  <div class="wide" id="table-block"></div></td>\r\n              </tr>\r\n            </table>\r\n            <br />\r\n            <div align="center"><br />\r\n            <br />\r\n            #PAGINACION#</div>            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n', 0);
INSERT INTO templates_acciones VALUES (108, 'lista_vacia_mis_solicitudes_ciudadano', '<tr>\r\n    <td colspan="#COLSPAN#">Debe realizar la b&uacute;squeda por su n&uacute;mero de folio</td>\r\n  </tr>', 0);
INSERT INTO templates_acciones VALUES (111, 'contenedor_respuesta_consulta_solicitudes', '<h3>Consulta de solicitudes</h3>\r\n<table width="100%" border="0" cellspacing="2" cellpadding="2">\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo para entregar respuesta: <strong>#PLAZO#</strong><br />\r\n    </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br />\r\n    Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span> </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n      <p>        Dirigida a:<span class="style1"><strong> #SERVICIO#</strong></span><br />\r\n        Entidad : <span class="style1"><strong>#ENTIDAD#</strong></span><br />\r\n        Estado actual: <span class="style1"><strong>#ESTADO#</strong></span></p>\r\n      </div></td>\r\n  </tr>\r\n</table>\r\n', 0);
INSERT INTO templates_acciones VALUES (109, 'lista_vacia_captcha', '<tr>\r\n    <td colspan="#COLSPAN#">Debe ingresar el correctamente el texo de validaci&oacute;n</td>\r\n  </tr>', 0);
INSERT INTO templates_acciones VALUES (110, 'buscador_solicitudes_mensaje_usuarios', 'Para conocer el estado de su solicitud, ingrese el número identificador en el siguiente formulario ', 0);
INSERT INTO templates_acciones VALUES (130, 'subjet_asigna_solicitud', 'Se ha asigando una nueva solicitud de Informaci&oacute;n a su cuenta.', 102);
INSERT INTO templates_acciones VALUES (112, 'contenedor_respuesta_consulta_solicitudes_vacia', '<h3>Consulta de solicitudes</h3>\r\n<table width="100%" border="0" cellspacing="2" cellpadding="2">\r\n  <tr>\r\n    <td>La solicitud buscada no se encuentra en nuestros registros</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n', 0);
INSERT INTO templates_acciones VALUES (128, 'lista_registros_solicitudes_vencer', '<tr>\r\n<td class="style8">&nbsp;&nbsp; &nbsp;#ENTIDAD#</td>\r\n<td class="style8" align="right">&nbsp;&nbsp; &nbsp; #CANTIDAD# </td>\r\n</tr>', 0);
INSERT INTO templates_acciones VALUES (115, 'encabezado_reporte_nivel_solicitud', '<table width="100%" border="0" cellpadding="2" cellspacing="0">\r\n  <tr>\r\n    <td width="11%">Servicio</td>\r\n    <td width="89%">#FILTRO_SERVICIO#</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Entidad</td>\r\n    <td>#FILTRO_ENTIDAD#</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Per&iacute;odo</td>\r\n    <td>#FILTRO_PERIODO#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mes :#FILTRO_MES#</td>\r\n  </tr>\r\n  #FILTROS_EXTRAS#\r\n</table>', 0);
INSERT INTO templates_acciones VALUES (113, 'contenedor_reporte', '<table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">\r\n  <tr>\r\n    <td width="14%">&nbsp;</td>\r\n    <td width="82%">&nbsp;</td>\r\n    <td width="2%">&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="3"><div align="center"><strong>#TITULO_INFORME#</strong></div></td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2">&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2">#ENCABEZADO#</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2" valign="top">#INFORMACION#</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="2"><div align="center">#PAGINACION#</div></td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n</table>', 0);
INSERT INTO templates_acciones VALUES (114, 'contenedor_resultado_anual_registro_reporte', '<tr>\r\n    <td><strong>#CAMPO_0#</strong></td>\r\n    <td><div align="right"><strong>#CAMPO_1#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_2#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_3#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_4#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_5#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_6#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_7#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_8#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_9#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_10#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_11#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_12#</strong></div></td>\r\n    <td><div align="right"><strong>#CAMPO_13#</strong></div></td>\r\n  </tr>', 0);
INSERT INTO templates_acciones VALUES (116, 'encabezado_reporte_nivel_entidad', '<table width="100%" border="0" cellpadding="2" cellspacing="0">\r\n  <tr>\r\n    <td width="11%">Servicio</td>\r\n    <td width="89%">#FILTRO_SERVICIO#</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Entidad</td>\r\n    <td>#FILTRO_ENTIDAD#</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Per&iacute;odo</td>\r\n    <td>#FILTRO_PERIODO#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n  </tr>\r\n   #FILTROS_EXTRAS#\r\n </table>', 0);
INSERT INTO templates_acciones VALUES (117, 'encabezado_reporte_nivel_servicio', '\r\n<table width="100%" border="0" cellpadding="2" cellspacing="0">\r\n  <tr>\r\n    <td width="5%">Servicio</td>\r\n    <td width="95%">#FILTRO_SERVICIO#</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Período</td>\r\n    <td>#FILTRO_PERIODO#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n  </tr>\r\n</table>', 0);
INSERT INTO templates_acciones VALUES (118, 'contenedor_resultado_anual_reporte', '<div class="wide" id="table-block">\r\n<table border="1" cellpadding="2" cellspacing="0" bordercolor="#666666" width="100%" >\r\n   \r\n        <tr  class="header">\r\n            <td>\r\n            <div align="center"><strong>#CATEGORIA#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Ene</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Feb</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Mar</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Abr</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>May</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Jun</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Jul</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Ago</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Sep</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Oct</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Nov</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Dic</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Total</strong></div>\r\n            </td>\r\n        </tr>\r\n       \r\n        #REGISTROS#\r\n        <tr>\r\n            <td>\r\n            <div align="right"><strong>Total</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_1#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_2#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_3#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_4#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_5#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_6#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_7#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_8#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_9#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_10#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_11#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_12#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_13#</strong></div>\r\n            </td>\r\n        </tr>\r\n   \r\n</table>\r\n</div>\r\n', 0);
INSERT INTO templates_acciones VALUES (119, 'contenedor_menu_reportes', '<h3>Reportes (Resumen y/o Detalle)</h3>\r\n<table width="98%" border="0" cellpadding="0" cellspacing="0">\r\n                <tr>\r\n                  <td valign="top"><a href="index.php?accion=#ACCION#&amp;act=1" >Ingresos totales seg&uacute;n per&iacute;odo</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=2" >Ingresos sin asignar</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=3" >Solicitudes en an&aacute;lisis seg&uacute;n tipo</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=4" >Solicitudes denegadas seg&uacute;n causal</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=5" >Solicitudes pr&oacute;ximas a vencer</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=6" >Solicitudes vencidas</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=7" >Solicitudes respondidas con reserva/secreto</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=8" >Solicitudes respondidas sin reserva/secreto</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=9" >Solicitudes derivadas</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=10" >Solicitudes impagas</a><br />\r\n                    <a href="index.php?accion=#ACCION#&amp;act=11" >Ingresos totales por responsable</a><br />                   </td>\r\n                </tr>\r\n                <tr>\r\n                  <td valign="top">&nbsp;</td>\r\n                </tr>\r\n</table>\r\n', 0);
INSERT INTO templates_acciones VALUES (129, 'reporte_cabecera_solitudes_vencer', '<div class="wide" id="table-block">\r\n<table cellspacing="0" cellpadding="0" width="60%" border="1" bordercolor="#666666" >\r\n   \r\n        <tr class="header">\r\n            <td width="70%"> \r\n            <div align="center"><strong>#CATEGORIA#</strong></div>\r\n            </td>\r\n            <td width="30%">\r\n            <div align="center"><strong>Cantidad de solicitudes </strong></div>\r\n            </td>\r\n        </tr>\r\n        #REGISTROS#\r\n        <tr>\r\n            <td>\r\n            <div align="right"><strong>Total</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="right"><strong>#TOTAL_1#</strong></div>\r\n            </td>\r\n        </tr>\r\n   \r\n</table>\r\n</div>', 0);
INSERT INTO templates_acciones VALUES (126, 'encabezado_reporte_nivel_entidad_adicional', '  <tr>\r\n    <td>#COMBO_ADICIONAL#</td>\r\n    <td>#FILTRO_ADICIONAL#</td>\r\n  </tr>\r\n', 0);
INSERT INTO templates_acciones VALUES (127, 'encabezado_reporte_nivel_entidad_dias_vencer', '  <tr>\r\n    <td>D&iacute;as por vencer</td>\r\n    <td>#FILTRO_DIAS#</td>\r\n  </tr>\r\n\r\n', 0);
INSERT INTO templates_acciones VALUES (121, 'contenedor_respuesta_consulta_solicitudes', '<h3>Consulta de solicitudes</h3>\r\n<table width="100%" border="0" cellspacing="2" cellpadding="2">\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo para entregar respuesta: <strong>#PLAZO#</strong><br />\r\n    </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br />\r\n    Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span> </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n      <p>        Dirigida a:<span class="style1"><strong> #SERVICIO#</strong></span><br />\r\n        Entidad : <span class="style1"><strong>#ENTIDAD#</strong></span><br />\r\n        Estado actual: <span class="style1"><strong>#ESTADO#</strong></span></p>\r\n      </div></td>\r\n  </tr>\r\n</table>', 0);
INSERT INTO templates_acciones VALUES (122, 'reporte_cabecera_lista_solicitudes', '<div class="wide" id="table-block">\r\n<table width="100%" border="1" bordercolor="#666666" cellpadding="0" cellspacing="0">\r\n<tbody>\r\n        <tr class="header">\r\n            <td width="30%" bgcolor="f2f2f2" class="style5"><div align="center">N&ordm; de Solicitud</div></td>\r\n          <td width="15%" bgcolor="f2f2f2" class="style5"><div align="center">Fecha Solicitud</div></td>\r\n          <td width="15%" bgcolor="f2f2f2" class="style5"><div align="center">Plazo</div></td>\r\n          <td width="20%" bgcolor="f2f2f2" class="style5"><div align="center">Etapa</div></td>\r\n          <td width="20%" bgcolor="f2f2f2" class="style5"><div align="center">Estado</div></td>\r\n      </tr>\r\n        #LISTA_SOLICITUDES#\r\n    </tbody>\r\n</table>\r\n</div>', 0);
INSERT INTO templates_acciones VALUES (123, 'reporte_linea_lista_solicitudes', '<tr>\r\n<td class="style8">&nbsp;&nbsp; &nbsp;#FOLIO#</td>\r\n<td class="style8">&nbsp;&nbsp; &nbsp; #FECHA_INGRESO#</td>\r\n<td class="style8">&nbsp;&nbsp; &nbsp; #DIAS# &nbsp;d&iacute;as</td>\r\n<td class="style8">&nbsp;&nbsp; &nbsp;#ESTADO_PADRE#</td>\r\n<td class="style8">&nbsp;&nbsp; &nbsp;#ESTADO# </td>\r\n</tr>', 0);
INSERT INTO templates_acciones VALUES (124, 'reporte_detalle_solicitud', '\r\n\r\n\r\n<table width="100%"  border="0" align="left" cellpadding="2" cellspacing="2">\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo para entregar respuesta: <strong>#PLAZO#</strong><br>\r\n    	   </div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br>\r\n   	       Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span> </div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n    	     <table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">\r\n               <tr>\r\n                 <td width="17%">Solicitante:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SOLICITANTE#</strong></span></td>\r\n               </tr>\r\n              #APODERADO#\r\n               <tr>\r\n                 <td>Direcci&oacute;n:</td>\r\n                 <td width="29%"><strong>#DIRECCION#</strong></td>\r\n                 <td width="14%">N&uacute;mero:</td>\r\n                 <td width="19%"><strong>#NUMERO#</strong></td>\r\n                 <td width="12%">Departamento:</td>\r\n                 <td width="9%"><strong>#DEPARTAMENTO#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Correo electr&oacute;nico:</td>\r\n                 <td colspan="3"><strong>#CORREO_ELECTRONICO#</strong></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Regi&oacute;n:</td>\r\n                 <td><strong>#REGION#</strong></td>\r\n                 <td>Comuna:</td>\r\n                 <td><strong>#COMUNA#</strong></td>\r\n                 <td>Ciudad:</td>\r\n                 <td><strong>#CIUDAD#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Dirigida a:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SERVICIO#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Entidad:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#ENTIDAD#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td colspan="6">&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Etapa actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO_PADRE#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Estado actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n             </table>\r\n    	     \r\n    	    \r\n    	 \r\n    	   </div></td>\r\n  	   </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Notificar por correo eletr&oacute;nico</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#MEDIO_NOTIFICACION#</strong> &nbsp;</div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Forma de recepci&oacute;n de la informaci&oacute;n solicitada</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_RECEPCION#</strong> &nbsp; </div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Formato de entrega</strong></td>\r\n  </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_ENTREGA#</strong></div></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Informaci&oacute;n Solicitada </strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#IDENTIFICACION_DOCUMENTOS#</strong></div></td>\r\n     </tr>\r\n      #FIRMADA#\r\n     <tr >\r\n       <td align="left" >&nbsp;</td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #ffffff;padding: 5px; width:600px">#VER_HISTORIAL# </div></td>\r\n     </tr>\r\n  </table>', 0);
INSERT INTO templates_acciones VALUES (125, 'formulario_registro_edicion_funcionario', '\r\n<h3>Mis Datos</h3>\r\n<p align="justify">Los campos indicados con (*) son obligatorios</p>\r\n<fieldset>               <legend>Datos Personales</legend>                              \r\n<br />\r\n<label>Nombres</label> *<br />\r\n#NOMBRES# <br />\r\n<label>Apellido paterno</label>  *<br />\r\n#PATERNO# <br />\r\n<label>Apellido materno</label>  *<br />\r\n#MATERNO#  \r\n<br />  \r\n<label>Tel&eacute;fono</label>\r\n<br />\r\n#FONO# <br />\r\n</fieldset>\r\n<p> </p>\r\n<fieldset>              <legend> #ENTIDAD_PADRE#</legend> <br />                          \r\n<label><strong>#ENTIDAD_HIJA#</strong></label><br />\r\n<br />\r\n</fieldset>\r\n<p> </p>\r\n<fieldset>               <legend>Datos de ingreso al sistema</legend>               <br />\r\n<label>               Direcci&oacute;n de correo electr&oacute;nico</label>  <strong>#MAIL#</strong> <a href="index.php?accion=Actualiza-email">Actualizar correo electr&oacute;nico</a>               <br />\r\n<br />\r\n<label><strong>Solo si desea cambiar su contrase&ntilde;a</strong></label> <br />\r\n<label>Contrase&ntilde;a actual</label>               <br />\r\n#CONTRASENIA_ACTUAL#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA#               M&iacute;nimo  6 caracteres.<br />\r\n<label>Confirme nueva contrase&ntilde;a </label>               <br />\r\n#CONTRASENIA2#               <br />\r\n<br />\r\n</fieldset>\r\n<br />\r\n<div align="center">#CAPTCHA#</div>\r\n<div align="center"><input type="submit" value="Actualizar Datos" id="Registrarse" class="botones" name="Registrarse" /></div>', 101);
INSERT INTO templates_acciones VALUES (136, 'contenedor_listado_solicitudes_finalizadas', '<table cellspacing="0" cellpadding="0" width="98%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">\r\n            <table width="100%" border="0" cellpadding="0" cellspacing="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center"><strong>Panel de Gesti&oacute;n de Solicitudes Finalizadas</strong></div>                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <div align="center">Buscar por N&ordm; de solicitud: \r\n                          <input id="buscar" name="buscar" type="text" /> <input id="buscar2" type="submit" name="buscar2" value="Buscar..." /></div>                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td><strong>Bandeja de Solicitudes</strong></td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td valign="top">\r\n                        <div class="wide" id="table-block">\r\n                        <table cellspacing="0" cellpadding="0">\r\n                            <tbody>\r\n                                <tr class="header2">\r\n                                    <td width="14%">N&ordm; de solicitud</td>\r\n                                    <td width="15%">Fecha  solicitud</td>\r\n                                    <td width="13%">Fecha t&eacute;rmino  solicitud</td>\r\n                                  <td width="14%">Fecha respuesta</td>\r\n                                    <td width="11%">Plazo</td>\r\n                                    <td width="17%">Estado</td>\r\n                                    <td width="16%">Ver</td>\r\n                                </tr>\r\n                                #LISTA_ADMINISTRACION_SOLICITUDES#\r\n                            </tbody>\r\n                        </table>\r\n                        </div>                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            <br />\r\n            <div align="center"><br />\r\n            <br />\r\n            #PAGINACION#</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n', 0);
INSERT INTO templates_acciones VALUES (131, 'registro_tabla_vacio_generico', '<tr>\r\n<td colspan="#COLSPAN#">#MENSAJE#</td>\r\n</tr>', 0);
INSERT INTO templates_acciones VALUES (132, 'subjet_asigna_solicitud', 'Asignación de solicitud', 0);
INSERT INTO templates_acciones VALUES (133, 'cuerpo_asigna_solicitud', 'Estimado #NOMBRE# #PATERNO# #MATERNO#\r\n\r\nSe ha asignado una nueva solictud de informaci&oacute;n, Folio #FOLIO#\r\n\r\n\r\nIngrese a nuestra web #LINK#', 103);
INSERT INTO templates_acciones VALUES (134, 'reporte_cabecera_solitudes_vencer_vacia', '<div class="wide" id="table-block">\r\n<table cellspacing="0" cellpadding="0" width="60%" border="1" bordercolor="#666666" >\r\n   \r\n        <tr class="header">\r\n            <td width="70%"> \r\n            <div align="center"><strong>#CATEGORIA#</strong></div>\r\n            </td>\r\n            <td width="30%">\r\n            <div align="center"><strong>Cantidad de solicitudes </strong></div>\r\n            </td>\r\n        </tr>\r\n        #REGISTROS#\r\n   \r\n</table>\r\n</div>', 0);
INSERT INTO templates_acciones VALUES (135, 'contenedor_resultado_anual_reporte_vacio', '<div class="wide" id="table-block">\r\n<table border="1" cellpadding="2" cellspacing="0" bordercolor="#666666" width="100%" >\r\n   \r\n        <tr  class="header">\r\n            <td>\r\n            <div align="center"><strong>#CATEGORIA#</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Ene</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Feb</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Mar</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Abr</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>May</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Jun</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Jul</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Ago</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Sep</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Oct</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Nov</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Dic</strong></div>\r\n            </td>\r\n            <td>\r\n            <div align="center"><strong>Total</strong></div>\r\n            </td>\r\n        </tr>\r\n       \r\n        #REGISTROS#\r\n      \r\n   \r\n</table>\r\n</div>\r\n', 0);
INSERT INTO templates_acciones VALUES (137, 'linea_lista_solicitudes_finalizadas', '<tr>\r\n\r\n<td>#FOLIO#</td>\r\n\r\n<td>#FECHA_INGRESO# </td>\r\n<td>#FECHA_TERMINO# </td>\r\n<td>#FECHA_RESPUESTA#</td>\r\n<td width="100">#DIAS# &nbsp;d&iacute;as</td>\r\n<td>#ESTADO#</td>\r\n<td class="actions"><a class="edit" href="#LINK#">VER DETALLE</a></td>\r\n\r\n</tr>', 0);
INSERT INTO templates_acciones VALUES (138, 'detalle_solicitud_finalizada', '<table width="100%"  border="0" align="left" cellpadding="2" cellspacing="2">\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #D0E3FB;padding: 5px; width:600px"> Plazo en que la solicitud fue respondida: <strong>#PLAZO#</strong><br>\r\n    	   </div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"> N&ordm; de solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span>&nbsp;<br>\r\n   	       Fecha ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span><br />\r\n   	       Fecha t&eacute;rmino: <span class="style1"><strong>#FECHA_TERMINO#</strong></span> <BR />\r\n   	       Fecha respuesta: <span class="style1"><strong>#FECHA_RESPUESTA#</strong></span></div></td>\r\n  	   </tr>\r\n    	 <tr >\r\n    	   <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px">\r\n    	     <table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">\r\n               <tr>\r\n                 <td width="17%">Solicitante:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SOLICITANTE#</strong></span></td>\r\n               </tr>\r\n              #APODERADO#\r\n               <tr>\r\n                 <td>Direcci&oacute;n:</td>\r\n                 <td width="29%"><strong>#DIRECCION#</strong></td>\r\n                 <td width="14%">N&uacute;mero:</td>\r\n                 <td width="19%"><strong>#NUMERO#</strong></td>\r\n                 <td width="12%">Departamento:</td>\r\n                 <td width="9%"><strong>#DEPARTAMENTO#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Correo electr&oacute;nico:</td>\r\n                 <td colspan="3"><strong>#CORREO_ELECTRONICO#</strong></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Regi&oacute;n:</td>\r\n                 <td><strong>#REGION#</strong></td>\r\n                 <td>Comuna:</td>\r\n                 <td><strong>#COMUNA#</strong></td>\r\n                 <td>Ciudad:</td>\r\n                 <td><strong>#CIUDAD#</strong></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Dirigida a:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#SERVICIO#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Entidad:</td>\r\n                 <td colspan="5"><span class="style1"><strong>#ENTIDAD#</strong></span></td>\r\n               </tr>\r\n               <tr>\r\n                 <td colspan="6">&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Etapa actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO_PADRE#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n               <tr>\r\n                 <td>Estado actual:</td>\r\n                 <td colspan="3"><span class="style1"><strong>#ESTADO#</strong></span></td>\r\n                 <td>&nbsp;</td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n             </table>\r\n    	     \r\n    	    \r\n    	 \r\n    	   </div></td>\r\n  	   </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Notificar por correo eletr&oacute;nico</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#MEDIO_NOTIFICACION#</strong> &nbsp;</div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Forma de recepci&oacute;n de la información solicitada</strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_RECEPCION#</strong> &nbsp; </div></td>\r\n     </tr>\r\n     \r\n     <tr >\r\n       <td align="left" ><strong>Formato de entrega</strong></td>\r\n  </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#FORMA_ENTREGA#</strong></div></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><strong>Informaci&oacute;n Solicitada </strong></td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px"><strong>#IDENTIFICACION_DOCUMENTOS#</strong></div></td>\r\n     </tr>\r\n     #FIRMADA#\r\n     <tr >\r\n       <td align="left" >&nbsp;</td>\r\n     </tr>\r\n     <tr >\r\n       <td align="left" ><div align="left" style="border: 1px solid #999999; background-color: #ffffff;padding: 5px; width:600px">#VER_HISTORIAL# </div></td>\r\n     </tr>\r\n  </table>', 0);
INSERT INTO templates_acciones VALUES (139, 'verificacion_electronico_de_ingreso', '<style type="text/css">\r\n<!--\r\n.style1 {font-weight: bold}\r\n-->\r\n</style>\r\n<img src="images/sitio/sgs/images/logo_gobierno_horizontal.jpg" alt="Gobierno de chile" border="0">\r\n<p align="center">\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px"> \r\n\r\n<table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">\r\n    <tr class="header">\r\n      <td class="texto_rojo"><strong> Si los datos de este borrador son correctos \r\n        presione "Enviar Solicitud". Si requiere modificar su solicitud, presione \r\n        "Volver"</strong></td>\r\n    </tr>\r\n <tr>\r\n      <td align="center" >      </td>\r\n    </tr>\r\n  </table></div><br />\r\n\r\n\r\n\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px"> \r\n  <strong>#USUARIO#</strong> <br />\r\n<br />\r\n  Al validar este borrador usted ingresar&aacute; su solicitud a:<br />\r\n<br />\r\n<strong>#SERVICIO#</strong> <br />\r\n\r\n<strong>#ENTIDAD#</strong> <br />\r\n<br />\r\n  Fecha de Ingreso: <strong>#FECHA# </strong> \r\n  <table width="600" cellpadding="0" cellspacing="0">\r\n    <tbody>\r\n          <tr>\r\n            <td width="291"><strong>Desea notificaci&oacute;n por correo electr&oacute;nico</strong></td>\r\n            <td colspan="3">#MEDIO_NOTIFICACION#     </td>\r\n        </tr>\r\n       <tr>\r\n            <td><strong>Forma de recepci&oacute;n</strong></td>\r\n            <td colspan="3">#FORMA_RECEPCION#     </td>\r\n      </tr>\r\n      #RETIRO_OFICINA# \r\n       <tr>\r\n            <td><strong>Formato de entrega</strong></td>\r\n            <td colspan="3">#FORMA_ENTREGA#     </td>\r\n    </tr>\r\n      \r\n        <tr>\r\n          <td>  </td>\r\n          <td width="26">  </td>\r\n          <td width="64">  </td>\r\n          <td width="217">  </td>\r\n        </tr>\r\n       \r\n        <tr>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n          <td>  </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<br />\r\n\r\n\r\n</div>\r\n \r\n <br />\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px">\r\n  <table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">\r\n    <tr class="header">\r\n      <td ><strong>Informaci&oacute;n solicitada</strong></td>\r\n    </tr>\r\n    <tr>\r\n      <td >#OBS#</td>\r\n    </tr>\r\n  <tr>\r\n      <td > </td>\r\n    </tr>\r\n <tr>\r\n      <td align="center" >\r\n      </td>\r\n    </tr>\r\n  </table>\r\n\r\n</div>\r\n<br />\r\n\r\n<div align="left" style="border: 1px solid #999999; background-color: #FFFFFF;padding: 5px; width:600px">\r\n  <table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">\r\n    <tr class="header">\r\n      <td class="texto_rojo"><strong> Si los datos de este borrador son correctos \r\n        presione "Enviar Solicitud". Si requiere modificar su solicitud, presione \r\n        "Volver"</strong></td>\r\n    </tr>\r\n <tr>\r\n      <td align="center" >      </td>\r\n    </tr>\r\n  </table>\r\n\r\n</div>\r\n  <div align="center"><br/>\r\n    #LINK_ACEPTAR#    \r\n</div>', 104);
INSERT INTO templates_acciones VALUES (140, 'lista_vacia_mis_solicitudes_responsable', '<tr>\r\n<td colspan="#COLSPAN#">No se encontraron solicitudes con los criterios seleccionados</td>\r\n</tr>', 0);
INSERT INTO templates_acciones VALUES (141, 'subjet_ingreso_solicitud', 'Se ha Ingresado una nueva solicitud de informaci&oacute;n folio #FOLIO#', 105);
INSERT INTO templates_acciones VALUES (142, 'cuerpo_ingreso_solicitud', 'Estimado #NOMBRE# #PATERNO# #MATERNO#\r\n\r\nSe ha ingresado una nueva solictud de informaci&oacute;n, Folio #FOLIO#\r\n\r\n\r\nIngrese a nuestra web #LINK#', 106);
INSERT INTO templates_acciones VALUES (143, 'mensaje_actualizar_datos_contrasena', '<h3>Mis Datos</h3>\r\n<p>Muchas gracias, sus datos incluyendo su contrase&ntilde;a han sido actualizados exitosamente.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n\r\n', 0);
INSERT INTO templates_acciones VALUES (144, 'mensaje_configuracion_guardada', 'Gracias Configuraci&oacute;n Guardada\r\n<br><br><br><br><br><br>', 0);

#
# Volcar la base de datos para la tabla `templates_acciones_etiquetas`
#
truncate table  templates_acciones_etiquetas;
INSERT INTO templates_acciones_etiquetas VALUES (1, 'INTERLINEADO', 'clase', 56, 1);
INSERT INTO templates_acciones_etiquetas VALUES (2, 'FOLIO', '', 56, 2);
INSERT INTO templates_acciones_etiquetas VALUES (3, 'FECHA_INGRESO', '', 56, 3);
INSERT INTO templates_acciones_etiquetas VALUES (4, 'FECHA_TERMINO', '', 56, 4);
INSERT INTO templates_acciones_etiquetas VALUES (5, 'DIAS', '', 56, 5);
INSERT INTO templates_acciones_etiquetas VALUES (6, 'ESTADO', 'estado_padre', 56, 6);
INSERT INTO templates_acciones_etiquetas VALUES (7, 'LINK', 'link_editar', 56, 7);
INSERT INTO templates_acciones_etiquetas VALUES (8, 'ESTADO_PADRE', 'estado_solicitud', 56, 8);
INSERT INTO templates_acciones_etiquetas VALUES (9, 'NOMBRE', '', 93, 9);
INSERT INTO templates_acciones_etiquetas VALUES (10, 'PATERNO', '', 93, 10);
INSERT INTO templates_acciones_etiquetas VALUES (11, 'ID_USUARIO', 'id_user_u', 93, 11);
INSERT INTO templates_acciones_etiquetas VALUES (12, 'EMAIL', 'email', 93, 12);
INSERT INTO templates_acciones_etiquetas VALUES (13, 'ENTIDAD', 'depto', 93, 13);
INSERT INTO templates_acciones_etiquetas VALUES (14, 'IMG_ESTADO', 'link_activo', 93, 14);
INSERT INTO templates_acciones_etiquetas VALUES (15, 'PERFIL', 'perfil', 93, 15);
INSERT INTO templates_acciones_etiquetas VALUES (16, 'LINK_DEL', 'link_del', 93, 16);
INSERT INTO templates_acciones_etiquetas VALUES (17, 'LINK_EDIT', 'link_edit', 93, 17);

#
# Volcar la base de datos para la tabla `tipo_cont_cat_grupo_productos`
#

truncate table  tipo_cont_cat_grupo_productos;


#
# Volcar la base de datos para la tabla `tipo_persona`
#
truncate table  tipo_persona;
INSERT INTO tipo_persona VALUES (1, 'Natural', 1);
INSERT INTO tipo_persona VALUES (2, 'Jur&iacute;dica', 2);

#
# Volcar la base de datos para la tabla `usuario_amigo`
#
truncate table  usuario_amigo;


#
# Volcar la base de datos para la tabla `usuario_cambio_email`
#
truncate table  usuario_cambio_email;

#
# Volcar la base de datos para la tabla `usuario_cambio_pass`
#


#
# Volcar la base de datos para la tabla `usuario_establecimientos`
#
truncate table  usuario_establecimientos;
INSERT INTO usuario_establecimientos VALUES (22, 3);
INSERT INTO usuario_establecimientos VALUES (22, 5);
INSERT INTO usuario_establecimientos VALUES (5, 2);
INSERT INTO usuario_establecimientos VALUES (22, 6);

#
# Volcar la base de datos para la tabla `usuario_frecuencia_organizacion`
#
truncate table  usuario_frecuencia_organizacion;
INSERT INTO usuario_frecuencia_organizacion VALUES (3, 'Frecuentemente', 1);
INSERT INTO usuario_frecuencia_organizacion VALUES (4, 'De vez en cuando', 2);
INSERT INTO usuario_frecuencia_organizacion VALUES (5, 'Casi nunca', 3);
INSERT INTO usuario_frecuencia_organizacion VALUES (6, 'S&oacute;lo estoy inscrito', 4);

#
# Volcar la base de datos para la tabla `usuario_nacionalidad`
#
truncate table  usuario_nacionalidad;
INSERT INTO usuario_nacionalidad VALUES (1, 'chilena', 1);
INSERT INTO usuario_nacionalidad VALUES (2, 'Otras Nacionalidades', 2);

#
# Volcar la base de datos para la tabla `usuario_nivel_educacional`
#
truncate table  usuario_nivel_educacional;
INSERT INTO usuario_nivel_educacional VALUES (4, 'B&aacute;sica Incompleta', 1);
INSERT INTO usuario_nivel_educacional VALUES (5, 'B&aacute;sica Completa', 2);
INSERT INTO usuario_nivel_educacional VALUES (6, 'Media Incompleta', 3);
INSERT INTO usuario_nivel_educacional VALUES (7, 'Media Completa', 4);
INSERT INTO usuario_nivel_educacional VALUES (8, 'Educaci&oacute;n T&eacute;cnica/Profesional', 5);
INSERT INTO usuario_nivel_educacional VALUES (9, 'Universitaria', 6);
INSERT INTO usuario_nivel_educacional VALUES (10, 'Postgrado(Master, Doctorado)', 7);
INSERT INTO usuario_nivel_educacional VALUES (11, 'Sin Educaci&oacute;n', 8);

#
# Volcar la base de datos para la tabla `usuario_ocupacion`
#
truncate table  usuario_ocupacion;
ALTER TABLE usuario_ocupacion CHANGE ocupacion ocupacion VARCHAR( 255 ) NOT NULL;
INSERT INTO usuario_ocupacion VALUES (4, 'Due&ntilde;a/o de casa', 1);
INSERT INTO usuario_ocupacion VALUES (5, 'Estudiante', 2);
INSERT INTO usuario_ocupacion VALUES (6, 'Jubilado/a- Pensionado/a', 3);
INSERT INTO usuario_ocupacion VALUES (7, 'Cesante', 4);
INSERT INTO usuario_ocupacion VALUES (8, 'Trabajador/a asalariado/a', 5);
INSERT INTO usuario_ocupacion VALUES (9, 'Patr&oacute;n/a - Empleador/a Empresario', 6);
INSERT INTO usuario_ocupacion VALUES (10, 'Trabajador/a independiente', 7);
INSERT INTO usuario_ocupacion VALUES (11, 'Trabajador/a servicio dom&eacute;stico', 8);
INSERT INTO usuario_ocupacion VALUES (12, 'Investigador / Acad&eacute;mico', 9);
INSERT INTO usuario_ocupacion VALUES (13, 'Periodista', 10);
INSERT INTO usuario_ocupacion VALUES (14, 'Funcionario p&uacute;blico', 11);
INSERT INTO usuario_ocupacion VALUES (15, 'Miembro de organizaci&oacute;n de la sociedad civil', 12);
INSERT INTO usuario_ocupacion VALUES (16, 'miembro de gremio empresarial', 13);
INSERT INTO usuario_ocupacion VALUES (17, 'Miembro de gremio / asociaci&oacute;n / sindicato', 14);
INSERT INTO usuario_ocupacion VALUES (18, 'Otra', 15);

#
# Volcar la base de datos para la tabla `usuario_organizacion`
#
truncate table  usuario_organizacion;
INSERT INTO usuario_organizacion VALUES (3, 'Centro de padres', 1);
INSERT INTO usuario_organizacion VALUES (4, 'Club deportivo', 2);
INSERT INTO usuario_organizacion VALUES (5, 'Colegios profesionales/t&eacute;cnicos', 3);
INSERT INTO usuario_organizacion VALUES (6, 'Cooperativas', 4);
INSERT INTO usuario_organizacion VALUES (7, 'Iglesia/entidades religiosas', 5);
INSERT INTO usuario_organizacion VALUES (8, 'Organizaci&oacute;n de adultos mayores', 6);
INSERT INTO usuario_organizacion VALUES (9, 'Organizaci&oacute;n de mujeres', 7);
INSERT INTO usuario_organizacion VALUES (10, 'Organizaci&oacute;n juvenil/estudiantil', 8);
INSERT INTO usuario_organizacion VALUES (11, 'Organizaci&oacute;n vecinal', 9);
INSERT INTO usuario_organizacion VALUES (12, 'Participaci&oacute;n pol&iacute;tica', 10);
INSERT INTO usuario_organizacion VALUES (13, 'Organizaci&oacute;n sindical', 11);
INSERT INTO usuario_organizacion VALUES (14, 'Organizaci&oacute;n cultural', 12);
INSERT INTO usuario_organizacion VALUES (15, 'Organizaci&oacute;n medioambiental', 13);
INSERT INTO usuario_organizacion VALUES (16, 'Otras organizaciones', 14);

#
# Volcar la base de datos para la tabla `usuario_perfil`
#
truncate table  usuario_perfil;
INSERT INTO usuario_perfil VALUES (1, 'Registrado', '?accion=Mis-Solicitudes', 1, 6, 0, 0, 0);
INSERT INTO usuario_perfil VALUES (4, 'NB', '?accion=Home', 1, 7, 0, 0, 0);
INSERT INTO usuario_perfil VALUES (999, 'WM', '?accion=Acciones', 1, 8, 1, 0, 0);
INSERT INTO usuario_perfil VALUES (5, 'Responsable', '?accion=gestion-de-solicitudes', 1, 5, 0, 1, 1);
INSERT INTO usuario_perfil VALUES (1001, 'Jefatura', '?accion=gestion-de-solicitudes', 1, 1, 0, 1, 0);
INSERT INTO usuario_perfil VALUES (1003, 'Asignador', '?accion=Asignar-solicitudes', 1, 4, 0, 1, 1);
INSERT INTO usuario_perfil VALUES (2, 'papel', '', 0, 10, 0, 0, 0);
INSERT INTO usuario_perfil VALUES (1004, 'Administrador Sistema', '?accion=Gestion-de-Usuarios', 1, 2, 0, 1, 0);
INSERT INTO usuario_perfil VALUES (1005, 'Digitador', '?accion=Ingreso-de-solicitudes', 1, 3, 0, 1, 0);

#
# Volcar la base de datos para la tabla `usuario_perfil_relacion`
#


#
# Volcar la base de datos para la tabla `usuario_perfiles`
#
truncate table  usuario_perfiles;
INSERT INTO usuario_perfiles VALUES (22, 10);
INSERT INTO usuario_perfiles VALUES (22, 14);
INSERT INTO usuario_perfiles VALUES (37, 11);
INSERT INTO usuario_perfiles VALUES (22, 3);
INSERT INTO usuario_perfiles VALUES (181, 1);

#
# Volcar la base de datos para la tabla `usuario_rango_edad`
#
truncate table  usuario_rango_edad;
INSERT INTO usuario_rango_edad VALUES (1, 'Menor de 18 años', 1);
INSERT INTO usuario_rango_edad VALUES (2, '19-29', 2);
INSERT INTO usuario_rango_edad VALUES (3, '30-49', 3);
INSERT INTO usuario_rango_edad VALUES (4, '50-69', 4);
INSERT INTO usuario_rango_edad VALUES (5, '70 &oacute; superior', 5);

#
# Volcar la base de datos para la tabla `usuario_sexo`
#
truncate table  usuario_sexo;
INSERT INTO usuario_sexo VALUES (1, 'Masculino', 1);
INSERT INTO usuario_sexo VALUES (2, 'Femenino', 2);

#
# Volcar la base de datos para la tabla `usuarios_newsletter`
#
truncate table  usuarios_newsletter;
INSERT INTO usuarios_newsletter VALUES (1, 'rrosende@minsegpres.gov.cl', '2008-12-16', 0);


delete from cms_configuracion where id_configuracion=1;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (1, 'registros_por_pagina', '10', '<p>Configura las l&iacute;neas o registros por cada pantalla con listas del sistema</p>', 0, 1, 0, 0);
delete from cms_configuracion where id_configuracion=7;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (7, 'dias_de_plazo_prorroga', '10', 'Dias habiles de prorroga que se asigna', 0, 6, 0, 0) ;
delete from cms_configuracion where id_configuracion=8;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (8, 'id_prorroga', '25', '', 0, 7, 0, 0) ;
delete from cms_configuracion where id_configuracion=9;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (9, 'observacion_prorroga', 'La solicitud ha sido prorrogada', '', 0, 8, 0, 0);
delete from cms_configuracion where id_configuracion=10;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (10, 'mensaje_cambio_estado', 'El cambio de estado fue realizado correctamente', '', 0, 9, 0, 0);
delete from cms_configuracion where id_configuracion=14;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (14, 'Etapa_fin', '13', '<p>Representa el estado de finalizacion de una solicitud con esto verificamos el&nbsp;ID si la solicutud tiene estado ID la sacamos de la lista</p>', 0, 14, 0, 0);
delete from cms_configuracion where id_configuracion=20;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (20, 'aviso_solicitud_ingresada', '1', '<p>Si desea que el sistema env&iacute;e un mail a los asignadores de responsabilidad cuando ingrese una nueva solicitud ingrese &quot;1&quot;&nbsp;.Ingrese  &quot;0&quot; si no desea que el sistema env&iacute;e avisos.</p>\r\n', 1, 20, 0, 0);
delete from cms_configuracion where id_configuracion=21;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (21, 'aviso_solicitud_asignada', '1', '<p>Si desea que el sistema env&iacute;e un mail cuando se asigne una solicitud al usuario responsable, ingrese &quot;1&quot; . Ingrese &quot;0&quot; si no desea que el sistema env&iacute;e un mail .</p>\r\n', 1, 21, 0, 0) ;
delete from cms_configuracion where id_configuracion=22;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (22, 'version', '<a href="index.php?accion=licencia">SGS 1.022</a>', '<p>Versi&oacute;n del SGS</p>', 0, 22, 0, 0);
delete from cms_configuracion where id_configuracion=23;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (23, 'Estados_etapa_fin', '16,17,18,19,20,21,22,23,24', 'Estas estapas seran consideradas dentro del js que filtra los id_estados para enviar mensaje de advertencia', 0, 0, 0, 0) ;
delete from cms_configuracion where id_configuracion=24;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (24, 'phpmailer', '1', '<p>Utilizar Phpmailer para el envi&oacute; de correos, en algunos caso el uso de esta librer&iacute;a no env&iacute;a los correos, si se desactiva el envi&oacute; de correos ser&aacute; por medio de la instrucci&oacute;n mail nativa de php.</p>', 1, 23, 0, 0) ;
delete from cms_configuracion where id_configuracion=25;
INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (25, 'firma_envio_mails', 'Este es un mensaje autom&aacute;tico enviado por el sistema inform&aacute;tico.No responda ni env&iacute;e mensajes a esta direcci&oacute;n de correo electr&oacute;nico ya que esta cuenta no se controla.', '<p>Firma que se le dar&aacute; a todos los mails que se env&iacute;e mediante el sistema, por lo cual deber&iacute;a ser gen&eacute;rico.</p>', 1, 24, 1, 0) ;


update sgs_tramos set condicion_vencimiento_dias_habiles = '0,-4' where id_tramo = 4;
update sgs_tramos set condicion_vencimiento_dias_habiles = '-5,menor' where id_tramo = 5;

