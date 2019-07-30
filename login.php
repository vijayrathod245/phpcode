<?php 
//session_start();
include('db.php');

if(@$_SESSION['admin']!=''){
    header('location:dashboard.php');
}

if(@$_POST['submit']){
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['last_time'] = time();
	
    $email = $_POST['email'];
    $password = $_POST['password'];
    @$type = $_POST['logtype'];
    
    if($type=='admin'){
		$qry = "select * from admin where email='$email' and password='$password'";
	}
	else{
		$qry = "select * from user where email='$email' and password='$password'";
	}
  
    $res = mysqli_query($conn, $qry);
    $num = mysqli_num_rows($res);

    if($num){

        if(!empty($_POST['remember'])){
            setcookie("member_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
            setcookie("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));   
        }
        else{
            if(@($_COOKIE["member_login"])){
                setcookie("member_login","");
            }
            if(@($_COOKIE["member_password"])){
                setcookie("member_password","");
            }
        }
        $arr = mysqli_fetch_array($res);
        $_SESSION['admin']=$arr['id'];
        $_SESSION['logtype'] = $type;
        header("location:dashboard.php");
    }
    else{
        $msg = "<span style='color:#2196f3;'>Incorrect email and password?</span>";
    }
}

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Sign In
    </title>
    <style>#loader{
      transition:all .3s ease-in-out;
      opacity:1;
      visibility:visible;
      position:fixed;
      height:100vh;
      width:100%;
      background:#fff;
      z-index:90000}
      #loader.fadeOut{
        opacity:0;
        visibility:hidden}
      .spinner{
        width:40px;
        height:40px;
        position:absolute;
        top:calc(50% - 20px);
        left:calc(50% - 20px);
        background-color:#333;
        border-radius:100%;
        -webkit-animation:sk-scaleout 1s infinite ease-in-out;
        animation:sk-scaleout 1s infinite ease-in-out}
      @-webkit-keyframes sk-scaleout{
        0%{
          -webkit-transform:scale(0)}
        100%{
          -webkit-transform:scale(1);
          opacity:0}
      }
      @keyframes sk-scaleout{
        0%{
          -webkit-transform:scale(0);
          transform:scale(0)}
        100%{
          -webkit-transform:scale(1);
          transform:scale(1);
          opacity:0}
      }
    </style>
    <link href="style.css" rel="stylesheet">
  </head>
  <body class="app">
    <div id="loader">
      <div class="spinner">
      </div>
    </div>
    <script>window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
          loader.classList.add('fadeOut');
        }, 300);
      }
    );
    </script>
    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(assets/static/images/bg.jpg)">
        <div class="pos-a centerXY">
          <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px">
            <img class="pos-a centerXY" src="assets/static/images/logo.png" alt="">
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
        <h4 class="fw-300 c-grey-900 mB-40">Login
        </h4>
        <form method="post">
        <?php echo @$msg; ?>
          <div class="form-group">
            <label class="text-normal text-dark">Email
            </label> 
            <input type="email" class="form-control" value="<?php if(@($_COOKIE["member_login"])) {echo $_COOKIE["member_login"];} ?>" name="email" placeholder="John Doe">
          </div>
          <div class="form-group">
            <label class="text-normal text-dark">Password
            </label> 
            <input type="password" value="<?php if(@($_COOKIE["member_password"])) {echo $_COOKIE["member_password"];} ?>" name="password" class="form-control" placeholder="Password">
          </div>


          <div class="form-group">
          <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" required class="form-check-input" name="logtype" value="admin">Admin
              </label>
          </div>
          <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" required class="form-check-input" name="logtype" value="user">User
              </label>
           </div>
          </div>



          <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">
              <div class="peer">
                <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                  <input type="checkbox" id="inputCall1" name="remember" class="peer" <?php if(@($_COOKIE["member_login"])) { ?> checked <?php } ?> /> 
                  <label for="inputCall1" class="peers peer-greed js-sb ai-c">
                    <span class="peer peer-greed">Remember Me
                    </span>
                  </label>
                </div>
              </div>
              <div class="peer">
                <input class="btn btn-primary" type="submit" name="submit" value="Login"/>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="js/vendor.js">
    </script>
    <script type="text/javascript" src="js/bundle.js">
    </script>