INSERT INTO bookstore.products (price, product_name, product_img_dir)
VALUES (100, 'something', 'C:/img/photo.png');

INSERT INTO bookstore.products (price, product_name, product_img_dir)
VALUES (20, 'badDog', 'C:/img/dog.png');

INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES (30, 'captain underpants', 'C:/img/captain_underpants.jpg');

INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES ('10', 'educated', 'C:/img/educated.jpg');


INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES ('5', 'nancy clancy', 'C:/img/fancy_nancy.jpg');

INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES ('0', 'meghan a hollywood princess', 'C:/img/meghan.jpg');

INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES ('1000', 'pokemon the official adventure guide', 'C:/img/pokeman.jpg');

INSERT INTO `bookstore`.`products` (`price`, `product_name`, `product_img_dir`) 
VALUES ('9999', 'robin', 'C:/img/robin.jpg');


SELECT * FROM bookstore.products;