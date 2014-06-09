<?php

namespace web\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * CmsKeysRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CmsKeysRepository extends EntityRepository
{
    public function listRecords($pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        $dqlList = 'SELECT m from \web\Entity\CmsKeys m';
        $qyKeys = $this->_em->createQuery($dqlList);
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyKeys);
            $qyKeys->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyKeys, $count);
    }

    
    public function addKey($keyValidacion, \web\Entity\CmsCliente $oCliente) {
        try {
            $objFecha = new \DateTime();
            $objFecha2 = new \DateTime();
            $objFecha2->setTimestamp( strtotime("+24 hours", $objFecha->getTimestamp()) );

            $oKey = new \web\Entity\CmsKeys();
            $oKey->setIdKeys($keyValidacion);
            $oKey->setConsumido(0);
            $oKey->setFechaInicio($objFecha);
            $oKey->setFechaFin($objFecha2);
            $oKey->setUsuarioCreacion($oCliente->getIdCliente());
            $this->_em->persist($oKey);
            $this->_em->flush();
            return $oKey;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro de key. ',1);
        }
    }

    public function verificarActivo($key) {
        try {
                $oFecha =new \DateTime();
                $query2 = $this->_em->createQuery('SELECT k from \web\Entity\CmsKeys k 
                    WHERE k.idKeys = :key AND k.consumido=0 AND k.fechaInicio <= :fecha and k.fechaFin >= :fecha');
                $query2->setParameter('key' ,$key)->setParameter('fecha' , $oFecha->format("Y-m-d H:i:s"));
                try {
                    $oKey = $query2->getSingleResult();
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('La clave de seguridad no existe o ya no esta disponible.',1);
                }
            return $oKey;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al consultar clave de activación.',1);
        }
    }
    
    public function consumirKey($oKey) {
        try {
//            $oKey = $this->find($key);
            $oKey->setConsumido(1);
            $this->_em->persist($oKey);
            $this->_em->flush();
            return $oKey;
        } catch(\Exception $e) {
            throw new \Exception('Ocurrió un error en la actualización de clave de activación.',1);
        }
    }
}
