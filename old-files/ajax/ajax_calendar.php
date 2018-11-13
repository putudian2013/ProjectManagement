<?php
    include '../config.php';
    
    $taskID = explode("-", $_POST["id"])[0];
    $projectID = explode("-", $_POST["id"])[1];        
    
    $sqlTask = "select * from task t where t.task_id = '".$taskID."'";
    $resultTask = mysqli_query($conn, $sqlTask);
    $rowTask = mysqli_fetch_assoc($resultTask);
    
?>

<div class="form-group">
    <input type="hidden" class="form-control" name="action" id="action" value="edit">
    <input type="hidden" class="form-control" name="source" id="action" value="calendar">
    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $projectID ?>">
</div>
<div class="form-group">
    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?php echo $rowTask["task_id"] ?>">
</div>
<div class="form-group">
    <label for="taskCode">Task Code</label>                                    
    <input type="text" class="form-control" name="taskCode" id="taskCode" required readonly value="<?php echo $rowTask["task_code"] ?>">
</div> 
<div class="form-group">
    <label for="taskName">Task Name</label>
    <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Example : Fixing n/a Features" required value="<?php echo $rowTask["task_name"] ?>">
</div> 
<div class="form-group">
    <label>Due Date</label>                                           
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="dueDateEdit" name="dueDate" value="<?php echo $rowTask["due_date"] ?>">
    </div>
</div>
<div class="form-group" style="width: 100%;">
    <label>Status</label>         
    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
        <option value="0" <?php echo $rowTask["task_status"] == 0 ? "selected=selected" : "" ?>>New</option>
        <option value="1" <?php echo $rowTask["task_status"] == 1 ? "selected=selected" : "" ?>>In Progress</option>
        <option value="2" <?php echo $rowTask["task_status"] == 2 ? "selected=selected" : "" ?>>Done</option>
        <option value="3" <?php echo $rowTask["task_status"] == 3 ? "selected=selected" : "" ?>>Canceled</option>
    </select>                                     
</div>
<div class="form-group" style="width: 100%;">
    <label>PIC</label>         
    <select class="form-control select2"  id="pic" name="pic" style="width: 100%;">
        <option value="0">Select...</option>
        <?php
            $sql = "select * from employee order by employee_name";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <option value="<?php echo $row["employee_id"] ?>" <?php echo $rowTask["pic"] == $row["employee_id"] ? "selected=selected" : "" ?>><?php echo $row["employee_name"] ?></option>  
        <?php
            }
        ?>  
    </select>                                     
</div>
<div class="form-group">
    <label>Task Detail</label>
    <textarea class="form-control" rows="6" id="taskDetail" name="taskDetail" placeholder="Task Detail "><?php echo $rowTask["task_detail"] ?></textarea>
</div>