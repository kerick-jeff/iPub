<ul>
  @foreach($photos as $photo)
      <li> <img src="{{ url('photo/'.$photo) }}" alt="" width = '370px' height = '370px' /> </li>
  @endforeach
</ul>
