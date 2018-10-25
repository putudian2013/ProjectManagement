<?php

    include '../config.php';

    $action = $_GET['action'];
    $subTaskCode = $_GET['subTaskCode'];
    $subTaskName = $_GET['subTaskName'];
    $dueDate = $_GET['dueDate'];
    $status = $_GET['status'];
    $pic = $_GET['pic'];
    $subTaskDetail = $_GET['subTaskDetail'];
    $taskID = $_GET['taskID'];    
    $subTaskID = $_GET['subTaskID'];          
            
    if ($action == "add") {
        $sql = "INSERT INTO `sub_task`
                (`sub_task_id`,`sub_task_name`,`due_date`,`sub_task_status`,`pic`,`sub_task_code`,`task_id`,`sub_task_detail`) 
                VALUES 
                ( NULL,'" . $subTaskName . "','" . $dueDate . "','" . $status . "','" . $pic . "','" . $subTaskCode . "','" . $taskID . "','" . $subTaskDetail . "')";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../sub-task.php?id=".$taskID."");
        
    } elseif ($action == "edit") {
        $sql = "UPDATE `sub_task` SET             
            `sub_task_name`='".$subTaskName."',
            `due_date`='".$dueDate."',
            `sub_task_status`='".$status."',
            `pic`='".$pic."',
            `sub_task_code`='".$subTaskCode."',
            `task_id`='".$taskID."',
            `sub_task_detail`='".$subTaskDetail."'
            WHERE `sub_task_id`='".$subTaskID."'";       

        mysqli_query($conn, $sql);
        mysqli_close($conn);       
        header("location:../sub-task.php?id=".$taskID."");
        
    } elseif ($action == "delete") {
        $sql = "DELETE FROM `sub_task` WHERE `sub_task_id`='".$subTaskID."'";
echo $sql;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../sub-task.php?id=".$taskID."");
    }
    
?>
