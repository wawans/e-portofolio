/*
Navicat MySQL Data Transfer

Source Server         : root@localhost
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : eportofolio

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2016-05-18 23:53:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `kelas`
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `kd_kelas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `act` char(1) NOT NULL DEFAULT '0',
  `tgl_join` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ket` tinytext,
  PRIMARY KEY (`kd_kelas`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelas
-- ----------------------------

-- ----------------------------
-- Table structure for `kelas_ref`
-- ----------------------------
DROP TABLE IF EXISTS `kelas_ref`;
CREATE TABLE `kelas_ref` (
  `kd_kelas` char(9) NOT NULL,
  `kd_uuid` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `nm_kelas` varchar(125) NOT NULL,
  `maks` int(11) NOT NULL DEFAULT '0',
  `tgl_buat` date NOT NULL,
  `tgl_mod` varchar(45) NOT NULL,
  PRIMARY KEY (`kd_kelas`,`kd_uuid`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelas_ref
-- ----------------------------

-- ----------------------------
-- Table structure for `kelompok`
-- ----------------------------
DROP TABLE IF EXISTS `kelompok`;
CREATE TABLE `kelompok` (
  `kd_kelompok` char(9) NOT NULL,
  `kd_kelas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `act` char(1) NOT NULL DEFAULT '1',
  `tgl_join` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kd_kelompok`,`kd_kelas`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelompok
-- ----------------------------

-- ----------------------------
-- Table structure for `kelompok_ref`
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_ref`;
CREATE TABLE `kelompok_ref` (
  `kd_kelompok` char(9) NOT NULL,
  `kd_uuid` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `nm_kelompok` varchar(125) NOT NULL,
  `maks` int(11) NOT NULL DEFAULT '0',
  `tgl_buat` date NOT NULL,
  `tgl_mod` date NOT NULL,
  PRIMARY KEY (`kd_kelompok`,`kd_uuid`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelompok_ref
-- ----------------------------

-- ----------------------------
-- Table structure for `profile`
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `kd_user` char(9) NOT NULL,
  `nm_awal` varchar(125) NOT NULL,
  `nm_akhir` varchar(125) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `act` char(1) NOT NULL DEFAULT '1',
  `tgl_mod` date NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profile
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `kd_user` char(9) NOT NULL,
  `kd_uuid` char(9) NOT NULL,
  `uname` varchar(75) NOT NULL,
  `upass` char(42) NOT NULL,
  `usalt` char(16) NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_mod` date NOT NULL,
  `act` char(1) NOT NULL DEFAULT '1' COMMENT '0:SUSPEND,1:ACTIVE',
  PRIMARY KEY (`kd_user`,`kd_uuid`),
  UNIQUE KEY `uname_UNIQUE` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
