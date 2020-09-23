<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
    'attribute'=>'Image',
    'value'=>$model->image,
    'format' => ['image',['width'=>'100','height'=>'100']],
],
[
    'attribute'=>'Category',
    'value'=>$model->category->name
],
            'name',
            'slug',
            'description:ntext',
            'price',
            'created_by',
            'last_updated_by',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
