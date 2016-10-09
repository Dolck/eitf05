/* Database Webshop*/

SET foreign_key_checks = 0;
drop table if exists Users;
drop table if exists Orders;
drop table if exists Products;
SET foreign_key_checks = 1;

create table Users(
	username varchar (20) PRIMARY KEY,
	password varchar (255) NOT NULL,
	email varchar (50) NOT NULL,
	forename varchar (30) NOT NULL,
	lastname varchar (30) NOT NULL,
	city varchar (30) NOT NULL,
	street varchar (30) NOT NULL,
	zipcode varchar (30) NOT NULL
);

INSERT INTO Users VALUES ('nolla', '$2y$10$PKDJao3dvi.EGgyR2hwq..62eK0LUzj8eMDxrgDqOP/r2XyD1km4C'/* 'ny123' */, 'dat16hsi@student.lu.se', 'Homer', 'Simpson', 'Springfield', '742 Evergreen Terrace', '58008');

create table Products(
	id int PRIMARY KEY auto_increment,
	name varchar (30) NOT NULL,
	price int NOT NULL,
	description varchar (150) NOT NULL
);

INSERT INTO Products (name, price, description) VALUES ('Råsa Cheps', '30', 'Det klassiska orginalet. Gör alla teknologer avundsjuka med det senaste från LTH:s modekatalog!');
INSERT INTO Products (name, price, description) VALUES ('Lila Cheps', '35', 'En exklusiv variant för att sticka ut ur mängden. Detta lila alternativ lämnar inte en trosa torr.');

create table Orders(
	id int auto_increment PRIMARY KEY,
	username varchar(20),
	p_id int,
	quantity int NOT NULL,
	`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (username) REFERENCES Users(username),
	FOREIGN KEY (p_id) REFERENCES Products(id)

);
