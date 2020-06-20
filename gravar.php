<?php 
session_start();
if(!isset($_SESSION['termo'])) //verifica se termo foi assinado
	header("Location: termo.php");

//proteção CSRF
if (empty($_SESSION['token']))
	$_SESSION['token'] = base64_encode(random_bytes(32));

include('includes/header.php');
?>

<div>
	<div class="container mt-4 px-4 col-md-8">
		<h2>Gravador de Áudio</h2>
		<p class='lead'>Grave aqui sua emoção</p>

		<p>Para fazer as gravações é necessário utilizar um fone de ouvido, para não causar interferência dos áudios
		do video com o áudio gravado. Preencha algumas informações sobre você, e, se desejar, identifique-se!<br>
		Ao gravar, você está concorcando com os <a href="termo.php">Termos</a>.</p>
	
		
		<form action="javascript:;" method='post' name='perfil'>
			<input type="hidden" name="_token" value="<?php echo $_SESSION['token'] ?>">
			<div class="form-row">
				<div class="col-sm-4">
					<input class="form-control form-control-sm" type="text" name="autor" id="autor"
						placeholder="Seu nome">
				</div>
				<div class="col-sm-1">
					<input class="form-control form-control-sm" type="number" name="idade" id="idade"
						placeholder="Idade" required>
				</div>
				<div class="col-sm-3">
					<select id="sexo" class='form-control form-control-sm' required>
						<option value="" disabled selected hidden>Sexo</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
					</select>
				</div>
			</div>
		</form>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<br>

		<div class="container text-center">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button id="recordButton" class="btn btn-secondary ">Gravar</button>
				<button id="pauseButton" class="btn btn-secondary" disabled>Pausar</button>
				<button id="stopButton" class="btn btn-secondary" disabled>Parar</button>
			</div>
			<div id="formats" class="mt-2">Formato:</div>
		</div>
		<div class="container mt-3">

			<ul id="recordingsList" class="list-group">
				<li class="list-group-item list-group-item-dark text-center"><b>Gravações</b></li>
			</ul>
		</div>

		<script src="includes/recorder.js"></script>
		<script src="includes/app.js"></script>

	</div>
</div>

<?php 
include('includes/footer.php');
?>