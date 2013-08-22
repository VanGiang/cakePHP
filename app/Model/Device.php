<?php
    class Device extends AppModel {
        var $name = 'Device';
        var $belongsTo = array(
            'Category' => array(
                'className' => 'Category'
            )
        );
        var $hasMany = array(
            'ProductOrder' => array(
                'class' => 'ProductOrder',
                'dependent' => true
            )
        );
    }
?>
