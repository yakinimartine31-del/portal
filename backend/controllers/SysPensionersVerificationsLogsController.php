<?php

namespace backend\controllers;

use backend\models\SysPensionersVerificationsLogs;
use backend\models\SysPensionersVerificationsLogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * SysPensionersVerificationsLogsController implements the CRUD actions for SysPensionersVerificationsLogs model.
 */
class SysPensionersVerificationsLogsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
            ]
        );
    }

    /**
     * Lists all SysPensionersVerificationsLogs models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SysPensionersVerificationsLogsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Disable pagination for export requests
        if (isset($this->request->queryParams['export'])) {
            $dataProvider->pagination = false;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'queryParams' => $this->request->queryParams,
        ]);
    }

    /**
     * Displays a single SysPensionersVerificationsLogs model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SysPensionersVerificationsLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SysPensionersVerificationsLogs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SysPensionersVerificationsLogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SysPensionersVerificationsLogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SysPensionersVerificationsLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SysPensionersVerificationsLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysPensionersVerificationsLogs::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Export all data to PDF/Excel/CSV
     */
    public function actionExport($format = 'pdf')
    {
        $searchModel = new SysPensionersVerificationsLogsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false;
        $models = $dataProvider->getModels();

        $exportColumns = [
            '#' => '#',
            'date_time' => 'Date Time',
            'pension_number' => 'Pension Number',
            'full_names' => 'Full Names',
            'verification_code' => 'Verification Code',
            'batch_code' => 'Batch Code',
            'verified_date_time' => 'Verified Date Time',
            'verification_status' => 'Verification Status',
            'checker_remarks' => 'Checker Remarks',
            'date_renewed' => 'Date Renewed',
            'start_date' => 'Start Date',
            'expiry_date' => 'Expiry Date',
            'verified_location' => 'Verified Location',
            'verified_by' => 'Verified By',
            'pensioner_phone_no' => 'Pensioner Phone No',
            'mobile_phone_of_who_come_behalf_of_pensioner' => 'Mobile Phone of Who Come Behalf of Pensioner',
        ];

        $pdfHeader = [
            'L' => ['content' => Yii::t('yii', 'logs REPORT')],
            'C' => [
                'content' => 'COMPLAINTS REPORT',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'arial',
                'height' => 119,
                'color' => '#333333'
            ],
            'R' => ['content' => Yii::t('yii', 'Date:') . date('Y-m-d')],
            'line' => true,
        ];

        $pdfFooter = [
            'L' => ['content' => '&copy; ZSSF', 'font-size' => 10, 'color' => '#333333', 'font-family' => 'arial'],
            'C' => ['content' => ''],
            'R' => ['font-size' => 10, 'color' => '#333333', 'font-family' => 'arial'],
            'line' => true,
        ];

        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            'date_time',
            'pension_number',
            'full_names',
            'verification_code',
            'batch_code',
            'verified_date_time',
            'verification_status',
            'checker_remarks:ntext',
            'date_renewed',
            'start_date',
            'expiry_date',
            'verified_location',
            'verified_by',
            'pensioner_phone_no',
            'mobile_phone_of_who_come_behalf_of_pensioner',
        ];

        $content = $this->renderPartial('_export', [
            'models' => $models,
            'gridColumns' => $gridColumns,
            'pdfHeader' => $pdfHeader,
            'pdfFooter' => $pdfFooter,
        ]);

        switch (strtolower($format)) {
            case 'pdf':
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'default_font_size' => 9,
                    'default_font' => 'Arial',
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 15,
                    'margin_bottom' => 15,
                    'margin_header' => 5,
                    'margin_footer' => 5,
                    'setAutoTopMargin' => 'stretch',
                    'autoScriptToLang' => true,
                    'ignore_invalid_utf8' => true,
                    'tabSpaces' => 4,
                ]);
                $mpdf->SetHeader($pdfHeader);
                $mpdf->SetFooter($pdfFooter);

                $cssInline = '
                        .kv-wrap{padding:20px;}
                        .kv-align-center{text-align:center;}
                        .kv-align-left{text-align:left;}
                        .kv-align-right{text-align:right;}
                        .kv-align-top{vertical-align:top!important;}
                        .kv-align-bottom{vertical-align:bottom!important;}
                        .kv-align-middle{vertical-align:middle!important;}
                        .kv-page-summary{border-top:4px double #ddd;font-weight: bold;}
                        .kv-table-footer{border-top:4px double #ddd;font-weight: bold;}
                        .kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}
                        table { border-collapse: collapse; width: 100%; }
                        th { background-color: #e0e0e0; font-weight: bold; padding: 5px; border: 1px solid #ddd; }
                        td { padding: 5px; border: 1px solid #ddd; }
                    ';

                // Write CSS
                $mpdf->WriteHTML('<style>' . $cssInline . '</style>', \Mpdf\HTMLParserMode::HEADER_CSS);

                // Chunk HTML to avoid pcre.backtrack_limit exceeded
                $chunkSize = 50000;
                $len = strlen($content);
                for ($i = 0; $i < $len; $i += $chunkSize) {
                    $end = $i + $chunkSize;
                    if ($end > $len) {
                        $end = $len;
                    }
                    // Find next closing tag to avoid splitting mid-tag
                    if ($end < $len) {
                        $nextClose = strpos($content, '>', $end);
                        if ($nextClose !== false && ($nextClose - $end) < 1000) {
                            $end = $nextClose + 1;
                        }
                    }
                    $chunk = substr($content, $i, $end - $i);
                    $mpdf->WriteHTML($chunk, \Mpdf\HTMLParserMode::HTML_BODY);
                }

                $filename = 'logs-reports-' . date('Y-m-d') . '.pdf';
                $mpdf->Output($filename, 'D');
                exit;

            case 'excel':
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="logs-reports-' . date('Y-m-d') . '.xls"');
                header('Cache-Control: max-age=0');
                echo $content;
                exit;

            case 'csv':
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename="logs-reports-' . date('Y-m-d') . '.csv"');
                $output = fopen('php://output', 'w');
                fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM

                // Write header row
                fputcsv($output, array_values($exportColumns));

                // Write data rows
                $counter = 1;
                foreach ($models as $model) {
                    $row = [$counter++];
                    foreach (array_slice($exportColumns, 1) as $attr => $label) {
                        $row[] = $model->$attr;
                    }
                    fputcsv($output, $row);
                }
                fclose($output);
                exit;

            default:
                throw new NotFoundHttpException('Invalid export format.');
        }
    }
}
