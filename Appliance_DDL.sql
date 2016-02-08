create table customer ( phone char(10) primary key,
building_num int,
street varchar(20),
apartment varchar(20)
);
create table appliance ( aname varchar(20) primary key,
description varchar (100)
);
create table catalog (aname varchar(20),
config varchar (20),
price decimal(4,2),
status varchar(20),
primary key (aname, config),
foreign key (aname) references appliance(aname)
);
create table orders (phone char(10),
aname varchar(20),
config varchar(20),
o_time timestamp,
quantity int,
price decimal(4,2),
status varchar(10),
primary key (phone, aname, config, o_time),
foreign key (phone) references customer(phone),
foreign key (aname, config) references catalog(aname, config)
);