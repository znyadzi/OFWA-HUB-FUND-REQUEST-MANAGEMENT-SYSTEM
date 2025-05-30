<form name="registerUser" action="registerUser.php" method="post">

    <label style="" for="Fullname">Username:</label>
    <input type="text" id="Username" placeholder="Enter a Prefered Username" name="Username" required>

    <label for="FullName">Full Name:</label>
    <input type="text" placeholder="Enter your Full Name" id="FullName" name="FullName" required>

    <label for="Email">Email:</label>
    <input type="email" placeholder="Enter your Email Address" id="Email" name="Email" required>

    <label for="Telephone">Telephone:</label>
    <input type="number" placeholder="Telephone" id="Telephone" name="Telephone" required>

    <label for="Address">Address:</label>
    <input type="text" placeholder="Enter your Residential Address" id="Address" name="Address" required>

    <label for="password">Password:</label>
    <input type="password" placeholder="Password" id="password" name="Password" required>

    <label for="password">Confirm Password:</label>
    <input type="password" oninput="

                                    const passwordInput = document.getElementById('password');
                                    const confirmpasswordInput = document.getElementById('confirmpassword');

                                    if (passwordInput.value !== confirmpasswordInput.value) {
                                        document.getElementById('passCheckMessage').style.display = 'block';
                                        // confirmpasswordInput.style.marginBottom = '0px';
                                    } else {
                                        document.getElementById('passCheckMessage').style.display = 'none';
                                    }
                                " placeholder="Confirm Password" id="confirmpassword" name="Confirmpassword" required>
    <p id="passCheckMessage" style=" display: none; color: red; ">Passwords do not match !!!</p>

    <label for="Account Type" style=" margin-bottom:15px;">Account Type:</label>
    <select id="AccountType" name="AccountType" required>
        <option value="Nurse">Nurse</option>
        <option value="Doctor">Doctor</option>
        <option value="Cashier">Cashier</option>
        <option value="Physician">Physician</option>
    </select>

    <input style="margin-bottom:20px;margin-top:30px" id="reg_submit_button" name="registerUser" type="submit"
        value="Register">
</form>