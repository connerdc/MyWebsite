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

        /*
            Things to do:
                1. Double insert in add_mealday doesn't work, try it formatted like this: https://stackoverflow.com/questions/4565195/mysql-how-to-insert-into-multiple-tables-with-foreign-keys
        */

        $(document).ready(function () {
            var nextDayID;

            var d = new Date();
            var ymdDateStr = (d.getFullYear()) + "-" + (d.getMonth()+1) + "-" + d.getDate();
            var currDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
            var insertDate = (d.getMonth()+1) + "-" + d.getDate() + "-" + d.getFullYear();
            $.ajax({
                    type: "GET",
                    url: "php/get_daydate.php",
                    dataType: "json",
                    success: function (data) {
                        var dStringArray = data.dayDate.toString().split(/[- :]/);
                        var dDate = new Date(dStringArray[0], (dStringArray[1]-1), dStringArray[2]);

                        if(currDate.valueOf() > dDate.valueOf()) {
                            // How it should look when coming to current day page and database entries don't match day
                            nextDayID = (Number(data.dayID)+1);
                            console.log(nextDayID);
                        } else {
                            //if database entry does match current day, show current day on landing page
                            nextDayID = data.dayID;
                            console.log(nextDayID);
                            $('.jumbotron').attr('hidden', true);
                            $('#displayToday').removeAttr('hidden');
                        }
                    },
                    error: function (data) {
                        alert("Can not load day.");
                    }  
            });

            //var mealCount = 1;

            /*not used because I'm dumb
            $("#add-another-meal").click(function (e) { 
                e.preventDefault();
                mealCount++;
                var mealList = document.getElementById("meal-list");
                var currentButton = document.getElementById("add-another-meal");
                var inputElement = document.createElement("input");
                inputElement.setAttribute('id', 'add-meal-food-' + mealCount);
                inputElement.setAttribute('class', 'form-control');
                inputElement.setAttribute('name', 'name');
                inputElement.setAttribute('type', 'name');
                inputElement.setAttribute('placeholder', 'Cheeseburgers w/Fries, Pizza, etc');
                mealList.insertBefore(inputElement, currentButton);
            });*/

            $("#addMealDayBtn").click(function (e) { 
                e.preventDefault();
                $('.jumbotron').attr('hidden', true);
                $('#addMealForm').removeAttr('hidden');
            });

            $("#addDay").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "php/add_mealday.php",
                    data: {
                        nextDayID: nextDayID, 
                        foodEaten: $("#add-meal-food").val(),
                        calories: $("#add-meal-calories").val(),
                        fat: $("#add-meal-fat").val(),
                        currDate: insertDate,
                        location: $("#add-meal-location").val(),
                        notes: $("#add-meal-notes").val()
                    },
                    success: function (response) {
                        $(function () {
                            console.log("Success!");
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 10000);
                    },
                    error: function(response) {
                        console.log("we failed boyz");
                        alert(response);
                    }  
                });
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

            <!-- If today isn't in database, show this-->
            <div class="jumbotron">
                <h1 class="display-4">Add today to your meal history!</h1>
                <hr class="my-4">
                <button id="addMealDayBtn" class="btn btn-primary btn-lg">Add Meals to Today</button>
            </div>

            <!-- Add Meal to Today Form -->
            <div id="addMealForm" hidden>
                <h1 class="display-3">Add a Meal to Today</h1>
                <hr class="my-4">
                <form id="addDay" action="POST" action="add_mealDay" disabled>
                    <div id="meal-list" class="form-group">
                        <h5>Food Eaten</h5>
                        <input id="add-meal-food" class="form-control" name="name" type="name" placeholder="Cheeseburgers w/Fries, Pizza, etc">
                        <!--<button id="add-another-meal" type="button" class="buttons btn btn-sm">+ Add Another Meal</button>-->
                    </div>
                    <div class="form-group">
                        <h5>Calories in Meal</h5>
                        <input name="link" id="add-meal-calories" type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <h5>Fat in Meal</h5>
                        <input name="link" id="add-meal-fat" type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <h5>Location Eaten</h5>
                        <input name="name" id="add-meal-location" type="text" class="form-control" placeholder="Write where you ate the meal.">
                    </div>
                    <div class="form-group">
                        <h5>Notes About Meal</h5>
                        <input name="name" id="add-meal-notes" type="text" class="form-control" placeholder="Write anything extra here if need be.">
                    </div>
                    <button id="add-meal-submit" type="submit" class="btn btn-lg buttons">Submit</button>
                </form>
            </div>

            <!-- Display today -->
            <div id="displayToday" class="container" hidden>
                <div class="card dayCard">
                    <div class="card-body">
                        <h3 class="card-title">Today's Food Tracker</h5>
                        <h5 id="cDayCardSubText" class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div> 

            <!-- Displaying multiple days in last 7 days tab-->
            <div id="displayWeek" class="container" hidden>
                <div class="row">
                    <div class="card dayCard">
                        <div class="card-body">
                            <h3 class="card-title">Today's Food Tracker</h5>
                            <h5 id="cDayCardSubText" class="card-subtitle mb-2 text-muted"></h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 50%;">
                        <div class="card-body">
                            <h3 class="card-title">Today's Food Tracker</h5>
                            <h5 id="cDayCardSubText" class="card-subtitle mb-2 text-muted"></h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div> 
                </div>
            </div> 

        </div>
    </div>
    <hr>

        <footer class="container footer">
            <p>&copy; Company 2017-2019</p>
        </footer>
    </main>

</body>
</html>