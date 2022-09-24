<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
session_start();
echo $_SESSION['order_nr'];
include('admin/config/constants.php');
$globalpath = "http://localhost:8888/projekt1";
require "views/header.view.php";


?>

<style type="text/css">

    .img-responsive{
        width: 100%;
    }
    .img-curve{
        border-radius: 15px;
    }

    .text-center{
        text-align: center;
    }

    .text-b{
        color: #ffffff;

    }

    .clearfix{
        clear: both;
        float: none;
    }


    .float-container{
        position: relative;
    }
    .float-text{
        position: absolute;
        bottom: 50px;
        left: 40%;
    }

    .error{
        padding: 2%;
        color: red;
    }

    .box-3{
        width: 28%;
        float: left;
        margin: 2%;
    }

</style>


<!-- die liste der Kategorien fängt hier an -->
<section

        class="categories">
    <div class="container-kategorie">
        <h2 class="text-center">Kategorien</h2>

        <?php

        //Display all the cateories that are active
        //Sql Query
        $sql = "SELECT * FROM category WHERE active='Ja'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //CHeck whether categories available or not
        if($count>0)
        {
            //CAtegories Available
            while($row=mysqli_fetch_assoc($res))
            {
                //Get the Values
                $id = $row['id'];
                $category_name = $row['category_name'];
                $image_name = $row['image_name'];
                ?>

                <a href="<?php echo URLRACINE; ?>food.php?category=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if($image_name=="")
                        {
                            //Image not Available
                            echo "<div class='error'>Image not found.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo URLRACINE; ?>assets/images/<?php echo $image_name; ?>" alt="FoodImage" class="img-responsive img-curve" height="300.34px">
                            <?php
                        }
                        ?>


                        <h3 class="float-text text-b"><?php echo $category_name; ?></h3>
                    </div>
                </a>

                <?php
            }
        }
        else
        {
            //Keine Kategorie verfügbar
            echo "<div class='error'>keine Kategorie verfügbar</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Die Liste der Kategorien endet hier -->


<?php require "views/footer.view.php";
?>
