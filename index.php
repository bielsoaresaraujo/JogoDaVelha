<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo Da Velha</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Jogo Da Velha</h1>
    <div id="tabuleiro">
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
        <div class="casa"></div>
</div>
<?php

session_start();

function getPlayerTurn() {

// Define os jogadores e símbolos $players = ['x', '0'];

// Inicializa o turno se ainda não estiver definido if (!isset($_SESSION['turn'])) { $_SESSION['turn'] = 0; // Começa com o jogador 'X' }

// Obtém o símbolo do jogador atual $currentPlayer = $players[$_SESSION['turn'] % 2];

return $currentPlayer;

}

?>

<?php

function makeMove($board, $position, $player) {

// verifice se a posição está vaz

if ($board [$position] === '') {
$board [Sposition] = Splayer; // Narca a posição com o sinbolo do jogador

// wrifica se ha un ganhador

If (checkWinner($board, Splayer)) {
    return ['board' => $board, 'winner' => $player];
}
//Alterna o turno

$SESSION ['turn']++;
return ['board' => $board, 'winner' => null];
} else { 
    return ['error' => 'Posição já ocupada!'];
    }
}

function checkWinner($board, $player) {
     // Define as combinações vencedoras

SwinningCombinations = [

[0, 1, 2], [3, 4, 5], [6, 7, 8], // Linhas

[0, 3, 6], [1, 4, 7], [2, 5, 8], 

[0, 4, 8], [2, 4, 6],
];

//Diagonals

// verifica se alguma combinacle fot atingida

foreach (SwinningCombinations as $combination) {

If ($board[$combination[0]] === $player &&
    $board[$combination[1]] === $player &&
    $board[$combination[2]] === $player) }
return true;
    
    }
}

return false;
}

<?php

session_start();

Include 'caminho_das_funcoes.php'; // Inclua o arquivo com as funções de jogo

header("Content-Type: application/json');

// Verifica o tipo de requisição if ($_SERVER['REQUEST_METHOD'] 'GET') { / Retorna o jogador atual e o símbolo /

echo json_encode(['player' => getPlayerTurn()]);

}

If ($_SERVER['REQUEST_METHOD'] === 'POST') (

// Recebe os dados da jogada

$data = json_decode(file_get_contents("php://input"), true);

// Inicializa o tabuleiro ou usa o existente

$board isset($_SESSION['board"]) ? $_SESSION['board']: array_fill(0, 9, ");

// Faz a jogada e atualiza o tabuleiro

$result = makeMove($board, $data['position'], $data['player']);

$_SESSION['board'] = $result['board"]; // Atualiza a sessão com o novo tabuleiro

// Retorna o resultado da jogada echo json_encode($result);

}

?>

<script>

// Carrega o jogador atual ao iniciar o jogo
async function getPlayerTurn() (
const response = awalt fetch('jogo.php');
const data = await response.json();
console.log("Jogador atual: ", data.player);
return data.player;
}

//Realiza una jogada async function makelove(position) {
const player = await getPlayerTurn();
const cell = document.getElementById("board").children[position];

if (cell.imerText === '') {

// Smela a jogada ao backend

const response = await('jogo.php', {

method: 'POST',

headers: {

'Content-Type': 'application/json'
},
body: JSON.stringify(position; position, player: player })

const result = awalt response.json();

If (result.winner) {

alert("O vencedor é: " result.winner);

resatGame (); 
} else {
cell. InnerText = player;
} else {
alert("Posicilo 56 ocupada! Escolha outra célula.");
}
}
}
function resetGame() {

document.querySelectorAll("#board.cell").forEach(cell => {
    cell.InnerTest = '';
}};


</body>
</html>