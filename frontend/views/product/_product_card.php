<?php
 use yii\helpers\Html;
?>
<li>
<div class="product_card card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $model->image; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $model->name; ?></h5>
    <p class="card-text"><?php echo $model->description; ?>.</p>
    <?php echo Html::a(Html::encode("View Details"), ['view', 'id' => $model->id],['class' =>  'btn btn-primary']); ?>
<?php echo Html::a(Html::encode("Add To Cart"), '#',['data-pid' => $model->id,'class' =>  'btn btn-primary add-to-cart']); ?>
<div class='main'>
  <!--<input type="number" value="0" class="counter" min="0" max="99"/> -->
</div>
</div>
</div>
</li>