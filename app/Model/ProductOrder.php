<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    class ProductOrder extends AppModel {
        var $name = 'ProductOrder';
        var $belongsTo = array(
            'Device' => array(
                'className' => 'Device',
                'foreignKey' => 'device_id'
        )); 
    }
?>