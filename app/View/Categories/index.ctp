<!-- File: /app/View/Categories/index.ctp -->

<h1>List Categories</h1>
<p><?php echo $this->Html->link('Add Category', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>
<!-- Here's where we loop through our $posts array, printing out post info -->
    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['name'], array('action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $category['Category']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])); ?>
        </td>
        <td>
            <?php echo $category['Category']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
