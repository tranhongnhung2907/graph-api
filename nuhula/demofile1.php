<!DOCTYPE html>
<html>
<body>
  <script type="text/javascript">
    function testAjax() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        console.log(this.readyState + ' ' + this.status);
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('id_ajax').innerHTML = this.responseText;
        }
      };
      xhttp.open('get', 'temp.php', true);
      xhttp.send();
    }
  </script>
  <p id="id_ajax">Ta sẽ đổi text này</p>
  <button type="button" name="button" onclick="testAjax()">Test AJAX</button>
</body>
</html>
