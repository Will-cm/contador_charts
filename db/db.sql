CREATE TABLE departamentos(
    id int not null auto_increment,
    nombre VARCHAR(65) NOT NULL,
    cantidad_pedidos INT default 0,
 PRIMARY KEY(id)
);

INSERT INTO departamentos (nombre) VALUES ('La paz');
INSERT INTO departamentos (nombre) VALUES ('Santa cruz');
INSERT INTO departamentos (nombre) VALUES ('Cochabamba');
INSERT INTO departamentos (nombre) VALUES ('Chuquisaca');

INSERT INTO departamentos (nombre) VALUES ('Tarija');
INSERT INTO departamentos (nombre) VALUES ('Oruro');
INSERT INTO departamentos (nombre) VALUES ('Potosi');
INSERT INTO departamentos (nombre) VALUES ('Beni');
INSERT INTO departamentos (nombre) VALUES ('Pando');