<!-- File: /app/View/ProductOrders/edit.ctp -->

<h1>Edit ProductOrder</h1>
<?php
    echo $this->Form->create('ProductOrder');
    echo $this->Form->input('quantity');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');
