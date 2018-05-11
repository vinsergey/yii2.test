<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
echo $form -> field($model, 'author');
echo $form -> field($model, 'title');
echo $form -> field($model, 'slug');
echo $form -> field($model, 'description');
echo $form -> field($model, 'content');
echo Html::submitButton('Add');
ActiveForm::end();