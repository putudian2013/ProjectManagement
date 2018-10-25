<?php

    
    function lastInsertedData($pk, $table){
        include '../config.php';                        
                        
        $sql = "SELECT ".$pk." FROM ".$table." ORDER BY ".$pk." DESC LIMIT 0,1";
        
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        
        return $row[$pk];
    }

?>
