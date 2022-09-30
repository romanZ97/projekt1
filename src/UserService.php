<?php
require_once "Main.php";

/**
 * Klasse SignService
 * Autor: Roman Zhuravel
 *
 * -Sammlung der Funktionen für Anlegen von User relevanten Daten (Favoriten, Kontaktdaten)
 */
class UserService extends Main
{

    private $user_id;
    private $user_name = null;
    private $email = null;
    private $user_forename = null;
    private $user_surname = null;
    private $address = null;
    private $contact = null;
    private $user_favorites = array();
    private $user_orders = array();
    private $user_reservation = array();


    public function __construct($user_id)
    {
        parent::__construct();
        $this->user_id  = $user_id;
        $this->setUser($user_id);
    }

    public function showOrderUserProfileData(){
        echo '
        <div class="mb-3 mt-3">
            <label for="order-c-ln" class="form-label">Name:</label>
            <input type="text" class="form-control" id="order-c-ln" name="order-c-ln" placeholder="Mustermann" value="' . $this->user_surname . '" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-fn" class="form-label">Vorname:</label>
            <input type="text" class="form-control" id="order-c-fn" name="order-c-fn" placeholder="Max" value="' . $this->user_forename . '" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-e" class="form-label">E-Mail:</label>
            <input type="email" class="form-control" id="order-c-e" name="order-c-e" placeholder="MaxMustermann@muster.de"  value="' . $this->email . '" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-a" class="form-label">Adresse:</label>
            <input type="text" class="form-control" id="order-c-a" name="order-c-a" placeholder="PLZ Ort, Strasse Haus-nr." value="' . $this->address . '" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-c" class="form-label">Telefonnummer:</label>
            <input type="tel" class="form-control" id="order-c-c" name="order-c-c" placeholder="+49..." pattern="(((\+|00+)49)|0)[1-9]\d+" value="' . $this->contact . '" required>

        </div>';
    }

    public function showUserProfileData(){
        echo '
        <div class="mb-3 mt-3">
            <label for="order-c-ln" class="form-label">Benutzername:</label>
            <input type="text" class="form-control" id="user-n" value="' . $this->user_name . '">

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-ln" class="form-label">Nachname:</label>
            <input type="text" class="form-control" id="user-sn" name="user-sn" placeholder="Mustermann" value="' . $this->user_surname . '" >

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-fn" class="form-label">Vorname:</label>
            <input type="text" class="form-control" id="user-fn" name="user-fn" placeholder="Max" value="' . $this->user_forename . '" >

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-e" class="form-label">E-Mail:</label>
            <input type="email" class="form-control" id="user-e" name="user-e" placeholder="MaxMustermann@muster.de"  value="' . $this->email . '" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-a" class="form-label">Adresse:</label>
            <input type="text" class="form-control" id="user-a" name="user-a" placeholder="PLZ Ort, Strasse Haus-nr." value="' . $this->address . '" >

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-c" class="form-label">Telefonnummer:</label>
            <input type="tel" class="form-control" id="user-c" name="user-c" placeholder="+49..." pattern="(((\+|00+)49)|0)[1-9]\d+" value="' . $this->contact . '" >

        </div>';
    }

    public function deleteUserFavorite($food_id)
    {
        $sql = "DELETE FROM `user_favorit` WHERE `food_id` = ?;";
        $this->executeQuery($sql,"i", array($food_id), "index");
    }

    public function addUserFavorite($food_id)
    {
        if(!$this->chekUserFavorite($food_id)){
            $sql = "INSERT INTO `user_favorit`(`user_id`, `food_id`) VALUES (?,?);";
            $this->executeQuery($sql,"ii", array($this->user_id,$food_id), "index");
            return true;
        } else {
            $this->deleteUserFavorite($food_id);
            return false;
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

        $result = mysqli_fetch_array($this->loadDataWithParameters($sql,"i", array($user_id),"index"));
        $this->user_name = $result["user_name"];
        $this->email = $result["email"];
        $this->user_forename = $result["user_forename"];
        $this->user_surname = $result["user_surname"];
        $this->address = $result["address"];
        $this->contact = $result["contact"];

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

        $result = $this->loadDataWithParameters($sql,"i", array($user_id), "index");
        foreach ($result as $favorite) {
            $this->user_favorites[] = $favorite;
        }
    }

    private function setUserOrders($user_id)
    {
        $sql = "SELECT `id` FROM `ordering` WHERE `user_id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($user_id), "index");
        foreach ($result as $order) {
            $this->user_orders[] = $order;
        }
    }

    private function setUserReservation($user_id)
    {
        $sql = "SELECT `id` FROM `tbl_reservation` WHERE `user_id` = ?";
        $result = $this->loadDataWithParameters($sql,"i", array($user_id), "index");

        foreach ($result as $reservation) {
            $this->user_favorites[] = $reservation;
        }
    }

    public function setUserData($data){
        foreach ($data as $key => $item){
            if ($item != $this->$key){
                $this->$key = $item;
                $sql = "UPDATE `user` SET `$key`= ? WHERE id = ". $_SESSION["user_id"];
                $this->executeQuery($sql,"s",array($item), "index");
            }
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
        return $this->email;
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
        return $this->address;
    }

    /**
     * @return null
     */
    public function getUserContact()
    {
        return $this->contact;
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