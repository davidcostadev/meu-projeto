<?php

use App\Models\Task\TaskConfig;
use Helpers\Date;
use Helpers\Form;

?>

<?php
    
echo Form::open([
    'action' => DIR . 'task/save/?return='.urlencode($return_url),
    'method' => 'post',
    'id' => 'form-edit-task',
    'class' => 'form-horizontal'
]);


echo Form::hidden([
    'id'    => 'task',
    'name'  => 'task_id',
    'value' => $task->task_id,
]);




?>




<div class="form-group">
    <label for="" class="col-sm-3 control-label">Tarefa</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::input([
            'type'  => 'input',
            'id'    => 'task',
            'name'  => 'task',
            'value' => $task->task,
            'class' => 'form-control'
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Descriçao</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::textarea(['
            type'   => 'input',
            'id'    => 'description',
            'name'  => 'description',
            'value' => $task->description,
            'class' => 'form-control',
            'rows'  => 7
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Status</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::select([
            'type'  => 'input',
            'id'    => 'status',
            'name'  => 'status',
            'value' => $task->status,
            'class' => 'form-control',
            'data' => [
                'new'      => 'Novo',
                'open'     => 'Aberto',
                'onhold'   => 'Em Espera',
                'resolved' => 'Resolvido',
                'invalid'  => 'Invalido',
                'wontfix'  => 'Não Resolvido',
                'closed'   => 'Fechado'
            ]
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Priority</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::select([
            'type'  => 'input',
            'id'    => 'priority',
            'name'  => 'priority',
            'value' => $task->priority,
            'class' => 'form-control',
            'data' => [
                'high' => 'Alta',
                'average' => 'Média',
                'low' => 'Baixa'
            ]
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Kind</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::select([
            'type'  => 'input',
            'id'    => 'kind',
            'name'  => 'kind',
            'value' => $task->kind,
            'class' => 'form-control',
            'data' => [
                'bug'             => 'Bug',
                'implementation'  => 'Implementação',
                'change'          => 'Alteração',
                'task'            => 'Tarefa',
                'proposal'        => 'Proposta'
            ]
        ]); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 col-md-5 text-center">
        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o"></i> Atualizar</button>
    </div>
</div>

<?php
echo Form::close();

?>
<label for="task"></label>




<?php /*
<div class="row">
    <div class="col-xs-12 col-md-8">
         <h3><?php echo htmlentities($task->kind); ?>: <?php echo htmlentities($task->task); ?> <small><span class="label label-default"><?php echo htmlentities($task->status); ?></span></small></h3>
         <p><strong><?php echo htmlentities($task->user_name); ?></strong> Criou uma Tarefa <i><?php echo Date::getTempo($task->update_on); ?></i><br>
            <?php echo htmlentities($task->description); ?>
         </p>
         <hr>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="row">
            <div class="col-xs-8">
                <div class="btn-group btn-block" role="group" aria-label="...">
                    <button type="button" class="btn btn-info"><?php echo htmlentities($task->status); ?></button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Status <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=new&amp;return=<?php echo urlencode($return_url); ?>">Novo</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=open&amp;return=<?php echo urlencode($return_url); ?>">Aberto</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=onhold&amp;return=<?php echo urlencode($return_url); ?>">Em Espera</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=resolved&amp;return=<?php echo urlencode($return_url); ?>">Resolvido</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=invalid&amp;return=<?php echo urlencode($return_url); ?>">Inválido</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=wontfix&amp;return=<?php echo urlencode($return_url); ?>">Não Resolvido</a></li>
                            <li><a href="<?php echo DIR; ?>task/save?task_id=<?php echo $task->task_id; ?>&amp;status=closed&amp;return=<?php echo urlencode($return_url); ?>">Fechado</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 text-right">
                <div class="btn-group btn-block">
                    <a href="<?php echo DIR; ?>task/edit/<?php echo $task->task_id; ?>" class="btn btn-default">Editar</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Deletar</a></li>
                        <li><a href="#">Anexar Imagem</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <br>

        <div class="panel panel-default">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Status</td>
                        <td><?php echo htmlentities($task->status); ?></td>
                    </tr>
                    <tr>
                        <td>Prioridade</td>
                        <td><i class="<?php echo TaskConfig::getIconPriority($task->priority); ?>"></i></td>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <td><i class="<?php echo TaskConfig::getIconKind($task->kind); ?>"></i></td>
                    </tr>
                    <tr>
                        <td>Criado Em</td>
                        <td><?php echo Date::getTempo($task->create_on); ?></td>
                    </tr>
                    <tr>
                        <td>Criado Por</td>
                        <td><?php echo htmlentities($task->user_name); ?></td>
                    </tr>
                    <tr>
                        <td>Projeto</td>
                        <td><?php echo htmlentities($task->project); ?></td>
                    </tr>
                    <tr>
                        <td>Cliente</td>
                        <td><?php echo htmlentities($task->client_name); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>   
    </div>
</div>


*/ ?>