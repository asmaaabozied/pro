{!! Form::open(['route' => ['categories.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('categories.list')
        <a href="{{ route('categories.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('categories.edit')
        <a href="{{ route('categories.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('categories.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
