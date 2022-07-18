<?php
include_once('ConnectDB.php');
//add  function
if (isset($_GET['func']) && $_GET['func'] == 'add') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    // $description = $_POST['description'];
    $pic = $_FILES['image'];

    if ($pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png" || $pic['type'] == "image/gif") {
        $image = $pic['name'];
        $sql = "SELECT * from event where image = '$image'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            copy($pic['tmp_name'], "./Event Image/" . $pic['name']);
            mysqli_query($conn, "INSERT INTO `event`(`title`, `date`, `location`, `time`,image) VALUES ('$title','$date','$location','$time','$image')");
            echo "<script> location.href='admin.php?page=manageevent'</script>";
            exit;
        } else {
            echo "<script>alert('Image name already exist, please change file name before upload!')</script>";
            echo "<script> location.href='admin.php?page=manageevent'</script>";
        }
    }
}

//update function
if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    // $description = $_POST['description'];
    $pic = $_FILES['image'];
    $image = $pic['name'];

    if ($pic['name'] != "") {
        if ($pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png" || $pic['type'] == "image/gif") {
            copy($pic['tmp_name'], "./Event Image/" . $pic['name']);
            mysqli_query($conn, "UPDATE `event` SET `title`='$title',`date`='$date',`location`='$location',`time`='$time', image='$image' WHERE `id`='$id'") or die(mysqli_error($conn));
            echo "<script> location.href='admin.php?page=manageevent'</script>";
            exit;
        }
    } else {
        mysqli_query($conn, "UPDATE `event` SET `title`='$title',`date`='$date',`location`='$location',`time`='$time' WHERE `id`='$id'") or die(mysqli_error($conn));
        echo "<script> location.href='admin.php?page=manageevent'</script>";
    }
}
//remove function
if (isset($_POST['btn_delete'])) {
    $id = $_POST['id'];
    $res = mysqli_query($conn, "SELECT * FROM `event` WHERE id='$id'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $filePic = $row['image'];
    unlink("./Event Image/" . $filePic);
    mysqli_query($conn, "DELETE FROM `event` WHERE id='$id'");
    echo "<script> location.href='admin.php?page=manageevent'</script>";
    exit;
}
