<?php session_start();
if(empty($_SESSION))
{
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>WLM/dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css"/>
    <script src="js/fetching.js"></script>
</head>
<body>
    <header>
        <button class="menu" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened')); flyOutMenu()" aria-label="Main Menu">
            <svg width="50" height="50" viewBox="0 0 100 100">
                <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                <path class="line line2" d="M 20,50 H 80" />
                <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
            </svg>
        </button>

        <form action="./accounts/logout.php">
            <button class="logOutButton">
                Logout
            </button>
        </form>
    </header>

    <div id="menu" style="z-index: 10;">
        <div class="menuPos">
            <p>Test 1<p>
        </div>
        <div class="menuPos">
            <p>Test 2<p>
        </div>
        <div class="menuPos">
            <p>Test 3<p>
        </div>
    </div>

    <div id="mainGrid">
        <div onclick="ChangeDiv('addTaskPanel', 'block')"><img class="icon" src="./gfx/addTask_button.png"></div>
        <div onclick="ChangeDiv('insertTaskPanel', 'block')"><img class="icon" src="./gfx/addTime_button.png"></div>
        <div class="w2">
            <img style="height: 100%; border-radius: 10px; float: left" src="./gfx/defaultUsr_Icon.png">
            <h2 style="text-align: center;">{Login}</h2>
            <h3 style="text-align: center;">{Mail}</h3>
            <h3 style="text-align: center;">{Start_date}</h3>
            <span><a href="123"><h4 style="text-align: center;" >Zmień hasło</h4></a></span>
        </div>
        <div>
        </div>
        <div class="w3">
        </div>
    </div>

    <div id="addTaskPanel">
            <button id="closeButton_1" onclick="ChangeDiv('addTaskPanel', 'none')">X</button>
            <label for="time">Time:</label>
            <input type="number" id="time" name="time"><br><br>
            <label for="type">Type:</label>
            <input type="number" id="type" name="type"><br><br>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title"><br><br>
            <label for="priority">Priority:</label>
            <input type="number" id="priority" name="priority"><br><br>
            <label for="alerts">Alerts:</label>
            <input type="date" id="alerts" name="alerts"><br><br>
            <label for="colors">Colors:</label>
            <input type="text" id="colors" name="colors"><br><br>
            <label for="comment">Comment:</label><br>
            <textarea rows="5" cols="30" id="comment" name="comment"></textarea><br><br>
            <button onclick="getFormData(); ChangeDiv('addTaskPanel', 'none')">Wprowadź</button>
    </div>

    <div id="insertTaskPanel">
        <button id="closeButton_2" onclick="ChangeDiv('insertTaskPanel', 'none')">X</button>
        <label for="date">Dzień:</label>
        <input type="date" id="date" name="date"><br><br>
        <label for="time_start">Godzina początkowa:</label>
        <input type="time" id="time_start" name="time_start"><br><br>
        <label for="time_end">Godzina końcowa:</label>
        <input type="time" id="time_end" name="time_end"><br><br>
        <label for="type">Typ:</label>
        <select name="type" id="type">
            <option value="Praca">Praca</option>
            <option value="Życie prywatne">Życie prywatne</option>
        </select>
        <br><br>
        <button onclick="getFormData(); ChangeDiv('insertTaskPanel', 'none')">Wprowadź</button>
    </div>

</body>
</html>