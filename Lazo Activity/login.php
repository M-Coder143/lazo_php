<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eclipse Realms · Sign in</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="style/login.css">
</head>
<body>
  <div class="container" style="max-width: 520px;">
    <div class="auth-card">
      <a href="#" class="brand">
        <i class="bi bi-fire"></i> Eclipse<span>Realms</span>
      </a>

      <form id="myForm" action="index.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="signinEmail" class="form-label">Email address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" id="signinEmail" name="signinEmail" placeholder="Email address" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="signinPassword" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="signinPassword" name="signinPassword" placeholder="••••••••" required>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <a href="#" class="form-check-label" style="color: #e8b923; text-decoration: none; font-size: 0.85rem;">Forgot password?</a>
        </div>
        <button type="submit" class="btn-auth-primary">
          <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
        </button>
        <div id="attemptMessage" style="display:none; color:#ff6b6b; font-size:0.8rem; margin-top:0.5rem; text-align:center;"></div>
        <div id="lockMessage" style="display:none; color:#ff6b6b; font-size:0.8rem; margin-top:0.5rem; text-align:center;">Too many failed attempts.</div>
      </form>

      <div class="divider">or continue with</div>
      <div class="social-row">
        <a href="#" class="social-btn"><i class="bi bi-steam"></i></a>
        <a href="#" class="social-btn"><i class="bi bi-playstation"></i></a>
        <a href="#" class="social-btn"><i class="bi bi-xbox"></i></a>
        <a href="#" class="social-btn"><i class="bi bi-discord"></i></a>
      </div>

      <div class="auth-footer">
        Don't have an account?
        <a href="register.php" style="color: #e8b923; text-decoration: none; font-weight: 500;">Register</a>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function () {
    let failedAttempts = 0;
    const maxAttempts = 5;

    const STATIC_EMAIL = "player@gmail.com";
    const STATIC_PASSWORD = "Player@123";

    $("#myForm").validate({
      rules: {
        signinEmail: { required: true, email: true },
        signinPassword: { required: true, minlength: 8 }
      },
      messages: {
        signinEmail: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address."
        },
        signinPassword: {
          required: "Please enter your password.",
          minlength: "Password must be at least 8 characters."
        }
      },
      errorClass: "error",
      errorElement: "div",
      errorPlacement: function (error, element) {
        error.css({ color: "#ff6b6b", "font-size": "0.8rem", "margin-top": "0.35rem" });
        error.insertAfter(element.closest(".input-group"));
      },
      submitHandler: function (form) {
        const email = $("#signinEmail").val();
        const password = $("#signinPassword").val();

        if (email === STATIC_EMAIL && password === STATIC_PASSWORD) {
          failedAttempts = 0;
          localStorage.setItem("username", "Player");
          window.location.replace("index.php");
        } else {
          failedAttempts++;
          if (failedAttempts >= maxAttempts) {
            $(".btn-auth-primary").prop("disabled", true)
              .css({ "opacity": "0.5", "cursor": "not-allowed" });
            $("#signinEmail, #signinPassword").prop("disabled", true);
            $("#lockMessage").show();
            $("#attemptMessage").hide();
          } else {
            const remaining = maxAttempts - failedAttempts;
            $("#attemptMessage")
              .text("Invalid credentials. " + remaining + " attempt(s) remaining.")
              .show();
          }
        }
        return false;
      }
    });
  });
</script>

</body>
</html>