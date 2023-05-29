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
    ORDER BY habitaciones.numHabitacion Asc;
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

