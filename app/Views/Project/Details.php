<?php

//use App\Models\Task\TaskConfig;
use Helpers\Date;


?><div class="row">
    <div class="col-xs-12 col-md-8">
         <h3><?php echo htmlentities($project->project); ?> <small><span class="label label-default"></span></small></h3>
         <p><strong><?php echo htmlentities($project->user_name); ?></strong> Criou o Projeto a <i><?php echo Date::getTempo($project->updated_on); ?></i><br>
            <?php echo htmlentities($project->description); ?>
         </p>
         <hr>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="row">
            <div class="col-xs-8">
                <div class="btn-group btn-block" role="group" aria-label="...">
                    
                </div>
            </div>
            <div class="col-xs-4 text-right">
                <div class="btn-group btn-block">
                    <a href="<?php echo DIR; ?>task/edit/<?php echo $project->task_id; ?>" class="btn btn-default">Editar</a>
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
                        <td>Criado Em</td>
                        <td><?php echo Date::getTempo($project->created_on); ?></td>
                    </tr>
                    <tr>
                        <td>Proprietário</td>
                        <td><?php echo htmlentities($project->user_name); ?></td>
                    </tr>
                    <tr>
                        <td>Atualizado</td>
                        <td><?php echo Date::getTempo($project->updated_on); ?></td>
                    </tr>
                    <tr>
                        <td>Projeto</td>
                        <td><?php echo htmlentities($project->project); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users"></i> Equipe
                <div class="pull-right"><button class="btn btn-xs btn-default" id="addUserGroup" data-toggle="modal" data-target="#modalAddUserGroup" data-project-id="<?php echo $project->project_id; ?>"><i class="fa fa-plus"></i> Usuário</button></div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><?php echo $project->user_name; ?></td>
                        <td class="text-right"><span class="label label-info">Propriétário</span></td>
                    </tr>
                    <?php if(count($group) > 0) : ?>
                        <?php foreach ($group as $user) :  ?>
                            <tr>
                                <td><?php echo $user->name; ?></td>
                                <td class="text-right"><span class="label label-default"><?php echo $user->permission; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>  
    </div>
</div>


