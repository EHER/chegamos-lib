default: help

help:
	@echo "Comandos disponíveis:"
	@echo "depends\t\t Instala as atualizações do projeto"
	@echo "test\t\t Roda os teste e gera relatório"
	@echo "coverage\t Abre o relatório de cobertura"
	@echo "md\t\t Procura problemas no código e gera relatório"
	@echo "showmess\t Abre o relatório de problemas no código"
	@echo "commit\t Faz o git commit depois de rodar os testes"

depends:
	@echo "Atualizando dependências do projeto..."
	git submodule update --init
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

commit: test
	@echo "Commitando alterações..."
	git commit
