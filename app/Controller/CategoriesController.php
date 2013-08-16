<?php 
// app/Controller/CategoriesController.php
class CategoriesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // Letting categories register themselves
    }

    public function index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->paginate());
    }

    public function view($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->set('category', $this->Category->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Category->read(null, $id);
            unset($this->request->data['Category']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Category->delete()) {
            $this->Session->setFlash(__('Category deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Category was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
?>
