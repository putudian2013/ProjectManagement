<?php 
    error_reporting(0);
    
    include_once 'config.php';    
    $type = $_GET["type"];
    
    header('Content-type: application/excel');
    
    $filename = "";
    if($type == 'outstanding') {        
        $filename = 'List of Outstanding Task.xls';
    } elseif($type == 'tomorrow') {    
        $filename = 'List of Task Due Tomorrow.xls';
    } elseif($type == 'today') {
        $filename = 'List of Task Due Today.xls';
    }
    
    $filename = 'List of Task Due Today.xls';
    header('Content-Disposition: attachment; filename=' . $filename);
?>
<?php        
    if($type == 'outstanding') {
        $sql = "select * from task t 
            inner join project p on t.project_id = p.project_id
            where t.task_status in ('0','1') and t.due_date < date_format(now(), '%Y-%m-%d')";    
    } elseif($type == 'tomorrow') {
        $sql = "select * from task t 
            inner join project p on t.project_id = p.project_id
            where t.task_status in ('0','1') and t.due_date = date_format(now() + interval 1 day, '%Y-%m-%d')";    
    } elseif($type == 'today') {
        $sql = "select * from task t 
            inner join project p on t.project_id = p.project_id
            where t.task_status in ('0','1') and t.due_date = date_format(now(), '%Y-%m-%d')";    
    } 
    $result = mysqli_query($conn, $sql);    
?>


<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<!--<html>-->
    <head>        
    </head>
    <body>
        <table>
            <tr>
                <?php 
                    if($type == 'outstanding') {
                ?>
                        <td colspan="14">List of Outstanding Task</td>
                <?php
                    } elseif($type == 'tomorrow') {
                ?>
                        <td colspan="14">List of Task Due Tomorrow</td>
                <?php
                    } elseif($type == 'today') {
                ?>
                        <td colspan="14">List of Task Due Today</td>
                <?php  
                    }
                ?>                
            </tr>
            <tr>
                
            </tr>
        </table>
        <table border="1">
            <tr>
                <td style="background: gray">No</td>
                <td style="background: gray">Project</td>
                <td style="background: gray">Task Code</td>
                <td colspan="10" style="background: gray">Task Name</td>
                <td style="background: gray">Due Date</td>
            </tr>
            <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($result)){
            ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row["project_name"] ?></td>
                        <td><?php echo $row["task_code"] ?></td>
                        <td colspan="10"><?php echo $row["task_name"] ?></td>
                        <td><?php echo $row["due_date"] ?></td>
                    </tr>
            <?php
                    $no++;
                }
            ?>
            
        </table>
    </body>
</html>