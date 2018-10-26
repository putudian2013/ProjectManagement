<!DOCTYPE html>
<?php 
    include 'config.php';        
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">        
        
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
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                    </ol>
                </section>

                <section class="content container-fluid">
                    <!-- START CONTENT -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>   
                                <?php 
                        
                                    $sqlDueToday = "select count(task_id) as 'due_today' from task where task_status in ('0','1') and due_date = date_format(now(), '%Y-%m-%d')";
                                    $resultDueToday = mysqli_query($conn, $sqlDueToday);
                                    $rowDueToday = mysqli_fetch_assoc($resultDueToday);

                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Task Due Today</span>
                                    <span class="info-box-number"><?php echo $rowDueToday["due_today"] ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dueToday" title="View Task Due Today"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div> 
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>   
                                <?php 
                        
                                    $sqlDueTomorrow = "select count(task_id) as 'due_tomorrow' from task where task_status in ('0','1') and due_date = date_format(now() + INTERVAL 1 DAY, '%Y-%m-%d') ";
                                    $resultDueTomorrow = mysqli_query($conn, $sqlDueTomorrow);
                                    $rowDueTomorrow = mysqli_fetch_assoc($resultDueTomorrow);

                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Task Due Tomorrow</span>
                                    <span class="info-box-number"><?php echo $rowDueTomorrow["due_tomorrow"] ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dueTomorrow" title="View Task Due Today"><i class="fa fa-eye"></i></a>                                        
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div>                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>   
                                <?php 
                        
                                    $sqlOutstanding = "select count(task_id) as 'outstanding' from task where task_status in ('0','1') and due_date < date_format(now(), '%Y-%m-%d')";
                                    $resultOutstanding = mysqli_query($conn, $sqlOutstanding);
                                    $rowOutstanding = mysqli_fetch_assoc($resultOutstanding);

                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Task Outstanding</span>
                                    <span class="info-box-number"><?php echo $rowOutstanding["outstanding"] ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#outstanding" title="View Task Due Today"><i class="fa fa-eye"></i></a>                                        
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div>
                    </div>
                    <div class="row">
                        
                        <?php 
                        
                            $sqlFinishProject = "select count(project_id) as 'finish_project' from project where project_status in ('2','3')";
                            $resultFinishProject = mysqli_query($conn, $sqlFinishProject);
                            $rowFinishProject = mysqli_fetch_assoc($resultFinishProject);
                        
                        ?>
                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-paste"></i></span>
                                    
                                <div class="info-box-content">
                                    <span class="info-box-text">Project Finish</span>
                                    <span class="info-box-number"><?php echo $rowFinishProject["finish_project"] ?></span>
                                </div>                                
                            </div>                            
                        </div>          
                        <?php 
                        
                            $sqlOnGoingProject = "select count(project_id) as 'on_going_project' from project where project_status in ('0','1')";
                            $resultOnGoingProject = mysqli_query($conn, $sqlOnGoingProject);
                            $rowOnGoingProject = mysqli_fetch_assoc($resultOnGoingProject);
                        
                        ?>                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa fa-paste"></i></span>
                                    
                                <div class="info-box-content">
                                    <span class="info-box-text">Project On Going</span>
                                    <span class="info-box-number"><?php echo $rowOnGoingProject["on_going_project"] ?></span>
                                </div>                                
                            </div>
                        </div>                            
                        <div class="clearfix visible-sm-block"></div>     
                        <?php 
                        
                            $sqlFinishTask = "select count(task_id) as 'finish_task' from task where task_status in ('2','3')";
                            $resultFinishTask = mysqli_query($conn, $sqlFinishTask);
                            $rowFinishTask = mysqli_fetch_assoc($resultFinishTask);
                        
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                                    
                                <div class="info-box-content">
                                    <span class="info-box-text">Task Finish</span>
                                    <span class="info-box-number"><?php echo $rowFinishTask["finish_task"] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php 
                        
                            $sqlOnGoingTask = "select count(task_id) as 'on_going_task' from task where task_status in ('0','1')";
                            $resultOnGoingTask = mysqli_query($conn, $sqlOnGoingTask);
                            $rowOnGoingTask = mysqli_fetch_assoc($resultOnGoingTask);
                        
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tasks"></i></span>
                                    
                                <div class="info-box-content">
                                    <span class="info-box-text">Task On Going</span>
                                    <span class="info-box-number"><?php echo $rowOnGoingTask["on_going_task"] ?></span>
                                </div>
                            </div>
                        </div>                        
                        
                    </div>                                                                                
                    
                    <div class="row">
                        <?php 
                                    
                            $sqlTotalProject = "select * from project";
                            $resultTotalProject = mysqli_query($conn, $sqlTotalProject);

                            while($rowTotalProject = mysqli_fetch_assoc($resultTotalProject)){                                                      
                        ?> 
                        <div class="col-md-4">
                            <div class="box">
                                <div class="box-header with-border">
                                    Project Completion of <?php echo $rowTotalProject["project_name"] ?>
                                    <div class="pull-right">
                                        <a href="task.php?id=<?php echo $rowTotalProject["project_id"] ?>" class="btn btn-primary btn-sm" title="Go To Project Task"><i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>                                
                                
                                <div class="box-body">
                                                                          
                                    <canvas id="pie-chart-<?php echo $rowTotalProject["project_code"] ?>" width="100%" height="80%"></canvas>
                                    
                                </div>                                
                                
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                $sqlTotalTask = "select count(task_id) as 'total_task' from task where project_id = '".$rowTotalProject["project_id"]."'";
                                                $resultTotalTask = mysqli_query($conn, $sqlTotalTask);
                                                $rowTotalTask = mysqli_fetch_assoc($resultTotalTask);
                                                
                                                $sqlTaskFinish = "select count(task_id) as 'task_finish' from task where project_id = '".$rowTotalProject["project_id"]."' and task_status in ('2','3')";
                                                $resultTaskFinish = mysqli_query($conn, $sqlTaskFinish);
                                                $rowTaskFinish = mysqli_fetch_assoc($resultTaskFinish);
                                                
                                                $sqlTaskInProgress = "select count(task_id) as 'task_in_progress' from task where project_id = '".$rowTotalProject["project_id"]."' and task_status in ('0','1')";
                                                $resultTaskInProgress = mysqli_query($conn, $sqlTaskInProgress);
                                                $rowTaskInProgress = mysqli_fetch_assoc($resultTaskInProgress);
                                            ?>
                                            <div class="description-block">
                                                <span class="description-header text-green"><?php echo round(($rowTaskFinish["task_finish"]/$rowTotalTask["total_task"])*100, 2) . "%" ?></span>
                                                <h5 class="description-header"><?php echo $rowTaskFinish["task_finish"] . "/" . $rowTotalTask["total_task"]?></h5>
                                                <span class="description-text">TASK FINISHED</span>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="description-block">
                                                <span class="description-header text-green"><?php echo round(($rowTaskInProgress["task_in_progress"]/$rowTotalTask["total_task"])*100, 2) . "%" ?></span>
                                                <h5 class="description-header"><?php echo $rowTaskInProgress["task_in_progress"] . "/" . $rowTotalTask["total_task"]?></h5>
                                                <span class="description-text">TASK IN PROGRESS</span>
                                            </div>
                                        </div>                                                                               
                                    </div>
                                </div>                                 
                            </div> 
                        </div>
                        <?php
                            }
                        ?> 
                    </div>
                    
                    
                    <!-- END CONTENT -->
                </section>
               
            </div>
            
            <!-- Modal Due Today -->
            <div class="modal fade" id="dueToday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">List of Task Due Today</h4>
                        </div>                        
                        <div class="modal-body">
                            <table id="dataTable" class="table table-bordered table-striped" style="font-size: 12px">
                                <thead style="background-color: grey">
                                    <tr>
                                        <td style="background: gray">No</td>
                                        <td style="background: gray">Project</td>
                                        <td style="background: gray">Task Code</td>
                                        <td colspan="10" style="background: gray">Task Name</td>
                                        <td style="background: gray">Due Date</td>
                                    </tr>
                                </thead>
                                <tbody>                                            
                                    <?php
                                        $no = 1;

                                        $sql = "select * from task t 
                                            inner join project p on t.project_id = p.project_id
                                            where t.task_status in ('0','1') and t.due_date = date_format(now(), '%Y-%m-%d')";

                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_assoc($result)) {
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="export-due-task.php?type=today" class="btn btn-primary btn-sm pull-right"><i class="fa fa-download"></i> Export to Excel</a>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <!-- Modal Due Tomorrow -->
            <div class="modal fade" id="dueTomorrow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">List of Task Due Tomorrow</h4>
                        </div>                        
                        <div class="modal-body">
                            <table id="dataTable" class="table table-bordered table-striped" style="font-size: 12px">
                                <thead style="background-color: grey">
                                    <tr>
                                        <td style="background: gray">No</td>
                                        <td style="background: gray">Project</td>
                                        <td style="background: gray">Task Code</td>
                                        <td colspan="10" style="background: gray">Task Name</td>
                                        <td style="background: gray">Due Date</td>
                                    </tr>
                                </thead>
                                <tbody>                                            
                                    <?php
                                        $no = 1;

                                        $sql = "select * from task t 
                                            inner join project p on t.project_id = p.project_id
                                            where t.task_status in ('0','1') and t.due_date = date_format(now() + interval 1 day, '%Y-%m-%d')";

                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_assoc($result)) {
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="export-due-task.php?type=tomorrow" class="btn btn-primary btn-sm pull-right" title="Export to Excel"><i class="fa fa-download"></i> Export to Excel</a>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <!-- Modal Outstanding -->
            <div class="modal fade" id="outstanding" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">List of Outstanding Task</h4>
                        </div>                        
                        <div class="modal-body">
                            <table id="dataTable" class="table table-bordered table-striped" style="font-size: 12px">
                                <thead style="background-color: grey">
                                    <tr>
                                        <td style="background: gray">No</td>
                                        <td style="background: gray">Project</td>
                                        <td style="background: gray">Task Code</td>
                                        <td colspan="10" style="background: gray">Task Name</td>
                                        <td style="background: gray">Due Date</td>
                                    </tr>
                                </thead>
                                <tbody>                                            
                                    <?php
                                        $no = 1;

                                        $sql = "select * from task t 
                                            inner join project p on t.project_id = p.project_id
                                            where t.task_status in ('0','1') and t.due_date < date_format(now(), '%Y-%m-%d')";

                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_assoc($result)) {
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="export-due-task.php?type=outstanding" class="btn btn-primary btn-sm pull-right" title="Export to Excel"><i class="fa fa-download"></i> Export to Excel</a>
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
        <script src="assets/chart/Chart.min.js"></script>
        
        <script src="assets/dist/js/adminlte.min.js"></script>
        
        <script>
            <?php 
                $sqlTotalProject = "select * from project";
                $resultTotalProject = mysqli_query($conn, $sqlTotalProject);

                while($rowTotalProject = mysqli_fetch_assoc($resultTotalProject)){ 
            ?>
                new Chart(document.getElementById("pie-chart-<?php echo $rowTotalProject["project_code"] ?>"), {
                    type: 'pie',
                    data: {
                        labels: ["In Progress","Finished"],
                        datasets: [{
                                backgroundColor: ["#8e5ea2", "#3e95cd"],
                                data: [
                                    <?php
                                        $sqlTaskFinish = "select count(task_id) as 'task_finish' from task where project_id = '".$rowTotalProject["project_id"]."' and task_status in ('2','3')";
                                        $resultTaskFinish = mysqli_query($conn, $sqlTaskFinish);
                                        $rowTaskFinish = mysqli_fetch_assoc($resultTaskFinish);

                                        $sqlTaskInProgress = "select count(task_id) as 'task_in_progress' from task where project_id = '".$rowTotalProject["project_id"]."' and task_status in ('0','1')";
                                        $resultTaskInProgress = mysqli_query($conn, $sqlTaskInProgress);
                                        $rowTaskInProgress = mysqli_fetch_assoc($resultTaskInProgress);
                                        
                                        echo $rowTaskInProgress["task_in_progress"] . "," . $rowTaskFinish["task_finish"];
                                    ?>
                                ]
                            }]
                    },
                    options: {                          
                        legend: {
                            display: false
                        }                      
                    }
                });
            <?php
                }
            ?>
        </script>
    </body>
</html>