<!DOCTYPE html>
<?php 
    include 'config.php';    
    $projectID = $_GET["id"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task Gantt Chart | Project Management</title>
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
                        Task Gantt Chart
                        <a href="task.php?id=<?php echo $projectID ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Table View</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>                        
                        <li>Project</li>
                        <li>Task</li>
                        <li>Gantt Chart</li>
                    </ol>
                </section>

                <section class="content container-fluid">
                    <!-- START CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">                                                                                               
                                <div class="box-body">                                                                        
                                    <div id="dp">
                                        
                                    </div>
                                </div>                                                                
                            </div>                            
                        </div>
                    </div>                    
                </section>
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
        
        <script src="assets/daypilot/daypilot-all.min.js"></script>
        
        <script src="assets/dist/js/adminlte.min.js"></script>
        
        <script type="text/javascript">
            // Get ID Canvas
            var dp = new DayPilot.Gantt("dp");
            
            // Gantt Chart Start Date
            dp.startDate = new DayPilot.Date("2017-01-01");
            
            // Gantt Chart Day Length
            dp.days = 366;
            
            // Enable/Disable Create New Task
            dp.rowCreateHandling = 'Enabled';
            
            // Chart Column
            dp.columns = [
                { title: "Task", property: "text", width: 100},
                { title: "Start Date", width: 100},
                { title: "End Date", width: 100}
            ];
            
            dp.onBeforeRowHeaderRender = function(args) {
                args.row.columns[1].html = new DayPilot.Duration(args.task.end().getTime() - args.task.start().getTime()).toString("d") + " days";
                args.row.areas = [
                    {
                        right: 3,
                        top: 3,
                        width: 16,
                        height: 16,
                        style: "cursor: pointer; box-sizing: border-box; background: white; border: 1px solid #ccc; background-repeat: no-repeat; background-position: center center; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABASURBVChTYxg4wAjE0kC8AoiFQAJYwFcgjocwGRiMgPgdEP9HwyBFDkCMAtAVY1UEAzDFeBXBAEgxQUWUAgYGAEurD5Y3/iOAAAAAAElFTkSuQmCC);",
                        action: "ContextMenu",
                        menu: taskMenu,
                        v: "Hover"
                    }
                ];
            };
            
            // Create Task
            dp.onRowCreate = function(args) {
                $.post("helper/gantt-chart/backend_create.php", {
                    name: args.text,
                    start: dp.startDate.toString(),
                    end: dp.startDate.addDays(1).toString()
                },
                function(data) {
                    loadTasks();
                });
            };
            
            dp.contextMenuLink = new DayPilot.Menu([
                {
                    text: "Delete",
                    onclick: function() {
                        var link = this.source;
                        $.post("backend_link_delete.php", {
                            id: link.id()
                        },
                        function(data) {
                            loadLinks();
                        });
                    }
                }
            ]);
            
            
            
            dp.onTaskMove = function(args) {
                $.post("backend_move.php", {
                    id: args.task.id(),
                    start: args.newStart.toString(),
                    end: args.newEnd.toString()
                },
                function(data) {
                    dp.message("Updated");
                });
            };
            
            dp.onTaskResize = function(args) {
                $.post("backend_move.php", {
                    id: args.task.id(),
                    start: args.newStart.toString(),
                    end: args.newEnd.toString()
                },
                function(data) {
                    dp.message("Updated");
                });
            };
            
            
            dp.onRowMove = function(args) {
                $.post("backend_row_move.php", {
                    source: args.source.id,
                    target: args.target.id,
                    position: args.position
                },
                function(data) {
                    dp.message("Updated");
                });
            };
            
            dp.onLinkCreate = function(args) {
                $.post("backend_link_create.php", {
                    from: args.from,
                    to: args.to,
                    type: args.type
                },
                function(data) {
                    loadLinks();
                });
            };
            
            dp.onTaskClick = function(args) {
                var modal = new DayPilot.Modal();
                modal.closed = function() {
                    loadTasks();
                };
                modal.showUrl("edit.php?id=" + args.task.id());
            };
            
            dp.init();
            
            loadTasks();
            loadLinks();
            
            function loadTasks() {
                $.post("helper/gantt-chart/backend_tasks.php", function(data) {
                    dp.tasks.list = data;
                    dp.update();
                });
            }
            
            function loadLinks() {
                $.post("backend_links.php", function(data) {
                    dp.links.list = data;
                    dp.update();
                });
            }
            
            var taskMenu = new DayPilot.Menu({
                items: [
                    {
                        text: "Delete",
                        onclick: function() {
                            var task = this.source;
                            $.post("backend_task_delete.php", {
                                id: task.id()
                            },
                            function(data) {
                                loadTasks();
                            });
                        }
                    }
                ]
            });
            
        </script>
                               
    </body>
</html>