<?php

class Main
{
    protected $conn;
    protected $globalpath = "/Projekt1";


    public function __construct()
    {
        require __DIR__ . "/../config/db_connect.php";
        $this->conn = $conn;
    }

    public function loadDataWithParameters($query, $types, $data)
    {
        return $this->p_loadDataWithParameters($query,$types,$data);
    }

    public function loadData($query)
    {
        return $this->p_loadData($query);
    }

    public function executeQuery($query,$types,$data)
    {
        $this->p_executeQuery($query,$types,$data);
    }

    private function p_executeQuery($query, $types, $data)
    {
        $this->secureQuery($this->conn,$data);
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/index.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt,$types,...$data);
            $result = mysqli_stmt_execute($stmt);

            if(!$result){
                header("Location: $this->globalpath/index.php?error=sqlerror");
                exit();
            }

        }
    }

    private function p_loadDataWithParameters($query, $types, $data)
    {
        $this->secureQuery($this->conn,$data);
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            //TODO - SetPathForMassage
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

    private function p_loadData($query)
    {
        $stmt = mysqli_stmt_init($this->conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: $this->globalpath/index.php?error=sqlerror");
            exit();

        } else {
            $result = mysqli_stmt_execute($stmt);

            if($result){
                return mysqli_stmt_get_result($stmt);

            }else{
                header("Location: $this->globalpath/index.php?error=sqlerror");
                exit();
            }

        }
    }

    function secureQuery($conn, $query)
    {
        foreach ($query as $key => $value){
            if(gettype($value) == "string")
            $query[$key] = mysqli_real_escape_string($conn,$value);
        }
    }

    public function getglobalpath(){
        return $this->globalpath;
    }

    public function getJSON($array){
        return json_encode($array,JSON_PRETTY_PRINT);
    }
}