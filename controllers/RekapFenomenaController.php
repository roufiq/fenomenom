<?php

namespace app\controllers;

use Yii;
use app\models\RekapFenomena;
use app\models\RekapFenomenaSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FenomenaSearch;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
//use yii\web\Controller;
use app\models\Fenomena;
use yii\web\Response;

/**
 * RekapFenomenaController implements the CRUD actions for RekapFenomena model.
 */
class RekapFenomenaController extends Controller
{
    /**
     * @inheritdoc
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

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editpertumbuhan' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => RekapFenomena::className(),                // the update model class
            ]
        ]);
    }

    /**
     * Lists all RekapFenomena models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $model= new RekapFenomena();
//        if ($model->load(Yii::$app->request->post()) && $model->save())
//        {
//            $model = new RekapFenomena(); //reset model
//        }
        $searchModel = new RekapFenomenaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->sortParam = false;


        $qParams= Yii::$app->request->getQueryParam('RekapFenomenaSearch');
//        Total parameter minimal untuk load halaman
        if(count($qParams)!=3)
        {
            $kuartal=ceil(date('n', time()) / 3);
//        $kuartal=2;
            $tahun= date("Y");
            $this->redirect(Url::toRoute(['rekap-fenomena/index','RekapFenomenaSearch[id_pdrb]'=>1,'RekapFenomenaSearch[tahun]'=>$tahun,
                'RekapFenomenaSearch[triwulan]'=>$kuartal]));
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
//            'model'=>$model,
            ]);
        }

//        print_r($dataProvider->totalCount);
//        Jika belum ada data untuk tahun dan triwulan maka generate dan batch insert RekapFenomena Model
        if($dataProvider->totalCount<=0)
        {
            $model= new RekapFenomena();
            $qParams= Yii::$app->request->getQueryParam('RekapFenomenaSearch');
//            if(isset($qParams['tahun']))
            $tahunParam= $qParams['tahun'];
//            if(isset($qParams['triwulan']))
            $triwulanParam= $qParams['triwulan'];
            if(isset($qParams['id_pdrb']))
            {
                $pdrbParam=$qParams['id_pdrb'];
                if($pdrbParam==1)
                {
                    $rows= $model->generateLapanganUsaha($tahunParam,$triwulanParam);
                    Yii::$app->db->createCommand()->batchInsert(RekapFenomena::tableName(),
                        ['id_pdrb', 'id_kategori', 'id_subkategori','series','tahun','triwulan'], $rows)->execute();

                }
                else
                {
                    $rows= $model->generatePengeluaran($tahunParam,$triwulanParam);
                    Yii::$app->db->createCommand()->batchInsert(RekapFenomena::tableName(),
                        ['id_pdrb', 'id_kategori', 'id_subkategori','tahun','triwulan'], $rows)->execute();
                }


            }
        }
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $id_rekap = $_POST['editableKey'];
            $model = $this->findModel($id_rekap);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);

            // fetch the first entry in posted data (there should only be one entry
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['RekapFenomena']);
            $post = ['RekapFenomena'=> $posted];

            // load model like any single model validation
            if ($model->load($post)) {
                // can save model or do something before saving model
                $model->save();
                Yii::$app->session->setFlash('success','Data Pertumbuhan berhasil diupdate');


                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';



                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                if (isset($posted['pertumbuhan'])) {


                    $output = $model->pertumbuhan;
                }

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
//                Yii::$app->response->format = Response::FORMAT_JSON;
            }
            // return ajax json encoded response and exit

            echo $out;
//            Yii::$app->session->setFlash('success','Data Pertumbuhan berhasil diupdate');
//            return $this->redirect(Url::to(Yii::$app->request->getAbsoluteUrl()));
            return;
        }





        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'model'=>$model,
        ]);
    }

    /**
     * Displays a single RekapFenomena model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RekapFenomena model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new RekapFenomena();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing RekapFenomena model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success','Data berhasil diubah');

            if(Yii::$app->request->isAjax)
            {
                return Json::encode (['status'=> true]);
            }
            else
            {
                return $this->redirect(['view','id'=>$model->id]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RekapFenomena model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the RekapFenomena model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RekapFenomena the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RekapFenomena::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTabulasi()
    {
        $searchModel = new RekapFenomenaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $fModel = new FenomenaSearch();
        $fProvider = $fModel->search(Yii::$app->request->queryParams);

        return $this->render('tabulasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $fModel,
            'dataProvider2' => $fProvider,
        ]);
    }
}
