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
            <li><a href="../contact-details.php"><i class="fa fa-group" aria-hidden="true"></i>Contact Details</a></li>          
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Add team</h1>
            </div>
        </div>
    <!--<h2>All Contact</h2>-->
 
        <!-- Basic Tables start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center"><a href="index.php" class="btn btn-info">Back</a></div>
                </div>
                <hr>
                <br>
                <div class="card-content">
                    <form action="server.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-8" style="margin-left: 19rem;">
                                <div class="form-group col-md-12">
                                  <label>User name</label>
                                  <input type="text" class="form-control" name="user_name">
                                </div>
                                <div class="form-group col-md-12">
                                  <label>User position</label>
                                  <input type="text" class="form-control" name="user_position">
                                </div>
                                <div class="form-group col-md-12">
                                  <label>User title</label>
                                  <input type="text" class="form-control" name="user_title">
                                </div>
                                <div class="form-group col-md-12">
                                  <label>User photo</label>
                                  <input type="file" class="form-control" name="photo">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="exampleFormControlTextarea1">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit_team">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--JavaScript -->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.js"></script>

</body>
</html>