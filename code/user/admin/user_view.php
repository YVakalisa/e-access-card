<?php include "header.php";
$counter=0;
     
?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">User</h4>
						
					</div>
					<div class="row">
						  <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">All Users</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Picture</th>
                          <th>Surname & Initials</th>
                          <th>Campus</th>
                          <th>Email</th>
                          <th>User Type</th>
                          <th>Date Created</th>
                          <th></th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Picture</th>
                          <th>Surname & Initials</th>
                          <th>Campus</th>
                          <th>Email</th>
                          <th>User Type</th>
                          <th>Date Created</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php  
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
                                      <td><?php echo $counter;?></td>
                                      <td><div class="avatar-lg"><img src="../../<?php echo $fac_n['photo'];?>" alt="image profile" class="avatar-img rounded"></div></td>
                                      <td><?php echo $fac_n['initials'].' '.$fac_n['lastname'];?></td>
                                      <td><?php echo $fac_n['campus'];?></td>
                                      <td><?php echo $fac_n['email'];?></td>
                                      <td><?php echo $fac_n['user_type'];?></td>
                                      <td><?php echo $fac_n['date_created'];?></td>
                                      <td><a href="user_edit.php?u=<?php echo $fac_n['user_id'];?>" >Edit</a></td>
                                      <td><a onclick="delete_user(<?php echo $fac_n['user_id'];?>)" style="color:red;hover;" pointer >Delete</a></td>
                                    </tr>
                                          
                                          <?php
                                      
                                  }
                                  
                                 
                                  
                              }else{
                                  echo "error ".mysqli_error($conn);
                              }

                              

                          ?>
                        <!-- <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011/04/25</td>
                          <td>$320,800</td>
                        </tr>
                        <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                          <td>$170,750</td>
                        </tr> -->
                    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

			</div>
    </div>
    <script>
      function delete_user(u_id) {
        if (confirm("Are you sure you want to delete this user?") == true) {
            
            window.location="user_delete.php?u="+u_id;
          }
      }
    </script>
  <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
 

<script >
    $(document).ready(function() {
      $('#basic-datatables').DataTable({
      });

      $('#multi-filter-select').DataTable( {
        "pageLength": 5,
        initComplete: function () {
          this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
                );

              column
              .search( val ? '^'+val+'$' : '', true, false )
              .draw();
            } );

            column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
          } );
        }
      });

      // Add Row
      $('#add-row').DataTable({
        "pageLength": 5,
      });

      var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $('#addRowButton').click(function() {
        $('#add-row').dataTable().fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action
          ]);
        $('#addRowModal').modal('hide');

      });
    });
  </script>

<?php include "footer.php";?>