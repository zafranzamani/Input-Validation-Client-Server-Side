function validateForm() {
    var nameInput = document.getElementById("name").value;
    var matricNoInput = document.getElementById("matricNo").value;
    var currentAddressInput = document.getElementById("currentAddress").value;
    var homeAddressInput = document.getElementById("homeAddress").value;
    var emailInput = document.getElementById("email").value;
    var mobilePhoneInput = document.getElementById("mobilePhone").value;
    var homePhoneInput = document.getElementById("homePhone").value;
  
    var nameRegex = /^[A-Za-z\s]+$/;
    var matricNoRegex = /^[0-9]+$/;
    var phoneRegex = /^[0-9]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    var errorMsg = "";
  
    if (!nameRegex.test(nameInput)) {
      errorMsg += "Name can only contain letters and spaces.<br>";
    }
  
    if (!matricNoRegex.test(matricNoInput)) {
      errorMsg += "Matric No can only contain numbers.<br>";
    }
  
    if (!emailRegex.test(emailInput)) {
      errorMsg += "Invalid email address.<br>";
    }
  
    if (!phoneRegex.test(mobilePhoneInput)) {
      errorMsg += "Mobile Phone No can only contain numbers.<br>";
    }
  
    if (!phoneRegex.test(homePhoneInput)) {
      errorMsg += "Home Phone No can only contain numbers.<br>";
    }
  
    if (errorMsg !== "") {
      document.getElementById("error-msg").innerHTML = errorMsg;
      return false;
    }
  
    return true;
  }
  