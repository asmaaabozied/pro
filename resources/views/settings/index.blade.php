@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2 class="pull-left"><b>{{trans('setting.setting')}}</b></h2>

    </section>


    <div class="content">
        <br>
        <br>
        <hr style="border-color: #3c8dbcab"/>


        @include('flash::message')



      @foreach($settings as $setting)

            {!! Form::model($setting, ['route' => ['settings.update', $setting->id], 'method' => 'patch']) !!}



          <label> Phone</label>
            <input class="form-control" value="{{$setting->phone}}" name="phone">

            @error('phone')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        <div>
            <label> Email</label>
            <input class="form-control" value="{{$setting->email}}" name="email">

            @error('email')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label> Facebook</label>
            <input class="form-control" value="{{$setting->facebook}}" name="facebook">
            @error('facebook')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div>
            <label> Instegram</label>
            <input class="form-control" value="{{$setting->instegram}}" name="instegram">
            @error('instegram')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label> Twitter</label>
            <input class="form-control" value="{{$setting->twitter}}" name="twitter">
            @error('twitter')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label> Snapchat</label>
            <input class="form-control" value="{{$setting->snapchat}}" name="snapchat">
            @error('snapchat')
            <span class="alert">
              <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @endforeach


<br>
            <div class="form-group col-sm-12">


                <div class="col-sm-1">&nbsp;</div>

                    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>


        </div>
            {!! Form::close() !!}

    </div>
@endsection

