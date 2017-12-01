<?php
if(!isset($_SESSION['username'])) {
    session_start();
}
$pagename = "PROFILE";
require_once('includes/functions.php');
check_cookie();

authenticate();

require_once('includes/header.php');
?>

    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <h1>
                <?php echo ' I am ' . '<span id="firstname">' . $_SESSION['firstname'] . '</span>' ?>
            </h1>
        </div>
    </div>

    <div class='container'>

        <table class="table table-bordered" id="profile_table">
            <tr>
                <th>Name</th>
                <td>
                    <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
                </td>
            </tr>
            <tr>
                <th>Username</th>
                <td>
                    <?php echo $_SESSION['username'] ?>
                </td>
            </tr>
            <tr>
                <th>Email address</th>
                <td>
                    <?php echo $_SESSION['email'] ?>
                </td>
            </tr>
        </table>

    </div>

    <br>

    <div class="container">

        <h3>Update account Information</h3>
        <br>

        <form id="update_form">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="xfirstname" placeholder="Enter your first name">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group" method="">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter desired password">
            </div>
            <br>
            <div class="form-group">
                <h4>Verify changes with current password</h4>
                <label for="oldpassword">Current password</label>
                <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter current password">
            </div>
            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
        </form>

    </div>

    <br>

    <?php
    include("includes/footer.php");
    ?>

        <script>
            $(document).ready(function () {
                $('#update_form').on("submit", function (event) {
                    event.preventDefault();
                    
                    $.ajax({
                        url: "pform.php",
                        method: "POST",
                        data: $('#update_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Updating...");
                        },
                        success: function (data) {
                        
                            $('#insert').val("Insert");
                            $('#update_form')[0].reset();
                            $('#profile_table').html(data);
                            

                        }
                    })
                });
            });

    
        </script>
        </body>

        </html>
