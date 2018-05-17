<?php
namespace backend\controllers;

use common\models\Post;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class PostController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'edit', 'create', 'delete', 'test', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts = Post::find();
        return $this->render('index', [
            'posts' => $posts,
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();

        if($model -> load(Yii::$app -> request -> post()))
        {
            if (  $model -> save())
            {
                return $this->redirect(Url::toRoute('/post/index'));
            } else {
                var_dump($model->getErrors());
                die();
            }

        }
        return $this->render('create', [
           'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Post::find() -> where(['id' => $id]) -> one();

        try {
            $model->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->redirect(Url::toRoute('/post/index'));
    }

    public function actionEdit($id)
    {
        //$model = Post::findOne($id);
        $model = Post::find() -> where(['id' => $id]) -> one();

        if($model -> load(Yii::$app -> request -> post()))
        {
            if (  $model -> save())
            {
                return $this->redirect(Url::toRoute('/post/index'));
            } else {
                var_dump($model->getErrors());
                die();
            }

        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionTest(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $posts = Post::find()->all();
        return ['posts' =>$posts ];
    }
}