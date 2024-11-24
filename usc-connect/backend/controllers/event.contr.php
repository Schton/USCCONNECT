<?php

require_once('C:\xampp\htdocs\usc-connect\backend\models\event.model.php');
require_once('C:\xampp\htdocs\usc-connect\backend\views\event.view.php');

class EventController
{
    private $conn;
    private $model;
    private $view;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->model = new Event($this->conn);
        $this->view = new EventView($this->conn);
    }

    //creates event
    public function createEvent($data)
    {     
        $this->model->setEventDetails($data);
    }

    //gets all event data
    public function getEvent()
    {
        return $this->model->getEventDetails();
    }

    //client display event list
    public function getDisplayList($events)
    {
        return $this->view->displayEventsList($events);
    }

    //ongoing event display from host
    public function getOngoingHostEvents($events)
    {
        return $this->view->displayOngoingHostEvents($events);
    }

    //host event confirmation table
    public function getWaitConfHostEvents($events)
    {
        return $this->view->displayWaitConfHostEvents($events);
    }

    //client event details popup
    public function displayEventDetailsWithModal()
    {
        $events = $this->getEvent(); // Fetch all event details from the model
        $this->view->displayEventDetailsWithModal($events); // Render modal for each event
    }

    //host display event history
    public function getEventHistory($events)
    {
        return $this->view->displayEventHistory($events);        
    }

}
