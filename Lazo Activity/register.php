<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eclipse Realms · Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="style/register.css">
</head>
<body>
  <div class="container" style="max-width: 520px;">
    <div class="auth-card">
      <a href="#" class="brand">
        <i class="bi bi-fire"></i> Eclipse<span>Realms</span>
      </a>

      <form id="registerForm" action="login.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="registerName" class="form-label">Username</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
            <input type="text" class="form-control" id="registerName" name="registerName" placeholder="Create a username" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="registerEmail" class="form-label">Email address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="Email address" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="registerPassword" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="min. 8 characters" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="registerConfirm" class="form-label">Confirm password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
            <input type="password" class="form-control" id="registerConfirm" name="registerConfirm" placeholder="repeat password" required>
          </div>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck" required>
          <label class="form-check-label" for="termsCheck">
            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
          </label>
        </div>
        <button type="submit" class="btn-auth-primary">
          <i class="bi bi-person-plus me-2"></i> Create Account
        </button>
        <div id="successMessage" style="display:none; color:#4ade80; font-size:0.85rem; margin-top:0.75rem; text-align:center; padding:0.5rem; border:1px solid rgba(74,222,128,0.3); border-radius:6px; background:rgba(74,222,128,0.08);">
          <i class="bi bi-check-circle-fill"></i> Account created successfully!
        </div>
      </form>

      <div class="auth-footer">
        Already have an account?
        <a href="login.php" style="color: #e8b923; text-decoration: none; font-weight: 500;">Sign in</a>
      </div>
    </div>
  </div>

  <script>
  $(document).ready(function () {
    $.validator.addMethod("passwordMatch", function (value, element) {
      return value === $("#registerPassword").val();
    }, "Passwords do not match.");

    $("#registerForm").validate({
      rules: {
        registerName: { required: true, minlength: 3, maxlength: 10 },
        registerEmail: { required: true, email: true },
        registerPassword: { required: true, minlength: 8 },
        registerConfirm: { required: true, minlength: 8, passwordMatch: true },
        termsCheck: { required: true }
      },
      messages: {
        registerName: {
          required: "Please enter a username.",
          minlength: "Username must be at least 3 characters.",
          maxlength: "Username must not exceed 10 characters."
        },
        registerEmail: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address (e.g., user@example.com)."
        },
        registerPassword: {
          required: "Please enter a password.",
          minlength: "Password must be at least 8 characters."
        },
        registerConfirm: {
          required: "Please confirm your password.",
          minlength: "Password must be at least 8 characters.",
          passwordMatch: "Passwords do not match."
        },
        termsCheck: {
          required: "You must agree to the Terms of Service and Privacy Policy."
        }
      },
      errorClass: "error",
      errorElement: "div",
      errorPlacement: function (error, element) {
        error.css({ color: "#ff6b6b", "font-size": "0.8rem", "margin-top": "0.35rem" });
        if (element.attr("type") === "checkbox") {
          error.insertAfter(element.closest(".form-check"));
        } else {
          error.insertAfter(element.closest(".input-group"));
        }
      },
      submitHandler: function (form) {
        localStorage.setItem("username", $("#registerName").val());
        $("#successMessage").show();
        form.reset();
        setTimeout(function () {
          window.location.replace("login.php");
        }, 1500);
        return false;
      }
    });

    $("#registerPassword").on("keyup", function () {
      $("#registerConfirm").valid();
    });
  });
</script>

</body>
</html>