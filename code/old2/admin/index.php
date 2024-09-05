<?php
include 'top_nav.php';
?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
           <?php
include 'side_nav.php';
?>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="span6" style="width: 100%;">
        <div class="widget-box widget-chat">
      <h1>Welcome <?php echo $name." ".$surname;?> </h1>
        
            
          </div>
        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="bg-dark p-10 text-white text-center">
                                                   <i class="fa fa-user m-b-5 font-16"></i>
                                                   <?php
                                                      $doha_num=0;
                                                        $doha=mysqli_query($conn,"SELECT * FROM `student`");
                                                        if ($doha) {
                                                          # code...
                                                          $doha_num=mysqli_num_rows($doha);
                                                          //$dddd=mysqli_fetch_assoc($doha);
                                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                                        }else{
                                                          echo "Error! ".mysqli_error($conn);
                                                        }

                                                    ?>
                                                   <h5 class="m-b-0 m-t-5"><?php echo $doha_num;?></h5>
                                                   <small class="font-light">Students</small>
                                                </div>
                                            </div>
                                             <div class="col-6">
                                                <div class="bg-dark p-10 text-white text-center">
                                                   <i class="fa fa-users m-b-5 font-16"></i>
                                                   <?php
                                                  $DBE_num=0;
                                                    $DBE=mysqli_query($conn,"SELECT * FROM `staff`");
                                                    if ($DBE) {
                                                      # code...
                                                      $DBE_num=mysqli_num_rows($DBE);
                                                      //$dddd=mysqli_fetch_assoc($doha);
                                                      //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                                    }else{
                                                      echo "Error! ".mysqli_error($conn);
                                                    }

                                                  ?>
                                                   <h5 class="m-b-0 m-t-5"><?php echo $DBE_num;?></h5>
                                                   <small class="font-light">Staff</small>
                                                </div>
                                            </div>

                                            <!--<div class="col-6 m-t-15">
                                                <div class="bg-dark p-10 text-white text-center">
                                                   <i class="fa fa-plus m-b-5 font-16"></i>
                                                   <?php
                                                      $DEL_num=0;
                                                        $DEL=mysqli_query($conn,"SELECT * FROM `student_card`");
                                                        if ($DEL) {
                                                          # code...
                                                          $DEL_num=mysqli_num_rows($DEL);
                                                          //$dddd=mysqli_fetch_assoc($doha);
                                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                                        }else{
                                                          echo "Error! ".mysqli_error($conn);
                                                        }

                                                      ?>
                                                   <h5 class="m-b-0 m-t-5"><?php echo $DEL_num;?></h5>
                                                   <small class="font-light">Student Cards</small>
                                                </div>
                                            </div>-->
                                             <!--<div class="col-6 m-t-15">
                                                <div class="bg-dark p-10 text-white text-center">
                                                   <i class="fa fa-tag m-b-5 font-16"></i>
                                                   <?php
                                                      $DSD_num=0;
                                                        $DSD=mysqli_query($conn,"SELECT * FROM `staff_card`");
                                                        if ($DBE) {
                                                          # code...
                                                          $DSD_num=mysqli_num_rows($DSD);
                                                          //$dddd=mysqli_fetch_assoc($doha);
                                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                                        }else{
                                                          echo "Error! ".mysqli_error($conn);
                                                        }

                                                      ?>
                                                      
                                                   <h5 class="m-b-0 m-t-5"><?php echo $DSD_num;?></h5>
                                                   <small class="font-light">Staff Card</small>
                                                </div>
                                            </div>-->
                                            
                                        </div>
                                    </div>
                                    <!-- column -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Faculty</h5>
                            </div>
                            <table class="table">
                                
                                <thead>
                                    <tr>
                                        <th scope="col">Faculty Code</th>
                                        <th scope="col">Number of Student</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    
                                    <?php
                                      $SARS_num=0;
                                        $SARS=mysqli_query($conn,"SELECT * FROM `faculty`");
                                        if ($SARS) {
                                          # code...
                                          $SARS_num=mysqli_num_rows($SARS);
                                          //$dddd=mysqli_fetch_assoc($doha);
                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                          while ($row1=mysqli_fetch_assoc($SARS)) {
                                              # code...
                                            echo "<tr><td>".$row1['faculty_code']."</td>";
                                            $faculty_id_fk=$row1['faculty_id'];
                                            $SARS_num2=0;
                                            $SARS_num3=0;
                                            $SARS2=mysqli_query($conn,"SELECT * FROM `course` WHERE faculty_id_fk='$faculty_id_fk'");
                                            if ($SARS2) {
                                              # code...
                                              $SARS_num2=mysqli_num_rows($SARS2);
                                                
                                              while ($row11=mysqli_fetch_assoc($SARS2)) {
                                                  # code...
                                                $course_id_fk=$row11['course_id'];
                                                
                                                $SARS3=mysqli_query($conn,"SELECT * FROM `student_course` WHERE course_id_fk='$course_id_fk'");
                                                if ($SARS3) {
                                                  # code...
                                                  $SARS_num3=mysqli_num_rows($SARS3)+$SARS_num3;
                                                 }
                                                 

                                                  }
                                             }
                                             echo "<td>".$SARS_num3."</td></tr>";
                                             //echo "<td>".$SARS_num2."</td></tr>";
                                          }
                                        }else{
                                          echo "Error! ".mysqli_error($conn);
                                        }

                                      ?>
                                    
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Course</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course Code</th>
                                        <th scope="col">Number of Student</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                      $CIPC_num=0;
                                        $CIPC=mysqli_query($conn,"SELECT * FROM `course`");
                                        if ($CIPC) {
                                          # code...
                                          $CIPC_num=mysqli_num_rows($CIPC);
                                          //$dddd=mysqli_fetch_assoc($doha);
                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                          while ($row2=mysqli_fetch_assoc($CIPC)) {
                                              # code...
                                            echo "<tr><td>".$row2['course_code']."</td>";
                                            $course_id_fk=$row2['course_id'];
                                            $CIPC_num2=0;
                                            $CIPC2=mysqli_query($conn,"SELECT * FROM `student_course` WHERE course_id_fk='$course_id_fk'");
                                            if ($CIPC2) {
                                              # code...
                                              $CIPC_num2=mysqli_num_rows($CIPC2);
                                             }
                                             echo "<td>".$CIPC_num2."</td></tr>";
                                          }
                                        }else{
                                          echo "Error! ".mysqli_error($conn);
                                        }

                                      ?>
                                    
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Module</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Module code</th>
                                        <th scope="col">Number of Student</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                      $DOT_num=0;
                                        $DOT=mysqli_query($conn,"SELECT * FROM `module`");
                                        if ($DOT) {
                                          # code...
                                          $DOT_num=mysqli_num_rows($DOT);
                                          //$dddd=mysqli_fetch_assoc($doha);
                                          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                                          while ($row3=mysqli_fetch_assoc($DOT)) {
                                              # code...
                                            echo "<tr><td>".$row3['module_code']."</td>";
                                            $module_id_fk=$row3['module_id'];
                                            $DOT_num2=0;
                                            $DOT2=mysqli_query($conn,"SELECT * FROM `student_module` WHERE module_id_fk='$module_id_fk'");
                                            if ($DOT2) {
                                              # code...
                                              $DOT_num2=mysqli_num_rows($DOT2);
                                             }
                                             echo "<td>".$DOT_num2."</td></tr>";
                                          }
                                          
                                        }else{
                                          echo "Error! ".mysqli_error($conn);
                                        }

                                      ?>
                                    
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->



                        

                    
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php
        include 'footer.php';
    ?>

</body>

</html>