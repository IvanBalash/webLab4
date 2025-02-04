﻿<?php session_start(); ?>

<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles/Header_style.css" >
    <link rel="stylesheet" href="styles/Main_style.css" >
    <link rel="stylesheet" href="styles/Footer_style.css" >
    <title>Shop</title>
</head>
<body>
    <div id="frame">
        <header>
            <?php require_once('header.php')?>
        </header>
        <main>
            <div id="ad">
                <button class="ad-button" id="previous"><img src="images/image 3.png"  alt="nothing"/></button>
                <button class="ad-button" id="next"><img src="images/image 2.png" alt="nothing"/></button>
            </div>
            <div id="shop"><a id="catalog"></a>
                <div id="settings">
                    <div class="settings-block">
                        <h2>каегории</h2>
                        <ul>
                            <li><button class="settings-button">категория 1</button></li>
                            <li><button class="settings-button">категория 2</button></li>
                            <li><button class="settings-button">категория 3</button></li>
                            <li><button class="settings-button">категория 4</button></li>
                        </ul>
                    </div>
                    <div class="settings-block">
                        <h2>фильтер</h2>
                        <div id="price-filter-block">
                            <p>цена от</p>
                            <label for="min-price"></label>
                                <input type="number" name="min-price" class="price-filter-input" />

                            <p>до</p>
                            <label for="max-price"></label>
                                <input type="number" name="max-price" class="price-filter-input" />

                        </div>
                        <ul>
                            <li><button class="settings-button">бренд</button></li>
                            <li><button class="settings-button">цвет</button></li>
                            <li><button class="settings-button">материал</button></li>
                            <li><button class="settings-button">другое</button></li>
                        </ul>
                    </div>


                        <?php
                        if(isset($_SESSION['auth'])) {

                            if ($_SESSION['access'] == 1) {
                                $url = getUrl('newProduct');
                                echo '<div class=' . "settings-block" . '>';
                                echo "<a href='" . $url . "'>создать новый продукт</a>";
                                echo "</div>";
                            }
                        }
                        ?>


                </div>
                <div id="goods">
                    <ul>
                        <?php
                            $db = new DBmanager();
                            $db->conect();
                            $query ="SELECT * FROM products";
                            $result = $db->query($query);
                            foreach ($result as $row){
                                $id = $row['id'];
                            ?>

                                <li><a id="<?= $id?>"></a>
                                    <div>

                                        <img src="images/images.jpg" alt="nothing">
                                        <p><?= $row['NAME']?></p>
                                        <p><?= $row['price']?></p>
                                        <form action="utils/add_to_cart.php" method="POST">
                                            <button value="<?= $id?>" name="cart" class="buy-button">в корзину</button>
                                        </form>
                                        <form action="utils/add_to_liked.php" method="POST">
                                            <button value="<?= $id?>" name="like" class="buy-button del">like</button>
                                        </form>
                                        <?php
                                            if(isset($_SESSION['auth'])) {
                                                if ($_SESSION['access'] == 1) {
                                                    $url = getUrl('changeProduct');
                                                    echo "<form action=" . "utils/go_to_change_product.php" . " method='GET'>";
                                                    echo "<button value='$id' name='chn' class='" ."buy-button del"."' >изменить</button>";
                                                    echo "</form>";
                                                    echo "<form action=" . "utils/delete_product.php" . " method='POST'>";
                                                    echo "<button value='$id' name='del' class='" ."buy-button del"."' >удалить</button>";
                                                    echo "</form>";
                                                }
                                            }
                                        ?>

                                    </div>
                                </li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
        </main>
        <footer>
            <div id="delivery"><a id="deliv"></a>
                <h1>Способы доставки</h1>
                <div class="delivery-method">
                    <h2>Самовывоз</h2>
                    <p>
                        Вы можете забрать самостоятельно из наших магазинов по адресу:
                        г. Санкт-Петербург, ул. Стремянная, д 13
                        г. Санкт-Петербург, пр. Энгельса, д 96
                        в любое удобное для Вас время.
                    </p>
                    <p>
                        Предварительно необходимо оформить заказ на сайте или по телефону
                    </p>
                </div>
                <div class="delivery-method">
                    <h2>Доставка курьером</h2>
                    <p>
                        Наши курьеры доставят выбранный вами товар до двери. Совершая заказ на сайте
                        по телефону укажите данный способ доставки и выберите нужное вам время.
                    </p>
                    <p>
                        Внимание! Заказ долже быть совершен не позднее, чем за 24 часа до выбранного времени доставки
                    </p>
                </div>
            </div>

            <?php require_once('footer.php')?>
        </footer>
    </div>
</body>
</html>
