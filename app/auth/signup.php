<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BZU NOTE | Sign Up page</title>
    <link rel="stylesheet" href="../../assets/css/signupPageStyle.css">
    <link rel="stylesheet" href="../../assets/css/validation.css">
</head>

<body>
    <header id="page-header">
        <nav id="nav-section">
            <a href="../../index.php"><img src="../../assets/imgs/c99.png" width="180" height="50" alt="bzu note logo"></a>
        </nav>

        <main id="main-section">

            <div class="main-content">

                <form action="../controllers/signup.controller.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>
                            <h1>Create a new account</h1>
                        </legend>
                        <section class="userCreden">
                            <h2>user credentials</h2>
                            <label for="username" class="control-label">Username:</label>
                            <input type="text" name="username" id="username" placeholder="user name" required /><br>
                            <?php
                            if (array_key_exists("error", $_GET)) {
                                echo "<p class=\"alert-error\"> (!) Username exist Try a new username</p>";
                            }
                            ?>
                            <label for="password" class="control-label">password:</label>
                            <input type="password" name="password" id="password" placeholder="password" required /><br>
                            <label for="confirm-password" class="control-label">confirm:</label>
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="confirm-password" required /><br>
                            <?php
                            if (array_key_exists("unmatch", $_GET)) {
                                echo "<p class=\"alert-error\"> (!) passwords doesn't match, Please try again</p>";
                            }
                            ?>
                        </section>

                        <section class="userInfo">


                            <h2>user information</h2>

                            <div class="rowflex">

                                <div class="l">
                                    <label for="fullName" class="control-label">Full Name:</label>
                                    <input type="text" name="fullName" id="fullName" placeholder="full name" required />
                                </div>

                                <div class="r">
                                    <label for="idNum" class="control-label">identity number:</label>
                                    <input type="text" pattern="\d*" maxlength="9" name="idNum" id="idNum" placeholder="0123456789" required />
                                </div>


                            </div>

                            <div class="rowflex">

                                <div>
                                    <label for="Nationality" class="control-label">Nationality:</label>
                                    <select name="Nationality" id="Nationality" required>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran (Islamic Republic of)</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao">Lao People's Democratic Republic</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia, Federated States of</option>
                                        <option value="Moldova">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint LUCIA">Saint LUCIA</option>
                                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                        <option value="Span">Spain</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                    </select>
                                </div>


                                <div>
                                    <label for="Address" class="control-label">Home Address:</label>
                                    <input type="text" name="Address" id="Address" placeholder="Address" required />
                                </div>


                            </div>


                            <div class="rowflex">

                                <div>
                                    <label for="MobileNumber" class="control-label">Mobile No.:</label>
                                    <input type="tel" name="MobileNumber" id="MobileNumber" placeholder="+970590000000" pattern="+[0-9]{1,3}[0-9]{9}" required />
                                </div>

                                <div>
                                    <label for="emailAddress" class="control-label">Email Address:</label>
                                    <input type="email" name="emailAddress" id="emailAddress" placeholder="email Address" required />
                                </div>

                            </div>

                            <div class="rowflex">

                                <div>
                                    <label for="DOB" class="control-label">Date of Birth:</label>
                                    <input type="date" name="DOB" id="DOB" placeholder="20/09/2020" required />
                                </div>

                                <div>
                                    <label for="YOE" class="control-label">years of experience:</label>
                                    <input type="number" name="YOE" id="YOE" placeholder="e.g 9" required />
                                </div>

                            </div>

                            <div class="rowflex">
                                <div>
                                    <label for="photo" class="control-label">Personal Photo:</label>
                                    <input type="file" name="photo" id="photo" placeholder="photo" accept="image/*" required />
                                </div>

                                <div>
                                    <label for="cv" class="control-label">upload your CV:</label>
                                    <input type="file" name="cv" id="cv" placeholder="upload cv" accept="application/pdf" required />
                                </div>

                            </div>
                        </section>

                        <input type="submit" name="submit-user-cred" id="submit-user-cred" value="Sign up">
                        <p id="acc-exist">have an account ? <a href="../auth/login.php">sign in</a></p>
                    </fieldset>

                </form>
            </div>
        </main>

        <footer id="site-footer">
            <section class="socialMedia">
                <a href="https://www.facebook.com/ezpzok" target="_blank"><img src="../../assets/imgs/facebook_48px.png" width="32" alt="facebook" /></a>
                <a href="https://www.instagram.com" target="_blank"><img src="../../assets/imgs/Instagram_logo_48px.png" width="32" alt="instagram" /></a>
                <a href="https://www.linkedin.com/in/mohammed-tahaynah/" target="_blank"><img src="../../assets/imgs/linkedin_48px.png" width="32" alt="linkedin" /></a>
                <a href="https://github.com/SMIL3Cr4Ck3R" target="_blank"><img src="../../assets/imgs/git_48px.png" width="32" alt="github" /></a>
            </section>
            <p>&copy; mohammed tahaynah</p>
        </footer>
    </header>
</body>

</html>