<section class="section main">
    <div class="container main__container">
        <div class="row-center main__row">
            <div class="main__box">
                <h1 class="main__title">Путешествуйте <br> с комфортом!</h1>
                <p class="main__text">Дополнительные скидки на аренду квартиры до 30% + бесплатный трансфер до дома!</p>
                <button data-modal class="button-r main__button">
                    <span>Подробнее</span>
                    <div class="button-r__wrap">

                    <svg>
                        <clipPath id="svgPathMain">
                            <path d="M 15,0
                                Q 5,0 5,10
                                Q 0,38 5,66
                                Q 5,76 15,76"
                            />
                            <path class="path" d="M 15,0
                                Q 5,0 5,10
                                Q 0,38 5,66
                                Q 5,76 15,76"
                            />
                            <rect x="15" width="calc(100% - 30px)" height="100%" />
                        </clipPath>
                    </svg>

                    <svg>
                        <clipPath id="svgPathMainM">
                            <path d="M 15,0
                                Q 5,0 5,10
                                Q 0,33 5,56
                                Q 5,66 15,66"
                            />
                            <path class="path" d="M 15,0
                                Q 5,0 5,10
                                Q 0,33 5,56
                                Q 5,66 15,66"
                            />
                        <rect x="15" width="calc(100% - 30px)" height="100%"/>
                        </clipPath>
                    </svg>
                </div>
                </button>
            </div>

            <div data-video="/video/Turkey.mp4" class="main__play">
                <picture class="main__play__button">
                    <source media="(max-width: 991px)" srcset="{{asset('img/main/playM.png')}}">
                    <img src="{{asset('img/main/play.png')}}" alt="play">
                </picture>
                <picture class="main__play__arrow">
                    <source media="(max-width: 991px)" srcset="{{asset('img/main/arrowM.png')}}">
                    <img src="{{asset('img/main/arrow.png')}}" alt="arrow">
                </picture>
                <span>Смотреть промо-ролик</span>
            </div>
        </div>
    </div>

</section>
 <!-- /.section main -->
