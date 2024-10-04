function validateForm() {
    let isValid = true;
    
    document.getElementById("firstNameError").innerHTML = "";
    document.getElementById("lastNameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("passwordError").innerHTML = "";
    document.getElementById("genderError").innerHTML = "";
    document.getElementById("dobError").innerHTML = "";
    document.getElementById("imageError").innerHTML = "";
    document.getElementById("addressError").innerHTML = "";

    var firstName = document.getElementById("firstName").value;
    if (firstName === "") {
        document.getElementById("firstNameError").innerHTML = "First Name is required.";
        isValid = false;
    }

    var lastName = document.getElementById("lastName").value;
    if (lastName === "") {
        document.getElementById("lastNameError").innerHTML = "Last Name is required.";
        isValid = false;
    }

    var email = document.getElementById("email").value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern == (email)) {
        document.getElementById("emailError").innerHTML = "Enter a valid email address.";
        isValid = false;
    }

    var password = document.getElementById("password").value;
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordPattern == (password)) {
        document.getElementById("passwordError").innerHTML = "Password must be 8 Characters Aaaa@1111";
        isValid = false;
    }

    var gender = document.querySelector('input[name="gender"]:checked');
    if (!gender) {
        document.getElementById("genderError").innerHTML = "Please select a gender.";
        isValid = false;
    }

    var dob = document.getElementById("dob").value;
    if (dob === "") {
        document.getElementById("dobError").innerHTML = "Date of Birth is required.";
        isValid = false;
    }

    var address = document.getElementById("address").value;
    if (address === "") {
        document.getElementById("addressError").innerHTML = "Address is required.";
        isValid = false;
    }

    return isValid;
}