                <?php include __DIR__ . '/../templates/header.php';

                session_start();
                if (!isset($_SESSION['user'])) {
                    header('Location: login.php');
                    exit();
                }
                ?>



                <div>
                    <br>
                    <h1 class="page-title">All Reviews</h1>
                    <br>
                </div>
                <div>
                    <a href="add_review.php">Add Review</a>
                    <a href="search.php">Search Game</a>
                </div>
                <?php
                   
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Game </th>
                            <th>Rating</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pa as $p): ?>
                            <tr>
                                <td>
                                    <?= $p['']; ?>
                                </td>
                                <td>
                                    <?= $p['']; ?> 
                                </td>
                                <td>
                                    <?= $p['']; ?> 
                                </td>
                                <td>
                                    <a href="edit_review.php?action=Update&reviewId=<?= $p['id']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
            </main>




<?php include __DIR__ . '/../templates/footer.php'; ?>





