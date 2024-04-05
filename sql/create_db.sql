create database php_final_exam;

use php_final_exam;

create table contacts
(
	id int primary key auto_increment,
    name varchar(255),
    phone_number varchar(20) not null
);

insert into contacts(name, phone_number) values 
('Hai Son', '123456789'),
('Truong Chel', '987654321'),
('Huy Hoang', '256849758'),
('Duy Manh', '5846213456');

select * from contacts;

drop database php_final_exam;