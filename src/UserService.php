<?php



class UserService {

    protected string $globalpath = "/Projekt1";

    private string $user_id;
    private $user_name = null;
    private $user_mail = null;
    private $user_forename = null;
    private $user_surname = null;
    private $user_address = null;
    private $user_contact = null;
    private $user_favorites = array();
    private $user_orders = array();
    private $user_reservation = array();

    protected $conn = null;

    public function __construct($user_id)
    {
        require_once __DIR__ . "/../config/db_connect.php";
        $this->conn = $conn;

        $this->user_id  = $user_id;
        $this->setUser($user_id);

    }

    private function loadData($query, $types, $data)
    {
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/index.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt,$types,...$data);
            $result = mysqli_stmt_execute($stmt);

            if($result){
                return mysqli_stmt_get_result($stmt);

            }else{
                header("Location: $this->globalpath/index.php?error=sqlerror");
                exit();
            }

        }
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

    private function setUser($user_id): void
    {
        $sql = "SELECT `user_id`, `user_name`, `user_forename`, `user_surname`, `email`, `address`, `contact` FROM `user` WHERE `user_id` = ?";

        $result = mysqli_fetch_array($this->loadData($sql,"i", array($user_id)));
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

    private function setUserFavorites($user_id): void
    {
        $sql = "SELECT `dish_id` FROM `user_favorit` WHERE `user_id` = ?";
        $result = $this->loadData($sql,"i", array($user_id));
        foreach ($result as $favorite) {
            $this->user_favorites[] = $favorite;
        }
    }

    private function setUserOrders($user_id): void
    {
        $sql = "SELECT `order_id` FROM `order` WHERE `user_id` = ?";
        $result = $this->loadData($sql,"i", array($user_id));
        foreach ($result as $order) {
            $this->user_favorites[] = $order;
        }
    }

    private function setUserReservation($user_id): void
    {
        $sql = "SELECT `reservation_id` FROM `reservation` WHERE `user_id` = ?";
        $result = $this->loadData($sql,"i", array($user_id));
        foreach ($result as $reservation) {
            $this->user_favorites[] = $reservation;
        }
    }


}