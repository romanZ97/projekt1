<?php
require "Main.php";

/**
 * Klasse SignService
 * Autor: Roman Zhuravel
 *
 * -Sammlung der Funktionen für Unterstützung der Registrierung- und Anmeldevorläufe
 */
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
     * Prüft, ob der User-Name in Datenbank vorhanden ist.
     *
     * @param $user_name string
     * @return bool|void true|false
     */
    public function checkUser($user_name,$path)
    {
        $sql = "SELECT user_name FROM user WHERE user_name=?";
        return (!empty(mysqli_fetch_array($this->loadDataWithParameters($sql,"s",array($user_name),$path))));
    }

// GETTER ..............................................................................................................*


    /**
     * Gibt User-ID nach User-Name zurück
     *
     * @param $user_name string
     * @return mixed|void int $user_id
     */
    public function getUserIdByName($user_name, $path)
    {
        $sql = "SELECT id FROM user WHERE user_name=?";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql,"s",array($user_name), $path))['id'];
    }

    function getUserByNameOrEmail($mail_username, $path){
        $sql = "SELECT * FROM user WHERE user_name=? OR email =?;";
        return mysqli_fetch_assoc($this->loadDataWithParameters($sql,"ss",array($mail_username, $mail_username), $path));
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
        $sql = "INSERT INTO user (user_name, email, password) VALUES (?, ?, ?)";

        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $this->executeQuery($sql, "sss", array($user_name, $email, $pwd), "signup");

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

