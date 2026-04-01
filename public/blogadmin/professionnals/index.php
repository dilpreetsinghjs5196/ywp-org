<?php @include("{$currDir}/hooks/links-home.php"); ?>
<?php include("../team/db_config.php"); ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
  <!--Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
   <!--Add custom CSS here -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
<div id="wrapper">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <!--Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">YMP ADMIN</a>
        </div>

         <!--Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="../index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="../blogs_view.php"><i class="fa fa-rss"></i>Blogs</a></li>
            <li><a href="../blog_categories_view.php"><i class="fa fa-tags"></i>Categories</a></li>
            <li><a href="../blogs_view.php"><i class="fa fa-check"></i>Published</a></li>
            <li><a href="#"><i class="fa fa-tasks"></i>Drafts</a></li>
            <li><a href="../team/index.php"><i class="fa fa-tasks"></i>Team</a></li>
            <li><a href="../professionnals/index.php"><i class="fa fa-tasks"></i>On-Board Professionals</a></li>
            <li><a href="../titles_view.php"><i class="fa fa-desktop"></i>Web Details</a></li>
            <li><a href="../links_view.php"><i class="fa fa-link"></i>Links</a></li>
            <li><a href="../editors_choice_view.php"><i class="fa fa-trophy"></i>Editors Choice</a></li>
            <li><a href="../../adminstats"><i class="fa fa-bar-chart-o"></i>Admin Stats</a></li>
            <li><a href="../contact-details.php"><i class="fa fa-group" aria-hidden="true"></i>Contact Details</a></li>          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>On-Board Professionals</h1>
        </div>
    </div>
    <!--<h2>All Contact</h2>-->
 
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
                <div class="table-responsive">
                    <div class="row>
                        <div class="d-flex justify-content-center"><a href="create.php" class="btn btn-primary">Add</a></div>
                    </div>
                  <table class="table mb-0" border="1">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <!--<th style="width: 0px;">Gender</th>-->
                        <!--<th>Position</th>-->
                        <th>Profession</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th style="width: 150px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM `on_board_professionals` ";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                            ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['user_name'];?></td>
                            <!--<td><?php //echo $row['gender'];?></td>-->
                            <!--<td><?php //echo $row['position'];?></td>-->
                            <td><?php echo $row['qualification'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td style="width: 150px;"><img src="images/<?php echo $row['photo'];?>" width="150" height="200"></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
                                <a class="delete btn btn-danger" title="Delete" data-toggle="tooltip" data-id="<?php echo $row['id'];?>" style="margin-left: 1rem;">delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Basic Tables end -->
        <footer class="footer footer-inverse">
      <div class="container">
        <div class="text-center">
          <small>YMP Admin 2022 | Brought To You By Alpine  Technologies</small>
        </div>
      </div>
    </footer>
</div>
<!--JavaScript -->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.js"></script>

<script language="Javascript">
$(document).on("click", ".delete", function(){
    var id = $(this).data('id');
    console.log(id, 'jo');
    Swal.fire({
    title: 'Are you sure?',
    text: "You want to delete it!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        isCheck(id);
    }
    })
});

function isCheck(id){
    $.ajax({
        url:'server.php/'+id,
        method:'GET',
        dataType:"json",
        data: {
            id:id       
        },
        success:function(r){
            window.location.reload(); 
        }
    }) 
     
}
 </script>
</body>
</html>