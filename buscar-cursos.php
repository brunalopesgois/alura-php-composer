<?php

require 'vendor/autoload.php';

use Alura\Composer\BuscadorDeCursos;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

// Teste::metodo();
// exit();

$client = new Client(['base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$buscador = new BuscadorDeCursos($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo exibeMensagem($curso);
}
