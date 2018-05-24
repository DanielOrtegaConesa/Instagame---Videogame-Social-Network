$(document).ready(function () {

    //disparadores
    $("#actualizar").click(function () {
        let desc = $("#descripcion").val();
        let red = $("#red").val();
        let contra = $("#contra").val();
        let contra2 = $("#contra2").val();

        let sm = $("#sm").prop("checked");
        let st = $("#st").prop("checked");
        let sn = $("#sn").prop("checked");
        
        let fm = $("#fm").prop("checked");
        let ft = $("#ft").prop("checked");
        let fn = $("#fn").prop("checked");

        if(contra == contra2) {
            ajaxActualizar(desc, red, sm, st, sn, fm, ft, fn, contra);
        }else{
            toast("Las contraseñas no coinciden")
        }
    });
    $("#img").change(function () {
        $("#formimagen").submit();
        toast("Subiendo imagen");
    })
});