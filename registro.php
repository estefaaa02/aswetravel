<?php
    session_start();
    require_once("daos/CargoDAO.php");
    require_once("entidades/Cargo.php");
    require_once("daos/UsuarioDAO.php");
    require_once("entidades/Usuario.php");
    require_once("daos/PreguntaDAO.php");
    require_once("entidades/Pregunta.php");
    require_once("daos/TarjetaDAO.php");
    require_once("entidades/Tarjeta.php");
    require_once("entidades/TipoUsuario.php");
    require_once("util/Conexion.php");

    $conexion = new Conexion();
    $con = $conexion->conectarBD();
    $cargoDAO = new CargoDAO($con);
    $preguntaDAO = new PreguntaDAO($con);
?>
<!doctype html>
<html lang="en">
<script type="text/javascript">
    function habilitar(valor) {
        if (valor == true) {
            document.getElementById("titular").disabled = false;
            document.getElementById("numero").disabled = false;
            document.getElementById("cvv").disabled = false;
        } else if (valor == false) {
            document.getElementById("titular").disabled = true;
            document.getElementById("numero").disabled = true;
            document.getElementById("cvv").disabled = true;
        }
    }

</script>
<script type="text/javascript">

  // initialise variable to save cc input string
  var cc_number_saved = "";

</script>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logo3r.png" type="image/png">
    <title>As We Travel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://kit.fontawesome.com/e600d1947b.js" crossorigin="anonymous"></script>
</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/logo3r.png" alt=""></a>
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
                                    aria-haspopup="true" aria-expanded="false">Nombre</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="#">Compras y reservas</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Historial de compras</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Historial de reservas</a></li>
                                </ul>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="#">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->


    <!--================ Área de formulario consulta de vuelos =================-->

    <!--================Home Blog Area =================-->
    <section class="blog_area single-post-area p_120">
        <form id="world" name="world" action="validarRegistro.php" method="post" class="needs-validation" novalidate>
            <?php
                if(isset($_SESSION["correoUsado"])){
                            echo " <div class='alert alert-danger alert-dismissible fade show'>
                        <center>  <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <strong>ERROR!</strong>El correo ya está siendo usado por otro usuario</center>
                            </div>";
                    unset($_SESSION['correoUsado']);
                  }
            ?>
            <div class="container">
                <div class="section-top-border">
                    <div class="row">

                        <!--  Formulario infromación vuelo y selección de asientos    -->

                        <div class="col-lg-8 col-md-8">
                            <div class="comment-form">
                                <h1>Mi información</h1>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-8 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Nombre</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-10 col-md-2 email">
                                        <input type="name" class="form-control" id="nombre" name="nombre"
                                            placeholder="Ingrese su nombre"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese su nombre'" required="true">
                                            <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-8 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Cargo</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-9 col-md-0 name">
                                        <div class="input-group-icon mt-10">
                                            <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                            <div class="form-select" id="default-select">
                                                <select name="cargo" id="cargo">
                                                    <?php
                                                        
                                                        $cargos = $cargoDAO->obtenerCargos();

                                                        foreach($cargos as $cargo){
                                                    ?>
                                                    <option value=<?php echo $cargo->getCod_cargo(); ?>><?php echo $cargo->getNom_cargo(); ?></option>
                                                        <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-8 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Correo</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-10 col-md-0 email">
                                        <input type="email" class="form-control" id="correo" name="correo"
                                            placeholder="Ingrese su correo"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese su correo'" required="true">
                                            <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-10 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Contraseña</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-10 col-md-2 email">
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            placeholder="Ingrese su contraseña"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese su contraseña'" required="true">
                                            <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-10 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Pregunta de seguridad</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-10 col-md-2 email">
                                        <select name="pregunta" id="pregunta">
                                                    <?php
                                                        
                                                        $preguntas = $preguntaDAO->obtenerPreguntas();

                                                        foreach($preguntas as $pregunta){
                                                    ?>
                                                    <option value=<?php echo $pregunta->getCod_pregunta(); ?>><?php echo $pregunta->getNom_pregunta(); ?></option>
                                                        <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                                Debe llenar este campo
                                        </div>
                                    </div>
                                </div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <center>
                                        <div class="form-group col-lg-10 col-md-0 name">
                                            <section class="sample-text-area">
                                                <p class="col-md-10 mt-sm-20 "> <b>Respuesta</b> </p>
                                            </section>
                                        </div>
                                    </center>
                                    <div class="form-group col-lg-10 col-md-2 email">
                                        <input type="text" class="form-control" id="respuesta" name="respuesta"
                                            placeholder="Ingrese su respuesta a la pregunta de seguridad"
                                            onfocus="this.placeholder = 'Campo requerido'"
                                            onblur="this.placeholder = 'Ingrese su respuesta'" required>
                                            <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                    </div>
                                </div>



                                <div class="br"></div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <div class="button-group-area mt-10">
                                        <a href="index.php" class="genric-btn warning-border circle">Regresar</a>
                                    </div>
                                    <div class="button-group-area mt-10">
                                        <button type="submit" class="genric-btn danger circle" name="registrar" aria-label > Registrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="blog_right_sidebar">
                                <div class="switch-wrap d-flex justify-content-between">
                                    <h3>Medio de pago</h3>
                                </div>

                                <div class="br"></div>

                                <aside name="todo" class="single_sidebar_widget author_widget">
                                    <h4 class="mb-20 title_color">Titular</h4>
                                    <input type="name" name="titular" class="form-control" name="titular" id="titular"
                                        placeholder="Ingrese el nombre del titular"
                                        onfocus="this.placeholder = 'Campo requerido'"
                                        onblur="this.placeholder = 'Ingrese el nombre del titular'" required="true">
                                        <div class="invalid-tooltip">
                                                Debe llenar este campo
                                            </div>
                                    <h4 class="mb-20 title_color">Número</h4>
                                    <input type="number" name="numero" class="form-control" name="numero" id="numero"
                                        placeholder="Ingrese el número de cuenta"
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
                                        <div class="invalid-feedback" >
                                                Debe llenar este campo
                                            </div>
                                    <h4 class="mb-20 title_color">Cvv</h4>
                                    <input type="name" name="cvv" class="form-control" name="cvv" id="cvv"
                                        placeholder="Ingrese el CVV de la tarjeta"
                                        onfocus="this.placeholder = 'Campo requerido'"
                                        onblur="this.placeholder = 'Ingrese el CVV de la tarjeta'">
                                        <div class="invalid-feedback">
                                                Debe llenar este campo
                                            </div>
                                </aside>
                                <div class="br"></div>
                                <div class="switch-wrap d-flex justify-content-between">
                                    <p>Ingresar medio de pago ahora</p>
                                    <div class="confirm-switch" id="switch">
                                        <input type="checkbox" name="tarjeta" id="confirm-switch"
                                            onchange="habilitar(this.checked)" checked>
                                        <label for="confirm-switch"></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================End Home Blog Area =================-->







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
    <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/theme.js"></script>
    <script type="text/javascript" src="js/node_modules/creditcard.js/dist/creditcard.min.js"></script>
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

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>

</html>

<?php
$conexion->desconectarBD($con);
unset($conexion);
?>