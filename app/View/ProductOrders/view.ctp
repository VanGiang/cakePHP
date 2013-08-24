<!-- File: /app/View/ProductOrders/view.ctp -->
<?php echo $this->Html->script('cart'); ?>
<h1>List product orders</h1>
<table class="table table-striped">
    <tr>
        <th>Index</th>
        <th>Product name</th>
        <th>Description</th>
        <th>Price a product</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php $index = 1; $total = 0;?>
    <?php foreach ($productorders as $productorder): ?>
        <?php $total += $productorder['Device']['price'] * $this->Session->read("Product.{$productorder['Device']['id']}.quantity"); ?>
    <tr>
        <td><?php echo $index; $index++; ?></td>
        <td>
            <?php 
                echo $this->Html->link($productorder['Device']['name'], 
                array('action' => '../devices/view', $productorder['Device']['id'])); 
            ?>
        </td>
        <td>
            <?php echo $productorder['Device']['description']; ?>
        </td>
        <td>
            <?php echo $productorder['Device']['price']; ?>$
        </td>
        <td>
            <input type="text" 
                value="<?php echo $this->Session->read("Product.{$productorder['Device']['id']}.quantity"); ?>"
                class="cart_quantities" 
                data-product_id="<?php echo ($this->Session->read("Product.{$productorder['Device']['id']}.id")); ?>"
                style="width:50px;"/>
        </td>
        <td>
            <?php 
                echo $this->Html->link(
                    'Delete', 
                    '../productorders/delete/'.$productorder['Device']['id'], 
                    array('confirm' => 'Are you sure?', 'class' => 'btn btn-danger')
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr><h3><?php echo "Total: <span class='price'><span class='total_price'>{$total}</span></span>"; ?>$</h3></tr>
</table>
<?php 
    echo $this->Html->link('Buy now', array('action' => 'add'), array('class' => 'btn btn-success btn-large'));
?>
