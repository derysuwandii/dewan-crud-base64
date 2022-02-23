/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100037
 Source Host           : localhost:3306
 Source Schema         : db_dewankomputer

 Target Server Type    : MySQL
 Target Server Version : 100037
 File Encoding         : 65001

 Date: 16/03/2019 17:17:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_mahasiswa_base64
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mahasiswa_base64`;
CREATE TABLE `tbl_mahasiswa_base64`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_masuk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_mahasiswa_base64
-- ----------------------------
INSERT INTO `tbl_mahasiswa_base64` VALUES (4, 'QXJpZWwgVGF0dW0=', 'SmFrYXJ0YQ==', 'UGVyZW1wdWFu', 'MjAxOS0wMy0xMw==', 'VGVrbmlrIEluZm9ybWF0aWth');
INSERT INTO `tbl_mahasiswa_base64` VALUES (5, 'TWVyaWFtIEJlcmxpbmE=', 'UGFkYW5n', 'UGVyZW1wdWFu', 'MjAxOS0wMy0xMw==', 'U2lzdGVtIEluZm9ybWFzaQ==');
INSERT INTO `tbl_mahasiswa_base64` VALUES (6, 'RGV3YW4=', 'SmFrYXJ0YQ==', 'TGFraS1sYWtp', 'MjAxOS0wMy0wMQ==', 'U2lzdGVtIEluZm9ybWFzaQ==');
INSERT INTO `tbl_mahasiswa_base64` VALUES (7, 'S29tcHV0ZXI=', 'Q2lsYWNhcA==', 'TGFraS1sYWtp', 'MjAxOS0wMy0wNw==', 'VGVrbmlrIEluZm9ybWF0aWth');
INSERT INTO `tbl_mahasiswa_base64` VALUES (8, 'QWhtYWQgWWFuaQ==', 'UHVyd29rZXJ0bw==', 'TGFraS1sYWtp', 'MjAxOS0wMy0wMQ==', 'VGVrbmlrIEluZm9ybWF0aWth');

SET FOREIGN_KEY_CHECKS = 1;
