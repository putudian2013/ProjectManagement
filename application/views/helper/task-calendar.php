<?php
    foreach ($task->result() as $row) :
        $taskCode = $row->task_code;
        $taskName = $row->task_name;
        $dueDate = $row->due_date;
        $status = $row->task_status;
        $pic = $row->pic;
        $taskDetail = $row->task_detail;     

    endforeach; 
?>

<div class="form-group">
    <label for="taskCode">Task Code</label>                                    
    <input type="text" class="form-control" name="taskCode" id="taskCode" required readonly value="<?= $taskCode ?>">
</div> 
<div class="form-group">
    <label for="taskName">Task Name</label>
    <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Example : Fixing n/a Features" required value="<?= $taskName ?>">
</div> 
<div class="form-group">
    <label>Due Date</label>                                           
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="dueDateEdit" name="dueDate" value="<?= $dueDate ?>">
    </div>
</div>
<div class="form-group" style="width: 100%;">
    <label>Status</label>         
    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
        <option value="0" <?= $status == 0 ? "selected=selected" : "" ?>>New</option>
        <option value="1" <?= $status == 1 ? "selected=selected" : "" ?>>In Progress</option>
        <option value="2" <?= $status == 2 ? "selected=selected" : "" ?>>Done</option>
        <option value="3" <?= $status == 3 ? "selected=selected" : "" ?>>Canceled</option>
    </select>                                     
</div>
<div class="form-group" style="width: 100%;">
    <label>PIC</label>         
    <select class="form-control select2"  id="pic" name="pic" style="width: 100%;">
        <option value="0">Select...</option>        
        <?php foreach ($employee->result() as $rowEmployee) : ?>                                                                                                
            <option value="<?= $rowEmployee->employee_id ?>" <?= $pic == $rowEmployee->employee_id ? "selected=selected" : "" ?>><?= $rowEmployee->employee_name ?></option>
        <?php endforeach; ?>
    </select>                                     
</div>
<div class="form-group">
    <label>Task Detail</label>
    <textarea class="form-control" rows="6" id="taskDetail" name="taskDetail" placeholder="Task Detail "><?= $taskDetail ?></textarea>
</div>
<div class="form-group">        
    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
</div>
<div class="form-group">
    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?= $taskID ?>">
</div>
