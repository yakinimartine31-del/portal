<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$data=\frontend\models\CommonZssfSettings::findOne(['id'=>1]);
$insta=$data['instagram_link'];
$twitter=$data['twitter_link'];
$facebook=$data['facebook_link'];
$youtube=$data['youtube_link'];
AppAsset::register($this);
?>
</div><!-- panel body -->
</div>
</div><!-- content -->
</div>
</div>
</div>
<div class="site-footer" style="background-color: #033B6A">
    <div class="container">
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
    </div>
</div>