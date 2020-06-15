<?php 
include('includes/header.php');
?>

<div class="container mt-4 px-4 col-md-9">
	<ul class="list-group">
		<li class="list-group-item list-group-item-dark text-center"><b>Banco de Vozes</b></li>
		<li class="list-group-item">
			<form action="" method="post" name='filtro'>
				<div class="form-row">
					<div class="col">
						<select name='sexo' class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Sexo</option>
							<option value="='M'">Masculino</option>
							<option value="='F'">Feminino</option>
						</select>
					</div>
					<div class="col">
						<select name="idade" class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Faixa Etária</option>
							<option value='< 18'> &lt;18 </option>
							<option value='BETWEEN 18 AND 29'>18-29</option>
							<option value='BETWEEN 30 AND 39'>30-39</option>
							<option value='BETWEEN 48 AND 49'>40-49</option>
							<option value='BETWEEN 58 AND 59'>50-59</option>
							<option value='>= 60'> 60+</option>
						</select>
					</div>
					<div class="col">
						<select name="emocao" class='form-control form-control-sm'>
							<option value="" disabled selected hidden>Emoção</option>
							<option value="= 1">Felicidade</option>
							<option value="= 2">Tristeza</option>
							<option value="= 3">Nojo</option>
							<option value="= 4">Medo</option>
							<option value="= 5">Raiva</option>
							<option value="= 6">Surpresa</option>
							<option value="= 7">Neutro</option>
							<option value="= 8">Outro</option>
						</select>
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
			echo "<script>window.onload = function() {\n";
			$where = "WHERE ";
			foreach($_POST as $filtro => $valor){
				$where .= $filtro." ".$valor." AND ";
				echo "\tdocument.filtro.".$filtro.".value = \"".$valor."\";\n";
			}
			$where = substr($where, 0, -4);
			echo "}\n</script>";
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
				echo "<audio class='align-middle' controls='true' src='uploads/".$audio['filename']."'></audio>";
				echo "Gravado por: <b>".$autor."</b> (".$audio['idade']."/".$audio['sexo']."). ";
				//echo "<i>".$audio['emocao'].":</i> ".$audio['descricao'].".";
				echo "<span class='text-muted'>".$audio['descricao']."</span></div>";
				echo "<span class='badge badge-primary badge-pill'>".$emocao."</span>";
				echo "</li>";
			}

		} catch (PDOException $ex) {
			echo "<li class='list-group-item'>";
			echo "<a href='criar_bd.php'>Acesse para inicializar o banco de dados</a>";
			echo "</li>";
		}

		?>
	</ul>
</div>

<?php 
include('includes/footer.php');
?>