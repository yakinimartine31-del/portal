<?php

/* @var $this yii\web\View */

$this->title = 'ZSSF | Members Portal';
?>
<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml1">
  <span class="text-wrapper">
    <span class="letters"><?= Yii::t('yii', 'Welcome to ZSSF Member Portal for getting contribution information') ?></span>
  </span>
            </h3>


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div id="carousel-content-row-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-content-row-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-content-row-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-content-row-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="dist/img/slide1.png">
                    </div>
                    <div class="item">
                        <img src="dist/img/slider2.png">
                    </div>
                    <div class="item">
                        <img src="dist/img/slider3.png">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-content-row-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-content-row-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <hr>
<!--            <div class="jumbotron-contents">-->
<!--                <h5 style="word-spacing: 3px">Zanzibar Social Security Fund was established under the Zanzibar Security-->
<!--                    Fund Act No. 2 of 1998-->
<!--                    subsequently amended by the Zanzibar Social Security Fund Act No. 9 of 2002 and re-enacted by-->
<!--                    the Act No. 2 of 2005. Prior to the enactment of the Act and establishment of the Zanzibar Social-->
<!--                    Security Fund, there was no formal social security scheme in Zanzibar. Nor was there a significant-->
<!--                    private sector/occupational pension scheme sector in Zanzibar. Before the inception of Zanzibar-->
<!--                    Social Security Fund, public service employees in Zanzibar were covered and received pension-->
<!--                    benefits under the Pensions Act No. 2 of 1990.</h5>-->
<!--            </div>-->

        </div>
    </div>
</div>

<!-- Thumbnails
                ================================================== -->
</div><!-- panel body -->
</div>
</div><!-- content -->
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script>
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml1 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({loop: true})
        .add({
            targets: '.ml1 .letter',
            scale: [0.3, 1],
            opacity: [0, 1],
            translateZ: 0,
            easing: "easeOutExpo",
            duration: 900,
            delay: (el, i) => 70 * (i + 1)
        }).add({
        targets: '.ml1 .line',
        scaleX: [0, 1],
        opacity: [0.5, 1],
        easing: "easeOutExpo",
        duration: 900,
        offset: '-=875',
        delay: (el, i, l) => 80 * (l - i)
    }).add({
        targets: '.ml1',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });
</script>