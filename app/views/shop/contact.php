<?php include_once (VIEWS . 'header.php') ?>
<h2 class="text-center"><?= $data['title'] ?></h2>
<div class="alert mt-3">
    <form action="<?= ROOT ?>shop/contact" method="POST">
        <div class="form-group text-left">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control"
                   required placeholder="Escriba su nombre">
        </div>
        <div class="form-group text-left">
            <label for="email">Correo electronico</label>
            <input type="email" name="email" id="email" class="form-control"
                   required placeholder="Escriba su correo electrónico">
        </div>
        <div class="form-group text-left">
            <label for="message">Mensaje</label>
            <textarea name="message" id="message" cols="30" rows="10"
                      class="form-control"></textarea>
        </div>
        <div class="mt-4 text-left">
            <input type="submit" value="Enviar" class="btn btn-info">
            <a href="<?= ROOT ?>shop" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>
<?php include_once (VIEWS . 'footer.php') ?>
