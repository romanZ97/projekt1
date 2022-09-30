<?php
require_once "Main.php";

/**
 * Klasse FoodService
 * Autor: Roman Zhuravel
 *
 * -Sammlung der Funktionen für Aufladen von angelegten Speisen Daten
 *
 */
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

    public function showFoodToSelect(){
        foreach ($this->active_categories as $category){
            echo '
            <optgroup label="'. $category["category_name"] . '">';

            $food_array = $this->getFootByCategory($category["id"]);
            foreach ($food_array as $food) {
                echo '
                <option id="select-foot-' . $food["id"] . '" value="' . $food["id"] . '">' . $food["title"] . '</option>';
            }
        }
    }

    /**
     * Baut einem HTML-Gerüst für jeweilige Kategorie mit dazugehörenden aktiven Speisen als Karten mit entsprechenden Buttons und Modalfenster und gibt das aus.
     *
     * @return void
     */
    public function showActiveFood(){
        foreach ($this->active_categories as $category){
            echo '
    <h2 id="container_category_'. $category["id"] . '" class="ueberschrift fw-light text-center text-lg-start mt-4 mb-0" style="font-weight: bold">'. $category["category_name"] . '</h2>
    <hr class="mt-2 mb-5">
    <div class="container" >
        <div class="row ">';

            $food_array = $this->getFootByCategory($category["id"]);

            foreach ($food_array as $food) {
                echo '
                 <div class="col-md-4" style="margin-bottom: 1em;">
                    <div class="card-sl h-100">
                        <div class="card-image">
                            <img src="' . $this->globalpath . '/assets/images/' . $food["image_name"] . '" style="height: 250px; width: 100%">
                        </div>
                        
                        ';
                if (isset($_SESSION["user_id"])) {
                    echo '
                            <a class="card-action" id="favorite_' . $food["id"] . '" type="button"
                               onclick="addFavorite(\'' . $food["id"] . '\')" title="Favorite">
                                <input name="favorite-add" value="' . $food["id"] . '" hidden/>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </a>';
                }
                echo '
                            <a class="card-action" id="order_position_' . $food["id"] . '" type="button" 
                            onclick="add(\'' . $food["id"] . '\')"title="Bestellen">
                            <input name="position-add" value="' . $food["id"] . '" hidden/>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </a>
                        
                        <div id="food-' . $food["id"] . '" class="card-details">
                            <div id="title-' . $food["id"] . '" class="card-heading h-100">
                                ' . $food["title"] . '
                            </div>
                            <div id="icon-' . $food["id"] . '" class="card-icon">
                                    <img src="'. $this->globalpath . '/assets/icons/' . $food["icon_name"] .'.png">
                             </div>
                            <div id="portion-' . $food["id"] . '" class="card-text-left">
                                ' . $food["food_portion"] . ' ' . $food["food_portion_unit"] . '
                            </div>
                            <div id="price-' . $food["id"] . '" class="card-text-right">
                                ' . $food["price"] . '€
                            </div>
                        </div>
                        <a class="card-button" role="button" type="button" onclick="showFoodModal(' . $food["id"] . ')"> weitere Details</a>
                    </div>
                </div>
               <!-- Modal -->
                <div class="modal fade" id="food-modal-' . $food["id"] . '" tabindex="-1" role="dialog" aria-labelledby="modal-' . $food["id"] . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-' . $food["id"] . '">' . $food["title"] . '</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';

                if($food["description"]) {
                    echo '
                            <div class="modal-body food-details" >
                                ' . $food["description"] . '
                             </div>';
                }
                echo '
                            <div class="modal-footer">
                                <div id="text-left">
                                   Eine Portion: ' . $food["food_portion"] . ' ' . $food["food_portion_unit"] . '
                                </div>
                                <div id="text-right">
                                    Preis: ' . $food["price"] . '€
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            echo '
        </div>
    </div>';
        }
    }

    /**
     * Baut einem HTML-Gerüst für jeweilige Kategorie als Karussell Element und gibt das aus.
     *
     * @return void
     */
    public function showDashboardCategories()
    {
        $first = true;
        $count = 1;
        foreach ($this->dashboard_categories as $category){

            if($first){
                echo '
        <div class="carousel-item active">
            <div class="cards-wrapper">';
                $first = false;
            }elseif ($count == 4){
                echo '<div class="carousel-item">
                        <div class="cards-wrapper">';
            }

            echo '
                    <a href="' . $this->globalpath . '/food.php?category=' . $category["id"] . '">
                        <div class="card">
                            <img src="' . $this->globalpath . '/assets/images/' . $category["image_name"] . '" class="card-img-top" alt="' . $category["category_name"] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $category["category_name"] . '</h5>
                            </div>
                        </div>
                    </a>';

            if ($count == 3 OR $count == 5) {
                echo '
                   </div>
              </div>';
            }
            $count++;
        }
    }

    /**
     * Baut einem HTML-Gerüst für jeweilige aktive, hervorgehobene Speise als eine Karte mit jeweiligen Buttons und angebundenen Modalfenster und gibt das aus.
     *
     * @return void
     */
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
                        <a class="card-action" id="favorite_' . $food["id"] . '" type="button"
                           onclick="addFavorite(\'' . $food["id"] . '\')" title="Favorite">
                            <input name="favorite-add" value="' . $food["id"] . '" hidden/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </a>';
            }
            echo '
                        <a class="card-action" id="order_position_' . $food["id"] . '" type="button" 
                        onclick="add(\'' . $food["id"] . '\')"title="Bestellen">
                        <input name="order-position-add" value="' . $food["id"] . '" hidden/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                            </svg>
                        </a>
                        
                        <div id="food-' . $food["id"] . '" class="card-details">
                            <div id="title-' . $food["id"] . '" class="card-heading h-100">
                                ' . $food["title"] . ' 
                            </div>
                            <div id="icon-' . $food["id"] . '" class="card-icon">
                                    <img src="'. $this->globalpath . '/assets/icons/' . $food["icon_name"] .'.png">
                             </div>
                            <div id="portion-' . $food["id"] . '" class="card-text-left">
                                ' . $food["food_portion"] . ' ' . $food["food_portion_unit"] . '
                            </div>
                            <div id="price-' . $food["id"] . '" class="card-text-right">
                                ' . $food["price"] . '€
                            </div>
                        </div>
                        <a class="card-button" role="button" type="button" tabindex="1" onclick="showFoodModal(' . $food["id"] . ')"> weitere Details</a>
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="food-modal-' . $food["id"] . '" tabindex="-1" role="dialog" aria-labelledby="modal-' . $food["id"] . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-' . $food["id"] . '">' . $food["title"] . '</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';

            if($food["description"]) {
                echo '
                            <div class="modal-body food-details" >
                                ' . $food["description"] . '
                             </div>';
            }
            echo '
                            <div class="modal-footer">
                                <div id="text-left">
                                   Eine Portion: ' . $food["food_portion"] . ' ' . $food["food_portion_unit"] . '
                                </div>
                                <div id="text-right">
                                    Preis: ' . $food["price"] . '€
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        }
    }

    public function getFoodById($food_id, $path)
    {
        $sql = "SELECT 
                    `id`, 
                    `title`,  
                    `price`,
                    `food_portion`,
                    `food_portion_unit`
                FROM `food`
                WHERE id = ?
                AND featured LIKE ?";
        return json_encode(mysqli_fetch_array($this->loadDataWithParameters($sql,"is",array($food_id,"ja"), $path)));
    }

    private function setDashboardCategories()
    {
        $sql = "SELECT `id`, `category_name`, `image_name`, `icon_name` FROM `category` WHERE `featured` LIKE \"ja\";";
        $result = $this->loadData($sql, "index");
        foreach ($result as $category) {
            $this->dashboard_categories[] = $category;
        }
    }

    private function setActiveCategories()
    {
        $sql = "SELECT `id`, `category_name`, `image_name`, `icon_name` FROM `category` WHERE `active` LIKE \"ja\";";
        $result = $this->loadData($sql, "index");
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
        $result = $this->loadData($sql, "index");
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
                    f.`category_id`,
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
        $result = $this->loadData($sql, "index");
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

    private function getCategoryName($id){
        return $this->active_categories[array_search($id,array_column($this->active_categories,"id"))]["name"];
    }

    private function getCategoryFoods($id){
        return array_filter($this->active_food, function ($v,$k,$id){
            return $k == "category_id" || $v = $id;
        });
    }

    public function getFootByCategory($category_id){
        $food_array = array_filter($this->active_food, function ($value) use ($category_id){
            return ($value["category_id"] == $category_id);
        });
        return $food_array;
    }
}