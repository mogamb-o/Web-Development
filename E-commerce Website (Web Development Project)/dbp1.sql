-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 10:58 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `userid`, `amount`) VALUES
(1, 'shahzaibchadhar', 37500),
(2, 'shahzaib', 10000),
(3, 'muhammadali', 500),
(4, 'newuser', 1250),
(5, 'shiza', 2250);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `code` varchar(11) NOT NULL,
  `quantities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userid` text NOT NULL,
  `C_code` int(11) NOT NULL,
  `C_Fname` varchar(20) NOT NULL,
  `C_Lname` varchar(20) NOT NULL,
  `Phone_no` bigint(20) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userid`, `C_code`, `C_Fname`, `C_Lname`, `Phone_no`, `Balance`) VALUES
('shahzaibchadhar', 981, 'Shahzaib', 'Chadhar', 3087921749, 1000),
('shahzaibchadhar1528317842', 982, 'shahzaib', 'chadhar', 3084090617, 0),
('shahzaib', 983, 'shah', 'zaib', 3084090617, 0),
('shahzaib1528318047', 984, 'shah', 'zaib', 3084090617, 0),
('shahzaib1528318059', 985, 'shah', 'zaib', 3084090617, 0),
('shahzaon', 986, 'shah', 'zaon', 222, 0),
('dczfvvrfsr', 987, 'dczfv', 'vrfsr', 324, 0),
('fdsf3212', 988, 'fdsf', '3212', 0, 0),
('fdsfgd', 989, 'fds', 'fgd', 4234, 0),
('fdsfgdrefr', 990, 'fdsfgd', 'refr', 0, 0),
('shahzaibchadhar1534101140', 991, 'shahzaib', 'chadhar', 3084090617, 0),
('muhammadali', 992, 'Muhammad', 'Ali', 3008457321, 0),
('newuser', 993, 'new', 'user', 3002456761, 0),
('alia', 994, 'ali', 'a', 3087954123, 0),
('shiza', 995, 'shiz', 'a', 3012355232, 0),
('newname', 996, 'new', 'name', 2343232, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `D_id` varchar(20) NOT NULL,
  `D_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`D_id`, `D_name`) VALUES
('E123', 'Employee'),
('P456', 'Products');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `E_id` varchar(20) NOT NULL,
  `D_id` varchar(20) NOT NULL,
  `E_Fname` varchar(20) NOT NULL,
  `E_Lname` varchar(20) NOT NULL,
  `Job` varchar(20) NOT NULL,
  `Salary` int(11) NOT NULL,
  `St_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`E_id`, `D_id`, `E_Fname`, `E_Lname`, `Job`, `Salary`, `St_date`) VALUES
('001', 'E123', 'ali', 'umer', 'Manager', 50000, '2015-12-17'),
('002', 'E123', 'fahad', 'sheik', 'Employee', 10000, '2015-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `invertory`
--

CREATE TABLE `invertory` (
  `P_code` varchar(20) NOT NULL,
  `Total_stock` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `Remain_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invertory`
--

INSERT INTO `invertory` (`P_code`, `Total_stock`, `sales`, `Remain_stock`) VALUES
('c001', 5, 5000, 3),
('c002', 50, 10000, 25),
('g001', 10, 3000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `INV_num` int(11) NOT NULL,
  `C_code` int(11) NOT NULL,
  `INV_date` date NOT NULL,
  `Sub_total` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`INV_num`, `C_code`, `INV_date`, `Sub_total`, `tax`, `Total`, `status`) VALUES
(1, 981, '2018-06-05', 5000, 0, 5000, 1),
(2, 981, '2018-06-05', 500, 0, 500, 1),
(3, 981, '2018-06-05', 6000, 0, 6000, 0),
(4, 983, '2018-06-06', 10000, 0, 10000, 0),
(5, 981, '2018-08-12', 1000, 0, 1000, 0),
(6, 992, '2019-01-03', 500, 0, 500, 0),
(7, 0, '2019-01-03', 500, 0, 500, 0),
(8, 0, '2019-01-03', 500, 0, 500, 0),
(9, 993, '2019-01-03', 250, 0, 250, 0),
(10, 995, '2019-01-03', 250, 0, 250, 0),
(11, 995, '2019-01-03', 2000, 0, 2000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `main_product`
--

CREATE TABLE `main_product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_product`
--

INSERT INTO `main_product` (`id`, `name`, `img`, `description`) VALUES
(1, 'Clothe', 'https://cdn.shopify.com/s/files/1/2290/7887/t/9/assets/top-banner-home-1.jpg?5647599713958782662', 'Men Gournents here'),
(2, 'Tech Shop', 'https://static.daraz.pk/cms/2017/W40/phones-images/Tablet-Accessories.png', 'Find your gadgets'),
(3, 'Grocery', 'https://static.daraz.pk/cms/2018/W6/grocer-cat-tile/Cooking-Essentials.png', 'Find your home staff here');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `P_code` varchar(20) NOT NULL,
  `P_quantity` int(11) NOT NULL,
  `D_id` varchar(20) NOT NULL,
  `P_name` text NOT NULL,
  `P_description` text NOT NULL,
  `p_img` text NOT NULL,
  `P_price` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Purchase_price` int(11) NOT NULL,
  `main_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`P_code`, `P_quantity`, `D_id`, `P_name`, `P_description`, `p_img`, `P_price`, `Discount`, `Purchase_price`, `main_product_id`) VALUES
('c001', 4, 'p456', 'Pents', 'blue', 'https://sc01.alicdn.com/kf/HTB1vN5LSFXXXXXwXXXXq6xXFXXXD/new-fashion-men-jeans-2017S-boys-fashion.jpg_350x350.jpg', 2500, 0, 2000, 1),
('c002', 37, 'p456', 'Shirts', 'white', 'http://static1.businessinsider.com/image/599b401cb0e0b593758b58e0-800/allgingham-hanging.jpg', 500, 0, 300, 1),
('g001', 6, 'p456', 'Cups', 'black', 'https://secure.img1-ag.wfcdn.com/im/41651069/resize-h800%5Ecompr-r85/2820/28203854/Beckey+4+Piece+Demitasse+Espresso+Cups+Set.jpg', 250, 0, 200, 3),
('g002', 5, 'p456', 'Plates', 'green', 'http://www.robin-wood.co.uk/wp-content/uploads/2013/07/mary-rose-dinner-plate-300x200.jpg', 5000, 0, 4000, 3),
('t001', 3, 'p456', 'Headphones', 'crimson', 'https://cnet3.cbsistatic.com/img/AXZ-UHoFdA7pmR7Ipt3-5tuqizE=/1070x602/2016/03/18/5fb797a8-078f-4337-b026-cd1abc4694e8/audeze-sine-headphones-03.jpg', 2000, 0, 1500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `P_code` varchar(20) NOT NULL,
  `P_quantity` int(11) NOT NULL,
  `D_id` varchar(20) NOT NULL,
  `P_name` varchar(20) NOT NULL,
  `P_description` varchar(20) NOT NULL,
  `p_img` text NOT NULL,
  `P_price` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Purchase_price` int(11) NOT NULL,
  `main_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_code`, `P_quantity`, `D_id`, `P_name`, `P_description`, `p_img`, `P_price`, `Discount`, `Purchase_price`, `main_product_id`) VALUES
('c001', 5, 'p456', 'Pents', 'blue', 'https://sc01.alicdn.com/kf/HTB1vN5LSFXXXXXwXXXXq6xXFXXXD/new-fashion-men-jeans-2017S-boys-fashion.jpg_350x350.jpg', 2500, 0, 2000, 1),
('c002', 50, 'p456', 'Shirts', 'white', 'http://static1.businessinsider.com/image/599b401cb0e0b593758b58e0-800/allgingham-hanging.jpg', 500, 0, 300, 1),
('g001', 10, 'p456', 'Cups', 'black', 'https://secure.img1-ag.wfcdn.com/im/41651069/resize-h800%5Ecompr-r85/2820/28203854/Beckey+4+Piece+Demitasse+Espresso+Cups+Set.jpg', 250, 0, 200, 3),
('g002', 5, 'p456', 'Plates', 'green', 'http://www.robin-wood.co.uk/wp-content/uploads/2013/07/mary-rose-dinner-plate-300x200.jpg', 5000, 0, 4000, 3),
('t001', 6, 'p456', 'Headphones', 'crimson', 'https://cnet3.cbsistatic.com/img/AXZ-UHoFdA7pmR7Ipt3-5tuqizE=/1070x602/2016/03/18/5fb797a8-078f-4337-b026-cd1abc4694e8/audeze-sine-headphones-03.jpg', 2000, 0, 1500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `P_code` varchar(20) NOT NULL,
  `V_code` int(11) NOT NULL,
  `In_Date` date NOT NULL,
  `No_Of_items` int(11) NOT NULL,
  `Pur_Account` int(11) NOT NULL,
  `Serial_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`P_code`, `V_code`, `In_Date`, `No_Of_items`, `Pur_Account`, `Serial_No`) VALUES
('c001', 258, '0000-00-00', 1, 10, 101),
('g002', 253, '0000-00-00', 2, 20, 102),
('t001', 255, '0000-00-00', 3, 30, 103);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `INV_num` int(11) NOT NULL,
  `P_code` varchar(20) NOT NULL,
  `P_quantity` int(11) NOT NULL,
  `Serial_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`INV_num`, `P_code`, `P_quantity`, `Serial_No`) VALUES
(98001, 'c001', 5, 101),
(98002, 'g002', 5, 102),
(98003, 'c002', 50, 104),
(98004, 't001', 6, 103),
(98005, 'g001', 10, 105);

-- --------------------------------------------------------

--
-- Table structure for table `s_login`
--

CREATE TABLE `s_login` (
  `id` int(11) NOT NULL,
  `Users_id` varchar(20) NOT NULL,
  `Passwords` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_login`
--

INSERT INTO `s_login` (`id`, `Users_id`, `Passwords`) VALUES
(7, 'shahzaibchadhar', 'zaibmalik'),
(9, 'shahzaibchadhar15283', '4GoiL3A8rv'),
(10, 'shahzaib', 'VNkTpR8ytr'),
(11, 'shahzaib1528318047', 'j56SyKYK4o'),
(12, 'shahzaib1528318059', 'Dqfwa6V4bw'),
(13, 'shahzaon', 'cpRwEWHSJe'),
(14, 'dczfvvrfsr', 'Np20sBFuzq'),
(15, 'fdsf3212', 'corkKVViTO'),
(16, 'fdsfgd', 'nNIhCNQ31L'),
(17, 'fdsfgdrefr', 'lkpEPQ7XnN'),
(18, 'shahzaibchadhar15341', 'p214UTZgja'),
(19, 'muhammadali', '7RDvuShIfp'),
(20, 'newuser', 'iyLSNYOpIR'),
(21, 'alia', 'yjlQgVLVjN'),
(22, 'shiza', 'fANM7ojE6t'),
(23, 'newname', 'ILL8dclCye');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `V_code` int(11) NOT NULL,
  `user` text NOT NULL,
  `V_name` varchar(20) NOT NULL,
  `V_contact` int(11) NOT NULL,
  `V_address` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`V_code`, `user`, `V_name`, `V_contact`, `V_address`, `status`) VALUES
(253, '', 'fahad', 2147483647, 'pwh', 0),
(255, '', 'umer', 2147483647, 'fsd', 0),
(256, '', 'shahzaib', 2147483647, 'morekhunda', 0),
(258, '', 'umer', 2147483647, 'lhr', 0),
(259, '', 'Shahzaib', 2147483647, 'faisalabad', 0),
(260, '', 'Shahzaib', 2147483647, 'faisalabad', 0),
(261, '', 'Shahzaib', 2147483647, 'faisalabad', 0),
(262, '', 'Shahzaib', 2147483647, 'faisalabad', 0),
(263, '', 'shahzaib', 2147483647, 'chiniot', 0),
(264, '', 'shahzaib', 2147483647, 'chiniot', 0),
(265, '', 'shah', 209, 'S', 0),
(266, '', 'shah', 209, 'S', 0),
(267, '', 'shah', 209, 'S', 0),
(268, '', 'shah', 209, 'S', 0),
(269, '', 'shah', 209, 'S', 0),
(270, '', 'shah', 209, 'S', 0),
(271, '', 'new', 92, 'address', 0),
(272, '', 'shahzaib', 2147483647, 'lahore', 0),
(273, '', 'shahzaib', 2147483647, 'lahore', 0),
(274, 'shahzaibchadhar', 'shahzaib', 2147483647, 'lhr', 1),
(275, 'shahzaibchadhar', 'Shahzaib', 2147483647, 'More khunda nankana ', 1),
(276, 'shahzaibchadhar', 'shahzaib', 2147483647, 'Nankana sahib', 0),
(277, 'shahzaib', 'shahzaib', 2147483647, 'morekhunda', 0),
(278, 'shahzaibchadhar', 'shahzaib', 2147483647, 'more khunda nankana ', 0),
(279, 'muhammadali', 'ali', 2147483647, 'address', 0),
(280, '', 'new', 2147483647, 'sss', 0),
(281, 'newuser', 'new', 2147483647, 'sss', 0),
(282, 'newuser', 'new', 2147483647, 'sss', 0),
(283, 'newuser', 'new', 2147483647, 'sss', 0),
(284, 'newuser', 'new', 2147483647, 'sss', 0),
(285, 'newuser', 'new', 2147483647, 'address', 0),
(286, 'newuser', 'new', 923323343, 'adreess', 0),
(287, 'newuser', 'new', 231323, 'sss', 0),
(288, 'shiza', 'shiza', 2147483647, 'ctn', 0),
(289, 'shiza', 'lkj', 4484, 'bjb', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`C_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`D_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`E_id`),
  ADD KEY `D_id` (`D_id`);

--
-- Indexes for table `invertory`
--
ALTER TABLE `invertory`
  ADD PRIMARY KEY (`P_code`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`INV_num`);

--
-- Indexes for table `main_product`
--
ALTER TABLE `main_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`P_code`),
  ADD KEY `D_id` (`D_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_code`,`P_quantity`),
  ADD KEY `D_id` (`D_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`P_code`),
  ADD UNIQUE KEY `Pur_Account` (`Pur_Account`),
  ADD KEY `V_code` (`V_code`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`INV_num`),
  ADD KEY `P_code` (`P_code`,`P_quantity`);

--
-- Indexes for table `s_login`
--
ALTER TABLE `s_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`V_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `C_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `INV_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `main_product`
--
ALTER TABLE `main_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `INV_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98006;
--
-- AUTO_INCREMENT for table `s_login`
--
ALTER TABLE `s_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`D_id`) REFERENCES `department` (`D_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`D_id`) REFERENCES `department` (`D_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`V_code`) REFERENCES `vendor` (`V_code`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`P_code`,`P_quantity`) REFERENCES `products` (`P_code`, `P_quantity`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
