<?php
require_once('../../backend/controllers/event.contr.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
{
    $data = [
        'eventName' => $_POST['eventName'],
        'eventType' => $_POST['eventType'],
        'description' => $_POST['description'],
        // 'eventIMG' => $_POST['eventIMG'],
        
        'cesPoints' => $_POST['cesPoints'],
        'department' => $_POST['department'],
        'maxParticipants' => $_POST['maxParticipants'],

        'startDate' => $_POST['startDate'],
        'endDate' => $_POST['endDate'],
        'registrationDeadline' => $_POST['registrationDeadline'],
        
        'building' => $_POST['building'],
        'streetName' => $_POST['streetName'],
        'barangay' => $_POST['barangay'],
        'city' => $_POST['city'],
        'province' => $_POST['province'],
        'postalCode' => $_POST['postalCode'],

    ];

    if (isset($_FILES['eventIMG']) && $_FILES['eventIMG']['error'] == 0) {
        $fileTmpPath = $_FILES['eventIMG']['tmp_name'];
        $binaryData = file_get_contents($fileTmpPath); // Convert to binary data
        $data['eventIMG'] = $binaryData;
    } else {
        $data['eventIMG'] = null; // Handle case where no image is uploaded
    }

    $contr = new EventController($conn);
    $contr->createEvent($data);
    
}
?>

<html>
<head>
    <link rel="stylesheet" href="..\css\navbar.css">
    <link rel="stylesheet" href="..\css\footer.css">
    <link rel="stylesheet" href="..\css\hostProfile.css">
    <title>USC CONNECT</title>
</head>
<body>
    <!-- navigation bar -->
    <nav>
        <div class="logo">
            <img src="..\img\logo.png" alt="">
        </div>
        <div class="search-bar">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="#">Events</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </div>
    </nav>
    <!-- main content -->
    <div class="container">
        <div class="section-links">
            <ul>
                <li><a href="#">My account</a></li>
                <li><a href="hostProfile.event-history.php">My events</a></li>
                <li><a href="hostProfile.create-event.php">Create event</a></li>
                <li><a href="#">Log out</a></li>
            </ul>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="create-event-content">
            
            <div class="event-container">
                <h3>Create event</h3>
                <p>Plan and Share Your Event. Add all necessary details like the event title, description, date,
                    and location to help clients understand what you’re offering. Include clear instructions on 
                    how to participate and the benefits, such as CES points, to attract more attendees. 
                    <br><br>
                    Your event’s title and description represent your offering to clients and should be engaging,
                    clear, and appropriate for all audiences. For more tips, see our Event Guidelines FAQ.</p>
            </div>
            <div class="event-container" id="general">
                <label class="title">GENERAL</label>
                <hr>
                <div class="inner-container">
                    <label>EVENT NAME</label><br>
                    <input type="text" name="eventName"><br>
                    <label>EVENT TYPE</label><br>
                    <input type="text" name="eventType"><br>
                    <label>DESCRIPTION</label><br>
                    <input type="text" name="description"><br>
                    <label>Upload image</label><br>
                    <input type="file" name="eventIMG"><br>
                </div>
            </div><br>
            <div class="event-container" id="specifics">
                <label class="title">SPECIFICS</label>
                <hr>
                <div class="inner-container">
                    <label>CES POINTS</label><br>
                    <input type="number" name="cesPoints"><br>
                    <label>DEPARTMENT</label><br>
                    <input type="text" name="department"><br>
                    <label>MAX PARTICIPANTS</label><br>
                    <input type="number" name="maxParticipants"><br>
                </div>
            </div><br>
            <div class="event-container" id="time">
                <label class="title">TIME</label>
                <hr>
                <div class="inner-container">
                    <label>START DATE</label><br>
                    <input type="datetime-local" name="startDate"><br>
                    <label>END DATE</label><br>
                    <input type="datetime-local" name="endDate"><br>
                    <label>REGISTRATION DEADLINE</label><br>
                    <input type="datetime-local" name="registrationDeadline"><br>
                </div>
            </div><br>
            <div class="event-container" id="location">
                <label class="title">LOCATION</label>
                <hr>
                <div class="inner-container">
                    <label>BUILDING</label><br>
                    <input type="text" name="building"><br>
                    <label>STREET NAME</label><br>
                    <input type="text" name="streetName"><br>
                    <label>BARANGAY</label><br>
                    <input type="text" name="barangay"><br>
                    <label>CITY</label><br>
                    <input type="text" name="city"><br>
                    <label>PROVINCE</label><br>
                    <input type="text" name="province"><br>
                    <label>POSTAL CODE</label><br>
                    <input type="text" name="postalCode"><br>
                </div>  
            </div><br>

            <div class="button-container">
                <button type="submit" name="cancel">CANCEL</button>
                <button type="submit" name="submit">SUBMIT</button>
            </div>
            
        </div> 
        </form>
    </div>
    <!-- footer -->
    <footer>

    </footer>
</body>
</html>