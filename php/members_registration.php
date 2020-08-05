<?php
//require_once('../mysql.php');
?>
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
    <li><a href="../index.php">Login</a></li>
    <li><a href="members_registration.php">Member Registration</a></li>
    <li><a href="new_customer_registration.php">Customer Registration</a></li>
</ul>

<?php




$userId = ""; //Variables to be used
$pass = ""; 
$message = "";
$error = "";
if(isset($_POST['submit'])) { //When user hits submit, isset checks if $_POST was posted. 
    //$_POST is a PHP super global variable which is used to collect form data after 
    //submitting an HTML form with method="post", as seen below. Here we connect 'submit' to post variable.

require_once('../mysql.php');


    $userId = $_POST['UserID']; //Posting User ID (defining $userid)
    $pass = $_POST['password']; //Posting password (defining $pass)

    if($pass == "") //If password box is empty - 
    {
        $error = "yes";
        $message = "Please provide valid password";
    }
    if($userId == "") //If username box is empty - 
    {
        $error = "yes";
        $message = "Please provide valid user ID";
    }
    if(strlen($pass) < 6 ) //If password box has less than 6 characters - 
    {
        $error = "yes";
        $message = "Length of password must br greater then 5";
    }

//Preg_match is checking if password match is true. If it does not contain '/[^A-Za-z0-9.]/' please provide
//valid password. 
    if (preg_match('/[^A-Za-z0-9.]/', $pass)) // '/[^a-z\d]/i' should also work. 
    {
        $error = "yes";
        $message = "Please provide valid password";
    }


//If username contains the characters below then display 'please provide valid userid'. 
    if((strpos($userId, '/') !== false) || (strpos($userId, '.') !== false) || (strpos($userId, '%') !== false)
         || (strpos($userId, '@') !== false) || (strpos($userId, '?') !== false))
    {
        $error = "yes";
        $message = "Please provide valid userId";
    }


//        $conn = new mysqli($host, $dbUsername, $dbPassword,$dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error()); //If failed, quote connection failed and die.
        } //Connection
//When user logs in 'new member registration', we're checking for customer ID and !isset($_SESSION['user_name'] (in background)
//in members.php. It is checking for a valid customergivenname to verify user as a member while on member page.
        $sql = "SELECT CustomerID,CustomerGivenName FROM Customer order by CustomerID desc limit 1"; //Grabbing most recent ID with DESC. 
        $data = mysqli_query($conn, $sql) or die("Bad SQL: $sql"); //mysqli_query function Performs a query on the database

        $customerId = ""; //Variables to be used 
        $customerFirstName = "";
        while ($row = $data->fetch_assoc()) {
            $customerId = $row['CustomerID']; //$customerid fetching customerID array 
            $customerFirstName = $row['CustomerGivenName']; //$customerfirstname fetching customergivenname array
        }
        //blow fish encryption
        //setting key to qwerty
        $pass = crypt($pass,"qwerty");
        //Inserting encrypted key into table. Parameters ("?") are left for later and binded later
        //Using (?), we're substituting string for later 
        $INSERT = "INSERT Into Member (CustomerID, UserID, HashedPassword,customerName) values(?,?,?,?)";
        //Preparing $INSERT for execution
        $stmt = $conn->prepare($INSERT);
        //'Bind_param' is binding parameters to SQL query and 'ssss' are the parameters meaning its a string.
        //This is telling mysql what type of data to expect.  
        $stmt->bind_param('ssss',$customerId, $userId, $pass,$customerFirstName);
        $stmt->execute();
        $message =  "New record added";
        $userId = "";
        $pass = "";


        require_once('../disconnect.php');

        session_start();
        $_SESSION['user_id'] = $userId; //Creating a new session for user depending on the user id.
        $_SESSION['user_name'] = $customerFirstName;
        header( "location: members.php" ); //If success on login, take user to members page.



        echo "<script>
        alert('New record added successfully');
        window.location.href='../index.php';
        </script>";
    
}

?>




<h1> New Member Registration </h1>


<!-- Connection to variables above. Using POST method-->
<form action="members_registration.php" method="post" class="login">
    User ID:
    <input type="text" name="UserID" value="<?php echo $userId?>"><br><br> 
    Password:
    <input type="password" name="password" value="<?php echo $pass?>"><br><br>
    <span id="error" style="color: red;"><?php echo $message; ?></span><br><br>

    <input type="button" name="cancelvalue" value="Cancel" onclick="window.opener=null; window.close(); return false;">

    <input type="submit" name="submit" value="submit">
</form>



</body>
</html>