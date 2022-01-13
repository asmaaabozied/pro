{!! Form::open(['route' => ['storeRatings.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('storeRatings.list')
        <a href="{{ route('storeRatings.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('storeRatings.edit')
        <a href="{{ route('storeRatings.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('storeRatings.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
