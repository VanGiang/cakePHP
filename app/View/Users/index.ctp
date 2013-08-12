<!-- File: /app/View/Users/index.ctp -->

<h1>List users</h1>
<p><?php echo $this->Html->link('Add User', array('action' => 'add'), array('class' => 'btn btn-large')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>User name</th>
        <th>Role</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['username'], array('action' => '../profiles/view', $user['Profile']['id'])); ?>
        </td>
        <td>
            <?php echo $user['User']['role']; ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
        </td>
        
        <td>
            <?php echo $user['User']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
