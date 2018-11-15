<table id="dataTable" class="table table-bordered table-striped" style="width:100%;font-size: 12px">
    <thead style="background-color: grey">
        <tr>
            <th>No</th>
            <th>Date</th>                                                
            <th>Action</th>                                        
            <th>Detail</th>                                        
        </tr>
    </thead>
    <tbody>                                            
        <?php 
            $no = 1;
            $projectID = $this->input->post('projectID');
            $taskID = $this->input->post('id');
            foreach ($taskHistory->result() as $row) :             
        ?>
        <tr>
            <td width="5%"><?php echo $no; ?></td>
            <td><?= $row->created_date; ?></td>
            <td><?= $row->action; ?></td>
            <td><?= $row->detail; ?></td>           
        </tr>
        <?php
                $no++;
            endforeach;
        ?>
    </tbody>
</table>