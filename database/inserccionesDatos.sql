INSERT INTO personas(nombres, apellidos, tipodocumento, numerodocumento, celular) VALUES 
('ANGEL', 'MARCOS CASTILLA','DNI', '73963911', NULL),
('MARIA', 'MARTINEZ MATETO','DNI','11887798',NULL),
('JOSE','SANDOVAL CASAS', 'DNI','12537521', NULL),
('JOEL', 'MARCELO CASTILLA','DNI', '12345543', NULL),
('FRANCO', 'TASAYCO MUNAYCO','DNI', '10045543',NULL),
('SANDRA', 'BARRIOS SALVATIERRA','DNI', '12245540', NULL),
('CARLINA', 'RODRIGUEZ CASAS','DNI', '12345540', NULL),
('PIERINA', 'ROJAS SARAVIA','DNI', '10245540', NULL),
('SOLYMAR', 'DAVALOS SARAVIA','DNI', '99245540', NULL),
('AMBAR', 'CORDOBA TASAYCO', 'DNI','67245540', NULL),
('LUIS', "ALVARADO ROSALES",'DNI','12097865', NULL),
('MARBELLA', "CASTAÑEDA YOTUN",'CDE','66097865', NULL),
('JUAN', 'PÉREZ', 'DNI', '12345678', NULL),
('MARÍA', 'GÓMEZ', 'DNI', '87654321', NULL),
('CARLOS', 'LÓPEZ', 'DNI', '23456709', NULL),
('ANA', 'MARTÍNEZ', 'DNI', '98765402', NULL),
('LUIS', 'HERNÁNDEZ', 'DNI', '34567800', NULL),
('LAURA', 'RODRÍGUEZ', 'DNI', '09876503', NULL),
('PEDRO', 'SÁNCHEZ', 'DNI', '45678001', NULL),
('SOFÍA', 'GONZÁLEZ', 'DNI', '21090765', NULL),
('MIGUEL', 'TORRES', 'DNI', '56789012', NULL),
('LUCÍA', 'RAMÍREZ', 'DNI', '10987654', NULL),
('RAÚL', 'CRUZ', 'DNI', '98765432', NULL),
('ANA', 'PÉREZ', 'DNI', '23456789', NULL),
('JAVIER', 'RODRÍGUEZ', 'DNI', '34567890', NULL),
('PAULA', 'GÓMEZ', 'DNI', '09876543', NULL),
('OSCAR', 'SÁNCHEZ', 'DNI', '45678901', NULL),
('ALICIA', 'TORRES', 'DNI', '21098765', NULL);

INSERT INTO empresas (ruc, nombre, direccion) 
VALUES
('12345678912', 'PEPITO SAC', 'En lado mas osucro de la luna'),
('12345678902', 'SANTIAGO SAC', 'las fosas de las marianas'),
('12345678910', 'MARCOS SAC', 'Calle del mas allá'),
('12345678913', 'ELLA NO TE AMA SAC', 'Calle el corazon roto'),
('12345678914', 'EMPRESA B', 'Avenida Secundaria 456'),
('12345678915', 'EMPRESA C', 'Calle Central 789'),
('12345678916', 'EMPRESA D', 'Avenida Principal 987'),
('12345678917', 'EMPRESA E', 'Calle Secundaria 654');

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

/*Hacer inserciones pero restarles un dia al metodo NOW()*/
-- alquiler habitacion 2
INSERT INTO clientes(idpersona) VALUES (4);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(2, 1, 4, NOW() - INTERVAL 1 DAY, 2, 90.00, 'B', 'B00000004');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(4, 11);
UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 2;

-- alquiler habitacion 11
INSERT INTO clientes(idpersona) VALUES (5);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(11, 1, 5, NOW() - INTERVAL 1 DAY, 2, 90.00, 'B', 'B00000005');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(5, 12);
UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 11;

/*Inseercion con 2 dias atras*/
-- alquiler habitacion 3
INSERT INTO clientes(idpersona) VALUES (6);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(3, 1, 6, NOW() - INTERVAL 2 DAY, 4, 90.00, 'B', 'B00000006');
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(6, 13);
UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = 3;

-- alquiler habitacion 12
INSERT INTO clientes(idpersona) VALUES (7);
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante) VALUES
(12, 1, 7, NOW() - INTERVAL 2 DAY, 2, 90.00, 'B', 'B00000007');

/*Inserter alquileres pasados el id del cliente varia del 1 al 5*/
-- alquiler habitacion 4
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(4, 1, 1, NOW() - INTERVAL 3 DAY, 2, 90.00, 'B', 'B00000008', NOW() - INTERVAL 1 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(7, 1);

-- alquiler habitacion 5
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(5, 1, 3, NOW() - INTERVAL 4 DAY, 2, 90.00, 'B', 'B00000010', NOW() - INTERVAL 2 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(9, 3);

-- alquiler habitacion 14
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(14, 1, 4, NOW() - INTERVAL 4 DAY, 2, 90.00, 'B', 'B00000011', NOW() - INTERVAL 2 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(10, 4);

-- alquiler habitacion 6
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(6, 1, 5, NOW() - INTERVAL 5 DAY, 2, 90.00, 'B', 'B00000012', NOW() - INTERVAL 3 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(11, 5);

-- alquiler habitacion 15
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(15, 1, 2, NOW() - INTERVAL 5 DAY, 2, 90.00, 'B', 'B00000013', NOW() - INTERVAL 3 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(12, 2);

-- alquiler habitacion 7
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(7, 1, 3, NOW() - INTERVAL 6 DAY, 2, 90.00, 'B', 'B00000014', NOW() - INTERVAL 4 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(13, 3);

-- alquiler habitacion 16
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(16, 1, 4, NOW() - INTERVAL 6 DAY, 2, 90.00, 'B', 'B00000015', NOW() - INTERVAL 4 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(14, 4);

-- alquiler habitacion 8
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(8, 1, 5, NOW() - INTERVAL 6 DAY, 2, 90.00, 'B', 'B00000016', NOW() - INTERVAL 4 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(15, 5);

-- alquiler habitacion 17
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES
(17, 1, 2, NOW() - INTERVAL  4 DAY, 2, 90.00, 'B', 'B00000017', NOW() - INTERVAL 2 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(16, 2);

-- alquiler habitacion 9
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida) VALUES 
(9, 1, 3, NOW() - INTERVAL 5 DAY, 2, 90.00, 'B', 'B00000018', NOW() - INTERVAL 3 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(16, 3);

-- alquiler habitacion 18
INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante, registrosalida)
VALUES (18, 1, 4, NOW() - INTERVAL 5 DAY, 2, 90.00, 'B', 'B00000019', NOW() - INTERVAL 3 DAY);
INSERT INTO detalles_huespedes(idalquiler, idpersona) VALUES
(17, 4);

UPDATE habitaciones SET estadohabitacion = 'M' WHERE idhabitacion = 5;
UPDATE habitaciones SET estadohabitacion = 'M' WHERE idhabitacion = 14;
UPDATE habitaciones SET estadohabitacion = 'M' WHERE idhabitacion = 19;
UPDATE habitaciones SET estadohabitacion = 'M' WHERE idhabitacion = 29;
