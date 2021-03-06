current_dir = $(shell pwd)

all: cs unit
travis: cs unit-travis
contrib: cs unit

init:
	if [ ! -d vendor ]; then composer install; fi;

cs: init
	$(current_dir)/vendor/bin/phpcs --standard=PSR2 src/

unit: init
	$(current_dir)/vendor/bin/phpunit --coverage-text --coverage-html covHtml

unit-travis: init
	$(current_dir)/vendor/bin/phpunit --coverage-text --coverage-clover ./build/logs/clover.xml

travis-coverage: init
	if [ -f ./build/logs/clover.xml ]; then wget https://scrutinizer-ci.com/ocular.phar && php ocular.phar code-coverage:upload --format=php-clover ./build/logs/clover.xml; fi
