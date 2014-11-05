<?php

namespace cart\Services;

/**
 * Description of UnidadMedida
 *
 * @author aramosr
 */
class UnidadMedidaService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartUnidadMedida";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($state="TODOS", $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($state, $pageStart, $pageLimit);
        return $aResult;
    }

    /**
     * 
     * @param array $formData
     * @return \cart\Entity\CartUnidadMedida
     */
    public function save($formData) {
        $aUnidadMedida = $this->_em->getRepository($this->_entity)->save($formData);
        return $aUnidadMedida;
    }
    
    public function getById($id, $asArray=true, $soloActivo=true) {
        $aResult = $this->_em->getRepository($this->_entity)->getById($id, $asArray, $soloActivo);
        return $aResult;
    }
    
    public function delete($idRegistro) {
        $this->_em->getRepository($this->_entity)->delete($idRegistro);
    }
    

}

?>
