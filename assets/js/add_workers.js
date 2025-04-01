            
const form = document.getElementById('form_valid');
const type = document.getElementById('type');

const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('cpassword');


var uservalid = false;
var emailvalid = false;
var passvalid = false;
var cpassvalid = false;



form.addEventListener('submit', e => {
    
    var typevalue = type.value;
    console.log(typevalue);
    if (typevalue === "service") {
        validateInputs();    

        if (uservalid == false || emailvalid == false || passvalid == false  || cpassvalid == false ) {
            e.preventDefault();
        }
    } else if (typevalue === "medecin") {
        validateInputsMedecin();
      
        
        if (userMedvalid == false || emailMedvalid == false || passMedvalid == false  || cpassMedvalid == false) {
            e.preventDefault();
        }
    } else if (typevalue === "Pramedical") {
        validateInputsPramedical();
      
        
        if (userPramedicalvalid == false || emailPramedicalvalid == false || passPramedicalvalid == false  || cpassPramedicalvalid == false) {
            e.preventDefault();
        }
    }
})





const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('succes');
      
};

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('succes');
    inputControl.classList.remove('error');
    
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};

const isValidnumber = number => {
    const re = /\d+/;
    return re.test(String(number).toLowerCase());
};


const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();

    if (usernameValue === '') {
        setError(username, 'Username is required');
      
    } else {
        setSuccess(username);
        uservalid = true; 
          
    }



    if (emailValue === '') {
        setError(email, 'Email is required');
       
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'valid email address');
       
    } else {
        setSuccess(email);
        emailvalid = true;
    }

    if (passwordValue === '') {
        setError(password, 'Password is required');
       
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be at least 8 character.');
        
    } else {
        setSuccess(password);
        passvalid = true;
    
    }

    if (password2Value === '') {
        setError(password2, 'Please confirm your password');
        
    } else if (password2Value !== passwordValue) {
        setError(password2, "Passwords doesn't match");
        
    } else {
        setSuccess(password2);
        cpassvalid =true;
        
    }
}

    const usernameMedecin = document.getElementById('usernameMedecin');
    const emailMedecin = document.getElementById('emailMedecin');
    const passwordMedecin = document.getElementById('passwordMedecin');
    const password2Medecin = document.getElementById('cpasswordMedecin');

    var userMedvalid = false;
    var emailMedvalid = false;
    var passMedvalid = false;
    var cpassMedvalid = false;

    function validateInputsMedecin() {
    const usernameValue = usernameMedecin.value.trim();
    const emailValue = emailMedecin.value.trim();
    const passwordValue = passwordMedecin.value.trim();
    const password2Value = password2Medecin.value.trim();


    if (usernameValue === '') {
        setError(usernameMedecin, 'Username is required');

    } else {
        setSuccess(usernameMedecin);
         userMedvalid = true;
    }

    if (emailValue === '') {
        setError(emailMedecin, 'Email is required');

    } else if (!isValidEmail(emailValue)) {
        setError(emailMedecin, 'valid email address');

    } else {
        setSuccess(emailMedecin);
         emailMedvalid = true;
    }

    if (passwordValue === '') {
        setError(passwordMedecin, 'Password is required');

    } else if (passwordValue.length < 8) {
        setError(passwordMedecin, 'Password must be at least 8 character.');

    } else {
        setSuccess(passwordMedecin);
         passMedvalid = true;
         
    }

    if (password2Value === '') {
        setError(password2Medecin, 'Please confirm your password');

    } else if (password2Value !== passwordValue) {
        setError(password2Medecin, "Passwords doesn't match");

    } else {
        setSuccess(password2Medecin);
        cpassMedvalid = true;
    }

}

    const usernamePramedical = document.getElementById('usernamePramedical');
    const emailPramedical = document.getElementById('emailPramedical');
    const passwordPramedical = document.getElementById('passwordPramedical');
    const password2Pramedical = document.getElementById('cpasswordPramedical');
    const adressePramedical = document.getElementById('adressePramedical');
    const numPramedical = document.getElementById('numPramedical');



    var userPramedicalvalid = false;
    var emailPramedicalvalid = false;
    var passPramedicalvalid = false;
    var cpassPramedicalvalid = false;
    var adressePramedicalvalid = false;
    var numPramedicalvalid = false;

    function validateInputsPramedical() {
    const usernameValue = usernamePramedical.value.trim();
    const emailValue = emailPramedical.value.trim();
    const passwordValue = passwordPramedical.value.trim();
    const password2Value = password2Pramedical.value.trim();
    const adressePramedicalValue = adressePramedical.value.trim();
    const numPramedicalValue = numPramedical.value.trim();



    if (numPramedicalValue === '') {
        setError(numPramedical, 'nemero is required');

    } else if (!isValidnumber(numPramedicalValue)) {
        setError(numPramedical, 'valid nemero');

    } else {
        setSuccess(numPramedical);
        numPramedicalvalid = true;
    }

    if (usernameValue === '') {
        setError(usernamePramedical, 'Username is required');

    } else {
        setSuccess(usernamePramedical);
         userPramedicalvalid = true;
    }

    if (adressePramedicalValue === '') {
        setError(adressePramedical, 'Username is required');

    } else {
        setSuccess(adressePramedical);
        adressePramedicalvalid = true;
    }

    if (emailValue === '') {
        setError(emailPramedical, 'Email is required');

    } else if (!isValidEmail(emailValue)) {
        setError(emailPramedical, 'valid email address');

    } else {
        setSuccess(emailPramedical);
         emailPramedicalvalid = true;
    }

    if (passwordValue === '') {
        setError(passwordPramedical, 'Password is required');

    } else if (passwordValue.length < 8) {
        setError(passwordPramedical, 'Password must be at least 8 character.');

    } else {
        setSuccess(passwordPramedical);
         passPramedicalvalid = true;
         
    }

    if (password2Value === '') {
        setError(password2Pramedical, 'Please confirm your password');

    } else if (password2Value !== passwordValue) {
        setError(password2Pramedical, "Passwords doesn't match");

    } else {
        setSuccess(password2Pramedical);
        cpassPramedicalvalid = true;
    }

}

// function select type 
function changefunc() {
    var selcted = type.value;

    // get les DIV de in formilaire
    const sizeform = document.getElementById("form_valid");
    const Servicediv = document.querySelector(".Serviceform");
    const meddiv = document.querySelector(".medform");
    const Pramedicaldiv = document.querySelector(".PramedicalForm");
    const divf= document.querySelector(".alldivform");


    divf.style.display = "block";
    sizeform.style.width = "500px";

    //si l'utilisteur est service
    //affiche la form service Rien d'autre
   if (selcted == "service") {
    sizeform.style.width = "900px";
    Servicediv.style.display = "block";
    meddiv.style.display = "none";
    Pramedicaldiv.style.display = "none";
    console.log(selcted);

    //si l'utilisteur est medecin
    //affiche la form medecin Rien d'autre
   } else if (selcted == "medecin") {
    sizeform.style.width = "900px";
    Servicediv.style.display = "none";
    meddiv.style.display = "block";
    Pramedicaldiv.style.display = "none";

    console.log(selcted);

        //si l'utilisteur est Pramedical
    //affiche la form Pramedical Rien d'autre
} else if (selcted == "Pramedical") {
    sizeform.style.width = "900px";
    Servicediv.style.display = "none";
    meddiv.style.display = "none";
    Pramedicaldiv.style.display = "block";
    console.log(selcted);
   }
} 
