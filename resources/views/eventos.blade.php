<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UniManage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href={{ asset('css/template.css') }}>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="/"><img src={{ asset('img/logo.png') }} alt="logomarca" height="100px" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item <?= $_SERVER['REQUEST_URI'] == "/" ? 'active' : '' ?>">
              <a class="nav-link" href="/">Início</a>
            </li>
            <li class="nav-item <?= $_SERVER['REQUEST_URI'] == "/projetos" ? 'active' : '' ?>">
              <a class="nav-link" href="/projetos">Projetos</a>
            </li>
            <li class="nav-item <?= $_SERVER['REQUEST_URI'] == "/eventos" ? 'active' : '' ?>">
              <a class="nav-link" href="/eventos">Eventos</a>
            </li>
            <li class="nav-item <?= $_SERVER['REQUEST_URI'] == "/sobre" ? 'active' : '' ?>">
              <a class="nav-link" href="/sobre">Sobre</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="main-container">
      
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
