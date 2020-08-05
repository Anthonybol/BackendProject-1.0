
<?php
session_start(); //Checking if user is a member, if not - prompt to login. 
if(!isset($_SESSION['user_name'])){ //Checking for username but no usernameS
    echo "<script>
        alert('Please login');
        window.location.href='javascript:history.go(-1)'; 
        </script>"; //Directs user back (-1) to the previous page using window.location.href jvascript method.
    exit;
}
?>

<html>
<head> 
<!-- basic styling -->
    <title></title>
    <style> 
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #dddddd;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            padding: 8px;
        }
    </style>

</head>
<body>



<ul>
    <li><a href="members.php">Members</a></li>
    <li style="position: absolute; right: 20px;"><a href="logout.php">Logout</a></li>

</ul>

<div class="banner"> <!-- banner div -->
		<img class="banner-image" src="../images/banner.jpg" alt="bannerimagehere" style="    width: 100%;">
        <br><br>
    Hey<strong style="color: red"> 
<?php
$regValue = $_SESSION['user_name']; //Grabbing username of user
echo $regValue; //echo username of user 
?> 
<!-- Hey 'username' welcome to our site -->
</strong>
    welcome to our site
</div>

</body>
</html>