<?php

use App\Models\Task\TaskConfig;
use Helpers\Date;
use Helpers\Form;

 
echo Form::open([
    'action' => DIR . 'task/save/?return='.urlencode($return_url),
    'method' => 'post',
    'id'     => 'form-edit-task',
    'class'  => 'form-horizontal'
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

<?php echo Form::close(); ?>