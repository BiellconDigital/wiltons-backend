--cambios 09-10-2014
CREATE TABLE cart_producto_variante (__id_producto_variante BIGINT AUTO_INCREMENT NOT NULL, __descripcion VARCHAR(100) DEFAULT NULL, __estado TINYINT(1) DEFAULT NULL, __fecha_registro DATETIME DEFAULT NULL, __idProducto INT DEFAULT NULL, INDEX IDX_7FB829BBC9EE6EC8 (__idProducto), PRIMARY KEY(__id_producto_variante)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

ALTER TABLE cart_producto_variante ADD CONSTRAINT FK_7FB829BBC9EE6EC8 FOREIGN KEY (__idProducto) REFERENCES cart_producto (__idProducto) ON DELETE CASCADE;

--cambios 15-10-2014
ALTER TABLE  `cart_producto_variante` ADD  `__codigo` VARCHAR( 15 ) NULL AFTER  `__id_producto_variante`;
ALTER TABLE  `cart_orden__detalle` ADD  `__codigo_variante` VARCHAR( 15 ) NULL AFTER  `__impuesto_ratio`;


--cambios 04-11-2014
CREATE TABLE cart_unidadMedida (__idUnidadMedida INT AUTO_INCREMENT NOT NULL, __descripcion VARCHAR(130) NOT NULL, __estado TINYINT(1) NOT NULL, __fecha_actualizacion DATETIME DEFAULT NULL, __fecha_registro DATETIME DEFAULT NULL, PRIMARY KEY(__idUnidadMedida)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE cart_orden__detalle ADD __idUnidadMedida INT DEFAULT NULL;
ALTER TABLE cart_orden__detalle ADD CONSTRAINT FK_82254A935F152AFF FOREIGN KEY (__idUnidadMedida) REFERENCES cart_unidadMedida (__idUnidadMedida);
CREATE INDEX IDX_82254A935F152AFF ON cart_orden__detalle (__idUnidadMedida);
ALTER TABLE cart_producto ADD __idUnidadMedida INT DEFAULT NULL;
ALTER TABLE cart_producto ADD CONSTRAINT FK_3924497E5F152AFF FOREIGN KEY (__idUnidadMedida) REFERENCES cart_unidadMedida (__idUnidadMedida);
CREATE INDEX IDX_3924497E5F152AFF ON cart_producto (__idUnidadMedida);
