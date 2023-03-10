<h1 align="center">🔷 Ambivar 🔷</h1>


<div id="metadados" align="center">
    <img alt="Packagist Version" src="https://img.shields.io/packagist/v/dev-macb/ambivar">
    <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dm/dev-macb/ambivar">
    <img alt="Packagist License" src="https://img.shields.io/packagist/l/dev-macb/ambivar">
</div>


---

<h2 id="objetivo">🎯 Objetivo</h2>
<p>
O <strong>Ambivar</strong> é um pacote em PHP que tem como objetivo facilitar a gestão de variáveis de ambiente em projetos. Esse pacote permite carregar essas variáveis através de um arquivo <code>.env</code>, que é lido automaticamente ou especificando o diretório do arquivo. 

Esse tipo de abordagem tem se tornado cada vez mais comum em projetos de software, pois oferece uma maneira fácil e segura de gerenciar configurações e segredos do projeto, sem precisar expor essas informações no código fonte.

O uso do Ambivar é bastante simples e intuitivo. Basta incluir o pacote no seu projeto PHP e criar um arquivo .env na raiz do projeto, contendo as variáveis de ambiente desejadas. O Ambivar se encarregará de ler esse arquivo e disponibilizar as variáveis para o projeto através de funções específicas.
</p>
<p align="center">🔷</p>


<h2 id="instalação">🔧 Instalação</h2>
<p>
    Para instalar o pacote Ambivar, certifique-se de que tenha o <a target="_blank" href="https://www.php.net/">PHP</a> e o gerenciador de pacotes <a target="_blank" href="https://getcomposer.org/">Composer</a> instalados em seu ambiente.
    Instale executando o seguinde comando:
</p>

```bash
$ composer require dev-macb/ambivar
```
<p>
    Para clonar o projeto para sua máquina via <a target="_blank" href="https://git-scm.com/">git</a>, execute os comandos a seguir:
</p>

```bash
$ mkdir ambivar && cd ambivar
$ git clone https://github.com/dev-macb/ambivar
$ composer install
```
<p align="center">🔷</p>


<h2 id="funcionalidades">⚙️ Funcionalidades</h2>
<p>
Para usar o Ambivar basta criar um arquivo <code>.env</code> na raiz de seu projeto. Como, por exemplo:

```env
BD_HOST=localhost
BD_PORT=12345
BD_NAME=nome_do_banco
BD_USER=usuario_do_banco
BD_PASS=senha_do_usuario
```

Use as funcionalidades do pacote
```php
<?php
    use DevMacB\Ambivar;

    // Carregar .env na raiz do projeto
    Ambivar::Carregar();

    // Carregar .env especificando o diretório em que o arquivo se encontra
    Ambivar::Carregar(__DIR__.'/dotenv');

    // Adicione novas variáveis passando seu nome e velor
    Ambivar::Definir_Variavel('URL', 'http://localhost');

    // Utilize as variáveis usando $_ENV ou getvar()
    echo getenv('URL');
    echo $_ENV['URL'];
    echo $_SERVER['URL'];

    // Remova variáveis existentes passando seu nome
    Ambivar::Apagar_Variavel('URL');
?>
```
<blockquote>
    Lembre-se de adicionar no <code>.gitignore</code> as arquivos de variáveis de ambiente para não colocar dados sensíveis do seu projeto para repositórios na nuvem
</blockquote>

<p align="center">🔷</p>



<h2 id="contribuições">✒️ Contribuições</h2>
<p>
    Toda contribuição será bem-vinda!🎉 Caso tenha encontrado algum bug, propor uma nova funcionalidade ou conversar sobre o projeto <a href="https://github.com/dev-macb/ambivar/issues">Abra uma Issue</a> e descreva seu caso. Se houver uma issue aberta e você deseja resolve-la, adicionar uma nova funcionalidade ou melhorar a documentação, desenvolva suas adições e me envie um <em>Pull Request</em>. Gostou do projeto e ainda não consegue contribuir com ele? Considere deixar uma ⭐ para o <strong>Ambivar</strong>. Desde já agradeço pelo interesse em colaborar de alguma forma com o nosso projeto.</a>
</p>
<p align="center">🔷</p>



<h2 id="licença">📄 Licença</h2>
<p>
    O Ambivar utiliza a <strong>licença MIT</strong> em todo seu código, confira suas condições em <a href="https://github.com/dev-macb/ambivar/blob/dev/LICENSE.md">LICENSE</a>.
</p>
<p align="center">🔷</p>
