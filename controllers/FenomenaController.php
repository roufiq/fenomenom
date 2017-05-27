<?php

namespace app\controllers;

use app\models\MKategoriPdrb;
use app\models\User;
use Yii;
use app\models\Fenomena;
use app\models\FenomenaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\MSubkategori;
use yii\helpers\Json;


/**
 * FenomenaController implements the CRUD actions for Fenomena model.
 */
class FenomenaController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['update', 'delete','view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {

                            if (Yii::$app->user->identity->username=='admin'|| $this->isUserAuthor()) {
                                return true;
                            }
                            return false;
                        }
                    ],
                ],
            ],
        ];
    }

    protected function isUserAuthor()
    {
        return $this->findModel(Yii::$app->request->get('id'))->author == Yii::$app->user->id;
    }

    /**
     * Lists all Fenomena models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FenomenaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Fenomena models.
     * @return mixed
     */
    public function actionVerified()
    {
        $searchModel = new FenomenaSearch();
        $dataProvider = $searchModel->verifikasi(Yii::$app->request->queryParams);

        return $this->render('verified', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Fenomena model.
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
     * Creates a new Fenomena model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fenomena();
        $model->author= Yii::$app->user->getId();
        $model->summary='<p><i>sumber data:</i></p><hr><p><i>Isi</i></p>';

        if ($model->load(Yii::$app->request->post())) {

            $berkas = $model->uploadBerkas();

            if($model->save())
            {
                if($berkas!==false)
                {
                    $path= $model->getBerkas();
                    $berkas->saveAs($path);
                }

                return $this->redirect(['view','id'=>$model->id_fenomena]);
            }
            else
            {
                var_dump($model->getErrors()); die();
            }

        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Fenomena model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $oldFile=$model->getBerkas();
        $filename=$model->berkas;
//        $model->summary_rev= $model->summary;
//        $model->judul_rev= $model->judul;

        if ($model->load(Yii::$app->request->post()))
        {

            $image = $model->uploadBerkas();
            if ($image === false)
            {
            $model->berkas = $filename;
            }
            if ($model->save())
            {
                // upload only if valid uploaded file instance found
                if ($image !== false)
                {
                    if(trim($filename)!="")
                {
                    //not safe method
                    unlink($oldFile);// delete old and overwrite

                }
                    $path = $model->getBerkas();
                    $image->saveAs($path);

                }
                return $this->redirect(['view', 'id' => $model->id_fenomena]);

            } else {
                echo 'Error om';

            }

        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionVerifikasi($id)
    {
        $model = $this->findModel($id);
        $model->summary_rev= $model->summary;
        $model->judul_rev= $model->judul;
        $model->is_verified=1;
        $filename=$model->berkas;

        if ($model->load(Yii::$app->request->post()))
        {
            $image = $model->uploadBerkas();
            if ($image === false) {
                $model->berkas = $filename;
            }

            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'data sukses diverifikasi');
                return $this->redirect(['verified']);
            }
        }
        return $this->render('verifikasi', [
            'model' => $model,
        ]);

    }



    /**
     * Deletes an existing Fenomena model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if($model->delete())
        {
            if(!$model->deleteBerkas())
            {
                Yii::$app->session->setFlash('error', 'Error deleting berkas');
            }
        }


        return $this->redirect(['index']);
    }



    /**
     * Finds the Fenomena model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fenomena the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fenomena::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload()
    {
        $model = new Fenomena();
        if(Yii::$app->request->post())
        {
            $model->berkas= \yii\web\UploadedFile::getInstance($model, 'berkas');
//            set id user nanti
            if($model->validate())
            {
                $saveTo = '/'.$model->berkas->baseName.'.'.$model->berkas->extension;
                if($model->berkas->saveAs($saveTo))
                {
                    $model->save(false);
                    Yii::$app->session->setFlash('success','File berhasil upload');
                }

            }
        }
        return $this->render('upload',['model'=>$model]);
    }

    public function actionKategori() {
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $param = Yii::$app->request->post();
            $parents = $_POST['depdrop_parents'];
            if ($parents != null)
            {
                $id_pdrb = $parents[0];
                $out= self::getKategoriList($id_pdrb);
                if (!empty($_POST['depdrop_params'])){
                    $param = $_POST['depdrop_params'][0];
                }




                echo Json::encode(['output'=>$out, 'selected'=>$param]);
                return;
            }

        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionSubkategori()
    {
        $out=[];

        if (isset($_POST['depdrop_parents']))
        {
            $ids = $_POST['depdrop_parents'];
            $postData=Yii::$app->request->post();
            $id_pdrb = empty($ids[0]) ? null : $ids[0];
            $id_kategori_pdrb = empty($ids[1]) ? null : $ids[1];

            if ($ids!= null)
            {
                $out = self::getSubkategoriList($id_pdrb, $id_kategori_pdrb);

                if (!empty($_POST['depdrop_params'])){
                    $postData = $_POST['depdrop_params'][0];
//                    $param = $params[0];
                }


                echo Json::encode(['output'=>$out, 'selected'=>$postData]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getKategoriList($id)
    {

        $list= MKategoriPdrb::find()->select(['id_kategori as id', 'kategori_pdrb as name'])->where(['id_pdrb'=>$id])->asArray()->all();


        return $list;

    }

    public function getSubkategoriList($cat_id, $subcat_id)
    {
        $list= MSubkategori::find()->select(['id_sub as id', 'nama_sub as name'])->where(['id_pdrb'=>$cat_id])
            ->andWhere(['id_kategori'=>$subcat_id])->asArray()->all();
//        $list= MSubkategori::find()->select(['id_sub as id', 'nama_sub as name'])->where(['id_kategori'=>$subcat_id])->asArray()->all();
        return $list;
    }


}
