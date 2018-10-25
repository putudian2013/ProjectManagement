<!DOCTYPE html>
<?php 
    include 'config.php';        
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendar | Project Management</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">        
        <link rel="stylesheet" href="assets/fullcalendar/fullcalendar.css">
        <link rel="stylesheet" href="assets/qtip/jquery.qtip.min.css">
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
                        Calendar
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Calendar</li>                                              
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
                                    
                                    <div id='calendar'>
                                        
                                    </div>
                                    
                                </div>                                
                                
                                <div class="box-footer">                                                                        
                                    
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
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>                                         
        <script src="assets/moment/min/moment.min.js"></script>
        <script src="assets/fullcalendar/fullcalendar.js"></script>        
        <script src="assets/qtip/jquery.qtip.min.js"></script> 
        <script src="assets/select2/js/select2.full.min.js"></script>       
        <script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>     
        
        <script src="assets/dist/js/adminlte.min.js"></script>
        
        <script>
            $(function() {                
                $('#calendar').fullCalendar({
                    header : {                        
                        right:  'today, prevYear, prev,next, nextYear'
                    },
                    themeSystem : 'bootstrap4',
                    editable: true,
                    eventRender: function(eventObj, $el) {
                        $el.popover({
                            title: eventObj.title,
                            content: eventObj.description,
                            trigger: 'hover',
                            placement: 'top',
                            container: 'body'
                        });
                    },
                    events: [
                        <?php 
                            $sql = "select task.*, project.project_color from task inner join project on task.project_id = project.project_id";
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
                                {
                                    title  : '<?php echo $row["task_code"] ?> - ' + '<?php echo $status ?>',
                                    start  : '<?php echo $row["due_date"] ?>',
                                    description: '<?php echo $row["task_name"] ?>',                                    
                                    color : '<?php echo $row["project_color"] ?>',
                                    id : "<?php echo $row["task_id"] . "-" . $row["project_id"] ?>"                           
                                },
                        <?php
                            }
                        ?>                                               
                    ],
                    
                    eventClick: function(calEvent, jsEvent, view) {                                                
                        
                        $("#editTask").modal();
                        
                        $.post("ajax/ajax_calendar.php",
                        {
                            id: calEvent.id                                
                        },
                        function(data){
                            $(".modal-body").html(data);   
                            
                            $(function () {
                                $('.select2').select2()
                            })
                            
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
                            
                        })  
                        
//                        if (calEvent.url) {
//                            window.open(calEvent.url);
//                            return false;
//                        } else {                            
//                                                      
//                        }

                    },
                    eventDrop: function(event, delta, revertFunc) {

                        //alert(event.title + " was dropped on " + event.start.format());

                        if (!confirm("Due Date for Task " + event.title + " will be Update to " + event.start.format("D MMMM Y") + ". Are You Sure ?")) {
                            revertFunc();
                        } else {
                            $.post("ajax/ajax_calendar_drop.php",
                            {
                                id: event.id,
                                due: event.start.format()
                            },
                            function(data){
                                alert(data)                                
                            })
                        }

                    },
                    
                    eventLimit: false, 
                    views: {
                        agenda: {
                            eventLimit: 6
                        }
                    }                    
                               
                    
                })                
            });
        </script>
        <script>
            
        </script>               
        <script>
            
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