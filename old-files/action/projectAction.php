<?php

    include '../config.php';

    $action = $_GET['action'];
    $projectID = $_GET['projectID'];
    $projectName = $_GET['projectName'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $projectOwner = $_GET['projectOwner'];
    $projectCode = $_GET['projectCode'];
    $projectStatus = $_GET['status'];
    $projectColor = $_GET['projectColor'];
    
    if ($action == "add") {
        $sql = "INSERT INTO `project`
                (`project_id`,`project_name`,`start_date`,`end_date`,`project_owner`,`project_code`,`project_status`,`project_color`) 
                VALUES 
                ( NULL,'" . $projectName . "','" . $startDate . "','" . $endDate . "','" . $projectOwner . "','" . $projectCode . "','" . $projectStatus . "','" . $projectColor . "')";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../project.php");
        
    } elseif ($action == "edit") {
        $sql = "UPDATE `project` SET             
            `project_name`='".$projectName."',
            `start_date`='".$startDate."',
            `end_date`='".$endDate."',
            `project_owner`='".$projectOwner."',
            `project_code`='".$projectCode."',
            `project_status`='".$projectStatus."',
            `project_color`='".$projectColor."'
            WHERE `project_id`='".$projectID."'";       

        mysqli_query($conn, $sql);
        mysqli_close($conn);       
        header("location:../project.php");
        
    } elseif ($action == "delete") {
        $sql = "DELETE FROM `project` WHERE `project_id`='".$projectID."'";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../project.php");
    }
    
?>
