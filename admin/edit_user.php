<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>

<?php if(!$session->is_signed_in()){

    redirect("login.php");

} ?>


<?php 

if(!isset($_GET['id'])){

    redirect("users.php");

} 

$user = User::find_by_id($_GET['id']);



    if(isset($_POST['update'])){

        if($user){

            $user->nickname = $_POST['nickname'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['pass'];

            if(empty($_FILES['user_image'])){

                $user->save();

            } else {
                
                $user->set_file($_FILES['user_image']);

                $user->upload_photo();

                $user->save();

                redirect("edit_user.php?id={$user->id}");

            }

            

        }

    }

    if(isset($_POST['delete'])){

        if($user){

            $user->delete();
            redirect("users.php");

        }

    }


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


                <div class="col-md-6">

                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_placeholder(); ?> " class="img-responsive" alt=""></a>


                </div>

        <form action="" method="post" enctype="multipart/form-data">

        

            <div class="col-md-6">

                <div class="form-group">

                <label for="picture">Add photo</label>
                    <input type="file" name="user_image">

                </div>

                <div class="form-group">

                <label for="nicknae">Username</label>
                    <input type="text" name="nickname" class="form-control" value="<?php echo $user->nickname; ?>">

                </div>

                <div class="form-group">

                <label for="firstname">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">

                </div>

                <div class="form-group">

                    <label for="lastname">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">

                </div>
                <div class="form-group">

                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control" value="<?php echo $user->pass ?>">

                </div>

                <div class="form-group">

                    <input type="submit" name="update" class="btn btn-primary" value="Update">

                    <input type="submit" name="delete" class="btn btn-danger pull-right" value="Delete">

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