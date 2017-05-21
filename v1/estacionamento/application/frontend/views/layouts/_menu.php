<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;




?>


<div id="sticky-nav-sticky-wrapper" class="sticky-wrapper is-sticky" style="height: 91px;">
    <?php
    NavBar::begin([
        'brandLabel' => '<a class="navbar-brand logo" href="' . \yii\helpers\Url::to(Yii::$app->homeUrl) . '"><span class="title-text-custom_first">Estacionamento</span></a>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'role' => "navigation",
            'id' => "sticky-nav"
        ],
    ]);
    $menuItems = [];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Sobre', 'url' => ['#sobre']];
//        $menuItems[] = ['label' => 'Planos', 'url' => ['#planos']];
//        $menuItems[] = ['label' => 'Contato', 'url' => ['#contato']];
//        $menuItems[] = ['label' => 'Registrar', 'url' => ['/site/signup']];
//        $menuItems[] = [
//            'label' => 'Entrar',
//            'items' => [
//                'template' => Yii::$app->view->render('/site/login/index_menu', ['model' => $login_form_model]),
//                'template' => '
//                           <div class="loginBox">
//                                <form class="loginForm" id="loginForm">
//                                        <input class="input-login" type="text" id="username" placeholder="username" />
//                                        <input class="input-login" type="password" id="password" placeholder="password" />
//                                        <div class="checkbox">
//                                             <label><input type="checkbox">Salvar dados</label>
//                                        </div>
//                                         <input type="submit" class="btn btn-info" value="Entrar">
//
//
//                                    <span><a href="#"><u>Esqueci minha senha</u></a></span>
//                                </form>
//                </div>
//                            ',
//            ]];
//    } else {
//        $menuItems[] = ['label' => 'Minha Conta', 'items' => [['label' => 'Minhas Informações', 'url' => '#'], ['label' => 'Pagamento', 'url' => 'site/pagamento']]];
        $menuItems[] = [
            'label' => 'Sair (dsa)',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']];
//    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>