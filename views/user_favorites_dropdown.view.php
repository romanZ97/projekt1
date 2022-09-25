<?php
session_start();
if(isset($_SESSION['user_id'])){
require __DIR__ . "/../src/UserService.php";
$uS = new UserService($_SESSION['user_id']);
$userFavorites = $uS->getSortedUserFavorites();
$dropdown_category = null;
?>
<?php if (count($userFavorites) < 1): ?>
    <a class="dropdown-item mt-0 px-0.5" style="animation-duration: 1000ms;">
        <span>
            Sie haben noch keinen Favoriten!
        </span>
    </a>
<?php else: ?>
    <?php foreach ($userFavorites as $favorite): ?>
        <a class="dropdown-item mt-0 px-0.5" href="#">
            <?php if ($dropdown_category != $favorite["category_id"]): ?>
                <?php $dropdown_category = $favorite["category_id"]; ?>
                <div class="dropdown-header mt-2 mb-0 p-0"><link rel="icon" type="image/png" href="<?php echo $globalpath?>/assets/icons/<?php echo $favorite["icon_name"] ?>.png"><?php echo $favorite["category_name"] ?></div>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
                <button class="dropdown-button" type="button" name="favorite-delete"
                        value="<?php echo $favorite["food_id"] ?>" style="margin-left: 5px; float: right" onclick="addFavorite(this.value,true)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                        <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                    </svg>
                </button>
                <button class="dropdown-button" id="favorite-to-order-<?php echo $favorite["food_id"] ?>" name="favorite-to-order" type="button" value="<?php echo $favorite["food_id"] ?>" style="position: relative" onclick="favoriteToOrderPosition(this.value);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-basket2-fill" viewBox="0 0 16 16">
                        <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                    </svg>
                </button>
            <span><?php echo $favorite["title"] ?></span>
        </a>
    <?php endforeach; ?>
<?php endif; ?>
<?php } ?>