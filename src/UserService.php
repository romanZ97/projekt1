<?php
require_once "Main.php";
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


    public function deleteUserFavorite($food_id)
    {
        $this->p_deleteUserFavorite($food_id);
    }

    public function addUserFavorite($food_id)
    {
        $this->p_addUserFavorite($this->user_id,$food_id);
    }

    private function p_deleteUserFavorite($food_id)
    {
        $sql = "DELETE FROM `user_favorit` WHERE `food_id` = ?;";
        $this->executeQuery($sql,"i", array($food_id));
    }

    private function p_addUserFavorite($user_id,$food_id)
    {
        if(!$this->chekUserFavorite($food_id)){
            $sql = "INSERT INTO `user_favorit`(`user_id`, `food_id`) VALUES (?,?);";
            $this->executeQuery($sql,"ii", array($user_id,$food_id));
        }
    }

    public function chekUserFavorite($food_id){
        $col = array_column($this->user_favorites,"food_id");
        $res = in_array($food_id,$col);
        return in_array($food_id,array_column($this->user_favorites,"food_id"));
    }


// SETTER ..............................................................................................................*

    private function setUser($user_id)
    {
        $this->user_id  = $user_id;

        $sql = "SELECT 
                    `id`, 
                    `user_name`, 
                    `user_forename`, 
                    `user_surname`, 
                    `email`, 
                    `address`, 
                    `contact` 
                FROM `user` 
                WHERE `id` = ?";

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


    public function getSortedUserFavorites()
    {
        $userFCategoryNames = array_column($this->user_favorites,"category_name");
        $userF = $this->user_favorites;
        array_multisort($userFCategoryNames,SORT_ASC,$userF);
        return $userF;
    }


    private function setUserFavorites($user_id)
    {
        $sql = "SELECT 
                    uf.`food_id`, 
                    f.`title`, 
                    f.`category_id`, 
                    f.`price`, 
                    c.`category_name`, 
                    c.`icon_name` 
                FROM `user_favorit`AS uf
                JOIN `food` AS f ON f.id = uf.food_id
                JOIN `category` AS c ON c.id = f.category_id
                WHERE uf.`user_id` = ?";

        $result = $this->loadDataWithParameters($sql,"i", array($user_id));
        foreach ($result as $favorite) {
            $this->user_favorites[] = $favorite;
        }
    }

    private function setUserOrders($user_id)
    {
        $sql = "SELECT `id` FROM `ordering` WHERE `user_id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($user_id));
        foreach ($result as $order) {
            $this->user_orders[] = $order;
        }
    }

    private function setUserReservation($user_id)
    {
        $sql = "SELECT `id` FROM `reservation` WHERE `user_id` = ?";
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