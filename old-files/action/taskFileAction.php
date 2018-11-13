<?php

    include '../config.php';
    
    $action = $_GET['action'];    
    $taskFileID = $_GET['id'];
    $projectID = $_GET['project'];
            
    if ($action == "delete") {
        $sql = "DELETE FROM `task_file` WHERE `task_file_id`='".$taskFileID."'";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../task.php?id=".$projectID."");
    }
    
?>
