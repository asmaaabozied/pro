@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2 class="pull-left"><b>{{\Illuminate\Support\Facades\Config::get('Title')}}</b></h2>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('users_referral.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


<!-- Modal -->
<div class="modal fade" id="ModelNotify" tabindex="-1" role="dialog" aria-labelledby="ModelNotify" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-primary " id="exampleModalLongTitle">Send Notification</h4>
        <button type="button" style="padding:0 20px;" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
        </button>
        </div>
            {!! Form::open(['route' => 'notifications.referalStore']) !!}
                <div class="modal-body" >
                    
                    <!-- Notification En Field -->
                    <div class="form-group col-sm-11">
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.notification_en_help') }}"></i> &nbsp;{!! Form::label('notification_en', trans('notification.fields.notification_en')) !!}
                        {!! Form::text('notification_en', null, ['class' => 'form-control', 'readonly' => (isset($notification))? true : false]) !!}
                    </div>
                    @foreach($system_languages as $system_language)
                        <?php
                        $input_name = 'notification_' . $system_language;
                        $input_value = (isset($notification))? $notification->$input_name : ''
                        ?>
                        <div class="form-group col-sm-11">
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("notification.fields.$input_name")) !!}
                            {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true, 'readonly' => (isset($notification))? true : false]) !!}
                        </div>
                    @endforeach
                    
                    <!--  Field -->
                    <div class="form-group col-sm-2">
                        <input hidden name="general" id="general" value="0">
                        <input hidden name="active" id="active" value="1">
                        <input hidden name="type" id="type" value="custom">
                        <input hidden name="filter_type" id="filter_type" value="users">
                        <input hidden name="users[]" id="users" >
                    </div>
                    <br/>
                </div>
                <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                @canany(['notifications.edit', 'notifications.create'])
                <button type="submit" id="btnSaveNotify" class="btn btn-primary">{{ trans('common.save') }}</button>
                @endcanany
                </div>
            {!! Form::close() !!}

      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModelGift"  tabindex="-1" role="dialog" aria-labelledby="ModelGift"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-primary " id="exampleModalLongTitle">Send Gift</h4>
          <button type="button" style="padding:0 20px;" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
        </div>
        {!! Form::open(['route' => 'user_gift.store']) !!}

        <div class="modal-body" >
            <input hidden readonly  id="user_id"  name="user_id"/>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-4"><label>{{trans('user.menu.usersReferral')}}</label></div>
                <div class="col-sm-8"><input chars="latin-alpha-numeric" readonly type="text" id="referral_count"  name="referral_count" class="form-control" /></div>
            </div>
            
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-4"><label>{{trans('common.title')}}</label></div>
                <div class="col-sm-8"><input chars="latin-alpha-numeric" type="text" id="title"  name="title" class="form-control" maxlength="150" /></div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-4"><label>{{trans('common.description')}}</label></div>
                <div class="col-sm-8"><input chars="latin-alpha-numeric" type="text" id="description"  name="description" class="form-control" maxlength="150" /></div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="btnSaveGift" class="btn btn-primary">{{ trans('common.save') }}</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.notifyBtn' ,function () {
            // fill user id , sill user name
            var user_id= $(this).attr('id').split("_")[0];
            $("#users").val(user_id);
        });
        $(document).on('click','.giftBtn' ,function () {
            // fill user id , sill user name
            var user_id= $(this).attr('id').split("_")[0];
            var referral_count= $(this).attr('data-referral');
            $("#user_id").val(user_id);
            $("#referral_count").val(referral_count);
            $("#title,#description").val('');
        });
    });
</script>
@endpush