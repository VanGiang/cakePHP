<h1>List Orders</h1>
<table class='table table-striped'>
    <tr>
        <th>STT</th>
        <th>Khách hàng</th>
        <th>Đặt hàng lần cuối</th>
        <th>Tổng giá</th>
    </tr>
    <?php $i = 0; ?>
    <?php foreach ($orders as $order):?>
        <?php $i++; ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $order['User']['username']; ?></td>
        <td><?php echo $order['Order']['modified']; ?></td>
        <td><?php echo $order['Order']['total_price']; ?></td>
    </tr>
    <?php endforeach ?>

</table>
