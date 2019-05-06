<?php
//starting Session
session_start();
if($_POST){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Hotel Reservations</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
                <i class="fas fa-umbrella-beach"></i>
                <h1> Make Your Reservation</h1>
				<div class="row">
					<div class="booking-form">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">First Name:</span>
										<input class="form-control" type="text" required placeholder="Please enter your firstname" name= "firstName">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Surname:</span>
										<input class="form-control" type="text"  required placeholder="Please enter your surname" name ="surName">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">CHECK IN</span>
										<input class="form-control" type="date" required name="checkIn">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">CHECK OUT</span>
										<input class="form-control" type="date" required name ="checkOut">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Adults (18+)</span>
										<select class="form-control">
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Children (0-17)</span>
										<select class="form-control">
											<option>0</option>
											<option>1</option>
											<option>2</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Select your Hotel</span>
										<select class="form-control" name = "hotel">
											<option class = "mount">Mount Nelson Hotel</option>
											<option class = "silo">The Silo Hotel</option>
											<option class = "pod">Pod Camps Bay</option>
										</select>
                                        <span class="form-label1">R550</span>
                                        <span class="form-label2">R1100</span>
                                        <span class="form-label3">R450</span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn" name = "submit">Check Availabilty</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
            <div class="booking-form">
                
<?php
         //////////////////////////////////////////////////////////////////////
        ////////////////////// MAIN PROGRAM////////////////////////////////////
                /////////////////////////////rough sketch//////
       ////////////////////////////////////////////////////////////////////////
$servername = "localhost";
$username = "jan";
$password = "janspass";
$database ="publications";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
                
// sql to create table
$sql = "CREATE TABLE Users_Booking (
firstname VARCHAR(30) NOT NULL,
surname VARCHAR(30) NOT NULL,
hotel VARCHAR(50),
days VARCHAR(30),
total_amount VARCHAR(30)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users_Booking created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
                   
    if (isset($_POST['submit'])){
             $_SESSION['firstName']= $_POST['firstName'];
             $_SESSION['surName']= $_POST['surName'];
             $_SESSION['Hotel']= $_POST['hotel'];
             $_SESSION['checkIn']= $_POST['checkIn'];
             $_SESSION['checkOut']= $_POST['checkOut'];
    }
      //// calculates difference in dates.  
    $dateIn = new Datetime($_SESSION['checkIn']);
    $dateOut = new Datetime($_SESSION['checkOut']);
    $days = $dateIn->diff($dateOut)->format("%d");
                
                
    $price;           
    switch ($_SESSION['Hotel']) {
    case "Mount Nelson Hotel":
        $price = 550;
        break;
    case "The Silo Hotel":
        $price = 350;
        break;
    case "Pod Camps Bay":
        $price = 650;
        break;
    default:
        echo "";
            
    }
    $total = $days * $price;
        
        echo "<div class='response-form'>";
            echo "<h4>"."Hi ".$_SESSION['firstName']." you are booking the ". $_SESSION['Hotel']."<br>"."</h4>";
            echo "<p>"."Number of Days:   ".$days."</p>";
            echo "<p>"."Daily Rate:   R"."$price"."</p>";
            echo "<p>"."Total:   R".$total."</p>";
            echo "<button class='submit-btn2'>confirm booking</button>";
    
        echo"</div>";

$firstname = $_SESSION['firstName'];
$lastname = $_SESSION['surName'];
$hotel = $_SESSION['Hotel'];
                
                
                
//// Insert into tables             
if($_POST){
$sql = "INSERT INTO Users_Booking (firstname, surname, hotel,days,total_amount)
VALUES ('$firstname','$lastname','$hotel','$days', '$total')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}
                
                
?>
                <div class = "booking-confirm">
                    <h2>Booking Confirmed</h2>
                    <i class="fas fa-check"></i>
                </div>
                </div>
			</div>
		</div>
	</div>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
<script type = "text/javascript" src ="main.js"></script>
    
</body>
</html>