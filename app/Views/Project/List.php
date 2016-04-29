<?php 

use Helpers\Date;
//print_r($projects); die();

?>
<div class="panel panel-default">

    <div class="panel-body">
        <a href="<?php echo DIR; ?>projects" class="btn btn-default"><i class="fa fa-eye"></i> Tudo</a>
    </div>

    <table class="table table-hover table-striped table-list">
        <thead>
            <tr>
                <th style="width: 100px;">#ID <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th>Projeto <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th style="width: 300px;">Proprietário <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
                <th style="width: 200px;">Atualizado <a href="#"><i class="fa fa-caret-down"></i></a> <a href="#"><i class="fa fa-caret-up"></i></a></th>
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
                            <?php if(isset($users[$filtro['user_id']])) echo $users[$filtro['user_id']]; ?>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php if(count($users)) : ?>
                                <li><a href="<?php echo DIR; ?>projects" title="Ver Todos">Todos</a></li>
                                <?php foreach($users as $user_id => $user) : ?>
                                    <li<?php if($filtro['user_id'] === $user_id) echo ' class="active"'; ?>><a href="<?php echo DIR; ?>projects?user_id=<?php echo $user_id; ?>" title="Filtrar por Proprietário"><?php echo $user; ?></a></li>
                                <?php endforeach;?>
                            <?php endif; ?>
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
            <?php if(count($projects) > 0) : ?>
                <?php foreach($projects as $project) : ?>
                    <tr>
                        <td><a href="<?php echo DIR; ?>project/details/<?php echo $project->id; ?>" title="Ver Detalhes da Projeto">#<?php echo $project->id; ?></a></td>
                        <td><a href="<?php echo DIR; ?>project/details/<?php echo $project->id; ?>" title="Ver Detalhes da Projeto"><?php echo $project->project; ?></a></td>
                        <td><a href="<?php echo DIR; ?>projects?user_id=<?php echo $project->user_id; ?>" title="Filtrar Por Proprietário"><?php echo $project->user_name; ?></a></td>
                        <td class="text-right"><?php echo Date::getTempo($project->updated_on); ?></td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="<?php echo DIR; ?>project/edit/<?php echo $project->id; ?>" class="btn btn-default btn-xs" title="Editar Detalhes da Projeto">
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
            <?php else : ?>
                <tr>
                    <td colspan="4">Nenhum projeto encontrado</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="panel-footer text-center">
        <?php echo $paginacao; ?>
        <hr>
        <?php echo '<span style="font-size: 10px"><label class="label label-info">'.$quant.'</label> projetos no total ('.$time. ' Segundos)</span>'; ?>
    </div>
</div>
