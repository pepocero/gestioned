//Generate icon
var deleteIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-trash' style='color:red;'></i>";
};

//Generate icon
var editIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-pen' style='color:blue;'></i>";
};

//TABLA CARRERAS
var table_carreras = new Tabulator("#tab_carreras", {
    //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
    ajaxURL: "../ajax/get_carreras.php",
    //ajaxConfig:"POST", //ajax HTTP request type
    //ajaxParams: {id:id, control:"t_equi"},
    layout:"fitColumns",
    pagination:"local",
    paginationSize:6,
    paginationSizeSelector:[12, 24, 36, true],
    selectable:true, //make rows selectable
    selectableRangeMode:"click",
    columns:[
        {title:"Carrera", field:"carrera", formatter:"html", width:400},
        {formatter: deleteIcon, width:60, hozAlign:"center", 
                    cellClick:function(e, cell){
                        let idCarrera = cell.getRow().getData().id;
                        let carrera = cell.getRow().getData().carrera;
    //sweetAjaxDelete(title, text, icon, urlAjax, ajaxParams)
                        sweetAjaxDelete("¿Estás seguro?", "Se eliminará la carrera: "+carrera, "warning", "../ajax/crud.php", {idCarrera:idCarrera, control:"delete_carrera"})                        
            } // fin cellClick
        },

        {formatter: editIcon, width:60, hozAlign:"center", 
                    cellClick:function(e, cell){
                        let idCarrera = cell.getRow().getData().id;
                        sweetAjaxInput("Ingrese el nuevo nombre de la carrera", "../ajax/crud.php", "update_carrera", idCarrera);
                          
            } // fin cellClick
        },
                
    ],
});


//ALTERNATIVA PARA AGREGAR CARRERA
//ajaxParams:{key1:"value1", key2:"value2"}
$("#btn_add_carrera").click(function(){
    var title = "Ingrese el nombre de la carrera";
    var urlAjax = "../ajax/crud.php";
    var control = "insert_carrera";
    sweetAjaxInput(title, urlAjax, control,0);
});