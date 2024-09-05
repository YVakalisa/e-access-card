<?php include "header.php";
$counter=0;
     
?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Staff Card</h4>
						
					</div>
					<div class="row">
						  <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">My Staff Card History</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date created</th>
                          <th>Office Number</th>
                          <th>QR Code</th>
                          <!-- <th>Start date</th>
                          <th>Salary</th> -->
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Date created</th>
                          <th>Office Number</th>
                          
                          <th>QR Code</th>
                          <!-- <th>Start date</th>
                          <th>Salary</th> -->
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php  
                                   // echo $f_id;
                            $sql2="SELECT QR_code,c.card_id as c_card, c.user_id as user_id, c.issue_date as date,sc.card_id as sc_card, sc.office_number as office_number FROM `staff_card` as sc,`card` as c where c.user_id='$id' and c.card_id=sc.card_id";
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
                                      <td><?php echo $fac_n['date'];?></td>
                                      <td><?php echo $fac_n['office_number'];?></td>
                                      <td><a href="../../<?php echo $fac_n['QR_code'];?>" target="_blank" download="<?php echo $stud_no;?>_qr">Download</a></td>
                                    <!-- <td><a href="mycard.php?s=<?php echo $fac_n['student_card_id'];?>" target="_blank" >view</a></td> -->
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