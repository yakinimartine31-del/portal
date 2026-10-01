<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php

                echo Yii::$app->request->baseUrl . '../../profile/images.png';

                ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>             <?php
                    if (!Yii::$app->user->isGuest) {

                        echo Yii::$app->user->identity->username;
                    }
                    ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('yii', 'Home'), 'icon' => 'certificate', 'url' => ['/']],
                    ['label' => Yii::t('yii', 'Complaints'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewComplaints'),
                        'url' => ['/complaints']
                    ],
					
                    ['label' => Yii::t('yii', 'Pensioners Death Reports'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewComplaints'),
                        'url' => ['/death-reports']
                    ],					

                    ['label' => Yii::t('yii', 'Contact Us'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewContactUs'),
                        'url' => ['/user-feedback']
                    ],
                    //                   ['label' => Yii::t('yii', 'Investments'), 'icon' => 'certificate', 'url' => ['/investments']],
                    [
                        'label' => Yii::t('yii', 'Articles'),
                        'icon' => 'certificate',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('viewArticles'),
                        'items' => [
                            ['label' => Yii::t('yii', 'Application Contents'), 'icon' => 'certificate', 'url' => ['/articles'],],
                            //   ['label' => Yii::t('yii','Publications'), 'icon' => 'certificate', 'url' => ['/publications'],],
                        ],
                    ],
                    //  ['label' => Yii::t('yii', 'SMS Logs'), 'icon' => 'certificate', 'url' => ['/sms-logs']],

                    ['label' => Yii::t('yii', 'Users Login Account'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewUserLoginAccount'),
                        'url' => ['/users']
                    ],
                    [
                        'label' => Yii::t('yii', 'Members'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewMembers'),
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('yii', 'All Members'), 'icon' => 'certificate', 'url' => ['/zssf-members'],],
                            // ['label' => Yii::t('yii', 'All Employers'), 'icon' => 'certificate', 'url' => ['/employers'],],
                            ['label' => Yii::t('yii', 'Contribution Trend'), 'icon' => 'certificate', 'url' => ['/contribution-trend'],],
                            ['label' => Yii::t('yii', 'Latest Contributions'), 'icon' => 'certificate', 'url' => ['/contributions'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('yii', 'Verification Agent'),
                        'visible' => Yii::$app->user->can('viewLogs'),
                        'icon' => 'certificate',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('yii', 'New Verification Agent'), 'icon' => 'certificate', 'url' => ['/users/new-agent'],],
                            ['label' => Yii::t('yii', 'List of Verification Agent'), 'icon' => 'certificate', 'url' => ['/users/index-agent'],],
                        ],
                    ],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => Yii::t('yii', 'Notification'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewNotification'),
                        'url' => ['/alerts/bulk'],
                        ],

                    [
                        'label' => Yii::t('yii', 'Logs'),
                        'visible' => Yii::$app->user->can('viewLogs'),
                        'icon' => 'certificate',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('yii', 'SMS Logs'), 'icon' => 'certificate', 'url' => ['/sms-logs'],],
                            ['label' => Yii::t('yii', 'Members Activities'), 'icon' => 'certificate', 'url' => ['/audit-trial'],],
                            ['label' => Yii::t('yii', 'Verifications Logs'), 'icon' => 'certificate', 'url' => ['/sys-pensioners-verifications-logs'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('yii', 'SMS'),
                        'visible' => Yii::$app->user->can('viewLogs'),
                        'icon' => 'certificate',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('yii', 'Schedule sending date'), 'icon' => 'certificate', 'url' => ['/alerts-schedule/bulk-verification'],],
                            ['label' => Yii::t('yii', 'List of scheduled'), 'icon' => 'certificate', 'url' => ['/alerts-schedule/index'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('yii', 'Settings'),
                        'icon' => 'certificate',
                        'visible' => Yii::$app->user->can('viewSetting'),
                        'url' => '#',
                        'items' => [
                            [
                                'label' => Yii::t('yii', 'Role Management'),
                                'icon' => 'certificate',
                                //  'visible' => Yii::$app->user->can('viewRoleManagement'),
                                'url' => '#',
                                'items' => [
                                    ['label' => Yii::t('yii', 'Permission List'), 'icon' => 'certificate', 'url' => ['/auth-item'],],
                                    ['label' => Yii::t('yii', 'Role List'), 'icon' => 'certificate', 'url' => ['/role'],],
                                    //   ['label' => Yii::t('yii', 'Role Assignment'), 'icon' => 'certificate', 'url' => ['/users/role'],],
                                ],
                            ],
                            ['label' => Yii::t('yii', 'Complaint Categories'), 'icon' => 'certificate', 'url' => ['/complaints-categories']],
                            ['label' => Yii::t('yii', 'Common Setting'), 'icon' => 'certificate', 'url' => ['/common-zssf-settings'],],
                            ['label' => Yii::t('yii', 'Subscription Setting'), 'icon' => 'certificate', 'url' => ['/subscription-types'],],
                            ['label' => Yii::t('yii', 'App images'), 'icon' => 'certificate', 'url' => ['/background-photos33-repeat'],],

                            // ['label' =>Yii::t('yii', 'Subscription'), 'icon' => 'certificate', 'url' => ['/background-photos33-repeat'],],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
