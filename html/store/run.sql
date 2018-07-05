create database store;
use store;

create table users (
	id int(10) unsigned auto_increment primary key not null,
	name varchar(50) not null,
	email varchar(50),
	cep char(9),
	logradouro varchar(100),
	complemento varchar(50),
	bairro varchar(50),
	cidade varchar(30),
	estado char(2), # sigla: RJ
	hashpw varchar(50),
	utype int, # regular user: 0; admin: 1
	created timestamp default current_timestamp()
);

/*create table users_log (
	id int(10) unsigned auto_increment primary key not null,
	usid int(10),
	query_done varchar(100),
	dtdone timestamp default current_timestamp()
);*/

create table products(
	id int(10) unsigned auto_increment primary key not null,
	name varchar(50) not null,
	stock int(10),
	description varchar(1000),
	price float
	#created timestamp default current_timestamp(),
	#last_update timestamp default current_timestamp()
);

create table orders(
	id int(10) unsigned auto_increment primary key not null,
	usid int(10),
	payment_status char(10),
	created timestamp default current_timestamp()
);

create table ord_details (
	id int(10) unsigned auto_increment primary key not null,
	orid int(10),
	prid int(10),
	pprice float, # order price can't be different from current price (eg. discount)
	qty int(10)
);