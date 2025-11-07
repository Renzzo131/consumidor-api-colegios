<!-- start page title -->
<style>
  /* Reutilizamos los estilos base del ejemplo */
  .hero-section {
    background: linear-gradient(135deg, #D8232A 0%, #bebebeff 100%);
    border-radius: 20px;
    padding: 60px 40px;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(255, 200, 55, 0.3);
    position: relative;
    overflow: hidden;
  }

  .hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
  }

  .hero-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
  }

  .hero-content {
    position: relative;
    z-index: 2;
  }

  .hero-section h1 {
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  }

  .filter-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
  }

  .filter-section h4 {
    color: #333;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .filter-section h4::before {
    content: '';
    width: 4px;
    height: 30px;
    background: linear-gradient(135deg, #D8232A 0%, #bebebeff 100%);
    border-radius: 10px;
  }

  .form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
    font-size: 0.9rem;
  }

  .form-control {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 15px;
    background: #f8f9fa;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #FFC837;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 200, 55, 0.1);
  }

  .btn-update {
    background: linear-gradient(135deg, #D8232A 0%, #bebebeff 100%);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 200, 55, 0.4);
  }

  .btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 200, 55, 0.6);
    color: white;
  }

  @media (max-width: 768px) {
    .hero-section {
      padding: 40px 20px;
    }

    .hero-section h1 {
      font-size: 1.8rem;
    }
  }
</style>

<div class="container-fluid px-4 py-4">
  <!-- Hero Section -->
  <div class="hero-section">
    <div class="hero-content row align-items-center">
      <div class="col-lg-8">
        <h1>Mi Token</h1>
      </div>
    </div>
  </div>

  <!-- Token Section -->
  <div class="filter-section">
    <h4>Gestión del Token</h4>
    <div class="row align-items-end">
      <div class="col-md-9 mb-3">
        <label for="token_usuario" class="form-label">Tu Token Actual</label>
        <input type="text" class="form-control" id="token_usuario" value="1234abcd5678efgh" readonly>
      </div>
      <div class="col-md-3 mb-3 text-end">
<button type="button" class="btn-update" onclick="actualizar_token();">
  Actualizar
</button>

      </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_token.js"></script>
<script>
  mostrar_token();
</script>


<!-- end page title -->
