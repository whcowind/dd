-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: May 26, 2016, 05:45 AM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `my_project`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `admin_data`
-- 

CREATE TABLE `admin_data` (
  `Aid` varchar(30) NOT NULL,
  `Apassword` varchar(30) NOT NULL,
  `Aname` varchar(10) NOT NULL,
  `Amail` varchar(50) NOT NULL,
  `addTime` varchar(20) NOT NULL,
  `login` int(2) NOT NULL default '0',
  PRIMARY KEY  (`Aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `admin_data`
-- 

INSERT INTO `admin_data` VALUES ('2', '3', '1', '4', '2016042011', 0);
INSERT INTO `admin_data` VALUES ('3', '4', '2', '5', '2016042011', 0);
INSERT INTO `admin_data` VALUES ('share', 'share', '分享帳號', 'share@mail.com', '2016042017', 0);
INSERT INTO `admin_data` VALUES ('T0001', 'T0001', '測試1', 'TA@TT1', '201604210544', 0);
INSERT INTO `admin_data` VALUES ('T0002', 'T0002', '測試2', 'TA@TT2', '201604210544', 0);
INSERT INTO `admin_data` VALUES ('T0003', 'T0003', '測試3', 'TA@TT3', '201604210544', 0);
INSERT INTO `admin_data` VALUES ('T01', 'T01', '王老師', '', '201605261033', 0);
INSERT INTO `admin_data` VALUES ('T02', 'T02', '李老師', '', '201605261033', 0);
INSERT INTO `admin_data` VALUES ('T03', 'T03', '陳老師', '', '201605261033', 0);
INSERT INTO `admin_data` VALUES ('T04', 'T04', '高老師', '', '201605261033', 1);
INSERT INTO `admin_data` VALUES ('tea', 'teacher01', 'T', 'AS', '2016042011', 0);
INSERT INTO `admin_data` VALUES ('teacher01', 'teacher01', '高敏芳', 'T12@gmail.com', '2015042011', 1);
INSERT INTO `admin_data` VALUES ('teacher02', 'teacher02', '楊雙福', 'T2@gmail.com', '2015042511', 0);

-- --------------------------------------------------------

-- 
-- 資料表格式： `allocate`
-- 

CREATE TABLE `allocate` (
  `allocateID` int(30) NOT NULL,
  `paperID` int(30) NOT NULL,
  `PTitle` varchar(150) NOT NULL,
  `studentID` varchar(30) NOT NULL,
  `progressing` int(5) NOT NULL,
  `Steacher` varchar(30) NOT NULL,
  KEY `paperId` (`paperID`),
  KEY `allocateID` (`allocateID`),
  KEY `Steacher` (`Steacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `allocate`
-- 

INSERT INTO `allocate` VALUES (2, 5, 'E5', 'FC101101', 0, 'teacher01');
INSERT INTO `allocate` VALUES (2, 5, 'E5', 'FC101102', 1, 'teacher01');
INSERT INTO `allocate` VALUES (1, 8, 'Mr.王-1', 'S01', 1, 'T01');
INSERT INTO `allocate` VALUES (1, 8, 'Mr.王-1', 'S02', 1, 'T01');
INSERT INTO `allocate` VALUES (3, 9, 'Mr.李-1', 'S03', 1, 'T02');
INSERT INTO `allocate` VALUES (3, 9, 'Mr.李-1', 'S04', 1, 'T02');
INSERT INTO `allocate` VALUES (4, 10, 'Mr.陳-1', 'S05', 1, 'T03');
INSERT INTO `allocate` VALUES (4, 10, 'Mr.陳-1', 'S06', 1, 'T03');
INSERT INTO `allocate` VALUES (5, 11, 'Mr.高-1', 'S07', 1, 'T04');
INSERT INTO `allocate` VALUES (5, 11, 'Mr.高-1', 'S08', 1, 'T04');

-- --------------------------------------------------------

-- 
-- 資料表格式： `choicequestionbase`
-- 

CREATE TABLE `choicequestionbase` (
  `ChId` int(10) NOT NULL,
  `ChDetail` varchar(1000) NOT NULL,
  `ChAns1Content` varchar(150) NOT NULL,
  `ChAns1Score` varchar(5) NOT NULL,
  `ChAns2Content` varchar(150) NOT NULL,
  `ChAns2Score` varchar(5) NOT NULL,
  `ChAns3Content` varchar(150) NOT NULL,
  `ChAns3Score` varchar(5) NOT NULL,
  `ChAns4Content` varchar(150) NOT NULL,
  `ChAns4Score` varchar(5) NOT NULL,
  `QType` varchar(50) NOT NULL,
  `owner` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `choicequestionbase`
-- 

INSERT INTO `choicequestionbase` VALUES (1, '測驗用選擇題', '答案一', '2', '答案二', '0', '答案三', '0', '答案四', '0', 'ChoiceQuestion', 'teacher01');
INSERT INTO `choicequestionbase` VALUES (3, '底下圖形的面積和周長各為多少？', '(A)面積81平方公分，周長18公分 ', '0', '(B)面積18平方公分，周長81公分 ', '0', '(C)面積81平方公分，周長36公分 ', '2', '(D)面積18平方公分，周長27公分', '0', 'ChoiceQuestion', 'teacher02');
INSERT INTO `choicequestionbase` VALUES (2, '測試用選擇題2', 'A', '2', 'B', '0', 'V', '0', 'D', '0', 'ChoiceQuestion', 'teacher02');
INSERT INTO `choicequestionbase` VALUES (4, 'for test - 0', '1 - 0', '1', '2 - 0', '2', '3 - 0', '3', '4 - 0', '4', 'ChoiceQuestion', 'teacher01');
INSERT INTO `choicequestionbase` VALUES (5, '222', '222', '2', '222', '3', '222', '1', '2222', '0', 'ChoiceQuestion', 'teacher01');

-- --------------------------------------------------------

-- 
-- 資料表格式： `general_manager`
-- 

CREATE TABLE `general_manager` (
  `ID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `general_manager`
-- 

INSERT INTO `general_manager` VALUES ('admin', 'admin123456789');

-- --------------------------------------------------------

-- 
-- 資料表格式： `gpsa_store`
-- 

CREATE TABLE `gpsa_store` (
  `GPSID` int(30) NOT NULL,
  `GPSAAns` varchar(1800) NOT NULL,
  `SID` varchar(20) NOT NULL,
  `PID` int(30) NOT NULL,
  `AID` int(30) NOT NULL,
  `GID` int(30) NOT NULL,
  `grade` varchar(30) NOT NULL default 'N',
  `mark` varchar(5) NOT NULL default '0',
  `Steacher` varchar(30) NOT NULL,
  KEY `AID` (`AID`),
  KEY `GPSID` (`GPSID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `gpsa_store`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `grade_detail`
-- 

CREATE TABLE `grade_detail` (
  `studentID` varchar(20) NOT NULL,
  `paperID` int(30) NOT NULL,
  `gradeID` int(30) NOT NULL,
  `QID` int(30) NOT NULL,
  `Qgrade` varchar(30) NOT NULL,
  `item` varchar(1800) NOT NULL,
  `QType` varchar(30) NOT NULL,
  KEY `gradeID` (`gradeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `grade_detail`
-- 

INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 5, '0', '', 'TF');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 5, '2', '1', 'CH');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 1, '2', '3', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 2, '1', '3', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 3, '0', '3', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 4, '2', '2', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 5, '2', '4', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 51, '2', '2', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 52, '4', '2', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 53, '2', '', 'GPSA');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 54, '2', '3', 'GP');
INSERT INTO `grade_detail` VALUES ('FC101101', 5, 2, 1, '4', '', 'SA');

-- --------------------------------------------------------

-- 
-- 資料表格式： `groupqtable`
-- 

CREATE TABLE `groupqtable` (
  `GroupID` int(30) NOT NULL,
  `GroupQ1ID` int(30) NOT NULL,
  `GroupQ2ID` int(30) NOT NULL,
  `GroupQ3ID` int(30) NOT NULL,
  `GroupQ4ID` int(30) NOT NULL,
  `GroupQ5ID` int(30) NOT NULL,
  `GroupQ6ID` int(30) NOT NULL,
  `GroupQ7ID` int(30) NOT NULL,
  `GroupQ8ID` int(30) NOT NULL,
  `GroupQ9ID` int(30) NOT NULL,
  `GroupQ10ID` int(30) NOT NULL,
  KEY `GroupID` (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `groupqtable`
-- 

INSERT INTO `groupqtable` VALUES (1, 1, 2, 3, 4, 5, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (2, 11, 12, 13, 14, 15, 16, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (3, 21, 22, 23, 24, 25, 26, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (4, 31, 0, 33, 34, 35, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (5, 41, 0, 43, 44, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (6, 51, 0, 53, 54, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (7, 61, 62, 63, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (8, 71, 72, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (9, 81, 82, 83, 84, 85, 86, 87, 88, 0, 0);
INSERT INTO `groupqtable` VALUES (10, 91, 92, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (11, 101, 102, 103, 104, 105, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (12, 111, 112, 113, 114, 115, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (13, 121, 122, 123, 124, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (14, 131, 132, 133, 134, 135, 136, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (15, 141, 142, 143, 144, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (16, 151, 152, 153, 154, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (17, 161, 162, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (18, 171, 172, 173, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (19, 181, 182, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (20, 191, 192, 193, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (21, 201, 202, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (22, 211, 212, 213, 214, 215, 216, 217, 218, 219, 0);
INSERT INTO `groupqtable` VALUES (23, 221, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (24, 231, 232, 233, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (25, 241, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (26, 251, 252, 253, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (27, 261, 262, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (28, 271, 272, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (29, 281, 282, 283, 284, 285, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (30, 291, 292, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (31, 301, 302, 303, 304, 305, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (32, 311, 312, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (33, 321, 322, 323, 324, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (34, 331, 332, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (35, 341, 342, 343, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `groupqtable` VALUES (36, 351, 352, 353, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 資料表格式： `groupquestionbase`
-- 

CREATE TABLE `groupquestionbase` (
  `GroupID` int(30) NOT NULL,
  `GroupTitle` varchar(4500) NOT NULL,
  `Qtype` varchar(20) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY  (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `groupquestionbase`
-- 

INSERT INTO `groupquestionbase` VALUES (1, '桃桃縣新新鄉亞洲保齡球館日前發生了一場大火，造成六名年輕消防員慘遭無情的祝融吞噬殉職。初步了解，這棟建築的一樓是亞洲游泳池，二樓為新新保齡球館，起火點疑在二樓的新新保齡球館，該處為鐵皮鋼架建築，疑是違建。消防隊員第一波進入搶救時，2樓變電箱爆燃，接著可能因高溫造成鐵皮熔塌，屋外的消防員大喊趕快撤退，但6名勇消來不及逃出。\n根據火災事故經驗，火場裡的「閃燃」和「爆燃」現象，經常成為可怕消防殺手。其中「閃燃」，一般是在起火密閉空間，大量的火煙燃燒，溫度飆升到500度，會引燃現場可燃物，變成火海；而「爆燃」是指在通風不良的密閉空間，氧氣量低於燃燒範圍，在空氣突然引入後，引發爆炸。根據初步研判，此次火災原因可能是因為烈火發生閃燃現象，而導致樓層崩塌所致。\n', 'Group', 'teacher01');
INSERT INTO `groupquestionbase` VALUES (2, '民國88年9月21日凌晨，在台灣中部地區發生的強烈地震，當時全台灣均感覺到天搖地動，共持續102秒，造成兩千多人死亡，十多萬間的房屋倒塌或毀損。許多道路、橋樑、堤防以及電力設備都被震毀。這次的地震稱作921大地震，又稱集集大地震，是台灣人難以抹滅的傷痛。\n地震很可怕，但這是一種無法避免的自然現象，但為什麼會發生地震呢？當板塊發生碰撞時會產生強大的力量，擠壓土壤底下的岩層，當岩層再也無法支撐時，就會斷裂，形成斷層，同時引發地震。最先斷裂的地方就是「震源」，從震源向上垂直延伸到地面的點，則稱為「震央」。\n所謂「地震規模」，是表示這次地震所釋放出來的能量大小，每一個地震只有一個規模值。而目前世界上所通用的地震規模，為美國地震學家芮氏(C. F. Richter)於1935年所創立之芮氏規模。\n科學家把我們感到地表震動的強弱區分成不同等級，就是「震度」。一般來說，距離震央越近的地方，感受到的震度也越強烈。但各地實際感受到的震度除了距離遠近，也與當地的地形和地質有關。\n', 'Group', 'teacher02');
INSERT INTO `groupquestionbase` VALUES (3, '八八風災是台灣50年以來最嚴重的水患，發生於2009年8月6日至8月10日間。因為莫拉克颱風侵襲台灣所帶來創紀錄的雨勢，造成台灣多處淹水、山崩與土石流。其中以位於高雄縣甲仙鄉小林村小林部落滅村事件最為嚴重，造成474人活埋。據政府統計，此次水災共造成681人死亡、18人失蹤。\n每年台灣地區都會受到颱風的侵襲。颱風來襲時總會帶來大量雨水以及強風，常常造成居民們生命財產的損失。到底颱風是什麼東西呢？\n在熱帶地區的海洋，海水容易蒸發形成溫暖、潮濕的空氣。這些溫暖、潮濕的空氣會不斷上升。到高空中遇到冷空氣就會凝結成大量積雨雲，最後因為地球自轉的關係而旋轉，成為漩渦狀的雲系就是「熱帶氣旋」，熱帶氣旋吸收熱量及雨水，逐漸增強。而颱風就是強烈的熱帶氣旋。因為發生的位置不同，不同地方生成的熱帶氣旋名稱也不一樣。發生在大西洋和東太平洋稱為颶風；在西北太平洋、東海和南海稱為颱風；在印度洋和西南太平洋則稱為氣旋。因此，台灣的颱風和美國的颶風都是指同樣的天氣現象。\n', 'Group', 'teacher02');
INSERT INTO `groupquestionbase` VALUES (4, 'teste', 'Group', 'teacher01');
INSERT INTO `groupquestionbase` VALUES (5, '111', 'Group', 'teacher01');
INSERT INTO `groupquestionbase` VALUES (6, 'new test', 'Group', 'teacher01');
INSERT INTO `groupquestionbase` VALUES (7, '管理', 'Group', 'teacher01');
INSERT INTO `groupquestionbase` VALUES (8, '                            蟑螂\n蟑螂的卵孵化，大約需要15天的時間。剛孵化出來的蟑螂是乳白色的若蟲，沒有翅膀。像其它種類的昆蟲一樣，隨著它慢慢長大必須蛻皮，經過3~4次蛻皮之後就可以看到翅芽。德國蟑螂需要6~7次蛻皮才能進入成蟲期，而美洲蟑螂則需要10~12次。\n住在房屋裡的蟑螂，喜歡澱粉性的食物，在它們爬過的食物上，往往會把所攜帶的病原生物留下而傳播疾病。蟑螂進食時有個壞習慣：邊吃、邊吐、邊排泄，因此污染食物，傳播多種疾病，如痢疾、副霍亂、肝炎、白喉、猩紅熱、蛔蟲病等。蟑螂還分泌和排泄出有異臭的物質，使人聞到後感覺噁心甚至嘔吐。\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (9, '                            淨灘\n週六，小明一家人參加淨灘活動，撿拾沙灘垃圾。\n父親：你知道我們為什麼要參加淨灘活動？\n小明：垃圾是人類製造、人類丟的，人類應該要負責。\n母親：而且，沙灘垃圾不只影響我們生活環境的品質，進入海裡更危害海洋生物的健康。\n小明：撿拾完的垃圾為什麼還要進行分類統計與秤重？\n父親：淨灘不只是為了清理沙灘垃圾。將大家蒐集到的數據統計、公布，可以用來教育民眾、和政府及企業合作，漸漸改變大家的行為和習慣，就可以真正減少沙灘垃圾。\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (10, '兩個水槽，分別置入水泥與泥土，再倒入等量的水，如圖一。\n一段時間後，發現兩者的水位如圖二。', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (11, '                        誰是大贏家\n每年一度的陸海空百米賽跑，終於又開賽了！\n    今年代表陸上動物的選手是獵豹，代表水中動物的選手是旗魚，代表鳥類的選手是鴕鳥，雖然飛不起來，但也跑的相當快喔！預備…砰！加油~加油~加油！快報…百米賽跑冠軍是…..，沒關係，明年我們鳥類一定會贏回來的。\n    第二年~今年陸地跟水中動物的代表，是去年的第一名與第二名，獵豹與旗魚，咦~今年鳥類是不是放棄了啊！今年代表鳥類的選手是…游隼，哇！預備…砰！加油~游隼，加油~游隼，加油~游隼！果然不負眾望，贏得了!\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (12, '                       柳丁無人島求生記\n在森林深處，一直有眼睛盯著柳丁看，柳丁仔細觀察其特徵，如果柳丁用「會不會游泳」來將這些動物做分類，分在「會游泳」那組的動物有\nA 有六隻腳，身上有兩對透明的翅膀\nB 有兩隻腳，身上有羽毛、翅膀，腳趾間有蹼\nC有四隻腳，後腳腳趾間有蹼，後腳比前腳粗壯\nD 沒有腳，身上有鰭的\nE 有四隻腳，前後腳的長短、粗細大致相同的\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (13, '                     渡渡鳥與卡伐利亞樹\n珍貴稀有的卡伐利亞樹的種子都無法發芽長出新的植物令生物學家傷透腦筋，研究了好多年都找不到答案。\n渡渡鳥和卡伐利亞樹都生長在模里西斯島。已經絕種300年的渡渡鳥曾經生活在卡伐利亞樹林裡，渡渡鳥待過的地方，卡伐利亞樹總能生長成林。當生物學家發現卡伐利亞樹齡也是300年，這樣的巧合讓生物學家想到，也許渡渡鳥絕種之日，便是卡伐利亞樹絕育之日。\n物種的消失可能影響其他物種的生存，對人類難道沒有影響？人們不斷在動植物身上發現農業、醫學、醫療、科技發展等用途，但是許多人類已知或未知的物種正像渡渡鳥一樣陸續滅絕了，其中會不會有某些物種對人類有著重大的影響，還來不及被發現？\n\n渡渡鳥因為人類任意捕殺等因素而絕種了。生物學家在模里西斯發現了大量不同年齡的渡渡鳥的骨骼，並將這些骨骼展示在自然歷史博物館。\n人類不斷在動植物上發現治病、手術醫療或其他用途的物質，會不會在我們還沒發現某些動植物對人類的重要，牠們就絕種了？\n\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (14, '                         保溫保冷效力\n以下是「大象牌不銹鋼保溫杯」容量、重量、保溫/保冷效力的產品標示：\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (15, '                         科學原理\n    有一天媽媽在庭院的草地上縫衣服，一不小心針掉了。\n', 'Group', 'T01');
INSERT INTO `groupquestionbase` VALUES (16, '                          皮影戲\n皮影戲，又稱影子戲或燈影戲，是一種民間藝術，顧名思義其演出是利用燈光把獸皮或紙板做成的人物剪影照射在白色的布幕上，以表演故事的戲劇，是世界許多國家皆有的一種戲劇形式。\n\n文章出處：https://zh.wikipedia.org/wiki/皮影戲\n\n小梅子在一次偶然的情況下看到皮影戲的表演，她心中產生了一些疑惑，她原先認為影子一定是黑色的，為什麼皮影可以有許多的顏色呢？\n', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (17, '                           颱風季\n下表是民國101年至103年臺灣有發布警報之颱風數量統計，請回答問題：\n', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (18, '                          跳繩\n教育部的體適能檢測發現，宜蘭縣小一學童的身高、體重都排名全台倒數第二，國小生的平均身高低於全國一公分，為了解決這個問題，陽明大學副教授劉影梅針對宜蘭縣四鄉鎮逾千位小四學童進行研究，發現每天跳繩30分鐘，連續跳20週好像對宜蘭縣小一學童長高有幫助。', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (19, '                          海洋生物\n', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (20, '                         颱風、土石流\n養護工程處是負責各地道路附屬設施（即人行道、側溝、擋土牆及路燈等）養護管理、公路縣鄉道災害緊急搶修復建事宜、協助各區公所辦理市區道路附屬設施養護整建及市區道路天然災害緊急搶修復建事宜。', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (21, '                          基因改造\n以植物而言，為了提高農作物生產量與增加作物對天然災害抵抗能力，將植物體內帶有遺傳物質基因的「DNA」進行修改，或與另一段不同生物的DNA 互相接合，重組DNA，藉以改變原物種的遺傳特性，並能大量繁殖的生物技術，稱為「重組DNA 技術」，或基因改造工程，經基改後的食物，為「基改食物」，如將抗蟲基因植入大豆作物中增加對廣效性除草劑耐受度，便可讓農人摒棄毒性更強的農藥，降低施用農藥的頻率，增加作物產量。', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (22, '                            銀膠菊\n小中與家人到郊外郊遊時，在野外看見一大片的滿天星，感覺非常漂亮，正想要摘一把回家觀賞時，突然被爸爸制止。爸爸告訴小中：這些看似滿天星的植物可能有毒，不可以隨便亂摘。\n回家後，小中查詢一些資料，發現那些看起來像滿天星的植物是學名稱為「銀膠菊」的有毒植物，正慶幸當時有聽爸爸的話，沒有隨意觸碰它，不然後果無法設想。以下是小中找到的資料：\n銀膠菊原產於中南美洲與西印度群島，對環境的適應力強，影響本土植物生長的多元性，且全株有毒，大量多次接觸銀膠菊植株、花粉及殘體碎片，可能引發皮膚炎或過敏反應，吸入過多可能引起肝臟疾病。因此除了危害人體健康外，對於生態也有影響，被列為「世界一百種外來惡性入侵生物」之一。\n\n\n小中在「中華民國第51屆中小學科學展覽會國小生物組校園國際外來毒草—銀膠菊的知與除」的說明書中看到其中一段銀膠菊及蟑螂的實驗，覺得很有趣，以下是說明書內容。\n實驗主題：銀膠菊的不同部位對蟑螂的毒害是否不同？ \n實驗目的：文獻上說銀膠菊的花粉、絨毛是毒害人體的主要部位。我們想了解銀膠菊 的不同部位（花含花粉、莖葉含絨毛、根不含花粉絨毛）對蟑螂的毒害是否不同。 實驗方法：三個透明廣口瓶分別裝銀膠菊的根（無花粉絨毛）、莖葉（有絨毛）、花（有 花粉），並各裝 5 隻蟑螂及食物牛奶糖，每天觀察記錄死亡及存活隻數並拍照。\n\n實驗結果：(表一)\n\n紅圈是死掉的蟑螂。藍圈是活著的蟑螂。', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (23, '                         越過高山的風\n當通過海面、充滿水氣的風，吹向高山，在甲處降雨，水氣變少的風繼續越過高山，吹向乙處。\n', 'Group', 'T02');
INSERT INTO `groupquestionbase` VALUES (24, '                            地震\n芮氏規模是以地震儀記錄查得地震波之時間差距及震幅大小為基礎來計算地震之規模。地震規模越大，其所釋放的能量就越高。芮氏規模7.0～7.9之地震為相當大的地震，如震央在陸地上會造成大災害；如在海底會引起大海嘯，全世界約每年發生二十次。震度是指地震時人們對於地面震動的感受程度，或物品因震動遭受破壞的程度。以下(圖一)是921大地震的地震報告。\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (25, '                           變色冰\n你吃過會變色的冰嗎？在堆成小山狀的細細碎冰上淋上蔬果汁A，冰立刻變成藍色，接著淋上檸檬汁，攪拌後，藍色碎冰就變成桃紅色。\n蔬果汁A如果再加入食用級小蘇打粉，經過攪拌後，顏色則會變成綠色。\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (26, '                             汽水\n喝上一口冰冰涼涼的汽水，清涼暢快的口感讓人精神一振！打開汽水瓶的瓶蓋，汽水中立即冒出大量的氣泡，有時甚至會像噴泉一樣溢出瓶口！這些氣泡裡面充滿了二氧化碳，這就是汽水會產生氣泡的原因。\n當你把汽水喝下肚，二氧化碳還會跟著進入腸胃，由於腸胃的溫度比較高，所以汽水會在腸胃中冒出更多的二氧化碳氣泡，最後因為腸胃容納不下這麼多的氣體，一部分二氧化碳就從嘴巴排出體外，順便帶走部分體內的熱量，所以喝完汽水後，你可能會頻頻打嗝，而解感到清涼又解熱！\n汽水其實只是一瓶二氧化碳的水溶液（另外有糖和香料，咖啡因)，把大约2～3大氣壓的二氧化碳密封在糖水裡，就會有部份的二氧化碳氣体溶解在水中，二氧化碳在水中就形成碳酸，汽水给人的那種刺激味道就是因為碳酸的缘故。\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (27, '                           共生\n海葵藉著小丑魚的協助，移除身上的寄生物、壞死的組織，與其周圍有機與無機的廢物，而這些物質常是海葵重要的食物來源；小丑魚則藉著海葵的保護，使它免於受到許多捕食者的攻擊。其實共生又可依照以下幾種形式的關係分為：\n(1)寄生：一種生物寄附於另一種生物身體內部或表面，利用被寄附生物的養分生存\n(2)互利共生：共生的生物體成員彼此都得到好處。\n(3)競爭共生（競爭）：雙方都受損。 \n(4)片利共生：對其中一方生物體有益，卻對另一方沒有影響。 \n(5)偏害共生：對其中一方生物體有害，對其他共生線的成員則沒有影響。 \n(6)無關共生：雙方都無益無損。\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (28, '                           熱氣球\n    每年在台東縣鹿野鄉舉辦的熱氣球嘉年華會，總吸引許多人潮，在清晨或傍晚搭乘熱氣球緩緩升到空中，欣賞四周美景，真是非常難得的體驗。但是為什熱氣球在清晨或傍晚才能升空呢？\n    熱氣球升空的原理是在結實且不透氣的氣囊內灌入空氣後，再利用大型的燃燒器加熱空氣，熱空氣上升，促使熱氣球飄上天空。因此只要調節燃燒器的火力，控制氣囊中的空氣溫度，就能讓熱氣球上升或下降。\n    熱氣球本身沒有控制方向的裝置，因此受風向的影響很大，清晨或傍晚的氣流比較平穩，氣溫也比較低，除了熱氣球比較好控制，也較能確保熱氣球的氣囊不會因為加熱器和陽光的雙重熱度而破裂或熔化，這就是熱氣球大多選擇在清晨或傍晚升空的主要原因。\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (29, '                      外來種生物的危害\n長久以來，台灣特有種生物為了適應島上環境，演化出獨特樣貌，成為台灣繽紛而特殊生態的最佳代言人；晚近數十年間，另一群外來種生物憑藉強悍的生命力據地稱王，成為原生物種的惡夢。當這些外來種生物，失去原有的價值，例如人們不愛食用、觀賞價值降低等，就可能被人們以「放生」為由，棄置於水域中或被棄置於郊外，一旦適應台灣的環境，再加上環境中沒有天敵，便容易大量繁殖，對原生種生物和生態環境造成危害。\n公園的布袋蓮，養在水塘作為教學用，但野外的布袋蓮因鮮少管理，而致蔓衍堵塞水道。當「數大」帶來不便，則成一種夢魘。又來自異國的銀合歡，強勢排擠本土植物，打亂本地的生態系與生物多樣性平衡，以龐大數量種子、排放有毒物質，砍伐後又萌芽的旺盛生命力，形成一處處純林棲地，建立銀合歡王國。\n\n', 'Group', 'T03');
INSERT INTO `groupquestionbase` VALUES (30, '                     血液為什麼會紅紅的？\n    一不小心受傷時，會流出紅紅的血液，但小朋友知道嗎？血液其實是由血漿及血球組成的。正常的血漿是淡淡的黃色液體﹔而血球包括紅血球、白血球和血小板。\n    其中紅血球的數量最多，長得像扁扁、中間凹陷的紅盤子，含有許多紅色的血紅素蛋白質，主要功能是攜帶氧氣，也會讓血液看起來紅紅的。當紅血球太少，血液攜帶氧氣的能力會受影響，容易覺得頭暈、疲勞。白血球則像圓滾滾的球，負責抵抗病原體，是守護我們身體的戰士。而體積最小的血小板，最重要的任務是止血﹗\n    血液有時是鮮紅色，有時是暗紅色，為什麼會有顏色上的差異呢？主要是跟血液裡的氧氣量有關。動脈裡流動的血液含氧量高，是鮮紅色的﹔靜脈裡的血液含氧量低，則呈暗紅色。\n    每個人有多少血液呢？每1公斤的體重大約有80c.c.的血液，如果受傷超過體重十分之一以上的血液，就是嚴重出血，可能會有生命危險。除了事故傷害引起的失血，貧血也要特別注意，貧血指的是血液裡的血紅素不足。紅血球是由骨髓製造的，製造紅血球時，需要使用鐵質當材料，日常飲食中有許多含鐵量較高的食物。\n', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (31, '               火環帶運作活躍，太平洋兩岸不平靜\n    環太平洋火山帶又稱「環太平洋地震帶」或「火環帶」，是一連串沿著太平洋海盆周圍分布的火山與斷層帶。這裡的板塊移動劇烈，釋放的地震能量占全球總能量的百分之八十。近來，除了亞洲地區有頻繁的地震與火山爆發外，太平洋另一端的南美洲也不平靜。\n    智利的卡爾布科火山在沉寂將近五十年後，今年四月噴出大量火山灰與岩漿，火山灰雲更高達十七公里。除了附近六千五百名居民被迫撤離外，約兩億公噸的火山灰覆蓋附近城鎮，重創當地的鮭魚業﹔各國被迫取消航班，影響南美洲的空中交通。\n    位在台北市的大屯山也是一座火山，但地質學者表示，大屯山未來噴發的機率不高，規模也不會太大。\n', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (32, '                          彩虹\n白色的太陽光其實包含有不同顏色的光線，粗略地可分為七種顏色，分別是紅、橙、黃、綠、藍、靛、紫。在正常情況下，我們只會看見太陽光是白色的。但是在雨後放晴的時候，天空中仍殘留著一些小水珠，白色的陽光被小水珠折射和反射。由於不同顏色的光有不同的折射率，它們在水珠中被反射到稍為不同的方向。如果我們在特定的仰角去觀察天空，會看見不同的水珠反射出不同顏色的光，形成彩虹 。\n彩虹的寬度及色彩深淺和空氣中的水滴大小有關。水滴越大，彩虹寬度越窄 ，但色彩比較鮮明；水滴越小，彩虹寬度越寬但色彩比較黯淡。此外，如果太陽在天空中的位置太高或太低，因為陽光射入水滴的角度關係，比較不易形成彩虹。\n  彩虹是陽光經由水滴的折射和反射而進入觀察者的眼睛，所以它永遠會出現在太陽的相反方向，早上出現的彩虹會在西方，下午出現的彩虹則會在東方。\n', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (33, '                          綠建築\n    曾被美國網站評選為「全球最美25座公立圖書館」之一的台北市立圖書館北投分館，今年再被國外網站「WHEN ON EARTH」列為世界最酷10大綠建築；其中，屋頂是網站推薦的一項特色，該木造建物屋頂太陽能發電可發電16千瓦電力，為全館總用電量10%，並採大量陽台深遮陽及垂直木格柵，降低熱輻射進入室內，降低耗能達到節能效果，符合內政部綠建築九項指標及生態、節能、減廢及健康等4面向。\n    綠化屋頂及斜坡草坡設計，可涵養水分自然排水至雨水回收槽，再利用回收水澆灌植栽及沖水馬桶，達到綠化與減少水資源浪費；建物使用木材及鋼材，皆可回收再利用，減少廢棄物對環境的破壞。在室內健康與環境指標方面，對於木材建材除做白蟻防治外，並使用生態塗料及免除不必要的裝修工程，減少汙染及有毒物質的釋放，避免影響人體健康。\n', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (34, '                         蒸發與結晶\n食鹽水，是指食鹽溶在水中所形成的溶液。我們可以利用水溫降低或水份減少來讓食鹽產生結晶。水由液態轉變成氣態，逸入大氣中的過程稱為蒸發，且在任何溫度下都可以蒸發。溫度越高，蒸發越快。溶劑蒸發的速率愈快，它的結晶顆粒就愈小。\n', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (35, '                           海洋垃圾\n2014年十大海洋廢棄物中，塑膠產品所占比例高達88.8%。下表是塑膠垃圾的分解環境與效果，發現塑膠垃圾只要進入海洋，分解速度都很緩慢。\n\n據調查顯示，在四面環海的中途島死亡的信天翁幼鳥，多因吃到塑膠垃圾致死，吞下的塑料製品導致它們無法吃下別的食物，有時塑料碎片甚至會割破它們的食管。且從幼鳥屍體發現，只要20公克的海洋垃圾就會致命。', 'Group', 'T04');
INSERT INTO `groupquestionbase` VALUES (36, '                        0pen，醬瓜蓋!\n    在日常生活中，我們常會利用熱脹冷縮的原理來輕鬆解決生活難題。例如:開醬瓜蓋、預防輪胎爆胎、製作酒精溫度計等。\n', 'Group', 'T04');

-- --------------------------------------------------------

-- 
-- 資料表格式： `groupsubquestionbase`
-- 

CREATE TABLE `groupsubquestionbase` (
  `GroupQID` int(30) NOT NULL,
  `GroupID` int(30) NOT NULL,
  `sort` int(10) NOT NULL,
  `GroupQContent` varchar(4500) NOT NULL,
  `GroupA1Content` varchar(350) NOT NULL,
  `GroupA1Score` varchar(10) NOT NULL,
  `GroupA2Content` varchar(350) NOT NULL,
  `GroupA2Score` varchar(10) NOT NULL,
  `GroupA3Content` varchar(350) NOT NULL,
  `GroupA3Score` varchar(10) NOT NULL,
  `GroupA4Content` varchar(350) NOT NULL,
  `GroupA4Score` varchar(10) NOT NULL,
  KEY `GroupQID` (`GroupQID`),
  KEY `GroupID` (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `groupsubquestionbase`
-- 

INSERT INTO `groupsubquestionbase` VALUES (1, 1, 0, '問題1：從文章中，我們判斷燃燒的條件不包括', 'A 有可燃物', '0', 'B 氧氣', '0', ' C 達到沸點', '2', 'D 達到燃點', '0');
INSERT INTO `groupsubquestionbase` VALUES (2, 1, 0, '問題2：根據文中描述，桃園新屋的火災是屬於哪一種燃燒現象？證據是什麼？', 'A 閃燃，因為高溫造成鐵皮熔塌。', '1', 'B 閃燃，因為溫度飆升到500度，樓層塌陷現場變成火海。', '2', 'C 爆燃，因為2樓變電箱爆。 ', '1', 'D 爆燃，因為空氣突然引入後，引發爆炸。', '0');
INSERT INTO `groupsubquestionbase` VALUES (3, 1, 0, '問題3：由圖1，我們比較103年與102年間火災發生次數可以知道？', 'A  103年火災發生次數最多的月份是7月。 ', '0', 'B  102年火災發生次數最少的月份是6月。  ', '0', 'C  103年大都數的月份，火災發生次數比102年少。', '0', 'D  103年與102年比較，火災次數減少的是2、3、8、9、11月。', '2');
INSERT INTO `groupsubquestionbase` VALUES (4, 1, 0, '問題4： 從表一比較兩年間火災發生的原因中，占最大比例的是？', 'A 人為縱火', '0', 'B 電器設備 ', '2', 'C 燭火', '0', 'D 其他原因', '0');
INSERT INTO `groupsubquestionbase` VALUES (5, 1, 0, '問題5：如果你是一位消防人員，根據表一的資料顯示，你會將下次的防火宣導著重於哪一方面？', 'A 瓦斯漏氣爆炸 ', '1', 'B 人為縱火 ', '1', 'C 不明原因 ', '0', 'D 電器設備', '2');
INSERT INTO `groupsubquestionbase` VALUES (11, 2, 0, '1.本文主要在說明什麼？', '①地震發生的原因和分級標準 ', '2', '②地震的分級以及分級的標準 ', '0', '③921大地震的形成原因和損失 ', '0', '④介紹板塊是什麼以及它的種類', '0');
INSERT INTO `groupsubquestionbase` VALUES (12, 2, 0, '2.小明在發生地震當時，看見隔壁大樓招牌掉落、自己無法穩當走路，幸好家中門窗仍保持完整，在地震結束後可以及時逃生。請問小明所在地的震度為何？', '①微震　', '0', '②弱震　', '0', '③強震　', '2', '④劇震', '0');
INSERT INTO `groupsubquestionbase` VALUES (13, 2, 0, '3.震度的分級是依據什麼 ？', '①板塊碰撞時的力量  ', '0', '②地震所釋放出的能量 ', '0', '③地震持續時間的長短 ', '0', '④我們感受到震動的強弱 ', '2');
INSERT INTO `groupsubquestionbase` VALUES (14, 2, 0, '4.根據文章內容，請回答右圖的A、B分別是什麼？', '①A是震源B是震度 ', '2', '②A是震源B是震央    ', '0', '③A是震度B是震央    ', '0', '④A是震央B是震源', '0');
INSERT INTO `groupsubquestionbase` VALUES (15, 2, 0, '5.根據上文，請推測地震比較容易發生在什麼地方？', '①A　', '0', '②B　', '2', '③C　', '0', '④D', '0');
INSERT INTO `groupsubquestionbase` VALUES (16, 2, 0, '6.一場地震造成甲地的吊燈、吊扇搖晃；乙地的房屋倒塌、毀損；丙地建築物的牆壁產生裂痕，請問哪個地方的地震規模最大？', '①甲　', '0', '②乙　', '0', '③丙　', '0', '④一樣大', '2');
INSERT INTO `groupsubquestionbase` VALUES (21, 3, 0, '1.莫拉克颱風最高風速為每小時167公里，是屬於哪一級的颱風？', '①熱帶性低氣壓    ', '0', '②輕度颱風 ', '0', '③中度颱風', '2', '④強度颱風', '0');
INSERT INTO `groupsubquestionbase` VALUES (22, 3, 0, '2.承上題，若莫拉克是生成在大西洋的颶風，則它是屬於哪一級颶風？', '①一　', '0', '②二　', '2', '③三　', '0', '④四', '0');
INSERT INTO `groupsubquestionbase` VALUES (23, 3, 0, '3.右圖是海洋表面溫度圖，根據文章中的敘述，颱風最容易在圖中的哪個地方生成 ？', '①A　', '0', '②B', '0', '③C　', '2', '④D', '0');
INSERT INTO `groupsubquestionbase` VALUES (24, 3, 0, '本文主要是在說明什麼 ？', '①莫拉克颱風所造的災害和損失 ', '0', '②颱風和颶風生成的原因和分級 ', '2', '③颱風和颶風的名稱會因為地方而異 ', '0', '④颱風和颶風是相同的天氣型態', '0');
INSERT INTO `groupsubquestionbase` VALUES (25, 3, 0, '5.下列有關颱風和颶風的敘述何者是正確的？', '①颱風或颶風只會在夏天形成', '0', ' ②所有的氣旋都會變成颱風或颶風', '0', ' ③颶風的威力比颱風強 ', '0', '④颱風和颶風形成的原因相同', '2');
INSERT INTO `groupsubquestionbase` VALUES (26, 3, 0, '6.颱風在什麼地方它的強度可能會增強？', '①海洋上空　', '2', '②陸地上空　', '0', '③海平面以下　', '0', '④海陸交界處', '0');
INSERT INTO `groupsubquestionbase` VALUES (31, 4, 0, '1', '1', '0', '1', '0', '1', '0', '1', '0');
INSERT INTO `groupsubquestionbase` VALUES (33, 4, 2, '3', '3', '3', '3', '3', '3', '3', '3', '3');
INSERT INTO `groupsubquestionbase` VALUES (34, 4, 0, '4', '4', '4', '4', '4', '4', '4', '4', '4');
INSERT INTO `groupsubquestionbase` VALUES (35, 4, 1, '5', '5', '0', '5', '0', '5', '0', '5', '0');
INSERT INTO `groupsubquestionbase` VALUES (41, 5, 0, '1', '1', '0', '1', '0', '1', '0', '1', '0');
INSERT INTO `groupsubquestionbase` VALUES (43, 5, 2, '55', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (44, 5, 0, '2', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (51, 6, 0, 'yyy', 'y1', '1', 'y2', '2', 'y3', '3', 'y4', '4');
INSERT INTO `groupsubquestionbase` VALUES (52, 6, 1, 'www', 'w1', '3', 'w2', '4', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (53, 6, 2, 'www簡答', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (54, 6, 0, 'h', 'h1', '2', 'h2h', '2', 'hh3', '2', 'h4', '2');
INSERT INTO `groupsubquestionbase` VALUES (61, 7, 0, '正常1', 'ㄅ', '1', 'ㄆ', '3', 'ㄇ', '2', 'ㄈ', '1');
INSERT INTO `groupsubquestionbase` VALUES (62, 7, 1, '是非型', 'rr1', '1', 'rr2', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (63, 7, 2, '簡答型', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (71, 8, 0, '你覺得蟑螂所傳播的疾病主要是屬於哪方面的疾病？', '呼吸道方面', '0', '腸胃方面', '2', '神經方面', '0', '皮膚方面', '0');
INSERT INTO `groupsubquestionbase` VALUES (72, 8, 2, '根據上文，你覺得蟑螂為什麼被稱為害蟲？請寫出一個原因。', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (81, 9, 2, '淨灘活動撿拾的是人為垃圾，請問，哪些屬於人為垃圾？\n(A)塑膠盒  (B)玻璃瓶  (C)海藻  (D)糖果紙  (E)貝殼', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (82, 9, 2, '上表是2009年統計全台各項海洋廢棄物所佔的比例，請問哪一類所佔的比例最高？', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (83, 9, 0, '根據2009十大海灘垃圾排名，請問哪一類的垃圾最多？', '金屬', '0', '紙類', '0', '玻璃', '0', '塑膠', '2');
INSERT INTO `groupsubquestionbase` VALUES (84, 9, 1, '清理沙灘垃圾是淨灘的最終目的，請判斷該敘述是否正確。', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (85, 9, 1, '清理沙灘垃圾是淨灘的最終目的', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (86, 9, 1, '蒐集沙灘垃圾相關的數據，可以當作教育宣導的資料', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (87, 9, 1, '淨灘是希望政府和企業能合作，共同清理沙灘垃圾', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (88, 9, 1, '想要減少沙灘垃圾，就要改變民眾的行為和習慣', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (91, 10, 0, '這個實驗所要探索的問題為何？', '哪個材質比較堅硬，不怕水的侵蝕', '0', '哪個材質適合的種植植物', '0', '水的滲透力在哪個材質比較好', '2', '哪個材質適合儲存水', '0');
INSERT INTO `groupsubquestionbase` VALUES (92, 10, 0, '透水性鋪面是人工所鋪築的多孔性鋪面，使雨水或其他水源通過時，能滲入地下，例如停車場常見的植草磚、碎石子鋪面。你覺得透水性鋪面主要的優點是什麼？', '使雨水留在地面', '0', '減少淹水災害', '2', '增加路面堅硬度', '0', '減少施工成本', '0');
INSERT INTO `groupsubquestionbase` VALUES (101, 11, 1, '蛙鞋是人類模仿動物腳上的蹼，例如：青蛙和鴨子的腳。\n\n請問是否正確', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (102, 11, 1, '吸盤可以吊掛各種物品，這項物品的創意聯想是蜘蛛的腳。\n\n請問是否正確', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (103, 11, 1, '除了吸盤、蛙鞋以外，生活中沒有模仿動物外形構造的物品。\n', '有', '2', '沒有', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (104, 11, 1, '人類模仿動物的外形構造，是為了賺更多錢。\n\n請問是否正確', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (105, 11, 1, '模仿動物的特徵各項科技產品，可以讓我們的生活更便利。\n\n請問是否正確', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (111, 12, 1, '[A、B、C] 請問該組動物是否 "會游泳" ？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (112, 12, 1, '[B、C、D] 請問該組動物是否 "會游泳" ？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (113, 12, 1, '[B、C、E] 請問該組動物是否 "會游泳" ？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (114, 12, 1, '[A、B、D] 請問該組動物是否 "會游泳" ？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (115, 12, 0, '柳丁猜測看到的四種動物，哪一種是正確的？', '   A是大蜘蛛', '0', '   B是鴨', '2', '   C是袋鼠', '0', '   E是兔子', '0');
INSERT INTO `groupsubquestionbase` VALUES (121, 13, 0, '根據本文，生物學家所要探索的問題為何？', '如何讓卡伐利亞樹的種子發芽', '2', '如何讓渡渡鳥找到卡伐利亞樹的種子', '0', '如何讓卡伐利亞樹存活超過300年', '0', '如何讓渡渡鳥不要絕種', '0');
INSERT INTO `groupsubquestionbase` VALUES (122, 13, 1, '人類無法再看到活生生的渡渡鳥\n\n根據渡渡鳥在世界上滅絕的敘述，請問是否正確', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (123, 13, 1, '經由復育卡伐利亞樹，可再找回渡渡鳥\n\n根據渡渡鳥在世界上滅絕的敘述，請問是否正確', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (124, 13, 1, '已滅絕的動物身上可能有對人類重要的物質\n\n根據渡渡鳥在世界上滅絕的敘述，請問是否正確', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (131, 14, 1, '根據上表的內容，時間越長，保溫效力越差。', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (132, 14, 1, '根據上表的內容，保溫效力好，保冷效力也會比較好。', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (133, 14, 1, '根據上表的內容，產品的重量是影響保溫效力最主要的原因。', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (134, 14, 0, '根據上表，A-05型保溫杯，其6小時保溫效力標示最有可能為多少度？', '77℃', '0', '71℃', '2', '63℃', '0', '61℃', '0');
INSERT INTO `groupsubquestionbase` VALUES (135, 14, 0, '若該公司出產A-36型保溫杯，容量為0.36公升，重量為0.21公斤，其1小時保溫效力標示最有可能為多少度？', '90℃', '0', '88℃', '2', '86℃', '0', '84℃', '0');
INSERT INTO `groupsubquestionbase` VALUES (136, 14, 1, '根據上表，｢保溫效力｣的測量是採用95℃的熱開水，請問，測量保冷效力的所採用的水可能的溫度是多少？', '4℃', '2', '8℃', '0', '10℃', '0', '14℃', '0');
INSERT INTO `groupsubquestionbase` VALUES (141, 15, 1, '聰明的你，使用 "指北針" ，是否可以幫你快速找到針？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (142, 15, 1, '聰明的你，使用 "不鏽鋼" ，是否可以幫你快速找到針？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (143, 15, 1, '聰明的你，使用 "磁鐵" ，是否可以幫你快速找到針？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (144, 15, 1, '聰明的你，使用 "磁石" ，是否可以幫你快速找到針？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (151, 16, 1, '製作皮影戲偶的紙板厚薄程度會影響它的透光性？\n\n請問該實驗室否可以找出 "皮影可以有許多的顏色" 的答案呢？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (152, 16, 1, '製作皮影戲偶的師傅年紀大小會影響它的透光性？\n\n請問該實驗室否可以找出 "皮影可以有許多的顏色" 的答案呢？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (153, 16, 1, '後台照射皮影戲偶的燈光強度會影響它的透光性？\n\n請問該實驗室否可以找出 "皮影可以有許多的顏色" 的答案呢？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (154, 16, 0, '恩熙想了解如何調整燈光強度，皮影戲表演才會最清楚，根據(圖一)她應該選擇以下哪兩個實驗才能知道以上的情況？', 'A、B', '0', 'A、D', '2', 'B、C', '0', 'C、D', '0');
INSERT INTO `groupsubquestionbase` VALUES (161, 17, 0, '根據(表一)，請問哪個季節的颱風最多？', '春季，3、4、5月', '0', '夏季，6、7、8月', '2', '秋季，9、10、11月 ', '0', '冬季，12、1、2月', '0');
INSERT INTO `groupsubquestionbase` VALUES (162, 17, 0, '(圖二)是103年侵襲臺灣的麥德姆颱風路徑圖，請問颱風中心距離臺灣最近的是何時？', '19日至20日', '0', '21日至22日', '0', '22日至23日', '2', '24日至25日', '0');
INSERT INTO `groupsubquestionbase` VALUES (171, 18, 0, '請問，劉教授所要研究的問題是：', '有持續跳繩比沒有持續跳繩的學童長得高？', '2', '有跳繩30分比沒有跳繩30分的學童長得高？', '0', '有跳繩30下比沒有跳繩30下的學童長得高？', '0', '只要跳繩20週就能長得比較高？', '0');
INSERT INTO `groupsubquestionbase` VALUES (172, 18, 2, '(表一)是劉影梅教授指導碩士生楊雅嵐在宜蘭縣公館、光復國小等校的實驗結果。\n\n依據(表一)，有每天跳繩30分鐘的學童在5個月後的平均身高比沒有每天跳繩30分鐘的學童多出多少公分？', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (173, 18, 1, '兒童之所以能成長、增高，是因為兒童的四肢骨及脊椎體的上下端，均含有能不斷分裂、增殖的組織，即所謂的生長板。由於遺傳、營養及身體健康的影響，生長板到某一年齡時就會閉合而停止分裂，而人的身高便從此決定。在生長板閉合之後，即使給與任何生長激素或增高器的刺激，也是無法達到增高的目的。\n\n依據(圖一)，你認為哪一張圖的生長板尚未閉合，還有生長的空間。', 'A', '2', 'B', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (181, 19, 0, '周桀綸利用暑假去到墾丁浮潛，他不可能看到下面哪一種生物？', '櫻花勾吻鮭', '2', '珊瑚', '0', '小丑魚', '0', '海藻', '0');
INSERT INTO `groupsubquestionbase` VALUES (182, 19, 2, '(2)	請問你為何會選擇這個答案，請說說看你的理由。', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (191, 20, 0, '為什麼各地的養護工程處要在7月份就開始積極進行行道樹的修剪工作？', '因為暴雨季即將來臨，修剪行道樹，避免樹被水沖走', '0', '因為暑假即將來臨，修剪行道樹，避免樹枝絆倒學生', '0', '因為颱風季即將來臨，修剪行道樹，避免樹被風吹斷', '2', '因為登革熱季將來臨，修剪行道樹，避免傳染病散播', '0');
INSERT INTO `groupsubquestionbase` VALUES (192, 20, 0, '每年颱風侵台時，總帶來豪雨成災，低窪地區淹水、山區土石流成災時有耳聞。我們應該在山坡地上多種植哪一類的植物，避免土壤因豪雨沖刷而快速流失，造成土石流？', '韓國草、牛筋草等草本植物，加強綠化。(圖一)', '0', '檳榔、竹子等短根系的木本植物。(圖二)', '0', '玫瑰、杜鵑等灌木植物。(圖三)', '0', '(D)	紅檜、松樹等喬木植物。(圖四)', '2');
INSERT INTO `groupsubquestionbase` VALUES (193, 20, 0, '大義想探討「坡度」對土石流的影響，他利用自製的道具(一堆大大小小各異的石頭、斜坡)想模擬土石流發生情況，根據(圖五)，他要比較哪兩個實驗才能知道呢？', '甲、乙', '2', '乙、丁', '0', '乙、丙', '0', '丙、丁', '0');
INSERT INTO `groupsubquestionbase` VALUES (201, 21, 0, '但新版的食品安全衛生管理法中規定食品總重含有 5% 以上基因改造食品標示義務，目的是要提醒消費者少食用基改食物，可能的原因是：', '基因改良過的農作物具有抵抗病蟲害及惡劣氣候能力?', '0', '大量繁殖農作物可以轉製成生質能源，解決石化原料污染的問題？', '0', '可能將過敏原基因引入食物中，讓食用者容易產生過敏?', '2', '基因改造食物會因為生存環境的不同而產生病變?', '0');
INSERT INTO `groupsubquestionbase` VALUES (202, 21, 0, '現代科技日新月異，醫療進步，使得全球人口數持續攀升，為了又效解決糧食問題，基因改造食品工程應勢而生。1992年，中國首先在大田生產上種植抗黃瓜鑲嵌病毒基因改造菸草，是世界上第一個商品化種植基因改造作物的國家。之後，各國持續專研於基因改造工程，想為人類生活做更好的改善。但，現在基改食品充斥市面，也有些科學家對基因改造食品提出不同的看法，不認為它是真的對環境有利的。你認為基因改造食品對人類或環境不好的影響是什麼呢？', '可以有效解決糧食不足的危機。', '0', '引發過敏風險，慢性發炎恐致癌。', '2', '讓作物成長快速，不受蟲害影響。', '0', '減少農藥的使用，有效降低成本。', '0');
INSERT INTO `groupsubquestionbase` VALUES (211, 22, 1, '小中找來了滿天星與銀膠菊的葉子照片，要仔細研究兩者的不同，請幫忙小中區分滿天星與銀膠菊不同的地方。\n\n根據(圖一)(滿天星)，請選出正確的答案!', '葉子呈現 "互生"  ', '0', '葉子呈現 "對生"', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (212, 22, 1, '小中找來了滿天星與銀膠菊的葉子照片，要仔細研究兩者的不同，請幫忙小中區分滿天星與銀膠菊不同的地方。\n\n根據(圖二)(銀膠菊)，請選出正確的答案!', '葉子呈現 "互生"', '2', '葉子呈現 "對生"', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (213, 22, 1, '小中找來了滿天星與銀膠菊的葉子照片，要仔細研究兩者的不同，請幫忙小中區分滿天星與銀膠菊不同的地方。\n\n根據(圖三)(滿天星)，請選出正確的答案!', '莖呈現 "內凹條紋"', '0', '莖呈現 "光滑"', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (214, 22, 1, '小中找來了滿天星與銀膠菊的葉子照片，要仔細研究兩者的不同，請幫忙小中區分滿天星與銀膠菊不同的地方。\n\n根據(圖四)(銀膠菊)，請選出正確的答案!', '莖呈現 "內凹條紋"', '2', '莖呈現 "光滑"', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (215, 22, 0, '小中想要對銀膠菊有更深一層的認識，他查詢到的資料顯示銀膠菊與滿天星、艾草部位特徵相近，如果小中想要仔細分辨銀膠菊與其他植物不同的地方，他可以從那些方面著手？ ', '用眼觀察，從銀膠菊的外觀：根、莖、葉的部分區分。 ', '2', '用鼻子聞，從銀膠菊的味道區分。', '0', '用眼觀察，從銀膠菊種子散播方式區分。', '0', '動手採集，從銀膠菊分泌的汁液區分。', '0');
INSERT INTO `groupsubquestionbase` VALUES (216, 22, 1, '從以上的實驗結果 - 請問 [銀膠菊全株都對人類有毒害] 是否正確？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (217, 22, 1, '從以上的實驗結果 - 請問 [銀膠菊全株都對蟑螂有毒害] 是否正確？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (218, 22, 1, '從以上的實驗結果 - 請問 [銀膠菊的根比較毒] 是否正確？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (219, 22, 1, '從以上的實驗結果 - 請問 [銀膠菊一定可以毒死所有蟑螂] 是否正確？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (221, 23, 0, '來到乙處的風常會使農作物乾枯，使農民遭受損失。這種風應該是什麼風？', '季風', '0', '焚風', '2', '颱風', '0', '颶風', '0');
INSERT INTO `groupsubquestionbase` VALUES (231, 24, 2, '根據上面圖表資料，請問 921 大地震震央在台灣的哪個縣市？\n芮氏規模為多少？ ', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (232, 24, 0, '根據圖表，離地震震央愈近，會有何種現象? ', '愈晚感受到地震', '0', '震源深度愈深', '0', '地層越軟弱', '0', '所測得的震度愈大', '2');
INSERT INTO `groupsubquestionbase` VALUES (233, 24, 0, '地震發生時所放出的震波分為兩種，一種是跑得較快（秒速約6.5公里），比較不會造成傷害的P波，另一種則是跑得較慢（秒速約3.5公里），破壞力較大的S波。\n\n為了掌握避難時機，地震預警系統應該要先偵測哪一個波？', 'P波', '2', 'S波', '0', '兩波會同時到達', '0', '以目前技術還測不到', '0');
INSERT INTO `groupsubquestionbase` VALUES (241, 25, 0, '這個會變色冰，會變色的主要因素是因為蔬果汁A？', '會隨著水溶液酸鹼性而變色。', '2', '會隨著水溶液溫度變化而變色。', '0', '遇果汁而解離時，會變成桃紅色。', '0', '遇到粉末時，會變成綠色。', '0');
INSERT INTO `groupsubquestionbase` VALUES (251, 26, 0, '倒一杯汽水，在放幾顆葡萄乾到汽水裡，就會看到葡萄乾在汽水中浮浮沈沈。\n這個實驗是為了證明下列哪一個假說？\n', '葡萄乾本身很輕，會在汽水中沉浮', '0', '汽水中有氫氣成分，使得葡萄乾沉浮', '0', ' 汽水中的氣壓，使得葡萄乾浮沉', '0', '汽水中的二氧化碳，使得葡萄乾浮沉', '2');
INSERT INTO `groupsubquestionbase` VALUES (252, 26, 0, '當打開一罐汽水時，會使得汽水上方的壓力在很短短時間內由原來的2~3大氣壓力降為正常的1大氣壓，在這快速膨脹過程中就會產生巨大的冷卻作用。\n請問：從冰箱拿出一瓶汽水，打開後，你會看見什麼現象？\n', '汽水瓶沒有變化，只是摸起來冰冰的。', '0', '打開汽水瓶口時有白霧產生。', '2', '看見汽水瓶底有白霧產生成。', '0', '會發現汽水瓶身外產生水珠。', '0');
INSERT INTO `groupsubquestionbase` VALUES (253, 26, 0, '從實驗中想找出最適合用來和小蘇打混和產生二氧化碳的酸性液體，\n(表一)中，用量是指：和10g小蘇打粉產生酸鹼中和時的用量。\n\n分析表中訊息，最適合用來和小蘇打混和產生二氧化碳的材料是哪一種液體？', '丁', '2', '丙', '0', '乙', '0', '甲', '0');
INSERT INTO `groupsubquestionbase` VALUES (261, 27, 0, '鮣魚體型很小，藉由背鰭特化的吸盤吸附在鯊魚的腹部。鮣魚不但毫不費力便可隨著鯊魚洄游，還可以撿食鯊魚獵食的碎屑。鮣魚與鯊魚間的關係稱為？　', '互利共生', '2', '片利共生', '0', '寄生', '0', '競爭共生', '0');
INSERT INTO `groupsubquestionbase` VALUES (262, 27, 0, '春天時，許多花卉、蔬菜的新芽部位常會出現蚜蟲，牠們以刺吸式的口器吸食植物的汁液，造成農作物的危害和損失，被視為農業害蟲之一。仔細觀察，有蚜蟲的地方往往也會發現許多螞蟻，卻不見蚜蟲數量減少。為什麼會發生這種現象？你的理由(假說)是?', '螞蟻喜歡捕食蚜蟲來吃', '0', '螞蟻喜愛蚜蟲排泄的蜜露', '2', '螞蟻喜歡往高處攀爬', '0', '蚜蟲喜歡吃螞蟻的食物', '0');
INSERT INTO `groupsubquestionbase` VALUES (271, 28, 0, '我們要如何讓熱氣球下降呢？請提出一個合理可行的方法。', '用燃燒器加熱空氣，使熱氣球內空氣溫度升高，熱氣球就會下降。', '0', '把燃燒器關掉，熱氣球內空氣會慢慢冷卻下來，熱氣球就會下降。', '2', '在熱氣球內用人力灌入冷空氣，因為熱漲冷縮，熱氣球就會下降。', '0', '熱氣球一旦升空，只能等燃燒器內的燃料燒完，熱氣球就會下降。', '0');
INSERT INTO `groupsubquestionbase` VALUES (272, 28, 2, '元宵節會放天燈，你認為它的原理和熱氣球相同嗎？請提出你的看法。', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (281, 29, 0, '從生態環境的角度來看，「放生」是一種什麼樣的行為？', '值得鼓勵宣揚的行為 ', '0', '宗教尊重生命的行為', '0', '會破壞生態平衡的行為', '2', '可以維持物種多樣性的行為', '0');
INSERT INTO `groupsubquestionbase` VALUES (282, 29, 0, '大量引進國外的動、植物會對環境造成什麼樣的影響？', '只有外來種動物會威脅原生種生物，植物不會', '0', '增加生物間的競爭，使所有的原生種增加繁殖', '0', '外來種進入台灣，增加生物多樣性且能與其他植物和平共存', '0', '破壞生態平衡，也可能使糧食生產減少，造成生態浩劫', '2');
INSERT INTO `groupsubquestionbase` VALUES (283, 29, 0, '設計利用一些天然又可食用的植物來抑制銀合歡發芽率的實驗中，在土壤中\n添加檳榔、苦瓜、蒜頭、乾橘子皮及鳳凰木葉，再把銀合歡的種子埋入土中\n情形如(表一)，請問實驗中的操作變因是什麼？\n', '銀合歡種子', '0', '處理狀況', '0', '土壤內的添加物', '2', '發芽植株', '0');
INSERT INTO `groupsubquestionbase` VALUES (284, 29, 2, ' 承上題，實驗後發芽的情形如(表二)：\n根據上面表格的實驗結果，對銀合歡發芽率有完全抑制作用的是：', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (285, 29, 2, ' 承上題，實驗後發芽的情形如(表二)：\n同樣根據上面表格的實驗結果，對抑制銀合歡發芽率最無效的是：', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (291, 30, 0, '小明生病時去醫院抽血檢查，他觀察到抽出來的血是暗紅色的，你認為小明抽血的血管部位及抽出的血液成分為何？', '是從動脈抽血，血液成分包括血漿及血球', '0', '是從動脈抽血，血液成分只包括血球', '0', '是從靜脈抽血，血液成分包括血漿及血球', '2', '是從靜脈抽血，血液成分只包括血球', '0');
INSERT INTO `groupsubquestionbase` VALUES (292, 30, 2, '偏食是否容易造成貧血？請提出你的看法。', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (301, 31, 1, '請問 [大屯山未來噴發的機率不高，規模也不會太大] 能用科學研究找到答案嗎？', '是', '0', '否', '2', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (302, 31, 1, '請問 [火山爆發對附近空中交通運輸量的影響程度為何？] 能用科學研究找到答案嗎？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (303, 31, 1, '請問 [火環帶釋放的地震能量占全球總能量的百分之八十。] 能用科學研究找到答案嗎？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (304, 31, 1, '請問 [卡爾布科火山噴出的火山灰雲高達十七公里。] 能用科學研究找到答案嗎？', '是', '2', '否', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (305, 31, 2, '火山灰進入大氣層會造成全球平均氣溫的改變嗎？請提出你的看法。', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (311, 32, 0, '某日下雨過後我們發現東邊的天空出現一個美麗的彩，請問這時太陽較接近哪方位？', '東方', '0', '南方', '0', '西方', '2', '北方', '0');
INSERT INTO `groupsubquestionbase` VALUES (312, 32, 0, '某校某班學生，進行觀察彩虹的研究，為使出現的彩虹清晰明顯，設計了不同顏色的牆面當作背景，並觀察了3次。觀察結果如(表一)。\n\n根據(表一)請你判斷：最主要的實驗探索問題是什麼？', '觀察時間不同時，是否會影響彩虹的清晰度？', '2', '背景顏色不同時，是否會影響彩虹的清晰度？', '0', '觀察地點不同時，是否會影響彩虹的清晰度？', '0', '觀察日期不同時，是否會影響彩虹的清晰度？', '0');
INSERT INTO `groupsubquestionbase` VALUES (321, 33, 2, '北投圖書館符合內政部的綠建築九項指標：包括「生物多樣性」、「綠化量」、「基地保水」、「水資源」、「日常節能」、「二氧化碳減量」、「室內健康與環境」、「廢棄物減量」、「汙水與垃圾改善」。請判斷文章中所述：對於木材建材除做白蟻防治外，並使用生態塗料，是符合哪一項指標？', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (322, 33, 2, '若將上表資料依部門別表示繪製成趨勢圖如(圖一)\n\n根據(圖一)，從1990年到2010年平均而言，請問哪一個部門的CO２排放量排名第二？', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (323, 33, 2, '若將上表資料依部門別表示繪製成趨勢圖如(圖一)\n\n根據(圖一)，從1990年到2010年平均而言，哪一個部門的CO２排放量最少？ ', '', '0', '', '0', '', '0', '', '0');
INSERT INTO `groupsubquestionbase` VALUES (324, 33, 0, '由觀測每月利用雨水回收澆灌植栽的成效，設計一個實驗：實驗組是有雨水回收系統供澆灌植栽，對照組則由自來水系統供給水源，請問在這個實驗中需要「改變的因素」是什麼？', ' 澆灌植栽的供水時間', '0', '澆灌植栽的供水人員', '0', '澆灌植栽的供水水量', '2', '澆灌植栽的供水系統', '0');
INSERT INTO `groupsubquestionbase` VALUES (331, 34, 0, '滴一滴海水在載玻片上，再放到通風處，一天過後，可以在載玻片上觀察到什麼現象？', '海水的量變多', '0', '產生很多氣泡', '0', '沒有物質留下', '0', '出現鹽的結晶', '2');
INSERT INTO `groupsubquestionbase` VALUES (332, 34, 0, '用酒精燈加熱食鹽水後出現的食鹽顆粒會有什麼結果？', '水份蒸發速度快，食鹽顆粒會比較大。', '2', '水份蒸發速度慢，食鹽顆粒會比較大。', '0', '水份蒸發速度快，食鹽顆粒會比較小。', '0', '水份蒸發速度慢，食鹽顆粒會比較小。', '0');
INSERT INTO `groupsubquestionbase` VALUES (341, 35, 0, '海洋塑膠廢棄物最後大部份會怎樣？', '分解成更小的粒子，再度回到大氣中。', '0', '經由層層食物鏈，到達人的身體內。', '0', '經過長時間作用，沈積到沙灘最底層。', '2', '廢棄物慢慢累積融合，變成大塑膠片。', '0');
INSERT INTO `groupsubquestionbase` VALUES (342, 35, 0, '你推斷信天翁幼鳥因吃到塑膠垃圾，導致窒息、飢餓和脫水致死的最大因素是：', '影響生殖能力', '0', '吃進有害化學物質', '0', '影響消化食物能力', '2', '纏繞窒息喪命', '0');
INSERT INTO `groupsubquestionbase` VALUES (343, 35, 0, '你覺得要如何做才能真正根本地減少海洋塑膠廢棄物的數量？', '鼓勵減少使用塑膠製品', '2', '多派人撿拾塑膠廢棄物', '0', '禁止遊客到海灘遊玩', '0', '興建大型焚化爐來因應', '0');
INSERT INTO `groupsubquestionbase` VALUES (351, 36, 0, '小志想要從冰箱裡拿出醬瓜來配稀飯，卻發現醬瓜的金屬蓋子打不開，小志若要用密封的醬瓜蓋驗證熱脹冷所原理，可以怎麼做?', '把瓶子泡在熱水裡', '0', '將蓋子沖一會兒熱水', '2', '將醬瓜放到冷凍庫裡', '0', '用鐵鎚把瓶子敲破', '0');
INSERT INTO `groupsubquestionbase` VALUES (352, 36, 0, '小賓不小心把兩個玻璃杯相疊在一起，為了將它們分開，小賓試了很多方法。請問下列哪些方法可以將兩個杯子分開呢？(圖片來源:康軒出版社)', '將外面的杯子泡進熱水裡(圖一)', '0', '將熱水倒進裡面的杯子中(圖二)', '0', '將冰水倒進裡面的杯子中(圖三)', '2', '將外面的杯子泡進冷水裡(圖四)', '0');
INSERT INTO `groupsubquestionbase` VALUES (353, 36, 0, '在(圖五)液體的熱脹冷縮實驗中，冷水與熱水標示的水位相差8公分，冷水是30℃，熱水是60℃。如果拿這個錐形瓶去測量某個液體的溫度，水位比冷水位的高4公分，這個液體的溫度大約是幾度？　\n', '32℃', '0', '45℃', '2', '58℃', '0', '65℃', '0');

-- --------------------------------------------------------

-- 
-- 資料表格式： `imagelink`
-- 

CREATE TABLE `imagelink` (
  `imageID` int(30) NOT NULL,
  `QID` int(30) NOT NULL,
  `QType` varchar(15) NOT NULL,
  KEY `imageID` (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `imagelink`
-- 

INSERT INTO `imagelink` VALUES (1, 1, 'TFQuestion');
INSERT INTO `imagelink` VALUES (4, 2, 'TFQuestion');
INSERT INTO `imagelink` VALUES (7, 3, 'TFQuestion');
INSERT INTO `imagelink` VALUES (2, 1, 'ChoiceQuestion');
INSERT INTO `imagelink` VALUES (5, 2, 'ChoiceQuestion');
INSERT INTO `imagelink` VALUES (8, 3, 'ChoiceQuestion');
INSERT INTO `imagelink` VALUES (6, 2, 'Group');
INSERT INTO `imagelink` VALUES (9, 3, 'Group');
INSERT INTO `imagelink` VALUES (1, 3, 'Group');
INSERT INTO `imagelink` VALUES (10, 5, 'TFQuestion');
INSERT INTO `imagelink` VALUES (3, 5, 'TFQuestion');
INSERT INTO `imagelink` VALUES (3, 5, 'ChoiceQuestion');
INSERT INTO `imagelink` VALUES (10, 5, 'ChoiceQuestion');
INSERT INTO `imagelink` VALUES (3, 6, 'Group');
INSERT INTO `imagelink` VALUES (9, 6, 'Group');
INSERT INTO `imagelink` VALUES (10, 6, 'Group');
INSERT INTO `imagelink` VALUES (3, 7, 'TFQuestion');
INSERT INTO `imagelink` VALUES (2, 7, 'Group');
INSERT INTO `imagelink` VALUES (9, 7, 'Group');

-- --------------------------------------------------------

-- 
-- 資料表格式： `imagetable`
-- 

CREATE TABLE `imagetable` (
  `imageID` int(30) NOT NULL,
  `imageURL` varchar(250) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY  (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `imagetable`
-- 

INSERT INTO `imagetable` VALUES (1, 'upload/20150711142107.png', 'teacher01');
INSERT INTO `imagetable` VALUES (2, 'upload/20150711142115.png', 'teacher01');
INSERT INTO `imagetable` VALUES (3, 'upload/20150711142123.png', 'teacher01');
INSERT INTO `imagetable` VALUES (4, 'upload/20150711142131.png', 'teacher02');
INSERT INTO `imagetable` VALUES (5, 'upload/20150711142140.png', 'teacher02');
INSERT INTO `imagetable` VALUES (6, 'upload/20150711142150.png', 'teacher02');
INSERT INTO `imagetable` VALUES (7, 'upload/20150711142202.png', 'teacher02');
INSERT INTO `imagetable` VALUES (8, 'upload/20150711142219.png', 'teacher02');
INSERT INTO `imagetable` VALUES (9, 'upload/20150711142242.jpg', 'teacher02');
INSERT INTO `imagetable` VALUES (10, 'upload/20160510160159.png', 'teacher01');
INSERT INTO `imagetable` VALUES (11, 'upload/20160512151854.png', 'teacher01');

-- --------------------------------------------------------

-- 
-- 資料表格式： `paperbase`
-- 

CREATE TABLE `paperbase` (
  `paperID` int(30) NOT NULL,
  `PTitle` varchar(150) NOT NULL,
  `PExplan` varchar(250) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY  (`paperID`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `paperbase`
-- 

INSERT INTO `paperbase` VALUES (1, '測試試卷一', 'T1', 'teacher01');
INSERT INTO `paperbase` VALUES (2, '測試試卷二', 'T2', 'teacher02');
INSERT INTO `paperbase` VALUES (3, '測試試卷三', 'T2 to T1', 'teacher02');
INSERT INTO `paperbase` VALUES (4, 'tttt', '', 'teacher01');
INSERT INTO `paperbase` VALUES (5, 'E5', '', 'teacher01');
INSERT INTO `paperbase` VALUES (6, '測試-1', '001', 'teacher01');
INSERT INTO `paperbase` VALUES (7, 'DDD', '', 'teacher01');
INSERT INTO `paperbase` VALUES (8, 'Mr.王-1', '', 'T01');
INSERT INTO `paperbase` VALUES (9, 'Mr.李-1', '', 'T02');
INSERT INTO `paperbase` VALUES (10, 'Mr.陳-1', '', 'T03');
INSERT INTO `paperbase` VALUES (11, 'Mr.高-1', '', 'T04');

-- --------------------------------------------------------

-- 
-- 資料表格式： `paperlink`
-- 

CREATE TABLE `paperlink` (
  `paperID` int(30) NOT NULL,
  `QID` int(30) NOT NULL,
  `QType` varchar(15) NOT NULL,
  KEY `paperID` (`paperID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `paperlink`
-- 

INSERT INTO `paperlink` VALUES (1, 1, 'TF');
INSERT INTO `paperlink` VALUES (1, 1, 'CH');
INSERT INTO `paperlink` VALUES (1, 1, 'GP');
INSERT INTO `paperlink` VALUES (1, 1, 'SA');
INSERT INTO `paperlink` VALUES (2, 2, 'TF');
INSERT INTO `paperlink` VALUES (2, 2, 'CH');
INSERT INTO `paperlink` VALUES (2, 2, 'GP');
INSERT INTO `paperlink` VALUES (2, 2, 'SA');
INSERT INTO `paperlink` VALUES (3, 3, 'TF');
INSERT INTO `paperlink` VALUES (3, 3, 'CH');
INSERT INTO `paperlink` VALUES (3, 3, 'GP');
INSERT INTO `paperlink` VALUES (3, 3, 'SA');
INSERT INTO `paperlink` VALUES (5, 5, 'TF');
INSERT INTO `paperlink` VALUES (5, 5, 'CH');
INSERT INTO `paperlink` VALUES (5, 1, 'GP');
INSERT INTO `paperlink` VALUES (5, 6, 'GP');
INSERT INTO `paperlink` VALUES (5, 1, 'SA');
INSERT INTO `paperlink` VALUES (4, 1, 'TF');
INSERT INTO `paperlink` VALUES (4, 1, 'CH');
INSERT INTO `paperlink` VALUES (4, 6, 'GP');
INSERT INTO `paperlink` VALUES (4, 1, 'SA');
INSERT INTO `paperlink` VALUES (6, 1, 'TF');
INSERT INTO `paperlink` VALUES (6, 5, 'TF');
INSERT INTO `paperlink` VALUES (6, 1, 'CH');
INSERT INTO `paperlink` VALUES (6, 1, 'GP');
INSERT INTO `paperlink` VALUES (6, 1, 'SA');
INSERT INTO `paperlink` VALUES (7, 1, 'TF');
INSERT INTO `paperlink` VALUES (7, 4, 'TF');
INSERT INTO `paperlink` VALUES (7, 5, 'TF');
INSERT INTO `paperlink` VALUES (7, 7, 'TF');
INSERT INTO `paperlink` VALUES (7, 1, 'CH');
INSERT INTO `paperlink` VALUES (7, 4, 'CH');
INSERT INTO `paperlink` VALUES (7, 5, 'CH');
INSERT INTO `paperlink` VALUES (8, 8, 'GP');
INSERT INTO `paperlink` VALUES (8, 9, 'GP');
INSERT INTO `paperlink` VALUES (8, 10, 'GP');
INSERT INTO `paperlink` VALUES (9, 16, 'GP');
INSERT INTO `paperlink` VALUES (9, 17, 'GP');
INSERT INTO `paperlink` VALUES (9, 18, 'GP');
INSERT INTO `paperlink` VALUES (9, 19, 'GP');
INSERT INTO `paperlink` VALUES (10, 27, 'GP');
INSERT INTO `paperlink` VALUES (10, 28, 'GP');
INSERT INTO `paperlink` VALUES (10, 29, 'GP');
INSERT INTO `paperlink` VALUES (11, 30, 'GP');
INSERT INTO `paperlink` VALUES (11, 31, 'GP');
INSERT INTO `paperlink` VALUES (11, 36, 'GP');

-- --------------------------------------------------------

-- 
-- 資料表格式： `questionpermission`
-- 

CREATE TABLE `questionpermission` (
  `owner` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `paperID` int(30) NOT NULL,
  KEY `paperID` (`paperID`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `questionpermission`
-- 

INSERT INTO `questionpermission` VALUES ('teacher02', 'teacher01', 3);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0001', 1);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0002', 1);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0003', 1);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0003', 4);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0002', 4);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0001', 4);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0001', 6);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0002', 6);
INSERT INTO `questionpermission` VALUES ('teacher01', 'T0003', 6);
INSERT INTO `questionpermission` VALUES ('T01', 'T02', 8);

-- --------------------------------------------------------

-- 
-- 資料表格式： `sa_store`
-- 

CREATE TABLE `sa_store` (
  `SAId` int(100) NOT NULL,
  `SAAns` varchar(4500) NOT NULL,
  `SID` varchar(20) NOT NULL,
  `PID` int(30) NOT NULL,
  `AID` int(30) NOT NULL,
  `GID` int(30) NOT NULL,
  `grade` varchar(30) NOT NULL default 'N',
  `mark` varchar(5) NOT NULL default '0',
  `Steacher` varchar(30) NOT NULL,
  KEY `SAId` (`SAId`),
  KEY `AID` (`AID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `sa_store`
-- 

INSERT INTO `sa_store` VALUES (1, 'E5 - 簡答2', 'FC101101', 5, 2, 2, '4', '1', 'teacher01');

-- --------------------------------------------------------

-- 
-- 資料表格式： `share`
-- 

CREATE TABLE `share` (
  `ID` int(150) NOT NULL,
  `password` varchar(30) NOT NULL,
  `sort` varchar(10) NOT NULL,
  `Aid` varchar(30) NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(350) NOT NULL,
  `file_path` varchar(500) NOT NULL default 'none',
  `upTime` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `share`
-- 

INSERT INTO `share` VALUES (1, '', '1', '2', 'T1', '分享1', 'upload/share/1.png', '2016 / 04 / 05');
INSERT INTO `share` VALUES (2, '1234', '2', '2', 'T2', '分享2', 'upload/share/2.png', '2016 / 04 / 07');
INSERT INTO `share` VALUES (3, 'read1', '3', 'Manager', '群組一限定', '閱讀第一章', 'upload/share/3.txt', '2016 / 04 / 21');

-- --------------------------------------------------------

-- 
-- 資料表格式： `short`
-- 

CREATE TABLE `short` (
  `SAId` int(100) NOT NULL,
  `SADetail` varchar(750) NOT NULL,
  `QType` varchar(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY  (`SAId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `short`
-- 

INSERT INTO `short` VALUES (1, '請回答下列之簡答題', 'SAQuestion', 'teacher01');
INSERT INTO `short` VALUES (2, 'temp22\n22222', 'SAQuestion', 'teacher02');
INSERT INTO `short` VALUES (3, 'SA3', 'SAQuestion', 'teacher02');

-- --------------------------------------------------------

-- 
-- 資料表格式： `student_data`
-- 

CREATE TABLE `student_data` (
  `Sid` varchar(30) NOT NULL,
  `Spassword` varchar(20) NOT NULL,
  `Sname` varchar(10) NOT NULL,
  `Sclass` varchar(10) NOT NULL,
  `Steacher` varchar(30) NOT NULL,
  `login` int(2) NOT NULL default '0',
  `basic_data` varchar(2) NOT NULL default '0',
  PRIMARY KEY  (`Sid`),
  KEY `Steacher` (`Steacher`),
  KEY `Sclass` (`Sclass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `student_data`
-- 

INSERT INTO `student_data` VALUES ('3', '3', '1', '三民國小一年一班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101101', 'FC101101', '王小名', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101102', 'FC101102', '黃大銘', '三年五班', 'teacher01', 1, '0');
INSERT INTO `student_data` VALUES ('FC101103', 'FC101103', '陳雅君', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101104', 'FC101104', '黃卿雅', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101105', 'FC101105', '林婉婷', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101106', 'FC101106', '李冠霖', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101107', 'FC101107', '蔡昆育', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101108', 'FC101108', '呂冠嫻', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101109', 'FC101109', '郭佳慈', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101110', 'FC101110', '薛如君', '三年五班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FC101111', 'FC101111', '黃彥霖', 'class2', 'teacher02', 0, '0');
INSERT INTO `student_data` VALUES ('FC101112', 'FC101112', '譚世一', 'class2', 'teacher02', 0, '0');
INSERT INTO `student_data` VALUES ('FC101113', 'FC101113', '蘇永明', 'class1', 'teacher02', 0, '0');
INSERT INTO `student_data` VALUES ('FC101114', 'FC101114', '李秉廷', 'class1', 'teacher02', 0, '0');
INSERT INTO `student_data` VALUES ('FF001', 'FF001', '學生1', '一年三班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FF002', 'FF002', '學生2', '一年三班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FF003', 'FF003', '學生3', '一年三班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FF004', 'FF004', '學生4', '一年三班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('FF005', 'FF005', '學生5', '一年三班', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('S01', 'S01', 'S01', '三年一班', 'T01', 0, '0');
INSERT INTO `student_data` VALUES ('S02', 'S02', 'S02', '三年一班', 'T01', 0, '0');
INSERT INTO `student_data` VALUES ('S03', 'S03', 'S03', '四年一班', 'T02', 0, '0');
INSERT INTO `student_data` VALUES ('S04', 'S04', 'S04', '四年一班', 'T02', 0, '0');
INSERT INTO `student_data` VALUES ('S05', 'S05', 'S05', '五年一班', 'T03', 0, '0');
INSERT INTO `student_data` VALUES ('S06', 'S06', 'S06', '五年一班', 'T03', 0, '0');
INSERT INTO `student_data` VALUES ('S07', 'S07', 'S07', '六年一班', 'T04', 0, '0');
INSERT INTO `student_data` VALUES ('S08', 'S08', 'S08', '六年一班', 'T04', 0, '0');
INSERT INTO `student_data` VALUES ('T1', 'T1', 'T1', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('T2', 'T2', 'T2', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('T3', 'T3', 'T3', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('T4', 'T4', 'T4', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('T5', 'T5', 'T5', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('T6', 'T6', 'T6', '測試', 'teacher01', 0, '0');
INSERT INTO `student_data` VALUES ('y', 'y', 'y', '一年二班', 'teacher01', 0, '0');

-- --------------------------------------------------------

-- 
-- 資料表格式： `student_grade`
-- 

CREATE TABLE `student_grade` (
  `studentID` varchar(20) NOT NULL,
  `paperID` int(30) NOT NULL,
  `gradeID` int(30) NOT NULL,
  `allocateID` int(30) NOT NULL,
  `grade` int(20) NOT NULL,
  `Time` varchar(30) NOT NULL,
  KEY `gradeID` (`gradeID`),
  KEY `allocateID` (`allocateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `student_grade`
-- 

INSERT INTO `student_grade` VALUES ('FC101101', 5, 2, 2, 23, '2016-05-11');
INSERT INTO `student_grade` VALUES ('FC101102', 5, 2, 2, 0, '');
INSERT INTO `student_grade` VALUES ('S01', 8, 1, 1, 0, '');
INSERT INTO `student_grade` VALUES ('S02', 8, 1, 1, 0, '');
INSERT INTO `student_grade` VALUES ('S03', 9, 1, 3, 0, '');
INSERT INTO `student_grade` VALUES ('S04', 9, 1, 3, 0, '');
INSERT INTO `student_grade` VALUES ('S05', 10, 1, 4, 0, '');
INSERT INTO `student_grade` VALUES ('S06', 10, 1, 4, 0, '');
INSERT INTO `student_grade` VALUES ('S07', 11, 1, 5, 0, '');
INSERT INTO `student_grade` VALUES ('S08', 11, 1, 5, 0, '');

-- --------------------------------------------------------

-- 
-- 資料表格式： `teacher_class`
-- 

CREATE TABLE `teacher_class` (
  `Aid` varchar(30) NOT NULL,
  `Aclass` varchar(60) NOT NULL,
  KEY `Aid` (`Aid`),
  KEY `Aclass` (`Aclass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `teacher_class`
-- 

INSERT INTO `teacher_class` VALUES ('teacher01', '三年五班');
INSERT INTO `teacher_class` VALUES ('teacher02', 'class2');
INSERT INTO `teacher_class` VALUES ('teacher01', '三民國小一年一班');
INSERT INTO `teacher_class` VALUES ('teacher02', 'class1');
INSERT INTO `teacher_class` VALUES ('teacher01', '一年一班');
INSERT INTO `teacher_class` VALUES ('teacher01', '一年二班');
INSERT INTO `teacher_class` VALUES ('teacher01', '一年三班');
INSERT INTO `teacher_class` VALUES ('teacher01', '測試');
INSERT INTO `teacher_class` VALUES ('T01', '三年一班');
INSERT INTO `teacher_class` VALUES ('T02', '四年一班');
INSERT INTO `teacher_class` VALUES ('T03', '五年一班');
INSERT INTO `teacher_class` VALUES ('T04', '六年一班');

-- --------------------------------------------------------

-- 
-- 資料表格式： `tfquestionbase`
-- 

CREATE TABLE `tfquestionbase` (
  `TFId` int(30) NOT NULL,
  `TFDetail` varchar(1000) NOT NULL,
  `TContent` varchar(150) NOT NULL,
  `FContent` varchar(150) NOT NULL,
  `TScore` varchar(15) NOT NULL,
  `FScore` varchar(15) NOT NULL,
  `QType` varchar(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY  (`TFId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `tfquestionbase`
-- 

INSERT INTO `tfquestionbase` VALUES (1, '測試用是非題1', '1', '2', '0', '0', 'TFQuestion', 'teacher01');
INSERT INTO `tfquestionbase` VALUES (2, '測試用是非題2', '3分', '0分', '3', '0', 'TFQuestion', 'teacher02');
INSERT INTO `tfquestionbase` VALUES (3, '1234', '321', '321', '1', '3', 'TFQuestion', 'teacher02');
INSERT INTO `tfquestionbase` VALUES (4, 'for test ', '!', '@', '0', '0', 'TFQuestion', 'teacher01');
INSERT INTO `tfquestionbase` VALUES (5, '234', '1', '1', '0', '0', 'TFQuestion', 'teacher01');
INSERT INTO `tfquestionbase` VALUES (6, 'T0001-+', 'T0001 - 1', 'T0001 - 2', '1', '3', 'TFQuestion', 'T0001');
INSERT INTO `tfquestionbase` VALUES (7, 'oi', 'o', 'i', '0', '0', 'TFQuestion', 'teacher01');

-- --------------------------------------------------------

-- 
-- 資料表格式： `truefalse`
-- 

CREATE TABLE `truefalse` (
  `TFId` int(30) NOT NULL,
  `PaperId` varchar(30) NOT NULL,
  `QType` varchar(30) NOT NULL,
  `CreateTime` varchar(50) NOT NULL,
  KEY `TFId` (`TFId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `truefalse`
-- 


-- 
-- 備份資料表限制
-- 

-- 
-- 資料表限制 `allocate`
-- 
ALTER TABLE `allocate`
  ADD CONSTRAINT `allocate_ibfk_1` FOREIGN KEY (`paperID`) REFERENCES `paperbase` (`paperID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allocate_ibfk_2` FOREIGN KEY (`Steacher`) REFERENCES `admin_data` (`Aid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `gpsa_store`
-- 
ALTER TABLE `gpsa_store`
  ADD CONSTRAINT `gpsa_store_ibfk_1` FOREIGN KEY (`AID`) REFERENCES `allocate` (`allocateID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gpsa_store_ibfk_2` FOREIGN KEY (`GPSID`) REFERENCES `groupsubquestionbase` (`GroupQID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `grade_detail`
-- 
ALTER TABLE `grade_detail`
  ADD CONSTRAINT `grade_detail_ibfk_1` FOREIGN KEY (`gradeID`) REFERENCES `student_grade` (`gradeID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `groupqtable`
-- 
ALTER TABLE `groupqtable`
  ADD CONSTRAINT `groupqtable_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `groupquestionbase` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `groupsubquestionbase`
-- 
ALTER TABLE `groupsubquestionbase`
  ADD CONSTRAINT `groupsubquestionbase_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `groupquestionbase` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `imagelink`
-- 
ALTER TABLE `imagelink`
  ADD CONSTRAINT `imagelink_ibfk_1` FOREIGN KEY (`imageID`) REFERENCES `imagetable` (`imageID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `paperlink`
-- 
ALTER TABLE `paperlink`
  ADD CONSTRAINT `paperlink_ibfk_1` FOREIGN KEY (`paperID`) REFERENCES `paperbase` (`paperID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `questionpermission`
-- 
ALTER TABLE `questionpermission`
  ADD CONSTRAINT `questionpermission_ibfk_1` FOREIGN KEY (`paperID`) REFERENCES `paperbase` (`paperID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionpermission_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `admin_data` (`Aid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `sa_store`
-- 
ALTER TABLE `sa_store`
  ADD CONSTRAINT `sa_store_ibfk_1` FOREIGN KEY (`SAId`) REFERENCES `short` (`SAId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sa_store_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `allocate` (`allocateID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `student_data`
-- 
ALTER TABLE `student_data`
  ADD CONSTRAINT `student_data_ibfk_2` FOREIGN KEY (`Steacher`) REFERENCES `admin_data` (`Aid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `student_grade`
-- 
ALTER TABLE `student_grade`
  ADD CONSTRAINT `student_grade_ibfk_1` FOREIGN KEY (`allocateID`) REFERENCES `allocate` (`allocateID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `teacher_class`
-- 
ALTER TABLE `teacher_class`
  ADD CONSTRAINT `teacher_class_ibfk_1` FOREIGN KEY (`Aid`) REFERENCES `admin_data` (`Aid`) ON DELETE CASCADE ON UPDATE CASCADE;
