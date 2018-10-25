<?php
    
    include 'lastInsertedDataHelper.php';
    
    function addTask(){
        include '../config.php';                                        
        
        $taskID = lastInsertedData('task_id', 'task');
        
        $sql = "INSERT INTO `task_history`
                (`action`,`detail`,`task_id`) 
                VALUES 
                ( 'Add','Added New Task','".$taskID."')";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    
    function editTask($dataOld, $dataNew, $taskID){
        include '../config.php';                       
        
        if($dataOld["task_status"] == 0) {
            $statusOld = "New";
        } elseif($dataOld["task_status"] == 1) {
            $statusOld = "In Progress";
        } elseif($dataOld["task_status"] == 2) {
            $statusOld = "Done";
        } elseif($dataOld["task_status"] == 3) {
            $statusOld = "Canceled";
        }
        
        $sqlPICOld = "select * from employee where employee_id = '".$dataOld["pic"]."'";                
        $resultPICOld = mysqli_query($conn, $sqlPICOld);
        $rowPICOld = mysqli_fetch_assoc($resultPICOld); 
        
        $detail = "Task Updated from : <br /> <br />
            Task Name : " . $dataOld["task_name"] . " <br />
            Due Date : " . $dataOld["due_date"] . " <br />
            Status : " . $statusOld . " <br />
            PIC : " . $rowPICOld["employee_name"] . " <br />
            Task Detail : " . $dataOld["task_detail"] . " <br /><br />";
        
        if($dataNew["task_status"] == 0) {
            $statusNew = "New";
        } elseif($dataNew["task_status"] == 1) {
            $statusNew = "In Progress";
        } elseif($dataNew["task_status"] == 2) {
            $statusNew = "Done";
        } elseif($dataNew["task_status"] == 3) {
            $statusNew = "Canceled";
        }
        
        $sqlPICNew = "select * from employee where employee_id = '".$dataNew["pic"]."'";                
        $resultPICNew = mysqli_query($conn, $sqlPICNew);
        $rowPICNew = mysqli_fetch_assoc($resultPICNew);
        
        $detail = $detail . " to : <br /><br />
            Task Name : " . $dataNew["task_name"] . " <br />
            Due Date : " . $dataNew["due_date"] . " <br />
            Status : " . $statusNew . " <br />
            PIC : " . $rowPICNew["employee_name"] . " <br />
            Task Detail : " . $dataNew["task_detail"] . "";
                       
        $sql = "INSERT INTO `task_history`
                (`action`,`detail`,`task_id`) 
                VALUES 
                ( 'Edit','".$detail."','".$taskID."')";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

?>
