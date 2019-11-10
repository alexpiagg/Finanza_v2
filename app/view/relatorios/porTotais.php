	<section id="container" >
	
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<h3><i class="fa fa-angle-right"></i> Relatórios > Por Totais </h3>
				
				<div class="row mt">
					<div class="col-md-12">
							<div class="panel-heading">
								<div class="pull-left"><h5></i> Veja abaixo a sua saúde financeira: </h5></div>
								<br>
								<div class="custom-check goleft mt">
									<table id="todo" class="table custom-check">
										<tbody>
											<tr>
												<td>				                        
													1) Você já recebeu R$ <b><?php echo $totalReceitaAno; ?> </b> este ano!
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>													
												</td>
											</tr>
											<tr>
												<td>				                        
													2) Você já gastou R$ <b><?php echo $totalAno; ?> </b> este ano!
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
											</td>
											</tr>								
											<tr>
												<td>
													3) Este mês já recebeu R$ <b> <?php echo $totalReceitaMesAtual; ?> </b>
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												</td>
											</tr>
											<tr>
												<td>
													4) Este mês já gastou R$ <b> <?php echo $totalMesAtual; ?> </b>
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												</td>
											</tr>
											<tr>
												<td>
													5) No último mês você gastou R$ <b> <?php echo $totalMesAnterior; ?> </b>
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												</td>
											</tr>
											<tr>
												<td>
													6) Em sua conta há: R$ <b> <?php echo $totalConta; ?> </b>
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												</td>
											</tr>
										</tbody>
									</table>							
								</div>
					</div>
				</div>
			
			</section>
		</section>

	<!-- main content end-->
	</section>
