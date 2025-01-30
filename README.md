```
vue create frontend
```
```
cd frontend
```
```
vue add vuetify
```
```
cd ..
```
```
symfony new backend --version="7.2.X"
```
```
cd backend
```
```
composer require makerbundle --dev
```
```
composer require api
```
```
inside .env
configure database
then start database
```
```
symfony console make:entity --api-resource
```
```
symfony console doctrine:database:create
```
```
symfony console make:migration
```
```
symfony console doctrine:migrations:migrate
```
```
symfony console make:controller myController
```

