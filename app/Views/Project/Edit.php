<?php

use Helpers\Date;
use Helpers\Form;

echo Form::open([
    'action' => DIR . 'project/save?return='.urlencode($return_url),
    'method' => 'post',
    'id'     => 'form-edit-project',
    'class'  => 'form-horizontal'
]);


echo Form::hidden([
    'id'    => 'project_id',
    'name'  => 'project_id',
    'value' => $project->project_id,
]);


?>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Nome do Projeto</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::input([
            'type'  => 'input',
            'id'    => 'project',
            'name'  => 'project',
            'value' => $project->project,
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
            'value' => $project->description,
            'class' => 'form-control',
            'rows'  => 7
        ]); ?>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">Cliente</label>
    <div class="col-sm-9 col-md-5">
        <?php echo Form::select([
            'type'  => 'input',
            'id'    => 'own_id',
            'name'  => 'own_id',
            'value' => $project->own_id,
            'class' => 'form-control',
            'data' => $users
        ]); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 col-md-5 text-center">
        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o"></i> Atualizar</button>
    </div>
</div>

<?php echo Form::close(); ?>