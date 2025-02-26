<h1 align="center">🔷 Ambivar 🔷</h1>

<div id="metadados" align="center">
    <img alt="Packagist Version" src="https://img.shields.io/packagist/v/dev-macb/ambivar?color=blue&logoColor=gray">
    <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dm/dev-macb/ambivar?color=blue&logoColor=gray">
    <img alt="Packagist License" src="https://img.shields.io/packagist/l/dev-macb/ambivar?color=blue&logoColor=gray">
</div>

<h2 id="objetivo">🎯 Objetivo</h2>
<p>
    O <strong>Ambivar</strong> é um pacote em PHP para facilitar a gestão de 
    variáveis de ambiente em projetos. Ele permite carregar e manipular 
    variáveis através de um arquivo <code>.env</code>, garantindo segurança e 
    flexibilidade para o gerenciamento de configurações do sistema.
</p>
<p align="center">🔷</p>

<h2 id="instalacao">🔧 Instalação</h2>
<p>
Para instalar o Ambivar, certifique-se de ter o <a target="_blank" href="https://www.php.net/">PHP</a> e o <a target="_blank" href="https://getcomposer.org/">Composer</a> instalados. Execute o seguinte comando:
</p>

```bash
composer require dev-macb/ambivar
```

<p align="center">🔷</p>

## 🚀 Uso Básico

### Carregamento de Variáveis
```php
use MacB\Ambivar;

Ambivar::inicializar(__DIR__);  // Opcional
Ambivar::dotenv();              // Carrega o arquivo .env padrão
Ambivar::carregar(".env.dev");  // Carrega um arquivo específico
```

### Manipulação de Variáveis
```php
Ambivar::adicionar('APP_ENV', 'production');
Ambivar::remover('TEMP_VAR');
$valor = Ambivar::obter('DB_HOST', 'localhost');
```

### Acesso às Variáveis
```php
echo Ambivar::obter('DB_NAME');
echo getenv('DB_NAME');
echo $_ENV['DB_NAME'];
```

<p align="center">🔷</p>

## 📚 Documentação Técnica

#### `ambivar(string $diretorioBase = null): void`
Define o diretório base para carregar arquivos `.env`.
```php
Ambivar::ambivar(__DIR__);
```

#### `dotenv(): bool`
Carrega o arquivo `.env` padrão do diretório base.
```php
Ambivar::dotenv();
```

#### `carregar(string $caminhoDoArquivoEnv): bool`
Carrega um arquivo `.env` específico.
```php
Ambivar::carregar("/caminho/.env");
```

#### `carregarDiretorio(string $diretorio): int`
Carrega todas as variáveis de ambiente dos arquivos `.env` dentro de um diretório.
```php
Ambivar::carregarDiretorio("/config");
```

#### `existe(string $chave): bool`
Verifica se uma variável de ambiente existe.
```php
if (Ambivar::existe('SECRET_KEY')) {
    echo "Chave existe";
}
```

#### `obter(string $chave, mixed $padrao = null): mixed`
Obtém o valor de uma variável de ambiente ou retorna um valor padrão se não existir.
```php
$valor = Ambivar::obter('DB_PORT', 3306);
```

#### `obterTodos(): array`
Retorna todas as variáveis de ambiente carregadas.
```php
$todas = Ambivar::obterTodos();
```

#### `adicionar(string $chave, string $valor, ?string $caminhoDoArquivoEnv = null): bool`
Adiciona ou atualiza uma variável de ambiente.
```php
Ambivar::adicionar('APP_DEBUG', 'true');
```

#### `adicionarVarios(array $variaveis, ?string $caminhoDoArquivoEnv = null): int`
Adiciona múltiplas variáveis de ambiente de uma só vez.
```php
Ambivar::adicionarVarios(['API_KEY' => '123', 'TIMEZONE' => 'UTC']);
```

#### `remover(string $chave, ?string $caminhoDoArquivoEnv = null): bool`
Remove uma variável de ambiente.
```php
// Remove a variável TEMP_TOKEN do arquivo .env padrão
Ambivar::remover('TEMP_TOKEN');

// Remove a variável DEBUG de um arquivo específico
Ambivar::remover('DEBUG', __DIR__ . '/.env.test');
```

### Boas Práticas
- **Não commit arquivos `.env`**: Adicione ao `.gitignore` e forneça um `.env.example`.
- **Evite armazenar dados sensíveis em texto puro**.
- **Use nomes descritivos e padrões** (`DB_HOST`, `APP_ENV`).
- **Sempre forneça valores padrão** ao acessar variáveis.




## ✒️ Contribuições
Se deseja contribuir, relate problemas ou sugira melhorias abrindo uma <a href="https://github.com/dev-macb/ambivar/issues">Issue</a> 
ou enviando um <em>Pull Request</em>. Se gostou do projeto, deixe uma ⭐ para apoiar!

<p align="center">🔷</p>

## 📄 Licença
O Ambivar é licenciado sob a <strong>MIT License</strong>. Consulte os termos em 
<a href="https://github.com/dev-macb/ambivar/blob/dev/LICENSE.md">LICENSE</a>.

<p align="center">🔷</p>
