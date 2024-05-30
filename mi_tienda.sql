drop database IF EXISTS restaurante;
create database restaurante;

use restaurante;

CREATE TABLE Estudiante (
    ID_Estudiante INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Email VARCHAR(100),
    Fecha_Nacimiento DATE,
    Ubicacion VARCHAR(100),
    ID_Numero_telefonico int
);

CREATE TABLE Factura (
    ID_Factura INT PRIMARY KEY ,
    Numero_Factura VARCHAR(50),
    Tipo_Factura VARCHAR(50)
);

CREATE TABLE Promocion (
    ID_Promocion INT PRIMARY KEY,
    Descripcion VARCHAR(255),
    Fecha_Inicio DATE,
    Fecha_Fin DATE,
    Descuento DECIMAL(5,2)
);

CREATE TABLE MetodoPago (
    ID_MetodoPago INT PRIMARY KEY,
    Nombre VARCHAR(50)
);

CREATE TABLE Restaurante (
    ID_Restaurante INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Direccion VARCHAR(255),
    Id_Numero_telefono VARCHAR(20)
);

CREATE TABLE Categoria (
    ID_Categoria INT PRIMARY KEY,
    Nombre VARCHAR(100)
);

CREATE TABLE Comida (
    ID_Comida INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Descripcion TEXT,
    Precio DECIMAL(10,2),
    ID_Categoria INT,
	ID_Restaurante int,
    FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria),
	FOREIGN KEY (ID_Restaurante) REFERENCES Restaurante(ID_Restaurante)
);

CREATE TABLE Precio_Comida (
    ID_PrecioComida INT PRIMARY KEY,
    ID_Comida INT,
    Precio DECIMAL(10,2),
    Fecha_Vigencia DATE,
    FOREIGN KEY (ID_Comida) REFERENCES Comida(ID_Comida)
);

CREATE TABLE Historial_Pedido (
    ID_HistorialPedido INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pedido INT,
    ID_Estudiante INT,
    ID_Comida INT,
    Cantidad INT,
    Fecha_Pedido DATE,
    FOREIGN KEY (ID_Estudiante) REFERENCES Estudiante(ID_Estudiante),
    FOREIGN KEY (ID_Comida) REFERENCES Comida(ID_Comida)
);

CREATE TABLE Calificacion_Producto (
    ID_Calificacion INT PRIMARY KEY,
    ID_Estudiante INT,
    ID_Comida INT,
    Calificacion INT,
    Comentario TEXT,
    FOREIGN KEY (ID_Estudiante) REFERENCES Estudiante(ID_Estudiante),
    FOREIGN KEY (ID_Comida) REFERENCES Comida(ID_Comida)
);

CREATE TABLE Carrito_Compras (
    ID_Carrito INT AUTO_INCREMENT PRIMARY KEY,
    ID_Estudiante INT,
    ID_Comida INT,
    Cantidad INT,
    FOREIGN KEY (ID_Estudiante) REFERENCES Estudiante(ID_Estudiante),
    FOREIGN KEY (ID_Comida) REFERENCES Comida(ID_Comida)
);

CREATE TABLE Pago (
    ID_Pago INT AUTO_INCREMENT PRIMARY KEY,
    ID_Carrito INT,
    ID_Promocion INT,
    ID_MetodoPago INT,
    ID_HistorialPedido INT,
    Monto DECIMAL(10,2),
    Fecha_Pago DATE,
    FOREIGN KEY (ID_Carrito) REFERENCES Carrito_Compras(ID_Carrito),
    FOREIGN KEY (ID_Promocion) REFERENCES Promocion(ID_Promocion),
    FOREIGN KEY (ID_MetodoPago) REFERENCES MetodoPago(ID_MetodoPago),
    FOREIGN KEY (ID_HistorialPedido) REFERENCES Historial_Pedido(ID_HistorialPedido)
);

CREATE TABLE Comentario_Tienda (
    ID_Comentario INT PRIMARY KEY,
    ID_Estudiante INT,
    Comentario TEXT,
    Fecha DATE,
    FOREIGN KEY (ID_Estudiante) REFERENCES Estudiante(ID_Estudiante)
);

CREATE TABLE Domiciliario (
    ID_Domiciliario INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Id_Numero_telefono VARCHAR(20)
    
);

CREATE TABLE Servicio_AtencionCliente (
    ID_ServicioCliente INT PRIMARY KEY,
    ID_Estudiante INT,
    Descripcion TEXT,
    Numero_Telefono VARCHAR(20),
    FOREIGN KEY (ID_Estudiante) REFERENCES Estudiante(ID_Estudiante)
);
CREATE TABLE Numero_telefonico(
    ID_Numero_telefonico INT PRIMARY KEY,
    Numero_telefonico NUMERIC,
    Entidad INT,
    Nombre_Entidad VARCHAR(50),
    CONSTRAINT fk_ID_Estudiante FOREIGN KEY (Entidad) REFERENCES Estudiante(ID_Estudiante),
    CONSTRAINT fk_ID_Domiciliario FOREIGN KEY (Entidad) REFERENCES Domiciliario(ID_Domiciliario),
    CONSTRAINT fk_ID_Restaurante FOREIGN KEY (Entidad) REFERENCES Restaurante(ID_Restaurante)
);
CREATE TABLE Tipo_De_Comida (
    ID_Tipo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50)
);

INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (1, 'Camilo', 'Murcia', 'Camilo@hotmail.com', '1997-08-27', 'B301');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (2, 'Marcela', 'Sesan', 'Marcela_Sesan@hotmail.com', '1998-02-10', 'C405');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (3, 'Cecilia', 'Garzon', 'Cecilia12@hotmail.com', '2002-04-02', 'A105');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (4, 'Camila', 'Espinoza', 'Camila125@hotmail.com', '2010-07-03', 'C600');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (5, 'Paula', 'Torres', 'Paula32@hotmail.com', '2003-08-25', 'Bicicletero');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (6, 'Mafe', 'Maldonado', 'Mafe124@hotmail.com', '2003-04-30', 'A405');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (7, 'Maria', 'Torres', 'Maria54@hotmail.com', '2005-03-03', 'C106');
INSERT INTO Estudiante (ID_Estudiante, Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion)
VALUES (8, 'Mariana', 'Casas', 'Mariana12@hotmail.com', '2003-04-09', 'B403');

INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (1, 'Mexicana', '2024-03-03', '2024-04-03', 0.30);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (2, 'Coreana', '2023-05-02', '2024-05-04', 0.25);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (3, 'Italiana', '2024-04-04', '2025-05-05', 0.70);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (4, 'Japones', '2023-06-03', '2024-03-03', 0.50);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (5, 'Peruana', '2024-05-05', '2024-05-05', 0.25);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (6, 'Hindu', '2023-05-06', '2024-05-13', 0.6);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (7, 'China', '2024-06-07', '2024-06-08', 0.3);
INSERT INTO Promocion (ID_Promocion, Descripcion, Fecha_Inicio, Fecha_Fin, Descuento)
VALUES (8, 'Thai', '2025-07-08', '2026-08-09', 0.5);

INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('1','ElRinconEnchilado','Cra15#16-b');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('2','Tacos_Picantes_Elquetzal','Cra36#5-A');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('3','Fijistas_Aztecas','Clle45#3-C');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('4','Puro_Sabor_Mexicano','Cra157#65-Z');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('5','FogonesMexicanos','Clle76#6');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('6','CocinandoConTequila','Cra36#7-S');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('7','Mexico_En_Tu_Casa','3Cra45#7-3A');
INSERT INTO Restaurante(ID_Restaurante, Nombre, Direccion) VALUES('8','Comiendo_Con_Mariachis','Cra2#1-A');

Insert into Categoria(ID_Categoria, Nombre) Values('1','Verduras');
Insert into Categoria(ID_Categoria, Nombre) Values('2','Grano');
Insert into Categoria(ID_Categoria, Nombre) Values('3','Mexicano');
Insert into Categoria(ID_Categoria, Nombre) Values('4','Japonesa');
Insert into Categoria(ID_Categoria, Nombre) Values('5','Hindu');
Insert into Categoria(ID_Categoria, Nombre) Values('6','Pescados');
Insert into Categoria(ID_Categoria, Nombre) Values('7','Lacteos');
Insert into Categoria(ID_Categoria, Nombre) Values('8','Carnes');

Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('1','Mole','Picantoso','25000','3','1');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('2','Pozole','Pesado','10000','3','2');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('3','Taco','Liviano','7000','3','3');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('4','Cochinita_Pibil','Almuerzo_Personal','30000','3','4');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('5','Chiles_De_Nogada','Para_Compartir','45000','3','5');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('6','Barbacoa','Para_Toda_La_Familia','50000','8','6');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('7','Carnitas','Para_Chuparse_Los_Dedos','25000','8','7');
Insert into Comida(ID_Comida, Nombre, Descripcion, Precio, ID_Categoria, ID_Restaurante) Values('8','Pescado_De_Veracruz','Sabrozo','15000','6','8');

INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (1, 1, 'Me encantó la comida en ElRinconEnchilado. El mole estaba delicioso.', '2024-04-28'),
    (2, 1, 'Los tacos de Tacos_Picantes_Elquetzal son increíbles. Definitivamente los recomiendo.', '2024-04-28'),
    (3, 1, 'Fui a Fijistas_Aztecas y probé el pozole. Estaba delicioso.', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (4, 2, 'El servicio en ElRinconEnchilado fue excelente. ¡Volveré pronto!', '2024-04-28'),
    (5, 2, 'FogonesMexicanos tiene una gran variedad de platos mexicanos. ¡Me encantó!', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (6, 3, 'Puro_Sabor_Mexicano es mi lugar favorito para comer tacos.', '2024-04-28'),
    (7, 3, 'Chiles_De_Nogada en Mexico_En_Tu_Casa es una delicia.', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (8, 4, 'Cochinita_Pibil en Puro_Sabor_Mexicano es deliciosa. ¡Altamente recomendada!', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (9, 5, 'Barbacoa en CocinandoConTequila es una experiencia gastronómica única.', '2024-04-28'),
    (10, 5, 'Los carnitas en Mexico_En_Tu_Casa son los mejores que he probado.', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (11, 6, 'Pescado_De_Veracruz en Comiendo_Con_Mariachis es mi plato favorito.', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (12, 7, 'ElRinconEnchilado tiene una excelente selección de comida mexicana.', '2024-04-28');
INSERT INTO Comentario_Tienda (ID_Comentario, ID_Estudiante, Comentario, Fecha)
VALUES
    (13, 8, 'Los tacos en Tacos_Picantes_Elquetzal son muy sabrosos.', '2024-04-28'),
    (14, 8, 'FogonesMexicanos tiene un ambiente acogedor y la comida es deliciosa.', '2024-04-28');

INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('1','Yahaira');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('2','Morella');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('3','Zulay');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('4','Xiomara');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('5','Jose');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('6','Hugo');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('7','Mateo');
INSERT INTO Domiciliario(ID_Domiciliario, Nombre) VALUES('8','Martin');

Insert into MetodoPago(ID_MetodoPago, Nombre) Values('1','Visa');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('2','Fallabela');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('3','Efectivo');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('4','Bancolombia');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('5','Datacredito');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('6','Servibanca');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('7','Paypal');
Insert into MetodoPago(ID_MetodoPago, Nombre) Values('8','Mastercard');

INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('1','3119632015','1','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('2','3456789012','2','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('3','3567890123','3','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('4','3678901234','4','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('5','3789012345','5','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('6','3890123456','6','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('7','3945678901','7','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('8','3023456789','8','Estudiante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('9','3452645456','1','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('10','3456720374','2','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('11','3456765456','3','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('12','3987654564','4','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('13','3134567458','5','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('14','3031235367','6','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('15','3013456784','7','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('16','3028765484','8','Restaurante');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('17','3092475484','1','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('18','3028768575','2','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('19','3056185484','3','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('20','3679365484','4','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('21','3012312564','5','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('22','3028761256','6','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('23','3076545684','7','Domiciliario');
INSERT INTO Numero_telefonico(ID_Numero_telefonico, Numero_telefonico, Entidad, Nombre_Entidad) VALUES('24','3124565484','8','Domiciliario');