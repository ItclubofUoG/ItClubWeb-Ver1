<?php
//Connect to database

include_once("connectDB.php");
session_start();
$output = '';

if (isset($_POST['To_Excel'])) {
    require 'connectDB.php';
    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $Card_sel = " ";

    if ($_POST['date_sel_start'] != 0 || $_POST['date_sel_end'] != 0 || $_POST['card_sel'] != 0) {
        $check = 1;
    }
    //Start date filter
    if ($_POST['date_sel_start'] != 0) {
        $Start_date = $_POST['date_sel_start'];
        $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
    } else {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate='" . date("Y-m-d") . "'";
    }
    //End date filter
    if ($_POST['date_sel_end'] != "") {
        $End_date = $_POST['date_sel_end'];
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . $End_date . "'";
    } else {
        $End_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . date("Y-m-d") . "'";
    }
    // //Time-In filter
    // if ($_POST['time_sel'] == "Time_in") {
    //     //Start time filter
    //     if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //         $_SESSION['searchQuery'] .= " AND timein='" . $Start_time . "'";
    //     } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //     }
    //     //End time filter
    //     if ($_POST['time_sel_end'] != 0) {
    //         $End_time = $_POST['time_sel_end'];
    //         $_SESSION['searchQuery'] .= " AND timein BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //     }
    // }
    // //Time-out filter
    // if ($_POST['time_sel'] == "Time_out") {
    //     //Start time filter
    //     if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //         $_SESSION['searchQuery'] .= " AND timeout='" . $Start_time . "'";
    //     } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //     }
    //     //End time filter
    //     if ($_POST['time_sel_end'] != 0) {
    //         $End_time = $_POST['time_sel_end'];
    //         $_SESSION['searchQuery'] .= " AND timeout BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //     }
    // }
    //Card filter
    if ($_POST['card_sel'] != 0) {
        $Card_sel = $_POST['card_sel'];
        $_SESSION['searchQuery'] .= " AND card_uid='" . $Card_sel . "'";
    }
    // //Department filter
    // if ($_POST['dev_uid'] != 0) {
    //     $dev_uid = $_POST['dev_uid'];
    //     $_SESSION['searchQuery'] .= " AND device_uid='" . $dev_uid . "'";
    // }


    // if ($_POST['select_date'] == 1) {
    //     $Start_date = date("Y-m-d");
    //     $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
    // }
    
    $sql = "SELECT * FROM users_logs ORDER BY id DESC";
    if (isset($_SESSION['searchQuery']) && $check == 1) { //
        $sql = "SELECT * FROM users_logs WHERE " . $_SESSION['searchQuery'] . " ORDER BY id DESC";
    }

    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $output .= '
                  <table class="table" border="1" style="font-size: 20px; border: 2px solid">  
                    <TR>
                      <TH style="background-color: #33F0FF">ID</TH>
                      <TH style="background-color: #33F0FF">Name</TH>
                      <TH style="background-color: #33F0FF">Date log</TH>
                      <TH style="background-color: #33F0FF">Time In</TH>
                      <TH style="background-color: #33F0FF">Time Out</TH>
                      <TH style="background-color: #33F0FF">Score</TH>
                    </TR>';
        while ($row = $result->fetch_assoc()) {
            $output .= '
                        <TR> 
                            <TD> ' . $row['id'] . '</TD>
                            <TD> ' . $row['username'] . '</TD>                           
                            <TD> ' . $row['checkindate'] . '</TD>
                            <TD> ' . $row['timein'] . '</TD>
                            <TD> ' . $row['timeout'] . '</TD>
                            <TD> ' . $row['scores'] . '</TD>
                        </TR>';
        }
        $output .= '</table>';
        $dateExport = date("Y-m-d");
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log - ' . date('d-m-Y', strtotime($dateExport)) . '.xls');

        echo $output;
        exit();
    } else {
        header("location: admin.php?page=userlog");
        exit();
    }
}
if (isset($_POST['user_log'])) {
    require 'connectDB.php';
    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $Card_sel = " ";

    if ($_POST['date_sel_start'] != 0 || $_POST['date_sel_end'] != 0 || $_POST['card_sel'] != 0) {
        $check = 1;
    }
    //Start date filter
    if ($_POST['date_sel_start'] != 0) {
        $Start_date = $_POST['date_sel_start'];
        $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
    } else {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate='" . date("Y-m-d") . "'";
    }
    //End date filter
    if ($_POST['date_sel_end'] != "") {
        $End_date = $_POST['date_sel_end'];
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . $End_date . "'";
    } else {
        $End_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . date("Y-m-d") . "'";
    }
    // //Time-In filter
    // if ($_POST['time_sel'] == "Time_in") {
    //     //Start time filter
    //     if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //         $_SESSION['searchQuery'] .= " AND timein='" . $Start_time . "'";
    //     } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //     }
    //     //End time filter
    //     if ($_POST['time_sel_end'] != 0) {
    //         $End_time = $_POST['time_sel_end'];
    //         $_SESSION['searchQuery'] .= " AND timein BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //     }
    // }
    // //Time-out filter
    // if ($_POST['time_sel'] == "Time_out") {
    //     //Start time filter
    //     if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //         $_SESSION['searchQuery'] .= " AND timeout='" . $Start_time . "'";
    //     } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //         $Start_time = $_POST['time_sel_start'];
    //     }
    //     //End time filter
    //     if ($_POST['time_sel_end'] != 0) {
    //         $End_time = $_POST['time_sel_end'];
    //         $_SESSION['searchQuery'] .= " AND timeout BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //     }
    // }
    //Card filter
    if ($_POST['card_sel'] != 0) {
        $Card_sel = $_POST['card_sel'];
        $_SESSION['searchQuery'] .= " AND card_uid='" . $Card_sel . "'";
    }
    // //Department filter
    // if ($_POST['dev_uid'] != 0) {
    //     $dev_uid = $_POST['dev_uid'];
    //     $_SESSION['searchQuery'] .= " AND device_uid='" . $dev_uid . "'";
    // }


    // if ($_POST['select_date'] == 1) {
    //     $Start_date = date("Y-m-d");
    //     $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
    // }

    $sql = "SELECT * FROM users_logs WHERE " . $_SESSION['searchQuery'] . " ORDER BY id DESC";
    header("location: admin.php?page=userlog&&func=filter&&sql=$sql");
}
//delete user logs
if (isset($_POST['btn_delete'])) {
    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $card_sel = " ";
    $check = 0;
    if ($_POST['date_sel_start'] != 0 && $_POST['date_sel_end'] != 0 || $_POST['card_sel'] != 0 || $_POST['dev_sel'] != 0) {
        $check = 1;
    }
    //Start date filter
    if ($_POST['date_sel_start'] != 0) {
        $Start_date = $_POST['date_sel_start'];
        $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
    } else {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate='" . date("Y-m-d") . "'";
    }
    //End date filter
    if ($_POST['date_sel_end'] != "") {
        $End_date = $_POST['date_sel_end'];
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . $End_date . "'";
    } else {
        $End_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . date("Y-m-d") . "'";
    }
    // if (isset($_POST['time_sel'])) {
    //     if ($_POST['time_sel'] == "Time_in") {
    //         //Start time filter
    //         if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //             $Start_time = $_POST['time_sel_start'];
    //             $_SESSION['searchQuery'] .= " AND timein='" . $Start_time . "'";
    //         } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //             $Start_time = $_POST['time_sel_start'];
    //         }
    //         //End time filter
    //         if ($_POST['time_sel_end'] != 0) {
    //             $End_time = $_POST['time_sel_end'];
    //             $_SESSION['searchQuery'] .= " AND timein BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //         }
    //     }
    //     //Time-out filter
    //     if ($_POST['time_sel'] == "Time_out") {
    //         //Start time filter
    //         if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
    //             $Start_time = $_POST['time_sel_start'];
    //             $_SESSION['searchQuery'] .= " AND timeout='" . $Start_time . "'";
    //         } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
    //             $Start_time = $_POST['time_sel_start'];
    //         }
    //         //End time filter
    //         if ($_POST['time_sel_end'] != 0) {
    //             $End_time = $_POST['time_sel_end'];
    //             $_SESSION['searchQuery'] .= " AND timeout BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
    //         }
    //     }
    // }
    // //Time-In filter

    //Card filter
    if ($_POST['card_sel'] != 0) {
        $card_sel = $_POST['card_sel'];
        $_SESSION['searchQuery'] .= " AND card_uid='" . $card_sel . "'";
    }
    //Department filter
    // if ($_POST['dev_sel'] != 0) {
    //     $dev_uid = $_POST['dev_sel'];
    //     $_SESSION['searchQuery'] .= " AND device_uid='" . $dev_uid . "'";
    // }
    $sql = "DELETE FROM `users_logs`";
    if (isset($_SESSION['searchQuery']) && $check == 1) {
        $sql = "DELETE FROM `users_logs` WHERE " . $_SESSION['searchQuery'] . "";
    } else {
        $sql = "DELETE FROM `users_logs`";
    }
    mysqli_query($conn, $sql);
    header("location: admin.php?page=userlog");
    exit();
}



// Add user log manually
if (isset($_GET['function']) && $_GET['function'] == 'addUserLog') {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $id = $_POST['stdID'];
    $checkinDate = date("Y-m-d");
    $timeIn = $timeOut = date("H:i:s");

    $sqlCheckID = mysqli_query($conn, "SELECT * FROM users where StudentID = '$id'");

    if (mysqli_num_rows($sqlCheckID) != 0) {
        $row = mysqli_fetch_array($sqlCheckID, MYSQLI_ASSOC);

        $username = $row['username'];
        $serial = $row['serialnumber'];
        $carduid = $row['card_uid'];
        $deviceid = $row['device_uid'];
        $deviceDep = $row['device_dep'];

        $sqlCheckExists = mysqli_query($conn, "SELECT * FROM users_logs where card_uid = '$carduid' and checkindate = '$checkinDate'");

        if (mysqli_num_rows($sqlCheckExists) == 0) {
            mysqli_query($conn, "INSERT INTO users_logs (username,serialnumber,card_uid,device_uid,device_dep,checkindate,timein, timeout, scores) 
                                        VALUES ('$username','$serial','$carduid','$deviceid','$deviceDep','$checkinDate','$timeIn','$timeOut',1)");
            echo "<script>alert('Add successfully'); location.href='admin.php?page=userlog' </script>";
        } else {
            echo "<script>alert('Student have already check-in'); location.href='admin.php?page=userlog' </script>";
        }
    } else {
        echo "<script>alert('Student ID does not exist'); location.href='admin.php?page=userlog' </script>";
    }
}
