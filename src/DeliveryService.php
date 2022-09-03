<?php
require_once "Main.php";
class DeliveryService extends Main
{
    protected $order_positions = array();
    private $order_id = null;
    private $order_nr =null;
    private $total_qty = 0;
    private $total_price = 0;
    private $status = null;
    private $order_customer = array();

    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION["order_nr"])) {
            $this->setOrderPositions($_SESSION["order_nr"]);
        } else {
            if (isset($_SESSION['user_id'])){
                $_SESSION["order_nr"] = $this->addUserOrder($_SESSION['user_id']);
            } else {
                $_SESSION["order_nr"] = $this->addOrder();
            }

        }
    }


    public function getSortedOrderPositions(){
        $orderCategoryNames = array_column($this->order_positions,"category_name");
        $orderP = $this->order_positions;
        array_multisort($orderCategoryNames,SORT_ASC,$orderP);
        return $orderP;
    }

    private function setOrderPositions_d($food_id){
        $sql = "SELECT 
                    f.`id`, 
                    f.`title`, 
                    f.`description`, 
                    f.`price`, 
                    f.`image_name`, 
                    f.`food_portion`, 
                    f.`food_portion_unit`,
                    f.`category_id`,
                    c.`category_name`,
                    c.`icon_name`,
                    mt.`icon_name`, 
                    co.`country_name`, 
                    co.`country_short_name`
                FROM `food` AS f
                JOIN category AS c ON c.id = f.category_id 
                JOIN country AS co ON co.id = f.country_id
                JOIN meat_type AS mt ON mt.id = f.meat_type_id
                WHERE f.`id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($food_id));
        foreach ($result as $order_position) {
            $this->order_positions[] = $order_position;
            $this->total_qty++;
            $this->total_price += $order_position["price"];
        }
    }

    private function setOrderPositions($order_nr){
        $order = $this->getOrderByNumber($order_nr);
        $this->order_id = $order["id"];
        $this->order_nr = $order["order_nr"];
        $this->status = $order["status"];
        $this->order_customer = array($order["customer_name"], $order["customer_contact"], $order["customer_email"], $order["customer_address"]);

        $sql = "SELECT 
                    o.`id`,
                    f.`id` as food
                FROM `order_position`AS op
                JOIN ordering AS o ON o.id = op.order_id
                JOIN `food` AS f ON f.id = op.food_id
                WHERE o.`order_nr` = ?";

        $result = $this->loadDataWithParameters($sql,"i", array($order_nr));
        foreach ($result as $order_position) {
            $this->setOrderPositions_d($order_position["food"]);
        }
    }

    public function addOrderPosition($order_nr, $food_id){
        $order = $this->getOrderByNumber($order_nr);
        if($qty = $this->getPositionQty($order["id"], $food_id )){
            $sql = "UPDATE `order_position` SET `qty`= '". $qty+1 ."' WHERE `order_id` = ? AND `food_id` = ?";
            $this->executeQuery($sql,"ii", array($order["id"], $food_id));

        } else {
            $sql = "INSERT INTO `order_position`(`order_position_nr`, `order_id`, `food_id`) 
                VALUES (?,?,?);";
            $this->executeQuery($sql,"iii", array(($order["total_qty"]+1), $order["id"], $food_id));
        }
        $this->updateOrder_add($order_nr, $food_id, $order["total_qty"]+1);

    }

    private function addOrder(){
        $order_nr = rand(1000,9999);
        if($this->getOrderByNumber($order_nr) != null){
            $this->addOrder();
        } else {
            $time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `ordering`(`order_nr`, `order_date`, `status`, `total_qty`) VALUES (?,?,?,?);";
            $this->executeQuery($sql,"issi", array($order_nr,$time,"open",0));
            $_SESSION["order_nr"] = $order_nr;
            $this->order_id = $this->getOrderByNumber($order_nr)["id"];
            return $order_nr;
        }
        return false;
    }

    private function addUserOrder($user_id){
        $order_nr = rand(1000,9999);
        if($this->getOrderByNumber($order_nr) != null){
            $this->addOrder();
        } else {
            $time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `ordering`(`order_nr`, `order_date`, `status`, `total_qty`, `user_id`) VALUES (?,?,?,?,?);";
            $this->executeQuery($sql,"issii", array($order_nr,$time,"open",0,$user_id));
            $_SESSION["order_nr"] = $order_nr;
            return $order_nr;
        }
        return false;
    }

    public function deleteOrderPosition($order_nr,$food_id){
        $p_qty = $this->getPositionQty($food_id);
        $sql = "DELETE FROM `order_position` WHERE `order_id` = ? AND `food_id` = ?;";
        $this->executeQuery($sql,"ii", array($this->order_id, $food_id));
        $this->updateOrder_del($order_nr,$food_id,$this->total_qty-$p_qty);
    }

    public function deleteOrder($order_nr){
        $sql = "DELETE FROM `ordering` WHERE `order_nr` = ?;";
        $this->executeQuery($sql,"i", array($order_nr));
    }

    private function getOrderByNumber($order_nr){
        $sql = "SELECT * 
                FROM `ordering`
                WHERE `order_nr` = ?";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql,"i", array($order_nr)));
    }

    private function getPositionQty($food_id){
        $sql = "SELECT `qty` FROM `order_position` 
                      WHERE `order_id` = ?
                      AND `food_id` = ?";
        $result = $this->loadDataWithParameters($sql,"ii", array($this->order_id, $food_id));
        $result = mysqli_fetch_assoc($result);
        return $result == null? false: $result["qty"];
    }

    private function updateOrder_add($order_nr, $food_id, $qty){
        $totalprice = $this->total_price + $this->getFoodPrice($food_id);
        $sql = "UPDATE `ordering` SET `total_price`= ?,`total_qty`= ?,`order_date`= ? WHERE 1";
        $this->executeQuery($sql,"iis", array($totalprice, $qty, date('Y-m-d H:i:s')));
    }

    private function updateOrder_del($order_nr, $food_id, $qty){
        $totalprice = $this->total_price - $this->getFoodPrice($food_id);
        $sql = "UPDATE `ordering` SET `total_price`= ?,`total_qty`= ?,`order_date`= ? WHERE 1";
        $this->executeQuery($sql,"iis", array($totalprice, $qty, date('Y-m-d H:i:s')));
    }

    private function getOrderPrice($order_nr){
        $sql = "SELECT `total_price` FROM `ordering` WHERE `order_nr` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($order_nr));
        return mysqli_fetch_assoc($result)["total_price"];
    }

    private function getFoodPrice($food_id){
        if($food = array_search($food_id,array_column($this->order_positions, "id"))){
            return $this->order_positions[$food]["price"];
        } else {
            $sql = "SELECT `price` FROM `food` WHERE `id` = ?";
            $result = $this->loadDataWithParameters($sql,"i", array($food_id));
            return mysqli_fetch_assoc($result)["price"];
        }
    }

    public function getTotalQty(){
        return $this->total_qty;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getNumber(){
        return $this->order_nr;
    }
}