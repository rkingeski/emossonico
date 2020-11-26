<?php 
include('includes/header.php');
?>

<div class="container mt-4 px-4 col-lg-10">
	<ul class="list-group">
		<li class="list-group-item list-group-item-dark text-center"><b>Banco de Vozes</b></li>
		<li class="list-group-item">
			<form action="" method="post" name='filtro'>
				<div class="form-row">
					<div class="col">
						<select name='sexo' class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Sexo</option>
							<option value="1">Masculino</option>
							<option value="2">Feminino</option>
						</select>
					</div>
					<div class="col">
						<select name="idade" class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Faixa Etária</option>
							<option value='1'> &lt;18 </option>
							<option value='2'>18-29</option>
							<option value='3'>30-39</option>
							<option value='4'>40-49</option>
							<option value='5'>50-59</option>
							<option value='6'> 60+</option>
						</select>
					</div>
					<div class="col">
						<select name="emocao" class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Emoção</option>
							<option value="1">Felicidade</option>
							<option value="2">Tristeza</option>
							<option value="3">Nojo</option>
							<option value="4">Medo</option>
							<option value="5">Raiva</option>
							<option value="6">Surpresa</option>
							<option value="7">Neutro</option>
							<option value="8">Outro</option>
						</select>
					</div>
					<div>
					<p class='lead'> Nível </p>
					<input type="range" min="1" max="100" value="50" class="slider" id="myRange">
					</div>

					<div class="col-md-auto">
						<div class="btn-group">
							<input type="submit" value="Filtrar" class='btn btn-sm btn-primary'>
							<input type="reset" value="Limpar" class='btn btn-sm btn-secondary'>
						</div>
					</div>
				</div>
			</form>
		</li>
		<?php

		if(!empty($_POST)){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_NUMBER_INT);

			echo "<script>window.onload = function() {\n";
			foreach($_POST as $filtro => $valor){
				echo "	document.filtro.$filtro.value = '$valor';\n";
			}
			echo "}\n</script>";
			$where = "WHERE ";
			if(isset($_POST['sexo'])){
				$sexo = ['M', 'F'][$_POST['sexo']-1];
				$where .= "sexo = '$sexo'";
				$where .= isset($_POST['idade']) || isset($_POST['emocao']) ? " AND " : "";
			}
			if(isset($_POST['idade'])){
				$idade = ['< 18', 'BETWEEN 18 AND 29', 'BETWEEN 30 AND 39', 
						  'BETWEEN 40 AND 49', 'BETWEEN 50 AND 59', '>= 60'][$_POST['idade']-1];
				$where .= "idade $idade";
				$where .= isset($_POST['emocao']) ? " AND " : "";
			}
			if(isset($_POST['emocao'])){
				$where .= "emocao = ".$_POST['emocao'];
			}

		} else {
			$where = "";
		}

		try {
			include('includes/connection.php');
			$dados = $db->prepare("SELECT autor, idade, sexo, emocao, descricao, filename FROM audios ".$where);
			$dados->execute();
			$audios = $dados->fetchAll(PDO::FETCH_ASSOC);

			foreach($audios as $audio){
				$autor = $audio['autor'] ?? 'Anônimo';
				$emocao = ['Felicidade', 'Tristeza', 'Nojo', 'Medo', 'Raiva', 'Surpresa', 'Neutro', 'Outro'][$audio['emocao']-1];
				echo "<li class='list-group-item d-flex justify-content-between align-items-center'><div>";
				echo "<audio class='align-middle' controls='true' src='uploads/{$audio['filename']}'></audio>";
				echo "Gravado por: <b>$autor</b> ({$audio['idade']}/{$audio['sexo']}). ";
				echo "<span class='text-muted'>{$audio['descricao']}</span></div>";
				echo "<span class='badge badge-primary badge-pill'>$emocao</span>";
				echo "</li>";
			}

		} catch (PDOException $e) {
			echo "<li class='list-group-item'>";
			echo $e->getMessage();
			echo "<br><a href='criar_bd'>Acesse para inicializar o banco de dados</a>";
			echo "</li>";
		}

		?>
	</ul>
</div>

<?php 
include('includes/footer.php');
?>