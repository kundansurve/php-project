<?php
// Initialize the session
require_once "config.php";

// Initialize the session

session_start();
 
// Check if the user is logged in, if not then redirect him to login page

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
$username=$_GET['profile'];
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

         
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer's Profile</title>
    <link rel="stylesheet" type="text/css" href="./profilepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
</head>

<body class="profile-page">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index:18">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Developer Profile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a href="login.php" style="color:white;text-decoration:none;margin-left:1em">Login</a>
        </li>
        <li class="nav-item">
        <a href="register.php" style="color:white;text-decoration:none;margin-left:1em">Sign up</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('http://wallpapere.org/wp-content/uploads/2012/02/black-and-white-city-night.png');"></div>
    <div class="main main-raised">
		<div class="profile-content">
            <div class="container">
                <div class="row">
	                <div class="col-md-6 ml-auto mr-auto">
        	           <div class="profile">
	                        <div class="avatar">
	                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRbiMjUoOxJCAMB9poSO2wLg34m7OxmyaT-A&usqp=CAU">
	                        </div>
	                        <div class="name">
	                            <h3 class="title"><?php echo $firstname." ".$lastname; ?></h3>
								<h6><?php echo $profiletitle ?></h6>
                                <div style="margin-top:2em">
								<a href="<?php echo $githublink; ?>" target="_blank" style="margin:0.5em"><img src="./iconfinder_github_317712.png" alt="link1" style="width:25px" /> <i className='fa fa-external-link redirect'></i></a>
                        <a href="<?php echo $linkedinlink; ?>" target="_blank" style="margin:0.5em"><img src="./iconfinder_2018_social_media_popular_app_logo_linkedin_3225190.png" style="width:25px"alt="link2" /> <i className='fa fa-external-link redirect'></i></a>
                        <a href="<?php echo $hackerranklink; ?>" target="_blank" style="margin:0.5em"><img src="./iconfinder_160_Hackerrank_logo_logos_4373234.png" style="width:25px" alt="link4" /> <i className='fa fa-external-link redirect'></i></a>
                        </div>
	                        </div>
	                    </div>
    	            </div>
                </div>
                <div class="description text-center" style="padding:1em">
                    <p><?php echo $about; ?></p>
                </div>

                <div class="repos" style="padding:1em;display:flex;flex-direction:column;justify-content:center;allign-items:center,flex-wrap:wrap">
                  <h3 style="margin:auto;padding:1em">Public Repository by <?php echo $firstname ?></h3>
              </div>
            </div>
        </div>
	</div>
	
	<footer class="footer text-center ">
        <p>Made By Kundan Surve & Atharv Karanzkar</p>
    </footer>
  
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>


   <script>
     fetch("https://api.github.com/users/<?php  echo substr($githublink,19,strlen($githublink)-19); ?>")
     .then(res=>res.json())
     .then((data)=>{
      fetch(data.repos_url)
      .then(res=>res.json())
      .then((repos)=>{
        const reposelement=document.querySelector('.repos');
        for(repo of repos){
          console.log(repo);
          const div1= document.createElement("div");
          const div2= document.createElement("div");
          const div3= document.createElement("div");
          const h3= document.createElement("h5");
          const a= document.createElement("a");
          const image=document.createElement("img");
          const h5 = document.createElement("h6");
          const hr=document.createElement("hr");
          a.href=repo.html_url;
          h3.innerText="Repository: "+repo.name;
          h5.innerText="Created at:"+repo.updated_at.split('T')[0];
          div3.appendChild(h3);
          div3.appendChild(h5);
          div2.appendChild(div1);
          div1.appendChild(div3);
          div1.style.padding="1em";
          a.appendChild(div1);
          a.appendChild(hr);
          a.target="_blank";
          a.style.textDecoration="none";
          a.style.color="black";
          reposelement.appendChild(a);

        }
      }).catch(err=>alert(err));
     }).catch(err=>alert(err));
   </script>

</body>
</html>