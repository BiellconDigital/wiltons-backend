Ext.define("Tonyprr.mvc.model.cart.ProductoVariante",{
    extend		: "Tonyprr.abstract.Model",
    idProperty : 'idProductoVariante',
    fields		: [
        {name:"idProductoVariante",type:"integer",
        useNull: true},
        {name:"idproducto",type:"integer"},
        "descripcion",
        {name: "estado", type: 'boolean'},
        {name:"fechaRegistro",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});