<?php

namespace Proxies\__CG__\web\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CmsKeys extends \web\Entity\CmsKeys implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setIdKeys($idKeys)
    {
        $this->__load();
        return parent::setIdKeys($idKeys);
    }

    public function getIdKeys()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["idKeys"];
        }
        $this->__load();
        return parent::getIdKeys();
    }

    public function setConsumido($consumido)
    {
        $this->__load();
        return parent::setConsumido($consumido);
    }

    public function getConsumido()
    {
        $this->__load();
        return parent::getConsumido();
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->__load();
        return parent::setFechaInicio($fechaInicio);
    }

    public function getFechaInicio()
    {
        $this->__load();
        return parent::getFechaInicio();
    }

    public function setFechaFin($fechaFin)
    {
        $this->__load();
        return parent::setFechaFin($fechaFin);
    }

    public function getFechaFin()
    {
        $this->__load();
        return parent::getFechaFin();
    }

    public function setUsuarioCreacion($usuarioCreacion)
    {
        $this->__load();
        return parent::setUsuarioCreacion($usuarioCreacion);
    }

    public function getUsuarioCreacion()
    {
        $this->__load();
        return parent::getUsuarioCreacion();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idKeys', 'consumido', 'fechaInicio', 'fechaFin', 'usuarioCreacion');
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