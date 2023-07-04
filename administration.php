<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>

    <body>


        <div style="display: flex; flex-direction: column; align-items: center; height: 50vh;">
            <h3>Bonjour <?= $_SESSION['user']['pseudo']; ?></h3>

            <div style="text-align: center;">
                <div>
                    <a href="settings.php"><img src="img\settings.jpg" alt="settings" style="width: 20%;"></a>
                    <a href="commandes.php"><img src="img\commande.png" alt="commandes" style="width: 20%;"></a>
                </div>
            </div>

        </div>

        <div style="display: flex; justify-content: center; gap: 200px;">
            <div style="width: 400px; height:400px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        </div>
        <div style="height: 10px; border-top: 2px solid black; margin: 20px;"></div>
        <div>
            <div style="height:400px;">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div style="height: 10px; border-top: 2px solid black; margin: 20px;"></div>
        <div>
            <div style="height:400px;">
                <canvas id="myChart3"></canvas>
            </div>
        </div>

        <?php
        $query = "SET lc_time_names = 'fr_FR'";
        $stmt = $dbh->query($query);
        $query = "SELECT DAYNAME(date) AS jour, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande , produit WHERE date >= DATE(NOW()) - INTERVAL 7 DAY and commande.id_produit = produit.id_produit AND commande.ID_commande = commande.ID_commande GROUP BY commande.ID_commande; ";
        $stmt = $dbh->query($query);
        $montantsTotals = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $montantsTotals[$row['jour']] = $row['prix_total'];
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Catégorie 1', 'Catégorie 2', 'Catégorie 3'],
                    datasets: [{
                        data: [30, 40, 20], // Remplacez ces valeurs par vos propres données
                        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'] // Couleurs pour chaque portion du camembert
                    }]
                }
            });

            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var dataChart2 = {
                labels: <?= json_encode(array_keys($montantsTotals)) ?>,
                datasets: [{
                    label: 'Ventes',
                    data: <?= json_encode(array_values($montantsTotals)) ?>,
                    backgroundColor: '#36a2eb', // Couleur des barres
                    borderColor: 'black', // Couleur de la ligne de séparation
                    borderWidth: 2 // Épaisseur de la ligne de séparation
                }]
            };

            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: dataChart2,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            <?PHP

            $query = "SET lc_time_names = 'fr_FR'";
            $stmt = $dbh->query($query);
            $query = "SELECT WEEK(date) AS semaine, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande , produit WHERE date >= DATE(NOW()) - INTERVAL 5 WEEK and commande.id_produit = produit.id_produit AND commande.ID_commande = commande.ID_commande GROUP BY WEEK(date); ";
            $stmt = $dbh->query($query);
            $montantsTotals = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $montantsTotals[$row['semaine']] = $row['prix_total'];
            }
            ?>
            var ctx2 = document.getElementById('myChart3').getContext('2d');
            var dataChart2 = {
                labels: <?= json_encode(array_keys($montantsTotals)) ?>,
                datasets: [{
                    label: 'Ventes',
                    data: <?= json_encode(array_values($montantsTotals)) ?>,
                    backgroundColor: '#36a2eb', // Couleur des barres
                    borderColor: 'black', // Couleur de la ligne de séparation
                    borderWidth: 2 // Épaisseur de la ligne de séparation
                }]
            };

            var ctx2 = document.getElementById('myChart3').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: dataChart2,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
    <br>
    <br>
<?php

    include "footer.php";
} else {
?>

    <h1>Accès non autorisé</h1>

<?php
    include "footer.php";
}
?>