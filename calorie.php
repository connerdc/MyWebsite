<!doctype html>
<html lang="en">

<?php
    include 'php/calorie_db.php';
    $conn = OpenCon();
?>

<head>
    <meta charset="utf-8">

    <title>Conner's Webpage</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calorie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            var d = new Date();
            var ymdDateStr = (d.getFullYear()) + "-" + (d.getMonth()+1) + "-" + d.getDate();
            var currDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
            console.log(currDate);

            $.ajax({
                    type: "GET",
                    url: "php/get_daydate.php",
                    dataType: "json",
                    success: function (data) {
                        var dStringArray = data.dayDate.toString().split(/[- :]/);
                        var dDate = new Date(dStringArray[0], (dStringArray[1]-1), dStringArray[2]);
                        console.log(dDate);

                        if(currDate.valueOf() > dDate.valueOf()) {
                            $("#dayHeader").text(currDate);
                            console.log("Current Day >");
                        } else {
                            $("#dayHeader").text(dDate);
                            console.log("Database Day >=");
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        alert("Can not load day.");
                    }  
            });
        });
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Conner's Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="portfolio.html">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manga.php">Manga</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="calorie.php">Calorie Counter <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <!--
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                </li> -->
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </nav>

    <main>
    <div class="wrapper">
    <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Calorie Counter</h3>
            </div>

            <hr>

            <div class="list-group">
                <button name="currentDayBtn" type="button" class="list-group-item list-group-item-action">Current Day</button>
                <button name="last7Btn" type="button" class="list-group-item list-group-item-action">View Last 7 Days</button>
                <button name="viewDietBtn" type="button" class="list-group-item list-group-item-action">View Diet</button>
                <button name="viewArchiveBtn" type="button" class="list-group-item list-group-item-action">View Archive</button>
            </div>

            <!--
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul> -->

        </nav>
        <!-- Page Content -->
        <div id="content">

            <h1 id="dayHeader">Today's Food Tracking</h1>

            <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>
            </nav> -->
            
        </div>
    </div>
    <hr>

        <footer class="container footer">
            <p>&copy; Company 2017-2019</p>
        </footer>
    </main>

</body>
</html>