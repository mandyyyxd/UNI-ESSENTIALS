<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
      <link rel="stylesheet" href="../css/basicLayout.css">
      <link rel="stylesheet" href="../css/helpLayout.css">
      <link rel="stylesheet" href="../css/theme.css">
    </head>

<body>
    <header>
        <div class="pageHeading">
            <div class="menu">
                <form>
                    <button type="button" name="menu" id="menu"><img src="../Images/NavImages/Menu_Icon.png" alt="Menu Button"></button>
                </form>
            </div>
            <div class="logo">
                <a href="index.php"><img src="../Images/NavImages/Uni-Essentials-Logo.png" alt="Uni Essentials Logo"></a>
            </div>
            <div class="search">
                <form>
                    <input type="text" placeholder="Search.." name="searchBar" id="searchBar">
                    <button type="submit" name="searchButton" id="searchButton">Search</button>
                </form>
            </div>
            <?php
            session_start();
            if (isset($_SESSION['profilePic']) && $_SESSION['profilePic'] !== NULL) {
                echo '<img alt="User Profile Picture" id="userProfilePic" src="' . htmlspecialchars($_SESSION['profilePic']) . '" alt="Profile Picture Preview" style="max-width: 200px;">';
            } else {
                echo '<img alt="User Profile Picture" id="userProfilePic" src="../Images/userPFP/Default.jpg" alt="Profile Picture Preview" style="max-width: 200px;">';
            }

            if (isset($_SESSION['firstName'])) {
                echo '<div class="logout">
                        <form action="../PHP/logout.php" method="post">
                            <button type="submit" class="logoutBTN"><img src="../Images/NavImages/Logout.png" alt="Logout Button"></button>
                        </form>
                      </div>';
            }
            ?>
        </div>
        <div class="navbar">
            <a href="index.php" class="selected">Home</a>
            <a href="technology.php">Technology</a>
            <a href="accessories.php">Accessories</a>
            <a href="discussion.php">Discussion Forums</a>
            <a href="cart.php">Shopping Cart</a>
            <?php
            if (isset($_SESSION['firstName'])) {
                echo '<a href="account.php">Hi, ' . htmlspecialchars($_SESSION['firstName']) . '</a>';
            } else {
                echo '<a href="login.php">Login/Register</a>';
            }
            ?>
        </div>
        <script src="../JavaScript/menuButton.js"></script>
    </header>

    <main>
        <div class="content">
            <div class="side-panel">
                <a href="#privacy-policy">Privacy Policy</a>
                <a href="#questions-or-concerns" class="indented">Questions/Concerns</a> 
                <a href="#information-collected" class="indented">Information Collected</a> 
                <a href="#deactivated-accounts" class="indented">Deactivated Accounts</a> 
                <a href="#australia-privacy-act" class="indented">Australia Privacy Act</a> 
                <a href="#information-protection" class="indented">Information Protection</a> 
                <a href="#user-terms">User Terms</a>
                <a href="#right-to-post" class="indented">Right to Post Content</a> 
                <a href="#content-restrictions" class="indented">Content Restrictions</a> 
                <a href="#copyright">Copyright</a>
                <a href="#copyright-infringement" class="indented">Copyright Infringement</a> 
                <a href="#cookie-policy">Cookie Policy</a>
            </div>
            <div class="help-wrapper">
                <div id="privacy-policy">
                <h1>Privacy Policy</h1>
                </div>
                <br>
                <em>Last Updated May 31, 2024</em>
                <br><br>
                We at UNI ESSENTIALS care deeply about our users and their information, we appreciate your trust in our service as we promise to uphold our ideals of sensibility and care.<br>
                <br>
                <div id="questions-or-concerns">
                <strong>Questions or Concerns? </strong>
                </div>
                <br>
                Reading this privacy notice will help you understand your privacy rights and choices. If you do not agree with our polices and practices, we urge you to not use our service. If you have any questions regarding this document please contact us at <a href="mailto:theuniessential@gmail.com">theuniessential@gmail.com</a>.
                <br><br>
                <div id="information-collected">
                <strong>What information do we collect?</strong>
                </div><br>
                In summary we collect the personal information that you provide us. We update our data when you our user opt to make a UNI ESSENTIALS account, enter data into a webform, update information in your own personal account or participate in our online discussion forums. Under law as a data subject you have the right to access and erase your personal data. You can withdraw your consent at any time on the basis of legitimate interests.
                <br><br>
                <strong>The personal data we collect are the following:</strong>
                <br><br>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Names</li>
                    <li>Email</li>
                    <li>Usernames</li>
                    <li>Password</li>
                    <li>Mailing address</li>
                    <li>Credit Card information.</li>
                </ul>
                <br>
                <div id="deactivated-accounts">
                <Strong>Deactivated Accounts</strong>
                </div><br>
                We keep your information for as long as necessary. When we have no  ongoing legitimate business need to process your personal information, we will either delete or anonymise information or securely store said information and isolate it from any further processing. This is a manual process completed annually, to  confirm whether your data has been deleted please send an email to <a href="mailto:theuniessential@gmail.com">theuniessential@gmail.com</a> to resolve your issue.
                <br><br>
                <div id="australia-privacy-act">
                <Strong>Australia Privacy Act 1998</strong>
                </div><br>
                We collect and process your personal information under the obligations set by Australia’s Privacy Act 1998. As an individual, the Privacy Act gives you greater control over the way that your personal information is handled. 
                The Privacy Act allows you to: 
                <br><br>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Know why your personal information is being collected, how it will be used and who it will be disclosed to</li>
                    <li>Have the option of not identifying yourself, or of using a pseudonym in certain circumstances</li>
                    <li>Ask for access to your personal information (including your health information)</li>
                    <li>Stop receiving unwanted direct marketing</li>
                    <li>Ask for your personal information that is incorrect to be corrected</li>
                    <li>Make a complaint about an organisation or agency the Privacy Act covers, if you think they’ve mishandled your personal information.</li>
                </ul>
                <br>
                If you would like to excersise these rights we encourage you to contact <a href="mailto:theuniessential@gmail.com">theuniessential@gmail.com</a> to formally file your complaint or query.            
                <br><br>
                <div id="information-protection">
                <Strong>How do we keep your information safe? </Strong>
                </div><br>
                We aim to protect your personal information through a system of organisation and technical security measures. We have implemented the appropriate and reasonable technical security measure designed to protect the information of our users. Despite our safeguards and efforts no data can be guaranteed to be 100% secure, we cannot promise or guarantee that hackers or malicilous individuals will not be able to access your information. Although we do our best to protect your personal information, transmission of personal information to and from our services is at your own risks. We urge you to only access our service in a secure environment.
                <br><br>
                <div id="user-terms">
                <h1>User Terms</h1>
                </div>
                <br>
                When You create an account with us, you must provide us information that is accurate and complete. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account with Uni Essentials. Additionally you are responsible for safeguarding the password that you use to access Uni Essentials. You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your Uni Essentials account. You may not use as a username the name of another person or entity or that is not lawfully available for use, or a name that is otherwise offensive or vulgar. Failure to do so may result in account termination. 
                <br><br>
                <div id="right-to-post">
                <strong>Your right to Post Content</strong>
                </div><br>
                The Uni Essentials service allows you to post and share content. You are responsible for the content that you post to our Service, including its legality, reliability, and appropriateness.
                By posting to the Uni Essentials service, you grant us the right and license to use, modify and distribute such content through the Service. You agree that this license includes the right for us to make this content available to other users of the Service, who may also use your content subject to these Terms.
                You represent and warrant that: (i) the Content is Yours (You own it) or You have the right to use it and grant us the rights and license as provided in these Terms, and (ii) the posting of your content on or through the Service does not violate private or public rights.
                <br><br>
                <div id="content-restrictions">
                <strong>Content Restrictions</strong>   
                </div>
                <br>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Promoting unlawful activity.</li>
                    <li>Mean-spirited content, including references or commentary about religion, race, sexual orientation, gender, national/ethnic origin, or other targeted groups.</li>
                    <li>Spam, machine – or randomly – generated, constituting unauthorized or unsolicited advertising, or any other form of unauthorized solicitation.</li>
                    <li>Containing or installing any viruses or malware that is designed or intended to disrupt or damage another persons data.</li>
                    <li>Infringing on any  rights of any party, including patent, copyright or other rights.</li>
                    <li>Impersonating any person or entity including the Company.</li>
                    <li>Violating the privacy of any third person.</li>
                    <li>False information and features.</li>
                </ul>
                <br>
                Uni Essentials reserves the right, but not the obligation, to delete or remove content that is inappropriate. Uni Essentials can also revoke the use our service if you post such Content. As Uni Essentials cannot control all content posted by users, you agree to use the Service at your own risk. You understand that by using the Service you run the risk of being exposed to content that could be viewed as offensive or indecent and you agree that under no circumstances that Uni Essentials will be liable in any way for any content.
                <br><br>
                <div id="copyright">
                <h1>Copyright</h1>
                </div>
                <br>
                All content found in the discussion forums as well as images used for branding, including text, images and other materials, are protected by copyright law and are the property of Uni Essentials unless otherwise stated. This content may not be reproduced, distributed, transmitted, or otherwise used, except with the prior written permission of Uni Essentials. 
                <br><br>
                You may not modify, publish, distribute, reproduce or perform, or in any way exploit in any format whatsoever any of the content of this website, in whole or in part, without our prior written consent. 
                <br><br>
                <div id="copyright-infringement">
                <strong>Copyright Infringement</strong>
                <br><br>
                We at Uni Essentials acknowledge the ownership of the images used for the products sold on this platform are not owned by us but instead belong to the manufacturers of each product. The use of these stock images fall under the fair use agreement, if the owners of the images would like us to remove said images we urge you to contact us immediately so we can do so.
                <br><br>
                If you believe that your intellectual property rights have been infringed upon by our website content, please notify us by sending an email to <a href="mailto:theuniessential@gmail.com">theuniessential@gmail.com</a> with the subject line "Copyright Infringement". 
                <br><br>
                <div id="cookie-policy">
                <h1>Cookie Policy</h1>
                </div>
                <br>
                This website uses cookies to enhance user experience, analyze website traffic, and provide personalized content and advertisements. Cookies are small text files that are stored on your computer or mobile device by the websites you visit. They are widely used to make websites work more efficiently and to provide information to website owners.
            </div>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>
   

</body>
</html>