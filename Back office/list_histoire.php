<?php
// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=categorie_db";
$username = "root";
$password = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Récupérer les catégories pour le formulaire de recherche
$stmt = $conn->query("SELECT id, nom FROM categorie");
$categories = $stmt->fetchAll();

// Récupérer les histoires (optionnellement filtrées par catégorie)
$categorie_id = isset($_POST['categorie']) ? $_POST['categorie'] : '';

if ($categorie_id) {
    $stmt = $conn->prepare("SELECT h.id, h.titre, h.contenu, h.date_creation, c.nom AS categorie 
                            FROM histoires h 
                            JOIN categorie c ON h.categorie_id = c.id 
                            WHERE h.categorie_id = :categorie_id 
                            ORDER BY h.date_creation DESC");
    $stmt->execute(['categorie_id' => $categorie_id]);
} else {
    $stmt = $conn->query("SELECT h.id, h.titre, h.contenu, h.date_creation, c.nom AS categorie 
                          FROM histoires h 
                          JOIN categorie c ON h.categorie_id = c.id 
                          ORDER BY h.date_creation DESC");
}

$histoires = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Histoires</title>
    <script>
        // Fonction pour afficher ou masquer le formulaire d'ajout
        function afficherFormulaireAjout() {
            document.getElementById('modalAjout').style.display = 'block';
        }

        function cacherFormulaireAjout() {
            document.getElementById('modalAjout').style.display = 'none';
        }

        // Validation avec JavaScript
        function validerFormulaire() {
            var titre = document.getElementById('titre').value;
            var contenu = document.getElementById('contenu').value;
            var categorie_id = document.getElementById('categorie_id').value;

            if (titre.length < 4) {
                alert("Le titre doit contenir au moins 4 caractères.");
                return false;
            }

            if (!titre || !contenu || !categorie_id) {
                alert("Tous les champs doivent être remplis !");
                return false;
            }

            return true;
        }
    </script>
    <style>
        #modalAjout {
            display: none;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Gestion des Histoires</h1>
</header>

<nav>
    <form method="POST" action="list_histoire.php">
        <label for="categorie">Filtrer par catégorie :</label>
        <select id="categorie" name="categorie">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['id']; ?>"><?= htmlspecialchars($categorie['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Rechercher</button>
    </form>
</nav>

<main>
    <h2>Liste des Histoires</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Catégorie</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($histoires as $histoire): ?>
            <tr>
                <td><?= $histoire['id']; ?></td>
                <td><?= htmlspecialchars($histoire['titre']); ?></td>
                <td><?= htmlspecialchars($histoire['contenu']); ?></td>
                <td><?= htmlspecialchars($histoire['categorie']); ?></td>
                <td><?= $histoire['date_creation']; ?></td>
                <td>
                    <a href="update_histoire.php?id=<?= $histoire['id']; ?>">Modifier</a> |
                    <a href="delete_histoire.php?id=<?= $histoire['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette histoire ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="6">
                <button type="button" onclick="afficherFormulaireAjout()">Ajouter une Histoire</button>
            </td>
        </tr>
        </tbody>
    </table>

    <div id="modalAjout">
        <h3>Ajouter une Histoire</h3>
        <form id="form_histoire" method="POST" action="add_histoire.php" onsubmit="return validerFormulaire()">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre">
            <br><br>

            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" rows="5" cols="40"></textarea>
            <br><br>

            <label for="categorie_id">Catégorie :</label>
            <select id="categorie_id" name="categorie_id">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id']; ?>"><?= htmlspecialchars($categorie['nom']); ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <button type="submit">Ajouter</button>
            <button type="button" onclick="cacherFormulaireAjout()">Annuler</button>
        </form>
    </div>
</main>


<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>


