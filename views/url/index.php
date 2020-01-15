<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (isset($success) && $success && !empty($shortUrl)):?>
    <p>Your short utl <a href="<?php echo $shortUrl?>"><?php echo $shortUrl?></a></p>
<?php endif;?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'url') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

