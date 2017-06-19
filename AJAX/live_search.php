<?php session_start();
    require "../backend/common.php";
    check_login($_SESSION['username'], $_SESSION['password']);
    $conn = connect_to_database();
    $q = $_GET['q'];
    $stmnt = $conn->prepare("SELECT * FROM Medication WHERE NAME REGEXP ?");

    $stmnt->execute(array($q));
    $numOptions = 0;
?>
    <ul id = "plive">
<?php
    while($numOptions != 9 && $result = $stmnt->fetch(PDO::FETCH_NUM)) {
?>
<li onclick ="selectDrug('<?php echo $result["0"]; ?>');"><?php echo $result["0"]; ?> </p>
<?php
    $numOptions++;
    }
?>
</ul>
