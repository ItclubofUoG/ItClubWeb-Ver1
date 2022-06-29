
<?php include_once('ConnectDB.php'); ?>

<body>

    <div id="manage-container">
        <p class="head-label">Manage Event</p>
        <div class="detail-mn">
            <!-- /model adduser -->
            <div class="modaluser js-modal-ev">
                <form class="modal-container js-modal-container-ev" method="POST" action="ManageEventPro.php?func=add" id="formadd">
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
                            <p class="error-ev"></p>
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
                            <input type="text" class="input-info" name="description" id="description" placeholder="Description">
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
                <!-- <div class="btn-add">
                    <button class="add-user js-add-ev"> Add New Event</button>
                </div> -->
                <div class="table-1">
                    <table class="table">
                        <thead class="table-head">

                            <tr class="tr-head">
                                <th class="th-head">ID | Title</th>
                                <th class="th-head">Date</th>
                                <th class="th-head">Time</th>
                                <th class="th-head">Location</th>
                                <th class="th-head">Description</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM `event`");
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                                <tr class="tr-body">

                                    <td class="td-body">
                                        <a href="?page=manageevent_update&&func=update&&id=<?php echo $row['id']; ?>" class="update-name js-update-name"> <?php echo $row['id']; ?> | <?php echo $row['title']; ?> </a>
                                    </td>
                                    <td class="td-body"><?php echo $row['date']; ?></td>
                                    <td class="td-body"><?php echo $row['time']; ?></td>
                                    <td class="td-body"><?php echo $row['location']; ?></td>
                                    <td class="td-body"><?php echo $row['description']; ?></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
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

        modalUser.addEventListener('click', hideModalAdd)

        modalcontainerUser.addEventListener('click', function(event) {
            event.stopPropagation() //stop nổi bọt
        })


        
        Validator({
            form: '#formadd',
            formGroupSelector: '.modal-body',
            errorSelector: '.error',
            rules: [
                Validator.isRequired('#devicename', 'This feild can not empty'),
                Validator.isRequired('#departmentname', 'This feild can not empty'),
            ],
        });
    
    </script>

</body>
