<?php

/**
 * formTitle
 *
 * @param  string $title
 * @param  string $action
 * @param  string $controller
 * @return string
 */
function formTitle($title, $action, $controller)
{
	$subtitulo = [
		'create' => $title . ' - Incluir',
		'view' => $title . ' - Visualizar',
		'update' => $title . ' - Alterar',
		'delete' => $title . ' - Excluir',
		'list' => 'Listagem de ' . $title
	];

	return "
		<div class='mt-3'>
			<nav aria-label='breadcrumb'>
				<ol class='breadcrumb'>
					<li class='breadcrumb-item'><a class='fs-3 text-dark' href='" . base_url('Home') . "'>Home</a></li>
					<li class='breadcrumb-item'><a class='fs-3 text-dark' href='" . base_url($controller) . "'>" . $subtitulo[$action] . "</a></li>
				</ol>
			</nav>
		</div>";
}

/**
 * formAction - ação do formulário
 *
 * @param string $action
 * @return string
 */
function formAction($action)
{
	$url = [
		'create' => 'register',
		'update' => 'update',
		'delete' => 'delete',
		'view' => ''
	];

	return $url[$action];
}

/**
 * método que monta o script da datatables
 *
 * @param  mixed $config
 * @return void
 */
function datatables()
{
	return '
            <script src="/assets/DataTables/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    fetch("/assets/DataTables/pt_br.json")
                        .then(mock => {
                            return mock.json()
                        })
                        .then(data => {
                            $(".tblLista").DataTable({
                                language: data
							});
                        });
                });
            </script>';
}

/**
 * formSubmit
 *
 * @param  mixed $action
 * @param  mixed $url
 * @return void
 */
function formSubmit($action, $url)
{
	$classes = [
		'create' => [
			'color' => 'btn-primary',
			'text' => 'Salvar'
		],
		'update' => [
			'color' => 'btn-warning',
			'text' => 'Salvar'
		],
		'delete' => [
			'color' => 'btn-danger',
			'text' => 'Excluir'
		]
	];

	?>
	<div class='row justify-content-center py-3'>
		<div class='col-xs-12'>
			<a href='<?= base_url($url) ?>' class='btn btn-secondary btn-sm'>Voltar</a>

			<?php if (isset($classes[$action])) : ?>
				<button id='btEnviar' type='submit' class='btn <?= $classes[$action]['color'] ?> ml-2 btn-sm'>
					<?= $classes[$action]['text'] ?>
				</button>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * disabled - desabilita input, checkbox ou select
 *
 * @param  string $acao
 * @param  string $tipo
 * @return void
 */
function disabled($action, $type = 'R')
{
	if ($action == 'view' || $action == 'delete') {
		if ($type == 'D') {
			return 'disabled';
		}

		return 'readonly';
	}

	return '';
}