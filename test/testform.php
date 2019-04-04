<!doctype html>
<html lang="en">
<?php
    include 'php/db_connection.php';
    $conn = OpenCon();
?>
<head>
    <meta charset="utf-8">

    <title>Conner's Webpage</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>

        $(document).ready(function () {
            $("form").submit(function (e) { 
                e.preventDefault();
                var firstname = $("#firstname").val();
                var lastname = $("#lastname").val();
                $.ajax({
                    type: "POST",
                    url: "testinsert.php",
                    data: {
                        firstname: firstname, 
                        lastname: lastname
                    },
                    success: function (response) {
                        alert(response);
                    },
                    error: function (response) {
                        alert(response);
                    }
                });
            });
        });

    </script>

</head>
    
<body>
    <form action="testinsert.php" method="post">
        <div class="form-group">
            <label>First Name</label>
            <input id="firstname" type="text" class="form-control"  placeholder="First Name">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input id="lastname" type="text" class="form-control" placeholder="Last Name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr>

    <footer class="container">
        <p>&copy; Company 2017-2019</p>
    </footer>
</body>
</html>