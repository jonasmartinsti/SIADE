<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema Informatizado dos Agentes de Endemias</title>
    <script type="text/javascript">

    </script>
    <script type="text/javascript" src="js/jquery-1.10.2.js">
        
    </script>
    
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
    

</head>

<body>
    <?php session_start(); 
    if(isset($_SESSION['auth'])){
        include 'conecta.php';
    }else{
        session_destroy();
        header("LOCATION:index.php?msg_erro=Acesso negado!");
    }
    ?>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="principal.php">SIADE</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown Menu de Configurações -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li><a href="configuracoes.php"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div id="menu" class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Cadastros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="agente_listar.php">Agente</a>
                                </li>
                                <li>
                                    <a href="bairro_listar.php">Bairro</a>
                                </li>
                                <li>
                                    <a href="quadra_listar.php">Quadra</a>
                                </li>
                                <li>
                                    <a href="imovel_listar.php">Imóvel</a>
                                </li>
                                <li>
                                    <a href="rua_listar.php">Rua</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="gerenciamentociclo_listar.php"><i class="fa fa-dashboard fa-fw"></i> Gerenciamento de Ciclo</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Relatórios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="d1.php">D1</a>
                                </li>
                                <li>
                                    <a href="d7.php">D7</a>
                                </li>
                                <li>
                                    <a href="ciclo.php">Ciclo</a>
                                </li>
                                <li>
                                    <a href="#">Pendentes <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="pendentedia.php">Dia</a>
                                        </li>
                                        <li>
                                            <a href="pendentesemana.php">Semana</a>
                                        </li>
                                        <li>
                                            <a href="pendenteciclo.php">Ciclo</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


    </div>
    <!-- /#wrapper -->
    <div id="page-wrapper">
        <br />
        <div class="row">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    Lista de Bairros
                </div>
            <div class="panel-body">

                <?php
                    if(isset($_GET['msg_ok'])){
                        echo "<div class='alert alert-success'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                        echo $_GET['msg_ok'];
                        echo "</div>";
                    }else if(isset($_GET['msg_erro'])){
                        echo "<div class='alert alert-warning'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                        echo $_GET['msg_erro'];
                        echo "</div>";
                    }else if(isset($_GET['id'])){
                        echo "<div class='alert alert-info' id='info'>";
                        echo "Todas as quadras desse bairro serão excluídas. Deseja realmente excluir? 
                            <a href='bairro_deletar.php?id=".$_GET['id']."'class='btn btn-success btn-xs'> Sim </a>
                            <a href='bairro_listar.php?' class='btn btn-danger btn-xs'> Não </a>";
                        echo "</div>";
                    }
                ?>
                
                <div class="table-responsive">
                <?php 
                    include('conecta.php'); 
                    echo "<table class='table table-striped table-hover'>"; 
                    echo "<thead>"; 
                    echo "<th><b>Bairro</b></td>"; 
                    
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "</thead>"; 
                    $result = mysql_query("SELECT * FROM `bairro`") or trigger_error(mysql_error()); 
                    while($row = mysql_fetch_array($result)){ 
                    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
                    echo "<tr>";    
                    echo "<td valign='top'>" . nl2br( $row['nome_bairro']) . "</td>";  
                      
                    echo "<td colspan='2' align='right' valign='top'>
                    <a class='btn btn-warning btn-xs' href=bairro_editar.php?id={$row['id_bairro']}> Editar </a>
                    <a class='btn btn-danger btn-xs' href=bairro_listar.php?id={$row['id_bairro']}> Excluir </a></td> ";  
                    echo "</tr>"; 
                    } 
                    echo "</table>"; 
                ?>
                <a href="bairro.php" class="btn btn-success">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>
    
</body>

</html>