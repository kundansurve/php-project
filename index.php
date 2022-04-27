<?php 
require_once "config.php";


session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index1.php");
    exit;
}

$developers=[];

$sql3="SELECT username from users";
if($stmt3 = mysqli_prepare($link, $sql3)){
  // Bind variables to the prepared statement as parameters
          if(mysqli_stmt_execute($stmt3)){
            if($result1 = $stmt3->get_result()){
              while($data1 = $result1->fetch_assoc()){
                array_push($developers,$data1["username"]);
              }
            }
          }
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          
          $sql6="SELECT username FROM users WHERE username LIKE '".$_POST['searched']."%'";
          if($stmt6 = mysqli_prepare($link, $sql6)){
            // Bind variables to the prepared statement as parameters
                    if(mysqli_stmt_execute($stmt6)){
                      if($result6 = $stmt6->get_result()){
                        $developers=[];
                        while($data6 = $result6->fetch_assoc()){
                          array_push($developers,$data6["username"]);
                        }
                      }
                    }
                  }
                
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
  
        <link rel="stylesheet" type="text/css" href="./index.css">
        <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <style>
            body{ font: 14px sans-serif; }
            .wrapper{ width: 360px; padding: 1em;margin: 1em;border: 1px solid black; border-radius:5px }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index:11">
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
          <a style="color:white " class="nav-link" href="profilepage.php?profile=<?php echo $username; ?>">Your Profile</a>
        </li>
        <li class="nav-item">
          <a style="color:white " class="nav-link" href="welcome.php">Update Profile</a>
        </li>
        <li class="nav-item dropdown">
        <a style="color:white " class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo htmlspecialchars($_SESSION["username"]); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" style="color:black " href="logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div style="background-color:#2181bd;background-image:url(https://images.unsplash.com/photo-1635830625698-3b9bd74671ca?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80);display:flex;justify-content:center;align-items:center;width:100%;height:93vh;margin:0px">
    <div><h1 style="color:white">Welcome to Developers Profile Builder</h1></div>

    </div>
    
    <div style="padding:1em">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
      <div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="search"> <i class="fa fa-search"></i> <input type="text" class="form-control" name="searched" placeholder="Search Developers"> <button class="btn btn-primary">Search</button> </div>
        </div>
    </div>
      </form>
</div>
<div style="width:100%; display:flex;justify-content:center;align-items:center">
<div class="containers" style="width:60%;min-width:320px;height:60vh;padding:1em;margin-top:2em">
<?php 
for ($x = 0; $x<count($developers); $x++) {
  if($x%2==0){
    echo "<div class='row'>";
  }
  echo "<div class='col-sm'><a style='text-decoration:none;color:black' href='profilepage.php?profile=".$developers[$x]."'><span style='display:flex;justify-content:center;align-items:center'><img src='./profilepic.svg' style='width:50px'><h4>".$developers[$x]."</h4></span></a></div>";
  if($x%2!=0){
    echo "</div>";
  }
}
?>

</div>
</div>
</div>
<footer class="footer text-center ">
        <p>Made By Kundan Surve & Atharv Karanzkar</p>
    </footer>
</body>
</html>
