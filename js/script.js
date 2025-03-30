document.addEventListener("DOMContentLoaded", function () {
    emailjs.init("0u2V6Av1TGD7XH2ln"); // Use only ONE public key 

    document.getElementById("contactForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const submitButton = document.querySelector("#contactForm button[type='submit']");
        submitButton.disabled = true;
        submitButton.textContent = "Sending...";

        // Get form values
        let serviceID, templateID, recipientEmail;

        const queryType = document.getElementById("queryType").value.toUpperCase();
        const formData = {
            queryType: queryType,
            fullName: document.getElementById("fullName").value.trim(),
            contactNumber: document.getElementById("contactNumber").value.trim(),
            emailAddress: document.getElementById("emailAddress").value.trim(),
            message: document.getElementById("message").value.trim(),
        };
        const callBack = "call back".toUpperCase();
        const complaint = "complaint".toUpperCase();
        // Define different service & template IDs
        if (queryType === callBack) {
            serviceID = "service_h482xnf"; 
            templateID = "template_vd91h6g"; 
            recipientEmail = "aayush.pokharel@trishakti.com.np";


        } else if (queryType === complaint) {
            serviceID = "service_469xmqq"; 
            templateID = "template_g805arp"; 
            recipientEmail = "prabin.trishakti@gmail.com";

        } else {
            alert("Please select a valid Query Type.");
            submitButton.disabled = false;
            submitButton.textContent = "Submit";
            return;
        }

        // Add recipient email to the formData
        formData.to_email = recipientEmail;

        // Send email using the selected service & template
        emailjs.send(serviceID, templateID, formData)
            .then(function (response) {
                // Show "Thank You" modal
                var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
                thankYouModal.show();

                document.getElementById("contactForm").reset(); // Clear form
                submitButton.disabled = false;
                submitButton.textContent = "Submit";
            }, function (error) {
                console.error("Email sending failed:", error);
                alert("Email sending failed. Please try again.", error);
                submitButton.disabled = false;
                submitButton.textContent = "Submit";
            });
    });
});
