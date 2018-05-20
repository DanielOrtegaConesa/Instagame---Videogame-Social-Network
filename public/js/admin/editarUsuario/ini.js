$(document).ready(function () {

    //disparadores
    $("#actualizar").click(function () {
        let desc = $("#descripcion").val();
        let red = $("#red").val();

        let sm = $("#sm").prop("checked");
        let st = $("#st").prop("checked");
        let sn = $("#sn").prop("checked");
        
        let fm = $("#fm").prop("checked");
        let ft = $("#ft").prop("checked");
        let fn = $("#fn").prop("checked");
        let nick = $("#usuario").val();
        ajaxActualizar(nick,desc,red,sm, st, sn, fm, ft, fn);
    });
    $("#img").change(function () {
        $("#formimagen").submit();
        toast("Subiendo imagen");
    })
});