<?php

namespace Proxies\__CG__\cart\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CartOrdenTipoLanguage extends \cart\Entity\CartOrdenTipoLanguage implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdOrdentipoLanguage()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idOrdentipoLanguage"];
        }
        $this->__load();
        return parent::getIdOrdentipoLanguage();
    }

    public function setDescripcion($descripcion)
    {
        $this->__load();
        return parent::setDescripcion($descripcion);
    }

    public function getDescripcion()
    {
        $this->__load();
        return parent::getDescripcion();
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

    public function setOrdenTipo(\cart\Entity\CartOrdenTipo $ordenTipo = NULL)
    {
        $this->__load();
        return parent::setOrdenTipo($ordenTipo);
    }

    public function getOrdenTipo()
    {
        $this->__load();
        return parent::getOrdenTipo();
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
        return array('__isInitialized__', 'idOrdentipoLanguage', 'descripcion', 'detalle', 'ordenTipo', 'language');
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