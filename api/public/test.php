<!DOCTYPE html>
<html>

<head>

</head>
<body>

<form id="form" action="" method="post">
    Name: <input type="text" name="user"><br>
    Password: <input type="password" name="password"><br>
    <input id="submit" type="button" name="submit" value="submit">
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    // click on button submit
    $("#submit").on('click', function(){
      // send ajax
      $.ajax({
        url: '/api/auth', // url where to submit the request
        type : "POST", // type of action POST || GET
        dataType : 'json', // data type
        data : $("#form").serialize(), // post data || get data
        success : function(result) {
          // you can see the result from the console
          // tab of the developer tools
          console.log(result);
          alert('SUCCESS');
        },
        error: function(xhr, resp, text) {
          console.log(xhr, resp, text);
          alert('ERROR');
        }
      })
    });
  });

</script>
</body>
</html>