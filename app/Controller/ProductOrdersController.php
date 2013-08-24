<?php 
class ProductOrdersController extends AppController {
    public $helpers = Array('Html', 'From', 'Session', 'Js' => array('Jquery'));

    public function index() {
        $this->set('productorders', $this->ProductOrder->find('all'));
    }

    public function view() {
        $productorders = array();
        $i = 1;
        foreach ($this->Session->read('Product') as $product) {
            $productorders[$i] = $this->ProductOrder->Device->findById($product['id']);
            $i++;
        }
        $this->set('productorders', $productorders);
    }

    public function add_to_cart($id) {
        if ($this->Session->check("Product.{$id}")) {
            $data = array(
                "Product.{$id}.quantity" => 
                $this->Session->read("Product.{$id}.quantity") + 1
            );
        } else {
            $device = $this->ProductOrder->Device->findById($id);
            $this->checkNull($device, 'Device');
            $data = array(
                "Product.{$id}.id" => $id,
                "Product.{$id}.quantity" => 1,
            );
        }

        if ($this->Session->write($data)) {
            $this->Session->setFlash(__('Your productorder has been saved.'));
            $this->redirect(array('action' => 'view'));
        } else {
            $this->Session->setFlash(__('Unable to add your productorder.'));
        }
    }

    public function add() {
        if (!$this->Session->check('Product')) {
            $this->Session->setFlash('Cart empty. Please choose products other.');
            $this->redirect(array('controller' => 'devices', 'action' => 'index'));
        }
        $order = $this->ProductOrder->Order->findByUser_id($this->Auth->user('id'));
        foreach($this->Session->read('Product') as $product) {
            $device = $this->ProductOrder->Device->findById($product['id']);
            $this->checkNull($device, 'Device');
            $product_order = $this->ProductOrder->find('first',array(
                'conditions' => array(
                    'ProductOrder.device_id' => $product['id'],
                    'ProductOrder.user_id' => $this->Auth->user('id'),
                    'ProductOrder.status' => 1,
                )));
            if ($product_order) {
                $data = array(
                    'id' => $product_order['ProductOrder']['id'],
                    'quantity' => $product_order['ProductOrder']['quantity'] + 
                    $product['quantity']
                );
            } else {
                if (empty($order)){
                    $order = $this->ProductOrder->Order->save(array('user_id' => $this->Auth->user('id')));
                }
                $data = array(
                    'name' => $device['Device']['name'],
                    'description' => $device['Device']['description'],
                    'price' => $device['Device']['price'],
                    'device_id' => $device['Device']['id'],
                    'status' => 1,
                    'user_id' => $this->Auth->user('id'),
                    'quantity' => $product['quantity'],
                    'order_id' => $order['Order']['id'],
                );
                $this->ProductOrder->create();
            }
            $this->ProductOrder->save($data);
        }
        $product_orders = $this->ProductOrder->find('all', array(
            'conditions' => array(
                'ProductOrder.user_id' => $this->Auth->user('id'),
                'status' => 1,
        )));
        $total_price = 0;
        foreach($product_orders as $product_order){
            $total_price += $product_order['ProductOrder']['price'] * $product_order['ProductOrder']['quantity'];
        }
        $this->ProductOrder->Order->save(array(
            'id' => $order['Order']['id'],
            'total_price' => $total_price,
        ));
        $this->Session->delete('Product');
        $this->Session->setFlash(__('Thanks you for purchase.'));
        $this->redirect(array('controller' => 'devices', 'action' => 'index'));
    }

    public function edit() {
        $this->layout = NULL;
        $this->autoRender = false;
        if (isset($_POST['quantities'])) {
            $q = $_POST['quantities'];
            $product_id = $_POST['product_id'];
            $this->Session->write("Product.{$product_id}.quantity", $q);
            $total_price = 0;
            foreach($this->Session->read('Product') as $product) {
                $device = $this->ProductOrder->Device->findById($product['id']);
                if ($device) {
                    $total_price += $device['Device']['price'] * $product['quantity'];
                } else {
                    echo header("HTTP/1.0 404 Not Found");
                }
            }
            echo json_encode($total_price);
        } else {
            echo header("HTTP/1.0 404 Not Found");
        }
    }

    public function delete($id) {
        $this->Session->delete("Product.{$id}");
        $this->redirect(array('action' => 'view'));
    }

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
