<!-- File: /app/View/Devices/view.ctp -->
<meta property="fb:admins" content="{howareyoutoday123}"/>
<div id="fb-root"></div>
<h1><?php echo h($device['Device']['name']); ?></h1>
<div class="img-polaroid span6">
<?php 
    if ($device['Device']['image']) {
        echo "<img src='{$this->webroot}img/uploads/{$device['Device']['image']}'>";
    } else {
        echo "<img src='{$this->webroot}img/uploads/no-image.jpg'>";
    }
?>
</div>
<p><small>Created: <?php echo $device['Device']['created']; ?></small></p>

<p><?php echo h($device['Device']['description']); ?></p>

<p>
    <?php 
        if ($this->App->isAdmin($current_user)) {
            echo $this->Html->link('Edit', array('action' => 'edit', $device['Device']['id']));
            echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $device['Device']['id']),
            array('confirm' => 'Are you sure?'));
        }
    ?>
</p>
<div class="fb-comments" num_posts="4" order_by="reverse_time" 
    data-href="<?php echo "{$this->webroot}devices/view/{$device['Device']['id']}";?>" data-width="470"></div>
