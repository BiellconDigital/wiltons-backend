<?php

namespace Proxies\__CG__\web\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CmsLanguage extends \web\Entity\CmsLanguage implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdLanguage()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idLanguage"];
        }
        $this->__load();
        return parent::getIdLanguage();
    }

    public function setIdioma($idioma)
    {
        $this->__load();
        return parent::setIdioma($idioma);
    }

    public function getIdioma()
    {
        $this->__load();
        return parent::getIdioma();
    }

    public function setNombreCorto($nombreCorto)
    {
        $this->__load();
        return parent::setNombreCorto($nombreCorto);
    }

    public function getNombreCorto()
    {
        $this->__load();
        return parent::getNombreCorto();
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

    public function setPrincipal($principal)
    {
        $this->__load();
        return parent::setPrincipal($principal);
    }

    public function getPrincipal()
    {
        $this->__load();
        return parent::getPrincipal();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idLanguage', 'idioma', 'nombreCorto', 'estado', 'principal');
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