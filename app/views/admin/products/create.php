<?php include_once (VIEWS . 'header.php') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script src="<?= ROOT ?>js/adminCreateProduct.js"></script>
<?php if(isset($data['errors']) && count($data['errors']) > 0): ?>
    <div class="alert alert-danger mt-3">
        <?php foreach ($data['errors'] as $value): ?>
            <strong><?= $value ?></strong><br>
        <?php endforeach; ?>
    </div>
<?php endif ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Alta de un producto</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminProduct/create" method="POST" enctype="multipart/form-data">
            <div class="form-control text-left">
                <label for="type">Tipo de producto</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Selecciona el tipo de producto</option>
                    <?php foreach ($data['type'] as $type): ?>
                        <option value="<?= $type->value ?>"
                            <?= isset($data['data']['type']) && $data['data']['type'] == $type->value ? 'selected' : '' ?>>
                            <?= $type->description ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left mt-4">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name"
                       class="form-control" required
                       placeholder="Escribe el nombre del producto"
                       value="<?= $data['data']['name'] ?? '' ?>">
            </div>
            <div class="form-group text-left mt-4">
                <label for="name">Descripción:</label>
                <textarea name="description" id="editor"><?= $data['data']['description'] ?? '' ?></textarea>
            </div>
            <div id="book">
                <div class="form-group text-left">
                    <label for="author">Autor</label>
                    <input type="text" name="author" id="author"
                           class="form-control"
                           placeholder="Escribe el autor del libro"
                           value="<?= $data['data']['author'] ?? '' ?>">
                </div>
                <div class="form-group text-left">
                    <label for="publisher">Editorial</label>
                    <input type="text" name="publisher" id="publisher"
                           class="form-control"
                           placeholder="Escribe la editorial del libro"
                           value="<?= $data['data']['publisher'] ?? '' ?>">
                </div>
                <div class="form-group text-left">
                    <label for="pages">Páginas</label>
                    <input type="text" name="pages" id="pages"
                           class="form-control"
                           placeholder="Escribe el número de páginas del libro"
                           value="<?= $data['data']['pages'] ?? '' ?>">
                </div>
            </div>
            <div id="course">
                <div class="form-group text-left">
                    <label for="people">Público objetivo</label>
                    <input type="text" name="people" id="people"
                           class="form-control"
                           placeholder="Escribe el público objetivo del curso"
                           value="<?= $data['data']['people'] ?? '' ?>">
                </div>
                <div class="form-group text-left">
                    <label for="objetives">Objetivos</label>
                    <input type="text" name="objetives" id="objetives"
                           class="form-control"
                           placeholder="Escribe los objetivos del curso"
                           value="<?= $data['data']['objetives'] ?? '' ?>">
                </div>
                <div class="form-group text-left">
                    <label for="necesites">Conocimientos necesarios previos</label>
                    <input type="text" name="necesites" id="necesites"
                           class="form-control"
                           placeholder="Escribe el número de páginas del libro"
                           value="<?= $data['data']['necesites'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group text-left">
                <label for="price">Precio</label>
                <input type="text" name="price" id="price"
                       pattern="^(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe el precio del producto sin comas ni símbolos"
                       value="<?= $data['data']['price'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <label for="discount">Descuento del producto</label>
                <input type="text" name="discount" id="discount"
                       pattern="^(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe el descuento del producto sin comas ni símbolos"
                       value="<?= $data['data']['discount'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <label for="envio">Coste del envío del producto</label>
                <input type="text" name="envio" id="envio"
                       pattern="^(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe el coste del envío del producto sin comas ni símbolos"
                       value="<?= $data['data']['send'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <label for="image">Imagen del producto</label>
                <input type="file" name="image" id="image"
                       class="form-control"
                       accept="image/jpeg,image/x-png,image/gif">
            </div>
            <div class="form-group text-left">
                <label for="published">Fecha del producto</label>
                <input type="date" name="published" id="published"
                       class="form-control"
                       placeholder="Fecha de creación o publicación del producto (AAAA-MM-DD)"
                       value="<?= $data['data']['published'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <label for="relation1">Producto relacionado</label>
                <select name="relation1" id="relation1" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                    <?php foreach ($data['catalogue'] as $item): ?>
                        <option value="<?= $item->id ?>"
                            <?= isset($data['data']['relation1']) && $data['data']['relation1'] == $item->id ? 'selected' : '' ?>>
                            <?= $item->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left">
                <label for="relation2">Producto relacionado</label>
                <select name="relation2" id="relation2" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                    <?php foreach ($data['catalogue'] as $item): ?>
                        <option value="<?= $item->id ?>"
                            <?= isset($data['data']['relation2']) && $data['data']['relation2'] == $item->id ? 'selected' : '' ?>>
                            <?= $item->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left">
                <label for="relation3">Producto relacionado</label>
                <select name="relation3" id="relation3" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                    <?php foreach ($data['catalogue'] as $item): ?>
                        <option value="<?= $item->id ?>"
                            <?= isset($data['data']['relation3']) && $data['data']['relation3'] == $item->id ? 'selected' : '' ?>>
                            <?= $item->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left">
                <label for="status">Estado del producto</label>
                <select name="status" id="status" class="form-control">
                    <option value="void">Selecciona el estado del producto</option>
                    <?php foreach ($data['status'] as $status): ?>
                        <option value="<?= $status->value ?>"
                            <?= isset($data['data']['status']) && $data['data']['status'] == $status->value ? 'selected' : '' ?>>
                            <?= $status->description ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-check text-left">
                <input type="checkbox" name="mostSold" id="mostSold"
                    <?= isset($data['data']['mostSold']) && $data['data']['mostSold'] == '1' ? 'checked' : '' ?>
                       class="form-check-input">
                <label for="mostSold" class="form-check-label">
                    Producto más vendido
                </label>
            </div>
            <div class="form-check text-left">
                <input type="checkbox" name="new" id="new"
                    <?= isset($data['data']['new']) && $data['data']['new'] == '1' ? 'checked' : '' ?>
                       class="form-check-input">
                <label for="new" class="form-check-label">
                    Producto nuevo
                </label>
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Crear producto" class="btn btn-success">
                <a href="<?= ROOT ?>adminproduct" class="btn btn-info">Regresar</a>
            </div>
        </form>
    </div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
