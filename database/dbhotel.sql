
CREATE DATABASE hoteldb;
USE hoteldb;

CREATE TABLE personas(
	idpersona					INT AUTO_INCREMENT PRIMARY KEY,
	tipodocumento 		CHAR(3) NOT NULL, -- DNI, CDE: Carnet de Extranjeria
	numerodocumento		VARCHAR(12) NOT NULL,
	nombres						VARCHAR(70) NOT NULL,
	apellidos					VARCHAR(70) NOT NULL,
	celular 					CHAR(9) NULL,
	direccion					VARCHAR(100) NULL,
	estado            BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,
	CONSTRAINT uk_numerodocumento_personas UNIQUE(numerodocumento)
)ENGINE=INNODB;

CREATE TABLE usuarios (
	idusuario				INT AUTO_INCREMENT PRIMARY KEY ,
	idpersona				INT NOT NULL,
	nombreusuario		VARCHAR(50) NOT NULL,
	claveacceso			VARCHAR(90) NOT NULL,
	email						VARCHAR(90)NOT NULL,
	estado          BIT NOT NULL DEFAULT 1,
	create_at				DATETIME NOT NULL DEFAULT NOW(),
	update_at				DATETIME NULL,

	CONSTRAINT uk_nombreusuario_usuario UNIQUE(nombreusuario),
	CONSTRAINT fk_idpersona_usuario FOREIGN KEY (idpersona) REFERENCES personas(idpersona)
)ENGINE=INNODB;


CREATE TABLE tipo_habitaciones(
	idtipohabitacion				INT AUTO_INCREMENT PRIMARY KEY,
	nombre 									VARCHAR(90) NOT NULL,
	cantmaxpersona					TINYINT NOT NULL,
	estado              		BIT NOT NULL DEFAULT 1,
	create_at				 				DATETIME NOT NULL DEFAULT NOW(),
	update_at								DATETIME NULL,
	CONSTRAINT uk_nombre_tipohabitacion UNIQUE (nombre)
)ENGINE=INNODB;

CREATE TABLE pisos(
	idpiso						INT AUTO_INCREMENT PRIMARY KEY,
	piso							VARCHAR(40) NOT NULL,
	estado        		BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,
	
	CONSTRAINT uk_piso_piso UNIQUE (piso)
)ENGINE=INNODB;

CREATE TABLE habitaciones(
	idhabitacion				INT AUTO_INCREMENT PRIMARY KEY,
	numHabitacion				INT NOT NULL,
	idtipohabitacion		INT NOT NULL,
	estadohabitacion 		CHAR(1) NOT NULL DEFAULT 'D', -- D: Disponible, O: Ocupado, M: Mantenimiento
	detalles						VARCHAR(300) NOT NULL,
	precio							DECIMAL(7,2) NOT NULL,
	idpiso							INT NOT NULL,
	estado              BIT NOT NULL DEFAULT 1,
	create_at				 		DATETIME NOT NULL DEFAULT NOW(),
	update_at						DATETIME NULL,

	CONSTRAINT fk_idtipohabitacion_habitaciones FOREIGN KEY (idtipohabitacion) REFERENCES tipo_habitaciones(idtipohabitacion),
	CONSTRAINT fk_idpiso_habitaciones FOREIGN KEY (idpiso) REFERENCES pisos(idpiso),
	CONSTRAINT uk_numHabitacion_habitaciones UNIQUE (numHabitacion),
	CONSTRAINT ck_estadohabitacion_habitaciones CHECK (estadohabitacion IN ('D', 'O', 'M'))
)ENGINE=INNODB;


CREATE TABLE empresas(
	idempresa				INT AUTO_INCREMENT PRIMARY KEY,
	ruc							CHAR(11) NOT NULL,
	nombre				  VARCHAR(70) NOT NULL,
	direccion				VARCHAR(100) NULL,
	telefono				CHAR(9) NULL,
	email						VARCHAR(100) NULL,
	estado          BIT NOT NULL DEFAULT 1,
	create_at				DATETIME NOT NULL DEFAULT NOW(),
	update_at				DATETIME NULL,

	CONSTRAINT uk_ruc_empresas UNIQUE(ruc)
)ENGINE=INNODB;

CREATE TABLE clientes(
	idcliente				INT AUTO_INCREMENT PRIMARY KEY,
	idpersona				INT NOT NULL,
	idempresa				INT NULL,
	estado          BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,

	CONSTRAINT fk_idpersona_clientes FOREIGN KEY (idpersona) REFERENCES personas(idpersona),
	CONSTRAINT fk_idempresa_clientes FOREIGN KEY (idempresa) REFERENCES empresas(idempresa)
)ENGINE=INNODB;

CREATE TABLE alquileres(
	idalquiler					INT AUTO_INCREMENT PRIMARY KEY,
	idhabitacion				INT NOT NULL,
	idusuario					INT NOT NULL,
	registroentrada			DATETIME NOT NULL DEFAULT NOW(),
	registrosalida				DATETIME NULL,
	cantidaddias				INT NOT NULL,
	precio						DECIMAL(7,2) NOT NULL,
	estado              		BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,

	CONSTRAINT fk_idhabitacion_alquileres FOREIGN KEY (idhabitacion) REFERENCES habitaciones(idhabitacion),
	CONSTRAINT fk_idusuario_alquileres FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario)
)ENGINE=INNODB;

CREATE TABLE detalles_huspedes(
	iddetallehusped		INT AUTO_INCREMENT PRIMARY KEY,
	idalquiler				INT NOT NULL,
	idpersona					INT NOT NULL,
	estado              BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,

	CONSTRAINT fk_idalquiler_detalles_huspedes FOREIGN KEY (idalquiler) REFERENCES alquileres(idalquiler),
	CONSTRAINT fk_idpersona_detalles_huspedes FOREIGN KEY (idpersona) REFERENCES personas(idpersona)
)ENGINE=INNODB;

CREATE TABLE pagos(
	idpago						INT AUTO_INCREMENT PRIMARY KEY,
	idalquiler				INT NOT NULL,
	idcliente					INT NOT NULL,
	tipocomprobante		CHAR(1) NOT NULL DEFAULT 'B', -- B: Boleta, F: Factura
	montopago					DECIMAL(7,2) NOT NULL,
	fechaemision			DATETIME NOT NULL DEFAULT NOW(),
	estado            BIT NOT NULL DEFAULT 1,
	create_at				 	DATETIME NOT NULL DEFAULT NOW(),
	update_at					DATETIME NULL,

	CONSTRAINT fk_idalquiler_pagos FOREIGN KEY (idalquiler) REFERENCES alquileres(idalquiler),
	CONSTRAINT fk_idcliente_pagos FOREIGN KEY (idcliente) REFERENCES clientes(idcliente)
)ENGINE=INNODB;
