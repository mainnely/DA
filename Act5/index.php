<?php
include("connect.php");

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID LEFT JOIN users ON posts.userID = users.userID";
$results = executeQuery(query: $query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echo</title>
    <link rel="icon" href="img/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid">
            <img src="img/ECHO.png" style="padding-left: 10px;" />
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 pt-3" style="border: 1px solid #6c757d;">
                <div class="row h4 text-secondary m-4 d-flex align-items-center">
                    <img src="img/home.png" style="width:48px;" /> Home
                </div>
                <div class="row h4 text-secondary m-4 d-flex align-items-center">
                    <img src="img/search.png" style="width:48px;" /> Explore
                </div>
                <div class="row h4 text-secondary m-4 d-flex align-items-center">
                    <img src="img/bell.png" style="width:48px;" /> Notifications
                </div>
                <div class="row h4 text-secondary m-4 d-flex align-items-center">
                    <img src="img/email.png" style="width:48px;" /> Messages
                </div>
            </div>


            <div class="col-9 pt-3" style="border: 1px solid #6c757d;">
                <div class="row display-6 px-3">
                    For You
                </div>
                <div class="row">
                    <div class="col-10">
                        <?php
        if (mysqli_num_rows($results) > 0) {
          while ($post = mysqli_fetch_assoc($results)) {
            ?>

                        <div class="card mx-5 my-4 p-4 rounded-3 shadow">
                            <div class="card-body">
                                <h4 class="card-user">
                                    <?php echo $post['firstName']." ".$post['lastName'] ?> • <span
                                        class="card-username text-secondary" style="font-size: 18px;">@
                                        <?php echo $post['username'] ?>
                                    </span> </h5>
                                    <h7 class="card-time text-secondary">
                                        <?php echo $post['dateTime'] ?>
                                    </h7>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?php echo $post['content'] ?>
                                </p>
                            </div>
                            <!-- <div class="card-body comsec d-flex justify-content-center" style="display: none;">
                              <h5>Hello</h5>
                            </div> -->
                            <div class="card-body d-flex justify-content-center flex-wrap">
                                <button class="btn mx-3 btn-primary">Like</button>
                                <button class="btn mx-3 btn-primary" onclick="expandContent()"
                                    id="btnExpand">Comment</button>
                                <button class="btn mx-3 btn-primary">Share</button>
                            </div>
                        </div>
                        <?php
          }
        }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="../" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 2024 ECHO, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script> 
    //   var display = "none";
    // function expandContent() {
    //   var comsec = document.getElementById("comsec");
    //   var btnExpand = document.getElementById("btnExpand");

    //   if (display == "none") {
    //     comsec.style.display = "block";
    //     display = "block";
    //     btnExpand.innerHTML = "Close";
    //   } else {
    //     comsec.style.display = "none";
    //     display = "none";
    //     btnExpand.innerHTML = "Learn more";
    //   }
    // }
    </script>
</body>

</html>