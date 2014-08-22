<?php

namespace Proxies\__CG__\cart\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CartOrdenDetalle extends \cart\Entity\CartOrdenDetalle implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getIdOrdenDetalle()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["idOrdenDetalle"];
        }
        $this->__load();
        return parent::getIdOrdenDetalle();
    }

    public function setProductoNombre($productoNombre)
    {
        $this->__load();
        return parent::setProductoNombre($productoNombre);
    }

    public function getProductoNombre()
    {
        $this->__load();
        return parent::getProductoNombre();
    }

    public function setCantidad($cantidad)
    {
        $this->__load();
        return parent::setCantidad($cantidad);
    }

    public function getCantidad()
    {
        $this->__load();
        return parent::getCantidad();
    }

    public function setPrecioUnitario($precioUnitario)
    {
        $this->__load();
        return parent::setPrecioUnitario($precioUnitario);
    }

    public function getPrecioUnitario()
    {
        $this->__load();
        return parent::getPrecioUnitario();
    }

    public function setPrecioTotal($precioTotal)
    {
        $this->__load();
        return parent::setPrecioTotal($precioTotal);
    }

    public function getPrecioTotal()
    {
        $this->__load();
        return parent::getPrecioTotal();
    }

    public function setImpuestoTotal($impuestoTotal)
    {
        $this->__load();
        return parent::setImpuestoTotal($impuestoTotal);
    }

    public function getImpuestoTotal()
    {
        $this->__load();
        return parent::getImpuestoTotal();
    }

    public function setImpuestoRatio($impuestoRatio)
    {
        $this->__load();
        return parent::setImpuestoRatio($impuestoRatio);
    }

    public function getImpuestoRatio()
    {
        $this->__load();
        return parent::getImpuestoRatio();
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->__load();
        return parent::setFechaRegistro($fechaRegistro);
    }

    public function getFechaRegistro()
    {
        $this->__load();
        return parent::getFechaRegistro();
    }

    public function setFechaModificacion($fechaModificacion)
    {
        $this->__load();
        return parent::setFechaModificacion($fechaModificacion);
    }

    public function getFechaModificacion()
    {
        $this->__load();
        return parent::getFechaModificacion();
    }

    public function setOrden(\cart\Entity\CartOrden $orden = NULL)
    {
        $this->__load();
        return parent::setOrden($orden);
    }

    public function getOrden()
    {
        $this->__load();
        return parent::getOrden();
    }

    public function setProducto(\cart\Entity\CartProducto $producto = NULL)
    {
        $this->__load();
        return parent::setProducto($producto);
    }

    public function getProducto()
    {
        $this->__load();
        return parent::getProducto();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idOrdenDetalle', 'productoNombre', 'cantidad', 'precioUnitario', 'precioTotal', 'impuestoTotal', 'impuestoRatio', 'fechaRegistro', 'fechaModificacion', 'orden', 'producto');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}