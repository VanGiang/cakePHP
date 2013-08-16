<!-- File: /app/View/ProductOrders/index.ctp -->

<h1>List product orders</h1>
<table class="table table-striped">
    <tr>
        <th>Index</th>
        <th>Product name</th>
        <th>Description</th>
        <th>Price a product</th>
        <th>Quantity</th>
        <th>Action</th>
        <th>Created</th>
    </tr>
    <?php $index = 1; $total = 0;?>
    <?php foreach ($productorders as $productorder): ?>
    <tr>
        <td><?php echo $index; $index++; $total += $productorder['ProductOrder']['price'] * $productorder['ProductOrder']['quantity']; ?></td>
        <td>
            <?php 
                echo $this->Html->link($productorder['ProductOrder']['name'], 
                array('action' => '../devices/view', $productorder['ProductOrder']['device_id'])); 
            ?>
        </td>
        <td>
            <?php echo $productorder['ProductOrder']['description']; ?>
        </td>
        <td>
            <?php echo $productorder['ProductOrder']['price']; ?>$
        </td>
        <td>
            <?php echo $productorder['ProductOrder']['quantity']; ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $productorder['ProductOrder']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $productorder['ProductOrder']['id'])); ?>
        </td>
        
        <td>
            <?php echo $productorder['ProductOrder']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr><h3>Total: <?php echo $total; ?>$</h3></tr>
</table>
<?php 
    echo $this->Html->link('Buy now', '#', array('class' => 'btn btn-success btn-large'));
?>
