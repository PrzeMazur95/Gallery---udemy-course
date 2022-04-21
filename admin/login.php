<?php require_once("includes/header.php"); ?>

<?php

if($session->is_signed_in()){

    redirect("index.php");

}

if(isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $pwd = trim($_POST['pwd']);


    $user_found = User::verify_user($name, $pwd);


    if($user_found){

        $session->login($user_found);
        redirect("index.php");

    }else{

        echo $the_message = "Your password or username are incorrect";

    }

}else{

$name = "";
$pwd = "";

}



?>


<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php $the_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="name" value="<?php echo htmlentities($name); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="pwd" value="<?php echo htmlentities($pwd); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>