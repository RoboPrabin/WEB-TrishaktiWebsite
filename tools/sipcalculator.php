<!DOCTYPE html>
<html lang="en">

<?php include '../headfoot/header1.php'; ?>

  <!-- Page Header -->
  <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
      <h1 class="display-4 mb-4 animated slideInDown">SIP Calculator</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

          <li class="breadcrumb-item active" aria-current="page">SIP Calculator</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-5">
    <h1 class="text-center mb-5">💰 SIP Calculator</h1>

    <div class="row g-4">
      <!-- Left: Form -->
      <div class="col-md-6">
        <div class="card shadow p-4">
          <h4 class="mb-3 text-dark">Enter Your Details</h4>

          <form id="sipForm">
            <div class="mb-3">
              <label for="inv_type" class="form-label">Investment Frequency</label>
              <select class="form-select" id="inv_type">
                <option value="1">Monthly</option>
                <option value="2">Quarterly</option>
                <option value="3">Semi-Annually</option>
                <option value="4">Annually</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="investment" class="form-label">Investment Amount (Rs)</label>
              <input type="number" class="form-control" id="investment" placeholder="Amount (Rs)">
            </div>

            <div class="mb-3">
              <label for="return" class="form-label">Expected Annual Return (%)</label>
              <input type="number" class="form-control" id="return" placeholder="Annual Return (%)">
            </div>

            <div class="mb-3">
              <label for="time" class="form-label">Investment Duration (Years)</label>
              <input type="number" class="form-control" id="time" placeholder="Duration (Years)">
            </div>

            <span id="errorSpan" class="text-danger mb-3 d-block"></span>

            <div class="d-flex justify-content-between">
              <button type="submit" id="submit" class="btn btn-primary w-50 me-2"><i class="fas fa-calculator me-2"></i>Calculate</button>
              <button type="button" id="clearFields" class="btn btn-outline-secondary w-50"><i class="fas fa-redo-alt me-2"></i>Clear</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Right: Results -->
      <div class="col-lg-6">
        <div id="calculate_value" class="card shadow-sm p-4 border-light">
          <h4 class="mb-3 text-dark">Calculation Details</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Investment</span>
              <strong id="totalInvest">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Estimated Returns</span>
              <strong id="totalReturn">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <span>Total Value</span>
              <strong id="total">0</strong>
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
  <script src="../js/bootstrap.bundle.min.js"></script>



<!-- JS Logic -->
<script>
  $(document).ready(function () {
    var selectedValue = 1;

    $('#inv_type').on('change', function () {
      selectedValue = $(this).val();
    });

    $('#submit').on('click', function (event) {
      event.preventDefault();

      var principal = parseFloat($('#investment').val());
      var xreturn = parseFloat($('#return').val());
      var time = parseFloat($('#time').val());

      if (isNaN(principal) || isNaN(xreturn) || isNaN(time)) {
        $('#errorSpan').text('Enter all values required');
        return;
      }

      if (principal <= 0 || xreturn <= 0 || xreturn > 100 || time <= 0) {
        $('#errorSpan').text('Enter valid values');
        return;
      }

      $('#errorSpan').text('');

      let no_of_payments, periodic_interest_rate;

      switch (parseInt(selectedValue)) {
        case 1: // Monthly
          no_of_payments = 12 * time;
          periodic_interest_rate = (xreturn / 100) / 12;
          break;
        case 2: // Quarterly
          no_of_payments = 4 * time;
          periodic_interest_rate = (xreturn / 100) / 4;
          break;
        case 3: // Semi-Annually
          no_of_payments = 2 * time;
          periodic_interest_rate = (xreturn / 100) / 2;
          break;
        case 4: // Annually
          no_of_payments = 1 * time;
          periodic_interest_rate = (xreturn / 100) / 1;
          break;
      }

      var totalInvest = principal * no_of_payments;
      var sip = principal * (((Math.pow(1 + periodic_interest_rate, no_of_payments) - 1) / periodic_interest_rate) * (1 + periodic_interest_rate));
      var totalReturn = sip - totalInvest;

      $('#totalInvest').text(totalInvest.toFixed(2));
      $('#totalReturn').text(totalReturn.toFixed(2));
      $('#total').text(sip.toFixed(2));
    });

    $('#clearFields').click(function () {
      $('#inv_type').val('1');
      $('#investment').val('');
      $('#return').val('');
      $('#time').val('');
      $('#totalInvest').text(0);
      $('#totalReturn').text(0);
      $('#total').text(0);
      $('#errorSpan').text('');
    });
  });
</script>

  <!-- Scripts -->
  <script src="../js/main.js"></script>

</body>
</html>
