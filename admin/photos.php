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
                    <small>Subheading</small>
                </h1>

            <div class="col-md-12">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>File name</th>
                            <th>Tittle</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $Photos = Photo::find_all();

                        foreach ($Photos as $Photo) : ?>

                            <tr>
                                <td><img src="<?php echo $Photo->picture_path();   ?>" class="img-thumbnail" alt=""></td>
                                <td><?php echo $Photo->photo_id; ?></td>
                                <td><?php echo $Photo->filename; ?></td>
                                <td><?php echo $Photo->tittle; ?></td>
                                <td><?php echo $Photo->size; ?></td>
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