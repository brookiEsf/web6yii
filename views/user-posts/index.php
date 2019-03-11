<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($models as $model):
        ?>
        <div class="news-one">
            <div class="col-md-6">
                <?= $model->title; ?>

                <p>
                    автор: <? echo($model->user->username); ?>
                </p>
                <p>
                    створено:
                    <?= $model->date_created; ?>
                </p>
            </div>

            <div class="col-md-6">
                <?= $model->body; ?>
            </div>

        </div>
    <?php
    endforeach;
    ?>


    <!--    <p>-->
    <!--        --><? //= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->

    <!--    --><? //= ListView::widget([
    //        'dataProvider' => $dataProvider,
    //        'itemOptions' => ['class' => 'item'],
    //        'itemView' => function ($model, $key, $index, $widget) {
    //            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
    //        },
    //    ]) ?>
</div>
