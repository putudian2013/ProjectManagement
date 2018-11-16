<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard | Project Management</title>       
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">         
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/Ionicons/css/ionicons.min.css'); ?>" >

        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/skin-blue.min.css'); ?>" >

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
                $this->load->view('include/header');
                $this->load->view('include/aside');
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
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>                                
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Task Due Today</span>
                                    <span class="info-box-number"><?= $taskDueToday->num_rows() ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dueToday" title="View Task Due Today"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div> 
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>                                   
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Task Due Tomorrow</span>
                                    <span class="info-box-number"><?= $taskDueTomorrow->num_rows() ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dueTomorrow" title="View Task Due Today"><i class="fa fa-eye"></i></a>                                        
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div>                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>                                   
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Task Outstanding</span>
                                    <span class="info-box-number"><?= $outstandingTask->num_rows() ?></span>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#outstanding" title="View Task Due Today"><i class="fa fa-eye"></i></a>                                        
                                    </div>
                                </div>                                      
                            </div>                                                                                    
                        </div>
                    </div>
                    <div class="row">                                                
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-paste"></i></span>                                    
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Project Finish</span>
                                    <span class="info-box-number"><?= $finishProject->num_rows() ?></span>
                                </div>                                
                            </div>                            
                        </div>                                                          
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa fa-paste"></i></span>                                    
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Project On Going</span>
                                    <span class="info-box-number"><?= $onGoingProject->num_rows() ?></span>
                                </div>                                
                            </div>
                        </div>                            
                        <div class="clearfix visible-sm-block"></div>                             
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>                                    
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Task Finish</span>
                                    <span class="info-box-number"><?= $taskFinish->num_rows() ?></span>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tasks"></i></span>                                    
                                <div class="info-box-content">                                    
                                    <span class="info-box-text">Task On Going</span>
                                    <span class="info-box-number"><?= $taskOnGoing->num_rows() ?></span>
                                </div>
                            </div>
                        </div>                        
                        
                    </div>                                                                                
                    
                    <div class="row">
                        <?php                                                                                                                                                         
                           foreach ($project->result() as $row) : 
                        ?> 
                        <div class="col-md-4">
                            <div class="box">
                                <div class="box-header with-border">
                                    Project Completion of <?= $row->project_name ?>
                                    <div class="pull-right">
                                        <a href="<?= base_url('project/task/') . $row->project_id ?>" class="btn btn-primary btn-sm" title="Go To Project Task"><i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>                                
                                
                                <div class="box-body">
                                                                          
                                    <canvas id="pie-chart-<?= $row->project_code ?>" width="100%" height="80%"></canvas>
                                    
                                </div>                                
                                
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6">                                                                                        
                                            <div class="description-block">
                                                <span class="description-header text-green"><?= $row->total_task == 0 ? "0" : round(($row->total_finish/$row->total_task)*100, 2) . "%" ?></span>
                                                <h5 class="description-header"><?= $row->total_finish . "/" . $row->total_task ?></h5>
                                                <span class="description-text">TASK FINISHED</span>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="description-block">
                                                <span class="description-header text-green"><?= $row->total_task == 0 ? "0" : round(($row->total_in_progress/$row->total_task)*100, 2) . "%" ?></span>
                                                <h5 class="description-header"><?= $row->total_in_progress . "/" . $row->total_task ?></h5>
                                                <span class="description-text">TASK IN PROGRESS</span>
                                            </div>
                                        </div>                                                                               
                                    </div>
                                </div>                                 
                            </div> 
                        </div>
                        <?php
                            endforeach;
                        ?> 
                    </div>
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
                                        foreach ($taskDueToday->result() as $row) :                                            
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="<?= base_url('report/dueTask/today') ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-download"></i> Export to Excel</a>
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
                                        foreach ($taskDueTomorrow->result() as $row) :                                                                                  
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="<?= base_url('report/dueTask/tomorrow') ?>" class="btn btn-primary btn-sm pull-right" title="Export to Excel"><i class="fa fa-download"></i> Export to Excel</a>
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
                                        foreach ($outstandingTask->result() as $row) :                                                                                   
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
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                            
                            <a href="<?= base_url('report/dueTask/outstanding') ?>" class="btn btn-primary btn-sm pull-right" title="Export to Excel"><i class="fa fa-download"></i> Export to Excel</a>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <?php
                $this->load->view('include/footer');
            ?>

        </div>       
        
        <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/chart/Chart.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
        
        
        <script>
            <?php                                                                                                                                                         
                foreach ($project->result() as $row) :                                    
            ?>            
                new Chart(document.getElementById("pie-chart-<?= $row->project_code ?>"), {
                    type: 'pie',
                    data: {
                        labels: ["In Progress","Finished"],
                        datasets: [{
                                backgroundColor: ["#8e5ea2", "#3e95cd"],
                                data: [                                    
                                    <?= $row->total_in_progress . "," . $row->total_finish ?>
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
                endforeach;
            ?>
        </script>
    </body>
</html>