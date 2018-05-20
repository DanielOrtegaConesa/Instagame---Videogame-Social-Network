$(document).ready(function () {
    //disparadores
    $("#registrar").click(function () {
        let nick = $("#nick").val();
        let pass = $("#password").val();
        let email = $("#email").val();
        if (nick != "" && pass != "" && email != "") {
            var re = new RegExp('^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$');
            if(re.test(String(email).toLowerCase())){
                ajaxRegistrar(nick,pass,email);
            }else{
                toast("Introduce un email valido")
            }
        } else {
            toast("Completa todos los campos del formulario");
        }
    });
});