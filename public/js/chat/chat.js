var chatAmigo = "";
var refrescoChat = 5;
$("#chat").remove();
$(document).ready(function () {
    chat();
})

function chat() {
    ajaxAmigosChat();
}

function ajaxAmigosChat() {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/chat/contactos",
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);

                for (let c in data) {
                    $("#chatListadoAmigos").append(
                        "<li class='collection-item avatar conversacion' id='chat" + data[c].amigo + "'>" +
                        "   <i class='mdi-social-person-outline circle white'>" +
                        "       <img src='/storage/app/perfiles/" + data[c].img + "' class='indexavatar'>" +
                        "   </i>" +
                        "   <a href='#" + data[c].amigo + "' class='title'>" + data[c].amigo +"  <div id='cmens"+data[c].amigo+"' class='chip'>"+data[c].cmens+ "</div> </a>" +
                        "</li>"
                    );

                    $("#chat" + data[c].amigo).click(function () {
                        chatAmigo = data[c].amigo;
                        cargarChat(chatAmigo);
                        primera = true;
                    });
                }
            }
        });

    $("#enviarMensaje").click(function () {
        enviarMensaje();
    });
}

function cargarChat() {
    moment.locale("es");
    if (chatAmigo != "") {
        inicioChat = 0;
        takeChat = 10;

        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "/chat/chatUsuario/" + chatAmigo + "/" + inicioChat + "/" + takeChat,

                error: function (e) {
                    console.log(e)
                    toast("Ha ocurrido un error inesperado");
                },

                success: function (data) {
                    $("#chatListadoMensajes").empty();
                    data = JSON.parse(data);
                    data["chats"] = JSON.parse(data["chats"]);
                    $("#cmens"+chatAmigo).html(0);

                    let imagenes = data["usuarios"];
                    let mensajes = data["chats"];

                    for (let c in mensajes) {
                        $("#chatListadoMensajes").append(
                            "<li class='collection-item avatar'>" +

                            "   <i class='mdi-social-person-outline circle white'>" +
                            "       <img src='/storage/app/perfiles/" + imagenes[mensajes[c].de] + "' class='indexavatar'>" +
                            "   </i>" +

                            "   <a href='/navegacion/verPerfilAjeno/" + mensajes[c].de + "' class='title'>" + mensajes[c].de + "</a>" +
                            "   <p class='grey-text'>" + moment(mensajes[c].fecha).fromNow() + "</p>" +
                            "   <p class='black-text'>" + mensajes[c].texto + "</p>" +
                            "</li>"
                        );
                    }

                    $('#chatListadoMensajes').scrollTop(document.getElementById("chatListadoMensajes").scrollHeight);

                }
            });
    }
}
function nuevosMensajes() {
    moment.locale("es");
    if (chatAmigo != "") {
        inicioChat = 0;
        takeChat = 10;

        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "/chat/nuevosMensajesUsuario/" + chatAmigo + "/" + inicioChat + "/" + takeChat,

                error: function (e) {
                    console.log(e)
                    toast("Ha ocurrido un error inesperado");
                },

                success: function (data) {
                    data = JSON.parse(data);
                    data["chats"] = JSON.parse(data["chats"]);

                    let imagenes = data["usuarios"];
                    let mensajes = data["chats"];

                    for (let c in mensajes) {
                        $("#chatListadoMensajes").append(
                            "<li class='collection-item avatar'>" +

                            "   <i class='mdi-social-person-outline circle white'>" +
                            "       <img src='/storage/app/perfiles/" + imagenes[mensajes[c].de] + "' class='indexavatar'>" +
                            "   </i>" +

                            "   <a href='/navegacion/verPerfilAjeno/" + mensajes[c].de + "' class='title'>" + mensajes[c].de + "</a>" +
                            "   <p class='grey-text'>" + moment(mensajes[c].fecha).fromNow() + "</p>" +
                            "   <p class='black-text'>" + mensajes[c].texto + "</p>" +
                            "</li>"
                        );
                        $('#chatListadoMensajes').scrollTop(document.getElementById("chatListadoMensajes").scrollHeight);
                    }



                }
            });
    }
}

function enviarMensaje() {
    if ($("#mensaje").val() != "" && chatAmigo != "") {
        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "https://danielortegaconesa.com/chat/nuevoMensaje",
                data: {
                    para: chatAmigo,
                    mensaje: escapeHtml($("#mensaje").val())
                },
                success: function (data) {
                    $("#mensaje").val("");
                    cargarChat(chatAmigo);
                }
            });
    } else {
        if(chatAmigo=="") {
            toast("Selecciona un amigo");
        }else{
            toast("Escribe texto en el mensaje");
        }
    }
}


setInterval(nuevosMensajes, (refrescoChat*1000));


