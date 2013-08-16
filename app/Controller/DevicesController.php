<?php 
// app/Controller/DevicesController.php
class DevicesController extends AppController {
    var $components = array('Upload');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // Letting devices register themselves
    }
    
    public function index($category_id = null) {
      if ($category_id) {
//            debug($this->Auth->user());die('OK1111');
            $category = $this->Device->Category->findById($category_id);
            $devices = $this->Device->findAllByCategory_id($category_id);
            $data = array('devices' => $devices, 'category' => $category);
        } else {
            //$this->Device->recursive = 0;
          // $data = array('devices' => $this->paginate());
              $data = array('devices' => $this->Device->find('all'));
        }
        $this->set($data);
    }

    public function view($id = null) {
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        $this->set('device', $this->Device->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            
            // đường dẫn tới thu mục upload file ảnh
                    $destination = realpath('../../app/webroot/img/uploads/') . '/';
                    // grab the file
                    $file = $this->data['Device']['image'];
//                    debug($this->data['Device']['image']);die();
                    // cấu hình upload
                    $rule = array(
                                    'type' => 'resizemin',
                                    'size' => array('400', '300'),
                                    'output' => 'jpg',
                                );
                    $result = $this->Upload->upload($file, $destination, null, $rule);
                    if (!$this->Upload->errors){
                            $this->request->data['Device']['image']= $this->Upload->result;
                    } else {
                            // display error
                            $errors = $this->Upload->errors;
                            // piece together errors
                            if(is_array($errors)){ $errors = implode("<br />",$errors); }
                                    $this->Session->setFlash($errors);
                                    $this->redirect('/devices');
                                    exit();
                    }
            $this->Device->create();
            
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        }
        $this->set('categories', $this->Device->Category->find('list'));
    }

    public function edit($id = null) {
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Device->read(null, $id);
            unset($this->request->data['Device']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->Device->delete()) {
            $this->Session->setFlash(__('Device deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Device was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
?>
