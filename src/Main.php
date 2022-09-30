<?php

/**
 *
 */
class Main
{
    /**
     * @var
     */
    protected $conn;
    /**
     * @var string
     */
    protected string $globalpath = "http://localhost:8888/projekt1";

    /**
     *
     */
    public function __construct()
    {
        require __DIR__ . "/../config/db_connect.php";
        $this->conn = $conn;
    }

    /**
     * @param $query
     * @param $types
     * @param $data
     * @return false|mysqli_result|null
     */
    public function loadDataWithParameters($query, $types, $data, $path)
    {
        return $this->p_loadDataWithParameters($query,$types,$data,$path);
    }

    /**
     * @param $query
     * @return false|mysqli_result|null
     */
    public function loadData($query, $path)
    {
        return $this->p_loadData($query, $path);
    }

    /**
     * @param $query
     * @param $types
     * @param $data
     * @return void
     */
    public function executeQuery($query, $types, $data, $path)
    {
        $this->p_executeQuery($query,$types,$data, $path);
    }

    /**
     * @param $query
     * @param $types
     * @param $data
     * @return void
     */
    private function p_executeQuery($query, $types, $data, $path)
    {
        $this->secureQuery($this->conn,$data);
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/$path.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt,$types,...$data);
            $result = mysqli_stmt_execute($stmt);

            if(!$result){
                header("Location: $this->globalpath/$path.php?error=sqlerror");
                exit();
            }

        }
    }

    /**
     * @param $query
     * @param $types
     * @param $data
     * @return false|mysqli_result|void
     */
    private function p_loadDataWithParameters($query, $types, $data, $path)
    {
        $this->secureQuery($this->conn,$data);
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/$path.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt,$types,...$data);
            $result = mysqli_stmt_execute($stmt);

            if($result){
                return mysqli_stmt_get_result($stmt);


            }else{
                header("Location: $this->globalpath/$path.php?error=sqlerror");
                exit();
            }

        }
    }

    /**
     * @param $query
     * @return false|mysqli_result|void
     */
    private function p_loadData($query,$path)
    {
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/$path.php?error=sqlerror");
            exit();

        } else {
            $result = mysqli_stmt_execute($stmt);

            if($result){
                return mysqli_stmt_get_result($stmt);

            }else{
                header("Location: $this->globalpath/$path.php?error=sqlerror");
                exit();
            }

        }
    }

    /**
     * @param $conn
     * @param $query
     * @return void
     */
    function secureQuery($conn, $query)
    {
        foreach ($query as $key => $value){
            if(gettype($value) == "string")
            $query[$key] = mysqli_real_escape_string($conn,$value);
        }
    }

    /**
     * @return string
     */
    public function getglobalpath(){
        return $this->globalpath;
    }

}