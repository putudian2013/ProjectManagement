<?php

    include '../config.php';
    include '../helper/historyHelper.php';

    $taskID = $_POST["id"];
    $sortable = $_POST["sortable"];
    
    if($sortable=="sortableNew"){
        $status = 0;
    } elseif($sortable=="sortableInProgress"){
        $status = 1;
    } elseif($sortable=="sortableDone"){
        $status = 2;
    } elseif($sortable=="sortableCancel"){
        $status = 3;
    }
    
    $sqlTaskOld = "select * from task where task_id = '".$taskID."'";                
    $resultTaskOld = mysqli_query($conn, $sqlTaskOld);
    $rowTaskOld = mysqli_fetch_assoc($resultTaskOld);
    
    $sql = "UPDATE `task` SET                        
            `task_status`='".$status."',            
            `created_date`=`created_date`
            WHERE `task_id`='".$taskID."'";                     

    mysqli_query($conn, $sql);
    
    if($status == 2){
        $sql = "UPDATE `task` SET
        `finish_date`= now()
        WHERE `task_id`='".$taskID."'";

         mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE `task` SET
        `finish_date`= null
        WHERE `task_id`='".$taskID."'";

         mysqli_query($conn, $sql);
    }
    
    $sqlTaskNew = "select * from task where task_id = '".$taskID."'";                
    $resultTaskNew = mysqli_query($conn, $sqlTaskNew);
    $rowTaskNew = mysqli_fetch_assoc($resultTaskNew);

    mysqli_close($conn); 
    
    editTask($rowTaskOld, $rowTaskNew, $taskID);
    
?>