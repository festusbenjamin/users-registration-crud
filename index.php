<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>User Management System</title>
</head>

<body>
    <!-- Modal Start -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="completeName" class="form-label">Name</label>
                        <input type="text" placeholder="Enter your name" class="form-control" id="completeName">
                    </div>
                    <div class="mb-3">
                        <label for="completeEmail" class="form-label">Email</label>
                        <input type="email" placeholder="Enter your email" class="form-control" id="completeEmail">
                    </div>
                    <div class="mb-3">
                        <label for="completeMobile" class="form-label">Mobile</label>
                        <input type="number" placeholder="Enter your mobile number" class="form-control" id="completeMobile">
                    </div>
                    <div class="mb-3">
                        <label for="completeResidence" class="form-label">Residence</label>
                        <input type="text" placeholder="Enter your residence" class="form-control" id="completeResidence" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="addUser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Update Modal Start -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updateName" class="form-label">Name</label>
                        <input type="text" placeholder="Enter your name" class="form-control" id="updateName">
                    </div>
                    <div class="mb-3">
                        <label for="updateEmail" class="form-label">Email</label>
                        <input type="email" placeholder="Enter your email" class="form-control" id="updateEmail">
                    </div>
                    <div class="mb-3">
                        <label for="updateMobile" class="form-label">Mobile</label>
                        <input type="number" placeholder="Enter your mobile number" class="form-control" id="updateMobile">
                    </div>
                    <div class="mb-3">
                        <label for="updateResidence" class="form-label">Residence</label>
                        <input type="text" placeholder="Enter your residence" class="form-control" id="updateResidence" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateUser()">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddenData" />
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal End -->

    <div class="container my-3 ">
        <h1 class="text-center">User Management System Using Bootstrap Model in PHP</h1>
        <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#completeModal">Add New User</button>
        <div id="displayDataTable"></div>
    </div>


    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            displayData();
        });

        //Display data
        function displayData() {
            var displayData = 'true';

            $.ajax({
                url: 'display.php',
                type: 'POST',
                data: {
                    sendDisplay: displayData
                },
                success: function(data, status) {
                    $('#displayDataTable').html(data);
                }
            })
        }

        //Update User
        function addUser() {
            var addName = $('#completeName').val();
            var addEmail = $('#completeEmail').val();
            var addMobile = $('#completeMobile').val();
            var addResidence = $('#completeResidence').val();

            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    sendName: addName,
                    sendEmail: addEmail,
                    sendMobile: addMobile,
                    sendResidence: addResidence,
                },
                success: function(data, status) {
                    // function to display data
                    $("#completeModal").modal('hide')
                    displayData();
                }
            });
        }

        //Delete user
        function deleteUser(deleteId) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
                return false;
            }
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {
                    sendDelete: deleteId
                },
                success: function(data, status) {
                    displayData();
                }
            })
        }

        //Get User
        function getUser(userId) {
            $('#updateModal').modal('show');

            $('#hiddenData').val(userId);

            $.post("update.php", {userId:userId}, function(data,status){
                var user = JSON.parse(data);
                $('#updateName').val(user.name);
                $('#updateEmail').val(user.email);
                $('#updateMobile').val(user.mobile);
                $('#updateResidence').val(user.residence);
            });

        }

        //Update User
        function updateUser() {
            var updateName = $('#updateName').val();
            var updateEmail = $('#updateEmail').val();
            var updateMobile = $('#updateMobile').val();
            var updateResidence = $('#updateResidence').val();
            var hiddenData = $('#hiddenData').val();

            $.post("update.php",{updateName:updateName, updateEmail:updateEmail, updateMobile:updateMobile, updateResidence:updateResidence, hiddenData:hiddenData}, function(data,status){
                $("#updateModal").modal('hide')
                displayData();
            })
        }
    </script>
</body>

</html>