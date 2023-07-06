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
                    <a href="adminproduits.php"><img src="img\catalog.png" alt="catalog" style="width: 20%"></a>
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



        try {
            $sql = "SELECT categorie.lib_cat_fr AS category, ROUND(SUM(produit.prix_produit * commande.nombre), 2) AS total_price 
                    FROM commande 
                    INNER JOIN produit ON commande.id_produit = produit.id_produit 
                    INNER JOIN categorie ON produit.id_cat = categorie.id_cat 
                    WHERE commande.date >= DATE(NOW()) - INTERVAL 5 DAY 
                    GROUP BY categorie.lib_cat_fr";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $cat_cout = $sth->fetchAll(PDO::FETCH_ASSOC);

            // Extraction des données pour le graphique
            $labels = array();
            $data = array();
            $backgroundColor = array();

            foreach ($cat_cout as $row) {
                $labels[] = $row['category'];
                $data[] = $row['total_price'];
                $backgroundColor[] = '#' . substr(md5(rand()), 0, 6); // Génération de couleurs aléatoires
            }

            // Génération du code JavaScript pour le graphique
            $chartData = array(
                'labels' => $labels,
                'datasets' => array(
                    array(
                        'data' => $data,
                        'backgroundColor' => $backgroundColor
                    )
                )
            );

            $chartDataJson = json_encode($chartData);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = <?php echo $chartDataJson; ?>;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: chartData
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