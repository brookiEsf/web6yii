<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userdb */
/* @var $form ActiveForm */

$this->title = 'enter-new-password';
?>
<div class="site-newPasswordEnt">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password') ?>
    <?= $form->field($model, 'confirmPassword') ?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- newPasswordEnt -->
