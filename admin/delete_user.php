<?php include("includes/init.php"); ?>



<?php 

if(!$session->is_signed_in()){

    redirect("login.php");
    
} 

 
if(empty($_GET['id'])){

    redirect("users.php");

}


$user = User::find_by_id($_GET['id']);


if($user){

    $session->message("The user {$user->nickname} has been deleted!");

    $user->delete();
    
    redirect("users.php");

} else {

    redirect("users.php");

}