<script>
  document.querySelector("#name").addEventListener("blur", validateName);
  document.querySelector("#description").addEventListener("blur", validateDescription);
  document.querySelector("#image").addEventListener("blur", validateImage);
  document.querySelector("#active").addEventListener("blur", validateActive);
  document.querySelector("#username").addEventListener("blur", validateUsername);
  document.querySelector("#password").addEventListener("blur", validatePassword);


  // for password validation
  const regexPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/;
  // min 4 character and no special character
  const regexNoSpecialChar = /^(?!\s*$).+/;
  // no empty string
  const regexNoEmptyString = /^(?!\s*$).+/;
  const regexActive = /^(?!\s*$).+/;
  // image validate regex
  const regexImage = /\.(jpe?g|png|gif|bmp)$/i;


  function validateName(e) {
    const name = document.querySelector("#name");
    if (regexNoSpecialChar.test(name.value)) {
      name.classList.remove("is-invalid");
      name.classList.add("is-valid");
      return true;
    } else {
      name.classList.remove("is-valid");
      name.classList.add("is-invalid");
      return false;
    }
  }


  function validateDescription(e) {
    const description = document.querySelector("#description");
    if (regexNoEmptyString.test(description.value)) {
      description.classList.remove("is-invalid");
      description.classList.add("is-valid");
      return true;
    } else {
      description.classList.remove("is-valid");

      description.classList.add("is-invalid");
      return false;
    }
  }

  function validateImage(e) {
    const image = document.querySelector("#image");
    if (regexImage.test(image.value)) {
      image.classList.remove("is-invalid");
      image.classList.add("is-valid");
      return true;
    } else {
      image.classList.remove("is-valid");

      image.classList.add("is-invalid");
      return false;
    }
  }

  function validateActive(e) {
    const active = document.querySelector("#active");
    if (regexActive.test(active.value)) {
      active.classList.remove("is-invalid");
      active.classList.add("is-valid");
      return true;
    } else {
      active.classList.remove("is-valid");

      active.classList.add("is-invalid");
      return false;
    }
  }

  function validateUsername(e) {
    const username = document.querySelector("#username");
    if (regexNoEmptyString.test(username.value)) {
      username.classList.remove("is-invalid");
      username.classList.add("is-valid");
      return true;
    } else {
      username.classList.remove("is-valid");

      username.classList.add("is-invalid");
      return false;
    }
  }

  function validatePassword(e) {
    const password = document.querySelector("#password");
    if (regexPassword.test(password.value)) {
      password.classList.remove("is-invalid");
      password.classList.add("is-valid");
      return true;
    } else {
      password.classList.remove("is-valid");

      password.classList.add("is-invalid");
      return false;
    }
  }

  (function() {
    const forms = document.querySelectorAll(".needs-validation");

    for (let form of forms) {
      form.addEventListener(
        "submit",
        function(event) {
          if (
            !form.checkValidity() ||
            !validateName() ||
            !validateDescription() ||
            !validateImage() ||
            !validateActive() ||
            !validatePassword()
          ) {
            event.preventDefault();
            event.stopPropagation();
          } else {
            form.classList.add("was-validated");
          }
        },
        false
      );
    }
  })();
</script>