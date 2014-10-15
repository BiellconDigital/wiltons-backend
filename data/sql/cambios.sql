--cambios 09-10-2014
CREATE TABLE cart_producto_variante (__id_producto_variante BIGINT AUTO_INCREMENT NOT NULL, __descripcion VARCHAR(100) DEFAULT NULL, __estado TINYINT(1) DEFAULT NULL, __fecha_registro DATETIME DEFAULT NULL, __idProducto INT DEFAULT NULL, INDEX IDX_7FB829BBC9EE6EC8 (__idProducto), PRIMARY KEY(__id_producto_variante)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

ALTER TABLE cart_producto_variante ADD CONSTRAINT FK_7FB829BBC9EE6EC8 FOREIGN KEY (__idProducto) REFERENCES cart_producto (__idProducto) ON DELETE CASCADE;

--cambios 15-10-2014
ALTER TABLE  `cart_producto_variante` ADD  `__codigo` VARCHAR( 15 ) NULL AFTER  `__id_producto_variante`