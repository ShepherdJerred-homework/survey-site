<?php

$hasSearched = isset($_GET['search']) && $_GET['search'] !== '';
if ($hasSearched) {
    $query = $_GET['search'];
    $results = json_decode(file_get_contents('http://www.omdbapi.com/?s=' . urlencode($query)), true);
}

$hasId = isset($_GET['id']) && $_GET['id'] !== '';
if ($hasId) {
    $id = $_GET['id'];
    $results = json_decode(file_get_contents('http://www.omdbapi.com/?i=' . urlencode($id)), true);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Movie Database</title>

    <link rel="stylesheet" href="pace.css">

    <script data-pace-options='{ "elements": { "selectors": [".selector"] }, "startOnPageLoad": false }' src="pace.min.js"></script>

    <script>
        window.onclick = function (e) {
            if (e.target.localName == 'a' || e.target.localName == 'button') {
                Pace.restart();
            }
        }
    </script>

</head>

<body>
<h1>Movie Database</h1>
<form action="moviesearch.php" method="GET">
    <input type="text" name="search" placeholder="Title">
    <button>Search</button>
</form>

<?php if ($hasSearched) { ?>
    <p>Search results for <strong><?php echo $query ?></strong>:</p>
    <ol>
        <?php
        foreach ($results["Search"] as $result)
            echo '<li><a href="moviesearch.php?id=' . $result['imdbID'] . '">' . $result['Title'] . '</a></li>';
        ?>
    </ol>
<?php } else if ($hasId) { ?>

    <?php
    echo '<h1>' . $results['Title'] . '</h1>';
    echo '<img src="' . $results['Poster'] . '">';
    echo '<br><br>' . $results['Year'] . ' - ' .
        $results['Rated'] . ' - ' . $results['Runtime'];
    echo '<br><br>IMDB Rating: <strong>' . $results['imdbRating'] . '</strong>';
    echo '<br><br>' . $results['Plot'];
    ?>

<?php } ?>

<p>App data is obtained from <a href="http://www.omdbapi.com/">OMDb API</a></p>
</body>

</html>
