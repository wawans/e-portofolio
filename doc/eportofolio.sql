/*
Navicat MySQL Data Transfer

Source Server         : root@localhost
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : eportofolio

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2016-09-21 22:58:53
*/

CREATE DATABASE IF NOT EXISTS `eportofolio`;
USE `eportofolio`;
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for kelas
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
-- Table structure for kelas_ref
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
  PRIMARY KEY (`kd_kelas`,`kd_uuid`,`kd_user`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kelompok
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
-- Table structure for kelompok_ref
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_ref`;
CREATE TABLE `kelompok_ref` (
  `kd_kelompok` char(9) NOT NULL,
  `kd_uuid` char(9) NOT NULL,
  `kd_kelas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `nm_kelompok` varchar(125) NOT NULL,
  `maks` int(11) NOT NULL DEFAULT '0',
  `tgl_buat` date NOT NULL,
  `tgl_mod` date NOT NULL,
  PRIMARY KEY (`kd_kelompok`,`kd_uuid`,`kd_kelas`,`kd_user`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `kd_media` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `kd_tugas` char(9) NOT NULL,
  `tgl_unggah` datetime NOT NULL,
  `name` varchar(250) NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`kd_media`,`kd_user`),
  UNIQUE KEY `filename_UNIQUE` (`file`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `kd_nilai` char(9) NOT NULL,
  `kd_tugas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `kd_penilai` char(9) NOT NULL,
  `sikap` decimal(3,0) NOT NULL DEFAULT '0',
  `pengetahuan` decimal(3,0) NOT NULL DEFAULT '0',
  `ketrampilan` decimal(3,0) NOT NULL DEFAULT '0',
  `waktu` decimal(3,0) NOT NULL DEFAULT '0',
  `presentasi` decimal(3,0) NOT NULL DEFAULT '0',
  `tgl_nilai` datetime NOT NULL,
  PRIMARY KEY (`kd_nilai`,`kd_tugas`,`kd_user`,`kd_penilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for profile
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
-- Table structure for tugas
-- ----------------------------
DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas` (
  `kd_tugas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`kd_tugas`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tugas_ref
-- ----------------------------
DROP TABLE IF EXISTS `tugas_ref`;
CREATE TABLE `tugas_ref` (
  `kd_tugas` char(9) NOT NULL,
  `kd_uuid` char(9) NOT NULL,
  `kd_kelas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `judul` varchar(125) NOT NULL,
  `konten` text NOT NULL,
  `jns_grup` char(1) NOT NULL,
  `jns_nilai` char(1) NOT NULL,
  `lampiran` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_awal` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_mod` datetime NOT NULL,
  `act` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kd_tugas`,`kd_uuid`,`kd_kelas`,`kd_user`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user
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
  UNIQUE KEY `uname_UNIQUE` (`uname`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
