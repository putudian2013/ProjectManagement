<?php

    include '../config.php';
    include '../helper/historyHelper.php';
    include '../lastInsertedDataHelper.php';    
    
    $action = $_GET['action'];
    $source = $_GET['source'];
    $taskCode = $_GET['taskCode'];
    $taskName = $_GET['taskName'];
    $dueDate = $_GET['dueDate'];
    $status = $_GET['status'];
    $pic = $_GET['pic'];
    $taskDetail = $_GET['taskDetail'];
    $projectID = $_GET['projectID'];
    $taskID = $_GET['taskID'];         
            
    if ($action == "add") {                
        
        $sql = "INSERT INTO `task`
                (`task_id`,`task_name`,`due_date`,`task_status`,`pic`,`task_code`,`project_id`,`task_detail`) 
                VALUES 
                ( NULL,'" . $taskName . "','" . $dueDate . "','" . $status . "','" . $pic . "','" . $taskCode . "','" . $projectID . "','" . $taskDetail . "')";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        
        addTask();
        
        header("location:../task.php?id=".$projectID."");
        
        
    } elseif ($action == "edit") {
        
        $sqlTaskOld = "select * from task where task_id = '".$taskID."'";                
        $resultTaskOld = mysqli_query($conn, $sqlTaskOld);
        $rowTaskOld = mysqli_fetch_assoc($resultTaskOld);                
                
        $sql = "UPDATE `task` SET             
            `task_name`='".$taskName."',
            `due_date`='".$dueDate."',
            `task_status`='".$status."',
            `pic`='".$pic."',
            `task_code`='".$taskCode."',
            `project_id`='".$projectID."',
            `task_detail`='".$taskDetail."',
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
        
        if(!isset($source)){
            header("location:../task.php?id=".$projectID."");
        } else {
            header("location:../task-board.php?id=".$projectID."");
        }
        
    } elseif ($action == "delete") {
        $sql = "DELETE FROM `task` WHERE `task_id`='".$taskID."'";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../task.php?id=".$projectID."");
        
    }
    
?>
