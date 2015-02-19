Ext.define("Tonyprr.mvc.view.cart.ProductoEsp", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewProductoEsp',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIProdEsp',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            title: 'Lista de Productos Especiales',
            itemId:'viewRecordsProdEsp',
            width : 310,
            border : true,
            frame : false
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            autoHeight: true,
            itemId:'viewListProdEsp',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    initComponent : function() {
        this.callParent(arguments);
        meProdEsp = this;
        
//        var storeProducto = Ext.create('Tonyprr.mvc.store.cart.Producto');
        Ext.create('Tonyprr.mvc.store.cart.Producto', {storeId:'ProductoEspStore'});
        
        panelView = Ext.create("Ext.grid.Panel", {
            frame:true,
            itemId:'viewListProdEspWidget',
            columnLines : true,
            autoScroll:true,
            store: Ext.data.StoreManager.lookup('ProductoEspStore'),
//            border:false,
            style: {
                width: '95%'
            },
            dockedItems : [{
                xtype: 'toolbar',
                dock: 'top',
                items: [
                    '-',
                    {
                        text:'Agregar Producto',
                        iconCls: 'add'
                    },'-'
                ]
            }],            
            columns : [
                {
                    xtype:'actioncolumn', 
                    width:40,
                    items: [{
                        icon: Tonyprr.Constants.IMAGE_EDIT,
                        tooltip: 'Editar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
//                            meProdEsp.getComponent('viewListProdEsp').expand(true);
//                            meProdEsp.down('grid[itemId="viewListProdEspWidget"]').toggleCollapse();
                            meProdEsp.down('panel[itemId="winProductoEsp"]').getComponent(0).loadRecord(grid.getStore().getAt(rowIndex));
                            meProdEsp.down('panel[itemId="winProductoEsp"]').getComponent(0).getForm().setValues({borrarAdj: 0});
                            
                            idReg = grid.getStore().getAt(rowIndex).get('idproducto');
                            // storeLanguage = grid.up('panel[itemId="viewCrudUIProdEsp"]').down('grid[itemId="gridProdLanguage"]').getStore();
                            // Ext.apply(storeLanguage.getProxy().extraParams, {idproducto: idReg});
                            // storeLanguage.load();

                            meProdEsp.down('panel[itemId="panelGaleProdEspWidget"]').getComponent(0).getForm().reset();
                            meProdEsp.down('grid[itemId="gridProdEspGaleriaLanguage"]').getStore().removeAll();
                            
                            storeGaleria = meProdEsp.down('dataview[itemId="viewGaleProdEspWidget"]').getStore();
                            Ext.apply( storeGaleria.getProxy().extraParams, {idproducto: idReg} );
                            storeGaleria.load();
                            
//                            storeGaleria = meProdEsp.down('dataview[itemId="viewGaleProdEspWidget"]').getStore();
//                            Ext.apply( storeGaleria.getProxy().extraParams, {idproducto: idReg} );
//                            storeGaleria.load();
                        }
                    },{
                        icon: Tonyprr.Constants.IMAGE_CROSS,
                        tooltip: 'Eliminar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
                            Ext.MessageBox.confirm('Eliminar Producto', 'Esta seguro que desea eliminar este producto?', 
                                 function (btn) {
                                    if (btn == 'yes')
                                        Tonyprr.Ajax.request({
                                            url     : Tonyprr.BASE_URL + '/admin/cart-producto/delete',
                                            params	: grid.getStore().getAt(rowIndex).data,
                                            el	: this.el,
                                            scope	: this,
                                            success	: function(data,response) {
                                                Tonyprr.App.showNotification({message:data.msg});
                                                if(data.success==1) {
                                                    grid.getStore().load();
                                                }
                                            },
                                            failure : function(data,response) {
                                                Tonyprr.App.showNotification({message:data.msg});
                                            }
                                        });
                                });
                        }                
                    }]
                },
                {dataIndex: 'idproducto',header : 'ID',width:26, sortable : true},
                {dataIndex: 'nombre_producto',header : 'Nombre',width: 335,sortable : true},
//                {dataIndex: 'precio',header : 'Precio',width: 70,sortable : true},
//                {dataIndex: 'cantidad',header : 'Stock',width: 70,sortable : true},
//                {dataIndex: 'cantidadVendidos',header : 'Vendidos',width: 70,sortable : true},
                {dataIndex: 'orden',header : 'Orden',width: 60,sortable : true},
                {dataIndex: 'estado',header : 'Estado',width: 50,sortable : true,renderer: Tonyprr.core.Lib.checkRender}
//                {dataIndex: 'fecharegConte',header : 'Fecha Ini.',width: 70,sortable : false,
//                    xtype: 'datecolumn',format:'d-m-Y'}
            ],
//            plugins : [
//                {
//                    ptype: 'rowexpander',
//                    rowBodyTpl : [
//                        '<div style = "width:340px;">',
//                        '<p><b>Fecha Registro: </b>{fechareg:date("d-m-Y H:i:s")}<br/><b>Fecha Última Modificaci&oacute;n: </b>{fechamodf:date("d-m-Y H:i:s")}</p>',
//                        '<p><b>Adjunto: </b><a href="'+Tonyprr.Constants.FILES_DATA_CART+'/producto/{adjunto}" target="_blank">{adjunto}</a></p>',
//                        '<p><img src="'+Tonyprr.Constants.FILES_DATA_CART+'/producto/{imagen}" width="130" style="float:left;margin-right:5px;"/>{intro_producto}</p>',
//                        '</div>'
//                    ]
//                }
//            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
                itemId:'gridPagingWidgetProd',
                pageSize: 15,
                store: Ext.data.StoreManager.lookup('ProductoEspStore'),
                displayInfo: true
            })
        });
        
        panelForm = Ext.create('Tonyprr.mvc.view.cart.WinProductoEsp');
        meProdEsp.getComponent('viewRecordsProdEsp').add(panelView);
        meProdEsp.getComponent('viewListProdEsp').add(panelForm);

        delete panelView;
        delete panelForm;
        
    }
});
