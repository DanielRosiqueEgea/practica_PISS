<?php      
            function db_connect() {
                $server = "localhost";
                $user = "root";
                $pass = "";
                $db = "practica";
                $conn = new mysqli($server,$user,$pass,$db);
            
                if($conn->connect_error){
                    echo("ha habido un error al conectarse a la base de datos");
                }
                return $conn;
                }

                function peticionSQL($sql,$conn){
                    try{
                        $resultado =$conn->query($sql);
                        return $resultado;
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }

                    return FALSE;
                }
        ?>