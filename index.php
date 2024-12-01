<?php
include_once './class/compute.class.php';

$amount=0;
$loanDetails=null;
if(isset($_GET['submit'])){
    $amount = filter_var($_GET['amount'], FILTER_VALIDATE_INT);

    $loan = new Compute($amount);
    $loan->computeInstallments();
    $loanDetails = $loan->getLoanDetails();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <h1>Loan Calculator</h1>
    </header>
    <div class="main-container">
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <label for="amount">Input the amount you want to borrow</label>
            <div class="input-container">
                <input type="number" step="1000" name="amount" value="<?=$amount?>">
                <input type="submit" value="Calculate" class="btn" name="submit">
            </div>

            <?php if(isset($loanDetails)): ?>

            <div class="table-container">
                <h2>Below are your estimated monthly installments:</h2>

                <div class="loan-table">
                    <div class="loan-table-header">
                        <div class="row1">
                            <div class="amount-title">Loan Amount:</div>
                            <div class="amount-value"><?=number_format($amount)?></div>
                        </div>
                        <div class="row2">
                            Term
                        </div>
                        <div class="row2">
                            Monthly Installment
                        </div>
                    </div>
                    <div class="loan-table-body">
                        <div class="loan-table-term">
                            <?php foreach($loanDetails as $detail): ?>
                            <div><?=$detail['term']?> Months</div>
                            <?php endforeach; ?>
                        </div>
                        <div class="loan-table-installments">
                        <?php foreach($loanDetails as $detail): ?>
                            <div><?=number_format($detail['value'])?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="notice">
                A monthly add-on rate of 0.5% is used for this calculation. Final amounts may change depending on the rates in effect when you apply.
                </div>
                <input type="submit" class="btn btn-center" value="Request Now" name="apply">
            </div>

            <?php endif; ?>
        </form>
    </div>
</body>
</html>