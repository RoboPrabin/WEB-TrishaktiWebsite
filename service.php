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
            <h1 class="display-3 mb-4 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded primary fw-semi-bold py-1 px-3">Our Services</p>
                <h1 class="mb-5">Explore the range of services we offer to our clients.</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>Order Taking</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>Stock Trading</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>Clearing and Settlement</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>BOID Registration</h5>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-5" type="button">
                                <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>DIS Clearing</h5>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-6" type="button">
                                    <h5 class="m-0"><i class="fa fa-bars primary me-3"></i>Demat Service</h5>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-1.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">We receive trading orders 24/7 via SMS and online form, ensuring that your trades are 
                                        executed promptly and efficiently, no matter when you need to place them.</p>
                                    <!-- <p><i class="fa fa-check primary me-2"></i> </p>
                                    <p><i class="fa fa-check primary me-2"></i> </p>
                                    <p><i class="fa fa-check primary me-2"></i> </p>
                                    <p><i class="fa fa-check primary me-2"></i>  </p> -->
                                    <a href="serviceLM/order.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                    
                                    
                                    


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-2.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">We provide reliable stock trading services tailored to our customers' needs, offering 
                                        competitive pricing and access to a wide range of markets to help you maximize your investment 
                                        opportunities.</p>
                                    <a href="serviceLM/stock.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-3.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">Our clearing and settlement services are designed to ensure that your trades are 
                                        processed smoothly and securely, providing you peace of mind knowing that your transactions are 
                                        handled by experts.</p>
                                    <a href="serviceLM/cs.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-4.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">We assist you in obtaining a DP ID for depositing shares received from any source, 
                                        simplifying the process and ensuring compliance with regulatory requirements.</p>

                                    <a href="serviceLM/boid.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-pane-5">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-5.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">We manage your Delivery Instruction Slips (DIS) with utmost care,
                                         ensuring that your trades are cleared accurately and efficiently, reducing the risk of errors.</p>

                                    <a href="serviceLM/dis.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-pane-6">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="img/service-6.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">18 Years of Financial Expertise: Driving Success in the Stock Market.</h3>
                                    <p class="mb-4">Our Demat service allows you to set up your account quickly,
                                         making it easy for you to hold and manage your securities electronically, 
                                         streamlining your trading experience.</p>

                                    <a href="serviceLM/demat.php" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->



<?php include 'headfoot/footer.php'; ?>


</body>

</html>
