<?php
require "Main.php";

class SignService extends Main
{

// Check Funktionen ....................................................................................................*


    /**
     * return filter_var($email, FILTER_VALIDATE_EMAIL)
     *
     * Prüft, ob die eingegebene Email gültige Zeichenkombinationen hat
     *
     * @param $email string
     * @return mixed boolean the filtered data, or FALSE if the filter fails
     */
    public function checkMailValidation($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * return preg_match("/^[a-zA-Z0-9]*\.[a-zA-Z-]*$/", $user_name)
     *
     * Prüft, ob der User-Name gültige Zeichenkombination hat (v.name)
     *
     * @param $user_name string
     * @return false|int 1 if the pattern matches given subject, 0 if it does not, or FALSE if an error occurred.
     */
    public function checkUserNameValidation($user_name)
    {
        //return preg_match("/^[a-zA-Z0-9]*\.[a-zA-Z-]*$/", $user_name);
        return true;
    }

    public function checkPassword($pwd, $pwd_r)
    {
        if($pwd == $pwd_r){
            return true;
        } else {
            return false;
        }
    }


    /**
     * Prüft, ob der User-Name in Datenbank vorhanden ist.
     *
     * @param $user_name string
     * @return bool|void true|false
     */
    public function checkUser($user_name)
    {
        $sql = "SELECT user_name FROM user WHERE user_name=?";
        return (!empty(mysqli_fetch_array($this->loadDataWithParameters($sql,"s",array($user_name)))));
    }

// GETTER ..............................................................................................................*


    /**
     * Gibt User-ID nach User-Name zurück
     *
     * @param $user_name string
     * @return mixed|void int $user_id
     */
    public function getUserIdByName($user_name)
    {
        $sql = "SELECT user_id FROM user WHERE user_name=?";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql,"s",array($user_name)))['user_id'];
    }



// ADD Funktionen ......................................................................................................*

    /**
     * Erzeugt einen neuen User mit ID, Name, Email, gehashten Passwort, standards Notiz und leerem Token.
     *
     * @param $user_name string
     * @param $email string
     * @param $password string Hash
     * @return void
     */
    public function addUser($user_name, $email, $pwd)
    {
        $sql = "INSERT INTO user (user_name, email, password, token_password) VALUES (?, ?, ?, null)";

        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $this->executeQuery($sql, "sss", array($user_name, $email, $pwd));

    }

// CRYPT Funktionen ....................................................................................................*

    public function encrypt($value)
    {
        return $this->p_encrypt($value);
    }

    public function decrypt($crypttext)
    {
        return $this->p_decrypt($crypttext);
    }


    private function p_encrypt( $value )
    {

        $key = hex2bin(openssl_random_pseudo_bytes(4));

        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);

        $ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);

        return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
    }

    private function p_decrypt( $ciphertext )
    {
        $cipher = "aes-256-cbc";

        list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
        return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
    }

}

