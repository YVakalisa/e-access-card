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
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<div class="row-fluid">
      <div class="span6" style="width: 100%;">
        <div class="widget-box widget-chat">
      <h1>Welcome <?php echo $name." ".$surname;?> </h1>
      <!-- <img src="../images/6.jpg" style="width: 100%;">  -->  
            
          </div>
        </div>
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Personal-info</h5>
        </div>
         
        <div class="widget-content nopadding">
          <form action="#" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">First Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Enter First name" name="name" value="<?php echo $name;?>" readonly/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Last Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Enter Last name" name="surname" value="<?php echo $surname;?>" readonly/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email</label>
              <div class="controls">
                <input type="email"  class="span11" placeholder="Enter Email" name="email" value="<?php echo $email;?>"  readonly/>
              </div>
            </div>
            

            <div class="control-group">
              <label class="control-label">Student number:</label>
              <div class="controls">
                <input type="text" class="span11" value="<?php echo $student_no;?>" placeholder="Enter Student number" name="cellno" readonly/>
            </div>

            <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            
                            <select name="campus" readonly>
                             <option><?php echo $campus;?></option>
                            </select>
                            <br>
                            
                        </div>
                    </div>
                </div>
            
            <div class="border-top">
                <div class="card-body">
                   
                    <a href="profile.php" class="btn btn-primary" style="width:96%;">Edit Details</a>
                </div>
            </div>
          </form>
        </div>
      </div>

      
    </div>
</div>
</div>
        
</div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> &copy; 2021</div>
</div>

<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<script src="js/matrix.interface.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
