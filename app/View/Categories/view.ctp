<!-- File: /app/View/Categories/view.ctp -->
<h1><?php echo h($category['Category']['name']); ?></h1>

<p><small>Created: <?php echo $category['Category']['created']; ?></small></p>

<p>
    <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])); ?>
    <?php echo $this->Form->postLink(
        'Delete',
        array('action' => 'delete', $category['Category']['id']),
        array('confirm' => 'Are you sure?'));
    ?>
</p>
            