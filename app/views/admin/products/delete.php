<?php include_once (VIEWS . 'header.php') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script src="<?= ROOT ?>js/adminCreateProduct.js"></script>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Baja de un producto</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminProduct/delete/<?= $data['product']->id ?>" method="POST" enctype="multipart/form-data">
            <div class="form-control text-left">
                <label for="type">Tipo de producto</label>
                <select name="type" id="type" class="form-control" disabled>
                    <option value="">Selecciona el tipo de producto</option>
                    <?php foreach ($data['type'] as $type): ?>
                        <option value="<?= $type->value ?>"
                            <?= isset($data['product']->type) && $data['product']->type == $type->value ? 'selected' : '' ?>>
                            <?= $type->description ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left mt-4">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name"
                       class="form-control" disabled
                       placeholder="Escribe el nombre del producto"
                       value="<?= $data['product']->name ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Eliminar producto" class="btn btn-success">
                <a href="<?= ROOT ?>adminproduct" class="btn btn-info">Regresar</a>
            </div>
        </form>
    </div>
</div>
