<?php

require_once('C:\xampp\htdocs\usc-connect\backend\dbcon.php');

class Event
{
    //general 
    private $eventName;
    private $eventType;
    private $description;
    private $eventIMG;

    //specifics
    private $cesPoints;
    private $department;
    private $maxParticipants;

    //time
    private $startDate;
    private $endDate;
    private $registrationDeadline;

    //location
    private $building;
    private $streetName;
    private $barangay;
    private $city;
    private $province;
    private $postalCode;

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function setEventDetails($data)
    {
        // Set the event details
        $this->eventName = $data['eventName'];
        $this->eventType = $data['eventType'];
        $this->description = $data['description'];
        $this->eventIMG = $data['eventIMG'];
    
        $this->cesPoints = $data['cesPoints'];
        $this->department = $data['department'];
        $this->maxParticipants = $data['maxParticipants'];
    
        $this->startDate = $data['startDate'];
        $this->endDate = $data['endDate'];
        $this->registrationDeadline = $data['registrationDeadline'];
    
        $this->building = $data['building'];
        $this->streetName = $data['streetName'];
        $this->barangay = $data['barangay'];
        $this->city = $data['city'];
        $this->province = $data['province'];
        $this->postalCode = $data['postalCode'];

        $null = null;
    
        // Insert into the events table
        $stmt = $this->conn->prepare("INSERT INTO events (eventName, eventType, description, eventIMG) VALUES (?,?,?,?)");
        $stmt->bind_param("sssb", $this->eventName, $this->eventType, $this->description, $null);
    
        if($this->eventIMG !== NULL) {
            $stmt->send_long_data(3, $this->eventIMG);
        }

        if ($stmt->execute()) {
            // Get the last inserted event ID
            $eventID = $stmt->insert_id;
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            return; // Exit if event insertion fails
        }
    
        // Now insert into the eventSpecifications table using the eventID
        $stmt = $this->conn->prepare("INSERT INTO eventspecification (eventID, cesPoints, department, startDate, endDate, registrationDeadline, maxParticipants)
            VALUES (?,?,?,?,?,?,?)");
    
        $stmt->bind_param("iissssi", $eventID, $this->cesPoints, $this->department, $this->startDate, $this->endDate, $this->registrationDeadline, $this->maxParticipants);
    
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    
        // Insert into the address table using the eventID
        $stmt = $this->conn->prepare("INSERT INTO address (eventID, building, streetName, barangay, city, province, postalCode) 
            VALUES (?,?,?,?,?,?,?)");
    
        $stmt->bind_param("issssss", $eventID, $this->building, $this->streetName, $this->barangay, $this->city, $this->province, $this->postalCode);
    
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    
        // Close the statement
        $stmt->close();
    } 
    
    public function getEventDetails()
    {
        $query = "SELECT * FROM events
        JOIN address ON events.eventID = address.eventID
        JOIN eventspecification ON events.eventID = eventspecification.eventID";
        $result = $this->conn->query($query);
        $events = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row; // Store each row in the events array
            }
        }

        return $events;
    }
}