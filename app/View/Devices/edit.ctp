<!-- File: /app/View/Devices/edit.ctp -->

<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Device');
    echo $this->Form->input('name');
    echo $this->Form->input('price');
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');