<style>
body {
  background-color:white;

}
.pagination {

    display: flex;
    justify-content: center;
    padding-top: 30px;
    padding-bottom: 30px;
}

.pagination a {
  color: white;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<body>
    <div id="user-container">
        <p class="head-label">List of Members</p>
        <table class="table">
            <thead class="table-head">
                <tr>
                    <th>ID | Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>BoB</th>                    
                    <th>Total Score </th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php
                include_once("connectDB.php");
                $No = 1;
                if (isset($_SESSION["us"])) {
                    $username = $_SESSION["us"];
                }
                $results_per_page = 10;
                // find out the number of results stored in database
                $sql = 'SELECT * FROM users';
                $result = mysqli_query($conn, $sql);
                $number_of_results = mysqli_num_rows($result);
                // determine number of total pages available
                (int)$number_of_pages = ceil($number_of_results / $results_per_page);

                // determine which page number visitor is currently on
                if (!isset($_GET['pages'])) {
                    $page = 1;
                } else {
                    $page = $_GET['pages'];
                }
                // determine the sql LIMIT starting number for the results on the displaying page
                $this_page_first_result = ($page - 1) * $results_per_page;
                $sql1 = 'SELECT * FROM users LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                $result = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $name = $row['username'] ;
                    $sql = "SELECT SUM(scores) as score FROM `users_logs` WHERE username='$name'" ;
                    $result_score = mysqli_query($conn,$sql);
                    $score = mysqli_fetch_array($result_score);
                ?>
                    <tr>
                        <td>
                            <p> <?php echo $row['StudentID']; ?> | <?php echo $row['username']; ?> </p>
                        </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['Department']; ?></td>
                        <td><?php echo $row['user_date']; ?></td>
                        
                        <td><?php echo $score['score']; ?></td>
                    </tr>
                <?php $No++;
                } ?>
            </tbody>
        </table>
        <div class="pagination">
            </br>
            </br>
            <?php
                // display the links to the pages
                if($number_of_pages > 1){
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        if ($i == $page) {
                            echo '<span style="background-color:#ccc;padding: 8px 16px; float:left;">' . $i . '</span>  ';
                        } else {
                            echo '<a href="admin.php?page=manageuser&&pages=' . $i . '"><div class="pag-number">' . $i . '</div></a>  ';
                        }
                    }
                }                    
            ?>
        </div>
    </div>
</body>

</html>