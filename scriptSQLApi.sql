CREATE SCHEMA IF NOT EXISTS api;
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
