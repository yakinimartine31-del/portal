<?php

namespace backend\controllers;

use backend\models\AuditTrial;
use backend\models\AuthAssignment;
use backend\models\UserCounters;
use backend\models\ZssfMembers;
use common\models\LoginForm;
use kartik\form\ActiveForm;
use Yii;
use backend\models\Users;
use backend\models\UsersSearch;
use yii\base\Security;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        
        if (Yii::$app->user->can('viewUserLoginAccount')) {
            UserCounters::checkLastLogin();
            $searchModel = new UsersSearch();
            $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view user login accounts';
            // $audit->activity='Login';
            $audit->module = 'Users';
            $audit->action = 'view';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to user login accounts'));
            return $this->redirect(['/']);
        }
    }


    public function actionRole()
    {

        if (Yii::$app->user->can('viewRoleManagement')) {
            if (!Yii::$app->user->isGuest) {
                $searchModel = new UsersSearch();
                $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

                $audit = new AuditTrial();
                $audit->items = 'view user Role accounts';
                // $audit->activity='Login';
                $audit->module = 'Users';
                $audit->action = 'view';
                $audit->new = '';
                $audit->old = '';
                $audit->category = 2;
                $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
                $audit->maker_time = date('Y-m-d H:i:s');
                $audit->save(false);

                return $this->render('role', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $model = new LoginForm();
                return $this->redirect(['site/login',
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to view user roles'));
            return $this->redirect(['/']);
        }


    }


    public function actionSearch()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $audit = new AuditTrial();
        $audit->items = 'view user login accounts';
        // $audit->activity='Login';
        $audit->module = 'Users';
        $audit->action = 'view';
        $audit->new = '';
        $audit->old = '';
        $audit->category = 2;
        $audit->maker = Yii::$app->user->identity->getId();
        $audit->maker_time = date('Y-m-d H:i:s');
        $audit->save(false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionActivated()
    {
        if (Yii::$app->user->can('viewUserLoginAccount')) {
            $searchModel = new UsersSearch();
            $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view user active login accounts';
            // $audit->activity='Login';
            $audit->module = 'Users';
            $audit->action = 'view';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to user login accounts'));
            return $this->redirect(['/']);
        }
    }

    /**
     * Displays a single Users model.
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


    public function actionViewSheha($id)
    {
        return $this->render('view-sheha', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->created_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionNew()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();

        }

        $role = AuthAssignment::findOne(['user_id' => Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null]);
        if (!empty($role) && ($role->item_name == 'Admin' || $role->item_name == 'SuperAdmin')) {

            $model = new Users();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password_new);
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->password_reset_token = Yii::$app->security->generateRandomString();
                $model->verification_token = Yii::$app->security->generateRandomString();
                $model->create_at = date('YmdHis');
                $model->status = \common\models\User::STATUS_ACTIVE;
                $model->registerDate = date('Y-m-d H-i-s');
                $model->staff_login = 1;
                $model->created_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;

                if ($model->validate()) {
                    $model->save(false);

                    Yii::$app->authManager->revokeAll($model->id);
                    Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'Username created Successfully ',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Yii::$app->session->setFlash('danger', Yii::t('yii', 'User was created successfully'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('new', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 3000,
                'icon' => 'fa fa-check',
                'message' => 'You do not have permission',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission'));
            //  return $this->redirect(['/']);
            return $this->redirect(['users/index']);
        }

    }



    public function actionIndexAgent()
    {
        if (Yii::$app->user->can('viewUserLoginAccount')) {
            UserCounters::checkLastLogin();
            $searchModel = new UsersSearch();
            $dataProvider = $searchModel->searchSheha(Yii::$app->request->queryParams);

            $audit = new AuditTrial();
            $audit->items = 'view sheha accounts';
            // $audit->activity='Login';
            $audit->module = 'Users';
            $audit->action = 'view';
            $audit->new = '';
            $audit->old = '';
            $audit->category = 2;
            $audit->maker = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);

            return $this->render('index-sheha', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission to user login accounts'));
            return $this->redirect(['/']);
        }
    }


    public function generateRandomString($length = 10)
    {
        $security = new Security();
        $randomBytes = $security->generateRandomKey($length);

        // Convert random bytes to characters
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[ord($randomBytes[$i]) % $charactersLength];
        }

        return $randomString;
    }

    public function actionNewAgent()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $role = AuthAssignment::findOne(['user_id' => Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null]);
        //    if (!empty($role) && $role->item_name =='Admin' || $role->item_name='SuperAdmin' ){

        $model = new Users();
        $member = new ZssfMembers();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $member->device_number=$this->generateRandomString(10);
        if ($model->load(Yii::$app->request->post()) && $member->load(Yii::$app->request->post())) {
            $check_user = Users::find()->where(['username' => $model->username])->one();

            if (empty($check_user)) {

                $model->password = Yii::$app->security->generatePasswordHash($model->password_new);
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->password_reset_token = Yii::$app->security->generateRandomString();
                $model->verification_token = Yii::$app->security->generateRandomString();
                $model->create_at = date('YmdHis');
                // $model->updated_at=date('0000-00-00 00:00:00');
                $model->status = \common\models\User::STATUS_ACTIVE;
                $model->registerDate = date('Y-m-d H-i-s');
                $model->staff_login = 0;
                $model->lastvisitDate = date('Y-m-d H-i-s');
                $model->lastResetTime = date('Y-m-d H-i-s');
                $model->updated_at = date('YmdHis');
                $model->created_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;

                if ($model->save(false)) {


                    $new_member = new ZssfMembers();
                    $new_member->uid = $model->id;
                    $new_member->date_time = date('Y-m-d H:i:s');
                    $new_member->full_names = $model->name;
                    $new_member->membership_number = $member->membership_number;
                    $new_member->email = $model->email;
                    $new_member->password = $model->password;
                    $new_member->username = $model->username;
                    $new_member->mobile_number = $member->mobile_number;
                    $new_member->mobile_phone_of_who_come_behalf_of_pensioner = $member->mobile_phone_of_who_come_behalf_of_pensioner;
                    $new_member->address = $member->address;
                    $new_member->gender = $member->gender;
                    $new_member->marital_status = $member->marital_status;
                    $new_member->user_type = 16;
                    $new_member->device_number = $member->device_number;
                    $new_member->region = $member->region;
                    $new_member->district = $member->district;
                    $new_member->shehia = $member->shehia;
                    $new_member->save(false);

                    // Yii::$app->authManager->revokeAll($model->id);
                    // Yii::$app->authManager->assign(Yii::$app->authManager->getRole($_POST['Users']['role']), $model->id);

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'Sheha created Successfully ',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Yii::$app->session->setFlash('success', Yii::t('yii', 'Sheha was created successfully'));
                    return $this->redirect(['view-sheha', 'id' => $model->id]);
                }

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 3000,
                    'icon' => 'fa fa-check',
                    'message' => 'Username already exist',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                Yii::$app->session->setFlash('danger', Yii::t('yii', 'User name already Exist'));
                return $this->redirect(['new']);
            }
        }

        return $this->render('new-sheha', [
            'model' => $model,
            'member' => $member,
        ]);
        //       }
//        else{
//            Yii::$app->session->setFlash('', [
//                'type' => 'danger',
//                'duration' => 3000,
//                'icon' => 'fa fa-check',
//                'message' => 'You do not have permission',
//                'positonY' => 'top',
//                'positonX' => 'right'
//            ]);
//            Yii::$app->session->setFlash('danger', Yii::t('yii', 'You do not have permission'));
//          //  return $this->redirect(['/']);
//            return $this->redirect(['users/index']);
//        }

    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->role = $model->role0 ? $model->role0->item_name : null;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->auth_key)) {
                $model->auth_key = Yii::$app->security->generateRandomString();
            }
            if (empty($model->password_reset_token)) {
                $model->password_reset_token = Yii::$app->security->generateRandomString();
            }
            if (empty($model->verification_token)) {
                $model->verification_token = Yii::$app->security->generateRandomString();
            }

            if ($model->validate()) {
                $find=AuthAssignment::find()
                    ->where(['user_id'=>$id])
                    ->one();


                if (!empty($model->role)){
                    if ($find){
                        Yii::$app->authManager->revokeAll($model->id);
                    }

                    Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);

                }


                $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateAgent($id)
    {
        $model = $this->findModel($id);
        $member = $this->findMemberModel($id);


        if ($model->load(Yii::$app->request->post()) && $member->load(Yii::$app->request->post())) {

            if ($model->password_new) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password_new);
            }

            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_reset_token = Yii::$app->security->generateRandomString();
            $model->verification_token = Yii::$app->security->generateRandomString();
            $model->updated_at = date('YmdHis');

            if ($model->save(false)) {

                ZssfMembers::updateAll([
                    'full_names' => $model->name,
                    'date_time' => date('Y-m-d H:i:s'),
                    'membership_number' => $member->membership_number,
                    'email' => $model->email,
                    'password' => $model->password,
                    'username' => $model->username,
                    'mobile_number' => $member->mobile_number,
                    'mobile_phone_of_who_come_behalf_of_pensioner' => $member->mobile_phone_of_who_come_behalf_of_pensioner,
                    'address' => $member->address,
                    'gender' => $member->gender,
                    'marital_status' => $member->marital_status,
                    'user_type' => 16,
                    'region' => $member->region,
                    'district' => $member->district,
                    'shehia' => $member->shehia,
                ], ['uid' => $model->id]);


                Yii::$app->session->setFlash('success', Yii::t('yii', 'Sheha was updated successfully'));
                return $this->redirect(['view-sheha', 'id' => $model->id]);

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update-sheha', [
            'model' => $model,
            'member' => $member,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteSheha($id)
    {
        ZssfMembers::updateAll([
            'date_time' => date('Y-m-d H:i:s'),
            'user_type' => 10,
        ], ['id' => $id]);

        Yii::$app->session->setFlash('success', Yii::t('yii', 'Sheha was deleted successfully'));

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findMemberModel($id)
    {
        if (($model = ZssfMembers::findOne(['uid' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }


    public function actionSubcat()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }


    public function actionGetData()
    {
        // if ($id = Yii::$app->request->post('depdrop_parents')) {
        if ($id = isset($_POST['depdrop_parents'])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://mobile.zssf.or.tz/api2/public/index.php/regions/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $operationPosts = count(json_decode($response));
            $regions = json_decode($response);

            if ($operationPosts > 0) {

                foreach ($regions as $region)
                    echo "<option value='" . $region->id . "'>" . $region->name . "</option>";
            } else
                echo "<option>-</option>";

        }
    }

    public function actionSub()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://mobile.zssf.or.tz/api2/public/index.php/districts/?region_id=$cat_id",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $districts = json_decode($response,true);

                $datas=array();
                foreach ($districts as $key=>$district){

                    $id=$district['DistrictID'];
                    $name=$district['DistrictName'];
                    $datas []=   [
                        'id'=>$id,
                        'name'=>$name,
                    ];

                }


                //  $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
//                $data = [
//                    ['id' => 1, 'name' => "Demo"],
//                    ['id' => 2, 'name' => 'Demo 2']
             //   ];
                return ['output' => $datas, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
    public function actionProd()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];

            if ($cat_id != null) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://mobile.zssf.or.tz/api2/public/index.php/shehias/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array("district_id" =>$subcat_id),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $shehias = json_decode($response,true);

                $datas=array();
                foreach ($shehias as $key=>$shehia){

                    $id=$shehia['ShehiaID'];
                    $name=$shehia['ShehiaName'];
                    $datas []=   [
                       'id'=>$id,
                       'name'=>$name,
                    ];

                }

//                print_r($datas);
//                die;


                //  $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
//                $data = [
//                    ['id' => 1, 'name' => $subcat_id],
//                    ['id' => 2, 'name' => 'Demo 2']
//                ];

                return ['output' => $datas, 'selected' => ''];

            }
        }
        return ['output' => '', 'selected' => ''];
    }

}
