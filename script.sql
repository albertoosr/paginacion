CREATE TABLE IF NOT EXISTS `t_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(60) NOT NULL,
  `contrapass` varchar(255) NOT NULL,
  `nevel` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;