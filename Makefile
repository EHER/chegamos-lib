default: help

help:
	@echo "Comandos disponíveis:"
	@echo "depends\t\t Instala as atualizações do projeto"
	@echo "test\t\t Roda os teste e gera relatório"
	@echo "coverage\t Abre o relatório de cobertura"
	@echo "md\t\t Procura problemas no código e gera relatório"
	@echo "showmess\t Abre o relatório de problemas no código"
	@echo "commit\t\t Faz o git commit depois de rodar os testes"
	@echo "checkstyle\t Verifica violações ao padrão de escrita"
	@echo "showstyle\t Abre o relatório violações ao padrão de código"
	@echo "doc\t\t"

depends: git-submodules pear-config pear-install
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

test:
	@echo "Rodando testes e gerando relatório de cobertura..."
	phpunit

coverage:
	@echo "Abrindo relatório de cobertura de código..."
	open reports/coverage/index.html

md:
	@echo "Procurando coisas estranhas no código..."
	phpmd src/ html codesize,unusedcode,design --reportfile reports/mess/index.html

showmess:
	@echo "Abrindo relatório de coisas estranhas..."
	open reports/mess/index.html

commit: test
	@echo "Commitando alterações..."
	git commit

cs:
	@echo "Verificando violações ao padrão de escrita do código.código.."
	phpcs src/chegamos/ --standard=PEAR --encoding=utf-8

doc:
	@echo "Gerando documentação..."
	php vendor/docblox/bin/docblox.php run -d src/chegamos -t reports/doc 

save: test cs md
	@echo "Executando tasks do save..."
