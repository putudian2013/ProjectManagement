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
                        Task Board 
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">       
                                    
                                </div>                                
                                
                                <div class="box-body">                                                                        
                                    
                                </div>                                
                                
                                <div class="box-footer">                                                                        
                                    <a href="task.php?id=<?php echo $projectID ?>" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> Back to Table View</a>
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
        <script src="assets/moment/min/moment.min.js"></script>        
        
        <script src="assets/dist/js/adminlte.min.js"></script>
                               
    </body>
</html>