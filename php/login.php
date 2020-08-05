<?php
//require_once('../mysql.php');
?>
<!DOCTYPE html>
<html>

<body>

<?php

$salt = md5('Anthony'); //md5 is salting 'anthony' as a password. Temporary login for myself. 
$in_user = $_POST['username']; //$in_user now carries (username) and will be posted to database using $_POST.  
$in_password = $_POST['password']; //Similar thing as above. 
$hash_password = crypt($in_password,"qwerty"); //$hash_password is now taking '$in_password' and crypt function is hashing it
//so its more secure. As password is posted, qwerty is used as the hashing key which encodes the password. 

require_once('../mysql.php'); //Connection

   if (!$conn) { //------------------------------------------>
       die("Connection failed: " . mysqli_connect_error()); //If failed, quote connection failed and die. 
   }
   else { //If connection success, $sql now does the below. When user logs in, customer name and password checked against table.
       echo "Connected to Database <br>";
       $sql = "SELECT * FROM member WHERE customerName = '$in_user' AND HashedPassword = '$hash_password'";
       $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql"); //mysqli_query function Performs 'sql' and 'conn' variables. 
       //$conn specifying the connection to use and $sql is the "SELECT * FROM member WHERE customerName = '$in_user' AND HashedPassword = '$hash_password'".
        if (mysqli_num_rows($data)) { //$data is the result. In this case, there is 1 row. 
            $out = "Success"; //mysqli_num_rows is checking if data is present in database. Also returning number of rows present.
        }
        else { //If password/username is incorrect, prompt user with this page and option to go back. 
            header( "location: ../html/failed_login.html" ); die;
        }
        echo $out;
       while($row = mysqli_fetch_array($data)) { //mysqli_fetch_array(data) is fetching a result row (data) which now = $row.
       $id = $row['UserID']; //Selecting row column (UserID) using mysqli_fetch_array to be able to select UserID
       echo $id; //Echoeing ID
       if(isset($id)){ //Variable $id is set, isset checks wether a variable is set. 
           session_start();
           $_SESSION['user_id'] = $id; //Creating a new session for user depending on the user id. Getting user id from above. 
           $_SESSION['user_name'] = $in_user; //Creating a new session for user depending on the user name. 
           header( "location: members.php" ); //If success on login, take user to members page.
           exit;
       }
   }
  }
?>

</body>
</html>