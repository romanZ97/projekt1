<?php
class DishService extends Main
{
    private $dashboard_categories = array();
    private $active_categories = array();
    private $dashboard_dishes = array();
    private $active_dishes = array();



    private function loadPageData(){
        $this->setDashboardCategories();
        $this->setDashboardDishes();
        $this->setActiveCategories();
        $this->setActiveDishes();
    }

    private function editCategory($category_id, $category_name, $category_image, $category_status, $category_dashboard){
        $sql = "UPDATE `category` SET 
                      `category_name`= ?,
                      `category_image`= ?,
                      `category_status`= ?,
                      `category_dashboard`= ?
                WHERE `category_id` = ?;";
        $this->insertData($sql,"ssssi", array($category_name, $category_image, $category_status, $category_dashboard, $category_id));
    }
    private function editDish($dish_id, $dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_f, $dish_f, $dish_image){
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
        $this->insertData($sql,"ssfssiiiifffsi", array($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_f, $dish_f, $dish_image, $dish_id));
    }

    private function insertCategory($category_name, $category_image, $category_status, $category_dashboard){
        $sql = "INSERT INTO `category`(`category_name`, `category_image`, `category_status`, `category_dashboard`) 
                VALUES (?,?,?,?);";
        $this->insertData($sql,"ssss", array($category_name, $category_image, $category_status, $category_dashboard));
    }
    private function insertDish($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_f, $dish_f, $dish_image){
        $sql = "INSERT INTO `dish`(`dish_name`, `dish_description`, `dish_price`, `dish_status`, `dish_dashboard`, `category_id`, `meat_type_id`, `country_id`, `dish_calories`, `dish_ch_share`, `dish_p_share`, `dish_f_share`, `dish_image`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $this->insertData($sql,"ssfssiiiifffs", array($dish_name, $dish_description, $dish_price, $dish_status, $dish_dashboard, $dish_category_id, $meat_type_id, $country_id, $dish_calories, $dish_ch, $dish_f, $dish_f, $dish_image));
    }

    private function setDashboardCategories(){
        $sql = "SELECT `category_id`, `category_name`, `category_image` FROM `category` WHERE `category_dashboard` > 0;";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->dashboard_categories[] = $category;
        }
    }

    private function setActiveCategories(){
        $sql = "SELECT `category_id`, `category_name`, `category_image` FROM `category` WHERE `category_status` > 0;";
        $result = $this->loadData($sql);
        foreach ($result as $category) {
            $this->active_categories[] = $category;
        }
    }

    private function setDashboardDishes(){
        $sql = "SELECT `dish_id`, `dish_name`, `dish_description`, `dish_price`, `category_id`, `meat_type_id`, co.country_name, `dish_ch_share`, `dish_p_share`, `dish_f_share`, `dish_image`  
                FROM `dish` AS di
                JOIN country AS co USING (country_id)
                WHERE dish_dashboard > 0";
        $result = $this->loadData($sql);
        foreach ($result as $dish) {
            $this->dashboard_dishes[] = $dish;
        }
    }

    private function setActiveDishes(){
        $sql = "SELECT `dish_id`, `dish_name`, `dish_description`, `dish_price`, `category_id`, `meat_type_id`, co.country_name, `dish_ch_share`, `dish_p_share`, `dish_f_share`, `dish_image`  
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