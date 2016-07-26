<ul>
  @foreach($photos as $photo)
      <li> <img src="{{ url('photo/'.$photo) }}" alt="" /> </li>
  @endforeach
</ul>
