<!doctype html>
<html lang="en">

<?php
    session_start();
    require_once($_SERVER["DOCUMENT_ROOT"] .'/util/Conexion.php');
    $conexion = new Conexion();
    $con = $conexion->conectarBD();
    
    $vIda = $_POST['vueloIda'];
    $vVuelta = $_POST['vueloVuelta'];
    $c = $_POST['categoria'];
    $numAsientos = $_POST['numero_asientos'];
    
    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/CargoDAO.php');
    $cargoDAO = new CargoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Cargo.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/VueloDAO.php');
    $vueloDAO = new VueloDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Vuelo.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/CategoriaAsientoDAO.php');
    $categoriaDAO = new CategoriaAsientoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/CategoriaAsiento.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/AsientoDAO.php');
    $asientoDAO = new AsientoDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Asiento.php');

    require_once($_SERVER["DOCUMENT_ROOT"] .'/daos/AerolineaDAO.php');
    $aerolineaDAO = new AerolineaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"] .'/entidades/Aerolinea.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/CiudadDAO.php');
    $ciudadDAO = new CiudadDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Ciudad.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/UsuarioDAO.php');
    $usuarioDAO = new UsuarioDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Usuario.php');

    require_once($_SERVER["DOCUMENT_ROOT"].'/daos/TarjetaDAO.php');
    $tarjetaDAO = new TarjetaDAO($con);

    require_once($_SERVER["DOCUMENT_ROOT"].'/entidades/Tarjeta.php');

?>

<script type="text/javascript">
    function chkcontrol(j) {
        var total = 0;
        for (var i = 0; i < document.getElementsByName("asiento[]").length; i++) {
            if (document.getElementsByName("asiento[]")[i].checked) {
                total = total + 1;
            }
            if (total > <?php echo $numAsientos ?>) {
                alert(<?php echo "Solo puede seleccionar ".$numAsientos." asientos. (".$numAsientos.")" ?>)
                document.getElementsByName("asiento[]")[j].checked = false;
                return false;
            }
        }
    }

function habilitar(valor)
{
    if(valor==true)
    {
        document.getElementById("titular").disabled=false;
        document.getElementById("numero").disabled=false;
        document.getElementById("cvv").disabled=false;
    }else if(valor==false)
    {
        document.getElementById("titular").disabled=true;
        document.getElementById("numero").disabled=true;
        document.getElementById("cvv").disabled=true;
    }
}

</script>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/logo3r.png" type="image/png">
    <title>AsWeTravel.com</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendors/animate-css/animate.css">
    <link rel="stylesheet" href="../vendors/popup/magnific-popup.css">
    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="../index.html"><img src="../img/logo3r.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item submenu dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre'] ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="../misDatos.php">Mi información</a>
                                    <li class="nav-item"><a class="nav-link" href="../comprasReservas.php">Compras y reservas</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../historialCompras.php">Historial de compras</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../historialReservas.php">Historial de reservas</a></li>
                                </ul>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area p_120">
        <form id="world" name="world" method="post" action="realizarCompraCliente.php">
            <div class="container">
                <div class="section-top-border">
                    <div class="row">

                        <!--  Formulario infromación vuelo y selección de asientos    -->

                        <?php 
                $vuelo = $vueloDAO->consultarVuelo($vIda);

                $aerolinea = $vuelo->getAerolinea();

                $ciudadOrigen = $vuelo->getCiudad_origen();

                $ciudadDestino = $vuelo->getCiudad_destino();

                $categoria = $categoriaDAO->consultarCategoriaAsiento($c);

                $fLlegada = strtotime( $vuelo->getFecha_llegada());
                $fechaLlegada = date( 'H:i d/m/Y ', $fLlegada );

            ?>

                        <div class="col-lg-8 col-md-8">
                            <div class="comment-form">
                                <h1>Comprar tiquete</h1>
                                <input type="hidden" value=<?php echo $vIda ?> name="vueloIda" id="vueloIda">
                                <input type="hidden" value=<?php echo $vVuelta ?> name="vueloVuelta" id="vueloIda">
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                    <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20" > <b>Precio</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-2 name">
                                        <input type="hidden" value=<?php echo $vuelo->getPrecio_vuelo(); ?> name="precio">
                                        <section class="sample-text-area">
                                            <p class="col-md-10 mt-sm-10 "> <?php echo $vuelo->getPrecio_vuelo(); ?> </p>
                                        </section>
                                    </div>
                                    <center>
                                    <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20 "> <b>Aerolínea</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-0 name">
                                        <input type="hidden" value=<?php echo $aerolinea->getNom_aerolinea(); ?> name="aerolinea">
                                        <section class="sample-text-area">
                                            <p class="col-md-10 mt-sm-10 "> <?php echo $aerolinea->getNom_aerolinea(); ?> </p>
                                        </section>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20 "> <b>Fecha salida</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-0 name">
                                        <input type="hidden" value=<?php echo $vuelo->getFecha_salida(); ?> name="fechaSalida">
                                        <section class="sample-text-area">
                                            <p class="col-md-10 mt-sm-10 "> <?php echo $vuelo->getFecha_salida(); ?> </p>
                                        </section>
                                    </div>
                                    <center>
                                        <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20 "> <b>Fecha llegada</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-30 name">
                                        <input type="hidden" value=<?php echo $vuelo->getFecha_llegada(); ?> name="fechaLlegada">
                                        <section class="sample-text-area">
                                            <p><?php echo $fechaLlegada ?></p>
                                        </section>
                                    </div>
                                </div>

                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20 "> <b>Ciudad salida</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-0 name">
                                        <input type="hidden" value=<?php echo $ciudadOrigen->getNom_ciudad(); ?> name="ciudadSalida">
                                        <section class="sample-text-area">
                                            <p class="col-md-10 mt-sm-10 "><?php echo $ciudadOrigen->getNom_ciudad(); ?> </p>
                                        </section>
                                    </div>
                                    <center>
                                        <div class="form-group col-lg-30 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-25 mt-sm-20 "> <b>Ciudad llegada</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-4 col-md-0 name">
                                        <input type="hidden" value=<?php echo $ciudadDestino->getNom_ciudad(); ?> name="ciudadLlegada">
                                        <section class="sample-text-area">
                                            <p class="col-md-10 mt-sm-10 "><?php echo $ciudadDestino->getNom_ciudad(); ?> </p>
                                        </section>
                                    </div>
                                </div>

                                <div class="br"></div>

                                <br>

                                <!-- Imagen del mapa del avión -->

                                <div class="col-md-15">
                                    <img src="../img/elements/mapaAvion.PNG" alt="" class="img-fluid">
                                </div>


                                <br>
                                <br>

                                <!-- Check de asientos en lista -->
                                <!-- if dependiendo de la clase dos for para que baje de fila -->
                                <center>
                                
                                    <?php
                                        
                                        $cont = 0;
                                        #$asientosLlenos = array();
                                        #$asientosLlenos = $asientoDAO->obtenerAsientosOcupadosPorVuelo($vuelo->getCod_vuelo());
                                        $asientos = $asientoDAO->obtenerAsientosPorCategoria($categoria->getCod_categoria_asiento());   
                                        foreach($asientos as $a)
                                        {
                                            
                                            
                                        ?>
                                            <div class="switch-wrap d-flex justify-content-between">
                                            
                                            <p> <?php echo $a->getNom_asiento(); ?> </p>
                                        <?php
                                                #if(count($asientosLlenos) != 0)
                                                #{
                                                    #foreach($asientosLlenos as $listaLlenos)
                                                    #{
                                                        #if($listaAsientos->getCod_asiento() == $listaLlenos->getCod_asiento())
                                                        #{
                                            ?>
                                                          <!--  <div class="primary-checkbox">
                                                                <input type="checkbox" disabled id="default-checkbox1">
                                                                <label for="default-checkbox1"></label>
                                                            </div> 
                                            <?php
                                                        #}
                                                        #else
                                                        #{
                                            ?>
                                                            <div class="primary-checkbox">
                                                                <input type="checkbox" name="asiento[]" value=<?php #echo $a->getCod_asiento(); ?>
                                                                    onclick='chkcontrol(<?php #echo $cont ?>)' id="default-checkbox<?php #echo $cont ?>" >
                                                                <label for="default-checkbox<?php #echo $cont ?>" ></label>
                                                            </div> -->
                                            <?php
                                                        #}
                                                    #}
                                                #}
                                                #else
                                                #{
                                            ?>
                                                <div class="primary-checkbox">
                                                    <input type="checkbox" name="asiento[]" value="<?php echo $a->getCod_asiento(); ?>"
                                                        onclick='chkcontrol(<?php echo $cont ?>)' id="default-checkbox<?php echo $cont ?>" >
                                                    <label for="default-checkbox<?php echo $cont ?>" ></label>
                                                </div>
                                            <?php
                                                #}
                                        ?>
                                            
                                            </div>
                                        <?php
                                            $cont = $cont+1;
                                        
                                        }
                                    ?>
                                 
                                </center>

                               <div class="br"></div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <div class="button-group-area mt-10">
                                        <a class="genric-btn warning-border circle" href=<?php $_SERVER["DOCUMENT_ROOT"]."/index.php" ?> >Regresar</a>
                                    </div>
                                    <div class="button-group-area mt-10">
                                            <button type="submit" name='envio' class="genric-btn danger circle" aria-label> Comprar
                                            </button>
                                        </div>
                                </div>
                            </div>

                        </div>

                        <!--  Sección derecha datos de la tarjeta    -->

                        <div class="col-lg-4 ">
                            <div class="blog_right_sidebar">
                                <div class="switch-wrap d-flex justify-content-between">

                                <?php
                                    $usuario = $usuarioDAO->consultarUsuarioCod($_SESSION['codigo_usuario']);
                                    $tarjeta = $usuario->getTarjeta();

                                    if($tarjeta != null)
                                    {
                                ?>
                                    <p>Cambiar medio de pago</p>
                                    <div class="confirm-switch" id="switch" >
                                        <input type="checkbox"  name="tarjeta" id="confirm-switch" onchange="habilitar(this.checked)" checked>
                                        <label for="confirm-switch"></label>
                                    </div>
                                </div>

                                <div class="br"></div>

                                <aside name="todo" class="single_sidebar_widget author_widget">
                                        <h4 class="mb-20 title_color">Titular</h4>
                                        <input type="hidden" name="tar" value="<?php $tarjeta->getCod_tarjeta();?>" >
                                        <input type="hidden" name="titular" value="<?php $tarjeta->getNom_titular_tarjeta(); ?>" >
                                        <input type="name" name="titular" class="form-control" id="titular" name="titular"
                                            placeholder="<?php $tarjeta->getNom_titular_tarjeta(); ?>"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el nombre del titular'" required="true">
                                        <h4 class="mb-20 title_color">Número</h4>
                                        <input type="hidden" name="numero" value="<?php $tarjeta->getNumero_tarjeta(); ?>" >
                                        <input type="number" name="numero" class="form-control" name="numero" id="numero"
                                        placeholder="<?php $tarjeta->getNumero_tarjeta(); ?>"
                                        onblur="
                                                // save input string and strip out non-numbers
                                                cc_number_saved = this.value;
                                                this.value = this.value.replace(/[^\d]/g, '');
                                                if(!validarTarjeta(this.value)) {
                                                    alert('Tarjeta inválida');
                                                    this.value = '';
                                                }
                                                " onfocus="
                                                // restore saved string
                                                if(this.value != cc_number_saved) this.value = cc_number_saved;
                                                " required="true">
                                        <h4 class="mb-20 title_color">Cvv</h4>
                                        <input type="hidden" name="cvv" value="<?php $tarjeta->getCvv_tarjeta(); ?>" >
                                        <input type="name" name="cvv" class="form-control" id="cvv" name="cvv"
                                            placeholder="<?php $tarjeta->getCvv_tarjeta(); ?>"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el CVV de la tarjeta'">
                                    </aside>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <p>Ingrese su medio de pago</p>
                                </div>

                                <div class="br"></div>

                                <aside name="todo" class="single_sidebar_widget author_widget">
                                        <h4 class="mb-20 title_color">Titular</h4>
                                        <input type="name" name="titular" class="form-control" id="titular" name="titular"
                                            placeholder="Ingrese el nombre del titular"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el nombre del titular'" required="true">
                                        <h4 class="mb-20 title_color">Número</h4>
                                        <input type="number" name="numero" class="form-control" name="numero" id="numero"
                                        placeholder="Ingrese ek número de cuenta"
                                        onblur="
                                                // save input string and strip out non-numbers
                                                cc_number_saved = this.value;
                                                this.value = this.value.replace(/[^\d]/g, '');
                                                if(!validarTarjeta(this.value)) {
                                                    alert('Tarjeta inválida');
                                                    this.value = '';
                                                }
                                                " onfocus="
                                                // restore saved string
                                                if(this.value != cc_number_saved) this.value = cc_number_saved;
                                                " required="true">
                                        <h4 class="mb-20 title_color">Cvv</h4>
                                        <input type="name" name="cvv" class="form-control" id="cvv" name="cvv"
                                            placeholder="Ingrese el CVV de la tarjeta"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese el CVV de la tarjeta'">
                                    </aside>
                                <?php
                                    }
                                ?>
                            </div>

                            <br>
                            <br>
                            <div class="blog_right_sidebar">
                                <div class="switch-wrap d-flex justify-content-between">
                                        <h3>Categoria de asientos</h3>
                                </div>
    
                                <div class="br"></div>
    
                                <aside name="todo" class="single_sidebar_widget author_widget">
                                    <h4 class="mb-20 title_color">Primera clase</h4>
                                        <div class="percentage">
                                            <div class="progress">
                                                <div class="progress-bar color-2" background-color="#d6d851" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    <h4 class="mb-20 title_color">Ejecutivo</h4>
                                        <div class="percentage">
                                            <div class="progress">  
                                                <div class="progress-bar color-3" background-color="#717244" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    <h4 class="mb-20 title_color">Económico</h4>
                                        <div class="percentage">
                                            <div class="progress">
                                                <div class="progress-bar color-1" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                </aside>
                            </div>    

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        $conexion->desconectarBD($con);
        unset($conexion);
        ?>
    </section>
    <!--================Blog Area =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/theme.js"></script>

    <script>
        function validarTarjeta(input) {
    // Accept only digits, dashes or spaces
        var sum = 0;
        var numdigits = input.length;
        var parity = numdigits % 2;
        for(var i=0; i < numdigits; i++) {
            var digit = parseInt(input.charAt(i))
            if(i % 2 == parity) digit *= 2;
            if(digit > 9) digit -= 9;
            sum += digit;
    }
    return (sum % 10) == 0;
    }
    </script>


</body>

</html>