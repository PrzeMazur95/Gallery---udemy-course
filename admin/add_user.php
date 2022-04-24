<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){

    redirect("login.php");

} ?>


<?php 

if(isset($_POST['create'])){



}


// $user = user::find_by_id($_GET['id']);

// if(isset($_POST['update'])){

//     if($user){

//         $user->tittle = $_POST['tittle'];
//         $user->caption = $_POST['caption'];
//         $user->alternate_text = $_POST['alternate_text'];
//         $user->description = $_POST['description'];


//         $user->save();

//     }

// }
    







?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            <?php include ("includes/top_nav.php") ?>



            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include ("includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add new User
                </h1>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="col-md-6 col-md-offset-3">

                <div class="form-group">

                <label for="picture">Add photo</label>
                    <input type="file" name="user_image">

                </div>

                <div class="form-group">

                <label for="username">Username</label>
                    <input type="text" name="nickname" class="form-control">

                </div>

                <div class="form-group">

                <label for="firstname">First Name</label>
                <input type="text" name="first_name" class="form-control">

                </div>

                <div class="form-group">

                    <label for="lastname">Last Name</label>
                    <input type="text" name="last_name" class="form-control">

                </div>
                <div class="form-group">

                    <label for="password">Password</label>
                    <input type="text" name="pass" class="form-control">

                </div>

                <div class="form-group">

                    <input type="submit" name="create" class="btn btn-primary">

                </div>


            </div>
        
            </form>
                
            </div>
        </div>
        <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>