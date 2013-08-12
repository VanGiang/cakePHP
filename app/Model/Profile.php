<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php 
    class Profile extends AppModel {
        var $name = 'Profile'; 
        var $belongsTo = array(
            'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
            )); 
    }
?>