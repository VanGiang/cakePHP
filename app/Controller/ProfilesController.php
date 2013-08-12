<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
    class ProfilesController extends AppController {
        public $helpers = Array('Html', 'From', 'Session');
        
        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid profile'));
            }

            $profile = $this->Profile->findById($id);
            if (!$profile) {
                throw new NotFoundException(__('Invalid profile'));
            }
            $this->set('profile', $profile);
        } 
    }
?>
