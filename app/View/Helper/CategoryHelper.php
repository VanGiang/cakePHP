<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    class CategoryHelper extends AppHelper {
        public function find123() {
            debugger::dump($this->find('all'));
            die('OKkk');
            return $this->Category->find('all');
        }
    }
?>