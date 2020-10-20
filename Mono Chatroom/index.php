<?php
require_once 'PIN.php';
require_once 'PINStorage.php';

require_once 'Chat.php';
require_once 'ChatStorage.php';

session_start();


$database = new PINStorage('./entry.csv');
$chats = new ChatStorage('./chat.csv');

$user = $_POST['user'] ?? null;
$database->loadPINS();
$chats->getLine();
if (isset($user) && $database->searchPins() != null) {
    $_SESSION['user'] = $database->searchPins()->getUser();
}
$lines = $_POST['add'] ?? null;

if (isset($_POST['add'])) {
    $chats->addLine(new Chat(
        $database->findPins($_SESSION['user'])->getUser(), $_POST['add']
    ));
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
    <h2>Welcome <?= $_SESSION['user']; ?> , Have a nice day in chatroom.</h2>

<?php elseif (isset($_POST['pin']) && $database->checkPIN($_POST['pin']) == null): ?>
    <h2>Your PIN is not correct</h2>
<?php endif; ?>

<div>
    <?php if (isset($_SESSION['user'])) : ?>
        <form action="index.php" method="post">
            <label for="add">Add new</label>
            <input type="text" id="add" name="add"/>
            <button type="submit">Add</button>
            <a href="welcome.php">Click to Log out</a>

        </form>
    <?php endif; ?>
</div>
<div>
    <?php foreach ($chats->getLine() as $line): ?>
        <li>
            <text><?= $line->getUser() . ' : ' . $line->getMessage() ?> </text>

        </li>

    <?php endforeach; ?>


</div>

</body>
</html>