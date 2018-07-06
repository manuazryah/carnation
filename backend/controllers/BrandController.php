<?php

namespace backend\controllers;

use Yii;
use common\models\Brand;
use common\models\BrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller {

        public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
        }

        /**
         * @inheritdoc
         */
        public function behaviors() {
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
         * Lists all Brand models.
         * @return mixed
         */
        public function actionIndex() {

                $searchModel = new BrandSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Brand model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Brand model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Brand();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model, $model->id) && $model->save() && $this->SaveUpload($model)) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        public function SetExtension($model, $id) {
                $image = UploadedFile::getInstance($model, 'image');
                if (!empty($id)) {
                        $update = Brand::findOne($id);
                        if (!empty($image)) {
                                $model->image = $image->extension;
                        } else {
                                $model->image = $update->image;
                        }
                } else {
                        $model->image = $image->extension;
                }

                return TRUE;
        }

        public function SaveUpload($model) {
                $image = UploadedFile::getInstance($model, 'image');
                $path = Yii::$app->basePath . '/../uploads/cms/brands';
                $size = [
                        ['width' => 300, 'height' => 75, 'name' => 'small'],
                ];

                if (!empty($image)) {
                        Yii::$app->UploadFile->UploadFile($model, $image, $path . '/' . $model->id, $size);
                }
                return TRUE;
        }

        /**
         * Updates an existing Brand model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model, $id) && $model->validate() && $model->save() && $this->SaveUpload($model)) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Brand model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $model1 = \common\models\Product::find()->where(['brand' => $id])->all();
                if (empty($model1)) {
                        $this->findModel($id)->delete();
                } else {
                        Yii::$app->getSession()->setFlash('error', "Can't delete the Item, Error Code : PRO1");
                }
                return $this->redirect(['index']);
        }

        /*     * *********** */

    public function actionAjaxaddimage() {
        if (Yii::$app->request->isAjax) {
            $uniqueId = time() . '-' . mt_rand();
            Yii::$app->session['tempfolder'] = $uniqueId;

            if (!is_dir(\Yii::$app->basePath . '/../uploads/temp/' . $uniqueId)) {
                mkdir(\Yii::$app->basePath . '/../uploads/temp/' . $uniqueId);
                chmod(\Yii::$app->basePath . '/../uploads/temp/' . $uniqueId, 0777);
                $dir = \Yii::$app->basePath . '/../uploads/temp/' . $uniqueId . '/';
                $result = $this->ImageUpload($_FILES, $dir);
            }
            if ($result == 1) {
                $home_path = Yii::$app->homeUrl . '../uploads/temp/' . Yii::$app->session['tempfolder'];
                $base_path = \Yii::$app->basePath . '/../uploads/temp/' . Yii::$app->session['tempfolder'];
                $value = 'success';

                echo $value;
            } else {
                echo 0;
            }
        }
    }

    public function actionAjaxaddbrand() {
        if (yii::$app->request->isAjax) {
            $brand = Yii::$app->request->post()['brand'];
            $model = new Brand();
            $model->brand = $brand;
            $model->status = '1';
            $model->image = '1';
            if (Yii::$app->SetValues->Attributes($model)) {
                if ($model->save()) {
                    $image_arr = [
                        ['width' => 150, 'height' => 75, 'name' => 'small'],
                    ];
                    $this->ProductImages($model, $image_arr);
                    echo json_encode(array("con" => "1", 'id' => $model->id, 'brand' => $brand)); //Success
                    exit;
//            array('id' => $model->id, 'category' => $category);
                } else {
                    echo json_encode(array("con" => "0", 'error' => 'Cannot added')); //Error
                    exit;
                }
            }
        }
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function ImageUpload($data, $dir) {
        if (isset($data['files']) && !empty($data['files'])) {
            $no_files = count($data["files"]['name']);

            for ($i = 0; $i < $no_files; $i++) {
                if ($data["files"]["error"][$i] > 0) {
                    return 0;
                } else {
                    if (move_uploaded_file($data["files"]["tmp_name"][$i], $dir . $data["files"]["name"][$i])) {
                        $reslt = 1;
                    } else {
                        $reslt = 0;
                    }
                }
            }
            return $reslt;
        } else {
            echo 'Please choose at least one file';
        }
    }

    function ProductImages($model, $image_arr) {
        if (isset(Yii::$app->session['tempfolder'])) {


            if ($this->SaveGalleyImage($model)) {
                $brand = Brand::findOne($model->id);
                $model->copybrand(Yii::$app->basePath . '/../uploads/cms/brands/' . $brand->id . '/large.'  . $brand->image, $brand);
//                $this->generateThumbImages($model, $image_arr);
            }
            $this->TempImageSession(Yii::$app->session['tempfolder']);
            unset(Yii::$app->session['tempfolder']);
        }
        return true;
    }

    function SaveGalleyImage($model) {
        if (isset(Yii::$app->session['tempfolder'])) {
            $path = Yii::$app->basePath . '/../uploads/temp/' . Yii::$app->session['tempfolder'];
//            $split_folder = Yii::$app->UploadFile->folderName(0, 1000, $model->id);
            $new_prod_path = Yii::$app->basePath . '/../uploads/cms/brands/' . $model->id;
            if ($this->NewFolder($model->id, $new_prod_path)) {
                $new_path = \Yii::$app->basePath . '/../uploads/cms/brands/' . $model->id;
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (file_exists($path)) {
                        if ($this->CopyImage($path, $new_path, $model)) {
                            $this->TempImageSession(Yii::$app->session['tempfolder']);
                            unset(Yii::$app->session['tempfolder']);
                        }
                    } else {
                        unset(Yii::$app->session['tempfolder']);
                    }
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }


                return true;
            }
        } else {
            return true;
        }
    }

    function CopyImage($path, $new_path, $model) {
        foreach (glob("{$path}/*") as $file) {
            $arry = explode('/', $file);
            if (is_dir($file)) {
                $profile_path = \Yii::$app->basePath . '/../uploads/cms/brands/' . $model->id;

                $this->CopyImage($file, $profile_path, $model);
            } else {

                $newfile = $new_path . '/' . end($arry);
                $name = $newfile;
                $ext = end((explode(".", $name))); # extra () to prevent notice

                copy($file, $newfile);
                $new_name = $new_path . '/large.' . $ext;
                rename($newfile, $new_name);
                $this->imagename($model, $ext);
            }
        }
    }

    function NewFolder($id, $new_prod_path) {

        if (!is_dir($new_prod_path)) {
            mkdir(\Yii::$app->basePath . '/../uploads/cms/brands/' . $id);
            chmod(\Yii::$app->basePath . '/../uploads/cms/brands/' . $id, 0777);
        }
//		if (!is_dir(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id)) {
//			mkdir(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id);
//			mkdir(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id . '/profile');
//			chmod(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id, 0777);
//			chmod(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id . '/profile', 0777);
//		}
//		if (!is_dir(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id . '/gallery')) {
//			mkdir(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id . '/gallery');
//			chmod(\Yii::$app->basePath . '/../uploads/brand/' . $split_folder . '/' . $id . '/gallery', 0777);
//		}

        return true;
    }

    function TempImageSession() {

        if (isset(Yii::$app->session['tempfolder'])) {
            $path = Yii::$app->basePath . '/../uploads/temp/' . Yii::$app->session['tempfolder'] . '/';
            if (file_exists($path)) {
                $this->recursiveRemoveDirectory($path);
            } else {

                unset(Yii::$app->session['tempfolder']);
                return true;
            }
            return true;
        }
    }

    function recursiveRemoveDirectory($directory) {
        foreach (glob("{$directory}/*") as $file) {
            if (is_dir($file)) {
                $this->recursiveRemoveDirectory($file);
            } else {
                unlink($file);
            }
        }
        FileHelper::removeDirectory($directory);
        return true;
    }

    function imagename($model, $ext) {
        $brand = Brand::findOne($model->id);
        $brand->image = $ext;
        $brand->save();
    }

}
