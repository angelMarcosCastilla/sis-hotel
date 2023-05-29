DELIMITER $$
CREATE PROCEDURE spu_usuarios_login (IN _nombreusuario VARCHAR(30))
BEGIN
SELECT  
	personas.nombres, personas.apellidos,
	usuarios.idusuario,
	usuarios.nombreusuario, usuarios.claveacceso, usuarios.email
	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE nombreUsuario = _nombreusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_pisos()
BEGIN
	SELECT * FROM pisos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_tipohabitaciones()
BEGIN
	SELECT * FROM tipo_habitaciones;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_habitaciones()
BEGIN
	SELECT 
	habitaciones.idhabitacion, habitaciones.numHabitacion, habitaciones.estadohabitacion,
	habitaciones.detalles, habitaciones.precio,
	tipo_habitaciones.nombre AS tipohabitacion,
    tipo_habitaciones.cantmaxpersona,
	tipo_habitaciones.idtipohabitacion,
	pisos.piso,
	pisos.idpiso
	FROM habitaciones
	INNER JOIN tipo_habitaciones ON tipo_habitaciones.idtipohabitacion = habitaciones.idtipohabitacion
	INNER JOIN pisos ON pisos.idpiso = habitaciones.idpiso
	WHERE habitaciones.estado = 1
    ORDER BY habitaciones.numHabitacion ASC;
END $$
DELIMITER $$
CREATE PROCEDURE spu_registrar_habitacion(
	IN _numHabitacion INT,
	IN _idtipohabitacion INT,
	IN _detalles VARCHAR(300),
	IN _precio DECIMAL(7,2),
	IN _idpiso INT
)
BEGIN
	INSERT INTO habitaciones(numHabitacion, idtipohabitacion, detalles, precio, idpiso)
	VALUES(_numHabitacion, _idtipohabitacion, _detalles, _precio, _idpiso);
END $$

DELIMITER $$
CREATE PROCEDURE spu_actualizar_habitacion(
	IN _idhabitacion INT,
	IN _numHabitacion INT,
	IN _idtipohabitacion INT,
	IN _detalles VARCHAR(300),
	IN _precio DECIMAL(7,2),
	IN _idpiso INT
)
BEGIN
	UPDATE habitaciones SET
		numHabitacion = _numHabitacion,
		idtipohabitacion = _idtipohabitacion,
		detalles = _detalles,
		precio = _precio,
		idpiso = _idpiso,
		update_at = NOW()
	WHERE idhabitacion = _idhabitacion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_eliminar_habitacion(IN _idhabitacion INT)
BEGIN
	UPDATE habitaciones SET estado = 0 WHERE idhabitacion = _idhabitacion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_totalestado_habitacion()
BEGIN
	SELECT COUNT(*) AS 'total', estadohabitacion FROM habitaciones
	GROUP BY estadohabitacion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_alquiladashoy_habitacion()
BEGIN
	SELECT  COUNT(*) AS 'totalAlquiler' FROM alquileres WHERE  DATE(registroentrada) = DATE(NOW());
END $$

DELIMITER $$
CREATE PROCEDURE spu_create_alquiler(
IN _idhabitacion		INT, 
IN _idusuario 			INT,
IN _registroentrada	DATETIME,
IN _cantidaddias		INT, 
IN _precio)				DECIMAL(7,2)
BEGIN
	INSERT INTO alquileres(idhabitacion, idusuario,registroentrada , cantidaddias, precio ) VALUES
	(_idhabitacion	, _idusuario, _registroentrada, _cantidaddias, _precio);
END $$


DELIMITER $$
CREATE PROCEDURE spu_create_cliente(
IN _idpersona	INT,
IN _idempresa	INT
BEGIN
	INSERT INTO clientes(idpersona, idempresa) VALUES (_idpersona, _idempresa);
END $$


DELIMITER $$
CREATE PROCEDURE spu_create_pago(
IN _idalquiler		INT,
IN _idcliente		INT,
IN _tipocomprobante	CHAR(1),
IN _montopago 	DECIMAL(7,2)
BEGIN
	INSERT INTO pagos(idalquiler, idcliente,tipocomprobante , montopago ) VALUES
	(_idalquiler,  _idcliente, _tipocomprobante, _montopago);
END $$



