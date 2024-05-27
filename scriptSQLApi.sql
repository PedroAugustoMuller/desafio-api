CREATE DATABASE IF NOT EXISTS api;
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
    PRIMARY KEY (id)
);

INSERT INTO authorized_tokens (token,token_status) VALUES ("040.842.710-80",'S');
INSERT INTO tasks(task_description,task_date) VALUES 
("Terminar a API",'2024-05-28'),
("Lista Vetores 1 - PRP",'2024-05-26'),
("Apresentacao Diagnostico - LEPC(A)",'2024-05-21');



SELECT * FROM authorized_tokens;
SELECT * FROM tasks;


