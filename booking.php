<?php
session_start();
include('doctor/includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobnum = $_POST['phone'];
    $email = $_POST['email'];
    $appdate = $_POST['date'];
    $specialization = $_POST['specialization'];
    $doctorlist = $_POST['doctorlist'];
    $user_type = $_POST['user_type'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        $error = "Appointment date must be greater than today's date.";
    } else {
        $sql = "INSERT INTO tblappointment(AppointmentNumber, Name, MobileNumber, Email, AppointmentDate, Specialization, Doctor) 
                VALUES (:aptnumber, :name, :mobnum, :email, :appdate, :specialization, :doctorlist)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctorlist', $doctorlist, PDO::PARAM_INT);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book an Appointment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #ccc;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .col-lg-6,
        .col-lg-3,
        .col-md-4,
        .col-12,
        .col-6 {
            flex: 1 1 45%;
            min-width: 200px;
        }

        .col-lg-3,
        .col-md-4,
        .col-6.mx-auto {
            flex: 1 1 100%;
            display: flex;
            justify-content: center;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button.form-control {
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button.form-control:hover {
            background: #0056b3;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
    <script src="js/jquery.min.js"></script>
    <script>
        function getdoctors(val) {
            $.ajax({
                type: "POST",
                url: "get_doctors.php",
                data: 'sp_id=' + val,
                success: function (data) {
                    $("#doctorlist").html(data);
                }
            });
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        <?php if (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form role="form" method="post">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <select name="user_type" id="user_type" class="form-control" required>
                        <option value="">Who are you?</option>
                        <option value="new">new appointment</option>
                        <option value="returning">already booked </option>
                        <option value="browse">inquiry</option>
                    </select>
                </div>
                <div class="col-lg-6 col-12">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required>
                </div>
                <div class="col-lg-6 col-12">
                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                        placeholder="Email address" required>
                </div>
                <div class="col-lg-6 col-12">
                    <input type="telephone" name="phone" id="phone" class="form-control"
                        placeholder="Enter Phone Number" maxlength="10">
                </div>
                <div class="col-lg-6 col-12">
                    <input type="date" name="date" id="date" value="" class="form-control" required>
                </div>
                <div class="col-lg-6 col-12">
                    <select onChange="getdoctors(this.value);" name="specialization" id="specialization"
                        class="form-control" required>
                        <option value="">Select specialization</option>
                        <?php
                        $sql = "SELECT * FROM tblspecialization";
                        $stmt = $dbh->query($sql);
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>"><?php echo $row['Specialization']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-6 col-12">
                    <select name="doctorlist" id="doctorlist" class="form-control" required>
                        <option value="">Select Doctor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 mx-auto">
                    <button type="submit" class="form-control" name="submit" id="submit-button">Completed</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>