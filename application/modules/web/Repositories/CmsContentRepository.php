<?php

namespace web\Repositories;

use Doctrine\ORM\EntityRepository;
use Vendors\Paginate\Paginate;

/**
 * CmsContentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CmsContentRepository extends EntityRepository
{
    public function listRecords($toArray, $idcontCate=NULL, $oLanguage=1, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL, $textoBusqueda=NULL) {
        $count= NULL;
        if(!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $oContentCategoria = null;
        if ($idcontCate != NULL) {
            $oContentCategoria = $this->_em->find("\web\Entity\CmsContentCategoria", $idcontCate );
            if(!($oContentCategoria instanceof \web\Entity\CmsContentCategoria)) {
                throw new \Exception('No existe la categoria del content.',1);
            }
        }
//        var_dump($oContentCategoria);
        $qbContent = $this->_em->createQueryBuilder();
        $qbContent->select(
                    '
                    c.idcontent,c.imagen,c.imagen2,c.adjunto,c.orden,c.estado,c.fechainipub,c.url
                    ,c.adicional1,c.adicional2,c.adicional3,
                    c.fechafinpub,c.fechamodf,c.fechareg,
                    cl.descripcion as nombre_content,cl.intro as intro_content,cl.detalle as detalle_content,
                    ca.idcontcate, cal.descripcion as nameCate,
                    t.idTipo
                    '
                    )->from($this->_entityName,'c')
                   ->leftJoin('c.contcate','ca')->leftJoin('c.languages','cl')->leftJoin('c.tipo','t')
                   ->leftJoin('ca.languages','cal')
                    ->where("cl.language = :lang and cal.language= :lang")->setParameter('lang', $oLanguage)
                    ->addOrderBy('ca.ordenCate','ASC')->addOrderBy('c.orden','ASC')
                   ->addOrderBy('c.fechainipub','DESC');
        if ($idcontCate != NULL) $qbContent->andWhere('c.contcate = :categoria')->setParameter('categoria', $oContentCategoria);
        if ($estado != "TODOS") 
            $qbContent->andWhere('c.estado = :estado')->setParameter('estado', $estado);
        if ($textoBusqueda != NULL) $qbContent->andWhere($qbContent->expr()->like('cl.descripcion', '?1'))->setParameter(1, '%' . $textoBusqueda . '%');
        $qyContent = $qbContent->getQuery();
//        echo $qbContent->getDQL();
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyContent);
            $qyContent->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }        
        
        if ($toArray) {
            $aContents = $qyContent->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            $objRecords->normalizeRecord($aContents);
        } else {
            $aContents = $qyContent->getResult();
        }
        
        if ($pageStart == NULL and $pageLimit == NULL) {
            $count = count($aContents);
        }
        
        return array($aContents, $count);
    }


    public function listRecordsXTipo($toArray, $idtipo=NULL, $oLanguage=1, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL, $textoBusqueda=NULL) {
        $count= NULL;
        if(!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $oContentTipo = null;
        if ($idtipo != NULL) {
            $oContentTipo = $this->_em->find("\web\Entity\CmsContentTipo", $idtipo );
            if(!($oContentTipo instanceof \web\Entity\CmsContentTipo)) {
                throw new \Exception('No existe la categoria del content.',1);
            }
        }
        $qbContent = $this->_em->createQueryBuilder();
        $qbContent->select(
                    '
                    c.idcontent,c.imagen,c.imagen2,c.adjunto,c.orden,c.estado,c.fechainipub,c.url
                    ,c.adicional1,c.adicional2,c.adicional3,
                    c.fechafinpub,c.fechamodf,c.fechareg,
                    cl.descripcion as nombre_content,cl.intro as intro_content,cl.detalle as detalle_content,
                    ca.idcontcate, cal.descripcion as nameCate
                    '
                    )->from($this->_entityName,'c')
                   ->leftJoin('c.contcate','ca')->leftJoin('c.languages','cl')->leftJoin('ca.languages','cal')
                    ->where("cl.language = :lang and cal.language= :lang")->setParameter('lang', $oLanguage)
                    ->addOrderBy('ca.ordenCate','ASC')
                   ->addOrderBy('c.fechainipub','DESC')->addOrderBy('c.orden','ASC');
        if ($idtipo != NULL) $qbContent->andWhere('c.tipo = :tipo')->setParameter('tipo', $oContentTipo);
        if ($estado != "TODOS")
            $qbContent->andWhere('c.estado = :estado')->setParameter('estado', $estado);
        if ($textoBusqueda != NULL) $qbContent->andWhere($qbContent->expr()->like('cl.descripcion', '?1'))->setParameter(1, '%' . $textoBusqueda . '%');
        $qyContent = $qbContent->getQuery();
//        echo $qbContent->getDQL();
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyContent);
            $qyContent->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }        
        
        if ($toArray) {
            $aContents = $qyContent->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            $objRecords->normalizeRecord($aContents);
        } else {
            $aContents = $qyContent->getResult();
        }
        
        if ($pageStart == NULL and $pageLimit == NULL) {
            $count = count($aContents);
        }
        
        return array($aContents, $count);
    }

    
    /**
     *
     * @param int $id
     * @param boolean $asArray
     * @param boolean $soloActivo
     * @return \web\Entity\CmsContent $oContent
     */
    public function getById($id, $language=null, $asArray=true, $soloActivo=false) {
        $oContentLang = null;
        try {

            $qbContent = $this->_em->createQueryBuilder();
            $qbContent->select( array("c", "cat"))->from($this->_entityName, 'c')
                        ->innerJoin('c.contcate','cat')
                        ->where("c.idcontent = ?1")
                        ->setParameter(1, $id);


            if ($soloActivo) 
                $qbContent->andWhere('c.estado = 1');
            $qyContent = $qbContent->getQuery();

            if ($asArray) {
                $oContent = $qyContent->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oContent) != 1)
                    throw new \Exception('No existe este registro o no se encuentra disponible.',1);
                $objRecords->normalizeRecord($oContent[0]);
                $oContent = $oContent[0];
            } else {
                try {
                    $oContent = $qyContent->getSingleResult();
                    $idsToFilter = array($language);
                    $oContentLang = $oContent->getLanguages()->filter(
                            function($oContentLang) use ($idsToFilter) {
                                return in_array($oContentLang->getLanguage(), $idsToFilter);
                            })->first();
                    
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe este registro o no se encuentra disponible.',1);
                }
            }
            return array($oContent, $oContentLang);
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            else throw new \Exception('Ocurrió un error en el procesamiento, estaremos solucionandolo en breve.',1);
        }
        
    }
    
}
