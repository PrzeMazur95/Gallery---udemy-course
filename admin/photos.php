<?php include("includes/header.php"); ?>

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
                    Photos
                </h1>
            <p class="bg-success"><?php echo $session->message; ?></p>
            <div class="col-md-12">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>File name</th>
                            <th>Tittle</th>
                            <th>Size</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $Photos = Photo::find_all();

                        foreach ($Photos as $Photo) : ?>

                            <tr>
                                <td><img class="admin-photo-thumbnail" src="<?php echo $Photo->picture_path();   ?>" class="img-thumbnail" alt="">

                                    <div class="actions_link">

                                        <a class="delete_link" href="delete_photo.php?id=<?php echo $Photo->id;?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $Photo->id;?>">Edit</a>
                                        <a href="../photo.php?id=<?php echo $Photo->id; ?>">View</a>

                                    </div>
                            
                                </td>
                                <td><?php echo $Photo->id; ?></td>
                                <td><?php echo $Photo->filename; ?></td>
                                <td><?php echo $Photo->tittle; ?></td>
                                <td><?php echo $Photo->size; ?></td>
                                <td>
                                    <a href="comment_photo.php?id=<?php echo $Photo->id; ?>">

                                        <?php 
                                            $comments = Comment::find_the_comments($Photo->id); 
                                            echo count($comments);
                                            
                                        ?>

                                    </a>
                                </td>
                            </tr>
                        
                        <?php endforeach; ?>
    
                    </tbody>
                </table>


            </div>


                
            </div>
        </div>
        <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>