<?php
require_once "config.php";

// Initialize the session

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file

 
// Define variables and initialize with empty values
$emailaddress="";
$firstname="";
$lastname="";
$githublink="";
$linkedinlink="";
$hackerranklink="";
$about="";
$profiletitle="";
$username=$_SESSION["username"];
$profileUpdate="";

$sql3="SELECT id from users where username like ?";
  if($stmt3 = mysqli_prepare($link, $sql3)){
    // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt3, "s",$username);
            if(mysqli_stmt_execute($stmt3)){
              if($result1 = $stmt3->get_result()){
                if($data1 = $result1->fetch_assoc()){
                  $sql4="SELECT * from developersinfo where userid like ?";
                  if($stmt4 = mysqli_prepare($link, $sql4)){
                    mysqli_stmt_bind_param($stmt4, "s",$data1['id']);
                    if(mysqli_stmt_execute($stmt4)){
                      if($result = $stmt4->get_result()){
                        if($data = $result->fetch_assoc()){
                          
                          $emailaddress=$data['emailaddress'];
                          $firstname=$data['firstname'];
                          $lastname=$data['lastname'];
                          $githublink=$data['githublink'];
                          $linkedinlink=$data['linkedinlink'];
                          $hackerranklink=$data['hackerranklink'];
                          $about=$data['about'];
                          $profiletitle=$data['profiletitle'];
                        }
                      }
                    }
                  }
                }
              }
            }
          }
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //$sql="UPDATE develpersinfo SET field1 = new-value1, field2 = new-value2"
  $sql="SELECT id from users where username like ?";
  if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s",$username);
            if(mysqli_stmt_execute($stmt)){
              if($result = $stmt->get_result()){
                if($data = $result->fetch_assoc()){
                  
                $sql1="UPDATE developersinfo SET firstname=?, lastname=?, emailaddress=?, about=?, profiletitle=?, githublink=?, linkedinlink=?, hackerranklink=? WHERE userid=".$data["id"];
                if($stmt1 = mysqli_prepare($link, $sql1)){
                  mysqli_stmt_bind_param($stmt1, "ssssssss",$_POST["firstname"],$_POST["lastname"],$_POST["emailaddress"],$_POST["about"],$_POST["profiletitle"],$_POST["githublink"],$_POST["linkedinlink"],$_POST["hackerranklink"]);
                  if(mysqli_stmt_execute($stmt1)){
                    $profileUpdate="Profile Updated Successfully";
                    $emailaddress=$_POST['emailaddress'];
                    $firstname=$_POST['firstname'];
                    $lastname=$_POST['lastname'];
                    $githublink=$_POST['githublink'];
                    $linkedinlink=$_POST['linkedinlink'];
                    $hackerranklink=$_POST['hackerranklink'];
                    $about=$_POST['about'];
                    $profiletitle=$_POST['profiletitle'];
                  }else{
                    $profileUpdate="";
                  }
                }else{
                  $profileUpdate="";
                }
              }else{
                $profileUpdate="";
              }
              }else{
                $profileUpdate="";
              }
          }else{
            $profileUpdate="";
          }
        }else{
          $profileUpdate="";
        }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developers Profile</title>
    <link rel="stylesheet" type="text/css" href="./profilepage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Developer Profile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
        <?php
  $param = $_SESSION["username"];
?><a style="color:white " class="nav-link" href="profilepage.php?profile=<?php echo $username; ?>">Your Profile</a> 
        </li>
        <li class="nav-item">
          <a style="color:white " class="nav-link" href="welcome.php">Update Profile</a>
        </li>
        <li class="nav-item dropdown">
          <a style="color:white " class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo htmlspecialchars($_SESSION["username"]); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" style="color:black" href="logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Developer's Profile.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="delete.php" class="btn btn-danger ml-3">Delete Your Account</a>
    </p>
    <h2>Create Your Profile</h2>
    <div style="width:automargin:1em;display:flex;justify-content:center;align-items:center">
    <div style="border:1px solid black;border-radius:5px;max-width:600px;margin-bottom:2em;width:90%;padding:1em;display:flex;justify-content:center;align-items:center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:90%;margin-bottom:1em">
    <div class="form-group" >
    <label for="firstname" style="float:left">First Name</label>
    <input type="text" name="firstname" class="form-control" id="firstname"  value="<?php echo $firstname; ?>" >
  </div>
  <div class="form-group" >
    <label style="float:left" for="lastname">Last Name</label>
    <input type="text" name="lastname" class="form-control" id="lastname"  value="<?php echo $lastname; ?>" >
  </div>
  <div class="form-group" >
    <label style="float:left" for="emailaddress">Email address</label>
    <input type="email" name="emailaddress" class="form-control" id="emailaddress" value="<?php echo $emailaddress; ?>" >
  </div>

  <div class="form-group">
    <label style="float:left" for="about">About</label>
    <textarea class="form-control" name="about" id="about" rows="5" ><?php echo $about; ?></textarea>
  </div>
  <div class="form-group" >
    <label style="float:left" for="profiletitle">Profile Title</label>
    <input type="text" class="form-control" name="profiletitle" id="profiletitle" value="<?php echo $profiletitle; ?>" >
  </div>
  <div class="form-group" >
    <label style="float:left" for="githublink">GitHub Link</label>
    <input type="text" class="form-control" name="githublink" id="githublink" value="<?php echo $githublink; ?>">
  </div>
  <div class="form-group" >
    <label style="float:left" for="linkedinlink">Linkedin Link</label>
    <input type="text" class="form-control" name="linkedinlink" id="linkedinlink" value="<?php echo $linkedinlink; ?>" >
  </div>
  <div class="form-group" >
    <label style="float:left" for="hackerranklink">HackerRank Link</label>
    <input type="text" class="form-control" name="hackerranklink" id="hackerranklink" value="<?php echo $hackerranklink; ?>">
  </div>
<button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>
    </div>
  </div>
  <footer class="footer text-center ">
        <p>Made By Kundan Surve & Atharv Karanzkar</p>
    </footer>
</body>
</html>