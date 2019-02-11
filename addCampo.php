<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Adicionando Campo Dinâmico</title>
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<a class="btn btn-primary" href="javascript:void(0)" id="addInput">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				Adicionar Campo
			</a>
			<br/>
			<div id="dynamicDiv">
				<p>
			        <input type="text" id="inputeste" size="20" value="" placeholder="" />
			        <a class="btn btn-danger" href="javascript:void(0)" id="remInput">
			        	<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			        	Remover Campo
					</a>
		        </p>
		    </div>

			<script>
			$(function () {
			    var scntDiv = $('#dynamicDiv');
			    $(document).on('click', '#addInput', function () {
			        $('<p>'+
		        		'<input type="text" id="inputeste" size="20" value="" placeholder="" /> '+
		        		'<a class="btn btn-danger" href="javascript:void(0)" id="remInput">'+
							'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
							'Remover Campo'+
		        		'</a>'+
					'</p>').appendTo(scntDiv);
			        return false;
			    });
			    $(document).on('click', '#remInput', function () {
		            $(this).parents('p').remove();
			        return false;
			    });
			});
			</script>
		</div>
	</body>
</html>
