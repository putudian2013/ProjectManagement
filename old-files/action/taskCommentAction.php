<?php

    include '../config.php';
    
    $action = $_GET['action'];
    $commentDetail = $_GET['commentDetail'];    
    $taskID = $_GET['taskID'];         
    $commentID = $_GET['commentID'];         
            
    if ($action == "add") {                
        
        $sql = "INSERT INTO `task_comment`
                (`detail`,`task_id`) 
                VALUES 
                ('" . $commentDetail . "','" . $taskID . "')";

        mysqli_query($conn, $sql);
        mysqli_close($conn);        
        
        header("location:../task-comment.php?id=".$taskID."");
        
    } elseif ($action == "edit") {                    
                
        $sql = "UPDATE `task_comment` SET             
            `detail`='".$commentDetail."',
            `task_id`='".$taskID."',
            `created_date`=`created_date`
            WHERE `task_comment_id`='".$commentID."'";       

        mysqli_query($conn, $sql);                      
        mysqli_close($conn);                     
        
        header("location:../task-comment.php?id=".$taskID."");
        
    } elseif ($action == "delete") {
        $sql = "DELETE FROM `task_comment` WHERE `task_comment_id`='".$commentID."'";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../task-comment.php?id=".$taskID."");
    }
    
?>
