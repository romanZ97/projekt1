<?php
require_once "Main.php";

class FoodService extends Main
{
    private $dashboard_categories = array();
    private $active_categories = array();
    private $dashboard_food = array();
    private $active_food = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function loadDashboardData()
    {
        $this->setDashboardCategories();
        $this->setDashboardFood();
    }

    public function loadActiveData()
    {
        $this->setActiveCategories();
        $this->setActiveFood();
    }

    public function showDashboardFood()
    {
        foreach ($this->dashboard_food as $food) {
            echo '
                 <div class="col-md-3" style="margin-bottom: 1em;">
                    <div class="card-sl h-100">                
                        <div class="card-image">
                            <img src="' . $this->globalpath . '/assets/images/' . $food["image_name"] . '" alt="Spaghetti">
                        </div>
                        ';
            if (isset($_SESSION["user_id"])) {
                echo '
                        <form id="dashboard-' . $food["id"] . '-favorite" action="' . $this->globalpath . '/includes/user_actions.inc.php"
                       method="post">
                            <a class="card-action" id="dashboard_favorite_' . $food["id"] . '" type="button"
                               onclick="document.getElementById(\'dashboard-' . $food["id"] . '-favorite\').submit();" title="Favorite">
                                <input name="dashboard-favorite-add" value="' . $food["id"] . '" hidden/>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </a>
                        </form>';
            }
            echo '
                        <form id="dashboard-' . $food["id"] . '-order" action="' . $this->globalpath . '/includes/user_actions.inc.php"
                                   method="post">
                            <a class="card-action" id="d_order_p_' . $food["id"] . '" type="button" 
                            onclick="document.getElementById(\'dashboard-' . $food["id"] . '-order\').submit();"title="Bestellen">
                            <input name="dashboard-order-position-add" value="' . $food["id"] . '" hidden/>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </a>
                        </form>
                        <div class="card-details">
                            <div class="card-heading h-100">
                                ' . $food["title"] . '
                            </div>
                            <div class="card-text-left">
                                ' . $food["food_portion"] . ' ' . $food["food_portion_unit"] . '
                            </div>
                            <div class="card-text-right">
                                ' . $food["price"] . '€
                            </div>
                        </div>
                        <a href="#" class="card-button"> weitere Details</a>
                    </div>
                </div>
               
                ';
        }
    }

    private function editCategory($category_id, $category_name, $category_image, $category_status, $category_dashboard)
    {
        $sql = "UPDATE `category` SET 
                      `category_name`= ?,
                      `category_image`= ?,
                      `category_status`= ?,
                      `category_dashboard`= ?
                WHERE `category_id` = ?;";
        $this->executeQuery($sql, "ssssi", array($category_name, $category_image, $category_status, $category_dashboard, $category_id));
    }

    private function editFood($dish_id, $dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_p, $dish_f, $dish_image)
    {
        $sql = "UPDATE `dish` SET 
                  `dish_name`= ?,
                  `dish_description`= ?,
                  `dish_price`= ?,
                  `dish_status`= ?, 
                  `dish_dashboard`= ?,
                  `category_id`= ?,
                  `meat_type_id`= ?,
                  `country_id`= ?,
                  `dish_calories`= ?,
                  `dish_ch_share`= ?,
                  `dish_p_share`= ?,
                  `dish_f_share`= ?,
                  `dish_image`= ? 
                WHERE `dish_id` = ?;";
        $this->executeQuery($sql, "ssfssiiiifffsi", array($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_p, $dish_f, $dish_image, $dish_id));
    }

    private function insertCategory($category_name, $category_image, $category_status, $category_dashboard)
    {
        $sql = "INSERT INTO `category`(`category_name`, `category_image`, `category_status`, `category_dashboard`) 
                VALUES (?,?,?,?);";
        $this->executeQuery($sql, "ssss", array($category_name, $category_image, $category_status, $category_dashboard));
    }

    private function insertDish($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_p, $dish_f, $dish_image)
    {
        $sql = "INSERT INTO `dish`(`dish_name`, `dish_description`, `dish_price`, `dish_status`, `dish_dashboard`, `category_id`, `meat_type_id`, `country_id`, `dish_calories`, `dish_ch_share`, `dish_p_share`, `dish_f_share`, `dish_image`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $this->executeQuery($sql, "ssfssiiiifffs", array($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_p, $dish_f, $dish_image));
    }

    private function setDashboardCategories()
    {
        $sql = "SELECT `id`, `category_name`, `image_name`, `icon_name` FROM `category` WHERE `featured` LIKE \"ja\";";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->dashboard_categories[] = $category;
        }
    }

    private function setActiveCategories()
    {
        $sql = "SELECT `id`, `category_name`, `image_name`, `icon_name` FROM `category` WHERE `active` LIKE \"ja\";";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->active_categories[] = $category;
        }
    }

    private function setDashboardFood()
    {
        $sql = "SELECT 
                    f.`id`, 
                    f.`title`, 
                    f.`description`, 
                    f.`price`, 
                    f.`image_name`, 
                    f.`food_portion`, 
                    f.`food_portion_unit`, 
                    c.`category_name`,
                    c.`icon_name`,
                    mt.`icon_name`, 
                    co.`country_name`, 
                    co.`country_short_name`  
                FROM `food` AS f
                JOIN category AS c ON c.id = f.category_id 
                JOIN country AS co ON co.id = f.country_id
                JOIN meat_type AS mt ON mt.id = f.meat_type_id
                WHERE f.featured LIKE \"ja\"";
        $result = $this->loadData($sql);
        foreach ($result as $food) {
            $this->dashboard_food[$food['id']] = $food;
        }
    }

    private function setActiveFood()
    {
        $sql = "SELECT 
                    f.`id`, 
                    f.`title`, 
                    f.`description`, 
                    f.`price`, 
                    f.`image_name`, 
                    f.`food_portion`, 
                    f.`food_portion_unit`, 
                    c.`category_name`,
                    c.`icon_name`,
                    mt.`icon_name`, 
                    co.`country_name`, 
                    co.`country_short_name`  
                FROM `food` AS f
                JOIN category AS c ON c.id = f.category_id 
                JOIN country AS co ON co.id = f.country_id
                JOIN meat_type AS mt ON mt.id = f.meat_type_id
                WHERE f.active LIKE \"ja\"";
        $result = $this->loadData($sql);
        foreach ($result as $food) {
            $this->active_food[$food['id']] = $food;
        }
    }

    /**
     * @return array
     */
    public function getDashboardCategories()
    {
        return $this->dashboard_categories;
    }

    /**
     * @return array
     */
    public function getActiveCategories()
    {
        return $this->active_categories;
    }

    /**
     * @return array
     */
    public function getDashboardFood()
    {
        return $this->dashboard_food;
    }

    /**
     * @return array
     */
    public function getActiveFood()
    {
        return $this->active_food;
    }


}