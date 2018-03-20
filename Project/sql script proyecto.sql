
drop database electronica;
create database electronica;
use electronica;
select * from mysql.user;
 DROP USER 'adm'@'localhost';
  DROP USER 'kualimecatronica'@'localhost';
  CREATE USER 'kualimecatronica'@'localhost'
  IDENTIFIED /*WITH sha256_password*/ BY 'circuitointegrado';
  GRANT ALL PRIVILEGES ON electronica.* TO 'kualimecatronica'@'localhost';
  
create table user(
	id_user NUMERIC not null, 
    firstname VARCHAR(50),
    lastname varchar(50),
    email varchar(50),
    date_birth date,
    phone NUMERIC
);

create table user_pass(
	id_user numeric not null,
    user_type char(1),
    username varchar(50),
    password varchar(50)
);

create table address(
	id_user numeric not null,
    street varchar(50),
    num numeric,
    city varchar(50),
    state varchar(50),
    country varchar (50),
    zip numeric
);
    

create table sales(
	id_sale numeric not null,
	id_user numeric not null,
    id_product numeric not null
);

create table payment_by_user(
	id_user numeric not null,
    credit_card_num numeric,
    pin_code numeric
);    

create table ci(
	id_ci numeric not null,
    num_ci varchar(50)
);
create table resistor(
	id_res numeric not null,
    ohms float
);

create table leds(
	id_led numeric not null,
    color varchar(15)
);

create table capacitor(
	id_capacitor numeric not null,
    charge float,
    type varchar(20)
);

create table sensor(
	id_sensor numeric not null,
    sensor_type varchar(50)
);


create table products(
	id_product numeric not null,
    price float,
    amount int
);

alter table user add constraint pk_user primary key (id_user);
alter table address add constraint pk_address primary key (id_user);
alter table user_pass add constraint pk_user_pass primary key (id_user);
alter table sales add constraint pk_shop_user primary key (id_sale);
alter table payment_by_user add constraint pk_shop_payment primary key (id_user);
alter table ci add constraint pk_ci primary key (id_ci);
alter table resistor add constraint pk_resistor primary key (id_res);
alter table leds add constraint pk_led primary key (id_led);
alter table capacitor add constraint pk_capacitor primary key (id_capacitor);
alter table sensor add constraint pk_sensor primary key (id_sensor);
alter table products add constraint pk_products primary key (id_product);

alter table ci add constraint fk_ci foreign key(id_ci) references products(id_product);
alter table resistor add constraint fk_res foreign key(id_res) references products(id_product);
alter table leds add constraint fk_leds foreign key(id_led) references products(id_product);
alter table capacitor add constraint fk_capacitor foreign key(id_capacitor) references products(id_product);
alter table sensor add constraint fk_sensor foreign key(id_sensor) references products(id_product);
alter table sales add constraint fk_shop_user foreign key(id_user) references user(id_user);
alter table sales add constraint fk_shop_product foreign key(id_product) references products(id_product);
alter table payment_by_user add constraint fk_payment_by_user foreign key(id_user) references user(id_user);
alter table address add constraint fk_address foreign key (id_user) references user(id_user);
alter table user_pass add constraint fk_user_pass foreign key (id_user) references user(id_user);



/*RUTINAS DE LLENADO*/
DELIMITER //
CREATE PROCEDURE fill_products_table
(amount_registers numeric)
BEGIN
	declare i bigint default 0;
    declare price float default 0;
    declare amount int default 0;
    
    
	while i < amount_registers
    do
        set price = floor((rand()*100)+1);
        set amount = floor((rand()*30)+1);
        insert into products values(i, price, amount);
        set i =  i + 1;
        
	end while;
END; //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE fill_ci_table
(id_start numeric, id_end numeric)
BEGIN
    declare num_ci varchar(50);
    declare num bigint default 0;
    
	while id_start <= id_end
    do
		set num = floor((rand()*(id_end-id_start))+1);
        set num_ci = concat('74LS',num);
        insert into ci values(id_start, num_ci);
        set id_start =  id_start + 1;
	end while;
END; //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE fill_resistor_table
(id_start numeric, id_end numeric)
BEGIN
    declare ohms float;
    
	while id_start <= id_end
    do
		set ohms = (rand() * 50000) + 1;
        
        update products 
			set price = floor((rand()*2)+1) 
            where id_product = id_start;
            
        insert into resistor values(id_start, ohms);
        set id_start =  id_start + 1;
	end while;
END; //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE fill_leds_table
(id_start numeric, id_end numeric)
BEGIN
    declare color varchar(15);
    
    create table colors (no_color int, color varchar(15));
	insert into colors values(0, 'Blanco');
    insert into colors values(1, 'Azul');
    insert into colors values(2, 'Azul Brillante');
    insert into colors values(3, 'Verde ');
    insert into colors values(4, 'Verde Brillante');
    insert into colors values(5, 'Rojo');
    insert into colors values(6, 'Amarillo');
    insert into colors values(7, 'Morado');
	insert into colors values(8, 'Rojo Brillante');
	 
	while id_start <= id_end
    do
		set color = (select colors.color from colors where no_color = (floor((rand() * 7) + 1)) limit 1);
        
        if color = null then
			set color ='Rojo'; 
		end if;
        
        update products 
			set price = floor((rand()*3)+1)
            where id_product = id_start;
            
        insert into leds values(id_start, color);
        set id_start =  id_start + 1;
	end while;
    drop table colors;
END; //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE fill_capacitor_table
(id_start numeric, id_end numeric)
BEGIN
    declare charge float;
    declare type varchar(20);
    declare aux int;
	 
	while id_start <= id_end
    do
		set charge = (rand() * 1000) + 1;
        set aux = floor((rand()*2) + 1);
        
        if(aux = 1) then 
			set type = 'Electrolítico'; 
		else 
			set type = 'Cerámico'; 
		end if;
        update products 
			set price = floor((rand()*5)+1)
            where id_product = id_start;
        insert into capacitor values(id_start, charge, type);
        set id_start =  id_start + 1;
	end while;
END; //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE fill_sensor_table
(id_start numeric, id_end numeric)
BEGIN
    declare sensor_type varchar(50);
    
    create table sensors (no_sensor int, sensor_type varchar(50));
	insert into sensors values(0, 'Sensor de Gas MQ102');
    insert into sensors values(1, 'Ultrasónico HSR04');
    insert into sensors values(2, 'Proximidad');
    insert into sensors values(3, 'Infrarrojo ');
    insert into sensors values(4, 'Presión');
    insert into sensors values(5, 'Temperatura DHT11');
    insert into sensors values(6, 'Corriente');
    insert into sensors values(7, 'Luz');
	insert into sensors values(8, 'Movimiento');
	 
	while id_start <= id_end
    do
		set sensor_type = (select sensors.sensor_type from sensors where sensors.no_sensor = (floor((rand() * 7) + 1)) limit 1);
        
        if sensor_type = null then
			set sensor_type ='Ultrasónico'; 
		end if;
        
        insert into sensor values(id_start, sensor_type);
        set id_start =  id_start + 1;
	end while;
    drop table sensors;
END; //
DELIMITER ;

select * from sensor;
select * from products;
DELIMITER //
CREATE PROCEDURE fill_store_tables
(amount_registers numeric)
BEGIN
	declare registers_by_table numeric;
    set registers_by_table = floor(amount_registers / 5);
    call fill_products_table(amount_registers);
    call fill_ci_table(0, registers_by_table);
    call fill_resistor_table(registers_by_table + 1, registers_by_table * 2);
    call fill_leds_table((registers_by_table * 2) +1, registers_by_table * 3);
    call fill_capacitor_table((registers_by_table * 3) +1, registers_by_table * 4);
    call fill_sensor_table((registers_by_table * 4) +1, (registers_by_table * 5) - 1);
END; //
DELIMITER ;

/*Llena las tablas con 2000 registros*/

call fill_store_tables(2000);

/*Dime cuantos leds azules hay, el costo del lote y el costo por cada uno, y el costo al público
	si se desea obtener el 120% de ganancia
    y la ganancia total
*/
select leds.color,
		count(leds.color) as cuantos_hay,
        sum(products.price)  as costo_total_lote,
        sum(products.price)/count(leds.color) as costo_por_unidad,
        (sum(products.price)/count(leds.color)) * 2.2 as costo_al_publico,
        (sum(products.price)*2.2)-(sum(products.price)) as ganancia
	from leds join products on leds.id_led = products.id_product 
    where color = 'Azul';
    
/*Dime todos los precios de los sensores infrarrojos que hay*/
select sensor.sensor_type, products.price 
	from sensor join products on sensor.id_sensor = products.id_product 
    where sensor.sensor_type = 'Infrarrojo' 
    order by price desc;

insert into user_pass values(1,'a','admin','admin');
insert into user_pass values(2,'s','joel','password');

select * from user_pass;
select host, user, password from mysql.user;

insert into user values(1,'Pedro','Moreno','pedrito@correo.com','2000/31/08',477910135);
insert into user values(2,'Joel','Gutierrez','joeli@correo.com','1992/12/08',477128382);

select id_user from user  ORDER BY 1 DESC limit 1;
use electronica;
select user_pass.user_type user.firstname, user.lastname, user_pass.username, user_pass.password from user_pass
inner join user on user_pass.id_user = user.id_user  where username = 'admin' and password = 'admin';

drop table user_pass;
create table user(
	id_user NUMERIC not null, 
    firstname VARCHAR(50),
    lastname varchar(50),
    email varchar(50),
    date_birth date,
    phone NUMERIC
);

