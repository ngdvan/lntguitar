CREATE TABLE `lnt_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) DEFAULT NULL,
  `title` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `router` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_backend` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lnt_menu_items
-- ----------------------------
INSERT INTO lnt_menu_items VALUES ('3', '1', '30', 'Khóa học', 'training/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('4', '0', '32', 'Video', 'video/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('5', '0', '32', 'Bản nhạc', 'song/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('6', '0', '34', 'Đặt hàng đàn', 'product/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('7', '0', '33', 'Tin tức', 'news/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('8', '0', '30', 'Tiêu chí và mục đích', 'page/view&id=1', null, '0');
INSERT INTO lnt_menu_items VALUES ('19', '0', '33', 'Liên hệ', 'site/contact', '', '0');
INSERT INTO lnt_menu_items VALUES ('30', '0', '0', 'Đào tạo', 'education/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('32', '0', '0', 'Thư viện Ứng dụng', 'app/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('33', '0', '0', 'Vui chơi - Giải trí', 'fun/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('34', '0', '0', 'Dịch vụ', 'service/index', '', '0');
INSERT INTO lnt_menu_items VALUES ('35', '0', '30', 'Giáo viên', 'teacher/view&id=1', null, '0');

CREATE TABLE `lnt_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `view` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  CONSTRAINT `lnt_news_term` FOREIGN KEY (`term_id`) REFERENCES `lnt_term` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lnt_news_user` FOREIGN KEY (`user_id`) REFERENCES `xf_user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lnt_news
-- ----------------------------
INSERT INTO lnt_news VALUES ('2', 'Chương trình giao lưu lnt nam -bắc', 'Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một \r\nđoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác\r\n phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, \r\nnghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường \r\nHampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những\r\n từ la-tinh khó hiểu nhất, \"consectetur\", trích từ một đoạn của Lorem \r\nIpsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ \r\nđiển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật\r\n ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của \"De Finibus \r\nBonorum et Malorum\" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi \r\nCicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết \r\nđạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem \r\nIpsum, \"Lorem ipsum dolor sit amet...\" được trích từ một câu trong đoạn \r\nthứ 1.10.32.<br>Trích đoạn chuẩn của Lorem Ipsum được sử dụng từ thế kỉ thứ 16 và được \r\ntái bản sau đó cho những người quan tâm đến nó. Đoạn 1.10.32 và 1.10.33 \r\ntrong cuốn \"De Finibus Bonorum et Malorum\" của Cicero cũng được tái bản \r\nlại theo đúng cấu trúc gốc, kèm theo phiên bản tiếng Anh được dịch bởi \r\nH. Rackham vào năm 1914.<br>', '/upload/images/2012/06/12/img_201206233700.jpg', null, null, '1', '13', '4', '1');
INSERT INTO lnt_news VALUES ('3', '[Hà Nội] Dã ngoại cùng CLB Guitar LNT', 'Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một \r\nđoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác\r\n phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, \r\nnghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường \r\nHampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những\r\n từ la-tinh khó hiểu nhất, \"consectetur\", trích từ một đoạn của Lorem \r\nIpsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ \r\nđiển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật\r\n ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của \"De Finibus \r\nBonorum et Malorum\" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi \r\nCicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết \r\nđạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem \r\nIpsum, \"Lorem ipsum dolor sit amet...\" được trích từ một câu trong đoạn \r\nthứ 1.10.32.<br>Trích đoạn chuẩn của Lorem Ipsum được sử dụng từ thế kỉ thứ 16 và được \r\ntái bản sau đó cho những người quan tâm đến nó. Đoạn 1.10.32 và 1.10.33 \r\ntrong cuốn \"De Finibus Bonorum et Malorum\" của Cicero cũng được tái bản \r\nlại theo đúng cấu trúc gốc, kèm theo phiên bản tiếng Anh được dịch bởi \r\nH. Rackham vào năm 1914.<br>', '/upload/images/2012/06/12/img_201206235203.jpg', null, null, '1', '14', '3', '1');

----- Taxonomy ---------
CREATE TABLE lnt_vocabulary (
  id int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_term (
  id int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  vid int(11) DEFAULT NULL,
  parent int(11) DEFAULT '0',
  PRIMARY KEY (id),
  KEY vid (vid),
  CONSTRAINT FK_term_vocabulary FOREIGN KEY (vid) REFERENCES lnt_vocabulary (id)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--- End taxonomy----

--  ----- Static Page --------
CREATE TABLE lnt_page(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  body TEXT NULL,
  `status` int NULL DEFAULT 1,
  user_id int(10) UNSIGNED NULL COMMENT 'ID Nguoi dang',
  create_time int(11) NULL,
  update_time int(11) NULL,
  CONSTRAINT FK_page_user FOREIGN KEY (user_id) REFERENCES xf_user(user_id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--- End static page -------

---- Teacher ---------
CREATE TABLE lnt_teacher(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	body TEXT NULL,
	picture VARCHAR(255) NULL,
	`status` int NULL DEFAULT 1,
	like_count int(11) DEFAULT 0,
	`view` int(11) DEFAULT 0
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_teacher_photo(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  teacher_id int(11) NOT NULL,
  photo VARCHAR(255) NULL,
  CONSTRAINT FK_photo_teacher FOREIGN KEY (teacher_id) REFERENCES lnt_teacher(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `lnt_like_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `like_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_like_teacher` (`teacher_id`),
  CONSTRAINT `FK_like_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `lnt_teacher` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
-- END  Teacher ----------

-- Video -------
CREATE  TABLE lnt_video(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	body TEXT NULL,
	link_youtube VARCHAR(255) NULL,
	image VARCHAR(255) NULL,
	file_path VARCHAR(255) NULL,
	tags VARCHAR(255) NULL,
	term_id int(11) NOT NULL,
	teacher_id int(11) NOT NULL COMMENT 'ID Giao vien',
	user_id int(10) UNSIGNED NULL COMMENT 'ID Nguoi dang',
	`view` int(11) NULL,
	create_time int NULL,
	update_time int NULL,
	`status` int NULL DEFAULT 1,
	CONSTRAINT FK_video_teacher FOREIGN KEY (teacher_id) REFERENCES lnt_teacher (id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT FK_video_user FOREIGN KEY (user_id) REFERENCES xf_user (user_id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT FK_video_term FOREIGN KEY (term_id) REFERENCES lnt_term (id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_video_tag (
  id int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
  frequency int(11) DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_like_video(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(10) UNSIGNED NOT NULL,
	video_id int(11) NOT NULL,
	like_time int(11) NULL,
	CONSTRAINT FK_like_video FOREIGN KEY (video_id) REFERENCES lnt_video(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_video_comment(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(10) UNSIGNED NOT NULL,
	video_id int(11) NOT NULL,
	create_time int NULL,
	contents TEXT NOT NULL,
	 `status` int NULL DEFAULT 1,
CONSTRAINT FK_comment_video FOREIGN KEY (video_id) REFERENCES lnt_video(id) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT FK_comment_video_user FOREIGN KEY (user_id) REFERENCES xf_user(user_id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;
----- End video --------------

--BEGIN Training------
CREATE TABLE lnt_center(
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	body TEXT NULL,
	province_id int(11) NULL,
	district_id int(11) NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_training(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	body TEXT NULL,
	`status` int NULL DEFAULT 1
) ENGINE=INNODB DEFAULT CHARSET utf8;

CREATE TABLE lnt_class_guitar(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	sku VARCHAR(255) NOT NULL,
	body TEXT NULL,
	`status` int DEFAULT 1,
	tid int(11) NULL,
	cid int(11) NULL COMMENT 'ID trung tam',
	`max` int(11) NULL COMMENT 'Học viên tối đa',
	start_time int(11) NULL,
	end_time int(11) NULL,
	create_time (11) NULL,
	update_time int(11) NULL,
	teacher_id int(11) NOT NULL,
	CONSTRAINT FK_class_guitar_teacher FOREIGN KEY (tid)
		REFERENCES lnt_teacher (id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT FK_class_guitar_training FOREIGN KEY (tid)
		REFERENCES lnt_training (id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT FK_class_guitar_center FOREIGN KEY (cid)
		REFERENCES lnt_center (id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET utf8;

CREATE TABLE lnt_class_calendar(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	day int(11) NOT NULL COMMENT 'NGay trong tuan',
	start_time int NOT NULL,
	end_time int NOT NULL,
	class_id int(11) NOT NULL,
	CONSTRAINT FK_calendar_class FOREIGN KEY (class_id) REFERENCES lnt_class_guitar(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET utf8;

CREATE TABLE lnt_student(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	tel VARCHAR(25) NOT NULL,
	birthday VARCHAR(100),
	create_time VARCHAR(100) NULL,
	pay_time VARCHAR(100) NULL,
	class_id int(11) NOT NULL COMMENT 'ID Lop Hoc',
	user_id int(10) UNSIGNED NULL,
	comment TEXT NULL,
	status VARCHAR(20) NULL DEFAULT 'reg-Dang ky,stu-dang hoc,comp-hoan thanh',
	CONSTRAINT FK_student_class FOREIGN KEY (class_id) REFERENCES lnt_class_guitar(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET utf8;
-- END Training ---------

---- Bản nhạc ----------
CREATE TABLE lnt_ban(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  body TEXT NULL
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_song (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  lyrics TEXT NULL,
  image VARCHAR(255) NULL,
  embed_code TEXT NULL,
  tid int(11) NOT NULL,
  `view` int(11) NULL DEFAULT 0,
  ban_id int(11) NOT NULL,
  user_id int(10) UNSIGNED NULL,
  create_time int NULL,
  tags VARCHAR(255) NULL,
  update_time int NULL,
  `status` int DEFAULT 1 COMMENT '0-hide; 1- show',
  CONSTRAINT FK_song_ban FOREIGN KEY (ban_id) REFERENCES lnt_ban(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_song_user FOREIGN KEY (user_id) REFERENCES xf_user(user_id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_song_term FOREIGN KEY (tid) REFERENCES lnt_term(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_rate_song(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id int(10) UNSIGNED NOT NULL,
  song_id int(11) NOT NULL,
  marks int(11) NOT NULL DEFAULT 1,
  CONSTRAINT FK_rate_song FOREIGN KEY (song_id) REFERENCES lnt_song (id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_like_song(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(10) UNSIGNED NOT NULL,
	song_id int(11) NOT NULL,
	like_time int(11) NULL,
	CONSTRAINT FK_like_song FOREIGN KEY (song_id) REFERENCES lnt_song(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

--- END Bản nhạc------------

----- Hop am
CREATE TABLE lnt_hopam (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  lyrics TEXT NULL,
  image VARCHAR(255) NULL,
  embed_code TEXT NULL,
  tid int(11) NOT NULL,
  `view` int(11) NULL DEFAULT 0,
  ban_id int(11) NOT NULL,
  user_id int(10) UNSIGNED NULL,
  guider VARCHAR(100) NULL,
  create_time int(11) NULL,
  tags VARCHAR(255) NULL,
  update_time int(11) NULL,
  `status` int(11) DEFAULT 1 COMMENT '0-hide; 1- show',
  CONSTRAINT FK_hopam_ban FOREIGN KEY (ban_id) REFERENCES lnt_ban(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_hopam_user FOREIGN KEY (user_id) REFERENCES xf_user(user_id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_hopam_term FOREIGN KEY (tid) REFERENCES lnt_term(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_hopam_tag (
  id int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
  frequency int(11) DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_like_hopam(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(10) UNSIGNED NOT NULL,
	hopam_id int(11) NOT NULL,
	like_time int(11) NULL,
	CONSTRAINT FK_like_hopam FOREIGN KEY (hopam_id) REFERENCES lnt_hopam(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_rate_hopam(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id int(10) UNSIGNED NOT NULL,
  hopam_id int(11) NOT NULL,
  marks int(11) NOT NULL DEFAULT 1,
  CONSTRAINT FK_rate_hopam FOREIGN KEY (hopam_id) REFERENCES lnt_hopam (id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lnt_hopam_comment(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int(10) UNSIGNED NOT NULL,
	hopam_id int(11) NOT NULL,
	contents TEXT NOT NULL,
	create_time int(11) NULL,
	 `status` int(11) NULL DEFAULT 1,
CONSTRAINT FK_comment_hopam FOREIGN KEY (hopam_id) REFERENCES lnt_hopam(id) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT FK_comment_hopam_user FOREIGN KEY (user_id) REFERENCES xf_user(user_id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

----- Ban dan

CREATE TABLE lnt_product(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  image VARCHAR(255) NULL,
  code VARCHAR(100) NULL,
  mpn_code VARCHAR(100) NULL,
  price int(11) NOT NULL,
  video VARCHAR(255) NULL,
  teach_info TEXT NULL,
  body TEXT NULL,
  cat_id int(11) NOT NULL,
  th_id int(11) NOT NULL,
  count_buy int(11) NULL DEFAULT 0,
  status int DEFAULT 1 COMMENT '0-AN,1-Hien,2-Het Hang',
  CONSTRAINT FK_product_term_1 FOREIGN KEY (cat_id) REFERENCES lnt_term (id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_product_term_2 FOREIGN KEY (th_id) REFERENCES lnt_term (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_product_image(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	product_id int(11) NOT NULL,
	file_path VARCHAR(255) NOT NULL,
	CONSTRAINT FK_image_product FOREIGN KEY (product_id) REFERENCES lnt_product(id) ON DELETE CASCADE ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE lnt_order(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  	user_id int(10) UNSIGNED NOT NULL,
  	cost VARCHAR(20) NULL,
  	paid VARCHAR(20) NULL,
  	create_time int(11),
  	paid_time int(11),
  	pid VARCHAR(255),
  	status int DEFAULT 0 COMMENT '0-CHua TT,1-Da TT,2-Dang TT'
)ENGINE=INNODB DEFAULT CHARSET=utf8;