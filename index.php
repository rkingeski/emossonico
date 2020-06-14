<?php 
include('includes/header.php');
?>
	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class='fundo'>
		<div class="jumbotron rounded-0">
			<div class="container">
				<h1 class="display-3">Emossônico</h1>
				<p>Um Banco de Dados de vozes colaborativo</p>
				<p><a class="btn btn-primary btn-lg" href="gravar.php" role="button">Começar</a></p>
			</div>
		</div>
	</div>

	<div class="container">
		<h2>Escolha a forma como deseja gravar</h2>
		<p>Você pode realizar atividades para gravar os áudios ou simplesmente gravar como desejar</p>
		<div class="row justify-content-around">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">Emoções Espontaneas</div>
					<div class="card-body">
						
						<p class="card-text">Clique aqui se você deseja gravar um áudio com uma emoção que esta sentindo neste momento.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">Emoções Induzidas</div>
					<div class="card-body">
						<p class="card-text">Clique aqui caso queira realizar atividades para indução de emoções</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php 
include('includes/footer.php');
?>