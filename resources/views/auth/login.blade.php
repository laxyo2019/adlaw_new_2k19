@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field()}}
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif

                        @if($message = Session::get('warning'))
                            <div class="alert alert-warning">
                                   {{$message}}
                            </div>
                        @endif
           
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail or Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                       {{--  <div class="form-group">
                            <div class="col-md-6 offset-md-4">  
                         
                                  {!! NoCaptcha::renderJs() !!}
                                  {!! NoCaptcha::display() !!}
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            </div>
                        </div> --}}
                      {{--   <div class="form-group row {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <div class="col-md-6 offset-md-4">
                                <div class="captcha mb-2">
                                    <span>{!! captcha_img('flat') !!}</span>

                                    <button type="button" class="btn btn-success btn-refresh ml-4"><i class="fa fa-refresh text-white"></i></button>
                                </div>
                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                @error('captcha')
                                  <span class="help-block text-danger">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                          </div>
                      </div> --}}


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script >
   $(document).ready(function(){
        $(".btn-refresh").click(function(){

            $.ajax({
             type:'GET',

             url:'/refresh_captcha',

             success:function(data){
                $(".captcha span").html(data.captcha);
             }
            });

        });
   });

</script>
@endsection
