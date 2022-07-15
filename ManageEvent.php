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


</style>
<?php include_once('ConnectDB.php'); ?>

<body>

    <div id="manage-container">
        <p class="head-label">Manage Event</p>
        <div class="detail-mn">
            <!-- /model adduser -->
            <div class="modaluser js-modal-ev">
                <form class="modal-container js-modal-container-ev" method="POST" action="ManageEventPro.php?func=add" enctype="multipart/form-data">
                    <div class="modal-header">
                        <div class="modal-label">
                            <p> Add New Event </p>
                        </div>
                        <div class="model-close js-modal-close-ev">
                            <i class=" icon-close">X</i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-input">
                            <input type="text" class="input-info" name="title" id="title" placeholder="Event Name">
                            <p class="error-ev" style="margin-bottom: 0; margin-bottom: 1px;"></p>
                        </div>
                        <div class="modal-input">
                            <input type="date" class="input-info" name="date" id="date" placeholder="Date">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="time" class="input-info" name="time" id="time" placeholder="Time">
                            <p class="error-ev"></p>
                        </div>
                        <div class="modal-input">
                            <input type="text" class="input-info" id="location" name="location" placeholder="Location">
                            <p class="error-ev"></p>
                        </div>
                        
                        <div class="modal-input">
                            <label for="" style="font-size: 13px;">Image</label>
                            <input class="img-event" type="file" class="input-info" name="image" id="image" accept="image/*" required>
                            <p class="error-ev"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button">
                            <button type="submit" class="modal-button" name="btn_add" id="btn_add">Add New</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- finish modal user -->


            <div class="detail-right">
                <div class="btn-add">
                    <button class="add-user js-add-ev"> Add New Event</button>
                </div>
                <div class="table-1">
                    <table class="table">
                        <thead class="table-head">

                            <tr class="tr-head">
                                <th class="th-head" style="max-width: 40px;">ID | Title</th>
                                <th class="th-head" style="min-width: 10px;">Date</th>
                                <th class="th-head" style="min-width: 40px;">Time</th>
                                <th class="th-head" style="min-width: 10px;">Location</th>
                                
                                
                                <th class="th-head">Image</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                            $results_per_page = 10;
                            // find out the number of results stored in database
                            $sql = 'SELECT * FROM event';
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
                            $sql1 = 'SELECT * FROM event ORDER BY id LIMIT ' . $this_page_first_result . ',' .  $results_per_page;

                            $result = mysqli_query($conn, $sql1);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                                <tr class="tr-body">
                                    <td class="td-body" style="max-width: 40px;">
                                        <a href="?page=manageevent_update&&func=update&&id=<?php echo $row['id']; ?>" class="update-name js-update-name"> <?php echo $row['id']; ?> | <?php echo $row['title']; ?> </a>
                                    </td>
                                    <td class="td-body" style="min-width: 10px;"><?php echo $row['date']; ?></td>
                                    <td class="td-body" style="max-width: 40px;"><?php echo $row['time']; ?></td>
                                    <td class="td-body" style="min-width: 10px;"><?php echo $row['location']; ?></td>
                                                                   
                                    <td class="td-body"><img src="./Event Image/<?php echo $row['image']; ?>" alt="" width="95%" height="150px" title="<?php echo $row['image']; ?>" ></td>

                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                    <?php
                    // display the links to the pages
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        echo '<a href="admin.php?page=manageevent&&pages=' . $page . '">' . $page . '</a> ';
                    }                   
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>


    <script>

        const addEvs = document.querySelectorAll('.js-add-ev') //sellect the class use to use js
        const modalcloseEv = document.querySelector('.js-modal-close-ev')
        const modalUser = document.querySelector('.js-modal-ev')


        function showModalAdd() {
            modalUser.classList.add('open1')
        }

        for (const addUser of addEvs) {
            addUser.addEventListener('click', showModalAdd)
        }

        function hideModalAdd() {
            modalUser.classList.remove('open1')
        }
        modalcloseEv.addEventListener('click', hideModalAdd)

        // modalUser.addEventListener('click', hideModalAdd)

        modalcontainerUser.addEventListener('click', function(event) {
            event.stopPropagation() //stop nổi bọt
        })
    </script>

</body>
