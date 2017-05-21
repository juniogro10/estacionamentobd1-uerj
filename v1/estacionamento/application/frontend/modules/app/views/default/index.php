<?php

/* @var $this yii\web\View */

use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <?

//        echo FileInput::widget([
//            'name' => 'file_input',
//            'pluginOptions' => [
//                'showPreview' => false,
//                'showCaption' => false,
//                'showRemove' => false,
//                'showUpload' => false,
//                //'browseClass' => 'btn btn-primary btn-block',
//                'browseClass' => 'btn btn-lg btn-primary',
//                'browseIcon' => '<i class="fa fa-upload"></i> ',
//                'browseLabel' =>  'Obter dados'
//            ],
//            'options' => ['accept' => '.csv,.txt,.zip'],
//            //'pluginOptions'=>['allowedFileExtensions'=>['txt','csv','zip']]
//        ]);


        echo FileInput::widget([
            'model' => $model,
            'name' => 'csvfile',
            'attribute' => 'csvfile',
            'options'=>[
                'multiple'=>false,
                'accept' => '.csv,.txt,.zip'
            ],
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/app/upload']),
                'maxFileCount' => 10,
                'showPreview' => false,
                'showCaption' => false,
                'browseClass' => 'btn btn-lg btn-primary',
                'browseIcon' => '<i class="fa fa-upload"></i> ',
                'browseLabel' =>  'Obter dados'
            ]
        ]);



        ?>




    </div>

    <div class="body-content">


        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
