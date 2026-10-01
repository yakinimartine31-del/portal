<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<nav role="navigation" class="navbar navbar-custom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Bootflat-Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="getting-started.html">Getting Started</a></li>
                <li class="active"><a href="getting-started.html">Contact</a></li>
                <li class="active"><a href="index.html">Documentation</a></li>
                <!-- <li class="disabled"><a href="#">Link</a></li> -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Silverbux <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li class="dropdown-header">Setting</li>
                        <li><a href="#">Action</a></li>
                        <li class="divider"></li>
                        <li class="active"><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li class="disabled"><a href="#">Signout</a></li>
                    </ul>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--header-->
<div class="container-fluid">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
                <li class="list-group-item"><a href="index.html"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                <li class="list-group-item"><a href="icons.html"><i class="glyphicon glyphicon-certificate"></i>Icons </a></li>
                <li class="list-group-item"><a href="list.html"><i class="glyphicon glyphicon-th-list"></i>Tables and List </a></li>
                <li class="list-group-item"><a href="forms.html"><i class="glyphicon glyphicon-list-alt"></i>Forms</a></li>
                <li class="list-group-item"><a href="alerts.html"><i class="glyphicon glyphicon-bell"></i>Alerts</li>
                <li class="list-group-item"><a href="timeline.html" ><i class="glyphicon glyphicon-indent-left"></i>Timeline</a></li>
                <li class="list-group-item"><a href="calendars.html" ><i class="glyphicon glyphicon-calendar"></i>Calendars</a></li>
                <li class="list-group-item"><a href="typography.html" ><i class="glyphicon glyphicon-font"></i>Typography</a></li>
                <li class="list-group-item"><a href="footers.html" ><i class="glyphicon glyphicon-minus"></i>Footers</a></li>
                <li class="list-group-item"><a href="panels.html" ><i class="glyphicon glyphicon-list-alt"></i>Panels</a></li>
                <li class="list-group-item"><a href="navs.html" ><i class="glyphicon glyphicon-th-list"></i>Navs</a></li>
                <li class="list-group-item"><a href="colors.html" ><i class="glyphicon glyphicon-tint"></i>Colors</a></li>
                <li class="list-group-item"><a href="flex.html" ><i class="glyphicon glyphicon-th"></i>Flex</a></li>
                <li class="list-group-item"><a href="login.html" ><i class="glyphicon glyphicon-lock"></i>Login</a></li>
                <li>
                    <a href="#demo3" class="list-group-item " data-toggle="collapse">Item 3  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <div class="collapse" id="demo3">
                        <a href="#SubMenu1" class="list-group-item" data-toggle="collapse">Subitem 1  <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <div class="collapse list-group-submenu" id="SubMenu1">
                            <a href="#" class="list-group-item">Subitem 1 a</a>
                            <a href="#" class="list-group-item">Subitem 2 b</a>
                            <a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse">Subitem 3 c <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">
                                <a href="#" class="list-group-item">Sub sub item 1</a>
                                <a href="#" class="list-group-item">Sub sub item 2</a>
                            </div>
                            <a href="#" class="list-group-item">Subitem 4 d</a>
                        </div>
                        <a href="javascript:;" class="list-group-item">Subitem 2</a>
                        <a href="javascript:;" class="list-group-item">Subitem 3</a>
                    </div>
                </li>
                <li>
                    <a href="#demo4" class="list-group-item " data-toggle="collapse">Item 4  <span class="glyphicon glyphicon-chevron-right"></span></a>
                <li class="collapse" id="demo4">
                    <a href="" class="list-group-item">Subitem 1</a>
                    <a href="" class="list-group-item">Subitem 2</a>
                    <a href="" class="list-group-item">Subitem 3</a>
                </li>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Panel Title</h3>
                </div>
                <div class="panel-body">



                    <!-- Jumbotron
                                    ================================================== -->
                    <div class="content-row">
                        <h2 class="content-row-title">Jumbotron</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="jumbotron">
                                    <div class="jumbotron-photo">
                                        <img src="dist/img/Jumbotron.jpg" />
                                    </div>
                                    <div class="jumbotron-contents">
                                        <h1>Implementing the HTML and CSS into your user interface project</h1>
                                        <h2>HTML Structure</h2>
                                        <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                                        <h2>CSS Structure</h2>
                                        <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="jumbotron">
                                    <div id="carousel-content-row-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-content-row-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-content-row-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-content-row-generic" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <img src="dist/img/slider1.jpg">
                                            </div>
                                            <div class="item">
                                                <img src="dist/img/slider2.jpg">
                                            </div>
                                            <div class="item">
                                                <img src="dist/img/slider3.jpg">
                                            </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-content-row-generic" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-content-row-generic" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                    <div class="jumbotron-contents">
                                        <h1>Implementing the HTML and CSS into your user interface project</h1>
                                        <h2>HTML Structure</h2>
                                        <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                                        <h2>CSS Structure</h2>
                                        <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                                    </div>
                                </div>
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
<!--footer-->
<div class="site-footer">
    <div class="container">
        <div class="download">
            <span class="download__infos">You simply have to <b>try it</b>.</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-primary" href="https://github.com/silverbux/bootflat-admin/archive/master.zip">Download Bootflat-Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- SmartAddon BEGIN -->
            <script type="text/javascript">
                (function() {
                    var s=document.createElement('script');s.type='text/javascript';s.async = true;
                    s.src='http://s1'+'.smartaddon.com/share_addon.js';
                    var j =document.getElementsByTagName('script')[0];j.parentNode.insertBefore(s,j);
                })();
            </script>

            <a href="http://www.smartaddon.com/?share" title="Share Button" onclick="return sa_tellafriend('','bookmarks')"><img alt="Share" src="http://bootflat.github.io/img/share.gif" border="0" /></a>
            <!-- SmartAddon END -->
        </div>
        <hr class="dashed" />
        <div class="row">
            <div class="col-md-4">
                <h3>Get involved</h3>
                <p>Bootflat is hosted on <a href="https://github.com/silverbux/bootflat-admin" target="_blank" rel="external nofollow">GitHub</a> and open for everyone to contribute. Please give us some feedback and join the development!</p>
            </div>
            <div class="col-md-4">
                <h3>Contribute</h3>
                <p>You want to help us and participate in the development or the documentation? Just fork Bootflat on <a href="https://github.com/silverbux/bootflat-admin" target="_blank" rel="external nofollow">GitHub</a> and send us a pull request.</p>
            </div>
            <div class="col-md-4">
                <h3>Found a bug?</h3>
                <p>Open a <a href="https://github.com/silverbux/bootflat-admin/issues" target="_blank" rel="external nofollow">new issue</a> on GitHub. Please search for existing issues first and make sure to include all relevant information.</p>
            </div>
        </div>
        <hr class="dashed" />
        <div class="row">
            <div class="col-md-6">
                <h3>Talk to us</h3>
                <ul>
                    <li>Tweet us at <a href="https://twitter.com" target="_blank">@YourTwitter</a>&nbsp;&nbsp;&nbsp;&nbsp;Email us at <span class="connect">info@yourdomain.com</span></li>
                    <li>
                        <a title="Twitter" href="https://twitter.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe121"></i></a>
                        <a title="Facebook" href="https://www.facebook.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe10b"></i></a>
                        <a title="Google+" href="https://plus.google.com/" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe110"></i></a>
                        <a title="Github" href="https://github.com/alexquiambao" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe10e"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <!-- Begin MailChimp Signup Form -->
                <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
                <div id="mc_embed_signup">
                    <h3 style="margin-bottom: 15px;">Newsletter</h3>
                    <form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                        <input style="margin-bottom: 10px;" type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                        <span class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary"></span>
                    </form>
                </div>
                <!--End mc_embed_signup-->
            </div>
        </div>
        <hr class="dashed" />
        <div class="copyright clearfix">
            <p><b>Bootflat</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="getting-started.html">Getting Started</a>&nbsp;&bull;&nbsp;<a href="index.html">Documentation</a>&nbsp;&bull;&nbsp;<a href="https://github.com/Bootflat/Bootflat.UI.Kit.PSD/archive/master.zip">Free PSD</a>&nbsp;&bull;&nbsp;<a href="colors.html">Color Picker</a></p>
            <p>Code licensed under <a href="http://opensource.org/licenses/mit-license.html" target="_blank" rel="external nofollow">MIT License</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/" rel="external nofollow">CC BY 3.0</a>.</p>
        </div>
    </div>
</div>
</body>
</html>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
