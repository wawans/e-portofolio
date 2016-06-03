/*
Navicat MySQL Data Transfer

Source Server         : root@localhost
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : eportofolio

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2016-05-24 21:05:49
*/

CREATE DATABASE eportofolio;
USE eportofolio;

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
INSERT INTO `kelas` VALUES ('211605000', '051620000', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605000', '051621001', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605000', '051622001', '0', '2016-05-22 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605001', '051621000', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605001', '051621001', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605001', '051622000', '0', '2016-05-22 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605001', '051622001', '0', '2016-05-22 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605002', '051621000', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605002', '051621001', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605004', '051620000', '0', '2016-05-22 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605004', '051621000', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605004', '051621001', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('211605005', '051621001', '0', '2016-05-21 00:00:00', null);
INSERT INTO `kelas` VALUES ('231605000', '051623000', '0', '2016-05-23 00:00:00', null);
INSERT INTO `kelas` VALUES ('231605002', '051622002', '0', '2016-05-23 00:00:00', null);

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
  PRIMARY KEY (`kd_kelas`,`kd_uuid`,`kd_user`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelas_ref
-- ----------------------------
INSERT INTO `kelas_ref` VALUES ('211605000', '202c43ba4', '051620000', 'Bahasa Korea', '50', '2016-05-21', '2016-05-21');
INSERT INTO `kelas_ref` VALUES ('211605001', '1d81f7480', '051621000', 'Teori KKPI', '50', '2016-05-21', '2016-05-21');
INSERT INTO `kelas_ref` VALUES ('211605002', '49fc35f24', '051621000', 'IPA 10 B', '40', '2016-05-21', '2016-05-21');
INSERT INTO `kelas_ref` VALUES ('211605004', '38a000747', '051621000', 'Fisika', '50', '2016-05-21', '2016-05-21');
INSERT INTO `kelas_ref` VALUES ('211605005', '146798f05', '051621001', 'IPS 2 A', '10', '2016-05-21', '2016-05-21');
INSERT INTO `kelas_ref` VALUES ('231605000', '492d821f2', '051623000', 'Biologi 12 A 16', '30', '2016-05-23', '2016-05-23');
INSERT INTO `kelas_ref` VALUES ('231605001', '7cd2258d6', '051623000', 'Statistik 12 A 16', '35', '2016-05-23', '2016-05-23');
INSERT INTO `kelas_ref` VALUES ('231605002', '1ca78cdd1', '051623000', 'UTAMA', '50', '2016-05-23', '2016-05-23');
INSERT INTO `kelas_ref` VALUES ('231605003', '5376f50f3', '051623000', 'Endemic', '50', '2016-05-23', '2016-05-23');

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
INSERT INTO `kelompok` VALUES ('221605000', '211605000', '051621001', '1', '2016-05-22 00:00:00');
INSERT INTO `kelompok` VALUES ('221605000', '211605000', '051622001', '1', '2016-05-22 00:00:00');
INSERT INTO `kelompok` VALUES ('221605001', '211605000', '051622000', '1', '2016-05-22 00:00:00');
INSERT INTO `kelompok` VALUES ('221605002', '211605001', '051622001', '1', '2016-05-22 00:00:00');

-- ----------------------------
-- Table structure for `kelompok_ref`
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
-- Records of kelompok_ref
-- ----------------------------
INSERT INTO `kelompok_ref` VALUES ('221605000', '4b61ef356', '211605000', '051621001', 'satu a', '5', '2016-05-22', '2016-05-22');
INSERT INTO `kelompok_ref` VALUES ('221605001', '185c61f44', '211605000', '051622000', 'dua a', '5', '2016-05-22', '2016-05-22');
INSERT INTO `kelompok_ref` VALUES ('221605002', '170753692', '211605001', '051622001', 'TIGA A', '5', '2016-05-22', '2016-05-22');

-- ----------------------------
-- Table structure for `media`
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `kd_media` char(9) NOT NULL,
  `kd_tugas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `tgl_unggah` datetime NOT NULL,
  `filename` varchar(75) NOT NULL,
  PRIMARY KEY (`kd_tugas`,`kd_user`,`kd_media`),
  UNIQUE KEY `filename_UNIQUE` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of media
-- ----------------------------

-- ----------------------------
-- Table structure for `nilai`
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
-- Records of nilai
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
INSERT INTO `profile` VALUES ('051620000', 'Administrator', '', 'support@port-edu.com', '1', '2016-05-20');
INSERT INTO `profile` VALUES ('051621000', 'root', 'linux', 'help@mail.com', '1', '2016-05-21');
INSERT INTO `profile` VALUES ('051621001', 'NamaSangatPanjang', 'Banyak Kata', '', '1', '2016-05-21');
INSERT INTO `profile` VALUES ('051622000', 'duaa', 'user', '', '1', '2016-05-22');
INSERT INTO `profile` VALUES ('051622001', 'tiga', 'user', '', '1', '2016-05-22');
INSERT INTO `profile` VALUES ('051622002', 'Siswa', 'Utama', '', '1', '2016-05-22');
INSERT INTO `profile` VALUES ('051623000', 'Guru', 'Master', '', '2', '2016-05-23');

-- ----------------------------
-- Table structure for `tugas`
-- ----------------------------
DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas` (
  `kd_tugas` char(9) NOT NULL,
  `kd_user` char(9) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`kd_tugas`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tugas
-- ----------------------------

-- ----------------------------
-- Table structure for `tugas_ref`
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
-- Records of tugas_ref
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
  UNIQUE KEY `uname_UNIQUE` (`uname`),
  UNIQUE KEY `kd_uuid_UNIQUE` (`kd_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('051620000', '71cb46377', 'admin', 'a3e523b2789f3929f4fca17b86b81366fe72acc3', '64d0a08d52a8817e', '2016-05-20', '2016-05-20', '1');
INSERT INTO `user` VALUES ('051621000', '1a589db53', 'root', '26b390cab6a281ac0136fcb16e36050232cefadb', '1d2f2ae1520dc693', '2016-05-21', '2016-05-21', '1');
INSERT INTO `user` VALUES ('051621001', '195533fb3', 'satu', 'd4c328e958bab49f74ea7a747f5241fd1f7a2c67', '62bef20d0130dc36', '2016-05-21', '2016-05-21', '1');
INSERT INTO `user` VALUES ('051622000', '2f9dce217', 'duaa', '2e7f3df015b556262bc44a5def1c7d8213befae6', '2ed421057ddfe96b', '2016-05-22', '2016-05-22', '1');
INSERT INTO `user` VALUES ('051622001', '3c173ac50', 'tiga', '2437270525ba3f3bf5f4989cef6065a3bf9751b0', '5b0efeea01ec6934', '2016-05-22', '2016-05-22', '1');
INSERT INTO `user` VALUES ('051622002', '6d05e5f75', 'siswa', '18a3d80e5dd9f86944cfe0960de71366eff26d69', '3d4561970db73e53', '2016-05-22', '2016-05-22', '1');
INSERT INTO `user` VALUES ('051623000', '3b8107912', 'guru', 'f35dede0b25e6e5606191c4c61c0d92e73bb3e42', '1b2679980ede41f1', '2016-05-23', '2016-05-23', '1');
