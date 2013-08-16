<?php
    class Category extends AppModel {
        var $name = 'Category';
        var $hasMany = array(
            'Device' => array(
                'className' => 'Device',
                'dependent' => true
            )
        );
    }
?>
