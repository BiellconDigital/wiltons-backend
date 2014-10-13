var rowEditingContent = Ext.create('Ext.grid.plugin.RowEditing');
Ext.define('Tonyprr.mvc.view.web.WinContenido1', {
	extend 			: "Ext.Panel",
        alias                   : 'widget.winContenido1',
        itemId: 'winContenido1',
        title   : "Promoción",
//        height: 500,
        autoHeight: true,
        autoWidth: true,
//        region : 'north',
        margin : '3 25 4 5',
        layout: 'fit',
//        modal : true,
//        closable : false,
//        closeAction : 'hide',
        frame : true,
        items : [
            {
                xtype : 'form',
                fileUpload:true,
                monitorValid : true,
                frame : false,
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
//                                layout : 'form',
                                layout : 'anchor',
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield',
//                                border : false,
                                title : 'Informaci&oacute;n',
                                items : [
                                    {
                                        xtype: 'hidden',
                                        name:'idcontent'
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Descripción',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype:'textfield',
                                                name:'adicional1',
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
                                        xtype : 'numberfield',
                                        name:'orden',
                                        minValue : 0,
                                        fieldLabel: 'Orden',
                                        anchor : '45%',
                                        allowBlank:false 
                                    },
                                    {
                                        xtype: 'hidden',
                                        name:'idcontcate'
                                    },
                                    {
                                        fieldLabel:'Categoria',
                                        anchor : '90%',
                                        name:'nameCate',
                                        disabled : true,
                                        allowBlank:false 
                                    }
                                    ,{
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Imagen PC',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype :'textfield',
                                                name :'imagen',
                                                width: 300, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_image',
                                                msgTarget: 'side',
//                                                anchor : '30%',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                        ]
                                    }
                                    ,{
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Imagen Tablet',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype :'textfield',
                                                name :'imagen2',
                                                width: 300, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_image2',
                                                msgTarget: 'side',
//                                                anchor : '30%',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                        ]
                                    }
                                    ,{
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Imagen Movil',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype :'textfield',
                                                name :'adjunto',
                                                width: 300, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_adjunto',
                                                msgTarget: 'side',
//                                                anchor : '30%',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                        ]
                                    }
                                ]
                            }
                            
                        ]
                    }
                ]
                ,buttons : [
                    {
                            text	: "Guardar",
                            iconCls : 'save',
                            formBind : true,
                            scope	: this
                    }
        //            ,{
        //                    text	: "Mostrar Lista",
        //                    iconCls : 'cross',
        //                    width : 130,
        //                    scope : this
        //            }
                ]
            }
        ]

	,initComponent	: function() {
            this.callParent();
	}
	
	
});