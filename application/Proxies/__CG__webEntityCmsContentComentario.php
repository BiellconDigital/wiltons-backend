<?php

namespace Proxies\__CG__\web\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class CmsContentComentario extends \web\Entity\CmsContentComentario implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getIdContentComentario()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["idContentComentario"];
        }
        $this->__load();
        return parent::getIdContentComentario();
    }

    public function setTitulo($titulo)
    {
        $this->__load();
        return parent::setTitulo($titulo);
    }

    public function getTitulo()
    {
        $this->__load();
        return parent::getTitulo();
    }

    public function setComentario($comentario)
    {
        $this->__load();
        return parent::setComentario($comentario);
    }

    public function getComentario()
    {
        $this->__load();
        return parent::getComentario();
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

    public function setCliente(\web\Entity\CmsCliente $cliente = NULL)
    {
        $this->__load();
        return parent::setCliente($cliente);
    }

    public function getCliente()
    {
        $this->__load();
        return parent::getCliente();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idContentComentario', 'titulo', 'comentario', 'estado', 'fechaRegistro', 'content', 'cliente');
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