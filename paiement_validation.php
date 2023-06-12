<!DOCTYPE html>
<html>

<title>Page de confirmation</title>
<style>
	#mascotte {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		animation: dance 2s ease infinite;
	}

	@keyframes dance {
		0% {
			transform: translate(-50%, -50%) rotate(0deg);
		}

		25% {
			transform: translate(-50%, -50%) rotate(20deg);
		}

		50% {
			transform: translate(-50%, -50%) rotate(0deg);
		}

		75% {
			transform: translate(-50%, -50%) rotate(-20deg);
		}

		100% {
			transform: translate(-50%, -50%) rotate(0deg);
		}
	}
</style>

<body>
	<h1>Votre achat a été confirmé !</h1>
	<a href="index.php">Retour à l'accueil</a>
	<div id="mascotte">
		<img src="img\mange.jpg" alt="Mascotte de l'entreprise">
	</div>
	<script>
		// Récupérez la référence de l'élément HTML qui contiendra l'animation
		const animationContainer = document.getElementById("animation-container");
		// Créez une image pour représenter votre mascotte
		const mascotImage = new Image();
		mascotImage.src = "img\mange.jpg";
		// Définissez les dimensions de l'image
		const mascotWidth = 100;
		const mascotHeight = 100;
		// Créez une fonction pour animer la mascotte
		function animateMascot() {
			// Déplacez la mascotte vers la droite
			let currentPosition = parseInt(mascotImage.style.left);
			mascotImage.style.left = currentPosition + 5 + "px";
			// Changez la direction de la mascotte si elle atteint le bord de l'écran
			if (currentPosition > window.innerWidth - mascotWidth) {
				mascotImage.style.transform = "scaleX(-1)";
			} else if (currentPosition < 0) {
				mascotImage.style.transform = "scaleX(1)";
			}
			// Appelez cette fonction à nouveau pour continuer l'animation
			window.requestAnimationFrame(animateMascot);
		}
		// Ajoutez l'image à l'élément HTML de l'animation
		animationContainer.appendChild(mascotImage);
		// Définissez les styles CSS de la mascotte
		mascotImage.style.position = "absolute";
		mascotImage.style.left = "0";
		mascotImage.style.top = "50%";
		mascotImage.style.transform = "translateY(-50%) scaleX(1)";

		// Appelez la fonction d'animation pour commencer l'animation
		animateMascot();
	</script>

</body>

</html>