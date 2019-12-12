use swap

CREATE TABLE IF NOT EXISTS swap.users (`name` VARCHAR(32) NOT NULL,`password` VARCHAR(255) NOT NULL,`email` VARCHAR(64) NOT NULL UNIQUE, `role` VARCHAR(15) NOT NULL, PRIMARY KEY (`email`));


CREATE TABLE IF NOT EXISTS swap.data (`email` VARCHAR(64) NOT NULL, `dataName` VARCHAR(64) NOT NULL, `dataLogin` VARCHAR(64) NOT NULL, `dataPassword` VARCHAR(255) NOT NULL, FOREIGN KEY (`email`) REFERENCES `swap`.`users` (`email`));


CREATE TABLE IF NOT EXISTS swap.pwdreq (`name` VARCHAR(32) NOT NULL, `email` VARCHAR(64) NOT NULL, `token` VARCHAR(10) NOT NULL);


