<?php
include "standart.php";
require_once "dbconnect.php";

if(!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"] === true && $_SESSION["admORuser"] !== "AAA")){
    header("location: index.php");
    exit;
}
include "Shield.php";
?>

<?php
$query1 = "SELECT id, username, admORuser FROM admin";
$result1 = mysqli_query($link, $query1);
while ($row1 = mysqli_fetch_assoc($result1)) {
echo '<ul class="list-group">';
echo '<li class="list-group-item"> ID = '.$row1["id"].' | Имя = '.$row1["username"].' | Статус = '.$row1["admORuser"].'</li>';
}

if (!empty($_POST["userdelete"]))
{
$stmt = mysqli_prepare($link, "DELETE FROM admin WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $userid);
$userid = $_POST["the_ID"];
mysqli_stmt_execute($stmt);
session_reset();
header("location: owner.php");
}

if (!empty($_POST['give'])) {  
    $stmt1 = mysqli_prepare($link, "UPDATE admin SET admORuser = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt1, 'si', $admoruser, $idd);
    
    $admoruser = $_POST["the_admin"]; 
    $idd = $_POST["the_ID"];

    mysqli_stmt_execute($stmt1);
    session_reset();
    header("location: owner.php");
}
?>
<form method="POST">
<div class="container">
<select class="form-select" size="7" aria-label="size 3 select example" name="the_ID">
<?php foreach($result1 as $option) : ?>
        <option value="<?php echo $option['id']; ?>">ID = <?php echo $option['id']; ?></option>
<?php endforeach; ?>
</select>
<select class="form-select" aria-label="Default select example" name="the_admin">
    <option value="AA">Администратор (AA)</option>
    <option value="A" selected>Пользователь (A)</option>
</select>
<input type="submit" name="give" value="Выдать">
<input type="submit" name="userdelete" value="Удалить Аккаунт">
</div>
</form>