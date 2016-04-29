<?php


?>
<div class="modal fade" id="modalAddUserGroup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Usuario no Projeto</h4>
            </div>
                <?php
                    echo Form::open([
                        'action' => DIR . 'group/save?return='.urlencode($return_url),
                        'method' => 'post',
                        'id'     => 'form-add-user-group',
                        'class'  => 'form-horizontal'
                    ]);
                    echo Form::hidden([
                        'id'    => 'ah-project_id',
                        'name'  => 'project_id'
                    ]); 
                ?>
                <input type="hidden" name="project_id" id="ah-project-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Usuarios</label>
                        <div class="col-xs-8 form-group">
                            <?php echo Form::select([
                                'type'  => 'input',
                                'id'    => 'user_id',
                                'name'  => 'user_id',
                                'class' => 'form-control input-block',
                                'data' => $users
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Permissão</label>
                        <div class="col-xs-8 form-group">
                            <?php echo Form::select([
                                'type'  => 'input',
                                'id'    => 'permission',
                                'name'  => 'permission',
                                'class' => 'form-control input-block',
                                'data' => [
                                    'see'   => 'Ver',
                                    'edit'  => 'Editar',
                                    'admin' => 'Administrador'
                                ]
                            ]); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            <?php echo Form::close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function () {
       $('#modalAddUserGroup').on('shown.bs.modal', function (event) {
            var button    = $(event.relatedTarget) // Button that triggered the modal
            var id_musica = button.data('project-id');

            var modal = $(this)
            modal.find('#ah-project-id').val(id_musica);
        })

    });
</script>