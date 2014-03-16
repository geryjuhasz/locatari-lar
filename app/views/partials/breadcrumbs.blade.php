@if($breadcrumbs = Session::get('breadcrumbs'))
<ul class="breadcrumb">
  @foreach(array_slice($breadcrumbs, 0, count($breadcrumbs) - 1) as $breadcrumb)
    <li><a href="{{ URL::to($breadcrumb['url']) }}">{{ $breadcrumb['title'] }}</a><span class="divider">/</span></li>
  @endforeach
  <li class="active">{{ end($breadcrumbs)['title'] }}<span class="divider"></span></li>
</ul>
@endif