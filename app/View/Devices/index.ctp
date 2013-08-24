<!-- File: /app/View/Devices/index.ctp -->
<?php
    if (!empty($category)) {
        echo "<h1>List Devices {$category['Category']['name']}</h1>";
        echo $this->Html->link('All Device', array('action' => 'index'), array('class' => 'btn btn-large'));
    } else {
        echo '<h1>All Devices</h1>';
    }
?>
    <?php if ($this->App->isAdmin($current_user)) { ?>
<p>
    <?php  echo $this->Html->link('Add Device', array('action' => 'add'), array('class' => 'btn btn-large')); ?>
</p>
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Desciption</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->
    <?php foreach ($devices as $device): ?>
    <tr>
        <td><?php echo $device['Device']['id']; ?></td>
        <td><div class="img-rounded"><?php 
                 if ($device['Device']['image']) {
                     $image = "/app/webroot/img/uploads/{$device['Device']['image']}";
                 } else {
                     $image = '/app/webroot/img/uploads/no-image.jpg';
                 }
                 echo $this->Html->image(
                    $image, array(
                        'width' => '100px',
                        'height' => '100px',
                        'url' => array('controller' => 'Devices', 'action' => 'view', $device['Device']['id'])
                    ));
            ?></div>
        </td>
        <td>
            <?php echo $this->Html->link($device['Device']['name'], array('action' => 'view', $device['Device']['id'])); ?>
        </td>
        <td><?php echo $device['Device']['price']; ?></td>
        <td><?php echo $device['Device']['description']; ?></td>
        <td>
            <?php echo $this->Html->link('Buy', array('action' => '../productorders/add/'.$device['Device']['id'])); ?>
            <?php 
                if ($this->App->isAdmin($current_user)) {
                    echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $device['Device']['id']),
                    array('confirm' => 'Are you sure?'));
                    echo $this->Html->link('Edit', array('action' => 'edit', $device['Device']['id']));
                }
            ?>
        </td>
        <td>
            <?php echo $device['Device']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<?php } else { ?>
<div class="row-fluid">
    <ul class="thumbnails">
        <?php $index = 0; ?>
        <?php foreach ($devices as $device): ?>
            <?php 
                $index += 1;
                if (($index % 3) == 1 ) {
                    echo "<li class='span4' style='margin-left: 0;'>";
                } else {
                    echo '<li class="span4">';
                }
            ?>
            
              <div class="thumbnail">
              <?php 
                 if ($device['Device']['image']) {
                     $image = "/app/webroot/img/uploads/{$device['Device']['image']}";
                 } else {
                     $image = '/app/webroot/img/uploads/no-image.jpg';
                 }
                 echo $this->Html->image(
                    $image, array(
                        'class' => 'image-product',
                        'url' => array('controller' => 'Devices', 'action' => 'view', $device['Device']['id'])
                    ));
                ?>
                <h3><?php echo $this->Html->link($device['Device']['name'], 
                    array('action' => 'view', $device['Device']['id'])); ?>
                </h3>
                <p><?php echo $device['Device']['description']; ?>...</p>
                <p><?php echo $this->Html->link('View details', 'view/'.$device['Device']['id'], array('class' => 'btn')); ?></p>
                <p><?php echo $this->Html->link(
                    'Buy',
                    array('action' => '../productorders/add_to_cart/'.$device['Device']['id']),
                    array('class' => 'btn')); ?>
                </p>
              </div>
            </li>
          <?php endforeach; ?>
  </ul>
</div>
<?php } ?>
