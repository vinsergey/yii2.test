<?php

use common\models\Post;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/** @var Post[] $posts*/

echo \yii\helpers\Html::a('Create', \yii\helpers\Url::toRoute('/post/create'));

$dataProvider = new ActiveDataProvider([
    'query' => $posts,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'author',
            'title',
            'slug',
            'content',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model)
                    {
                        return '<a href="'.Url::toRoute(['/post/edit', 'id' => $model-> id]).'">Edit</a>';
                    }
                ]
            ]
        ]
    ]);
} catch (Exception $e) {
}

