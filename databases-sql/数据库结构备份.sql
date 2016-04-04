-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015-06-12 12:47:32
-- 服务器版本: 5.5.43-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `汽车衡称重系统`
--

-- --------------------------------------------------------

--
-- 表的结构 `司机`
--

CREATE TABLE IF NOT EXISTS `司机` (
  `驾驶证号` char(18) NOT NULL COMMENT '驾驶证号',
  `姓名` text NOT NULL,
  `出生日期` date NOT NULL COMMENT '出生日期',
  `驾照类型` char(2) CHARACTER SET ascii NOT NULL COMMENT '驾照类型 c1 c2 a1什么滴',
  `部门` text NOT NULL COMMENT '部门名字',
  `联系电话` char(11) CHARACTER SET ascii NOT NULL COMMENT '11位手机号码',
  `备注` text COMMENT '备注信息可为空',
  UNIQUE KEY `驾驶证号` (`驾驶证号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于存放司机信息！';

-- --------------------------------------------------------

--
-- 表的结构 `用户`
--

CREATE TABLE IF NOT EXISTS `用户` (
  `姓名` text NOT NULL COMMENT '账户用户名',
  `账号` char(20) NOT NULL COMMENT '账户名',
  `密码` char(20) NOT NULL COMMENT '账户密码',
  `权限` int(11) NOT NULL COMMENT '账户权限码',
  `备注` text COMMENT '备注信息，可为空',
  PRIMARY KEY (`账号`),
  UNIQUE KEY `账号` (`账号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统用户信息表';

-- --------------------------------------------------------

--
-- 表的结构 `称重管理`
--

CREATE TABLE IF NOT EXISTS `称重管理` (
  `车牌号` char(20) NOT NULL COMMENT '车牌号',
  `净重` float NOT NULL COMMENT '车辆所载货物重量',
  `时间` datetime NOT NULL COMMENT '称量时间日期和时间（datetime）',
  `管理账户` char(20) NOT NULL COMMENT '管理员账号',
  `备注` text COMMENT '备注信息',
  PRIMARY KEY (`车牌号`,`管理账户`),
  KEY `管理账号` (`管理账户`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户-车辆关系';

--
-- 表的关联 `称重管理`:
--   `管理账户`
--       `用户` -> `账号`
--   `车牌号`
--       `车辆` -> `车牌号`
--

-- --------------------------------------------------------

--
-- 表的结构 `车辆`
--

CREATE TABLE IF NOT EXISTS `车辆` (
  `车牌号` char(20) NOT NULL COMMENT '车牌号',
  `车型` text NOT NULL COMMENT '车辆类型（小型货车什么滴）',
  `出厂日期` date NOT NULL COMMENT '出厂日期（date）',
  `车重` float NOT NULL COMMENT '车辆重量',
  `核定载重` float NOT NULL COMMENT '出厂核定载重',
  `照片` longblob NOT NULL COMMENT '这里存放照片',
  `备注` text COMMENT '备注信息',
  PRIMARY KEY (`车牌号`),
  UNIQUE KEY `车牌号` (`车牌号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于存放搜集到的车辆的信息！';

-- --------------------------------------------------------

--
-- 表的结构 `驾驶`
--

CREATE TABLE IF NOT EXISTS `驾驶` (
  `车牌号` char(20) NOT NULL COMMENT '车牌号，对应车辆表里的车牌号',
  `驾驶证号` char(18) NOT NULL COMMENT '驾驶证号，对应司机表中的驾驶证号',
  `备注` text COMMENT '备注信息',
  PRIMARY KEY (`车牌号`,`驾驶证号`),
  KEY `驾驶驾驶证号` (`驾驶证号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='车辆司机关系表';

--
-- 表的关联 `驾驶`:
--   `驾驶证号`
--       `司机` -> `驾驶证号`
--   `车牌号`
--       `车辆` -> `车牌号`
--

--
-- 限制导出的表
--

--
-- 限制表 `称重管理`
--
ALTER TABLE `称重管理`
  ADD CONSTRAINT `管理账号` FOREIGN KEY (`管理账户`) REFERENCES `用户` (`账号`),
  ADD CONSTRAINT `管理车牌号` FOREIGN KEY (`车牌号`) REFERENCES `车辆` (`车牌号`);

--
-- 限制表 `驾驶`
--
ALTER TABLE `驾驶`
  ADD CONSTRAINT `驾驶驾驶证号` FOREIGN KEY (`驾驶证号`) REFERENCES `司机` (`驾驶证号`),
  ADD CONSTRAINT `驾驶车牌号` FOREIGN KEY (`车牌号`) REFERENCES `车辆` (`车牌号`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
