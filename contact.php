<!DOCTYPE html>
<html lang="en">

<?php include 'headfoot/header.php'; ?>
        <!-- Floating Learn Icon (Left) -->
        <div class="floating-icon learn" onclick="window.location.href='learn.php';">
            📚
            <span class="icon-label">Learn</span>
        </div>

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


<!-- Callback Start -->
<div class="container-fluid callback mb-5" id="contact">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="shadow rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <p class="d-inline-block shadow rounded rounded text-light fw-semi-bold py-1 px-3">Get In Touch</p>
                        <h1 class="display-5 mb-5 text-light">Request A Call-Back</h1>
                    </div>
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control uppercase" id="fullName" placeholder="Your Name">
                                    <label for="fullName" class="form-label">Full Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="emailAddress" placeholder="Your Email">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="contactNumber" placeholder="Your Mobile">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <label for="queryType" class="form-label"></label>
                                    <select class="form-select" id="queryType" required>
                                        <option value="Select an option">Select an option</option>
                                        <option value="call back">Call Back</option>
                                        <option value="complaint">Feedback</option>
                                    </select>
                                </div>                             
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                    <label for="message" class="form-label">Message</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-100 py-3" type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Callback End -->

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouModalLabel">Thank You</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your message has been delivered to the Trishakti team.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>




<!-- location starts here -->
    <div class="container-fluid text-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 100%;">
                    <h1 class="display-5 mb-2" style="color: #011a41;">Our Office</h1>
                    <br>
                    <div style="background-color: brown;height: 1px;" class="mb-3"></div>
                </div>
                
                <div class="col-lg-4 col-md-6 text-black">
                    <!-- <h4 class="text-white mb-4">Our Office</h4> -->
                    <div class="map-container">
                        <h5 class="mb-4 "><b>HEAD OFFICE - Kathmandu</b></h5>
                        <p><i class="fas fa-user-alt icon me-3"></i> Renu Pradhan</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-01-5970148</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i> info@trishakti.com.np</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Star Mall 7th Floor, Putalisadak, Kathmandu</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.3377784162158!2d85.32058897539135!3d27.706855376182926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1907e99e0391%3A0xcce47de157f588d3!2sStar%20Mall!5e0!3m2!1sen!2suk!4v1696237690318!5m2!1sen!2suk"
                        width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Kathmandu Office"></iframe>
                </div>
                </div>

                <div class="col-lg-4 col-md-6 text-black">
                    <div class="map-container">
                    <h5 class="mb-4"><b>BRANCH - Pokhara</b></h5>
                    <p><i class="fas fa-user-alt icon me-3"></i> Kabiraj Sharma</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-061-573901</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>  pokhara.trishakti@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Newroad, Pokhara, Kaski</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3515.639286192792!2d83.98340627541005!3d28.218269875893526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995958302f15cf1%3A0xacf672cbeb50ad1a!2sTrishakti%20Securities%20Public%20Limited!5e0!3m2!1sen!2suk!4v1696239518866!5m2!1sen!2suk"
                        width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Branch Office 1"></iframe>
                </div>
                </div>

                <div class="col-lg-4 col-md-6 text-black">
                    <div class="map-container">
                        <h5 class=" mb-4"><b>BRANCH - Mahendranagar</b></h5>
                        <p><i class="fas fa-user-alt icon me-3"></i> Mohan Prasad Bohora </p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-099-590192</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i> info@trishakti.com.np</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Mahendra Nagar, Kanchanpur</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3490.6889408471084!2d80.17891717551313!3d28.96694927548377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDU4JzAxLjAiTiA4MMKwMTAnNTMuNCJF!5e0!3m2!1sen!2suk!4v1710055406441!5m2!1sen!2suk"
                        width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Branch Office 2"></iframe>
                </div>
                </div>

                <div class="col-lg-4 col-md-6 text-black">
                    <div class="map-container">
                        <h5 class=" mb-4"><b>BRANCH - Hetauda</b></h5>
                        <p><i class="fas fa-user-alt icon me-3"></i> Bimal Sanjel</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-05-7590048</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i> support.hetauda@trishakti.com.np</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Hetauda, Parijat Marg</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3541.3165153706977!2d85.02860408128869!3d27.428244915347456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb49000ef03a17%3A0x907e40c698ac698c!2sTRISHAKTI%20SECURITIES%20PUBLIC%20LIMITED!5e0!3m2!1sen!2snp!4v1742183698077!5m2!1sen!2snp"
                        width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Branch Office 1"></iframe>
                </div>
                </div>

                <div class="col-lg-4 col-md-6 text-black">
                    <div class="map-container">
                        <h5 class="mb-4"><b>BRANCH - Lalitpur</b></h5>
                        <p><i class="fas fa-user-alt icon me-3"></i></p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-01-5400148</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i> support.lalitpur@trishakti.com.np</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Lalitpur, Manbhawan, Home Grocer</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d220.84145205121357!2d85.3153985150462!3d27.672074208673283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19cd11e75943%3A0xc412e89270f9d3ed!2sHome%20Grocer!5e0!3m2!1sen!2snp!4v1742183822524!5m2!1sen!2snp"
                        width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Branch Office 1"></iframe>

                </div>
                </div>
                <div class="col-lg-4 col-md-6 text-black">
                    <div class="map-container">
                        <h5 class="mb-4"><b>BRANCH - Banepa</b></h5>
                        <p><i class="fas fa-user-alt icon me-3"></i>Samir Bhochhibhoya</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> +977-011-665048</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i> support.banepa@trishakti.com.np</p>
                        <p class="mb-2">
                            <i class="fa fa-map-marker-alt me-3"></i>
                            Banepa, Godam Chok <span style="font-size: 0.81rem;">(District Cooperative Office Building)</span>
                        </p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1767.4261495513347!2d85.52430067446306!3d27.629090755424354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDM3JzQyLjIiTiA4NcKwMzEnMjYuOCJF!5e0!3m2!1sen!2snp!4v1745988177597!5m2!1sen!2snp"
                            width="90%" height="200" class="map-iframe curve" allowfullscreen loading="lazy" title="Trishakti Securities Branch Office 1"></iframe>

                </div>
                </div>
<!-- location stops here -->
            </div>
        </div>
    </div>
    
    <?php include 'headfoot/footer.php'; ?>

    <!-- Template Javascript -->
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>