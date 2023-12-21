-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2023 at 12:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Celular'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `item_orden`
--

CREATE TABLE `item_orden` (
  `id_item_orden` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_orden`
--

INSERT INTO `item_orden` (`id_item_orden`, `id_orden`, `id_producto`, `cantidad`) VALUES
(64, 52, 1, 1),
(65, 52, 2, 1),
(66, 53, 1, 1),
(67, 54, 6, 1),
(68, 54, 12, 1),
(69, 54, 1, 1),
(70, 55, 5, 1),
(71, 55, 1, 1),
(72, 55, 7, 1),
(73, 56, 10, 1),
(74, 56, 1, 1),
(75, 57, 6, 1),
(76, 58, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_sesion`
--

CREATE TABLE `item_sesion` (
  `id_item_sesion` int(11) NOT NULL,
  `id_sesion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_sesion`
--

INSERT INTO `item_sesion` (`id_item_sesion`, `id_sesion`, `id_producto`, `cantidad`, `posicion`) VALUES
(219, 73, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orden`
--

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orden`
--

INSERT INTO `orden` (`id_orden`, `direccion`, `ciudad`, `pais`, `total`, `id_usuario`) VALUES
(52, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 2499.98, 3),
(53, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 1499.99, 4),
(54, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 8549.97, 4),
(55, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 1769.97, 4),
(56, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 3499.98, 4),
(57, 'Victor Mideros, Quito, Ap1', 'Quito', 'Ecuador', 49.99, 4),
(58, 'Urb Vista Grande', 'Quito', 'Ecuador', 1499.99, 4);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `img_principal` varchar(50) NOT NULL,
  `img_secundaria` varchar(50) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `img_principal`, `img_secundaria`, `sku`, `id_categoria`) VALUES
(1, 'iPhone15', 'Esta es la descripcion del iPhone15', 1499.99, 'images/home/products/iPhone15.png', 'images/home/products_full/iPhone15.png', 'IPH15EC', 1),
(2, 'Lenovo ThinkPad', 'Esta es la descripcion de la laptop', 999.99, 'images/home/products/lenovo.png', 'images/home/products_full/lenovo.png', 'LENTPEC', 2),
(3, 'Samsung S6', 'Esta es la descripcion del samsung', 799.00, 'images/home/products/samsung.png', 'images/home/products_full/samsung.png', 'SAM1234', 1),
(4, 'Huawei', 'Esta es la descripcion del Huawei', 399.99, 'images/home/products/huawei.png', 'images/home/products_full/huawei.png', 'asdasd', 1),
(5, 'Watch', 'Esta es la descripcion del Watch', 249.99, 'images/home/products/watch.png', 'images/home/products_full/watch.png', 'awdsd', 1),
(6, 'Airtag', 'Esta es la descripcion del Airtag', 49.99, 'images/home/products/airtag.png', 'images/home/products_full/airtag.png', 'asdsada', 1),
(7, 'Charger iOS', 'Esta es la descripcion del Charger', 19.99, 'images/home/products/charger.png', 'images/home/products_full/charger.png', 'asdasdas', 1),
(8, 'Go To School Bundle', 'Esta es la descripcion del Go To School Bundle', 1999.99, 'images/home/products/gotoschool.png', 'images/home/products_full/gotoschool.png', 'asdasdsad', 1),
(9, 'iPhone12', 'Esta es la descripcion del iPhone12', 599.99, 'images/home/products/iPhone12.png', 'images/home/products_full/iPhone12.png', 'fsdgfd', 1),
(10, 'Macbook Air', 'Esta es la descripcion de la Macbook Air', 1999.99, 'images/home/products/macbookair.png', 'images/home/products_full/macbookair.png', 'gfhfghjfgj', 1),
(11, 'Pro Bundle', 'Esta es la descripcion del Pro Bundle', 4999.99, 'images/home/products/probundle.png', 'images/home/products_full/probundle.png', 'asdfsdfdsf', 1),
(12, 'Studio Display Pro', 'Esta es la descripcion del Studio Display', 6999.99, 'images/home/products/studiodisplay.png', 'images/home/products_full/studiodisplay.png', 'sadsad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sesion`
--

CREATE TABLE `sesion` (
  `id_sesion` int(11) NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sesion`
--

INSERT INTO `sesion` (`id_sesion`, `session_id`, `id_usuario`, `fecha_creacion`) VALUES
(72, '247541', 4, '2023-12-18 19:57:21'),
(73, '452603', 3, '2023-12-18 20:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `correo`, `telefono`, `password`, `lastname`) VALUES
(1, 'Luis ', 'luis.gomez@gmail.com', '0939683251', '12345', 'Gomez'),
(2, 'Ana ', 'ana@gmail.com', '0984438514', '28137', 'Perez'),
(3, 'Juan Francisco', 'juanfrancistm2011@icloud.com', '0939683251', '12345', 'Cisneros'),
(4, 'Juan', 'juanfrancistm2011@gmail.com', '111111111', '12345', 'Cisneros'),
(9, 'Prueba', 'prueba@gmail.com', '0984438514', '12345', 'Prueba');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `item_orden`
--
ALTER TABLE `item_orden`
  ADD PRIMARY KEY (`id_item_orden`),
  ADD KEY `item_orden_fk0` (`id_orden`),
  ADD KEY `item_orden_fk1` (`id_producto`);

--
-- Indexes for table `item_sesion`
--
ALTER TABLE `item_sesion`
  ADD PRIMARY KEY (`id_item_sesion`),
  ADD KEY `item_sesion_fk0` (`id_sesion`),
  ADD KEY `item_sesion_fk1` (`id_producto`);

--
-- Indexes for table `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `orden_fk0` (`id_usuario`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_fk0` (`id_categoria`);

--
-- Indexes for table `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `sesion_fk0` (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_orden`
--
ALTER TABLE `item_orden`
  MODIFY `id_item_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `item_sesion`
--
ALTER TABLE `item_sesion`
  MODIFY `id_item_sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `orden`
--
ALTER TABLE `orden`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_orden`
--
ALTER TABLE `item_orden`
  ADD CONSTRAINT `item_orden_fk0` FOREIGN KEY (`id_orden`) REFERENCES `orden` (`id_orden`),
  ADD CONSTRAINT `item_orden_fk1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Constraints for table `item_sesion`
--
ALTER TABLE `item_sesion`
  ADD CONSTRAINT `item_sesion_fk0` FOREIGN KEY (`id_sesion`) REFERENCES `sesion` (`id_sesion`),
  ADD CONSTRAINT `item_sesion_fk1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Constraints for table `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_fk0` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Constraints for table `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
