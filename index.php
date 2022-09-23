<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link href='https://fonts.googleapis.com/css?family=Coiny' rel='stylesheet'>
	<title>Petrona Burger</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<script>

		function ver() {
			if(document.getElementById('burger').checked){
				document.getElementById('hd1').style.visibility='visible';
			}else{document.getElementById('hd1').style.visibility='hidden';}

//------------------------------------------------------------------------------------------------
			if(document.getElementById('drink').checked){
				document.getElementById('bd1').style.visibility='visible';
			}else{document.getElementById('bd1').style.visibility='hidden';}

//------------------------------------------------------------------------------------------------
			if(document.getElementById('side').checked){
				document.getElementById('dd1').style.visibility='visible';
			}else{document.getElementById('dd1').style.visibility='hidden';}

//------------------------------------------------------------------------------------------------
		}
		function ver2() {
			var h1=document.getElementById("h1").value;var veri=0; var vei=0;
			var b1=document.getElementById("b1").value;
			var a1=document.getElementById("a1").value;
			var cc=document.getElementById("CC").value;

			if(h1<=0){
				if(b1<=0){
					if(a1<=0){
							alert('!!NO INGRESO NINGUN PRODUCTO¡¡');veri=0;
					}else{veri=1;}
				}else{veri=1;}
			}else{veri=1;}
	

			if (cc==0) {vei=0;alert('!!NO INGRESO LA CEDULA DEL CLIENTE¡¡');}
			if(veri!=0){
				<?php
				session_start();
				//-------------AGREGAR PEDIDOS----------------------------------------------------
					if((isset($_POST['add'])) && ($_POST['cedula']!=0)
						&& (($_POST['h1'] || $_POST['b1'] || $_POST['a1'])!=0)){
							$total=0;
							if($_POST['h1']>0){
								$total=($_POST['h1']*10000)+$total;
								if($_POST['b1']>0){
									$total=($_POST['b1']*5000)+$total;
									if($_POST['a1']>0){
										$total=($_POST['a1']*5000)+$total;
									}
								}
							}
							$num=rand(1000, 9999);
        					$pedido=array("cedula"=>$_POST['cedula'],"burger"=>$_POST['h1'],"drink"=>$_POST['b1'],"side"=>$_POST['a1'], "total"=>$total, "num_ped"=>$num);
        					$_SESSION['Pedidos'][]=$pedido;
							
    				}
					
					

					//-----------ELIMINAR PEDIDOS-------------------------------------------------
    				if (isset($_POST['delete'])) {
        				unset($_SESSION['Pedidos'][$_POST['key']]);
    				}
    				//-----------MODIFICAR PEDIDOS------------------------------------------------
    				if (isset($_POST['update'])) {
        			$pedido=array("cedula"=>$_POST['cedula2'],"burger"=>$_POST['burger2'],"drink"=>$_POST['drink2'],"side"=>$_POST['side2']);
        				
        				$_SESSION['Pedidos'][$_POST["key"]]=$pedido;
    				}
			$products = [
	  			1  => ["name" => "burger", "price" => 10000],
	  			2  => ["name" => "drink", "price" => 5000],
	  			3  => ["name" => "side", "price" => 5000]
			];
	
				?>
			}
		}

		
		function consultat(){
			session_start();
		}
	</script>

	<header>
        <div class="contenedor">
            <div class="header-logo">
                <div class="logo">
                    <a href="#">Petrona Burger</a>
                </div>

                <div class="redes-sociales">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="likeding"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </header>

	<form method="post" action="">
		
		
		<br>
        <input type="text" name="cedula" id="CC" placeholder="Cedula"><br><br>  
        <button class="myButton" name="add" value="0" onclick="ver2()">AGREGAR PEDIDO</button><br>
--------------------------------------------------------------------------------------------------
		
		<main>
			<section class="menu">
				<div class="contenedor">
					<h3 class="titulo">Menu</h3>
					<div class="contenedor-menu">
						<div class="contenedor-menu2">
							<article>
								<p class="categoria">De comer</p>
								<div class="platillo">
									<p class="nombre">Hamburguesa</p>
									<p class="precio">$10.000</p>
									<p class="descripcion">
										<input type="checkbox" name="burger" id="burger" onclick="ver()"/><br>
										<div id="hd1" style="visibility:hidden">
											<input type="number" name="h1" id="h1" value="0">
										</div>
									</p>
								</div>
							</article>

							<article>
								<p class="categoria">De Beber</p>
								<div class="platillo">
									<p class="nombre">Fanta</p>
									<p class="precio">$5.000</p>
									<p class="descripcion">
										<input type="checkbox" name="drink" id="drink" onclick="ver()"/><br>
										<div id="bd1" style="visibility:hidden">
											<input type="number" name="b1" id="b1" value="0">
										</div>
									</p>
								</div>
							</article>

							<article>
								<p class="categoria">Acompañamiento</p>
								<div class="platillo">
									<p class="nombre">Papas</p>
									<p class="precio">$5.000</p>
									<p class="descripcion">
										<input type="checkbox" name="side" id="side" onclick="ver()"/><br>
										<div id="dd1" style="visibility:hidden">
											<input type="number" name="a1" id="a1" value="0">
										</div>
									</p>
								</div>
							</article>
						</div>
					</div>
				</div>
			</section>
		</main>

	</form>
	<h3 class="titulo2">Lista de pedidos</h3>
	
</body>
</html>
<?php
if(isset($_SESSION['Pedidos'])){
	
        foreach ($_SESSION['Pedidos'] as $key => $value) {?>
		 <table id="myTable"style="border:1px solid black" align="center">
			<tr><th>Cliente</th>
				<th>Hamburguesa</th>
				<th>Bebida</th>
				<th>Acompañantes</th>
				<th>Total</th>
				<th>N° Pedido</th></tr> 
		
        	<html><tr style="border:1px solid black;"></html>
           
<HTML>

<form method="post" action="">
  	<th style="border:1px solid black;">
  		<input type="text"name="cedula2" value=<?php echo$value['cedula'] ?>>
	</th>

  	<th style="border:1px solid black;">
  		<input type="text"name="burger2"value=<?php echo $value['burger'] ?>>
	</th>

  	<th style="border:1px solid black;">
  		<input type="text"name="drink2"value=<?php echo $value['drink'] ?>>
	</th>

  	<th style="border:1px solid black;">
  		<input type="text"name="side2"value=<?php echo $value['side'] ?>>
	</th>

	<th style="border:1px solid black;">
  		<input type="text"name="total"value=<?php echo $value['total'] ?>>
	</th>

	<th style="border:1px solid black;">
  		<input type="text"name="num"value=<?php echo $value['num_ped'] ?>>
	</th>
	<th style="border:1px solid black; display:none;">
  		<input type="text" name="key" readonly="readonly" value=<?php echo $key ?>>
	</th>
    <th style="border:1px solid transparent;"><button class="myButton" name="delete">ELIMINAR</button>
	</th>
</form>
           
</HTML>
<?php
			echo '</tr> <br>';
        }
    }
	
?>
</table><br>

