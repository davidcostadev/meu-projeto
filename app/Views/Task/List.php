<?php 

use App\Models\Task\TaskConfig;
use Helpers\Date;

?>
<div class="panel panel-default">
    <?php /*<div class="panel-heading">
        <div class="row">
            <div class="col-md-12 col-lg-10 col-lg-offset-1">
                <form action="<?php echo DIR; ?>musicas/lista" method="get">
                    <div class="row">
                        <div class="col-xs-8 col-sm-9">
                            <input type="text" name="q" class="form-control input-lg" placeholder="Digite o nome da música">    
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-search"></i> Pesquisar</button>    
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>*/?>


    <div class="panel-body">
        <div class="form-inline">
            <div class="form-group form-group-sm" style="margin: 0;">
                <label for="" class="control-label" style="font-size: 12px;margin: 0">lista</label><br>
                <div class="input-group">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-table"></i> Tabela
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li class="active"><a href="#"><i class="fa fa-table"></i> Tabela</a></li>
                            <li><a href="#"><i class="fa fa-list-ul"></i> Lista</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        
            <div class="form-group form-group-sm" style="margin: 0;">
                <label for="" class="control-label" style="font-size: 12px;margin: 0">Disponibilidade</label><br>
                <div class="input-group">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Todos
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li class="active"><a href="#"> Todos</a></li>
                            <li><a href="#"> Ok</a></li>
                            <li><a href="#"> Indisponível</a></li>
                            <li><a href="#"> 7 Dias</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            
        
        
       
    </div>
     <table class="table table-hover table-striped table-list">
        <thead>
            <tr>
                <th style="width: 100px;">#ID <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th style="width: 220px;">Tarefa <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>T <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>P <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>Projeto <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>Status <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>Atualizado <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th style="width: 105px;"></th>
            </tr>
        </thead>
        <tbody class="headerInput">
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="id_produto" value="<?php if(isset($filtros['id_produto'])) echo $filtros['id_produto']; ?>" class="form-control input-xs">
                    </div>
                </td>
                <td>
                    
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" nome="id_produto_competidor" value="<?php if(isset($filtros['id_produto_competidor'])) echo $filtros['id_produto_competidor']; ?>" class="form-control input-xs">
                    </div>
                </td>>

                <td class="text-right">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-search"></i> Buscar</button>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php if(count($tasks) > 0) : ?>
                <?php foreach($tasks as $task) : ?>
                    <tr>
                        <td><a href="<?php echo DIR; ?>task/details/<?php echo $task->id; ?>">#<?php echo $task->id; ?></a></td>
                        <td><?php echo $task->task; ?></td>
                        <td class="text-center"><i class="<?php echo TaskConfig::getIconKind($task->kind); ?>"></i></td>
                        <td class="text-center"><i class="<?php echo TaskConfig::getIconPriority($task->priority); ?>"></i></td>
                        <td><?php echo $task->project_name; ?></td>
                        <td><?php echo $task->status; ?></td>
                        <td class="text-right"><?php echo Date::getTempo($task->update_on); ?></td>

                        <td class="text-right">
                            <div class="btn-group">
                                <button type="button" id="editMusica" class="btn btn-default btn-xs" data-id-musica="<?php echo $task->id_musica; ?>" data-id-musica="<?php echo $task->id_cantor; ?>" data-musica="<?php echo $task->musica; ?>" data-cantor="<?php echo $task->cantor; ?>" data-toggle="modal" data-target="#modalEditMusica">
                                    <i class="fa fa-pencil-square-o"></i> Editar
                                </button>
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Excluir</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="panel-footer text-center">
        <?php echo $paginacao; ?>
        <hr>
        <?php echo '<span style="font-size: 10px"><label class="label label-info">'.$quant.'</label> produtos no total ('.$time. ' Segundos)</span>'; ?>
    </div>
</div>
