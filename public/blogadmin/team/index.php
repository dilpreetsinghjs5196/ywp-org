<?php @include("{$currDir}/hooks/links-home.php"); ?>
<?php include("db_config.php"); ?>


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
        <!-- <ul class="nav navbar-nav navbar-right navbar-user">-->
        <!--    <li class="dropdown messages-dropdown">-->
        <!--      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>-->
        <!--      <ul class="dropdown-menu">-->
        <!--        <li class="dropdown-header">7 New Messages</li>-->
        <!--        <li class="message-preview">-->
        <!--          <a href="#">-->
        <!--            <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
        <!--            <span class="name">John Smith:</span>-->
        <!--            <span class="message">Hey there, I wanted to ask you something...</span>-->
        <!--            <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
        <!--          </a>-->
        <!--        </li>-->
        <!--        <li class="divider"></li>-->
        <!--        <li class="message-preview">-->
        <!--          <a href="#">-->
        <!--            <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
        <!--            <span class="name">John Smith:</span>-->
        <!--            <span class="message">Hey there, I wanted to ask you something...</span>-->
        <!--            <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
        <!--          </a>-->
        <!--        </li>-->
        <!--        <li class="divider"></li>-->
        <!--        <li class="message-preview">-->
        <!--          <a href="#">-->
        <!--            <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
        <!--            <span class="name">John Smith:</span>-->
        <!--            <span class="message">Hey there, I wanted to ask you something...</span>-->
        <!--            <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
        <!--          </a>-->
        <!--        </li>-->
        <!--        <li class="divider"></li>-->
        <!--        <li><a href="#">View Inbox <span class="badge">7</span></a></li>-->
        <!--      </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown alerts-dropdown">-->
        <!--      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>-->
        <!--      <ul class="dropdown-menu">-->
        <!--        <li><a href="#">Default <span class="label label-default">Default</span></a></li>-->
        <!--        <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>-->
        <!--        <li><a href="#">Success <span class="label label-success">Success</span></a></li>-->
        <!--        <li><a href="#">Info <span class="label label-info">Info</span></a></li>-->
        <!--        <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>-->
        <!--        <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>-->
        <!--        <li class="divider"></li>-->
        <!--        <li><a href="#">View All</a></li>-->
        <!--      </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown user-dropdown">-->
        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  admin<b class="caret"></b></a>-->
        <!--    <ul class="dropdown-menu">-->
        <!--      <li><a href="membership_profile.php"><i class="fa fa-user"></i> <strong>My Profile Details</strong> </a></li>-->
        <!--      login/logout area starts-->
        <!--      <li>-->
        <!--                      <a href="admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm hidden-xs"><i class="fa fa-cog"></i> <strong>Admin Area</strong></a>-->
        <!--       <a href="admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm visible-xs btn-sm"><i class="fa fa-cog"></i> <strong>Admin Area</strong></a>-->
        <!--                                                   <ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">-->
        <!--      </ul>-->
        <!--      <ul class="nav navbar-nav visible-xs">-->
        <!--      </ul>-->
        <!--                                </li>-->
        <!--    login/logout area ends-->
        <!--    <li class="divider"></li>-->
        <!--    <li><a class="btn navbar-btn btn-primary" href="index.php?signOut=1"><i class="fa fa-power-off"></i> <strong style="color:white">Sign Out</strong> </a></li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!--  </ul>-->
        </div><!-- /.navbar-collapse -->
      </nav>
      
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Team</h1>
                <!--<ol class="breadcrumb">-->
                <!--  <li><a href="../index.php"><i class="icon-dashboard" style="text-decoration:none;"></i> <strong>View Website</strong></a></li>-->
                <!--  <li><a href="index.php"><i class="icon-dashboard" style="text-decoration:none;"></i> <strong>Dashboard</strong></a></li>-->
                <!--</ol>-->
            <!--<div class="alert alert-success fade in">-->
            <!--    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
            <!--    <strong><span class="fa fa-bullhorn fa-2x"></span> </strong> <strong>&nbsp;&nbsp;Welcome to your Admin Dashboard!!</strong>.-->
            <!--</div>          -->
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
                        <div class="d-flex justify-content-center"><a href="createteam.php" class="btn btn-primary">Add</a></div>
                    </div>
                  <table class="table mb-0" border="1">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Position</th>
                        <th>User Title</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM `teams` ";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                            ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['user_name'];?></td>
                            <td><?php echo $row['user_position'];?></td>
                            <td><?php echo $row['user_title'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><img src="images/<?php echo $row['photo'];?>" width="150" height="200"></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
                                <a class="delete text-red" title="Delete" data-toggle="tooltip" data-id="<?php echo $row['id'];?>" style="margin-left: 1rem;">delete</a>
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