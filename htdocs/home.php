<?php 
include ('conexao.php'); 
Proteger();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto</title>
	<meta charset="utf-8">
	  <!-- Compiled and minified CSS -->
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 -->
    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
            
</head>
<body>
<div class="row">
	<nav>
		<div class="nav-wrapper">
		<a href="home.php" class="brand-logo"><i class="material-icons">cloud</i><?php echo $_SESSION['nome']; ?></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="home.php"><i class="material-icons">home</i></a></li>
				<li><a href="sair.php"><i class="material-icons">arrow_forward</i></a></li>
			</ul>
		</div>
	</nav>
</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col s6 m6 offset-s3 offset-m3">
				<form method="post" action="home.php">
					<fieldset>
						<legend>Novo jogo</legend>
						<div class="row">
							<div class="input-field col s6">
								<input type="text" name="nome" id="nome" class="validate">
								<label for="nome">Nome do jogo: </label>
							</div>
							<div class="input-field col s3">
								<?php
									$todas = ListarCategorias();
									while($cat = $todas -> fetch_object()){
										echo '<p>
												<label>
												<input name="categoria" type="radio" values="'.$cat.'"/>
												<span>'.$cat->nome.'</span>
												</label>
											  </p>';
									}
								?>
							</div>
							<div class="input-field col s3">
								<input type="submit" class="btn" value="Cadastrar">
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col s8 m8 offset-s2 offset-m2">
				<h1>Meus Jogos</h1>
				<?php
				if(isset($_POST['nome'])){
					$sql = 'INSERT INTO jogo (nome, id_usuario, id_categoria) VALUES ("'.$_POST['nome'].'",'.$_SESSION['cd'].','.$_POST['categoria'].')';
					$res = $con->query($sql);
					if($res){
						msg("Jogo Cadastrado");
					}else{
						msg("Erro ao cadastrar jogo!"); 
					}
				}
					$todos = ListarJogos($_SESSION['cd']);
					while($jogo = $todos->fetch_object()){
						echo '<a href="perguntas.php?game='.$jogo->cd.'">
						<button class="btn">'.$jogo->nome.'</button>
						</a>';
					}
				?>
			</div>
		</div>
	</div>	
</body>
</html>
