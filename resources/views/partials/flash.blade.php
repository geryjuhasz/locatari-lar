<div class="flash col-12 nomargin nopadding">
  @if(Session::has('flash_success'))
    <?php $flash = Session::get('flash_success');?>

    <div class="alert alert-block bg-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @if(is_array($flash))
      <ul>
        @foreach($flash as $msg)
          <li>{{ $msg }}</li>
        @endforeach
      </ul>
      @else
        {{ $flash }}
      @endif
    </div>
  @endif

  @if(Session::has('flash_warning'))
    <?php $flash = Session::get('flash_warning');?>
    <div class="alert alert-block bg-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @if(is_array($flash))
      <ul>
        @foreach($flash as $msg)
          <li>{{ $msg }}</li>
        @endforeach
      </ul>
      @else
        {{ $flash }}
      @endif
    </div>
  @endif

  @if(Session::has('flash_error'))
    <?php $flash = Session::get('flash_error');?>
    <div class="alert alert-block bg-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @if(is_array($flash))
        @foreach($flash as $msg)
          <span>{{ $msg }}</span><br />
        @endforeach
      @elseif($flash instanceof Illuminate\Support\MessageBag)
        @foreach($flash->all() as $msg)
           <span>{{ $msg }}</span><br />
        @endforeach
      @else
        {{ $flash }}
      @endif
    </div>
  @endif

  @if(Session::has('flash_info'))
    <?php $flash = Session::get('flash_info');?>
    <div class="alert alert-block bg-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @if(is_array($flash))
      <ul>
        @foreach($flash as $msg)
          <li>{{ $msg }}</li>
        @endforeach
      </ul>
      @else
        {{ $flash }}
      @endif
    </div>
  @endif
</div>
<div class="clearfix"></div>