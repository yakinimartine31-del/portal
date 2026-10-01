<?php
// views/contribution-trend/_pdf_contribution.php
?>
<!DOCTYPE html>
<html>
<head>
   
    
</head>
<body style="font-family: Arial, sans-serif; font-size: 10px; margin: 0; padding: 0;">

<!-- Header Section with Logo on Left -->
<div style="width: 100%; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px;">
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <td style="width: 80px; vertical-align: top; padding-right: 10px;">
                <?php if ($logoBase64): ?>
                    <img src="data:image/png;base64,<?= $logoBase64 ?>" alt="ZSSF Logo" style="height: 70px; width: auto;">
                <?php else: ?>
                    <img src="../images/pdfzssflogo.png" alt="ZSSF Logo" style="height: 70px; width: auto;">
                <?php endif; ?>
            </td>
            <td style="vertical-align: top;">
                <div style="font-size: 16px; font-weight: bold; color: #000; margin-bottom: 5px;">
                    ZANZIBAR SOCIAL SECURITY FUND
                </div>
                <div style="font-size: 14px; font-weight: bold; color: #000; margin-bottom: 5px;">
                    Contribution Information Statement
                </div>
                <div style="font-size: 11px; color: #333;">
                    Member statement for <?= htmlspecialchars($memberName) ?>
                </div>
                <div style="font-size: 11px; color: #333;">
                    as of <?= date('d/m/Y', strtotime($exportDate)) ?>
                </div>
                <div style="font-size: 11px; color: #333;">
                    Member number: <?= htmlspecialchars($memberNumber) ?>
                </div>
                <div style="font-size: 11px; color: #333; margin-top: 5px;">
                    Working at ZANZIBAR SOCIAL SECURITY FUND
                </div>
            </td>
        </tr>
    </table>
</div>

<!-- Main Contribution Table -->
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000; font-size: 9px; margin-bottom: 20px;">
    <thead>
        <tr style="background-color: #e0e0e0;">
            <th style="border: 1px solid #000; padding: 6px; text-align: center; width: 30px; font-weight: bold;">#</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: left; width: 50px; font-weight: bold;">Year</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">January</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">February</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">March</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">April</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">May</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">June</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">July</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">August</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">September</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">October</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">November</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">December</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Sort models by year in descending order (newest first)
        usort($models, function($a, $b) {
            return $b->ContributionYear <=> $a->ContributionYear;
        });
        
        $rowNumber = 1;
        foreach ($models as $index => $model): 
        ?>
        <tr>
            <td style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;"><?= $rowNumber ?></td>
            <td style="border: 1px solid #000; padding: 5px; text-align: left; font-weight: bold;"><?= $model->ContributionYear ?></td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->JANUARYC > 0 ? number_format($model->JANUARYC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->FEBRUARYC > 0 ? number_format($model->FEBRUARYC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->MARCHC > 0 ? number_format($model->MARCHC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->APRILC > 0 ? number_format($model->APRILC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->MAYC > 0 ? number_format($model->MAYC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->JUNEC > 0 ? number_format($model->JUNEC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->JULYC > 0 ? number_format($model->JULYC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->AUGUSTC > 0 ? number_format($model->AUGUSTC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->SEPTEMBERC > 0 ? number_format($model->SEPTEMBERC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->OCTOBERC > 0 ? number_format($model->OCTOBERC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->NOVEMBERC > 0 ? number_format($model->NOVEMBERC, 2) : '0.00' ?>
            </td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">
                <?= $model->DECEMBERC > 0 ? number_format($model->DECEMBERC, 2) : '0.00' ?>
            </td>
        </tr>
        <?php 
        $rowNumber++;
        endforeach; 
        ?>
    </tbody>
</table>

<!-- Contribution Trend Section -->
<div style="font-size: 12px; font-weight: bold; margin: 20px 0 10px 0; color: #000; padding-bottom: 5px; border-bottom: 1px solid #ccc;">
    ZSSF Contribution 
</div>

<!-- Trend Table -->
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000; font-size: 9px; margin-bottom: 30px;">
    <thead>
        <tr style="background-color: #e0e0e0;">
            <th style="border: 1px solid #000; padding: 6px; text-align: center; width: 30px; font-weight: bold;">#</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: left; width: 50px; font-weight: bold;">Year</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">January</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">February</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">March</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">April</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">May</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">June</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">July</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">August</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">September</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">October</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">November</th>
            <th style="border: 1px solid #000; padding: 6px; text-align: right; width: 85px; font-weight: bold;">December</th>
        </tr>
    </thead>
    <tbody>
        <!-- Trend data rows -->
        <tr>
            <td style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;">23</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: left; font-weight: bold;">2004</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">6,708.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;">24</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: left; font-weight: bold;">2003</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
            <td style="border: 1px solid #000; padding: 5px; text-align: right; font-family: 'Courier New', monospace; white-space: nowrap;">0.00</td>
        </tr>
    </tbody>
</table>

<!-- Summary Section at the end -->
<div style="margin: 30px 0 20px 0; padding: 15px; background-color: #f8f8f8; border: 1px solid #ccc; border-radius: 3px;">
    <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px; font-weight: bold; width: 40%;">Total Months Contributed:</td>
            <td style="padding: 8px; font-weight: bold; font-family: 'Courier New', monospace; text-align: right; width: 60%;">
                <?= $totalMonthsContributed ?> months
            </td>
        </tr>
        <tr>
            <td style="padding: 8px; font-weight: bold;">Total Contribution Amount:</td>
            <td style="padding: 8px; font-weight: bold; font-family: 'Courier New', monospace; text-align: right;">
                <?= number_format($totalContribution, 2) ?>
            </td>
        </tr>
    </table>
</div>


    <div style="margin: 3px 0; font-weight: bold;">
        Page 1 of 2
    </div>
</div>

</body>
</html>