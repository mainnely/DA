<?php
include('connect.php');

$id = $_GET['id'];

if(isset($_POST['btnEdit'])){
    $content = $_POST['content'];

    $editQuery = "UPDATE posts SET content='$content' WHERE postID='$id'";
    executeQuery($editQuery);

    header('Location: ./');
}

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID LEFT JOIN users ON posts.userID = users.userID WHERE postID='$id' ORDER BY dateTime DESC";
$results = executeQuery(query: $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card shadow rounded-5 p-5">
          <div class="h3 text-center">
            Edit Post
          </div>

          <?php
          if (mysqli_num_rows($results) > 0) {
            while ($post = mysqli_fetch_assoc($results)) {
              ?>

              <form method="post">
                <input value="<?php echo $post['content']?>" class="mt-3 form-control" type="text" name="content" required>
                <button class="mt-5 btn btn-primary" type="submit" name="btnEdit">
                  Save
                </button>
              </form>

              <?php
            }
          }
          ?>

        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>