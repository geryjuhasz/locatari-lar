@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">  
                @include('partials.flash')
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Sign In')
               @section ('login_panel_body')
                        <form role="form" method="POST" action="{{ URL::action('AdminsController@login') }}">
                            <fieldset>
                                <div class="form-group">
                                	<input name="name" class="form-control" type="text" autofocus="" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="remember-me">
										Remember me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                                
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop