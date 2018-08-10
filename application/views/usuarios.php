<?php $this->load->view('topo'); ?>
    <?php if(isset($mensagem)){ ?>
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">
                <?= $mensagem; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    <?php } ?>

            <?php if(isset($alert)){ ?>
            <div class="col-lg-12">
                <div class="alert alert-info" role="alert">
                    <?= $alert; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        <?php } ?>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Listagem de Usuários</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result->result() as $dados)
					    { ?>
                            <tr>
                                <th scope="row"><?= $dados->id ?></th>
                                <td><?= $dados->nome ?></td>
                                <td><?= $dados->email ?></td>
                                <td><?= anchor("usuarios/edit/$dados->id", "Editar") ?>
                                    | <a href="#"  data-toggle="modal" data-target="#largeModal<?= $dados->id ?>"  />Excluir</a></td>
                            </tr>

                            <div class="modal fade" id="largeModal<?= $dados->id ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="largeModalLabel">Large Modal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <?= anchor("usuarios/delete/$dados->id", "Deletar") ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

				    <?php } ?>
                </table>
            </div>
        </div>
    </div>

<?php $this->load->view('rodape'); ?>