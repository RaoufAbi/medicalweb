<?php
include('assets/php/config.php');

if (isset($_POST['submit'])) {
  $user_type = $_POST['user_type'];
  if ($user_type == 'Paramedical') {
    include('assets/php/Paramedical_SignUp.php');

  } elseif ($user_type == 'medecin') {
    include('assets/php/Medecin_SignUp.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/signup.css" />
  <style>
    body {
      background: var(--color-4);
      overflow: hidden;
    }

    .error {
      color: red;
      font-size: 12px;
    }

    .success {
      border-color: green;
    }
  </style>
</head>

<body>
  <div class="header finisher-header" style="width: 100%; height: 100%">
    <div class="form-container">
      <form action="" method="post" id="form_valid" autocomplete="off">
        <h3>S'inscrire maintenant</h3>
        <select name="user_type" id="type" onchange="changefunc()">
          <option style="display: none" value="vide">&#160;</option>
          <option value="Paramedical">Paramedical</option>
          <option value="medecin">medecin</option>
        </select>
        <div class="alldivform" style="display: none">
          <!-- Formulaire Paramedical -->
          <div class="Paramedical_Form">
            <div class="inputcontrol">
              <label for="">Le nom complet</label>
              <input type="text" name="nameP" id="username" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Adresse e-mail</label>
              <input type="text" name="emailP" id="email" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Date de naissance</label>
              <input type="date" name="date_naissanceP" id="date_naissance_p" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Bio "max 30 mots"</label>
              <input type="text" name="bioP" id="biop" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Numero de telephone</label>
              <input type="text" name="phone_numberP" id="phone_Parmedical" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">les annees d'experience</label>
              <input type="number" name="expP" id="phone_Parmedical" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">matricule du diplôme</label>
              <input type="text" name="diplomeP" id="phone_Parmedical" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Sexe</label>
              <select name="sexeP">
                <option style="display: none" value="vide">&#160;</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
            </div>
            <div class="inputcontrol">
              <label for="">Specialite</label>
              <select name="spcP">
                <option style="display: none" value="vide">&#160;</option>
                <option value="ISP">ISP</option>
                <option value="KSP">KSP</option>
                <option value="DSP">DSP</option>
                <option value="MIMSP">MIMSP</option>
                <option value="LSP">LSP</option>
                <option value="ASSP">ASSP</option>
              </select>
            </div>
            <div class="inputcontrol">
              <label for="">Mot de passe</label>
              <input type="password" name="passwordP" id="password" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Confirmez le mot de passe</label>
              <input type="password" name="cpasswordP" id="cpassword" />
              <div class="error"></div>
            </div>
          </div>

          <!-- Formulaire Medecin -->
          <div class="medform">
            <div class="inputcontrol">
              <label for="">Le nom complet</label>
              <input type="text" name="nameM" id="usernameM" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Adresse e-mail</label>
              <input type="text" name="emailM" id="emailM" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Date de naissance</label>
              <input type="date" name="date_naissance_M" id="date_naissance_M" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Bio "max 30 mots"</label>
              <input type="text" name="bioM" id="bioM" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Numero de telephone</label>
              <input type="text" name="phone_M" id="phone_M" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">les annees d'experience</label>
              <input type="number" name="expM" id="phone_Parmedical" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">matricule du diplôme</label>
              <input type="text" name="diplomeM" id="phone_Parmedical" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Sexe</label>
              <select name="sexeM">
                <option style="display: none" value="vide">&#160;</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
            </div>
            <div class="inputcontrol">
              <label for="">Specialite</label>
              <select name="specialiteM">
                <option style="display: none" value="vide">&#160;</option>
                <option value="Generale">Generale</option>
                <option value="Cardiologie">Cardiologie</option>
                <option value="Pneumologie">Pneumologie</option>
                <option value="Oncologie">Oncologie</option>
                <option value="Infectiologie">Infectiologie</option>
                <option value="autre">Autre</option>
              </select>
            </div>
            <div class="inputcontrol">
              <label for="">Mot de passe</label>
              <input type="password" name="passwordM" id="passwordM" />
              <div class="error"></div>
            </div>
            <div class="inputcontrol">
              <label for="">Confirmez le mot de passe</label>
              <input type="password" name="cpasswordM" id="cpasswordM" />
              <div class="error"></div>
            </div>
          </div>

          <input type="submit" name="submit" value="S'inscrire" class="form-btn" />
        </div>
        <p>
          Vous avez dejà un compte? <a href="/">Connexion</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById("form_valid");
    const type = document.getElementById("type");

    // elements du formulaire Paramedical
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const password2 = document.getElementById("cpassword");
    const biop = document.getElementById("biop");
    const date_naissance_p = document.getElementById("date_naissance_p");
    const phone_Parmedical = document.getElementById("phone_Parmedical");

    // elements du formulaire medecin
    const usernameM = document.getElementById("usernameM");
    const emailM = document.getElementById("emailM");
    const passwordM = document.getElementById("passwordM");
    const cpasswordM = document.getElementById("cpasswordM");
    const bioM = document.getElementById("bioM");
    const date_naissance_M = document.getElementById("date_naissance_M");
    const phone_M = document.getElementById("phone_M");

    // Variables de validation pour Paramedical
    var uservalid = false;
    var emailvalid = false;
    var passvalid = false;
    var cpassvalid = false;
    var biopvalid = false;
    var phone_Parmedicalvalid = false;
    var date_naissance_pvalid = false;

    // Variables de validation pour medecin
    var usernameMvalid = false;
    var emailMvalid = false;
    var passwordMvalid = false;
    var cpasswordMvalid = false;
    var bioMvalid = false;
    var phone_Mvalid = false;
    var date_naissance_Mvalid = false;

    // ecouteur d'evenement pour la soumission du formulaire
    form.addEventListener("submit", (e) => {
      var typevalue = type.value;

      if (typevalue === "Paramedical") {
        validateInputsParamedical();
        if (
          !uservalid ||
          !emailvalid ||
          !passvalid ||
          !cpassvalid ||
          !biopvalid ||
          !phone_Parmedicalvalid ||
          !date_naissance_pvalid
        ) {
          e.preventDefault(); // Empêche la soumission si la validation echoue
        }
      } else if (typevalue === "medecin") {
        validateInputsMedecin();
        if (
          !usernameMvalid ||
          !emailMvalid ||
          !passwordMvalid ||
          !cpasswordMvalid ||
          !bioMvalid ||
          !phone_Mvalid ||
          !date_naissance_Mvalid
        ) {
          e.preventDefault(); // Empêche la soumission si la validation echoue
        }
      }
    });

    // Fonction pour afficher les erreurs
    const setError = (element, message) => {
      const inputControl = element.parentElement;
      const errorDisplay = inputControl.querySelector(".error");

      errorDisplay.innerText = message;
      inputControl.classList.add("error");
      inputControl.classList.remove("success");
    };

    // Fonction pour indiquer un succes
    const setSuccess = (element) => {
      const inputControl = element.parentElement;
      const errorDisplay = inputControl.querySelector(".error");

      errorDisplay.innerText = "";
      inputControl.classList.add("success");
      inputControl.classList.remove("error");
    };

    // Validation de l'email
    const isValidEmail = (email) => {
      const re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    };

    // Validation du numero de telephone
    const isValidPhone = (phone) => {
      const re = /^\d{10}$/; // Exemple : 10 chiffres pour un numero de telephone
      return re.test(String(phone));
    };

    // Validation du formulaire Paramedical
    const validateInputsParamedical = () => {
      const usernameValue = username.value.trim();
      const emailValue = email.value.trim();
      const passwordValue = password.value.trim();
      const password2Value = password2.value.trim();
      const biopValue = biop.value.trim();
      const date_naissance_pValue = date_naissance_p.value.trim();
      const phone_ParmedicalValue = phone_Parmedical.value.trim();

      // Validation du nom d'utilisateur
      if (usernameValue === "") {
        setError(username, "Le nom d'utilisateur est requis");
        uservalid = false;
      } else {
        setSuccess(username);
        uservalid = true;
      }

      // Validation de l'email
      if (emailValue === "") {
        setError(email, "L'email est requis");
        emailvalid = false;
      } else if (!isValidEmail(emailValue)) {
        setError(email, "Veuillez fournir un email valide");
        emailvalid = false;
      } else {
        setSuccess(email);
        emailvalid = true;
      }

      // Validation du mot de passe
      if (passwordValue === "") {
        setError(password, "Le mot de passe est requis");
        passvalid = false;
      } else if (passwordValue.length < 8) {
        setError(password, "Le mot de passe doit contenir au moins 8 caracteres");
        passvalid = false;
      } else {
        setSuccess(password);
        passvalid = true;
      }

      // Validation de la confirmation du mot de passe
      if (password2Value === "") {
        setError(password2, "Veuillez confirmer votre mot de passe");
        cpassvalid = false;
      } else if (password2Value !== passwordValue) {
        setError(password2, "Les mots de passe ne correspondent pas");
        cpassvalid = false;
      } else {
        setSuccess(password2);
        cpassvalid = true;
      }

      // Validation de la bio
      if (biopValue === "") {
        setError(biop, "La bio est requise");
        biopvalid = false;
      } else if (biopValue.split(" ").length > 30) {
        setError(biop, "La bio ne doit pas depasser 30 mots");
        biopvalid = false;
      } else {
        setSuccess(biop);
        biopvalid = true;
      }

      // Validation de la date de naissance
      if (date_naissance_pValue === "") {
        setError(date_naissance_p, "La date de naissance est requise");
        date_naissance_pvalid = false;
      } else {
        setSuccess(date_naissance_p);
        date_naissance_pvalid = true;
      }

      // Validation du numero de telephone
      if (phone_ParmedicalValue === "") {
        setError(phone_Parmedical, "Le numero de telephone est requis");
        phone_Parmedicalvalid = false;
      } else if (!isValidPhone(phone_ParmedicalValue)) {
        setError(phone_Parmedical, "Veuillez fournir un numero de telephone valide");
        phone_Parmedicalvalid = false;
      } else {
        setSuccess(phone_Parmedical);
        phone_Parmedicalvalid = true;
      }
    };

    // Validation du formulaire medecin
    const validateInputsMedecin = () => {
      const usernameValue = usernameM.value.trim();
      const emailValue = emailM.value.trim();
      const passwordMValue = passwordM.value.trim();
      const cpasswordMValue = cpasswordM.value.trim();
      const bioMValue = bioM.value.trim();
      const phone_MValue = phone_M.value.trim();
      const date_naissance_MValue = date_naissance_M.value.trim();

      // Validation du nom d'utilisateur
      if (usernameValue === "") {
        setError(usernameM, "Le nom d'utilisateur est requis");
        usernameMvalid = false;
      } else {
        setSuccess(usernameM);
        usernameMvalid = true;
      }

      // Validation de l'email
      if (emailValue === "") {
        setError(emailM, "L'email est requis");
        emailMvalid = false;
      } else if (!isValidEmail(emailValue)) {
        setError(emailM, "Veuillez fournir un email valide");
        emailMvalid = false;
      } else {
        setSuccess(emailM);
        emailMvalid = true;
      }

      // Validation du mot de passe
      if (passwordMValue === "") {
        setError(passwordM, "Le mot de passe est requis");
        passwordMvalid = false;
      } else if (passwordMValue.length < 8) {
        setError(passwordM, "Le mot de passe doit contenir au moins 8 caracteres");
        passwordMvalid = false;
      } else {
        setSuccess(passwordM);
        passwordMvalid = true;
      }

      // Validation de la confirmation du mot de passe
      if (cpasswordMValue === "") {
        setError(cpasswordM, "Veuillez confirmer votre mot de passe");
        cpasswordMvalid = false;
      } else if (cpasswordMValue !== passwordMValue) {
        setError(cpasswordM, "Les mots de passe ne correspondent pas");
        cpasswordMvalid = false;
      } else {
        setSuccess(cpasswordM);
        cpasswordMvalid = true;
      }

      // Validation de la bio
      if (bioMValue === "") {
        setError(bioM, "La bio est requise");
        bioMvalid = false;
      } else if (bioMValue.split(" ").length > 30) {
        setError(bioM, "La bio ne doit pas depasser 30 mots");
        bioMvalid = false;
      } else {
        setSuccess(bioM);
        bioMvalid = true;
      }

      // Validation du numero de telephone
      if (phone_MValue === "") {
        setError(phone_M, "Le numero de telephone est requis");
        phone_Mvalid = false;
      } else if (!isValidPhone(phone_MValue)) {
        setError(phone_M, "Veuillez fournir un numero de telephone valide");
        phone_Mvalid = false;
      } else {
        setSuccess(phone_M);
        phone_Mvalid = true;
      }

      // Validation de la date de naissance
      if (date_naissance_MValue === "") {
        setError(date_naissance_M, "La date de naissance est requise");
        date_naissance_Mvalid = false;
      } else {
        setSuccess(date_naissance_M);
        date_naissance_Mvalid = true;
      }
    };

    // function select type
    function changefunc() {
      var selcted = type.value;

      // get les DIV de in formilaire
      const sizeform = document.getElementById("form_valid");
      const patdiv = document.querySelector(".Paramedical_Form");
      const meddiv = document.querySelector(".medform");

      const divf = document.querySelector(".alldivform");

      divf.style.display = "block";
      sizeform.style.width = "500px";

      //si l'utilisteur est Paramedical
      //affiche la form Paramedical Rien d'autre
      if (selcted == "Paramedical") {
        sizeform.style.width = "900px";
        patdiv.style.display = "block";
        meddiv.style.display = "none";

        console.log(selcted);

        //si l'utilisteur est medecin
        //affiche la form medecin Rien d'autre
      } else if (selcted == "medecin") {
        sizeform.style.width = "900px";
        patdiv.style.display = "none";
        meddiv.style.display = "block";

        console.log(selcted);

        //si l'utilisteur est delegue medical
        //affiche la form delegue medical Rien d'autre
      }
    }
  </script>

  <script src="assets/js/finisher-header.es5.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    new FinisherHeader({
      count: 100,
      size: {
        min: 2,
        max: 19,
        pulse: 0,
      },
      speed: {
        x: {
          min: 0,
          max: 0.4,
        },
        y: {
          min: 0,
          max: 0.6,
        },
      },
      colors: {
        background: "#759cff",
        particles: ["#0048ff", "#ffffff", "#000000"],
      },
      blending: "overlay",
      opacity: {
        center: 1,
        edge: 0,
      },
      skew: 0,
      shapes: ["c"],
    });
  </script>
</body>

</html>