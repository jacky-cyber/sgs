# phpMyAdmin MySQL-Dump
# version 2.5.0-rc2
# http://www.phpmyadmin.net/ (download page)
#
# Servidor: localhost
# Tiempo de generación: 05-07-2004 a las 20:31:20
# Versión del servidor: 3.23.34
# Versión de PHP: 4.0.6
# Base de datos : mailing
# --------------------------------------------------------

#
# Estructura de tabla para la tabla mail_apro
#
# Creación: 04-07-2004 a las 15:57:53
# Última actualización: 05-07-2004 a las 02:34:46
#

CREATE TABLE mail_apro (
  id_mailing varchar(16) NOT NULL default '',
  id_receptor varchar(16) NOT NULL default '',
  aprobacion char(2) NOT NULL default '',
  vio char(2) NOT NULL default 'no',
  visito char(2) NOT NULL default 'no',
  texto text NOT NULL
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla mail_apro
#

INSERT INTO mail_apro VALUES ('2004070415372573', '1', 'ok', 'ok', 'ok', 0x6e6f);
INSERT INTO mail_apro VALUES ('2004070415372573', '2', 'no', 'no', 'no', 0x70727565626120646520746578746f0d0a);
INSERT INTO mail_apro VALUES ('2004070418212086', '2', 'ok', 'ok', 'ok', 0x6e6f);
INSERT INTO mail_apro VALUES ('2004070418564158', '2', 'ok', 'ok', 'ok', 0x6e6f);
INSERT INTO mail_apro VALUES ('2004070421291295', '2', 'ok', 'ok', 'ok', 0x6e6f);
INSERT INTO mail_apro VALUES ('2004070422272160', '2', '', 'no', 'no', 0x6e6f);
INSERT INTO mail_apro VALUES ('2004070502254185', '2', '', 'no', 'no', 0x6e6f);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla mail_texto
#
# Creación: 05-07-2004 a las 02:32:59
# Última actualización: 05-07-2004 a las 03:04:28
#

CREATE TABLE mail_texto (
  id_texto varchar(16) NOT NULL default '',
  id_mailing varchar(16) NOT NULL default '',
  titulo text NOT NULL,
  bajada text NOT NULL,
  contenido text NOT NULL,
  image varchar(255) NOT NULL default '',
  link varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla mail_texto
#

INSERT INTO mail_texto VALUES ('2004070502403563', '2004070502400249', 0x546974756c6f2064656c20436f6e74656e69646f, 0x42616a6164612064656c20436f6e74656e69646f, 0x436f6e74656e69646f, 'bigbheadphone.jpg', 'http://www.danahezablah.cl');
INSERT INTO mail_texto VALUES ('2004070502413335', '2004070502400249', 0x546974756c6f2064656c20436f6e74656e69646f, 0x42616a6164612064656c20436f6e74656e69646f, 0x436f6e74656e69646f, 'cristel.jpg', 'http://www.danahezablah.cl');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla mailing
#
# Creación: 05-07-2004 a las 02:31:39
# Última actualización: 05-07-2004 a las 03:04:28
#

CREATE TABLE mailing (
  id_mailing varchar(16) NOT NULL default '',
  titulo varchar(255) NOT NULL default '',
  subjet text NOT NULL,
  tipo char(3) NOT NULL default '',
  tot_mailing int(11) NOT NULL default '0',
  html text NOT NULL,
  txt text NOT NULL
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla mailing
#

INSERT INTO mailing VALUES ('2004070502400249', 'vvvvvvvvvvvv', 0x496e67726573617220546974756c6f20285375626a6574292064656c204d61696c696e67, '3', 0, '', 0x436f6e74656e69646f);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla receptores
#
# Creación: 04-07-2004 a las 14:30:51
# Última actualización: 04-07-2004 a las 14:41:48
#

CREATE TABLE receptores (
  id_receptor varchar(16) NOT NULL default '',
  nombre varchar(255) NOT NULL default '',
  mail varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla receptores
#

INSERT INTO receptores VALUES ('1', 'Ricardo Rosende', 'rrosende@score.cl');
INSERT INTO receptores VALUES ('2', 'Newtemopral', 'jotaperr@hotmail.com');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla tipo_mailing
#
# Creación: 04-07-2004 a las 14:30:51
# Última actualización: 04-07-2004 a las 14:41:48
#

CREATE TABLE tipo_mailing (
  id_tipo int(11) NOT NULL default '0',
  descrip varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla tipo_mailing
#

INSERT INTO tipo_mailing VALUES (1, 'Imagen');
INSERT INTO tipo_mailing VALUES (2, 'Html Libre');
INSERT INTO tipo_mailing VALUES (3, 'Html Predefinido');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla user_mailing
#
# Creación: 04-07-2004 a las 14:30:51
# Última actualización: 04-07-2004 a las 14:30:54
#

CREATE TABLE user_mailing (
  id_mailing varchar(16) NOT NULL default '',
  id_usuario varchar(16) NOT NULL default '',
  reci char(2) NOT NULL default '',
  visit char(2) NOT NULL default '',
  enviado char(2) NOT NULL default ''
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla user_mailing
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla usuario
#
# Creación: 04-07-2004 a las 14:30:52
# Última actualización: 04-07-2004 a las 19:18:32
#

CREATE TABLE usuario (
  id_usuario varchar(16) NOT NULL default '',
  nombre varchar(255) NOT NULL default '',
  apellido varchar(255) NOT NULL default '',
  mail varchar(255) NOT NULL default '',
  mail2 varchar(255) NOT NULL default '',
  tipo varchar(4) NOT NULL default '',
  nomas char(2) NOT NULL default '',
  id_mailing_nomas varchar(16) NOT NULL default ''
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla usuario
#

INSERT INTO usuario VALUES ('1', 'Ricardo', 'Rosende', 'rrosende@score.cl', '', '1', '', '');
INSERT INTO usuario VALUES ('2', 'Ricardo2', '', 'newtemopral@hotmail.com', '', '2', '', '');
INSERT INTO usuario VALUES ('3', 'Ricardo3', '', 'jotaperr@hotmail.com', '', '2', '', '');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla usuario_tipo
#
# Creación: 04-07-2004 a las 18:49:30
# Última actualización: 04-07-2004 a las 18:49:32
#

CREATE TABLE usuario_tipo (
  id_tipo_u int(11) NOT NULL auto_increment,
  descrip varchar(255) NOT NULL default '',
  PRIMARY KEY  (id_tipo_u)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Volcar la base de datos para la tabla usuario_tipo
#

INSERT INTO usuario_tipo VALUES (1, 'base1');
INSERT INTO usuario_tipo VALUES (2, 'base2');

