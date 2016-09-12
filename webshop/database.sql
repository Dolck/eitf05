/* Database Webshop*/

SET foreign_key_checks = 0;
drop table if exists users;
SET foreign_key_checks = 1;

create table Users(
	username varchar (20) NOT NULL PRIMARY KEY,
	password varchar (50) NOT NULL,
	email varchar (50) NOT NULL,
	forename varchar (30) NOT NULL,
	lastname varchar (30) NOT NULL,
	city varchar (30) NOT NULL,
	street varchar (30) NOT NULL,
	zipcode varchar (30) NOT NULL
);

create table Orders(
	id int NOT NULL PRIMARY KEY,
	user,
	p_id,
	nbr int AUTOINCREMENT,
	quantity int NOT NULL,
	FOREIGN KEY (user) REFERENCES Users (username),
	FOREIGN KEY (p_id) REFERENCES Products (id)
);

create table Products(
	id int PRIMARY KEY AUTOINCREMENT,
	name varchar (30) NOT NULL,
	price int NOT NULL
);