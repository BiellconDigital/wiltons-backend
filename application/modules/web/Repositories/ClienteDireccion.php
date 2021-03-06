<?php
namespace Dao\Cart;

use CmsClienteDireccion;
//use Models\CmsTipoDocumento;
//use Models\CmsPais;
use Vendors\Paginate\Paginate;

/**
 * Clase Dao para el manejo de Marcas de ClienteDireccion
 *
 * @author aramosr
 */
class ClienteDireccion {
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    private $_em;
    public static $DIR_DESPACHO = 1;
    public static $DIR_FACTURA = 2;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     *
     * @param Models\CmsCliente $oCliente
     * @param mixed $estado
     * @param int $pageStart
     * @param int $pageLimit
     * @return mixed
     */
    public function listRecords($oCliente, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        $qbClienteDireccion = $this->_em->createQueryBuilder();
        $qbClienteDireccion->select(
                    '
                    cd.idClienteDireccion,cd.direccion,cd.estado,cd.dirprinDespacho,cd.dirDespacho,cd.dirFactura,cd.estado,
                    ,c.idCliente
                    ,td.idTipoDireccion,td.nombreTdoc
                    ,pa.idPais,u.codPostal
                    ')->from('\CmsClienteDireccion','cd')
                    ->innerJoin('cd.tipoDireccion','td')->innerJoin('cd.pais','pa')->innerJoin('cd.cliente','c')
                    ->innerJoin('cd.ubigeo','u')
                    ->orderBy('cd.fechaRegistro','DESC')
                    ->where('cd.cliente = :clie')->setParameter('clie', $oCliente);
        if ($estado != "TODOS") $qbClienteDireccion->andWhere('cd.estado = :estado')->setParameter('estado', $estado);
        $qyClienteDireccion = $qbClienteDireccion->getQuery();//,pa.nombre as nombre_pais
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyClienteDireccion);
            $qyClienteDireccion->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyClienteDireccion, $count);
    }

    
    /**
     * 
     * @param array $formData
     * @param mixed $oCliente
     * @return \CmsClienteDireccion
     * @throws \Exception
     */
    public function save($formData, $oCliente = null) {
        try {
            
            $newRegister = false;
//            $subioArchivo = false;
            
            if (!$oCliente instanceof \CmsCliente)
                $oCliente = $this->_em->find("\CmsCliente", $formData['idCliente'] );
            if(!$oCliente)
                throw new \Exception('No existe Cliente.',1);
            
//            $qbCliDir = $this->_em->createQueryBuilder();
//            $qbCliDir->select('COUNT(c.idClienteDireccion)')->from('\CmsClienteDireccion','c')
//                        ->andWhere('c.estado = :estado')->setParameter('estado', 1)
//                        ->andWhere('c.dirprinDespacho = :prin')->setParameter('prin', 1)
//                        ->andWhere($qbCliDir->expr()->neq('c.idClienteDireccion', ':idc'))->setParameter('idc', $formData['idClienteDireccion'])
//                        ->andWhere('c.cliente = :cliente')->setParameter('cliente', $oCliente);
//            $totalClienteDireccion = $qbCliDir->getQuery()->getSingleScalarResult();
////            echo $totalClienteDireccion;
//            if ($totalClienteDireccion > 0 and isset($formData['dirprinDespacho']))
//                throw new \Exception('Ya se encuentra registrado una direcci�n principal de despacho para el cliente.',1);
            
            if (is_numeric($formData['idClienteDireccion']) ) {
                $oClienteDireccion = $this->_em->find("\CmsClienteDireccion", $formData['idClienteDireccion'] );
            }
            else {
                $oClienteDireccion = new CmsClienteDireccion();
                $newRegister = true;
            }

            $oTipoDireccion = $this->_em->find("\CmsTipoDireccion", $formData['idTipoDireccion'] );
            if(!$oTipoDireccion)
                throw new \Exception('No existe tipo de direcci�n. Seleccione primero una tipo.',1);
                
            $oPais = $this->_em->find("\CmsPais", $formData['idPais'] );
            if(!$oPais)
                throw new \Exception('No existe Pa�s. Seleccione primero una Pa�s.',1);
                
            $oClienteDireccion->setDireccion($formData['direccion']);
            if(isset($formData['codPostal'])) {
                $oUbigeo = $this->_em->find("\CmsUbigeo", $formData['codPostal'] );
                if(!$oUbigeo)
                    throw new \Exception('No existe Distrito, por favor seleccione uno mientras ingresa el texto.',1);
                $oClienteDireccion->setUbigeo($oUbigeo);
            }
            $oClienteDireccion->setTipoDireccion($oTipoDireccion);
            $oClienteDireccion->setPais($oPais);
            $oClienteDireccion->setCliente($oCliente);
            $oClienteDireccion->setEstado(1);//isset($formData['estado'])?1:0
//            $oClienteDireccion->setDirprinDespacho(isset($formData['dirprinDespacho'])?1:0);
            $oClienteDireccion->setDirDespacho($formData['dirDespacho']);
            $oClienteDireccion->setDirFactura($formData['dirFactura']);
            $oClienteDireccion->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oClienteDireccion);
            $this->_em->flush();
            
            return $oClienteDireccion;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro direcci�n. ',1);// . $e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        try {
            $oClienteDireccion = $this->_em->find('\CmsClienteDireccion',$idRegistro);
            if(!$oClienteDireccion) 
                throw new \Exception("No exite ClienteDireccion con el ID ".$idRegistro .".",2);
            @unlink($this->_pathClienteDireccion . trim($oClienteDireccion->getFoto()));
            $this->_em->remove($oClienteDireccion);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el ClienteDireccion.",1);
        }
    }


    public function getById($id, $asArray=true) {
        $dqlList = 'SELECT c FROM \CmsClienteDireccion c WHERE c.idClienteDireccion = ?1';
        $qyClienteDireccion = $this->_em->createQuery($dqlList);
        $qyClienteDireccion->setParameter(1,$id);
        if ($asArray) {
            $oClienteDireccion = $qyClienteDireccion->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oClienteDireccion) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oClienteDireccion[0]);
            $oClienteDireccion = $oClienteDireccion[0];
        } else {
            $oClienteDireccion = $qyClienteDireccion->getSingleResult();
        }
        return $oClienteDireccion;
    }
    
    /**
     *
     * @param CmsClienteDireccion $oCliente
     * @param boolean $asArray
     * @return mixed 
     */
    public function getDirPrinDespacho($oCliente, $asArray=true) {
        $dqlList = 'SELECT d.idClienteDireccion,d.dirprinDespacho,d.direccion,td.idTipoDireccion,p.idPais 
                    FROM \CmsClienteDireccion d JOIN d.tipoDireccion td JOIN d.pais p 
                    WHERE d.dirprinDespacho = 1 AND d.estado=1 AND d.cliente=?1';//dirprinDespacho
        $qyClienteDireccion = $this->_em->createQuery($dqlList);
        $qyClienteDireccion->setParameter(1,$oCliente);
        if ($asArray) {
            $oClienteDireccion = $qyClienteDireccion->getArrayResult();//getScalarResult
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oClienteDireccion) != 1)
                return null;
            $objRecords->normalizeRecord($oClienteDireccion[0]);
            $oClienteDireccion = $oClienteDireccion[0];
        } else {
            try {
                $oClienteDireccion = $qyClienteDireccion->getSingleResult();
            } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
            }
        }
        return $oClienteDireccion;
    }
    
    /**
     *
     * @param CmsCliente $oCliente
     * @param boolean $asArray
     * @return CmsClienteDireccion
     */
    public function getDirPorTipo($oCliente, $tipo_dir, $asArray=true) {
        if ($asArray) {
        $dqlList = 'SELECT d.idClienteDireccion,d.direccion,td.idTipoDireccion,d.dirDespacho,d.dirFactura,d.estado,p.idPais
                    FROM \CmsClienteDireccion d JOIN d.tipoDireccion td JOIN d.pais p
                    WHERE d.estado=1 AND d.cliente=?1';//dirprinDespacho
        } else {
            $dqlList = 'SELECT d FROM \CmsClienteDireccion d WHERE d.estado=1 AND d.cliente=?1';
        }
        if ($tipo_dir == 1) {
            $dqlList .= ' AND d.dirDespacho = 1';
        } else if ($tipo_dir == 2) {
            $dqlList .= ' AND d.dirFactura = 1';
        } else {
            $dqlList .= ' AND d.dirFactura = 0';
        }
        
        $qyClienteDireccion = $this->_em->createQuery($dqlList);
        $qyClienteDireccion->setParameter(1,$oCliente);
        if ($asArray) {
            $oClienteDireccion = $qyClienteDireccion->getArrayResult();//getScalarResult
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oClienteDireccion) != 1)
                return null;
            $objRecords->normalizeRecord($oClienteDireccion[0]);
            $oClienteDireccion = $oClienteDireccion[0];
        } else {
            try {
                $qyClienteDireccion->setFirstResult(0)->setMaxResults(1);
                $oClienteDireccion = $qyClienteDireccion->getSingleResult();
            } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
            }
        }
        return $oClienteDireccion;
    }
    
    public function listformSelect($oCliente, $tipo_dir) {
        $qbClienteDireccion = $this->_em->createQueryBuilder();
        $qbClienteDireccion->select(
                    '
                    cd.idClienteDireccion,cd.direccion
                    ')->from('\CmsClienteDireccion','cd')
                    ->where("cd.dirDespacho = ?1 AND cd.cliente = ?2")
                    ->setParameters(array(1 => $tipo_dir, 2 => $oCliente));
        
        $respu[0] = "--";
        $qyClienteDireccion = $qbClienteDireccion->getQuery();
        $aClienteDir = $qyClienteDireccion->getArrayResult();
        foreach ($aClienteDir as $rowDir) {
            $respu[$rowDir['idClienteDireccion']]=$rowDir['direccion'];
        }
        return $respu;
    }
    
}

?>
