/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 8.0.30 : Database - toko_online
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`toko_online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `toko_online`;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama`) values 
(1,'Flowers Bouquet'),
(6,'Snack Bouquet'),
(7,'Money Bouquet');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_product_id` (`product_id`),
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `keranjang` */

insert  into `keranjang`(`id`,`user_id`,`product_id`,`quantity`) values 
(1,15,2,4),
(3,15,3,7),
(8,16,3,1),
(9,17,3,1),
(10,17,2,5),
(11,19,3,1),
(13,22,3,3),
(14,24,11,1),
(15,24,16,1),
(16,24,10,1),
(17,25,3,2),
(18,25,19,1),
(19,25,15,1),
(20,26,2,1),
(21,26,15,1),
(22,26,19,1),
(23,18,11,2),
(24,29,12,1);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ketersediaan_stok` enum('habis','tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'tersedia',
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`),
  KEY `kategori_produk` (`kategori_id`),
  CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`id`,`kategori_id`,`nama`,`harga`,`foto`,`detail`,`ketersediaan_stok`) values 
(2,1,'Luxury',50000,'VwQW2s4uhuDwFAdZtVdg.jpg','   Ini adalah produk Luxury dengan rangkaian Lily putih yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin.                                    ','tersedia'),
(3,1,'Louise',50000,'T2IkRYlVlSq30ebYluNI.jpg','   Ini adalah produk Louise dengan rangkaian Pompom Hydrange yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin. Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka.                                                ','tersedia'),
(9,1,'Victoria',50000,'st3xyZ8dXeQDdH3UhxPp.jpg','Ini adalah produk Victoria dengan rangkaian Mawar merah muda dan mawar kuning  yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin.  Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka','tersedia'),
(10,1,'Felice',50000,'XrsC28qnbz3wcs1g3Mtj.jpg','Ini adalah produk Felice dengan rangkaian Mawar yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin.       \r\n Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka.','tersedia'),
(11,1,'Flora&#039;s',50000,'33Ud5575U1yAWCa7egiD.jpg','Ini adalah produk Flora&#039;s  dengan rangkaian Bunga Lily yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin. Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka.','tersedia'),
(12,1,'Ixora',50000,'GsSw6nWDefZ5rrOBdGAU.jpg','Ini adalah produk Ixora dengan rangkaian Pompom Hydrangea yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin. Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka.','tersedia'),
(13,1,'Daisy',50000,'OialxPS4sarb7fdVHxyb.jpg','Ini adalah produk Daisy dengan rangkaian Mawar merah dan Mawar putih yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin. Buket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka','tersedia'),
(14,1,'Nerine',25000,'DVn80njqp31IHZxAjmRz.jpg','Ini adalah produk Nerine dengan rangkaian Bunga Lily dan mawar putih yang indah, dihias dengan hiasan daun didalamnya, serta dirangkai cantik dalam Chellophane Paper dengan Pita satin.       \r\nBuket ini sangat cocok untuk momen ulang tahun, anniversary ataupun untuk menyampaikan ucapan selamat kepada mereka.','tersedia'),
(15,6,'Good Day',60000,'fFGwMIaX1Dwr8apOUncj.jpg','                        Snack Bouquet GoodDay adalah buket camilan  yang disusun dengan cantik, dan memberikan kesan mewah dan penuh perhatian  untuk berbagai kesempatan, mulai dari ulang tahun, perayaan, hingga hadiah untuk orang tersayang.                    ','tersedia'),
(16,6,'Dairy Milk',65000,'azTqg1LhYiIzsFbYRNdQ.jpg','Snack Bouquet Dairy Milk adalah buket camilan yang memanjakan pecinta cokelat. Buket ini dirancang khusus dengan berbagai varian cokelat Dairy Milk yang populer, menjadikannya hadiah yang sempurna untuk ulang tahun, perayaan, atau sekadar untuk menyenangkan orang tersayang.','tersedia'),
(17,6,'Nextar',60000,'Y7904BPWB7jaRBbDslsv.jpg','Snack Bouquet Nextar adalah pilihan yang sempurna bagi pecinta kue dan camilan manis. Buket ini berisi berbagai varian kue Nextar yang lezat dan populer, menjadikannya hadiah ideal untuk ulang tahun, perayaan, atau sekadar untuk menyenangkan orang tersayang.','tersedia'),
(18,6,'Pocky',100000,'roToWGnXVjLigbzjFJXV.jpg','                        Snack Bouquet Pocky adalah buket camilan yang memadukan kelezatan stik cokelat Pocky dengan berbagai varian rasanya. Buket ini cocok sebagai hadiah spesial untuk segala kesempatan, menawarkan kombinasi yang lezat dan menarik bagi pecinta camilan.                    ','tersedia'),
(19,7,'Bles Money',560000,'YC6xtvxEM3yoYfEZc4K0.jpg','Bles Money Bouquet adalah buket kreatif yang terdiri dari 10 lembar uang pecahan 50.000 Rupiah yang disusun dengan cantik, cocok sebagai hadiah unik dan berkesan untuk berbagai acara spesial seperti pernikahan, ulang tahun, atau sebagai ucapan selamat . ','tersedia'),
(20,7,'Golden Money',1100000,'E6CW2nHR6KK0M8tyUI2j.jpg','Golden Money Bouquet adalah buket kreatif yang terdiri dari 10 lembar uang pecahan 100.000 Rupiah yang disusun dengan cantik, cocok sebagai hadiah unik dan berkesan untuk berbagai acara spesial seperti pernikahan, ulang tahun, atau sebagai ucapan selamat .','tersedia'),
(21,7,'Bloom Money',260000,'TiZtdNlsAJJysEpcTP2V.jpg','Bloom Money Bouquet adalah buket kreatif yang terdiri dari 10 lembar uang pecahan 20.000 Rupiah yang disusun dengan cantik, cocok sebagai hadiah unik dan berkesan untuk berbagai acara spesial seperti pernikahan, ulang tahun, atau sebagai ucapan selamat .','tersedia'),
(22,7,'Baby Money',120000,'yGwjfhc1K158zXDBwWzU.jpg','Baby Money Bouquet adalah buket kreatif yang terdiri dari 10 lembar uang pecahan 5000 Rupiah yang disusun dengan cantik, cocok sebagai hadiah unik dan berkesan untuk berbagai acara spesial seperti pernikahan, ulang tahun, atau sebagai ucapan selamat . ','tersedia');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`id`,`role_name`) values 
(1,'admin'),
(2,'customer');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role` (`role`),
  CONSTRAINT `fk_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`name`,`role`) values 
(1,'admin','$2y$10$maMK3SDP/S3sseIpoyJv7e5wSGinEEmcDi79Xs741QL5SwwtGOpfS','admin',1),
(3,'dewikerten','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','ras',2),
(4,'jkaba','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','abnjka',2),
(5,'asm,n','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','as',2),
(6,'ras@gmai.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','peh',2),
(7,'ras@gmai.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','anjaknks',2),
(8,'ras@gmai.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','janjka',2),
(9,'nsb','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','nabnab',2),
(10,'ras@gmai.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','njanaj',2),
(11,'p','148de9c5a7a44d19e56cd9ae1a554bf67847afb0c58f6e12fa29ac7ddfca9940','p',2),
(12,'a','ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb','a',2),
(13,'n','1b16b1df538ba12dc3f97edbb85caa7050d46c148134290feba80f8236c83db9','n',2),
(14,'b','3e23e8160039594a33894f6564e1b1348bbd7a0088d42c4acb73eeaed59c009d','b',2),
(15,'namex','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','this NAME',2),
(16,'indira','5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','indira',2),
(17,'test','ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae','test',2),
(18,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia ',2),
(19,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia ',2),
(20,'sovia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia aulia ',2),
(21,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(22,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(23,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(24,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(25,'auliananbila','6b73dfd2e91dc7471b2137a1208de7f11a60deb59ca842f623d19a9947f28b3f','nabila',2),
(26,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(27,'soviaaulia','3bf2a20384e6925f1a7086e0a05b0fac4aa4dd580c3123b5f087ff799cf2beda','sovia',2),
(28,'auliasovia','6b73dfd2e91dc7471b2137a1208de7f11a60deb59ca842f623d19a9947f28b3f','aulia',2),
(29,'piadump','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','dumpie',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
toko_online