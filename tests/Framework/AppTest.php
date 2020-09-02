<?php
namespace tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase {

    public function testRedirectUri()
    {
        $app=new App();
        $request=new ServerRequest('GET', '/slash/');
        $response=$app->run($request);

        $this->assertContains('/slash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());

    }

    public function testBlog(){
        $app=new App();
        $request=new ServerRequest('GET', '/blog');
        $response=$app->run($request);

        $this->assertEquals('<h2>Bienvenue sur mon blog</h2>', $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testError(){
        $app= new App();
        $request=new ServerRequest('GET', 'errr');
        $response=$app->run($request);

        $this->assertEquals('<h1>Erreur 404</h1>', $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }

}