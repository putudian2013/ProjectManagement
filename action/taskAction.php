<?php
    error_reporting(0);
    
    include_once '../config.php';
    include '../helper/historyHelper.php';
    include '../lastInsertedDataHelper.php';    
    
    $action = !isset($_GET['action']) ? $_POST['action'] : $_GET['action'];    
    $source = $_GET['source'];
    $taskCode = $_GET['taskCode'];
    $taskName = $_GET['taskName'];
    $dueDate = $_GET['dueDate'];
    $status = $_GET['status'];
    $pic = $_GET['pic'];
    $taskDetail = $_GET['taskDetail'];
    $projectID = !isset($_GET['projectID']) ? $_POST['projectID'] : $_GET['projectID']; 
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
            if($source == "board"){
                header("location:../task-board.php?id=".$projectID."");
            } elseif($source == "calendar") {
                header("location:../calendar.php");
            }            
        }
        
    } elseif ($action == "delete") {
        $sql = "DELETE FROM `task` WHERE `task_id`='".$taskID."'";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location:../task.php?id=".$projectID."");
        
    } elseif ($action == "import") {
                        
        require_once('../helper/importExcel/excel_reader2.php');
        require_once('../helper/importExcel/SpreadsheetReader.php');

        $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];        ;
        
            if (in_array($_FILES["fileToUpload"]["type"], $allowedFileType)) {

                $targetPath = '../media/import/' . $_FILES['fileToUpload']['name'];                
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath);
                
                $Reader = new SpreadsheetReader($targetPath);

                $sheetCount = count($Reader->sheets());
                for ($i = 0; $i < $sheetCount; $i++) {

                    $Reader->ChangeSheet($i);

                    foreach ($Reader as $Row) {
                        
                        
                        // Ini mulai baca kolom
                        
                        //(`task_id`,`task_name`,`due_date`,`task_status`,`pic`,`task_code`,`project_id`,`task_detail`) 
                        
                        $taskName = "";
                        $dueDate = "";                        
                        $pic = "";                                                
                        $taskDetail = "";
                        
                        if (isset($Row[0])) {
                            $taskName = mysqli_real_escape_string($conn, $Row[0]);
                        }
                        if (isset($Row[1])) {
                            $dueDate = mysqli_real_escape_string($conn, $Row[3]);     
                        }                        
                        if (isset($Row[2])) {
                            $pic = mysqli_real_escape_string($conn, $Row[2]);     
                            $sql = "select * from employee where employee_name = '" . $pic . "'";                              
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);                             
                            $pic = $row["employee_id"];  
                        }                                                
                        if (isset($Row[3])) {
                            $taskDetail = mysqli_real_escape_string($conn, $Row[1]);
                        }                                                                             

                        if (!empty($taskName) || !empty($dueDate) || !empty($pic) || !empty($taskDetail)) {
                            
                            if($taskName!="Task Name" && $dueDate!="Due Date" && $taskStatus!="Task Status" && $pic!="PIC" && $taskCode!="Task Code" && $projectID!="Project" && $taskDetail!="Task Detail" ){
                                
                                $sql = "select * from project where project_id = " . $projectID . "";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $taskCode = $row["project_code"];


                                $sql = "select * from task where project_id = " . $projectID . "";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result) + 1;

                                if (strlen($count) == 1) {
                                    $count = "00" . $count;
                                } elseif (strlen($count) == 2) {
                                    $count = "0" . $count;
                                } else {
                                    $count = $count;
                                }

                                $taskCode = $taskCode . "-" . $count;                                                                                                                         
                                
                                $query = "INSERT INTO `task`
                                    (`task_id`,`task_name`,`due_date`,`task_status`,`pic`,`task_code`,`project_id`,`task_detail`) 
                                    VALUES 
                                    ( NULL,'" . $taskName . "','" . $dueDate . "', '0','" . $pic . "','" . $taskCode . "','" . $projectID . "','" . $taskDetail . "')";
                                echo $query;
                                echo "<br />";
                                $result = mysqli_query($conn, $query);
                                
                            }
                                                       
                            if (!empty($result)) {
                                $type = "success";
                                $message = "Excel Data Imported into the Database";
                                echo "<br />";
                            } else {
                                $type = "error";
                                $message = "Problem in Importing Excel Data";
                                echo $message;
                                echo "<br />";
                            }
                        }
                    }
                }
            } else {
                $type = "error";
                $message = "Invalid File Type. Upload Excel File.";
                echo $message;
            }
        
        
        header("location:../task.php?id=".$projectID."&import=1");
        
    }
    
?>
