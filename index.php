<?php
session_start();
require('clases/funciones.php');
if(@!$_SESSION['rut']){
    @header('Location: login.php');
    exit();
}
  $m = new Mantenedores();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aidim</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom Fonts -->  
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/ >
    <script src="js/jquery.js"></script>

    <!--********** librerias grafic: highcharts,keyframes **********-->  
    <script type="text/javascript" src="grafic/lib/Highcharts/jquery.keyframes.min.js"></script>
    <script src="grafic/lib/highcharts/highcharts.js"></script>
    <script src="grafic/lib/highcharts/highcharts-more.js"></script>
    <script src="grafic/lib/highcharts/solid-gauge.js"></script>
    <script src="grafic/lib/highcharts/exporting.js"></script>
    <!--********** librerias grafic: highcharts,keyframes **********-->  

    <script src="js/jquery.datetimepicker.full.js"></script>
    <script language="javascript">
    $(document).ready(function () {
                $("#exportButton").click(function () {
                    $("#exportTable").toggle();
                });
            });
    $(document).ready(function() {
        $(".botonExcel").click(function(event) {
            $("#datos_a_enviar").val( $("<div>").append( $("#tablaExcel").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
    });
    });
    </script>
    <script language="Javascript">
    function imprSelec(nombre) {
      var ficha = document.getElementById(nombre);
      var ventimp = window.open(' ', 'popimpr');
      ventimp.document.write( ficha.innerHTML );
      ventimp.document.close();
      ventimp.print( );
      ventimp.close();
    }
    </script>
    </head>
    <body>
    <style type="text/css">
        li > a {
            color:#999;
        }
    </style>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Arauco</span></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nombre']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="pages/logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php if($m->get_rol_id($_SESSION['rol_usuario']) == 'Administrador') { ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Reportes"><i class="fa fa-bar-chart"></i> Generar Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Reportes" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Inspecciones"><i class="fa fa-fw fa-arrows-v"></i> Inspecciones <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Inspecciones" class="collapse">
                            <li>
                                <a href="index.php?s=inspecciones&status=1">Realizadas</a>
                            </li>
                            <li>
                                <a href="index.php?s=inspecciones&status=0">No Realizadas</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Graficas"><i class="fa fa-pie-chart"></i> Generar Graficas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Graficas" class="collapse">
                            <li>
                                <a href="index.php?s=GraficasFallas" data-toggle="collapse" data-target="#fallas"><i class="fa fa-fw fa-arrows-v"></i> Fallas Registradas <i class="fa fa-fw fa-caret-down"></i></a>
                            </li>
                        </ul>
                   
                    </li>
          <!-- ************************* grafica variables ********************** -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#graficvar"><i class="fa fa-eye"></i>Graficas Variables<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="graficvar" class="collapse">
                            <li>
                                <a href="index.php?s=varequipo" data-target="#graficvar"><i class="glyphicon glyphicon-briefcase"></i> Variables Equipo<i class="fa fa-fw"></i></a>

                            </li>
                            <li>
                                <a href="index.php?s=varmaquina" data-target="#graficvar"><i class="glyphicon glyphicon-scale"></i> KPI Maquina<i class="fa fa-fw"></i></a>

                            </li>
                        </ul>
                   
                    </li>
          <!-- ************************* grafica variables ********************** -->

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ins"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Inspección <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ins" class="collapse">
                            <li>
                                <a href="index.php?s=addinspeccion">Generar Inpección</a>
                            </li>
                             <li>
                                <a href="index.php?s=listarinspecciones">Inspecciones Actuales</a>
                            </li>
                        </ul>                
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Mantenedores"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Mantenedores <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Mantenedores" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Usuario"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuario <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Usuario" class="collapse">
                            <li>
                                <a href="index.php?s=adduser">Ingresar nuevo usuario</a>
                            </li>
                            <li>
                                <a href="index.php?s=moduser">Modificar Usuario</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Area"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> Area <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Area" class="collapse">
                            <li>
                                <a href="index.php?s=addarea">Ingresar Area</a>
                            </li>
                            <li>
                                <a href="index.php?s=modarea">Modificar Area</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Maquina"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Maquina <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Maquina" class="collapse">
                            <li>
                                <a href="index.php?s=addmaquina">Ingresar Maquina</a>
                            </li>
                            <li>
                                <a href="index.php?s=modmaquina">Modificar Maquina</a>
                            </li>                             
                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Equipo"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Equipo <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Equipo" class="collapse">
                            <li>
                                <a href="index.php?s=addequipo">Ingresar Equipo</a>
                            </li>
                            <li>
                                <a href="index.php?s=modequipo">Modificar Equipo</a>
                            </li>  

                             </ul>
                             <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Item <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Item" class="collapse">
                            <li>
                                <a href="index.php?s=additem">Ingresar Item</a>
                            </li>
                            <li>
                                <a href="index.php?s=moditem">Modificar Item</a>
                            </li>
                            </li>
                            </ul>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Plantilla"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Plantilla <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Plantilla" class="collapse">
                            <li>
                                <a href="index.php?s=addplantilla">Ingresar Plantilla</a>
                            </li>
                            <li>
                                <a href="index.php?s=modplantilla">Modificar Plantilla</a>
                            </li>

                            </li>
                            </ul>                   
                    </li>
                    <!-- SUBMENU -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <?php } else if($m->get_rol_id($_SESSION['rol_usuario']) == 'Encargado') { ?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Reportes"><i class="fa fa-bar-chart"></i> Generar Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Reportes" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#Inspecciones"><i class="fa fa-fw fa-arrows-v"></i> Inspecciones <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="Inspecciones" class="collapse">
                            <li>
                                <a href="index.php?s=inspecciones&status=true">Realizadas</a>
                            </li>
                            <li>
                                <a href="index.php?s=inspecciones&status=false">No Realizadas</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Graficas"><i class="fa fa-pie-chart"></i> Generar Graficas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Graficas" class="collapse">
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#fallas"><i class="fa fa-fw fa-arrows-v"></i> Fallas Registradas <i class="fa fa-fw fa-caret-down"></i></a>
                                 <ul id="fallas" class="collapse">
                            <li>
                                <a href="#">Planificadas</a>
                            </li>
                            <li>
                                <a href="#">Emergencia</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                   
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Variables"><i class="fa fa-eye"></i> Visualizar Variables <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Variables" class="collapse">
                            <li>
                                <a href="#">Temperatura</a>
                            </li>
                            <li>
                                <a href="#">Vibración</a>
                            </li>
                        </ul>                
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ins"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Inspección <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ins" class="collapse">
                            <li>
                                <a href="index.php?s=addinspeccion">Generar Inpección</a>
                            </li>
                             <li>
                                <a href="index.php?s=listarinspecciones">Inspecciones Actuales</a>
                            </li>
                        </ul>                
                    </li>
                    <!-- SUBMENU -->
                    <!-- SUBMENU -->
                    
                    <!-- SUBMENU -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <?php } else if ($m->get_rol_id($_SESSION['rol_usuario']) == 'Operador') { ?>
        <!-- /.navbar-collapse -->
        <style>
        #wrapper {
            padding-left: 0px;
        }
        </style>
        </nav>
        <? } ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php

                    @$site = addslashes(htmlentities($_GET["s"]));

                    if($site && $site != "") {
                        switch($site) {
                            case "home":
                                $href = "pages/home.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                           case "adduser":
                                $href = "pages/mantenedores/adduser.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                           case "moduser":
                                $href = "pages/mantenedores/moduser.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                          case "addarea":
                                $href = "pages/mantenedores/addarea.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                         case "modarea":
                                $href = "pages/mantenedores/modarea.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                        case "addmaquina":
                                $href = "pages/mantenedores/addmaquina.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "modmaquina":
                                $href = "pages/mantenedores/modmaquina.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                        case "addequipo":
                                $href = "pages/mantenedores/addequipo.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "modequipo":
                                $href = "pages/mantenedores/modequipo.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "additem":
                                $href = "pages/mantenedores/additem.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "moditem":
                                $href = "pages/mantenedores/moditem.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;   
                        case "addplantilla":
                                $href = "pages/mantenedores/addplantilla.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "modplantilla":
                                $href = "pages/mantenedores/modplantilla.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;  
                         case "addinspeccion":
                                $href = "pages/mantenedores/add_inspeccion.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                         case "listarinspecciones":
                                $href = "pages/mantenedores/listarinspecciones.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 

                        case "inspecciones":
                                $href = "pages/inspecciones.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;  

                        case "GraficasFallas":
                                $href = "pages/graficasfallas.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
     // variables graficos *********************************************************
                        case "varmaquina":
                                $href = "grafic/varmaquina.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                        case "oee":
                                $href = "grafic/oee.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                        case "hoee":
                                $href = "grafic/h.oee.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                        case "hdis":
                                $href = "grafic/h.dis.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                        case "hrit":
                                $href = "grafic/h.rit.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                        case "hcal":
                                $href = "grafic/h.cal.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;
                        case "varequipo":
                                $href = "grafic/varequipo.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;

                         case "realt":
                                $href = "grafic/realt.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                                                               
                        case "realv":
                                $href = "grafic/realv.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 
                                
                        case "temctrl":
                                $href = "grafic/temctrl.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 

                        case "vibctrl":
                                $href = "grafic/vibctrl.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 

                        case "htemp":
                                $href = "grafic/h.temp.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break; 

                        case "hvibr":
                                $href = "grafic/h.vibr.php";
                                if(file_exists($href)) {
                                    include($href);
                                } else {
                                    include("pages/404.php");
                                }
                                break;     
// variables graficos *********************************************************

                                default:
                                include("pages/404.php");   
                                }
                            } else {
                                include("pages/home.php");
                        }
				?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
    <!-- jQuery -->
    <script type="text/javascript" src="tableExport.js"></script>
    <script type="text/javascript" src="jquery.base64.js"></script>
    <script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="jspdf/jspdf.js"></script>
    <script type="text/javascript" src="jspdf/libs/base64.js"></script>
    <script type="text/javascript" src="html2canvas.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>