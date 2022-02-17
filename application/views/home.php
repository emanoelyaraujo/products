<?php

$this->load->view('template/header');

?>

<div class="container mt-3">
	<div class="d-flex align-items-center p-2" style="justify-content: space-between;">
		<div>
			<h3>Produtos e Tag's</h3>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-4">
			<div class="card mb-2">
				<div class="d-flex align-items-center">
					<div>
						<div class="box-blue">
							<i class="fa-solid fa-bag-shopping" style="color: #668df5"></i>
						</div>
					</div>
					<div>
						<h5 id="qtd-produto-tag" class="mb-0"><?= $countProductTag ?></h5>
						<span>quantidade de produto com tag</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card mb-2">
				<div class="d-flex align-items-center">
					<div>
						<div class="box-green">
							<i class="fa-solid fa-basket-shopping" style="color: #25ff2c;"></i>
						</div>
					</div>

					<div>
						<h5 id="qtd-produto" class="mb-0"><?= $countProduto ?></h5>
						<span>quantidade de produto</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card mb-2">
				<div class="d-flex align-items-center">
					<div>
						<div class="box-red">
							<i class="fa-solid fa-tags" style="color: #ff0000;"></i>
						</div>
					</div>

					<div>
						<h5 id="qtd-tag" class="mb-0"><?= $countTag ?></h5>
						<span>quantidade de tag</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4">
			<div class="card mb-4">
				<h4>Cadastros</h4>
				<div>
					<h6 class="mb-0"><a href="<?= base_url('Product') ?>">Produto</a></h6>
				</div>
				<br>
				<div>
					<h6 class="mb-0"><a href="<?= base_url('Tag') ?>">Tag</a></h6>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="row">
					<div class="col-md-12 text-center">
						<h3>Relatório - Tags e Produtos</h3>
						<hr>
					</div>
					<?php if (!empty($relatorio)) : ?>
						<div class="table-responsive">
							<table class="table table-hover tblLista" style="width: 650px !important;">
								<thead>
									<tr>
										<th scope="col">Tag</th>
										<th scope="col">Quantidade</th>
										<th scope="col">Produtos</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($relatorio as $r) : ?>
										<tr>
											<td><?= $r->name ?></td>
											<td><?= $r->qtd ?></td>
											<td>
												<ul>
													<?php foreach ($this->model->getProdutos($r->tag_id) as $p) : ?>
														<li><small><?= $p->name ?></small></li>
													<?php endforeach; ?>
												</ul>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else : ?>
						<div class="alert alert-primary d-flex align-items-center" role="alert">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
							</svg>
							<div>
								Para visualizar o relatório é necessário que algum produto tenha uma tag
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= datatables() ?>

<?php
$this->load->view('template/footer');
