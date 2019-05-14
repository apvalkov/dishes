<?php

namespace app\modules\admin\controllers;

use app\models\Ingredient;
use app\modules\admin\models\forms\DishForm;
use app\modules\admin\services\DishService;
use Yii;
use app\models\Dish;
use app\modules\admin\models\DishSearch;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
{
    /**
     * @var DishService
     */
    private $service;

    public function __construct(string $id, Module $module, DishService $service, array $config = [])
    {
        $this->service = $service;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DishForm();
        $statuses = Dish::getStatuses();
        $ingredients = ArrayHelper::map(Ingredient::find()->active()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $this->service->create($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'statuses' => $statuses,
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = DishForm::findOne($id);
        $statuses = Dish::getStatuses();
        $ingredients = ArrayHelper::map(Ingredient::find()->active()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $this->service->update($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'statuses' => $statuses,
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
