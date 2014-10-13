<?php
namespace cart\Services;

use cart\Entity\CartProductoVariante;
use cart\Entity\CartProductoVarianteLanguage;

/**
 * Clase Dao para el manejo de Variante de Producto
 *
 * @author aramosr
 */
class ProductoVariante {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProductoVariante";

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idproducto=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($idproducto, $oLanguage, $pageStart, $pageLimit);
        return $aResult;
    }
    
    public function save(array $formData) {
        try {
            $newRegister = false;
            if (is_numeric($formData['idProductoVariante']) && $formData['idProductoVariante'] != 0) {
                $oProductoVariante = $this->_em->find("\cart\Entity\CartProductoVariante", $formData['idProductoVariante'] );
            }
            else {
                $oProductoVariante = new CartProductoVariante();
                $newRegister = true;
            }
            $Producto = $this->_em->find("cart\Entity\CartProducto", $formData['idproducto'] );

            $oProductoVariante->setDescripcion($formData['descripcion']);
            $oProductoVariante->setProducto($Producto);
            $oProductoVariante->setEstado(true);
            $this->_em->persist($oProductoVariante);
            $this->_em->flush();

            return $oProductoVariante;
        } catch( \Exception $e) {
            throw new \Exception("Error al guardar registro.",2);
        }
    }


    public function delete($idRegistro) {
        try {
            $oProductoVariante = $this->_em->find('cart\Entity\CartProductoVariante',$idRegistro);
            if(!$oProductoVariante) 
                throw new \Exception("No exite el registro con el ID ".$idRegistro .".",2);
            $this->_em->remove($oProductoVariante);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el registro.", 2);
        }
    }

}

?>
