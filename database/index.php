<?php

require_once 'NumberStorage.php';
require_once 'Numbers.php';

$database = new NumberStorage('number.csv');
$database->loadNumbers();

?>

<html lang="en">
<body>
<h1>Search the Database</h1>
<form action="/" method="post">

    <label for="search_number">Enter Phone Number</label>
    <input type="text" name="search_number" id="search_number"/>

    <button type="submit">Search</button> <br>
   <h2><?php echo $database->searchDatabase(); ?></h2>

</form>
</body>
</html>
<?php
