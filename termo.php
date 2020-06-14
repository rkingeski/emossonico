<?php 
session_start();
if(isset($_POST['a'])){
	if($_POST['a'] == 1 ){
		$_SESSION['termo']=1;
		header("Location: gravar.php");
	} elseif ($_POST['a'] == 0) {
		$_SESSION['termo']=NULL;
		header("Location: obrigado.php"); //redirection para pagina agradecendo?
	}
}

include('includes/header.php');
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-8" style='text-align: justify;'>
				<h2>Termo de Consentimento Livre e Esclarecido</h2>

				<p class='lead'>Para poder participar desta pesquisa você precisa concordar com o termo abaixo.</p>

				<p>O(a) senhor(a) está sendo convidado a participar de uma pesquisa de doutorado intitulada “SS”, que fará gravações, tendo como objetivo criar um banco de voz com emoções. Serão previamente marcados a data e horário para as gravações, utilizando equipamentos de gravação de áudio e equipamentos físicos. Estas medidas serão realizadas no estúdio de gravação da rádio UDESC de Joinville. Também serão realizadas atividades para indução de emoções tais como visualização de vídeos e atividades para indução de emoções. Não é obrigatório participar de todas as atividades nem todas as gravações.</p>
				<p>O(a) Senhor(a) não tera despesas e nem sera remunerados pela participação na pesquisa. Todas as despesas decorrentes de sua participação serão ressarcidas. Em caso de danos, decorrentes da pesquisa será garantida a indenização. 
				Os riscos destes procedimentos serão mínimos por envolver indução de emoções, porém de forma a não prejudicar psicologicamente os participantes desta pesquisa.
				<p>A sua identidade será preservada, pois não é necessário se identificar, podendo inclusive utilizar um pseudonimo onde é requerido o nome do participante.</p>
				<p>Os benefícios e vantagens em participar deste estudo serão contribuir para a criação de um instrumento de estudo e pesquisa.</p>
				<p>As pessoas que estarão acompanhando os procedimentos serão os pesquisadores o estudante de doutorado Rafael Kingeski, o professor responsável Dr. Aleksander Sade Paterno.</p>
				<p>O(a) senhor(a) poderá se retirar do estudo a qualquer momento, sem qualquer tipo de constrangimento.</p>
				<p>Solicitamos a sua autorização para o uso de seus dados para a produção de artigos técnicos e científicos e para divulgação. A sua privacidade será mantida através da não-identificação de sua identidade, portanto, não coloque o seu nome completo no campo de identificação das gravações.</p>
				<p>Este termo de consentimento livre e esclarecido é feito em duas vias, sendo que uma delas ficará em poder do pesquisador e outra com o sujeito participante da pesquisa.</p>

				<p>NOME DO PESQUISADOR RESPONSÁVEL PARA CONTATO: Rafael Kingeski</br>
				NÚMERO DO TELEFONE: (47) 99640-5959</p>

				<p>Comitê de Ética em Pesquisa Envolvendo Seres Humanos – CEPSH/UDESC</br>
				Av. Madre Benvenuta, 2007 – Itacorubi – Florianópolis – SC - 88035-901</br>
				Fone/Fax: (48) 3664-8084 / (48) 3664-7881 - E-mail: cepsh.reitoria@udesc.br / cepsh.udesc@gmail.com </br>
				CONEP- Comissão Nacional de Ética em Pesquisa</br>
				SEPN 510, Norte, Bloco A, 3ºandar, Ed. Ex-INAN, Unidade II – Brasília – DF- CEP: 70750-521</br>
				Fone: (61) 3315-5878/ 5879 – E-mail: conep@saude.gov.</p>

				<form action="" method="post">
					<button name='a' type="submit" class='btn btn-primary' value='1'>Li e concordo com os termos</button>
					<button name='a' type="submit" class='btn btn-secondary' value='0'>Não concordo</button>
				</form>

		</div>
	</div>
</div>
	<?php 
include('includes/footer.php');
?>