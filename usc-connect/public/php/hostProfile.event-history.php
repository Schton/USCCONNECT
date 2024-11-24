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
    <style>
        .event-type-links button {
            background-color: #f5f5f5;
            padding: 10px 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .event-type-links button:hover {
            background-color: #e0e0e0;
        }

        .event-type-links .active-tab {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }

    </style>
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
                <li><a href="#time">My account</a></li>
                <li><a href="hostProfile.event-history.php">My events</a></li>
                <li><a href="hostProfile.create-event.php">Create event</a></li>
                <li><a href="#">Log out</a></li>
            </ul>
        </div>
        <div class="my-event-container">
            <div class="event-type-links">
                <button id="activeEventsBtn" class="active-tab">My active events</button>
                <button id="eventHistoryBtn">My event history</button>
            </div>
            <div class="event-type-content">
            <!-- Active Events Section -->
                <div id="activeEventsSection">
                <br>
                <label>On-going events</label>
                <br><br>
                <table class="ongoing-table">
                    <?php
                    require_once('../../backend/controllers/event.contr.php');
                                                
                    $eventObj = new EventController($conn);
                    $events = $eventObj->getEvent();
                    $eventObj->getOngoingHostEvents($events);
                    ?>        
                </table>
                <br><br><br>
                <label>Events awaiting confirmation</label>
                <br><br>
                <table class="waiting-table">
                <?php
                    $eventObj = new EventController($conn);
                    $events = $eventObj->getEvent();
                    $eventObj->getWaitConfHostEvents($events);
                ?> 
                </table>
            </div>

            <!-- Event History Section -->
            <div id="eventHistorySection" style="display: none;">
                <br>
                <label>Past events</label>
                <br><br>
                <table class="history-table">
                <?php
                    $eventObj = new EventController($conn);
                    $events = $eventObj->getEvent();
                    $eventObj->getEventHistory($events); // Create a method for fetching event history
                ?> 
                </table>
            </div>
        </div>
        </div>
    <!-- footer -->
    <footer>

    </footer>
    <script>
    // Buttons
    const activeEventsBtn = document.getElementById('activeEventsBtn');
    const eventHistoryBtn = document.getElementById('eventHistoryBtn');

    // Sections
    const activeEventsSection = document.getElementById('activeEventsSection');
    const eventHistorySection = document.getElementById('eventHistorySection');

    // Event listeners for buttons
    activeEventsBtn.addEventListener('click', () => {
        // Show active events
        activeEventsSection.style.display = 'block';
        eventHistorySection.style.display = 'none';
        // Update button styles
        activeEventsBtn.classList.add('active-tab');
        eventHistoryBtn.classList.remove('active-tab');
    });

    eventHistoryBtn.addEventListener('click', () => {
        // Show event history
        eventHistorySection.style.display = 'block';
        activeEventsSection.style.display = 'none';
        // Update button styles
        eventHistoryBtn.classList.add('active-tab');
        activeEventsBtn.classList.remove('active-tab');
    });
</script>
</body>
</html>