-- MySQL dump 10.13  Distrib 8.0.39, for Win64 (x86_64)
--
-- Host: localhost    Database: recipebook
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('viyalagoda229@gmail.com','679cebc645b3f');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(45) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Appetizers'),(2,'Main Courses'),(3,'Desserts'),(4,'Soups and Stews'),(5,'Salads'),(6,'Breakfast and Brunch'),(7,'Beverages'),(8,'Side Dishes'),(9,'Snacks'),(10,'Sauces and Condiments');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `recipe_recipeId` int NOT NULL,
  `user_username` varchar(45) NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `fk_comment_recipe1_idx` (`recipe_recipeId`),
  KEY `fk_comment_user1_idx` (`user_username`),
  CONSTRAINT `fk_comment_recipe1` FOREIGN KEY (`recipe_recipeId`) REFERENCES `recipe` (`recipeId`),
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'Nice.',2,'hash'),(2,'Goood!',1,'hash'),(3,'Hmmm !!!',6,'hash'),(4,'good.',5,'dil');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactus` (
  `massageId` int NOT NULL AUTO_INCREMENT,
  `senderEmail` varchar(100) NOT NULL,
  `contain` text,
  `dateTime` datetime NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`massageId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactus`
--

LOCK TABLES `contactus` WRITE;
/*!40000 ALTER TABLE `contactus` DISABLE KEYS */;
INSERT INTO `contactus` VALUES (1,'viyalagoda229@gmail.com','Hi','2025-01-31 09:03:44',0),(2,'viyalagoda229@gmail.com','How are you?','2025-01-31 09:08:09',0),(3,'viyalagoda240@gmail.com','Who are you ?','2025-01-31 09:08:52',0),(4,'viyalagoda228@gmail.com','How to make a user account in recipe book?','2025-01-31 09:44:55',0),(5,'viyalagoda240@gmail.com','Hi!','2025-01-31 11:40:22',0),(6,'viyalagoda229@gmail.com','Hello !!!','2025-01-31 17:00:12',0),(7,'viyalagoda229@gmail.com','Hello !!!','2025-01-31 18:20:00',0);
/*!40000 ALTER TABLE `contactus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactusreply`
--

DROP TABLE IF EXISTS `contactusreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactusreply` (
  `contactUsReplyId` int NOT NULL AUTO_INCREMENT,
  `contain` text,
  `dateTime` datetime NOT NULL,
  `contactUs_massageId` int NOT NULL,
  PRIMARY KEY (`contactUsReplyId`),
  KEY `fk_contactUsReply_contactUs1_idx` (`contactUs_massageId`),
  CONSTRAINT `fk_contactUsReply_contactUs1` FOREIGN KEY (`contactUs_massageId`) REFERENCES `contactus` (`massageId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactusreply`
--

LOCK TABLES `contactusreply` WRITE;
/*!40000 ALTER TABLE `contactusreply` DISABLE KEYS */;
INSERT INTO `contactusreply` VALUES (1,'Hi !','2025-01-31 11:08:27',1),(2,'How are you ?','2025-01-31 11:09:15',1),(3,'Good. What about you?','2025-01-31 11:10:07',2),(4,'Admin','2025-01-31 11:39:15',3),(5,'Hi!','2025-01-31 11:40:49',5),(6,'Hi!!!','2025-01-31 17:00:58',6),(7,'Go to the Sign Up','2025-01-31 18:22:27',4),(8,'Hello how can i help you?','2025-01-31 18:29:37',7),(9,'Hi!','2025-01-31 18:35:27',3),(10,'Hi!','2025-01-31 18:38:33',2);
/*!40000 ALTER TABLE `contactusreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `ingredientsId` int NOT NULL AUTO_INCREMENT,
  `ingredient` varchar(100) NOT NULL,
  `recipe_recipeId` int NOT NULL,
  PRIMARY KEY (`ingredientsId`),
  KEY `fk_ingredients_recipe1_idx` (`recipe_recipeId`),
  CONSTRAINT `fk_ingredients_recipe1` FOREIGN KEY (`recipe_recipeId`) REFERENCES `recipe` (`recipeId`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Baguette',1),(2,'Butter',1),(3,'Garlic',1),(4,'Spaghetti',2),(5,'Ground beef',2),(6,'Tomato sauce',2),(7,'Flour',3),(8,'Sugar',3),(9,'Cocoa powder',3),(10,'Tomatoes',4),(11,'Onion',4),(12,'Garlic',4),(13,'Romaine lettuce',5),(14,'Croutons',5),(15,'Caesar dressing',5),(16,'Flour',6),(17,'Eggs',6),(18,'Milk',6),(19,'Lemons',7),(20,'Sugar',7),(21,'Water',7),(22,'Potatoes',8),(23,'Butter',8),(24,'Milk',8),(25,'Popcorn kernels',9),(26,'Butter',9),(27,'Salt',9),(28,'Tomato paste',10),(29,'Vinegar',10),(30,'Sugar',10),(31,'1 pizza dough (store-bought or homemade)',11),(32,'1/2 cup tomato sauce',11),(33,'1 cup fresh mozzarella, sliced',11),(34,'Fresh basil leaves',11),(35,'1 tbsp olive oil',11),(36,'Salt to taste',11),(37,'4 oz (115 g) semi-sweet chocolate',12),(38,'1/2 cup (115 g) unsalted butter',12),(39,'1/4 cup (50 g) granulated sugar',12),(40,'2 large eggs',12),(41,'2 large egg yolks',12),(42,'1/4 cup (30 g) all-purpose flour',12),(43,'A pinch of salt',12),(44,'2 tbsp olive oil',13),(45,'1 medium onion, diced',13),(46,'2 garlic cloves, minced',13),(47,'4 cups canned tomatoes (or fresh, chopped)',13),(48,'2 cups vegetable broth',13),(49,'1 cup heavy cream',13),(50,'1/4 cup fresh basil, chopped',13);
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruction`
--

DROP TABLE IF EXISTS `instruction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instruction` (
  `instructionId` int NOT NULL AUTO_INCREMENT,
  `instruction` text NOT NULL,
  `step` varchar(45) NOT NULL,
  `recipe_recipeId` int NOT NULL,
  PRIMARY KEY (`instructionId`),
  KEY `fk_instruction_recipe1_idx` (`recipe_recipeId`),
  CONSTRAINT `fk_instruction_recipe1` FOREIGN KEY (`recipe_recipeId`) REFERENCES `recipe` (`recipeId`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruction`
--

LOCK TABLES `instruction` WRITE;
/*!40000 ALTER TABLE `instruction` DISABLE KEYS */;
INSERT INTO `instruction` VALUES (1,'Cook spaghetti.','1',1),(2,'Brown beef, add sauce.','2',1),(3,'Combine and serve.','3',1),(4,'Cook spaghetti.','1',2),(5,'Brown beef, add sauce.','2',2),(6,'Combine and serve.','3',2),(7,'Mix ingredients in a mug.','1',3),(8,'Microwave for 1 minute.','2',3),(9,'Sauté onion and garlic.','1',4),(10,'Add tomatoes and simmer.','2',4),(11,'Blend until smooth.','3',4),(12,'Toss lettuce with dressing.','1',5),(13,'Add croutons and serve.','2',5),(14,'Mix ingredients.','1',6),(15,'Cook on a griddle.','2',6),(16,'Mix lemon juice, sugar, and water.','1',7),(17,'Serve over ice.','2',7),(18,'Boil potatoes.','1',8),(19,'Mash with butter and milk.','2',8),(20,'Heat kernels until popped.','1',9),(21,'Toss with butter and salt.','2',9),(22,'Mix ingredients in a saucepan.','1',10),(23,'Simmer until thickened.','2',10),(24,'Preheat the oven to 475°F (245°C).','1',11),(25,'Roll out the pizza dough onto a lightly floured surface.','2',11),(26,'Spread tomato sauce evenly over the dough.','3',11),(27,'Top with slices of mozzarella and basil leaves.','4',11),(28,'Drizzle olive oil on top and sprinkle with a pinch of salt.','5',11),(29,'Bake in the oven for 10-12 minutes or until the crust is golden and the cheese is bubbling.','6',11),(30,'Remove from the oven, slice, and serve.','7',11),(31,'Preheat the oven to 425°F (220°C). Grease and flour 4 ramekins.','1',12),(32,'Melt chocolate and butter together in a double boiler or microwave, stirring until smooth.','2',12),(33,'In a separate bowl, whisk eggs, egg yolks, and sugar until pale and thick.','3',12),(34,'Fold in the melted chocolate mixture.','4',12),(35,'Sift in flour and salt, and gently mix until combined.','5',12),(36,'Pour the batter into the prepared ramekins.','6',12),(37,'Bake for 12-14 minutes, or until the edges are firm but the center is soft.','7',12),(38,'Let cool for 1 minute, then invert onto a plate and serve warm.','8',12),(39,'Heat olive oil in a large pot over medium heat. Add onion and garlic, cooking until soft.','1',13),(40,'Add tomatoes and broth, and simmer for 15 minutes.','2',13),(41,'Use an immersion blender to puree the soup until smooth (or transfer to a blender in batches).','3',13),(42,'Stir in cream and basil, and season with salt and pepper.','4',13),(43,'Simmer for another 5 minutes, then serve hot.','5',13);
/*!40000 ALTER TABLE `instruction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe` (
  `recipeId` int NOT NULL AUTO_INCREMENT,
  `recipeName` varchar(100) NOT NULL,
  `user_username` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`recipeId`),
  KEY `fk_recipe_user1_idx` (`user_username`),
  CONSTRAINT `fk_recipe_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (1,'Garlic Bread','dil','1'),(2,'Spaghetti Bolognese','dil','1'),(3,'Chocolate Mug Cake','dil','1'),(4,'Tomato Soup','dil','1'),(5,'Caesar Salad','dil','1'),(6,'Pancakes','dil','1'),(7,'Lemonade','dil','1'),(8,'Mashed Potatoes','dil','1'),(9,'Popcorn','dil','1'),(10,'Homemade Ketchup','hash','1'),(11,'Classic Margherita Pizza','hash','1'),(12,'Chocolate Lava Cake','hash','1'),(13,'Creamy Tomato Basil Soup','hash','1');
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_has_category`
--

DROP TABLE IF EXISTS `recipe_has_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_has_category` (
  `recipe_has_categoryId` int NOT NULL AUTO_INCREMENT,
  `recipe_recipeId` int NOT NULL,
  `category_categoryId` int NOT NULL,
  PRIMARY KEY (`recipe_has_categoryId`),
  KEY `fk_recipe_has_category_category1_idx` (`category_categoryId`),
  KEY `fk_recipe_has_category_recipe_idx` (`recipe_recipeId`),
  CONSTRAINT `fk_recipe_has_category_category1` FOREIGN KEY (`category_categoryId`) REFERENCES `category` (`categoryId`),
  CONSTRAINT `fk_recipe_has_category_recipe` FOREIGN KEY (`recipe_recipeId`) REFERENCES `recipe` (`recipeId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_has_category`
--

LOCK TABLES `recipe_has_category` WRITE;
/*!40000 ALTER TABLE `recipe_has_category` DISABLE KEYS */;
INSERT INTO `recipe_has_category` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,4,8),(6,4,10),(7,5,5),(8,5,8),(9,6,6),(10,6,8),(11,7,1),(12,7,3),(13,7,7),(14,7,8),(15,8,3),(16,8,8),(17,9,8),(18,9,9),(19,10,8),(20,10,10),(21,11,2),(22,11,9),(23,12,3),(24,12,8),(25,13,4),(26,13,8);
/*!40000 ALTER TABLE `recipe_has_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipepic`
--

DROP TABLE IF EXISTS `recipepic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipepic` (
  `recipePicId` int NOT NULL AUTO_INCREMENT,
  `recipePicture` text NOT NULL,
  `recipe_recipeId` int NOT NULL,
  PRIMARY KEY (`recipePicId`),
  KEY `fk_recipePic_recipe1_idx` (`recipe_recipeId`),
  CONSTRAINT `fk_recipePic_recipe1` FOREIGN KEY (`recipe_recipeId`) REFERENCES `recipe` (`recipeId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipepic`
--

LOCK TABLES `recipepic` WRITE;
/*!40000 ALTER TABLE `recipepic` DISABLE KEYS */;
INSERT INTO `recipepic` VALUES (1,'resource/recipeImg/Garlic Bread_678e740c3052d.jpeg',1),(2,'resource/recipeImg/Garlic Bread_678e740c31c2c.jpeg',1),(3,'resource/recipeImg/Garlic Bread_678e740c33141.jpeg',1),(4,'resource/recipeImg/Spaghetti Bolognese_678e7c3faaead.jpeg',2),(5,'resource/recipeImg/Spaghetti Bolognese_678e7c3fac34a.jpeg',2),(6,'resource/recipeImg/Spaghetti Bolognese_678e7c3fad533.jpeg',2),(7,'resource/recipeImg/Chocolate Mug Cake_678e7cfced91b.jpeg',3),(8,'resource/recipeImg/Chocolate Mug Cake_678e7cfceec02.jpeg',3),(9,'resource/recipeImg/Tomato Soup_678e7f36921c8.jpeg',4),(10,'resource/recipeImg/Tomato Soup_678e7f3693498.jpeg',4),(11,'resource/recipeImg/Caesar Salad_678e7fe205523.jpeg',5),(12,'resource/recipeImg/Caesar Salad_678e7fe206790.jpeg',5),(13,'resource/recipeImg/Pancakes_678f31455f6bb.jpeg',6),(14,'resource/recipeImg/Pancakes_678f31456052c.jpeg',6),(15,'resource/recipeImg/Lemonade_678f325f2ed1a.jpeg',7),(16,'resource/recipeImg/Lemonade_678f325f2fef3.jpeg',7),(17,'resource/recipeImg/Mashed Potatoes_678f34c3a9572.jpeg',8),(18,'resource/recipeImg/Mashed Potatoes_678f34c3ab88e.jpeg',8),(19,'resource/recipeImg/Popcorn_678f3632a5674.jpeg',9),(20,'resource/recipeImg/Popcorn_678f3632a6773.jpeg',9),(21,'resource/recipeImg/Homemade Ketchup_678f39eb17a44.jpeg',10),(22,'resource/recipeImg/Homemade Ketchup_678f39eb18d48.jpeg',10),(23,'resource/recipeImg/Homemade Ketchup_678f39eb19a40.jpeg',10),(24,'resource/recipeImg/Classic Margherita Pizza_678f3ecca4784.jpeg',11),(25,'resource/recipeImg/Classic Margherita Pizza_678f3ecca5852.jpeg',11),(26,'resource/recipeImg/Chocolate Lava Cake_678f3ff7a287d.jpeg',12),(27,'resource/recipeImg/Chocolate Lava Cake_678f3ff7a38a4.jpeg',12),(28,'resource/recipeImg/Creamy Tomato Basil Soup_678f410a487bf.jpeg',13),(29,'resource/recipeImg/Creamy Tomato Basil Soup_678f410a49693.jpeg',13);
/*!40000 ALTER TABLE `recipepic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reply` (
  `replyId` int NOT NULL AUTO_INCREMENT,
  `replycontent` text,
  `comment_commentId` int NOT NULL,
  PRIMARY KEY (`replyId`),
  KEY `fk_reply_comment1_idx` (`comment_commentId`),
  CONSTRAINT `fk_reply_comment1` FOREIGN KEY (`comment_commentId`) REFERENCES `comment` (`commentId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
INSERT INTO `reply` VALUES (1,'Thanks.',1),(2,'Thank you lot!.',1),(3,'Thanks',2),(4,'Thanks.',3),(5,'Hi!',2),(6,'Nice.',2),(7,'Thank you very much',2);
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `profilePic` text,
  `status` varchar(45) DEFAULT NULL,
  `verificationCode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('dil','Dilshan','Udesh','12345','viyalagoda229@gmail.com','0714230844','resource/profilePic/dil.jpeg','1','679a6bf31824a'),('hash','Hashan','Rangan','12345','viyalagoda240@gmail.com','0704464510',NULL,'0',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22 14:00:43
