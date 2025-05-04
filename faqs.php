<!DOCTYPE html>
<html lang="en">


<?php include 'headfoot/header.php'; ?>



        <!-- Floating Learn Icon (Left) -->
        <div class="floating-icon learn" onclick="window.location.href='learn.php';">
            📚
            <span class="icon-label">Learn</span>
        </div>



    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">FAQS</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">FAQS</li>
                </ol>
            </nav>
        </div>
    </div>
       

<!-- FAQ Section Start -->
<div class="container-fluid my-5 py-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 padd">
            <div class="list-group" style="top: 20px;">
                <button class="list-group-item list-group-item-action active" id="kycTab">
                    <i class="fas fa-id-card-alt me-4"></i><b>KYC Related</b>
                </button>
                <button class="list-group-item list-group-item-action" id="tradingTab">
                    <i class="fas fa-chart-line mt-3 me-4"></i><b>Trading Related</b>
                </button>
                <button class="list-group-item list-group-item-action" id="settlementTab">
                    <i class="fas fa-cogs mt-3 me-4"></i><b>Settlement Related</b>
                </button>
                <button class="list-group-item list-group-item-action" id="accountTab">
                    <i class="fas fa-user-circle mt-3 me-4"></i><b>Account Related</b>
                </button>
            </div>
        </div>

        <!-- FAQ Content Section -->
        <div class="col-md-9">
            <!-- KYC Section -->
            <div id="kycSection" class="section-content">
                <h2 class="text-center text-dark mb-4">KYC Related Questions</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q1">
                                <span>1. What are the documents required for submitting KYC form?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q1" class="collapse">
                                <ul class="list-unstyled ps-3 text-dark">
                                    <li>Photocopy of citizenship</li>
                                    <li>Photocopy of DEMAT confirmation letter</li>
                                    <li>One PP size Photo</li>
                                    <li>Photocopy of PAN card for transactions above 5 lakhs</li>
                                    <li>Photocopy of ID card</li>
                                    <li>Photo and citizenship copy of guardian (in case of minor)</li>
                                    <li>Bank Cheque book copy</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q2">
                                <span>2. How do we open trading accounts via online?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q2" class="collapse">
                                <ol class="ps-3 text-dark">
                                    <li>Visit our website <a href="https://trishakti.com.np/" class="text-warning" target="_blank">https://trishakti.com.np/</a></li>
                                    <li>Click on Open Account</li>
                                    <li>Fill the form and attach document in PDF format</li>
                                </ol>
                                <p><strong class="text-dark">Note:</strong> Account will be activated after submission of hard copy on Trishakti Securities Public Limited within 2 weeks.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q3">
                                <span>3. How to convert my offline broker trading status to online?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q3" class="collapse">
                                <p class="text-dark">Download TMS Online Agreement Form – Go to our website, click Resources (Downloads) and download the form. Fill the agreement form and submit it to us physically or through mail.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q4">
                                <span>4. What is the difference between a trading account and DEMAT account?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q4" class="collapse">
                                <p class="text-dark">A trading account is opened in the broker's office to trade in the secondary market, while a DEMAT account is opened to keep a record of shares.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q5">
                                <span>5. Can we open multiple trading accounts from different brokers?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q5" class="collapse">
                                <p class="text-dark">No, you cannot open multiple trading accounts in different broker offices with the same DEMAT account (i.e., same BOID).</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q6">
                                <span>6. Is collateral needed in trading?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q6" class="collapse">
                                <p class="text-dark">If you are an offline trader, collateral is not needed. But if you are an online trader, you should deposit 25% of total trading as collateral, which is refundable.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q8">
                                <span>7. Why is Reference necessary?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q8" class="collapse">
                                <p class="text-dark">Reference is necessary for contact verification and emergency contact needs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trading Section -->
            <div id="tradingSection" class="section-content" style="display: none;">
                <h2 class="text-center text-dark mb-4">Trading Related Questions</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q12">
                                <span>1. When will I receive the money in my bank account after selling shares?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q12" class="collapse">
                                <p class="text-dark">The amount will be settled in your bank account within 4 working days after selling your shares.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Section -->
            <div id="accountSection" class="section-content" style="display: none;">
                <h2 class="text-center text-dark mb-4">Account Related Questions</h2>
                <div class="row">

            <!-- FAQ Item 1 -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm rounded border p-4">
                    <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q7">
                        <span>1. How to transfer my fund in broker accounts through Connect IPS?</span>
                        <i class="fas fa-chevron-down primary"></i>
                    </h5>
                    <div id="q7" class="collapse">
                        <ol class="ps-3 text-dark">
                            <li>Go to the Connect IPS dashboard</li>
                            <li>Tab to Financial Institution</li>
                            <li>Tab Capital Market</li>
                            <li>Tab Brokers Payments</li>
                            <li>Fill required fields</li>
                            <li>Inform us about your payments</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm rounded border p-4">
                    <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q10">
                        <span>2. When do I receive my payment after selling shares?</span>
                        <i class="fas fa-chevron-down primary"></i>
                    </h5>
                    <div id="q10" class="collapse">
                        <p class="text-dark">&#8620; You will receive your payment after four working days from the actual trading. In case of book closure, it may delay further four more days (i.e., the 9th working day).</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm rounded border p-4">
                    <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q11">
                        <span>3. How can we make payment for offline users?</span>
                        <i class="fas fa-chevron-down primary"></i>
                    </h5>
                    <div id="q11" class="collapse">
                        <p class="text-dark">&#8620; You can make payment through:</p>
                        <ul class="ps-3 text-dark">
                            <li>Connect IPS</li>
                            <li>Global IME Bank Ltd, Kamaladi Branch</li>
                            <li>A/C No: 123456789</li>
                            <li>Pay directly to our office</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm rounded border p-4">
                    <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q13">
                        <span>4. When can I withdraw the fund from my trading account?</span>
                        <i class="fas fa-chevron-down primary"></i>
                    </h5>
                    <div id="q13" class="collapse">
                        <p class="text-dark">&#8620; You can withdraw funds after selling your shares; however, ensure that the transaction settlement is complete.</p>
                    </div>
                </div>
            </div>

                </div>
            </div>

            <!-- Settlement Section -->
            <div id="settlementSection" class="section-content" style="display: none;">
                <h2 class="text-center text-dark mb-4">Settlement Related Questions</h2>
                <div class="row">
                    <!-- FAQ Item 1 -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q9">
                                <span>1. In how many days are my shares transferred?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q9" class="collapse">
                                <p class="text-dark">Transfer your shares within 1 day of trading by the following steps:</p>
                                <ol class="ps-3 text-dark">
                                    <li>Open your Mero share account</li>
                                    <li>Click My EDIS</li>
                                </ol>
                                <p><strong class="text-dark">Note:</strong> You have to calculate WACC and MY HOLDINGS before doing EDIS by clicking My purchase source in Mero share.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm rounded border p-4">
                            <h5 class="d-flex justify-content-between align-items-center text-dark" data-bs-toggle="collapse" data-bs-target="#q10">
                                <span>2. When do I receive my payment after selling shares?</span>
                                <i class="fas fa-chevron-down primary"></i>
                            </h5>
                            <div id="q10" class="collapse">
                                <p class="text-dark">The payment for shares sold will be credited to your account after 3 to 4 working days.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ Section End -->


<?php include 'headfoot/footer.php'; ?>

    <!-- JavaScript to Handle Tab Clicks -->
    <script>
        document.getElementById('kycTab').addEventListener('click', function() {
            document.getElementById('kycSection').style.display = 'block';
            document.getElementById('tradingSection').style.display = 'none';
            document.getElementById('settlementSection').style.display = 'none';
            document.getElementById('accountSection').style.display = 'none';
            // Add active class to KYC tab and remove from others
            this.classList.add('active');
            document.getElementById('tradingTab').classList.remove('active');
            document.getElementById('settlementTab').classList.remove('active');
            document.getElementById('accountTab').classList.remove('active');
        });

        document.getElementById('tradingTab').addEventListener('click', function() {
            document.getElementById('kycSection').style.display = 'none';
            document.getElementById('tradingSection').style.display = 'block';
            document.getElementById('settlementSection').style.display = 'none';
            document.getElementById('accountSection').style.display = 'none';
            // Add active class to Trading tab and remove from others
            this.classList.add('active');
            document.getElementById('kycTab').classList.remove('active');
            document.getElementById('settlementTab').classList.remove('active');
            document.getElementById('accountTab').classList.remove('active');
        });

        document.getElementById('settlementTab').addEventListener('click', function() {
            document.getElementById('kycSection').style.display = 'none';
            document.getElementById('tradingSection').style.display = 'none';
            document.getElementById('settlementSection').style.display = 'block';
            document.getElementById('accountSection').style.display = 'none';
            // Add active class to Settlement tab and remove from others
            this.classList.add('active');
            document.getElementById('kycTab').classList.remove('active');
            document.getElementById('tradingTab').classList.remove('active');
            document.getElementById('accountTab').classList.remove('active');
        });

        document.getElementById('accountTab').addEventListener('click', function() {
            document.getElementById('kycSection').style.display = 'none';
            document.getElementById('tradingSection').style.display = 'none';
            document.getElementById('settlementSection').style.display = 'none';
            document.getElementById('accountSection').style.display = 'block';
            // Add active class to Settlement tab and remove from others
            this.classList.add('active');
            document.getElementById('kycTab').classList.remove('active');
            document.getElementById('tradingTab').classList.remove('active');
            document.getElementById('settlementTab').classList.remove('active');
            
        });
    </script>



</body>

</html>
