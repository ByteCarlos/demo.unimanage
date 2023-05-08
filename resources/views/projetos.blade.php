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
            <a class="navbar-brand" href="/"><img src={{ asset('img/logo.png') }} alt="logomarca"
                    height="100px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">
                        <a class="nav-link" href="/">Início</a>
                    </li>
                    <li class="nav-item <?= $_SERVER['REQUEST_URI'] == '/projetos' ? 'active' : '' ?>">
                        <a class="nav-link" href="/projetos">Projetos</a>
                    </li>
                    <li class="nav-item <?= $_SERVER['REQUEST_URI'] == '/eventos' ? 'active' : '' ?>">
                        <a class="nav-link" href="/eventos">Eventos</a>
                    </li>
                    <li class="nav-item <?= $_SERVER['REQUEST_URI'] == '/tarefas' ? 'active' : '' ?>">
                        <a class="nav-link" href="/tarefas">Tarefas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container projects-container">
        <div class="project-header-buttons">
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-modal">Criar Projeto</button>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Código do projeto</th>
                    <th scope="col">Nome do projeto</th>
                    <th scope="col">Time</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de entrega</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $proj)
                    <tr>
                        <td>{{ $proj->project_cod }}</td>
                        <td>{{ $proj->name }}</td>
                        <td>{{ $proj->team->name }}</td>
                        <td>{{ $proj->description }}</td>
                        <td>{{ date('d/m/Y', strtotime($proj->delivery_date)) }}</td>
                        <td style="display: flex;justify-content: center;flex-direction: row;">
                            <button class="btn btn-primary edit-project" data-id="{{ $proj->id }}" data-toggle="modal" data-target="#update-modal" style="margin-right:10px;">Editar</button>
                            <form action="{{ route('projetos.delete', ['id' => $proj->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Carregando o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit-project').on('click', function() {
                console.log('click')
                var projectId = $(this).data('id');
                var url = '{{ route("projetos.edit", ":id") }}';
                url = url.replace(':id', projectId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.edit-project-modal input[name="project_cod"]').val(data.project_cod);
                        $('.edit-project-modal input[name="project_name"]').val(data.name);
                        $('.edit-project-modal textarea[name="project_description"]').val(data.description);
                        $('.edit-project-modal input[name="project_delivery_date"]').val(data.delivery_date);
                        $('.edit-project-modal #update-modal form').attr('action', '{{ route("projetos.update", ":id") }}'.replace(':id', data.id));
                    }
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</body>
<div class="modal" tabindex="-1" role="dialog" id="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/projetos">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Código</label>
                        <input name="project_cod" type="text" class="form-control" aria-describedby="Nome" placeholder="Digite o Código do Projeto" required>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="project_name" type="text" class="form-control" aria-describedby="Nome" placeholder="Digite o Nome do Projeto" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="project_description" class="form-control" id="project_description" placeholder="Escreva uma descrição para seu projeto"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Data de Entrega</label>
                      <input name="project_delivery_date" id="delivery_date" type="date" class="form-control">
                  </div>
                    <div class="form-group">
                      <label>Nome do Time</label>
                      <input name="team_name" type="text" class="form-control" aria-describedby="team_name" placeholder="Digite o Nome do Time" required>
                  </div>
                    <div class="form-group" style="display: grid">
                      <label>Orientador</label>
                      <select name="project_instructor[]" id="project_instructor" multiple class="form-control select2">
                        @foreach ($instructors as $instructor)
                            <option value="{{$instructor->id}}">{{$instructor->name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Criar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal edit-project-modal" tabindex="-1" role="dialog" id="update-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('projetos.update', ['id' => $proj->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Código</label>
                        <input name="project_cod" type="text" class="form-control" aria-describedby="Nome" placeholder="Digite o Código do Projeto" required>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="project_name" type="text" class="form-control" aria-describedby="Nome" placeholder="Digite o Nome do Projeto" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="project_description" class="form-control" id="project_description" placeholder="Escreva uma descrição para seu projeto"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Data de Entrega</label>
                      <input name="project_delivery_date" id="delivery_date" type="date" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
  $('.select2').select2();
});

</script>
</html>