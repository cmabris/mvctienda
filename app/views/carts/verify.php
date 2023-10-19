<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Iniciar Sesión</a></li>
            <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
            <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
            <li class="breadcrumb-item">Verificar los datos</li>
        </ol>
    </nav>
    <div class="card-header">
        <h1><?= $data['title'] ?></h1>
        <p>Por favor, verifique los datos antes de continuar</p>
    </div>
    <div class="card-body">
        <?php $verify=false; $subtotal=0; $send=0; $discount=0 ?>

        Método de pago: <?= $data['payment'] ?><br>
        Nombre: <?= $data['user']->first_name ?> <?= $data['user']->last_name_1 ?> <?= $data['user']->last_name_2 ?><br>
        Dirección: <?= $data['user']->address ?><br>
        Ciudad: <?= $data['user']->city ?><br>
        Estado: <?= $data['user']->state ?><br>
        Código Postal: <?= $data['user']->postcode ?><br>
        País: <?= $data['user']->country ?><br>

        <table class="table table-stripped" style="width: 100%">
            <tr>
                <th style="width: 12%">Producto</th>
                <th style="width: 58%">Descripción</th>
                <th style="width: 1.8%">Cant.</th>
                <th style="width: 10.12%">Precio</th>
                <th style="width: 10.12%">Subtotal</th>
            </tr>
            <?php foreach($data['data'] as $key => $value): ?>
                <tr>
                    <td><img src="<?= ROOT ?>img/<?= $value->image ?>" style="width: 105px" alt="<?= $value->name ?>"></td>
                    <td><b><?= $value->name ?></b> <?= substr(html_entity_decode($value->description), 0, 200) ?>...</td>
                    <td class="text-right"><?= number_format($value->quantity, 2) ?> &euro;</td>
                    <td class="text-right"><?= number_format($value->price, 2) ?> &euro;</td>
                    <td class="text-right"><?= number_format($value->price * $value->quantity, 2) ?> &euro;</td>
                </tr>
                <?php $subtotal += $value->price * $value->quantity; $discount += $value->discount; $send += $value->send ?>
            <?php endforeach; ?>
            <?php $total = $subtotal - $discount + $send ?>
        </table>
        <hr>
        <table class="text-right" style="width: 100%">
            <tr>
                <td style="width: 79.85%"></td>
                <td style="width: 11.95%">Subtotal:</td>
                <td style="width: 9.20%"><?= number_format($subtotal,2) ?> &euro;</td>
            </tr>
            <tr>
                <td style="width: 79.85%"></td>
                <td style="width: 10.95%">Descuento:</td>
                <td style="width: 9.20%"><?= number_format($discount,2) ?> &euro;</td>
            </tr>
            <tr>
                <td style="width: 79.85%"></td>
                <td style="width: 11.95%">Envío:</td>
                <td style="width: 9.20%"><?= number_format($send, 2) ?> &euro;</td>
            </tr>
            <tr>
                <td style="width: 79.85%"></td>
                <td style="width: 11.95%">Total:</td>
                <td style="width: 9.20%"><?= number_format($total,2) ?> &euro;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="<?= ROOT ?>cart/thanks" class="btn btn-success" role="button">Pagar</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>

