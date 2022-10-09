<?
    require_once "core/connect.php";
    //unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/maskedinput/dist/jquery.maskedinput.min.js"></script>
    <script src="src/js/script.js"></script>
    <link rel="stylesheet" href="src/css/style.css">
    <title>Мокрый Хвост</title>
</head>
<body>
    <header>
        <div class="logo__outer">
            <img src="src/img/logo.png" alt="">
        </div>
        <nav>
            <div class="menu__link">
                <a href="#pop" class="menu__link__inner">
                    Популярное
                </a>
            </div>
            <div class="menu__link">
                <a href="#catalog" class="menu__link__inner">
                    Каталог
                </a>
            </div>
            <div class="menu__link">
                <a href="#terms" class="menu__link__inner">
                    Условия
                </a>
            </div>
            <div class="menu__link">
                <a href="#about" class="menu__link__inner">
                    О нас
                </a>
            </div>
            <div class="menu__link">
                <a href="#" id="profile" class="menu__link__inner">
                    Профиль
                </a>
            </div>
        </nav>
    </header>
    <div class="header__under__banner">
        <div class="under__banner">
            <div class="banner__inner">
                <div class="banner__inner__inner">
                    <strong>
                        Магазин товаров для животных
                    </strong>
                    <br>
                    <span class="banner__strong__under">
                        от ведущих производителей
                    </span>
                    <br>
                    <span class="banner__description">
                        Скидка на товары для ухода - 50% до конца декабря - успейте заказать выгодно!
                    </span>
                    <button class="banner__button" id="get_promocode">Получить промокод на скидку</button>
                </div>
            </div>
        </div>
    </div>
    <section>
        <h1 class="section__header" id="about">Почему нам можно доверять</h1>
        <div class="wearegood">
            <div class="wearegood__item">
                <img src="src/img/weare/adding-machine.svg" alt="">
                <h3>Весь товар сертифицирован</h3>
                <p>И вы можете проверить это, посетив наш магазин!</p>
            </div>
            <div class="wearegood__item">
                <img src="src/img/weare/copier.svg" alt="">
                <h3>Тысячи довольных клиентов</h3>
                <p>Отзывы наших клиентов заставляют нас держать планку на высоком уровне</p>
            </div>
            <div class="wearegood__item">
                <img src="src/img/weare/basket.svg" alt="">
                <h3>100% гарантия качества </h3>
                <p>Если вы или ваш питомец недовольны качеством товара, то мы вернем вам деньги</p>
            </div>
        </div>

        <div class="collage">
            <div class="left__side">
                <img src="src/img/collage_left.jpg" alt="">
            </div>
            <div class="right__side">
                <div class="upper">
                    <img src="src/img/collage_right.jpg" alt="">
                </div>

                <div class="lower">
                    <h1 class="section__header">Подбор лучших зоотоваров</h1>
                    <p>
                        В нашей компании работают квалифицированные специалисты, которые помогут подобрать для 
                        ваших четвероногих друзей корма, витамины, ошейники, средства от блох и клещей и др. 
                        Лучшие товары отбираются с учетом стоимости, отзывов покупателей и мнения ветеринаров.
                        Домашние любимцы изо дня в день дарят нам радость и тепло общения, но также они ждут от 
                        нас ответного внимания и заботы. Мы подберем несколько товаров для собак и кошек, которые 
                        помогут упростить и разнообразить уход за питомцем, а также превратить вашего непоседу в 
                        стильного и послушного друга.
                    </p>
                </div>
            </div>
        </div>

        <h1 class="section__header" id="pop">Популярные зоотовары</h1>
        <div class="top__products">
            <?
            $sql = "SELECT `id`,`name`,`description`,`src`,`cost` FROM `catalog` `c` ORDER BY (SELECT COUNT(*) FROM `orders_products` `o` WHERE `o`.`product_id`=`c`.`id`) DESC LIMIT 4;";
            $items_query = mysqli_query($connect, $sql);
            while( $item = mysqli_fetch_assoc($items_query)):
            ?>
            <div class="top__products__inner">
                <img src="<?= $item['src'] ?>" alt="">
                <div class="right">
                    <h3><?= $item['name'] ?></h3>
                    <p><?= $item['description'] ?></p>
                    <span class="cost"><?= $item['cost'] ?></span>
                    <?
                    if($_SESSION['cart'][$item['id']]){
                        $button_text = "В корзине";
                        $class = " added";
                    }
                    else{
                        $button_text = "В корзину";
                        $class = "";
                    }
                    ?>
                    <button value="<?= $item['id'] ?>" class="button__add<?= $class ?>"> <?= $button_text ?> </button>
                </div>
            </div>
            <?
            endwhile;
            ?>
        </div>

        
    </section>

    <div class="header__under__banner banner2">
        <div class="under__banner">
            <div class="banner__inner">
                <div class="banner__inner__inner">
                    <strong>
                        Спецпредложения
                    </strong>
                    <br>
                    <span class="banner__strong__under">
                        или как работают промокоды:
                    </span>
                    <br>
                    <span class="banner__description">
                        <ul>
                            <li>Промокоды действуют на весь ассортимент</li>
                            <li>Вы можете подарить промокод кому-нибудь</li>
                            <li>Узнать номинал промокода и активировать его можно у оператора, который с вами связался</li>
                        </ul>
                    </span>
                    
                </div>
            </div>
        </div>
    </div>

    <section>
        <h1 class="section__header catalog__header" id="catalog">Каталог зоотоваров</h1>
        <div class="catalog">
            <select name="category" id="category" class="catalog__select">
                <option value="0">Все</option>
                <?
                $options = mysqli_query($connect, "SELECT * FROM `catalog_sections`");
                while( $option = mysqli_fetch_array($options)):
                ?>
                <option value="<?=$option[0]?>"> <?=$option[1]?> </option>
                <? endwhile; ?>
            </select>
            <div class="catalog__inner">
                <?
                $items = mysqli_query($connect, "SELECT * FROM `catalog`");
                while( $item = mysqli_fetch_assoc($items)):
                ?>
                <div class="catalog__item">
                    <img src="<?= $item['src'] ?>">
                    <h3 class="product__name"> <?= $item['name'] ?> </h3>
                    <p class="product__desc"> <?= $item['description'] ?> </p>
                    <span class="cost"> <?= $item['cost'] ?> </span>
                    <input class="section_id hide" type="radio" value="<?= $item['section_id'] ?>">
                    <?
                    if($_SESSION['cart'][$item['id']]){
                        $button_text = "В корзине";
                        $class = " added";
                    }
                    else{
                        $button_text = "В корзину";
                        $class = "";
                    }
                    ?>
                    <button value="<?= $item['id'] ?>" class="button__add<?= $class ?>"> <?= $button_text ?> </button>
                </div>
                <? endwhile; ?>
            </div>
        </div>

        <div class="delivery__outer">
            <div class="text">
                <h2>Доставим за 3 дня</h2>
                <p>Наша компания занимается продажей и доставкой зоотоваров с 2009 года. Сделайте заказ, и наши операторы свяжутся с вами для согласования деталей.</p>
            </div>
            <div class="img__outer">
                <img src="src/img/delivery_info.jpg" alt="">
            </div>
        </div>

        <h1 class="section__header" id="terms">Условия оплаты и доставки</h1>
        <div class="delivery__outer second">
            <div class="img__outer">
                <img src="src/img/delivery_info2.jpg" alt="">
            </div>

            <div class="text2">
                <p> <b> Доставка по всей России </b> - через транспортные компании, а также наложенным платежом. Стоимость доставки через транспортную компанию составляет около 500 руб., доставка наложенным платежом 400-2 000 руб. в зависимости от размера и стоимости ковра.</p>
                <p> <b>Самовывоз.</b>  Самовывоз со склада курьерской службы (срок доставки до пункта самовывоза составляет 7-14  дней в зависимости от региона)</p>
                <h3>Оплата</h3>
                <p> <b>Наличные при получении</b> – (вы делаете заказ, оставляете контактную информацию, указываете в пункте Оплата – «Наличными», при этом варианте оплата осуществляется курьеру при привозе заказа).</p>
                <p> <b>Наложенный платеж</b> – это значит, что оплачивать заказ вы будете наличными при получении в отделении Почты России.  Дополнительные комиссии в нашем магазине отсутствуют.</p>
            </div>
        </div>

        <h1 class="section__header" id="map">Наши магазины</h1>
    </section>

    <div class="wrapper" id="wrapper">
        <div class="wrapper__inner">
            <div class="wrapper__header">
                <img src="src/img/cross.png" alt="">
            </div>
            <? if (!$_SESSION["user"]): ?>
            <div class="reg">
                <h2>Регистрация</h2>
                <input type="email" name="email" placeholder="E-mail">
                <input type="text" name="telephone" id="tel" placeholder="Номер телефона">
                <input type="text" name="username" placeholder="Имя">
                <input type="password" name="password1" placeholder="Пароль">
                <input type="password" name="password2" placeholder="Подтверждение пароля">
                <p>У вас уже есть аккаунт? <br><span class="switch__form">Авторизация</span></p>
                <button>Подтвердить</button>
            </div>
            <div class="auth">
                <h2>Авторизация</h2>
                <input type="email" name="email_login" placeholder="E-mail">
                <input type="password" name="password_login" placeholder="Пароль">
                <p>У вас нет аккаунта? <br><span class="switch__form">Регистрация</span></p>
                <button>Подтвердить</button>
            </div>
            <? else: ?>
            <div class="profile">
                <h2>Профиль</h2>
                <div class="char__outer">
                    <span class="char__label">e-mail</span>
                    <span class="label"> <?= $_SESSION["user"]["email"] ?> </span>
                </div>
                <div class="char__outer">
                    <span class="char__label">Имя</span>
                    <span class="label"> <?= $_SESSION["user"]["name"] ?> </span>
                </div>
                <div class="char__outer">
                    <span class="char__label">Номер телефона</span>
                    <span class="label"> <?= $_SESSION["user"]["tel"]; ?> </span>
                </div>
                <div class="char__outer">
                    <span class="char__label">Количество заказов</span>
                    <span class="label"> <?= $_SESSION["user"]["orders"]; ?> </span>
                </div>
                <div class="char__outer">
                    <span class="char__label">Зарегистрирован:</span>
                    <span class="label"> <?= $_SESSION["user"]["date"]; ?> </span>
                </div>
                <form action="core/signout.php" method="post">
                    <button type="submit">Выход</button>
                </form>
            </div>
            <? endif; ?>
            <div class="cart">
                <h2>Корзина</h2>
                <div class="cart__inner">
                    <?
                    if ($_SESSION["cart"]):
                    foreach($_SESSION['cart'] as $item_id => $item):
                    ?>
                    <div class="cart__item" id="<?echo "cart" . trim($item_id) ?>">
                        <span class="name"> <?= $item["name"] ?> </span>
                        <div class="count__panel">
                            <button value="<?=trim($item_id)?>" class="change decrement">-</button>
                            <span class="count" id="count<?=trim($item_id)?>"><?=$item["count"]?></span>
                            <button value="<?=trim($item_id)?>" class="change increment">+</button>
                        </div>
                        <span class="cost" id="cost<?=trim($item_id)?>"><? echo $item["price"] * $item["count"] ?></span>
                    </div>
                    <?
                    endforeach;
                    else:
                    ?>
                    <h3 class="bucket__clear">Пусто</h3>
                    <? 
                    endif;
                    ?>
                </div>
                <?
                if(!$_SESSION["cart"] || !$_SESSION["user"]){
                    $disabled = "disabled";
                }
                ?>
                <form action="core/make_order.php" method="post">
                    <button name="makeorder" type="submit" <?=$disabled?>>Заказать</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="busket__button">
        <img src="src/img/cart.png">
    </div>

    <div class="to__up">
        <img src="src/img/arrow_up.png">
    </div>

    <div class="notification">
        <h3 id="not__header"></h3>
        <p id="not__desc"></p>
    </div>

    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A05bf7191223c3e2b1e87fb44f58162d3dd4d000fc88274b5ad9238af168b2dce&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    
</body>
</html>