<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIGOF</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      background: white;
      position: relative;
      overflow: hidden;
    }

    .login-wrapper {
      width: 100%;
      height: 100vh;
      display: flex;
      position: relative;
      z-index: 1;
    }

    /* Left side - Login form */
    .login-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      padding: 40px;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
    }

    .brand-logo {
      margin-bottom: 10px;
    }

    .brand-logo img {
      max-width: 180px;
      height: auto;
      display: block;
    }

    .welcome-text {
      margin-bottom: 40px;
      display: flex;
      justify-content: center;
      text-align: center;
    }

    .welcome-text h1 {
      color: #667eea;
      font-size: 2.5rem;
      font-weight: 700;
      letter-spacing: 3px;
      margin-bottom: 5px;
    }

    .welcome-text p {
      color: #999;
      font-size: 0.95rem;
    }

    .form-group {
      margin-bottom: 25px;
      position: relative;
    }

    .form-group label {
      display: block;
      color: #333;
      font-size: 0.9rem;
      margin-bottom: 8px;
      font-weight: 500;
    }

    .form-group input {
      width: 100%;
      padding: 14px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 1rem;
      outline: none;
      transition: all 0.3s ease;
      background: #f8f9fa;
    }

    .form-group input:focus {
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 0.85rem;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #666;
    }

    .remember-me input[type="checkbox"] {
      width: 16px;
      height: 16px;
      cursor: pointer;
      accent-color: #667eea;
    }

    .forgot-password {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .forgot-password:hover {
      color: #764ba2;
    }

    .btn-submit {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #FFC837 0%, #FF8008 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(255, 200, 55, 0.4);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 200, 55, 0.6);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    /* Right side - Illustration */
    .illustration-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px;
      position: relative;
    }

    .illustration-container {
      width: 100%;
      max-width: 500px;
      height: 500px;
      background: white;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      position: relative;
      overflow: hidden;
    }
.illustration-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
}

    .illustration-placeholder {
      text-align: center;
      padding: 40px;
    }

    .illustration-placeholder svg {
      width: 200px;
      height: 200px;
      margin-bottom: 20px;
      opacity: 0.3;
    }

    .illustration-placeholder p {
      color: #999;
      font-size: 1.1rem;
      line-height: 1.6;
    }

    .illustration-placeholder strong {
      color: #667eea;
      display: block;
      font-size: 1.3rem;
      margin-bottom: 10px;
    }

    /* Decorative elements around illustration */

    /* Responsive */
    @media (max-width: 968px) {
      .login-wrapper {
        flex-direction: column;
      }

      .illustration-section {
        display: none;
      }

      .login-section {
        padding: 20px;
      }
    }

    @media (max-width: 480px) {
      .welcome-text h1 {
        font-size: 2rem;
      }

      .login-container {
        max-width: 100%;
      }
    }
  </style>
  <!-- Sweet Alerts css -->
  <link href="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <script>
    const base_url = '<?php echo BASE_URL; ?>';
    const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
  </script>
</head>

<body>
  <div class="login-wrapper">
    <!-- Left side - Login Form -->
    <div class="login-section">
      <div class="login-container">
        <div class="brand-logo">
          <img src="<?php echo BASE_URL; ?>src/view/include/logo.png" alt="Logo">
        </div>

        <div class="welcome-text">
          <h1>Bienvenido</h1>
        </div>

        <form id="frm_login">
          <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" placeholder="Ingrese su DNI" required>
          </div>

          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>
          </div>


          <button type="submit" class="btn-submit">Ingresar</button>
        </form>
      </div>
    </div>

    <!-- Right side - Illustration -->
    <div class="illustration-section">
      <div class="illustration-container">
<img src="<?php echo BASE_URL; ?>src/view/include/colegios.webp" alt="imagen">
      </div>
    </div>
  </div>
</body>

<script src="<?php echo BASE_URL; ?>src/view/js/sesion.js"></script>
<!-- Sweet Alerts Js-->
<script src="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.js"></script>

</html>