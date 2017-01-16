@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('partials.navbar_toplinks')
        
            @include('partials.navbar_sidebar')
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
                @include('partials.flash')
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

