<!DOCTYPE html>
<html lang="en">

<?php include '../headfoot/header1.php'; ?>

  <!-- Page Header -->
  <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
      <h1 class="display-4 mb-4 animated slideInDown">Weighted Average Calculator</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

          <li class="breadcrumb-item active" aria-current="page">Weighted Avg. Calculator</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-5">

    <h2 class="mb-5 text-center fw-bold text-primary">🧮 Weighted Average Calculator</h2>
          <!-- Custom Tab Buttons -->
          <div class="tab-buttons">
            <button id="second" class="btn btn-outline-primary active">Secondary Transactions</button>
            <button id="irb" class="btn btn-outline-secondary">IPO / Rights / Bonus</button>
          </div>
    <div class="container calculator-container p-4 shadow-sm">
  
      <div class="tab-content" id="tabContent">
        <!-- Secondary Tab -->
        <div class="tab-pane fade show active" id="secondary" role="tabpanel">
          <h4>For Secondary</h4>
          <div id="secondaryInputs"></div>
          <button class="btn btn-success" onclick="addRow('secondary')"><i class="fas fa-plus me-2"></i>Add Row</button>
          <button class="btn btn-primary my-3" onclick="calculate('secondary')"><i class="fas fa-calculator me-2"></i>Calculate</button>
          <button class="btn btn-outline-secondary my-3" onclick="clearFields('secondary')"><i class="fas fa-redo-alt me-2"></i>Clear</button>
          <h4 class="mt-3 text-primary">Weighted Average Price: Rs <strong id="secondaryAverage"></strong></h4>
        </div>

        <!-- IPO Tab -->
        <div class="tab-pane fade" id="ipo" role="tabpanel">
          <h4>For IPO</h4>
          <div id="ipoInputs"></div>
          <button class="btn btn-success" onclick="addRow('secondary')"><i class="fas fa-plus me-2"></i>Add Row</button>
          <button class="btn btn-primary my-3" onclick="calculate('ipo')"><i class="fas fa-calculator me-2"></i>Calculate</button>
          <button class="btn btn-outline-secondary my-3" onclick="clearFields('ipo')"><i class="fas fa-redo-alt me-2"></i>Clear</button>
          <h4 class="mt-3 text-primary">Weighted Average Price: Rs <strong id="ipoAverage"></strong></h4>
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

<!-- JavaScript Logic -->
<script>
  $(document).ready(function () {
  let ipoIndex = 0;
  let secondaryIndex = 0;

  function calculateTotalPayableIpo(parValue, quantity) {
    return parValue * quantity;
  }

  function calculateTotalPayable(rate, quantity) {
    const dpCharge = 25;
    let brokerPercent = 0.36;
    const sebonPercent = 0.014;

    const totalAmount = rate * quantity;
    const sebonFee = (totalAmount * sebonPercent) / 100;

    if (totalAmount <= 50000) brokerPercent = 0.36;
    else if (totalAmount <= 500000) brokerPercent = 0.33;
    else if (totalAmount <= 2000000) brokerPercent = 0.31;
    else if (totalAmount <= 10000000) brokerPercent = 0.27;
    else brokerPercent = 0.24;

    let brokerCom = (brokerPercent * totalAmount) / 100;
    if (brokerCom < 10) brokerCom = 10;

    return totalAmount + brokerCom + sebonFee + dpCharge;
  }

  function addRow(type) {
    const index = type === 'ipo' ? ipoIndex++ : secondaryIndex++;
    const container = $(`#${type}Inputs`);
  
    const rowHtml = `
      <div class="row mb-2 align-items-end" id="${type}Row${index}">
        <div class="col-md-2">
          <label>Par Value</label>
          <select class="form-select" id="${type}Par${index}">
            <option value="10">10</option>
            <option value="100">100</option>
          </select>
        </div>
        <div class="col-md-2">
          <label>Quantity</label>
          <input type="number" class="form-control" id="${type}Qty${index}" />
        </div>
        <div class="col-md-2">
          <label>Rate</label>
          <input type="number" class="form-control" id="${type}Rate${index}" />
        </div>
        <div class="col-md-3">
          <label>Total Amount</label>
          <input type="number" class="form-control" id="${type}Amt${index}" readonly />
        </div>
      </div>`;
  
    container.append(rowHtml);
  }

  function calculate(type) {
    let sumTotal = 0;
    let totalQuantity = 0;
    const maxIndex = type === 'ipo' ? ipoIndex : secondaryIndex;

    for (let i = 0; i < maxIndex; i++) {
      const qty = parseFloat($(`#${type}Qty${i}`).val()) || 0;
      const rate = parseFloat($(`#${type}Rate${i}`).val()) || 0;
      const parValue = parseFloat($(`#${type}Par${i}`).val()) || 0;

      if (qty <= 0 || rate <= 0) continue;

      const total = type === 'ipo'
        ? calculateTotalPayableIpo(parValue, qty)
        : calculateTotalPayable(rate, qty);

      $(`#${type}Amt${i}`).val(total.toFixed(2));
      sumTotal += total;
      totalQuantity += qty;
    }

    const weightedAverage = totalQuantity > 0 ? (sumTotal / totalQuantity).toFixed(2) : "0.00";
    $(`#${type}Average`).text(weightedAverage);
  }

  function clearFields(type) {
    const maxIndex = type === 'ipo' ? ipoIndex : secondaryIndex;
    for (let i = 0; i < maxIndex; i++) {
      $(`#${type}Qty${i}`).val('');
      $(`#${type}Rate${i}`).val('');
      $(`#${type}Amt${i}`).val('');
    }
    $(`#${type}Average`).text('');
  }

  $('#second').click(function () {
    $('#secondary').addClass('show active');
    $('#ipo').removeClass('show active');
    $(this).addClass('active');
    $('#irb').removeClass('active');
  });

  $('#irb').click(function () {
    $('#ipo').addClass('show active');
    $('#secondary').removeClass('show active');
    $(this).addClass('active');
    $('#second').removeClass('active');
  });

  window.addRow = addRow;
  window.calculate = calculate;
  window.clearFields = clearFields;

  addRow('secondary');
  addRow('ipo');
});

</script>


  <!-- Scripts -->
  <script src="../js/main.js"></script>

</body>
</html>
