<header class="header section">

    <div class="container header__container">
        <div class="row-center">

            <a href="/">
                <picture class="header__logo">
                    <source media="(max-width: 991px)" srcset="img/logoM.png">
                    <img src="{{asset('img/logo.png')}}" alt="Feniks">
                </picture>
            </a>

            <nav class="header__nav">
                <a href="#we" class="header__link">О нас</a>
                <a href="#catalog" class="header__link">Аренда</a>
                <a href="#catalog" class="header__link">Продажа</a>
                <a href="#send" class="header__link">Новости</a>
                <a href="#footer" class="header__link">Контакты</a>
            </nav>

            <a href="tel:+79991112233" class="button header__button"><img src="{{asset('img/tel.png')}}" alt="tel">Бесплатный звонок</a>

            <div class="header__burger">
                <div class="header__burger__line"></div>
                <div class="header__burger__line"></div>
                <div class="header__burger__line"></div>
                <div class="header__burger__line"></div>
            </div>
        </div>
    </div>

</header>
