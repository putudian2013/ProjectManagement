<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Project | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">        
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/Ionicons/css/ionicons.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css'); ?>" >           
        <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2.min.css'); ?>" >        
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.css'); ?>" >            
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'); ?>">

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
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            
            <?php              
                $this->load->view('include/header');
                $this->load->view('include/aside');
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Project
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
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
                                    
                                    <table id="dataTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Project</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Owner</th>
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                              
                                            <?php                                             
                                                
                                                $no = 1;
                                                
                                                foreach ($project->result() as $row) :                                                                                                        
                                                    switch ($row->project_status) {
                                                        case 0:
                                                            $status = "New";
                                                            break;
                                                        case 1:
                                                            $status = "On Progress";
                                                            break;
                                                        case 2:
                                                            $status = "Finish";
                                                            break;
                                                        case 3:
                                                            $status = "Canceled";
                                                            break;
                                                        default:
                                                            break;
                                                    } 
                                                    
                                            ?>
                                            <tr>
                                                <td width="5%" style="background: <?= $row->project_color; ?>"><?php echo $no; ?></td>
                                                <td><?= $row->project_code; ?></td>
                                                <td><?= $row->project_name; ?></td>
                                                <td><?= $row->start_date; ?></td>
                                                <td><?= $row->end_date; ?></td>
                                                <td><?= $status; ?></td>
                                                <td><?= $row->employee_name; ?></td>                                                
                                                <td width="25%">                                                   
                                                    <a href="#" title="Edit" class="btn btn-success" data-toggle="modal" data-target="#editProject" 
                                                       data-id="<?= $row->project_id; ?>" 
                                                       data-name="<?= $row->project_name; ?>"
                                                       data-code="<?= $row->project_code; ?>"
                                                       data-start="<?= $row->start_date; ?>"
                                                       data-end="<?= $row->end_date; ?>"
                                                       data-status="<?= $row->project_status; ?>"
                                                       data-owner="<?= $row->project_owner; ?>"                                                       
                                                       data-color="<?= $row->project_color; ?>"
                                                       > <i class="fa fa-pencil"></i> 
                                                    </a>
                                                    <a href="<?= base_url('project/task/') . $row->project_id ?>" title="Task" class="btn btn-warning"> 
                                                        <i class="fa fa-tasks"></i>
                                                    </a> 
                                                    <a href="#" class="btn btn-danger" title="Delete"  data-toggle="modal" data-target="#deleteProject"
                                                       data-id="<?= $row->project_id; ?>" 
                                                       ><i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                </div>                                
                                
                                <div class="box-footer">
                                    <div class="btn-group pull-right">                                        
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProject" ><i class="fa fa-plus"></i> Add New Project</a>
                                    </div>
                                </div>                                 
                            </div>                            
                        </div>
                    </div>                    
                </section>
            </div>
            
            <!-- Modal Add -->
            <div class="modal fade" id="addProject" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Project</h4>
                        </div>
                        <form action="<?= base_url('project/save') ?>" method="post">
                            <div class="modal-body">                                
                                <div class="form-group">
                                    <label for="projectCode">Project Code</label>
                                    <input type="text" class="form-control" name="projectCode" id="projectCode" placeholder="Example : DP" required>
                                </div> 
                                <div class="form-group">
                                    <label for="projectName">Project Name</label>
                                    <input type="text" class="form-control" name="projectName" id="projectName" placeholder="Example : HR System Project" required>
                                </div> 
                                <div class="form-group">
                                    <label>Start Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="startDate" name="startDate" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="endDate" name="endDate" value="">
                                    </div>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Status</label>         
                                    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
                                        <option value="0">New</option>
                                        <option value="1">On Progress</option>
                                        <option value="2">Finish</option>
                                        <option value="3">Canceled</option>
                                    </select>                                     
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Project Owner</label>         
                                    <select class="form-control select2"  id="projectOwner" name="projectOwner" style="width: 100%;">
                                        <option value="0">Select...</option>
                                        <?php foreach ($employee->result() as $row) : ?>                                                                                                
                                            <option value="<?php echo $row->employee_id ?>"><?php echo $row->employee_name ?></option>
                                        <?php endforeach; ?> 
                                    </select>                                     
                                </div>
                                <div class="form-group">
                                    <label for="projectColor">Project Color</label>
                                    <div id="projectColor" class="input-group colorpicker-component">
                                        <input type="text" value="#000000" class="form-control" id="projectColor" name="projectColor"/>
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
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
            <div class="modal fade" id="editProject" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                        </div>
                        <form action="<?= base_url('project/update') ?>" method="post">
                            <div class="modal-body">                                
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID">
                                </div>
                                <div class="form-group">
                                    <label for="projectCode">Project Code</label>
                                    <input type="text" class="form-control" name="projectCode" id="projectCode" placeholder="Example : DP" required>
                                </div> 
                                <div class="form-group">
                                    <label for="projectName">Project Name</label>
                                    <input type="text" class="form-control" name="projectName" id="projectName" placeholder="Example : HR System Project" required>
                                </div>  
                                <div class="form-group">
                                    <label>Start Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="startDateEdit" name="startDate" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="endDateEdit" name="endDate" value="">
                                    </div>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Status</label>         
                                    <select class="form-control select2"  id="status" name="status" style="width: 100%;">
                                        <option value="0">New</option>
                                        <option value="1">On Progress</option>
                                        <option value="2">Finish</option>
                                        <option value="3">Canceled</option>
                                    </select>                                     
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label>Project Owner</label>         
                                    <select class="form-control select2"  id="projectOwner" name="projectOwner" style="width: 100%;">
                                        <option value="0">Select...</option>
                                        <?php foreach ($employee->result() as $row) : ?>                                                                                                
                                            <option value="<?php echo $row->employee_id ?>"><?php echo $row->employee_name ?></option>
                                        <?php endforeach; ?>  
                                    </select>                                     
                                </div>
                                <div class="form-group">
                                    <label for="projectColor">Project Color</label>
                                    <div id="projectColorEdit" class="input-group colorpicker-component">
                                        <input type="text" class="form-control" id="projectColor" name="projectColor"/>
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
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
            <div class="modal fade" id="deleteProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Project</h4>
                        </div>
                        <form action="<?= base_url('project/delete') ?>" method="post">
                            <div class="modal-body">                                
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID">
                                </div>
                                <h4>Are You Sure to Delete this Project ?</h4>
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
                $this->load->view('include/footer');                
            ?>

        </div>

        <script src="<?= base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>   
        <script src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/select2/js/select2.full.min.js') ?>"></script>
        <script src="<?= base_url('assets/moment/min/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>  
        <script src="<?= base_url('assets/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') ?>"></script>
        
        <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
                       
        <script>
            $(function () {
                $('.select2').select2()
            })
        </script>
        <script>
            $(function(){
                $('#startDate').daterangepicker({
                    singleDatePicker: true,                                                
                    showDropdowns : true,
                    drops : "down",
                    opens : 'right',                    
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                })
                
                $('#endDate').daterangepicker({
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
            $(function(){
                $('#startDateEdit').daterangepicker({
                    singleDatePicker: true,                                                
                    showDropdowns : true,
                    drops : "down",
                    opens : 'right',                    
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                })
                
                $('#endDateEdit').daterangepicker({
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
                    'paging'      : false,
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
            $('#editProject').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var projectID = button.data('id') 
                var projectName = button.data('name') 
                var startDate = button.data('start') 
                var endDate = button.data('end') 
                var projectCode = button.data('code')                 
                var status = button.data('status')
                var projectOwner = button.data('owner')                 
                var projectColor = button.data('color')
                
                
                var modal = $(this)
                modal.find('#projectID').val(projectID)
                modal.find('#projectName').val(projectName)                
                modal.find('#startDateEdit').val(startDate)                
                modal.find('#endDateEdit').val(endDate)                
                modal.find('#projectCode').val(projectCode)                                          
                modal.find('#projectOwner').val(projectOwner).change() 
                modal.find('#status').val(status).change() 
                modal.find('#projectColor').val(projectColor)
                
                
            })
        </script>
        <script>
            $('#deleteProject').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var projectID = button.data('id') 
                
                var modal = $(this)
                modal.find('#projectID').val(projectID)
                
            })
        </script>
        <script>
            $(function() {
                $('#projectColor').colorpicker();
            });
        </script>
        <script>
            $(function() {
                $('#projectColorEdit').colorpicker();
            });
        </script>
    </body>
</html>