<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use kartik\money\MaskMoney;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <h1>Перевести деньжат</h1>
        <?php
        $form = ActiveForm::begin([
            'id' => 'transfer-form',
            'options' => [],
        ]) ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'userFrom')->dropDownList(Users::getUsersIdName()); ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'userTo')->dropDownList(Users::getUsersIdName()); ?>
                </div>
            </div>
            <div class="row top-buffer">
                <?= $form->field($model, 'amount'); ?>
            </div>
            <div class="row top-buffer">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success pull-right']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
