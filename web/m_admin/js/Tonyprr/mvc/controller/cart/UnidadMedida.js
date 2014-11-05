Ext.define('Tonyprr.mvc.controller.cart.UnidadMedida', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.UnidadMedida'
                   ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.UnidadMedida'
              ],

    views	: [
		'Tonyprr.mvc.view.cart.UnidadMedida'
    ],
    refs: [
//        {
//            ref: 'formUnidadMedida',
//            selector: 'form[id="formWidgetUnidadMedida"]'
//        },
        {
            ref: 'gridUnidadMedida',
            selector: 'grid[id="gridWidgetUnidadMedida"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'gridpanel[id="gridWidgetUnidadMedida"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[id="gridWidgetUnidadMedida"] button[text="Nuevo"]': {
                click : this.onClickNew
            }
            
            ,'form[id="formWidgetUnidadMedida"] button[text="Guardar"]': {
                click : this.onClickSave
            }
             
        });
    },
    
    initView: function(parent) {
        var viewUnidadMedida = Ext.widget('viewUnidadMedida'); 
        parent.add(viewUnidadMedida);
        viewUnidadMedida.setHeight(parent.getHeight());
        
    },
    
    onGridAfterRender: function(grid,opts) {//grid,opts
        grid.getStore().load();
    }

    ,onClickNew: function(button,e) {
        try {
            Ext.getCmp('formWidgetUnidadMedida').getForm().reset();
        } catch(Exception) {
//            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }

    ,onClickSave: function(button,e) {
        controller = this;
        Ext.getCmp('formWidgetUnidadMedida').getForm().submit({
            url : Tonyprr.BASE_URL + '/admin/cart-unidad-medida/save',
            waitMsg:'Guardando, espere por favor...',
            method:'POST',
            timeout: 12000,
            scope:this,
            success: function(request, action) {
                try{
                    var json = Ext.JSON.decode(action.response.responseText);
                    if(json.success == 1) {
                        controller.getGridUnidadMedida().getStore().load();
                        formProd = Ext.getCmp('formWidgetUnidadMedida');
                        formProd.getForm().setValues({idunidadMedida:json.idunidadMedida});
                    }
                    Tonyprr.App.showNotification({message:json.msg});
//                                    Ext.MessageBox.alert('Error ', json.msg);
                } catch(Exception) {
                    Tonyprr.core.Lib.exceptionAlert(Exception);
                }
            },
            failure: function(request, action) {
                Ext.MessageBox.alert('Error','Error en el servidor.');
            }
        });
    }
    
});