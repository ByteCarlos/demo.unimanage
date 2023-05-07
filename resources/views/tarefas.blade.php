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
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-modal">Criar Tarefa</button>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome da Tarefa</th>
                    <th scope="col">Projeto Vinculado</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td style="display: flex;justify-content: center;flex-direction: row;">
                            <button class="btn btn-primary edit-task" data-id="{{ $task->id }}" data-toggle="modal" data-target="#update-modal" style="margin-right:10px;">Editar</button>
                            <form action="{{ route('tarefas.delete', ['id' => $task->id]) }}" method="POST">
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
            $('.edit-task').on('click', function() {
                console.log('click')
                var taskId = $(this).data('id');
                var url = '{{ route("tarefas.edit", ":id") }}';
                url = url.replace(':id', taskId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.edit-task-modal input[name="task_name"]').val(data.name);
                        $('.edit-task-modal select[name="project_event"]').val(data.project_fk);
                        $('.edit-task-modal #update-modal form').attr('action', '{{ route("tarefas.update", ":id") }}'.replace(':id', data.id));
                    }
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<div class="modal" tabindex="-1" role="dialog" id="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/tarefas">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="task_name" type="text" class="form-control" aria-describedby="task_name"
                            placeholder="Digite o nome da tarefa" required>
                    </div>
                    <div class="form-group">
                        <label>Projeto</label>
                        <select name="project_task" class="form-control" id="project_task">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
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

<div class="modal edit-task-modal" tabindex="-1" role="dialog" id="update-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tarefas.update', ['id' => $task->id]) }}" method="POST">
                @csrf   
                @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                      <label>Nome</label>
                      <input name="task_name" type="text" class="form-control" aria-describedby="task_name"
                          placeholder="Digite o nome da tarefa" required>
                  </div>
                  <div class="form-group">
                      <label>Projeto</label>
                      <select name="project_task" class="form-control" id="project_task">
                          @foreach ($projects as $project)
                              <option value="{{ $project->id }}">{{ $project->name }}</option>
                          @endforeach
                      </select>
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

</html>
