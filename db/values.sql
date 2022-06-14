
PRAGMA foreign_keys = ON;



-- TODO: All passwords are 1234 in SHA-1 format
INSERT INTO users VALUES (1000,'Dominic Woods', 'woofs', '1234', '/img/woofs.png', 'dominic@gmail.com', '989273829', 'Doggos are fun');
INSERT INTO users VALUES (1001,'Zachary Young', 'meow', '0000', '/img/cats/cutecat_1.jpg', 'meowmeow@gmail.com', '234232353', 'Meow');
INSERT INTO users VALUES (1002,'Alicia Hamilton', 'assertiva', 'aaaa', '/img/assertiva.png', 'alicia@gmail.com', '827382628' , 'Adopt them, quick');
INSERT INTO users VALUES (1003,'Abril Cooley', 'covid', 'cv19', '/img/covid.png', 'coughcough@gmail.com', '808242424', 'Pets are awecome');


INSERT INTO pet VALUES (1000,'Flyer',1,4,'Dog','M','brown','A cute doggo','/img/dogs/cutedog_1.jpg');
INSERT INTO pet VALUES (1001,'Fifi',2,2,'Cat','S','black', 'Meow Meow', '/img/cats/cutecat_2.jpg');
INSERT INTO pet VALUES (1001,'Johnny',3,6,'Rabbit','M','yellow', 'Carrots!', '/img/rabbits/acacia_1.jpg');
INSERT INTO pet VALUES (1002,'Cinder',4,1,'Cat','S','grey','Give me sardines', '/img/cats/cutecat_4.jpg');


INSERT INTO photo VALUES ('../img/dogs/cutedog_3.jpg',1);
INSERT INTO photo VALUES ('../img/cats/cutecat_8.jpg',2);
INSERT INTO photo VALUES ('../img/cats/cutecat_9.jpg',2);
INSERT INTO photo VALUES ('../img/rabbits/Johnny_1.jpg',3);
INSERT INTO photo VALUES ('../img/cats/cutecat_7.jpg',4);
