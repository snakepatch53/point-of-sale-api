CREATE TABLE infos (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100),
    sigla VARCHAR(50),
    logo VARCHAR(10),
    icon VARCHAR(10),
    ciudad VARCHAR(50),
    direccion VARCHAR(100),
    telefono VARCHAR(11),
    celular VARCHAR(11),
    email VARCHAR(100),
    iva DOUBLE
) ENGINE INNODB;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50),
    user VARCHAR(50),
    pass VARCHAR(50),
    foto VARCHAR(10)
) ENGINE INNODB;

CREATE TABLE bodega (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50),
    descripcion TEXT
) ENGINE INNODB;

CREATE TABLE proveedor (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50),
    provicia VARCHAR(50),
    ciudad VARCHAR(50),
    direccion VARCHAR(50),
    telefono VARCHAR(11),
    celular VARCHAR(11),
    email VARCHAR(50),
    ruc VARCHAR(50)
) ENGINE INNODB;

CREATE TABLE cliente (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre1 VARCHAR(20),
    nombre2 VARCHAR(20),
    apellido1 VARCHAR(20),
    apellido2 VARCHAR(20),
    cedula VARCHAR(50),
    ruc VARCHAR(50),
    ciudad VARCHAR(50),
    direccion VARCHAR(50),
    telefono VARCHAR(11),
    celular VARCHAR(11),
    email VARCHAR(50)
) ENGINE INNODB;

CREATE TABLE producto (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50),
    codigo TEXT,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    elaboracion VARCHAR(50),
    vencimiento VARCHAR(50),
    descripcion TEXT,
    foto VARCHAR(10),
    bodega_id INT,
    FOREIGN KEY (bodega_id) REFERENCES bodega (bodega_id)
) ENGINE INNODB;

CREATE TABLE producto_compra (
    compra_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    compra_fecha VARCHAR(20),
    compra_iva DOUBLE,
    proveedor_id INT,
    usuario_id INT,
    FOREIGN KEY (proveedor_id) REFERENCES proveedor (proveedor_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
) ENGINE INNODB;

CREATE TABLE producto_entrada (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fecha VARCHAR(20),
    cantidad INT,
    precio DOUBLE,
    comision DOUBLE,
    producto_id INT,
    producto_compra_id INT,
    FOREIGN KEY (producto_id) REFERENCES producto (producto_id),
    FOREIGN KEY (producto_compra_id) REFERENCES producto_compra (producto_compra_id) ON DELETE CASCADE
) ENGINE INNODB;

CREATE TABLE producto_venta (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fecha VARCHAR(20),
    iva DOUBLE,
    cliente_id INT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
) ENGINE INNODB;

CREATE TABLE producto_salida (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fecha VARCHAR(20),
    cantidad INT,
    precio DOUBLE,
    comision DOUBLE,
    producto_id INT,
    producto_venta_id INT,
    FOREIGN KEY (producto_id) REFERENCES producto (producto_id),
    FOREIGN KEY (producto_venta_id) REFERENCES producto_venta (producto_venta_id) ON DELETE CASCADE
) ENGINE INNODB;