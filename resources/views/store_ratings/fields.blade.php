<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans('storeRating.fields.user_id')) !!}
    <select class="form-control select2" name="user_id" id="user_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($users as $id => $user)
            <option value="{{$id}}" {{($id == @$storeRating->user_id)? 'Selected' : ''}}>{{$user}}</option>
        @endforeach
    </select>
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.store_id_help') }}"></i> &nbsp;{!! Form::label('store_id', trans('storeRating.fields.store_id')) !!}
    <select class="form-control select2" name="store_id" id="store_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($stores as $id => $store)
            <option value="{{$id}}" {{($id == @$storeRating->store_id)? 'Selected' : ''}}>{{$store}}</option>
        @endforeach
    </select>
</div>

<!-- Rate Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('storeRating.fields.rate')) !!}
    {!! Form::number('rate', null, ['class' => 'form-control', 'step' => 0.5, 'min' => 0, 'max' => 5]) !!}
</div>

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Review Field -->
<div class="form-group col-sm-9 col-lg-9">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.review_help') }}"></i> &nbsp;{!! Form::label('review', trans('storeRating.fields.review')) !!}
    {!! Form::textarea('review', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeRatings.list')
        <a href="{{ route('storeRatings.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['storeRatings.edit', 'storeRatings.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('storeRatings.delete')
        @if(isset($storeRating))
            <a href="{{ route('storeRatings.destroy', $storeRating->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>
