<!-- start page title -->
<style>
  .hero-section {
    background: linear-gradient(135deg, #FFC837 0%, #FF8008 100%);
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

  .hero-section p {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 0;
  }

  .stats-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }

  .stats-card:hover {
    transform: translateY(-5px);
    border-color: #FFC837;
    box-shadow: 0 8px 30px rgba(255, 200, 55, 0.3);
  }

  .stats-card .icon {
    font-size: 3rem;
    margin-bottom: 15px;
  }

  .stats-card h3 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
  }

  .stats-card p {
    color: #666;
    font-size: 0.95rem;
    margin: 0;
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
    background: linear-gradient(135deg, #FFC837 0%, #FF8008 100%);
    border-radius: 10px;
  }

  .form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
    font-size: 0.9rem;
  }

  .form-control,
  .form-select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 15px;
    transition: all 0.3s ease;
    background: #f8f9fa;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #FFC837;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 200, 55, 0.1);
  }

  .btn-search {
    background: linear-gradient(135deg, #FFC837 0%, #FF8008 100%);
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 200, 55, 0.4);
  }

  .btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 200, 55, 0.6);
    color: white;
  }

  .btn-reset {
    background: white;
    color: #666;
    border: 2px solid #e0e0e0;
    padding: 12px 40px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .btn-reset:hover {
    border-color: #FFC837;
    color: #FF8008;
    background: #fffbf0;
  }

  .results-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  }

  .results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
  }

  .results-header h5 {
    color: #333;
    font-weight: 700;
    margin: 0;
  }

  .badge-yellow {
    background: linear-gradient(135deg, #FFC837 0%, #FF8008 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
  }

  @media (max-width: 768px) {
    .hero-section {
      padding: 40px 20px;
    }

    .hero-section h1 {
      font-size: 1.8rem;
    }

    .stats-card {
      margin-bottom: 20px;
    }
  }
</style>

<div class="container-fluid px-4 py-4">
  <!-- Hero Section -->
  <div class="hero-section">
    <div class="hero-content row align-items-center">
      <div class="col-lg-8">
        <h1>Sistema de Centros Educativos del Perú</h1>
        <p>
          Accede a la información completa de todos los centros educativos del país. 
          Busca por código modular, nombre, ubicación geográfica, nivel educativo y más. 
          Datos actualizados y validados para consultas del API.
        </p>
      </div>
      <div class="col-lg-4 text-end d-none d-lg-block">
        <img src="https://cdn-icons-png.flaticon.com/512/3976/3976625.png" 
             alt="Educación" 
             style="max-width: 200px; filter: brightness(0) invert(1); opacity: 0.9;">
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="stats-card">
        <h3 id="total_colegios">---</h3>
        <p>Centros Educativos</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="stats-card">
        <h3 id="total_departamentos">25</h3>
        <p>Departamentos</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="stats-card">
        <h3 id="total_niveles">3</h3>
        <p>Niveles Educativos</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="stats-card">
        <h3 id="total_activos">---</h3>
        <p>Instituciones Activas</p>
      </div>
    </div>
  </div>

  <!-- Filter Section -->
  <div class="filter-section">
    <h4>Filtros de Búsqueda Avanzada</h4>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="busqueda_codigo" class="form-label">Código Modular</label>
        <input type="text" class="form-control" id="busqueda_codigo" placeholder="Ej: 0234567">
      </div>

      <div class="col-md-4 mb-3">
        <label for="busqueda_nombre" class="form-label">Nombre del Centro Educativo</label>
        <input type="text" class="form-control" id="busqueda_nombre" placeholder="Ej: San Martín de Porres">
      </div>

      <div class="col-md-4 mb-3">
        <label for="busqueda_departamento" class="form-label">Departamento</label>
        <select class="form-select" id="busqueda_departamento">
          <option value="">Todos los departamentos</option>
          <option value="Lima">Lima</option>
          <option value="Arequipa">Arequipa</option>
          <option value="Cusco">Cusco</option>
          <option value="La Libertad">La Libertad</option>
          <option value="Piura">Piura</option>
          <!-- Agregar más departamentos -->
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_provincia" class="form-label">Provincia</label>
        <input type="text" class="form-control" id="busqueda_provincia" placeholder="Ej: Lima">
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_distrito" class="form-label">Distrito</label>
        <input type="text" class="form-control" id="busqueda_distrito" placeholder="Ej: Miraflores">
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_nivel" class="form-label">Nivel Educativo</label>
        <select class="form-select" id="busqueda_nivel">
          <option value="">Todos los niveles</option>
          <option value="A1">Inicial - Jardín</option>
          <option value="A2">Inicial - Cuna-Jardín</option>
          <option value="B0">Primaria</option>
          <option value="F0">Secundaria</option>
          <option value="E0">Superior Tecnológica</option>
          <option value="T0">Superior Pedagógica</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_gestion" class="form-label">Gestión</label>
        <select class="form-select" id="busqueda_gestion">
          <option value="">Todas las gestiones</option>
          <option value="Pública">Pública</option>
          <option value="Privada">Privada</option>
          <option value="Pública - Convenio">Pública - Convenio</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_forma_atencion" class="form-label">Forma de Atención</label>
        <select class="form-select" id="busqueda_forma_atencion">
          <option value="">Todas las formas</option>
          <option value="Escolarizada">Escolarizada</option>
          <option value="No escolarizada">No escolarizada</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_area" class="form-label">Área</label>
        <select class="form-select" id="busqueda_area">
          <option value="">Todas las áreas</option>
          <option value="Urbano">Urbano</option>
          <option value="Rural">Rural</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_genero" class="form-label">Género de Alumnos</label>
        <select class="form-select" id="busqueda_genero">
          <option value="">Todos</option>
          <option value="Mixto">Mixto</option>
          <option value="Mujeres">Mujeres</option>
          <option value="Hombres">Hombres</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label for="busqueda_estado" class="form-label">Estado</label>
        <select class="form-select" id="busqueda_estado">
          <option value="">Todos los estados</option>
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
        </select>
      </div>
    </div>

    <div class="text-center mt-4">
      <button type="button" class="btn btn-search me-3" onclick="numero_pagina(1);">
        <i class="mdi mdi-magnify"></i> Buscar Centros Educativos
      </button>
      <button type="button" class="btn btn-reset" onclick="limpiarFiltros();">
        <i class="mdi mdi-refresh"></i> Limpiar Filtros
      </button>
    </div>
  </div>

  <!-- Results Section -->
  <div class="results-section">
    <div class="results-header">
      <h5>Resultados de la Búsqueda</h5>
      <div>
        <label for="cantidad_mostrar" class="me-2">Mostrar:</label>
        <select id="cantidad_mostrar" class="form-select d-inline-block" style="width: auto;" onchange="numero_pagina(1);">
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ms-2">registros</span>
      </div>
    </div>

    <!-- Hidden inputs for filters -->
    <input type="hidden" id="pagina" value="1">
    <input type="hidden" id="filtro_codigo_modular" value="">
    <input type="hidden" id="filtro_nombre" value="">
    <input type="hidden" id="filtro_departamento" value="">
    <input type="hidden" id="filtro_provincia" value="">
    <input type="hidden" id="filtro_distrito" value="">
    <input type="hidden" id="filtro_nivel" value="">
    <input type="hidden" id="filtro_atencion" value="">
    <input type="hidden" id="filtro_gestion" value="">

    <div id="tablas"></div>

    <div class="d-flex justify-content-between align-items-center mt-4">
      <div id="texto_paginacion_tabla"></div>
      <div id="paginacion_tabla">
        <ul class="pagination justify-content-end mb-0" id="lista_paginacion_tabla"></ul>
      </div>
    </div>
  </div>

  <div id="modals_editar"></div>
  <div id="modals_permisos"></div>
</div>

<script src="<?php echo BASE_URL; ?>src/view/js/functions_colegios.js"></script>
<script>
  listar_colegios();

  function limpiarFiltros() {
    document.getElementById('busqueda_codigo').value = '';
    document.getElementById('busqueda_nombre').value = '';
    document.getElementById('busqueda_departamento').value = '';
    document.getElementById('busqueda_provincia').value = '';
    document.getElementById('busqueda_distrito').value = '';
    document.getElementById('busqueda_nivel').value = '';
    document.getElementById('busqueda_gestion').value = '';
    document.getElementById('busqueda_forma_atencion').value = '';
    document.getElementById('busqueda_area').value = '';
    document.getElementById('busqueda_genero').value = '';
    document.getElementById('busqueda_estado').value = '';
    
    // Limpiar filtros ocultos
    document.getElementById('filtro_codigo_modular').value = '';
    document.getElementById('filtro_nombre').value = '';
    document.getElementById('filtro_departamento').value = '';
    document.getElementById('filtro_provincia').value = '';
    document.getElementById('filtro_distrito').value = '';
    document.getElementById('filtro_nivel').value = '';
    document.getElementById('filtro_atencion').value = '';
    document.getElementById('filtro_gestion').value = '';
    
    numero_pagina(1);
  }
</script>
<!-- end page title -->
