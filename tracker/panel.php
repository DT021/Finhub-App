<?php

session_start();
if(isset($_SESSION['tracker']))

{

	include "inc/header.php";
	include "../includes/connect.php";
	$unit = $_SESSION['unit'];
echo'
<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Recently Added Users</h5>
                                        <div class="ibox-tools">
                                            <span class="label label-warning-light pull-right">Latest</span>
                                           </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">';

                                                    $query = "SELECT * FROM users LIMIT 5";
                                                    $run = mysqli_query($dbc,$query);

                                                    if($run)
                                                    {

                                        while($row = mysqli_fetch_array($run, MYSQLI_ASSOC) )
                                                 {

                                                echo '

                                                <div class="feed-element">
                                                    <div class="media-body ">
                                                        <small class="text-danger">new</small>
                                                        <strong>'.$row['firstname']. ' '. $row['lastname'].'</strong> was Added <br>
                                                        <small class="mb-4">Role: '.$row['role'].' </small>

                                                    </div>
                                                </div>


                                                ';

                                                 }
                                                    
                                             } 
                                             echo '
                                            </div>

                                       </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Recent Records From<span class="text-danger"> '.$_SESSION['unit'].' Unit</span></h5>
                                        <div class="ibox-tools">
                                            <span class="label label-warning-light pull-right">Latest</span>
                                           </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">';

                                                    $query = "SELECT * FROM records WHERE unit ='$unit' ORDER BY `id` DESC LIMIT 10";
                                                    $run = mysqli_query($dbc,$query);

                                                    if($run)
                                                    {

                                        while($row = mysqli_fetch_array($run, MYSQLI_ASSOC) )
                                                 {

                                                echo '

                                                <div class="feed-element">
                                                    <div class="media-body ">
                                                        <strong>'.$row['beneficiary']. ' To be Paid #'. $row['amount'].'</strong><br>
                                                        <small class="">Forecast Date:'.$row['forecastdate'].'</small><br/>
                                                        <small class="text-danger">Payment Status</small>: ' .$row['status'].'

                                                    </div>
                                                </div>
                                                ';

                                                 }
                                             }
                                             echo ' 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><span class="text-danger">'.$_SESSION['unit'].'</span> Unit Statistics</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-3">
                                <small class="stats-label">All Records</small>';

                                $query = "SELECT * FROM records WHERE unit = '$unit' ";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'

                                <h4 class="text-danger">'.$num.'</h4>
                            </div>

                            <div class="col-xs-3">
                                <small class="stats-label">Paid Items</small>';

                                $query = "SELECT * FROM records WHERE unit = '$unit' AND status='paid'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Pending Items</small>';

                                $query = "SELECT * FROM records WHERE unit = '$unit' AND status='pending'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Overdue Items</small>';

                                $query = "SELECT * FROM records WHERE unit = '$unit' AND status='overdue'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payment Statistics</h5>
                        <div class="ibox-tools">
                            <span class="label label-danger pull-right">Filters</span>
                           </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-3">
                                <small class="stats-label">Total Amount </small>';

                                $query = "SELECT SUM(amount) AS total FROM records WHERE unit = '$unit'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);

                                echo'

                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>

                            <div class="col-xs-3">
                                <small class="stats-label">Total Paid</small>';

                                $query = "SELECT SUM(amount) AS total FROM records WHERE unit = '$unit' AND status='paid'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);

                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Pending</small>';

                                $query = "SELECT SUM(amount) AS total FROM records WHERE unit = '$unit' AND status='pending'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);

                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Overdue</small>';

                                $query = "SELECT SUM(amount) AS total FROM records WHERE unit = '$unit' AND status='overdue'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);

                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>';

        include 'inc/footer.php';



}
elseif (isset($_SESSION['admin']) AND isset($_SESSION['username'])) {

	echo 'Admin Logged in  <a href="logout.php">Log Out</a>';
	# code...
}
else{
	header("Location:index.php");
}

