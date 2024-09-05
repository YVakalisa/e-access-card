<?php
include 'top_nav.php';

?>

<!--close-top-Header-menu-->
<!--start-top-serch-->

<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar">
  <?php
include 'side_nav.php';

?>

</div>
<!--close-left-menu-stats-sidebar-->

         
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  </div>
    <h1>My Student Card</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Year</th>
                  <th>Have Residence?</th>
                  <th>Have Bus?</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
               
                  
                <?php  
                         // echo $f_id;
                  $sql2="SELECT * from student_card where student_id='$id'";
                              $query=mysqli_query($conn,$sql2);
                             $rowsn=mysqli_num_rows($query);
                              //echo "rows ". $rowsn;
                              if ($query) {
                                  # code...
                                  while ($fac_n=mysqli_fetch_assoc($query)) {
                                      # code...
                                      
                                          # code...
                                    ?>
                                     <tr class="gradeX">
                                      <td><?php echo $fac_n['date'];?></td>
                                      <td><?php 
                                        if($fac_n['residence']==0){
                                          echo "No";
                                        }else{
                                          echo "Yes";
                                        }
                                    ?></td>
                                      <td><?php 
                                        if($fac_n['bus']==0){
                                          echo "No";
                                        }else{
                                          echo "Yes";
                                        }
                                    ?></td>
                                    <td><a href="mycard.php?s=<?php echo $fac_n['student_card_id'];?>" target="_blank" >view</a></td>
                                    </tr>
                                          
                                          <?php
                                      
                                  }
                                  
                                 
                                  
                              }else{
                                  echo "error ".mysqli_error($conn);
                              }

                              

                          ?>
                                                                

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> &copy; 2022 </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
</body>
</html>
