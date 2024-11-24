

<html>
<head>
    <link rel="stylesheet" href="..\css\navbar.css">
    <link rel="stylesheet" href="..\css\footer.css">
    <link rel="stylesheet" href="..\css\events.css">
    <title>USC CONNECT</title>
    <style>
        /* modal */
/* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Modal Content */
.modal-content {
    background-color: #000;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}
    </style>
</head>
<body>
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
    <div class="container">
        <div class="advertise">
            <!-- ads -->
        </div>
        <div class="main-content">
            <div class="filter1">
                <select name="Sort by" id="">
                    <option value="" hidden>Sort by</option>
                    <option value="">CES points</option>
                    <option value="">Latest</option>
                    <option value="">Oldest</option>
                </select>
            </div>
            <div class="event-content">
                <div class="event-filter">
                    <hr>
                    <details>
                        <summary>Campus</summary><br>
                            <div class="filter">
                                <input type="checkbox">
                                <label>Talamban campus</label><br>
                                <input type="checkbox">
                                <label>Main campus</label>
                            </div>
                    </details><br>

                    <details>
                        <summary>Department</summary><br>
                            <div class="filter">
                                <input type="checkbox">
                                <label>SAS</label><br>
                                <input type="checkbox">
                                <label>SAFAD</label>
                            </div>
                    </details><br>
                </div>
                <div class="event-list">
                    <hr>
                    <?php
                        require_once('../../backend/controllers/event.contr.php');
                                                
                        $eventObj = new EventController($conn);
                        $eventObj->displayEventDetailsWithModal();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer>

    </footer>
    <script>
        function showModal(eventID) 
        {
            document.getElementById('modal-' + eventID).style.display = 'block';
        }

        function closeModal(eventID) 
        {
            document.getElementById('modal-' + eventID).style.display = 'none';
        }

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) 
        {
            const modals = document.getElementsByClassName('modal');
            for (let i = 0; i < modals.length; i++) 
            {
                if (event.target == modals[i]) 
                {
                    modals[i].style.display = 'none';
                }
            }
        }
    </script>
</body>
</html> 