<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header mx-auto" >
        <a class="navbar-brand" href="index.php"><img src="../img/logo-dan.png" height="30px"> </a>
        
    </div>
    
    

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>



    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown navbar-inverse">
        <span class="mx-auto " style="color:darkgrey"><?php echo "  |  " . ($_SESSION['nombre']) . "  (  " . ($_SESSION['rol']) . "  )" ?></span>
        </li> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> Configuración <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">

                <li><a href="../db/logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php if ($_SESSION['idrol'] == 1 || $_SESSION['idrol'] == 3) :  ?>
                    <li>
                        <a href="listaMontarPedido.php" class="active"><i class="fa fa-pencil"></i>Montar Pedido</a>
                    </li>
                <?php endif ?>
                <?php if ($_SESSION['idrol'] == 1 || $_SESSION['idrol'] == 2) :  ?>
                    <li>
                        <a href="listaAprobarPedido.php" class="active"><i class="fa fa-check"></i>Aprobar Pedido</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>