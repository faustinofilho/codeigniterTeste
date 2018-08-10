<?php 

$this->load->view('topo'); ?>

           <div class="animated fadeIn">

                <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header">
                        <strong>Usuários</strong> 
                    </div>
                    <div class="card-body card-block">
                        <?= form_open('usuarios/store')  ?>
                       
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nome</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" value="<?= set_value('nome') ? : (isset($nome) ? $nome : '') ?>" name="nome" placeholder="" class="form-control">
                            <small class="form-text text-muted">Campo obrigatório</small></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="email" name="email" value="<?= set_value('email') ? : (isset($email) ? $email : '') ?>"  class="form-control">
                            <small class="form-text text-muted">Campo obrigatório</small></div>
                        </div>  
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="senha" class=" form-control-label">Senha</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="senha" name="senha" class="form-control">
                            <small class="form-text text-muted">Campo obrigatório</small></div>
                        </div>   
                    </div>
                    <input type='hidden' name="id" value="<?= set_value('id') ? : (isset($id) ? $id : ''); ?>">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Enviar
                        </button>
                    </div>
                    </div>
                    <?= form_close(); ?>
 
                </div>     

<?php $this->load->view('rodape'); ?>
    