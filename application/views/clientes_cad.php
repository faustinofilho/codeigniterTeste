<?php 


$this->load->view('topo'); ?>

           <div class="animated fadeIn">

                <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header">
                        <strong>Cliente</strong> 
                    </div>
                    <div class="card-body card-block">
                        <?= form_open_multipart('clientes/store')  ?>
                       
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nome</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" value="<?= set_value('nome') ? : (isset($nome) ? $nome : '') ?>" name="nome" placeholder="" class="form-control">
                            <small class="form-text text-muted">Campo obrigatório</small></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">CNPJ</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="cnpj" name="cnpj" value="<?= set_value('cnpj') ? : (isset($cnpj) ? $cnpj : '') ?>" placeholder="00.00.000/0000-00" class="form-control">
                            <small class="form-text text-muted">Campo obrigatório</small></div>
                        </div>                        
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="logo" class=" form-control-label">Logo</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="logo" name="logo" class="form-control-file"></div>
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
    