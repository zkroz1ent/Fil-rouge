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
		const animationContainer = document.getElementById("animation-container");
		const mascotImage = new Image();
		mascotImage.src = "img\mange.jpg";
		const mascotWidth = 100;
		const mascotHeight = 100;
		function animateMascot() {
			let currentPosition = parseInt(mascotImage.style.left);
			mascotImage.style.left = currentPosition + 5 + "px";
			if (currentPosition > window.innerWidth - mascotWidth) {
				mascotImage.style.transform = "scaleX(-1)";
			} else if (currentPosition < 0) {
				mascotImage.style.transform = "scaleX(1)";
			}
			window.requestAnimationFrame(animateMascot);
		}
		animationContainer.appendChild(mascotImage);
		mascotImage.style.position = "absolute";
		mascotImage.style.left = "0";
		mascotImage.style.top = "50%";
		mascotImage.style.transform = "translateY(-50%) scaleX(1)";

		animateMascot();
	</script>

</body>

</html>