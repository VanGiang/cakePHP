<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AuthComponent', 'Controller/Component');
?>
<?php 
    class User extends AppModel {
        public $validate = array(
            'username' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A username is required'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'author')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
        );
        
        var $name = 'User'; 
        var $hasOne = array(
            'Profile' => array(
                'className' => 'Profile',
                'dependent' => true
            ),
            'Order' => array(
                'className' => 'Order',
                'dependent' => true,
            ),
        ); 

        var $hasMany = array(
            'Product0rder' => array(
                'className' => 'ProductOrder',
                'dependent' => true
            )
        );

        public function beforeSave($options = array()) {
            if (isset($this->data[$this->alias]['password'])) {
                $this->data[$this->alias]['password'] = 
                    AuthComponent::password(
                        $this->data[$this->alias]['password']);
            }
            return true;
        }

    }
?>
