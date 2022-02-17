<?php

$this->load->view('template/header');
?>

<div class="container">
    <div class="d-flex bd-highlight mt-3">
        <div class="p-2 w-100 bd-highlight">
            <?= formTitle('Tag', $action, 'Tag') ?>
        </div>
        <div class="p-2 flex-shrink-1 bd-highlight">
            <a class='btn btn-icon btn-primary btn-sm' href="<?= base_url('Tag/create') ?>" title='Incluir'>
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <?php
    if ($this->session->flashdata("success")) {
        ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
            <strong>Sucesso!</strong> <?= $this->session->flashdata("success") ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    } else if ($this->session->flashdata("error")) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
            <strong>Erro!</strong> <?= $this->session->flashdata("error") ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>
    <div class="table-responsive">
        <table class="table table hover tblLista">
            <thead class='table-light'>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tags as $p) : ?>
                    <tr>
                        <td><?= $p->id ?></td>
                        <td><?= $p->name ?></td>
                        <td>
                            <a class='btn btn-icon btn-secondary btn-sm' href="<?= base_url('Tag/view/' . $p->id) ?>" title='Visualizar'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a class='btn btn-icon btn-warning btn-sm' href="<?= base_url('Tag/update/' . $p->id) ?>" title='Editar'>
                                <i class="far fa-edit" style="color:white;"></i>
                            </a>
                            <a class='btn btn-icon btn-danger btn-sm' href="<?= base_url('Tag/delete/' . $p->id) ?>" title='Excluír'>
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= datatables() ?>

<?php
$this->load->view('template/footer');
