default: help

help:
	@echo "Comandos disponíveis:"
	@echo "depends\t\t Instala as dependências do projeto"
	@echo "test\t\t Roda os testes"
	@echo "coveraget\t\t Gera relatório de cobertura de testes"
	@echo "showcoverage\t Abre o relatório de cobertura de testes"
	@echo "md\t\t Procura problemas no código e gera relatório"
	@echo "showmd\t Abre o relatório de problemas no código"
	@echo "doc\t\t Gera documentação do projeto"
	@echo "showdoc\t\t Abre a documentação do projeto"
	@echo "commit\t\t Faz o git commit depois de rodar os testes"

depends: git-submodules pear-config pear-install brew-install
	@echo "Atualizando dependências do projeto..."

git-submodules:
	@echo "Inicializando submodules..."
	git submodule update --init
	php vendor/docblox/bin/docblox.php template:install new_black -v 1.0.1

pear-config:
	@echo "Adicionando canais PEAR..."
	pear config-set auto_discover 1
	pear channel-discover pear.phpmd.org
	pear channel-discover pear.pdepend.org

pear-install:
	@echo "Instalando pacotes PEAR..."
	pear install pear.phpunit.de/PHPUnit
	pear install --alldeps phpmd/PHP_PMD
	pear install PHP_CodeSniffer-1.3.2

brew-install:
	brew install GraphViz

test:
	@echo "Rodando testes..."
	phpunit -c config/phpunit.xml

coverage:
	@echo "Gerando relatório de cobertura de testes..."
	phpunit -c config/phpunit.xml --coverage-html reports/coverage

showcoverage:
	@echo "Abrindo relatório de cobertura de código..."
	open reports/coverage/index.html

md:
	@echo "Procurando problemas no código..."
	phpmd src/ html codesize,unusedcode,design --reportfile reports/md/index.html

showmd:
	@echo "Abrindo relatório de problemas no código..."
	open reports/md/index.html

cs:
	@echo "Verificando violações ao padrão de escrita do código.código.."
	phpcs src/chegamos/ --encoding=utf-8 -p --report=summary -s --standard=config/phpcs.xml

doc:
	@echo "Gerando documentação..."
	php vendor/docblox/bin/docblox.php run -d src/chegamos -t reports/docblox 

showdoc:
	@echo "Abrindo documentação..."
	open reports/docblox/index.html

commit: test
	@echo "Commitando alterações..."
	git commit

save: test cs md
	@echo "Executando tasks do save..."
