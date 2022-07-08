<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/User/event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>

<body style="background-color:  #0c5774;">


    <div class="skin">
        
            <?php
            include_once('./connectDB.php');
            if (isset($_GET['id'])) {
                echo '<script type="text/javascript">',
                'open_modal();',
                '</script>';
            }
            $sql = "SELECT * FROM `event` order by id desc";
            $result = mysqli_query($conn, $sql);
            $no = 1;
            while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC)) {

            ?>
                <?php if ($no % 2 != 0) { ?>
                    <div class="et-piece">
                        <img src="Event Image/<?php echo $row['image'] ?>" alt="450x300" class="et-figure p1">
                        <div class="et-piece-info p2">
                            <div class="et-detail">Title: <b><?php echo $row['title'] ?></b></div>
                            <div class="et-detail">Date: <b><?php echo date('d-m-Y', strtotime($row['date'])) ?></b></div>
                            <div class="et-detail">Time: <b><?php echo $row['time'] ?></b></div>
                            <div class="et-detail">Location: <b><?php echo $row['location'] ?></b></div>
                            <div class="et-detail">Score: <b><?php echo $row['score'] ?></b></div>
                            
                            
                        </div>
                    </div>
                <?php } else { ?>


                    <!-- The event piece has picture right -->
                    <div class="et-piece">
                        <img src="Event Image/<?php echo $row['image'] ?>" alt="450x300" class="et-figure p2">
                        <div class="et-piece-info p4">
                            <div class="et-detail">Title: <b><?php echo $row['title'] ?></b></div>
                            <div class="et-detail">Date: <b><?php echo date('d-m-Y', strtotime($row['date'])) ?></b></div>
                            <div class="et-detail">Time: <b><?php echo $row['time'] ?></b></div>
                            <div class="et-detail">Location: <b><?php echo $row['location'] ?></b></div>
                            <div class="et-detail">Score: <b><?php echo $row['score'] ?></b></div>
                            
                        </div>
                    </div>

            <?php }
                $no++;
            } ?>

        </div>
    </div>
</body>

</html>