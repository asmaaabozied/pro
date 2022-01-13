{!! Form::open(['route' => ['orders.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('orders.list')
        <a href="{{ route('orders.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('orders.edit')
        <a href="{{ route('orders.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
</div>
{!! Form::close() !!}
