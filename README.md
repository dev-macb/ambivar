<h1 align="center">🔷 Ambivar 🔷</h1>



<div id="metadados" align="center">
    <img alt="Packagist Version" src="https://img.shields.io/packagist/v/dev-macb/ambivar?color=blue&logoColor=gray">
    <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dm/dev-macb/ambivar?color=blue&logoColor=gray">
    <img alt="Packagist License" src="https://img.shields.io/packagist/l/dev-macb/ambivar?color=blue&logoColor=gray">
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
URL=http//localhost/exemplo
```

Use as funcionalidades do pacote
```php
<?php
    // Importação do módulo
    use DevMacB\Ambivar;

    // Carregar todos os arquivos com extensão .env na raiz do projeto
    Ambivar::dotenv();

    // Carregar um arquivo .env específico
    Ambivar::carregar(__DIR__, 'nome_arquivo');

    // Escrever uma variável de ambiente no arquivo especificado
    Ambivar::escrever_env(__DIR__, '', 'NOME_PROJETO', 'Ambivar');

    // Apagar uma variável de ambiente específica de um arquivo .env
    Ambivar::apagar_env(__DIR__, '', 'URL');

    // Use as variáveis de ambiente
    echo getenv('URL');    
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
