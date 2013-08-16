<?php 
    class ProductOrdersController extends AppController {
        public $helpers = Array('Html', 'From', 'Session');

        public function index() {
            $this->set('productorders', $this->ProductOrder->findAllByUser_id($this->Auth->user(id)));
        }
        
//        public function view($id = null) {
//            if (!$id) {
//                throw new NotFoundException(__('Invalid post'));
//            }
//
//            $post = $this->Post->findById($id);
//            if (!$post) {
//                throw new NotFoundException(__('Invalid post'));
//            }
//            $this->set('post', $post);
//        }
        
        public function add($id) {
            $productorder = $this->ProductOrder->find(
                'first',
                array('conditions' => array(
                    'ProductOrder.device_id' => $id,
                    'ProductOrder.user_id' => $this->Auth->user('id'),
                    'ProductOrder.status' => 1
            )));
            if ($productorder) {
                $data = array(
                    'id' => $productorder['ProductOrder']['id'],
                    'quantity' => $productorder['ProductOrder']['quantity'] + 1
                );
            } else {
                $device = $this->ProductOrder->Device->findById($id);
                $this->checkNull($device, 'Device');
                $data = array(
                    'name' => $device['Device']['name'],
                    'description' => $device['Device']['description'],
                    'price' => $device['Device']['price'],
                    'device_id' => $device['Device']['id'],
                    'status' => 1,
                    'user_id' => $this->Auth->user('id'),
                    'quantity' => 1,
                );
            }
            
            if ($this->ProductOrder->save($data)) {
                $this->Session->setFlash(__('Your productorder has been saved.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your productorder.'));
            }
        }
        
        public function edit($id = null) {
            $this->checkNull($id);
            $productorder = $this->ProductOrder->findById($id);
            $this->checkNull($productorder);

            if ($this->request->is('post') || $this->request->is('put')) {
                $this->ProductOrder->id = $id;
                if ($this->ProductOrder->save($this->request->data)) {
                    $this->Session->setFlash(__('Your ProductOrder has been updated.'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Unable to update your ProductOrder.'));
                }
            }

            if (!$this->request->data) {
                $this->request->data = $productorder;
            }
        }
        
        public function delete($id) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
            if ($this->ProductOrder->delete($id)) {
                $this->Session->setFlash(__('The productorder with id: %s has been deleted.', h($id)));
                $this->redirect(array('action' => 'index'));
            }
        }
//        
//        public function isAuthorized($user) {
//            // All registered users can add posts
//            if ($this->action === 'add') {
//                return true;
//            }
//
//            // The owner of a post can edit and delete it
//            if (in_array($this->action, array('edit', 'delete'))) {
//                $postId = $this->request->params['pass'][0];
//                if ($this->Post->isOwnedBy($postId, $user['id'])) {
//                    return true;
//                }
//            }
//
//            return parent::isAuthorized($user);
//        }
        public function findProductOrder($id) {
            $productorder = $this->ProductOrder->findById($id);
            $this->chekNull($productorder);
            return $productorder;
        }
        
        public function checkNull($arg1, $arg2 = null) {
            if ($arg2 == null) {
                $arg2 = 'Productorder';
            }
            if (!$arg1) {
                throw new NotFoundException(__('Invalid '.$arg2));
            }
            return $arg1;
        }
    }
?>