<?php

require_once('header.php');

//require_once('db.php');

//get the search term(s)
$userSearch = $_POST['keywords'];

//split this into a list based on the spaces between each word
$wordList = explode(' ', $userSearch);

//start the sql
//can add connection here
$sql = "SELECT * FROM racers WHERE ";
$where = "";
$counter = 0;

foreach($wordList as $word) {
    $sql .= " racerName LIKE ?";
    $wordList[$counter] = "%" . $word . "%";
    $counter++;

    if ($counter < sizeof($wordList)) {
        $sql .= " OR ";
    }
}

$sql = $sql . $where;

$cmd = $conn->prepare($sql);
$cmd->execute($wordList);
$racers = $cmd->fetchAll();

echo '<table border="1"><tr>
<td>Racer Name</td>
<td>Age</td>
<td>Sex</td>
<td>Phone</td></tr>';

foreach ($racers as $racer) {
	echo '<tr><td>' . $racer['racerName'] . '</td>
	<td>' . $racer['age'] . '</td>
	<td>' . $racer['sex'] . '</td>
	<td>' . $racer['phoneNum'] . '</td></tr>';

}

echo '</table>';
$conn = null;

?>

</body>

</html>
