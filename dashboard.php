<?php session_start();
if(!empty($_SESSION))
{
    require_once "./accounts/connection.php";

    $data = [];

    $sql = "SELECT `login`, `mail`, `start_date` FROM users WHERE user_id = " . $_SESSION['user_id'];

    $res = $conn -> query($sql);

    while($row = $res -> fetch_assoc())
    {
        $data['login'] = $row['login'];
        $data['mail'] = $row['mail'];
        $data['start_date'] = $row['start_date'];
    }
}
else
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
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="js/fetching.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
</head>
<body>
    <header>
        <span id="logo">WLM</span>
        <a href="accounts/logout.php"><span>Wyloguj się</span></a>
        <a href="modules/fin/finanse.php"><span>Moje Finanse</span></a>
        <a href="modules/harm/harmonogram.html"><span>Mój Harmonogram</span></a>

    </header>
    <header style="display:none;">
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


    <main>
    <div id="mainGrid">
        <div>
            <div class="small_grid">
                <div class="lu">Twoje zadania<br><h3>Najbliższe zadanie</h3></div>
                <div class="ru"><a href="modules\harm\harmonogram.html"><img class="bb" src="gfx/addTime.png"></a></div>
                <div class="do"><h3>Zadania</h3><a><img src="gfx/arrow.png" class='arrow' onclick="ChangeDiv('addTaskPanel', 'block')"></a></div>

            </div>
        </div>
        <div>
        <div class="small_grid">
                <div class="lu">Twoje przedziały<br><h3>Najbliższy czas</h3></div>
                <div class="ru" ><a href="modules\harm\harmonogram.html"><img class="bb" src="gfx/addTask.png"></a></div>
                <div class="do"><h3>Przedziały</h3><a><img src="gfx/arrow.png" class='arrow' onclick="ChangeDiv('addTaskPanel', 'block')"></a></div>

            </div>
        </div>
        <div>
            <div class="small_grid">
                    <div class="lu">                <?php echo $data['login']; ?><br><h3><?php echo $data['mail']; ?></h3></div>
                    <div class="ru"><img class="bb" src="gfx/pen.png"></div>
                    <div class="do"></div>
            <!--<div class="w2">
                <img style="margin-left: 1%; margin-top: 2.5%; height: 90%; border-radius: 10px; float: left" src="./gfx/defaultUsr_Icon.png">
                <h2 style="text-align: center;"></h2>
                <h3 style="text-align: center;"></h3>
                <h3 style="text-align: center;"><?php echo $data['start_date']; ?></h3>
                <span><a href="#"><h4 style="text-align: center;" >Zmień hasło</h4></a></span>-->
            </div>
        </div>
        <div class="menu_card">
                        <div class="small_grid">
                <div class="lu">                Moje Finanse<br><h3>Moje saldo</h3></div>
                <div class="ru" ><a href="modules\fin\finanse.html"><img class="bb" src="gfx/money_icon.png"></a></div>
                <div class="do"><h3>Finanse</h3><a><img src="gfx/arrow.png" class='arrow' onclick="ChangeDiv('addTaskPanel', 'block')"></a></div>

            </div>
        </div>
        <div style="grid-column: 1 / span 4;">
        </div>
    </div>
    </main>
    <div id="addTaskPanel">
            <button id="closeButton_1" class="x"  onclick="ChangeDiv('addTaskPanel', 'none')">X</button>
            <label for="time">Czas trwania:</label>
            <input type="number" id="time" name="time"><br>
            <label for="title">Tytuł:</label>
            <input type="text" id="title" name="title"><br>
            <label for="priority">Priorytet:</label>
            <input type="number" id="priority" name="priority"><br>
            <label for="type">Typ:</label>
            <input type="number" id="type" name="type"><br>
            <br>
            <label for="alerts">Deadline:</label>
            <input type="date" id="alerts" name="alerts"><br>
            <label for="colors">Kolor:</label>
            <input type="color" id="colors" name="colors"><br>
            <label for="comment">Komentarz:</label><br>
            <textarea rows="5" cols="30" id="comment" name="comment"></textarea><br>
            <button onclick="getFormData(); ChangeDiv('addTaskPanel', 'none')">Wprowadź</button>
    </div>

    <div id="insertTaskPanel">
        <button id="closeButton_2" class="x" onclick="ChangeDiv('insertTaskPanel', 'none')">X</button>
        <label for="date">Dzień:</label>
        <input type="date" id="date" name="date"><br>
        <label for="time_start">Godzina początkowa:</label>
        <input type="time" id="time_start" name="time_start"><br>
        <label for="time_end">Godzina końcowa:</label>
        <input type="time" id="time_end" name="time_end"><br>
        <label for="type">Typ:</label>
        <select name="type" id="type">
            <option value=1>Praca</option>
            <option value=2>Życie prywatne</option>
        </select>
        <br>
        <button onclick="getFormData(); ChangeDiv('insertTaskPanel', 'none')">Wprowadź</button>
    </div>

</body>
</html>