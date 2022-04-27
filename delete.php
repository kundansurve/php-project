<?php
require_once "config.php";
// Initialize the session
session_start();
 
$sql3="SELECT id from users where username like '".$_SESSION["username"]."'";
echo $sql3;
  if($stmt3 = mysqli_prepare($link, $sql3)){
    // Bind variables to the prepared statement as parameters
            
            if(mysqli_stmt_execute($stmt3)){
              if($result1 = $stmt3->get_result()){
                if($data1 = $result1->fetch_assoc()){
                  $sql4="DELETE from developersinfo where userid like '".$data1['id']."'";
                  if($stmt4 = mysqli_prepare($link, $sql4)){
                    if(mysqli_stmt_execute($stmt4)){
                      $sql5 = "DELETE from users where username like ?";
                      if($stmt5 = mysqli_prepare($link, $sql5)){
                        mysqli_stmt_bind_param($stmt5, "s",$_SESSION["username"]);
                        if(mysqli_stmt_execute($stmt5)){
                            // Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
                        }
                      }
                    }
                  }
                }
              }
            }
          }

// Unset all of the session variables

exit;
?>