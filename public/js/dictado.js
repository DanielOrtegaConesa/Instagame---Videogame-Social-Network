var artyom = new Artyom();
artyom.initialize({
    lang:"es-ES",// A lot of languages are supported. Read the docs !
    continuous:false,// recognize 1 command and stop listening !
    listen:false, // Start recognizing
    debug:true, // Show everything in the console
    speed:1 // talk normally
}).then(function(){
    console.log("Ready to work !");
});

function dictado(idMostrarResultado) {
    var settings = {
        continuous: false,
        onResult:function(text){
            if(text==""){
                UserDictation.stop();
            }else{
                console.log("Recognized text: ", text);
                $("#"+idMostrarResultado).val(text);
            }
        },

        onStart:function(){
            $("#microfono").html("mic");
        },

        onEnd:function() {
            $("#microfono").html("mic_none");
        }
    };

    var UserDictation = artyom.newDictation(settings);
    UserDictation.start();
}

$("#microfono").click(function () {
    dictado(idMostrarResultado);
})