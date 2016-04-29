<?php

use App\Models\Task\TaskConfig;
use Helpers\Date;



?>
<div class="row">
    <div class="col-lg-8">
    <?php foreach($projects as $project) : ?>
        <?php
            $tasks = $taskConfig->getTasks(array('project_id' => $project->project_id));

            $count =  TaskConfig::getQuantTasks(array('project_id' => $project->project_id)); 

            if($count == 0) {
                continue;
            }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-area-chart fa-fw"></i> <a href="<?php echo DIR; ?>tasks?client_id=<?php echo $project->own_id; ?>"><?php echo $project->user_name;?></a> / <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id; ?>"><?php echo $project->project; ?></a>
                <div class="pull-right"><button class="btn btn-xs btn-default" id="addTask" data-toggle="modal" data-target="#modalAddTask" data-project-id="<?php echo $project->project_id; ?>"><i class="fa fa-plus"></i> Tarefa</button></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                
                <p><small><a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id)); ?> Tarefas</a>
                (<a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=new'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'new'); ?> Novos</a> -
                <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=resolved'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'resolved'); ?> Resolvidos</a> -
                <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=open'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'open'); ?> Abertas</a> -
                <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=closed'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'closed'); ?> Fechadas</a> -
                <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=onhold'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'onhold'); ?> Em espera</a> -
                <a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id.'&amp;status=wontfix'; ?>"><?php echo TaskConfig::getQuantTasks(array('project_id' => $project->project_id), 'wontfix'); ?> Não resolvidas</a>
                )</small></p>
    
                <?php
                if(count($tasks)) {


                    $total       = TaskConfig::getQuantTasks(array('project_id' => $project->project_id));
                    $completadas = TaskConfig::getQuantTasks(array('project_id' => $project->project_id), array('resolved', 'closed'));

                    //echo '('.$completadas.'  * 100) / '.$total.'<br>';

                    $porcentagem = ($completadas * 100) / $total;
                } else {
                    $porcentagem = 0;
                }

                ?>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" style="width: <?php echo $porcentagem; ?>%">
                         <span><?php echo round($porcentagem, 0); ?>% Completado</span>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th class="text-center" style="width: 45px;"><span title="Tipo">T</span></th>
                                <th class="text-center" style="width: 45px;"><span title="Prioridade">P</span></th>
                                <th>Tarefa</th>
                                <th class="text-center" style="width: 100px;">Status</th>
                                <th class="text-right" style="width: 140px;">Atualizado</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php if(count($tasks)): ?>
                                <?php foreach($tasks as $task): ?>
                                    <tr>
                                        <td><a href="<?php echo DIR; ?>task/details/<?php echo $task->id; ?>" title="Ver Tarefa"><?php echo $task->id; ?></a></td>
                                        <td class="text-center"><i class="<?php echo TaskConfig::getIconKind($task->kind); ?>"></i></td>
                                        <td class="text-center"><i class="<?php echo TaskConfig::getIconPriority($task->priority); ?>"></i></td>
                                        <td><a href="<?php echo DIR; ?>task/details/<?php echo $task->id; ?>" title="Ver Tarefa"><?php echo $task->task; ?></a></td>
                                        <td class="text-center"><?php echo $task->status; ?></td>
                                        <td class="text-right"><?php echo Date::getTempo($task->updated_on); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="6">nenhuma tafera para esse projeto</td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="text-center"><a href="<?php echo DIR; ?>tasks?project_id=<?php echo $project->project_id; ?>" class="btn btn-link btn-block" title="Ver Mais">Ver mais</a></div>
            </div>
            <!-- /.panel-body -->
        </div>
    <?php endforeach; ?>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Atividades das Tarefas
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-check"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge info"><i class="fa fa-save"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                <hr>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
    <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'new'); ?></div>
                        <div>Novas tarefas!</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=new">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-open fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'open'); ?></div>
                        <div>Tarefas em Aberto!</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=open">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pause fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'onhold'); ?></div>
                        <div>Tarefas em Espera!</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=onhold">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-square fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'resolved'); ?></div>
                        <div>Tarefas em Resolvidas!</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=resolved">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-times-circle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'wontfix'); ?></div>
                        <div>Tarefas Não resolvidas</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=wonfix">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-archive fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo TaskConfig::getQuantTasks(array(), 'closed'); ?></div>
                        <div>Tarefas Fechadas</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo DIR; ?>tasks?status=closed">
                <div class="panel-footer">
                    <span class="pull-left">Ver</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Progresso
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"><svg height="342" version="1.1" width="294" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#0b62a4" d="M147,264.8333333333333A91.33333333333333,91.33333333333333,0,0,0,233.35180688739524,203.25135669275903" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#0b62a4" stroke="#ffffff" d="M147,267.8333333333333A94.33333333333333,94.33333333333333,0,0,0,236.1881801063243,204.22859103668176L271.8004216328778,216.49831113260063A132,132,0,0,1,147,305.5Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#3980b5" d="M233.35180688739524,203.25135669275903A91.33333333333333,91.33333333333333,0,0,0,65.0802706076015,133.11515489624878" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#3980b5" stroke="#ffffff" d="M236.1881801063243,204.22859103668176A94.33333333333333,94.33333333333333,0,0,0,62.38947657646432,131.78864538554163L24.120405911402244,112.92273234437317A137,137,0,0,1,276.52771033109286,218.12703503913855Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#679dc6" d="M65.0802706076015,133.11515489624878A91.33333333333333,91.33333333333333,0,0,0,146.97130678756912,264.83332882621403" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#679dc6" stroke="#ffffff" d="M62.38947657646432,131.78864538554163A94.33333333333333,94.33333333333333,0,0,0,146.97036430978855,267.83332867816995L146.95853097765465,305.49999348606116A132,132,0,0,1,28.60506262996421,115.13358152888509Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="147" y="163.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1.4144,0,0,1.4144,-60.9112,-72.3099)" stroke-width="0.7070217457420924"><tspan dy="6" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">In-Store Sales</tspan></text><text x="147" y="183.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1.9028,0,0,1.9028,-132.7083,-158.4375)" stroke-width="0.5255474452554745"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan></text></svg></div>
                <a href="#" class="btn btn-default btn-block">View Details</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

    </div>
    <!-- /.col-lg-4 -->
</div>