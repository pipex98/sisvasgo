<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$userName = Yii::$app->user->isGuest 
    ? "" : Yii::$app->user->identity->username;

$baseUrl = Yii::$app->request->baseUrl;

$personPicture = Yii::$app->user->isGuest
    ? '' : Yii::$app->user->identity->picture;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->params['app']['short_name'] . '</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Help -->
                <li class="messages-menu">
                    <?= Html::a('<i class="fa fa-question-circle"></i>', ['/site/about']); ?>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::img($personPicture, [
                                'class' => 'img-circle user-image'
                        ]); ?>
                        <span class="hidden-xs"><?= $userName; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= Html::img($personPicture, [
                                'class' => 'img-circle'
                                ]); ?>
                            <p><?= $userName; ?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('user', 'Logout'),
                                    ['/user/security/logout'],
                                    [
                                        'class' => 'btn btn-danger btn-flat btn-sm',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to logout?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ); ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>