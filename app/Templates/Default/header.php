<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title.' - '.SITETITLE; //SITETITLE defined in index.php?></title>

    <?php
    Assets::css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css',
        Url::templatePath().'css/datepicker.css',
        Url::templatePath().'css/bootstrap-datetimepicker.min.css',
        Url::templatePath().'plugins/metisMenu/metisMenu.min.css',
        Url::templatePath().'dist/css/sb-admin-2.css',
        Url::templatePath().'dist/css/timeline.css',
        Url::templatePath().'css/page.css',
    ]);
    echo $css; //place to pass data / plugable hook zone
    ?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo GOOGLE_ANALYTICS; ?>

    <?php 
    Assets::js([
        'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js',
        Url::templatePath().'js/bootstrap-datepicker.js',
        Url::templatePath().'js/bootstrap-datetimepicker.min.js',
        Url::templatePath().'js/typeahead.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
        Url::templatePath().'plugins/metisMenu/metisMenu.js',
        Url::templatePath().'js/page.js'
    ]);
    echo $js; //place to pass data / plugable hook zone

    ?>

</head>
<body>
<?php echo $afterBody; //place to pass data / plugable hook zone?>
<div id='wrapper'>

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="logo" class="navbar-brand" href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
            </div>
            <!-- /.navbar-header -->
            <div class="collapse navbar-collapse">
                <?php /*ul class="nav navbar-nav">
                    <li class="active dropdown">
                        <a href="<?php echo DIR; ?>" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-table fa-fw"></i> Catalogo  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="active"><a href="#">Produtos</a></li>
                        </ul>
                    </li>
                </ul*/ ?>
            

                <ul class="nav navbar-nav navbar-top-links navbar-right">
                    <?php /*li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li*/ ?>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Meu Cadastro</a></li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a></li>
                            <li><a href="#"><i class="fa fa-key fa-fw"></i> Minha Senha</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> sair</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links --> 

                <div id="sidebar-offset" class="navbar-basic sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Pesquisa Tarefa...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li class="active">
                                <a href="<?php echo DIR; ?>" class="" title="Painel"><i class="fa fa-dashboard"></i> <span class="nome">Dashboard</span></a>
                            </li>
                            <li>
                                <a href="<?php echo DIR.'tasks'; ?>" class="" title="Lista de Música"><i class="fa fa-tasks"></i> <span class="nome">Tarefas</span> <i class="fa arrow"></i></a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo DIR.'task/add'; ?>" title="Adicionar Tarefas">Adicionar Tarefa</a>
                                        <a href="<?php echo DIR.'tasks'; ?>" title="Lista de Música">Lista de Tarefas</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo DIR.'projects'; ?>" class="" title="Lista de Projetos"><i class="fa fa-building"></i> <span class="nome">Projetos</span> <i class="fa arrow"></i></a>
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo DIR.'project/add'; ?>" title="Adicionar Projeto">Adicionar Projeto</a>
                                        <a href="<?php echo DIR.'projects'; ?>" title="Lista de Projetos">Projetos</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="" title="Usuários"><i class="fa fa-users"></i> <span class="nome">Usuários</span></a>
                            </li>
                            <li>
                                <a href="#" class="" title="Senhas"><i class="fa fa-key"></i> <span class="nome">Senhas</span></a>
                            </li>
                            <li>
                                <a href="#" class="" title="Notas"><i class="fa fa-sticky-note"></i> <span class="nome">Notas</span></a>
                            </li>
                        </ul>
                        <div class="clean"></div>
                    </div>
                    <div id="toggleMenuOffSet" class="text-center hidden-xs">
                        <button id="btn-offset" class="btn btn-default">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div id="pageHeader" class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="page-header"><?php echo $title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
