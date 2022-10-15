/*
SQLyog Community v11.31 (32 bit)
MySQL - 5.5.39 : Database - profile_matching
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`profile_matching` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `profile_matching`;

/*Table structure for table `analisis` */

DROP TABLE IF EXISTS `analisis`;

CREATE TABLE `analisis` (
  `id_analisis` int(5) NOT NULL AUTO_INCREMENT,
  `profile_target` int(5) DEFAULT NULL,
  `runtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_analisis`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `analisis` */

insert  into `analisis`(`id_analisis`,`profile_target`,`runtime`) values (3,4,'2015-05-11 00:24:21'),(4,4,'2015-05-11 21:09:06'),(5,4,'2015-06-03 02:39:59'),(6,4,'2015-06-03 02:42:40'),(7,4,'2015-06-03 02:55:52'),(8,7,'2015-06-03 10:26:13');

/*Table structure for table `detil_keputusan` */

DROP TABLE IF EXISTS `detil_keputusan`;

CREATE TABLE `detil_keputusan` (
  `id_detil_hasil` int(5) NOT NULL AUTO_INCREMENT,
  `id_hasil` int(5) NOT NULL,
  `id_kandidat` int(5) NOT NULL,
  `keputusan` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_detil_hasil`),
  KEY `id_hasil` (`id_hasil`),
  CONSTRAINT `detil_keputusan_ibfk_1` FOREIGN KEY (`id_hasil`) REFERENCES `keputusan` (`id_hasil`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `detil_keputusan` */

insert  into `detil_keputusan`(`id_detil_hasil`,`id_hasil`,`id_kandidat`,`keputusan`) values (11,3,10,0),(12,3,11,0),(13,3,12,1),(14,3,13,0),(15,3,14,0),(16,4,10,0),(17,4,11,0),(18,4,12,1),(19,4,13,0),(20,4,14,0),(21,5,10,0),(22,5,11,0),(23,5,12,0),(24,5,13,0),(25,5,14,0),(26,5,24,0),(27,6,10,0),(28,6,11,0),(29,6,12,0),(30,6,13,0),(31,6,14,0),(32,6,24,0),(33,7,10,0),(34,7,11,0),(35,7,12,0),(36,7,13,0),(37,7,14,0),(38,7,24,0),(39,8,16,0),(40,8,17,0),(41,8,24,0);

/*Table structure for table `kandidat` */

DROP TABLE IF EXISTS `kandidat`;

CREATE TABLE `kandidat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_profil` int(6) NOT NULL,
  `id_pegawai` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `kandidat` */

insert  into `kandidat`(`id`,`id_profil`,`id_pegawai`) values (7,4,10),(8,4,11),(9,4,12),(10,4,13),(11,4,14),(12,4,24),(31,7,16),(32,7,17),(33,7,24);

/*Table structure for table `keputusan` */

DROP TABLE IF EXISTS `keputusan`;

CREATE TABLE `keputusan` (
  `id_hasil` int(5) NOT NULL AUTO_INCREMENT,
  `id_analisis` int(5) DEFAULT NULL,
  `status_keputusan` enum('final','draft') DEFAULT 'draft',
  PRIMARY KEY (`id_hasil`),
  UNIQUE KEY `id_analisis` (`id_analisis`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `keputusan` */

insert  into `keputusan`(`id_hasil`,`id_analisis`,`status_keputusan`) values (3,3,'final'),(4,4,'final'),(5,5,'draft'),(6,6,'draft'),(7,7,'draft'),(8,8,'draft');

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id_kriteria` int(6) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(25) DEFAULT NULL,
  `nama_kriteria` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  UNIQUE KEY `kode_kriteria` (`kode_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id_kriteria`,`kode_kriteria`,`nama_kriteria`,`keterangan`) values (9,'K1','Aspek Kapasitas Intelektual',''),(10,'K2','Sikap Kerja','');

/*Table structure for table `nilai_pegawai` */

DROP TABLE IF EXISTS `nilai_pegawai`;

CREATE TABLE `nilai_pegawai` (
  `id_pegawai` int(6) NOT NULL,
  `id_subkriteria` int(6) NOT NULL,
  `nilai` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`,`id_subkriteria`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_subkriteria` (`id_subkriteria`),
  CONSTRAINT `nilai_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_pegawai_ibfk_2` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_pegawai` */

insert  into `nilai_pegawai`(`id_pegawai`,`id_subkriteria`,`nilai`) values (10,9,4),(10,10,4),(10,11,4),(10,12,4),(10,13,1),(10,14,1),(10,15,1),(10,16,1),(10,17,1),(10,18,1),(10,19,1),(10,20,1),(10,21,1),(10,22,1),(10,25,1),(11,9,3),(11,10,3),(11,11,3),(11,12,4),(11,13,4),(11,14,3),(11,15,4),(11,16,2),(11,17,4),(11,18,3),(11,19,3),(11,20,4),(11,21,4),(11,22,4),(11,25,3),(12,9,4),(12,10,3),(12,11,4),(12,12,4),(12,13,4),(12,14,3),(12,15,4),(12,16,4),(12,17,4),(12,18,3),(12,19,3),(12,20,4),(12,21,3),(12,22,4),(12,25,4),(13,9,3),(13,10,3),(13,11,3),(13,12,4),(13,13,3),(13,14,2),(13,15,3),(13,16,2),(13,17,3),(13,18,4),(13,19,4),(13,20,4),(13,21,3),(13,22,2),(13,25,3),(14,9,4),(14,10,3),(14,11,3),(14,12,4),(14,13,3),(14,14,2),(14,15,4),(14,16,3),(14,17,4),(14,18,3),(14,19,3),(14,20,2),(14,21,3),(14,22,4),(14,25,3);

/*Table structure for table `nilai_profil_mutasi` */

DROP TABLE IF EXISTS `nilai_profil_mutasi`;

CREATE TABLE `nilai_profil_mutasi` (
  `id_nilai_profil_mutasi` int(6) NOT NULL AUTO_INCREMENT,
  `id_profil_mutasi` int(6) NOT NULL,
  `id_subkriteria` int(6) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai_profil_mutasi`),
  KEY `id_profil_mutasi` (`id_profil_mutasi`),
  KEY `id_subkriteria` (`id_subkriteria`),
  CONSTRAINT `nilai_profil_mutasi_ibfk_1` FOREIGN KEY (`id_profil_mutasi`) REFERENCES `profil_mutasi` (`id_pm`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_profil_mutasi_ibfk_2` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

/*Data for the table `nilai_profil_mutasi` */

insert  into `nilai_profil_mutasi`(`id_nilai_profil_mutasi`,`id_profil_mutasi`,`id_subkriteria`,`nilai`) values (16,4,16,3),(17,4,17,4),(18,4,18,3),(19,4,19,3),(20,4,20,4),(21,4,21,3),(22,4,22,3),(23,4,25,4),(24,4,9,3),(25,4,10,4),(26,4,11,3),(27,4,12,3),(28,4,13,4),(29,4,14,3),(30,4,15,4),(31,5,16,5),(32,5,17,5),(33,5,18,5),(34,5,19,5),(35,5,20,5),(36,5,21,5),(37,5,22,5),(38,5,25,5),(39,5,9,5),(40,5,10,5),(41,5,11,5),(42,5,12,5),(43,5,13,5),(44,5,14,5),(45,5,15,5),(46,6,16,1),(47,6,17,1),(48,6,18,1),(49,6,19,1),(50,6,20,1),(51,6,21,1),(52,6,22,1),(53,6,25,1),(54,6,9,1),(55,6,10,1),(56,6,11,1),(57,6,12,1),(58,6,13,1),(59,6,14,1),(60,6,15,1),(61,7,16,1),(62,7,17,1),(63,7,18,1),(64,7,19,1),(65,7,20,1),(66,7,21,1),(67,7,22,1),(68,7,25,1),(69,7,9,1),(70,7,10,1),(71,7,11,1),(72,7,12,1),(73,7,13,1),(74,7,14,1),(75,7,15,1);

/*Table structure for table `nilai_total_analisis_peserta` */

DROP TABLE IF EXISTS `nilai_total_analisis_peserta`;

CREATE TABLE `nilai_total_analisis_peserta` (
  `id_analisis` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_total` double NOT NULL,
  KEY `id_analisis` (`id_analisis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_total_analisis_peserta` */

insert  into `nilai_total_analisis_peserta`(`id_analisis`,`id_peserta`,`id_kriteria`,`nilai_total`) values (5,10,9,3.46),(5,11,9,4.82),(5,12,9,4.7),(5,13,9,4.3),(5,14,9,4.36),(5,10,10,2.6),(5,11,10,4.65),(5,12,10,4.9),(5,13,10,4.5),(5,14,10,4.45),(3,10,9,3.46),(3,11,9,4.82),(3,12,9,4.7),(3,13,9,4.3),(3,14,9,4.36),(3,10,10,2.6),(3,11,10,4.65),(3,12,10,4.9),(3,13,10,4.5),(3,14,10,4.45),(4,10,9,3.46),(4,11,9,4.82),(4,12,9,4.7),(4,13,9,4.3),(4,14,9,4.36),(4,10,10,2.6),(4,11,10,4.65),(4,12,10,4.9),(4,13,10,4.5),(4,14,10,4.45),(5,10,9,0),(5,11,9,0),(5,12,9,0),(5,13,9,0),(5,14,9,0),(5,24,9,0),(5,10,10,0),(5,11,10,0),(5,12,10,0),(5,13,10,0),(5,14,10,0),(5,24,10,0),(6,10,9,3.46),(6,11,9,4.82),(6,12,9,4.7),(6,13,9,4.3),(6,14,9,4.36),(6,24,9,2.56),(6,10,10,2.6),(6,11,10,4.65),(6,12,10,4.9),(6,13,10,4.5),(6,14,10,4.45),(6,24,10,2.6),(7,10,9,3.46),(7,11,9,4.82),(7,12,9,4.7),(7,13,9,4.3),(7,14,9,4.36),(7,24,9,2.56),(7,10,10,2.6),(7,11,10,4.65),(7,12,10,4.9),(7,13,10,4.5),(7,14,10,4.45),(7,24,10,2.6),(8,16,9,0),(8,17,9,0),(8,24,9,0),(8,16,10,0),(8,17,10,0),(8,24,10,0);

/*Table structure for table `notifikasi` */

DROP TABLE IF EXISTS `notifikasi`;

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(5) NOT NULL AUTO_INCREMENT,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `judul` varchar(70) DEFAULT NULL,
  `pesan` text,
  `id_analisis` int(5) DEFAULT NULL,
  `id_pegawai` int(5) DEFAULT NULL,
  `read` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_notifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `notifikasi` */

insert  into `notifikasi`(`id_notifikasi`,`waktu`,`judul`,`pesan`,`id_analisis`,`id_pegawai`,`read`) values (1,'2015-05-23 21:22:47','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',3,10,1),(2,'2015-05-11 00:24:21','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',3,11,0),(3,'2015-05-11 23:59:37','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',3,12,1),(4,'2015-05-11 00:24:21','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',3,13,0),(5,'2015-05-11 00:24:21','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',3,14,0),(6,'2015-05-23 21:22:47','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',4,10,1),(7,'2015-05-11 21:09:06','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',4,11,0),(8,'2015-05-11 23:59:37','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',4,12,1),(9,'2015-05-11 21:09:06','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',4,13,0),(10,'2015-05-11 21:09:06','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',4,14,0),(11,'2015-05-23 21:22:47','Keputusan','Anda dinyatakan TIDAK LAYAK untuk menempati MANAGER wilayah PALEMBANG',4,10,1),(12,'2015-05-11 23:46:42','Keputusan','Anda dinyatakan TIDAK LAYAK untuk menempati MANAGER wilayah PALEMBANG',4,11,0),(13,'2015-05-11 23:59:37','Keputusan','Anda dinyatakan LAYAK untuk menempati MANAGER wilayah PALEMBANG',4,12,1),(14,'2015-05-11 23:46:51','Keputusan','Anda dinyatakan TIDAK LAYAK untuk menempati MANAGER wilayah PALEMBANG',4,13,0),(15,'2015-05-11 23:46:47','Keputusan','Anda dinyatakan TIDAK LAYAK untuk menempati MANAGER wilayah PALEMBANG',4,14,0),(16,'2015-06-03 02:43:28','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,10,1),(17,'2015-06-03 02:39:59','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,11,0),(18,'2015-06-03 02:39:59','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,12,0),(19,'2015-06-03 02:39:59','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,13,0),(20,'2015-06-03 02:39:59','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,14,0),(21,'2015-06-03 02:39:59','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',5,24,0),(22,'2015-06-03 02:43:28','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,10,1),(23,'2015-06-03 02:42:40','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,11,0),(24,'2015-06-03 02:42:40','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,12,0),(25,'2015-06-03 02:42:40','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,13,0),(26,'2015-06-03 02:42:40','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,14,0),(27,'2015-06-03 02:42:40','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',6,24,0),(28,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,10,0),(29,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,11,0),(30,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,12,0),(31,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,13,0),(32,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,14,0),(33,'2015-06-03 02:55:52','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',7,24,0),(34,'2015-06-03 10:26:13','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',8,16,0),(35,'2015-06-03 10:26:13','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',8,17,0),(36,'2015-06-03 10:26:13','Promosi Jabatan','Anda menjadi salah satu kandidat mutasi untuk jabatan MANAGER wilayah PALEMBANG',8,24,0);

/*Table structure for table `parameter_analisis` */

DROP TABLE IF EXISTS `parameter_analisis`;

CREATE TABLE `parameter_analisis` (
  `id_analisis` int(5) NOT NULL,
  `jenis_parameter` enum('CFP','SFP','CP') NOT NULL,
  `referensi` int(5) NOT NULL,
  `nilai` double NOT NULL,
  KEY `id_analisis` (`id_analisis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `parameter_analisis` */

insert  into `parameter_analisis`(`id_analisis`,`jenis_parameter`,`referensi`,`nilai`) values (3,'CFP',0,60),(3,'SFP',0,40),(3,'CP',9,40),(3,'CP',10,60),(4,'CFP',0,60),(4,'SFP',0,40),(4,'CP',9,40),(4,'CP',10,60),(5,'CFP',0,0),(5,'SFP',0,0),(5,'CP',9,0),(5,'CP',10,0),(6,'CFP',0,60),(6,'SFP',0,40),(6,'CP',9,40),(6,'CP',10,60),(7,'CFP',0,60),(7,'SFP',0,40),(7,'CP',9,40),(7,'CP',10,60),(8,'CFP',0,0),(8,'SFP',0,0),(8,'CP',9,0),(8,'CP',10,0);

/*Table structure for table `parameter_profil_mutasi` */

DROP TABLE IF EXISTS `parameter_profil_mutasi`;

CREATE TABLE `parameter_profil_mutasi` (
  `id_pm` int(5) NOT NULL,
  `jenis_parameter` enum('CFP','SFP','CP') NOT NULL,
  `referensi` int(5) NOT NULL,
  `nilai` double NOT NULL,
  KEY `id_analisis` (`id_pm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `parameter_profil_mutasi` */

insert  into `parameter_profil_mutasi`(`id_pm`,`jenis_parameter`,`referensi`,`nilai`) values (6,'CFP',0,50),(6,'SFP',0,50),(6,'CP',9,50),(6,'CP',10,50),(4,'CFP',0,60),(4,'SFP',0,40),(4,'CP',9,40),(4,'CP',10,60);

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `kd_pegawai` varchar(25) DEFAULT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL,
  `alamat` text,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `diangkat_per` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kd_pegawai` (`kd_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `pegawai` */

insert  into `pegawai`(`id`,`kd_pegawai`,`nama_pegawai`,`alamat`,`tempat_lahir`,`tanggal_lahir`,`diangkat_per`,`jenis_kelamin`) values (10,'01','Ahmad Zulfikar','asdasd','Palembang','2012-02-07','2012-02-12','L'),(11,'02','Dena Christina','alamat','_','2012-02-12','2012-02-12',NULL),(12,'03','Fahra Lubis','asdasd','--','2012-02-12','2012-02-12',NULL),(13,'04','Jimmy Berlian','asdasd','-','2012-02-12','2012-02-12',NULL),(14,'05','Masyito Hermawan','asdasd','asdasdasd','2012-02-12','2012-02-12',NULL),(16,'06','Ike','palembang','Palembang','2012-01-30','2012-02-15',NULL),(17,'07','Frans Filasta Pratama','JL. Kemala ','Sungai Liat','2012-02-12','2012-02-12',NULL),(19,'10','tukul arwana','asdasd','Semarang','2012-02-19','2012-02-14',NULL),(23,'kaki','kasjdkajsd','asdasd','askdjkasdj','2012-02-12','2012-02-12',NULL),(24,'kakis','Roni Sianturi','asdasd','askdjkasdj','2012-02-12','2012-02-12',NULL);

/*Table structure for table `pendidikan_nonformal` */

DROP TABLE IF EXISTS `pendidikan_nonformal`;

CREATE TABLE `pendidikan_nonformal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(6) NOT NULL,
  `nama_kursus` varchar(75) NOT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `lamanya` int(2) NOT NULL DEFAULT '0',
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `pendidikan_nonformal` */

insert  into `pendidikan_nonformal`(`id`,`id_pegawai`,`nama_kursus`,`tempat`,`lamanya`,`keterangan`) values (2,10,'Kursus Menjahit','Mama Dedeh',0,'asd'),(3,16,'Kursus Bahasa Inggris','ASDASD',0,'ASDASD'),(4,17,'ddd',NULL,1,NULL),(5,18,'kasdjaksdj','kjaskdjasd',1,NULL),(7,22,'asdkjasd','asdkjaskd',1,'alsdkl'),(9,24,'Kursus Bahasa Inggris','LBB LIA',1,'asd'),(12,24,'Kursus Bahasa Jerman','LBB LIA',1,'asd'),(13,24,'Kursus Bahasa Cina','LBB LIA',1,'asdasd'),(14,24,'Kursus Bahasa Spanyol','LBB LIA',2,'lkasldk');

/*Table structure for table `pendidikan_pegawai` */

DROP TABLE IF EXISTS `pendidikan_pegawai`;

CREATE TABLE `pendidikan_pegawai` (
  `id_pendidikan` int(6) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(6) NOT NULL,
  `institusi` varchar(100) NOT NULL,
  `tingkat` int(1) NOT NULL DEFAULT '1',
  `jurusan` varchar(200) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `tahun_keluar` year(4) NOT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`id_pendidikan`),
  KEY `id_pegawai` (`id_pegawai`),
  CONSTRAINT `pendidikan_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `pendidikan_pegawai` */

insert  into `pendidikan_pegawai`(`id_pendidikan`,`id_pegawai`,`institusi`,`tingkat`,`jurusan`,`tahun_masuk`,`tahun_keluar`,`nilai`) values (2,10,'asdasd',1,'asdasd',0000,0000,0),(3,10,'123',2,'123',2012,0000,123),(4,11,'Universitas Sriwijaya',2,'Sistem Informasi',2010,2014,4),(5,11,'Universitas Sriwijaya',2,'Sistem Informasi',2010,2014,4),(6,12,'Universitas Sriwijaya',2,'Sistem Informasi',2010,2014,4),(7,13,'asd',2,'asd',2010,2014,3.33),(8,14,'123123',2,'123123',2010,2017,4),(11,16,'KKKKKK',1,'KKK',2010,2013,4),(12,17,'ddd90',1,'askdfj',2010,2014,3.58),(17,24,'Universitas Sriwijaya',1,'Sistem Informasi 1',2010,2014,3.58),(18,24,'Universitas Sriwijaya',2,'Sistem Informasi',2010,2014,3.58);

/*Table structure for table `profil_mutasi` */

DROP TABLE IF EXISTS `profil_mutasi`;

CREATE TABLE `profil_mutasi` (
  `id_pm` int(6) NOT NULL AUTO_INCREMENT,
  `nama_profil_mutasi` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pendidikan_minimum` int(1) NOT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`id_pm`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `profil_mutasi` */

insert  into `profil_mutasi`(`id_pm`,`nama_profil_mutasi`,`wilayah`,`keterangan`,`pendidikan_minimum`,`nilai`) values (4,'Manager','Palembang','0',2,3),(5,'Komisaris','Jambi','0',4,3.85),(6,'Kepala Cabang','Bangka Belitung','0',4,3),(7,'Test','etasd','0',1,2.75);

/*Table structure for table `riwayat_jabatan` */

DROP TABLE IF EXISTS `riwayat_jabatan`;

CREATE TABLE `riwayat_jabatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(6) NOT NULL,
  `jabatan` varchar(75) NOT NULL,
  `wilayah` varchar(75) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `riwayat_jabatan` */

insert  into `riwayat_jabatan`(`id`,`id_pegawai`,`jabatan`,`wilayah`,`dari`,`sampai`,`keterangan`) values (1,22,'sadkasdjk','askdjkas','0000-00-00','0000-00-00','alsdkl'),(2,24,'Direktur Utama','Pertamina','2010-01-22','2016-01-22','asd'),(4,24,'Dierektur Kedua','Pertamin','2015-05-13','2015-05-13',NULL),(5,24,'Ciyeee','alskd','2015-05-07','2015-05-05',NULL);

/*Table structure for table `subkriteria` */

DROP TABLE IF EXISTS `subkriteria`;

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(6) NOT NULL AUTO_INCREMENT,
  `kode_subkriteria` varchar(25) DEFAULT NULL,
  `nama_subkriteria` varchar(50) DEFAULT NULL,
  `id_kriteria` int(6) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `jenis_nilai` enum('CF','SF') DEFAULT NULL,
  PRIMARY KEY (`id_subkriteria`),
  UNIQUE KEY `kode_subkriteria` (`kode_subkriteria`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `subkriteria` */

insert  into `subkriteria`(`id_subkriteria`,`kode_subkriteria`,`nama_subkriteria`,`id_kriteria`,`keterangan`,`jenis_nilai`) values (9,'P','Pendidikan',9,'','CF'),(10,'PT','Pencapaian Target',9,'','CF'),(11,'PK','Perencanaan Kerja',9,'','CF'),(12,'KK','Kontrol Kerja',9,'','CF'),(13,'MK','Motivasi Kerja',9,'','SF'),(14,'IS','Inisiatif',9,'','SF'),(15,'KB','Kecepatan Bekerja',9,'','CF'),(16,'LB','Lama Bekerja',10,'','CF'),(17,'LY','Loyalitas',10,'','CF'),(18,'KT','Ketelitian',10,'','CF'),(19,'KA','Keakuratan',10,'','CF'),(20,'KM','Komunikasi',10,'','SF'),(21,'IG','Integritas',10,'','SF'),(22,'KSKD','Kerjasama dan Kedisiplinan',10,'','CF'),(25,'TJ','Tanggung Jawab',10,'','CF');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `role` enum('Manager','Pegawai','Kepegawaian') DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`username`,`password`,`role`,`nama`,`jabatan`) values (1,'manager','1d0258c2440a8d19e716292b231e3190','Manager','Manager','admin'),(4,'01','fff362de37277ebf4e9aff1a080770e8','Pegawai','Ahmad Zulfikar','Pegawai'),(5,'02','a2ef406e2c2351e0b9e80029c909242d','Pegawai','Dena Christina','Pegawai'),(6,'03','fff362de37277ebf4e9aff1a080770e8','Pegawai','Fahra Lubis','Pegawai'),(7,'04','7d0665438e81d8eceb98c1e31fca80c1','Pegawai','Jimmy Berlian','Pegawai'),(8,'05','751d31dd6b56b26b29dac2c0e1839e34','Pegawai','Masyito Hermawan','Pegawai'),(9,'kepegawaian','d45de20a488481327b5c7f2600b861cf','Kepegawaian','Kepegawaian',NULL),(11,'06','faeac4e1eef307c2ab7b0a3821e6c667','Pegawai','Ike','Pegawai'),(12,'07','d72d187df41e10ea7d9fcdc7f5909205','Pegawai','Frans Filasta Pratama','Pegawai'),(14,'10','d3d9446802a44259755d38e6d163e820','Pegawai','tukul arwana','Pegawai'),(18,'kaki','9f5cc93a91524713c66b55d7ff1233fb','Pegawai','kasjdkajsd','Pegawai'),(19,'kakis','02d5b12f8a726f24870c13f3207b1b7e','Pegawai','Roni Sianturi','Pegawai');

/* Trigger structure for table `detil_keputusan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `notifikasi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `notifikasi` AFTER INSERT ON `detil_keputusan` FOR EACH ROW BEGIN
	DECLARE judul VARCHAR(70);
	DECLARE pesan TEXT;
	DECLARE jabatannya VARCHAR(100);
	DECLARE wilayahnya VARCHAR(100);
	declare idAnalisis int(5);
	
	select id_analisis into idAnalisis from keputusan where id_hasil = new.id_hasil;
	
	SELECT nama_profil_mutasi,wilayah INTO jabatannya,wilayahnya FROM profil_mutasi LEFT JOIN analisis ON analisis.id_analisis = idAnalisis group by analisis.id_analisis limit 1;
	
	SET judul = "Promosi Jabatan";
	SET pesan = CONCAT("Anda menjadi salah satu kandidat mutasi untuk jabatan ",
				UPPER(jabatannya)
				," wilayah ",UPPER(wilayahnya));
				
	insert into notifikasi values(null,null,judul,pesan,idAnalisis,new.id_kandidat,0);
	
    END */$$


DELIMITER ;

/* Trigger structure for table `detil_keputusan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `notifikasi_hasil` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `notifikasi_hasil` AFTER UPDATE ON `detil_keputusan` FOR EACH ROW BEGIN
	DECLARE judul VARCHAR(70);
	DECLARE pesan TEXT;
	DECLARE jabatannya VARCHAR(100);
	DECLARE wilayahnya VARCHAR(100);
	DECLARE idAnalisis INT(5);
	DECLARE statusnya VARCHAR(20);
	
	SELECT id_analisis INTO idAnalisis FROM keputusan WHERE id_hasil = new.id_hasil;
	
	SELECT nama_profil_mutasi,wilayah INTO jabatannya,wilayahnya FROM profil_mutasi LEFT JOIN analisis ON analisis.id_analisis = idAnalisis GROUP BY analisis.id_analisis LIMIT 1;
	
	SET judul = "Keputusan";
		
	IF( new.keputusan = 1 ) THEN
		SET statusnya = "LAYAK";
	ELSE
		SET statusnya = "TIDAK LAYAK";
	END IF;
	
	SET pesan = CONCAT("Anda dinyatakan ",statusnya," untuk menempati ",
				UPPER(jabatannya)
				," wilayah ",UPPER(wilayahnya));
				
	INSERT INTO notifikasi VALUES(NULL,NULL,judul,pesan,idAnalisis,new.id_kandidat,0);
    END */$$


DELIMITER ;

/* Trigger structure for table `pegawai` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_user` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_user` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
	insert into users values(NULL,new.kd_pegawai,md5(new.kd_pegawai),'Pegawai',new.nama_pegawai,'Pegawai');	
    END */$$


DELIMITER ;

/* Trigger structure for table `pegawai` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_update_user` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_update_user` AFTER UPDATE ON `pegawai` FOR EACH ROW BEGIN
	update users set username = new.kd_pegawai, nama = new.nama_pegawai where username = old.kd_pegawai;
    END */$$


DELIMITER ;

/* Trigger structure for table `pegawai` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_delete_user` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_delete_user` AFTER DELETE ON `pegawai` FOR EACH ROW BEGIN
	delete from users where username = old.kd_pegawai;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `report` */

/*!50003 DROP PROCEDURE IF EXISTS  `report` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `report`(in id_analisis int(5))
BEGIN
	SET @sql = NULL;
	set @sql2 = null;
	SELECT 
		GROUP_CONCAT(DISTINCT 
				CONCAT('MAX(IF(`nilai_total_analisis_peserta`.id_kriteria = ''',
					`nilai_total_analisis_peserta`.id_kriteria,''',
					nilai_total*(select (nilai/100) from parameter_analisis where jenis_parameter = ''','CP',''' and referensi = ''',`nilai_total_analisis_peserta`.id_kriteria,''' and id_analisis = ''',id_analisis,'''),0.0)) as ',REPLACE(nama_kriteria,' ','_')) SEPARATOR ',') INTO @sql
	FROM `nilai_total_analisis_peserta`
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria;
	SELECT 
		concat('(',GROUP_CONCAT(DISTINCT 
				CONCAT('MAX(IF(`nilai_total_analisis_peserta`.id_kriteria = ''',
					`nilai_total_analisis_peserta`.id_kriteria,''',
					nilai_total*(select (nilai/100) from parameter_analisis where jenis_parameter = ''','CP',''' and referensi = ''',`nilai_total_analisis_peserta`.id_kriteria,''' and id_analisis = ''',id_analisis,'''),0.0))') SEPARATOR '+'),') as hasil_akhir') INTO @sql2
	FROM `nilai_total_analisis_peserta`
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria;
	
	
	SET @sql = CONCAT("select kd_pegawai, nama_pegawai,",@sql,
	',',@sql2,' FROM `nilai_total_analisis_peserta` 
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria 
	left join pegawai on pegawai.id = `nilai_total_analisis_peserta`.id_peserta
	where id_analisis = ''',id_analisis,'''
	group by `nilai_total_analisis_peserta`.`id_peserta` order by hasil_akhir desc');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_2` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_2` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `report_2`( IN id_analisis INT(5) )
BEGIN
	SET @sql = NULL;
	SET @sql2 = NULL;
	SELECT 
		GROUP_CONCAT(DISTINCT 
				CONCAT('MAX(IF(`nilai_total_analisis_peserta`.id_kriteria = ''',
					`nilai_total_analisis_peserta`.id_kriteria,''',
					TRUNCATE((nilai_total*
					(select 
					   (nilai/100) 
				         from 
					    parameter_analisis 
					 where 
					    jenis_parameter = ''','CP',''' 
						and 
				            referensi = ''',`nilai_total_analisis_peserta`.id_kriteria,''' 
						 and 
					    id_analisis = ''',id_analisis,'''
					)),3),0.0)) as ',REPLACE(nama_kriteria,' ','_')) SEPARATOR ',') INTO @sql
	FROM `nilai_total_analisis_peserta`
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria;
	SELECT 
		CONCAT('(',GROUP_CONCAT(DISTINCT 
				CONCAT('MAX(IF(`nilai_total_analisis_peserta`.id_kriteria = ''',
					`nilai_total_analisis_peserta`.id_kriteria,''',
					
					  TRUNCATE((nilai_total*(
						select (nilai/100) 
						from 
						  parameter_analisis 
						where 
						  jenis_parameter = ''','CP',''' 
						  and referensi = ''',`nilai_total_analisis_peserta`.id_kriteria,''' 
						  and id_analisis = ''',id_analisis,''')),2),0.0))') SEPARATOR '+'),') as hasil_akhir') INTO @sql2
	FROM `nilai_total_analisis_peserta`
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria;
	
	
	SET @sql = CONCAT("select id,kd_pegawai, nama_pegawai,",@sql,
	',',@sql2,' ,detil_keputusan.id_detil_hasil,keputusan.id_hasil ,detil_keputusan.keputusan,status_keputusan FROM `nilai_total_analisis_peserta` 
	LEFT JOIN kriteria ON kriteria.id_kriteria = `nilai_total_analisis_peserta`.id_kriteria 
	left join pegawai on pegawai.id = `nilai_total_analisis_peserta`.id_peserta
	left join keputusan on keputusan.id_analisis = nilai_total_analisis_peserta.id_analisis
	left join detil_keputusan on keputusan.id_hasil = detil_keputusan.id_hasil and detil_keputusan.id_kandidat = pegawai.id
	where keputusan.id_analisis = ''',id_analisis,'''
	group by `nilai_total_analisis_peserta`.`id_peserta` order by hasil_akhir desc');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
