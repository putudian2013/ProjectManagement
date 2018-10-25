<?php

    include '../config.php';
    include '../helper/historyHelper.php';

    $taskID = explode("-", $_POST["id"])[0];  
    $dueDate = $_POST["due"];
    
    
    
    $sqlTaskOld = "select * from task where task_id = '".$taskID."'";                
    $resultTaskOld = mysqli_query($conn, $sqlTaskOld);
    $rowTaskOld = mysqli_fetch_assoc($resultTaskOld);
    
    $sql = "UPDATE `task` SET                        
            `due_date`='".$dueDate."',            
            `created_date`=`created_date`
            WHERE `task_id`='".$taskID."'"; 
    
    echo $sql;

    mysqli_query($conn, $sql);        
    
    $sqlTaskNew = "select * from task where task_id = '".$taskID."'";                
    $resultTaskNew = mysqli_query($conn, $sqlTaskNew);
    $rowTaskNew = mysqli_fetch_assoc($resultTaskNew);

    mysqli_close($conn); 
    
    editTask($rowTaskOld, $rowTaskNew, $taskID);
    
?>