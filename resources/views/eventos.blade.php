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
                    <li class="nav-item <?= $_SERVER['REQUEST_URI'] == '/sobre' ? 'active' : '' ?>">
                        <a class="nav-link" href="/sobre">Sobre</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container projects-container">
        <div class="project-header-buttons">
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-modal">Criar Evento</button>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Data do Evento</th>
                    <th scope="col">Título do Evento</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Projeto Vinculado</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($event->date)) }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->project->name }}</td>
                        <td style="display: flex;justify-content: center;flex-direction: row;">
                            <button class="btn btn-primary edit-event" data-id="{{ $event->id }}" data-toggle="modal" data-target="#update-modal" style="margin-right:10px;">Editar</button>
                            <form action="{{ route('eventos.delete', ['id' => $event->id]) }}" method="POST">
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
            $('.edit-event').on('click', function() {
                console.log('click')
                var eventId = $(this).data('id');
                var url = '{{ route("eventos.edit", ":id") }}';
                url = url.replace(':id', eventId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.edit-event-modal input[name="event_name"]').val(data.name);
                        $('.edit-event-modal input[name="event_date"]').val(data.date);
                        $('.edit-event-modal input[name="event_location"]').val(data.location);
                        $('.edit-event-modal select[name="project_event"]').val(data.project_fk);
                        $('.edit-event-modal #update-modal form').attr('action', '{{ route("eventos.update", ":id") }}'.replace(':id', data.id));
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
                <h5 class="modal-title">Criar Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/eventos">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data do Evento</label>
                        <input name="event_date" id="event_date" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="event_name" type="text" class="form-control" aria-describedby="event_name"
                            placeholder="Digite o nome do evento" required>
                    </div>
                    <div class="form-group">
                        <label>Local</label>
                        <input name="event_location" type="text" class="form-control" aria-describedby="event_location"
                        placeholder="Digite o local do evento" required>
                    </div>
                    <div class="form-group">
                        <label>Projeto</label>
                        <select name="project_event" class="form-control" id="project_event">
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

<div class="modal edit-event-modal" tabindex="-1" role="dialog" id="update-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('eventos.update', ['id' => $event->id]) }}" method="POST">
                @csrf   
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data do Evento</label>
                        <input name="event_date" id="event_date" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="event_name" type="text" class="form-control" aria-describedby="event_name"
                            placeholder="Digite o nome do evento" required>
                    </div>
                    <div class="form-group">
                        <label>Local</label>
                        <input name="event_location" type="text" class="form-control" aria-describedby="event_location"
                        placeholder="Digite o local do evento" required>
                    </div>
                    <div class="form-group">
                        <label>Projeto</label>
                        <select name="project_event" class="form-control" id="project_event">
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
