DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createCar`(IN `name` VARCHAR(250), IN `brand` VARCHAR(250))
BEGIN
	DECLARE LastIdCar INT(11);
    IF NOT (SELECT 1 FROM cartype WHERE cartype.name = name AND cartype.brand = brand LIMIT 1) THEN
    
    	INSERT INTO cartype (cartype.name,cartype.brand)
    	VALUES(name,brand);
    	IF LAST_INSERT_ID() = LastIdCar THEN
    	SELECT "success" AS "reuslt";
    	ELSE
    	SELECT "fail" AS "reuslt";
    	END IF;
    END IF;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createCarXPost`(IN `postID` INT(11), IN `carID` INT(11))
BEGIN
	INSERT INTO cartypexpost(cartypexpost.postId,cartypexpost.typeID)
    VALUES (postID,carID);
   END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createEvaluation`(IN `postId` INT, IN `userId` INT)
BEGIN
DECLARE ln INT;
IF NOT EXISTS(SELECT 1 from userxposts WHERE userxposts.userID = userId AND userxposts.postID = postId) THEN
SELECT posts.like INTO ln FROM posts WHERE posts.id = postId;
UPDATE posts
SET posts.like = ln + 1
WHERE posts.id = postId;
INSERT INTO userxposts (userxposts.userID, userxposts.postID)
VALUES (userId, postId);
END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createFaq`(IN `name` VARCHAR(250))
INSERT INTO faq (faq.question) VALUES (name)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createFaqStep`(IN `id` INT, IN `stepNum` INT, IN `fileId` INT, IN `content` VARCHAR(250))
INSERT INTO faqstep (faqstep.FAQID,faqstep.stepNumber,faqstep.fileID,faqstep.content)
VALUES(id,stepNum,fileId,content)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createFile`(IN `name` VARCHAR(250), IN `userID` INT(11), IN `url` VARCHAR(250), IN `type` VARCHAR(250), IN `extension` VARCHAR(10), IN `size` INT(11))
BEGIN
INSERT INTO files(files.name,files.userID,files.url,files.type ,files.extension,files.size)
VALUES(name,userID,url,type,extension,size);
SELECT files.id FROM files WHERE files.id = LAST_INSERT_ID();
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createFollow`(IN `follow` INT, IN `follower` INT)
BEGIN
  DECLARE follow_id INT;
  
  BEGIN
    -- Próbáljuk meg a beszúrást
    IF EXISTS(SELECT 1 FROM follow WHERE follow.Follow != follow AND follow.Follower != follower) THEN
    INSERT INTO follow (Follow, Follower) VALUES (follow, follower);
    SET follow_id = LAST_INSERT_ID();
    END IF;
  END;

  BEGIN
    -- Ellenőrizzük, hogy a beszúrás sikeres volt-e
    IF follow_id IS NULL THEN
      CALL throwError("Cannot Insert Follow!");
    END IF;
  END;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createMessage`(IN `senderId` INT, IN `receiverId` INT, IN `text` TEXT)
BEGIN
INSERT INTO message(message.text,message.senderID,message.receiverID)
VALUES(text,senderId,receiverId);

INSERT INTO notification (notification.senderID,notification.receiverID,notification.type,notification.tableID)
VALUES(senderId,receiverId,"Message",LAST_INSERT_ID());

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createNotification`(IN `senderID` INT, IN `type` VARCHAR(100), IN `tableId` INT)
BEGIN
    DECLARE cnt INT;
    DECLARE sNum INT;
    DECLARE currentOffset INT;
    DECLARE fS INT;
    SET sNum = 1;
    SET currentOffset = 0;
    
    SELECT COUNT(*) INTO cnt FROM follow WHERE follow.Follow = senderID;

    WHILE (sNum <= cnt) DO
        SELECT follow.Follower INTO fS FROM follow WHERE follow.Follow = senderID ORDER BY follow.id DESC LIMIT 1 OFFSET currentOffset;
        INSERT INTO notification (notification.senderID,notification.receiverID,notification.type,notification.tableID)
        VALUES (senderID,fS,type,tableId);
        SET sNum = sNum + 1;
        SET currentOffset = currentOffset + 1;
    END WHILE;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createPost`(IN `InPost` INT, IN `InTitle` VARCHAR(256), IN `InText` TEXT, IN `InUserID` INT, IN `hasFile` TINYINT, IN `FileID` INT, IN `carName` VARCHAR(250), IN `carBrand` VARCHAR(250))
BEGIN
DECLARE postID INT(11);
DECLARE newPostID INT(11);

IF InPost = 0 THEN
	SET postID = NULL;
ELSE
	SET postID = InPost;
END IF;

	INSERT INTO posts(postId, title, text, userID, hasFile)
	VALUES(postID, InTitle, InText, InUserID, hasFile);

	SET newPostID = LAST_INSERT_ID();
	CALL createNotification(InUserID, "Post", newPostID);
	CALL createCar(carName, carBrand);
	CALL createCarXPost(newPostID, LAST_INSERT_ID());
    
    IF hasFile = 1 THEN
		CALL createPostXFile(newPostID,FileID);
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createPostWithFile`(IN `postId` INT, IN `title` VARCHAR(100), IN `text` TEXT, IN `userID` INT, IN `carName` VARCHAR(250), IN `carBrand` VARCHAR(250), IN `IsFile` TINYINT, IN `fileName` VARCHAR(250), IN `fileUrl` VARCHAR(250), IN `fileType` VARCHAR(250), IN `fileExtension` VARCHAR(10), IN `fileSize` INT(11))
BEGIN
    DECLARE postCount INT;
    DECLARE newPostID INT;
    DECLARE newFileID INT;
    DECLARE sendeFollowerCount INT;
    DECLARE cnt INT;
    
    SET cnt = 1;
    
    
    
    
    IF IsFile THEN 
        INSERT INTO `posts` (`postId`, `title`, `text`, `userID`,`hasFile`)
        VALUES (postId, title, text, userID,1);
        SET newPostID = LAST_INSERT_ID();
        CALL createFile(fileName,userID, fileUrl, fileType, fileExtension, fileSize);
        SET newFileID =  LAST_INSERT_ID();
        INSERT INTO postxfile(fileId, postId)
        VALUES (newFileID, newPostID);
    ELSE 
        INSERT INTO `posts` (`postId`, `title`, `text`, `userID`)
        VALUES (postId, title, text, userID);

        SET newPostID = LAST_INSERT_ID();
END IF;

    
    IF carName IS NOT NULL THEN
        CALL createCar(carName, carBrand);
        CALL createCarXPost(newPostID, LAST_INSERT_ID());
        
        SELECT COUNT(*) INTO sendeFollowerCount FROM follow WHERE follow.Follow = userID;
 		CALL createNotification(userID,"Post", newPostID);
        SELECT *
        FROM posts
        INNER JOIN cartypexpost ON posts.id = cartypexpost.postId 
        INNER JOIN cartype ON cartypexpost.typeID = cartype.id
        WHERE posts.id = newPostID;
    END IF;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `createPostXFile`(IN `postId` INT, IN `fileId` INT)
INSERT INTO postxfile (postxfile.fileId,postxfile.postId)
VALUES (fileId,postId)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getAllCar`()
SELECT * from cartype$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getAllFaq`()
SELECT * FROM faq$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getAllMessageById`(IN `senderId` INT, IN `receiverId` INT)
SELECT * from message 
WHERE 
((message.senderID = senderId AND message.receiverID = receiverId)
OR
(message.senderID = receiverId AND message.receiverID =  senderId))$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getCarByCarTypeOrBrand`(IN `value` VARCHAR(250))
SELECT cartype.name , cartype.brand FROM cartype WHERE cartype.name LIKE CONCAT(CONCAT("%",value),"%") OR cartype.brand LIKE CONCAT(CONCAT("%",value),"%")$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getFaqById`(IN `faqId` INT)
SELECT faqstep.FAQID,faq.question, faqstep.content,faqstep.stepNumber,files.url FROM faqstep
RIGHT JOIN faq ON faq.id = faqstep.FAQID
LEFT JOIN files ON faqstep.fileID = files.id
WHERE faqstep.FAQID = faqId
ORDER BY faqstep.stepNumber ASC$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getFile`(IN `fileId` INT)
SELECT * FROM files WHERE files.id = fileId$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getFilesToPost`(IN `id` INT)
SELECT files.id, files.name,files.userID,files.url,files.type,files.extension,files.size,files.status 
FROM postxfile RIGHT JOIN files ON postxfile.fileId = files.id WHERE postxfile.postId = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getHistory`(IN `userId` INT)
SELECT posts.id AS "PostId", posts.title,userviewpost.timestamp,user.username AS "postCreate",files.url AS "postCreateIMG" from posts 
LEFT JOIN userviewpost ON posts.id = userviewpost.postId 
INNER JOIN user ON posts.userID = user.id
INNER JOIN files ON files.id = user.profilePicture
WHERE userviewpost.userId = userId$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getNotificationById`(IN `userId` INT)
BEGIN

SELECT * FROM notification WHERE notification.receiverID = userId;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getPostById`(IN `postId` INT(11), IN `userId` INT)
BEGIN
DECLARE view int;
 
IF NOT EXISTS(SELECT 1 FROM userviewpost WHERE userviewpost.userId = userID AND userviewpost.postId = postId) THEN
    SELECT posts.viewNumber INTO view FROM posts WHERE posts.id = postId;
    UPDATE posts
    SET posts.viewNumber = view +1
    WHERE posts.id = postId;
    INSERT INTO userviewpost (userviewpost.userId,userviewpost.postId)
    VALUES(userId,postId);
END IF;
SELECT *,EXISTS(SELECT 1 from userxposts WHERE userxposts.userID = userId AND userxposts.postID = postId) AS "liked" 
FROM posts 
WHERE posts.id = postId; 
SELECT files.url FROM files
LEFT JOIN postxfile ON postxfile.fileId = files.id
LEFT JOIN posts ON postxfile.postId = posts.id
WHERE posts.id = postId;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getPostSilpleModeAllOf`()
BEGIN

SELECT *,EXISTS(SELECT 1 from userxposts WHERE userxposts.userID = userId AND userxposts.postID = postId) AS "liked" 
FROM posts
WHERE posts.status = 1;

SELECT posts.id, files.url FROM files
INNER JOIN postxfile ON postxfile.fileId = files.id
INNER JOIN posts ON postxfile.postId = posts.id
WHERE  posts.status = 1;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getTopBlogger`()
SELECT
user.id,
  user.username,
  user.bio,
  MAX(posts.like / posts.viewNumber) AS popularity,
  SUM(posts.viewNumber) AS totalViews,
  SUM(posts.like) AS totalLikes
FROM
  posts
INNER JOIN
  user ON user.id = posts.userID
GROUP BY
  user.username
ORDER BY
  popularity DESC, totalLikes DESC$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getUserByID`(IN `id` INT)
SELECT `user`.`id`, `user`.`username`, `user`.`email`, `user`.`bio`, `user`.`profilePicture`, `user`.`level`
FROM `user`
WHERE `user`.`id` = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `getUserByUsername`(IN `username` VARCHAR(100))
SELECT `user`.`id`, `user`.`username`, `user`.`email`, `user`.`bio`,files.url,files.id AS "fileid", `user`.`level`
FROM `user`
LEFT JOIN files on files.id = user.profilePicture
WHERE `user`.`username` LIKE CONCAT(CONCAT('%', username),'%')$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `login`(IN `email` VARCHAR(256), IN `password` CHAR(64))
BEGIN
    DECLARE userCount INT;

    -- Felhasználók számának ellenőrzése
    SET userCount = (SELECT COUNT(*) FROM user WHERE user.email = email AND user.passwd = password AND user.level != "Banned");

    IF userCount > 0 THEN
        -- Felhasználó adatainak lekérdezése
        SELECT * FROM user WHERE user.email = email AND user.passwd = password AND user.level != "Banned";
    ELSE
        -- Hibakezelés, ha nincs ilyen felhasználó
        CALL throwError("Nincs Ilyen User");
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `signup`(IN `username` VARCHAR(255), IN `email` VARCHAR(255), IN `password` CHAR(64))
BEGIN
    IF EXISTS(SELECT 1 FROM user WHERE user.email = email) > 0 THEN
    	CALL throwError("Error Email");
    ELSEIF EXISTS(SELECT 1 FROM user WHERE user.username = username) > 0 THEN
    	CALL throwError("Error UserName");
    ELSE
        -- Ha nem létezik, akkor hozd létre az új felhasználót
        INSERT INTO user (username, email, passwd) VALUES (username, email, password);
        SELECT * FROM user WHERE user.email = email;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `throwError`(IN `message` VARCHAR(255))
BEGIN
    DECLARE ErrorMessage VARCHAR(1000);
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = message;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `updateViewedNotification`(IN `notificationID` INT)
UPDATE notification
SET notification.status = 0
WHERE notification.id = notificationID$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`c38486dbUser`@`localhost` PROCEDURE `userUpdate`(IN `userData` JSON)
BEGIN
    DECLARE id INT(11);
    DECLARE username VARCHAR(256);
    DECLARE email VARCHAR(256);
    DECLARE passwd CHAR(64);
    DECLARE bio TEXT;
    DECLARE profilePicture INT(11);
    DECLARE level VARCHAR(256);
    
    -- Új adatok kinyerése a JSON objektumból
    SET id = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.id'));
    SET username = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.username'));
    SET email = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.email'));
    SET passwd = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.passwd'));
    SET bio = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.bio'));
    SET profilePicture = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.profilePicture'));
    SET level = JSON_UNQUOTE(JSON_EXTRACT(userData, '$.level'));
    
    IF id IS NOT NULL THEN
        IF username IS NOT NULL THEN
            UPDATE user SET user.username = username WHERE user.id = id;
        END IF;
        
        IF email IS NOT NULL THEN
            UPDATE user SET user.email = email WHERE user.id = id;
        END IF;
        
        IF passwd IS NOT NULL THEN
            UPDATE user SET user.passwd = passwd WHERE user.id = id;
        END IF;
        
        IF bio IS NOT NULL THEN
            UPDATE user SET user.bio = bio WHERE user.id = id;
        END IF;
        
        IF profilePicture IS NOT NULL THEN
            UPDATE user SET user.profilePicture = profilePicture WHERE user.id = id;
        END IF;
        
        IF level IS NOT NULL THEN
            UPDATE user SET user.level = level WHERE user.id = id;
        END IF;
        
        SELECT * FROM user WHERE user.id = id;
    ELSE
        CALL throwError("Miss ID");
    END IF;
END$$
DELIMITER ;
