Ext.define('Tonyprr.mvc.controller.cart.ProductoEsp', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.ProductoCategoriaTree',
                    'Tonyprr.mvc.store.cart.Producto','Tonyprr.mvc.store.cart.ProductoLanguage',
                    'Tonyprr.mvc.store.cart.ProductoCategoria'
                    
//                    ,'Tonyprr.mvc.store.cart.Marca'
                    ,'Tonyprr.mvc.store.cart.ProductoGaleria'
                    ,'Tonyprr.mvc.store.cart.ProductoGaleriaLanguage'
//                    ,'Tonyprr.mvc.store.cart.ProductoTipo'
                    // ,'Tonyprr.mvc.store.cart.MovimientoStockProducto'
                    // ,'Tonyprr.mvc.store.cart.ProductoVariante'
                    ,'Tonyprr.mvc.store.cart.UnidadMedida'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.ProductoCategoria',
                    'Tonyprr.mvc.model.cart.Producto','Tonyprr.mvc.model.cart.ProductoLanguage'
                    
//                    ,'Tonyprr.mvc.model.cart.Marca'
                    ,'Tonyprr.mvc.model.cart.ProductoGaleria'
                    ,'Tonyprr.mvc.model.cart.ProductoGaleriaLanguage'
//                    ,'Tonyprr.mvc.model.cart.ProductoTipo'
                    // ,'Tonyprr.mvc.model.cart.MovimientoStock'
                    // ,'Tonyprr.mvc.model.cart.ProductoVariante'
                    ,'Tonyprr.mvc.model.cart.UnidadMedida'
                  ],

    views	: [
                    'Tonyprr.mvc.view.cart.ProductoEsp'
                    ,'Tonyprr.mvc.view.cart.WinProductoEsp'
//                    ,'Tonyprr.mvc.view.cart.ProductoCategoriaTree'
                  ],
    refs: [
        {
            ref: 'panelViewListProd',
            selector: 'panel[itemId="viewListProdEsp"]'
        }
        ,{
            ref: 'listviewprod',
            selector: 'panel[itemId="viewRecordsProdEsp"]'
        }
        ,{
            ref: 'winproducto',
            selector: 'panel[itemId="winProductoEsp"]'
        }
        ,{
            ref: 'cboUnidadMedidaProd',
            selector: 'combobox[itemId="cboUnidadMedidaProdEspWin"]'
        }
//        ,{
//            ref: 'cbotipoprod',
//            selector: 'combobox[itemId="cboTipoProdWinProd"]'
//        }
//        ,{
//            ref : 'viewgaleria',
//            selector : 'dataview[itemId="viewGaleProdEspWidget"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="viewListProdEspWidget"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="viewListProdEspWidget"] button[text="Agregar Producto"]': {
                click : this.onClickAddProd
            }

            ,'panel[itemId="winProductoEsp"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winProductoEsp"] button[text="Guardar"]': {
                click : this.onClickSaveProd
            }
/*            ,'panel[itemId="winProductoEsp"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
*/        });
    },
    
    initView: function(parent) {
        var viewProductoEsp = Ext.widget('viewProductoEsp');
        parent.add(viewProductoEsp);
        viewProductoEsp.setHeight(parent.getHeight());
    }
    
    ,onGridAfterRender: function(grid, opts) {
        if( Ext.isObject(this.getCboUnidadMedidaProd()) ) {
            Ext.apply(this.getCboUnidadMedidaProd().getStore().getProxy().extraParams, {activos : true});
            this.getCboUnidadMedidaProd().getStore().load();
        }

        try {
            Ext.apply(Ext.data.StoreManager.lookup('ProductoEspStore').getProxy().extraParams, 
                    {idTipo : 2});
            Ext.data.StoreManager.lookup('ProductoEspStore').load();
        } catch(Exception) {
            console.log(Exception);
            try {
                Ext.data.StoreManager.lookup('ProductoEspStore').load();
            } catch(Exception) {
                try {
                    Ext.data.StoreManager.lookup('ProductoEspStore').load();
                } catch(Exception) {
                    try {
                        Ext.data.StoreManager.lookup('ProductoEspStore').load();
                    } catch(Exception) {
                        try {
                            Ext.data.StoreManager.lookup('ProductoEspStore').load();
                        } catch(Exception) {
                            Ext.data.StoreManager.lookup('ProductoEspStore').load();
                        }
                    }
                }
            }
        }

//        if( Ext.isObject(this.getCbotipoprod()) ) this.getCbotipoprod().getStore().load();
    }
    ,onWinAfterRender: function(panel, opts) {
//        this.getCbomarcaprod().getStore().load();
    }

    ,onClickAddProd: function(button,e) {
        try {
            this.getWinproducto().getComponent(0).getForm().reset();
            this.getWinproducto().getComponent(0).getForm().setValues({idTipo : 2});
            
            //this.getWinproducto().down(('form[itemId="formProdLanguage"]')).getForm().reset();
//            this.getWinproducto().down(('grid[itemId="gridProdLanguage"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSaveProd: function(button,e) {
        controller = this;
        if(this.getWinproducto().getComponent(0).getForm().isValid()) {
            this.getWinproducto().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/cart-producto/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListviewprod().getComponent(0).getStore().load();
                            formProd = controller.getWinproducto().getComponent(0);
                            formProd.getForm().setValues({idproducto:json.idproducto});
                            
                            // storeLanguage = controller.getWinproducto().down('grid[itemId="gridProdLanguage"]').getStore();
                            // Ext.apply(storeLanguage.getProxy().extraParams, {idproducto : json.idproducto});
                            // storeLanguage.load();
                            
                        }
                        Tonyprr.App.showNotification({message:json.msg});
                    } catch(Exception) {
                        Tonyprr.core.Lib.exceptionAlert(Exception);
                    }
                },
                failure: function(request, action) {
                    Ext.MessageBox.alert('Error','Error en el servidor.');
                }
            });
        }
    }
    
    ,onClickSaveLanguage: function(button,e) {
        data = this.getWinproducto().getComponent(0).getForm().getValues();
        if (data.idproducto == "") {
            return;
        }
        controller = this;
        var form = this.getWinproducto().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idproducto: data.idproducto
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
//                    controller.getWinproducto().down('grid[itemId="gridProdLanguage"]').getStore().load();
                    controller.getListviewprod().getComponent(0).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});