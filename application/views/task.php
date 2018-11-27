<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">                
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/Ionicons/css/ionicons.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/buttons.bootstrap.min.css'); ?>" >        
        <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2.min.css'); ?>" >        
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.css'); ?>" >        

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
        <style>
            .btn-group{
                display: block;
            }
        </style>        
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
                        Task of <?= $projectName ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                    </ol>
                </section>
                <section class="content container-fluid">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">       
                                    <a href="<?= base_url('task/board/') . $projectID ?>" class="btn btn-primary" >Board View</a>
<!--                                    <a href="<?= base_url('task/gantt/') . $projectID ?>" class="btn btn-primary" >Gantt Chart</a>-->
                                </div>                                                                
                                <div class="box-body">                                    
                                    <table id="dataTable" class="table table-bordered table-striped" style="font-size: 12px">
                                        <thead style="background-color: grey">
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>                                                
                                                <th>Reported Date</th>                                                
                                                <th>Record Date</th>                                                
                                                <th>Task</th>
                                                <th>Status</th>                                                                               
                                                <th>PIC</th>                                                
                                                <th>Due Date</th>
                                                <th>Sub Task</th>
                                                <th>Finish Date</th>
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            
                                                $no = 1;
                                                
                                                foreach ($task->result() as $row) :                                                   
                                                    switch ($row->task_status) {
                                                        case 0:
                                                            $status = "New";
                                                            break;
                                                        case 1:
                                                            $status = "In Progress";
                                                            break;
                                                        case 2:
                                                            $status = "Done";
                                                            break;
                                                        case 3:
                                                            $status = "Canceled";
                                                            break;
                                                        default:
                                                            break;
                                                    }                                                                                                                                                                                                            
                                            ?>
                                            <tr>
                                                <td width="5%"><?php echo $no; ?></td>
                                                <td><?= $row->task_code ?></td>
                                                <td><?= $row->reported_date ?></td>
                                                <td><?= $row->record_date ?></td>
                                                <td><?= $row->task_name ?></td>
                                                <td style="background-color: <?= $row->task_status == 2 ? 'greenyellow' : '' ?>"><?= $status; ?></td>                                                                                             
                                                <td><?= $row->emp_pic; ?></td>                                                
                                                <td><?= $row->due_date ?></td>   
                                                <td><?= $row->sub_task ?></td>
                                                <td><?= $row->finish_date == "" ? "-" : $row->finish_date ?></td>
                                                <td width="20%">                                                   
                                                    <a href="#" class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-target="#editTask" 
                                                       data-id="<?= $row->task_id ?>" 
                                                       data-code="<?= $row->task_code ?>"
                                                       data-reported="<?= $row->reported_date ?>"
                                                       data-name="<?= $row->task_name ?>"
                                                       data-due="<?= $row->due_date ?>"
                                                       data-status="<?= $row->task_status ?>"
                                                       data-pic="<?= $row->pic ?>"
                                                       data-detail="<?= $row->task_detail ?>"
                                                       > <i class="fa fa-pencil"></i> 
                                                    </a>  
                                                    <a href="<?= base_url('task/subTask/') . $row->task_id . '/' . $projectID ?>" title="Sub Task" class="btn btn-warning btn-sm"> 
                                                        <i class="fa fa-tasks"></i> 
                                                    </a>                                                                                                                                                                                                                 
                                                    <a href="<?= base_url('task/comment/') . $row->task_id . '/' . $projectID ?>" class="btn btn-success btn-sm" title="Comment"><i class="fa fa-comment"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-sm button-upload" title="Upload File"
                                                       data-id="<?= $row->task_id ?>" 
                                                       ><i class="fa fa-upload"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-primary btn-sm button-history" title="History"
                                                       data-id="<?= $row->task_id ?>" 
                                                       ><i class="fa fa-history"></i> 
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteTask"
                                                       data-id="<?= $row->task_id ?>" 
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
                                    <div class=" pull-right">                                        
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#importTask" ><i class="fa fa-upload"></i> Import From Excel</a>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTask" ><i class="fa fa-plus"></i> Add New Task</a>                                                                                
                                    </div>
                                    <a href="<?= base_url('project') ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Project List</a>                                    
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
                        <form action="<?= base_url('task/save') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?php echo $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <label for="taskCode">Task Code</label>                                   
                                    <input type="text" class="form-control" name="taskCode" id="taskCode" value="AUTOMATIC" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Reported Date</label>                                           
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reportedDate" name="reportedDate" value="">
                                    </div>
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
                                        <?php foreach ($employee->result() as $row) : ?>                                                                                                
                                            <option value="<?php echo $row->employee_id ?>"><?php echo $row->employee_name ?></option>
                                        <?php endforeach; ?> 
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
                        <form action="<?= base_url('task/update/table') ?>" method="post">
                            <div class="modal-body">                                                                
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
                                        <?php foreach ($employee->result() as $row) : ?>                                                                                                
                                            <option value="<?php echo $row->employee_id ?>"><?php echo $row->employee_name ?></option>
                                        <?php endforeach; ?>                                        
                                    </select>                                     
                                </div>
                                <div class="form-group">
                                    <label>Task Detail</label>
                                    <textarea class="form-control" rows="6" id="taskDetail" name="taskDetail" placeholder="Task Detail "></textarea>
                                </div>
                                <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID">
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
                        <form action="<?= base_url('task/delete') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action" id="action" value="delete">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
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
            
            <!-- Modal Import -->
            <div class="modal fade" id="importTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Import Task</h4>
                        </div>                         
                        <form action="<?= base_url('task/import')?>" method="post" name="import" id="import" enctype="multipart/form-data">
                            <div class="modal-body">                                                                
                                <div class="form-group">
                                    <label for="fileToUpload">File to Upload</label>    
                                    <input type="file" name="fileToUpload" accept=".xls,.xlsx" required/>
                                    <a class="btn btn-success pull-right" href="<?= base_url('media/template/Form Upload Excel Task.xlsx') ?>" ><i class="fa fa-download"></i> Download Excel Sample</a>
                                    <br />
                                </div>
                                
                                <div class="form-group">                    
                                    <input type="hidden" class="form-control" name="action" id="action" value="import">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                                
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php
                include_once 'include/footer.php';
            ?>

        </div>

        <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>   
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>          
        <script src="<?php echo base_url('assets/datatables/js/dataTables.buttons.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/buttons.bootstrap.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/jszip.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/pdfmake.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/vfs_fonts.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/buttons.html5.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/buttons.print.min.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/datatables/js/buttons.colVis.min.js'); ?>"></script>                        
        <script src="<?php echo base_url('assets/select2/js/select2.full.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/moment/min/moment.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>  
        
        <script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
                       
        <script>
            $(function () {
                $('.select2').select2()
            })
        </script>
        <script>
            $(function(){
                $('#dueDate, #reportedDate').daterangepicker({                    
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
                var reportedDate = button.data('reported')  
                               
                var modal = $(this)
                modal.find('#taskID').val(taskID)
                modal.find('#taskName').val(taskName)                
                modal.find('#dueDateEdit').val(dueDate)                    
                modal.find('#status').val(status).change()
                modal.find('#pic').val(pic).change()                                      
                modal.find('#taskDetail').val(detail)
                modal.find('#taskCode').val(code)
                modal.find('#reportedDate').val(reportedDate)
                
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
                
                $.post("<?= base_url('task/history') ?>",
                {
                    id: id,          
                    projectID: <?= $projectID ?>
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
                
                $.post("<?= base_url('task/uploadFile') ?>",
                {
                    id: id,
                    projectID: <?= $projectID ?>
                },
                function(data){
                    $(".body-upload").html(data);
                });
            }); 
        </script>
        <script>
            <?php 
                if (isset($_GET["import"])==1){
            ?>
                    alert("Task Imported Successfully")
            <?php
                }
            ?>
        </script>
    </body>
</html>