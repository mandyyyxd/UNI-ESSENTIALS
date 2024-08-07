document.addEventListener('DOMContentLoaded', function() {
    insertFooter();
});

function insertFooter() {
    var footer = document.querySelector("footer");

    footer.innerHTML = `
    <div class="cardContainer">
        <div class="table">
            <h1 class="contact">Contact Us</h1> 
            <table>
                <tr><th>Nitin Bisht</th><td><a href="mailto:s3843339@student.rmit.edu.au">s3843339@student.rmit.edu.au</a></td></tr>
                <tr><th>Mandeep Sharma</th><td><a href="mailto:s3993934@student.rmit.edu.au">s3993934@student.rmit.edu.au</a></td></tr>
                <tr><th>Sara Joshi</th><td><a href="mailto:s4036275@student.rmit.edu.au">s4036275@student.rmit.edu.au</a></td></tr>
                <tr><th>Charles Jordan</th><td><a href="mailto:s4015481@student.rmit.edu.au">s4015481@student.rmit.edu.au</a></td></tr>
                <tr><th>Email:</th><td><a href="mailto:theuniessential@gmail.com">theuniessential@gmail.com</a></td></tr>
            </table>   
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d788.0557099573056!2d144.96339207671838!3d-37.808249091397684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642cb8277b521%3A0x6b99ccbd6e58e558!2sBuilding%2010%20(Casey%20Building)%20-%20RMIT%20University!5e0!3m2!1sen!2sau!4v1715338170924!5m2!1sen!2sau" width="360" height="180" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="socials">
            <h1>Our Socials</h1> 
            <a href="https://www.instagram.com/theuniessential/" target="_blank"><img src="../Images/FooterImages/instagram-logo.jpg" alt="Instagram"></a>
            <a href="https://www.facebook.com/profile.php?id=61559229281359&sk=about" target="_blank"><img src="../Images/FooterImages/facebook-logo.png" alt="Facebook"></a>
            <a href="https://twitter.com/theuniessential" target="_blank"><img src="../Images/FooterImages/twitter-logo.png" alt="Twitter"></a>
        </div>
    </div>
    `;

    var sitemapHTML = `
    <div class="sitemap">
        <div class="footer-title">
            <h1>Shopping</h1>
            <ul>
                <li><a href="technology.php">Technology</a></li>
                <li><a href="accessories.php">Accessories</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
            </ul>
        </div>
        <div class="footer-title">
            <h1>Connect</h1>
            <ul>
                <li><a href="discussion.php">Discussion</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>
        </div>
        <div class="footer-title">
            <h1>Socials</h1>
            <ul>
                <li><a href="https://www.facebook.com/people/Uni-Essential/pfbid02wBgR2fRR1xrN9XsmEi26CP262w6y1ofSa4pREDRETBdj2zBgCrTzdQ4anjvY46i2l/?sk=about">Facebook</a></li>
                <li><a href="https://x.com/theuniessential">Twitter</a></li>
                <li><a href="https://www.instagram.com/theuniessential/">Instagram</a></li>
            </ul>
        </div>
    </div>
    <div class="help">
        <a href="help.php">Privacy Policy - User Terms - Copyright - Cookies</a>
    </div>
    `;
    
    footer.innerHTML += sitemapHTML; 
}
