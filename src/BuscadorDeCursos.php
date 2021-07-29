<?php

namespace Alura\Composer;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class BuscadorDeCursos
{
    private ClientInterface $client;
    private Crawler $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->client->request('GET', $url);

        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);

        $elementosCurso = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementosCurso as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
