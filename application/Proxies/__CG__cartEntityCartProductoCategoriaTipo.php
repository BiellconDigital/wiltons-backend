<?php

namespace Proxies\__CG__\cart\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CartProductoCategoriaTipo extends \cart\Entity\CartProductoCategoriaTipo implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdProductocateTipo()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idProductocateTipo"];
        }
        $this->__load();
        return parent::getIdProductocateTipo();
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

    public function setEstado($estado)
    {
        $this->__load();
        return parent::setEstado($estado);
    }

    public function getEstado()
    {
        $this->__load();
        return parent::getEstado();
    }

    public function setContcate(\cart\Entity\CartProductoCategoria $contcate = NULL)
    {
        $this->__load();
        return parent::setContcate($contcate);
    }

    public function getContcate()
    {
        $this->__load();
        return parent::getContcate();
    }

    public function setTipo(\cart\Entity\CartProductoTipo $tipo = NULL)
    {
        $this->__load();
        return parent::setTipo($tipo);
    }

    public function getTipo()
    {
        $this->__load();
        return parent::getTipo();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idProductocateTipo', 'cantidad', 'estado', 'contcate', 'tipo');
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