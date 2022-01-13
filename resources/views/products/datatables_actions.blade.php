{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('products.list')
        <a href="{{ route('products.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('products.edit')
        <a href="{{ route('products.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('products.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
