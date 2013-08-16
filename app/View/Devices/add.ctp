<!-- File: /app/View/Devices/add.ctp -->

<h1>Add Post</h1>
<?php
echo $this->Form->create('Device', array('enctype'=>'multipart/form-data'));
echo $this->Form->input('name');
echo $this->Form->input('price');
echo $this->Form->input('category_id');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->file('image');
echo $this->Form->end('Save Post');
?>