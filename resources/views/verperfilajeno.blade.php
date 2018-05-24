@include("plantillas.toplog")
@if(!$u->baneado)
    <!-- Se utiliza en la peticion ajax-->
    <script>
        let nick = '<?=$u->nick?>';
    </script>

    <?php
    if ($u->nick == session("usuario")->nick) {
        header("location:/navegacion/verPerfil");
        die;
    }

    $jugando = [];
    $dejados = [];
    foreach ($u->juegos as $juego) {
        if ($u->estadoJuego($u->nick, $juego->cod) == "jugando") {
            $jugando[] = $juego;
        } else if ($u->estadoJuego($u->nick, $juego->cod) == "dejado") {
            $dejados[] = $juego;
        }
    }
    ?>

    <!-- Cabezara del perfil -->
    <div id="perfil" class="card imgbanner">
        <div class="card-content">
            <div class="row valign-wrapper">
                <div class="col s12">
                    <h4 class="texto-azul"><img src="{{url('/storage/app/perfiles/'.$u->perfil->img)}}"
                                                alt="imagen de perfil"
                                                class="circle imgperfil">

                        <div class="left-align">{{$u->nick}}</div>
                        <div class="right-align">
                            <i id="reportuser" class="material-icons waves-effect red-text tooltipped rightmargin30"  data-tooltip="Reportar">report_problem</i>
                            <?php
                            $estado = "no";
                            $a1 = \App\Amistades::where("nick1", session("usuario")->nick)->where("nick2", $u->nick)->first();
                            $a2 = \App\Amistades::where("nick1", $u->nick)->where("nick2", session("usuario")->nick)->first();

                            if ($a1 == NULL && $a2 == NULL) {
                                $a1 = \App\PeticionesAmistad::where("nick1", session("usuario")->nick)->where("nick2", $u->nick)->first();
                                $a2 = \App\PeticionesAmistad::where("nick1", $u->nick)->where("nick2", session("usuario")->nick)->first();
                                if ($a1 == NULL && $a2 == NULL) {
                                    echo "<i id='add' class='material-icons waves-effect tooltipped' data-tooltip='Agregar' >person_add</i>";
                                } else {
                                    echo "<i id='reloj' class='material-icons waves-effect'>timer</i>";
                                }
                            } else {
                                echo "<i id='remove' class='material-icons waves-effect tooltipped' data-tooltip='Eliminar'>close</i>";
                            }
                            ?>

                        </div>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido -->
    <div id="contenido-perfil" class="row">

        <div id="lateral" class="col s12 m6">
            <div class="card light-blue darken-4">
                <div class="card-content">
                    <span class="card-title">Sobre mi</span>
                    <p>{{$u->perfil->descripcion}}</p>
                    <br/>
                    <span class="card-title">Tambien en</span>
                    <p>{{$u->perfil->red}}</p>
                </div>
            </div>
        </div>

        <div id="lateral" class="col s12 m6">
            <div class="card light-blue darken-4">
                <div class="card-content">
                    <span class="card-title">Disponibilidad</span>
                    <?php
                    $semana = $u->perfil->horario;
                    $fin = $u->perfil->horariofin;
                    echo "<p>Entre Semana: ";
                    switch ($semana) {
                        case "m":
                            echo "Mañanas</p>";
                            break;
                        case "t":
                            echo "Tardes</p>";
                            break;
                        case "n":
                            echo "Noches</p>";
                            break;
                        case "mt":
                            echo "Mañanas y Tardes</p>";
                            break;
                        case "mn":
                            echo "Mañanas y Noches</p>";
                            break;
                        case "tn":
                            echo "Tardes y Noches</p>";
                            break;
                        case "todo":
                            echo "Cuando sea</p>";
                            break;
                        case "ninguno":
                            echo "Demasiado ocupado</p>";
                            break;
                    }

                    echo "<br/>";

                    echo "<p>Fin de Semana: ";
                    switch ($fin) {
                        case "m":
                            echo "Mañanas</p>";
                            break;
                        case "t":
                            echo "Tardes</p>";
                            break;
                        case "n":
                            echo "Noches</p>";
                            break;
                        case "mt":
                            echo "Mañanas y Tardes</p>";
                            break;
                        case "mn":
                            echo "Mañanas y Noches</p>";
                            break;
                        case "tn":
                            echo "Tardes y Noches</p>";
                            break;
                        case "todo":
                            echo "Cuando sea</p>";
                            break;
                        case "ninguno":
                            echo "Demasiado ocupado</p>";
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- listados -->
        <div class="row">
            <div class="col s12">
                <ul class="tabs light-blue darken-4">
                    <li class="tab col s6"><a href="#jugando">Jugando</a></li>
                    <li class="tab col s6"><a href="#dejados">Dejados</a></li>
                </ul>
            </div>

            <div id="jugando" class="col s12">
                <ul class="collection">
                    @if($jugando == [])
                        <li class="collection-item">
                            <div>Todavia Ninguno</div>
                        </li>
                    @endif
                    @foreach($jugando as $j)
                        <li class="collection-item">
                            <div>{{$j->nombre}}<a href="{{url("/navegacion/verJuego/".$j->cod)}}"
                                                  class="secondary-content"><i
                                            class="material-icons">pageview</i></a></div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div id="dejados" class="col s12">
                <ul class="collection">
                    @if($dejados == [])
                        <li class="collection-item">
                            <div>Todavia Ninguno</div>
                        </li>
                    @endif
                    @foreach($dejados as $j)
                        <li class="collection-item">
                            <div>{{$j->nombre}}<a href="{{url("/navegacion/verJuego/".$j->cod)}}"
                                                  class="secondary-content"><i
                                            class="material-icons">pageview</i></a></div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    <script src="{{url("/public/js/verPerfilAjeno/ajax.js")}}"></script>
@else
    <h4>Usuario baneado</h4>
@endif
@include("plantillas.footlog")

