<?php
require_once "Main.php";

class DishService extends Main
{
    private $dashboard_categories = array();
    private $active_categories = array();
    private $dashboard_dishes = array();
    private $active_dishes = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function loadDashboardData()
    {
        $this->setDashboardCategories();
        $this->setDashboardDishes();
    }

    public function loadActiveData()
    {
        $this->setActiveCategories();
        $this->setActiveDishes();
    }

    public function showDashboardDishes()
    {
        foreach ($this->dashboard_dishes as $dish) {
            echo '
                 <div class="col-md-3" style="margin-bottom: 1em;">
                    <div class="card-sl h-100">
                    <form id="dashboard-' . $dish["dish_id"] . '-form" action="';
                    echo $this->globalpath; echo '/includes/user_favorites.inc.php"
               method="post">
                        <div class="card-image">
                            <img src="data:image/png;base64,' . base64_encode($dish["dish_image"]) . '" alt="Spaghetti">
                        </div>
                        ';
            if (isset($_SESSION["user_id"])) {
                echo '
                        <a class="card-action" type="button"
                           onclick="document.getElementById(\'dashboard-' . $dish["dish_id"] . '-form\').submit();" title="Favorite">
                            <input id="dashboard-favorite" name="dashboard-favorite" value="' . $dish["dish_id"] . '" hidden/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </a>';
            }
            echo '
                        <a class="card-action" id="order_1" type="button" title="Bestellen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                            </svg>
                        </a>
                        <div class="card-details">
                            <div class="card-heading h-100">
                                ' . $dish["dish_name"] . '
                            </div>
                            <div class="card-text-left">
                                ' . $dish["dish_portion"] . ' ' . $dish["dish_portion_unit"] . '
                            </div>
                            <div class="card-text-right">
                                ' . $dish["dish_price"] . '€
                            </div>
                        </div>
                        <a href="#" class="card-button"> weitere Details</a>
                        </form>
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

    private function editDish($dish_id, $dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_p, $dish_f, $dish_image)
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
        $sql = "SELECT `category_id`, `category_name`, `category_image` FROM `category` WHERE `category_dashboard` > 0;";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->dashboard_categories[] = $category;
        }
    }

    private function setActiveCategories()
    {
        $sql = "SELECT `category_id`, `category_name`, `category_image` FROM `category` WHERE `category_status` > 0;";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->active_categories[] = $category;
        }
    }

    private function setDashboardDishes()
    {
        $sql = "SELECT `dish_id`, `dish_name`, `dish_description`, `dish_price`, `category_id`, mt.`meat_type_icon`, co.`country_name`, `dish_portion`, `dish_portion_unit`, `dish_image`  
                FROM `dish` AS di
                JOIN country AS co USING (country_id)
                JOIN meat_type AS mt USING (meat_type_id)
                WHERE dish_dashboard > 0";
        $result = $this->loadData($sql);
        foreach ($result as $dish) {
            $this->dashboard_dishes[] = $dish;
        }
    }

    private function setActiveDishes()
    {
        $sql = "SELECT `dish_id`, `dish_name`, `dish_description`, `dish_price`, `category_id`, `meat_type_id`, co.`country_name`, `dish_ch_share`, `dish_p_share`, `dish_f_share`, `dish_image`  
                FROM `dish` AS di
                JOIN country AS co USING (country_id)
                WHERE dish_status > 0";
        $result = $this->loadData($sql);
        foreach ($result as $dish) {
            $this->active_dishes[] = $dish;
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
    public function getDashboardDishes()
    {
        return $this->dashboard_dishes;
    }

    /**
     * @return array
     */
    public function getActiveDishes()
    {
        return $this->active_dishes;
    }


}