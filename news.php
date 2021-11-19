<!DOCTYPE html>
<html>
<title>Новости</title>

<?php
include "standart.php";
?>

<?php
session_reset();
require_once "dbconnect.php";
    $query = "SELECT id, Theme, Text, Photo, Date FROM newss ORDER BY Date DESC";
    $result = mysqli_query($link, $query);

    if (!empty($_POST["iddelete"]))
    {
    $stmt = mysqli_prepare($link, "DELETE FROM newss WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $id = $_POST["iddelete"];
    mysqli_stmt_execute($stmt);
    header("location: news.php");
    }

    if (!empty($_POST['upnew'])) {  
    $stmt2 = mysqli_prepare($link, "UPDATE newss SET Theme = ?, Text = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt2, 'ssi', $uptheme, $uptext, $id);
    
    $uptheme = $_POST["uptheme"];
    $uptext = $_POST["uptext"];
    $id = $_POST["upnew"];
    mysqli_stmt_execute($stmt2);
    header("location: news.php");
    }
?>

<?php
error_reporting(0);
while ($row = mysqli_fetch_assoc($result)) {
echo '<div class="card mb-3" style="max-width: 100%;">';
echo '<div class="row g-0">';
echo '<div class="col-md-3">';
echo '<img width="200" height="211" src="image/'.$row["Photo"].'" alt="Fail">'; 
echo '</div>';
echo '<div class="col-md-8">';
echo '<div class="card-body">';
echo '<h5 class="card-title">'.$row["Theme"].'</h5>';
echo '<p class="card-text">'.$row["Text"].'</p>';
echo '<p class="card-text"><small class="text-muted">'.$row["Date"].'</small></p>';

if ($_SESSION["admORuser"] == "AAA" || $_SESSION["admORuser"] == "AA")
{
echo '<form action="news.php" method="post">';
echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $row["id"] . '">Изменить/Удалить</button>';
echo '<div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="exampleModalLabel" >Изменить/Удалить' . $row["id"] . '</h5>';
echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
echo '<span aria-hidden="true">&times;</span>';
echo '</button>';
echo '</div>';
echo '<div class="modal-body">';
echo '<form>';
echo '<div class="form-group" >';
echo '<label for="recipient-name" class="col-form-label">Recipient:</label>';
echo '<input id="uptheme" name="uptheme" type="text" class="form-control" id="recipient-name" value="'.$row["Theme"].'" >';
echo '</div>';
echo '<div class="form-group" >';
echo '<label for="message-text" class="col-form-label">Message:</label>';
echo '<textarea id="uptext" name="uptext" class="form-control" style="height:200px" id="message-text">'.$row["Text"].'</textarea>';
echo '</div>';
echo ' </form>';
echo '</div>';
echo '<div class="modal-footer">';
echo '<input type="hidden" name="upnew" value="' . $row["id"] . '" />
      <input type="submit" value="Сохранить">
      </form>';
echo '<form action="news.php" method="post">
      <input type="hidden" name="iddelete" value="' . $row["id"] . '" />
      <input type="submit" value="Удалить">
      </form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

}
?>
