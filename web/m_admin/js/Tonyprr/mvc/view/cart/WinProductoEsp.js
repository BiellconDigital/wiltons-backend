var rowEditingProducto = Ext.create('Ext.grid.plugin.RowEditing');

var rowEditingProductoVariante = Ext.create('Ext.grid.plugin.RowEditing', {
        listeners: {
            cancelEdit: function(rowEditing, context) {
                // Canceling editing of a locally added, unsaved record: remove it
                console.log(context.record);
//                if (context.record.phantom) {
//                    Ext.data.StoreManager.lookup('ProductoVarianteStore').remove(context.record);
//                    //store.remove(context.record);
//                }
            }
        }
    });
    
Ext.define('Tonyprr.mvc.view.cart.WinProductoEsp', {
	extend 			: "Ext.Panel",
        alias                   : 'widget.winProductoEsp',
        itemId: 'winProductoEsp',
        title   : "Productos Especiales",
//        height: 500,
        autoHeight: true,
        autoWidth: true,
        margin : '3 10 4 5',
        layout: 'fit',
//        modal : true,
//        closable : false,
//        closeAction : 'hide',
        frame : true,
        items : [
            {
                xtype : 'form',
                title : 'Información',
                //collapsible: true,
                fileUpload:true,
                monitorValid : true,
                frame : true,
                autoHeight: true,
                autoWidth: true,
                defaultType : 'textfield',
                layout              : 'anchor',
                fieldDefaults	: {
                    labelAlign	: 'left',
                    labelWidth      : 90,
                    msgTarget	: 'side',
                    anchor          : '99%'
                },
                items : [
                    {
                        xtype : 'tabpanel',
//                        autoHeight: true,
                        autoWidth: true,
                        plain:true,
                        activeTab: 0,
//                        height:235,
                        defaults:{bodyStyle:'padding:10px'},
                        items : [


                            {
                                xtype :'panel',
                                layout : 'anchor',
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield',
                                title : 'Data',
                                items : [
                                    {
                                        xtype: 'hidden',
                                        name:'idproducto'
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'C&oacute;digo',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype: 'textfield',
                                                name : 'codigoProducto',
                                                allowBlank:false
                                            },
                                            {
                                                xtype: 'splitter',
                                                width : 15
                                            },
                                            {
                                                xtype: 'numberfield',
                                                fieldLabel: 'Orden',
                                                labelWidth : 50,
                                                name:'orden',
                                                allowBlank:false
                                            }
                                        ]
                                    },            
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Nombre',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype:'textfield',
                                                name:'nombre_producto',
                                                width : 370
                                            },
                                            {
                                                xtype: 'splitter',
                                                width : 15
                                            },
                                            {
                                                xtype: 'checkbox',
                                                fieldLabel: 'Mostrar?',
                                                labelWidth : 50,
                                                name:'estado'
                                            }
                                        ]
                                    },            
                                    {
                                        xtype: 'hidden',
                                        name:'idTipo'
                                    },
                                    {
                                        fieldLabel:'Categoria',
                                        anchor : '95%',
                                        name:'nameCate',
                                        disabled : true,
                                        allowBlank:false 
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Unidad Medida Venta',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                           {
                                               xtype: 'combobox',
                                               anchor : '65%',
                                               itemId: 'cboUnidadMedidaProdEspWin',
                                               name:'idunidadMedida',
                                               typeAhead: true,
                                               store: 'Tonyprr.mvc.store.cart.UnidadMedida',
                                               queryMode: 'local',
                                               displayField: 'descripcion',
                                               valueField: 'idunidadMedida',
                                               allowBlank:false
                                           },
                                            {
                                                xtype: 'splitter',
                                                width : 15
                                            },
                                            {
                                                xtype : 'numberfield',
                                                name:'precio',
                                                decimalSeparator: '.',
                                                minValue : 0,
                                                fieldLabel: 'Precio',
                                                anchor : '35%',
                                                allowBlank:false 
                                            }
                                        ]
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Foto',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype :'textfield',
                                                name :'imagen',
                                                width: 320, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_image',
                                                msgTarget: 'side',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            },
                                            {xtype: 'splitter', width:15},
                                            {
                                                xtype: 'checkbox',
                                                fieldLabel: 'Borrar',
                                                labelWidth : 42,
                                                name:'borrarImg'
                                            }
                                        ]
                                    }
                                ]
                            }
                            


                            ,{
                                xtype :'panel',
                                title: 'Ficha',
                                itemId:'panelProdEspLanguage',
                                layout : 'anchor',
                                padding : '6 6 6 6', 
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield',
                                items:[
                                    {
                                        xtype: 'tinymcefield',
                                        name: 'ficha',
                                        fieldLabel: 'Detalle',
                                        labelAlign: 'top',
                                        height: 290,
                                        anchor: '100%',
                                        tinymceConfig: {
                                            theme_advanced_buttons1: 'fullscreen,|,undo,redo,|,bold,italic,underline,strikethrough,|,forecolor,backcolor,removeformat,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,|,code',
                                            theme_advanced_buttons2: 'fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink',
                                            theme_advanced_buttons3: '',
                                            theme_advanced_buttons4: '',
                                            skin_variant : 'gray'
                                        }
                                    }

                                ]
                            }
                        ]
                    }
                    
                    
                    
                ]
                ,buttons : [
                    {
                            text    : "Guardar",
                            iconCls : 'save',
                            formBind : true,
                            scope   : this
                    }
                ]
            }
            ,{
                xtype :'panel',
                title: 'Galeria del Producto',
                itemId:'panelGaleProdEspWidget',
                layout : 'anchor',
                frame: true,
                autoWidth: true,
                autoHeight: true,
                padding: '10px',
                margin: '5px'
            }

        ]

	,initComponent	: function() {
		this.callParent();
                meWinProductoEsp = this;



                /************************************************************************************************/
                /*************************************  GALERIA DE IMAGENES  **************************************/
                Ext.create('Tonyprr.mvc.store.cart.ProductoGaleriaLanguage', {storeId:'ProductoEspGaleLanguageStore'});
                meWinProductoEsp.down('panel[itemId="panelGaleProdEspWidget"]').add(                
                                    {
                                        xtype : 'form',
                                        fileUpload:true,
                                        frame : true,
                                        autoHeight: true,
                                        padding : '3 3 3 3',
                                        autoWidth: true,
                                        border : false,
                                        defaultType : 'textfield',
                                        layout              : 'anchor',
                                        fieldDefaults   : {
                                            labelAlign  : 'left',
                                            labelWidth      : 90,
                                            msgTarget   : 'side',
                                            anchor          : '96%'
                                        },
                                        items : [
                                            {
                                                xtype: 'hidden',
                                                name:'idcontgale'
                                            },
                                            {
                                                xtype: 'numberfield',
                                                name:'ordenGale',
                                                fieldLabel :'Orden',
                                                anchor:'33%'
                                            },
                                            {
                                                xtype:'filefield',
                                                name:'file_foto_gale',
                                                fieldLabel :'Foto (JPG)',
                                                anchor:'98%',
                                                msgTarget: 'side',
                                                regex: /^.*\.(jpg|JPG|jpeg|JPEG)$/,
                                                regexText: 'Solo imagenes jpg',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                            ,{
                                                xtype : 'grid',
                                                itemId:'gridProdEspGaleriaLanguage',
                                                plugins: [rowEditingProducto],
                                                height: 120,
                                                autoWidth: true,
                                                frame:true,
                                                columnLines : true,
                                                autoScroll:true,
                                                store: Ext.data.StoreManager.lookup('ProductoEspGaleLanguageStore'),
                                                border:false,
                                                columns : [
                                                    {dataIndex: 'idProductogaleLanguage',header : 'ID',width:26, hidden : true},
                                                    {dataIndex: 'idcontgale',header : 'ID Categoria',width: 80, hidden : true},
                                                    {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                                    {dataIndex: 'idioma',header : 'Idioma', width : 110},
                                                    {
                                                        dataIndex: 'titulo',header : 'Titulo',width: 140,
                                                        field: {
                                                            xtype: 'textfield'
                                                        }
                                                    },
                                                    {
                                                        dataIndex: 'descripcion',header : 'Descripci&oacute;n',width: 170,
                                                        field: {
                                                            xtype: 'textarea'
                                                        }
                                                    }
                                                ]
                                            }
                                        ]
                                        ,buttons:[
                                            {
                                                text : 'Subir Foto',iconCls:'save',
                                                formBind: true,
                                                handler: function(btn){
                                                    
                                                    valuesForm=meWinProductoEsp.getComponent(0).getForm().getValues();
                                                    valuesFormFoto = meWinProductoEsp.down('panel[itemId="panelGaleProdEspWidget"]').getComponent(0).getForm().getValues();

                                                    if(valuesFormFoto.descripcionGale=='' || valuesFormFoto.file_foto_gale=='') {
                                                        Ext.MessageBox.alert('Alerta','Ingrese los datos de la Foto a agregar.');
                                                        return;
                                                    }
                                                    if(!Ext.isNumeric(valuesForm.idproducto)) {
                                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Producto para crear su Galeria.');
                                                        return;
                                                    }

                                                    meWinProductoEsp.down('panel[itemId="panelGaleProdEspWidget"]').getComponent(0).getForm().submit({
                                                        url : Tonyprr.BASE_URL + '/admin/cart-producto-galeria/save',
                                                        waitMsg:'Guardando, espere por favor...',
                                                        method:'POST',
                                                        params : {
                                                            idproducto: valuesForm.idproducto,
                                                            tipoGale: 1
                                                        },
                                                        timeout: 90000,
                                                        scope:this,
                                                        success: function(request, action) {
                                                            try {
                                                                var json = Ext.JSON.decode(action.response.responseText);
                                                                if(json.success == 1) {
                                                                    viewtemp=meWinProductoEsp.down('dataview[itemId="viewGaleProdEspWidget"]');
                                                                    viewtemp.getStore().load( { callback: function() {
//                                                                            viewtemp.refresh();
                                                                            newImage = Ext.fly('gale_prod_img-'+json.idcontgale);
                                                                            newImage.hide().show({duration: 500}).frame("#ffcc33", 3, { duration: 3 });//hide().show({duration: 500}).
//                                                                            winNewFoto.animateTarget = newImage; 
                                                                    }} );
                                                                    
                                                                    storeLanguage = meWinProductoEsp.down('grid[itemId="gridProdEspGaleriaLanguage"]').getStore();
                                                                    Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : json.idcontgale});
                                                                    storeLanguage.load();
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
                                        ]
                                    }
                );
            
                Ext.create('Tonyprr.mvc.store.cart.ProductoGaleria', {storeId:'ProductoEspGaleStore'});
                panelGaleria = Ext.create('Ext.Panel',
                    {
                        itemId:'formGaleProdEspWidget',
                        frame: true,
                        autoScroll: true,
                        height:240,
                        margin : '3 3 3 3',
                        autoWidth: true,
                        tbar: [
                            {
                                text:'Borrar',
                                iconCls:'cancel', scope: this,
                                handler: function(btn){
                                    valuesForm=meWinProductoEsp.getComponent(0).getForm().getValues();
                                    if(!Ext.isNumeric(valuesForm.idproducto)) {
                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Producto para borrar su Galeria.');
                                        return;
                                    }
                                    var viewGal = meWinProductoEsp.down('dataview[itemId="viewGaleProdEspWidget"]');
                                    var records = viewGal.getSelectionModel().getSelection();
                                    if(records.length == 0) {
                                        Ext.MessageBox.alert('Alerta','Debe seleccionar una foto para eliminarla.');delete viewGal;return;
                                    }
                                    Ext.MessageBox.confirm('Eliminar Foto', 'Esta seguro que desea eliminar esta foto?', 
                                         function (btn) {
                                            if (btn == 'yes')
                                                Tonyprr.Ajax.request({
                                                    url     : Tonyprr.BASE_URL + '/admin/cart-producto-galeria/delete',
                                                    params  : records[0].data,
                                                    el  : this.el,
                                                    scope   : this,
                                                    success : function(data,response) {
                                                        Tonyprr.App.showNotification({message:data.msg});
                                                        if(data.success==1) {
                                                            viewGal.getStore().load();
                                                            delete viewGal;delete records;
                                                        }
                                                    },
                                                    failure : function(data,response) {
                                                        Tonyprr.App.showNotification({message:data.msg});
                                                    }
                                                });
                                    });            
                                }
                            },'-'
                        ],
                        items: 
                            Ext.create('Ext.view.View', 
                            {
                                xtype : 'dataview',
                                itemId:'viewGaleProdEspWidget',
                                baseCls: 'data-view-gale',
                                store: Ext.data.StoreManager.lookup('ProductoEspGaleStore'),
                                tpl: [
                                    '<tpl for=".">',
                                        '<div class="thumb-wrap" id="gale_prod-{idcontgale}">',
                                        '<div class="thumb"><img src="'+Tonyprr.Constants.FILES_DATA_CART+'/producto/galeria/thumb_{imagenGale}" title="{descripcionGale}" id="gale_prod_img-{idcontgale}"></div>',
                                        '<span class="x-editable">{shortDescription}</span></div>',
                                    '</tpl>',
                                    '<div class="x-clear"></div>'
                                ],
                                multiSelect: true,
                                autoHeight:true,
                                autoWidth: true,
                                trackOver: true,
                                overItemCls: 'x-item-over',
                                itemSelector: 'div.thumb-wrap',
                                emptyText: 'No hay imagenes a mostrar',
                                prepareData: function(data) {
                                    Ext.apply(data, {
                                        shortDescription: Ext.util.Format.ellipsis(data.descripcionGale, 19),
                    //                    sizeString: Ext.util.Format.fileSize(data.size),
                                        dateString: Ext.util.Format.date(data.fecharegGale, "d-m-Y H:i:s")
                                    });
                                    return data;
                                },
                                listeners: {
                                    itemdblclick : function(view, model, node, e) {
                                        idImagen = node.id;
//                                        alert(name+ '-' +idImagen);
                                        storeLanguage = meWinProductoEsp.down('grid[itemId="gridProdEspGaleriaLanguage"]').getStore();
                                        Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : model.get('idcontgale')});
                                        storeLanguage.load();
                                        meWinProductoEsp.down('panel[itemId="panelGaleProdEspWidget"]').getComponent(0).loadRecord(model);
                                    }
                                }
                            }
                        )
                    }
                );          
                meWinProductoEsp.down('panel[itemId="panelGaleProdEspWidget"]').add(panelGaleria);
                delete panelGaleria;

    }
	
	
});
