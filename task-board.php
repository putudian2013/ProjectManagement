<!DOCTYPE html>
<?php 
    include 'config.php';    
    $projectID = $_GET["id"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task Board | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">    
        <link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css">
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
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
            
            <?php
                include_once 'include/header.php';
                include_once 'include/aside.php';
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Task Board
                        <a href="task.php?id=<?php echo $projectID ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Table View</a>
                    </h1>                    
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                        <li>Board</li>                        
                    </ol>
                </section>

                <section class="content container-fluid">
                    <!-- START CONTENT -->
                    <?php
                        $sqlTaskNew = "select * from task where project_id = '".$projectID."' and task_status = 0";
                        $resultTaskNew = mysqli_query($conn, $sqlTaskNew);
                        
                        $sqlTaskInProgress = "select * from task where project_id = '".$projectID."' and task_status = 1";
                        $resultTaskInProgress = mysqli_query($conn, $sqlTaskInProgress);
                        
                        $sqlTaskDone = "select * from task where project_id = '".$projectID."' and task_status = 2";
                        $resultTaskDone = mysqli_query($conn, $sqlTaskDone);
                        
                        $sqlTaskCancel = "select * from task where project_id = '".$projectID."' and task_status = 3";
                        $resultTaskCancel = mysqli_query($conn, $sqlTaskCancel);
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="btn-primary" style="height: 40px;"><center><p style="padding:10px">NEW (<?php echo mysqli_num_rows($resultTaskNew); ?>)</p></center></h4>                            
                            <div class="box box-primary">                                                                                                
                                <div class="box-body">                                     
                                    <ul id = "sortableNew" style="list-style-type: none; padding-left:0px;">
                                        <?php 
                                            if(mysqli_num_rows($resultTaskNew)==0){
                                        ?>
                                        <br />
                                        <?php
                                            }
                                        ?>
                                        <?php                                            
                                            while($rowTaskNew = mysqli_fetch_assoc($resultTaskNew)){
                                        ?>
                                        <li class="default" data-id="<?php echo $rowTaskNew['task_id'] ?>">
                                            <div class="box box-primary">                                                
                                                <div class="box-body">                                                                                                                            
                                                    <a href="#" style="color: black" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?php echo $rowTaskNew['task_id'] ?>" 
                                                       data-code="<?php echo $rowTaskNew['task_code'] ?>"
                                                       data-name="<?php echo $rowTaskNew['task_name'] ?>"
                                                       data-due="<?php echo $rowTaskNew['due_date'] ?>"
                                                       data-status="<?php echo $rowTaskNew['task_status'] ?>"
                                                       data-pic="<?php echo $rowTaskNew['pic'] ?>"
                                                       data-detail="<?php echo $rowTaskNew['task_detail'] ?>"
                                                       > <p style="text-align: center"><?php echo $rowTaskNew["task_code"] . " : " . $rowTaskNew["task_name"]; ?></p> 
                                                    </a> 
                                                </div>                                                                                                                    
                                            </div>
                                        </li>
                                        <?php
                                            }
                                        ?>                                                                                                                                                                
                                    </ul>                                                                        
                                </div>                                                                                                 
                            </div>                            
                        </div>
                        
                        <div class="col-md-3">
                            <h4 class="btn-warning" style="height: 40px;"><center><p style="padding:10px">IN PROGRESS (<?php echo mysqli_num_rows($resultTaskInProgress); ?>)</p></center></h4>
                            
                            <div class="box box-warning">                                                                                                
                                <div class="box-body">                                     
                                    <ul id = "sortableInProgress" style="list-style-type: none; padding-left:0px;">
                                        <?php 
                                            if(mysqli_num_rows($resultTaskInProgress)==0){
                                        ?>
                                        <br />
                                        <?php
                                            }
                                        ?>
                                        <?php                                            
                                            while($rowTaskInProgress = mysqli_fetch_assoc($resultTaskInProgress)){
                                        ?>
                                        <li class="default" data-id="<?php echo $rowTaskInProgress['task_id'] ?>" >
                                            <div class="box box-warning">                                                
                                                <div class="box-body">                                                                                                                            
                                                    <a href="#" style="color: black" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?php echo $rowTaskInProgress['task_id'] ?>" 
                                                       data-code="<?php echo $rowTaskInProgress['task_code'] ?>"
                                                       data-name="<?php echo $rowTaskInProgress['task_name'] ?>"
                                                       data-due="<?php echo $rowTaskInProgress['due_date'] ?>"
                                                       data-status="<?php echo $rowTaskInProgress['task_status'] ?>"
                                                       data-pic="<?php echo $rowTaskInProgress['pic'] ?>"
                                                       data-detail="<?php echo $rowTaskInProgress['task_detail'] ?>"
                                                       > <p style="text-align: center"><?php echo $rowTaskInProgress["task_code"] . " : " . $rowTaskInProgress["task_name"]; ?></p>
                                                    </a>
                                                </div>                                                                                                                    
                                            </div>
                                        </li>
                                        <?php
                                            }
                                        ?> 
                                    </ul>                                                                       
                                </div>                                                                                                 
                            </div>                            
                        </div>
                        
                        <div class="col-md-3">
                            <h4 class="btn-success" style="height: 40px;"><center><p style="padding:10px">DONE (<?php echo mysqli_num_rows($resultTaskDone); ?>)</p></center></h4>
                            
                            <div class="box box-success">                                                                                                
                                <div class="box-body">                                     
                                    <ul id = "sortableDone" style="list-style-type: none; padding-left:0px;">
                                        <?php 
                                            if(mysqli_num_rows($resultTaskDone)==0){
                                        ?>
                                        <br />
                                        <?php
                                            }
                                        ?>
                                        <?php                                            
                                            while($rowTaskDone = mysqli_fetch_assoc($resultTaskDone)){
                                        ?>
                                        <li class="default" data-id="<?php echo $rowTaskDone['task_id'] ?>" >
                                            <div class="box box-success">                                                
                                                <div class="box-body">                                                                                                                            
                                                    <a href="#" style="color: black" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?php echo $rowTaskDone['task_id'] ?>" 
                                                       data-code="<?php echo $rowTaskDone['task_code'] ?>"
                                                       data-name="<?php echo $rowTaskDone['task_name'] ?>"
                                                       data-due="<?php echo $rowTaskDone['due_date'] ?>"
                                                       data-status="<?php echo $rowTaskDone['task_status'] ?>"
                                                       data-pic="<?php echo $rowTaskDone['pic'] ?>"
                                                       data-detail="<?php echo $rowTaskDone['task_detail'] ?>"
                                                       > <p style="text-align: center"><?php echo $rowTaskDone["task_code"] . " : " . $rowTaskDone["task_name"]; ?></p>
                                                    </a>
                                                </div>                                                                                                                    
                                            </div>
                                        </li>
                                        <?php
                                            }
                                        ?>                                       
                                    </ul>                                                                       
                                </div>                                                                                                 
                            </div>                            
                        </div>
                        
                        <div class="col-md-3">
                            <h4 class="btn-danger" style="height: 40px;"><center><p style="padding:10px">CANCELED (<?php echo mysqli_num_rows($resultTaskCancel); ?>)</p></center></h4>
                            
                            <div class="box box-danger">                                                                                                
                                <div class="box-body">                                     
                                    <ul id = "sortableCancel" style="list-style-type: none; padding-left:inherit;">
                                        <?php 
                                            if(mysqli_num_rows($resultTaskCancel)==0){
                                        ?>
                                        <br />
                                        <?php
                                            }
                                        ?>
                                        <?php                                            
                                            while($rowTaskCancel = mysqli_fetch_assoc($resultTaskCancel)){
                                        ?>
                                        <li class="default" data-id="<?php echo $rowTaskCancel['task_id'] ?>" >
                                            <div class="box box-danger">                                                
                                                <div class="box-body">                                                                                                                            
                                                    <a href="#" style="color: black" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?php echo $rowTaskCancel['task_id'] ?>" 
                                                       data-code="<?php echo $rowTaskCancel['task_code'] ?>"
                                                       data-name="<?php echo $rowTaskCancel['task_name'] ?>"
                                                       data-due="<?php echo $rowTaskCancel['due_date'] ?>"
                                                       data-status="<?php echo $rowTaskCancel['task_status'] ?>"
                                                       data-pic="<?php echo $rowTaskCancel['pic'] ?>"
                                                       data-detail="<?php echo $rowTaskCancel['task_detail'] ?>"
                                                       > <p style="text-align: center"><?php echo $rowTaskCancel["task_code"] . " : " . $rowTaskCancel["task_name"]; ?></p>
                                                    </a>
                                                </div>                                                                                                                    
                                            </div>
                                        </li>
                                        <?php
                                            }
                                        ?>   
                                    </ul>                                                                       
                                </div>                                                                                                 
                            </div>                            
                        </div>
                    </div>                       
                </section>
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
                                    <input type="hidden" class="form-control" name="source" id="action" value="board">
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
            
            <?php
                include_once 'include/footer.php';
            ?>

        </div>

        <script src="assets/jquery/dist/jquery.min.js"></script>        
        <script src="assets/jquery/dist/jquery-ui.js"></script>        
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>                                         
        <script src="assets/select2/js/select2.full.min.js"></script>
        <script src="assets/moment/min/moment.min.js"></script>
        <script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>      
        
        <script src="assets/dist/js/adminlte.min.js"></script>
        <script>
            $(function() {
                $( "#sortableNew" ).sortable({
                    connectWith: "#sortableInProgress,#sortableDone,#sortableCancel",
                    cursor: "pointer",                    
                    receive: function(event, ui) {
                        var attr_id = ui.item.attr('data-id'); 
                        var group = event.target.id;                        
                        
                        $.post("ajax/ajax_task_board.php",
                        {
                            id: attr_id,
                            sortable: group
                        },
                        function(data){
                            location.reload();
                        })
                        
                    }                    
                });
                $( "#sortableInProgress" ).sortable({
                    connectWith: "#sortableNew,#sortableDone,#sortableCancel",
                    cursor: "pointer",                    
                    receive: function(event, ui) {
                        var attr_id = ui.item.attr('data-id'); 
                        var group = event.target.id;
                        
                        $.post("ajax/ajax_task_board.php",
                        {
                            id: attr_id,
                            sortable: group
                        },
                        function(data){
                            location.reload();
                        })
                    }
                });
                $( "#sortableDone" ).sortable({
                    connectWith: "#sortableNew,#sortableInProgress,#sortableCancel",
                    cursor: "pointer",                    
                    receive: function(event, ui) {
                        var attr_id = ui.item.attr('data-id'); 
                        var group = event.target.id;
                        
                        $.post("ajax/ajax_task_board.php",
                        {
                            id: attr_id,
                            sortable: group
                        },
                        function(data){
                            location.reload();
                        })
                    }
                });
                $( "#sortableCancel" ).sortable({
                    connectWith: "#sortableNew,#sortableDone,#sortableInProgress",
                    cursor: "pointer",                    
                    receive: function(event, ui) {
                        var attr_id = ui.item.attr('data-id'); 
                        var group = event.target.id;
                        
                        $.post("ajax/ajax_task_board.php",
                        {
                            id: attr_id,
                            sortable: group
                        },
                        function(data){
                            location.reload();
                        })
                    }
                });
            });
        </script>   
        <script>
            $(function () {
                $('.select2').select2()
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
    </body>
</html>