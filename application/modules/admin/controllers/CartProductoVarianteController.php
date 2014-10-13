<?php
use cart\Services\ProductoVariante;

class Admin_CartProductoVarianteController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction()
    {
        // action body
    }

    public function listVarianteAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $idProducto = isset($data['idproducto'])?$data['idproducto']:0;
                //$tipoGale = isset($data['tipoGale'])?$data['tipoGale']:1;
                $srvProductoVariante = new ProductoVariante();
                list($aProductoVariante, $total) = $srvProductoVariante->aList($idProducto, 1);
                $objRecords = \Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aProductoVariante);
                $result['success'] = 1;
                $result['data'] = $aProductoVariante;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }        
    }

    public function deleteAction()
    {
        try {
            if ($this->_request->getPost()) {
                if( $this->_getParam('idcontgale',0) != 0 ) {
                    $idRegistro = $this->_getParam('idcontgale');
                    $srvProductoVariante = new ProductoVariante();
                    $srvProductoVariante->delete($idRegistro);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Foto correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Foto a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }        
    }

    public function saveAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $srvProductoVariante = new ProductoVariante();
                $oProductoGale = $srvProductoVariante->save($formData);
                $result['success'] = 1;
                $result['idProductoVariante'] = $oProductoGale->getIdProductoVariante();
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }


}













