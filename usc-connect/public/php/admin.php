<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
      integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

      <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
        <link rel="icon" href="..\images\smartpress.png" type="image/x-icon">
            <style>
                body {
                    font-family: 'Play', sans-serif;
                }
            </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Smart Press</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#orders" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#users" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#feedback" class="sidebar-link">
                        <i class="fa-regular fa-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="logout.php" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
            
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">

                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="..\img\logo.png" class="avatar img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-2 mb-3" id="orders">Events</h3>
                        <div class="row">
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Pending events
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                        <?php
                                            require_once('../../backend/controllers/event.contr.php');
                                                
                                            $eventObj = new EventController($conn);
                                            $events = $eventObj->getEvent();
                                            $eventObj->getEventDetails($events);
                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            In-progress orders
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                        <?php
                                            $sql = "SELECT COUNT(*) as progress_count FROM orders WHERE status = 'In-progress'";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo $row['progress_count'];
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Completed orders
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                        <?php
                                            $sql = "SELECT COUNT(*) as completed_count FROM orders WHERE status = 'Completed'";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo $row['completed_count'];
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Cancelled orders
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                        <?php
                                            $sql = "SELECT COUNT(*) as cancel_count FROM orders WHERE status = 'Canceled'";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo $row['cancel_count'];
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>


                        <!-- ayaw hilabti kai maguba -->
                        <div class="row">
                            <div class="col-12">
                            <div class="table-container">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Email address</th>
                    <th scope="col">Product type</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Size</th>
                    <th scope="col">Product file</th>
                    <th scope="col">Details</th>
                    <th scope="col">Order type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_con.php";
                    $sql = "SELECT * FROM orders,users where orders.userID = users.userID";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result) ) {
                        ?>
                            <tr>
                                <td><?php echo $row['orderID'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['productType'] ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo $row['size'] ?></td>
                                <td><?php echo $row['productFile'] ?></td>
                                <td><?php echo $row['details'] ?></td>  
                                <td><?php echo $row['orderType'] ?></td>   
                                <td><?php echo $row['price'] ?></td>  
                                <td><?php echo $row['status'] ?></td>                              
                                    <td>
                                        <form action="edit_order.php" method="post">
                                            <input type="hidden" name="orderID" value="<?php echo $row['orderID'] ?>">
                                            <button type="submit" style="border: none;"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a></button>
                                        </form>
                                        <a href="#" onclick="confirmDelete(<?php echo $row['orderID'] ?>)" class="link-dark">
                                        <i class="fa-solid fa-trash fs-5" style="margin-right:18px"></i></a>
                                    </td>
                            </tr>
                        <?php

                    }
                ?>
                
            
            </tbody>
        </table>
        </div>
        
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- ayaw hilabti kai maguba -->
             <br><br><br><br>
             <hr>
             <br><br><br><br>
            <!-- users -->
            <div class="user-table" style="width:96%;margin-left: 2%;">
            <h3 class="fw-bold fs-2 mb-3" id="orders">Users</h3>
            <div class="table-container">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Last name</th>
                    <th scope="col">First name</th>
                    <th scope="col">Email address</th>
                    <th scope="col">Password</th>
                    <th scope="col">Account created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_con.php";
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['userID'] > 2){
                        ?>
                            <tr>
                                <td><?php echo $row['userID'] ?></td>
                                <td><?php echo $row['last_name'] ?></td>
                                <td><?php echo $row['first_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <td><?php echo $row['createdAt'] ?></td>
                                <td>
                                    <a href="#" onclick="confirmDeleteUser(<?php echo $row['userID']; ?>)" class="link-dark">
                                    <i class="fa-solid fa-trash fs-5" style="margin-right:18px"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                ?>
                
            
            </tbody>
        </table>
                </div>
            </div>
            <!-- users -->
            <br><br><br><br>
             <hr>
             <br><br><br><br>
            <!-- feedback -->
            <!-- feedback -->
            <div class="feedback-table" style="width:96%;margin-left: 2%;">
            <h3 class="fw-bold fs-2 mb-3" id="feedback">Feedback</h3>
            <div class="table-container">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Contact Info</th>
                    <th scope="col">Concerns/Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_con.php";
                    $sql = "SELECT userID, fullName, contactInfo, concerns FROM feedback";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['userID'] != 1){
                        ?>
                            <tr>
                                <td><?php echo $row['userID'] ?></td>
                                <td><?php echo $row['fullName'] ?></td>
                                <td><?php echo $row['contactInfo'] ?></td>
                                <td><?php echo $row['concerns'] ?></td>
                            </tr>
                        <?php
                        }
                    }
                ?>
                
            
            </tbody>
        </table>
                </div>
            </div>
            <!-- feedback -->
            <!-- feedback -->
        </div>
    </div>
<!-- confirm delete order -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="deleteOrderLink" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- logout confirmation -->
    <div class="modal fade" id="logoutConfirmationModal" tabindex="-1" aria-labelledby="logoutConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutConfirmationModalLabel">Logout Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="logoutUserLink" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- delete user -->
<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="deleteConfirmLink" href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

    <!-- <script src="../js/admin.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
    // guba
    function confirmDelete(orderID) {
        // Set the href attribute of the delete link dynamically based on the orderID
        document.getElementById('deleteOrderLink').href = 'delete_order.php?orderID=' + orderID;
        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        myModal.show();
    }
    function logoutDelete(userID) {
    document.getElementById('logoutUserLink').href = 'logout.php?userID=' + userID;

    var myModal = new bootstrap.Modal(document.getElementById('logoutConfirmationModal'));
    myModal.show();
    }
    // guba

    function confirmDeleteUser(userID) {
    // Set the href attribute of the delete link dynamically based on the userID
    document.getElementById('deleteConfirmLink').href = 'delete_user.php?userID=' + userID;
    // Show the modal
    var myModal = new bootstrap.Modal(document.getElementById('deleteUser'));
    myModal.show();
}
    const hamBurger = document.querySelector(".toggle-btn");

    hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    });
    
</script>
</body>

</html>
