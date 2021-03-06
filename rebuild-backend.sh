rm -rf ./backend
rm -rf ./docker/backend

git clone git@github.com:ozitag/tager-backend.git backend
rm -rf backend/.git

mv backend/src _backend
cp -R backend/docker docker/backend
rm -rf backend
mv _backend backend
cp backend/.env.example backend/.env

cp .tager/assets/favicon/favicon.ico backend/public/favicon.ico

sed -i -e 's/ \/src/ \/backend/g' docker/backend/Dockerfile
sed -i -e 's/ \/docker/ \/docker\/backend/g' docker/backend/Dockerfile
rm docker/backend/Dockerfile-e