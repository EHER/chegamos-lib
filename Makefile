default: help

help:
	@echo "Comandos disponíveis:"
	@echo "test\t\t Roda os teste e gera relatório"
	@echo "coverage\t Abre o relatório de cobertura"

depends:
	@echo "Atualizando dependências do projeto..."
	git submodule update
	pear config-set auto_discover 1
	pear install pear.phpunit.de/PHPUnit
	pear channel-discover pear.phpmd.org
	pear channel-discover pear.pdepend.org
	pear install --alldeps phpmd/PHP_PMD

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

