<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Pixel Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            padding: 40px 0;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .invoice-header {
            background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
            border-radius: 24px 24px 0 0;
            padding: 40px 50px;
            color: white;
            position: relative;
        }

        .logo-box {
            background: white;
            border-radius: 24px;
            padding: 30px;
            width: 180px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            left: 50px;
            top: 125px;
            box-shadow: 5px 5px 10px #e7e5e5;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #333;
        }

        .logo-pixel {
            color: #FDB714;
        }

        .company-info {
            margin-left: 220px;
            font-size: 14px;
            line-height: 1.8;
        }

        @media screen and (max-width: 480px) {
            .company-info {
                margin-left: 0px;
                font-size: 14px;
                line-height: 1.8;
            }
        }

        .company-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .invoice-title {
            position: absolute;
            right: 50px;
            top: 50px;
            text-align: right;
        }

        .invoice-title h1 {
            font-size: 42px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 2px;
        }

        .invoice-id {
            background: white;
            color: #4A90E2;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
            font-weight: 600;
        }

        .invoice-body {
            padding: 73px 50px 20px 50px;
        }

        .bill-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
            gap: 61px;
        }

        @media screen and (max-width: 480px) {
            .bill-section {
                display: block;
                justify-content: flex-end;
                margin-bottom: 40px;
                gap: 61px;
            }
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #666;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        /* .section-title::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            background-size: contain;
        } */
        /* .bill-to::before {
            content: '👤';
            font-size: 18px;
        }
        .date-section::before {
            content: '📅';
            font-size: 18px;
        } */
        .client-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .client-details {
            font-size: 14px;
            color: #666;
            line-height: 1.8;
        }

        .package-title {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }

        .table-responsive {
            margin-bottom: 30px;
        }

        .invoice-table {
            width: 100%;
            margin-bottom: 0;
        }

        .invoice-table thead th {
            background-color: #f8f9fa;
            border: none;
            font-weight: 700;
            color: #333;
            padding: 15px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .invoice-table tbody td {
            padding: 20px 15px;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 14px;
        }

        .invoice-table tbody tr:first-child td {
            border-top: none;
        }

        .addon-header {
            background-color: #f8f9fa;
            font-weight: 700;
            color: #333;
            padding: 12px 15px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .payment-summary-section {
            display: flex;
            gap: 30px;
            margin-top: 40px;
            background-color: #F1FBFF;
            border-radius: 15px;
        }

        @media screen and (max-width: 480px) {
            .payment-summary-section {
                display: block;
                gap: 30px;
                margin-top: 40px;
                background-color: #F1FBFF;
                border-radius: 15px;
            }
        }

        .payment-info {
            flex: 1;
            background: #F1FBFF;
            border-radius: 15px;
            padding: 25px;
        }

        .payment-info-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .payment-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .payment-detail-label {
            color: #666;
        }

        .payment-detail-value {
            color: #333;
            font-weight: 600;
        }

        .qr-box {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }

        .qr-code {

            background: #f0f0f0;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border: 1px solid #ddd;
        }

        .qr-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
        }

        .qr-subtitle {
            font-size: 12px;
            color: #666;
            text-align: left;
        }

        .note-box {
            background: #f8f9fa;
            border-left: 4px solid #4A90E2;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .note-title {
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .note-text {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
        }

        .price-summary {
            flex: 1;
            background: #F1FBFF;
            border-radius: 15px;
            padding: 25px;
        }

        .price-summary-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            font-size: 14px;
            border-bottom: 1px solid #e9ecef;
        }

        .price-row:last-child {
            border-bottom: none;
        }

        .price-label {
            color: #666;
        }

        .price-value {
            color: #333;
            font-weight: 600;
        }

        .discount-value {
            color: #28a745;
        }

        .total-row {

            margin: 15px -25px -25px;
            padding: 20px 25px;
            border-radius: 0 0 12px 12px;
        }

        .total-amount {
            font-size: 28px;
            font-weight: 700;
            color: #333;
        }

        .amount-words {
            margin-top: 10px;
            padding-top: 15px;
            /*border-top: 1px solid #e9ecef;*/
        }

        .amount-words-label {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }

        .amount-words-text {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .terms-section {
            background-color: #F1FBFF;
            text-align: center;
            padding: 23px 50px;
            border-radius: 15px;
        }

        .terms-text {
            font-size: 14px;
            color: #666;
        }

        .terms-link {
            color: #333;
            font-weight: 600;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            padding: 30px 50px 30px 50px;
            border-top: 1px solid #e9ecef;
        }

        .footer-notice {
            font-size: 16px;
            color: #999;
            font-style: italic;
            margin-bottom: 20px;
        }

        .footer-links {
            font-size: 14px;
            color: #666;
        }

        .footer-links a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header Section -->
        <div class="invoice-header">
            <div class="logo-box">
                <div>
                    <span class="logo-text"><span class="logo-pixel">P</span>IXEL</span>
                    <div style="font-size: 14px; color: #666; font-weight: 500; margin-top: -5px;">STUDIO</div>
                </div>
            </div>
            <div class="company-info">
                <div class="company-name">Pixel Studio</div>
                <div>GSTIN : 27AABCU9603R1ZM</div>
                <div>Pune, Maharashtra, India</div>
                <div>www.pixelstudio.com &nbsp;&nbsp;&nbsp; (91) 8541254785</div>
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <div class="invoice-id">Invoice ID: 000027</div>
            </div>
        </div>

        <!-- Body Section -->
        <div class="invoice-body">
            <!-- Bill To and Date Section -->
            <div class="bill-section">
                <div class="bill-to-section">
                    <div class="section-title bill-to">Bill To:</div>
                    <div class="client-name">Priya Sharma</div>
                    <div class="client-details">
                        Client ID : PIXSTM001<br>
                        GSTIN : 27AABCU9603R1ZM<br>
                        contact@priyasharma.com<br>
                        Pune, Maharashtra, India
                    </div>
                </div>
                <div class="date-section-wrapper" style="    margin-right: 15%;">
                    <div class="section-title date-section">Date:</div>
                    <div class="client-details">
                        <div style="margin-bottom: 8px;">
                            <span style="display: inline-block; width: 100px;">Invoice date:</span>
                            <strong>June 26, 2024</strong>
                        </div>
                        <div>
                            <span style="display: inline-block; width: 100px;">Due date:</span>
                            <strong>July 26, 2024</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Details -->
            <div class="package-title">Package Details</div>

            <!-- Main Package Table -->
            <div class="table-responsive">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 20%;">ITEM</th>
                            <th style="width: 40%;">DESCRIPTION</th>
                            <th style="width: 10%; text-align: center;">QTY</th>
                            <th style="width: 15%; text-align: right;">RATE</th>
                            <th style="width: 15%; text-align: right;">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Outdoor Shoot</td>
                            <td>Professional outdoor photography with edited images</td>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: right;">₹50,000</td>
                            <td style="text-align: right;">₹50,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add-ons Table -->
            <div class="table-responsive">
                <div class="addon-header">ADD-ONS / EXTRAS</div>
                <table class="invoice-table">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Edited Photos</td>
                            <td style="width: 40%;">10 professionally retouched images</td>
                            <td style="width: 10%; text-align: center;">1</td>
                            <td style="width: 15%; text-align: right;">₹35,000</td>
                            <td style="width: 15%; text-align: right;">₹35,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Payment Information and Price Summary -->
            <div class="payment-summary-section">
                <!-- Payment Information -->
                <div class="payment-info">
                    <div class="payment-info-title">Payment Information</div>
                    <div class="payment-detail">
                        <span class="payment-detail-label">Payment Method:</span>
                        <span class="payment-detail-value">UPI</span>
                    </div>
                    <div class="payment-detail">
                        <span class="payment-detail-label">Transaction ID:</span>
                        <span class="payment-detail-value">TXN202503151234456789</span>
                    </div>
                    <div class="payment-detail">
                        <span class="payment-detail-label">Payment Date:</span>
                        <span class="payment-detail-value">March 15, 2025, 10:30 AM</span>
                    </div>

                    <!-- QR Code -->
                    <div class="qr-box">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="qr-code">
                                    <svg viewBox="0 0 120 120">
                                        <rect width="120" height="120" fill="white" />
                                        <g fill="black">
                                            <rect x="10" y="10" width="30" height="30" />
                                            <rect x="80" y="10" width="30" height="30" />
                                            <rect x="10" y="80" width="30" height="30" />
                                            <rect x="50" y="10" width="10" height="10" />
                                            <rect x="50" y="30" width="10" height="10" />
                                            <rect x="70" y="30" width="10" height="10" />
                                            <rect x="50" y="50" width="10" height="10" />
                                            <rect x="70" y="50" width="10" height="10" />
                                            <rect x="90" y="50" width="10" height="10" />
                                            <rect x="30" y="70" width="10" height="10" />
                                            <rect x="50" y="70" width="10" height="10" />
                                            <rect x="70" y="70" width="10" height="10" />
                                            <rect x="90" y="70" width="10" height="10" />
                                            <rect x="50" y="90" width="10" height="10" />
                                            <rect x="70" y="90" width="10" height="10" />
                                            <rect x="90" y="90" width="10" height="10" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="qr-title">Scan to Pay</div>
                                <div class="qr-subtitle">Use any UPI app to complete payment</div>
                            </div>
                        </div>


                    </div>

                    <!-- Note -->
                    <div class="note-box">
                        <div class="note-title">NOTE</div>
                        <div class="note-text">
                            Thank you for choosing Pixel Studios for your photography services via Streammly. For any
                            assistance or service-related queries, please contact our support team through the Streammly
                            app.
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="price-summary">
                    <div class="price-summary-title">Price Summary</div>
                    <div class="price-row">
                        <span class="price-label">Sub Total</span>
                        <span class="price-value">₹ 85,000.00/-</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label discount-value">Discount (10%)</span>
                        <span class="price-value discount-value">- ₹ 1250.00/-</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">CGST (9%)</span>
                        <span class="price-value">₹ 120.00/-</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">SGST (9%)</span>
                        <span class="price-value">₹ 120.00/-</span>
                    </div>
                    <div class="total-row">
                        <div class="price-row">
                            <span class="price-label" style="font-weight: 600; font-size: 16px;">Total Amount</span>
                            <span class="total-amount">₹ 83,990.00/-</span>
                        </div>
                        <div class="amount-words">
                            <div class="amount-words-label">Total Amount ( In Words )</div>
                            <div class="amount-words-text">Eighty-Three Thousand Nine Hundred and Ninety Rupees Only
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="terms-section mt-3">
                <div class="terms-text">
                    By purchasing this package, you agree to our <a href="#" class="terms-link">Terms & Conditions</a>
                </div>
            </div>
        </div>

        <!-- Terms Section -->


        <!-- Footer -->
        <div class="footer">
            <div class="footer-notice">This is a system-generated invoice — no signature required</div>
            <div class="footer-links">
                <a href="mailto:support@streammly.com">support@streammly.com</a> &nbsp;&nbsp;•&nbsp;&nbsp; Copyright ©
                2025 Streammly
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>