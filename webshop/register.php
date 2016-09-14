<?php
include 'header.php';

?>


	<div class="container">

      <form action="regUser.php" method="post">
        <h2>Register new user</h2>
        <label for="inputForename" class="sr-only">Forename</label>
        <input type="text" id="inputForename" name="inputForename" class="form-control" placeholder="Forename" required>

        <label for="inputLastname" class="sr-only">Lastname</label>
        <input type="text" id="inputLastname" name="inputLastname" class="form-control" placeholder="Lastname" required>

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

        <label for="inputStreet" class="sr-only">Street</label>
        <input type="text" id="inputStreet" name="inputStreet" class="form-control" placeholder="Street" required>
        
        <label for="inputZip" class="sr-only">Zip code</label>
        <input type="text" id="inputZip" name="inputZip" class="form-control" placeholder="Zip" required>

        <label for="inputCity" class="sr-only">City</label>
        <input type="text" id="inputCity" name="inputCity" class="form-control" placeholder="City" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->

</body>
</html>