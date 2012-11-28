# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# servidor: localhost
# Tiempo de generación: 25-02-2008 a las 10:03:12
# Versión del servidor: 4.00.00
# Versión de PHP: 4.2.3
# Base de datos : `4ruedas`
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `comunas`
#

CREATE TABLE comunas (
  id_comuna int(11) NOT NULL auto_increment,
  id_region int(11) NOT NULL default '0',
  comuna varchar(150) NOT NULL default '',
  PRIMARY KEY  (id_comuna)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `comunas`
#

INSERT INTO comunas VALUES (1, 1, 'Alto Hospicio');
INSERT INTO comunas VALUES (2, 1, 'Camina');
INSERT INTO comunas VALUES (3, 1, 'Colchane');
INSERT INTO comunas VALUES (4, 1, 'Huara');
INSERT INTO comunas VALUES (5, 1, 'Iquique');
INSERT INTO comunas VALUES (6, 1, 'Pica');
INSERT INTO comunas VALUES (7, 1, 'Pozo Almonte');
INSERT INTO comunas VALUES (8, 2, 'Antofagasta');
INSERT INTO comunas VALUES (9, 2, 'Calama');
INSERT INTO comunas VALUES (10, 2, 'Mar&iacute;a Elena');
INSERT INTO comunas VALUES (11, 2, 'Mejillones');
INSERT INTO comunas VALUES (12, 2, 'Ollague');
INSERT INTO comunas VALUES (13, 2, 'San Pedro Atacama');
INSERT INTO comunas VALUES (14, 2, 'Sierra Gorda');
INSERT INTO comunas VALUES (15, 2, 'Taltal');
INSERT INTO comunas VALUES (16, 2, 'Tocopilla');
INSERT INTO comunas VALUES (17, 3, 'Alto del Carmen');
INSERT INTO comunas VALUES (18, 3, 'Caldera');
INSERT INTO comunas VALUES (19, 3, 'Cha&ntilde;aral');
INSERT INTO comunas VALUES (20, 3, 'Copiap&oacute;');
INSERT INTO comunas VALUES (21, 3, 'Diego de Almagro');
INSERT INTO comunas VALUES (22, 3, 'Freirina');
INSERT INTO comunas VALUES (23, 3, 'Huasco');
INSERT INTO comunas VALUES (24, 3, 'Tierra Amarilla');
INSERT INTO comunas VALUES (25, 3, 'Vallenar');
INSERT INTO comunas VALUES (26, 4, 'Andacollo');
INSERT INTO comunas VALUES (27, 4, 'Canela');
INSERT INTO comunas VALUES (28, 4, 'Combarbal&aacute;');
INSERT INTO comunas VALUES (29, 4, 'Coquimbo');
INSERT INTO comunas VALUES (30, 4, 'Illapel');
INSERT INTO comunas VALUES (31, 4, 'La Higuera');
INSERT INTO comunas VALUES (32, 4, 'La Serena');
INSERT INTO comunas VALUES (33, 4, 'Los Vilos');
INSERT INTO comunas VALUES (34, 4, 'Monte Patria');
INSERT INTO comunas VALUES (35, 4, 'Ovalle');
INSERT INTO comunas VALUES (36, 4, 'Paihuano');
INSERT INTO comunas VALUES (37, 4, 'Punitaqui');
INSERT INTO comunas VALUES (38, 4, 'R&iacute;o Hurtado');
INSERT INTO comunas VALUES (39, 4, 'Salamanca');
INSERT INTO comunas VALUES (40, 4, 'Vicu&ntilde;a');
INSERT INTO comunas VALUES (41, 5, 'Algarrobo');
INSERT INTO comunas VALUES (42, 5, 'Cabildo');
INSERT INTO comunas VALUES (43, 5, 'Calle Larga');
INSERT INTO comunas VALUES (44, 5, 'Cartagena');
INSERT INTO comunas VALUES (45, 5, 'Casablanca');
INSERT INTO comunas VALUES (46, 5, 'Catemu');
INSERT INTO comunas VALUES (47, 5, 'Con - Con');
INSERT INTO comunas VALUES (48, 5, 'El Quisco');
INSERT INTO comunas VALUES (49, 5, 'El Tabo');
INSERT INTO comunas VALUES (50, 5, 'Hijuelas');
INSERT INTO comunas VALUES (51, 5, 'Isla de Pascua');
INSERT INTO comunas VALUES (52, 5, 'Juan Fern&aacute;ndez');
INSERT INTO comunas VALUES (53, 5, 'La Calera');
INSERT INTO comunas VALUES (54, 5, 'La Cruz');
INSERT INTO comunas VALUES (55, 5, 'La Ligua');
INSERT INTO comunas VALUES (56, 5, 'Limache');
INSERT INTO comunas VALUES (57, 5, 'Llay llay');
INSERT INTO comunas VALUES (58, 5, 'Los Andes');
INSERT INTO comunas VALUES (59, 5, 'Nogales');
INSERT INTO comunas VALUES (60, 5, 'Olmu&eacute;');
INSERT INTO comunas VALUES (61, 5, 'Panquehue');
INSERT INTO comunas VALUES (62, 5, 'Papudo');
INSERT INTO comunas VALUES (63, 5, 'Petorca');
INSERT INTO comunas VALUES (64, 5, 'Puchuncavi');
INSERT INTO comunas VALUES (65, 5, 'Putaendo');
INSERT INTO comunas VALUES (66, 5, 'Quillota');
INSERT INTO comunas VALUES (67, 5, 'Quilpue');
INSERT INTO comunas VALUES (68, 5, 'Quintero');
INSERT INTO comunas VALUES (69, 5, 'Rinconada');
INSERT INTO comunas VALUES (70, 5, 'San Antonio');
INSERT INTO comunas VALUES (71, 5, 'San Esteban');
INSERT INTO comunas VALUES (72, 5, 'San Felipe');
INSERT INTO comunas VALUES (73, 5, 'Santa Mar&iacute;a');
INSERT INTO comunas VALUES (74, 5, 'Santo Domingo');
INSERT INTO comunas VALUES (75, 5, 'Valpara&iacute;so');
INSERT INTO comunas VALUES (76, 5, 'Villa Alemana');
INSERT INTO comunas VALUES (77, 5, 'Vi&ntilde;a del Mar');
INSERT INTO comunas VALUES (78, 5, 'Zapallar');
INSERT INTO comunas VALUES (79, 6, 'Chepica');
INSERT INTO comunas VALUES (80, 6, 'Chimbarongo');
INSERT INTO comunas VALUES (81, 6, 'Codegua');
INSERT INTO comunas VALUES (82, 6, 'Coinco');
INSERT INTO comunas VALUES (83, 6, 'Coltauco');
INSERT INTO comunas VALUES (84, 6, 'Donihue');
INSERT INTO comunas VALUES (85, 6, 'Graneros');
INSERT INTO comunas VALUES (86, 6, 'La Estrella');
INSERT INTO comunas VALUES (87, 6, 'Las Cabras');
INSERT INTO comunas VALUES (88, 6, 'Litueche');
INSERT INTO comunas VALUES (89, 6, 'Lolol');
INSERT INTO comunas VALUES (90, 6, 'Machali');
INSERT INTO comunas VALUES (91, 6, 'Malloa');
INSERT INTO comunas VALUES (92, 6, 'Marchigue');
INSERT INTO comunas VALUES (93, 6, 'Nancagua');
INSERT INTO comunas VALUES (94, 6, 'Navidad');
INSERT INTO comunas VALUES (95, 6, 'Olivar');
INSERT INTO comunas VALUES (96, 6, 'Palmilla');
INSERT INTO comunas VALUES (97, 6, 'Paredones');
INSERT INTO comunas VALUES (98, 6, 'Peralillo');
INSERT INTO comunas VALUES (99, 6, 'Peumo');
INSERT INTO comunas VALUES (100, 6, 'Pichidegua');
INSERT INTO comunas VALUES (101, 6, 'Pichilemu');
INSERT INTO comunas VALUES (102, 6, 'Placilla');
INSERT INTO comunas VALUES (103, 6, 'Pumanque');
INSERT INTO comunas VALUES (104, 6, 'Quinta de Tilcoco');
INSERT INTO comunas VALUES (105, 6, 'Rancagua');
INSERT INTO comunas VALUES (106, 6, 'Rengo');
INSERT INTO comunas VALUES (107, 6, 'Requinoa');
INSERT INTO comunas VALUES (108, 6, 'San Fernando');
INSERT INTO comunas VALUES (109, 6, 'San Vicente');
INSERT INTO comunas VALUES (110, 6, 'Santa Cruz');
INSERT INTO comunas VALUES (111, 6, 'Sn. Fco. de Mostazal');
INSERT INTO comunas VALUES (112, 7, 'Cauquenes');
INSERT INTO comunas VALUES (113, 7, 'Chanco');
INSERT INTO comunas VALUES (114, 7, 'Colb&uacute;n');
INSERT INTO comunas VALUES (115, 7, 'Constituci&oacute;n');
INSERT INTO comunas VALUES (116, 7, 'Curepto');
INSERT INTO comunas VALUES (117, 7, 'Curico');
INSERT INTO comunas VALUES (118, 7, 'Empedrado');
INSERT INTO comunas VALUES (119, 7, 'Hualane');
INSERT INTO comunas VALUES (120, 7, 'Licanten');
INSERT INTO comunas VALUES (121, 7, 'Linares');
INSERT INTO comunas VALUES (122, 7, 'Longavi');
INSERT INTO comunas VALUES (123, 7, 'Maule');
INSERT INTO comunas VALUES (124, 7, 'Molina');
INSERT INTO comunas VALUES (125, 7, 'Parral');
INSERT INTO comunas VALUES (126, 7, 'Pelarco');
INSERT INTO comunas VALUES (127, 7, 'Pelluhue');
INSERT INTO comunas VALUES (128, 7, 'Pencahue');
INSERT INTO comunas VALUES (129, 7, 'Rauco');
INSERT INTO comunas VALUES (130, 7, 'Retiro');
INSERT INTO comunas VALUES (131, 7, 'Rio Claro');
INSERT INTO comunas VALUES (132, 7, 'Romeral');
INSERT INTO comunas VALUES (133, 7, 'Sagrada Familia');
INSERT INTO comunas VALUES (134, 7, 'San Clemente');
INSERT INTO comunas VALUES (135, 7, 'San Javier');
INSERT INTO comunas VALUES (136, 7, 'San Rafael');
INSERT INTO comunas VALUES (137, 7, 'Talca');
INSERT INTO comunas VALUES (138, 7, 'Teno');
INSERT INTO comunas VALUES (139, 7, 'Vichuqu&eacute;n');
INSERT INTO comunas VALUES (140, 7, 'Villa Alegre');
INSERT INTO comunas VALUES (141, 7, 'Yerbas Buenas');
INSERT INTO comunas VALUES (142, 8, 'Alto Biobio');
INSERT INTO comunas VALUES (143, 8, 'Antuco');
INSERT INTO comunas VALUES (144, 8, 'Arauco');
INSERT INTO comunas VALUES (145, 8, 'Bulnes');
INSERT INTO comunas VALUES (146, 8, 'Cabrero');
INSERT INTO comunas VALUES (147, 8, 'Canete');
INSERT INTO comunas VALUES (148, 8, 'Chiguayante');
INSERT INTO comunas VALUES (149, 8, 'Chillan');
INSERT INTO comunas VALUES (150, 8, 'Chillan Viejo');
INSERT INTO comunas VALUES (151, 8, 'Cobquecura');
INSERT INTO comunas VALUES (152, 8, 'Coelemu');
INSERT INTO comunas VALUES (153, 8, 'Coihueco');
INSERT INTO comunas VALUES (154, 8, 'Concepci&oacute;n');
INSERT INTO comunas VALUES (155, 8, 'Contulmo');
INSERT INTO comunas VALUES (156, 8, 'Coronel');
INSERT INTO comunas VALUES (157, 8, 'Curanilahue');
INSERT INTO comunas VALUES (158, 8, 'El Carmen');
INSERT INTO comunas VALUES (159, 8, 'Florida');
INSERT INTO comunas VALUES (160, 8, 'Hualpen');
INSERT INTO comunas VALUES (161, 8, 'Hualqui');
INSERT INTO comunas VALUES (162, 8, 'Laja');
INSERT INTO comunas VALUES (163, 8, 'Lebu');
INSERT INTO comunas VALUES (164, 8, 'Los Alamos');
INSERT INTO comunas VALUES (165, 8, 'Los Angeles');
INSERT INTO comunas VALUES (166, 8, 'Lota');
INSERT INTO comunas VALUES (167, 8, 'Mulchen');
INSERT INTO comunas VALUES (168, 8, 'Nacimiento');
INSERT INTO comunas VALUES (169, 8, 'Negrete');
INSERT INTO comunas VALUES (170, 8, 'Ninhue');
INSERT INTO comunas VALUES (171, 8, 'Niquen');
INSERT INTO comunas VALUES (172, 8, 'Pemuco');
INSERT INTO comunas VALUES (173, 8, 'Penco');
INSERT INTO comunas VALUES (174, 8, 'Pinto');
INSERT INTO comunas VALUES (175, 8, 'Portezuelo');
INSERT INTO comunas VALUES (176, 8, 'Quilaco');
INSERT INTO comunas VALUES (177, 8, 'Quilleco');
INSERT INTO comunas VALUES (178, 8, 'Quillon');
INSERT INTO comunas VALUES (179, 8, 'Quirihue');
INSERT INTO comunas VALUES (180, 8, 'Ranquil');
INSERT INTO comunas VALUES (181, 8, 'San Carlos');
INSERT INTO comunas VALUES (182, 8, 'San Fabian');
INSERT INTO comunas VALUES (183, 8, 'San Ignacio');
INSERT INTO comunas VALUES (184, 8, 'San Nicol&aacute;s');
INSERT INTO comunas VALUES (185, 8, 'San Pedro de la Paz');
INSERT INTO comunas VALUES (186, 8, 'San Rosendo');
INSERT INTO comunas VALUES (187, 8, 'Santa Barbara');
INSERT INTO comunas VALUES (188, 8, 'Santa Juana');
INSERT INTO comunas VALUES (189, 8, 'Talcahuano');
INSERT INTO comunas VALUES (190, 8, 'Tirua');
INSERT INTO comunas VALUES (191, 8, 'Tome');
INSERT INTO comunas VALUES (192, 8, 'Trehuaco');
INSERT INTO comunas VALUES (193, 8, 'Tucapel');
INSERT INTO comunas VALUES (194, 8, 'Yumbel');
INSERT INTO comunas VALUES (195, 8, 'Yungay');
INSERT INTO comunas VALUES (196, 9, 'Angol');
INSERT INTO comunas VALUES (197, 9, 'Carahue');
INSERT INTO comunas VALUES (198, 9, 'Cholchol');
INSERT INTO comunas VALUES (199, 9, 'Collipulli');
INSERT INTO comunas VALUES (200, 9, 'Cunco');
INSERT INTO comunas VALUES (201, 9, 'Curacautin');
INSERT INTO comunas VALUES (202, 9, 'Curarrehue');
INSERT INTO comunas VALUES (203, 9, 'Ercilla');
INSERT INTO comunas VALUES (204, 9, 'Freire');
INSERT INTO comunas VALUES (205, 9, 'Galvarino');
INSERT INTO comunas VALUES (206, 9, 'Gorbea');
INSERT INTO comunas VALUES (207, 9, 'Lautaro');
INSERT INTO comunas VALUES (208, 9, 'Loncoche');
INSERT INTO comunas VALUES (209, 9, 'Lonquimay');
INSERT INTO comunas VALUES (210, 9, 'Los Sauces');
INSERT INTO comunas VALUES (211, 9, 'Lumaco');
INSERT INTO comunas VALUES (212, 9, 'Melipeuco');
INSERT INTO comunas VALUES (213, 9, 'Nueva Imperial');
INSERT INTO comunas VALUES (214, 9, 'Padre las Casas');
INSERT INTO comunas VALUES (215, 9, 'Perquenco');
INSERT INTO comunas VALUES (216, 9, 'Pitrufquen');
INSERT INTO comunas VALUES (217, 9, 'Puc&oacute;n');
INSERT INTO comunas VALUES (218, 9, 'Puren');
INSERT INTO comunas VALUES (219, 9, 'Renaico');
INSERT INTO comunas VALUES (220, 9, 'Saavedra');
INSERT INTO comunas VALUES (221, 9, 'Temuco');
INSERT INTO comunas VALUES (222, 9, 'Teodoro Schmidt');
INSERT INTO comunas VALUES (223, 9, 'Tolt&eacute;n');
INSERT INTO comunas VALUES (224, 9, 'Traiguen');
INSERT INTO comunas VALUES (225, 9, 'Victoria');
INSERT INTO comunas VALUES (226, 9, 'Vilcun');
INSERT INTO comunas VALUES (227, 9, 'Villarrica');
INSERT INTO comunas VALUES (228, 10, 'Ancud');
INSERT INTO comunas VALUES (229, 10, 'Calbuco');
INSERT INTO comunas VALUES (230, 10, 'Castro');
INSERT INTO comunas VALUES (231, 10, 'Chaiten');
INSERT INTO comunas VALUES (232, 10, 'Chonchi');
INSERT INTO comunas VALUES (233, 10, 'Cochamo');
INSERT INTO comunas VALUES (234, 10, 'Curaco de Velez');
INSERT INTO comunas VALUES (235, 10, 'Dalcahue');
INSERT INTO comunas VALUES (236, 10, 'Fresia');
INSERT INTO comunas VALUES (237, 10, 'Frutillar');
INSERT INTO comunas VALUES (238, 10, 'Futaleufu');
INSERT INTO comunas VALUES (239, 10, 'Hualaihue');
INSERT INTO comunas VALUES (240, 10, 'Llanquihue');
INSERT INTO comunas VALUES (241, 10, 'Los muermos');
INSERT INTO comunas VALUES (242, 10, 'Maullin');
INSERT INTO comunas VALUES (243, 10, 'Osorno');
INSERT INTO comunas VALUES (244, 10, 'Palena');
INSERT INTO comunas VALUES (245, 10, 'Puerto Montt');
INSERT INTO comunas VALUES (246, 10, 'Puerto Octay');
INSERT INTO comunas VALUES (247, 10, 'Puerto Varas');
INSERT INTO comunas VALUES (248, 10, 'Puqueldon');
INSERT INTO comunas VALUES (249, 10, 'Purranque');
INSERT INTO comunas VALUES (250, 10, 'Puyehue');
INSERT INTO comunas VALUES (251, 10, 'Queilen');
INSERT INTO comunas VALUES (252, 10, 'Quellon');
INSERT INTO comunas VALUES (253, 10, 'Quemchi');
INSERT INTO comunas VALUES (254, 10, 'Quinchao');
INSERT INTO comunas VALUES (255, 10, 'Rio Negro');
INSERT INTO comunas VALUES (256, 10, 'San Juan de la Costa');
INSERT INTO comunas VALUES (257, 10, 'San Pablo');
INSERT INTO comunas VALUES (258, 11, 'Ays&eacute;n');
INSERT INTO comunas VALUES (259, 11, 'Chile Chico');
INSERT INTO comunas VALUES (260, 11, 'Cisnes');
INSERT INTO comunas VALUES (261, 11, 'Cochrane');
INSERT INTO comunas VALUES (262, 11, 'Coyhaique');
INSERT INTO comunas VALUES (263, 11, 'Guaitecas');
INSERT INTO comunas VALUES (264, 11, 'Lago verde');
INSERT INTO comunas VALUES (265, 11, 'O`higgins');
INSERT INTO comunas VALUES (266, 11, 'R&iacute;o Iba&ntilde;ez');
INSERT INTO comunas VALUES (267, 11, 'Tortel');
INSERT INTO comunas VALUES (268, 12, 'Cabo de Hornos');
INSERT INTO comunas VALUES (269, 12, 'Laguna Blanca');
INSERT INTO comunas VALUES (270, 12, 'Natales');
INSERT INTO comunas VALUES (271, 12, 'Porvenir');
INSERT INTO comunas VALUES (272, 12, 'Primavera');
INSERT INTO comunas VALUES (273, 12, 'Punta Arenas');
INSERT INTO comunas VALUES (274, 12, 'Rio Verde');
INSERT INTO comunas VALUES (275, 12, 'San Gregorio');
INSERT INTO comunas VALUES (276, 12, 'Timaukel');
INSERT INTO comunas VALUES (277, 12, 'Torres del Paine');
INSERT INTO comunas VALUES (278, 13, 'Alhue');
INSERT INTO comunas VALUES (279, 13, 'Buin');
INSERT INTO comunas VALUES (280, 13, 'Calera de Tango');
INSERT INTO comunas VALUES (281, 13, 'Cerrillos');
INSERT INTO comunas VALUES (282, 13, 'Cerro Navia');
INSERT INTO comunas VALUES (283, 13, 'Colina');
INSERT INTO comunas VALUES (284, 13, 'Conchali');
INSERT INTO comunas VALUES (285, 13, 'Curacavi');
INSERT INTO comunas VALUES (286, 13, 'El Bosque');
INSERT INTO comunas VALUES (287, 13, 'El Monte');
INSERT INTO comunas VALUES (288, 13, 'Estacion Central');
INSERT INTO comunas VALUES (289, 13, 'Huechuraba');
INSERT INTO comunas VALUES (290, 13, 'Independencia');
INSERT INTO comunas VALUES (291, 13, 'Isla de Maipo');
INSERT INTO comunas VALUES (292, 13, 'La Cisterna');
INSERT INTO comunas VALUES (293, 13, 'La Florida');
INSERT INTO comunas VALUES (294, 13, 'La Granja');
INSERT INTO comunas VALUES (295, 13, 'La Pintana');
INSERT INTO comunas VALUES (296, 13, 'La Reina');
INSERT INTO comunas VALUES (297, 13, 'Lampa');
INSERT INTO comunas VALUES (298, 13, 'Las Condes');
INSERT INTO comunas VALUES (299, 13, 'Lo Barnechea');
INSERT INTO comunas VALUES (300, 13, 'Lo Espejo');
INSERT INTO comunas VALUES (301, 13, 'Lo Prado');
INSERT INTO comunas VALUES (302, 13, 'Macul');
INSERT INTO comunas VALUES (303, 13, 'Maip&uacute;');
INSERT INTO comunas VALUES (304, 13, 'Mar&iacute;a Pinto');
INSERT INTO comunas VALUES (305, 13, 'Melipilla');
INSERT INTO comunas VALUES (306, 13, '&Ntilde;u&ntilde;oa');
INSERT INTO comunas VALUES (307, 13, 'Padre Hurtado');
INSERT INTO comunas VALUES (308, 13, 'Paine');
INSERT INTO comunas VALUES (309, 13, 'Pedro Aguirre Cerda');
INSERT INTO comunas VALUES (310, 13, 'Penaflor');
INSERT INTO comunas VALUES (311, 13, 'Pe&ntilde;alol&eacute;n');
INSERT INTO comunas VALUES (312, 13, 'Pirque');
INSERT INTO comunas VALUES (313, 13, 'Providencia');
INSERT INTO comunas VALUES (314, 13, 'Pudahuel');
INSERT INTO comunas VALUES (315, 13, 'Puente Alto');
INSERT INTO comunas VALUES (316, 13, 'Quilicura');
INSERT INTO comunas VALUES (317, 13, 'Quinta Normal');
INSERT INTO comunas VALUES (318, 13, 'Recoleta');
INSERT INTO comunas VALUES (319, 13, 'Renca');
INSERT INTO comunas VALUES (320, 13, 'San Bernardo');
INSERT INTO comunas VALUES (321, 13, 'San Joaqu&iacute;n');
INSERT INTO comunas VALUES (322, 13, 'San Jos&eacute; de Maipo');
INSERT INTO comunas VALUES (323, 13, 'San Miguel');
INSERT INTO comunas VALUES (324, 13, 'San Pedro');
INSERT INTO comunas VALUES (325, 13, 'San Ram&oacute;n');
INSERT INTO comunas VALUES (326, 13, 'Santiago');
INSERT INTO comunas VALUES (327, 13, 'Santiago Oeste');
INSERT INTO comunas VALUES (328, 13, 'Santiago Sur');
INSERT INTO comunas VALUES (329, 13, 'Talagante');
INSERT INTO comunas VALUES (330, 13, 'Til Til');
INSERT INTO comunas VALUES (331, 13, 'Vitacura');
INSERT INTO comunas VALUES (332, 14, 'Corral');
INSERT INTO comunas VALUES (333, 14, 'Futrono');
INSERT INTO comunas VALUES (334, 14, 'La Uni&oacute;n');
INSERT INTO comunas VALUES (335, 14, 'Lago Ranco');
INSERT INTO comunas VALUES (336, 14, 'Lanco');
INSERT INTO comunas VALUES (337, 14, 'Los Lagos');
INSERT INTO comunas VALUES (338, 14, 'Mafil');
INSERT INTO comunas VALUES (339, 14, 'Mariquina');
INSERT INTO comunas VALUES (340, 14, 'Paillaco');
INSERT INTO comunas VALUES (341, 14, 'Panguipulli');
INSERT INTO comunas VALUES (342, 14, 'Rio Bueno');
INSERT INTO comunas VALUES (343, 14, 'Valdivia');
INSERT INTO comunas VALUES (344, 15, 'Arica');
INSERT INTO comunas VALUES (345, 15, 'Camarones');
INSERT INTO comunas VALUES (346, 15, 'General Lagos');
INSERT INTO comunas VALUES (347, 15, 'Putre');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `regiones`
#

CREATE TABLE regiones (
  id_region int(11) NOT NULL auto_increment,
  region varchar(120) NOT NULL default '',
  PRIMARY KEY  (id_region)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `regiones`
#

INSERT INTO regiones VALUES (1, 'Regi&oacute;n deTarapac&aacute');
INSERT INTO regiones VALUES (2, 'Regi&oacute;n de Antofagasta');
INSERT INTO regiones VALUES (3, 'Regi&oacute;n de Atacama');
INSERT INTO regiones VALUES (4, 'Regi&oacute;n de Coquimbo');
INSERT INTO regiones VALUES (5, 'Regi&oacute;n de Valpara&iacute;so');
INSERT INTO regiones VALUES (6, 'Regi&oacute;n de Ohiggins');
INSERT INTO regiones VALUES (7, 'Regi&oacute;n del Maule');
INSERT INTO regiones VALUES (8, 'Regi&oacute;n del B&iacute;o  B&iacute;o');
INSERT INTO regiones VALUES (9, 'Regi&oacute;n de La Araucan&iacute;a');
INSERT INTO regiones VALUES (10, 'Regi&oacute;n de Los Lagos');
INSERT INTO regiones VALUES (11, 'Regi&oacute;n de Ays&eacute;n');
INSERT INTO regiones VALUES (12, 'Regi&oacute;n de Magallanes y La Ant&aacute;rtica Chilena');
INSERT INTO regiones VALUES (13, 'Regi&oacute;n Metropolitana');
INSERT INTO regiones VALUES (14, 'Regi&oacute;n de Los R&iacute;os');
INSERT INTO regiones VALUES (15, 'Regi&oacute;n de Arica y Parinacota');

