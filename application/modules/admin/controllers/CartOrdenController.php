<?php
use cart\Services\OrdenService as OrdenService;

class Admin_CartOrdenController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction()
    {
    }

    public function listAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $pageStart = isset($data['start'])?$data['start']:NULL;
                $pageLimit = isset($data['limit'])?$data['limit']:NULL;
                $daoOrden = new OrdenService();
                list($resultados, $total) = $daoOrden->aList(NULL, 1, $pageStart, $pageLimit);
                $result['success'] = 1;
                $result['data'] = $resultados;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function cambiarEstadoAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $daoOrden = new OrdenService();
                $oOrden = $daoOrden->cambiarEstado($data);
                
                $result['msg'] = 'Se registr&oacute; los cambios correctamente.';
                $result['success'] = 1;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "".$e->getMessage()) );
        }
    }


    public function actualizarOrdenVisaAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $codigoTransaccion = $data['codigoTransaccion'];
            $idOrden = $data['idOrden'];
            $idOrdenEstado = $data['idOrdenEstado'];
            $montoTotal = $data['costoEnvio'] + $data['totalFinal'];
            $ordenService = new OrdenService();
            $result = $ordenService->actualizarOrdenVisa($idOrden, $idOrdenEstado, $montoTotal, $codigoTransaccion);

            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0, "update" => 0, "data" => null,"msg" => $e->getMessage()) );
        }
    
    }
 
    public function deleteAction()
    {
        try {
//            $Producto = new \Models\CmsProducto();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idOrden',0) != 0 ) {
                    $data = $this->getRequest()->getParams();
                    $idOrden = $data['idOrden'];
                    $ordenService = new OrdenService();
                    $ordenService->delete($idOrden);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; el Pedido correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID del Pedido a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(ValidacionException $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

}





