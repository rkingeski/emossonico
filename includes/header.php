<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		
		<title>Emossônico</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
			integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
			integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
			integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            
        <style>
            .fundo{
                background-image: url('images/waves.png');
                background-position: center;
                background-size: cover;
            }
            .jumbotron{
                background-color: rgba(169, 169, 169, 0.5);
            }
				input::-webkit-outer-spin-button,
				input::-webkit-inner-spin-button {
					/* display: none; <- Crashes Chrome on hover */
					-webkit-appearance: none;
					margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
				}

				input[type=number] {
					-moz-appearance:textfield; /* Firefox */
				}
        </style>

	</head>
	<body class='pt-5 mt-2'>
		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<span class="navbar-brand" href="#">Emossônico</span>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
			  
				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				  <ul class="navbar-nav mr-auto">
					<li class="nav-item">
					  <a class="nav-link" href="/">Página Inicial</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="sobre">Sobre</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="gravar" >Gravar</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="banco" >Banco de Vozes</a>
					</li>
				  </ul>
				</div>
			  </nav>
        </header>
        <main>