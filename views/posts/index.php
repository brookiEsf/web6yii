<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--    --><? //= GridView::widget([
    //        'dataProvider' => $dataProvider,
    //        'columns' => [
    //            ['class' => 'yii\grid\SerialColumn'],
    //
    //            'id',
    //            'username',
    //            'date_created',
    //            'date_updated',
    //            'body:ntext',
    //            //'title',
    //
    //            ['class' => 'yii\grid\ActionColumn'],
    //        ],
    //    ]); ?>
</div>

<?php
foreach ($models as $model):
    ?>
    <div class="news-one">
        <div class="col-md-12">
            <?= $model->title; ?>

            <p>
                id: <? echo($model->user->id); ?>
            </p>

            <p>
                автор: <? echo($model->user->username); ?>
            </p>
            <p>
                створено:
                <? echo($model->date_created); ?>
            </p>
            <p>
                змінено:
                <? echo($model->date_updated); ?>
            </p>
            <p>
                заголовок:
                <? echo($model->title); ?>
            </p>
            <p>
                тіло поста:
                <? echo($model->body); ?>
            </p>
            <hr>
        </div>

        <!--        <div class="col-md-6">-->
        <!--            --><?//= $model->body;
        ?>
        <!--        </div>-->

    </div>
<?php
endforeach;
?>
