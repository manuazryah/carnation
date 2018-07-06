<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\SubCategory;
use yii\helpers\Url;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$current_action = Yii::$app->controller->action->id; // controller action id
$gender_params = \yii::$app->getRequest()->getQueryParams();

$brands_sub = \common\models\Brand::find()->where(['status' => 1])->orderBy(['brand' => SORT_ASC])->all();
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Products</a></li>
        </ul>
        <h1 class="page-title">Products</h1>

    </div>
</div>

<section class="in-product-section">
    <div class="container">
        <div class="row">
            <aside id="column-left" class="col-sm-3 hidden-xs">

                <div class="box sidebarFilter">

                    <div class="filterbox">
                        <div class="list-group">
                            <div class="title">Brand</div>
                            <div class="list-group-item">
                                <div id="filter-group3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="7" />
                                            Burberry (0)                      </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="9" />
                                            Calvin klein (0)                      </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="8" />
                                            Hugo Boss (0)                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">FRAGRANCES</div>
                            <div class="list-group-item">
                                <div id="filter-group2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="4" />
                                            Eau De Parfum                      </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="5" />
                                            Eau De Toilette                     </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="6" />
                                            Eau De Toilette                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class=" title">Size</div>
                            <div class="list-group-item">
                                <div id="filter-group1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="1" />
                                            Red (12)                      </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="2" />
                                            Blue (13)                      </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="3" />
                                            Green (3)                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class=" title">Target Groups</div>
                            <div class="list-group-item">
                                <div id="filter-group1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="1" />
                                            Men                     </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="2" />
                                            Women                    </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="3" />
                                            Unisex                      </label>

                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="filter[]" value="3" />
                                            Unisex                      </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </aside> 
            <div class="col-sm-9">
                <div class="row">
                    <?=
                    $dataProvider->totalcount > 0 ? ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => '_view2',
                                'pager' => [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => '<',
                                    'nextPageLabel' => '>',
                                    'maxButtonCount' => 5,
                                ],
                            ]) : $this->render('no_product');
                    ?>
                </div>
            </div>    

        </div>
    </div>
    <div class="clearfix"></div>
</section>