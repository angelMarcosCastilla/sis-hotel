
INSERT INTO personas(nombres, apellidos, tipodocumento, numerodocumento, celular) VALUES 
('ANGEL', 'MARCOS CASTILLA','DNI', '73963911', NULL),
('MARIA', 'MARTINEZ MATETO','DNI','11887798',NULL),
('JOSE','SANDOVAL CASAS', 'DNI','12537521', NULL),
('JOEL', 'MARCELO CASTILLA','DNI', '12345543', NULL),
('FRANCO', 'TASAYCO MUNAYCO','DNI', '10045543',NULL),
('SANDRA', 'BARRIOS SALVATIERRA','DNI', '12245540', NULL),
('CARLINA', 'RODRIGUEZ CASAS','DNI', '12345540', NULL),
('PIERINA', 'ROJAS SARAVIA','DNI', '00245540', NULL),
('SOLYMAR', 'DAVALOS SARAVIA','DNI', '99245540', NULL),
('AMBAR', 'CORDOBA TASAYCO', 'DNI','67245540', NULL),
('LUIS', "ALVARADO ROSALES",'DNI','12097865', NULL),
('MARBELLA', "CASTAÑEDA YOTUN",'CDE','660978650011', NULL);

INSERT INTO empresas (ruc, nombre, direccion) 
VALUES
('12345678912', 'PEPITO SAC', 'En lado mas osucro de la luna'),
('12345678902', 'SANTIAGO SAC', 'las fosas de las marianas'),
('12345678910', 'MARCOS SAC', 'Calle del mas allá');

INSERT INTO usuarios(idpersona, nombreusuario, claveacceso, email)
VALUES (1,'angeluser','$2y$10$XaESoYZS6kBEl6LZy2ilOudXWLpUd7O9GUJL/ie88ALXM3DaP3wb2','angelmarcoscastilla15@gmail.com');

INSERT INTO tipo_habitaciones(nombre, cantmaxpersona) VALUES
('SIMPLE', 1),
('DOBLE', 2),
('MATRIMONIAL', 2),
('TRIPLE', 3),
('SUITE', 4);

INSERT INTO  habitaciones(numHabitacion,idtipohabitacion, numpiso, precio, detalles)
VALUES 
(1,1, 4, 40, "Cable,Wifi,Tv,baño"),
(2,2,1,70, "Cable,Wifi,Tv,baño"),
(3,1,2,40, "Cable,Wifi,Tv,baño"),
(4,3,4,80, "Cable,Wifi,Tv,baño"),
(5,3,1,110, "Cable,Wifi,Tv,baño"),
(6,4,3,130, "Cable,Wifi,Tv,baño"),
(7,5,1,150, "Cable,Wifi,Tv,baño"),
(8,1,4,40, "Cable,Wifi,Tv,baño"),
(9,2,1,70, "Cable,Wifi,Tv,baño"),
(10,1,4,40, "Cable,Wifi,Tv,baño"),
(11,3,1,80, "Cable,Wifi,Tv,baño"),
(12,3,3,110, "Cable,Wifi,Tv,baño"),
(13,4,1,130, "Cable,Wifi,Tv,baño"),
(14,5,2,150, "Cable,Wifi,Tv,baño"),
(15,1,1,40, "Cable,Wifi,Tv,baño"),
(16,2,3,70, "Cable,Wifi,Tv,baño"),
(17,1,3,40, "Cable,Wifi,Tv,baño"),
(18,3,2,80, "Cable,Wifi,Tv,baño"),
(19,3,4,110, "Cable,Wifi,Tv,baño"),
(20,4,1,130, "Cable,Wifi,Tv,baño"),
(21,5,4,150, "Cable,Wifi,Tv,baño"),
(22,1,1,40, "Cable,Wifi,Tv,baño"),
(23,2,3,70, "Cable,Wifi,Tv,baño"),
(24,1,2,40, "Cable,Wifi,Tv,baño"),
(25,3,1,80, "Cable,Wifi,Tv,baño"),
(26,3,2,110, "Cable,Wifi,Tv,baño"),
(27,4,4,130, "Cable,Wifi,Tv,baño"),
(28,5,2,150, "Cable,Wifi,Tv,baño"),
(29,1,3,40, "Cable,Wifi,Tv,baño"),
(30,2,4,70, "Cable,Wifi,Tv,baño"),
(31,1,1,40, "Cable,Wifi,Tv,baño");

-- alquiler prueba habitacion 9 
INSERT INTO clientes(idpersona) VALUES (2);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(9, 1, 1, NOW(), 2, 90.00, 'B', 'B00000001');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(1, 1),
(1,2);
UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 9;

-- alquiler habitacion 1
INSERT INTO clientes(idpersona) VALUES (2);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(1, 1, 2, NOW(), 2, 90.00, 'B', 'B00000002');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(2, 6);
UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 1;

-- alquiler habitacion 10
INSERT INTO clientes(idpersona) VALUES (3);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(10, 1, 3, NOW(), 2, 90.00, 'B', 'B00000003');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(3, 10);

UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 10;


UPDATE habitaciones SET estadohabitacion = 'M' WHERE idhabitacion = 5;

