create table comments(id int NOT NULL AUTO_INCREMENT, c varchar(500),  PRIMARY KEY (id));
create table credentials(id int NOT NULL AUTO_INCREMENT, username varchar(255), password varchar(255), salt varchar(255), creditcard varchar(255), u_group varchar(255), PRIMARY KEY (id));
create table cookies(id int NOT NULL AUTO_INCREMENT, username varchar(255), name varchar(255), value varchar(255), PRIMARY KEY (id));
