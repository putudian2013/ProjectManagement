<?php
    $systemName = 'ProjectManagement';
?>

<aside class="main-sidebar">
    <section class="sidebar">                                       
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><center>System Menu</center></li>
            
            <li><a href="<?= base_url('') ?>"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                        
            <li><a href="<?= base_url('project') ?>"> <i class="fa fa-paste"></i> <span>Project</span></a></li>
            
            <li><a href="<?= base_url('calendar') ?>"> <i class="fa fa-calendar"></i> <span>Calendar</span></a></li>            
            
<!--            <li class="treeview">
                <a href="#"><i class="fa fa-files-o"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="employee-working-hours.php?daterange=&shown=&employee="> <i class="fa fa-file"></i> <span>Employee Working Hours</span></a></li>           
                    <li><a href="customer-working-hours.php?daterange=&shown=&customer=&employee="> <i class="fa fa-file"></i> <span>Customer Working Hours</span></a></li>            
                    <li><a href="project-working-hours.php?daterange=&shown=&project="> <i class="fa fa-file"></i> <span>Project Working Hours</span></a></li>
                </ul>
            </li>            -->
            
        </ul>
    </section>
</aside>