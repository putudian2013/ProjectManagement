<!DOCTYPE html>
<?php 
    include 'config.php';    
    $projectID = $_GET["id"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/datatables/css/buttons.bootstrap.min.css">                                
        
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
        <style>
            .btn-group{
                display: block;
            }
        </style>
    </head>    
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
            
            <?php
                include_once 'include/header.php';
                include_once 'include/aside.php';
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Task
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                    </ol>
                </section>

                <section class="content container-fluid">
                    <!-- START CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">       
                                    <a href="task-board.php?id=<?php echo $projectID ?>" class="btn btn-primary" >Board View</a>
<!--                                    <a href="task-gantt.php?id=<?php echo $projectID ?>" class="btn btn-primary" >Gantt Chart</a>-->
                                </div>                                
                                
                                <div class="box-body">
                                    
                                    <table id="dataTable" class="table table-bordered table-striped" style="font-size: 12px">
                                        <thead style="background-color: grey">
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>                                                
                                                <th>Task</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>PIC</th>
                                                <th>Sub Task</th>
                                                <th>Finish Date</th>
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            
                                                $no = 1;
                                                
                                                $sql = "select t.*, e.`employee_name` as 'emp_pic'
                                                    from task t
                                                    inner join employee e on t.`pic` = e.`employee_id`                                                    
                                                    where project_id = ".$projectID."
                                                    order by t.task_status asc, t.task_code asc";

                                                $result = mysqli_query($conn, $sql);

                                                while($row = mysqli_fetch_assoc($result)){  
                                                    
                                                    if($row["task_status"] == 0) {
                                                        $status = "New";
                                                    } elseif($row["task_status"] == 1) {
                                                        $status = "In Progress";
                                                    } elseif($row["task_status"] == 2) {
                                                        $status = "Done";
                                                    } elseif($row["task_status"] == 3) {
                                                        $status = "Canceled";
                                                    }
                                            ?>
                                            <tr>
                                                <td width="5%"><?php echo $no; ?></td>
                                                <td><?php echo $row["task_code"]; ?></td>
                                                <td><?php echo $row["task_name"]; ?></td>
                                                <td><?php echo $row["due_date"]; ?></td>
                                                <td style="background-color: <?php echo $row["task_status"] == 2 ? 'greenyellow' : '' ?>"><?php echo $status; ?></td>
                                                <td><?php echo $row["emp_pic"]; ?></td>                                                
                                                <td>
                                                    <?php 
                                                        $sqlSubTask = "select * from sub_task where task_id = '".$row['task_id']."'";
                                                        $resultSubTask = mysqli_query($conn, $sqlSubTask);                                                       
                                                        $count = mysqli_num_rows($resultSubTask);
                                                        
                                                        echo $count;
                                                    ?>
                                                </td>
                                                <td><?php echo $row["finish_date"] == "" ? "-" : $row["finish_date"] ?></td>
                                                <td width="20%">                                                   
                                                    <a href="#" class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?php echo $row['task_id'] ?>" 
                                                       data-code="<?php echo $row['task_code'] ?>"
                                                       data-name="<?php echo $row['task_name'] ?>"
                                                       data-due="<?php echo $row['due_date'] ?>"
                                                       data-status="<?php echo $row['task_status'] ?>"
                                                       data-pic="<?php echo $row['pic'] ?>"
                                                       data-detail="<?php echo $row['task_detail'] ?>"
                                                       > <i class="fa fa-pencil"></i> 
                                                    </a>  
                                                    <a href="sub-task.php?id=<?php echo $row['task_id'] ?>" title="Sub Task" class="btn btn-warning btn-sm"> 
                                                        <i class="fa fa-tasks"></i> 
                                                    </a>                                                                                                                                                                                                                 
                                                    <a href="task-comment.php?id=<?php echo $row['task_id'] ?>" class="btn btn-success btn-sm" title="Comment"><i class="fa fa-comment"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-sm button-upload" title="Upload File"
                                                       data-id="<?php echo $row['task_id'] ?>" 
                                                       ><i class="fa fa-upload"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-primary btn-sm button-history" title="History"
                                                       data-id="<?php echo $row['task_id'] ?>" 
                                                       ><i class="fa fa-history"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteTask"
                                                       data-id="<?php echo $row['task_id'] ?>" 
                                                       ><i class="fa fa-times"></i> 
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
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTask" ><i class="fa fa-plus"></i> Add New Task</a>
                                    </div>
                                    <a href="project.php" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Project List</a>
                                </div>                                 
                            </div>                            
                        </div>
                    </div>                    
                </section>
            </div>
            
            <!-- Modal Add -->
            <div class="modal fade" id="addTask" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Task</h4>
                        </div>
                        <form action="action/taskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="add">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <label for="taskCode">Task Code</label>
                                    <?php
                                        
                                        $sql = "select * from project where project_id = ".$projectID."";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        
                                        $taskCode = $row["project_code"];
                                        
                                        $sql = "select * from task where project_id = ".$projectID."";
                                        $result = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($result) + 1;
                                        
                                        if(strlen($count)==1){
                                            $count = "00" . $count;
                                        } elseif (strlen($count)==2) {
                                            $count = "0" . $count;
                                        } else {
                                            $count = $count;
                                        }
                                        
                                        $taskCode = $taskCode . "-" . $count;
                                        
                                    ?>
                                    <input type="text" class="form-control" name="taskCode" id="taskCode" value="<?php echo $taskCode; ?>" required readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="taskName">Task Name</label>
                                    <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Example : Fixing n/a Features" required>
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
                                    <label>Task Detail</label>
                                    <textarea class="form-control" rows="6" id="taskDetail" name="taskDetail" placeholder="Task Detail "></textarea>
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
            <div class="modal fade" id="editTask" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
                        </div>
                        <form action="action/taskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="edit">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID">
                                </div>
                                <div class="form-group">
                                    <label for="taskCode">Task Code</label>                                    
                                    <input type="text" class="form-control" name="taskCode" id="taskCode" required readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="taskName">Task Name</label>
                                    <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Example : Fixing n/a Features" required>
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
                                    <label>Task Detail</label>
                                    <textarea class="form-control" rows="6" id="taskDetail" name="taskDetail" placeholder="Task Detail "></textarea>
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
            <div class="modal fade" id="deleteTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Task</h4>
                        </div>
                        <form action="action/taskAction.php" method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="delete">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID">
                                </div>
                                <h4>Are You Sure to Delete this Task ?</h4>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal History -->
            <div class="modal fade" id="historyTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Task History</h4>
                        </div>                        
                        <div class="modal-body body-history">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                        </div>                        
                    </div>
                </div>
            </div>
            
            <!-- Modal Upload -->
            <div class="modal fade" id="uploadTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Task File</h4>
                        </div>                         
                        <div class="modal-body body-upload">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                                
                        </div>
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
        <script src="assets/datatables/js/dataTables.buttons.min.js"></script>  
        <script src="assets/datatables/js/buttons.bootstrap.min.js"></script>  
        <script src="assets/datatables/js/jszip.min.js"></script>  
        <script src="assets/datatables/js/pdfmake.min.js"></script>  
        <script src="assets/datatables/js/vfs_fonts.js"></script>  
        <script src="assets/datatables/js/buttons.html5.min.js"></script>  
        <script src="assets/datatables/js/buttons.print.min.js"></script>  
        <script src="assets/datatables/js/buttons.colVis.min.js"></script>                        
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
            $(document).ready(function() {                
                var m = moment().format("DD MMM YYYY hh:mm:ss");
                var table = $('#dataTable').DataTable( {         
                    dom: 'Bfrtp',
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Excel',                            
                            title: 'List of All Task',                            
                            orientation: 'landscape',
                            pageSize: 'A4',                               
                            customize: function( xlsx ) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c', sheet).attr('s', '25');
                                $('row:first c', sheet).attr('s', '2');                                
                            },
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: 'PDF',                            
                            title: 'List of All Task',                            
                            orientation: 'landscape',
                            pageSize: 'A4',  
                            customize: function (doc) {
                                doc.pageMargins = [30,20,30,40];
                                doc.defaultStyle.fontSize = 8;
                                doc.styles.tableHeader.fontSize = 8;
                                doc.styles.tableHeader.align = "center";                                
                                doc['footer']=(function(page, pages) {
                                    return {
                                        columns: [
                                            {
                                                alignment: 'left',
                                                text: ['Created on: ', { text: m.toString() }]
                                            },
                                            {
                                                alignment: 'right',
                                                text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
                                            }
                                        ],
                                        margin: 20
                                    }
                                });                                
                            },
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            autoPrint: true,
                            title: 'List of All Task',
                            messageBottom: "<br /><p align='right'><i>Printed on : " + m + "</i></p>",
                            orientation: 'landscape',
                            pageSize: 'A4',
                            customize: function(win) {                                
                                var last = null;
                                var current = null;
                                var bod = [];
                                
                                var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');
                                
                                style.type = 'text/css';
                                style.media = 'print';
                                
                                if (style.styleSheet)
                                {
                                    style.styleSheet.cssText = css;
                                }
                                else
                                {
                                    style.appendChild(win.document.createTextNode(css));
                                }
                                
                                head.appendChild(style);                                                                
                                                                
                                
                            },
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ],
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,
                    columnDefs: [
                        { width: '100%', targets: 0 }
                    ],
                    fixedColumns: true,                    
                    'paging'      : false,
                    'lengthChange': false,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                } );                                
            } );                     
        </script>                
        <script>
            $('.modal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
            });
        </script>
        <script>
            $('#editTask').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var taskID = button.data('id') 
                var taskName = button.data('name') 
                var dueDate = button.data('due') 
                var status = button.data('status') 
                var pic = button.data('pic')                 
                var detail = button.data('detail')                 
                var code = button.data('code')   
                               
                var modal = $(this)
                modal.find('#taskID').val(taskID)
                modal.find('#taskName').val(taskName)                
                modal.find('#dueDateEdit').val(dueDate)                    
                modal.find('#status').val(status).change()
                modal.find('#pic').val(pic).change()                                      
                modal.find('#taskDetail').val(detail)
                modal.find('#taskCode').val(code)
                
            })
        </script>
        <script>
            $('#deleteTask').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var taskID = button.data('id') 
                
                var modal = $(this)
                modal.find('#taskID').val(taskID)
                
            })
        </script>
        <script>            
           $(".button-history").click(function(){
               var id = $(this).data('id');
                
                $("#historyTask").modal();                    
                
                $.post("ajax/ajax_task_history.php",
                {
                    id: id                        
                },
                function(data){
                    $(".body-history").html(data);
                });
            }); 
        </script>
        <script>            
           $(".button-upload").click(function(){
                var id = $(this).data('id');
                
                $("#uploadTask").modal();                    
                
                $.post("ajax/ajax_task_file.php",
                {
                    id: id,
                    projectID: <?php echo $projectID ?>
                },
                function(data){
                    $(".body-upload").html(data);
                });
            }); 
        </script>
    </body>
</html>