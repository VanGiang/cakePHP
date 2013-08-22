<?php 
class ProductOrdersController extends AppController {
    public $helpers = Array('Html', 'From', 'Session');

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
        $total_price = 0;
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
                $total_price = $data['quantity']*$device['Device']['price'];
                $data_order = array(
                    'id' => $product_order['ProductOrder']['order_id'],
                    'total_price' => $total_price
                );
                $this->ProductOrder->Order->save($data_order);
            } else {
                if ($total_price == 0) {
                    $order = $this->ProductOrder->Order->save();
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
                $total_price += $data['price'] * $data['quantity'];
                $this->ProductOrder->Order->save(
                    array('id' => $order['Order']['id'], 'total_price' => $total_price)
            )   ;
            }
            $this->ProductOrder->save($data);
        }
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
