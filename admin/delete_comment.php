<?php include("includes/init.php"); ?>



<?php 

if(!$session->is_signed_in()){

    redirect("login.php");
    
} 

 
if(empty($_GET['id'])){

    redirect("users.php");

}


$comment = Comment::find_by_id($_GET['id']);


if($comment){

    $comment->delete();
    redirect("comments.php");

} else {

    echo "Something went wrong";

}