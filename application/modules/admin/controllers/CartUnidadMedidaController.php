<?php
use cart\Services\UnidadMedidaService as unidadMedidaService;
use Tonyprr\Exception\ValidacionException;

class Admin_CartUnidadMedidaController extends Zend_Controller_Action
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

    public function listAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $pageStart = isset($data['start'])?$data['start']:NULL;
                $pageLimit = isset($data['limit'])?$data['limit']:NULL;
                $activos = isset($data['activos'])?$data['activos']:"TODOS";
                $srvUnidadMedida = new unidadMedidaService();
                list($aUnidadMedidas, $total) = $srvUnidadMedida->aList($activos, $pageStart, $pageLimit);
                
                $result['success'] = 1;
                $result['data'] = $aUnidadMedidas;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function saveAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $unidadMedidaService = new unidadMedidaService();
                $oUnidadMedida = $unidadMedidaService->save($formData);
            
                $result['idunidadMedida'] = $oUnidadMedida->getIdunidadMedida();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de UnidadMedida correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function formAction()
    {
        try {
            if( $this->_getParam('id',0) != 0 ) {
                $formData = $this->getRequest()->getParams();
                $daoUnidadMedida = new unidadMedidaService();
                $aUnidadMedida = $daoUnidadMedida->getById($this->_getParam('id'));
                $result['success'] = 1;
                $result['data'] = $aUnidadMedida;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>$e->getMessage()));
        }        
    }
    
    public function deleteAction()
    {
        try {
//            $Producto = new \Models\CmsProducto();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idunidadMedida',0) != 0 ) {
                    $idUnidadMedida = $this->_getParam('idunidadMedida');
                    $srvUnidadMedida = new unidadMedidaService();
                    $srvUnidadMedida->delete($idUnidadMedida);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; la Unidad Medida correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Unidad Medida a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(ValidacionException $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        } catch(Exception $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

}



