$(document).ready(function(){

    $(".numWish").mouseenter(function() {

        var div=$(this).find("div.divCount");
        var idCount=$(this).attr('id');
        var idDivUser=$(".producto #"+idCount+".dataUser").attr('id');
        var user;
        var length=$(".producto #"+idCount+".dataUser").length;
        //alert(idDivUser);
        if(idDivUser!==undefined){

            $(".producto #"+idCount+".dataUser").map(function() {
                //alert($(this).attr('value'));
                //user=$(this).attr('value')
                div.append( "<a class='profileAmigo' href='../view/amigo.php?usuario="+$(this).attr('value')+"' target='_blank'>"+$(this).attr('value')+"</a><br>" );
            });

    }// Cierre de mouseenter

    });

    $(".numWish").mouseleave(function() {
        var div=$(this).find("div.divCount");
        $("a.profileAmigo").remove();
        $("br").remove();
    }); // Cierre de mouseleave

});