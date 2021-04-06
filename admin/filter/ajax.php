<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<div class="container">
   <table id="userTable" border="1" >
      <thead>
        <tr>
          <th width="5%">S.no</th>
          <th width="20%">Username</th>
          <th width="20%">Name</th>
          <th width="30%">Email</th>
        </tr>
      </thead>
      <tbody></tbody>
   </table>
</div>

<script src="../assets/js/core/jquery.min.js"></script>
<script>
	$(document).ready(function(){
    $.ajax({
        url: 'sa.php',
        type: 'get',
        dataType: 'JSON',
        success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                var id = response[i].id;
                var username = response[i].username;
                var name = response[i].name;
                var email = response[i].email;

                var tr_str = "<tr>" +
                    "<td align='center'>" + (i+1) + "</td>" +
                    "<td align='center'>" + username + "</td>" +
                    "<td align='center'>" + name + "</td>" +
                    "<td align='center'>" + email + "</td>" +
                    "</tr>";

                $("#userTable tbody").append(tr_str);
            }

        }
    });
});
</script>
</body>
</html>