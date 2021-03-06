<!DOCTYPE html>
<?php    
    foreach ($task->result() as $row) :
        $taskCode = $row->task_code;
        $taskName = $row->task_name;
    endforeach;                
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Comment Task | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/Ionicons/css/ionicons.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css'); ?>" >           
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
                        Comment Task
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                        <li>Comment Task</li>
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
                                    
                                    <table id="dataTable" class="table table-bordered table-striped" style="width:100%;font-size: 12px">
                                        <thead style="background-color: grey">
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Detail</th>                                                
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            
                                                $no = 1;                                                
                                                foreach ($taskComment->result() as $row) :                                                                                                                                                                                                                                                                                                                
                                            ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row->created_date; ?></td>
                                                <td><?= $row->detail; ?></td>                                                                                               
                                                <td>                                                   
                                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editComment" 
                                                       data-id="<?= $row->task_comment_id ?>"                                                        
                                                       data-detail="<?= $row->detail ?>"                                                                                                      
                                                       > <i class="fa fa-pencil"></i> Edit 
                                                    </a>                                                       
                                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteComment"
                                                       data-id="<?= $row->task_comment_id ?>" 
                                                       ><i class="fa fa-times"></i> Delete
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
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addComment" ><i class="fa fa-plus"></i> Add New Comment</a>
                                    </div>
                                    <a href="<?= base_url('project/task/') . $projectID ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Task List</a>
                                </div>                                 
                            </div>                            
                        </div>
                    </div>                    
                </section>
            </div>
            
            <!-- Modal Add -->
            <div class="modal fade" id="addComment" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Comment</h4>
                        </div>
                        <form action="<?= base_url('taskComment/save') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?= $taskID ?>">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
                                </div>                                                                                                                                                                 
                                <div class="form-group">
                                    <label>Comment Detail</label>
                                    <textarea class="form-control" rows="6" id="commentDetail" name="commentDetail" placeholder="Comment Detail "></textarea>
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
            <div class="modal fade" id="editComment" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
                        </div>
                        <form action="<?= base_url('taskComment/update') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?= $taskID ?>">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="commentID" id="commentID">
                                </div>                                
                                <div class="form-group">
                                    <label>Comment Detail</label>
                                    <textarea class="form-control" rows="6" id="commentDetail" name="commentDetail" placeholder="Comment Detail"></textarea>
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
            <div class="modal fade" id="deleteComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Task</h4>
                        </div>
                        <form action="<?= base_url('taskComment/delete') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="taskID" id="taskID" value="<?= $taskID ?>">
                                    <input type="hidden" class="form-control" name="projectID" id="projectID" value="<?= $projectID ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="commentID" id="commentID">
                                </div>
                                <h4>Are You Sure to Delete this Comment ?</h4>
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

        <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>   
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>          
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
            $(function () {                
                $('#dataTable').DataTable({
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,                                        
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
            $('#editComment').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var commentID = button.data('id') 
                var commentDetail = button.data('detail')                 
                               
                var modal = $(this)
                modal.find('#commentID').val(commentID)
                modal.find('#commentDetail').val(commentDetail)
                
            })
        </script>
        <script>
            $('#deleteComment').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var commentID = button.data('id')                
                
                var modal = $(this)
                modal.find('#commentID').val(commentID)                
                
            })
        </script>
        
    </body>
</html>