<div id="título" align="center">
    <h1>🔷 Ambivar 🔷</h1>
</div>


<details>
    <summary>📌 Informações do Projeto</summary>
    <div id="metadados" align="center">
        <img alt="Packagist Version" src="https://img.shields.io/packagist/v/dev-macb/ambivar">
        <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dm/dev-macb/ambivar">
        <img alt="Packagist License" src="https://img.shields.io/packagist/l/dev-macb/ambivar">
    </div>
</details>


<details>
    <summary>📌 Índice</summary>
    <ul id="lista-índice">
        <li><a href="#objetivo">Objetivo</a></li>
        <li><a href="#instalação">Instalação</a></li>
        <li><a href="#funcionalidades">Funcionalidades</a></li>
        <li><a href="#contribuições">Contribuições</a></li>
        <li><a href="#licença">Licença</a></li>
    </ul>
</details>

---

<h2 id="objetivo">🎯 Objetivo</h2>
<p>
    Este é um projeto em PHP que demonstra como carregar variáveis de ambiente a partir de arquivos .env. O objetivo deste projeto é mostrar como podemos usar arquivos .env para armazenar configurações sensíveis, como chaves de API, senhas e outras informações que não devem ser expostas no código.
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

```php
<?php
    use MacB\Ambivar;

    // Carregar arquivo .env passando o caminho do diretório
    Ambivar::Carregar(__DIR__);
?>
```

<blockquote>
    Neste documento há apenas uma abresentação breve das funcionalidades do pacote. Para visualizar a documentação oficial com todas as funções e informações adicionais do módulo clique <a target="_blank" href="https://braz.readthedocs.io/pt_BR/latest/?badge=latest">aqui</a>.
</blockquote>
</p>
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