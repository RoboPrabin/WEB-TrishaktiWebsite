<!DOCTYPE html>
<html lang="en">

<?php include '../headfoot/header1.php'; ?>

  <!-- Page Header -->
  <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
      <h1 class="display-4 mb-4 animated slideInDown">EMI Calculator</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

          <li class="breadcrumb-item active" aria-current="page">EMI Calculator</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-5">
    <h1 class="text-center mb-5">💸 EMI Calculator</h1>    
    <div class="row g-4">
      

  
      <!-- Right: Inputs -->
      <div class="col-md-6">
        <div class="card shadow p-4">
          <h4 class="mb-3 text-dark">Enter Your Details</h4>
          <div class="mb-3">
            <label for="principal" class="form-label">Loan Amount</label>
            <input type="number" id="principal" class="form-control" placeholder="Enter Numbers Only">
          </div>
          <div class="mb-3">
            <label for="rate" class="form-label">Annual Interest Rate (%)</label>
            <input type="number" id="rate" class="form-control" placeholder="Enter Numbers Only">
          </div>
          <div class="mb-3">
            <label for="time" class="form-label">Loan Term (in months)</label>
            <input type="number" id="time" class="form-control" placeholder="Enter Numbers Only">
          </div>
          <div id="errorMsg" class="error-text text-danger small"></div>
  
          <!-- <div class="d-flex justify-content-between">
            <button class="btn btn-primary w-50 me-2" id="calculateBtn"><i class="fas fa-calculator me-2"></i>Calculate</button>
            <button class="btn btn-secondary w-50" id="clearBtn"><i class="fas fa-redo-alt me-2"></i>Clear</button>
          </div> -->


          <div class="d-flex justify-content-between">
            <button type="submit" id="calculateBtn" class="btn btn-primary w-50 me-2"><i class="fas fa-calculator me-2"></i>Calculate</button>
            <button type="button" id="clearBtn" class="btn btn-outline-secondary w-50"><i class="fas fa-redo-alt me-2"></i>Clear</button>
          </div>


        </div>
      </div>

      <!-- Right: Results -->
      <div class="col-md-6">
        <div id="calculate_value" class="card shadow-sm p-4 border-light">
          <h4 class="mb-3 text-dark">Calculation Details</h4>
          <div class="my-3 mx-3 d-flex justify-content-between">
            <h3 class="text-primary">Monthly EMI:</h3>
            <h3 id="emiResult" class="text-primary justify-content-between"> 0.00</h3>
          </div>
          <ul class="list-group list-group-flush">
            <!-- <div class="mb-3">
            <li class="list-group-item d-flex justify-content-between">
              <span><h3>Monthly EMI</h3></span>
              <strong id="emiResult"><h3>0.00</h3></strong>
            </li>
            </div> -->
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Payment</span>
              <strong id="totalPayment"> 0.00</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Interest</span>
              <strong id="totalInterest"> 0.00</strong>
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
  document.getElementById('calculateBtn').addEventListener('click', function (e) {
    e.preventDefault();

    const principal = parseFloat(document.getElementById('principal').value);
    const annualRate = parseFloat(document.getElementById('rate').value);
    const months = parseInt(document.getElementById('time').value);

    const errorMsg = document.getElementById('errorMsg');
    errorMsg.textContent = "";

    if (isNaN(principal) || isNaN(annualRate) || isNaN(months) ||
        principal <= 0 || annualRate <= 0 || months <= 0) {
      errorMsg.textContent = "Please enter valid, positive numbers in all fields.";
      return;
    }

    const monthlyRate = annualRate / (12 * 100); // Convert to decimal monthly rate
    const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) /
                (Math.pow(1 + monthlyRate, months) - 1);
    const totalPayment = emi * months;
    const totalInterest = totalPayment - principal;

    // Output results
    document.getElementById('emiResult').textContent = `Rs. ${emi.toFixed(2).toLocaleString()}`;
    document.getElementById('totalPayment').textContent = `Rs. ${totalPayment.toFixed(2).toLocaleString()}`;
    document.getElementById('totalInterest').textContent = `Rs. ${totalInterest.toFixed(2).toLocaleString()}`;
  });

  document.getElementById('clearBtn').addEventListener('click', function () {
    document.getElementById('principal').value = '';
    document.getElementById('rate').value = '';
    document.getElementById('time').value = '';
    document.getElementById('emiResult').textContent = ' 0.00';
    document.getElementById('totalPayment').textContent = ' 0.00';
    document.getElementById('totalInterest').textContent = ' 0.00';
    document.getElementById('errorMsg').textContent = '';
  });
</script>

  <!-- Scripts -->
  <script src="../js/main.js"></script>

</body>
</html>
