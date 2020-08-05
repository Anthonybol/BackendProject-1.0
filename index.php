<!DOCTYPE html>
<html>
<head>
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
    <li><a href="php/members_registration.php">Member Registration</a></li>
    <li><a href="php/new_customer_registration.php">Customer Registration</a></li>
    <li><a href="php/members.php">Members</a></li>
</ul>

<h1>Login Here</h1>
<!-- Posting to lgin php file -->
<form name="input" method="POST" action="php/login.php"> 
Username:
<!-- Username box -->
<input type="text" name="username"><br>
Password:
<!-- password box -->
<input type="password" name="password"><br>
<!-- Login button -->
<input type="submit" value="Login">
</form>
<!-- Registration for members  -->
<!--<input type="button" value="Members registration" onclick="window.open('php/members_registration.php')">-->

<!--<input type="button" value="New customer registration" onclick="window.open('php/new_customer_registration.php')">-->
</form>

</body>
</html>