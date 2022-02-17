<?php

$this->load->view('template/header');

?>

<div class="container mt-3">
    <?= formTitle('Tag', $action, 'Tag'); ?>
    <form action="<?= base_url('Tag/' . formAction($action)) ?>" method="post">
        <input type="hidden" name="id" value="<?= $tag->id ?? '' ?>">
        <?= textCustom("error") ?>
        <div class="form-group col-md-4">
            <label class='form-label' for="name">Nome <span class='text-danger fw-bold'>*</span></label>
            <input class='form-control' type="text" name="name" <?= disabled($action, 'R') ?> value="<?= set_value('name', $tag->name ?? '') ?>" required>
            <?= textCustom("name") ?>
        </div>
        <?= formSubmit($action, 'Tag') ?>
    </form>
</div>