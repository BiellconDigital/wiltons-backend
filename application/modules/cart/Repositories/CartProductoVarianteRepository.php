<?php

namespace cart\Repositories;

use Doctrine\ORM\EntityRepository;
use Vendors\Paginate\Paginate;

/**
 * CartProductoVarianteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartProductoVarianteRepository extends EntityRepository
{
    public function listRecords($idProducto, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
//        $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $oProducto = $this->_em->find("\cart\Entity\CartProducto", $idProducto );
        if(!$oProducto)
            throw new \Exception('No existe el registro.');

        $dqlList = 'SELECT pv.idProductoVariante, pv.estado,
                           pv.codigo, pv.descripcion
                    from \cart\Entity\CartProductoVariante pv 
                    INNER JOIN pv.producto p
                    WHERE pv.producto = ?1';
        $qyProductoVariante = $this->_em->createQuery($dqlList);
        $qyProductoVariante->setParameter(1, $oProducto);
                //->setParameter(2, $oLanguage);
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyProductoVariante);
            $qyProductoVariante->setFirstResult($pageStart)->setMaxResults($pageLimit);
            $aProductoVariante = $qyProductoVariante->getResult();
        } else {
            $aProductoVariante = $qyProductoVariante->getResult();
            $count = count($aProductoVariante);
        }
        return array($aProductoVariante, $count, $oProducto);
    }

    public function getById($id, $asArray=true) {
        $dqlList = 'SELECT pv FROM \cart\Entity\CartProductoVariante pv WHERE pv.idProductoVariante = ?1';
        $qyProductoVariante = $this->_em->createQuery($dqlList);
        $qyProductoVariante->setParameter(1,$id);
        if ($asArray) {
            $oProductoVariante = $qyProductoVariante->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oProductoVariante) != 1)
                throw new Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oProductoVariante[0]);
            $oProductoVariante = $oProductoVariante[0];
        } else {
            $oProductoVariante = $qyProductoVariante->getSingleResult();
        }
        return $oProductoVariante;
    }
    
}
