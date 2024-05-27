CREATE DATABASE api;
USE api;
CREATE TABLE authorized_tokens(
	id INT NOT NULL AUTO_INCREMENT,
    token VARCHAR(150) NOT NULL,
    token_status ENUM('S','N') NOT NULL DEFAULT 'N',
    PRIMARY KEY (id)
);
CREATE TABLE tasks(
	id INT NOT NULL AUTO_INCREMENT,
    task_description VARCHAR(200),
    task_date date,
    task_status ENUM('todo','doing','done') NOT NULL DEFAULT 'todo',
    PRIMARY KEY (id)
); 

/*Tokens autorizados*/
INSERT INTO authorized_tokens (token,token_status) VALUES ("040.842.710-80",'S');

/*tasks*/
INSERT INTO tasks(task_description,task_date,task_status) VALUES
("Terminar a API",'2024-05-28','todo'),
("Lista Vetores 1 - PRP",'2024-05-26','doing'),
("Apresentacao Diagnostico - LEPC(A)",'2024-05-21','done');



SELECT * FROM authorized_tokens;
SELECT * FROM tasks;