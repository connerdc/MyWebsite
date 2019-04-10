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
    <link rel="stylesheet" href="css/manga.css">

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            
            $(".plusbutton").click(function (event) { 
                event.preventDefault();
                var buttonName = this.id;
                var parse = buttonName.split("");
                var number = parse[0];
                var mangaID = parseInt(number);
                $.ajax({
                    type: "POST",
                    url: "php/add_episode.php",
                    data: {
                        mangaID: mangaID
                    },
                    success: function (response ) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 100); 
                    },
                    error: function (response) {
                        alert(response);
                    }                    
                });
            });

            $(".editbutton").click(function (event) { 
                event.preventDefault();
                
            });

            $("#editform").submit(function (event) {
                event.preventDefault();    
                $.ajax({
                    type: "POST",
                    url: "php/edit_manga.php",
                    data: {
                        name: $("#manga-name").val(),
                        link: $("#manga-link").val(),
                        completedCptr: $("#manga-completed").val(),
                        totalCptr: $("#manga-total").val(),
                        score: $("#manga-score").val(),
                        thoughts: $("#manga-thoughts").val()
                    },
                    success: function (response) {
                        $(function () {
                            $('#modal').modal('toggle');
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 100);
                    },
                    error: function(response) {
                        alert(response);
                    }  
                });
            });

            $("#addform").submit(function (event) {
                event.preventDefault();    
                $.ajax({
                    type: "POST",
                    url: "php/add_manga.php",
                    data: {
                        name: $("#manga-name").val(),
                        link: $("#manga-link").val(),
                        completedCptr: $("#manga-completed").val(),
                        totalCptr: $("#manga-total").val(),
                        score: $("#manga-score").val(),
                        thoughts: $("#manga-thoughts").val()
                    },
                    success: function (response) {
                        $(function () {
                            $('#modal').modal('toggle');
                        });
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 100);
                    },
                    error: function(response) {
                        alert(response);
                    }  
                });
            });
            /*
            $("form").submit(function (event) { 
                event.preventDefault();

                var name = $("#manga-name").val();
                var link = $("#manga-link").val();
                var completedCptr = $("#manga-completed").val();
                var totalCptr = $("#manga-total").val();
                var score = $("#manga-score").val();
                var thoughts = $("#manga-thoughts").val();
                var submit = $("#manga-submit").val();

                $.post("php/add_manga.php", {
                    name: name,
                    link: link,
                    completedCptr: completedCptr,
                    totalCptr: totalCptr,
                    score: score,
                    thoughts: thoughts,
                    submit: submit 
                });
            });*/
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
                <li class="nav-item active">
                    <a class="nav-link" href="manga.php">Manga <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calorie.php">Calorie Counter</a>
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
        <div id="mangahd" class="container">
            <h1 id="specialHeader" class="display-2">My Manga List</h1>
        </div>

        <hr class="listhr">

        <div id="contentformat">
            <div class="container">
                <button type="button" id="newMangaBtn" class="btn btn-dark" data-toggle="modal" data-target=".newmanga">Add Manga</button>

                <div id="modal" class="modal fade newmanga" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Add Manga</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editform" method="post" action="php/add_manga.php">
                                    <div class="form-group">
                                        <label>Manga Name</label>
                                        <input name="name" id="manga-name" type="name" class="form-control" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label>Link to Manga</label>
                                        <input name="link" id="manga-link" type="link" class="form-control" placeholder="Link">
                                    </div>
                                    <label>Chapters Read/Total Chapters</label>
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <input name="completedCptr" id="manga-completed" type="number" class="form-control" placeholder="0">
                                        </div>
                                        <p>/</p>
                                        <div class="col-2">
                                            <input name="totalCptr" id="manga-total" type="number" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Score</label>
                                            <select name="score" id="manga-score" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="10">10 (Masterpiece)</option>
                                                <option value="9">9 (Amazing)</option>
                                                <option value="8">8 (Great)</option>
                                                <option value="7">7 (Good)</option>
                                                <option value="6">6 (Decent)</option>
                                                <option value="5">5 (Tolerable)</option>
                                                <option value="4">4 (Dislike)</option>
                                                <option value="3">3 (Bad)</option>
                                                <option value="2">2 (Awful)</option>
                                                <option value="1">1 (Dumpster Fire)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thoughts</label>
                                        <textarea name="thoughts" id="manga-thoughts" class="form-control" rows="5" id="comment"></textarea>
                                    </div>
                                    <hr>
                                    <button id="manga-submit" type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal" class="modal fade editmanga" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Edit Manga</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addform" method="post" action="php/edit_manga.php">
                                    <div class="form-group">
                                        <label>Manga Name</label>
                                        <input name="name" id="manga-name" type="name" class="form-control" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label>Link to Manga</label>
                                        <input name="link" id="manga-link" type="link" class="form-control" placeholder="Link">
                                    </div>
                                    <label>Chapters Read/Total Chapters</label>
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <input name="completedCptr" id="manga-completed" type="number" class="form-control" placeholder="0">
                                        </div>
                                        <p>/</p>
                                        <div class="col-2">
                                            <input name="totalCptr" id="manga-total" type="number" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Score</label>
                                            <select name="score" id="manga-score" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="10">10 (Masterpiece)</option>
                                                <option value="9">9 (Amazing)</option>
                                                <option value="8">8 (Great)</option>
                                                <option value="7">7 (Good)</option>
                                                <option value="6">6 (Decent)</option>
                                                <option value="5">5 (Tolerable)</option>
                                                <option value="4">4 (Dislike)</option>
                                                <option value="3">3 (Bad)</option>
                                                <option value="2">2 (Awful)</option>
                                                <option value="1">1 (Dumpster Fire)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thoughts</label>
                                        <textarea name="thoughts" id="manga-thoughts" class="form-control" rows="5" id="comment"></textarea>
                                    </div>
                                    <hr>
                                    <button id="manga-submit" type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table table-striped table-sm table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 35%">Name</th>
                            <th style="width: 3%">Link</th>
                            <th style="width: 5%">Progress</th>
                            <th style="width: 3%">+</th>
                            <th style="width: 4%">Score</th>
                            <th style="width: 40%">Thoughts</th>
                            <th style="width: 5%">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM manga";
                            $result = mysqli_query($conn, $sql);
                            $number = 1;

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><th id=\"specalign\" class=\"tableopacity\" scope=\"row\">" . $row["mangaID"] . "</th>
                                    <td class=\"tableopacity\">" . $row["name"]. "</td>
                                    <td id=\"specalign\" class=\"tableopacity\"><a href=\"" . $row["link"] . "\">Link</a></td>
                                    <td id=\"specalign\" class=\"tableopacity\">" . $row["completedCptr"] . "/" . $row["totalCptr"] . "</td>
                                    <td class=\"pluscol tableopacity\"><button id=\"" . $number . "button\" class=\"btn plusbutton tableopacity\">+</button> </td>
                                    <td id=\"specalign\" class=\"tableopacity\">" . $row["score"]. "</td>
                                    <td class=\"tableopacity\">" . $row["thoughts"]. "</td>
                                    <td id=\"" . $number . "edit\" class=\"tableopacity editbtn\"><button class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\".editmanga\">Edit</button>
                                    </tr>";

                                    $number = $number + 1;
                                }
                            }
                        ?>
                        <!-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td><a href="#">Link</a></td>
                            <td id="specalign">78/149</td>
                            <td><button class="plusminusbtn">+</button></td>
                            <td><button class="plusminusbtn">-</button></td>
                            <td id="specalign">10</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</td>
                            <td id="editbtn"><button>Edit</button></td> 
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <hr class="listhr">

    <footer class="container footer">
        <p>&copy; Company 2017-2019</p>
    </footer>
</body>
</html>