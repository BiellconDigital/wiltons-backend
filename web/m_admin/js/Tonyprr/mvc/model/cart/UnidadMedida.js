Ext.define("Tonyprr.mvc.model.cart.UnidadMedida",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idunidadMedida", type:"integer"},
        "descripcion",
        {name:"estado", type:"boolean"},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaActualizacion", type:"date", dateFormat:'Y-m-d H:i:s'}
    ]
});