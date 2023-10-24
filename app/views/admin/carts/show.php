<?php include_once (VIEWS . 'header.php') ?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Detalle de Ventas</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center" style="width: 100%">
                <thead>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Envío</th>
                <th>Total</th>
                </thead>
                <?php $quantity=0; $discount=0; $send=0; $total=0 ?>
                <?php foreach($data['data'] as $sale): ?>
                    <tr>
                        <td class="text-center"><?= $sale->name ?></td>
                        <td class="text-center"><?= substr($data['date'], 0, 10) ?></td>
                        <td class="text-right"><?= number_format($sale->price, 2) ?></td>
                        <td class="text-right"><?= number_format($sale->quantity, 2) ?></td>
                        <td class="text-right"><?= number_format($sale->discount, 2) ?></td>
                        <td class="text-right"><?= number_format($sale->send, 2) ?></td>
                        <td class="text-right"><?= number_format($sale->price * $sale->quantity - $sale->discount + $sale->send, 2) ?></td>
                    </tr>
                    <?php $quantity+=$sale->quantity; $discount+=$sale->discount; $send+=$sale->send; $total+=$sale->price * $sale->quantity - $sale->discount + $sale->send ?>
                <?php endforeach ?>
                <tr>
                    <td></td>
                    <td>Totales:</td>
                    <td><?= number_format($quantity, 2) ?></td>
                    <td><?= number_format($discount, 2) ?></td>
                    <td><?= number_format($send, 2) ?></td>
                    <td><?= number_format($total, 2) ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="<?= ROOT ?>admincarts/sales" class="btn btn-success">Regresar</a>
        </div>
    </div>
<?php include_once (VIEWS . 'footer.php') ?>