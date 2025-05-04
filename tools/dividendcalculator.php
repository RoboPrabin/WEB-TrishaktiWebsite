<!DOCTYPE html>
<html lang="en">

<?php include '../headfoot/header1.php'; ?>

  <!-- Page Header -->
  <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
      <h1 class="display-4 mb-4 animated slideInDown">Dividend Calculator</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

          <li class="breadcrumb-item active" aria-current="page">Dividend Calculator</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-5">
    <h2 class="mb-5 text-center fw-bold text-primary">📊 Dividend Calculator</h2>

    <div class="row g-4 align-items-start">

      <!-- Calculator Form -->
      <div class="col-lg-6">
        <div class="card shadow-sm p-4 h-100 border-light">
          <h4 class="mb-3 text-dark">Enter Details</h4>

          <div class="mb-3">
            <label for="parvalue" class="form-label">Par Value (Rs.)</label>
            <input type="number" class="form-control" id="parvalue" placeholder="Par value">
          </div>
          
          <div class="mb-3">
            <label for="ShareQuantity" class="form-label">Share Quantity</label>
            <input type="number" class="form-control" id="ShareQuantity" placeholder="No. of shares">
          </div>
          
          <div class="mb-3">
            <label for="percentbonusshare" class="form-label">Bonus Share (%)</label>
            <input type="number" class="form-control" id="percentbonusshare" placeholder="Bonus %">
          </div>
          
          <div class="mb-3">
            <label for="percentcashdevident" class="form-label">Cash Dividend (%)</label>
            <input type="number" class="form-control" id="percentcashdevident" placeholder="Dividend %">
          </div>          

          <div class="text-danger mb-3 fw-medium" id="errorSpan"></div>

          <div class="d-flex justify-content-between">
            <button id="calculate" class="btn btn-primary w-50 me-2"><i class="fas fa-calculator me-2"></i>Calculate</button>
            <button id="clearFields" class="btn btn-outline-secondary w-50"><i class="fas fa-redo-alt me-2"></i>Clear</button>
          </div>
        </div>
      </div>

      <!-- Result Display -->
      <div class="col-lg-6">
        <div id="calculate_value" class="card shadow-sm p-4 border-light">
          <h4 class="mb-3 text-dark">Calculation Details</h4>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span>Cash Dividend</span>
              <strong id="cash">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Bonus Shares</span>
              <strong id="bonushare">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Tax on Cash Dividend</span>
              <span id="taxOnCashDevident">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Tax on Bonus Shares</span>
              <span id="taxonBonusShare">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <span>Total Cash Amount</span>
              <span id="totalCashAmount">0</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>

    <!-- Copyright Start -->
    <div id="stickyFooterwrap" class="container-fluid facts py-sm-3">
      <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 text-white">
              &copy; <a class="border-bottom text-white" href="#">Trishakti Securities</a>, All Right Reserved.
          </div>
          <div class="col-md-6 text-center text-md-end text-white">
              Designed By <a class="border-bottom text-white" href="#">Aayush Pokharel</a>
          </div>
      </div>
  </div>    
  <!-- Copyright End -->



  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-lg-square rounded-circle back-to-top up-arrow visually-hidden"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/wow/wow.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/waypoints/waypoints.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/counterup/counterup.min.js"></script>

  <script>
    // CALCULATE BUTTON FUNCTIONALITY
document.getElementById("calculate").addEventListener("click", function () {
  const parValue = parseFloat(document.getElementById('parvalue').value);
  const shareQuantity = parseInt(document.getElementById('ShareQuantity').value);
  const percentBonusShare = parseFloat(document.getElementById('percentbonusshare').value);
  const percentCashDividend = parseFloat(document.getElementById('percentcashdevident').value);
  const errorSpan = document.getElementById('errorSpan');

  // Input validation
  if (isNaN(parValue) || isNaN(shareQuantity) || isNaN(percentBonusShare) || isNaN(percentCashDividend)) {
    errorSpan.textContent = 'Please enter all values.';
    return;
  }

  if (parValue <= 0 || shareQuantity <= 0 || percentBonusShare < 0 || percentBonusShare > 100 || percentCashDividend < 0 || percentCashDividend > 100) {
    errorSpan.textContent = 'Please enter valid inputs.';
    return;
  }

  errorSpan.textContent = ''; // Clear error message

  // CALCULATIONS
  const totalCash = parValue * shareQuantity;
  const cash = totalCash * (percentCashDividend / 100);
  const bonusShare = shareQuantity * (percentBonusShare / 100);
  const taxOnCashDividend = 0.05 * cash;
  const taxOnBonusShare = 0.05 * (bonusShare * parValue);
  const totalCashAmount = cash - taxOnCashDividend - taxOnBonusShare;

  // UPDATE RESULTS
  document.getElementById('cash').textContent = cash.toFixed(2);
  document.getElementById('bonushare').textContent = bonusShare.toFixed(2);
  document.getElementById('taxOnCashDevident').textContent = taxOnCashDividend.toFixed(2);
  document.getElementById('taxonBonusShare').textContent = taxOnBonusShare.toFixed(2);
  document.getElementById('totalCashAmount').textContent = totalCashAmount.toFixed(2);

  // Ensure results section is visible
  document.getElementById("calculate_value").style.display = "block";
});


// CLEAR BUTTON FUNCTIONALITY (form + results, keeps results section visible)
document.getElementById("clearFields").addEventListener("click", function () {
  // Clear form inputs
  document.getElementById('parvalue').value = '';
  document.getElementById('ShareQuantity').value = '';
  document.getElementById('percentbonusshare').value = '';
  document.getElementById('percentcashdevident').value = '';

  // Reset results
  document.getElementById('cash').textContent = '0';
  document.getElementById('bonushare').textContent = '0';
  document.getElementById('taxOnCashDevident').textContent = '0';
  document.getElementById('taxonBonusShare').textContent = '0';
  document.getElementById('totalCashAmount').textContent = '0';

  // Clear error message
  document.getElementById('errorSpan').textContent = '';
});

  </script>

  <!-- Scripts -->
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>
