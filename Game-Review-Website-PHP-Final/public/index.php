<?php
include __DIR__ . '/../templates/header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include __DIR__ . '/../models/game.php';
$games = GetGames();
?>

<style>
.card {
    width: 20rem; /* Set a consistent width for all cards */
    height: 30rem; /* Set a consistent height for all cards */
}

.card-img-top {
    width: 100%;
    height: 19rem; /* Set a fixed height for images */
    object-fit:fill; /* Ensure images cover the entire area without distortion */
}

.card-body {
    height: 8rem; /* Adjust height to fit the remaining space in the card */
    overflow: hidden; /* Hide overflow content to ensure consistent card height */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.carousel-item img {
    height:fit-content; /* Set a fixed height for carousel images */
    object-fit: cover; /* Ensure images cover the entire area without distortion */
}
</style>

<div class="container">
    <br>
    <h1 class="page-title">Games</h1>
    <br>
    <!-- Carousel -->
    <div id="gameBannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $upcoming_games = array_slice($games, 0, 5); // Assuming first 5 games are upcoming, adjust as needed
            foreach ($upcoming_games as $index => $g): ?>
                <?php
                // Convert the game title to lowercase and replace spaces with underscores
                // Replace invalid characters for file names (e.g., colons)
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

                // Set active class for the first carousel item
                $active_class = ($index === 0) ? 'active' : '';
                ?>
                <div class="carousel-item <?= $active_class ?>">
                    <img src="<?= htmlspecialchars($image_src) ?>" class="d-block w-100" alt="<?= htmlspecialchars($g['game_title']); ?> Cover Art">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= htmlspecialchars($g['game_title']); ?></h5>
                        <p><?= htmlspecialchars($g['genre']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#gameBannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#gameBannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Carousel -->

    <br>
    <div class="d-flex justify-content-end mb-3">
        <a href="add_review.php" class="btn btn-primary me-2">Add Review</a>
        <a href="search.php" class="btn btn-secondary">Search Game</a>
    </div>
    <div class="row">
        <?php foreach ($games as $g): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php
                    // Convert the game title to lowercase and replace spaces with underscores
                    // Replace invalid characters for file names (e.g., colons)
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
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
