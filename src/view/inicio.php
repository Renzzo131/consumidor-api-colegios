<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Consumidor de API - Colegios del Perú</title>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f6fa;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
    }

    /* Hero principal */
    .hero-section {
      background: linear-gradient(135deg, #D8232A 0%, #bebebeff 100%);
      border-radius: 20px;
      padding: 60px 40px;
      margin-bottom: 40px;
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
      text-align: center;
    }

    .hero-section h1 {
      color: white;
      font-size: 2.4rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .hero-section p {
      color: rgba(255, 255, 255, 0.95);
      font-size: 1.1rem;
      margin-bottom: 0;
    }

    /* Filtros */
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
      display: block;
    }

    .form-control {
      width: 100%;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      padding: 10px 15px;
      transition: all 0.3s ease;
      background: #f8f9fa;
    }

    .form-control:focus {
      border-color: #FFC837;
      background: white;
      box-shadow: 0 0 0 3px rgba(255, 200, 55, 0.1);
      outline: none;
    }

    .btn {
      padding: 12px 40px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .btn-search {
      background: linear-gradient(135deg, #D8232A 0%, #bebebeff 100%);
      color: white;
      border: none;
      box-shadow: 0 4px 15px rgba(255, 200, 55, 0.4);
    }

    .btn-search:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 200, 55, 0.6);
    }

    /* Tabla de resultados */
    .results-section {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    table th, table td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #f1f1f1;
      color: #333;
      font-weight: 700;
    }

    table tr:hover {
      background-color: #fafafa;
    }

    @media (max-width: 768px) {
      .hero-section {
        padding: 40px 20px;
      }

      .hero-section h1 {
        font-size: 1.8rem;
      }

      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <!-- Hero -->
    <div class="hero-section">
      <div class="hero-content">
        <h1>Sistema Consumidor de API</h1>
        <p>Consulta los Centros Educativos del Perú mediante la API oficial</p>
      </div>
    </div>

    <!-- Filtros -->
    <div class="filter-section">
      <h4>Datos de Conexión y Búsqueda</h4>
      <form id="frmApi">
        <input type="hidden" class="form-control" id="ruta_api" value="https://apicolegios.serviciosvirtuales.com.pe/">

        <label for="data" class="form-label mt-3">Ingrese Distrito:</label>
        <input type="text" class="form-control" name="data" id="data" placeholder="Ejemplo: Miraflores">

        <div class="text-center mt-4">
          <button type="button" id="btn_buscar" class="btn btn-search" onclick="llamar_api();">
            🔍 Buscar Centros Educativos
          </button>
        </div>
      </form>
    </div>

    <!-- Resultados -->
    <div class="results-section">
      <h4>Resultados de la Búsqueda</h4>
      <table>
        <thead>
          <tr>
            <th>N°</th>
            <th>Código Modular</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Provincia</th>
            <th>Distrito</th>
          </tr>
        </thead>
        <tbody id="contenido"></tbody>
      </table>
    </div>
  </div>

  <script src="<?php echo BASE_URL; ?>src/view/js/api.js"></script>
</body>
</html>
