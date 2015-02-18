<?php

namespace Proxies\__CG__\web\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CmsContentGaleria extends \web\Entity\CmsContentGaleria implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdcontgale()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idcontgale"];
        }
        $this->__load();
        return parent::getIdcontgale();
    }

    public function setOrdenGale($ordenGale)
    {
        $this->__load();
        return parent::setOrdenGale($ordenGale);
    }

    public function getOrdenGale()
    {
        $this->__load();
        return parent::getOrdenGale();
    }

    public function setImagenGale($imagenGale)
    {
        $this->__load();
        return parent::setImagenGale($imagenGale);
    }

    public function getImagenGale()
    {
        $this->__load();
        return parent::getImagenGale();
    }

    public function setFecharegGale($fecharegGale)
    {
        $this->__load();
        return parent::setFecharegGale($fecharegGale);
    }

    public function getFecharegGale()
    {
        $this->__load();
        return parent::getFecharegGale();
    }

    public function addLanguage(\web\Entity\CmsContentGaleriaLanguage $languages)
    {
        $this->__load();
        return parent::addLanguage($languages);
    }

    public function removeLanguage(\web\Entity\CmsContentGaleriaLanguage $languages)
    {
        $this->__load();
        return parent::removeLanguage($languages);
    }

    public function getLanguages()
    {
        $this->__load();
        return parent::getLanguages();
    }

    public function setContent(\web\Entity\CmsContent $content = NULL)
    {
        $this->__load();
        return parent::setContent($content);
    }

    public function getContent()
    {
        $this->__load();
        return parent::getContent();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idcontgale', 'ordenGale', 'imagenGale', 'fecharegGale', 'languages', 'content');
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