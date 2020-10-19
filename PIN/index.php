<?php
require_once 'PIN.php';
require_once 'PINStorage.php';

session_start();


$database = new PINStorage('./entry.csv');


$user = $_POST['user'] ?? null;
$database->loadPINS();

if (isset($user) && $database->searchPins() != null) {
    $_SESSION['user'] = $database->searchPins()->getUser();
}
?>

<html lang="en">
<body>
<h1>Please log in</h1>
<?php if (!isset($_SESSION['user'])) : ?>
    <form action="/" method="post">
        <label for="user">Enter UserName</label>
        <input type="text" name="user" id="user"/>

        <label for="pin">Enter PIN</label>
        <input type="text" name="pin" id="pin"/>

        <button type="submit">Log In</button>
        <br>


    </form>
<?php endif; ?>
<?php if (isset($_POST['pin']) && $database->checkPIN($_POST['pin']) != null) : ?>
    <h2>Welcome <?= $_SESSION['user']; ?> , Have a nice day in webpage.</h2>

<?php elseif (isset($_POST['pin']) && $database->checkPIN($_POST['pin']) == null): ?>
    <h2>Your PIN is not correct</h2>
<?php endif; ?>

<a href="welcome.php">Click to Log out</a>


</body>
</html>
