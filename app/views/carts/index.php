<?php include_once (VIEWS . 'header.php') ?>
<?php $verify = false; $subtotal = 0; $send = 0; $discount = 0; $user_id = $data['user_id'] ?>
<h2 class="text-center">
    Carrito de Compra
</h2>
    <form action="<?= ROOT ?>cart/update" method="POST">
        <table class="table table-stripped" style="width: 100%">
            <tr>
                <th style="width: 12%">Producto</th>
                <th style="width: 58%">Descripción</th>
                <th style="width: 1.8%">Cant.</th>
                <th style="width: 10.12%">Precio</th>
                <th style="width: 10.12%">Subtotal</th>
                <th style="width: 1%">&nbsp;</th>
                <th style="width: 6.5%">Borrar</th>
            </tr>
            <?php foreach($data['data'] as $key => $value): ?>
                <tr>
                    <td><img src="<?= ROOT ?>img/<?= $value->image ?>" style="width: 105px" alt="<?= $value->name ?>"></td>
                    <td><b><?= $value->name ?></b> <?= substr(html_entity_decode($value->description), 0, 200) ?>...</td>
                    <td class="text-right">
                        <input type="number" name="c<?= $key ?>" class="text-right" value="<?= number_format($value->quantity, 0) ?>" min="1" max="99">
                        <input type="hidden" name="i<?= $key ?>" value="<?= $value->product ?>">
                    </td>
                    <td class="text-right"><?= number_format($value->price, 2) ?> &euro;</td>
                    <td class="text-right"><?= number_format($value->price * $value->quantity, 2) ?> &euro;</td>
                    <td>&nbsp;</td>
                    <td class="text-right"><a href="<?= ROOT ?>cart/delete/<?= $value->product ?>/<?= $data['user_id'] ?>" class="btn btn-danger">Borrar</a></td>
                </tr>
                <?php $subtotal += $value->price * $value->quantity; $discount += $value->discount; $send += $value->send ?>
            <?php endforeach; ?>
            <?php $total = $subtotal - $discount + $send ?>
            <input type="hidden" name="rows" value="<?= count($data['data']) ?>">
            <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
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
                <td>
                    <a href="<?= ROOT ?>shop" class="btn btn-info" role="button">Seguir Comprando</a>
                </td>
                <td>
                    <input type="submit" class="btn btn-primary" role="button" value="Recalcular">
                </td>
                <?php if ($verify): ?>
                    <td>
                        <a href="<?= ROOT ?>cart/thanks" class="btn btn-success" role="button">Pagar</a>
                    </td>
                <?php else: ?>
                    <td>
                        <a href="<?= ROOT ?>cart/checkout" class="btn btn-success" role="button">Pagar</a>
                    </td>
                <?php endif; ?>
            </tr>
        </table>
    </form>

<?php include_once (VIEWS . 'footer.php') ?>