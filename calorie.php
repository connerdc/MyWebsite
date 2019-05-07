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
            1. Remove hidden from last 7 day cards not used on button click
        */

        $(document).ready(function () {

            var d = new Date();
            var ymdDateStr = (d.getFullYear()) + "-" + (d.getMonth()+1) + "-" + d.getDate();
            var currDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
            var insertDate = (d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear());
            var americanDate = ((d.getMonth()+1) + "-" + d.getDate() + "-" + d.getFullYear());
            //below ajax call checks if current date is in the database, if it is then will display current day tab. If not I'll keep jumbotron up with current day progress.
            $.ajax({
                    type: "GET",
                    url: "php/get_dayinfo.php",
                    dataType: "json",
                    success: function (data) {
                        var dStringArray = data.dayDate.toString().split(/[- :]/);
                        var dDate = new Date(dStringArray[0], (dStringArray[1]-1), dStringArray[2]);

                        if(!(currDate.valueOf() > dDate.valueOf())) {
                            //how it displays if current day is the same as the most recent database entry
                            $('.jumbotron').attr('hidden', true);
                            $('#displayToday').removeAttr('hidden');
                            $('#todayFoodTrackTitle').text("Today\'s (" + americanDate + ") Food Tracker");

                            var caloriesOnDay = 0;

                            for(var i = 1; i<(data.mealCount+1); i++) {
                                var meal = i + "meal";
                                var newMealHTML = '<hr\><h5 class="card-text">Meal ' + i + ': </h5\><p class="card-text">Food Eaten: ' + data[meal].foodEaten + ' </p\><p class="card-text">Calories: ' + data[meal].calories + ' </p\><p class="card-text">Fat Content: ' + data[meal].fat + ' grams </p\><p class="card-text">Location: ' + data[meal].location + ' </p\><p class="card-text">Notes: ' + data[meal].notes + ' </p\>';
                                $("#currDayCardBody").append(newMealHTML);

                                caloriesOnDay += Number(data[meal].calories);
                            }
                            var caloriesHTML = '<hr><p class="card-text">Calories Eaten Today: ' + caloriesOnDay + '</p>';
                            $("#currDayCardBody").append(caloriesHTML);
                        }
                    },
                    error: function (data) {
                        alert("Can not load day.");
                        console.log(data);
                    }  
            });

            //clicking current day button in sidebar
            $("#currentDayBtn").click(function (e) { 
                e.preventDefault();
                $('.jumbotron').attr('hidden', true);
                $("#addMealForm").attr('hidden', true);
                $("#addAnotherMeal").attr('hidden', true);
                $("#displayWeek").attr('hidden', true);
                $("#last7Btn").removeAttr('disabled');
                for(var i=0; i<7; i++) {
                    $("#" + (i+1) + "dayWeekCBody").html("");
                }

                var attr = $("#displayToday").attr('hidden');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $("#displayToday").removeAttr('hidden');
                }
            });

            //clicking last 7 days button in sidebar
            $("#last7Btn").click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "php/get_mealweek.php",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        for(var i = 0; i<data.count; i++) {
                            var newDayHTML = "";
                            var titleHTML = '<h3 class="card-title">' + data[i].dayDate + '\'s Meals</h5><hr>';
                            newDayHTML += titleHTML;

                            var totalCaloriesDay = 0;

                            //this for loop adds the cards into the stack of cards showing the last 7 days of food recorded. 
                            //data[i][0][mealLength] refers to a json object passed back that goes like this Day => array of meal objects => meal object array. From there you can access various properties of that meal.
                            for(var mealLength = 0; mealLength < data[i][0].length; mealLength++) {
                                newDayHTML += '<h5 class="card-text">Meal ' + (mealLength+1) + ': </h5\><p class="card-text">Food Eaten: ' + data[i][0][mealLength].foodEaten + ' </p\><p class="card-text">Calories: ' + data[i][0][mealLength].calories + ' </p\><p class="card-text">Fat Content: ' + data[i][0][mealLength].fatContent + ' grams </p\><p class="card-text">Location: ' + data[i][0][mealLength].location + ' </p\><p class="card-text">Notes: ' + data[i][0][mealLength].notes + ' </p\>';
                                totalCaloriesDay += Number(data[i][0][mealLength].calories);
                            }

                            var caloriesHTML = '<hr><p class="card-text">Calories Eaten Today: ' + totalCaloriesDay + '</p>';
                            newDayHTML += caloriesHTML;

                            $("#" + (i+1) + "dayWeekCBody").append(newDayHTML);
                        }
                        //hide day cards if not used
                        for (var i = (7-data.count); i < 8; i++) {
                            $("#" + i + "card").attr('hidden', true);           
                        }
                    },
                    error: function (data) {
                        alert("Can not load week.");
                        console.log(data);
                    }  
                });
                $('.jumbotron').attr('hidden', true);
                $("#addMealForm").attr('hidden', true);
                $("#addAnotherMeal").attr('hidden', true);
                $("#displayToday").attr('hidden', true);
                $("#last7Btn").attr('disabled', true);
                
                var attr = $("#displayWeek").attr('hidden');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $("#displayWeek").removeAttr('hidden');
                }
            });

            /*For View Diet and View Archive
            $(selector).click(function (e) { 
                e.preventDefault();
                
            });

            $(selector).click(function (e) { 
                e.preventDefault();
                
            });*/

            $("#addMealDayBtn").click(function (e) { 
                e.preventDefault();
                $('.jumbotron').attr('hidden', true);
                $('#addMealForm').removeAttr('hidden');
            });

            $("#add-meal-to-today").click(function (e) { 
                e.preventDefault();
                $("#displayToday").attr('hidden', true);
                $('#addAnotherMeal').removeAttr('hidden');
            });

            //form submit after clicked by button on jumbotron, is slightly different than adding another meal because we also have to add the date.
            $("#addDay").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "php/add_mealday.php",
                    datatype: "html",
                    data: {
                        foodEaten: $("#add-meal-food").val(),
                        calories: $("#add-meal-calories").val(),
                        fat: $("#add-meal-fat").val(),
                        currDate: insertDate,
                        location: $("#add-meal-location").val(),
                        notes: $("#add-meal-notes").val()
                    },
                    success: function (response) {
                        $(function () {
                            console.log(response);
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    },
                    error: function(response) {
                        console.log("Could not insert meal/day.");
                        alert(response);
                    }  
                });
            });

            //form submit after clicking "add meal to today" button in current day
            $("#addAnotherMealForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "php/add_anothermeal.php",
                    datatype: "html",
                    data: {
                        foodEaten: $("#addAnr-meal-food").val(),
                        calories: $("#addAnr-meal-calories").val(),
                        fat: $("#addAnr-meal-fat").val(),
                        location: $("#addAnr-meal-location").val(),
                        notes: $("#addAnr-meal-notes").val()
                    },
                    success: function (response) {
                        $(function () {
                            console.log(response);
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    },
                    error: function(response) {
                        console.log("Could not insert meal/day.");
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
            </ul>
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
                <button id="currentDayBtn" type="button" class="list-group-item list-group-item-action">Current Day</button>
                <button id="last7Btn" type="button" class="list-group-item list-group-item-action">View Last 7 Days Recorded</button>
                <button id="viewDietBtn" type="button" class="list-group-item list-group-item-action">View Diet</button>
                <button id="viewArchiveBtn" type="button" class="list-group-item list-group-item-action" >View Archive</button>
            </div>

        </nav>
        <!-- Page Content -->
        <div id="content">

            <!-- If today isn't in database, show this-->
            <div class="jumbotron">
                <h1 class="display-4">Add today to your meal history!</h1>
                <hr class="my-4">
                <button id="addMealDayBtn" class="btn btn-primary btn-lg">Add Meals to Today</button>
            </div>

            <!-- Add First Meal to Today Form -->
            <div id="addMealForm" hidden>
                <h1 class="display-3">Add First Meal to Today</h1>
                <hr class="my-4">
                <form id="addDay" action="POST" action="add_mealDay.php">
                    <div id="meal-list" class="form-group">
                        <h5>Food Eaten</h5>
                        <input id="add-meal-food" class="form-control" name="name" type="name" placeholder="Cheeseburgers w/Fries, Pizza, etc">
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

            <!-- Add Meal to Today Form -->
            <div id="addAnotherMeal" hidden>
                <h1 class="display-3">Add Another Meal to Today</h1>
                <hr class="my-4">
                <form id="addAnotherMealForm" action="POST" action="add_anothermeal.php">
                    <div id="meal-list" class="form-group">
                        <h5>Food Eaten</h5>
                        <input id="addAnr-meal-food" class="form-control" name="name" type="name" placeholder="Cheeseburgers w/Fries, Pizza, etc">
                    </div>
                    <div class="form-group">
                        <h5>Calories in Meal</h5>
                        <input name="link" id="addAnr-meal-calories" type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <h5>Fat in Meal</h5>
                        <input name="link" id="addAnr-meal-fat" type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <h5>Location Eaten</h5>
                        <input name="name" id="addAnr-meal-location" type="text" class="form-control" placeholder="Write where you ate the meal.">
                    </div>
                    <div class="form-group">
                        <h5>Notes About Meal</h5>
                        <input name="name" id="addAnr-meal-notes" type="text" class="form-control" placeholder="Write anything extra here if need be.">
                    </div>
                    <button id="add-another-meal-submit" type="submit" class="btn btn-lg buttons">Submit</button>
                </form>
            </div>

            <!-- Display today -->
            <div id="displayToday" class="container" hidden>
                <button id="add-meal-to-today" type="button" class="btn btn-lg buttons">Add Meal to Today</button>
                <div class="card dayCard">
                    <div id="currDayCardBody" class="card-body">
                        <h3 id="todayFoodTrackTitle" class="card-title">Today's Meals</h5>
                    </div>
                </div>
            </div> 

            <!-- Displaying multiple days in last 7 days tab-->
            <div id="displayWeek" class="container" hidden>
                <h1 class="display-3">Last 7 Days</h1>
                <hr>
                <div id="7days">
                    <div id="1card" class="card dayCard">
                        <div id="1dayWeekCBody" class="card-body">
                        </div>
                    </div>
                    <div id="2card" class="card dayCard">
                        <div id="2dayWeekCBody" class="card-body">
                        </div>
                    </div> 
                    <div id="3card" class="card dayCard">
                        <div id="3dayWeekCBody" class="card-body">
                        </div>
                    </div>
                    <div id="4card" class="card dayCard">
                        <div id="4dayWeekCBody" class="card-body">
                        </div>
                    </div>
                    <div id="5card" class="card dayCard">
                        <div id="5dayWeekCBody" class="card-body">
                        </div>
                    </div>
                    <div id="6card" class="card dayCard">
                        <div id="6dayWeekCBody" class="card-body">
                        </div>
                    </div>
                    <div id="7card" class="card dayCard">
                        <div id="7dayWeekCBody" class="card-body">
                        </div>
                    </div>
                </div>
            </div> 

        </div>
    </div>
    <hr>

        <footer class="container footer">
            <p>&copy; Conner Christopherson 2019</p>
        </footer>
    </main>

</body>
</html>