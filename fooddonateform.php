<?php
include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'demo');
if(isset($_POST['submit']))
{
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    //$address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
    $latitude = mysqli_real_escape_string($connection, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($connection, $_POST['longitude']);


 



    $query = "INSERT INTO food_donations(email, food, type, category, phoneno, location, name, quantity, latitude, longitude) 
VALUES ('$emailid','$foodname','$meal','$category','$phoneno','$district','$name','$quantity', '$latitude', '$longitude')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css"> <!-- Your existing CSS -->
</head>
<body style="background-color: #06C167;">
    <div class="container">
        <div class="regformf">
            <!-- Food Donation Form -->
            <form action="" method="post">
                <p class="logo">Food <b style="color: #06C167;">Donate</b></p>

                <!-- Food Name -->
                <div class="input">
                    <label for="foodname">Food Name:</label>
                    <input type="text" id="foodname" name="foodname" required/>
                </div>

                <!-- Meal Type -->
                <div class="radio">
                    <label for="meal">Meal type:</label><br><br>
                    <input type="radio" name="meal" id="veg" value="veg" required/>
                    <label for="veg" style="padding-right: 40px;">Veg</label>
                    <input type="radio" name="meal" id="Non-veg" value="Non-veg">
                    <label for="Non-veg">Non-veg</label>
                </div><br>

                <!-- Food Category -->
                <div class="input">
                    <label for="food">Select the Category:</label><br><br>
                    <div class="image-radio-group">
                        <input type="radio" id="raw-food" name="image-choice" value="raw-food">
                        <label for="raw-food"><img src="img/raw-food.png" alt="raw-food"></label>

                        <input type="radio" id="cooked-food" name="image-choice" value="cooked-food" checked>
                        <label for="cooked-food"><img src="img/cooked-food.png" alt="cooked-food"></label>

                        <input type="radio" id="packed-food" name="image-choice" value="packed-food">
                        <label for="packed-food"><img src="img/packed-food.png" alt="packed-food"></label>
                    </div>
                </div><br>

                <!-- Quantity -->
                <div class="input">
                    <label for="quantity">Quantity (number of persons / kg):</label>
                    <input type="text" id="quantity" name="quantity" required/>
                </div>

                <!-- Contact Details -->
                <b><p style="text-align: center;">Contact Details</p></b>

                <!-- Name (Pre-filled from session) -->
                <div class="input">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required/>
                </div>

                <!-- Phone No -->
                <div class="input">
                    <label for="phoneno">Phone No:</label>
                    <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required/>
                </div>

                <!-- District -->
                <div class="input">
                    <label for="district">District:</label>
                    <select id="district" name="district" style="padding:10px;">
                        <option value="almora">Almora</option>
                        <option value="bagehswar">Bageshwar</option>
                        <option value="chamoli">Chamoli</option>
                        <option value="champawat">Champawat</option>
                        <option value="dehradun" selected>Dehradun</option>
                        <option value="haridwar">Haridwar</option>
                        <option value="nainital">Nainital</option>
                        <option value="pauri-garhwal">Pauri Garhwal</option>
                        <option value="pithoragarh">Pithoragarh</option>
                        <option value="rudraprayag">Rudraprayag</option>
                        <option value="tehri-garhwal">Tehri Garhwal</option>
                        <option value="udhamsinghnagar">Udham Singh Nagar</option>
                        <option value="uttarkashi">Uttarkashi</option>
                    </select>
                </div>

                <!-- Latitude and Longitude fields (Visible) -->
                <div class="input">
                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" readonly required/>
                </div>

                <div class="input">
                    <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" readonly required/>
                </div>

                <!-- Ask Location Button -->
                <div class="btn">
                    <button type="button" onclick="getLocation()">Allow Location</button>
                </div><br>

                <!-- Submit Button -->
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript to Get Current Location -->
    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                alert("Location captured successfully!");
            }, function(error) {
                alert("Error getting location: Please allow location permission.");
            });
        } else {
            alert("Geolocation is not supported by your browser.");
        }
    }
    </script>

</body>
</html>
