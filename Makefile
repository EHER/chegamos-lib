default: help

help:
	@echo "Comandos disponíveis:"
	@echo "install\t\t Instala as dependências do projeto"
	@echo "update\t\t Instala as dependências do projeto"
	@echo "test\t\t Roda os testes"
	@echo "coverage\t Gera relatório de cobertura de testes"
	@echo "showcoverage\t Abre o relatório de cobertura de testes"
	@echo "md\t\t Procura problemas no código"
	@echo "cs\t\t Procura violações ao padrão de escrita do código"
	@echo "commit\t\t Faz o git commit depois de rodar os testes"

install: composer-install
	@echo "Instalando as dependências do projeto"

remove-vendors:
	@echo "Removendo vendors"
	@rm -rf vendors composer.lock

reinstall: remove-vendors install

update: composer-update

composer-install:
	@echo "Instalando dependencias usando o Composer"
	composer install --dev

composer-update:
	@echo "Atualizando dependencias usando o Composer"
	composer update --dev

brew-install:
	brew install GraphViz

test:
	@echo "Rodando testes"
	bin/phpunit

coverage:
	@echo "Gerando relatório de cobertura de testes"
	vendor/bin/phpunit --coverage-html reports/coverage

showcoverage:
	@echo "Abrindo relatório de cobertura de código"
	open reports/coverage/index.html

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
