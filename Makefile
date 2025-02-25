.PHONY: up down composer
up:
	docker-compose up -d
	docker-compose down
composer:
	docker-compose exec app composer $(filter-out $@,$(MAKECMDGOALS))