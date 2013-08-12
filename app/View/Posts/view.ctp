<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<p>
    <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
    <?php echo $this->Form->postLink(
        'Delete',
        array('action' => 'delete', $post['Post']['id']),
        array('confirm' => 'Are you sure?'));
    ?>
</p>
            