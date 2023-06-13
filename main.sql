.header on
.mode column

CREATE TABLE shop (
  Id INT PRIMARY KEY,
  name TEXT,
  adress TEXT
);

INSERT INTO shop VALUES
  (1,'Magnit', 'Moscow'),
  (2,'Perek', 'Spb'),
  (3,'Avokado', 'Rostov'),
  (4,'Azbuka', 'NN'),
  (5,'Diksi', 'Voronezh');

CREATE TABLE product (
  Id INT PRIMARY KEY,
  productId INT,
  name TEXT,
  price TEXT,
  counts INT,
  FOREIGN KEY (productId) REFERENCES shop (Id)
);

INSERT INTO product VALUES
  (1,10,'Banan', '100', 5),
  (2,20,'Apple', '200', 15),
  (3,30,'Grape', '250', 25),
  (4,40,'Milk', '350', 35),
   (5,50,'Bread', '50', 45);

CREATE TABLE orders (
  Id INT PRIMARY KEY,
  orderId INT,
  created_at DATETIME,
  FOREIGN KEY (orderId) REFERENCES shop (Id),
  FOREIGN KEY (orderId) REFERENCES client (Id)
);

INSERT INTO orders VALUES
  (01,1,'2008-10-24 09:37:22'),
  (02,2,'2008-10-25 08:37:22'),
  (03,3,'2008-10-26 11:37:22'),
  (04,4,'2008-10-27 12:37:22'),
  (05,5,'2008-10-28 13:37:22');

CREATE TABLE order_product (
Id INT PRIMARY KEY, 
orderId INT, 
FOREIGN KEY (orderId) REFERENCES product (Id),
FOREIGN KEY (orderId) REFERENCES orders (orderId)
);

CREATE TABLE client (
  Id INT PRIMARY KEY,
  name TEXT,
  phone TEXT
);

INSERT INTO client VALUES
  (1,'Andrey', '88007775577'),
  (2,'Viktor', '88006665577'),
  (3,'Sergey', '88008885577'),
  (4,'Oleg', '88009995577'),
  (5,'Maksim', '88001115577');
