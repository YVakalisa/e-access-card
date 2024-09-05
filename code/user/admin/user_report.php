<?php  
 include '../../connector.php'; 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>User Report</title>  
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
                <h3 align="center">User Report</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>

                                  
                                  <th>Surname & Initials</th>
                                  <th>Campus</th>
                                  <th>Email</th>
                                  <th>User Type</th> 
                                  <th>Date Created</th>
                               </tr>  
                          </thead>  
                        
                     <?php  
                     $counter=0;
                                   // echo $f_id;
                            $sql2="SELECT * FROM user WHERE user_type<>'Admin'";
                            $query=mysqli_query($conn,$sql2);
                             $rowsn=mysqli_num_rows($query);
                              //echo "rows ". $rowsn;
                              if ($query) {
                                  # code...
                                  while ($fac_n=mysqli_fetch_assoc($query)) {
                                      # code...
                                      $counter++
                                          # code...
                                    ?>
                                     <tr>
                                      <!-- <td><?php echo $counter;?></td> -->
                                      <!-- <td><div class="avatar-lg"><img src="../../<?php echo $fac_n['photo'];?>" alt="image profile" class="avatar-img rounded"></div></td> -->
                                      <td><?php echo $fac_n['initials'].' '.$fac_n['lastname'];?></td>
                                      <td><?php echo $fac_n['campus'];?></td>
                                      <td><?php echo $fac_n['email'];?></td>
                                      <td><?php echo $fac_n['user_type'];?></td>
                                      <td><?php echo $fac_n['date_created'];?></td>
                                      <!-- <td><a href="user_edit.php?u=<?php echo $fac_n['user_id'];?>" >Edit</a></td>
                                      <td><a onclick="delete_user(<?php echo $fac_n['user_id'];?>)" style="color:red;hover;" pointer >Delete</a></td> -->
                                    </tr>
                                          
                                          <?php
                                      
                                  }
                                  
                                 
                                  
                              }else{
                                  echo "error ".mysqli_error($conn);
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