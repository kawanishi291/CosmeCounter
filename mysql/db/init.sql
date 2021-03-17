CREATE DATABASE sample_db;
use sample_db;


CREATE TABLE `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `user_img` varchar(128) DEFAULT "0.gif",
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;


CREATE TABLE IF NOT EXISTS `pouch` (
  `user_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `genre` varchar(64) NOT NULL,
  `brand` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `item_img` varchar(128) NOT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT "0",
  `time` varchar(32) NOT NULL,
  PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;


CREATE TABLE IF NOT EXISTS `chat` (
  `user_id` int(7) NOT NULL,
  `request_id` int(7) NOT NULL,
  `chat` varchar(255) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT "0",
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;


CREATE TABLE IF NOT EXISTS `brand_list` (
  `number` int(32) NOT NULL,
  `brand` text NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

INSERT INTO `brand_list` (`number`, `brand`) VALUES
(0, '資生堂'),
(1, 'Dior'),
(2, 'CHANEL'),
(3, 'ちふれ'),
(4, 'イヴ・サンローラン'),
(5, 'CANMAKE'),
(6, 'MAYBELLINE NEW YORK'),
(7, '我的美麗日記'),
(8, 'sofina'),
(9, 'KOSE'),
(10, 'THE SAME'),
(11, 'innisfree'),
(12, 'ロート'),
(13, 'Panasonic'),
(14, '3CE'),
(15, 'BRAUN'),
(16, 'ライオン'),
(17, '花王'),
(18, 'Gillette'),
(19, 'ボシュロムジャパン'),
(20, 'MEDIHEAL'),
(21, 'Dr.Jart+'),
(22, '23years old'),
(23, 'DR.PEPTI+'),
(24, 'VT°'),
(25, 'NATURE REPUBLIC'),
(26, 'Mamonde'),
(27, 'WELLAGE'),
(28, 'LANEIGE'),
(29, 'OCEAN'),
(30, 'SUQQU'),
(31, 'DAISO'),
(32, 'CEZANNE'),
(33, 'DHC');
COMMIT;


CREATE TABLE IF NOT EXISTS `item_list` (
  `number` int(32) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `genre` int(32) NOT NULL,
  `genre_name` varchar(128) NOT NULL,
  `genre_img` varchar(64) DEFAULT "0.gif",
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

INSERT INTO `item_list` (`number`, `item_name`, `genre`, `genre_name`, `genre_img`) VALUES
(0, '化粧水・乳液', 0, 'スキンケア', 'img10.png'),
(1, 'ファンデーション', 1, '下地', 'img01.png'),
(2, 'コンシーラー', 1, '下地', 'img08.png'),
(3, 'アイブロー', 2, 'メークアップ', 'img07.png'),
(4, 'アイライナー', 2, 'メークアップ', 'img05.png'),
(5, 'アイシャドウ', 2, 'メークアップ', 'img02.png'),
(6, 'マスカラ', 2, 'メークアップ', 'img03.png'),
(7, 'チーク', 2, 'メークアップ', 'img11.png'),
(8, 'リップ', 2, 'メークアップ', 'img09.png'),
(9, 'パック', 0, 'スキンケア', 'img04.png'),
(10, '洗顔', 0, 'スキンケア', 'img06.png'),
(11, '替刃', 3, '日用品', 'img12.png'),
(12, '目薬', 3, '日用品', 'img13.png'),
(13, 'コンタクト', 3, '日用品', 'img14.png'),
(14, 'オーラルケア', 3, '日用品', '0.gif'),
(15, 'ワックス ', 3, '日用品', '0.gif');
COMMIT;