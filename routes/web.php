<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Acceso libre

Route::any('/', "IndexController@index");
Route::any('/index/entrar', "IndexController@entrar");
Route::any('/recuperar/mostrar', "RecuperarController@mostrar");
Route::any('/recuperar/recuperar', "RecuperarController@enviarMail");
Route::any('/recuperar/validar', "RecuperarController@validar");


Route::any('/admin', "IndexController@indexAdmin");
Route::any('/index/entrarAdmin', "IndexController@entrarAdmin");

Route::any('/registro/mostrar', "RegistroController@mostrar");
Route::any('/registro/registrar', "RegistroController@registrar");
Route::any('/registro/validar', "RegistroController@validar");
Route::any('/navegacion/cerrar', "NavegacionController@CerrarSesion");

Route::any("/tojson/juegos", "tojsonController@juegos");
Route::any("/tojson/generos", "tojsonController@generos");
Route::any("/tojson/comentarios", "tojsonController@comentarios");
Route::any("/tojson/comentariosAdmin", "tojsonController@comentariosAdmin");

// Acceso solo si esta iniciada la sesion como usuario
Route::group(['middleware' => ['session.has.user']], function () {

    //vistas
    //perfil
    Route::any('/navegacion/index', "NavegacionController@index");
    Route::any('/navegacion/verPerfil', "NavegacionController@verPerfil");
    Route::any('/navegacion/editarPerfil', "NavegacionController@editarPerfil");
    //Juegos
    Route::any('/navegacion/buscarJuego', "NavegacionController@buscarJuego");
    Route::any('/navegacion/verJuego/{id}', "NavegacionController@verJuego");
    //Comentarios
    Route::any("/navegacion/verComentario/{id}" , "NavegacionController@verComentario");
    //usuarios
    Route::any('/navegacion/buscarUsuario', "NavegacionController@buscarUsuario");
    Route::any('/navegacion/verPerfilAjeno/{nick}', "NavegacionController@verPerfilAjeno");
    //chat
    Route::any('/navegacion/chat', "NavegacionController@chat");
    //anuncios
    Route::any('/navegacion/buscarAnuncio', "NavegacionController@buscarAnuncio");
    Route::any('/navegacion/nuevoAnuncio', "NavegacionController@nuevoAnuncio");
    Route::any('/navegacion/misAnuncios', "AnunciosController@misAnuncios");
    Route::any('/navegacion/editarAnuncio/{cod}', "NavegacionController@editarAnuncio");

    //Back
    //inicio
    Route::any("/tojson/solicitudesUsuario", "tojsonController@solicitudesUsuario");
    Route::any("/tojson/amistadesUsuario", "tojsonController@amistadesUsuario");
    Route::any("/tojson/notificacionesUsuario", "tojsonController@notificacionesUsuario");
    Route::any("/tojson/novedadesUsuario/{inicio}/{take}", "tojsonController@novedadesUsuario");
    //Perfil
    Route::any('/editarPerfil/actualizar', "EditarPerfilController@actualizar");
    Route::any('/editarPerfil/actualizarImagen', "EditarPerfilController@actualizarimagen");
    //Juegos
    Route::any('/juego/cambiarEstadoUsuario', "JuegoController@cambiarEstadoUsuario");
    Route::any('/juego/filtrarUsu/{campo}/{valor}', "JuegoController@filtrarUsu");
    Route::any('/juego/nuevoComentario', "JuegoController@nuevoComentario");
    Route::any('/juego/cambiarPuntuacion', "JuegoController@cambiarPuntuacion");
    Route::any("/juego/eliminarComentario/{comentario}","JuegoController@eliminarComentario");
    Route::any("/juego/reportarComentario/{comentario}","JuegoController@reportarComentario");
    //usuarios
    Route::any('/usuario/filtrarUsu/{campo}/{valor}', "UsuarioController@filtrarUsu");
    Route::any("/reportesUsuarios/reportar/{nick}","ReportesUsuariosController@reportar");
    //amistades
    Route::any('/amistad/peticion/{nick}', "AmistadesController@peticion");
    Route::any('/amistad/aceptar/{nick}', "AmistadesController@aceptar");
    Route::any('/amistad/rechazar/{nick}', "AmistadesController@rechazar");
    Route::any('/amistad/eliminar/{nick}', "AmistadesController@eliminar");
    //chat
    Route::any("/chat/contactos", "ChatController@contactos");
    Route::any("/chat/chatUsuario/{usuario}/{inicio}/{take}", "ChatController@chatUsuario");
    Route::any("/chat/nuevosMensajesUsuario/{usuario}/{inicio}/{take}", "ChatController@nuevosMensajesUsuario");
    Route::any('/chat/nuevoMensaje', "ChatController@nuevoMensaje");
    //Anuncios
    Route::any('/anuncios/nuevoAnuncio', "AnunciosController@nuevoAnuncio");
    Route::any('/anuncios/filtrar/{campo}/{valor}', "AnunciosController@filtrar");
    Route::any('/anuncios/editar/{cod}', "AnunciosController@editarAnuncio");
    Route::any('/anuncios/eliminar/{cod}', "AnunciosController@eliminarAnuncio");

});


// Acceso solo si esta iniciada la sesion como administrador
Route::group(['middleware' => ['session.has.admin']], function () {

    //vistas
    //genero
    Route::any('/admin/navegacion/nuevoGenero', "NavegacionAdminController@nuevoGenero");
    Route::any('/admin/navegacion/buscarGenero', "NavegacionAdminController@buscarGenero");
    Route::any('/admin/navegacion/editarGenero/{id}', "NavegacionAdminController@editarGenero");

    //juego
    Route::any('/admin/navegacion/nuevoJuego', "NavegacionAdminController@nuevoJuego");
    Route::any('/admin/navegacion/buscarJuego', "NavegacionAdminController@buscarJuego");
    Route::any('/admin/navegacion/editarJuego/{id}', "NavegacionAdminController@editarjuego");
    Route::any('/admin/navegacion/verJuego/{id}', "NavegacionAdminController@verJuego");

    //usuarios
    Route::any('/admin/navegacion/buscarUsuario', "NavegacionAdminController@buscarUsuario");
    Route::any('/admin/navegacion/verPerfilAjeno/{nick}', "NavegacionAdminController@verPerfilAjeno");
    Route::any('/admin/navegacion/editarPerfil/{nick}', "NavegacionAdminController@editarPerfil");

    //reportes comentarios
    Route::any('/admin/navegacion/reportesComentarios', "NavegacionAdminController@reportesComentarios");
    Route::any('/admin/reportesComentarios/filtrar/{campo}/{valor}', "ReportesComentariosController@filtrar");
    Route::any('/admin/reportesComentarios/eliminar/{codigo}', "ReportesComentariosController@eliminar");
    Route::any('/admin/reportesComentarios/permitir/{codigo}', "ReportesComentariosController@permitir");

    //reportes usuarios
    Route::any('/admin/navegacion/reportesUsuarios', "NavegacionAdminController@reportesUsuarios");

    //Anuncios
    Route::any('/admin/navegacion/buscarAnuncio', "NavegacionAdminController@buscarAnuncio");
    Route::any('/admin/navegacion/editarAnuncio/{cod}', "NavegacionAdminController@editarAnuncio");



    // Back
    //generos
    Route::any('/admin/genero/insert', "GeneroController@insert");
    Route::any('/admin/genero/update', "GeneroController@update");
    Route::any('/admin/genero/delete/{cod}', "GeneroController@delete");
    Route::any('/admin/genero/filtrar/{campo}/{valor}', "GeneroController@filtrar");

    //juegos
    Route::any('/admin/juego/insert', "JuegoController@insert");
    Route::any('/admin/juego/update', "JuegoController@update");
    Route::any('/admin/juego/delete/{cod}', "JuegoController@delete");
    Route::any('/admin/juego/filtrar/{campo}/{valor}', "JuegoController@filtrar");
    Route::any("/admin/juego/eliminarComentario/{comentario}","JuegoController@eliminarComentarioAdmin");

    //usuarios
    Route::any('/admin/usuario/filtrar/{campo}/{valor}', "UsuarioController@filtrar");
    Route::any('/admin/editarUsuario/actualizar/{nick}', "EditarPerfilController@actualizarAdmin");
    Route::any('/admin/editarUsuario/actualizarImagen/{nick}', "EditarPerfilController@actualizarimagenAdmin");

    //Reportes Usuarios
    Route::any('/admin/reportesUsuarios/eliminar/{nick}', "ReportesUsuariosController@eliminar");
    Route::any('/admin/reportesUsuarios/permitir/{nick}', "ReportesUsuariosController@permitir");
    Route::any('/admin/reportesUsuarios/banear/{nick}', "ReportesUsuariosController@banear");
    Route::any('/admin/reportesUsuarios/desbanear/{nick}', "ReportesUsuariosController@desbanear");

    //Anuncios
    Route::any('/admin/anuncios/filtrar/{campo}/{valor}', "AnunciosController@filtrarAdmin");
    Route::any('/admin/anuncios/editar/{cod}', "AnunciosController@editarAnuncioAdmin");
    Route::any('/admin/anuncios/eliminar/{cod}', "AnunciosController@eliminarAnuncioAdmin");

});
