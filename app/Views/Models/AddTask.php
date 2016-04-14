<div class="modal fade" id="modalAddTask">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Tarefa</h4>
            </div>
            <form action="<?php echo DIR; ?>task/add?return=<?php echo urlencode($return_url); ?>" class="form-horizontal" method="post">
                <input type="hidden" name="project_id" id="ah-project-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Tarefa:</label>
                        <div class="col-xs-8 form-group">
                            <input type="text" name="task" id="task" class="form-control input-block" autocomplete="off" placeholder="Digite sua tarefa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label col-xs-4">Descrição:</label>
                        <div class="col-xs-8 form-group">
                            <textarea type="text" name="description" id="description" class="form-control input-block" autocomplete="off" placeholder="Descreva a tarefa"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Status:</label>
                        <div class="col-xs-8 form-group">
                            <select name="status" id="status" class="form-control input-block">
                                <option value="new">Novo</option>
                                <option value="open">Aberto</option>
                                <option value="onhold">Em Espera</option>
                                <option value="resolved">Resolvido</option>
                                <option value="invalid">Invalido</option>
                                <option value="wontfix">Não Resolvido</option>
                                <option value="closed">Fechado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Prioridade:</label>
                        <div class="col-xs-8 form-group">
                            <select name="priority" id="priority" class="form-control input-block">
                                <option value="high">Alta</option>
                                <option value="average" selected="selected">Média</option>
                                <option value="low">Baixa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="control-label col-xs-4">Tipo:</label>
                        <div class="col-xs-8 form-group">
                            <select name="kind" id="kind" class="form-control input-block">
                                <option value="bug">Bug</option>
                                <option value="implementation" selected="selected">Implementação</option>
                                <option value="change">Alteração</option>
                                <option value="task">Tarefa</option>
                                <option value="proposal">Proposta</option>
                            </select>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



        
        

<script>
    $(function () {
       $('#modalAddTask').on('shown.bs.modal', function (event) {
            var button    = $(event.relatedTarget) // Button that triggered the modal
            var id_musica = button.data('project-id');

            var modal = $(this)
            modal.find('#ah-project-id').val(id_musica);
        })

    });
</script>