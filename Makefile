default: help

help:
	@echo "Comandos disponíveis:"
	@echo "install\t\t Instala as dependências do projeto"
	@echo "update\t\t Instala as dependências do projeto"
	@echo "test\t\t Roda os testes"
	@echo "coverage\t Gera relatório de cobertura de testes"
	@echo "showcoverage\t Abre o relatório de cobertura de testes"
	@echo "doc\t\t Gera documentação do projeto"
	@echo "showdoc\t\t Abre a documentação do projeto"
	@echo "md\t\t Procura problemas no código"
	@echo "cs\t\t Procura violações ao padrão de escrita do código"
	@echo "commit\t\t Faz o git commit depois de rodar os testes"

install: get-composer composer-install docblox-config pear-config pear-install brew-install
	@echo "Instalando as dependências do projeto"

remove-vendors:
	@echo "Removendo vendors"
	@rm -rf vendors composer.lock

reinstall: remove-vendors install

update: composer-update

get-composer:
	@echo "Baixando Composer"
	wget -nc http://getcomposer.org/composer.phar

composer-install:
	@echo "Instalando dependencias usando o Composer"
	php composer.phar install

composer-update:
	@echo "Atualizando dependencias usando o Composer"
	php composer.phar update

docblox-config:
	@echo "Configurando Template do Docblox"
	php vendor/docblox/bin/docblox.php template:install new_black -v 1.0.1

get-pyrus:
	@echo "Baixando Pyrus"
	wget http://pear2.php.net/pyrus.phar -O pyrus.phar

pyrus-install:
	@echo "Instalando pacotes do Pyrus"

pear-config:
	@echo "Adicionando canais PEAR"
	pear config-set auto_discover 1
	pear channel-discover pear.phpmd.org
	pear channel-discover pear.pdepend.org

pear-install:
	@echo "Instalando pacotes PEAR"
	pear install pear.phpunit.de/PHPUnit
	pear install --alldeps phpmd/PHP_PMD
	pear install PHP_CodeSniffer-1.3.2

brew-install:
	brew install GraphViz

test:
	@echo "Rodando testes"
	php vendor/EHER/PHPUnit/phpunit.php -c config/phpunit.xml

coverage:
	@echo "Gerando relatório de cobertura de testes"
	phpunit -c config/phpunit.xml --coverage-html reports/coverage

showcoverage:
	@echo "Abrindo relatório de cobertura de código"
	open reports/coverage/index.html

doc:
	@echo "Gerando documentação"
	php vendor/docblox/bin/docblox.php run -d src/chegamos -t reports/docblox -p

showdoc:
	@echo "Abrindo documentação"
	open reports/docblox/index.html

md:
	@echo "Procurando problemas no código"
	phpmd src/ text codesize,unusedcode,design

cs:
	@echo "Verificando violações ao padrão de escrita do código"
	phpcs src/chegamos/ --encoding=utf-8 -p -s --standard=config/phpcs.xml

commit: test
	@echo "Commitando alterações"
	git commit

save: test cs
	@echo "Executando tasks do save"

build: coverage cs md
	@echo "Executando tasks do build"
