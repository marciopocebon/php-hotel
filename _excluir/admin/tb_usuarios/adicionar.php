	<?php include '../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Cadastrar Tb Usuarios</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=salvar" method="post">
						<div class='form-group'>
<label>Usu Email</label>
<input type='text' name='usu_email' class='form-control' placeholder='Usu Email' required>
</div>

<div class='form-group'>
<label>Usu Senha</label>
<input type='text' name='usu_senha' class='form-control' placeholder='Usu Senha' required>
</div>

<div class='form-group'>
<label>Usu Tipo</label>
<input type='text' name='usu_tipo' class='form-control' placeholder='Usu Tipo' required>
</div>

<div class='form-group'>
<label>Usu Conf</label>
<input type='text' name='usu_conf' class='form-control' placeholder='Usu Conf' required>
</div>

<div class='form-group'>
<label>Usu Hash</label>
<input type='text' name='usu_hash' class='form-control' placeholder='Usu Hash' required>
</div>

<div class="form-group">
<label>Fk Cli Cod</label>
<select class="form-control" name="fk_cli_cod" >
<option value="">SELECIONE UMA OPÇÃO</option>
<?php   foreach ($data["fk_cli_cod_list"] as $value) {  ?>
<option value="<?php  echo $value["pk_cli_cod"];  ?>"><?php  echo $value["pk_cli_cod"];  ?></option>
<?php  }  ?>
</select>
</div>

						<button type="submit" style="float:right;" class="btn btn-default">Salvar</button>
					</form>
				</div>
			</div>		
		</div>	
	</div>
	
	<?php include '../footer.php'; ?>
