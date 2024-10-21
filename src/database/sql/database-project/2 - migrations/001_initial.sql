CREATE DATABASE IF NOT EXISTS db_fila_facil;

/*TODO:
--Verificar quais colunas serão utilizadas como indices
*/

/*
OBS: Verificar qual tipo de constraint representa melhor o id (uuid/auto_increment)
*/

USE db_fila_facil;

/*Criação da tabela da empresa*/
CREATE TABLE IF NOT EXISTS tb_enterprise (
cnpj CHAR(14),
corporate_name VARCHAR(60) NOT NULL,
email VARCHAR(64) UNIQUE NOT NULL,
phone CHAR(11),
profile_picture VARCHAR(50),
sector ENUM('Saúde', 'Tecnólogia', 'Educação', 'Outros') DEFAULT 'Outros',
enterprise_password VARCHAR(256) NOT NULL,
token VARCHAR(100),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
updated_at DATETIME DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),

PRIMARY KEY(cnpj)

);

/*Criaçao da tabela usuario*/
CREATE TABLE IF NOT EXISTS tb_user (
user_id CHAR(36),
user_name VARCHAR(45) NOT NULL,
email VARCHAR(64) UNIQUE NOT NULL,
phone CHAR(11) UNIQUE,
profile_picture VARCHAR(50),
user_password VARCHAR(256) NOT NULL,
token VARCHAR(100),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
updated_at DATETIME DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),

PRIMARY KEY(user_id)

);

/*Criação da tabela evento*/
CREATE TABLE IF NOT EXISTS tb_event(
event_id CHAR(36),
event_name VARCHAR(50) NOT NULL,
enterprise_cpnj CHAR(14) NOT NULL,
avaliable_tickets INT NOT NULL,
event_description TEXT NOT NULL,
break_time TIME,
opening_time DATETIME NOT NULL,
closing_time DATETIME NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
updated_at DATETIME DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),

PRIMARY KEY (event_id),
FOREIGN KEY (enterprise_cpnj) REFERENCES tb_enterprise (cnpj)
	ON DELETE CASCADE

);


/*Criação da tabela favoritos*/
CREATE TABLE IF NOT EXISTS tb_favorite (
favorite_id CHAR(36),
event_id CHAR(36) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),

PRIMARY KEY(favorite_id),
FOREIGN KEY (event_id) REFERENCES tb_event(event_id)
	ON DELETE CASCADE
);


/*Criação da tabela imagem*/
CREATE TABLE IF NOT EXISTS tb_image(
image_id CHAR(36),
image_name VARCHAR(50) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),

PRIMARY KEY(image_id)

);

/*Criação da tabela endereço*/
CREATE TABLE IF NOT EXISTS tb_address (
cep CHAR(8),
state CHAR(2) NOT NULL,
city VARCHAR(50) NOT NULL,
neighborhood VARCHAR(50),
street VARCHAR(100),

PRIMARY KEY(cep)

);

CREATE TABLE IF NOT EXISTS tb_enterprise_address (
cep CHAR(8),
enterprise_cpnj CHAR(14),
residential_number VARCHAR(10),
complement VARCHAR(255),

PRIMARY KEY(cep, enterprise_cpnj),
FOREIGN KEY(cep) REFERENCES tb_address (cep)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
FOREIGN KEY (enterprise_cpnj) REFERENCES tb_enterprise (cnpj)
	ON UPDATE CASCADE
	ON DELETE CASCADE

);


CREATE TABLE IF NOT EXISTS tb_user_address (
cep CHAR(8),
user_id CHAR(36),
residential_number VARCHAR(10),
complement VARCHAR(255),

PRIMARY KEY(cep, user_id),
FOREIGN KEY(cep) REFERENCES tb_address (cep)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
FOREIGN KEY(user_id) REFERENCES tb_user (user_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE

);



CREATE TABLE IF NOT EXISTS tb_event_image(
event_id CHAR(36),
image_id CHAR(36),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),

PRIMARY KEY(event_id, image_id),
FOREIGN KEY (event_id) REFERENCES tb_event (event_id)
	ON DELETE CASCADE,
FOREIGN KEY (image_id) REFERENCES tb_image (image_id)
	ON DELETE CASCADE

);


CREATE TABLE IF NOT EXISTS tb_event_user(
event_id CHAR(36),
user_id CHAR(36),
sold_ticket INT NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),

PRIMARY KEY(event_id, user_id),
FOREIGN KEY (event_id) REFERENCES tb_event (event_id)
	ON DELETE CASCADE,
FOREIGN KEY (user_id) REFERENCES tb_user (user_id)
	ON DELETE CASCADE

);


/*Esta tabela realmente é necessaria?*/
CREATE TABLE IF NOT EXISTS tb_favorite_user(
favorite_id CHAR(36),
user_id CHAR(36),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),

PRIMARY KEY(favorite_id, user_id),
FOREIGN KEY (favorite_id) REFERENCES tb_favorite (favorite_id)
	ON DELETE CASCADE,
FOREIGN KEY (user_id) REFERENCES tb_user (user_id)
	ON DELETE CASCADE

);

