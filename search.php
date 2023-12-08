<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$decksearch = $_POST["decksearch"];
	try{
		require_once "includes/dbh-inc.php";
		$query = "SELECT * FROM decks WHERE deckname = :decksearch;";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":decksearch",$decksearch);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$pdo = null;
		$stmt = null;
	} catch(PDOException $e){
		die("Query failed:".$e->getMessage());
	}
}

else{
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Study Tool </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="studystyle.css">
</head>
<body>

<div class="header">
    <h1>Study Tool</h1>
</div>
<div class="topnav">
    <a href="#" onclick="TransitionPage('flashcard.html')">Back to Main Menu</a>
</div>
<h2>Study Created Decks</h2>

<body> 

<h3>Created Decks</h3>
<p id="OutDecks"></p>

<button onclick="ChooseDeck()">Choose Deck</button>

<h3 id="QuizHead">Quiz Yourself</h3>

<p id="Score"></p>

<p id="OutCards"></p>

<p id="QuizBoxes"></p>

<button onclick="CheckAnswers()">Check Answers</button>

<h3>Cookie Debugging</h3>

<button onclick="DebugCookies()">DebugCookies()</button>
<button onclick="ClearCookies()">ClearCookies()</button>

<script>
var deck = new Array();

window.onload = DisplayDecks;

function ChooseDeck()
{
    const deckName = prompt("Saved Deck Name (case sensitive): ");
    if (deckName == null) return;
    const newDeck = GetCookie(deckName);
    //alert(newDeck);

    if (newDeck.length == 0)
    {
        alert("ERROR: Deck does not exist");
        return;
    }
    deck = JSON.parse(newDeck);
    //document.getElementById("QuizHead").style.display="block";
    //DisplayNotecards();
    ShowQuizBoxes();
}

function CheckAnswers()
{
    var score = deck.length;
    for (var i = 0; i < deck.length; i++)
    {
        const guess = document.getElementById(`Q${deck[i][0]}`).value;
        const ans = deck[i][1];
        if (guess != ans)
        {
            alert(`Card${i+1}. You put ${guess} but ${ans} is correct`);
            score--;
        }
    }
    var text = `${score} / ${deck.length}`;
    document.getElementById("Score").innerHTML = text;
}

function ShowQuizBoxes()
{    
    let text = "";
    for (var i = 0; i < deck.length; i++)
    {
        text += deck[i][0] + `<input id=Q${deck[i][0]}>` + "</input>" + "<br>";
    }
    document.getElementById("QuizBoxes").innerHTML = text;
}

function DisplayNotecards()
{
    let text = "<ol>";
    for (let i = 0; i < deck.length; i++)
    {
        text += "<li>" + deck[i][0] + "</li>";
    }
    text += "</ol>";

    document.getElementById("OutCards").innerHTML = text;
}

function DisplayDecks()
{
    var cookies = document.cookie.split(';');
    let text = "<ol>";
    for (var i = 0; i < cookies.length; i++)
    {
        var cookie = cookies[i].split('=');
        if (cookie[1] == null) continue; 
        text += "<li>" + cookie[0] + "</li>";
    }
    text += "</ol>";

    document.getElementById("OutDecks").innerHTML = text;
}

function GetCookie(cname) {
    // Function from W3schools
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) 
    {
        let c = ca[i];
       
        while (c.charAt(0) == ' ') 
        {
            c = c.substring(1);
        }
       
        if (c.indexOf(name) == 0) 
        {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function DebugCookies()
{
    alert(document.cookie);
}

function TransitionPage(pageName)
{
	window.location.href = pageName;
}

</script>
<h3>SEARCH RESULTS</h3>
<?php
if(empty($results)){
	echo"<div>";
	echo"<p>There were no results!</p>";
	echo "</div>"
}
else{
	foreach($results as $row){
	echo $row["deckName"]>>results.txt;
	echo $row["InWord"]>>results.txt;
	echo $row["InDef"]>>results.txt;
	}
}
?>
</body>
</body>
</html>
