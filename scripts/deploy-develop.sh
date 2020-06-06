cd /srv/tager

sudo chown www-data:www-data -R .

sudo -u www-data git fetch --all
sudo -u www-data git reset --hard origin/master
sudo -u www-data git clean -f -d

sudo cp .env.development .env
sudo cp web/.env.development web/.env
sudo cp backend/.env.development backend/.env
sudo cp admin/.env.development admin/.env

sudo cp scripts/nginx-develop.conf /etc/nginx/sites-available/tager

sudo docker-compose -f docker-compose.dev.yml --project-name tager up --build --force-recreate -d