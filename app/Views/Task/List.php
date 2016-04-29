<?php 

use App\Models\Task\TaskConfig;
use Helpers\Date;

?>
<div class="panel panel-default">

    <div class="panel-body">
        <a href="<?php echo DIR; ?>tasks" class="btn btn-default"><i class="fa fa-eye"></i> Tudo</a>
        <a href="<?php echo DIR; ?>tasks?status=new" class="btn btn-link"><i class="fa fa-eye"></i> Novos</a>
        <a href="<?php echo DIR; ?>tasks?status=open" class="btn btn-link"><i class="fa fa-eye"></i> Abertos</a>
        <a href="<?php echo DIR; ?>tasks?priority=high" class="btn btn-link"><i class="fa fa-eye"></i> Urgentes</a>
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
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <?php if(isset($projects[$filtro['project_id']])) echo $projects[$filtro['project_id']]; ?>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php if(count($projects)) : ?>
                                <li><a href="<?php echo DIR; ?>tasks" title="Ver Todos">Todos</a></li>
                                <?php foreach($projects as $project_id => $project) : ?>
                                    <li<?php if($filtro['project_id'] === $project_id) echo ' class="active"'; ?>><a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project_id; ?>" title="Filtrar por Projeto"><?php echo $project; ?></a></li>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-trash-o"></i> Bug</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" nome="id_produto_competidor" value="<?php if(isset($filtros['id_produto_competidor'])) echo $filtros['id_produto_competidor']; ?>" class="form-control input-xs">
                    </div>
                </td>

                <td class="text-right">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-search"></i> Buscar</button>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php if(count($tasks) > 0) : ?>
                <?php foreach($tasks as $task) : ?>
                    <tr>
                        <td><a href="<?php echo DIR; ?>task/details/<?php echo $task->id; ?>" title="Ver Detalhes da Tarefa">#<?php echo $task->id; ?></a></td>
                        <td><a href="<?php echo DIR; ?>task/details/<?php echo $task->id; ?>" title="Ver Detalhes da Tarefa"><?php echo $task->task; ?></a></td>
                        <td class="text-center"><a href="<?php echo DIR; ?>tasks?kind=<?php echo $task->kind; ?>" title="Filtrar Por Tipo"><i class="<?php echo TaskConfig::getIconKind($task->kind); ?>"></i></a></td>
                        <td class="text-center"><a href="<?php echo DIR; ?>tasks?priority=<?php echo $task->priority; ?>" title="Filtrar Por Prioridade"><i class="<?php echo TaskConfig::getIconPriority($task->priority); ?>"></i></a></td>
                        <td><a href="<?php echo DIR; ?>tasks?project_id=<?php echo $task->project_id; ?>" title="Filtrar Por Projeto"><?php echo $task->project_name; ?></a></td>
                        <td><a href="<?php echo DIR; ?>tasks?status=<?php echo $task->status; ?>" title="Filtrar Por Status"><?php echo $task->status; ?></a></td>
                        <td class="text-right"><?php echo Date::getTempo($task->updated_on); ?></td>

                        <td class="text-right">
                            <div class="btn-group">
                                <a href="<?php echo DIR; ?>task/edit/<?php echo $task->id; ?>" class="btn btn-default btn-xs" title="Editar Detalhes da Tarefa">
                                    <i class="fa fa-pencil-square-o"></i> Editar
                                </a>
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
        <?php echo '<span style="font-size: 10px"><label class="label label-info">'.$quant.'</label> tarefas no total ('.$time. ' Segundos)</span>'; ?>
    </div>
</div>
