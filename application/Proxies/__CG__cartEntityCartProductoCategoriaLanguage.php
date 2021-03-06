<?php

namespace Proxies\__CG__\cart\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CartProductoCategoriaLanguage extends \cart\Entity\CartProductoCategoriaLanguage implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdProductocateLanguage()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idProductocateLanguage"];
        }
        $this->__load();
        return parent::getIdProductocateLanguage();
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
        return array('__isInitialized__', 'idProductocateLanguage', 'descripcion', 'detalle', 'contcate', 'language');
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