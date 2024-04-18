<?php
session_start();
if(isset($_SESSION['rut'])){
    header('Location: index.php');
    exit();
}
require('clases/funciones.php');
$class = new Logeo();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aidim - Tesis</title>
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">	<link rel="stylesheet" href="css/form-elements.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">                 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            	<div class="form-top">
                            		<div class="form-top-left">
                            			<img src="img/arauco.png" alt="Arauco">
                                		<p>Ingrese su DNI y su contraseña correspondiente.</p>
                            		</div>
                            		<div class="form-top-right">
                            			<i class="fa fa-lock"></i>
                            		</div>
                                </div>
                                <div class="form-bottom">
    		                  <?php
                                if(isset($_POST['Entrar']) == 'Entrar'){
                                $rut = mysqli_real_escape_string($class->conexion(),$_POST['rut']);
                                $pass = mysqli_real_escape_string($class->conexion(),$_POST['password']);
                                if($class->Login($rut,$pass)){
                                  echo '<div class="alert alert-dismissible alert-success">
                                          <button type="button" class="close" data-dismiss="alert">x</button>
                                          Inicio de sesión correcto!.
                                        </div>';
                                  echo '<meta http-equiv="Refresh" content="2"; url="index.php" />';
                                }
                                else{
                                   echo '<div class="alert alert-dismissible alert-danger">
                                          <button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
                                         Revise sus entradas!.
                                        </div>';
                                    }
                               }
                               ?>
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="rut" placeholder="Username..." class="form-username form-control" id="form-username" onblur = "this.value = this.value.replace( /^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')" autofocus>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" name="Entrar" class="btn">Entrar!</button>
			                    </form>
		                    </div>
                          </div>
                       </div>
                    </div>
                </div>
            </div>            
        </div>
        <!-- Javascript -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/scripts.js"></script>
        <!--[if lt IE 10]>
            <script src="js/placeholder.js"></script>
        <![endif]-->
    </body>
</html>