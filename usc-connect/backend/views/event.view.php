<?php
require('C:\xampp\htdocs\usc-connect\backend\image.php');
class EventView
{
    //student methods
    public function displayEventsList($events)
    {
        foreach($events as $event)
        echo '
            <div class="card-container">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../../backend/image.php?eventID=' . $event['eventID'] . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($event['eventName']) .' </h5>
                                <a href="#" class="btn btn-primary">View details</a>
                        </div>
                </div>
            </div>';                
    }

    //admin method
    public function displayEventDetails($events)
    {
        foreach($events as $event)
        echo  htmlspecialchars($event['eventName']);
    }

    public function displayOngoingHostEvents($events)
    {   
        echo '<tr>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>CES Points</th>
              </tr>';

        $currentDate = new DateTime();

        foreach ($events as $event) {

            // $endDate = $event['endDate'];
            $endDate = new DateTime($event['endDate']);

            if($event['eventStatus'] === 'Verified' && $endDate < $currentDate)
            {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($event['eventName']) . '</td>';
                echo '<td>' . htmlspecialchars($event['startDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['endDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['cesPoints']) . '</td>';
                echo '</tr>'; 
            }
        }

    }
    public function displayWaitConfHostEvents($events)
    {
        echo '<tr>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>CES Points</th>
                <th>Action</th>
              </tr>'; // Table header

        foreach ($events as $event) {
            if($event['eventStatus'] === 'Unverified')
            {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($event['eventName']) . '</td>';
                echo '<td>' . htmlspecialchars($event['startDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['endDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['cesPoints']) . '</td>';
                echo '<td><button>Cancel</button></td>
                    </tr>';
            }
        }
    }

    public function displayEventDetailsWithModal($events)
    {
        foreach ($events as $event) 
        {
        echo '
            <div class="card-container">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../../backend/image.php?eventID=' . $event['eventID'] . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($event['eventName']) .' </h5>
                                <button onclick="showModal(' . htmlspecialchars($event['eventID']) . ')">View Details</button>
                        </div>
                </div>
            </div>'; 

        // Modal structure
        echo '
        <div id="modal-' . htmlspecialchars($event['eventID']) . '" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(' . htmlspecialchars($event['eventID']) . ')">&times;</span>
                <h2>' . htmlspecialchars($event['eventName']) . '</h2>
                <p><strong>Event Type:</strong> ' . htmlspecialchars($event['eventType']) . '</p>
                <p><strong>Description:</strong> ' . htmlspecialchars($event['description']) . '</p>
                <p><strong>CES Points:</strong> ' . htmlspecialchars($event['cesPoints']) . '</p>
                <p><strong>Department:</strong> ' . htmlspecialchars($event['department']) . '</p>
                <p><strong>Start Date:</strong> ' . htmlspecialchars($event['startDate']) . '</p>
                <p><strong>End Date:</strong> ' . htmlspecialchars($event['endDate']) . '</p>
                <p><strong>Registration Deadline:</strong> ' . htmlspecialchars($event['registrationDeadline']) . '</p>
                <p><strong>Address:</strong> ' . htmlspecialchars($event['building']) . ', ' 
                                    . htmlspecialchars($event['streetName']) . ', ' 
                                    . htmlspecialchars($event['barangay']) . ', ' 
                                    . htmlspecialchars($event['city']) . ', ' 
                                    . htmlspecialchars($event['province']) . ' ' 
                                    . htmlspecialchars($event['postalCode']) . '</p>
            </div>
        </div>';
        }
    }

    public function displayEventHistory($events)
    {
        echo '<tr>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>CES Points</th>
              </tr>';

        $currentDate = new DateTime();

        foreach ($events as $event) {

            $endDate = new DateTime($event['endDate']);
            // $endDate = $event['endDate'];


            if($endDate > $currentDate && $event['eventStatus'] === 'Verified') 
            {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($event['eventName']) . '</td>';
                echo '<td>' . htmlspecialchars($event['startDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['endDate']) . '</td>';
                echo '<td>' . htmlspecialchars($event['cesPoints']) . '</td>';
                echo '</tr>'; 
            }
        }
    }
}