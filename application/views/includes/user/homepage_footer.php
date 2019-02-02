<!-- footer section start -->
<footer class="footer" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-form">
                    <h4>Get in Touch</h4>
                    <p class="form-message"></p>
                    <form id="contact_us_form" name="contact_us_form" action="#" method="POST">
                        <input type="text" name="name" placeholder="Enter Your Name">
                        <input type="email" name="email" placeholder="Enter Your Email">
                        <input type="text" name="subject" placeholder="Your Subject">
                        <textarea placeholder="Messege" name="message"></textarea>
                        <button type="submit" id="submitbtn" name="submit">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-address">
                    <h4>Address</h4>
                    <p>Plot no 4, ground floor, Swapnamandir housing society Erandwane, near Alankar police station, Maharashtra 411004</p>
                    <ul>
<!--                        <li>
                            <div class="contact-address-icon">
                                <i class="icofont icofont-headphone-alt"></i>
                            </div>
                            <div class="contact-address-info">
                                <a href="callto:#">+8801712435941</a>
                                <a href="callto:#">+881934180093</a>
                            </div>
                        </li>-->
                        <li>
                            <div class="contact-address-icon">
                                <i class="icofont icofont-envelope"></i>
                            </div>
                            <div class="contact-address-info">
                                <a href="mailto:#">support@bizmo-tech.com</a>
                            </div>
                        </li>
                        <li>
                            <div class="contact-address-icon">
                                <i class="icofont icofont-web"></i>
                            </div>
                            <div class="contact-address-info">
                                <a href="https://bizmo-tech.com">https://bizmo-tech.com</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-area">
                    <ul>
                        <li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-brand-linkedin"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
                    </ul>
                    <p>©2018 All Rights Reserved | Powered by <a target="_blank" href="https://bizmo-tech.com">Bizmo Technologies</a></p>

<!--                    <p>&copy;  Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. 
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                         Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. </p>-->
                </div>
            </div>
        </div>
    </div>
</footer><!-- footer section end -->
<a href="#" class="scrollToTop">
    <i class="icofont icofont-arrow-up"></i>
</a>
<div class="switcher-area" id="switch-style">
    <div class="display-table">
        <div class="display-tablecell">
<!--            <a class="switch-button" id="toggle-switcher"><i class="icofont icofont-wheel"></i></a>-->
            <div class="switched-options">
<!--                <div class="config-title">Home variation:</div>-->
<!--                <ul>
                    <li><a href="index.html">Home - Fixed Text</a></li>
                    <li><a href="index-slider.html">Home - Slider Effect</a></li>-->
<!--                    <li class="active"><a href="index-video.html">Home - Video Background</a></li>
                </ul>-->
<!--                <div class="config-title">Other Pages</div>-->
<!--                <ul>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog-detail.html">Blog Details</a></li>
                </ul>-->
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#contact_us_form").submit(function () {
            dataString = $("#contact_us_form").serialize();
            $("#submitbtn").html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Sending Message. Hang on...</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "homepage/sendContactEmail",
                //dataType : 'text',
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data) {
                    console.log(data);                    
                    $("#submitbtn").html('<span>Send Message</span>');
                    $("#fpasswd_err").html(data);
                    $('form :input').val('');
                }
            });
            return false;  //stop the actual form post !important!

        });
    });
</script>

<!-- Gmap JS -->
<script src="assets/assets/js/gmap3.min.js"></script>
<!-- Google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnKyOpsNq-vWYtrwayN3BkF3b4k3O9A_A"></script>
<!-- Custom map JS -->
<script src="assets/assets/js/custom-map.js"></script>
<!-- WOW JS -->
<script src="assets/assets/js/wow-1.3.0.min.js"></script>
<!-- Switcher JS -->
<script src="assets/assets/js/switcher.js"></script>
<!-- main JS -->
<script src="assets/assets/js/main.js"></script>
</body>
</html>