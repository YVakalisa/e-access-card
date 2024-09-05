<?php  
 include '../../connector.php'; 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Staff Card Report</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
           
           <script src="//cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
            <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>   
            <script src="//cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>   
            <script src="//cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>   
            
           
          <style>
.btn {
  border: none;
  color: white;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
}

.success {background-color: blue;} /* Green */
.success:hover {opacity: 0.9;}

</style> 
          
           
           
      </head>  
      <body> 

           <br /><br />  
           <div class="container">
           <a onclick="history.back();" class="btn success"><- Back to system</a>  
                <h3 align="center">Staff Card Report</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>
                          <th>Staff</th>
                          <th>Date created</th>
                          <th>Office Number</th>
                          
                               </tr>  
                          </thead>  
                        
                    <?php  
                                   // echo $f_id;
                            $sql2="SELECT s.user_id,s.user_type as user_type,s.initials as initials,s.lastname as lastname,QR_code,c.card_id as c_card, c.user_id as user_id, c.issue_date as date,sc.card_id as sc_card, sc.office_number as office_number FROM `staff_card` as sc,`card` as c,`user` as s where s.user_type='Staff' and c.card_id=sc.card_id and s.user_id=c.user_id";
                            $query=mysqli_query($conn,$sql2);
                             
                              //echo "rows ". $rowsn;
                              if ($query) {
                                  # code...
                                $rowsn=mysqli_num_rows($query);
                                  while ($fac_n=mysqli_fetch_assoc($query)) {
                                      # code...
                                      //$counter++
                                          # code...
                                    ?>
                                     <tr>
                                      
                                      <td><?php echo $fac_n['initials'].' '.$fac_n['lastname'];?></td>
                                      <td><?php echo $fac_n['date'];?></td>
                                      <td><?php echo $fac_n['office_number'];?></td>
                                      
                                    </tr>
                                          
                                          <?php
                                      
                                  }
                                  
                                 
                                  
                              }else{
                                echo '<script type="text/javascript">alert("error '.mysqli_error($conn).'");</script>';
                                  //echo "error ".mysqli_error($conn);
                              }

                              

                          ?>
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function() {
    $('#employee_data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );  
 </script>  