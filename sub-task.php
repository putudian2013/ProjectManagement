<!DOCTYPE html>
<?php 
    include 'config.php';    
    $taskID = $_GET["id"];
    
    $sql = "select * from task where task_id = '".$taskID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $taskCode = $row["task_code"];
    $taskName = $row["task_name"];
    $projectID = $row["project_id"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sub Task | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap.min.css">   
        <link rel="stylesheet" href="assets/select2/css/select2.min.css">
        <link rel="stylesheet" href="assets/bootstrap-daterangepicker/daterangepicker.css">
        
        <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">       
        <link rel="stylesheet" href="assets/dist/css/skins/skin-blue.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            
            <?php
                include_once 'include/header.php';
                include_once 'include/aside.php';
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Sub Task of <?php echo $taskCode ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                        <li>Sub Task</li>
                    </ol>
                </section>

                <section class="content container-fluid">
                    <!-- START CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    
                                </div>                                
                                
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <label for="taskName">Task Name</label>
                                        <input type="text" class="form-control" name="taskName" id="taskName" value="<?php echo $taskName ?>" required readonly>
                                    </div>
                                    
                                    <table id="dataTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Sub Task</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>PIC</th>                                                                                              
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            
                                                $no = 1;
                                                
                                                $sql = "SELECT st.*, e.`employee_name` AS 'emp_pic' FROM sub_task st
                                                    INNER JOIN employee e ON st.`pic` = e.`employee_id`
                                                    WHERE task_id = ".$taskID."
                                                    ORDER BY st.sub_task_code";                                                

                                                $result = mysqli_query($conn, $sql);

                                                while($row = mysqli_fetch_assoc($result)){  
                                                    
                                                    if($row["sub_task_status"] == 0) {
                                                        $status = "New";
                                                    } elseif($row["sub_task_status"] == 1) {
                                                        $status = "In Progress";
                                                    } elseif($row["sub_task_status"] == 2) {
                                                        $status = "Done";
                                                    } elseif($row["sub_task_status"] == 3) {
                                                        $status = "Canceled";
                                                    }
                                            ?>
                                            <tr>
                                                <td width="5%"><?php echo $no; ?></td>
                                                <td><?php echo $row["sub_task_code"]; ?></td>
                                                <td><?php echo $row["sub_task_name"]; ?></td>
                                                <td><?php echo $row["due_date"]; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td><?php echo $row["emp_pic"]; ?></td>                                                
                                                <td width="25%">                                                   
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editSubTask" 
                                                       data-id="<?php echo $row['sub_task_id'] ?>" 
                                                       data-code="<?php echo $row['sub_task_code'] ?>"
                                                       data-name="<?php echo $row['sub_task_name'] ?>"
                                                       data-due="<?php echo $row['due_date'] ?>"
                                                       data-status="<?php echo $row['sub_task_status'] ?>"
                                                       data-pic="<?php echo $row['pic'] ?>"
                                                       data-detail="<?php echo $row['sub_task_detail'] ?>"
                                                       > <i class="fa fa-pencil"></i> Edit 
                                                    </a>                                                       
                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteSubTask"
                                                       data-id="<?php echo $row['sub_task_id'] ?>" 
                                                       ><i class="fa fa-times"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                </div>                                
                                
                                <div class="box-footer">                                    
                                    <div class="btn-group pull-right">                                        
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSubTask" ><i class="fa fa-plus"></i> Add New Sub Task</a>
                                    </div>
                                    <a href="task.php?id=<?php echo $projectID ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Task List</a>
                                </div>                                 
                            </div>                            
                        </div>
                    </div>                    
                </section>
            </div>
            
            <!-- Modal Add -->
            <div class="modal fade" id="addSubTask" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Sub Task</h4>
                        </div>
                        <form action="action/subTaskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="add">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?php echo $taskID ?>">
                                </div>
                                <div class="form-group">
                                    <label for="subTaskCode">Sub Task Code</label>
                                    <?php
                                        
                                        $sql = "select * from task where task_id = ".$taskID."";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        
                                        $subTaskCode = $row["task_code"];
                                        
                                        $sql = "select * from sub_task where task_id = ".$taskID."";
                                        $result = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($result) + 1;                                                                               
                                        
                                        $subTaskCode = $subTaskCode . "." . $count;                                        
                                        
                                    ?>
                                    <input type="text" class="form-control" name="subTaskCode" id="subTaskCode" value="<?php echo $subTaskCode; ?>" required readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="subTaskName">Sub Task Name</label>
                                    <input type="text" class="form-control" name="subTaskName" id="subTaskName" placeholder="Example : Fixing n/a Features" required>
                                </div> 
                                <div class="form-group">
                                    <label>Due Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="dueDate" name="dueDate" value="">
                                    </div>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Status</label>         
                                    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
                                        <option value="0">New</option>
                                        <option value="1">In Progress</option>
                                        <option value="2">Done</option>
                                        <option value="3">Canceled</option>
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
                                                <option value="<?php echo $row["employee_id"] ?>"><?php echo $row["employee_name"] ?></option>  
                                        <?php
                                            }
                                        ?>  
                                    </select>                                     
                                </div>
                                <div class="form-group">
                                    <label>Sub Task Detail</label>
                                    <textarea class="form-control" rows="6" id="subTaskDetail" name="subTaskDetail" placeholder="Sub Task Detail "></textarea>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal Edit -->
            <div class="modal fade" id="editSubTask" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Sub Task</h4>
                        </div>
                        <form action="action/subTaskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="edit">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?php echo $taskID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="subTaskID" id="subTaskID">
                                </div>
                                <div class="form-group">
                                    <label for="subTaskCode">Sub Task Code</label>                                    
                                    <input type="text" class="form-control" name="subTaskCode" id="subTaskCode" required readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="subTaskName">Sub Task Name</label>
                                    <input type="text" class="form-control" name="subTaskName" id="subTaskName" placeholder="Example : Fixing n/a Features" required>
                                </div> 
                                <div class="form-group">
                                    <label>Due Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="dueDateEdit" name="dueDate">
                                    </div>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Status</label>         
                                    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
                                        <option value="0">New</option>
                                        <option value="1">In Progress</option>
                                        <option value="2">Done</option>
                                        <option value="3">Canceled</option>
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
                                                <option value="<?php echo $row["employee_id"] ?>"><?php echo $row["employee_name"] ?></option>  
                                        <?php
                                            }
                                        ?>  
                                    </select>                                     
                                </div>
                                <div class="form-group">
                                    <label>Sub Task Detail</label>
                                    <textarea class="form-control" rows="6" id="subTaskDetail" name="subTaskDetail" placeholder="Sub Task Detail "></textarea>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal Delete -->
            <div class="modal fade" id="deleteSubTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Task</h4>
                        </div>
                        <form action="action/subTaskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="delete">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?php echo $taskID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="subTaskID" id="subTaskID">
                                </div>
                                <h4>Are You Sure to Delete this Sub Task ?</h4>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php
                include_once 'include/footer.php';
            ?>

        </div>

        <script src="assets/jquery/dist/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>   
        <script src="assets/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/js/dataTables.bootstrap.min.js"></script>
        <script src="assets/select2/js/select2.full.min.js"></script>
        <script src="assets/moment/min/moment.min.js"></script>
        <script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>  
        
        <script src="assets/dist/js/adminlte.min.js"></script>
                       
        <script>
            $(function () {
                $('.select2').select2()
            })
        </script>
        <script>
            $(function(){
                $('#dueDate').daterangepicker({
                    singleDatePicker: true,                                                
                    showDropdowns : true,
                    drops : "down",
                    opens : 'right',                    
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                })                                
            })
        </script>        
        <script>
            $(function(){                
                $('#dueDateEdit').daterangepicker({
                    singleDatePicker: true,                                                
                    showDropdowns : true,
                    drops : "up",
                    opens : 'right',                    
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                })
            })
        </script>        
        <script>
            $(function () {                
                $('#dataTable').DataTable({
                    'paging'      : true,
                    'lengthChange': false,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                })                           
            })
        </script>                
        <script>
            $('.modal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
            });
        </script>
        <script>
            $('#editSubTask').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var subTaskID = button.data('id') 
                var subTaskName = button.data('name') 
                var dueDate = button.data('due') 
                var status = button.data('status') 
                var pic = button.data('pic')                 
                var detail = button.data('detail')                 
                var code = button.data('code')   
                               
                var modal = $(this)
                modal.find('#subTaskID').val(subTaskID)
                modal.find('#subTaskName').val(subTaskName)                
                modal.find('#dueDateEdit').val(dueDate)                    
                modal.find('#status').val(status).change()
                modal.find('#pic').val(pic).change()                                      
                modal.find('#subTaskDetail').val(detail)
                modal.find('#subTaskCode').val(code)
                
            })
        </script>
        <script>
            $('#deleteSubTask').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var subTaskID = button.data('id') 
                
                var modal = $(this)
                modal.find('#subTaskID').val(subTaskID)
                
            })
        </script>
        
    </body>
</html>