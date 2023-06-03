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
	habitaciones.numpiso
	FROM habitaciones
	INNER JOIN tipo_habitaciones ON tipo_habitaciones.idtipohabitacion = habitaciones.idtipohabitacion
	WHERE habitaciones.estado = 1
    ORDER BY habitaciones.numHabitacion ASC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_registrar_habitacion(
	IN _numHabitacion INT,
	IN _idtipohabitacion INT,
	IN _detalles VARCHAR(300),
	IN _precio DECIMAL(7,2),
	IN _numpiso INT
)
BEGIN
	INSERT INTO habitaciones(numHabitacion, idtipohabitacion, detalles, precio, numpiso)
	VALUES(_numHabitacion, _idtipohabitacion, _detalles, _precio, _numpiso);
END $$

DELIMITER $$
CREATE PROCEDURE spu_actualizar_habitacion(
	IN _idhabitacion INT,
	IN _numHabitacion INT,
	IN _idtipohabitacion INT,
	IN _detalles VARCHAR(300),
	IN _precio DECIMAL(7,2),
	IN _numpiso INT
)
BEGIN
	UPDATE habitaciones SET
		numHabitacion = _numHabitacion,
		idtipohabitacion = _idtipohabitacion,
		detalles = _detalles,
		precio = _precio,
		numpiso = _numpiso,
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
CREATE PROCEDURE spu_registrarAlquiler(
	IN _idpersona INT,
	IN _idempresa INT,
	IN _idhabitacion INT,
	IN _idusuario INT,
	IN _registroentrada DATETIME,
	IN _cantidaddias	INT,
	IN _precio DECIMAL(7,2),
	IN _tipocomprobante CHAR(1),
	IN _huespedes VARCHAR(30)
)
BEGIN
	-- REGISTRO CLIENTE
	-- DECLARAR VARIABLES PERSONAS Y EMPRESAS
	DECLARE elemento INT;
	DECLARE fin INT DEFAULT 0;
	DECLARE pos INT DEFAULT 1;
	SET @idpersona = _idpersona;
	SET @idempresa = _idempresa;

	IF @idpersona = "" THEN
		SET @idpersona = NULL;
	END IF;

	IF @idempresa = "" THEN
		SET @idempresa = NULL;
	END IF;

	INSERT INTO clientes(idpersona, idempresa) VALUES (@idpersona, @idempresa);
	SET @idcliente = LAST_INSERT_ID();

	-- CREAMOS EL NUMERO DE COMPROBANTE
	-- SI ES BOLETA EMPEZARA CON B Y SI ES FACTURA EMPEZARA CON F
	-- TENDRA 9 CARACTERES
	-- EJEMPLOS B00000001, F00000001 
	IF _tipocomprobante = 'B' THEN
		SET @serie = 'B';
		SET @numcomprobante = (SELECT COUNT(*) + 1 FROM alquileres WHERE tipocomprobante = 'B');
	ELSE
		SET @serie = 'F';
		SET @numcomprobante = (SELECT COUNT(*) + 1 FROM alquileres WHERE tipocomprobante = 'F');
	END IF;

	-- CONCATENAMOS EL NUMERO DE COMPROBANTE
	SET @numcomprobante = CONCAT(@serie, LPAD(@numcomprobante, 8, '0'));
	
	-- insertar alquiler
	INSERT INTO alquileres(idhabitacion, idusuario, idcliente, registroentrada, cantidaddias, precio, tipocomprobante, numcomprobante)
	VALUES(_idhabitacion, _idusuario, @idcliente, _registroentrada, _cantidaddias, _precio, _tipocomprobante,  @numcomprobante);
	SET @idalquiler = LAST_INSERT_ID();
	
	-- cambiar estado a la habitacion 
	UPDATE habitaciones SET estadohabitacion = 'O' WHERE idhabitacion = _idhabitacion;
	
	-- INSERTAR PERSONAS EN EL ALQUILER
	-- VIENE LOS ID SEPARADOS POR COMAS
	-- VAMOS A RECORRER CON UN WHILE Y SEPARAMOS LOS ID PARA INSERTARLOS
  WHILE NOT fin DO
    SET pos = LOCATE(',', _huespedes);
    IF pos = 0 THEN
      SET fin = 1;
      SET pos = LENGTH(_huespedes) + 1;
    END IF;
    
    SET elemento = SUBSTRING(_huespedes, 1, pos - 1);
    SET _huespedes = SUBSTRING(_huespedes, pos + 1);
    -- Realizar la inserción con el valor del elemento
    INSERT INTO detalles_huespedes(idalquiler, idpersona)
		VALUES(@idalquiler, elemento);
  END WHILE;
END $$

DELIMITER $$
CREATE PROCEDURE buscarclientes(
IN _tipocomprobante		CHAR(1),
IN _numerodocumento	VARCHAR(11)
)
BEGIN
	IF _tipocomprobante = 'B' THEN
		SELECT CONCAT(nombres, ' ' , apellidos) AS 'nombre', idpersona AS 'id', direccion FROM personas WHERE numerodocumento = _numerodocumento;
	ELSE
		SELECT nombre, direccion, idempresa AS 'id' FROM empresas WHERE  ruc = _numerodocumento;
	END IF;
END $$

DELIMITER $$
CREATE PROCEDURE buscarHuespedes(
IN _numerodocumento	VARCHAR(11)
)
BEGIN
	SELECT  nombres , apellidos, numerodocumento , idpersona FROM personas WHERE numerodocumento = _numerodocumento;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detalle_alquiler(IN _idhabitacion  INT)
BEGIN
	SELECT alquileres.idalquiler, alquileres.fechaemision, alquileres.registroentrada,
    alquileres.cantidaddias, alquileres.tipocomprobante, alquileres.numcomprobante, 
	alquileres.precio * alquileres.cantidaddias AS 'total'
	FROM alquileres 
    INNER JOIN habitaciones ON habitaciones.idhabitacion = alquileres.idhabitacion
    WHERE alquileres.idhabitacion = _idhabitacion AND alquileres.registrosalida IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_obtener_cliente(IN _idhabitacion INT)
BEGIN
	DECLARE _idpersona INT;
	DECLARE _idempresa INT;
	DECLARE _cliente INT;

	/*obtenemos el id del alquiler dependiendo de el _idhabitacion*/
	SELECT idcliente INTO  _cliente FROM alquileres WHERE idhabitacion = _idhabitacion AND registrosalida IS NULL;
	
	SELECT idempresa, idpersona
    INTO _idempresa, _idpersona
	FROM clientes WHERE  idcliente =  _cliente;

	IF _idpersona IS NOT NULL THEN
		SELECT CONCAT(personas.nombres, ' ', personas.apellidos) AS 'nombre', personas.numerodocumento AS 'numerodocumento', personas.direccion AS 'direccion'
		FROM personas
		WHERE idpersona = _idpersona;
	ELSE
		SELECT empresas.nombre AS 'nombre', empresas.ruc AS 'numerodocumento', empresas.direccion AS 'direccion'
		FROM empresas
		WHERE idempresa = _idempresa;
	END IF;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detalle_huesped_alquiler(IN _idhabitacion  INT)
BEGIN
	DECLARE _idalquiler INT;
	SELECT idalquiler INTO  _idalquiler FROM alquileres WHERE idhabitacion = _idhabitacion AND registrosalida IS NULL;
	
	SELECT personas.numerodocumento, CONCAT(personas.nombres, ' ', personas.apellidos)  as 'nombres'
	FROM detalles_huespedes
	INNER JOIN personas ON detalles_huespedes.idpersona = personas.idpersona
  WHERE idalquiler = _idalquiler;
END $$

DELIMITER $$
CREATE PROCEDURE spu_registrarSalida(IN _alquiler INT, IN _idhabitacion INT)
BEGIN
	UPDATE alquileres SET registrosalida = NOW(), update_at =NOW()  WHERE idalquiler = _alquiler;
	UPDATE habitaciones SET estadohabitacion = 'D' WHERE idhabitacion = _idhabitacion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_actualizarHabitacionADisponible(IN _idhabitacion INT)
BEGIN
	UPDATE habitaciones SET estadohabitacion = 'D' WHERE idhabitacion = _idhabitacion;
END $$

-- REPORTES
-- 1) obtener el total de habitaciones alquiladias el los ultimos 7 dias
DELIMITER $$
CREATE PROCEDURE spu_habitacionesalquiladasultimos7dias()
BEGIN
	SELECT DATE(registroentrada) AS 'fecha', COUNT(*) AS 'total' FROM alquileres
	WHERE DATE(registroentrada) BETWEEN DATE(NOW()) - INTERVAL 7 DAY AND DATE(NOW())
	GROUP BY DATE(registroentrada); 
END $$

-- 2) tipos de habitaciones mas alquiladas grafica el tipo y el total
DELIMITER $$
CREATE PROCEDURE spu_tipohabitacionmasalquilada()
BEGIN
	SELECT tipo_habitaciones.nombre, COUNT(*) AS 'total' FROM alquileres 
	INNER JOIN habitaciones  ON alquileres.idhabitacion = habitaciones.idhabitacion
	INNER JOIN tipo_habitaciones  ON habitaciones.idtipohabitacion = tipo_habitaciones.idtipohabitacion
	GROUP BY tipo_habitaciones.nombre;
END $$

-- 3 reporte de los alquuileres entre dos fechas que cuente el inico y fin tambien
DELIMITER $$
CREATE PROCEDURE spu_alquileresentrefechas(IN _fecha1 DATE, IN _fecha2 DATE)
BEGIN
	SELECT habitaciones.numHabitacion, tipo_habitaciones.nombre,
    alquileres.registroentrada, alquileres.registrosalida,
	IF(personas.nombres IS NULL, empresas.nombre, CONCAT(personas.nombres, ' ', personas.apellidos)) AS 'cliente',
    alquileres.tipocomprobante, alquileres.cantidaddias * alquileres.precio as 'total'
	FROM alquileres
    INNER JOIN clientes on clientes.idcliente = alquileres.idcliente
    LEFT JOIN personas on personas.idpersona = clientes.idpersona
    LEFT JOIN empresas ON clientes.idempresa = empresas.idempresa
    INNER JOIN habitaciones on habitaciones.idhabitacion = alquileres.idhabitacion
    INNER JOIN tipo_habitaciones on habitaciones.idtipohabitacion = tipo_habitaciones.idtipohabitacion
	WHERE  DATE(alquileres.registroentrada) BETWEEN _fecha1 AND _fecha2  ;
END $$

call spu_alquileresentrefechas('2023-05-31', '2023-06-02');

-- 4) reporte de las habitaciones mas alquiladas
-- AGRUPAR POR ID DE HABITACION 
DELIMITER $$
CREATE PROCEDURE spu_habitacionesmasalquiladas()
BEGIN
	SELECT habitaciones.numHabitacion, tipo_habitaciones.nombre as 'tipo', count(*) as total FROM alquileres
		INNER JOIN habitaciones ON habitaciones.idhabitacion = alquileres.idhabitacion
		INNER JOIN tipo_habitaciones ON tipo_habitaciones.idtipohabitacion = habitaciones.idtipohabitacion
		GROUP BY habitaciones.idhabitacion
		ORDER BY COUNT(*) DESC;
END $$
