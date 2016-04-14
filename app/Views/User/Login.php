<div id="login-page" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
            <form action="<?php echo DIR; ?>user/logar" method="post">
                <h1 class="text-center">Meu Projeto</h1>
                <p class="text-center">Coloque seus dados para acessar o panel do meu projeto.</p>
                <br>
                            
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" name="email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Senha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control input-lg" placeholder="Senha">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-sign-in"></i> Entrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>