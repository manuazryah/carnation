<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\db\Expression;
use common\models\CreateYourOwn;
use common\models\WishList;
use yii\web\UploadedFile;

class AjaxController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    /*
     * This function set gender value in session variable
     * And also find characters based on gender type
     * return result to the view
     */

    public function actionGenderSession() {

        if (Yii::$app->request->isAjax) {
            $gender_type = $_POST['data_val'];
            Yii::$app->session['create-your-own'] = [
                'gender' => $gender_type,
            ];
            $characters = \common\models\Characters::find()->where(['gender' => $gender_type])->all();
            if ($characters == '') {
                echo '0';
                exit;
            } else {
                $options = '';
                foreach ($characters as $character_data) {
                    $options .= '<label class = "image-toggler choose2 character-main" data-image-id = "#image1" id = " " data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/characters/' . $character_data->id . '.' . $character_data->img . '"><input class="character" type="radio" name="character" value="' . $character_data->id . '" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/characters/' . $character_data->id . '.' . $character_data->img . '"><span class="span2">' . $character_data->name . '</span></label>';
                }
            }
            echo $options;
        }
    }

    /*
     * This function set character value in session variable
     * And also find scent based on character
     * return result to the view
     */

    public function actionCharacterSession() {
        if (Yii::$app->request->isAjax) {
            $character = $_POST['data_val'];
            $character_data = \common\models\Characters::find()->where(['id' => $character])->one();
            $sess = Yii::$app->session['create-your-own'];
            Yii::$app->session['create-your-own'] = array_merge($sess, ['character' => $character, 'character-price' => $character_data->price]);
            $Scents = \common\models\Scent::find()->where(new Expression('FIND_IN_SET(:charecter_id, charecter_id)'))->addParams([':charecter_id' => $character])->andWhere(['status' => 1])->all();
            if ($Scents == '') {
                echo '0';
                exit;
            } else {
                $options = '';
                foreach ($Scents as $Scent_data) {
                    $options .= '<label class = "image-toggler choose2 scent-main" data-image-id = "#image1" " data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/scent/' . $Scent_data->id . '.' . $Scent_data->img . '"><input class="scent" type="radio" name="scent" value="' . $Scent_data->id . '" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/characters/' . $Scent_data->id . '.' . $Scent_data->img . '"><span class="span2">' . $Scent_data->scent . '</span></label>';
                }
            }
            echo $options;
        }
    }

    /*
     * This function set character value in session variable
     * And also find scent based on character
     * return result to the view
     */

    public function actionScentSession() {
        if (Yii::$app->request->isAjax) {
            $scent_id = $_POST['data_val'];
            $scent_data = \common\models\Scent::find()->where(['id' => $scent_id])->one();
            $sess = Yii::$app->session['create-your-own'];
            Yii::$app->session['create-your-own'] = array_merge($sess, ['scent' => $scent_id, 'scent-price' => $scent_data->price]);
            $Notes = \common\models\Notes::find()->where(new Expression('FIND_IN_SET(:scent_id, scent_id)'))->addParams([':scent_id' => $scent_id])->andWhere(['status' => 1])->all();
            $all_notes = \common\models\Notes::find()->where(['status' => 1])->all();
            $options = '<input type="hidden" name="note-count" id="note-count" value="0"/>';
            $options1 = '';
            if (!empty($Notes)) {
                $i = 1;
                foreach ($Notes as $Note_data) {
                    $options .= '<span class="button-checkbox notes-main" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $Note_data->id . '/large.' . $Note_data->main_img . '" id="note-' . $Note_data->id . '" data-val1="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $Note_data->id . '/small.' . $Note_data->main_img . '"><button id="" type="button" class="btn image-toggler choose2 tab btn-default" data-image-id="#image1"><span class="span2" id="' . $i . '">' . $Note_data->notes . '</span></button><input type="checkbox" class="note-select" name="notes[]" name2="service_frequency" value="' . $Note_data->id . '" id="" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $Note_data->id . '/large.' . $Note_data->main_img . '"></span><input type="hidden" name="item-count" id="item-' . $Note_data->id . '" value="0"/>';
                    $i++;
                }
            }
            if (!empty($all_notes)) {
                foreach ($all_notes as $all_data) {
                    $options1 .= '<span class="button-checkbox notes-main" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $all_data->id . '/large.' . $all_data->main_img . '" id="note-' . $all_data->id . '" data-val1="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $all_data->id . '/small.' . $all_data->main_img . '"><button id="" type="button" class="btn image-toggler choose2 tab btn-default" data-image-id="#image1"><span class="span2">' . $all_data->notes . '</span></button><input type="checkbox" class="note-select" name="notes[]" name2="service_frequency" value="' . $all_data->id . '" id="" data-val="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $all_data->id . '/large.' . $all_data->main_img . '"></span><input type="hidden" name="item-count" id="item-' . $all_data->id . '" value="0"/>';
                }
            }
            $arr_variable = array('recomented' => $options, 'recomented-count' => count($Notes), 'all' => $options1, 'all-count' => count($all_notes));
            $data['result'] = $arr_variable;
            echo json_encode($data);
        }
    }

    /*
     * This function add note variables to session
     * return result to the view
     */

    public function actionAddNotesSession() {
        if (Yii::$app->request->isAjax) {
            $note_id = $_POST['data_val'];
            $note_data = \common\models\Notes::findOne($note_id);
            $note_session = Yii::$app->session['create-your-own'];
            if (isset(Yii::$app->session['create-your-own']['note-data'])) {
                $prev_note = Yii::$app->session['create-your-own']['note-data'];
                if (empty($prev_note)) {
                    $next_note = $note_data->id;
                } else {
                    $next_note = $prev_note . "," . $note_data->id;
                }
            } else {
                $next_note = $note_data->id;
            }
            Yii::$app->session['create-your-own'] = array_merge($note_session, ['note-data' => $next_note]);
        }
    }

    /*
     * This function remove note variables from session
     * return result to the view
     */

    public function actionRemoveNotesSession() {
        if (Yii::$app->request->isAjax) {
            $note_id = $_POST['data_val'];
            $notes_data = \common\models\Notes::find()->where(['id' => $note_id])->one();
            $prev_session = Yii::$app->session['create-your-own'];
            $arr_note_data = explode(',', Yii::$app->session['create-your-own']['note-data']);
            $new_str = '';
            $j = 1;
            foreach ($arr_note_data as $value) {
                if ($value == $notes_data->id) {
                    if ($j != 1) {
                        $new_str .= $value . ',';
                    }
                    $j++;
                } else {
                    $new_str .= $value . ',';
                }
            }
            Yii::$app->session['create-your-own'] = array_merge($prev_session, ['note-data' => rtrim($new_str, ',')]);
            echo $notes_data->notes;
            exit;
        }
    }

    /*
     * This function set bottle value in session variable
     * return result to the view
     */

    public function actionBottleSession() {
        if (Yii::$app->request->isAjax) {
            $bottle = $_POST['data_val'];
            $bottle_data = \common\models\Bottle::find()->where(['id' => $bottle])->one();
            $sess = Yii::$app->session['create-your-own'];
            Yii::$app->session['create-your-own'] = array_merge($sess, ['bottle' => $bottle_data->id, 'bottle-price' => $bottle_data->price]);
            $bottle_src = Yii::$app->homeUrl . 'uploads/create_your_own/bottle/' . $bottle_data->id . '/large.' . $bottle_data->bottle_img;

            $data_positions = $bottle_data->data_positions;
            $max_length_1 = 'Max :' . $bottle_data->label_1_length . ' characters ';
            $max_length_2 = 'Max :' . $bottle_data->label_2_length . ' characters ';
            $image_width = $bottle_data->image_width;
            $image_height = $bottle_data->image_height;
            $arr_variable2 = array('id' => $bottle_data->id, 'img_width' => $image_width, 'img_height' => $image_height, 'bottle-src' => $bottle_src, 'max-length1' => $max_length_1, 'max-length2' => $max_length_2, 'max-limit1' => $bottle_data->label_1_length, 'max-limit2' => $bottle_data->label_2_length, 'data_pos' => $data_positions);
            $data['result'] = $arr_variable2;
            echo json_encode($data);
        }
    }

    /*
     * This function set bottle label value in session variable
     * return result to the view
     */

    public function actionLabelSession() {
        if (Yii::$app->request->isAjax) {
            $line1 = $_POST['line_1'];
            $line2 = $_POST['line_2'];
            $sess = Yii::$app->session['create-your-own'];
            $amount = 0;
            $amount += Yii::$app->session['create-your-own']['character-price'];
            $amount += Yii::$app->session['create-your-own']['scent-price'];
            $amount += Yii::$app->session['create-your-own']['bottle-price'];
            $arr_note_data = explode(',', Yii::$app->session['create-your-own']['note-data']);
            foreach ($arr_note_data as $value) {
                $note_model = \common\models\Notes::find()->where(['id' => $value])->one();
                $amount += $note_model->price;
            }
            Yii::$app->session['create-your-own'] = array_merge($sess, ['line-1' => $line1, 'line-2' => $line2, 'total-amount' => $amount]);
            $gender_name = '';
            $character_name = '';
            $scent_name = '';
            if (isset(Yii::$app->session['create-your-own']['gender'])) {
                $gender_name = \common\models\Gender::findOne(Yii::$app->session['create-your-own']['gender'])->gender;
            }
            if (isset(Yii::$app->session['create-your-own']['character'])) {
                $character_name = \common\models\Characters::findOne(Yii::$app->session['create-your-own']['character'])->name;
            }
            if (isset(Yii::$app->session['create-your-own']['gender'])) {
                $scent_name = \common\models\Scent::findOne(Yii::$app->session['create-your-own']['scent'])->scent;
            }
            $heading = $gender_name . '  >  ' . $character_name . '  >  ' . $scent_name;
            $options = '';
            if (isset(Yii::$app->session['create-your-own']['note-data'])) {
                $arr_note_data = explode(',', Yii::$app->session['create-your-own']['note-data']);
                foreach ($arr_note_data as $value) {
                    $datas = \common\models\Notes::find()->where(['id' => $value])->one();
                    if (strlen($datas->notes) > 10) {
                        $str = substr($datas->notes, 0, 7) . '...';
                    } else {
                        $str = $datas->notes;
                    }
                    $options .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><img src="' . Yii::$app->homeUrl . 'uploads/create_your_own/notes/' . $datas->id . '/small.' . $datas->sub_img . '"><p style="font-size:12px;" title="' . $datas->notes . '">' . $str . '</p></div>';
                }
            }
            $bottle_data = \common\models\Bottle::find()->where(['id' => Yii::$app->session['create-your-own']['bottle']])->one();
            $data_positions = $bottle_data->data_positions;
            $image_width = $bottle_data->image_width;
            $image_height = $bottle_data->image_height;
            $bottle_src = Yii::$app->homeUrl . 'uploads/create_your_own/bottle/' . $bottle_data->id . '/large.' . $bottle_data->bottle_img;
            if (isset(Yii::$app->session['temp_img_session']) && isset(Yii::$app->session['create-your-own']['img-extension'])) {
                $bottle_backgrnd_src = Yii::$app->homeUrl . 'uploads/create_your_own/bottle_image/' . Yii::$app->session['temp_img_session'] . '.' . Yii::$app->session['create-your-own']['img-extension'];
            } else {
                $bottle_backgrnd_src = '';
            }
            $arr_variable1 = array('bottle_backgrnd_src' => $bottle_backgrnd_src, 'data_pos' => $data_positions, 'img_width' => $image_width, 'img_height' => $image_height, 'heading' => $heading, 'first-line' => Yii::$app->session['create-your-own']['line-1'], 'second-line' => Yii::$app->session['create-your-own']['line-2'], 'tot-count' => sprintf('%0.2f', Yii::$app->session['create-your-own']['total-amount']) . ' $', 'note-imgs' => $options, 'bottle-src' => $bottle_src);
            $data['result'] = $arr_variable1;
            echo json_encode($data);
        }
    }

    /*
     * This function save create your own data and check when the user is logged in or not
     * return result to the view
     */

    public function actionCheckOut() {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->session['create-your-own'];
            $user_id = '';
            $sessonid = '';
            $flag = 0;
            $model = new CreateYourOwn();
            if (isset(Yii::$app->user->identity->id)) {
                $user_id = Yii::$app->user->identity->id;
                $flag = 1;
            } else {
                if (!isset(Yii::$app->session['temp_create_yourown']) || Yii::$app->session['temp_create_yourown'] == '') {
                    $milliseconds = round(microtime(true) * 1000);
                    Yii::$app->session['temp_create_yourown'] = $milliseconds;
                }
                $sessonid = Yii::$app->session['temp_create_yourown'];
            }
            $model->user_id = $user_id;
            $model->session_id = $sessonid;
            $model->gender = $data['gender'];
            $model->character_id = $data['character'];
            $model->scent = $data['scent'];
            $model->note = $data['note-data'];
            $model->bottle = $data['bottle'];
            $model->label_1 = $data['line-1'];
            $model->label_2 = $data['line-2'];
            $model->tot_amount = $data['total-amount'];
            if (isset(Yii::$app->session['temp_img_session']) && isset(Yii::$app->session['create-your-own']['img-extension'])) {
                $model->image = Yii::$app->session['create-your-own']['img-extension'];
            }
            if ($model->save()) {
                if (isset(Yii::$app->session['temp_img_session']) && isset(Yii::$app->session['create-your-own']['img-extension'])) {
                    $path = Yii::$app->basePath . '/../' . "uploads/create_your_own/bottle_image/";
                    $file = $path . Yii::$app->session['temp_img_session'] . '.' . Yii::$app->session['create-your-own']['img-extension'];
                    $newName = $model->id . '.' . Yii::$app->session['create-your-own']['img-extension'];
                    rename($file, $path . $newName);
                    unset(Yii::$app->session['temp_img_session']);
                    unset(Yii::$app->session['create-your-own']);
                }
                yii::$app->session['create_own'] = $model->id;
                yii::$app->session['after_login'] = 'cart/mycart';
            }
            echo $flag;
        }
    }

    /*
     * This function select Country code based on the country id
     * return result to the view
     */

    public function actionCountrycode() {

        if (Yii::$app->request->isAjax) {
            $country_id = $_POST['country_id'];
            if ($country_id == '') {
                echo '0';
                exit;
            } else {
                $country_code = \common\models\CountryCode::find()->where(['id' => $country_id])->one();
                if (empty($country_code)) {
                    echo '0';
                    exit;
                } else {

                    echo $country_code->id;
                    exit;
                }
            }
        }
    }

    /*
     * This function select chek email id	 * return result to the view
     */

    public function actionEmailUnique() {

        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            if ($email == '') {
                echo '0';
                exit;
            } else {
                $data = \common\models\User::find()->where(['email' => $email, 'usertype' => '1'])->one();
                if (!empty($data)) {
                    echo 0;
                    exit;
                } else {
                    echo 1;
                    exit;
                }
            }
        }
    }

    /*
     * This function select chek email id	 * return result to the view
     */

    public function actionUserUnique() {

        if (Yii::$app->request->isAjax) {
            $username = $_POST['username'];
            if ($email == '') {
                echo '0';
                exit;
            } else {
                $data = \common\models\User::find()->where(['username' => $username])->one();
                if (!empty($data)) {
                    echo 0;
                    exit;
                } else {
                    echo 1;
                    exit;
                }
            }
        }
    }

    /**
     * Save product to wish list.
     * @param product id
     * if user logged in set user id otherwise redirect to login
     */
    public function actionSavewishlist() {
        if (Yii::$app->request->isAjax) {
            $flag = 0;
            $product_ids = $_POST['product_id'];
            $product_id = yii::$app->EncryptDecrypt->Encrypt('decrypt', $product_ids);
            if ($product_id != '') {
                $user_id = '';
                $sessonid = '';
                if (isset(Yii::$app->user->identity->id)) {
                    $user_id = Yii::$app->user->identity->id;
                    $model = WishList::find()->where(['product' => $product_id, 'user_id' => $user_id])->one();
                    if (empty($model)) {
                        $model = new WishList();
                        $model->user_id = $user_id;
                        $model->session_id = $sessonid;
                        $model->product = $product_id;
                        $model->date = date('Y-m-d');
                        $flag = 1;
                    } else {
                        $model->date = date('Y-m-d');
                        $flag = 2;
                    }
                    $model->save();
                } else {
                    yii::$app->session['wishlist-login'] = '<i class="fa fa-exclamation" aria-hidden="true"></i> Please login for wishlisting a product';
                }
            }
            echo $flag;
        }
    }

    public function actionBottleImageSave() {
        if (Yii::$app->request->isAjax) {
            $milliseconds = round(microtime(true) * 1000);
            if (!isset(Yii::$app->session['temp_img_session'])) {
                Yii::$app->session['temp_img_session'] = $milliseconds;
            }
            $uploaddir = Yii::$app->basePath . '/../' . "uploads/create_your_own/bottle_image/";
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            basename($_FILES['fileToUpload']['name']);
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploaddir . Yii::$app->session['temp_img_session'] . '.' . end($temp))) {
                $sess = Yii::$app->session['create-your-own'];
                Yii::$app->session['create-your-own'] = array_merge($sess, ['img-extension' => end($temp)]);
                echo Yii::$app->homeUrl . "uploads/create_your_own/bottle_image/" . Yii::$app->session['temp_img_session'] . '.' . Yii::$app->session['create-your-own']['img-extension'];
            }
        }
    }

}
