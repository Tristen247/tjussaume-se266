<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/game.php';
?>
<style>
.card {
    width: 20rem; /* Set a consistent width for all cards */
    height: 30rem; /* Set a consistent height for all cards */
}

.card-img-top {
    width: 100%;
    height: 22rem; /* Set a fixed height for images */
    object-fit: center; /* Ensure images cover the entire area without distortion */
}

.card-body {
    height: 13rem; /* Adjust height to fit the remaining space in the card */
    overflow: hidden; /* Hide overflow content to ensure consistent card height */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>

        <div>
            <h1 class="page-title">Search Games</h1>
        </div>
        <?php 

            $title = '';
            $genre = '';
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST['game_title'] ?? '';
                $genre = $_POST['genre'] ?? '';

                $results = SearchGames($title, $genre);
            }

            $games = SearchGames($title, $genre);

        ?>

        <div class="container">
            
            <form method="POST" name="search_games">
                <div>
                    <div>
                        <label>Game Title:</label>
                    </div>
                    <div>
                        <input type="text" name="game_title" value="<?=$title; ?>">
                    </div>
                    <div>
                        <label>Genre:</label>
                    </div>
                    <div>
                        <input type="text" name="genre" value="<?=$genre; ?>">
                    </div>
                    <br>
                    <div>
                        <input type="submit" class="btn btn-primary" name="search" value="Search">
                    </div>
                    <br>
                </div>
            </form>
        </div>

        <a href="index.php">View All Games</a>

        <div class="row">
        <?php foreach ($games as $g): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php
                    // Convert the game title to lowercase and replace spaces with underscores
                    // Replace invalid characters for file names
                    $invalid_characters = array(" ", ":", "/", "\\", "?", "*", "<", ">", "|", "\"");
                    $game_title_for_image = strtolower(str_replace($invalid_characters, '_', $g['game_title']));
                    
                    // Set the correct image paths for both jpg and png
                    $image_path_jpg = __DIR__ . "/../images/{$game_title_for_image}.jpg";
                    $image_path_png = __DIR__ . "/../images/{$game_title_for_image}.png";
                    $relative_image_path_jpg = "../images/{$game_title_for_image}.jpg";
                    $relative_image_path_png = "../images/{$game_title_for_image}.png";
                    $default_image = "../images/default.jpg";
                    
                    // Check if the image file exists
                    if (file_exists($image_path_jpg)) {
                        $image_src = $relative_image_path_jpg;
                    } elseif (file_exists($image_path_png)) {
                        $image_src = $relative_image_path_png;
                    } else {
                        $image_src = $default_image;
                    }

                    // Debug output
                    echo "<!-- Image path JPG: $image_path_jpg -->";
                    echo "<!-- Image path PNG: $image_path_png -->";
                    echo "<!-- Image exists JPG: " . (file_exists($image_path_jpg) ? "Yes" : "No") . " -->";
                    echo "<!-- Image exists PNG: " . (file_exists($image_path_png) ? "Yes" : "No") . " -->";
                    ?>
                    <img src="<?= htmlspecialchars($image_src) ?>" class="card-img-top" alt="<?= htmlspecialchars($g['game_title']); ?> Cover Art">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="reviews.php?game_id=<?= htmlspecialchars($g['game_id']); ?>">
                                <?= htmlspecialchars($g['game_title']); ?>
                            </a>
                        </h5>
                        <p class="card-text"><strong>Genre:</strong> <?= htmlspecialchars($g['genre']); ?></p>
                        <p class="card-text"><strong>Release Date:</strong> <?= htmlspecialchars($g['release_date']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>