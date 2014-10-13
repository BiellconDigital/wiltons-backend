<?php
use cart\Services\Producto;
use cart\Services\ProductoVariante;
use Tonyprr\Exception\ValidacionException;

class Api_ProductoVarianteController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

//        $bootstrap = $this->getInvokeArg('bootstrap');   
//        $options = $bootstrap->getOption('resources');   
//        $contextSwitch = $this->_helper->getHelper('contextSwitch'); 
//        $contextSwitch->addActionContext('index', array('xml','json'))->initContext();
        
    }

    public function indexAction()
    {
        if ($this->_request->isGet()) {
            $this->_forward('get');
        } else {
            $this->getResponse()->setHttpResponseCode(500);
        }
    }

    public function getAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $pageStart = isset($data['start'])?$data['start']:NULL;
            $pageLimit = isset($data['limit'])?$data['limit']:NULL;
            $idproducto = isset($data['idproducto'])?$data['idproducto']:NULL;
            $srvProductoVariante = new ProductoVariante();
            
            if (!isset($data['operacion']) || $data['operacion'] == "lista") {
                list($aProductoVariantes, $total, $oProducto) = $srvProductoVariante->aList($idproducto, 1, $pageStart, $pageLimit);
                $objRecords=\Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aProductoVariantes);
                $result['data'] = $aProductoVariantes;
            } else if ($data['operacion'] == "getById") {
                $aProducto = $srvProductoVariante->getById($data['idprod'], 1, true, true);
                $result['data'] = $aProducto;
                $total = 1;
            }
            $result['success'] = 1;
            $result['total'] = $total;
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function postAction()
    {
    }

    public function putAction()
    {
        try {
            $body = $this->getRequest()->getRawBody();
            $data = Zend_Json::decode($body);
            $dataParams = $this->getRequest()->getParams();
            $idproducto = isset($dataParams['idproducto'])?$dataParams['idproducto']:NULL;
            $data['idproducto'] = $idproducto;
            $srvProductoVariante = new ProductoVariante();
            $oProductoVariante = $srvProductoVariante->save($data);
            
            $result['idProductoVariante'] = $oProductoVariante->getIdProductoVariante();
            $result['success'] = 1;
            $result['msg'] = "Se proceso el registro correctamente.";
            $this->_helper->json->sendJson($result);
        } catch(Exception $e) {
            $this->getResponse()->setHttpResponseCode(500);
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        // action body
    }


}









