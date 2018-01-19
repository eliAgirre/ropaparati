$(document).ready(function(){
    $("#coleccionesA").mouseover(function() {
        $('#linkColecciones').css('color','grey');
    }); // Cierre función mouseover
    $("#coleccionesA").mouseout(function() {
        $('#linkColecciones').css('color','black');
    }); // Cierre función mouseout

    $("#coleccionesB").mouseover(function() {
        $('#linkColecciones').css('color','grey');
    }); // Cierre función mouseover
    $("#coleccionesB").mouseout(function() {
        $('#linkColecciones').css('color','black');
    }); // Cierre función mouseout

    $("#campanas").mouseover(function() {
        $('#linkCampanas').css('color','grey');
    }); // Cierre función mouseover
    $("#campanas").mouseout(function() {
        $('#linkCampanas').css('color','black');
    }); // Cierre función mouseout

    $("#blog").mouseover(function() {
        $('#linkBlog').css('color','grey');
    }); // Cierre función mouseover
    $("#blog").mouseout(function() {
        $('#linkBlog').css('color','black');
    }); // Cierre función mouseout

});// Cierre de jQuery