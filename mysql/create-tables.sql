drop table if exists comments;
drop table if exists credentials;
create table comments(id int NOT NULL AUTO_INCREMENT, c varchar(500),  PRIMARY KEY (id));
create table credentials(id int NOT NULL AUTO_INCREMENT, username varchar(255), creditcard varchar(255),PRIMARY KEY (id));
