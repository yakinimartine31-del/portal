<?php

namespace frontend\controllers;

use backend\models\AuditTrial;
use Yii;
use frontend\models\ContributionTrend;
use frontend\models\ContributionTrendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * ContributionTrendController implements the CRUD actions for ContributionTrend model.
 */
class ContributionTrendController extends Controller
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
                        'roles' => ['@'], // @ means authenticated users only
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
     * Lists all ContributionTrend models.
     * @return mixed
     */
    public function actionIndex()
    {
        // Check if user is logged in
        if (Yii::$app->user->isGuest || Yii::$app->user->identity === null) {
            return $this->redirect(['site/login']);
        }

        // Get current logged-in member FIRST
        $user_id = Yii::$app->user->identity->getId();
        $member = \frontend\models\Members::find()->where(['uid' => $user_id])->one();

        if (!$member) {
            throw new NotFoundHttpException('Member record not found.');
        }

        // Handle both array and object cases for member properties
        $member_sys_id = is_array($member) ? (isset($member['member_sys_id']) ? $member['member_sys_id'] : null) : $member->member_sys_id;
        $member_number = is_array($member) ? (isset($member['membership_number']) ? $member['membership_number'] : null) : $member->membership_number;

        // Create search model and set member_id filter FIRST
        $searchModel = new ContributionTrendSearch();
        $searchModel->member_id = $member_sys_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Set default sort to ascending (small year to high year)
        $dataProvider->sort->defaultOrder = [
            'ContributionYear' => SORT_ASC,
        ];

        // Fetch salary data from sys_contributions table
        // Key by year_month for lookup
        $salaryData = [];
        $allYearsWithSalary = []; // Store all years with salary data
        $lastYearSalary = 0;
        $lastMonthSalary = null;
        $lastMonthYear = null;
        $lastMonthNum = null;

        if ($member_number) {
            $salaryQuery = Yii::$app->db->createCommand("
                SELECT member_number, salary, cont_year, cont_month 
                FROM sys_contributions 
                WHERE member_number = :member_number
                ORDER BY cont_year DESC, cont_month DESC
            ");
            $salaryQuery->bindParam(':member_number', $member_number);
            $salaryRecords = $salaryQuery->queryAll();

            // Create a map of year_month => ALL salaries (store as array to keep all records)
            foreach ($salaryRecords as $record) {
                $key = $record['cont_year'] . '_' . str_pad($record['cont_month'], 2, '0', STR_PAD_LEFT);
                if (!isset($salaryData[$key])) {
                    $salaryData[$key] = [];
                }
                $salaryData[$key][] = $record['salary'];
                
                // Track all years with salary data
                if (!in_array($record['cont_year'], $allYearsWithSalary)) {
                    $allYearsWithSalary[] = $record['cont_year'];
                }
            }

            // Sort years in ascending order
            sort($allYearsWithSalary);

            // Calculate last year salary (most recent year with salary)
            $yearsWithSalary = [];
            foreach ($salaryRecords as $record) {
                $year = $record['cont_year'];
                if (!isset($yearsWithSalary[$year])) {
                    $yearsWithSalary[$year] = 0;
                }
                $yearsWithSalary[$year] += $record['salary'];
            }

            if (!empty($yearsWithSalary)) {
                krsort($yearsWithSalary);
                $lastYear = key($yearsWithSalary);
                $lastYearSalary = $yearsWithSalary[$lastYear];

                // Find last month with salary (most recent)
                if (!empty($salaryRecords)) {
                    $lastRecord = $salaryRecords[0]; // Already sorted DESC
                    $lastMonthYear = $lastRecord['cont_year'];
                    $lastMonthNum = $lastRecord['cont_month'];
                    $lastMonthKey = $lastMonthYear . '_' . str_pad($lastMonthNum, 2, '0', STR_PAD_LEFT);
                    $lastMonthSalary = isset($salaryData[$lastMonthKey]) ? $salaryData[$lastMonthKey] : null;
                }
            }
        }

        // Create year filter array
        $yearFilter = [];
        foreach ($allYearsWithSalary as $year) {
            $yearFilter[$year] = $year;
        }

        try {
            $audit = new AuditTrial();
            $audit->items = 'View Contribution trend in member portal';
            $audit->module = 'Contribution Trend';
            $audit->action = 'list view';
            $audit->new = '';
            $audit->category = 2;
            $audit->old = '';
            $audit->maker = Yii::$app->user->identity->getId();
            $audit->maker_time = date('Y-m-d H:i:s');
            $audit->save(false);
        } catch (\Exception $e) {
            Yii::warning('Failed to save audit trail: ' . $e->getMessage());
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'salaryData' => $salaryData,
            'lastYearSalary' => $lastYearSalary,
            'lastMonthSalary' => $lastMonthSalary,
            'lastMonthYear' => $lastMonthYear,
            'lastMonthNum' => $lastMonthNum,
            'allYearsWithSalary' => $allYearsWithSalary,
            'yearFilter' => $yearFilter,
        ]);
    }

    /**
     * Export action for contribution trend
     */
    public function actionExport($type = 'pdf')
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity === null) {
            return $this->redirect(['site/login']);
        }

        // Get current logged-in member
        $user_id = Yii::$app->user->identity->getId();
        $member = \frontend\models\Members::find()->where(['uid' => $user_id])->one();

        if (!$member) {
            throw new NotFoundHttpException('Member record not found.');
        }

        $memberName = $member->full_names;
        $memberNumber = $member->membership_number;

        // Get contribution trend data
        $searchModel = new ContributionTrendSearch();
        $searchModel->member_id = $member->member_sys_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        $models = $dataProvider->getModels();

        // Sort models by year in descending order (newest first)
        usort($models, function($a, $b) {
            if ($a->ContributionYear == $b->ContributionYear) {
                return 0;
            }
            return ($a->ContributionYear < $b->ContributionYear) ? 1 : -1;
        });

        // Calculate totals
        $totalMonths = 0;
        $totalContribution = 0;

        foreach ($models as $model) {
            $monthlyFields = ['JANUARYC', 'FEBRUARYC', 'MARCHC', 'APRILC', 'MAYC', 'JUNEC',
                'JULYC', 'AUGUSTC', 'SEPTEMBERC', 'OCTOBERC', 'NOVEMBERC', 'DECEMBERC'];

            foreach ($monthlyFields as $field) {
                if ($model->$field > 0) {
                    $totalMonths++;
                    $totalContribution += $model->$field;
                }
            }
        }

        // Fetch salary data from sys_contributions table for export
        $salaryData = [];
        if ($memberNumber) {
            $salaryQuery = Yii::$app->db->createCommand("
                SELECT member_number, salary, cont_year, cont_month 
                FROM sys_contributions 
                WHERE member_number = :member_number
                ORDER BY cont_year DESC, cont_month DESC
            ");
            $salaryQuery->bindParam(':member_number', $memberNumber);
            $salaryRecords = $salaryQuery->queryAll();

            // Create a map of year_month => ALL salaries
            foreach ($salaryRecords as $record) {
                $key = $record['cont_year'] . '_' . str_pad($record['cont_month'], 2, '0', STR_PAD_LEFT);
                if (!isset($salaryData[$key])) {
                    $salaryData[$key] = [];
                }
                $salaryData[$key][] = $record['salary'];
            }
        }

        // Helper function to get all salaries for a month
        $getAllSalaries = function($year, $month) use ($salaryData) {
            $key = $year . '_' . str_pad($month, 2, '0', STR_PAD_LEFT);
            if (isset($salaryData[$key]) && is_array($salaryData[$key]) && count($salaryData[$key]) > 0) {
                $formattedSalaries = array_map(function($s) {
                    return number_format((float)$s, 2);
                }, $salaryData[$key]);
                return implode(', ', $formattedSalaries);
            }
            return '-';
        };

        $exportDate = date('Y-m-d H:i:s');
        $filename = "ZSSF_Contribution_Statement_{$memberNumber}_" . date('Y-m-d');

        // Audit trail for export
        $audit = new AuditTrial();
        $audit->items = 'Export Contribution trend';
        $audit->module = 'Contribution Trend';
        $audit->action = 'export';
        $audit->new = $type . ' format';
        $audit->category = 2;
        $audit->old = '';
        $audit->maker = Yii::$app->user->identity->getId();
        $audit->maker_time = date('Y-m-d H:i:s');
        $audit->save(false);

        switch (strtolower($type)) {
            case 'pdf':
                return $this->exportPdf($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData, $getAllSalaries);

            case 'excel':
                return $this->exportExcel($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData, $getAllSalaries);

            case 'csv':
                return $this->exportCsv($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData, $getAllSalaries);

            default:
                Yii::$app->session->setFlash('error', 'Invalid export format requested.');
                return $this->redirect(['index']);
        }
    }

    /**
     * PDF Export
     */
    private function exportPdf($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData = [], $getAllSalaries = null)
    {
        // Get absolute path for logo
        $logoPath = Yii::getAlias('@webroot') . '/images/pdfzssflogo.png';
        $logoBase64 = null;

        // Convert logo to base64 if exists
        if (file_exists($logoPath)) {
            $logoBase64 = base64_encode(file_get_contents($logoPath));
        }

        $content = $this->renderPartial('_pdf_contribution', [
            'models' => $models,
            'memberName' => $memberName,
            'memberNumber' => $memberNumber,
            'exportDate' => $exportDate,
            'totalMonthsContributed' => $totalMonths,
            'totalContribution' => $totalContribution,
            'logoBase64' => $logoBase64,
            'salaryData' => $salaryData,
            'getAllSalaries' => $getAllSalaries,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_DOWNLOAD,
            'filename' => $filename . '.pdf',
            'content' => $content,
            'options' => ['title' => 'ZSSF Contribution Statement - ' . $memberName],
            'methods' => [
                'SetHeader' => false,
                'SetFooter' => false,
            ],
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 15,
            'marginBottom' => 15,
            'marginHeader' => 5,
            'marginFooter' => 5,
            'cssInline' => '
                body { font-family: Arial, sans-serif; font-size: 9pt; color: #000; }
                table { border-collapse: collapse; }
                th { background-color: #e0e0e0; font-weight: bold; }
                .amount { font-family: "Courier New", monospace; text-align: right; }
                .year { font-weight: bold; }
            '
        ]);

        return $pdf->render();
    }

    /**
     * Excel Export
     */
    private function exportExcel($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData = [], $getAllSalaries = null)
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');

        echo '<html>';
        echo '<head><meta charset="UTF-8"></head>';
        echo '<body style="font-family: Arial, sans-serif; font-size: 10px;">';

        // Header Section
        echo '<div style="text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 15px;">';
        echo '<div style="font-size: 18px; font-weight: bold;">ZANZIBAR SOCIAL SECURITY FUND</div>';
        echo '<div style="font-size: 14px; font-weight: bold;">Contribution Information Statement</div>';
        echo '</div>';

        // Member Info
        echo '<div style="margin-bottom: 10px; padding: 5px; background-color: #f0f0f0;">';
        echo '<strong>Member:</strong> ' . htmlspecialchars($memberName);
        echo '</div>';

        // Summary Section
        echo '<div style="margin-bottom: 15px; padding: 8px; background-color: #f8f8f8; border: 1px solid #ddd;">';
        echo '<table style="width: 100%; border-collapse: collapse;">';
        echo '<tr>';
        echo '<td style="padding: 3px; font-weight: bold; width: 150px;">Months Contributed:</td>';
        echo '<td style="padding: 3px;">' . $totalMonths . '</td>';
        echo '<td style="padding: 3px; font-weight: bold; width: 150px;">Total Contribution:</td>';
        echo '<td style="padding: 3px; font-family: Courier New; text-align: right;">' . number_format($totalContribution, 2) . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';

        // Salary and Contribution Data Table with separate columns
        echo '<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-bottom: 20px;">';

        // Table Headers - Salary and Contribution columns
        echo '<tr style="background:#4cb6de;color:#fff;font-weight:bold;">';
        echo '<th style="padding:4px;border:1px solid #000;text-align:center;width:25px;">#</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:left;width:50px;">Year</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jan Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jan Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Feb Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Feb Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Mar Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Mar Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Apr Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Apr Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">May Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">May Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jun Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jun Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jul Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Jul Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Aug Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Aug Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Sep Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Sep Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Oct Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Oct Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Nov Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Nov Cont.</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Dec Salary</th>';
        echo '<th style="padding:4px;border:1px solid #000;text-align:right;width:80px;">Dec Cont.</th>';
        echo '</tr>';

        // Data Rows
        $counter = 1;
        foreach ($models as $model) {
            $year = $model->ContributionYear;
            echo '<tr>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:center;font-weight:bold;">' . $counter++ . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;font-weight:bold;">' . $year . '</td>';
            
            // January
            $janSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 1) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $janSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->JANUARYC, 2) . '</td>';
            
            // February
            $febSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 2) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $febSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->FEBRUARYC, 2) . '</td>';
            
            // March
            $marSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 3) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $marSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->MARCHC, 2) . '</td>';
            
            // April
            $aprSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 4) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $aprSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->APRILC, 2) . '</td>';
            
            // May
            $maySalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 5) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $maySalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->MAYC, 2) . '</td>';
            
            // June
            $junSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 6) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $junSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->JUNEC, 2) . '</td>';
            
            // July
            $julSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 7) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $julSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->JULYC, 2) . '</td>';
            
            // August
            $augSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 8) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $augSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->AUGUSTC, 2) . '</td>';
            
            // September
            $sepSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 9) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $sepSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->SEPTEMBERC, 2) . '</td>';
            
            // October
            $octSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 10) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $octSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->OCTOBERC, 2) . '</td>';
            
            // November
            $novSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 11) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $novSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->NOVEMBERC, 2) . '</td>';
            
            // December
            $decSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 12) : '-';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . $decSalary . '</td>';
            echo '<td style="padding:4px;border:1px solid #000;text-align:right;font-family:Courier New;">' . number_format($model->DECEMBERC, 2) . '</td>';
            echo '</tr>';
        }

        echo '</table>';

        // Footer
        echo '<div style="text-align: center; margin-top: 20px; padding-top: 5px; border-top: 1px solid #000; font-size: 8px; color: #666;">';
        echo '<div>ZANZIBAR SOCIAL SECURITY FUND | P.O. Box 117, Zanzibar</div>';
        echo '<div>| Generated: ' . $exportDate . '</div>';
        echo '<div>Page 1 of 1</div>';
        echo '</div>';

        echo '</body></html>';
        exit;
    }

    /**
     * CSV Export
     */
    private function exportCsv($models, $filename, $memberName, $memberNumber, $exportDate, $totalMonths, $totalContribution, $salaryData = [], $getAllSalaries = null)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM

        // Header
        fputcsv($output, ['ZANZIBAR SOCIAL SECURITY FUND']);
        fputcsv($output, ['Contribution Information Statement']);
        fputcsv($output, ['']);
        fputcsv($output, ['Member:', $memberName]);
        fputcsv($output, ['Months Contributed:', $totalMonths]);
        fputcsv($output, ['Total Contribution:', number_format($totalContribution, 2)]);
        fputcsv($output, ['']);

        // Table Headers with Salary and Contribution columns
        fputcsv($output, [
            '#', 'Year', 
            'Jan Salary', 'Jan Cont.',
            'Feb Salary', 'Feb Cont.',
            'Mar Salary', 'Mar Cont.',
            'Apr Salary', 'Apr Cont.',
            'May Salary', 'May Cont.',
            'Jun Salary', 'Jun Cont.',
            'Jul Salary', 'Jul Cont.',
            'Aug Salary', 'Aug Cont.',
            'Sep Salary', 'Sep Cont.',
            'Oct Salary', 'Oct Cont.',
            'Nov Salary', 'Nov Cont.',
            'Dec Salary', 'Dec Cont.'
        ]);

        // Data Rows
        $counter = 1;
        foreach ($models as $model) {
            $year = $model->ContributionYear;
            
            $janSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 1) : '-';
            $febSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 2) : '-';
            $marSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 3) : '-';
            $aprSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 4) : '-';
            $maySalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 5) : '-';
            $junSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 6) : '-';
            $julSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 7) : '-';
            $augSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 8) : '-';
            $sepSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 9) : '-';
            $octSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 10) : '-';
            $novSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 11) : '-';
            $decSalary = ($getAllSalaries !== null) ? $getAllSalaries($year, 12) : '-';
            
            fputcsv($output, [
                $counter++,
                $year,
                $janSalary, number_format($model->JANUARYC, 2),
                $febSalary, number_format($model->FEBRUARYC, 2),
                $marSalary, number_format($model->MARCHC, 2),
                $aprSalary, number_format($model->APRILC, 2),
                $maySalary, number_format($model->MAYC, 2),
                $junSalary, number_format($model->JUNEC, 2),
                $julSalary, number_format($model->JULYC, 2),
                $augSalary, number_format($model->AUGUSTC, 2),
                $sepSalary, number_format($model->SEPTEMBERC, 2),
                $octSalary, number_format($model->OCTOBERC, 2),
                $novSalary, number_format($model->NOVEMBERC, 2),
                $decSalary, number_format($model->DECEMBERC, 2)
            ]);
        }

        fputcsv($output, ['']);
        fputcsv($output, ['ZANZIBAR SOCIAL SECURITY FUND | P.O. Box 117, Zanzibar']);
        fputcsv($output, ['Generated:', $exportDate]);
        fputcsv($output, ['Page 1 of 1']);

        fclose($output);
        exit;
    }

    /**
     * Displays a single ContributionTrend model.
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
     * Creates a new ContributionTrend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContributionTrend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContributionTrend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContributionTrend model.
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
     * Finds the ContributionTrend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContributionTrend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContributionTrend::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}