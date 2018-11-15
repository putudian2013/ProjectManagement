<?php
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename=' . $filename . '.xls');
?>
<html xmlns:x="urn:schemas-microsoft-com:office:excel">
    <head>        
    </head>
    <body>
        <table>
            <tr>
                <td colspan="14"><?= $filename ?></td>               
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
                foreach ($task->result() as $row) :                                            
            ?>                                    
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->project_name ?></td>
                        <td><?= $row->task_code ?></td>
                        <td colspan="10"><?= $row->task_name ?></td>
                        <td><?= $row->due_date ?></td>
                    </tr>
            <?php
                    $no++;
                endforeach;                                        
            ?>

        </table>
    </body>
</html>