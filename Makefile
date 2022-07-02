PHP = php
PHPFLAGS =

style:
	$(PHP) $(PHPFLAGS) vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php -v

quality:
	$(PHP) $(PHPFLAGS) vendor/bin/phpstan analyze

tests:
	$(PHP) $(PHPFLAGS) vendor/bin/phpunit

.PHONY: tests quality style