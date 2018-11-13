<table id="dataTable" class="table table-bordered table-striped" style="width:100%;font-size: 12px">
    <thead style="background-color: grey">
        <tr>
            <th>No</th>
            <th>Date</th>                                                
            <th>Action</th>                                        
            <th>Detail</th>                                        
        </tr>
    </thead>
    <tbody>                                            
        <?php 
            $taskID = $_POST["id"];
        
            include '../config.php';
            
            $no = 1;

            $sql = "select * from task_history where task_id = '".$taskID."'";

            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){                  
        ?>
        <tr>
            <td width="5%"><?php echo $no; ?></td>
            <td><?php echo $row["created_date"]; ?></td>
            <td><?php echo $row["action"]; ?></td>
            <td><?php echo $row["detail"]; ?></td>           
        </tr>
        <?php
                $no++;
            }
        ?>
    </tbody>
</table>
