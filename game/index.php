<link rel="stylesheet" type="text/css" href="style.css" />
<?php

echo "<center>
      <div class='game_title'>
      <li>
      wood=<a id='wood'>0</a>
      </li>
      <li>
      stone=<a id='stone'>0</a>
      </li>
      </div>
  </center>";
  $x = 0;
  $y = 0;
  $id = 0;
  echo "<div class='map'>";
  while ($y!==10){
      $id++;
      echo "<div onclick=t($y,$x) id=$id class='sector'></div>";
      $x++;
      if ($x==15) {
        echo "<br>";
        $y++;
        $x=0;
      }
  }
  echo "</div>";
 ?>
<script type="text/javascript">
  function t(y,x){
    wood = document.getElementById('wood');
    stone = document.getElementById('stone');
    wood.innerHTML = parseInt(wood.innerHTML) +y;
    stone.innerHTML = parseInt(stone.innerHTML) +x;
  }
  function test () {
    id = Math.floor((Math.random()*150)+1);
    document.getElementById(id).innerHTML = 1;
    setTimeout('test()', 1000);
  }
  test();
</script>
