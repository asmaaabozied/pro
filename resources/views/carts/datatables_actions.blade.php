{!! Form::open(['route' => ['carts.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('carts.list')
        <a href="{{ route('carts.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
</div>
{!! Form::close() !!}
