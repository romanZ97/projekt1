<?php
require_once "Main.php";

class DeliveryService extends Main
{
    protected $order_positions = array();
    private $order_id = null;
    private $order_nr = null;
    private $total_qty = 0;
    private $total_price = 0;
    private $status = null;
    private $user_id = null;

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION["order_nr"])) {
            $this->setOrder($this->getOrderByNumber($_SESSION["order_nr"]));
            $this->setOrderPositions($_SESSION["order_nr"]);
        }
    }

    public function getSortedOrderPositions()
    {
        $orderCategoryNames = array_column($this->order_positions, "category_name");
        $orderP = $this->order_positions;
        array_multisort($orderCategoryNames, SORT_ASC, $orderP);
        return $orderP;
    }

//    public function showPositions()
//    {
//        if(!($positions = $this->getSortedOrderPositions())){
//            echo '
//                <div class="d-flex justify-content-md-center order-positions-summ">Fmy
//                    <div class="d-flex flex-row align-items-center">
//                        <span style="font-weight: bold">Ihre Bestellung ist leer, wählen Sie was aus</span>
//                    </div>
//                </div>';
//
//        } else {
//            foreach ($positions as $position) {
//                echo '
//                <li id="list-position-' . $position["id"] . '" class="d-flex justify-content-between">
//                    <div class="d-flex flex-row align-items-center">
//                        <span id="title">' . $position["title"] . '</span>
//                        <input name="order_position-view" value="' . $position["id"] . '" hidden>
//                        <p style="margin-left: 15px">' . $position["food_portion"] . ' ' . $position["food_portion_unit"] . '</p>
//                    </div>
//                    <div class="d-flex flex-row align-items-center">
//                        <div class="d-flex flex-row align-items-center">
//                            <button class="dropdown-button" type="button" value="' . $position["id"] . '" onclick="addOrderPosition(this.value)">
//                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
//                                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
//                                   <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
//                               </svg>
//                            </button>
//                            <div class="counter" style=" margin-left: 15px;">
//                                <span class="down" onClick="decreaseCount(event, this,' . $position["id"] . ')">-</span>
//                                <input id="position_qty" type="text" value="' . $this->getPositionQty($position["id"]) . '" readonly>
//                                <span class="up" onClick="increaseCount(event, this,' . $position["id"] . ')">+</span>
//                            </div>
//                        </div>
//                        <span class="list-price" id="price">' . $position["price"] . ' €</span>
//                    </div>
//                </li>';
//            }
//        }
//
//    }

    public function showDelivery(){
        $positions = $this->getSortedOrderPositions();
        $index = 1;
        foreach ($positions as $position){
            echo '
        <tr>
            <td class="list-nr">'. $index .'</td>
            <td>'. $position["title"] .'</td>
            <td class="list-count">x'. $position["qty"] .'</td>
            <td class="list-portion">'. $position["food_portion"] .' '. $position["food_portion_unit"] .'</td>
            <td class="list-price">'. $position["price"]*$position["qty"]  .' €</td>
        </tr>';
            $index++;
        }

    }

    private function setOrderPosition($food_id)
    {
        $sql = "SELECT 
                    f.`id`, 
                    f.`title`, 
                    f.`description`, 
                    f.`price`, 
                    f.`image_name`, 
                    f.`food_portion`, 
                    f.`food_portion_unit`,
                    f.`category_id`,
                    op.`qty`,
                    c.`category_name`,
                    c.`icon_name`,
                    mt.`icon_name`, 
                    co.`country_name`, 
                    co.`country_short_name`
                FROM `food` AS f
                JOIN order_position AS op ON op.food_id = f.id 
                JOIN category AS c ON c.id = f.category_id 
                JOIN country AS co ON co.id = f.country_id
                JOIN meat_type AS mt ON mt.id = f.meat_type_id
                WHERE f.`id` = ?
                AND op.order_id = ?";
        $result = $this->loadDataWithParameters($sql, "ii", array($food_id,$this->order_id));
        foreach ($result as $order_position) {
            $this->order_positions[] = $order_position;
        }
    }

    private function setOrderPositions($order_nr)
    {
//        $this->setOrder($this->getOrderByNumber($order_nr));
//        if (isset($_SESSION['user_id'])) {
//            $this->setUser($_SESSION['user_id']);
//            $this->user_id = $_SESSION['user_id'];
//        }

        $sql = "SELECT 
                    o.`id`,
                    f.`id` as food
                FROM `order_position`AS op
                JOIN ordering AS o ON o.id = op.order_id
                JOIN `food` AS f ON f.id = op.food_id
                WHERE o.`order_nr` = ?";

        $result = $this->loadDataWithParameters($sql, "i", array($order_nr));
        foreach ($result as $order_position) {
            $this->setOrderPosition($order_position["food"]);
        }
    }

    private function addOrderPositions($positions)
    {
        foreach ($positions as $position){
            $this->addOrderPosition($position["id"], $position["qty"]);
        }
    }

    public function addOrder($data)
    {
        $order_nr = rand(1000, 9999);
        if ($this->getOrderByNumber($order_nr) != null) {
            $this->addOrder($data);
        } else {

            $time = date('Y-m-d H:i:s');
            if (isset($_SESSION['user_id'])) {
                $sql = "INSERT INTO `ordering`(`order_nr`, `order_date`, `status`, `total_qty`, `total_price`, `user_id`) VALUES (?,?,?,?,?,?);";
                $this->executeQuery($sql, "issisi", array($order_nr, $time, "open", $data["order_total_qty"], $data["order_total_price"], $_SESSION['user_id']));
            } else {
                $sql = "INSERT INTO `ordering`(`order_nr`, `order_date`, `status`, `total_qty`, `total_price`) VALUES (?,?,?,?,?);";
                $this->executeQuery($sql, "issis", array($order_nr, $time, "open", $data["order_total_qty"], $data["order_total_price"]));
            }
            $_SESSION["order_nr"] = $order_nr;
            $this->setOrder($this->getOrderByNumber($order_nr));
            $this->total_price = $data["order_total_price"];
            $this->total_qty = $data["order_total_qty"];
            $this->addOrderPositions($data["order_positions"]);

        }
    }

    public function addOrderPosition($food_id, $qty)
    {
            $sql = "INSERT INTO `order_position`(`order_id`, `food_id`, `qty`) 
                VALUES (?,?,?);";
            $this->executeQuery($sql, "iii", array($this->order_id, $food_id, $qty));
            $this->setOrderPosition($food_id);
    }

    public function deleteOrderPosition($food_id)
    {
        $sql = "DELETE FROM `order_position` WHERE `order_id` = ? AND `food_id` = ?;";
        $this->executeQuery($sql, "ii", array($this->order_id, $food_id));
        $key = array_search($food_id, array_column($this->order_positions, "id"));
        $this->total_qty--;
        $this->total_price = $this->total_price - $this->order_positions[$key]["price"];
        unset($this->order_positions[$key]);
    }

    public function deleteAllOrderPositions()
    {
        $sql = "DELETE FROM `order_position` WHERE `order_id` = ?";
        $this->executeQuery($sql, "i", array($this->order_id));
//        $this->updateOrder_del_a();
        unset($this->order_positions);
    }

    public function deleteOrder($order_nr)
    {
        $sql = "DELETE FROM `ordering` WHERE `order_nr` = ?;";
        $this->executeQuery($sql, "i", array($order_nr));
    }

    private function getOrderByNumber($order_nr)
    {
        $sql = "SELECT  `id`, `order_nr`, `status`, `user_id`, `total_price`, `total_qty`
                FROM `ordering`
                WHERE `order_nr` = ?";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql, "i", array($order_nr)));
    }

    private function getPositionQty($food_id)
    {
        $sql = "SELECT `qty` FROM `order_position` 
                      WHERE `order_id` = ?
                      AND `food_id` = ?";
        $result = $this->loadDataWithParameters($sql, "ii", array($this->order_id, $food_id));
        $result = mysqli_fetch_assoc($result);
        return $result == null ? false : $result["qty"];
    }

    public function submitOrderCalculation($data)
    {
        $this->updateOrderPositionsCount($data);
        $this->updateOrder_calculation();
    }

    private function updateOrder_calculation()
    {
        $sql = "UPDATE `ordering` SET `total_price`= ?,`total_qty`= ?,`order_date`= ?, `status` = ? WHERE id = ?";
        $this->executeQuery($sql, "sissi", array($this->total_price, $this->total_qty, date('Y-m-d H:i:s'), "calculated", $this->order_id));
    }

    public function updateOrderPositionsCount($data)
    {
        $this->total_price = 0;
        foreach ($data as $food_id => $qty){
            $this->setPositionQty($food_id,$qty);
        }
    }

    private function setPositionQty($position, $qty){
        $key = array_search($position, array_column($this->order_positions, "id"));
        $this->order_positions[$key]["qty"] = $qty;
        $this->total_qty = $this->total_qty + $qty-1;
        $this->total_price += $this->order_positions[$key]["price"] * $qty;
        $sql = "UPDATE `order_position` SET `qty`= ? WHERE `order_id` = ? AND `food_id` = ?";
        $this->executeQuery($sql, "iii", array( $qty, $this->order_id, $position));
    }

    public function getTotalQty()
    {
        return $this->total_qty;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getOrderNr()
    {
        return $this->order_nr;
    }

    public function getOrderDate(){
        $sql = "SELECT  `order_date`
                FROM `ordering`
                WHERE `id` = ?";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql, "i", array($this->order_id)))["order_date"];
    }

    public function getPositions()
    {
        return $this->order_positions;
    }

    private function setOrder($order)
    {
        $this->order_id = $order["id"];
        $this->order_nr = $order["order_nr"];
        $this->status = $order["status"];
        $this->total_price = $order["total_price"];
        $this->total_qty = $order["total_qty"];
        $this->user_id = $order["user_id"];
    }

    public function isPosition($food_id)
    {
        $test = array_search($food_id, array_column($this->order_positions, "id"));
        return gettype($test) == "integer";
    }

    public function submitOrder($data)
    {
        foreach ($data as $key => $item){
            $this->$key = $item;
            $sql = "UPDATE `ordering` SET `order_date`= ?, `$key`= ? WHERE id = ?";
            $this->executeQuery($sql,"ssi",array(date('Y-m-d H:i:s'), $item, $this->order_id));
        }
    }

    private function setUser($user_id)
    {
        $sql = "UPDATE `ordering` SET `order_date`= ?, `user_id` = ? WHERE `id` = ?";
        $this->executeQuery($sql, "sii", array(date('Y-m-d H:i:s'), $user_id, $this->order_id));
    }

    public function uptateOrderStatus($status)
    {
        $sql = "UPDATE `ordering` SET `order_date`= ?, `status` = ? WHERE `id` = ?";
        $this->executeQuery($sql, "ssi", array(date('Y-m-d H:i:s'), $status, $this->order_id));
    }
}