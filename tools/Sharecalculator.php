<!DOCTYPE html>
<html lang="en">

<?php include '../headfoot/header1.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
          <h1 class="display-4 mb-4 animated slideInDown">Share Calculator</h1>
          <nav aria-label="breadcrumb animated slideInDown">
              <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
        
                  <li class="breadcrumb-item active" aria-current="page">Share Calculator</li>
              </ol>
          </nav>
      </div>
  </div>
  <!-- Page Header End -->
  <div class="container py-5">
    <h2 class="mb-2 text-center fw-bold text-primary">📈 Share Calculator</h2>

    <div class="container mb-5 py-5 ">
        <div class="tab-buttons">
          <button id="showBuy" class="btn btn-outline-primary active">Buy Calculator</button>
          <button id="showSell" class="btn btn-outline-secondary">Sell Calculator</button>
        </div>
      
        <!-- Buy Section -->
        <div id="buySection" class="card p-4">
          <h4>Enter Details</h4>
          <div class="row g-3">
            <div class="col-md-6">
              <label>Price per Share</label>
              <input type="number" class="form-control" id="price" />
            </div>
            <div class="col-md-6">
              <label>Quantity</label>
              <input type="number" class="form-control" id="quantity" />
            </div>
            <div class="d-flex justify-content">
              <button id="buyCalculate" class="btn btn-primary me-2"><i class="fas fa-calculator me-2"></i>Calculate</button>
              <button id="clearFieldsBuy" class="btn btn-outline-secondary"><i class="fas fa-redo-alt me-2"></i>Clear</button>
            </div>
          </div>
          <!-- Result Display -->
          <div class="col-lg-6 mt-5">
            <div id="calculate_value" class="card shadow-sm p-4 border-light">
              <h4 class="mb-3 text-dark">Purchase Calculation Details</h4>

              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                  <span>Total Amount</span>
                  <strong id="totalAmount">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>Broker Commission</span>
                  <strong id="brokerCom">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>Sebon Fee</span>
                  <strong id="sebonFee">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>DP Charge</span>
                  <strong id="dpCharge">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
                  <span>Total Payable</span>
                  <strong id="sumTotal">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
                  <span>Cost Per Share</span>
                  <strong id="costPerShare">0</strong>
                </li>
              </ul>
            </div>
          </div>
        </div>
      
        <div id="sellSection" class="card p-4 hidden">
          <h4>Enter Details</h4>
          <div class="row g-3">
            <div class="col-md-4">
              <label>Selling Price</label>
              <input type="number" class="form-control" id="sellingPrice" />
            </div>
            <div class="col-md-4">
              <label>Quantity</label>
              <input type="number" class="form-control" id="sellQuantity" />
            </div>
            <div class="col-md-4">
              <label>WACC (Weighted Avg. Cost)</label>
              <input type="number" class="form-control" id="wacc" />
            </div>
            <div class="col-md-6">
              <label>Capital Gain Type</label>
              <div>
                <label class="me-3"><input type="radio" name="cgtType" value="5" checked /> Short Term (5%)</label>
                <label><input type="radio" name="cgtType" value="7" /> Long Term (7%)</label>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content">
                <button id="sellCalculate" class="btn btn-primary me-2"><i class="fas fa-calculator me-2"></i>Calculate</button>
                <button id="clearFieldsSell" class="btn btn-outline-secondary"><i class="fas fa-redo-alt me-2"></i>Clear</button>
              </div>
          </div>
      <!-- Result Display -->
      <div class="col-lg-6 mt-5">
        <div id="calculate_value" class="card shadow-sm p-4 border-light">
          <h4 class="mb-3 text-dark">Sale Calculation Details</h4>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Sale</span>
              <strong id="totalSale">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Broker Commission</span>
              <strong id="saleBrokerCom">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Sebon Fee</span>
              <strong id="saleSebonFee">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>DP Charge</span>
              <strong id="saleDpCharge">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Capital Gain Tax</span>
              <strong id="capitalTax">0</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <span>Total Receivable</span>
              <strong id="totalReceivable">0</strong>
            </li>
          </ul>
          </div>
        </div>
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

    // --- Tab Switching ---
document.getElementById("showBuy").addEventListener("click", () => {
    document.getElementById("buySection").classList.remove("hidden");
    document.getElementById("sellSection").classList.add("hidden");
    document.getElementById("showBuy").classList.add("active");
    document.getElementById("showSell").classList.remove("active");
  });
  
  document.getElementById("showSell").addEventListener("click", () => {
    document.getElementById("sellSection").classList.remove("hidden");
    document.getElementById("buySection").classList.add("hidden");
    document.getElementById("showSell").classList.add("active");
    document.getElementById("showBuy").classList.remove("active");
  });
  
  // --- Buy Calculator ---
  document.getElementById("buyCalculate").addEventListener("click", () => {
    const price = parseFloat(document.getElementById("price").value);
    const quantity = parseInt(document.getElementById("quantity").value);
  
    if (!price || !quantity || price <= 0 || quantity <= 0) return;
  
    const totalAmount = price * quantity;
  
    let brokerPercent = 0.36;
    if (totalAmount > 50000 && totalAmount <= 500000) brokerPercent = 0.33;
    if (totalAmount > 500000 && totalAmount <= 2000000) brokerPercent = 0.31;
    if (totalAmount > 2000000) brokerPercent = 0.27;
  
    let brokerCom = (brokerPercent * totalAmount) / 100;
    if (totalAmount <= 50000 && brokerCom < 10) brokerCom = 10;
  
    const sebonFee = (totalAmount * 0.015) / 100;
    const dpCharge = 25;
    const totalPayable = totalAmount + brokerCom + sebonFee + dpCharge;
    const costPerShare = totalPayable / quantity;
  
    document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);
    document.getElementById("brokerCom").textContent = brokerCom.toFixed(2);
    document.getElementById("sebonFee").textContent = sebonFee.toFixed(2);
    document.getElementById("dpCharge").textContent = dpCharge.toFixed(2);
    document.getElementById("sumTotal").textContent = totalPayable.toFixed(2);
    document.getElementById("costPerShare").textContent = costPerShare.toFixed(2);
  });
  
  document.getElementById("clearFieldsBuy").addEventListener("click", () => {
    document.getElementById("price").value = '';
    document.getElementById("quantity").value = '';
    ["totalAmount", "brokerCom", "sebonFee", "dpCharge", "sumTotal", "costPerShare"]
      .forEach(id => document.getElementById(id).textContent = '0');
  });
  
  // --- Sell Calculator ---
  const sellState = {
    dpCharge: 25
  };
  
  function calculateSell(cgt) {
    const price = parseFloat(document.getElementById("sellingPrice").value);
    const qty = parseInt(document.getElementById("sellQuantity").value);
    const wacc = parseFloat(document.getElementById("wacc").value);
  
    if (!price || !qty || !wacc || price <= 0 || qty <= 0 || wacc <= 0) return;
  
    const totalSale = price * qty;
    const totalPurchase = wacc * qty;
  
    let brokerPercent = 0.36;
    if (totalSale > 50000 && totalSale <= 500000) brokerPercent = 0.33;
    if (totalSale > 500000 && totalSale <= 2000000) brokerPercent = 0.31;
    if (totalSale > 2000000) brokerPercent = 0.27;
  
    let brokerCom = (brokerPercent * totalSale) / 100;
    if (totalSale <= 50000 && brokerCom < 10) brokerCom = 10;
  
    const sebonFee = (totalSale * 0.015) / 100;
    const profit = totalSale - (totalPurchase + brokerCom + sebonFee + sellState.dpCharge);
    const capitalTax = profit > 0 ? (cgt * profit) / 100 : 0;
    const totalReceivable = totalSale - (brokerCom + sebonFee + sellState.dpCharge + capitalTax);
  
    // Update the values in DOM
    document.getElementById("totalSale").textContent = totalSale.toFixed(2);
    document.getElementById("saleBrokerCom").textContent = brokerCom.toFixed(2);
    document.getElementById("saleSebonFee").textContent = sebonFee.toFixed(2);
    document.getElementById("saleDpCharge").textContent = sellState.dpCharge.toFixed(2);
    document.getElementById("capitalTax").textContent = capitalTax.toFixed(2);
    document.getElementById("totalReceivable").textContent = totalReceivable.toFixed(2);
  }
  
  document.getElementById("sellCalculate").addEventListener("click", () => {
    const cgt = parseFloat(document.querySelector("input[name='cgtType']:checked").value);
    calculateSell(cgt);
  });
  
  document.querySelectorAll("input[name='cgtType']").forEach(radio => {
    radio.addEventListener("change", () => {
      const cgt = parseFloat(document.querySelector("input[name='cgtType']:checked").value);
      calculateSell(cgt);
    });
  });
  
  document.getElementById("clearFieldsSell").addEventListener("click", () => {
    ["sellingPrice", "sellQuantity", "wacc"].forEach(id => document.getElementById(id).value = '');
    ["totalSale", "saleBrokerCom", "saleSebonFee", "saleDpCharge", "capitalTax", "totalReceivable"]
      .forEach(id => document.getElementById(id).textContent = '0');
  });
  
</script>



    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>
