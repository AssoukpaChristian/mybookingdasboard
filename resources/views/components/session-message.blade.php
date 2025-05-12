@foreach (['success', 'danger', 'warning', 'info'] as $msg)
    @if(session()->has($msg))
        <div x-data x-init = "$dispatch('message-session')" class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
            {{ session()->get($msg) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
@endforeach
