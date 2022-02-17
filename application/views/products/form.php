<?php

$this->load->view('template/header');

?>

<div class="container mt-3">
    <?= formTitle('Produto', $action, 'Product'); ?>
    <form action="<?= base_url('Product/' . formAction($action)) ?>" method="post">
        <input type="hidden" name="id" value="<?= $product->id ?? '' ?>">
        <?= textCustom("error") ?>
        <div class="row">
            <div class="form-group col-md-4">
                <label class='form-label' for="name">Nome <span class='text-danger fw-bold'>*</span></label>
                <input class='form-control' type="text" name="name" <?= disabled($action, 'R') ?> value="<?= set_value('name', $product->name ?? '') ?>" required>
                <?= textCustom("name") ?>
            </div>
            <div class="form-group col-md-6">
                <label class='form-label' for="tag">Tag's <span class='text-danger fw-bold'>*</span></label>
                <ul class="list-group">
                    <?php foreach ($tags as $t) : ?>
                        <?php
                        $checked = '';
                        foreach ($this->model->getTagsByProduct($product->id) as $tag_product) {
                            if ($tag_product['tag_id'] == $t->id) {
                                $checked = 'checked';
                                break;
                            } else {
                                $checked = '';
                            }
                        }
                        ?>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="tag[]" value="<?= $t->id ?>" <?= $checked . ' ' . disabled($action, 'D')?>>
                            <?= $t->name ?>
                        </li>
                    <?php endforeach; ?>
                    <?= textCustom("tag") ?>
                </ul>
            </div>
        </div>
        <?= formSubmit($action, 'Product') ?>
    </form>
</div>