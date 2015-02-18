<?php

namespace Proxies\__CG__\cart\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CartOrdenEstadoLanguage extends \cart\Entity\CartOrdenEstadoLanguage implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdOrdenestadoLanguage()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idOrdenestadoLanguage"];
        }
        $this->__load();
        return parent::getIdOrdenestadoLanguage();
    }

    public function setNombre($nombre)
    {
        $this->__load();
        return parent::setNombre($nombre);
    }

    public function getNombre()
    {
        $this->__load();
        return parent::getNombre();
    }

    public function setDetalle($detalle)
    {
        $this->__load();
        return parent::setDetalle($detalle);
    }

    public function getDetalle()
    {
        $this->__load();
        return parent::getDetalle();
    }

    public function setOrdenEstado(\cart\Entity\CartOrdenEstado $ordenEstado = NULL)
    {
        $this->__load();
        return parent::setOrdenEstado($ordenEstado);
    }

    public function getOrdenEstado()
    {
        $this->__load();
        return parent::getOrdenEstado();
    }

    public function setLanguage(\web\Entity\CmsLanguage $language = NULL)
    {
        $this->__load();
        return parent::setLanguage($language);
    }

    public function getLanguage()
    {
        $this->__load();
        return parent::getLanguage();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idOrdenestadoLanguage', 'nombre', 'detalle', 'ordenEstado', 'language');
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