<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', trans('supportTicket.fields.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.email_help') }}"></i> &nbsp;{!! Form::label('email', trans('supportTicket.fields.email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('supportTicket.fields.type')) !!}
    <select class="form-control select2" name="type" id="type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('supportTicket.types') as $type)
            <option value="{{$type}}" {{($type == @$supportTicket->type)? 'Selected' : ''}}>{{$type}}</option>
        @endforeach
    </select>
</div>

<!-- Responded Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.responded_help') }}"></i> &nbsp;{!! Form::label('responded', trans('supportTicket.fields.responded')) !!}<br/>
    <label>
        <input type="hidden" name="responded" id="responded" value="0" checked>
        <input type="checkbox" name="responded" id="responded" @if(@$supportTicket->responded) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Message Field -->
<div class="form-group col-sm-9 col-lg-9">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.message_help') }}"></i> &nbsp;{!! Form::label('message', trans('supportTicket.fields.message')) !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('supportTickets.list')
        <a href="{{ route('supportTickets.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['supportTickets.edit', 'supportTickets.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('supportTickets.delete')
       @if(!empty($supportTicket)) <a href="{{ route('supportTickets.destroy', $supportTicket->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
       @endif
    @endcan -->
</div>
