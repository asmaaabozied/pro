{!! Form::open(['route' => ['storeSubscriptions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('storeSubscriptions.list')
        <a href="{{ route('storeSubscriptions.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
</div>
{!! Form::close() !!}
