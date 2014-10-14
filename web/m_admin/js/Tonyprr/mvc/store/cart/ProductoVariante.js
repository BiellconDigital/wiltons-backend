//Ext.define("Tonyprr.mvc.store.cart.ProductoVariante",{
//    extend : 'Tonyprr.abstract.Store',
//    model  : "Tonyprr.mvc.model.cart.ProductoVariante",
//    url     : '/admin/cart-producto-variante/list-variante/'
//});

Ext.define("Tonyprr.mvc.store.cart.ProductoVariante",{
        extend : 'Ext.data.Store',
        autoLoad: false,
        autoSync: true,
        model  : "Tonyprr.mvc.model.cart.ProductoVariante",
        proxy: {
            type: 'rest',
            url: Tonyprr.BASE_URL + '/api/producto-variante',
            reader: {
                type: 'json',
                root: 'data',
                successProperty	: "success",
                totalProperty	: "total"
            },
            writer: {
                type: 'json'
            }
        },
        listeners: {
            write: function(store, operation){
                var record = operation.getRecords()[0],
                    name = Ext.String.capitalize(operation.action),
                    verb;
                console.log(operation);
                if (name == 'Destroy') {
                    record = operation.records[0];
                    verb = 'Destroyed';
                } else {
                    verb = name + 'd';
                }
                console.log(record);
                if (name != 'Create')
                    store.load();
                //Ext.MessageBox.alert(name,Ext.String.format("{0} Variante: {1}", verb, record.getIdProductoVariante()));
                
            }
        }
    });