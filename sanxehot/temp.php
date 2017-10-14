<!DOCTYPE html>
<html>
<body>
  <form name='formabc' target="_blank" action="config.php" method="get">
    <input type="text" name="testabc" value="">
    <input type="submit" value="submit đi">
  </form>
  <script type="text/javascript">
  var i = 5;
  function test() {

    document.write(i);
    i--;
    setTimeout('test()',1000);
  }

  test();

  </script>
  <p id="time">5</p>
</body>
</html>
