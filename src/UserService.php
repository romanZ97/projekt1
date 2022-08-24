<?php
require "Main.php";
class UserService extends Main
{

    private $user_id;
    private $user_name = null;
    private $user_mail = null;
    private $user_forename = null;
    private $user_surname = null;
    private $user_address = null;
    private $user_contact = null;
    private $user_favorites = array();
    private $user_orders = array();
    private $user_reservation = array();


    public function __construct($user_id)
    {
        parent::__construct();
        $this->user_id  = $user_id;
        $this->setUser($user_id);
    }



    //TODO-------------------------------------------------------------------------------------------------------------- ENCRYPT & DECRYPT METHODS
//    private function decrypt( $ciphertext ): bool|string
//    {
//        $cipher = "aes-256-cbc";
//
//        $encrypted_data = explode('::', base64_decode($ciphertext));
//        return openssl_decrypt($encrypted_data[0], $cipher,  null,0,null);
//    }

// SETTER ..............................................................................................................*

    private function setUser($user_id)
    {
        $sql = "SELECT `user_id`, `user_name`, `user_forename`, `user_surname`, `email`, `address`, `contact` FROM `user` WHERE `user_id` = ?";

        $result = mysqli_fetch_array($this->loadDataWithParameters($sql,"i", array($user_id)));
        $this->user_name = $result["user_name"];
        $this->user_mail = $result["email"];
        $this->user_forename = $result["user_forename"];
        $this->user_surname = $result["user_surname"];
        $this->user_address = $result["address"];
        $this->user_contact = $result["contact"];

        $this->setUserOrders($user_id);
        $this->setUserReservation($user_id);
        $this->setUserFavorites($user_id);
    }


    public function showUserFavorites(){ //TODO ------------------------------------------------------------------------ Prozedurall scheriben
        $userFCategoryNames = array_column($this->user_favorites,"category_name");
        $userF = $this->user_favorites;
        array_multisort($userFCategoryNames,SORT_ASC,$userF);
        $category = null;
        foreach ($userF as $favorite){
            echo '<a class="dropdown-item" href="#">';

            if($category != $favorite["category_id"]){
                $category = $favorite["category_id"];
                echo '<div class="dropdown-header">'. $favorite["category_name"] .'</div>';
            }

            echo '<button></button><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                     class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg><button>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                     class="bi bi-basket2-fill" viewBox="0 0 16 16">
                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                </svg></button>' . $favorite["dish_id"] . '   ' . $favorite["dish_name"] . '</a>
            <a class="dropdown-item" href="#">';
        }
    }


    private function setUserFavorites($user_id)
    {
        $sql = "SELECT uf.`dish_id`, d.`dish_name`, d.`category_id`, c.`category_name` FROM `user_favorit`AS uf
                JOIN `dish` AS d USING (dish_id)
                JOIN `category` AS c USING (category_id)
                WHERE `user_id` = ?";

        $result = $this->loadDataWithParameters($sql,"i", array($user_id));
        foreach ($result as $favorite) {
            $this->user_favorites[] = $favorite;
        }
    }

    private function setUserOrders($user_id)
    {
        $sql = "SELECT `order_id` FROM `order` WHERE `user_id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($user_id));
        foreach ($result as $order) {
            $this->user_favorites[] = $order;
        }
    }

    private function setUserReservation($user_id)
    {
        $sql = "SELECT `reservation_id` FROM `reservation` WHERE `user_id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($user_id));
        foreach ($result as $reservation) {
            $this->user_favorites[] = $reservation;
        }
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return null
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return null
     */
    public function getUserMail()
    {
        return $this->user_mail;
    }

    /**
     * @return null
     */
    public function getUserForename()
    {
        return $this->user_forename;
    }

    /**
     * @return null
     */
    public function getUserSurname()
    {
        return $this->user_surname;
    }

    /**
     * @return null
     */
    public function getUserAddress()
    {
        return $this->user_address;
    }

    /**
     * @return null
     */
    public function getUserContact()
    {
        return $this->user_contact;
    }

    /**
     * @return array
     */
    public function getUserFavorites()
    {
        return $this->user_favorites;
    }

    /**
     * @return array
     */
    public function getUserOrders()
    {
        return $this->user_orders;
    }

    /**
     * @return array
     */
    public function getUserReservation()
    {
        return $this->user_reservation;
    }


}