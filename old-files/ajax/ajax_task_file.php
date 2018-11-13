<table id="dataTable" class="table table-bordered table-striped" style="width:100%;font-size: 12px">
    <thead style="background-color: grey">
        <tr>
            <th>No</th>                                                         
            <th>Filename</th>
            <th>File</th>
            <th>Action</th>                                        
        </tr>
    </thead>
    <tbody>                                            
        <?php 
            $taskID = $_POST["id"];            
        
            include '../config.php';
            
            $no = 1;

            $sql = "select * from task_file where task_id = '".$taskID."'";

            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){                  
        ?>
        <tr>
            <td width="5%"><?php echo $no; ?></td>
            <td><?php echo $row["task_file_name"]; ?></td>
            <td><?php echo $row["filename"]; ?></td>
            <td>
                <a target="_blank" href="media/task/<?php echo $row["filename"]; ?>" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>
                <a download href="media/task/<?php echo $row["filename"]; ?>" class="btn btn-primary btn-sm" title="View"><i class="fa fa-download"></i></a>
                <a class="btn btn-danger btn-sm" href='action/taskFileAction.php?action=delete&id=<?php echo $row["task_file_id"] ?>&project=<?php echo $_POST["projectID"]; ?>' onclick="return confirm('Are you sure to Delete this File ?')"><i class="fa fa-times"></i></a>
            </td>           
        </tr>
        <?php
                $no++;
            }
        ?>
    </tbody>
</table>
<hr />
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn btn-primary">
                    Add New File
                </a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">            
            <div class="panel-body">
                <form method="post" action="helper/uploadHelper.php" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">                    
                        <input type="hidden" class="form-control" name="action" id="action" value="uploadTaskFile">
                        <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?php echo $taskID ?>">
                        <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $_POST["projectID"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fileName">File Name</label>                                    
                        <input type="text" class="form-control" name="fileName" id="fileName" required>
                    </div>
                    <div class="form-group">
                        <label for="fileToUpload">File to Upload</label>    
                        <input type="file" name="fileToUpload"/>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Save New File</button>
                </form>
            </div>
        </div>
    </div>        
</div>
