<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'new index/header.php'; ?>
</head>
<body>
    <?php include 'new index/navbar.php'; ?>
    <?php include 'new index/home.php'; ?>
    <?php include 'new index/features.php'; ?>
    <?php include 'new index/classes.php'; ?>
    <?php include 'new index/cta.php'; ?>
    <?php include 'new index/footer.php'; ?>
    <?php include 'new index/popup.php'; ?>

  <script>
    (function () {
      const username = localStorage.getItem("username");
      if (!username) return;

      document.getElementById("popupUsername").textContent = username;
      const popup = document.getElementById("welcomePopup");
      popup.style.display = "flex";

      document.getElementById("closeWelcome").addEventListener("click", function () {
        popup.style.display = "none";
      });
    })();
  </script>

</body>
</html>