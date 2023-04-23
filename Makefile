build-module-zip: build-composer build-zip

build-zip:
	rm -rf is_shoppingcart.zip
	cp -Ra $(PWD) /tmp/is_shoppingcart
	rm -rf /tmp/is_shoppingcart/config_*.xml
	rm -rf /tmp/is_shoppingcart/_theme_dev/node_modules
	rm -rf /tmp/is_shoppingcart/.github
	rm -rf /tmp/is_shoppingcart/.gitignore
	rm -rf /tmp/is_shoppingcart/.php-cs-fixer.cache
	rm -rf /tmp/is_shoppingcart/.git
	mv -v /tmp/is_shoppingcart $(PWD)/is_shoppingcart
	zip -r is_shoppingcart.zip is_shoppingcart
	rm -rf $(PWD)/is_shoppingcart

build-composer:
	composer install --no-dev -o

