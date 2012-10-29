-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2012 a las 08:40:07
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_lugar_cristal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `cod_art` int(4) NOT NULL COMMENT 'Contiene el codigo del articulo',
  `descr_art` varchar(30) DEFAULT NULL COMMENT 'Describe el articulo',
  `cant_art` int(4) DEFAULT NULL COMMENT 'Contiene la cantidad de articulos',
  `precio_art` double DEFAULT NULL COMMENT 'Contiene el precio del articulo',
  `cod_venta` int(4) DEFAULT NULL COMMENT 'Representa el codigo de venta del articulo',
  `estado` varchar(3) DEFAULT NULL COMMENT 'Representa el estado Activo, Inactivo',
  PRIMARY KEY (`cod_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_pedido`
--

CREATE TABLE IF NOT EXISTS `articulo_pedido` (
  `cod_art` int(4) NOT NULL COMMENT 'Codigo del articulosolicitado',
  `cod_pedido` int(4) NOT NULL COMMENT 'Codigo del pedido',
  `cant_art` int(4) DEFAULT NULL COMMENT 'Contiene la cantidad de articulo pedido',
  KEY `cod_art` (`cod_art`),
  KEY `cod_pedido` (`cod_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cliente` int(4) NOT NULL COMMENT 'Contiene el codigo del cliente',
  `cedula` int(10) NOT NULL COMMENT 'Cedula del cliente',
  `rif` varchar(15) DEFAULT NULL COMMENT 'RIF del cliente',
  `nombre` varchar(30) NOT NULL COMMENT 'Contiene el nombre del cliente',
  `apellido` varchar(30) NOT NULL COMMENT 'Contiene el apellido del cliente',
  `direccion` varchar(80) DEFAULT NULL COMMENT 'Direccion del cliente',
  `telefono` int(11) DEFAULT NULL COMMENT 'Contiene el numero de telefono del cliente',
  `email` varchar(30) NOT NULL COMMENT 'Contiene el correo del cliente',
  PRIMARY KEY (`cod_cliente`,`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `cedula`, `rif`, `nombre`, `apellido`, `direccion`, `telefono`, `email`) VALUES
(0, 0, NULL, 'suhjail', '', 'carrizal c', 2147483647, 'suhja@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_sucursal`
--

CREATE TABLE IF NOT EXISTS `cliente_sucursal` (
  `cod_cliente` int(4) NOT NULL COMMENT 'Codigodelcliente',
  `cod_sucursal` int(4) NOT NULL COMMENT 'Codigo de la sucursal',
  KEY `cod_cliente` (`cod_cliente`),
  KEY `cod_sucursal` (`cod_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `cod_dpto` int(4) NOT NULL COMMENT 'Contiene el codigo del departamento',
  `nombre_dpto` varchar(40) DEFAULT NULL COMMENT 'Nombre del departamento. Ejm: carpinteria',
  `estado` varchar(1) NOT NULL COMMENT 'Estado del departamento A: activo E: eliminado',
  PRIMARY KEY (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cod_dpto`, `nombre_dpto`, `estado`) VALUES
(0, 'Contabilidad', 'E'),
(1, 'Informática', 'E'),
(2, 'Sistemas', 'A'),
(3, 'Pintura', 'A'),
(4, 'Madera', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `cod_emp` int(4) NOT NULL COMMENT 'Contiene el codigo del empleado',
  `cedula` int(10) NOT NULL COMMENT 'Cedula del empleado',
  `cod_sucursal` int(4) NOT NULL COMMENT 'Sucursal a la quepertenece',
  `cod_dpto` int(4) NOT NULL COMMENT 'Codigo del departamento',
  `nombre` varchar(30) NOT NULL COMMENT 'Contiene el nombre del empleado',
  `apellido` varchar(30) NOT NULL COMMENT 'Contiene el apellido del empleado',
  `fecha_nac` date NOT NULL COMMENT 'Contiene la fecha de nacimiento del empleado',
  `nacionalidad` varchar(1) NOT NULL COMMENT 'Contiene la nacionalidad del empleado',
  `sexo` varchar(1) NOT NULL COMMENT 'Indica el sexo del empleado',
  `edo_civil` varchar(2) NOT NULL COMMENT 'Contiene el estado civil del empleado',
  `fecha_ingreso` date NOT NULL COMMENT 'Contiene la fecha de ingreso del empleado',
  `email` varchar(30) NOT NULL COMMENT 'Contiene el correo del empleado',
  `estado` varchar(3) NOT NULL COMMENT 'Representa el estado Activo, Inhactivo',
  `telefono_cel` int(11) DEFAULT NULL COMMENT 'Contiene el numero celular',
  `telefono_local` int(11) DEFAULT NULL COMMENT 'Contiene el numero local',
  `direccion_hab` varchar(80) DEFAULT NULL COMMENT 'Direccion de habitacion del empleado',
  `tipo_emp` varchar(10) DEFAULT NULL COMMENT 'Tipo de empleado: ejm. vendedor, etc',
  `cod_usuario` int(4) NOT NULL COMMENT 'Contiene el codigo del usuario',
  PRIMARY KEY (`cod_emp`,`cedula`),
  KEY `cod_sucursal` (`cod_sucursal`),
  KEY `cod_dpto` (`cod_dpto`),
  KEY `cod_usuario` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `cod_estado` int(4) NOT NULL COMMENT 'Contiene el codigo del estado',
  `tipo_estado` varchar(3) NOT NULL COMMENT 'Contiene el tipo de estado',
  `descr_estado` varchar(30) DEFAULT NULL COMMENT 'DescripciÃ³n del tipo de estado',
  PRIMARY KEY (`cod_estado`),
  KEY `tipo_estado` (`tipo_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `cod_factura` int(4) NOT NULL COMMENT 'Codigo de la factura',
  `cod_pedido` int(4) NOT NULL COMMENT 'Contiene el codigo del pedido',
  `sub_total` double DEFAULT NULL COMMENT 'Contiene el sub-total de la factura',
  `monto_iva` double DEFAULT NULL COMMENT 'Contiene el monto de iva de la factura',
  `monto_total` double DEFAULT NULL COMMENT 'Contiene el monto total de la factura',
  PRIMARY KEY (`cod_factura`),
  KEY `cod_pedido` (`cod_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `cod_material` int(4) NOT NULL COMMENT 'Contiene el codigo del material',
  `descr_material` varchar(30) DEFAULT NULL COMMENT 'Describe el material',
  `cant_material` int(4) DEFAULT NULL COMMENT 'Contiene la cantidad del material',
  `estado` varchar(3) DEFAULT NULL COMMENT 'Representa el estado Activo, Inactivo',
  PRIMARY KEY (`cod_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_articulo`
--

CREATE TABLE IF NOT EXISTS `material_articulo` (
  `cod_material` int(4) NOT NULL COMMENT 'Codigo del material usuado en el articulo',
  `cod_art` int(4) NOT NULL COMMENT 'Codigo del articulo',
  KEY `cod_material` (`cod_material`),
  KEY `cod_art` (`cod_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `cod_pago` int(4) NOT NULL COMMENT 'Contiene el codigo del pago',
  `cod_factura` int(4) NOT NULL COMMENT 'Codigo de la factura',
  `fecha_pago` date NOT NULL COMMENT 'Fecha del pago',
  `forma_pago` varchar(1) NOT NULL COMMENT 'Forma de pago D: deposito, E: efectivo, C:cheque',
  `ref_bancaria` varchar(20) NOT NULL COMMENT 'Referencia bancaria del pago',
  `monto_pago` double DEFAULT NULL COMMENT 'Contiene el monto del pago',
  `monto_deuda` double DEFAULT NULL COMMENT 'Contiene el monto de la deuda',
  PRIMARY KEY (`cod_pago`),
  KEY `cod_factura` (`cod_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `cod_pedido` int(4) NOT NULL COMMENT 'Contiene el codigo del pedido',
  `cod_emp` int(4) NOT NULL COMMENT 'Codigo del empleado',
  `cedula` int(10) NOT NULL COMMENT 'Cedula del empleadovendedor',
  `cod_factura` int(4) NOT NULL COMMENT 'Codigo de la factura',
  `cod_cliente` int(4) NOT NULL COMMENT 'Codigo del cliente comprador',
  PRIMARY KEY (`cod_pedido`),
  KEY `cod_emp` (`cod_emp`,`cedula`),
  KEY `cod_cliente` (`cod_cliente`),
  KEY `cod_factura` (`cod_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_estado`
--

CREATE TABLE IF NOT EXISTS `pedido_estado` (
  `cod_estado` int(4) NOT NULL COMMENT 'Codigo del estado en que se encuentra el pedido',
  `cod_pedido` int(4) NOT NULL COMMENT 'Codigo del pedido',
  `cod_usuario` int(4) NOT NULL COMMENT 'Codigo del usuario que solicito el pedido',
  `fecha` date DEFAULT NULL COMMENT 'Contiene la fecha donde cambio el estado del pedido',
  KEY `cod_estado` (`cod_estado`),
  KEY `cod_pedido` (`cod_pedido`),
  KEY `cod_usuario` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `cod_rol` int(4) NOT NULL COMMENT 'Contiene el cÃ³digo del rol',
  `tipo_rol` varchar(3) NOT NULL COMMENT 'Contiene el tipo del rol',
  `descr_rol` varchar(30) DEFAULT NULL COMMENT 'Describe el rol que tiene el usuario',
  PRIMARY KEY (`cod_rol`),
  UNIQUE KEY `tipo_rol` (`tipo_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_servicio`
--

CREATE TABLE IF NOT EXISTS `rol_servicio` (
  `cod_rol` int(4) NOT NULL COMMENT 'Codigo del rol contenedor del servicio',
  `cod_servicio` int(4) NOT NULL COMMENT 'Codigo del servicio',
  KEY `cod_rol` (`cod_rol`),
  KEY `cod_servicio` (`cod_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `cod_servicio` int(4) NOT NULL COMMENT 'Contiene el codigo del servicio',
  `nombre_servicio` varchar(30) DEFAULT NULL COMMENT 'Nombre del servicio, ejmp: pedido',
  `descr_servicio` varchar(50) DEFAULT NULL COMMENT 'Describe el servicio',
  PRIMARY KEY (`cod_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `cod_sucursal` int(4) NOT NULL COMMENT 'Contiene el codigo de la sucursal',
  `nombre_sucursal` varchar(30) NOT NULL COMMENT 'Contiene el nombre de la sucursal',
  `direccion` varchar(80) DEFAULT NULL COMMENT 'Direccion de la sucursal',
  `rif` varchar(15) DEFAULT NULL COMMENT 'RIF de la sucursal',
  `telefono` varchar(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_departamento`
--

CREATE TABLE IF NOT EXISTS `sucursal_departamento` (
  `cod_sucursal` int(4) NOT NULL COMMENT 'Codigo de la sucursal',
  `cod_dpto` int(4) NOT NULL COMMENT 'Codigo del departamento',
  KEY `cod_sucursal` (`cod_sucursal`),
  KEY `cod_dpto` (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` int(4) NOT NULL COMMENT 'Contiene el codigo del usuario',
  `cod_rol` int(4) NOT NULL COMMENT 'Contiene el codigo del rol del usuario',
  `cod_sucursal` int(4) NOT NULL COMMENT 'Sucursal a la quepertenece',
  `cod_emp` int(4) NOT NULL COMMENT 'Codigo del empleado',
  `cedula` int(10) NOT NULL COMMENT 'Cedula del usuario/empleado',
  `usuario` varchar(20) NOT NULL COMMENT 'Contiene el usuario',
  `clave` varchar(50) NOT NULL COMMENT 'Clave del usuario',
  `estado` varchar(3) NOT NULL COMMENT 'Representa el estado Activo, Inactivo',
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_rol` (`cod_rol`),
  KEY `cod_sucursal` (`cod_sucursal`),
  KEY `cod_emp` (`cod_emp`,`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo_pedido`
--
ALTER TABLE `articulo_pedido`
  ADD CONSTRAINT `articulo_pedido_ibfk_1` FOREIGN KEY (`cod_art`) REFERENCES `articulo` (`cod_art`) ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_pedido_ibfk_2` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente_sucursal`
--
ALTER TABLE `cliente_sucursal`
  ADD CONSTRAINT `cliente_sucursal_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_sucursal_ibfk_2` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`cod_dpto`) REFERENCES `departamento` (`cod_dpto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `material_articulo`
--
ALTER TABLE `material_articulo`
  ADD CONSTRAINT `material_articulo_ibfk_1` FOREIGN KEY (`cod_material`) REFERENCES `material` (`cod_material`) ON UPDATE CASCADE,
  ADD CONSTRAINT `material_articulo_ibfk_2` FOREIGN KEY (`cod_art`) REFERENCES `articulo` (`cod_art`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`cod_factura`) REFERENCES `factura` (`cod_factura`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cod_emp`, `cedula`) REFERENCES `empleado` (`cod_emp`, `cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`cod_factura`) REFERENCES `factura` (`cod_factura`);

--
-- Filtros para la tabla `pedido_estado`
--
ALTER TABLE `pedido_estado`
  ADD CONSTRAINT `pedido_estado_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`cod_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_estado_ibfk_2` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_estado_ibfk_3` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_servicio`
--
ALTER TABLE `rol_servicio`
  ADD CONSTRAINT `rol_servicio_ibfk_1` FOREIGN KEY (`cod_rol`) REFERENCES `rol` (`cod_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_servicio_ibfk_2` FOREIGN KEY (`cod_servicio`) REFERENCES `servicio` (`cod_servicio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursal_departamento`
--
ALTER TABLE `sucursal_departamento`
  ADD CONSTRAINT `sucursal_departamento_ibfk_1` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sucursal_departamento_ibfk_2` FOREIGN KEY (`cod_dpto`) REFERENCES `departamento` (`cod_dpto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cod_rol`) REFERENCES `rol` (`cod_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`cod_emp`, `cedula`) REFERENCES `empleado` (`cod_emp`, `cedula`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
