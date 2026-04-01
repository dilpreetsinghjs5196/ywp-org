<?php if(!isset($Translation)){ @header('Location: index.php'); exit; } ?>
  <?php include_once("{$currDir}/header-user.php"); ?>
  <?php @include("{$currDir}/hooks/links-home.php"); ?>
 <?php include('../config.php'); ?>
 <?php include('../database/db_connect.php'); ?>
 

<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
</head>
<body>

 
 
 
 <h2>All Contact</h2>
 
 
  <!-- Basic Tables start -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
             
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                  
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                 
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div>
                    <a href="export-contact.php" class="btn btn-success">Export to Excel</a>
                    <!--<form action="export-contact.php" method="post">-->
                    <!--    <input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel">-->
                    <!--</form>-->
                </div>
                <p class="px-1">
                
                <div class="table-responsive">
                  <table class="table mb-0" border="1">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        
                        
                        <th>Email</th>
                        <th>Age</th>
                        <th>Hear about us</th>
                        <th>Departmental Preference 1</th>
                        <th>Departmental Preference 2</th>
                        <th>Departmental Preference 3</th>
                        
                        <th>In case none of the aforementioned departments<br/> interest you, please let us know what you<br/> wish to do as a part of YWP;</th>
                        <th>What motivates you to be a part of YWP;?</th>
                        <th>What are your views on mental health awareness<br/> and accessibility in India? *</th>
                        <th>Any other information that you'd like to provide</th>
                       <th width="400px">if you have been part of the Discover Bootcamp, .... ?</th>
                       <th>if you are a person with disability or a dalit,...?</th>
                        <th>Posting Date</th>
                        <th>Filename</th>
                        <th>size (in mb)</th>
                        <th>Downloads</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 

$sql ="SELECT id,FullName,PhoneNumber,EmailId,Age,Hearing,Dept_pref1,Dept_pref2,Dept_pref3,Aforementioned_ans,Motivates_ans,Mental_health_ans,Other_info_ans,Part_of,Person_with, PostingDate, name, size, downloads from tblcontactdata";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0):
foreach($results as $result):
       ?>

                      <tr>
                  <th scope="row"><?php echo htmlentities($cnt);?></th>
                  <td><?php echo htmlentities($result->FullName);?></td>
                  <td><?php echo htmlentities($result->PhoneNumber);?></td>
                  
                  
                  <td><?php echo htmlentities($result->EmailId);?></td>
                  <td><?php echo htmlentities($result->Age);?></td>
                  <td><?php echo htmlentities($result->Hearing);?></td>
                  <td><?php echo htmlentities($result->Dept_pref1);?></td>
                  <td><?php echo htmlentities($result->Dept_pref2);?></td>
                  <td><?php echo htmlentities($result->Dept_pref3);?></td>
                  
                  <td><?php echo htmlentities($result->Aforementioned_ans);?></td>
                  <td><?php echo htmlentities($result->Motivates_ans);?></td>
                  <td><?php echo htmlentities($result->Mental_health_ans);?></td>
                  <td ><?php echo htmlentities($result->Other_info_ans);?></td>
                  <td width="400px"><?php echo htmlentities($result->Part_of);?></td>
                  <td><?php echo htmlentities($result->Person_with);?></td>
                  
                  <td><?php echo htmlentities($result->PostingDate);?></td>
                    <td><?php echo htmlentities($result->name);?></td>
                      <td><?php echo htmlentities($result->size);?></td>
                        <td><?php echo htmlentities($result->downloads);?></td>
                        <td><a href="../uploads/<?php echo htmlentities($result->name);?>" download>Download</a></td>
                         <!--<td><a href="downloads.php?file_id=<?php echo htmlentities($result->id);?>">Download</a></td>-->


                  
                      </tr>
                      <?php
                      $cnt++;
endforeach;
else: ?>
<tr>
<td colspan="5" style="color:red; font-size:22px;" align="center">No Record found</td>
</tr>
<?php  
endif;
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Basic Tables end -->
        
        
        
        
        
        
        

       
  
     

   
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
<footer class="footer footer-inverse">
      <div class="container">
        <div class="text-center">
          <small>YMP Admin 2022 | Brought To You By Alpine  Technologies</small>
        </div>
      </div>
    </footer>
  </body>
</html>