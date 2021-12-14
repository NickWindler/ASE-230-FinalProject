-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 10:01 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

--
-- Database: `tofoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_primary` tinyint(1) NOT NULL,
  `street` varchar(75) NOT NULL,
  `city` varchar(60) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `state` varchar(50) NOT NULL,
  `delivery_instructions` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`ID`, `user_id`, `is_primary`, `street`, `city`, `zip`, `state`, `delivery_instructions`) VALUES
(5, 15, 0, 'Main Street', 'Big City', '12345', 'KY', NULL),
(10, 15, 1, '234 Elm Street', 'Louisville', '53721', 'KY', 'Do not ring doorbell');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `ID` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image_url` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`ID`, `restaurant_id`, `name`, `price`, `description`, `image_url`) VALUES
(5, 5, 'Chicken Alfredo', '17.99', 'This homemade sauce combines simple, fresh ingredients like butter, cream and parmesan cheese to make a rich topping to our fettuccine pasta', 'https://media.olivegarden.com/en_us/images/product/classic-chicken-alfredo-dinner-dpv-590x365.jpg'),
(10, 5, 'Chicken Parmigiana', '16.79', 'Two lightly fried parmesan-breaded chicken breasts are smothered with Olive Garden’s homemade marinara sauce and melted Italian cheeses.', 'https://media.olivegarden.com/en_us/images/product/dinner-chicken-parm-dpv-590x365.jpg'),
(15, 5, 'Lasagna Classico', '15.79', 'Prepared fresh daily with layers of pasta, parmesan, mozzarella, pecorino romano and our homemade meat sauce.', 'https://media.olivegarden.com/en_us/images/product/lasagna-classico-dpv-1180x730.png'),
(20, 10, 'Goodfella', '19.99', 'A meaty pie suitable for any gangster with pepperoni, Italian rope sausage, ground beef, and bacon.', 'https://goodfellas-pizzeria.square.site/uploads/1/2/7/5/127545638/s884673856506028148_p112_i3_w640.jpeg'),
(25, 10, 'The Boss', '30.00', 'Calling the shots with chicken, tomatoes, onions, bacon, and drizzled ranch.', 'https://goodfellas-pizzeria.square.site/uploads/1/2/7/5/127545638/s884673856506028148_p272_i3_w640.jpeg'),
(30, 10, 'Fuhgetaboutit', '39.99', 'Every available topping... Fuhgetaboutit!', 'https://goodfellas-pizzeria.square.site/uploads/1/2/7/5/127545638/s884673856506028148_p191_i3_w640.jpeg'),
(35, 15, 'Some Noodles', '15.67', 'Some noodles... I am not sure they hardly have anything on their site.', 'https://pompilios.com/wp-content/uploads/2015/03/Screen-shot-2012-07-02-at-12.20.35-PM.png'),
(40, 20, 'Fancy Noodles', '29.99', 'Fancy noodles with toppings.', 'https://cdn.citybeat.com/files/base/scomm/cb/image/2016/08/640w/Eats2_Sotto_Lunch_Bottarga.57a22bc248f2e.jpg'),
(45, 20, 'Pasta', '25.79', 'Expensive for such a small serving.', 'https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fstatic.onecms.io%2Fwp-content%2Fuploads%2Fsites%2F9%2F2014%2F02%2Foriginal-201401-HD-cincinnati-in-10-plates-sotto-amatriciana.jpg'),
(50, 20, 'Meat and Peas', '45.00', 'Meat and Peas, that is all.', 'https://media-cdn.tripadvisor.com/media/photo-s/0c/a3/80/66/photo1jpg.jpg'),
(55, 25, 'Cheeseburger', '6.79', 'Two slices of Kraft American cheese melted between a pair of fresh patties and placed on a soft, toasted sesame seed bun.', 'https://preview.redd.it/5n8qjr2kfd531.jpg?auto=webp&s=d2a192139c314543363797af509771461579606b'),
(60, 25, 'Little Hamburger', '4.99', 'It is like a hamburger except smaller.', 'https://1.bp.blogspot.com/-UI84rpUfPlk/VG0vWvfg7pI/AAAAAAAAiO4/RVIig64oTK0/s1600/five-guys-little-bacon-cheeseburger-front.jpg'),
(65, 25, 'Cheese Dog', '6.99', 'Not made with an actual dog.', 'https://i2.wp.com/eatawienertoday.com/wp-content/uploads/2017/09/five-guys-bacon-cheese-hot-dog-1-e1506530563113.jpg'),
(70, 30, 'Classic Smash', '5.49', 'Certified Angus Beef, American cheese, lettuce, tomatoes, red onions, pickles, Smash Sauce®, ketchup, toasted bun.', 'https://1sbnfv2h0tci3kwvug47tobt-wpengine.netdna-ssl.com/wp-content/uploads/2020/09/Beef_Classic-Smash-Single_Web-286x215.png'),
(75, 30, 'Bacon Cheddar Burger', '7.49', 'Certified Angus Beef, aged cheddar cheese, applewood smoked bacon, haystack onions, bbq sauce, toasted bun.', 'https://1sbnfv2h0tci3kwvug47tobt-wpengine.netdna-ssl.com/wp-content/uploads/2020/09/Beef_BBQ-Bacon-Cheddar-Single_Web-286x215.png'),
(80, 30, 'Bacon Smash Burger', '7.49', 'Certified Angus Beef, American cheese, applewood smoked bacon, lettuce, tomatoes, mayo, toasted bun.', 'https://1sbnfv2h0tci3kwvug47tobt-wpengine.netdna-ssl.com/wp-content/uploads/2020/09/Beef_Bacon-Smash-Single_Web-286x215.png'),
(85, 35, 'Orange Chicken', '9.99', 'Came straight from an orange chicken.', 'https://dinnerthendessert.com/wp-content/uploads/2017/08/Panda-Express-Orange-Chicken-8-.jpg'),
(90, 35, 'Kung Pao Chicken', '8.99', 'Came straight from a high ranking general chicken.', 'https://drivemehungry.com/wp-content/uploads/2019/09/panda-express-kung-pao-chicken-2-1.jpg'),
(95, 35, 'Beef and Broccoli', '9.49', 'It is as the name suggests.', 'https://dinnerthendessert.com/wp-content/uploads/2016/02/Panda-Express-Beef-and-Broccoli-3-500x453.jpg'),
(100, 40, 'Cool Lettuce Wraps', '8.99', 'The Coolest Lettuce Around.', 'https://yangkeenoodle.com/wp-content/uploads/2018/09/ykn-lettucewrap-menu-tom-200x200.png'),
(105, 40, 'Orange Chicken', '10.19', 'Crispy Chicken, Carrots, Pea Pods, White Rice or Brown Rice.', 'https://yangkeenoodle.com/wp-content/uploads/2018/09/ykn-orangechicken-menu-tom-200x200.png'),
(110, 40, 'Mongolian Stir-Fry', '10.19', 'Chicken, Broccoli, Mushrooms, Onions, White Rice or Brown Rice, Garlic Soy Sauce.', 'https://yangkeenoodle.com/wp-content/uploads/2018/09/ykn-mongolian-menu-tom-200x200.png'),
(115, 45, 'Rice and Other Stuff', '7.99', 'This is all you are going to get for this restaurant.', 'https://nitthasiamkitchen.files.wordpress.com/2016/11/food.jpg?w=600&h=400&crop=1'),
(120, 50, 'A lot of Tacos', '49.99', 'But it is not even Tuesday.', 'https://s3-media0.fl.yelpcdn.com/bphoto/gEgdvSW0jBNeOGkdRJXPag/348s.jpg'),
(125, 50, 'Shrimp Tacos', '11.99', 'I wonder how the shrimp wound up there.', 'https://s3-media0.fl.yelpcdn.com/bphoto/A_Cro3kT5IOeE1ueY3lKPQ/348s.jpg'),
(130, 50, 'Fancy Dessert', '17.33', 'Very fancy.', 'https://media-cdn.tripadvisor.com/media/photo-s/0e/b1/2b/16/photo2jpg.jpg'),
(135, 55, 'Rice and Food', '14.99', 'There is rice with a lot of other stuff mixed in there.', 'https://media-cdn.tripadvisor.com/media/photo-p/13/e0/77/f4/photo0jpg.jpg'),
(140, 55, 'Mexican Food', '12.16', 'I wish restaurants would have convenient menus for this project.', 'https://3.bp.blogspot.com/-DAgXPn4UoXc/UEy4dCkA93I/AAAAAAAAFuk/itjen5KhZs8/s1600/20120813_221637.jpg'),
(145, 60, 'Baja Nachos', '10.00', 'Steak, Nachos, Queso, etc...', 'https://media-cdn.tripadvisor.com/media/photo-s/0d/a0/19/a7/nachos-mexicanos.jpg'),
(150, 60, 'Tacos and Rice', '1.00', 'The good stuff.', 'https://media-cdn.tripadvisor.com/media/photo-s/0d/a0/19/4b/it-s-a-mexican-dishdon.jpg'),
(155, 5, 'Tour of Italy', '18.99', 'Three OG classics all on one plate!', 'https://media.olivegarden.com/en_us/images/product/Tour-of-Italy-dpv1180X730.jpg'),
(160, 5, 'Cheese Ravioli', '13.99', 'Filled with a blend of indulgent Italian cheeses, topped with your choice homemade marinara or meat sauce** and melted mozzarella.', 'https://media.olivegarden.com/en_us/images/product/Cheese-Ravioli-dpv-1180x730.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meals_orders`
--

CREATE TABLE `meals_orders` (
  `ID` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `meal_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `security_code` varchar(4) NOT NULL,
  `expiration_date` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `user_id`, `card_number`, `security_code`, `expiration_date`) VALUES
(5, 15, '4762908514526735', '634', '01/24');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `ID` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) NOT NULL,
  `street` varchar(75) NOT NULL,
  `city` varchar(60) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `state` varchar(50) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `image_url` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`ID`, `type_id`, `name`, `street`, `city`, `zip`, `state`, `rating`, `image_url`) VALUES
(5, 5, 'Olive Garden', '475 Ohio Pike', 'Cincinnati', '45255', 'OH', '4.3', 'https://media.olivegarden.com/en_us/images/marketing/italian-family-restaurant-olive-garden-g6-rdv.jpg'),
(10, 5, 'Goodfellas Pizza', '603 Main St', 'Covington', '41011', 'KY', '4.6', 'https://goodfellasusa.com/fts-content/uploads/sites/160/2020/05/loc_vic1.jpg'),
(15, 5, 'Pompilios', '600 Washington Ave', 'Newport', '41071', 'KY', '4.4', 'https://s3-media0.fl.yelpcdn.com/bphoto/BewbdlUAPSXXf_JPJYJAvA/l.jpg'),
(20, 5, 'Sotto', '118 E 6th St', 'Cincinnati', '45202', 'OH', '4.7', 'http://www.onlyinyourstate.com/wp-content/uploads/2017/07/sotto.jpg'),
(25, 10, 'Five Guys', '4226 Shelbyville Rd', 'Louisville', '40207', 'KY', '4.4', 'https://s3.amazonaws.com/cloconnect-paddock/uploads/41a54afb19379627e4e5e25f19cf9421.jpg'),
(30, 10, 'Smash Burger', '2517 Wilson Ave', 'Highland Heights', '41076', 'KY', '4.0', 'https://media-cdn.tripadvisor.com/media/photo-s/0a/c1/1a/c1/store-front.jpg'),
(35, 15, 'Panda Express', '6805 Houston Rd', 'Florence', '41042', 'KY', '3.8', 'https://media-cdn.tripadvisor.com/media/photo-s/1c/d2/e6/03/panda-express-avon-on.jpg'),
(40, 15, 'Yang Kee Noddle', '13301 Shelbyville Rd', 'Louisville', '40223', 'KY', '4.2', 'https://yangkeenoodle.com/wp-content/uploads/2017/04/Middletown_600x400px.jpg'),
(45, 15, 'Nittha Siam Kitchen', '2415 Alexandria Pike', 'Highland Heights', '41076', 'KY', '4.6', 'https://s3-media0.fl.yelpcdn.com/bphoto/7IFNnngvifHLE2-HvbaG-w/l.jpg'),
(50, 20, 'Gustavos Mexican Grill', '1226 Market St', 'LaGrange', '40031', 'KY', '4.8', 'https://indulgery-a0f0.netdna-ssl.com/listing_images/1200x600/104730_ec7413f269525a7aca9d4e5ae99350c6.jpg'),
(55, 20, 'El Nopal', '412 S 1st St', 'LaGrange', '40031', 'KY', '4.4', 'https://fastly.4sqi.net/img/general/600x600/ENA2JY5ST4YMIFX3ZF4X4Q4GTVFNBHPESYB5PVVQU2P54ESC.jpg'),
(60, 20, 'El Acapulco', '1004 Grange Dr', 'LaGrange', '40031', 'KY', '4.5', 'https://media-cdn.tripadvisor.com/media/photo-s/0d/30/03/e7/el-acapulco.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`ID`, `name`) VALUES
(5, 'Italian'),
(10, 'American'),
(15, 'Chinese'),
(20, 'Mexican');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(16) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `first_name`, `last_name`, `email`, `password`, `phone`, `role`) VALUES
(5, 'Admin', 'User', 'admin@gmail.com', 'admin', '111-111-1111', 1),
(10, 'Normal', 'User', 'nuser@gmail.com', 'notanadmin', '123-456-7890', 0),
(15, 'Data', 'User', 'duser@gmail.com', 'datauser', '923-456-8242', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `meals_orders`
--
ALTER TABLE `meals_orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `meal_id` (`meal_id`),
  ADD KEY `order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `meals_orders`
--
ALTER TABLE `meals_orders`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meals_orders`
--
ALTER TABLE `meals_orders`
  ADD CONSTRAINT `meals_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meals_orders_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
