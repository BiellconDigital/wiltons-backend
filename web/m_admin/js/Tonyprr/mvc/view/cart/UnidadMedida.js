Ext.define("Tonyprr.mvc.view.cart.UnidadMedida", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewUnidadMedida',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIUnidadMedida',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            itemId:'viewListUnidadMedida',
            width : 350,
            split:true,
            minSize: 150,
            maxSize: 350,
            collapsible : true,
            border : false,
            frame : false,
            layout: 'fit'
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            itemId:'viewFormUnidadMedida',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
            this.getComponent('viewFormUnidadMedida').getComponent('formWidgetUnidadMedida').loadRecord(record);
    },
    initComponent : function() {
        this.callParent(arguments);
        
        meUnidadMedidaProd = this;
        
        var storeUnidadMedida = Ext.create('Tonyprr.mvc.store.cart.UnidadMedida',{storeId: 'storeUnidadMedida'});
        meUnidadMedidaProd.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidgetUnidadMedida',
            id:'gridWidgetUnidadMedida',
            frame:true,
            columnLines : true,
            autoScroll:true,
            store: storeUnidadMedida,
            border:false,
            tbar : [
                '-',
                {
                    text:'Nuevo',iconCls:'add'
                },
                 '-'
            ],
            columns : [
            {
                xtype:'actioncolumn', 
                width:40,
                items: [
                    {
                        icon: Tonyprr.Constants.IMAGE_EDIT,
                        tooltip: 'Editar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
                            grid.up('panel[itemId="viewCrudUIUnidadMedida"]').loadUIForm(grid.getStore().getAt(rowIndex));
                        }
                    }
                ]
            },
            {dataIndex: 'idunidadMedida',header : 'ID',width:26, sortable : false},
            {dataIndex: 'descripcion',header : 'Descripción',width: 190,sortable : false},
            {dataIndex: 'estado',header : 'Estado',width: 50,sortable : false,renderer: Tonyprr.core.Lib.checkRender}
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
//                itemId:'gridPagingWidgetNoti',
                pageSize: 15,
                store: storeUnidadMedida,
                displayInfo: true
            })
        });
        meUnidadMedidaProd.getComponent('viewListUnidadMedida').add(meUnidadMedidaProd.gridUI);
        
        
        meUnidadMedidaProd.formUI = Ext.create("Tonyprr.abstract.Form", {
            fileUpload:true,
            itemId:'formWidgetUnidadMedida',
            id:'formWidgetUnidadMedida',
            width:590,
            title:'Registro de Unidad de Medida',
            margin:'0 23 12 1',
            frame: true,
            waitMsgTarget: true,
            items : [
                {
                    xtype: 'tabpanel',
                    activeTab: 0,
                    border:true,
                    autoHeight: true,
                    width:'100%',
                    defaults:{bodyStyle:'padding:2px'},
                    items:[
                        {
                            xtype :'panel',
                            title: 'Datos',
                            layout : 'anchor',
                            defaults: {anchor : '98%'},
                            defaultType : 'textfield',
                            padding : '6 6 6 6', 
                            items:[
                                {
                                    xtype: 'hidden',
                                    name:'idunidadMedida'
                                },
                                {
                                    xtype: 'fieldcontainer',
                                    fieldLabel: 'Descripción',
                                    layout: 'hbox',
                                    items: [
                                        {
                                            xtype :'textfield',
                                            width : 310,
                                            name:'descripcion'
                                        }
                                        ,{xtype: 'splitter', width : 18}
                                        ,{
                                            xtype: 'checkbox',
                                            name:'estado'
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
            ,
            buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',iconCls:'save',
//                    itemId:'saveBtnFormNoti',
                    formBind: true,
//                    disabled: true,
                    scope: this
                }
            ]
        });
        meUnidadMedidaProd.getComponent('viewFormUnidadMedida').add(meUnidadMedidaProd.formUI);
        delete meUnidadMedidaProd.gridUI;
        delete meUnidadMedidaProd.formUI;
    }
});
