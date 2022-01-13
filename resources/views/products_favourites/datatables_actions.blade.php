{!! Form::open(['route' => ['productsFavourites.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('productsFavourites.list')
        <a href="{{ route('productsFavourites.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('productsFavourites.edit')
        <a href="{{ route('productsFavourites.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('productsFavourites.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
