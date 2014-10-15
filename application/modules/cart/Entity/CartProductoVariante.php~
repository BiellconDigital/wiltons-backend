<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoVariante
 *
 * @ORM\Table(name="cart_producto_variante")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoVarianteRepository")
 */
class CartProductoVariante
{
    /**
     * @var integer $idProductoVariante
     *
     * @ORM\Column(name="__id_producto_variante", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductoVariante;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=100, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var cart\Entity\CartProducto
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProducto", inversedBy="variantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idProducto", referencedColumnName="__idProducto", onDelete="CASCADE")
     * })
     */
    private $producto;


    /**
     * Get idProductoVariante
     *
     * @return integer 
     */
    public function getIdProductoVariante()
    {
        return $this->idProductoVariante;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartProductoVariante
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
     * @return CartProductoVariante
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartProductoVariante
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

    /**
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartProductoVariante
     */
    public function setProducto(\cart\Entity\CartProducto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return cart\Entity\CartProducto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
