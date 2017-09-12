/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - sikapi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sikapi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sikapi`;

/*Table structure for table `cabang` */

DROP TABLE IF EXISTS `cabang`;

CREATE TABLE `cabang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kodecabang` varchar(20) NOT NULL,
  `namacabang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cabang` */

insert  into `cabang`(`id`,`kodecabang`,`namacabang`) values 
(1,'01','SEMARANG'),
(2,'02','BANDUNG'),
(3,'03','JAKARTA'),
(4,'04','KALIMANTAN'),
(5,'05','KUDUS'),
(6,'06','TEMANGGUNG'),
(7,'07','KUPANG');

/*Table structure for table `jenis_kas` */

DROP TABLE IF EXISTS `jenis_kas`;

CREATE TABLE `jenis_kas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_kas` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_kas` */

insert  into `jenis_kas`(`id`,`nama_jenis_kas`) values 
(1,'UBR'),
(2,'BOP'),
(3,'UP'),
(4,'SERAGAM'),
(5,'UANG ALAT'),
(6,'PERPUSTAKAAN'),
(7,'KEGIATAN'),
(8,'UANG SEKOLAH'),
(9,'UANG KOMPUTER'),
(10,'UANG PANGKAL'),
(11,'UANG MAKAN'),
(12,'UANG BUKU & ALAT'),
(13,'KOPERASI SERAGAM'),
(14,'WARUNG SEKOLAH'),
(15,'KOPERASI'),
(16,'UBR BOS');

/*Table structure for table `kas` */

DROP TABLE IF EXISTS `kas`;

CREATE TABLE `kas` (
  `id_kas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `uraian` text NOT NULL,
  `no_bt` varchar(100) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `saldo` double NOT NULL,
  `tgl_input` date NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_kas` int(5) NOT NULL,
  `tahunpelajaran` varchar(100) NOT NULL,
  `idunit` int(5) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `kas` */

insert  into `kas`(`id_kas`,`id_user`,`tanggal`,`nomor`,`uraian`,`no_bt`,`transaksi`,`nominal`,`saldo`,`tgl_input`,`timestamp`,`jenis_kas`,`tahunpelajaran`,`idunit`) values 
(1,4,'2017-08-23','No.123','Belanja Dapur','BT','kredit',50000,0,'2017-08-23','2017-08-23 12:35:08',1,'2017/2018',1),
(2,5,'2017-08-23','SDKD10000','Uang Listrik','BTSKKD_9000','kredit',15000,0,'2017-08-23','2017-08-23 12:36:10',1,'2017/2018',9),
(3,4,'2017-08-23','NO-10000','Pembelian Seragam Siswa','BT1000','kredit',900000,0,'2017-08-23','2017-08-23 18:22:16',1,'2017/2018',1),
(4,4,'2017-08-23','NO-10000','Saldo Awal','nbt','debet',10000000,0,'2017-08-23','2017-08-23 21:22:53',1,'2017/2018',1);

/*Table structure for table `kas_bank` */

DROP TABLE IF EXISTS `kas_bank`;

CREATE TABLE `kas_bank` (
  `id_kas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `uraian` text NOT NULL,
  `no_bt` varchar(100) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `saldo` double NOT NULL,
  `tgl_input` date NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_kas` int(5) NOT NULL,
  `tahunpelajaran` varchar(100) NOT NULL,
  `nama_bank` varchar(200) NOT NULL,
  `no_rekening` varchar(200) NOT NULL,
  `idunit` int(5) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kas_bank` */

insert  into `kas_bank`(`id_kas`,`id_user`,`tanggal`,`nomor`,`uraian`,`no_bt`,`transaksi`,`nominal`,`saldo`,`tgl_input`,`timestamp`,`jenis_kas`,`tahunpelajaran`,`nama_bank`,`no_rekening`,`idunit`) values 
(1,4,'2017-08-23','NO-10000','Pembelian Seragam Siswa','BT1000','kredit',900000,0,'2017-08-23','2017-08-23 18:25:13',1,'2017/2018','Mayapada','1370005446980',1);

/*Table structure for table `kas_temp` */

DROP TABLE IF EXISTS `kas_temp`;

CREATE TABLE `kas_temp` (
  `id_kas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `uraian` text NOT NULL,
  `no_bt` varchar(100) NOT NULL,
  `debit` double NOT NULL,
  `kredit` double NOT NULL,
  `saldo` double NOT NULL,
  `tgl_input` date NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_kas` int(5) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kas_temp` */

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`level`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`id`,`level`) values 
(1,'Administrator'),
(2,'Bendahara Pusat'),
(3,'Bendahara Cabang'),
(4,'Bendahara Unit');

/*Table structure for table `trx` */

DROP TABLE IF EXISTS `trx`;

CREATE TABLE `trx` (
  `nominal` float NOT NULL,
  `kode` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `trx` */

insert  into `trx`(`nominal`,`kode`) values 
(90000,'k'),
(78000,'d'),
(15000,'k'),
(1000000,'d');

/*Table structure for table `unit` */

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `kodeunit` varchar(5) NOT NULL,
  `namaunit` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `unit` */

insert  into `unit`(`id`,`kodeunit`,`namaunit`) values 
(1,'01','TK Sinar Matahari'),
(2,'02','TK URSULA'),
(3,'03','TK CAHAYA NUR'),
(4,'04','TK COR YESU'),
(5,'05','TK MARIA BINTANG LAUT'),
(6,'06','TK SANTO YOSEPH'),
(7,'07','TK MIRIAM'),
(8,'08','TK SR. YOSEPH'),
(9,'09','SD KEBON DALEM/PINGGIR'),
(10,'10','SD MARSUDI UTAMI'),
(11,'11','SD CAHAYA NUR'),
(12,'12','SD PANGUDI UTAMI'),
(13,'13','SD MARIA BINTANG LAUT'),
(14,'14','SD SANTO YOSEPH'),
(15,'15','SMP KEBON DALEM'),
(16,'16','SMP MARSUDI UTAMI'),
(17,'17','SMP WARINGIN'),
(20,'18','SMP SANTO YOSEPH'),
(21,'19','SMA KEBON DALEM'),
(22,'20','SMA TRINITAS'),
(23,'21','TK KEBON DALEM 2'),
(24,'22','SD KEBON DALEM 2'),
(25,'23','TK TRINITAS'),
(27,'29','TK EDUARD MICHELIS'),
(29,'24','SD TRINITAS'),
(30,'90','KANTOR YPII PUSAT'),
(31,'91','KANTOR YPII CABANG SEMARANG'),
(32,'92','KANTOR YPII CABANG BANDUNG'),
(33,'93','KANTOR YPII CABANG JAKARTA'),
(34,'94','KANTOR YPII CABANG KALIMANTAN'),
(35,'95','PUSDIKOM');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `idunit` int(5) NOT NULL DEFAULT '1',
  `idcabang` int(5) NOT NULL DEFAULT '1',
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama_user`,`username`,`password`,`idunit`,`idcabang`,`level`) values 
(1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3',31,1,'1'),
(2,'Tendy Developer','tendy','4de1e6299967445fc7c8438e5d9f84df',32,2,'1'),
(3,'Sr. Virgo','virgo','4c0711c0dd6649d201428feb644fcf94',30,1,'1'),
(4,'TK Sinar Matahari','tksm','300ce42abecef8bfa8d9f6d084b274cc',1,1,'4'),
(5,'SD Kebon Dalem','sdkd','b3114cd5d954b865ac4306c8e92aa7bd',9,1,'4'),
(6,'SMP Kebon Dalem','smpkd','cb7d5c62ca2ff40a27707d42adc2eed9',15,1,'4');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
