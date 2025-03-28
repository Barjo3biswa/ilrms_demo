<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            padding: 20px;
            text-align: center;
            color: white;
        }
        .header.success {
            background-color: #4CAF50;
        }
        .header.pending {
            background-color: #FF9800;
        }
        .header.aborted {
            background-color: #FF5722;
        }
        .header.failed {
            background-color: #F44336;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }
        .content p span {
            font-weight: bold;
        }
        .content .message {
            margin-top: 15px;
            font-style: italic;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button-container a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header 
            <?= $STATUS === 'Y' ? 'success' : 
               ($STATUS === 'P' ? 'pending' : 
               ($STATUS === 'A' ? 'aborted' : 'failed')); ?>">
            <h1>
                <?= $STATUS === 'Y' ? 'Transaction Successful' : 
                   ($STATUS === 'P' ? 'Transaction Pending' : 
                   ($STATUS === 'A' ? 'Transaction Aborted' : 'Transaction Failed')); ?>
            </h1>
        </div>
        <div class="content">
            <?php if ($STATUS === 'Y'): ?>
                <p><span>GRN Number:</span> <?= htmlspecialchars($GRN); ?></p>
                <p><span>Amount:</span> ₹<?= htmlspecialchars($AMOUNT); ?></p>
                <p><span>Payment Date:</span> <?= htmlspecialchars($PAYMENT_DATE); ?></p>
                <p>Your transaction was successful with the above details. Thank you for your payment!</p>
            <?php else: ?>
                <p>
                    <?= $STATUS === 'P' ? 'Your transaction is currently pending. Please check back later for updates.' : 
                       ($STATUS === 'A' ? 'Your transaction was aborted. Please try again if needed.' : 
                       'Your transaction failed. Please contact support for assistance.'); ?>
                </p>
            <?php endif; ?>            
        </div>
        <div class="footer">
            <p class="message">
                After initiating a payment transaction, you will need to log in again to continue.
            </p>
            <div class="button-container">
                <a href="<?= base_url(); ?>">
                    <i class="fas fa-user"></i> Go to Profile
                </a>
            </div>
        </div>
    </div>
</body>
</html>
