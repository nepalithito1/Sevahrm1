<?php
    include("connection.php");
    $tbl_name="admin";  // Table name 
                        // Connect to server and select databse.
    if(isset($_POST['register'])){
        $con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
        mysqli_select_db($con,"$db_name")or die("cannot select DB");
        // username and password sent from form
        $myusername=$_POST['dname']; 
        $mypassword=$_POST['dpassword']; 
        session_start();
        $_SESSION['a']="userPresent";
        // To protect MySQL injection (more detail about MySQL injection)
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysqli_real_escape_string($con,$myusername);
        $mypassword = mysqli_real_escape_string($con,$mypassword);
        //admin login table
        $sql="SELECT * FROM $tbl_name WHERE aname='$myusername' and apassword='$mypassword'";
        $result= mysqli_query($con,$sql);
        // Mysql_num_row is counting table row
        $count=mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count==1){
            // Register $myusername, $mypassword and redirect to file "login_success.php"
            // session_register("myusername");
            //session_register("mypassword"); 
            /* session_start();
            $_SESSION['a']="userPresent"; */
            $sucess1 = "HR success";
            echo "<script>setTimeout(\"location.href = 'HRdashboard/index.php';\",1500);</script>";
        }
        else if($count<=0) {
            $sql1="SELECT * FROM info WHERE username='$myusername' and password='".md5($mypassword)."'";
            $myusername=$_POST['dname'];
            $mypassword=$_POST['dpassword'];
            $myusername = stripslashes($myusername);
            $mypassword = stripslashes($mypassword);
            $myusername = mysqli_real_escape_string($connect,$myusername);
            $mypassword = mysqli_real_escape_string($connect,$mypassword);
            $mypassword = $mypassword;
            if ($result=mysqli_query($connect,$sql1)){
                $result1= mysqli_fetch_object($result);
            }
            //$result1 = mysql_fetch_object($result);
            $id=$result1->id;
            // Mysql_num_row is counting table row
            $count1=mysqli_num_rows($result); 
            if($count1==1){	
                $_SESSION['username']=$myusername;
                $_SESSION['password']=$mypassword;
                echo "Sucessfully logged in, redirecting to Employee page............. ";
                echo "<script>setTimeout(\"location.href = 'HRdashboard/html/employee_details.php?id=$id';\",1500);</script>";
                exit();
            }
            else if($count1<=0) {
                $sql2="SELECT * FROM client WHERE username='$myusername' and password='".md5($mypassword)."'";
                $result2= mysqli_query($con,$sql2);
                $count2=mysqli_num_rows($result2);	
                if($count2==1){	
                    echo "Sucessfully logged in, redirecting to Manager page............. ";
                    echo "<script>setTimeout(\"location.href = 'Manager/index.php';\",1500);</script>";
                }
                else {
                    $error="Wrong username/password";
                }
            }
        }
        //echo '<div class="msf-container"> </div>';
        else {
            $error="Wrong username or password";
        }
    }
?>


<!DOCTYPE html>
<html>
		<style>
		.page{
			border:5px;
			background-image:url("img1/back.png");
			width:650px;
			height:750px;
			margin:30px 0px 0px 380px;
		}	
		.logo{
			padding:5px 50px 0px 50px;
			margin:-60px 200px 0px -30px;
			float:left;
		}
		
		.page1{
			border-radius:5px;
			border-color:black;
			margin:-85px 0px 0px 130px;
			float:left;
		}
            .page2{
                
			border-radius:5px;
			border-color:black;
			margin:-85px 0px 0px 130px;
			float:left;
		}
		.text_over_image{
			font-size:28px;
			position:absolute;
			top:20px;
			margin:180px 0px 0px 25px;
			
		}
		.text_over_image2{
			font-size:16px;
			position:absolute;
			top:20px;
			margin:230px 0px 0px 25px;
		}
		.login{
			margin:-40px 0px 0px 210px;
            
            
		}
        .btn {
            border-radius: 12px;
			color: #ffffff;
			font-size: 15px;
			background: #004664;
			padding: 5px 55px 12px 25px;
            text-align: center;
			border: solid #ffffff 2px;
			text-decoration: none;
			width:100px;
			margin:20px 0px 0px 5px;
            
			
			}

		.btn:hover {
				background: #1c5a70;
				text-decoration: none;
		}
            .btn1 {
                position : relative;
            border-radius: 12px;
			color: #ffffff;
			font-size: 12px;
			background: #004664;
			padding: 10px 5px 12px 0px;
            text-align: center;
			border: solid #ffffff 2px;
			text-decoration: none;
			width:150px;
			margin:-800px 0px 0px 65px;
            
			
			}

		.btn1:hover {
				background: #1c5a70;
				text-decoration: none;
		}
		input[type=text] {
			width: 65%;
			padding: 12px 20px;
			margin: 100px 0px 0px 0px;
			box-sizing: border-box;
			border-radius:12px;
			border:5px solid #1c5a70;
			}
        input[type=password] {
			width: 65%;
			padding: 12px 20px;
			margin: 100px 0px 0px 0px;
			box-sizing: border-box;
			border-radius:12px;
			border:5px solid #1c5a70;
			}
            
		.password
			{
			margin:-80px 0px 0px 0px;
			}
		.username
			{
                
			margin:0px 0px 0px 0px;
			width:500px;
			}
		.remember_me
			{
			margin:-160px 50px 0px 24px;
			}
        span.psw{
                margin:20px 50px 0px 50px ;
            }
		</style>

		<body>
		
		
			<div class="page"><div class="logo"><img src="img1/sevadev.png" width="600px" height="300px"></div>
			
			<div class="page2"><img src="img1/004664.png" width="400px" height="400px">
                <h1 class="text_over_image"><form method="POST">
				<div class="username">
				
				<input type="text" placeholder="Username" id="dname" name="dname"></br
				</div>
				<div class="password">
					<input type="password" placeholder="Password" id="dpassword" name="dpassword">
                    </div>
                     <button type="submit" class="btn" name="register">Login</button>
                    <input type = "button" onclick="window.location.href='forget_password.php'" type="submit" class="btn1" name="forget" value = "Forget Password??"></button>
                    
                    </h1></form>
                    
			<h1 class="text_over_image"><font style="color:white">Login Now</h1></font>
			<p class="text_over_image2"><font style="color:white">Enter your username and password.</p></font>
				</div>     
                 
                		</div>
			</div>
		</body>
</html>
