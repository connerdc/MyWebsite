<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Conner's Webpage</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
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
            <h1 class="display-2">My Manga List</h1>
        </div>

        <hr>

        <div id="tableformat">
            <div class="container">
                <table class="table table-striped table-sm table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th style="width: 30%">Name</th>
                            <th style="width: 6%">Link</th>
                            <th style="width: 5%">Progress</th>
                            <th style="width: 3%">+</th>
                            <th style="width: 3%">-</th>
                            <th style="width: 5%">Score</th>
                            <th style="width: 33%">Thoughts</th>
                            <th style="width: 5%">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td><a href="#">Link</a></td>
                            <td id="specalign">78/149</td>
                            <td><button class="plusminusbtn">+</button></td>
                            <td><button class="plusminusbtn">-</button></td>
                            <td id="specalign">10</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</td>
                            <td id="editbtn"><button>Edit</button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td><a href="#">Link</a></td>
                            <td id="specalign">4/80</td>
                            <td><button class="plusminusbtn">+</button></td>
                            <td><button class="plusminusbtn">-</button></td>
                            <td id="specalign">7</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque veniam iure dolorem asperiores quasi non, dolorum deserunt sapiente expedita quisquam ducimus harum quae voluptas id, tempore nulla in praesentium quos?</td>
                            <td id="editbtn"><button>Edit</button></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td><a href="#">Link</a></td>
                            <td id="specalign">78/?</td>
                            <td><button class="plusminusbtn">+</button></td>
                            <td><button class="plusminusbtn">-</button></td>
                            <td id="specalign">6</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque veniam iure dolorem asperiores quasi non?</td>
                            <td id="editbtn"><button>Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <hr>

    <footer class="container">
        <p>&copy; Company 2017-2019</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>