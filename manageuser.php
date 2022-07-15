<style>
    body {
        background-color: white;

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

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    .form-group-search {
        margin-left: 8%;
    }

    .form-label-s {
        width: 380px;
        height: 30px;
        margin: 5px 0px 5px 2%;
        /* style="width: 80px; height: 34px"; */
    }

    #btn_search {
        width: 80px;
        height: 34px;
        border: 1px solid #777;
        background-color: #FB8122;
        color: #fff;
    }

    #btn_search:hover {
        transition: 0.3s;
        cursor: pointer;
    }

    @media screen and (max-width: 900px) {
        .form-group-search {
            margin-left: 8%;
        }

        .form-label-s {
            width: 230px;
            height: 22px;
            margin: 5px 0px 5px 2%;
            /* style="width: 80px; height: 34px"; */
        }

        #btn_search {
            width: 60px;
            height: 26px;
            border: 1px solid #777;
            background-color: #FB8122;
            color: #fff;
        }

        #btn_search:hover {
            transition: 0.3s;
            cursor: pointer;
        }
    }
</style>
<!-- body -->
<div id="manage-container">
    <p class="head-label">Manage User</p>
    <div class="detail-mn">
        <!-- /model adduser -->
        <div class="modaluser js-modal-user">
            <form id="form-add" name="form-add" class="modal-container js-modal-container-user" action="manageuserpro.php?function=add" method="POST">
                <div class="modal-header">
                    <div class="modal-label">
                        <p> User Info </p>
                    </div>
                    <div class="model-close js-modal-close-user">
                        <i class=" icon-close">x</i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-input">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="input-info" placeholder="UserName" style="padding-left: 10px;">
                            <p class="error"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="stid" id="stid" class="input-info" placeholder="StudentID....." style="padding-left: 10px;">
                            <p class="error" style="margin-bottom: 0;"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" id="email" name="email" class="input-info" placeholder="User email,...." style="padding-left: 10px;">
                            <p class="error" style="margin-bottom: 0;"></p>
                        </div>
                        <div class="form-group">
                            <input type="number" id="card_id" name="cart_id" class="input-info" placeholder="CardID,...." style="padding-left: 10px;">
                            <p class="error" style="margin-bottom: 0;"></p>
                        </div>
                        <div class="form-group">
                            <input type="date" id="dob" name="dob" class="input-info" placeholder="DoB,...." style="padding-left: 10px;">
                            <p class="error" style="margin-bottom: 0;"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" id="github" name="github" class="input-info" placeholder="Github,...." style="padding-left: 10px;">
                            <p class="error" style="margin-bottom: 0;"></p>
                        </div>
                    </div>
                    <div class="modal-sublabel">
                        <h4>Additional Info</h4>
                    </div>
                    <label class="department-label">User Department:</label>
                    <div class="modal-input">
                        <select class="input-info" name="department" id="department" placeholder="Department">
                            <option value="1">All Department</option>
                            <option value="Font-end">Font-end</option>
                            <option value="Back-end">Back-end</option>
                            <option value="Design">Design</option>
                            <option value="Media">Media</option>
                        </select>
                    </div>
                    <label class="department-label">Gender:</label>
                    <div class="gender">
                        <input type="radio" name="gender" value="male" checked> <span>Male</span>
                        <input type="radio" name="gender" value="female"> <span>Female</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="button">
                        <button type="submit" name="btn_add" id="btn_add" class="modal-button">Add User</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- finish modal user -->


        <div>
            <form action="" method="POST">
                <div class="form-group-search">
                    <input type="text" name="id" placeholder="" class="form-label-s">
                    <button type="submit" name="btn_search" id="btn_search">Search</button>
                </div>
                <!-- <div class="btn-add1">
                <button class="add-user js-add-user" style="width: 80px; height: 30px"> Add new</button>
            </div> -->
            </form>
        </div>


        <div class="detail-right">

            <div class="table-1">
                <table class="table">
                    <thead class="table-head">
                        <tr>
                            <th>ID | Name</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Card UID</th>
                            <th>DoB</th>
                            <th>Github</th>
                            <th>Email</th>
                            <th>Total Score</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php
                        include_once('connectDB.php');
                        if (isset($_POST['btn_search'])) {
                            $id = $_POST['id'];

                            $results_per_page = 10;
                            // find out the number of results stored in database
                            $sql = "SELECT * FROM users WHERE StudentID like '%$id%' or username like '%$id%'";
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
                            $this_page_first_result = 0;
                            $sql1 = "SELECT * FROM users WHERE StudentID like '%$id%' or username like '%$id%' LIMIT " . $this_page_first_result . ',' .  $results_per_page;
                            $result = mysqli_query($conn, $sql1);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $name = $row['username'];
                                $sql = "SELECT SUM(scores) as score FROM `users_logs` WHERE username='$name'";
                                $result_score = mysqli_query($conn, $sql);
                                $score = mysqli_fetch_array($result_score);
                                // echo $score['score'];
                        ?>

                                <tr>
                                    <td>
                                        <a href="?page=manageuser_update&&stuid=<?php echo $row['StudentID']; ?>" class="update-name js-update-name"> <?php echo $row['StudentID']; ?> | <?php echo $row['username']; ?> </a>
                                    </td>
                                    <td> <?php echo $row['Department']; ?> </td>
                                    <td> <?php echo $row['gender']; ?> </td>
                                    <td> <?php echo $row['card_uid']; ?> </td>
                                    <td> <?php echo $row['user_date']; ?> </td>
                                    <td> <?php echo $row['github']; ?> </td>
                                    <td> <?php echo $row['email']; ?> </td>
                                    <td> <?php echo $score['score']; ?> </td>
                                </tr>

                            <?php }
                        } else {
                            $results_per_page = 15;
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
                                $name = $row['username'];
                                $sql = "SELECT SUM(scores) as score FROM `users_logs` WHERE username='$name'";
                                $result_score = mysqli_query($conn, $sql);
                                $score = mysqli_fetch_array($result_score);

                            ?>
                                <tr>
                                    <td>
                                        <a href="?page=manageuser_update&&stuid=<?php echo $row['StudentID']; ?>" class="update-name js-update-name"> <?php echo $row['StudentID']; ?> | <?php echo $row['username']; ?> </a>
                                    </td>
                                    <td> <?php echo $row['Department']; ?> </td>
                                    <td> <?php echo $row['gender']; ?> </td>
                                    <td> <?php echo $row['card_uid']; ?> </td>
                                    <td> <?php echo $row['user_date']; ?> </td>
                                    <td> <?php echo $row['github']; ?> </td>
                                    <td> <?php echo $row['email']; ?> </td>
                                    <td> <?php echo $score['score']; ?> </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    </br>
                    </br>
                    <?php
                    // display the links to the pages
                    if ($number_of_pages > 1) {
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
        </div>
    </div>
</div>
<script script>
    const addUsers = document.querySelectorAll('.js-add-user') //sellect the class use to use js
    const modalcloseUser = document.querySelector('.js-modal-close-user')
    const modalUser = document.querySelector('.js-modal-user')
    const modalcontainerUser = document.querySelector('.js-modal-container-user')

    function showModalAdd() {
        modalUser.classList.add('open')
    }

    for (const addUser of addUsers) {
        addUser.addEventListener('click', showModalAdd)
    }

    function hideModalAdd() {
        modalUser.classList.remove('open')
    }
    modalcloseUser.addEventListener('click', hideModalAdd)

    modalUser.addEventListener('click', hideModalAdd)

    modalcontainerUser.addEventListener('click', function(event) {
        event.stopPropagation() //stop nổi bọt
    })
</script>

<script src="./js/validator_all.js"></script>
<script>
    Validator({
        form: '#form-add',
        formGroupSelector: '.form-group',
        errorSelector: '.error',
        rules: [
            Validator.isRequired('#username', 'This field can not empty'),
            Validator.isRequired('#stid', 'This field can not empty'),
            Validator.isRequired('#email', 'This field can not empty'),
            Validator.isRequired('#card_id', 'This field can not empty'),
            Validator.isRequired('#github', 'This field can not empty'),
            Validator.isEmail('#email', 'Invalid email'),
        ],
        // onSubmit: function(data) {
        //     console.log(data)
        // }
    });
</script>