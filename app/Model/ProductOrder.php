<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    class ProductOrder extends AppModel {
        var $name = 'ProductOrder';
        public $belongsTo = array(
            'Device' => array(
                'className' => 'Device',
                'foreignKey' => 'device_id'
            ),
            'User' => array(
                'className' => 'User'
            ),
            'Order' => array(
                'className' => 'Order'
            )
        ); 

        public function afterSave() {

        }
    }
?>
