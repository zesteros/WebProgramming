
drop database electronica;
create database electronica;
use electronica;
select * from mysql.user;
 DROP USER 'adm'@'localhost';
  DROP USER 'kualimecatronica'@'localhost';
  CREATE USER 'kualimecatronica'@'localhost'
  IDENTIFIED /*WITH sha256_password*/ BY 'circuitointegrado';
  GRANT ALL PRIVILEGES ON electronica.* TO 'kualimecatronica'@'localhost';
  select host, user, password from mysql.user;

  
create table user(
	id_user NUMERIC not null, 
    firstname VARCHAR(50),
    lastname varchar(50),
    email varchar(50),
    phone NUMERIC
);

create table orders(
	id_order numeric not null,
    id_supplier numeric not null,
    id_user numeric not null,
    orders_date date,
    ship_date date
);

create table category(
	id_category numeric not null,
    name varchar(50),
    parent_category numeric not null
);

create table order_detail(
	id_order numeric not null,
    id_product numeric not null,
    unit_price float,
    quantity int,
    discount float
);

create table customer(
	id_customer numeric not null,
    rfc varchar(50),
    firstname VARCHAR(50),
    lastname varchar(50),
    email varchar(50),
    phone NUMERIC
);

create table user_session(
	id_user numeric not null,
    user_type char(1),
    username varchar(50),
    password varchar(50),
    logging_session varchar(100)
);

create table sales(
	id_sale numeric not null,
	id_user numeric not null,
    id_customer numeric not null,
    date datetime
);

create table sales_by_user(
	id_sale numeric not null,
    id_product numeric not null,
    quantity int
);    

create table supplier(
	id_supplier numeric not null,
    name varchar(50),
    email varchar(50),
    phone numeric,
    clabe varchar(50)
);

create table store(
	id_store numeric not null,
    id_attendant numeric not null,
    name varchar(50),
    address varchar(100)
);

create table products(
	id_product numeric not null,
    id_supplier numeric not null,
    id_category numeric not null,
    description varchar(100),
    price float,
    price_to_public float,
    quantity_by_unit int,
    units_on_orders int,
    discontinued char(1)
);

create table stock(
	id_product numeric not null,
    id_store numeric not null,
    stock int
);


alter table user add constraint pk_user primary key (id_user);
alter table customer add constraint pk_customer primary key (id_customer);
alter table user_session add constraint pk_user_session primary key (id_user);
alter table sales add constraint pk_sales primary key (id_sale);
alter table supplier add constraint pk_supplier primary key (id_supplier);
alter table store add constraint pk_store primary key (id_store);
alter table products add constraint pk_products primary key (id_product);
alter table orders add constraint pk_orders primary key (id_order);
alter table category add constraint pk_category primary key (id_category);

alter table user_session add constraint fk_user_session foreign key(id_user) references user(id_user);
alter table sales add constraint fk_sales_user foreign key(id_user) references user(id_user);
alter table sales add constraint fk_sales_customer foreign key(id_customer) references customer(id_customer);
alter table sales_by_user add constraint fk_sales_by_user foreign key(id_sale) references sales(id_sale);
alter table sales_by_user add constraint fk_sales_by_user_product foreign key(id_product) references products(id_product);
alter table store add constraint fk_store foreign key(id_attendant) references user(id_user);
alter table products add constraint fk_products_supplier foreign key(id_supplier) references supplier(id_supplier);
alter table orders add constraint fk_orders_supplier foreign key(id_supplier) references supplier(id_supplier);
alter table orders add constraint fk_orders_user foreign key(id_user) references user(id_user);
alter table order_detail add constraint fk_order_detail_orderss foreign key(id_order) references orders(id_order);
alter table order_detail add constraint fk_order_detail_products foreign key(id_product) references products(id_product);
alter table stock add constraint fk_stock_store foreign key(id_store) references store(id_store);
alter table stock add constraint fk_stock_products foreign key(id_product) references products(id_product);



insert into user values(1,'Angelo','Loza','angel@correo.com',477910135);
insert into user values(2,'Juanito','Perengano','juanito@correo.com', 477128382);
insert into user_session values(1,'a','admin','admin', null);
insert into user_session values(2,'s','Juanito','Perengano', null);

select * from user_session;


use electronica;

create table products(
	id_product numeric not null,
    id_supplier numeric not null,
    id_category numeric not null,
    description varchar(100),
    price float,
    price_to_public float,
    quantity_by_unit int,
    units_on_orders int,
    disconued char(1)
);

insert into store values(1,1,'Kuali Mecatrónica', 'Honduras, col. Obrera');
insert into supplier values(1,'Juan Ornelas','juan@correo.com',4771828181,'172839172839103817');
insert into category values(1,"Resistores",1);
insert into products values(1,1,1,"Resistencia 1 kOhm",0.5,1,1,0,'F');
insert into products values(2,1,1,"Resistencia 10 kOhm",0.5,1,1,0,'F');
insert into products values(3,1,1,"Resistencia 120 kOhm",0.5,1,1,0,'F');
insert into products values(4,1,1,"Resistencia 32 kOhm",0.5,1,1,0,'F');
insert into products values(5,1,1,"Resistencia 12 kOhm",0.5,1,1,0,'F');
insert into store values(2,1,'Electrónica Medina', 'Pino Suárez Col.Centro');
insert into supplier values(2,'Hugo Rodríguez','hugo@correo.com',4779827161,'918273617289182718');
insert into category values(2,"Sensores",2);
insert into products values(6,2,2,"Sensor Ultrasónico",35,48,1,0,'F');
insert into products values(7,2,2,"Sensor de flujo de agua (Caudalómetro) ",80,120,1,5,'F');
insert into products values(8,1,2,"Sensor de movimiento (Infrarrojo)",22,46,1,3,'F');
insert into products values(9,2,2,"Sensor de corriente",110,120,1,4,'F');
insert into products values(10,1,2,"Sensor de color",100,130,1,0,'F');
insert into stock values(1,1,10);
insert into stock values(1,2,30);
insert into stock values(2,1,2);
insert into stock values(3,1,30);
insert into stock values(4,1,3);
insert into stock values(5,2,4);
insert into stock values(6,1,5);
insert into stock values(7,1,12);
insert into stock values(8,2,1);
insert into stock values(9,1,2);
insert into stock values(10,1,4);

select * from products order by price;

select * from user_session;

select products.id_product, products.description 
from products inner join supplier on products.id_supplier = supplier.id_supplier 
where supplier.name like '%Juan%';

select products.id_product as id, products.description as descripcion, products.price_to_public as precio, stock.stock as inventario, store.name as tienda
from products join stock on products.id_product = stock.id_product inner join store on stock.id_store = store.id_store
where products.description like '%Res%'
group by products.description;

SELECT user_session.user_type, user.firstname, user.lastname, user_session.username, user_session.password 
		from user_session inner join user on user_session.id_user = user.id_user 
		WHERE username='admin' and password='admin';
