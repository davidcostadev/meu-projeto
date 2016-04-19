<?php

use App\Models\Task\TaskConfig;
use Helpers\Date;
use Helpers\Form;


echo Form::open([
    'action' => DIR . 'task/save?return='.urlencode($return_url),
    'method' => 'post',
    'id'     => 'form-edit-task',
    'class'  => 'form-horizontal'
]);


?>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Tarefa</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::input([
            'type'  => 'input',
            'id'    => 'task',
            'name'  => 'task',
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
            'class' => 'form-control',
            'rows'  => 7
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Projeto</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::select([
            'type'  => 'input',
            'id'    => 'project_id',
            'name'  => 'project_id',
            'class' => 'form-control',
            'data' => $projects
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
            'class' => 'form-control',
            'value' => 'new',
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
            'class' => 'form-control',
            'value' => 'average',
            'data' => [
                'high'    => 'Alta',
                'average' => 'Média',
                'low'     => 'Baixa'
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
            'class' => 'form-control',
            'value' => 'implementation',
            'data' => [
                'bug'            => 'Bug',
                'implementation' => 'Implementação',
                'change'         => 'Alteração',
                'task'           => 'Tarefa',
                'proposal'       => 'Proposta'
            ]
        ]); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 col-md-5 text-center">
        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Adicionar</button>
    </div>
</div>

<?php echo Form::close(); ?>