<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartUnidadMedida
 *
 * @ORM\Table(name="cart_unidadMedida")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartUnidadMedidaRepository")
 */
class CartUnidadMedida
{
    /**
     * @var integer $idunidadMedida
     *
     * @ORM\Column(name="__idUnidadMedida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idunidadMedida;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=130, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime $fechaActualizacion
     *
     * @ORM\Column(name="__fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;


    /**
     * Get idunidadMedida
     *
     * @return integer 
     */
    public function getIdunidadMedida()
    {
        return $this->idunidadMedida;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartUnidadMedida
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CartUnidadMedida
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return CartUnidadMedida
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    
        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartUnidadMedida
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
}
