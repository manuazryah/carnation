<?php

//use Yii;

namespace frontend\controllers;

use yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\Category;
use common\models\RecentlyViewed;
use common\models\WishList;
use common\models\Settings;
use yii\db\Expression;
use common\models\CmsMetaTags;

class ProductController extends \yii\web\Controller {

        public function actionIndex($id = null, $type = null, $category = null, $featured = null, $keyword = null) {
                $searchModel = new ProductSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination->pageSize = 42;
//                if (!empty($id) && $id != null) {
//                        $catag = Category::find()->where(['category_code' => $id])->one();
//                        $category = $catag->main_category;
//                } else {
//                        $catag = "";
//                }
                $catag = '';
                if (isset($keyword) && $keyword != '') {
                        $this->Search($keyword, $dataProvider);
                }

                if (!empty($category)) {
                        if ($category == "exclusive-brands")
                                $category = 1;
                        elseif ($category == "brands") {
                                $category = 2;
                        }
                        $dataProvider->query->andWhere(['main_category' => $category]);
                }

                if (!empty($id)) {
                        $dataProvider->query->andWhere(['brand' => $id]);
//                        $category = $catag->main_category;
                }

                if ((!empty($type) && $type == 0) || $type != "") {
                        $dataProvider->query->andWhere(['gender_type' => $type]);
                }

                if (!empty($featured)) {

                        if ($featured == 'featured') {

                                if (isset(Yii::$app->request->queryParams['category']) && Yii::$app->request->queryParams['category'] == "brands") {
                                        $featured = '';
                                } else {
                                        $featured = 1;
                                }
                        } else if ($featured == 1) {
                                $featured = 1;
                        } else {
                                $featured = 0;
                        }

                        $dataProvider->query->andWhere(['featured_product' => $featured]);
                }


                $categories = Category::find()->where(['status' => 1, 'main_category' => $category])->all();

                $meta_tags = CmsMetaTags::find()->where(['id' => 3])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'categories' => $categories,
                            'catag' => $catag,
                            'id' => $id,
                            'type' => $type,
                            'meta_title' => $meta_tags->meta_title,
                            'featured_status' => $featured,
                            'keyword' => $keyword,
                ]);
        }

        public function actionBrands() {
                $brands = \common\models\Brand::find()->where(['status' => 1])->orderBy(['brand' => SORT_ASC])->all();
                
                $meta_tags = CmsMetaTags::find()->where(['id' => 6])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('brands', ['brands' => $brands,'meta_title' => $meta_tags->meta_title,]);
        }

        public function Search($keyword, $dataProvider) {
                $dataProvider->query->andWhere(['like', 'product_name', $keyword])->orWhere(['like', 'canonical_name', $keyword]);
                /*
                 * search category
                 */
                $categorys = Category::find()->where(['status' => 1])->andWhere(['like', 'category', $keyword])->all();
                $category_products = array();
                if (!empty($categorys)) {
                        foreach ($categorys as $value) {
                                $cat_products = Product::find()->where(['status' => 1, 'category' => $value->id])->all();
                                foreach ($cat_products as $cat_products) {
                                        $category_products[] = $cat_products->id;
                                }
                        }
                        $dataProvider->query->orWhere(['IN', 'id', $category_products]);
                }
                /*
                 * search search tags
                 */
                $search_tags = \common\models\MasterSearchTag::find()->where(['status' => 1])->andWhere((['like', 'tag_name', $keyword]))->all();
                $keyword_products = array();
                if (!empty($search_tags)) {
                        foreach ($search_tags as $value) {
                                $search_products = Product::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:search_tag, search_tag)'))->addParams([':search_tag' => $value->id])->all();
                                foreach ($search_products as $search_productss) {
                                        if (!in_array($search_productss->id, $keyword_products))
                                                $keyword_products[] = $search_productss->id;
                                }
                        }
                        $dataProvider->query->orWhere(['IN', 'id', $keyword_products]);
                }
                return $dataProvider;
        }

        public function actionProductDetail($product) {
                if (isset(Yii::$app->user->identity->id)) {
                        $user_id = Yii::$app->user->identity->id;
                } else {
                        $user_id = '';
                }
        if (isset(Yii::$app->user->identity->id)) {
            $recently_viewed = RecentlyViewed::find()->where(['user_id' => Yii::$app->user->identity->id])->limit(10)->all();
        } else if (isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] != '') {
            $recently_viewed = RecentlyViewed::find()->where(['session_id' => Yii::$app->session['temp_user_product']])->limit(10)->all();
        }
                $shipping_limit = Settings::findOne('1')->value;
                $product_details = Product::find()->where(['canonical_name' => $product, 'status' => '1'])->one();
        Product::RecentlyViewed($product_details);
//        $this->RecentlyViewed($product_details);
                $product_reveiws = \common\models\CustomerReviews::find()->where(['product_id' => $product_details->id, 'status' => '1'])->all();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $product_details->meta_keywords]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $product_details->meta_description]);
//                echo '<pre>';                print_r($product_details);exit;
                if ($product_details) {
                        return $this->render('product_detail', [
                                    'product_details' => $product_details,
                                    'product_reveiws' => $product_reveiws,
                                    'user_id' => $user_id,
                                    'shipping_limit' => $shipping_limit,
                                    'recently_viewed' => $recently_viewed,
                        ]);
                }
        }

        public function actionSearchKeyword() {
                if (Yii::$app->request->isAjax) {

                        $keyword = $_POST['keyword'];
                        if ($keyword != '' || !empty($keyword)) {
                                $search_tags = \common\models\MasterSearchTag::find()->select('tag_name')->where(['status' => 1])->andWhere((['like', 'tag_name', $keyword]))->all();
                                $products = Product::find()->where(['status' => 1])->select('product_name')->andWhere((['like', 'product_name', $keyword]))->all();
                                $category = Category::find()->where(['status' => 1])->select('category')->andWhere((['like', 'category', $keyword]))->all();
                                $results_temp = array_merge($search_tags, $products);
                                $results = array_merge($results_temp, $category);

                                $values = $this->renderPartial('_product_search', ['products' => $results, 'keyword' => $keyword]);
                                return $values;
                        }
                }
        }

    public function actionSpecialOffer() {
        $special_offers = \common\models\HomeManagement::findOne(4)->products;
        $special = explode(',', $special_offers);
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['status' => 1]);
        $dataProvider->query->andWhere(['IN', 'id', $special]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'type'=>'',
            ]);
//        return $this->render('special_offer');
    }

}
