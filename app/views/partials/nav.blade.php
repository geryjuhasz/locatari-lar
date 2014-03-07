<ul class="nav nav-pills">
	@foreach($nav_left as $title => $link)
    <?php
      $active = '';
      if(isset($active_link)) {
        if(strtolower($active_link) === strtolower($title))
          $active = 'active';
      }
    ?>
		<li class="{{ $active }}"><a href="{{ $link }}">{{ $title }}</a></li>
	@endforeach
</ul>