﻿use company;

#创建职工账户信息
create table account(
 accountId int unsigned not null primary key,
 name char(10) not null,
 position tinyint not null
);
create table accountlogin(
 id int unsigned not null auto_increment,
 accountId int unsigned not null,
 username char(30) not null,
 password char(60) not null,
 primary key(id, accountId)
);
#创建产品列表
create table product_info(
 id int unsigned not null auto_increment primary key,
 pro_id char not null,
 unit varchar(6) not null,
 brand varchar(20) not null
)engine=InnoDB;
#创建合同列表
create table contract(
 contract_id char  not null unique primary key,
 customer_id int(5) references customer_information(customer_id),
 amount float(7,2),
 accountId int unsigned not null,
 date date not null,
 remarks tinytext
)engine=InnoDB;
create table contract_list(
 contract_id char not null unique references contract(contract_id),
 pro_id char not null references product_info(pro_id),
 pro_price float(7,2) not null,
 quantity tinyint unsigned not null,
 mindelivery int(10) default 0,
 maxdelivery int(10) not null default 0,
 state int(1) not null default 0,
 primary key(contract_id, pro_id)
)engine=InnoDB;
create table billing_information(
 customer_id int(5) primary key unique references customer_information(customer_id),
 name varchar(60) not null,
 address varchar(100) not null,
 bankNumber varchar(30) not null,
 tell varchar(15) not null,
 bankName varchar(20) not null,
 ITIN varchar(20) not null
)engine=InnoDB;